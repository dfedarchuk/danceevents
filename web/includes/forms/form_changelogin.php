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
	# * FILE: /includes/forms/form_changelogin.php
	# ----------------------------------------------------------------------------------------------------

	$readonly = "";
	if (DEMO_LIVE_MODE) { $readonly = "readonly"; }

?>

    <div class="header-form">
        <?=string_ucwords(system_showText(LANG_SITEMGR_MANAGEACCOUNT_SITEMGRACCOUNT))?>
    </div>

    <? if ($error_currentpassword) { ?>
        <div id="warning" class="errorMessage"><?=$error_currentpassword?></div>
    <? } ?>

    <? if ($message_changelogin) { ?>
        <? if ($success) { ?>
            <div id="warning" class="successMessage"><?=$message_changelogin?></div>
        <? } else { ?>
            <div id="warning" class="errorMessage"><?=$message_changelogin?></div>
        <? } ?>
    <? } ?>

    <table cellpadding="2" cellspacing="0" border="0" class="standard-table">
        <tr>
            <th><?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:</th>
            <td>
                <input type="text" name="username" value="<?=$username?>" class="input-form-changelogin" <?=$readonly?> />
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_LABEL_CURRENTPASSWORD)?>:</th>
            <td>
                <input type="password" name="current_password" class="input-form-changelogin" <?=$readonly?> />
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_NEW)?> <?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>:</th>
            <td>
                <input type="password" name="password" class="input-form-changelogin" <?=$readonly?> />
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_LABEL_RETYPENEWPASSWORD)?>:</th>
            <td>
                <input type="password" name="retype_password" class="input-form-changelogin" <?=$readonly?> />
            </td>
        </tr>
    </table>