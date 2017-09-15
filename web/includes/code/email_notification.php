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
	# * FILE: /includes/code/email_notifications.php
	# ----------------------------------------------------------------------------------------------------

	$body = stripslashes($body);

	# ----------------------------------------------------------------------------------------------------
	# DEFAULTS
	# ----------------------------------------------------------------------------------------------------
	// Default from field value (this variable retrieve site manager e-mail from setting table)
	setting_get("sitemgr_email", $sitemgr_email);
	list($sitemgr_emails) = explode(",", $sitemgr_email);
	$default_from = $sitemgr_email;
	///////////////////////////////////////////////////////////////////////////////////////////

	setting_get("payment_tax_status", $payment_tax_status);
	# ----------------------------------------------------------------------------------------------------
	# SAVE AND / OR LOAD
	# ----------------------------------------------------------------------------------------------------  

	if ($id) {
		
		if ($id == 36){
			$listingLevelObj = new ListingLevel();
			$levelValue = $listingLevelObj->getValues();
			asort($levelValue);
			
			if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			
				foreach ($levelValue as $value) {
					if (!${"email_traffic_listing_".$value}) setting_get("email_traffic_listing_".$value, ${"email_traffic_listing_".$value});
				}
			
			}
		}

		$emailNotificationObj = new EmailNotification($id);

		$days = $emailNotificationObj->getNumber("days");

		if ($save || $hiddenValue ) {

			// Reset ///////////////////////////////////////////////////////
			if ($hiddenValue) {
				$subject = $emailNotificationObj->restoreSubject();
			}
			if ($hiddenValue == 'reset_html'){
				$body         = $emailNotificationObj->restoreBody("html");
				if (!$payment_tax_status == "on") {
					$body = str_replace("CUSTOM_INVOICE_TAX", "", $body);
				}
				$content_type = "text/html";
			} elseif($hiddenValue == 'reset_text') {
				$body         = $emailNotificationObj->restoreBody("text");
				if (!$payment_tax_status == "on") {
					$body = str_replace("CUSTOM_INVOICE_TAX", "", $body);
				}
				$content_type = "text/plain";
			}
			///////////////////////////////////////////////////////////////

			// Loading data into the object

			$_POST["subject"] = str_replace("&quot;", "\"", $_POST["subject"]);
			$_POST["body"] = str_replace("&quot;", "\"", $_POST["body"]);

			$emailNotificationObj->makeFromRow($_POST);

			// Default CSS style for message
			$message_style = "alert-success";

			// Save
			if ($save) {
				
				if ($id == 36){
					foreach ($levelValue as $value) {
						
						if (!setting_set("email_traffic_listing_".$value, ${"email_traffic_listing_".$value}))
							if (!setting_new("email_traffic_listing_".$value, ${"email_traffic_listing_".$value}))
								$error = true;
					}
				}

				if (!$emailNotificationObj->getString("bcc") || validate_email($emailNotificationObj->getString("bcc"))) {

					$emailNotificationObj->Save();

					if ($email) {
						$message = 1;
					} else {
						$message = 2;
					}
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/design/email-editor/index.php?message=$message");
                    exit;

				} else {

					$message = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDEMAILADDRESS);
					$message_style = "alert-warning";

				}

			}

		}

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$emailNotificationObj->extract();
			$deactivate = $emailNotificationObj->getString("deactivate");
			$content_type = $emailNotificationObj->getString("content_type");
			$bcc = $emailNotificationObj->getString("bcc");

			if (!$payment_tax_status == "on") {
				$body = str_replace("CUSTOM_INVOICE_TAX", "", $body);
			}
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------
	//deactivate
	if(!$deactivate == 1) {
		$deactivate = "";
	} else {
		$deactivate = "checked";
	}