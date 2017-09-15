<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-google-ads.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-7">

        <div class="panel panel-default">
            <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEADS))?> API</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="google_ad_client"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEADS_CLIENT))?></label>
                    <input class="form-control" type="text" name="google_ad_client" id="google_ad_client" value="<?=$google_ad_client?>" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> placeholder="<?=system_showText(LANG_SITEMGR_EXAMPLE)?> pub-0107044813308700">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_ad_status" value="on" <?=($google_ad_status == "on") ? "checked" : ""?> <?=((DEMO_LIVE_MODE) ? "readonly": "")?> > <?=system_showText(LANG_SITEMGR_GADS_ENABLE);?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label><?=system_showText(LANG_SITEMGR_GADDS_TYPE)?></label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_ad_type_text" value="text" <?=( $google_ad_type & 1 ) ? "checked" : ""?> <?=((DEMO_LIVE_MODE) ? "readonly": "")?> > <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_TEXT))?>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_ad_type_image" value="image" <?=( $google_ad_type & 2 ) ? "checked" : ""?> <?=((DEMO_LIVE_MODE) ? "readonly": "")?> > <?=string_ucwords(system_showText(LANG_SITEMGR_IMAGE))?>
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
                <p class="help-block"><p class="help-block"><?=system_showText(LANG_SITEMGR_GOOGLEPREFS_TIP_2);?></p></p>
            </div>
        </div>
    </div>