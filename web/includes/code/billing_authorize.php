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
	# * FILE: /includes/code/billing_authorize.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_authorize.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUTHORIZE RECURRING FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	# Function to parse Authorize.net response
	# ----------------------------------------------------------------------------------------------------
	function parse_return($content) {
		$refId = substring_between($content, '<refId>', '</refId>');
		$resultCode = substring_between($content, '<resultCode>', '</resultCode>');
		$code = substring_between($content, '<code>', '</code>');
		$text = substring_between($content, '<text>', '</text>');
		$subscriptionId = substring_between($content, '<subscriptionId>', '</subscriptionId>');
		return array ($refId, $resultCode, $code, $text, $subscriptionId);
	}
	# ----------------------------------------------------------------------------------------------------
	# Helper function for parsing response
	# ----------------------------------------------------------------------------------------------------
	function substring_between($haystack, $start, $end) {
		if (string_strpos($haystack, $start) === false || string_strpos($haystack, $end) === false) {
			return false;
		} else {
			$start_position = string_strpos($haystack, $start) + string_strlen($start);
			$end_position = string_strpos($haystack, $end);
			return string_substr($haystack, $start_position, $end_position-$start_position);
		}
	}
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	if ($pay) {

		$validationok = "yes";

		$x_cc_exp_date = explode("/", $_POST["x_exp_date"]);
		$x_cc_month_exp_date = $x_cc_exp_date[0];
		$x_cc_year_exp_date = $x_cc_exp_date[1];

		// installments calculation
		$installments = 0;
		if (RECURRING_FEATURE == "on") {
			if ($x_cc_year_exp_date == date("y")) {
				$installments = $x_cc_month_exp_date - date("m");
			} else {
                $installments = (12 - date("m")) + (($x_cc_year_exp_date - date("y") - 1) * 12) + $x_cc_month_exp_date;
			}
		}
		
		if ($installments < 0) {
			$validationok = "no";
			if ($process == "signup") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=authorize\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			elseif ($process == "claim") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=authorize&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			else $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<br />\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		} else {
			$installments += 1; // increase one installment because the first is charged immediately.
			if ($installments > 36) $installments = 36;
			$renewal_increase = $installments;
		}

		if ($pay && $validationok == "yes") {

			// Configuration
			$x_login       = AUTHORIZE_LOGIN;
			$x_tran_key    = AUTHORIZE_TXNKEY;
			$x_customer_ip = $_SERVER["REMOTE_ADDR"];
			$x_description = "Item Renewal";
			$x_invoice_num = $_POST["x_invoice_num"];
			$x_cust_id     = $_POST["x_cust_id"];
			$x_card_num    = $_POST["x_card_num"];
			$x_exp_date    = $_POST["x_exp_date"];
			$x_card_code   = $_POST["x_card_code"];
			$x_first_name  = $_POST["x_first_name"];
			$x_last_name   = $_POST["x_last_name"];
			$x_company     = $_POST["x_company"];
			$x_address     = $_POST["x_address"];
			$x_city        = $_POST["x_city"];
			$x_state       = $_POST["x_state"];
			$x_zip         = $_POST["x_zip"];
			$x_country     = $_POST["x_country"];
			$x_phone       = $_POST["x_phone"];
			$x_email       = $_POST["x_email"];
			$x_amount      = $_POST["x_amount"];
			$x_domain_id   = $_POST["x_domain_id"];
			$domain_id = $x_domain_id;
			$x_package_id  = $_POST["x_package_id"];

			if (RECURRING_FEATURE == "on") {
				$x_start_date        = date("Y-m-d");
				$x_expiration_date   = date("Y-m", mktime(0, 0, 0, $x_cc_month_exp_date, 1, $x_cc_year_exp_date));
				$x_total_occurrences = $installments;
                $renewal_cycle = ($_SESSION["order_renewal_period_authorize"] ? $_SESSION["order_renewal_period_authorize"] : $_SESSION["order_renewal_period"]);
				$x_length            = ($renewal_cycle == "monthly" ? 1 : 12);
				$x_unit              = "months";
			} else {
				$x_email_customer   = "TRUE";
				$x_delim_data       = "TRUE";
				$x_delim_char       = "||";
				$x_encap_char       = "";
				$x_type             = "AUTH_CAPTURE";
				$x_test_request     = "FALSE";
				$x_relay_response   = "FALSE";
				$x_duplicate_window = "120";
				$x_method           = "CC";
			}

			$x_listing_ids           = $_POST["x_listing_ids"];
			$x_listing_amounts       = $_POST["x_listing_amounts"];
			$x_event_ids             = $_POST["x_event_ids"];
			$x_event_amounts         = $_POST["x_event_amounts"];
			$x_banner_ids            = $_POST["x_banner_ids"];
			$x_banner_amounts        = $_POST["x_banner_amounts"];
			$x_classified_ids        = $_POST["x_classified_ids"];
			$x_classified_amounts    = $_POST["x_classified_amounts"];
			$x_article_ids           = $_POST["x_article_ids"];
			$x_article_amounts       = $_POST["x_article_amounts"];
			$x_custominvoice_ids     = $_POST["x_custominvoice_ids"];
			$x_custominvoice_amounts = $_POST["x_custominvoice_amounts"];

			if (RECURRING_FEATURE == "on") {
				//Build XML to post
				$content =
					"<?xml version=\"1.0\" encoding=\"utf-8\"?>".
					"<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
						"<merchantAuthentication>".
							"<name>".$x_login."</name>".
							"<transactionKey>".$x_tran_key."</transactionKey>".
						"</merchantAuthentication>".
						"<refId>".$x_invoice_num."</refId>".
						"<subscription>".
							"<name>".$x_invoice_num."</name>".
							"<paymentSchedule>".
								"<interval>".
									"<length>".$x_length."</length>".
									"<unit>".$x_unit."</unit>".
								"</interval>".
								"<startDate>".$x_start_date."</startDate>".
								"<totalOccurrences>".$x_total_occurrences."</totalOccurrences>".
							"</paymentSchedule>".
							"<amount>".$x_amount."</amount>".
							"<payment>".
								"<creditCard>".
									"<cardNumber>".$x_card_num."</cardNumber>".
									"<expirationDate>".$x_expiration_date."</expirationDate>".
								"</creditCard>".
							"</payment>".
							"<customer>".
								"<id>".$x_cust_id."</id>".
								"<email>".$x_email."</email>".
								"<phoneNumber>".$x_phone."</phoneNumber>".
							"</customer>".
							"<billTo>".
								"<firstName>".$x_first_name."</firstName>".
								"<lastName>".$x_last_name."</lastName>".
								"<company>".$x_company."</company>".
								"<address>".$x_address."</address>".
								"<city>".$x_city."</city>".
								"<state>".$x_state."</state>".
								"<zip>".$x_zip."</zip>".
								"<country>".$x_country."</country>".
							"</billTo>".
						"</subscription>".
					"</ARBCreateSubscriptionRequest>";
			} else {
				// Build fields string to post
				$content="x_version=3.1"
				."&x_login=".urlencode(trim($x_login))
				."&x_email=".urlencode(trim($x_email))
				."&x_first_name=".urlencode(trim($x_first_name))
				."&x_last_name=".urlencode(trim($x_last_name))
				."&x_company=".urlencode(trim($x_company))
				."&x_address=".urlencode(trim($x_address))
				."&x_city=".urlencode(trim($x_city))
				."&x_state=".urlencode(trim($x_state))
				."&x_zip=".urlencode(trim($x_zip))
				."&x_country=".urlencode(trim($x_country))
				."&x_phone=".urlencode(trim($x_phone))
				."&x_email_customer=".urlencode(trim($x_email_customer))
				."&x_amount=".urlencode(trim($x_amount))
				."&x_test_request=".urlencode(trim($x_test_request))
				."&x_duplicate_window=".urlencode(trim($x_duplicate_window))
				."&x_customer_ip=".urlencode(trim($x_customer_ip))
				."&x_invoice_num=".urlencode(trim($x_invoice_num))
				."&x_description=".urlencode(trim($x_description))
				."&x_cust_id=".urlencode(trim($x_cust_id))
				."&x_card_num=".urlencode(trim($x_card_num))
				."&x_card_code=".urlencode(trim($x_card_code))
				."&x_exp_date=".urlencode(trim($x_exp_date))
				."&x_first_name=".urlencode(trim($x_first_name))
				."&x_last_name=".urlencode(trim($x_last_name))
				."&x_delim_data=".urlencode(trim($x_delim_data))
				."&x_delim_char=".urlencode(trim($x_delim_char))
				."&x_encap_char=".urlencode(trim($x_encap_char))
				."&x_type=".urlencode(trim($x_type))
				."&x_method=".urlencode(trim($x_method))
				."&x_relay_response=".urlencode(trim($x_relay_response))
				."&x_cust_ip=".urlencode(trim($x_customer_ip))
				."&x_listing_ids=".urlencode($x_listing_ids)
				."&x_listing_amounts=".urlencode($x_listing_amounts)
				."&x_event_ids=".urlencode($x_event_ids)
				."&x_event_amounts=".urlencode($x_event_amounts)
				."&x_banner_ids=".urlencode($x_banner_ids)
				."&x_banner_amounts=".urlencode($x_banner_amounts)
				."&x_classified_ids=".urlencode($x_classified_ids)
				."&x_classified_amounts=".urlencode($x_classified_amounts)
				."&x_article_ids=".urlencode($x_article_ids)
				."&x_article_amounts=".urlencode($x_article_amounts)
				."&x_custominvoice_ids=".urlencode($x_custominvoice_ids)
				."&x_custominvoice_amounts=".urlencode($x_custominvoice_amounts)
				."&x_tran_key=".urlencode(trim($x_tran_key));
			}

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, AUTHORIZE_POST_URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			if (RECURRING_FEATURE == "on") {
				curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
				curl_setopt($ch, CURLOPT_HEADER, 1);
			} else {
				$agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)";
				$ref = "http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
				curl_setopt($ch, CURLOPT_NOPROGRESS, 1);
				curl_setopt($ch, CURLOPT_VERBOSE, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
				curl_setopt($ch, CURLOPT_TIMEOUT, 120);
				curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				curl_setopt($ch, CURLOPT_REFERER, $ref);
			}
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			$curl_response = curl_exec($ch);
            
            $curl_response = str_replace('"', "", $curl_response);

			curl_close($ch);

			if ($curl_response) {

				if (RECURRING_FEATURE == "on") {

					list($x_refId, $x_resultCode, $x_code, $x_text, $x_subscriptionId) = parse_return($curl_response);

					$transaction_authorize["ref_id"]                = $x_refId;
					$transaction_authorize["result_code"]           = $x_resultCode;
					$transaction_authorize["response_code"]         = $x_code;
					$transaction_authorize["response_text"]         = $x_text;
					$transaction_authorize["subscription_id"]       = $x_subscriptionId;
					$transaction_authorize["start_date"]            = $x_start_date;
					$transaction_authorize["total_occurrences"]     = $x_total_occurrences;
					$transaction_authorize["recurring_length"]      = $x_length;
					$transaction_authorize["recurring_unit"]        = $x_unit;
					$transaction_authorize["invoice_num"]           = $x_invoice_num;
					$transaction_authorize["description"]           = $x_description;
					$transaction_authorize["amount"]                = $x_amount;
					$transaction["account_id"]                      = $x_cust_id;
					$transaction_authorize["cardholder_first_name"] = $x_first_name;
					$transaction_authorize["cardholder_last_name"]  = $x_last_name;
					$transaction_authorize["company"]               = $x_company;
					$transaction_authorize["billing_address"]       = $x_address;
					$transaction_authorize["city"]                  = $x_city;
					$transaction_authorize["state"]                 = $x_state;
					$transaction_authorize["zip"]                   = $x_zip;
					$transaction_authorize["country"]               = $x_country;
					$transaction_authorize["phone"]                 = $x_phone;
					$transaction_authorize["email"]                 = $x_email;
					$transaction["ip"]                              = $x_customer_ip;
					$transaction["listing_ids"]                     = $x_listing_ids;
					$transaction["listing_amounts"]                 = $x_listing_amounts;
					$transaction["event_ids"]                       = $x_event_ids;
					$transaction["event_amounts"]                   = $x_event_amounts;
					$transaction["banner_ids"]                      = $x_banner_ids;
					$transaction["banner_amounts"]                  = $x_banner_amounts;
					$transaction["classified_ids"]                  = $x_classified_ids;
					$transaction["classified_amounts"]              = $x_classified_amounts;
					$transaction["article_ids"]                     = $x_article_ids;
					$transaction["article_amounts"]                 = $x_article_amounts;
					$transaction["custominvoice_ids"]               = $x_custominvoice_ids;
					$transaction["custominvoice_amounts"]           = $x_custominvoice_amounts;
					$transaction["transaction_id"]                  = $transaction_authorize["subscription_id"];
					$transaction["recurring"]                       = "y";
					$domain_id					                    = $x_domain_id;

					if (string_strtolower($transaction_authorize["result_code"]) == "ok") {
						$transaction["transaction_status"] = 'Accepted';
						$transaction_status = "ok";
					} else {
						$transaction["transaction_status"] = 'Failed';
					}

				} else {

					$details = explode($x_delim_char, $curl_response);

					$transaction_authorize["response_code"]         = $details[0];
					$transaction_authorize["response_subcode"]      = $details[1];
					$transaction_authorize["response_reason_code"]  = $details[2];
					$transaction_authorize["response_reason_text"]  = $details[3];
					$transaction_authorize["approval_code"]         = $details[4];
					$transaction_authorize["avs_result_code"]       = $details[5];
					$transaction_authorize["transaction_id"]        = $details[6];
					$transaction_authorize["invoice_number"]        = $details[7];
					$transaction_authorize["description"]           = $details[8];
					$transaction_authorize["amount"]                = $details[9];
					$transaction_authorize["method"]                = $details[10];
					$transaction_authorize["transaction_type"]      = $details[11];
					$transaction["account_id"]                      = $details[12];
					$transaction_authorize["cardholder_first_name"] = $details[13];
					$transaction_authorize["cardholder_last_name"]  = $details[14];
					$transaction_authorize["company"]               = $details[15];
					$transaction_authorize["billing_address"]       = $details[16];
					$transaction_authorize["city"]                  = $details[17];
					$transaction_authorize["state"]                 = $details[18];
					$transaction_authorize["zip"]                   = $details[19];
					$transaction_authorize["country"]               = $details[20];
					$transaction_authorize["phone"]                 = $details[21];
					$transaction_authorize["fax"]                   = $details[22];
					$transaction_authorize["email"]                 = $details[23];
					$transaction_authorize["ship_to_first_name"]    = $details[24];
					$transaction_authorize["ship_to_last_name"]     = $details[25];
					$transaction_authorize["ship_to_company"]       = $details[26];
					$transaction_authorize["ship_to_address"]       = $details[27];
					$transaction_authorize["ship_to_city"]          = $details[28];
					$transaction_authorize["ship_to_state"]         = $details[29];
					$transaction_authorize["ship_to_zip"]           = $details[30];
					$transaction_authorize["ship_to_country"]       = $details[31];
					$transaction_authorize["tax_amount"]            = $details[32];
					$transaction_authorize["duty_amount"]           = $details[33];
					$transaction_authorize["freight_amount"]        = $details[34];
					$transaction_authorize["tax_example_flag"]      = $details[35];
					$transaction_authorize["po_number"]             = $details[36];
					$transaction_authorize["md5_hash"]              = $details[37];
					$transaction_authorize["cvv2"]                  = $details[38];
					$transaction_authorize["cavv"]                  = $details[39];
					$transaction["ip"]                              = $details[68];
					$transaction["listing_ids"]                     = $details[69];
					$transaction["listing_amounts"]                 = $details[70];
					$transaction["event_ids"]                       = $details[71];
					$transaction["event_amounts"]                   = $details[72];
					$transaction["banner_ids"]                      = $details[73];
					$transaction["banner_amounts"]                  = $details[74];
					$transaction["classified_ids"]                  = $details[75];
					$transaction["classified_amounts"]              = $details[76];
					$transaction["article_ids"]                     = $details[77];
					$transaction["article_amounts"]                 = $details[78];
					$transaction["custominvoice_ids"]               = $details[79];
					$transaction["custominvoice_amounts"]           = $details[80];
					$transaction["transaction_id"]                  = $transaction_authorize["transaction_id"];
					$transaction["recurring"]                       = "n";

					if ($transaction_authorize["response_code"] == "1") {
						$transaction["transaction_status"] = 'Approved';
						$transaction_status = "ok";
					} elseif ($transaction_authorize["response_code"] == "2") {
						$transaction["transaction_status"] = 'Declined';
					} elseif ($transaction_authorize["response_code"] == "3") {
						$transaction["transaction_status"] = 'Error';
					} else {
						$transaction["transaction_status"] = 'Failed';
					}

				}

				$transaction_authorize["trans_time"]            = date("Y-m-d H:i:s");
				$accountObj                                     = new Account($transaction["account_id"]);
				$transaction["username"]                        = $accountObj->getString("username");
				$transaction["transaction_datetime"]            = $transaction_authorize["trans_time"];
				$transaction["transaction_subtotal"]            = $x_subtotal_amount;
				$transaction["transaction_tax"]					= $x_tax_amount;
				$transaction["transaction_amount"]              = $transaction_authorize["amount"];
				$transaction["transaction_currency"]            = AUTHORIZE_CURRENCY;
				$transaction["system_type"]                     = "authorize";
				$transaction["notes"]                           = "";

				if ($transaction_status == "ok") {

					$payment_success = "y";

					$payment_message .= "<p class=\"successMessage\">".system_showText(LANG_LABEL_STATUS).": ".$transaction["transaction_status"]."<br />\n";
					if (RECURRING_FEATURE == "on") {
						$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE)." (".system_showText(LANG_LABEL_SUBSCRIPTION_ID)."): ".$transaction["transaction_id"]."<br />\n";
						$payment_message .= $transaction_authorize["response_text"]."<br />\n";
					} else {
						$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": ".$transaction["transaction_id"]."<br />\n";
						$payment_message .= $transaction_authorize["response_reason_text"]."<br />\n";
					}
					if ($process == "claim") $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY)."\n";
					else $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_YOUR)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";
					
					$payment_message .= "</p>";

					$transaction["return_fields"] = system_array2nvp($transaction_authorize, " || ");
					$paymentLogObj = new PaymentLog($transaction);
					$paymentLogObj->Save($domain_id);

					$listing_ids = explode("::",$transaction["listing_ids"]);
					$listing_amounts = explode("::",$transaction["listing_amounts"]);
					$event_ids = explode("::",$transaction["event_ids"]);
					$event_amounts = explode("::",$transaction["event_amounts"]);
					$banner_ids = explode("::",$transaction["banner_ids"]);
					$banner_amounts = explode("::",$transaction["banner_amounts"]);
					$classified_ids = explode("::",$transaction["classified_ids"]);
					$classified_amounts = explode("::",$transaction["classified_amounts"]);
					$article_ids = explode("::",$transaction["article_ids"]);
					$article_amounts = explode("::",$transaction["article_amounts"]);
					$custominvoice_ids = explode("::",$transaction["custominvoice_ids"]);
					$custominvoice_amounts = explode("::",$transaction["custominvoice_amounts"]);

					if (!empty($listing_ids[0])) {

						$listingStatus = new ItemStatus();

						$amountAux = 0;
						$levelObj = new ListingLevel();
						foreach($listing_ids as $each_listing_id){

							$listingObj = new Listing($each_listing_id);

                            $renewal_cycle = ($_SESSION["order_renewal_period_listing_{$each_listing_id}"] ? $_SESSION["order_renewal_period_listing_{$each_listing_id}"] : $_SESSION["order_renewal_period"]);
                            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

							$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate($renewal_increase, $renewal_cycle));
							
							$dbMain = db_getDBObject(DEFAULT_DB, true);
							$dbObjCat = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
							
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

							$transaction_listing_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_listing_log["listing_id"]     = $each_listing_id;
							$transaction_listing_log["listing_title"]  = $listingObj->getString("title", false);
                            $transaction_listing_log["level"]          = $listingObj->getString("level");
							$transaction_listing_log["level_label"]    = $levelObj->showLevel($listingObj->getString("level"));
							$transaction_listing_log["renewal_date"]   = $listingObj->getString("renewal_date");
							$transaction_listing_log["discount_id"]    = $listingObj->getString("discount_id");
							$transaction_listing_log["categories"]     = ($category_amount) ? $category_amount : 0;
							$transaction_listing_log["amount"]         = str_replace(",","",$listing_amounts[$amountAux]);
							$amountAux++;

							$transaction_listing_log["extra_categories"] = 0;
							if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
								$transaction_listing_log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
							} else {
								$transaction_listing_log["extra_categories"] = 0;
							}

							$transaction_listing_log["listingtemplate_title"] = "";
							if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
								if ($listingObj->getString("listingtemplate_id")) {
									$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
									$transaction_listing_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
								}
							}

							$paymentListingLogObj = new PaymentListingLog($transaction_listing_log, $domain_id);
							$paymentListingLogObj->Save();

						}

						unset($listingObj);

					}

					if (!empty($event_ids[0])) {

						$eventStatus = new ItemStatus();

						$amountAux = 0;
						foreach($event_ids as $each_event_id){

							$eventObj = new Event($each_event_id);
                            $levelObj = new EventLevel();

                            $renewal_cycle = ($_SESSION["order_renewal_period_event_{$each_event_id}"] ? $_SESSION["order_renewal_period_event_{$each_event_id}"] : $_SESSION["order_renewal_period"]);
                            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));
                            
							$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate($renewal_increase, $renewal_cycle));
	
							setting_get("event_approve_paid", $event_approve_paid);
									
							if ($event_approve_paid){
								$eventObj->setString("status", $eventStatus->getDefaultStatus());
							}else{
								$eventObj->setString("status", "A");
							}
							
							$eventObj->Save();

							$transaction_event_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_event_log["event_id"]       = $each_event_id;
							$transaction_event_log["event_title"]    = $eventObj->getString("title",false);
                            $transaction_event_log["level"]          = $eventObj->getString("level");
							$transaction_event_log["level_label"]    = $levelObj->showLevel($eventObj->getString("level"));
							$transaction_event_log["renewal_date"]   = $eventObj->getString("renewal_date");
							$transaction_event_log["discount_id"]    = $eventObj->getString("discount_id");
							$transaction_event_log["amount"]         = str_replace(",","",$event_amounts[$amountAux]);
							$amountAux++;

							$paymentEventLogObj = new PaymentEventLog($transaction_event_log, $domain_id);
							$paymentEventLogObj->Save();

						}

						unset($eventObj);

					}

					if (!empty($banner_ids[0])) {

						$bannerStatus = new ItemStatus();

						$amountAux = 0;
						foreach($banner_ids as $each_banner_id){

							$bannerObj = new Banner($each_banner_id);
                            $levelObj = new BannerLevel();

							if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

								$dbMain = db_getDBObject(DEFAULT_DB, true);
								$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
								
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

								$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate($renewal_increase, $renewal_cycle));

								setting_get("banner_approve_paid", $banner_approve_paid);
									
								if ($banner_approve_paid){
									$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
								}else{
									$bannerObj->setString("status", "A");
								}
								
								$bannerObj->Save();

							}

							$transaction_banner_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_banner_log["banner_id"]      = $each_banner_id;
							$transaction_banner_log["banner_caption"] = $bannerObj->getString("caption",false);
                            $transaction_banner_log["level"]          = $bannerObj->getString("type");
							$transaction_banner_log["level_label"]    = $levelObj->showLevel($bannerObj->getString("type"));
							$transaction_banner_log["renewal_date"]   = $bannerObj->getString("renewal_date");
							$transaction_banner_log["discount_id"]    = $bannerObj->getString("discount_id");
							$transaction_banner_log["impressions"]    = ($unpaid_impressions[$each_banner_id]) ? $unpaid_impressions[$each_banner_id] : 0;
							$transaction_banner_log["amount"]         = str_replace(",","",$banner_amounts[$amountAux]);
							$amountAux++;

							$paymentBannerLogObj = new PaymentBannerLog($transaction_banner_log, $domain_id);
							$paymentBannerLogObj->Save();

						}

						unset($bannerObj);

					}

					if (!empty($classified_ids[0])) {

						$classifiedStatus = new ItemStatus();

						$amountAux = 0;
						foreach($classified_ids as $each_classified_id){

							$classifiedObj = new Classified($each_classified_id);
                            $levelObj = new ClassifiedLevel();

                            $renewal_cycle = ($_SESSION["order_renewal_period_classified_{$each_classified_id}"] ? $_SESSION["order_renewal_period_classified_{$each_classified_id}"] : $_SESSION["order_renewal_period"]);
                            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));
                            
							$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate($renewal_increase, $renewal_cycle));
							
							setting_get("classified_approve_paid", $classified_approve_paid);
									
							if ($classified_approve_paid){
								$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
							}else{
								$classifiedObj->setString("status", "A");
							}
												
							$classifiedObj->save();

							$transaction_classified_log["payment_log_id"]   = $paymentLogObj->getNumber("id");
							$transaction_classified_log["classified_id"]    = $each_classified_id;
							$transaction_classified_log["classified_title"] = $classifiedObj->getString("title",false);
                            $transaction_classified_log["level"]            = $classifiedObj->getString("level");
							$transaction_classified_log["level_label"]      = $levelObj->showLevel($classifiedObj->getString("level"));
							$transaction_classified_log["renewal_date"]     = $classifiedObj->getString("renewal_date");
							$transaction_classified_log["discount_id"]      = $classifiedObj->getString("discount_id");
							$transaction_classified_log["amount"]           = str_replace(",","",$classified_amounts[$amountAux]);
							$amountAux++;

							$paymentClassifiedLogObj = new PaymentClassifiedLog($transaction_classified_log, $domain_id);
							$paymentClassifiedLogObj->Save();

						}

						unset($classifiedObj);

					}

					if (!empty($article_ids[0])) {

						$articleStatus = new ItemStatus();

						$amountAux = 0;
						foreach($article_ids as $each_article_id){

							$articleObj = new Article($each_article_id);
                            $levelObj = new ArticleLevel();

                            $renewal_cycle = ($_SESSION["order_renewal_period_article_{$each_article_id}"] ? $_SESSION["order_renewal_period_article_{$each_article_id}"] : $_SESSION["order_renewal_period"]);
                            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));
                            
							$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate($renewal_increase, $renewal_cycle));
							
							setting_get("article_approve_paid", $article_approve_paid);
									
							if ($article_approve_paid){
								$articleObj->setString("status", $articleStatus->getDefaultStatus());
							}else{
								$articleObj->setString("status", "A");
							}
							
							$articleObj->Save();

							$transaction_article_log["payment_log_id"] = $paymentLogObj->getNumber("id");
							$transaction_article_log["article_id"]     = $each_article_id;
							$transaction_article_log["article_title"]  = $articleObj->getString("title",false);
                            $transaction_article_log["level"]          = $articleObj->getString("level");
							$transaction_article_log["level_label"]    = $levelObj->showLevel($articleObj->getString("level"));
							$transaction_article_log["renewal_date"]   = $articleObj->getString("renewal_date");
							$transaction_article_log["discount_id"]    = $articleObj->getString("discount_id");
							$transaction_article_log["amount"]         = str_replace(",","",$article_amounts[$amountAux]);
							$amountAux++;

							$paymentArticleLogObj = new PaymentArticleLog($transaction_article_log, $domain_id);
							$paymentArticleLogObj->Save();

						}

						unset($articleObj);

					}

					if (!empty($custominvoice_ids[0])) {

						$amountAux = 0;
						foreach($custominvoice_ids as $each_custominvoice_id){

							$customInvoiceObj = new CustomInvoice($each_custominvoice_id);
							if ($x_tax_amount > 0) {
								$cInvoiceAmount = payment_calculateTax($customInvoiceObj->getNumber("amount"), $x_tax_amount);
							} else {
								$cInvoiceAmount = $customInvoiceObj->getNumber("amount");
							}
							$customInvoiceObj->setNumber("tax", $x_tax_amount);
							$customInvoiceObj->setNumber("subtotal", $customInvoiceObj->getNumber("amount"));
							$customInvoiceObj->setNumber("amount", $cInvoiceAmount);
							$customInvoiceObj->setString("paid", "y");
							$customInvoiceObj->Save();

							$transaction_custominvoice_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
							$transaction_custominvoice_log["custom_invoice_id"] = $each_custominvoice_id;
							$transaction_custominvoice_log["title"]             = $customInvoiceObj->getString("title");
							$transaction_custominvoice_log["date"]              = $customInvoiceObj->getString("date");
							$transaction_custominvoice_log["items"]             = $customInvoiceObj->getTextItems();
							$transaction_custominvoice_log["items_price"]       = $customInvoiceObj->getTextPrices();
							$transaction_custominvoice_log["amount"]            = $customInvoiceObj->getNumber("subtotal");
							$amountAux++;

							$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($transaction_custominvoice_log, $domain_id);
							$paymentCustomInvoiceLogObj->Save();

						}

						unset($customInvoiceObj);

					}

					if ($x_package_id) {

						/////////////////////////////
						$packageObj = new Package($x_package_id);
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
                                    if ($package_offer_item['domain_id'] > 0) {
                                        $aux_domain_obj = new Domain($package_offer_item['domain_id']);
                                        $auxdomains_names .= "&nbsp;&nbsp;&nbsp;-".$aux_domain_obj->getString('name')."<br />";
                                        $auxlevel_names .= $item_levelName."<br />";
                                    }

                                    if ($package_offer_item['price'] == 0) {
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

                            $dbMain = db_getDBObject(DEFAULT_DB, true);
                            $sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".$domain_id." AND package_id = ".$x_package_id." AND account_id = ".$x_cust_id;
                            $r = $dbMain->query($sql);
                            $i = 0;
                            while($row = mysql_fetch_assoc($r)){
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

                                    $renewal_cycle = ($_SESSION["order_renewal_period_{$item["module"]}_{$item_id}"] ? $_SESSION["order_renewal_period_{$item["module"]}_{$item_id}"] : $_SESSION["order_renewal_period"]);
                                    $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

                                    $sql = "UPDATE $className SET status = ".db_formatString($stritemStatus).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate($renewal_increase, $renewal_cycle))." WHERE id = ".$item_id;
                                    $dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
                                    $dbItem->query($sql);
                                }
                            }
						}

						//////////////////////////////

						$amountAux = 0;

						$packageObj = new Package($x_package_id);

						$transaction_package_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
						$transaction_package_log["package_id"]		  = $x_package_id;
						$transaction_package_log["package_title"]     = $packageObj->getString("title");
						$transaction_package_log["items"]             = $item_name." ".$item_levelName."\n".str_replace("-","",$auxdomains_names);
						$transaction_package_log["items_price"]       = str_replace(CURRENCY_SYMBOL." ", "",str_replace("<br />","\n",$aux_package_item_price));
						$transaction_package_log["amount"]            = payment_calculateTax(str_replace(",","",$aux_package_total), $payment_tax_value, false);
						$amountAux++;

						$paymentPacakgeObj = new PaymentPackageLog($transaction_package_log, $domain_id);
						$paymentPacakgeObj->Save();

						unset($packageObj);

					}

					$paymentLogObj->sendNotification(false, $x_package_id);

				} else {

					$payment_message .= "<p class=\"errorMessage\">".system_showText(LANG_LABEL_STATUS).": ".$transaction["transaction_status"]."<br />\n";
					if (RECURRING_FEATURE == "on") {
						$payment_message .= $transaction_authorize["response_code"]." - ".$transaction_authorize["response_text"]."<br />\n";
					} else {
						$payment_message .= $transaction_authorize["response_reason_code"]." - ".$transaction_authorize["response_reason_text"]."<br />\n";
					}
					if ($process == "signup") $try_again_message = "\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=authorize\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
					elseif ($process == "claim") $try_again_message = "\n<a style=\"cursor:pointer\" href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/".$process."/payment.php?payment_method=authorize&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
					else $try_again_message = "\n<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

				}

				$payment_message .= $try_again_message."</p>\n";

			} else {
				$payment_message .= "<p class=\"errorMessage\">\n";
				$payment_message .= system_showText(LANG_LABEL_STATUS).":".system_showText(LANG_LABEL_ERROR)."<br />\n";
				$payment_message .= system_showText(LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE)."<br />\n";
				$payment_message .= "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			}

		}

	} else {
		$payment_message .= "<p class=\"errorMessage\">\n";
		$payment_message .= system_showText(LANG_LABEL_STATUS).":".system_showText(LANG_LABEL_ERROR)."<br />\n";
		$payment_message .= system_showText(LANG_MSG_PAYMENT_INVALID_PARAMS)."<br />\n";
		$payment_message .= "<a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
	}

?>