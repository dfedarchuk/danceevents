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
	# * FILE: /includes/code/mailappsignup.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if ($disconnet == "yes") {

            if (!setting_set("arcamailer_customer_id", "")) {
                if (!setting_new("arcamailer_customer_id", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_customer_name", "")) {
                if (!setting_new("arcamailer_customer_name", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_customer_email", "")) {
                if (!setting_new("arcamailer_customer_email", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_customer_country", "")) {
                if (!setting_new("arcamailer_customer_country", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_customer_timezone", "")) {
                if (!setting_new("arcamailer_customer_timezone", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_enable_list", "")) {
                if (!setting_new("arcamailer_enable_list", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_list_label", "")) {
                if (!setting_new("arcamailer_list_label", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_customer_listname", "")) {
                if (!setting_new("arcamailer_customer_listname", "")) {
                    $error = true;
                }
            }

            if (!setting_set("arcamailer_customer_listid", "")) {
                if (!setting_new("arcamailer_customer_listid", "")) {
                    $error = true;
                }
            }

            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/promote/newsletter/index.php?messageDisconnect=1#account");
            exit;

        }

		if (validate_form("mailapp_signup", $_POST, $message_mailapp)) {

            //Create/Connect account
            if ($actionForm == "newAcc") {

                $postFields = array();

                //Create new Account
                if ($account_type == "new") {
                    $postFields["action"] = "signUP";
                    $postFields["edir_name"] = $edir_name;
                    $postFields["edir_email"] = $edir_email;
                    $postFields["edir_country"] = $edir_country;
                    $postFields["edir_timezone"] = $edir_timezone;

                //Connect Existing Account
                } else {
                    $postFields["action"] = "doLogin";
                    $postFields["email"] = $arcamailer_username;
                    $postFields["password"] = $arcamailer_password;
                }

                $return = arcamailer_curlRequest($postFields);

                if ($return["success"] == 1 && ($return["customer_ID"] || $return["arrayReturn"]["customer_ID"])) {

                    if ($account_type == "existing") {

                        $return["customer_ID"] = $return["arrayReturn"]["customer_ID"];
                        $edir_name = $return["arrayReturn"]["Name"];
                        $edir_email = $arcamailer_username;
                        $edir_country = $return["arrayReturn"]["Country"];
                        $edir_timezone = $return["arrayReturn"]["TimeZone"];

                    }

                    if (!setting_set("arcamailer_customer_id", $return["customer_ID"])) {
                        if (!setting_new("arcamailer_customer_id", $return["customer_ID"])) {
                            $error = true;
                        }
                    }

                    if (!setting_set("arcamailer_customer_name", $edir_name)) {
                        if (!setting_new("arcamailer_customer_name", $edir_name)) {
                            $error = true;
                        }
                    }

                    if (!setting_set("arcamailer_customer_email", $edir_email)) {
                        if (!setting_new("arcamailer_customer_email", $edir_email)) {
                            $error = true;
                        }
                    }

                    if (!setting_set("arcamailer_customer_country", $edir_country)) {
                        if (!setting_new("arcamailer_customer_country", $edir_country)) {
                            $error = true;
                        }
                    }

                    if (!setting_set("arcamailer_customer_timezone", $edir_timezone)) {
                        if (!setting_new("arcamailer_customer_timezone", $edir_timezone)) {
                            $error = true;
                        }
                    }

                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/promote/newsletter/index.php?".($account_type == "existing" ? "messageConnect" : "messageSignup")."=1#account");
                    exit;

                } else {
                    $message_mailapp = $return["message"];
                }

            //Create or update list
            } else {

                //Update list
                if ($edir_list_id) {

                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/promote/newsletter/index.php?messageUpdate=1#newsletter");
                    exit;

                //Create list
                } else {

                    $postFields = array();
                    $postFields["action"] = "allowService";
                    $postFields["customerID"] = $edir_customer_id;
                    $postFields["listName"] = $edir_list;

                    $return = arcamailer_curlRequest($postFields);

                    if ($return["success"] == 1) {

                        if (!setting_set("arcamailer_customer_listname", $edir_list)) {
                            if (!setting_new("arcamailer_customer_listname", $edir_list)) {
                                $error = true;
                            }
                        }

                        if (!setting_set("arcamailer_customer_listid", $return["arrayReturn"])) {
                            if (!setting_new("arcamailer_customer_listid", $return["arrayReturn"])) {
                                $error = true;
                            }
                        }

                        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/promote/newsletter/index.php?messageNewList=1#newsletter");
                        exit;

                    } else {
                        $message_mailapp = $return["arrayReturn"]->Message;
                    }

                }

            }

        }

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    setting_get("arcamailer_customer_id", $edir_customer_id);
    setting_get("arcamailer_customer_name", $edir_name);
    setting_get("arcamailer_customer_email", $edir_email);
    setting_get("arcamailer_customer_country", $edir_country);
    setting_get("arcamailer_customer_timezone", $edir_timezone);
    setting_get("arcamailer_customer_listname", $edir_list);
    setting_get("arcamailer_customer_listid", $edir_list_id);

    //Prepare dropdowns
    $return = arcamailer_curlRequest("", "?getInfo=true");

    if (is_array($return["timezones"])) {
        foreach ($return["timezones"] as $timezone) {
            $timezoneOptions .= "\n<option value=\"".$timezone."\" ".($timezone == $edir_timezone ? "selected=\"selected\"" : "").">$timezone</option>";
        }
    }

    if (is_array($return["contries"])) {
        foreach ($return["contries"] as $country) {
            $countryOptions .= "\n<option value=\"".$country."\" ".($country == $edir_country ? "selected=\"selected\"" : "").">$country</option>";
        }
    }


?>
