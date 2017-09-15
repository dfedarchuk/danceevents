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
    # * FILE: /claim.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("./conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # MAINTENANCE MODE
    # ----------------------------------------------------------------------------------------------------
    verify_maintenanceMode();

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (CLAIM_FEATURE != "on") {
        exit;
    }

    if ($_GET["claim"]) {
        $db = db_getDBObject();
        $sql = "SELECT Listing.id as id FROM Listing WHERE Listing.friendly_url = " . db_formatString($_GET["claim"]) . " LIMIT 1";
        $result = $db->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["claimlistingid"] = $aux["id"];
        if (!$_GET["claimlistingid"]) {
            header("Location: " . LISTING_DEFAULT_URL . "/");
            exit;
        }
    }

    extract($_POST);
    extract($_GET);

    $listingObject = new Listing($claimlistingid);
    if (!$listingObject->getNumber("id") || $listingObject->getNumber("id") <= 0 || is_numeric($listingObject->getNumber("account_id")) || $listingObject->getString("claim_disable") != "n") {
        header("Location: ".LISTING_DEFAULT_URL."/");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if (($_SERVER['REQUEST_METHOD'] == "POST")) {

        $_POST["retype_password"] = $_POST["password"];

        $validate_account = validate_addAccount($_POST, $message_account);
        $validate_contact = validate_form("contact", $_POST, $message_contact);

        if ($validate_account && $validate_contact) {

            $account = new Account($_POST);
            $account->save();

            if ($_POST["claim"]) {
                $account->changeMemberStatus(true);
            }

            if ($_POST["newsletter"]) {
                $_POST["name"] = $_POST["first_name"]." ".$_POST["last_name"];
                $_POST["type"] = "sponsor";
                arcamailer_addSubscriber($_POST, $success, $account->getNumber("id"));
            }

            $contact = new Contact($_POST);
            $contact->setNumber("account_id", $account->getNumber("id"));
            $contact->save();

            $profileObj = new Profile(sess_getAccountIdFromSession());
            $profileObj->setNumber("account_id", $account->getNumber("id"));
            if (!$profileObj->getString("nickname")) {
                $profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
            }
            $profileObj->Save();

            $accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
            $accDomain->Save();
            $accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

            /**************************************************************************************************/
            /*                                                                                                */
            /* E-mail notify                                                                                  */
            /*                                                                                                */
            /**************************************************************************************************/

            // sending e-mail to user //////////////////////////////////////////////////////////////////////////
            if ($emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_SIGNUP)) {

                $linkActivation = system_getAccountActivationLink($account->getNumber("id"));

                $subject = $emailNotificationObj->getString("subject");
                $body = $emailNotificationObj->getString("body");
                $body = str_replace("ACCOUNT_NAME",$contact->getString("first_name").' '.$contact->getString("last_name"),$body);
                $login_info = trim(system_showText(LANG_LABEL_USERNAME)).": ".$_POST["username"];
                $login_info .= ($emailNotificationObj->getString("content_type") == "text/html"? "<br />": "\n");
                $login_info .= trim(system_showText(LANG_LABEL_PASSWORD)).": ".$_POST["password"];
                $body = str_replace("ACCOUNT_LOGIN_INFORMATION",$login_info, $body);
                $body = str_replace("LINK_ACTIVATE_ACCOUNT", $linkActivation, $body);
                $body = system_replaceEmailVariables($body, $listingObject->getNumber('id'), 'listing');
                $subject = system_replaceEmailVariables($subject, $listingObject->getNumber('id'), 'listing');
                $body = html_entity_decode($body);
                $subject = html_entity_decode($subject);
                $error = false;

                Mailer::mail( $contact->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );

            }
            ////////////////////////////////////////////////////////////////////////////////////////////////////

            sess_registerAccountInSession($account->getString("username"));
            setcookie("username_members", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
            exit;

        } else {
            // removing slashes added if required
            $_POST = format_magicQuotes($_POST);
            $_GET  = format_magicQuotes($_GET);
            extract($_POST);
            extract($_GET);
        }

    }

    unset($loginTypes, $facebookEnabled, $googleEnabled, $cUserEnabled);

    setting_get("foreignaccount_google", $foreignaccount_google);
    if ($foreignaccount_google == "on") {
        $googleEnabled = true;
    }

    if (FACEBOOK_APP_ENABLED == "on") {
        $facebookEnabled = true;
    }

    if (sess_isAccountLogged() && SOCIALNETWORK_FEATURE == "on") {
        $cUserEnabled = true;
    }

    $loginTypes	.= "formNewUser,";
    $loginTypes	.= "formDirectoryUser,";
    if ($googleEnabled) {
        $loginTypes	.= "formGoogleUser,";
    }
    if ($facebookEnabled) {
        $loginTypes	.= "formFacebookUser,";
    }
    if ($cUserEnabled) {
        $loginTypes	.= "formCurrentUser,";
    }
    $loginTypes	= string_substr($loginTypes, 0, -1);

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = (($listingObject->getString("seo_title")) ? ($listingObject->getString("seo_title")) : ($listingObject->getString("title")))." - ".system_showText(LANG_LISTING_CLAIMTHIS);
    $headertag_description = (($listingObject->getString("seo_description")) ? ($listingObject->getString("seo_description")) : ($listingObject->getString("description")));
    $headertag_keywords = (($listingObject->getString("seo_keywords")) ? ($listingObject->getString("seo_keywords")) : (str_replace(" || ", ", ", $listingObject->getString("keywords"))));
    include(EDIRECTORY_ROOT."/frontend/header.php");

?>
    <div class="block-container first block-bg-image well-translucid">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="container">
            <div class="space-content">
                <h1><?=system_showText(LANG_LISTING_CLAIMING);?> <q><?=$listingObject->getString("title");?></q></h1>
                <div class="well well-translucid">
                    <?=string_strtoupper(system_showText(LANG_EASYANDFAST));?> <span><?=string_strtoupper(system_showText(LANG_THREESTEPS))?></span>
                </div>
            </div>
        </div>

    </div>

    <main>

        <div class="container well well-light">

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <ol class="breadcrumb breadcrumb-steps">
                        <li class="active"><strong>1:</strong> <?=system_showText(LANG_ACCOUNTSIGNUP)?></li>
                        <li><strong>2:</strong> <?=system_showText(LANG_LISTINGUPDATE)?></li>
                        <li><strong>3:</strong> <?=system_showText(LANG_CHECKOUT)?></li>
                    </ol>
                </div>
            </div>

            <div class="row" id="claim_login" style="display:none">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-theme">
                        <div class="panel-heading">
                            <h2><?=system_showText(LANG_LABEL_LOGIN);?></h2>
                        </div>
                        <div class="panel-body">

                            <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {

                                if (FACEBOOK_APP_ENABLED == "on") {
                                    $fbLabel = system_showText(LANG_LOGINFACEBOOKUSER);
                                    $urlRedirect = "?claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                    unset($fbLabel);
                                }

                                if ($foreignaccount_google == "on") {
                                    $goLabel = system_showText(LANG_LOGINGOOGLEUSER);
                                    $urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                    unset($goLabel);
                                } ?>

                                <p><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>

                            <? } ?>

                            <form role="form" class="form" name="formDirectory" method="post" action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/login.php?destiny=<?=EDIRECTORY_FOLDER?>/<?=MEMBERS_ALIAS?>/claim/getlisting.php&amp;query=claimlistingid=<?=$claimlistingid?>">
                                <input type="hidden" name="claim" value="yes" />
                                <?
                                $members_section = true;
                                include(INCLUDES_DIR."/forms/form_login.php"); ?>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="javascript:void(0);" onclick="$('#claim_login').css('display', 'none'); $('#claim_signup').fadeIn(500);" class="btn btn-default"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="claim_signup">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-theme">
                        <div class="panel-heading">
                            <h2><?=system_showText(LANG_BUTTON_SIGNUP);?></h2>
                        </div>
                        <div class="panel-body">

                            <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {

                                if (FACEBOOK_APP_ENABLED == "on") {
                                    $fbLabel = system_showText(LANG_SIGNUPFACEBOOKUSER);
                                    $urlRedirect = "?claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                    unset($fbLabel);
                                }

                                if ($foreignaccount_google == "on") {
                                    $goLabel = system_showText(LANG_SIGNUPGOOGLEUSER);
                                    $urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                    unset($goLabel);
                                } ?>

                                <p><?=system_showText(LANG_OR_SIGNUPEMAIL);?></p>

                            <? } ?>

                            <form role="form" class="form" name="signup_claim" method="post" action="<?=system_getFormAction($_SERVER["REQUEST_URI"])?>">
                                <input type="hidden" name="claim" value="true" />
                                <input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>" />
                                <?
                                $claimSection = true;
                                include(INCLUDES_DIR."/forms/form_addaccount.php");
                                ?>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="javascript:void(0);" onclick="$('#claim_signup').css('display', 'none'); $('#claim_login').fadeIn(500);" class="btn btn-default"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

<?


    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/frontend/footer.php");
