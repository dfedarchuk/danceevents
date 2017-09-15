<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2015 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-google-recaptcha.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLERECAPTCHA))?></div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="google_recaptcha_sitekey"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLERECAPTCHA_SITEKEY))?></label>
                    <input class="form-control" type="text" name="google_recaptcha_sitekey" id="google_recaptcha_sitekey" value="<?=$google_recaptcha_sitekey?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> placeholder="<?=system_showText(LANG_SITEMGR_EXAMPLE)?> 6LeB1gTTAAANADXdQKdlcPkX2-iuAXbGUCM1VXWQ">
                </div>
                <div class="form-group">
                    <label for="google_recaptcha_secretkey"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLERECAPTCHA_SECRETKEY))?></label>
                    <input class="form-control" type="text" name="google_recaptcha_secretkey" id="google_recaptcha_secretkey" value="<?=$google_recaptcha_secretkey?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> placeholder="<?=system_showText(LANG_SITEMGR_EXAMPLE)?> 8LeB1gTTAAAAASHUDpWnLDmLjmLGXYMs_WYrtR30">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_recaptcha_status" value="on" <?=($google_recaptcha_status == "on") ? "checked" : ""?> <?=((DEMO_LIVE_MODE) ? "readonly": "")?> > <?=system_showText(LANG_SITEMGR_GOOGLERECAPTCHA_ENABLE);?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" name="submit_button" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
            </div>
        </div>

    </div>

    <div class="col-sm-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <p class="help-block"><p class="help-block"><?=system_showText(LANG_SITEMGR_GOOGLERECAPTCHA_TIP);?></p></p>
            </div>
        </div>
    </div>