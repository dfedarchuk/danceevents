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
	# * FILE: /sponsors/resetpassword.php
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
				$urlRedirect = DEFAULT_URL."/".MEMBERS_ALIAS."/account/index.php";
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
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>
    <section class="top-search">

		<? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

		<div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_LABEL_RESET_PASSWORD);?></h1>
                <br>
            </div>
        </div>
    </section>

    <div class="container well well-light">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <? if ($success_message) { ?>
                    <p class="alert alert-info">
                        <?=$success_message;?>
                        <br>
                        <a href="<?=$urlRedirect;?>"><?=system_showText(LANG_BUTTON_MANAGE_ACCOUNT)?></a>
                    </p>
                <? } elseif ($error_message && !$message) { ?>
                    <p class="alert alert-warning"><?=$error_message;?>
                        <br><br>
                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/forgot.php"><?=system_showText(LANG_LABEL_FORGOTPASSWORD);?></a>
                    </p>
                <? } else { ?>

                    <div class="panel panel-theme">
                         <div class="panel-body">
                            <? if ($message) { ?>
                                <p class="alert alert-warning"><?=$message;?></p>
                            <? } ?>

                            <form name="formResetPassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                                    <div class="form-group">
                                        <label><?=system_showText(LANG_LABEL_USERNAME)?>:</label>
                                        <b class="form-control-static"><?=$member_username;?></b>
                                    </div>

                                    <div class="form-group">
                                       <label><?=system_showText(LANG_LABEL_PASSWORD)?>:</label>
                                        <input class="form-control" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" required>
                                        <small class="help-block"><?=system_showText(LANG_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></small>
                                    </div>

                                    <div class="form-group">
                                        <label><?=system_showText(LANG_LABEL_RETYPE_PASSWORD)?>:</label>
                                        <input class="form-control" type="password" name="retype_password" required>
                                    </div>

                                    <hr>
                                    <button class="btn btn-success btn-block" type="submit" value="<?=system_showText(LANG_BUTTON_SUBMIT);?>"><?=system_showText(LANG_BUTTON_SUBMIT);?></button>

                            </form>
                         </div>
                    </div>

                <? } ?>
            </div>
        </div>
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
