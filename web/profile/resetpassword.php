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
    # * FILE: /profile/resetpassword.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSession();

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $accountObj = new Account(sess_getAccountIdFromSession());
        $member_username = $accountObj->getString("username");

        if ($_POST["password"]) {
            if (validate_MEMBERS_account($_POST, $message, sess_getAccountIdFromSession())) {
                $accountObj->setString("password", $_POST["password"]);
                $accountObj->updatePassword();
                $success_message = system_showText(LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED);
                $urlRedirect = SOCIALNETWORK_URL."/edit.php";
            }
        } else {
            $message = system_showText(LANG_MSG_PASSWORD_IS_REQUIRED);
        }

    }

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    if ($_GET["key"]) {

        $forgotPasswordObj = new forgotPassword($_GET["key"]);

        if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "members")) {

            $accountObj = new Account($forgotPasswordObj->getString("account_id"));
            $member_username = $accountObj->getString("username");

            $forgotPasswordObj->Delete();

            if (!$member_username) {
                $error_message = system_showText(LANG_MSG_WRONG_ACCOUNT);
            }

        } else {
            $error_message = system_showText(LANG_MSG_WRONG_KEY);
        }

    } else {
        $error_message = system_showText(LANG_MSG_WRONG_KEY);
    }

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = system_showText(LANG_LABEL_RESET_PASSWORD);
    include(EDIRECTORY_ROOT."/frontend/header.php");

    ?>

    <main>

        <div class="container well well-light">

            <div class="row">

                <div class="col-md-6">
                    <div class="panel panel-theme">
                        <div class="panel-heading">
                            <h2><?=system_showText(LANG_LABEL_RESET_PASSWORD);?></h2>
                        </div>
                        <div class="panel-body">
                            <form role="form" class="form" name="formResetPassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                                <? if ($success_message) { ?>

                                    <div class="alert alert-success">
                                        <span class="fa fa-check">
                                            <?=$success_message;?>
                                            <a href="<?=$urlRedirect;?>"><?=system_showText(LANG_BUTTON_MANAGE_ACCOUNT)?></a>
                                        </span>
                                    </div>

                                <? } elseif ($error_message && !$message) { ?>

                                    <div class="alert alert-danger">
                                        <span class="fa fa-times">
                                            <?=$error_message;?><br>
                                            <a href="<?=DEFAULT_URL?>/<?=SOCIALNETWORK_FEATURE_NAME?>/forgot.php"><?=system_showText(LANG_LABEL_FORGOTPASSWORD);?></a>
                                        </span>
                                    </div>

                                <? } else {

                                    if ($message) { ?>
                                        <div class="alert alert-danger">
                                            <span class="fa fa-times">
                                                <?=$message;?>
                                            </span>
                                        </div>
                                    <? } ?>

                                <div class="form-group">
                                    <label for="np-password"><?=system_showText(LANG_LABEL_PASSWORD)?></label>
                                    <input type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" required class="form-control" id="np-password">
                                </div>
                                <div class="form-group">
                                    <label for="np-passwordretype"><?=system_showText(LANG_LABEL_RETYPE_PASSWORD)?></label>
                                    <input type="password" name="retype_password" required class="form-control" id="np-passwordretype">
                                </div>
                                <button type="submit" class="btn btn-success btn-block" type="submit" value="<?=system_showText(LANG_BUTTON_SUBMIT);?>"><?=system_showText(LANG_BUTTON_SUBMIT);?></button>
                                <br>

                                <? } ?>

                            </form>
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