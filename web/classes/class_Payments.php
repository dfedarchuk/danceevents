<?php
/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2016 Arca Solutions, Inc. All Rights Reserved.           #
#                                                                    #
# This file may not be redistributed in whole or part.               #
# eDirectory is licensed on a per-domain basis.                      #
#                                                                    #
# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
#                                                                    #
# http://www.edirectory.com | http://www.edirectory.com/license.html #
######################################################################
\*==================================================================*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /classes/class_Payments.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *		$paymentObj = new Payment();
 * <code>
 * @copyright Copyright 2016 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 11.1.00
 * @package Classes
 * @name Payments
 * @access Public
 */

class Payments
{

    public static  function newPayment($data) {
        if ($data["recurring_status"] != "trialing") {
            $logObj = self::registerLog($data);
        }

        $modules = array("listing", "event", "classified", "article", "banner", "custominvoice", "package");

        foreach ($modules as $module) {
            if (is_array($data[$module."_id"]) && $module != "package") {
                self::renewItem($logObj, $data, $module);
            } elseif ($module == "package" && !empty($data["package_id"])) {
                self::PayPackage($logObj, $data);
            }
        }

        if ($logObj) {
            $logObj->sendNotification();
        }
    }

    public static  function registerLog($data) {

        $log["account_id"] = $data["account_id"];
        $log["username"] = $data["account_username"];
        $log["ip"] = $_SERVER["REMOTE_ADDR"];
        $log["transaction_id"] = $data["transaction_id"];
        $log["transaction_status"] = $data["transaction_status"];
        $log["transaction_datetime"] = date("Y-m-d H:i:s");
        $log["transaction_tax"] = $data["tax"];
        $log["transaction_subtotal"] = $data["subtotal"];
        $log["transaction_amount"] = $data["amount"];
        $log["transaction_currency"] = $data["currency"];
        $log["system_type"] = $data["gateway"];
        $log["recurring"] = $data["recurring"];
        $log["notes"] = $data["notes"];

        $paymentLogObj = new PaymentLog($log);
        $paymentLogObj->Save();

        return $paymentLogObj;
    }

