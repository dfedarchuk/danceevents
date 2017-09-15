<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-google-tags.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-7">

        <div class="panel panel-default">
            <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLETAG))?> API</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="google_tag_client"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLETAG_CLIENT))?></label>
                    <input class="form-control" type="text" name="google_tag_client" id="google_tag_client" value="<?=$google_tag_client?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> placeholder="<?=system_showText(LANG_SITEMGR_EXAMPLE)?> ABC-ABCAB7">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_tag_status" value="on" <?=($google_tag_status == "on") ? "checked" : ""?> <?=((DEMO_LIVE_MODE) ? "readonly": "")?> > <?=system_showText(LANG_SITEMGR_GTAG_ENABLE);?>
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
                <p class="help-block"><p class="help-block"><?=system_showText(LANG_SITEMGR_GOOGLEPREFS_TIP_3);?></p></p>
            </div>
        </div>
    </div>