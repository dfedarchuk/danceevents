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
    # * FILE: /includes/form/form_addaccount.php
    # ----------------------------------------------------------------------------------------------------

    if ((string_strlen(trim($message_account)) > 0) || (string_strlen(trim($message_contact)) > 0) ) { ?>
        <p class="alert alert-warning">
            <? if (string_strlen(trim($message_contact)) > 0) { ?>
                <?=$message_contact?>
            <? } ?>
            <? if ((string_strlen(trim($message_contact)) > 0) && (string_strlen(trim($message_account)) > 0)) { ?>
                <br />
            <? } ?>
            <? if (string_strlen(trim($message_account)) > 0) { ?>
                <?=$message_account?>
            <? } ?>
        </p>
    <? } ?>

    <div class="form-group row">
        <div class="col-sm-6">
            <label for="first_name"><?=system_showText(LANG_LABEL_FIRST_NAME);?></label>
            <input class="form-control" type="text" name="first_name" id="first_name" value="<?=$first_name?>" />
        </div>

        <div class="col-sm-6">
            <label for="last_name"><?=system_showText(LANG_LABEL_LAST_NAME);?></label>
            <input class="form-control" type="text" name="last_name" id="last_name" value="<?=$last_name?>" />
        </div>
    </div>

    <div class="form-group">
        <label for="username<?=($claimSection ? "_claim" : "")?>"><?=system_showText(LANG_LABEL_USERNAME);?></label>
        <input class="form-control" type="email" name="username" id="username<?=($claimSection ? "_claim" : "")?>" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" onblur="populateField(this.value,'email');" />
        <input type="hidden" name="email" id="email" value="<?=$email?>" />
    </div>

    <div class="form-group">
        <label for="password<?=($claimSection ? "_claim" : "")?>"><?=system_showText(LANG_LABEL_PASSWORD);?></label>
        <input class="form-control" id="password<?=($claimSection ? "_claim" : "")?>" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" />
    </div>

    <? if ($showNewsletter) { ?>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="newsletter" value="y" <?=($newsletter || (!$newsletter && $_SERVER["REQUEST_METHOD"] != "POST")) ? "checked" : ""?> />
                <?=$signupLabel?>
            </label>
        </div>

    <? } ?>

    <div class="row">
        <div class="col-sm-6">
            <?=str_replace("[a]", "<a rel=\"nofollow\" href=\"".DEFAULT_URL."/".ALIAS_TERMS_URL_DIVISOR."\" target=\"_blank\">", str_replace("[/a]", "</a>", system_showText(LANG_ACCEPT_TERMS)));?>
            <span class="break-sm"></span>
        </div>
        <div class="col-sm-6">
        <? if ($advertise_section) { ?>
            <? if (PAYMENT_FEATURE == "on" && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
            <button class="btn btn-success btn-block" id="check_out_payment_2" type="submit" name="continue" value=""><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
            <? } ?>
            <button class="btn btn-success btn-block" id="check_out_free_2" type="submit" name="checkout" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
        <? } else { ?>
            <button class="btn btn-success btn-block" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
        <? } ?>
        </div>
    </div>
