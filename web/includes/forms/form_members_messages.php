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
	# * FILE: /includes/forms/form_members_messages.php
	# ----------------------------------------------------------------------------------------------------

    if ($message) { ?>
        <p class="alert alert-<?=$message_style?>"><?=$message?></p>
    <? }
    
    if (string_strlen(trim($message_demoDotCom)) > 0) { ?>
        <p class="alert alert-warning">
            <? if (string_strlen(trim($message_demoDotCom)) > 0) { ?>
                <?=$message_demoDotCom?>
            <? } ?>
        </p>
    <? } ?>

    <? if (string_strlen(trim($message_profile)) > 0) { ?>
    <p class="alert alert-warning">
        <?=$message_profile?>
        </p>
    <? }
    
    if ($_GET["error"] == "disableAttach") { ?>
        <p class="alert alert-warning"><?=system_showText(LANG_FB_ALREADY_LINKED)?></p>
    <? }

    if (isset($_GET["facebookerror"])) { ?>
        <p class="alert alert-warning"><?=system_showText(LANG_MSG_ERROR_NUMBER)." 10001. ".system_showText(LANG_MSG_TRY_AGAIN);?></p>
    <? }
    
    if ((string_strlen(trim($message_member)) > 0) || (string_strlen(trim($message_account)) > 0) || (string_strlen(trim($message_contact)) > 0) ) { ?>
					
        <p class="alert alert-warning">
            <? if (string_strlen(trim($message_member)) > 0) { ?>
                <?=$message_member?>

                <? if (string_strlen(trim($message_account)) > 0) { ?>
                    <br />
                <? } ?>
            <? } ?>

            <? if (string_strlen(trim($message_account)) > 0) { ?>
                <?=$message_account?>

                <? if (string_strlen(trim($message_contact)) > 0) { ?>
                    <br />
                <? } ?>
            <? } ?>

            <? if (string_strlen(trim($message_contact)) > 0) { ?>
                <?=$message_contact?>
            <? } ?>
        </p>

    <? } ?>
        
    <p class="alert alert-success" id="messageEmail" style="display:none"><?=system_showText(LANG_LABEL_ACTIVATEEMAIL_SENT);?></p>
    <p class="alert alert-warning" id="messageEmailError" style="display:none"></p>
    
    <? if ($messageAct) { ?>
        <p class="alert alert-success"><?=system_showText(LANG_MSG_ACCOUNT_ACTIVATED);?></p>
    <? } ?>