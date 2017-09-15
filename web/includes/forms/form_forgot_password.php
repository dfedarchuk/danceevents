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
	# * FILE: /includes/forms/form_forgot_password.php
	# ----------------------------------------------------------------------------------------------------

    if ($section == "sitemgr") { ?>

	<div class="form-login">

        <p class="help-block"><?=LANG_SITEMGR_FORGOOTTEN_PASS_TIP;?></p>

		<? if ($message) { ?>
            <p class="alert alert-<?=($message_class == "successMessage" ? "success" : "warning")?>"><?=$message?></p>
        <? } else { ?>
            <br>
        <? } ?>

        <div class="form-group">
            <input class="form-control" type="email" name="username" value="" placeholder="<?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS)?>" required />
        </div>
        <div class="form-group">
            <button type="submit" value="Send It" class="btn btn-primary btn-block"><?=system_showText(LANG_SITEMGR_SEND_IT);?></button>
            <br>
            <p class="help-block small text-center">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/login.php"><?=system_showText(LANG_SITEMGR_FORGOOTTEN_PASS_3);?></a>
            </p>
        </div>

	</div>

	<? } else { ?>

        <? if ($message_class != "informationMessage") { ?>
        <div class="alert alert-<?=($message_class == "successMessage" ? "success" : "warning")?>">
            <span class="fa fa-<?=($message_class == "successMessage" ? "check" : "warning")?>"></span>
            <span><?=$message?></span>
        </div>
        <? } ?>

        <? if ($message_class != "successMessage") { ?>

        <div class="form-group">
            <label for="fp-email"><?=system_showText(LANG_MSG_TYPE_USERNAME);?></label>
            <input type="email" class="form-control" id="fp-email" name="username" value="" placeholder="<?=system_showText(LANG_LABEL_EMAIL_ADDRESS);?>">
        </div>
        <button type="submit" class="btn btn-success btn-block" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
        <span class="break-sm"></span>

        <? } ?>

	<? } ?>
