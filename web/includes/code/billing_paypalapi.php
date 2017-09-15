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
	# * FILE: /includes/code/billing_paypalapi.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_paypalapi.inc.php");
	
	extract($_POST);
	extract($_GET);

	if ($pay) {

		$verification = "y";

		if (!is_array($listing_id) && !is_array($event_id) && !is_array($banner_id) && !is_array($classified_id) && !is_array($article_id) && !is_array($custominvoice_id)) {

			$verification = "n";
			
			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		} elseif (!$creditCardType || !$creditCardNumber || !$expdate_month || !$expdate_year || !$cvv2Number || !$firstName || !$lastName || !$address1 || !$city || !$state || !$zip) {

			$verification = "n";
			
			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $payment_message .= system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		} elseif ($cvv2Number && (!is_numeric($cvv2Number) || ((string_strlen($cvv2Number) != 3) && (string_strlen($cvv2Number) != 4)))) {

			$verification = "n";
			
			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $payment_message .= system_showText(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER)."<br />\n<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		} elseif ((string_strlen($cvv2Number) == 4) && ($creditCardType != "Amex")) {

			$verification = "n";
			
			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $payment_message .= system_showText(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		} elseif ((string_strlen($cvv2Number) == 3) && ($creditCardType == "Amex")) {

			$verification = "n";
			
			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $payment_message .= system_showText(LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH)."<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		}

	}

	if ($pay && $verification == "y") {

		$paymentType      = urlencode($_POST["paymentType"]);
		$firstName        = urlencode($_POST["firstName"]);
		$lastName         = urlencode($_POST["lastName"]);
		$creditCardType   = urlencode($_POST["creditCardType"]);
		$creditCardNumber = urlencode($_POST["creditCardNumber"]);
		$expDateMonth     = urlencode($_POST["expdate_month"]);
		$padDateMonth     = str_pad($expDateMonth, 2, "0", STR_PAD_LEFT);
		$expDateYear      = urlencode($_POST["expdate_year"]);
		$cvv2Number       = urlencode($_POST["cvv2Number"]);
		$address1         = urlencode($_POST["address1"]);
		$city             = urlencode($_POST["city"]);
		$state            = urlencode($_POST["state"]);
		$country          = urlencode($_POST["country"]);
		$zip              = urlencode($_POST["zip"]);
		$amount           = urlencode($_POST["amount"]);
		$currencyCode     = urlencode($_POST["currency"]);

		$nvpstr  = "";
		$nvpstr .= "&";
		$nvpstr .= "PAYMENTACTION=$paymentType";
		$nvpstr .= "&";
		$nvpstr .= "AMT=$amount";
		$nvpstr .= "&";
		$nvpstr .= "CREDITCARDTYPE=$creditCardType";
		$nvpstr .= "&";
		$nvpstr .= "ACCT=$creditCardNumber";
		$nvpstr .= "&";
		$nvpstr .= "EXPDATE=".$padDateMonth.$expDateYear."";
		$nvpstr .= "&";
		$nvpstr .= "CVV2=$cvv2Number";
		$nvpstr .= "&";
		$nvpstr .= "FIRSTNAME=$firstName";
		$nvpstr .= "&";
		$nvpstr .= "LASTNAME=$lastName";
		$nvpstr .= "&";
		$nvpstr .= "STREET=$address1";
		$nvpstr .= "&";
		$nvpstr .= "CITY=$city";
		$nvpstr .= "&";
		$nvpstr .= "STATE=$state";
		$nvpstr .= "&";
		$nvpstr .= "ZIP=$zip";
		$nvpstr .= "&";
		$nvpstr .= "COUNTRYCODE=$country";
		$nvpstr .= "&";
		$nvpstr .= "CURRENCYCODE=$currencyCode";

		include(EDIRECTORY_ROOT."/".MEMBERS_ALIAS."/billing/CallerService.php");

		$resArray = hash_call("doDirectPayment", $nvpstr);

		if (!$resArray["CURL_ERROR"]) {

			$ack = string_strtoupper($resArray["ACK"]);

			if ($ack != "SUCCESS") {
			
				$payment_message .= "<p class=\"errorMessage\">\n";

				$payment_message .= system_showText(LANG_MSG_TRANSACTION_NOT_COMPLETED)."<br />\n<br />\n";
				$payment_message .= "Ack: ".$resArray["ACK"]."<br />\n";
				$payment_message .= "Correlation ID: ".$resArray["CORRELATIONID"]."<br />\n";
				$payment_message .= "Version: ".$resArray["API_VERSION"]."<br />\n";

				$count = 0;
				while (isset($resArray["L_SHORTMESSAGE".$count])) {

					$errorCode    = $resArray["L_ERRORCODE".$count];
					$shortMessage = $resArray["L_SHORTMESSAGE".$count];
					$longMessage  = $resArray["L_LONGMESSAGE".$count];
					$count        = $count+1;

					$payment_message .= system_showText(LANG_MSG_ERROR_NUMBER)." ".$errorCode."<br />\n";
					$payment_message .= system_showText(LANG_MSG_SHORT_MESSAGE)." ".$shortMessage."<br />\n";
					$payment_message .= system_showText(LANG_MSG_LONG_MESSAGE)." ".$longMessage."<br />\n";

				}

				if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

			} else {

				$payment_success = "y";
				
				$payment_message .= "<p class=\"successMessage\">\n";

				$payment_message .= system_showText(LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY)."<br />\n<br />\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_ID).": ".$resArray["TRANSACTIONID"]."<br />\n";
				$payment_message .= system_showText(LANG_LABEL_AMOUNT).": ".$currencyCode." ".$resArray["AMT"]."<br />\n";
				$payment_message .= "AVS: ".$resArray["AVSCODE"]."<br />\n";
				$payment_message .= "CVV2: ".$resArray["CVV2MATCH"]."<br />\n";
				if ($process == "claim") $payment_message .= "<br />\n".system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY)."<br />\n";
				else $payment_message .= "<br />\n".system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a><br />\n";

				$log_paypalapi["payment_status"] = $resArray["ACK"];
				$log_paypalapi["txn_id"]         = $resArray["TRANSACTIONID"];
				$log_paypalapi["mc_gross"]       = $resArray["AMT"];
				$log_paypalapi["mc_currency"]    = $currencyCode;
				$log_paypalapi["avs"]            = $resArray["AVSCODE"];
				$log_paypalapi["cvv2"]           = $resArray["CVV2MATCH"];
				$log_paypalapi["txn_type"]       = $paymentType;
				$log_paypalapi["first_name"]     = $firstName;
				$log_paypalapi["last_name"]      = $lastName;
				$log_paypalapi["address"]        = $address1;
				$log_paypalapi["city"]           = $city;
				$log_paypalapi["state"]          = $state;
				$log_paypalapi["zip"]            = $zip;

				$accountObj                  = new Account($acctId);
				$log["account_id"]           = $acctId;
				$log["username"]             = $accountObj->getString("username");
				$log["ip"]                   = $_SERVER["REMOTE_ADDR"];
				$log["transaction_id"]       = $resArray["TRANSACTIONID"];
				$log["transaction_status"]   = $resArray["ACK"];
				$log["transaction_datetime"] = date("Y-m-d H:i:s");
				$log["transaction_tax"]		 = $_POST["paypalapi_tax"];
				$log["transaction_subtotal"] = $_POST["paypalapi_subtotal"];
				$log["transaction_amount"]   = $resArray["AMT"];
				$log["transaction_currency"] = $currencyCode;
				$log["system_type"]          = "paypalapi";
				$log["recurring"]            = "n";
				$log["notes"]                = "";
				$package_id					 = $_POST["paypalapi_package_id"];

				$log["return_fields"] = system_array2nvp($log_paypalapi, " || ");
				$paymentLogObj = new PaymentLog($log);
				$paymentLogObj->Save();

				if (!empty($listing_id[0])) {

					$listingStatus = new ItemStatus();

					$priceAux = 0;
					$levelObj = new ListingLevel();
					foreach($listing_id as $each_listing_id){

                        $renewal_cycle = ($_SESSION["order_renewal_period_listing_{$each_listing_id}"] ? $_SESSION["order_renewal_period_listing_{$each_listing_id}"] : $_SESSION["order_renewal_period"]);
                        $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

						$dbObjCat = db_getDBObject();
						$listingObj = new Listing($each_listing_id);
						$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate("1", $renewal_cycle));
								
						setting_get("listing_approve_paid", $listing_approve_paid);
									
						if ($listing_approve_paid){
							$listingObj->setString("status", $listingStatus->getDefaultStatus());
						}else{
							$listingObj->setString("status", "A");
						}
																		
						$listingObj->Save();

						$category_amount = 0;
						$sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$listingObj->getString("id")."";
						$result = $dbObjCat->query($sql);
						if(mysql_num_rows($result)){
							while($row = mysql_fetch_assoc($result)){
								$category_amount++;
							}
						}

						$log_listing["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_listing["listing_id"]     = $listingObj->getString("id");
						$log_listing["listing_title"]  = $listingObj->getString("title", false);
                        $log_listing["level"]          = $listingObj->getString("level");
						$log_listing["level_label"]    = $levelObj->showLevel($listingObj->getString("level"));
						$log_listing["renewal_date"]   = $listingObj->getString("renewal_date");
						$log_listing["discount_id"]    = $listingObj->getString("discount_id");
						$log_listing["categories"]     = ($category_amount) ? $category_amount : 0;
						$log_listing["amount"]         = str_replace(",","",$listing_price[$priceAux]);
						$priceAux++;

						$log_listing["extra_categories"] = 0;
						if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
							$log_listing["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
						} else {
							$log_listing["extra_categories"] = 0;
						}

						$log_listing["listingtemplate_title"] = "";
						if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
							if ($listingObj->getString("listingtemplate_id")) {
								$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
								$log_listing["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
							}
						}

						$paymentListingLogObj = new PaymentListingLog($log_listing);
						$paymentListingLogObj->Save();

					}

					unset($listingObj);

				}

				if (!empty($event_id[0])) {

					$eventStatus = new ItemStatus();

					$priceAux = 0;
					foreach($event_id as $each_event_id){

                        $renewal_cycle = ($_SESSION["order_renewal_period_event_{$each_event_id}"] ? $_SESSION["order_renewal_period_event_{$each_event_id}"] : $_SESSION["order_renewal_period"]);
                        $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

						$eventObj = new Event($each_event_id);
                        $levelObj = new EventLevel();
                        
						$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate("1", $renewal_cycle));
						
						setting_get("event_approve_paid", $event_approve_paid);
									
						if ($event_approve_paid){
							$eventObj->setString("status", $eventStatus->getDefaultStatus());
						}else{
							$eventObj->setString("status", "A");
						}
						
						$eventObj->Save();

						$log_event["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_event["event_id"]       = $eventObj->getString("id");
						$log_event["event_title"]    = $eventObj->getString("title",false);
                        $log_event["level"]          = $eventObj->getString("level");
						$log_event["level_label"]    = $levelObj->showLevel($eventObj->getString("level"));
						$log_event["renewal_date"]   = $eventObj->getString("renewal_date");
						$log_event["discount_id"]    = $eventObj->getString("discount_id");
						$log_event["amount"]         = str_replace(",","",$event_price[$priceAux]);
						$priceAux++;

						$paymentEventLogObj = new PaymentEventLog($log_event);
						$paymentEventLogObj->Save();

					}

					unset($eventObj);

				}

				if (!empty($banner_id[0])) {

					$bannerStatus = new ItemStatus();

					$priceAux = 0;
					foreach($banner_id as $each_banner_id){

						$bannerObj = new Banner($each_banner_id);
                        $levelObj = new BannerLevel();

						if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

							$dbObj = db_getDBObject();

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

                            $renewal_cycle = ($_SESSION["order_renewal_period_banner_{$each_banner_id}"] ? $_SESSION["order_renewal_period_banner_{$each_banner_id}"] : $_SESSION["order_renewal_period"]);
                            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

							$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate("1", $renewal_cycle));
														
							setting_get("banner_approve_paid", $banner_approve_paid);
									
							if ($banner_approve_paid){
								$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
							}else{
								$bannerObj->setString("status", "A");
							}
							
							$bannerObj->Save();

						}

						$log_banner["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_banner["banner_id"]      = $bannerObj->getString("id");
						$log_banner["banner_caption"] = $bannerObj->getString("caption",false);
                        $log_banner["level"]          = $bannerObj->getString("type");
						$log_banner["level_label"]    = $levelObj->showLevel($bannerObj->getString("type"));
						$log_banner["renewal_date"]   = $bannerObj->getString("renewal_date");
						$log_banner["discount_id"]    = $bannerObj->getString("discount_id");
						$log_banner["impressions"]    = ($unpaid_impressions[$each_banner_id]) ? $unpaid_impressions[$each_banner_id] : 0;
						$log_banner["amount"]         = str_replace(",","",$banner_price[$priceAux]);
						$priceAux++;

						$paymentBannerLogObj = new PaymentBannerLog($log_banner);
						$paymentBannerLogObj->Save();

					}

					unset($bannerObj);

				}

				if (!empty($classified_id[0])) {

					$classifiedStatus = new ItemStatus();

					$priceAux = 0;
					foreach($classified_id as $each_classified_id){

						$classifiedObj = new Classified($each_classified_id);
                        $levelObj = new ClassifiedLevel();

                        $renewal_cycle = ($_SESSION["order_renewal_period_classified_{$each_classified_id}"] ? $_SESSION["order_renewal_period_classified_{$each_classified_id}"] : $_SESSION["order_renewal_period"]);
                        $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));
                        
						$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate("1", $renewal_cycle));
						
						setting_get("classified_approve_paid", $classified_approve_paid);
									
						if ($classified_approve_paid){
							$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
						}else{
							$classifiedObj->setString("status", "A");
						}
						
						$classifiedObj->save();

						$log_classified["payment_log_id"]   = $paymentLogObj->getNumber("id");
						$log_classified["classified_id"]    = $classifiedObj->getString("id");
						$log_classified["classified_title"] = $classifiedObj->getString("title",false);
                        $log_classified["level"]            = $classifiedObj->getString("level");
						$log_classified["level_label"]      = $levelObj->showLevel($classifiedObj->getString("level"));
						$log_classified["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$log_classified["discount_id"]      = $classifiedObj->getString("discount_id");
						$log_classified["amount"]           = str_replace(",","",$classified_price[$priceAux]);
						$priceAux++;

						$paymentClassifiedLogObj = new PaymentClassifiedLog($log_classified);
						$paymentClassifiedLogObj->Save();

					}

					unset($classifiedObj);

				}

				if (!empty($article_id[0])) {

					$articleStatus = new ItemStatus();

					$priceAux = 0;
					foreach($article_id as $each_article_id){

                        $renewal_cycle = ($_SESSION["order_renewal_period_article_{$each_article_id}"] ? $_SESSION["order_renewal_period_article_{$each_article_id}"] : $_SESSION["order_renewal_period"]);
                        $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

						$articleObj = new Article($each_article_id);
                        $levelObj = new ArticleLevel();
                        
						$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate("1", $renewal_cycle));
								
						setting_get("article_approve_paid", $article_approve_paid);
									
						if ($article_approve_paid){
							$articleObj->setString("status", $articleStatus->getDefaultStatus());
						}else{
							$articleObj->setString("status", "A");
						}
						
						$articleObj->Save();

						$log_article["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_article["article_id"]     = $articleObj->getString("id");
						$log_article["article_title"]  = $articleObj->getString("title",false);
                        $log_article["level"]          = $articleObj->getString("level");
						$log_article["level_label"]    = $levelObj->showLevel($articleObj->getString("level"));
						$log_article["renewal_date"]   = $articleObj->getString("renewal_date");
						$log_article["discount_id"]    = $articleObj->getString("discount_id");
						$log_article["amount"]         = str_replace(",","",$article_price[$priceAux]);
						$priceAux++;

						$paymentArticleLogObj = new PaymentArticleLog($log_article);
						$paymentArticleLogObj->Save();

					}

					unset($articleObj);

				}

				if (!empty($custominvoice_id[0])) {

					$priceAux = 0;
					foreach($custominvoice_id as $each_custominvoice_id){

						$customInvoiceObj = new CustomInvoice($each_custominvoice_id);
						if ($paymentLogObj->getNumber("transaction_tax") > 0) {
							$cInvoiceAmount = payment_calculateTax($customInvoiceObj->getNumber("amount"), $paymentLogObj->getNumber("transaction_tax"));
						} else {
							$cInvoiceAmount = $customInvoiceObj->getNumber("amount");
						}
						$customInvoiceObj->setNumber("tax", $paymentLogObj->getNumber("transaction_tax"));
						$customInvoiceObj->setNumber("subtotal", $customInvoiceObj->getNumber("amount"));
						$customInvoiceObj->setNumber("amount", $cInvoiceAmount);
						$customInvoiceObj->setString("paid", "y");
						$customInvoiceObj->Save();

						$log_custominvoice["payment_log_id"]    = $paymentLogObj->getNumber("id");
						$log_custominvoice["custom_invoice_id"] = $customInvoiceObj->getString("id");
						$log_custominvoice["title"]             = $customInvoiceObj->getString("title");
						$log_custominvoice["date"]              = $customInvoiceObj->getString("date");
						$log_custominvoice["items"]             = $customInvoiceObj->getTextItems();
						$log_custominvoice["items_price"]       = $customInvoiceObj->getTextPrices();
						$log_custominvoice["amount"]            = $customInvoiceObj->getNumber("subtotal");
						$priceAux++;

						$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($log_custominvoice);
						$paymentCustomInvoiceLogObj->Save();

					}

					unset($customInvoiceObj);

				}

				if ($package_id) {

					//////////////////////////////

					$sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".SELECTED_DOMAIN_ID." AND package_id = ".$package_id." AND account_id = ".$acctId;
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

                            $renewal_cycle = $_SESSION["order_renewal_period"];
                            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

							$sql = "UPDATE $className SET status = ".db_formatString($stritemStatus).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate("1", $renewal_cycle))." WHERE id = ".$item_id;
							$dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
							$dbItem->query($sql);
						}
					}

					/////////////////////////////
					$packageObj = new Package($package_id);
					$array_package_offers = $packageObj->getPackagesByDomainID();

					$auxitem_name = $array_package_offers[0]["items"][0]["module"];
					$auxpackage_name = $packageObj->getString("title");
					if ($auxitem_name) {
						switch($auxitem_name) {
                            case 'listing':             $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
                                                        $level = new ListingLevel();
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                            case 'banner':              $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
                                                        $level = new BannerLevel();
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                            case 'event':               $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
                                                        $level = new EventLevel();
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                            case 'classified':          $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
                                                        $level = new ClassifiedLevel();
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

                                                        break;

                            case 'article':             $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
                                                        $level = new ArticleLevel();
                                                        $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

                                                        $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

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
					}

					//////////////////////////////

					$amountAux = 0;

					$packageObj = new Package($package_id);

					$transaction_package_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
					$transaction_package_log["package_id"]		  = $package_id;
					$transaction_package_log["package_title"]     = $packageObj->getString("title");
					$transaction_package_log["items"]             = $item_name." ".$item_levelName."\n".str_replace("-","",$auxdomains_names);
					$transaction_package_log["items_price"]       = str_replace(CURRENCY_SYMBOL." ", "",str_replace("<br />","\n",$aux_package_item_price));
					$transaction_package_log["amount"]            = payment_calculateTax(str_replace(",","",$aux_package_total), $payment_tax_value, false);
					$amountAux++;

					$paymentPacakgeObj = new PaymentPackageLog($transaction_package_log, $domain_id);
					$paymentPacakgeObj->Save();

					unset($packageObj);

				}

				$paymentLogObj->sendNotification();

			}

		} elseif ($resArray["CURL_ERROR"] == "Y") {
		
			$payment_message .= "<p class=\"errorMessage\">\n";

			$payment_message .= system_showText(LANG_MSG_TRANSACTION_NOT_COMPLETED)."<br />\n<br />\n";

			$errorCode    = $resArray["curl_error_no"];
			$errorMessage = $resArray["curl_error_msg"];

			$payment_message .= system_showText(LANG_MSG_ERROR_NUMBER)." ".$errorCode."<br />\n";
			$payment_message .= "Error Message: ".$errorMessage."<br />\n";

			if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=paypalapi&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $try_again_message = "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		}

		$payment_message .= $try_again_message."\n</p>";

	}