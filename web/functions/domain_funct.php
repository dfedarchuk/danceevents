<?php

/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
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
# * FILE: /functions/domain_funct.php
# ----------------------------------------------------------------------------------------------------


/**
 * Return the number of active domain
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @param object $db
 */
function domain_returnTotal($db = false)
{

    if (!$db) {
        $db = db_getDBObject(DEFAULT_DB, true);
    }
    $sql = "SELECT count(id) AS total FROM Domain WHERE status = 'A'";
    $result = $db->query($sql);
    $row = mysql_fetch_assoc($result);

    return (int)$row['total'];
}

/**
 * Function to verify is one record already exists on second DB
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @name domain_returnIfExistReg ()
 * @param integer $id
 * @param string $table
 * @param object $db
 */
function domain_returnIfExistReg($id, $table, $db)
{

    $sql = "SELECT id FROM " . $table . " WHERE id = " . $id . " LIMIT 1";
    $result = $db->query($sql);
    if (mysql_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * Return a dropdown containing all domains or, case exists only one domain, the domain id.
 * If the params are feeded, a post automatically is made for the option chosen.
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @name domain_getDropDown ()
 * @param string $http_host
 * @param string $request_uri
 * @param integer $domain_id
 * @return array|bool
 */
function domain_getDropDown($http_host = false, $request_uri = false, $query_string = false, $domain_id = false)
{

    if (   (string_strpos($_SERVER["PHP_SELF"], "login.php") !== false)
        || (string_strpos($_SERVER["PHP_SELF"], "resetpassword.php")) !== false
        || (string_strpos($_SERVER["PHP_SELF"], "forgotpassword.php")) !== false
    ) {
        return false;
    }

    $http_host = str_replace(EDIRECTORY_FOLDER, "", $http_host);

    $dbObj = db_getDBObject(DEFAULT_DB, true);

    $whereLiveMode = "";

    if (DEMO_LIVE_MODE && strpos($_SERVER["SERVER_NAME"], "demodirectory.com.br") === false) {
        $whereLiveMode = "AND id not IN (3, 7, 8)";
    }

    $sql = "SELECT id, name, url FROM Domain WHERE status = 'A' $whereLiveMode ORDER BY name";
    $result = $dbObj->query($sql);

    $arrayDomains = [];
    $i = 0;

    if (mysql_num_rows($result) > 1) {

        while ($row = mysql_fetch_assoc($result)) {

            $domainName = $row["name"];

            $domainOnClick = "";
            if ($http_host && $request_uri) {
                $domainOnClick = "onclick=\"changeDomainInfo($(this).attr('data-id'), '" . $http_host . "', '" . $request_uri . "','" . $query_string . "','" . (sess_getAccountIdFromSession() ? "true" : "false") . "');\"";
            }
            if (domain_checkDropDown()) {
                $domainDisabled = true;
            } else {
                $domainDisabled = false;
            }

            $arrayDomains[$row["id"]]["id"] = $row["id"];
            $arrayDomains[$row["id"]]["name"] = $domainName;
            $arrayDomains[$row["id"]]["onclick"] = $domainOnClick;
            $arrayDomains[$row["id"]]["disabled"] = $domainDisabled;
            $i++;
        }

        return $arrayDomains;

    } else {
        return false;
    }
}

/**
 * Use this to verify if the domain dropdown must be disabled or not according to URL
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 7.8.00
 * @package Classes
 * @name domain_checkDropDown
 * @access Public
 * @return boolean
 */
function domain_checkDropDown()
{

    $array_modules[] = "Listing";
    $array_modules[] = "Banner";
    $array_modules[] = "Event";
    $array_modules[] = "Classified";
    $array_modules[] = "Article";
    $array_modules[] = "Promotion";
    $array_modules[] = "Blog";
    $array_modules[] = "Category";
    $array_modules[] = "CustomInvoice";
    $array_modules[] = "Faq";
    $array_modules[] = "Pay";
    $array_modules[] = "Email";

    $openPMsmaccount = string_strpos($_SERVER["PHP_SELF"], "/smaccount/");
    $openPMmembersPackage = string_strpos($_SERVER["PHP_SELF"], "order_package.php");

    $openPMview = string_strpos($_SERVER["PHP_SELF"], "/view") || (string_strpos($_SERVER["PHP_SELF"],
            "/report.php")) || (string_strpos($_SERVER["PHP_SELF"],
                "/index.php") && string_strpos($_SERVER["REQUEST_URI"], "?category_id"));
    $openPMedit = (isset($_GET["id"]) && $_GET["id"] != "") && !$openPMview && (!string_strpos($_SERVER["PHP_SELF"],
                "/report.php") && (!string_strpos($_SERVER["PHP_SELF"],
                "search")) && (!string_strpos($_SERVER["PHP_SELF"], "index")));
    string_strpos($_SERVER["PHP_SELF"], "/account/") ? $openPMview = false : "";
    string_strpos($_SERVER["PHP_SELF"], "/account/") ? $openPMedit = false : "";
    $openPMaddCustomInvoice = string_strpos($_SERVER["PHP_SELF"], "/custominvoice.php");
    $openPMaddPay = string_strpos($_SERVER["PHP_SELF"], "/pay.php");
    $openPMaddEmail = string_strpos($_SERVER["PHP_SELF"], "/email.php");
    $openPMaddType = string_strpos($_SERVER["PHP_SELF"], "/template.php");
    $openPMaddPackage = string_strpos($_SERVER["PHP_SELF"], "/package.php");
    $openPMPayment = string_strpos($_SERVER["PHP_SELF"], "/processpayment.php");
    $openPMPCustomPage = string_strpos($_SERVER["PHP_SELF"], "/custom.php");

    $openPMaddListing = (((string_strpos($_SERVER["PHP_SELF"],
                "listinglevel")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id"))) || ((string_strpos($_SERVER["PHP_SELF"],
                "listing.php")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id")) && (!string_strpos($_SERVER["PHP_SELF"],
                "content"))) && !(isset($_GET["id"]) && $_GET["id"] != ""));
    $openPMaddBanner = string_strpos($_SERVER["PHP_SELF"], "add") && !(isset($_GET["id"]) && $_GET["id"] != "");
    $openPMaddEvent = (((string_strpos($_SERVER["PHP_SELF"], "eventlevel")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id"))) || ((string_strpos($_SERVER["PHP_SELF"],
                "event.php")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id")) && (!string_strpos($_SERVER["PHP_SELF"],
                "content"))) && !(isset($_GET["id"]) && $_GET["id"] != ""));
    $openPMaddClassified = (((string_strpos($_SERVER["PHP_SELF"],
                "classifiedlevel")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id"))) || ((string_strpos($_SERVER["PHP_SELF"],
                "classified.php")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id")) && (!string_strpos($_SERVER["PHP_SELF"],
                "content"))) && !(isset($_GET["id"]) && $_GET["id"] != ""));
    $openPMaddArticle = ((string_strpos($_SERVER["PHP_SELF"], "articlelevel")) || ((string_strpos($_SERVER["PHP_SELF"],
                "article.php")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id")) && (!string_strpos($_SERVER["PHP_SELF"],
                "content"))) && !(isset($_GET["id"]) && $_GET["id"] != ""));
    $openPMaddPromotion = ((string_strpos($_SERVER["PHP_SELF"], "deal.php")) && (!string_strpos($_SERVER["PHP_SELF"],
                "prefs/deal.php")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id"))) && !(isset($_GET["id"]) && $_GET["id"] != "");
    $openPMaddBlog = (((string_strpos($_SERVER["PHP_SELF"], "blog.php")) && (!string_strpos($_SERVER["REQUEST_URI"],
                "?id"))) && !(isset($_GET["id"]) && $_GET["id"] != ""));
    $openPMaddCategory = (string_strpos($_SERVER["PHP_SELF"],
            "/category.php") && !$openPMeditCategory && (!string_strpos($_SERVER["PHP_SELF"], "review")));

    foreach ($array_modules as $module) {
        if ((${"openPMadd" . $module}) || ($openPMview) || ($openPMedit) || ($openPMsmaccount) || ($openPMaddType) || $openPMaddPackage || $openPMPayment || $openPMPCustomPage || $openPMmembersPackage) {
            return true;
        }
    }

}

/**
 * Use this to verify if a URL is valid
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 7.8.00
 * @package Classes
 * @name domain_validateDomainUrl
 * @access Public
 * @param varchar $url
 * @return boolean
 */
function domain_validateDomainUrl($url)
{
    $url = str_replace("http://", "", $url);
    $url = str_replace("https://", "", $url);
    $url = str_replace("www.", "", $url);
    $pattern = "/^([[:alnum:]]|\-){1,}\.([[:alnum:]]|\-){1,}(\.[[:alnum:]]{1,}){0,}$/";
    if (preg_match($pattern, $url)) {
        return true;
    } else {
        return false;
    }
}

function domain_getLevelInfo($array_fields, $table_name, $domain_id = false)
{

    if ($domain_id) {
        $db_main = db_getDBObject(DEFAULT_DB, true);
        $db = db_getDBObjectByDomainID($domain_id, $db_main);
    } else {
        $db = db_getDBObject();
    }

    $sql = "SELECT " . (is_array($array_fields) ? implode(",",
            $array_fields) : $array_fields) . ", '" . $table_name . "' AS table_name FROM " . $table_name . " WHERE active = 'y' ORDER BY value" . ($table_name != "BannerLevel" ? " DESC" : "");
    $result = $db->query($sql);
    if (mysql_num_rows($result)) {
        unset($array_levels);
        while ($row = mysql_fetch_assoc($result)) {
            $array_levels[] = $row;
        }
        if (count($array_levels) > 0) {
            return $array_levels;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


function domain_getModulesEnabledByDomain($domain_id = false, $use_banner = false)
{
    /*
     * Check constants
     */
    unset($array_module_level);
    $array_fields[] = "value";
    $array_fields[] = "name";

    if ($domain_id) {
        unset($domainObj);
        $domainObj = new Domain($domain_id);
        $aux_domain_event_feature = $domainObj->getString("event_feature");
        $aux_domain_banner_feature = $domainObj->getString("banner_feature");
        $aux_domain_classified_feature = $domainObj->getString("classified_feature");
        $aux_domain_article_feature = $domainObj->getString("article_feature");


        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObjCat = db_getDBObjectByDomainID($domain_id, $dbMain);

        $sql = "SELECT value FROM Setting WHERE name LIKE 'custom_event_feature'";
        $result = $dbObjCat->query($sql);
        $row = mysql_fetch_assoc($result);
        $aux_domain_custom_event_feature = $row['value'];

        $sql = "SELECT value FROM Setting WHERE name LIKE 'custom_classified_feature'";
        $result = $dbObjCat->query($sql);
        $row = mysql_fetch_assoc($result);
        $aux_domain_custom_classified_feature = $row['value'];

        $sql = "SELECT value FROM Setting WHERE name LIKE 'custom_article_feature'";
        $result = $dbObjCat->query($sql);
        $row = mysql_fetch_assoc($result);
        $aux_domain_custom_article_feature = $row['value'];

        $sql = "SELECT value FROM Setting WHERE name LIKE 'custom_banner_feature'";
        $result = $dbObjCat->query($sql);
        $row = mysql_fetch_assoc($result);
        $aux_domain_custom_banner_feature = $row['value'];

        @include(EDIRECTORY_ROOT . '/custom/domain_' . $domain_id . '/theme/theme.inc.php');

        unset($edir_theme);


    } else {
        $aux_domain_event_feature = EVENT_FEATURE;
        $aux_domain_banner_feature = BANNER_FEATURE;
        $aux_domain_classified_feature = CLASSIFIED_FEATURE;
        $aux_domain_article_feature = ARTICLE_FEATURE;

        $aux_domain_custom_event_feature = CUSTOM_EVENT_FEATURE;
        $aux_domain_custom_banner_feature = CUSTOM_BANNER_FEATURE;
        $aux_domain_custom_classified_feature = CUSTOM_CLASSIFIED_FEATURE;
        $aux_domain_custom_article_feature = CUSTOM_ARTICLE_FEATURE;

    }

    if ($aux_domain_event_feature == "on" && $aux_domain_custom_event_feature == "on") {
        /*
         * Get Levels
         */
        $array_module_level[LANG_SITEMGR_EVENT] = domain_getLevelInfo($array_fields, "EventLevel", $domain_id);

    }

    if ($use_banner && $aux_domain_banner_feature == "on" && $aux_domain_custom_banner_feature == "on") {
        /*
         * Get Levels
         */
        $array_module_level[LANG_SITEMGR_BANNER] = domain_getLevelInfo($array_fields, "BannerLevel", $domain_id);
    }

    if ($aux_domain_classified_feature == "on" && $aux_domain_custom_classified_feature == "on") {
        /*
         * Get Levels
         */
        $array_module_level[LANG_SITEMGR_CLASSIFIED] = domain_getLevelInfo($array_fields, "ClassifiedLevel",
            $domain_id);
    }

    if ($aux_domain_article_feature == "on" && $aux_domain_custom_article_feature == "on") {
        /*
         * Get Levels
         */
        $array_module_level[LANG_SITEMGR_ARTICLE] = domain_getLevelInfo($array_fields, "ArticleLevel", $domain_id);
    }


    /*
     * Get Levels to Listing
     */
    $array_module_level[LANG_SITEMGR_LISTING] = domain_getLevelInfo($array_fields, "ListingLevel", $domain_id);


    if ($array_module_level) {
        return $array_module_level;
    } else {
        return false;
    }


}

function domain_DropDownModuleDomain($domain_id = false, $array_options = false, $use_banner = false)
{

    unset($array_modules_level, $array_dropdown_items);

    $array_modules_level = domain_getModulesEnabledByDomain($domain_id, $use_banner);

    $j = 0;

    unset($aux_compare_domains);

    foreach ($array_modules_level as $key => $value) {

        for ($i = 0; $i < count($value); $i++) {

            /*
             * Get type of item
             */
            unset($aux_key);
            if ($value[$i]["table_name"] == "EventLevel") {
                $aux_key = "event";
            } elseif ($value[$i]["table_name"] == "ArticleLevel") {
                $aux_key = "article";
            } elseif ($value[$i]["table_name"] == "BannerLevel" && $use_banner) {
                $aux_key = "banner";
            } elseif ($value[$i]["table_name"] == "ClassifiedLevel") {
                $aux_key = "classified";
            } elseif ($value[$i]["table_name"] == "ListingLevel") {
                $aux_key = "listing";
            }

            if ($aux_compare_domains) {
                echo $aux_key . "_" . $value[$i]["value"] . "<br />";
                if (in_array($aux_key . "_" . $value[$i]["value"], $array_options)) {
                    $array_dropdown_items[$j]["label"] = ucfirst($key) . ($value[$i]["table_name"] == "ArticleLevel" ? "" : " - " . ucfirst($value[$i]["name"]));
                    $array_dropdown_items[$j]["option_id"] = $aux_key . "_" . $value[$i]["value"];
                }
            } else {
                $array_dropdown_items[$j]["label"] = ucfirst($key) . ($value[$i]["table_name"] == "ArticleLevel" ? "" : " - " . ucfirst($value[$i]["name"]));
                $array_dropdown_items[$j]["option_id"] = $aux_key . "_" . $value[$i]["value"];
            }

            $j++;
        }

    }
    if (count($array_dropdown_items) > 0) {
        return $array_dropdown_items;
    } else {
        return false;
    }

}

function domain_CommonModuleLevel($array_domains, $array_options, $use_banner = false)
{

    $str = "";
    if (is_array($array_domains)) {
        unset($domain_options);
        $domain_options = [];
        for ($i = 0; $i < count($array_domains); $i++) {
            if (array_key_exists("id", $array_domains[$i])) {
                unset($aux_array_options, $array_options_diff, $array_aux);

                /*
                 * Get options of module and level that exists on $array_options
                 */

                $aux_array_options = domain_DropDownModuleDomain($array_domains[$i]["id"], $array_options, $use_banner);

                for ($j = 0; $j < count($aux_array_options); $j++) {
                    ${"array_aux_" . $i}[] = $aux_array_options[$j]["option_id"];
                }
                /*
                 * Add items that doesn't exist on $domain_options
                 */
//					$array_options_diff = array_diff($aux_array_options, $domain_options);
//					if(is_array($array_options_diff) && count($array_options_diff)){
//						$domain_options = array_merge($domain_options,$array_options_diff);
//					}

                $str .= "\$array_aux_{$i}, ";
            }
        }
        if (count($array_domains) > 1) {

            $str = string_substr($str, 0, -2);
            eval("\$array_common = array_intersect($str);");

            $i = 0;
            foreach ($array_common as $info) {
                if (string_strpos($info, "listing") !== false) {
                    $domain_options[$i]["option_id"] = $info;
                    $level = explode("_", $info);
                    $levelObj = new ListingLevel();
                    $domain_options[$i]["label"] = LANG_LISTING_FEATURE_NAME . " - " . ucfirst($levelObj->getName($level[1]));
                }

                if (string_strpos($info, "event") !== false) {
                    $domain_options[$i]["option_id"] = $info;
                    $level = explode("_", $info);
                    $levelObj = new EventLevel();
                    $domain_options[$i]["label"] = LANG_EVENT_FEATURE_NAME . " - " . ucfirst($levelObj->getName($level[1]));
                }

                if (string_strpos($info, "article") !== false) {
                    $domain_options[$i]["option_id"] = $info;
                    $level = explode("_", $info);
                    $levelObj = new ArticleLevel();
                    $domain_options[$i]["label"] = LANG_ARTICLE_FEATURE_NAME;
                }

                if (string_strpos($info, "classified") !== false) {
                    $domain_options[$i]["option_id"] = $info;
                    $level = explode("_", $info);
                    $levelObj = new ClassifiedLevel();
                    $domain_options[$i]["label"] = LANG_CLASSIFIED_FEATURE_NAME . " - " . ucfirst($levelObj->getName($level[1]));
                }

                if ((string_strpos($info, "banner") !== false) && $use_banner) {
                    $domain_options[$i]["option_id"] = $info;
                    $level = explode("_", $info);
                    $levelObj = new BannerLevel();
                    $domain_options[$i]["label"] = LANG_BANNER_FEATURE_NAME . " - " . ucfirst($levelObj->getName($level[1]));
                }
                $i++;
            }
        } else {
            $domain_options = $aux_array_options;
        }
        if (is_array($domain_options)) {

            if (is_array($domain_options)) {
                return $domain_options;
            } else {
                return false;
            }

        }

    }
}

function domain_saveLogForPackageItems($package_id, $posted_items, $SMAccount)
{

    if ($package_id && $posted_items && $SMAccount) {

        /*
         * Get old items of package
         */
        unset($packageItemObj);
        $packageItemObj = new PackageItems();
        $array_items = $packageItemObj->getItemsByPackageId($package_id);

        if (is_array($array_items)) {
            unset($array_old_items);
            for ($i = 0; $i < count($array_items); $i++) {
                $array_old_items[] = "Module: " . $array_items[$i]["module"] . " Level: " . ($array_items[$i]["level"] ? $array_items[$i]["level"] : "No level") . " Price: " . $array_items[$i]["price"] . " For Domain: " . ($array_items[$i]["domain_id"] ? $array_items[$i]["domain_id"] : "All");
            }
            $old_items = implode(" || ", $array_old_items);
        } else {
            $old_items = "";
        }

        /*
         * Get posted items
         */
        if (is_array($posted_items)) {
            unset($array_new_items);
            for ($i = 0; $i < count($posted_items); $i++) {
                $array_new_items[] = "Module: " . $posted_items[$i]["module"] . " Level: " . ($posted_items[$i]["level"] ? $posted_items[$i]["level"] : "No level") . " Price: " . $posted_items[$i]["price"] . " For Domain: " . ($posted_items[$i]["domain_id"] ? $posted_items[$i]["domain_id"] : "All");
            }
            $new_items = implode(" || ", $array_new_items);
        } else {
            $new_items = $posted_items;
        }

        /*
         * Save log
         */
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $sql = "INSERT INTO PackageItemsLOG (package_id,old_items,new_items,updated,smaccount) VALUES (" . $package_id . ",'" . $old_items . "','" . $new_items . "',NOW(),'" . $SMAccount . "')";
        $dbMain->query($sql);

        /*
         * Delete items of this package
         */
        if ($packageItemObj->DeleteItemsByPackageID($package_id)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function domain_numberPackages($constantFile = false, $module, $level)
{
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $sql = "SELECT id FROM Package WHERE parent_domain = " . SELECTED_DOMAIN_ID . " AND module = '" . $module . "' AND level ='" . $level . "' AND status = 'A'";
    $r = $dbMain->query($sql);
    $lines = mysql_num_rows($r);

    return $lines;
}

function domain_findConstants($word, $domain, $constantFile = false)
{
    if (!$domain || !$word) {
        return false;
    }

    if (!$constantFile) {
        $constantFile = EDIRECTORY_ROOT . "/custom/domain_$domain/conf/constants.inc.php";
    }

    if (file_exists($constantFile)) {
        $fp = fopen($constantFile, 'r');
        if ($fp && filesize($constantFile)) {
            $phptext = file_get_contents($constantFile);
            $startPos = string_strpos($phptext, $word);

            $text1 = string_substr($phptext, $startPos, string_strlen($phptext));

            $text2 = string_substr($text1, 0, string_strpos($text1, ");"));
            $text2 = str_replace("'", '', $text2);
            $text2 = str_replace('"', '', $text2);
            $text2ARR = explode(',', $text2);

            return trim($text2ARR[1]);
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function domain_SaveAccountInfoDomain($aux_account, $object)
{
    if (is_numeric(str_replace("'", "", $object->domain_id))) {
        $accDomain = new Account_Domain($aux_account, str_replace("'", "", $object->domain_id));
    } else {
        $accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
    }
    $accDomain->Save();
    $accDomain->saveOnDomain($aux_account, $object);
}

?>
