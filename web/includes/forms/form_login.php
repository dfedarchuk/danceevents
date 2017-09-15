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
	# * FILE: /includes/forms/form_login.php
	# ----------------------------------------------------------------------------------------------------

    if (!$advertise_section) { ?>

        <input type="hidden" name="destiny" value="<?=$destiny?>" />
        <input type="hidden" name="query" value="<?=urlencode($query)?>" />

    <? }

    $style = ($message_login) ? "display:visible;" : "display:none;";

    $defaultusername = $username;
    $defaultpassword = "";
    if (DEMO_MODE) {
        if ($members_section || $advertise_section) {

            if (string_strpos($_SERVER["PHP_SELF"], "/".SOCIALNETWORK_FEATURE_NAME."/login.php") !== false) {
                $defaultusername = "profile@demodirectory.com";
                $defaultpassword = "abc123";
                $forgotLink = DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/forgot.php";
            } else {
                $defaultusername = "demo@demodirectory.com";
                $defaultpassword = "abc123";
            }

        } elseif ($sitemgr_section) {
            $defaultusername = "sitemgr@demodirectory.com";
            $defaultpassword = "abc123";
        }
    }

    if (string_strpos($_SERVER["PHP_SELF"], "/".SOCIALNETWORK_FEATURE_NAME."/login.php") !== false) {
        $forgotLink = DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/forgot.php";
    } else {
        $forgotLink = DEFAULT_URL."/".MEMBERS_ALIAS."/forgot.php";
    }

    if ($aux_modal_box) {

        if ($message_login) { ?>
            <p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>" style="<?=$style?>"><?=$message_login?></p>
        <? } ?>

		<div>
			<label for="username"><?=system_showText(LANG_LABEL_USERNAME);?>:</label>
			<input class="text" type="email" name="username" id="username" value="<?=$defaultusername?>" />
		</div>

		<div>
			<label for="password"><?=system_showText(LANG_LABEL_PASSWORD);?>:</label>
			<input class="text" type="password" name="password" id="password" value="<?=$defaultpassword?>" />
		</div>

		<? if ($automatically !== false) { ?>
		<div class="labelcheckbox">
			<label >
				<input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="checkbox" style="float:left;" />
				<?=system_showText(LANG_AUTOLOGIN);?>
			</label>
		</div>
		<? } ?>

		<button type="submit"><?=system_showText(LANG_BUTTON_LOGIN);?></button>

	<? } elseif (!$sitemgr_section) { ?>

        <? if ($message_login) { ?>
            <br>
            <div class="alert alert-warning"><?=$message_login?></div>
        <? } ?>

        <div class="form-group">
            <label for="<?=$advertise_section ? "dir_" : ""?>username"><?=system_showText(LANG_LABEL_USERNAME);?></label>
            <input class="form-control" type="email" name="<?=$advertise_section ? "dir_" : ""?>username" id="<?=$advertise_section ? "dir_" : ""?>username" value="<?=$defaultusername?>" placeholder="<?=system_showText(LANG_LABEL_EMAIL_ADDRESS);?>">
        </div>
        <div class="form-group">
            <label for="<?=$advertise_section ? "dir_" : ""?>password"><?=system_showText(LANG_LABEL_PASSWORD);?></label>
            <input type="password" class="form-control" name="<?=$advertise_section ? "dir_" : ""?>password" id="<?=$advertise_section ? "dir_" : ""?>password" value="<?=$defaultpassword?>" >
        </div>
            <? if ($automatically !== false) { ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="automatic_login" value="1" <?=$checked?>>
                    <?=system_showText(LANG_AUTOLOGIN);?>
                </label>
            </div>
            <? } ?>
            <div class="row">
                <div class="col-sm-6">
                    <? if (system_checkEmail(SYSTEM_FORGOTTEN_PASS)) { ?>
                        <a href="<?=$forgotLink;?>" rel="nofollow"><?=system_showText(LANG_LABEL_FORGOTPASSWORD);?></a>
                    <? }
                    if (DEMO_MODE) { ?> <br><small><?=system_showText(LANG_LABEL_TESTPASSWORD)?>: <b>abc123</b> </small><? } ?>
                    <span class="break-sm"></span>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-success btn-block" <?=($advertise_section ? "type=\"button\"  onclick=\"submitForm('formDirectory');\"" : "type=\"submit\"")?>><?=system_showText(LANG_BUTTON_LOGIN);?></button>
                </div>
            </div>

	<? } else { ?>

		<div class="form-login">

			<h2><?=system_showText(LANG_SITEMGR_LOGIN_ACCOUNT);?></h2>

			<? if ($message_login) { ?>
                <p class="errorMessage" style="<?=$style?>"><?=$message_login?></p>
            <? } ?>

			<div class="form-box">

				<div>
					<input type="email" name="username" id="username" value="<?=$defaultusername?>" placeholder="<?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS);?>" />
				</div>

				<div>
					<input type="password" name="password" id="password" value="<?=$defaultpassword?>" placeholder="<?=system_showText(LANG_LABEL_PASSWORD);?>" />
				</div>

				<? if (DEMO_MODE) { ?>
                    <div class="text-center warning">Test Password: abc123</div>
                <? } ?>

				<? if ($automatically !== false) { ?>
                    <label class="automaticLogin">
                        <?=system_showText(LANG_AUTOLOGIN);?>
                        <input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="inputAuto" />
                    </label>
				<? } ?>

            	<button type="submit" class="stmgr-btn success"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
			</div>

            <p class="linkLogin">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/forgot.php" rel="nofollow"><?=system_showText(LANG_SITEMGR_FORGOTPASS_FORGOTYOURPASSWORD)?></a>
			</p>

		</div>
	<? } ?>