    public static  function renewItem($paymentLogObj = "", $data, $module) {

        switch ($module) {
            case "listing":
                $levelObj = new ListingLevel();
                $moduleObj = "Listing";
                $logObj = "PaymentListingLog";
                break;
            case "event":
                $levelObj = new EventLevel();
                $moduleObj = "Event";
                $logObj = "PaymentEventLog";
                break;
            case "classified":
                $levelObj = new ClassifiedLevel();
                $moduleObj = "Classified";
                $logObj = "PaymentClassifiedLog";
                break;
            case "article":
                $levelObj = new ArticleLevel();
                $moduleObj = "Article";
                $logObj = "PaymentArticleLog";
                break;
            case "banner":
                $levelObj = new BannerLevel();
                $moduleObj = "Banner";
                $logObj = "PaymentBannerLog";
                break;
            case "custominvoice":
                $moduleObj = "CustomInvoice";
                $logObj = "PaymentCustomInvoiceLog";
                break;
        }

        $itemStatus = new ItemStatus();
        $priceAux = 0;

        if (is_array($data[$module."_id"])) foreach ($data[$module."_id"] as $each_item_id) {

            $itemObj = new $moduleObj($each_item_id);

            $renewal_cycle = ($_SESSION["order_renewal_period_{$module}_{$each_item_id}"] ? $_SESSION["order_renewal_period_{$module}_{$each_item_id}"] : $data["renewal"]);
            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

            if ($module == "banner") {

                if ($itemObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) {

                    $dbObj = db_getDBObject();

                    setting_get("banner_approve_paid", $banner_approve_paid);

                    if ($banner_approve_paid) {
                        $sql = "UPDATE Banner set impressions = impressions + " . $itemObj->getNumber("unpaid_impressions") . ", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = " . $itemObj->getNumber("id");
                    } else {
                        $sql = "UPDATE Banner set impressions = impressions + " . $itemObj->getNumber("unpaid_impressions") . ", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = " . $itemObj->getNumber("id");
                    }

                    $dbObj->query($sql);

                    $id = $itemObj->getNumber("id");
                    $unpaid_impressions[$id] = $itemObj->getNumber("unpaid_impressions");

                } elseif ($itemObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) {

                    $itemObj->setString("renewal_date", $itemObj->getNextRenewalDate(1, $renewal_cycle));

                    setting_get("banner_approve_paid", $banner_approve_paid);

                    if ($banner_approve_paid) {
                        $itemObj->setString("status", $itemStatus->getDefaultStatus());
                    } else {
                        $itemObj->setString("status", "A");
                    }

                    $itemObj->Save();

                }

                $log["banner_caption"] = $itemObj->getString("caption", false);
                $log["impressions"] = ($data[$module."_unpaid_impressions"][$each_item_id]) ? $data[$module."_unpaid_impressions"][$each_item_id] : 0;

            } elseif ($module == "custominvoice") {

                if ($paymentLogObj->getNumber("transaction_tax") > 0) {
                    $cInvoiceAmount = payment_calculateTax($itemObj->getNumber("amount"), $paymentLogObj->getNumber("transaction_tax"));
                } else {
                    $cInvoiceAmount = $itemObj->getNumber("amount");
                }
                $itemObj->setNumber("tax", $paymentLogObj->getNumber("transaction_tax"));
                $itemObj->setNumber("subtotal", $itemObj->getNumber("amount"));
                $itemObj->setNumber("amount", $cInvoiceAmount);
                $itemObj->setString("paid", "y");
                $itemObj->Save();

                $log["custom_invoice_id"] = $itemObj->getString("id");
                $log["title"] = $itemObj->getString("title");
                $log["date"] = $itemObj->getString("date");
                $log["items"] = $itemObj->getTextItems();
                $log["items_price"] = $itemObj->getTextPrices();
                $log["amount"] = $itemObj->getNumber("subtotal");
                $priceAux++;

            } else {

                $itemObj->setString("renewal_date", $itemObj->getNextRenewalDate(1, $renewal_cycle));
                setting_get($module . "_approve_paid", $item_approve_paid);

                if ($item_approve_paid) {
                    $itemObj->setString("status", $itemStatus->getDefaultStatus());
                } else {
                    $itemObj->setString("status", "A");
                }

                $itemObj->Save();

            }

            if ($module == "listing") {
                $dbObjCat = db_getDBObject();
                $category_amount = 0;
                $sql = "SELECT category_id FROM Listing_Category WHERE listing_id = " . $itemObj->getString("id") . "";
                $result = $dbObjCat->query($sql);
                if (mysql_num_rows($result)) {
                    while ($row = mysql_fetch_assoc($result)) {
                        $category_amount++;
                    }
                }

                $log["extra_categories"] = 0;
                if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($itemObj->getString("level"))) > 0)) {
                    $log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($itemObj->getString("level"));
                } else {
                    $log["extra_categories"] = 0;
                }

