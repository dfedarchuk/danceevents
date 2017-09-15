<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-datacenter-settings.php
	# ----------------------------------------------------------------------------------------------------

    if ($message_imports) { ?>
		<div id="warning" class="alert alert-<?=$message_style?>"><?=$message_imports?></div>
	<? } ?>
        
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading"><?=system_showText(LANG_SITEMGR_DEFAULTSETTINGS." - ".LANG_LISTING_FEATURE_NAME_PLURAL)?></div>
			<div class="panel-body form-horizontal">

				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_from_export" name="import_from_export" value="1" <?=$import_from_export?>><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_enable_listing_active" name="import_enable_listing_active" value="1" <?=$import_enable_listing_active?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE)?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_update_listings" name="import_update_listings" value="1" <?=$import_update_listings?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_UPDATE)?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_update_friendlyurl" name="import_update_friendlyurl" value="1" <?=$import_update_friendlyurl?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FRIENDLYURL)?>
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_featured_categs" name="import_featured_categs" value="1" <?=$import_featured_categs?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FEATURED_CATEGS)?>
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_sameaccount_listing" name="import_sameaccount" value="1" <?=$import_sameaccount?> onclick="JS_ShowHideAccount('listing');"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT)?>
							</label>
						</div>
					</div>
				</div>
                <div class="form-group" id="import_account_id_listing" <?=($import_sameaccount != "checked") ? "style=\"display:none;\"" : ""?>>
                    <label class="col-sm-5 control-label"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT)?></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control mail-select" style="width: 200px;" name="account_id" id="account_id" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?=$account_id?>">
                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-5 control-label"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_DEFAULTLEVEL)?></label>
					<div class="col-sm-7">
						<div class="selectize">
							<select name="import_defaultlevel" style="width: 200px;">
								<?
								$levelObj = new ListingLevel();
								$levelvalues = $levelObj->getLevelValues();
								foreach ($levelvalues as $levelvalue) {
									if ($import_defaultlevel == $levelvalue) {
										$selected = " selected=\"selected\"";
                                    } else {
                                        $selected = "";
                                    }
									echo "<option value=\"".$levelvalue."\" $selected>".$levelObj->showLevel($levelvalue)."</option>";
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" name="imports" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
			</div>
		</div>
	</div>

    <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
        
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading"><?=system_showText(LANG_SITEMGR_DEFAULTSETTINGS." - ".LANG_EVENT_FEATURE_NAME_PLURAL)?></div>
			<div class="panel-body form-horizontal">

				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_from_export_event" name="import_from_export_event" value="1" <?=$import_from_export_event?>><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_enable_event_active" name="import_enable_event_active" value="1" <?=$import_enable_event_active?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE)?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_update_events" name="import_update_events" value="1" <?=$import_update_events?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_UPDATE)?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_update_friendlyurl_event" name="import_update_friendlyurl_event" value="1" <?=$import_update_friendlyurl_event?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FRIENDLYURL)?>
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_featured_categs_event" name="import_featured_categs_event" value="1" <?=$import_featured_categs_event?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FEATURED_CATEGS)?>
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
	    			<div class="col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="import_sameaccount_event" name="import_sameaccount_event" value="1" <?=$import_sameaccount_event?> onclick="JS_ShowHideAccount('event');"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT)?>
							</label>
						</div>
					</div>
				</div>
                <div class="form-group" id="import_account_id_event" <?=($import_sameaccount != "checked") ? "style=\"display:none;\"" : ""?>>
                    <label class="col-sm-5 control-label"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT)?></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control mail-select" style="width: 200px;" name="account_id_event" id="account_id_event" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?=$account_id_event?>">
                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-5 control-label"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_DEFAULTLEVEL)?></label>
					<div class="col-sm-7">
						<div class="selectize">
							<select name="import_defaultlevel_event" style="width: 200px;">
								<?
								$levelObj = new EventLevel();
								$levelvalues = $levelObj->getLevelValues();
								foreach ($levelvalues as $levelvalue) {
									if ($import_defaultlevel == $levelvalue) {
										$selected = " selected=\"selected\"";
                                    } else {
                                        $selected = "";
                                    }
									echo "<option value=\"".$levelvalue."\" $selected>".$levelObj->showLevel($levelvalue)."</option>";
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" name="imports" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
			</div>
		</div>
	</div>
	
    <? } ?>