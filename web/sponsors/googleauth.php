<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /sponsors/googleauth.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

    setting_get("foreignaccount_google_clientid", $foreignaccount_google_clientid);
    setting_get("foreignaccount_google_clientsecret", $foreignaccount_google_clientsecret);

    if (isset($_GET["aux_code"]) && $foreignaccount_google_clientid && $foreignaccount_google_clientsecret) {

        //Validate token
        $url = "https://accounts.google.com/o/oauth2/auth";
        $client_id = $foreignaccount_google_clientid;
        $client_secret = $foreignaccount_google_clientsecret;
        $redirect_uri = "postmessage";
        $grant_type = "authorization_code";

        // try to get an access token
        $code = $_GET['aux_code'];
        $url = 'https://accounts.google.com/o/oauth2/token';
        $params = array(
            "code" => $code,
            "client_id" => "$client_id",
            "client_secret" => "$client_secret",
            "redirect_uri" => "$redirect_uri",
            "grant_type" => "$grant_type"
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $json_response = curl_exec($curl);
        curl_close($curl);

        $authObj = json_decode($json_response);

        if (!$json_response || $authObj->error) {
            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=cancel");
            exit;
        }

    } else {
        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=cancel");
        exit;
    }

    if ($_GET["user_email"] && $_GET["user_name"]) { //user successfully authenticated
        $auxUserName = explode(" ", $_GET["user_name"]);
        unset($userInfo);
        $userInfo["first_name"] = $auxUserName[0];
        $userInfo["last_name"] = $auxUserName[1];
        $userInfo["email"] = $_GET["user_email"];

        if ($_GET["advertise"] == "yes" || string_strpos($_GET["destiny"], "/".ALIAS_CLAIM_URL_DIVISOR) !== false) {
            if (string_strpos($_GET["destiny"], "/".LISTING_FEATURE_FOLDER) !== false) {
                $email_notification = SYSTEM_LISTING_SIGNUP;
            } else if (string_strpos($_GET["destiny"], "/".ARTICLE_FEATURE_FOLDER) !== false) {
                $email_notification = SYSTEM_ARTICLE_SIGNUP;
            } else if (string_strpos($_GET["destiny"], "/".EVENT_FEATURE_FOLDER) !== false) {
                $email_notification = SYSTEM_EVENT_SIGNUP;
            } else if (string_strpos($_GET["destiny"], "/".CLASSIFIED_FEATURE_FOLDER) !== false) {
                $email_notification = SYSTEM_CLASSIFIED_SIGNUP;
            } else if (string_strpos($_GET["destiny"], "/".BANNER_FEATURE_FOLDER) !== false) {
                $email_notification = SYSTEM_BANNER_SIGNUP;
            } else if (string_strpos($_GET["destiny"], "/".ALIAS_CLAIM_URL_DIVISOR) !== false) {
                $email_notification = SYSTEM_CLAIM_SIGNUP;
            } else {
                $email_notification = SYSTEM_NEW_PROFILE;
            }
        } else {
            $email_notification = SYSTEM_NEW_PROFILE;
        }

        if (system_registerForeignAccount($userInfo, "google", false, $email_notification)) {
            setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
            if ($_GET["claim"] == "yes" || $_GET["advertise"] == "yes" || SOCIALNETWORK_FEATURE == "off") {
                $accObj = new Account(sess_getAccountIdFromSession());
                if ($accObj->getString("is_sponsor") == 'n') {
                    $accObj->changeMemberStatus(true);
                }

                if ($_GET["advertise"] == "yes") {
                    $destinyUrl = $_GET["destiny"];
                    $itemID		= $_GET["item_id"];
                    $item		= $_GET["advertise_item"];

                    $level              = $_SESSION["go_{$item}_level_{$itemID}"];
                    $expiration         = $_SESSION["go_{$item}_expiration_setting_{$itemID}"];
                    $impressions        = $_SESSION["go_{$item}_unpaid_impressions_{$itemID}"];
                    $template           = $_SESSION["go_{$item}_template_id_{$itemID}"];
                    $title              = $_SESSION["go_{$item}_title_{$itemID}"];
                    $discount_id        = $_SESSION["go_{$item}_discount_id_{$itemID}"];
                    $return_categories  = $_SESSION["go_{$item}_return_categories_{$itemID}"];
                    $caption            = $_SESSION["go_{$item}_caption_{$itemID}"];
                    $package_id         = $_SESSION["go_{$item}_package_id_{$itemID}"];
                    $start_date         = $_SESSION["go_{$item}_start_date_{$itemID}"];
                    $end_date           = $_SESSION["go_{$item}_end_date_{$itemID}"];

                    unset(
                        $_SESSION["go_{$item}_level"],
                        $_SESSION["go_{$item}_expiration_setting"],
                        $_SESSION["go_{$item}_unpaid_impressions"],
                        $_SESSION["go_{$item}_template_id"],
                        $_SESSION["go_{$item}_title"],
                        $_SESSION["go_{$item}_discount_id"],
                        $_SESSION["go_{$item}_return_categories"],
                        $_SESSION["go_{$item}_caption"],
                        $_SESSION["go_{$item}_start_date"],
                        $_SESSION["go_{$item}_end_date"],
                        $_SESSION["go_{$item}_package_id"]
                    );

                    if ($item == "banner") {
                        $destinyUrl .= "?type=".$level;
                        $destinyUrl .= "&expiration_setting=".$expiration;
                        $destinyUrl .= "&caption=".$caption;
                    } else if ($item == "listing") {
                        $destinyUrl .= "?level=".$level;
                        if ($template) {
                            $destinyUrl .= "&listingtemplate_id=".$template;
                        }
                        if ($return_categories) {
                            $destinyUrl .= "&return_categories=".$return_categories;
                        }
                    } elseif ($item == "event") {
                        $destinyUrl .= "?level=".$level;
                        if ($start_date) {
                            $destinyUrl .= "&start_date=".$start_date;
                        }
                        if ($end_date) {
                            $destinyUrl .= "&end_date=".$end_date;
                        }
                    } else {
                        $destinyUrl .= "?level=".$level;
                    }

                    if ($title) {
                        $destinyUrl .= "&title=".$title;
                    }
                    if ($discount_id) {
                        $destinyUrl .= "&discount_id=".$discount_id;
                    }
                    if ($package_id) {
                        $destinyUrl .= "&package_id=".$package_id;
                    }

                    $_GET["destiny"] = $destinyUrl;
                }
            }
        } else { //system error
            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=error");
            exit;
        }
    } else {
        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?googleerror=cancel");
        exit;
    }
	if (!$_GET["destiny"]) {
        $_GET["destiny"] = DEFAULT_URL;
    }

    /*
     * Workaround to pin a bookmark without login
     */
    if ($_GET['bookmark_remember']){
        // Sets a cookie to use in font JS
        setcookie('open_bookmark', $_GET['bookmark_remember'], time()+60*60, '/');
    }

    /*
     * Workaround for make a redeem without login
     */
    if ($_GET['redeem_remember']){
        // Sets a cookie to use in font JS
        setcookie('open_redeem', $_GET['redeem_remember'], time()+60*60, '/');
    }

    // Opens modal automatically
    $_SESSION['_sf2_attributes']['modal'] = 1;

	header("Location: ".$_GET["destiny"]);
	exit;
