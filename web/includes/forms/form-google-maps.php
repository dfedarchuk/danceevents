<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-google-maps.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-7">

        <div class="panel panel-default">
            <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEMAPS))?> API</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="google_maps_key"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEMAPS_KEY))?></label>
                    <input class="form-control" type="text" name="google_maps_key" id="google_maps_key" value="<?=$google_maps_key?>" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> placeholder="<?=system_showText(LANG_SITEMGR_EXAMPLE)?> ABQIAAAApsu_yVy ... PoWjn3yp6vDxlSg">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="google_maps_status" value="on" <?=($google_maps_status == "on") ? "checked" : ""?> <?=((DEMO_LIVE_MODE) ? "readonly": "")?> > <?=system_showText(LANG_SITEMGR_GMAPS_ENABLE);?>
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
                <p class="help-block"><?=system_showText(LANG_SITEMGR_GOOGLEMAPS_TIP1)?></p>
            </div>
        </div>
    </div>
