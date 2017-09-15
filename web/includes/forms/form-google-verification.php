<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-google-verification.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-7">

        <div class="panel panel-default">
            <div class="panel-heading">Google Search Console</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="googleverification"><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLETAG)?></label>
                    <input id='googleverification' class="form-control" name="google_tag" type="text" value="<?=string_htmlentities($googleTag)?>" placeholder="<?=string_htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE1))?>">
                    <a href="https://www.google.com/webmasters/tools/dashboard" target="blank"><?=system_showText(LANG_SITEMGR_SEARCHMETATAGS_GOOGLE)?></a><br />
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
                <p class="help-block">
                    <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP1)?><br />
                    <?=system_showText(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP2))?><br /><br />
                </p>
            </div>
        </div>
    </div>