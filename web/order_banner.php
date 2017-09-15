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
    # * FILE: /order_banner.php
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
    if (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on") { exit; }
    $banLevelObj = new BannerLevel();
    $banLevelValue = $banLevelObj->getValues();
    if (!in_array($type, $banLevelValue)) {
        header("Location: ".DEFAULT_URL."/".ALIAS_ADVERTISE_URL_DIVISOR."/");
        exit;
    }
    if (sess_getAccountIdFromSession()) {
        $accObj = new Account(sess_getAccountIdFromSession());
        $accObj->changeMemberStatus(true);
        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/banner/banner.php?type=$type");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if (($_SERVER['REQUEST_METHOD'] == "POST")) {

        $_POST["retype_password"] = $_POST["password"];
        $validate_account = validate_addAccount($_POST, $message_account);
        $validate_contact = validate_form("contact", $_POST, $message_contact);
        $validate_banner = validate_form("banner", $_POST, $message_banner);
        $validate_discount = is_valid_discount_code($_POST["discount_id"], "banner", $_POST["id"], $message_discount, $discount_error_num);

        if ($validate_account && $validate_contact && $validate_banner && $validate_discount) {

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

            $banner = new Banner($_POST);
            $banner->setNumber("account_id", $account->getNumber("id"));
            if (!$banner->hasImpressions()) {
                $banner->setNumber("unpaid_impressions", 0);
                $banner->setString("unlimited_impressions", "y");
            } else {
                $banner->setString("unlimited_impressions", "n");
            }

            $banner->Save();

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
            setting_get("sitemgr_banner_email",$sitemgr_banner_email);
            $sitemgr_banner_emails = explode(",",$sitemgr_banner_email);

            // sending e-mail to user //////////////////////////////////////////////////////////////////////////
            if ($emailNotificationObj = system_checkEmail(SYSTEM_BANNER_SIGNUP)) {
                $linkActivation = system_getAccountActivationLink($account->getNumber("id"));
                $subject = $emailNotificationObj->getString("subject");
                $body = $emailNotificationObj->getString("body");
                $login_info = trim(system_showText(LANG_LABEL_USERNAME)).": ".$_POST["username"];
                $login_info .= ($emailNotificationObj->getString("content_type") == "text/html"? "<br />": "\n");
                $login_info .= trim(system_showText(LANG_LABEL_PASSWORD)).": ".$_POST["password"];
                $body = str_replace("ACCOUNT_LOGIN_INFORMATION",$login_info,$body);
                $body = system_replaceEmailVariables($body, $banner->getNumber('id'), 'banner');
                $body = str_replace("LINK_ACTIVATE_ACCOUNT", $linkActivation, $body);
                $subject = system_replaceEmailVariables($subject, $banner->getNumber('id'), 'banner');
                $body = html_entity_decode($body);
                $subject = html_entity_decode($subject);
                Mailer::mail( $contact->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
            }
            ////////////////////////////////////////////////////////////////////////////////////////////////////

            // site manager warning message /////////////////////////////////////
            $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_SIGNUPBANNER);
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />".system_showText(LANG_NOTIFY_SIGNUPBANNER_1)."<br /><br />".system_showText(LANG_LABEL_ACCOUNT).":<br /><br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_USERNAME2).": </strong>".system_showAccountUserName($account->getString("username"))."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_FIRST_NAME).": </strong>".$contact->getString("first_name")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_LAST_NAME).": </strong>".$contact->getString("last_name")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_COMPANY).": </strong>".$contact->getString("company")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_ADDRESS).": </strong>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_CITY).": </strong>".$contact->getString("city")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_STATE).": </strong>".$contact->getString("state")."<br />";
            $sitemgr_msg .= "<strong>".ucfirst(system_showText(ZIPCODE_LABEL)).": </strong>".$contact->getString("zip")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_COUNTRY).": </strong>".$contact->getString("country")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_PHONE).": </strong>".$contact->getString("phone")."<br />";
            $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_EMAIL).": </strong>".$contact->getString("email")."<br />";
            $sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?id=".$account->getNumber("id")."</a><br /><br />";
            $sitemgr_msg .= "".system_showText(LANG_BANNER_FEATURE_NAME).":<br /><br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_CAPTION).": </b>".$banner->getString("caption")."<br />";
            $sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BANNER_FEATURE_FOLDER."/banner.php?id=".$banner->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BANNER_FEATURE_FOLDER."/banner.php?id=".$banner->getNumber("id")."</a><br /><br />";

            setting_get("new_banner_email", $new_banner_email);

            if ($new_banner_email) {
                system_notifySitemgr($sitemgr_account_emails, $emailSubject, $sitemgr_msg, true, "", "", true, $sitemgr_banner_emails);
            }
            ////////////////////////////////////////////////////////////////////////////////////////////////////

            if ($checkout) $payment_method = "checkout";

            sess_registerAccountInSession($account->getString("username"));
            setcookie("username_members", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
            setcookie("automatic_login_members", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

            $host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

            setcookie($host."_DOMAIN_ID_MEMBERS", SELECTED_DOMAIN_ID, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

            setting_get("banner_approve_free", $banner_approve_free);

            if ($payment_method == "checkout" && !$banner_approve_free){
                $banner->setString("status", "A");
                $banner->save();
            }

            if ($payment_method == "checkout") {
                $redirectURL = DEFAULT_URL."/".MEMBERS_ALIAS."/".BANNER_FEATURE_FOLDER."/banner.php?id=".$banner->getNumber("id")."&process=signup";
            } elseif ($payment_method == "invoice") {
                $redirectURL = DEFAULT_URL."/".MEMBERS_ALIAS."/signup/invoice.php";
            } else {
                $redirectURL = DEFAULT_URL."/".MEMBERS_ALIAS."/signup/payment.php?payment_method=".$payment_method;
            }
            header("Location: ".$redirectURL);
            exit;

        } else {
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
    if (!$expiration_setting) $expiration_setting = BANNER_EXPIRATION_RENEWAL_DATE;

    $bannerLevelObj = new BannerLevel();
    $levelValue = $bannerLevelObj->getValues();

    $formloginaction = DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?destiny=".EDIRECTORY_FOLDER."/".MEMBERS_ALIAS."/".BANNER_FEATURE_FOLDER."/banner.php";

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

    $labelName = str_replace("[level]", $bannerLevelObj->showLevel($type), LANG_ADVERTISE_BANNERLEVEL);
    $labelPrice = "";
    $labelPriceRenewal = "";

    $advertiseItem = "banner";

    $hasPackage = false;

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
