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
	# * FILE: /includes/code/billing_paypal.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_paypal.inc.php");

	if (string_strpos($_SERVER["PHP_SELF"], "receipt.php") === false) {

		extract($_POST);
		extract($_GET);

		if ($txn_id || $subscr_id || $receipt_id || $tx){

			$payment_success = "y";
			
			$payment_message .= "<p class=\"successMessage\">\n";

			if ($txn_id) {
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $payment_status <br />\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_ID).": $txn_id <br />\n";
			} elseif ($receipt_id) {
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $payment_status <br />\n";
				$payment_message .= system_showText(LANG_LABEL_RECEIPT_ID).": $receipt_id <br />\n";
			} elseif ($subscr_id) {
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_COMPLETED)." <br />\n";
				$payment_message .= system_showText(LANG_LABEL_SUBSCRIBE_ID).": $subscr_id <br />\n";
			} elseif ($tx) {
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $st <br />\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_ID).": $tx <br />\n";
			}

			if ($payment_status == "Completed") {
				if ($process == "claim") $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY)."\n";
				else $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_YOUR)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";
			} elseif ($payment_status == "Pending") {
				if ($process == "claim") $payment_message .= "<br />\n".system_showText(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED)."<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY)."\n";
				else $payment_message .= "<br />\n".system_showText(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED)."<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_YOUR)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";
			}

		} elseif ($auth) {

			$payment_success = "y";

			$payment_message .= "<p class=\"successMessage\">\n";

			if ($process == "claim") $payment_message .= system_showText(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED)."<br />\n".system_showText(LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED)."<br />\n(".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY).")<br />\n";
			else $payment_message .= system_showText(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED).($process != "signup" ? "<br />" : "")."\n".system_showText(LANG_LABEL_YOUR)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a> ".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED)."<br />\n(".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY).")\n";

		} elseif ($cancel == true) {
		
			$payment_message .= "<p class=\"errorMessage\">\n";

			$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_CANCELED)." <br />\n";
			if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypal\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypal&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		} else {
            
            $payment_message .= "<p class=\"successMessage\">\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_YOUR)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";
            
        }

		$payment_message .= $try_again_message."\n</p>";

	} else {

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value"; 
		}

		// post back to PayPal system to validate
		$header .= "POST ".PAYPAL_URL_FOLDER." HTTP/1.0\r\n";
        $header .= "Host: ".PAYPAL_URL."\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . string_strlen($req) . "\r\n\r\n"; 

		$fp = fsockopen ('ssl://'.PAYPAL_URL, 443, $errno, $errstr, 30);

		if (!$fp) {

			setting_get("sitemgr_email",$sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "IPN FAILURE", system_showText(LANG_MSG_CONNECTION_FAILURE)."\n".$_SERVER["SERVER_NAME"], $sitemgr_email);
			$eDirMailerObj->send();
			exit;

		} else {

			fputs ($fp, $header . $req);

			while (!feof($fp)) {

				$res = fgets ($fp, 1024);

				if (strcmp ($res, "VERIFIED") == 0) {

					$params = explode("&",urldecode($req));

					foreach($params as $each_param){
						$arr_aux_params = explode("=",$each_param);
						for($i=0; $i < count($arr_aux_params); $i++){
							if($i%2 == 0 || $i == 0){
								$filtered_params["{$arr_aux_params[$i]}"] = $arr_aux_params[$i+1];
							}
						}
					}

					foreach($filtered_params as $key => $value){

						if($key == "custom"){

							$arr_custom_param =  explode("::",$value);
							foreach($arr_custom_param as $each_custom_param){
								$arr_custom_param_values = explode(":",$each_custom_param);
								for($i=0; $i < count($arr_custom_param_values); $i++){
									if($i%2 == 0 || $i == 0){
										$transaction["{$arr_custom_param_values[$i]}"] = trim($arr_custom_param_values[$i+1]);
									}
								}
							}
							$domain_id = $transaction["domain_id"];
							$package_id = $transaction["package_id"];
							$renewal = $transaction["renewal"];
						} elseif($key == "payment_date" || $key == "subscr_date"){

							$t_date = strtotime($value);
							$date = date("Y-m-d H:i:s",$t_date);
							$transaction[$key] = trim($date);

						} else {

							$transaction[$key] = trim($value);

						}

					}

					$accountObj                             = new Account($transaction["account_id"]);
					$account_id								= $transaction["account_id"];
					$transactionLog["account_id"]           = $transaction["account_id"];
					$transactionLog["username"]             = $accountObj->getString("username");
					$transactionLog["ip"]                   = $transaction["ip"];
					$transactionLog["transaction_id"]       = $transaction["txn_id"];
					$transactionLog["transaction_status"]   = $transaction["payment_status"];
					$transactionLog["transaction_datetime"] = $transaction["payment_date"];
					$transSubTotal = $transaction["mc_gross"] - ($transaction["tax"] > 0? $transaction["tax"]: 0);
					if ($transaction["tax"] > 0) $transactionLog["transaction_tax"] = payment_taxToPercentage($transaction["tax"], $transSubTotal);
					else $transactionLog["transaction_tax"]	= 0;
					$transactionLog["transaction_subtotal"] = $transSubTotal;
					$transactionLog["transaction_amount"]   = $transaction["mc_gross"];
					$transactionLog["transaction_currency"] = $transaction["mc_currency"];
					$transactionLog["system_type"]          = "paypal";
					$transactionLog["recurring"]            = "n";
					$transactionLog["notes"]                = "";

					if ($transaction["txn_type"] == "subscr_payment") $transactionLog["recurring"] = "y";

				} else if (strcmp ($res, "INVALID") == 0) {

					// log for manual investigation
					setting_get("sitemgr_email",$sitemgr_email);
					if($transaction){
						foreach ($transaction as $key => $value){
							$email_content .= "$key => $value\n\n";
						}
					}
					$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "INVALID IPN", $res."\n".$email_content."\n".$_SERVER["SERVER_NAME"], $sitemgr_email);
					$eDirMailerObj->send();

				}

			}

			fclose ($fp);

		}

		// Sign up will not be loged. Just the payment itself.
		if ($transaction["txn_type"] != "subscr_payment" && $transaction["txn_type"] != "cart") unset($transaction);

		if ($transaction["num_cart_items"]){

			unset($itemArray);
			unset($listingArray);
			unset($eventArray);
			unset($bannerArray);
			unset($classifiedArray);
			unset($articleArray);
			unset($customInvoiceArray);

			for ($i=1; $i <= $transaction["num_cart_items"]; $i++) {

				unset($item);
				$item = $transaction["item_number$i"];

				unset($tempItem);
				$tempItem = explode(":", $item);
				$itemType = $tempItem[0];
				$itemID = $tempItem[1];
                $itemRenewal = $tempItem[2];

				unset($tempItem);
				$tempItem["id"] = $itemID;
				$tempItem["type"] = $itemType;
				$tempItem["renewal"] = $itemRenewal;

				$tempItem["amount"] = $transaction["mc_gross_$i"];

				$itemArray[] = $tempItem;
				if ($itemType == "listing") $listingArray[] = $tempItem;
				if ($itemType == "event") $eventArray[] = $tempItem;
				if ($itemType == "banner") $bannerArray[] = $tempItem;
				if ($itemType == "classified") $classifiedArray[] = $tempItem;
				if ($itemType == "article") $articleArray[] = $tempItem;
				if ($itemType == "custominvoice") $customInvoiceArray[] = $tempItem;

			}

		} else {

			unset($itemArray);
			unset($listingArray);
			unset($eventArray);
			unset($bannerArray);
			unset($classifiedArray);
			unset($articleArray);
			unset($customInvoiceArray);

			if ($transaction["option_name1"] == "itemsPaid") {

				$itemArrayAux = explode("|",$transaction["option_selection1"]);

				if ($itemArrayAux) foreach ($itemArrayAux as $item_aux) {

					unset($tempItem);
					$tempItem = explode(":", $item_aux);
					$itemType = $tempItem[0];
					$itemID = $tempItem[1];
                    $itemRenewal = $tempItem[2];

					unset($tempItem);
					$tempItem["id"] = $itemID;
                    $tempItem["renewal"] = $itemRenewal;
					if ($itemType == "l") $tempItem["type"] = "listing";
					if ($itemType == "e") $tempItem["type"] = "event";
					if ($itemType == "b") $tempItem["type"] = "banner";
					if ($itemType == "c") $tempItem["type"] = "classified";
					if ($itemType == "a") $tempItem["type"] = "article";
					if ($itemType == "i") $tempItem["type"] = "custominvoice";

					$itemArray[] = $tempItem;

					if ($tempItem["type"] == "listing") {
						unset($lObj);
						$lObj = new Listing($tempItem["id"], $domain_id);
						$tempItem["amount"] = format_money($lObj->getPrice($itemRenewal == "M" ? "monthly" : "yearly"));
						unset($lObj);
						$listingArray[] = $tempItem;
					}

					if ($tempItem["type"] == "event") {
						unset($eObj);
						$eObj = new Event($tempItem["id"], $domain_id);
						$tempItem["amount"] = format_money($eObj->getPrice($itemRenewal == "M" ? "monthly" : "yearly"));
						unset($eObj);
						$eventArray[] = $tempItem;
					}

					if ($tempItem["type"] == "banner") {
						unset($bObj);
						$bObj = new Banner($tempItem["id"], $domain_id);
						$tempItem["amount"] = format_money($bObj->getPrice($itemRenewal == "M" ? "monthly" : "yearly"));
						unset($bObj);
						$bannerArray[] = $tempItem;
					}

					if ($tempItem["type"] == "classified") {
						unset($cObj);
						$cObj = new Classified($tempItem["id"], $domain_id);
						$tempItem["amount"] = format_money($cObj->getPrice($itemRenewal == "M" ? "monthly" : "yearly"));
						unset($cObj);
						$classifiedArray[] = $tempItem;
					}

					if ($tempItem["type"] == "article") {
						unset($aObj);
						$aObj = new Article($tempItem["id"], $domain_id);
						$tempItem["amount"] = format_money($aObj->getPrice($itemRenewal == "M" ? "monthly" : "yearly"));
						unset($aObj);
						$articleArray[] = $tempItem;
					}

					if ($tempItem["type"] == "custominvoice") {
						unset($iObj);
						$iObj = new CustomInvoice($tempItem["id"], $domain_id);
						$tempItem["amount"] = format_money($iObj->getPrice());
						unset($iObj);
						$customInvoiceArray[] = $tempItem;
					}

				}

			}

		}

		if ($itemArray && $transaction) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID($domain_id, $dbMain);
			$sql = "SELECT id FROM Payment_Log WHERE transaction_id = '".$transaction["txn_id"]."' AND system_type = 'paypal'";
			$r = $db->query($sql);

			if (mysql_num_rows($r) > 0) {

				$row = mysql_fetch_assoc($r);
				$transactionLog["return_fields"] = system_array2nvp($transaction, " || ");
				$paymentLogObj = new PaymentLog($row["id"]);
				$paymentLogObj->MakeFromRow($transactionLog);
				$paymentLogObj->Save($domain_id);

			} else {

				$transactionLog["return_fields"] = system_array2nvp($transaction, " || ");
				$paymentLogObj = new PaymentLog($transactionLog);
				$paymentLogObj->Save($domain_id);

				if ($listingArray) {

					$levelObj = new ListingLevel(false, $domain_id);
					foreach ($listingArray as $each_listing) {

						$listingObj = new Listing($each_listing["id"], $domain_id);

						$dbMain = db_getDBObject(DEFAULT_DB, true);
						$dbObjCat = db_getDBObjectByDomainID($domain_id, $dbMain);

						$category_amount = 0;
						$sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$listingObj->getString("id")."";
						$result = $dbObjCat->query($sql);
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

				}

				if ($eventArray) {

					foreach ($eventArray as $each_event) {

						$eventObj = new Event($each_event["id"], $domain_id);
                        $levelObj = new EventLevel(false, $domain_id);

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

				}

				if ($bannerArray) {

					foreach ($bannerArray as $each_banner) {

						$bannerObj = new Banner($each_banner["id"],$domain_id);
                        $levelObj = new BannerLevel(false, $domain_id);

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

				}

				if ($classifiedArray) {

					foreach ($classifiedArray as $each_classified) {

						$classifiedObj = new Classified($each_classified["id"], $domain_id);
                        $levelObj = new ClassifiedLevel(false, $domain_id);

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

				}

				if ($articleArray) {

					foreach ($articleArray as $each_article) {

						$articleObj = new Article($each_article["id"], $domain_id);
                        $levelObj = new ArticleLevel(false, $domain_id);

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

				}

				if ($package_id) {

					$packageObj = new Package($package_id);
					$array_package_offers = $packageObj->getPackagesByDomainID();

					$auxitem_name = $array_package_offers[0]["items"][0]["module"];
					$auxpackage_name = $packageObj->getString("title");
					if ($auxitem_name) {
						switch($auxitem_name) {
                            case 'listing':         $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
                                                    $level = new ListingLevel();
                                                    $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                    $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                    break;

                            case 'banner':          $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
                                                    $level = new BannerLevel();
                                                    $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                    $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                    break;

                            case 'event':           $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
                                                    $level = new EventLevel();
                                                    $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                    $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                    break;

                            case 'classified':      $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
                                                    $level = new ClassifiedLevel();
                                                    $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                    $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

													break;

                            case 'article':         $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
                                                    $level = new ArticleLevel();
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

            if ($itemArray && string_strtolower($transaction["payment_status"]) == "completed") {

                $dbMain = db_getDBObject(DEFAULT_DB, true);
                $db = db_getDBObjectByDomainID($domain_id, $dbMain);
                $sql = "SELECT id FROM Payment_Log WHERE transaction_id = '".$transaction["txn_id"]."' AND system_type = 'paypal'";
                $r = $db->query($sql);
                $row = mysql_fetch_assoc($r);
                $paymentLogID = $row["id"];
                unset($db, $sql, $r, $row);

                if ($listingArray) {

                    $listingStatus = new ItemStatus();


                    foreach ($listingArray as $each_listing){

                        $listingObj = new Listing($each_listing["id"], $domain_id);

                        $dbMain = db_getDBObject(DEFAULT_DB, true);
                        $db = db_getDBObjectByDomainID($domain_id, $dbMain);
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

                        $dbMain = db_getDBObject(DEFAULT_DB, true);
                        $db = db_getDBObjectByDomainID($domain_id, $dbMain);
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

                            $dbMain = db_getDBObject(DEFAULT_DB, true);
                            $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);

                            setting_get("banner_approve_paid", $banner_approve_paid);

                            if ($banner_approve_paid){
                                $sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
                            }else{
                                $sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = ".$bannerObj->getNumber("id");
                            }

                            $result = $dbObj->query($sql);

                            $id = $bannerObj->getNumber("id");
                            $unpaid_impressions[$id] = $bannerObj->getNumber("unpaid_impressions");


                        } elseif ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

                            $dbMain = db_getDBObject(DEFAULT_DB, true);
                            $db = db_getDBObjectByDomainID($domain_id, $dbMain);
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

                        $dbMain = db_getDBObject(DEFAULT_DB, true);
                        $db = db_getDBObjectByDomainID($domain_id, $dbMain);
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

                        $dbMain = db_getDBObject(DEFAULT_DB, true);
                        $db = db_getDBObjectByDomainID($domain_id, $dbMain);
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

                    foreach ($customInvoiceArray as $each_custominvoice) {

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

                    $sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".$domain_id." AND package_id = ".$package_id." AND account_id = ".$account_id;
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

                            $itemObj = new $className($item_id);

                            $itemStatus = new ItemStatus();

                            setting_get($item["module"]."_approve_paid", $item_approve_paid);

                            if ($item_approve_paid) {
                                $stritemStatus = $itemStatus->getDefaultStatus();
                            } else {
                                $stritemStatus = "A";
                            }

                            $sql = "UPDATE $className SET status = ".db_formatString($stritemStatus).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate("1", $renewal))." WHERE id = ".$item_id;
                            $dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
                            $dbItem->query($sql);
                        }
                    }
                }

            }

            $paymentLogObj = new PaymentLog($paymentLogID, $domain_id);
            $paymentLogObj->sendNotification($domain_id, $package_id);

		}

	}

?>