<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-contactinfo.php
	# ----------------------------------------------------------------------------------------------------
?>

	<div class="panel panel-default">
		<div class="panel-heading"><?=system_showText(LANG_LABEL_CONTACT_INFORMATION);?></div>
		<div class="panel-body">
		    <div class="form-group">
	          <label for="address"><?=system_showText(LANG_LABEL_ADDRESS)?></label>
	          <input type="text" class="form-control" name="contact_address" id="address" value="<?=$contact_address?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?>>
		    </div>

            <div class="form-group row">
		        <div class="col-xs-6">
		          <label for="company"><?=system_showText(LANG_SITEMGR_LABEL_COMPANYNAME)?></label>
		          <input type="text" class="form-control" id="company" name="contact_company" value="<?=$contact_company?>">
		        </div>
		        <div class="col-xs-6">
		          <label for="email"><?=system_showText(LANG_LABEL_EMAIL)?></label>
		          <input type="email" class="form-control" id="email" name="contact_email" value="<?=$contact_email?>">
		        </div>
		    </div>

			<div class="form-group row">
		        <div class="col-xs-6">
		          <label for="phone"><?=system_showText(LANG_LABEL_PHONE)?></label>
		          <input type="tel" class="form-control" id="phone" name="contact_phone" value="<?=$contact_phone?>">
		        </div>
                <div class="col-xs-6">
		          <label for="fax"><?=system_showText(LANG_SITEMGR_LABEL_FAX)?></label>
		          <input type="tel" class="form-control" id="fax" name="contact_fax" value="<?=$contact_fax?>">
		        </div>
		    </div>

		    <div class="form-group row">
		        <div class="col-xs-6">
		          <label for="city"><?=system_showText(LANG_LABEL_CITY)?></label>
		          <input type="text" class="form-control" name="contact_city" id="city" value="<?=$contact_city?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?>>
		        </div>
		        <div class="col-xs-6">
		          <label for="state"><?=system_showText(LANG_LABEL_STATE)?></label>
		          <input type="text" class="form-control" name="contact_state" id="state" value="<?=$contact_state?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?>>
		        </div>
		    </div>

		    <div class="form-group row">
		        <div class="col-xs-6">
		            <label for="country"><?=system_showText(LANG_LABEL_COUNTRY)?></label>
		            <input type="text" class="form-control" name="contact_country" id="country" value="<?=$contact_country?>">
                </div>
                 <div class="col-xs-6">
		            <label for="zip_code"><?=string_ucwords(ZIPCODE_LABEL)?></label>
		            <input type="text" class="form-control" name="contact_zipcode" id="zip_code" value="<?=$contact_zipcode?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?>>
                </div>
            </div>
            <? if ($loadMap) { ?>
                <div class="form-group row">
                    <div class="col-xs-12" id="tableMapTuning" <?=($hasValidCoord ? "" : "style=\"display: none\"" )?>>
                        <div id="map" style="height: 200px"></div>
                        <input type="hidden" name="contact_latitude_longitude" id="myLatitudeLongitude" value="<?=$contact_latitude_longitude?>" />
                        <input type="hidden" name="contact_mapzoom" id="map_zoom" value="<?=$contact_mapzoom?>" />
                        <input type="hidden" name="contact_latitude" id="latitude" value="<?=$contact_latitude?>" />
                        <input type="hidden" name="contact_longitude" id="longitude" value="<?=$contact_longitude?>" />
                    </div>
                </div>
            <? } ?>

		</div>
		<div class="panel-footer">
			<a href="<?=DEFAULT_URL."/".ALIAS_CONTACTUS_URL_DIVISOR?>" target="_blank" class="btn btn-default pull-left"><?=system_showText(LANG_SITEMGR_BASIC_INFO_CONTACTVIEW);?></a>
			<button type="button" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "document.header.submit();"?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>

		</div>
	</div>