                $log["listingtemplate_title"] = "";
                if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                    if ($itemObj->getString("listingtemplate_id")) {
                        $listingTemplateObj = new ListingTemplate($itemObj->getString("listingtemplate_id"));
                        $log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
                    }
                }

                $log["categories"] = ($category_amount) ? $category_amount : 0;

            }

            if ($paymentLogObj) {

                $log["payment_log_id"] = $paymentLogObj->getNumber("id");
                $log[$module . "_id"] = $itemObj->getString("id");
                $log[$module . "_title"] = $itemObj->getString("title", false);
                $log["renewal_date"] = $itemObj->getString("renewal_date");
                $log["discount_id"] = $itemObj->getString("discount_id");
                if (!$log["amount"]) {
                    $log["amount"] = str_replace(",", "", $data[$module . "_price"][$priceAux]);
                }
                if ($levelObj) {
                    $log["level"] = $itemObj->getString(($module == "banner" ? "type" : "level"));
                    $log["level_label"] = $levelObj->showLevel($itemObj->getString(($module == "banner" ? "type" : "level")));
                }
                $paymentLogItemObj = new $logObj($log);
                $paymentLogItemObj->Save();
            }
            $priceAux++;

        }

        unset($itemObj);

    }
    
    public static function PayPackage($logObj, $data)
    {
        if ($data["package_id"]) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".SELECTED_DOMAIN_ID." AND package_id = ".$data["package_id"]." AND account_id = ".$data["account_id"];
            $r = $dbMain->query($sql);
            $i = 0;
            while ($row = mysql_fetch_assoc($r)) {
                $itemsInfo[$i]["module_id"] = $row["module_id"];
                $itemsInfo[$i]["module"] = $row["module"];
                $itemsInfo[$i]["domain_id"] = $row["domain_id"];
                $i++;
            }

            foreach ($itemsInfo as $item) {
                if ($item["module"] != "custom_package") {
                    $className = ucfirst($item["module"]);
                    $item_id = $item["module_id"];
                    $domain_idItem = $item["domain_id"];

                    $itemObj = new $className($item_id);

                    $itemStatus = new ItemStatus();

                    setting_get($item["module"]."_approve_paid", $item_approve_paid);

                    if ($item_approve_paid) {
                        $status = $itemStatus->getDefaultStatus();
                    } else {
                        $status = "A";
                    }

                    $dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
                    $sql = "UPDATE $className SET status = ".db_formatString($status).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate(1, $data["renewal"]))." WHERE id = ".$item_id;
                    $dbItem->query($sql);
                }
            }

            $packageObj = new Package($data["package_id"]);
            $array_package_offers = $packageObj->getPackagesByDomainID();

            $auxitem_name = $array_package_offers[0]["items"][0]["module"];

            if ($auxitem_name) {
                switch ($auxitem_name) {
                    case 'listing':             $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
                        $level = new ListingLevel();
                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                        break;
                    case 'banner':              $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
                        $level = new BannerLevel();
                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                        break;
                    case 'event':               $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
                        $level = new EventLevel();
                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                        break;
                    case 'classified':          $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
                        $level = new ClassifiedLevel();
                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                        break;
                    case 'article':             $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
                        $level = new ArticleLevel();
                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                        break;
                    case 'custom_package':      $item_name = ucfirst(LANG_GIFT);
                        break;

                }

                $auxdomains_names = "";
                $aux_package_item_price = "";
                foreach ($array_package_offers as $package_offer) {
                    foreach ($package_offer['items'] as $package_offer_item) {
                        if ($package_offer_item['domain_id']>0) {
                            $aux_domain_obj = new Domain($package_offer_item['domain_id']);
                            $auxdomains_names .= "&nbsp;&nbsp;&nbsp;-".$aux_domain_obj->getString('name')."<br />";
                        }

                        if ($package_offer_item['price']==0) {
                            $aux_package_item_price .= CURRENCY_SYMBOL." ".system_showText(LANG_FREE)."<br />";
                        } else {
                            $aux_package_item_price .= CURRENCY_SYMBOL." ".$package_offer_item['price']."<br />";
                            $aux_package_total = $package_offer_item['price'];
                        }
                    }

                    $auxdomains_names = string_substr($auxdomains_names, 0, -4);

                }
            }

            setting_get("payment_tax_value", $payment_tax_value);
            $packageObj = new Package($data["package_id"]);

            $transaction_package_log["payment_log_id"]    = $logObj->getNumber("id");
            $transaction_package_log["package_id"]		  = $data["package_id"];
            $transaction_package_log["package_title"]     = $packageObj->getString("title");
            $transaction_package_log["items"]             = $item_name." ".$item_levelName."\n".str_replace("-","", $auxdomains_names);
            $transaction_package_log["items_price"]       = str_replace(CURRENCY_SYMBOL." ", "", str_replace("<br />", "\n", $aux_package_item_price));
            $transaction_package_log["amount"]            = payment_calculateTax(str_replace(",", "", $aux_package_total), $payment_tax_value, false);

            $paymentPacakgeObj = new PaymentPackageLog($transaction_package_log);
            $paymentPacakgeObj->Save();

            unset($packageObj);

        }
    }
    
}