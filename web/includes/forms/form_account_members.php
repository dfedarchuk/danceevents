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
	# * FILE: /includes/forms/form_account_members.php
	# ----------------------------------------------------------------------------------------------------

    $accountID = sess_getAccountIdFromSession();

    $readonly = "";
    if (DEMO_LIVE_MODE && ($username == "demo@demodirectory.com")) {
        $readonly = "readonly";
    }

    $isForeignAcc = false;

    if ((string_strpos($username, "facebook::") !== false || string_strpos($username, "google::") !== false)) {
        $isForeignAcc = true;
    }

    $dropdown_protocol = html_protocolDropdown($url, "url_protocol", false, $protocol_replace);

    if ((string_strpos($username, "facebook::") === false && string_strpos($username, "google::") === false)) { ?>
    <div id="change-email">

        <h3><?=system_showText(LANG_LABEL_ACCOUNT_USERNAME);?></h3>
        <p><?=system_showText(LANG_LABEL_ACCOUNT_USERNAME_TIP);?></p>
        <br>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 well">
                <div class="form-group">
                    <label for="username_mail"><?=system_showText(LANG_LABEL_USERNAME)?></label>

                    <div class="checking input-group">
                        <? if ($active == "y") { ?>
                            <span class="input-group-addon"> <i class="fa fa-check" data-toggle="tooltip" title="<?=system_showText(LANG_LABEL_ACCOUNT_ACT);?>"></i></span>
                        <? } else { ?>
                            <span class="input-group-addon"> <span id="loadingEmail" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span> <i class="fa fa-times" data-toggle="tooltip" title="<?=system_showText(LANG_LABEL_ACCOUNT_NOTACT);?>"></i></span>
                        <? } ?>

                        <input id="username_mail" class="form-control" type="text" name="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" onblur="checkUsername(this.value, '<?=DEFAULT_URL;?>', 'members', <?=($accountID ? $accountID : 0);?>); populateField(this.value,'email');">
                    </div>
                    <input type="hidden" name="active" value="<?=$active?>">
                    <? if ($active != "y") { ?>
                        <p class="help-block"><a href="javascript: void(0);" onclick="sendEmailActivation(<?=$accountID?>);"><?=system_showText(LANG_LABEL_ACTIVATE_ACC);?></a></p>
                    <? } ?>
                    <label id="checkUsername">&nbsp;</label>
                </div>
            </div>
        </div>
        <hr>

    </div>

    <? } else { ?>

    <input type="hidden" name="username" value="<?=$username?>">

    <? } ?>

    <? if (!$isForeignAcc) { ?>

    <div id="change-password">

        <h3><?=system_showText(LANG_LABEL_ACCOUNT_CHANGEPASS);?></h3>
        <p><?=system_showText(LANG_LABEL_ACCOUNT_CHANGEPASS_TIP);?></p>
        <br>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 well">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="currentPass"><?=system_showText(LANG_LABEL_CURRENT_PASSWORD)?></label>

                        <div class="checking">
                            <input id="currentPass" type="password" name="current_password" class="form-control" <?=$readonly?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="newPass"><?=system_showText(LANG_LABEL_NEW_PASSWORD);?> </label>
                        <input id="newPass" class="form-control" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" <?=$readonly?>>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="retypePass"><?=system_showText(LANG_LABEL_RETYPE_NEW_PASSWORD);?></label>
                        <input id="retypePass" class="form-control" type="password" name="retype_password" <?=$readonly?>>
                    </div>
                </div>
            </div>
        </div>

        <hr>

    </div>

    <? }