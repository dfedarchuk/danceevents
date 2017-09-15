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
            <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEANALYTICS))?> API</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="google_analytics_account"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEANALYTICS_ACCOUNT))?></label>
                    <input class="form-control" type="text" name="google_analytics_account" id="google_analytics_account" value="<?=$google_analytics_account?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> placeholder="<?=system_showText(LANG_SITEMGR_EXAMPLE)?> UA-2623236-1">
                </div>
                <div class="form-group">
                    <label><?=system_showText(LANG_SITEMGR_GOOGLEANALYTICS_OPTIONS)?></label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_analytics_front" value="on" <?=(($google_analytics_front == "on") ? "checked" : "")?>> <?=string_ucwords(system_showText(LANG_SITEMGR_FRONT))?>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_analytics_members" value="on" <?=(($google_analytics_members == "on") ? "checked" : "")?>> <?=string_ucwords(system_showText(LANG_SITEMGR_MEMBERS))?>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_analytics_sitemgr" value="on" <?=(($google_analytics_sitemgr == "on") ? "checked" : "")?>> <?=string_ucwords(system_showText(LANG_SITEMGR_SITEMGR))?>
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
                <p class="help-block"><?=system_showText(LANG_SITEMGR_GOOGLEPREFS_TIP_3);?></p>
            </div>
        </div>
    </div>