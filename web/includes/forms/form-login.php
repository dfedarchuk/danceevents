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
	# * FILE: /includes/forms/form-login.php
	# ----------------------------------------------------------------------------------------------------

?>

    <input type="hidden" name="destiny" value="<?=$destiny?>" />
    <input type="hidden" name="query" value="<?=urlencode($query)?>" />

    <?

    $style = ($message_login) ? "display:visible;" : "display:none;";

    $defaultusername = $username;
    $defaultpassword = "";
    if (DEMO_MODE) {
        $defaultusername = "sitemgr@demodirectory.com";
        $defaultpassword = "abc123";
    }

    if ($message_login) { ?>
        <p class="alert alert-warning" style="<?=$style?>"><?=$message_login?></p>
    <? } ?>

    <div class="form-box">
        <br>
        <div class="form-group">
            <input class="form-control" type="email" name="username" id="username" value="<?=$defaultusername?>" placeholder="<?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS);?>">
        </div>

        <div class="form-group">
            <input class="form-control" type="password" name="password" id="password" value="<?=$defaultpassword?>" placeholder="<?=system_showText(LANG_LABEL_PASSWORD);?>">
            <div class="row">
                <p class="col-xs-6 help-block small">
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/forgot.php" rel="nofollow"><?=system_showText(LANG_SITEMGR_FORGOTPASS_FORGOTYOURPASSWORD)?></a>
                </p>
                <? if (DEMO_MODE) { ?>
                    <p class="col-xs-6 text-right help-block text-info small">Test Password: abc123</p>
                <? } ?>
            </div>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="automatic_login" value="1" <?=$checked?> />
                <?=system_showText(LANG_AUTOLOGIN);?>
            </label>
        </div>
        <br>
        <button type="submit"  class="btn btn-primary btn-block"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
    </div>
