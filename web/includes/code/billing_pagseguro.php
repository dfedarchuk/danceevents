<?

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
	# * FILE: /includes/code/billing_pagseguro.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_pagseguro.inc.php");
    
    if ($_SERVER["REQUEST_METHOD"] != "POST" && !$_POST['notificationType'] && !$_POST['notificationCode']){ //Members return

        LogPagSeguro::debug("Members return.");
        $payment_success = "y";

        $payment_message = "<p class=\"successMessage\">\n";
        if ($process == "claim") $payment_message .= system_showText(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED)."<br />\n".system_showText(LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED)."<br />\n(".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY).")<br />\n";
        else $payment_message .= system_showText(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED).($process != "signup" ? "<br />" : "")."\n".system_showText(LANG_LABEL_YOUR)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a> ".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED)."<br />\n(".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY).")\n";
        $payment_message .= $try_again_message."\n</p>";
        
    } elseif ($_POST['notificationType'] && $_POST['notificationCode']) { //Pagseguro notification

        LogPagSeguro::debug("New PagSeguro Notification. Type: ".$_POST['notificationType']." Code: ".$_POST['notificationCode']); 

        //Pagseguro credentials
        $credentials = new PagSeguroAccountCredentials(
            PAGSEGURO_EMAIL,
            PAGSEGURO_TOKEN
        );
        
        //Notification type 
        $type = $_POST['notificationType'];
        //Notification code 
        $code = $_POST['notificationCode'];

        if ($type === 'transaction') {
            /* Obtendo o objeto PagSeguroTransaction a partir do código de notificação */
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $code);
            
            LogPagSeguro::debug("Searching for transaction"); 
        }
        
        if ($transaction){
            
            LogPagSeguro::debug("Transaction found."); 
        
            $status = $transaction->getStatus();
            $reference = $transaction->getReference();
            $items = $transaction->getItems();
            
            LogPagSeguro::debug("Reading items..."); 

            foreach($items as $key => $item) {

                unset($tempItem_id);
                unset($tempItem);
                unset($aux_item);

                $tempItem_id = $item->getId();
                $aux_item = explode(":", $tempItem_id); 
                $itemType = $aux_item[0];
                $itemID = $aux_item[1];                
                $renewal = $aux_item[2];

                unset($tempItem);
                $tempItem["id"] = $itemID;
                $tempItem["type"] = $itemType;
                $tempItem["descricao"] = $item->getDescription();
                $tempItem["amount"] = $item->getAmount();
                $tempItem["renewal"] = $renewal;

                $itemArray[] = $tempItem;
                if ($itemType == "listing") $listingArray[] = $tempItem;
                if ($itemType == "event") $eventArray[] = $tempItem;
                if ($itemType == "banner") $bannerArray[] = $tempItem;
                if ($itemType == "classified") $classifiedArray[] = $tempItem;
                if ($itemType == "article") $articleArray[] = $tempItem;
                if ($itemType == "custominvoice") $customInvoiceArray[] = $tempItem;
                if ($itemType == "package") $package_renewal = $renewal;

            }
            
            LogPagSeguro::debug("Items read."); 

            $auxParams = explode("||", $reference);

            $acc_id = $auxParams[0];
            $domain_id = $auxParams[1];
            $package_id = $auxParams[2];
            $user_ip = $auxParams[3];
            $currency = $auxParams[4];
            $subtotal = $auxParams[5];
            $tax = $auxParams[6];

            $accountObj                             = new Account($acc_id);
            $transactionLog["account_id"]           = $acc_id;
            $transactionLog["username"]             = $accountObj->getString("username");
            $transactionLog["ip"]                   = $user_ip;
            $transactionLog["transaction_id"]       = $transaction->getCode();

            $transactionStatus = $transaction->getStatus();
            
            $statusValue = $transactionStatus->getValue();
            
            if ($statusValue == 1) {
                $transactionLog["transaction_status"] = "Waiting";
            } else if ($statusValue == 2) {
                $transactionLog["transaction_status"] = "Analysis";
            } else if ($statusValue == 3) {
                $transactionLog["transaction_status"] = "Paid";
            } else if ($statusValue == 4) {
                $transactionLog["transaction_status"] = "Available";
            } else if ($statusValue == 5) {
                $transactionLog["transaction_status"] = "Dispute";
            } else if ($statusValue == 6) {
                $transactionLog["transaction_status"] = "Refunded";
            } else if ($statusValue == 7) {
                $transactionLog["transaction_status"] = "Cancelled";
            }
            
            LogPagSeguro::debug("Transaction status: ".$transactionLog["transaction_status"]); 

            if (DEMO_DEV_MODE) {
                $transactionLog["transaction_status"] = "Paid";
            }

            $transaction_dateTime = explode("T",$transaction->getDate());
            $transaction_dateTime2 = explode(".", $transaction_dateTime[1]);

            $transactionLog["transaction_datetime"] = $transaction_dateTime[0]." ".$transaction_dateTime2[0];
            $transactionLog["transaction_subtotal"] = $subtotal;
            $transactionLog["transaction_tax"]      = $tax;
            $transactionLog["transaction_amount"]   = $transaction->getGrossAmount();
            $transactionLog["transaction_currency"] = $currency;
            $transactionLog["system_type"]          = "pagseguro";
            $transactionLog["recurring"]            = "n";
            $transactionLog["notes"]                = "";

            if ($itemArray) {
                
                LogPagSeguro::debug("Save logs"); 
                
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                $db = db_getDBObjectByDomainID($domain_id, $dbMain);
                $sql = "SELECT id FROM Payment_Log WHERE transaction_id = '".$transactionLog["transaction_id"]."' AND system_type = 'pagseguro'";
                $r = $db->query($sql);

                if (mysql_num_rows($r) > 0) {
                    
                    LogPagSeguro::debug("Log found, let's update it."); 
                    
                    $row = mysql_fetch_assoc($r);
                    $transactionLog["return_fields"] = system_array2nvp($transactionLog, " || ");
                    $paymentLogObj = new PaymentLog($row["id"], $domain_id);
                    $paymentLogObj->MakeFromRow($transactionLog);
                    $paymentLogObj->Save($domain_id);

                } else {

                    LogPagSeguro::debug("No log found. Create new one."); 
                    
                    $transactionLog["return_fields"] = system_array2nvp($transactionLog, " || ");
                    $paymentLogObj = new PaymentLog($transactionLog, $domain_id);
                    $paymentLogObj->Save($domain_id);

                    if ($listingArray) {

                        $levelObj = new ListingLevel(false, $domain_id);
                        foreach ($listingArray as $each_listing) {

                            $listingObj = new Listing($each_listing["id"], $domain_id);

                            $category_amount = 0;
                            $sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$listingObj->getString("id")."";
                            $result = $db->query($sql);
                            if(mysql_num_rows($result)){
                                while($row = mysql_fetch_assoc($result)){
                                    $category_amount++;
                                }
                            }

                            $payment_listing_log["payment_log_id"] = $paymentLogObj->getString("id");
                            $payment_listing_log["listing_id"]     = $each_listing["id"];
                            $payment_listing_log["listing_title"]  = $listingObj->getString("title", false);
                            $payment_listing_log["discount_id"]    = $listingObj->getString("discount_id");
                            $payment_listing_log["level"]          = $listingObj->getString("level");
                            $payment_listing_log["level_label"]    = $levelObj->showLevel($listingObj->getString("level"));
                            $payment_listing_log["renewal_date"]   = $listingObj->getString("renewal_date");
                            $payment_listing_log["categories"]     = ($category_amount) ? $category_amount : 0;
                            $payment_listing_log["amount"]         = $each_listing["amount"];

                            $payment_listing_log["extra_categories"] = 0;
                            if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
                                $payment_listing_log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
                            } else {
                                $payment_listing_log["extra_categories"] = 0;
                            }

                            $payment_listing_log["listingtemplate_title"] = "";
                            if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                                if ($listingObj->getString("listingtemplate_id")) {
                                    $listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"), $domain_id);
                                    $payment_listing_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
                                }
                            }

                            $paymentListingLogObj = new PaymentListingLog($payment_listing_log, $domain_id);
                            $paymentListingLogObj->Save();
                        }
                        unset($listingObj);
                    }

                    if ($eventArray) {

                        $levelObj = new EventLevel(false, $domain_id);
                        foreach ($eventArray as $each_event) {

                            $eventObj = new Event($each_event["id"], $domain_id);

                            $payment_event_log["payment_log_id"] = $paymentLogObj->getString("id");
                            $payment_event_log["event_id"]       = $each_event["id"];
                            $payment_event_log["event_title"]    = $eventObj->getString("title",false);
                            $payment_event_log["level"]          = $eventObj->getString("level");
                            $payment_event_log["level_label"]    = $levelObj->showLevel($eventObj->getString("level"));
                            $payment_event_log["renewal_date"]   = $eventObj->getString("renewal_date");
                            $payment_event_log["discount_id"]    = $eventObj->getString("discount_id");
                            $payment_event_log["amount"]         = $each_event["amount"];

                            $paymentEventLogObj = new PaymentEventLog($payment_event_log, $domain_id);
                            $paymentEventLogObj->Save();

                        }

                        unset($eventObj);
                    }

                    if ($bannerArray) {

                        $levelObj = new BannerLevel(false, $domain_id);
                        foreach ($bannerArray as $each_banner) {

                            $bannerObj = new Banner($each_banner["id"], $domain_id);

                            $payment_banner_log["payment_log_id"] = $paymentLogObj->getString("id");
                            $payment_banner_log["banner_id"]      = $each_banner["id"];
                            $payment_banner_log["banner_caption"] = $bannerObj->getString("caption",false);
                            $payment_banner_log["level"]          = $bannerObj->getString("type");
                            $payment_banner_log["level_label"]    = $levelObj->showLevel($bannerObj->getString("type"));
                            $payment_banner_log["renewal_date"]   = $bannerObj->getString("renewal_date");
                            $payment_banner_log["discount_id"]    = $bannerObj->getString("discount_id");
                            $payment_banner_log["impressions"]    = $bannerObj->getNumber("unpaid_impressions");
                            $payment_banner_log["amount"]         = $each_banner["amount"];

                            $paymentBannerLogObj = new PaymentBannerLog($payment_banner_log, $domain_id);
                            $paymentBannerLogObj->Save();
                        }
                        unset($bannerObj);

                    }

                    if ($classifiedArray) {

                        $levelObj = new ClassifiedLevel(false, $domain_id);
                        foreach ($classifiedArray as $each_classified) {

                            $classifiedObj = new Classified($each_classified["id"], $domain_id);

                            $payment_classified_log["payment_log_id"]   = $paymentLogObj->getString("id");
                            $payment_classified_log["classified_id"]    = $each_classified["id"];
                            $payment_classified_log["classified_title"] = $classifiedObj->getString("title",false);
                            $payment_classified_log["level"]            = $classifiedObj->getString("level");
                            $payment_classified_log["level_label"]      = $levelObj->showLevel($classifiedObj->getString("level"));
                            $payment_classified_log["renewal_date"]     = $classifiedObj->getString("renewal_date");
                            $payment_classified_log["discount_id"]      = $classifiedObj->getString("discount_id");
                            $payment_classified_log["amount"]           = $each_classified["amount"];

                            $paymentClassifiedLogObj = new PaymentClassifiedLog($payment_classified_log, $domain_id);
                            $paymentClassifiedLogObj->Save();

                        }
                        unset($classifiedObj);
                    }

                    if ($articleArray) {

                        $levelObj = new ArticleLevel(false, $domain_id);
                        foreach ($articleArray as $each_article) {

                            $articleObj = new Article($each_article["id"], $domain_id);

                            $payment_article_log["payment_log_id"] = $paymentLogObj->getString("id");
                            $payment_article_log["article_id"]     = $each_article["id"];
                            $payment_article_log["article_title"]  = $articleObj->getString("title",false);
                            $payment_article_log["level"]          = $articleObj->getString("level");
                            $payment_article_log["level_label"]    = $levelObj->showLevel($articleObj->getString("level"));
                            $payment_article_log["renewal_date"]   = $articleObj->getString("renewal_date");
                            $payment_article_log["discount_id"]    = $articleObj->getString("discount_id");
                            $payment_article_log["amount"]         = $each_article["amount"];

                            $paymentArticleLogObj = new PaymentArticleLog($payment_article_log, $domain_id);
                            $paymentArticleLogObj->Save();

                        }
                        unset($articleObj);
                    }

                    if ($customInvoiceArray) {

                        foreach ($customInvoiceArray as $each_custominvoice) {

                            $customInvoiceObj = new CustomInvoice($each_custominvoice["id"], $domain_id);

                            $payment_custominvoice_log["payment_log_id"]    = $paymentLogObj->getString("id");
                            $payment_custominvoice_log["custom_invoice_id"] = $each_custominvoice["id"];
                            $payment_custominvoice_log["title"]             = $customInvoiceObj->getString("title");
                            $payment_custominvoice_log["date"]              = $customInvoiceObj->getString("date");
                            $payment_custominvoice_log["items"]             = $customInvoiceObj->getTextItems();
                            $payment_custominvoice_log["items_price"]       = $customInvoiceObj->getTextPrices();
                            $payment_custominvoice_log["amount"]            = $customInvoiceObj->getNumber("subtotal");

                            $paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($payment_custominvoice_log, $domain_id);
                            $paymentCustomInvoiceLogObj->Save();

                        }
                        unset($customInvoiceObj);
                    }

                    if ($package_id) {

                        /////////////////////////////
                        $packageObj = new Package($package_id);
                        $array_package_offers = $packageObj->getPackagesByDomainID();

                        $auxitem_name = $array_package_offers[0]["items"][0]["module"];
                        $auxpackage_name = $packageObj->getString("title");
                        if ($auxitem_name) {
                            switch($auxitem_name) {
                                case 'listing':         $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
                                                        $level = new ListingLevel(false, $domain_id);
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                                case 'banner':          $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
                                                        $level = new BannerLevel(false, $domain_id);
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                                case 'event':           $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
                                                        $level = new EventLevel(false, $domain_id);
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                                case 'classified':      $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
                                                        $level = new ClassifiedLevel(false, $domain_id);
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                                case 'article':         $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
                                                        $level = new ArticleLevel(false, $domain_id);
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                                case 'custom_package':  $item_name = ucfirst(LANG_GIFT);
                                                        break;

                            }

                            $auxdomains_names = "";
                            $aux_package_item_price = "";
                            foreach ($array_package_offers as $package_offer) {
                                foreach ($package_offer['items'] as $package_offer_item) {
                                    if ($package_offer_item['domain_id']>0) {
                                        $aux_domain_obj = new Domain($package_offer_item['domain_id']);
                                        $auxdomains_names .= "&nbsp;&nbsp;&nbsp;-".$aux_domain_obj->getString('name')."<br />";
                                        $auxlevel_names .= $item_levelName."<br />";
                                    }

                                    if ($package_offer_item['price']==0) {
                                        $aux_package_item_price .= CURRENCY_SYMBOL." ".system_showText(LANG_FREE)."<br />";
                                    } else {
                                        $aux_package_item_price .= CURRENCY_SYMBOL." ".$package_offer_item['price']."<br />";
                                        $aux_package_total += $package_offer_item['price'];
                                    }
                                }

                                $auxdomains_names = string_substr($auxdomains_names, 0, -4);
                                $auxlevel_names = string_substr($auxlevel_names, 0, -4);
                                $aux_package_item_price = string_substr($aux_package_item_price, 0, -4);
                            }

                            $transaction_package_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
                            $transaction_package_log["package_id"]		  = $package_id;
                            $transaction_package_log["package_title"]     = $packageObj->getString("title");
                            $transaction_package_log["items"]             = $item_name." ".$item_levelName."\n".str_replace("-","",$auxdomains_names);
                            $transaction_package_log["items_price"]       = str_replace(CURRENCY_SYMBOL." ", "",str_replace("<br />","\n",$aux_package_item_price));
                            $transaction_package_log["amount"]            = payment_calculateTax(str_replace(",","",$aux_package_total), $payment_tax_value, false);

                            $paymentPacakgeObj = new PaymentPackageLog($transaction_package_log, $domain_id);
                            $paymentPacakgeObj->Save();

                            unset($packageObj);
                        }
                    }
                }

                if ($itemArray && string_strtolower($transactionLog["transaction_status"]) == "paid") {
                    LogPagSeguro::debug("Transaction paid, let's activate the items."); 
                    $dbMain = db_getDBObject(DEFAULT_DB, true);
                    $db = db_getDBObjectByDomainID($domain_id, $dbMain);
                    $sql = "SELECT id FROM Payment_Log WHERE transaction_id = '".$transactionLog["transaction_id"]."' AND system_type = 'pagseguro'";
                    $r = $db->query($sql);
                    $row = mysql_fetch_assoc($r);
                    $paymentLogID = $row["id"];
                    unset($sql, $r, $row);

                    if ($listingArray) {

                        $listingStatus = new ItemStatus();

                        foreach ($listingArray as $each_listing){

                            $listingObj = new Listing($each_listing["id"], $domain_id);

                            $sql = "UPDATE Payment_Listing_Log SET renewal_date = '".$listingObj->getNextRenewalDate("1", $each_listing["renewal"])."' WHERE payment_log_id = '".$paymentLogID."' AND listing_id = '".$listingObj->getString("id")."'";
                            $r = $db->query($sql);

                            $listingObj->setString("renewal_date", $listingObj->getNextRenewalDate("1", $each_listing["renewal"]));

                            setting_get("listing_approve_paid", $listing_approve_paid);

                            if ($listing_approve_paid){
                                $listingObj->setString("status", $listingStatus->getDefaultStatus());
                            }else{
                                $listingObj->setString("status", "A");
                            }

                            $listingObj->save();

                            unset($listingObj);

                        }

                    }

                    if ($eventArray) {

                        $eventStatus = new ItemStatus();

                        foreach ($eventArray as $each_event){

                            $eventObj = new Event($each_event["id"], $domain_id);

                            $sql ="UPDATE Payment_Event_Log SET renewal_date = '".$eventObj->getNextRenewalDate("1", $each_event["renewal"])."' WHERE payment_log_id = '".$paymentLogID."' AND event_id = '".$eventObj->getString("id")."'";
                            $r = $db->query($sql);

                            $eventObj->setString("renewal_date", $eventObj->getNextRenewalDate("1", $each_event["renewal"]));

                            setting_get("event_approve_paid", $event_approve_paid);

                            if ($event_approve_paid){
                                $eventObj->setString("status", $eventStatus->getDefaultStatus());
                            }else{
                                $eventObj->setString("status", "A");
                            }

                            $eventObj->save();

                            unset($eventObj);

                        }

                    }

                    if ($bannerArray) {

                        $bannerStatus = new ItemStatus();

                        foreach ($bannerArray as $each_banner){

                            $bannerObj = new Banner($each_banner["id"], $domain_id);

                            if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

                                setting_get("banner_approve_paid", $banner_approve_paid);

                                if ($banner_approve_paid){
                                    $sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
                                }else{
                                    $sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = ".$bannerObj->getNumber("id");
                                }

                                $result = $db->query($sql);

                                $id = $bannerObj->getNumber("id");
                                $unpaid_impressions[$id] = $bannerObj->getNumber("unpaid_impressions");


                            } elseif ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

                                $sql = "UPDATE Payment_Banner_Log SET renewal_date = '".$bannerObj->getNextRenewalDate("1", $each_banner["renewal"])."' WHERE payment_log_id = '".$paymentLogID."' AND banner_id = '".$bannerObj->getString("id")."'";
                                $r = $db->query($sql);

                                $bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate("1", $each_banner["renewal"]));

                                setting_get("banner_approve_paid", $banner_approve_paid);

                                if ($banner_approve_paid){
                                    $bannerObj->setString("status", $bannerStatus->getDefaultStatus());
                                }else{
                                    $bannerObj->setString("status", "A");
                                }

                                $bannerObj->Save();

                            }

                            unset($bannerObj);

                        }

                    }

                    if ($classifiedArray) {

                        $classifiedStatus = new ItemStatus();

                        foreach ($classifiedArray as $each_classified){

                            $classifiedObj = new Classified($each_classified["id"], $domain_id);

                            $sql = "UPDATE Payment_Classified_Log SET renewal_date = '".$classifiedObj->getNextRenewalDate("1", $each_classified["renewal"])."' WHERE payment_log_id = '".$paymentLogID."' AND classified_id = '".$classifiedObj->getString("id")."'";
                            $r = $db->query($sql);

                            $classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate("1", $each_classified["renewal"]));

                            setting_get("classified_approve_paid", $classified_approve_paid);

                            if ($classified_approve_paid){
                                $classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
                            }else{
                                $classifiedObj->setString("status", "A");
                            }

                            $classifiedObj->save();

                            unset($classifiedObj);

                        }

                    }

                    if ($articleArray) {

                        $articleStatus = new ItemStatus();

                        foreach ($articleArray as $each_article){

                            $articleObj = new Article($each_article["id"], $domain_id);

                            $sql = "UPDATE Payment_Article_Log SET renewal_date = '".$articleObj->getNextRenewalDate("1", $each_article["renewal"])."' WHERE payment_log_id = '".$paymentLogID."' AND article_id = '".$articleObj->getString("id")."'";
                            $r = $db->query($sql);

                            $articleObj->setString("renewal_date", $articleObj->getNextRenewalDate("1", $each_article["renewal"]));

                            setting_get("article_approve_paid", $article_approve_paid);

                            if ($article_approve_paid){
                                $articleObj->setString("status", $articleStatus->getDefaultStatus());
                            }else{
                                $articleObj->setString("status", "A");
                            }

                            $articleObj->save();

                            unset($articleObj);

                        }

                    }

                    if ($customInvoiceArray) {

                        foreach ($customInvoiceArray as $each_custominvoice){

                            $customInvoiceObj = new CustomInvoice($each_custominvoice["id"], $domain_id);
                            $cInvoiceAmount = payment_calculateTax($customInvoiceObj->getNumber("amount"), $transactionLog["transaction_tax"]);
                            $customInvoiceObj->setString("paid", "y");
                            $customInvoiceObj->setNumber("tax", $transactionLog["transaction_tax"]);
                            $customInvoiceObj->setNumber("subtotal", $customInvoiceObj->getNumber("amount"));
                            $customInvoiceObj->setNumber("amount", $cInvoiceAmount);
                            $customInvoiceObj->save();

                            unset($customInvoiceObj);

                        }

                    }

                    if ($package_id) {

                        $sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".$domain_id." AND package_id = ".$package_id." AND account_id = ".$acc_id;
                        $dbMain = db_getDBObject(DEFAULT_DB, true);
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

                                $itemObj = new $className($item_id, $domain_id);

                                $itemStatus = new ItemStatus();

                                setting_get($item["module"]."_approve_paid", $item_approve_paid);

                                if ($item_approve_paid) {
                                    $stritemStatus = $itemStatus->getDefaultStatus();
                                } else {
                                    $stritemStatus = "A";
                                }

                                $sql = "UPDATE $className SET status = ".db_formatString($stritemStatus).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate("1", $package_renewal))." WHERE id = ".$item_id;
                                $dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
                                $dbItem->query($sql);
                            }
                        }
                    }

                    $paymentLogObj = new PaymentLog($paymentLogID, $domain_id);
                    $paymentLogObj->sendNotification($domain_id, $package_id);
                } else {
                    LogPagSeguro::debug("No item found or transaction not paid yet.");
                }
            }
        } else {
            LogPagSeguro::debug("Transaction not found.");
        }
    }

?>