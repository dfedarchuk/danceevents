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
    # * FILE: /order_event.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("./conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSessionFront();

    extract($_POST);
    extract($_GET);

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }
    $evLevelObj = new EventLevel();
    $evLevelValue = $evLevelObj->getValues();
    if (!in_array($level, $evLevelValue)) {
        header("Location: ".DEFAULT_URL."/".ALIAS_ADVERTISE_URL_DIVISOR."/");
        exit;
    }
    if (sess_getAccountIdFromSession()) {
        $accObj = new Account(sess_getAccountIdFromSession());
        $accObj->changeMemberStatus(true);
        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/".EVENT_FEATURE_FOLDER."/event.php?level=$level");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if (($_SERVER['REQUEST_METHOD'] == "POST")) {

        $_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
        $_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
        $_POST["friendly_url"] = trim($_POST["friendly_url"]);
        $_POST["friendly_url"] = system_denyInjections($_POST["friendly_url"]);

        if (!$_POST["friendly_url"]) {
            system_generateFriendlyURL($_POST["title"]);
        }

        $sqlFriendlyURL = "";
        $sqlFriendlyURL .= "SELECT friendly_url FROM Event WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." LIMIT 1";

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObjFriendlyURL = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
        if (mysql_num_rows($resultFriendlyURL) > 0) {
            $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
        }

        $friendly_url = $_POST["friendly_url"];

        $_POST["start_date"] = system_denyInjections($_POST["start_date"]);
        $start_date = $_POST["start_date"];
        $_POST["end_date"] = system_denyInjections($_POST["end_date"]);
        $end_date = $_POST["end_date"];
        $_POST["retype_password"] = $_POST["password"];

        $validate_account = validate_addAccount($_POST, $message_account);
        $validate_contact = validate_form("contact", $_POST, $message_contact);
        $tmpEMAIL = $_POST["email"];
        unset($_POST["email"]);

        $validate_event = validate_form("event", $_POST, $message_event);
        $_POST["email"] = $tmpEMAIL;
        $validate_discount = is_valid_discount_code($_POST["discount_id"], "event", $_POST["id"], $message_discount, $discount_error_num);

        if ($validate_account && $validate_contact && $validate_event && $validate_discount) {

            $account = new Account($_POST);
            $account->save();

            $account->changeMemberStatus(true);

            $contact = new Contact($_POST);
            $contact->setNumber("account_id", $account->getNumber("id"));
            $contact->save();

            $profileObj = new Profile($account->getNumber("id"));
            $profileObj->setNumber("account_id", $account->getNumber("id"));
            if (!$profileObj->getString("nickname")) {
                $profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
            }
            $profileObj->Save();

            $accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
            $accDomain->Save();
            $accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

            if ($_POST["newsletter"]) {
                $_POST["name"] = $_POST["first_name"]." ".$_POST["last_name"];
                $_POST["type"] = "sponsor";
                arcamailer_addSubscriber($_POST, $success, $account->getNumber("id"));
            }

            unset($_POST["email"]);
            unset($_POST["phone"]);
            unset($_POST["address"]);
            $event = new Event($_POST);
            $event->setNumber("account_id", $account->getNumber("id"));
            $status = new ItemStatus();
            $event->setString("status", $status->getDefaultStatus());
            $event->setDate("renewal_date", "00/00/0000");
            $event->Save();

            /**************************************************************************************************/
            /*                                                                                                */
            /* E-mail notify                                                                                  */
            /*                                                                                                */
            /**************************************************************************************************/
            setting_get("sitemgr_send_email",$sitemgr_send_email);
            setting_get("sitemgr_email",$sitemgr_email);
            $sitemgr_emails = explode(",",$sitemgr_email);
            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
            setting_get("sitemgr_account_email",$sitemgr_account_email);
            $sitemgr_account_emails = explode(",",$sitemgr_account_email);
            setting_get("sitemgr_event_email",$sitemgr_event_email);
            $sitemgr_event_emails = explode(",",$sitemgr_event_email);

            // sending e-mail to user //////////////////////////////////////////////////////////////////////////
            if ($emailNotificationObj = system_checkEmail(SYSTEM_EVENT_SIGNUP)) {
                $linkActivation = system_getAccountActivationLink($account->getNumber("id"));
                $subject = $emailNotificationObj->getString("subject");
                $body = $emailNotificationObj->getString("body");
                $login_info = trim(system_showText(LANG_LABEL_USERNAME)).": ".$_POST["username"];
                $login_info .= ($emailNotificationObj->getString("content_type") == "text/html"? "<br />": "\n");
                $login_info .= trim(system_showText(LANG_LABEL_PASSWORD)).": ".$_POST["password"];
                $body = str_replace("ACCOUNT_LOGIN_INFORMATION",$login_info,$body);
                $body = system_replaceEmailVariables($body, $event->getNumber('id'), 'event');
                $body = str_replace("LINK_ACTIVATE_ACCOUNT", $linkActivation, $body);
                $subject = system_replaceEmailVariables($subject, $event->getNumber('id'), 'event');
                $body = html_entity_decode($body);
                $subject = html_entity_decode($subject);
                Mailer::mail( $contact->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
            }
            ////////////////////////////////////////////////////////////////////////////////////////////////////

            /// site manager warning message /////////////////////////////////////
            $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_SIGNUPEVENT);
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />".system_showText(LANG_NOTIFY_SIGNUPEVENT_1)."<br /><br />".system_showText(LANG_LABEL_ACCOUNT).":<br /><br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_USERNAME2).": </b>".system_showAccountUserName($account->getString("username"))."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_FIRST_NAME).": </b>".$contact->getString("first_name")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_LAST_NAME).": </b>".$contact->getString("last_name")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_COMPANY).": </b>".$contact->getString("company")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_ADDRESS).": </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_CITY).": </b>".$contact->getString("city")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_STATE).": </b>".$contact->getString("state")."<br />";
            $sitemgr_msg .= "<b>".ucfirst(system_showText(ZIPCODE_LABEL)).": </b>".$contact->getString("zip")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_COUNTRY).": </b>".$contact->getString("country")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_PHONE).": </b>".$contact->getString("phone")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_EMAIL).": </b>".$contact->getString("email")."<br />";
            $sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?id=".$account->getNumber("id")."</a><br /><br />";
            $sitemgr_msg .= "".system_showText(LANG_EVENT_FEATURE_NAME).":<br /><br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_TITLE).": </b>".$event->getString("title")."<br />";
            $sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/event.php?id=".$event->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/event.php?id=".$event->getNumber("id")."</a><br /><br />";

            setting_get("new_event_email",$new_event_email);

            if ($new_event_email) {
                system_notifySitemgr($sitemgr_account_emails, $emailSubject, $sitemgr_msg, true, "", "", true, $sitemgr_event_emails);
            }
            ////////////////////////////////////////////////////////////////////////////////////////////////////

            if ($checkout) $payment_method = "checkout";

            sess_registerAccountInSession($account->getString("username"));
            setcookie("username_members", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
            setcookie("automatic_login_members", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");


            $host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

            setcookie($host."_DOMAIN_ID_MEMBERS", SELECTED_DOMAIN_ID, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

            //Check if a package was bought
            $queryPackage = "";

            if ($_POST["using_package"] == "y") {

                //Check if exists package
                $packageObj = new Package();
                $array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "event", $event->level);

                if ((is_array($array_package_offers)) and (count($array_package_offers) > 0) and $array_package_offers[0]) {

                    unset($array_info_package);
                    $array_info_package["item_type"]		= "event";
                    $array_info_package["item_id"]			= $event->getNumber("id");
                    $array_info_package["item_name"]		= $event->getString("title");
                    $array_info_package["item_friendly_ur"]	= $event->getString("friendly_url");
                    $array_info_package["package_id"][0]	= $aux_package_id;
                    $package_id = package_buying_package($array_info_package, true);
                    $queryPackage = "&ispackage=true&package_id=$package_id";

                }
            }

            setting_get("event_approve_free", $event_approve_free);

            if ($payment_method == "checkout" && !$event_approve_free){
                $event->setString("status", "A");
                $event->save();
            }

            if ($payment_method == "checkout") {
                $redirectURL = DEFAULT_URL."/".MEMBERS_ALIAS."/".EVENT_FEATURE_FOLDER."/event.php?id=".$event->getNumber("id")."&process=signup";
            } elseif ($payment_method == "invoice") {
                $redirectURL = DEFAULT_URL."/".MEMBERS_ALIAS."/signup/invoice.php".($queryPackage ? "?".$queryPackage : "");
            } else {
                $redirectURL = DEFAULT_URL."/".MEMBERS_ALIAS."/signup/payment.php?payment_method=".$payment_method.$queryPackage;
            }
            header("Location: ".$redirectURL);
            exit;

        } else {

            if (($pos = string_strrpos($_POST["friendly_url"], FRIENDLYURL_SEPARATOR)) !== false) {
                $_POST["friendly_url"] = string_substr($_POST["friendly_url"], 0, $pos);
            }

            // removing slashes added if required
            $_POST = format_magicQuotes($_POST);
            $_GET  = format_magicQuotes($_GET);
            extract($_POST);
            extract($_GET);
        }

    }

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    $eventLevelObj = new EventLevel();
    $levelValue = $eventLevelObj->getValues();

    $formloginaction = DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?destiny=".EDIRECTORY_FOLDER."/".MEMBERS_ALIAS."/".EVENT_FEATURE_FOLDER."/event.php";

    /*
     * TAX SECTION
     */
    setting_get("payment_tax_status", $payment_tax_status);
    setting_get("payment_tax_value", $payment_tax_value);
    customtext_get("payment_tax_label", $payment_tax_label);

    unset($googleEnabled, $facebookEnabled);

    setting_get("foreignaccount_google", $foreignaccount_google);
    if ($foreignaccount_google == "on") {
        $googleEnabled = true;
    }

    if (FACEBOOK_APP_ENABLED == "on") {
        $facebookEnabled = true;
    }

    $unique_id = system_generatePassword();

    $checkoutpayment_class = "isHidden";
    $checkoutfree_class = "isHidden";

    $labelName = str_replace("[level]", $eventLevelObj->showLevel($level), LANG_ADVERTISE_EVENTLEVEL);

    $advertiseItem = "event";

    //Check if exists package
    $packageObj = new Package();
    $array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "event", $level);
    $hasPackage = false;
    if ((is_array($array_package_offers)) && (count($array_package_offers) > 0) && $array_package_offers[0]) {
        $hasPackage = true;
    }
    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = $headertagtitle;
    $headertag_description = $headertagdescription;
    $headertag_keywords = $headertagkeywords;
    include(EDIRECTORY_ROOT."/frontend/header.php");

    ?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_MENU_ADVERTISE);?></h1>
                <br>
            </div>
        </div>
    </section>

    <main>
        <section class="block">
            <div class="container">
                <div class="well">
                    <?php include(INCLUDES_DIR."/forms/form_advertise.php"); ?>
                </div>
            </div>
        </section>
    </main>

<?php
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/frontend/footer.php");
