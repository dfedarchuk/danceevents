<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-twilio.php
	# ----------------------------------------------------------------------------------------------------
?>

    <form name="twilio" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
        <div class="panel panel-default">
            <div class="panel-heading"><?=system_showText(LANG_SITEMGR_TWILIO_CONFIGURATION)?></div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="twilio_enabled_call" id="twilio_enabled_call" value="on" <?=$twilio_checked_call?>>
                            <?=system_showText(LANG_SITEMGR_TWILIO_ENABLE_CLICKCALL);?>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="twilio_account_sid"><?=system_showText(LANG_SITEMGR_TWILIO_SID)?></label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="twilio_account_sid" id="twilio_account_sid" value="<?=$twilio_account_sid?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?>>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="twilio_auth_token"><?=system_showText(LANG_SITEMGR_TWILIO_AUTHTOKEN)?></label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="twilio_auth_token" id="twilio_auth_token" value="<?=$twilio_auth_token?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?>>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="twilio_clicktocall_message"><?=system_showText(LANG_SITEMGR_TWILIO_CLICK_TO_CALL_MESSAGE)?></label>
                    <textarea id="twilio_clicktocall_message" name="twilio_clicktocall_message" rows="5" cols="1" class="form-control textarea-counter" data-chars="160" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>"><?=$twilio_clicktocall_message?></textarea>
                    <p class="help-block">
                        <?=system_showText(LANG_SITEMGR_TWILIO_MESSAGE_TIP)?><br>
                        <?=system_showText(LANG_SITEMGR_TWILIO_MESSAGE_TIP2)?>
                    </p>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" name="twilio" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
            </div>
        </div>
    </form>