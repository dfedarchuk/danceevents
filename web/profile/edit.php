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
    # * FILE: /profile/edit.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # MAINTENANCE MODE
    # ----------------------------------------------------------------------------------------------------
    verify_maintenanceMode();

    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

    if (SOCIALNETWORK_FEATURE == "off") { exit; }

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSessionFront();

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/profile.php");
    if (MAIL_APP_FEATURE == "on") {
        arcamailer_checkSubscriber();
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    // Default CSS class for message box
    $message_style = "warning";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $validate_demodirectoryDotCom = true;
        if (DEMO_LIVE_MODE) {
            $validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
        }

        if ($validate_demodirectoryDotCom) {
            if (SOCIALNETWORK_FEATURE == "off") {
                $_POST["publish_contact"] = "n";
            } else {
                if ($_POST["publish_contact"] == "on") {
                    $_POST["publish_contact"] = "y";
                } else {
                    $_POST["publish_contact"] = "n";
                }
            }

            if ((string_strlen($_POST["password"])) || (string_strlen($_POST["retype_password"]))) {
                $validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
            } else {
                $validate_membercurrentpassword = true;
            }

            $account = new Account($account_id);
            $validate_account = validate_MEMBERS_account($_POST, $message_account, sess_getAccountIdFromSession());
            $validate_contact = validate_form("contact", $_POST, $message_contact);

            if ($validate_membercurrentpassword && $validate_account && $validate_contact && !$message_profile) {
                $account = new Account($account_id);
                $lastNewsletter = $account->getString("newsletter");

                $notifyUser = false;
                if ($_POST["password"]) {
                    $notifyUser = true;
                    $account->setString("password", $_POST["password"]);
                    $account->updatePassword();
                }
                if ($_POST["username"]) {
                    if ($account->getString("username") != $_POST["username"]) {
                        $notifyUser = true;
                    }
                    $account->setString("username", $_POST["username"]);
                }
                $account->setString("publish_contact", $_POST["publish_contact"]);

                if ($_POST["newsletter"]) {
                    $actualNewsletter = "y";
                } else {
                    $actualNewsletter = "n";
                }

                $account->setString("newsletter", $actualNewsletter);
                $account->Save();

                $contact = new Contact($_POST);
                $contact->Save();

                if ($actualNewsletter != $lastNewsletter) {

                    //Subscribe
                    if ($actualNewsletter == "y") {

                        $fields["name"] = $contact->getString("first_name")." ".$contact->getString("last_name");
                        $fields["type"] = "profile";
                        $fields["email"] = $contact->getString("email");
                        arcamailer_addSubscriber($fields, $success, $account->getNumber("id"));

                        //Unsubscribe
                    } else {
                        arcamailer_Unsubscribe($contact->getString("email"), $account->getNumber("id"));
                    }

                }

                $accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
                $accDomain->Save();
                $accDomain->saveOnDomain($account->getNumber("id"), $account, $contact);

                if (system_checkEmail(SYSTEM_VISITOR_ACCOUNT_UPDATE) && $_POST["tab"] == "tab_2" && $notifyUser) {
                    system_sendPassword(SYSTEM_VISITOR_ACCOUNT_UPDATE, $_POST["email"], $_POST["username"], $_POST["password"], $_POST["first_name"]." ".$_POST["last_name"]);
                }

                $message = system_showText(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED);
                $message_style = "success";
            } else {
                $message = "";
                $message_style = "";
            }
        } else {
            $message = "";
            $message_style = "";
        }

        // removing slashes added if required
        $_POST = format_magicQuotes($_POST);
        $_GET  = format_magicQuotes($_GET);

        extract($_GET);
        extract($_POST);
    }

    # ----------------------------------------------------------------------------------------------------
    # MODE REWRITE
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/mod_rewrite.php");

    unset($info);
    $info = socialnetwork_retrieveInfoProfile($id);

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    extract($_GET);
    extract($_POST);

    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------
    if (sess_getAccountIdFromSession()) {
        $accountObj = new Account(sess_getAccountIdFromSession());
        $contactObj = new Contact(sess_getAccountIdFromSession());
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $accountObj->extract();
            $contactObj->extract();
        }
    } else {
        header("Location: ".DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/index.php");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = $headertagtitle;
    $headertag_description = $headertagdescription;
    $headertag_keywords = $headertagkeywords;
    include(EDIRECTORY_ROOT."/frontend/header.php");

    # ----------------------------------------------------------------------------------------------------
    # BODY
    # ----------------------------------------------------------------------------------------------------
    ?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_JOIN_PROFILE);?></h1>
                <br>
            </div>
        </div>
    </section>

    <main>

        <section class="block">
            <?php

            if ($_GET["id"]) {
                $account = $_GET["id"];
            } else {
                $account = sess_getAccountIdFromSession();
            }

                $account = new Account($account);
                $contactObj = new Contact($account->getNumber("id"));
            ?>

            <div class="container">
                <? if ($account->getString("is_sponsor") == "n") { ?>

                    <ul class="nav nav-tabs nav-justified">

                        <li id="tab_1" class="<?=($tab == "tab_1" || !$tab) ? "active" : ""?>">
                            <a href="<?=SOCIALNETWORK_URL?>/edit.php?tab=tab_1"><?=system_showText(LANG_LABEL_PERSONAL_PAGE)?></a>
                        </li>

                        <li id="tab_2" class="<?=($tab == "tab_2") ? "active" : ""?>">
                            <a href="<?=SOCIALNETWORK_URL?>/edit.php?tab=tab_2"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS)?></a>
                        </li>

                    </ul>

                <? } ?>

                <div class="well">

                    <?php

                    include(INCLUDES_DIR."/forms/form_members_messages.php");

                    if (!$contactObj->getString("email")) { ?>
                        <p class="alert alert-warning"><?=system_showText(LANG_MSG_FOREIGNACCOUNTWARNING);?></p>
                    <? } ?>


                    <form name="account" id="account" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">

                        <input type="hidden" name="tab" id="tab" value="<?=$tab ? $tab: "tab_1";?>" />
                        <input type="hidden" name="account_id" value="<?=$account_id?>" />

                        <?
                        $accountID = sess_getAccountIdFromSession();
                        ?>
                        <div id="cont_tab_1" style="<?=($tab == 'tab_1' || !$tab) ? '' : 'display:none'?>">

                            <? include(INCLUDES_DIR."/forms/form_profile.php"); ?>
                            <hr>
                            <br>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit" value="Submit"><?=system_showText(LANG_SAVE_CHANGES)?></button>
                            </div>
                            <br>
                        </div>

                        <div id="cont_tab_2" style="<?=($tab == 'tab_2') ? '' : 'display:none'?>">

                            <? include(INCLUDES_DIR."/forms/form_account_members.php"); ?>
                            <? include(INCLUDES_DIR."/forms/form_contact_members.php"); ?>
                            <hr>
                            <br>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit" value="Submit"><?=system_showText(LANG_SAVE_CHANGES)?></button>
                            </div>
                            <br>

                        </div>

                    </form>

                </div>
            </div>
        </section>

    </main>

    <?php
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/frontend/footer.php");
