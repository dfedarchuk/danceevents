<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-settings.php
	# ----------------------------------------------------------------------------------------------------
?>

    <form name="general-settings" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
        
        <? if ($success) { ?>
        <div class="col-xs-12">
            <div class="alert alert-success fade in" role="alert">
                <p><?=system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);?></p>
            </div>
        </div>
        <? } ?>
        
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE)?></div>
                <div class="panel-body form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3 control-label"><?=system_showText(LANG_SITEMGR_MAINTENANCETURNON);?></div>
                        <div class="col-sm-9 checkbox">
                            <label>
                                <input type="checkbox" name="maintenance_mode" value="on" <?=($maintenance_mode == "on" ? "checked" : "")?>>
                                <?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE_TIP);?>
                            </label>
                        </div>				
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="maintenance" value="maintenance" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/page-editor/custom.php?id=".$idMaintance["id"]?>" target="_blank" class="btn btn-default pull-left"><?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE_TIP2);?></a>
                </div>
            </div>

            <? if (count($activeModules)) { ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_MANAGE_MODULES))?></div>
                <div class="panel-body form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3 control-label"><?=system_showText(LANG_SITEMGR_SETTING_ACITVATEDMODULES);?></div>
                        <div class="col-sm-9">
                            <? foreach ($activeModules as $acModule) { ?>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" name="check_<?=$acModule?>_feature" value="on" <?=${"custom_".$acModule."_feature_checked"}?>>
                                    <?=system_showText(defined("LANG_".strtoupper($acModule)."_FEATURE_NAME_PLURAL") ? constant("LANG_".strtoupper($acModule)."_FEATURE_NAME_PLURAL") : constant("LANG_".strtoupper($acModule)."_FEATURE_NAME"));?>
                                </label>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="modules_options" value="modules_options" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div>
            <? } ?>
            
            <div class="panel panel-default">
                <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_CLAIM_CLAIMS))?></div>
                <div class="panel-body form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3 control-label"><?=system_showText(LANG_SITEMGR_NAVBAR_OPTIONS)?></div>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="claim_approve" value="on" <?=$claim_approve_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_SITEMGRMUSTAPPROVE)?>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="claim_deny" value="on" <?=$claim_deny_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_AFTERDENIED)?>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="claim_approveemail" value="on" <?=$claim_approveemail_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_SENDEMAILLISTINGOWNER_ISAPPROVED)?>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="claim_denyemail" value="on" <?=$claim_denyemail_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_SENDEMAILLISTINGOWNER_ISDENIED)?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-sm-3"><?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_CLAIMTEXTLINK)?></label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="claim_textlink" value="<?=$claim_textlink?>">
                            </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="claim" value="claim" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading"><?=system_showText(LANG_SITEMGR_COMMENTING_OPTIONS);?></div>
                <div class="panel-body form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3 control-label"><?=system_showText(LANG_SITEMGR_NAVBAR_OPTIONS)?></div>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="review_listing_enabled" id="review_listing_enabled" value="on" <?=$review_listing_enabled_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_LISTING)?>
                                </label>
                            </div>
                            
                            <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on"){ ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="review_article_enabled" id="review_article_enabled" value="on" <?=$review_article_enabled_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_ARTICLE)?>
                                </label>
                            </div>
                            <? } ?>
                            
                            <? /*if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on"){ ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="review_promotion_enabled" id="review_promotion_enabled" value="on" <?=$review_promotion_enabled_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_PROMOTION)?>
                                </label>
                            </div>
                            <? }*/ ?>
                            
                            <?/* if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on"){ ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="review_blog_enabled" id="review_blog_enabled" value="on" <?=$review_blog_enabled_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_BLOG)?>
                                </label>
                            </div>
                            <? }*/ ?>
                            
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="review_approve" id="review_approve" value="on" <?=$review_approve_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_SITEMGRMUSTAPPROVE)?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="reviews" value="reviews" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                     <?=system_showText(LANG_SITEMGR_SN_MSG_CONFIGURE);?>
                </div>
                <div class="panel-body form-horizontal">
                    
                    <div id="customVisitor" class="options-content">
                        <ul class="nav nav-pills" role="tablist">
                            <? foreach ($modulesVisitor as $k => $moduleVisitor) { ?>
							<li class="<?=(!$k ? "active" : "")?>"><a href="#visitor-<?=$moduleVisitor?>" data-toggle="tab" role="tab"><?=ucfirst(constant("LANG_SITEMGR_".string_strtoupper($moduleVisitor)."_SETTINGS"));?></a></li>
                            <? } ?>
						</ul>
                        
                        <div class="row tab-content content-pills">
                        <? foreach ($modulesVisitor as $k => $moduleVisitor) { ?>
                            <div class="tab-pane <?=(!$k ? "active" : "")?>" id="visitor-<?=$moduleVisitor?>">
                                <div class="form-group form-horizontal">
                                    <label class="col-sm-3 control-label">
                                          <?=system_showText(LANG_SITEMGR_NAVBAR_OPTIONS)?>
                                    </label>
                                    <div class="col-sm-9">
                                        
                                        <? if ($moduleVisitor == "general") { ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="enable_visitorprofile" value="on" <?=($enable_visitorprofile == "on" ? "checked" : "")?>>
                                                <?=system_showText(LANG_SITEMGR_SETTING_ENABLEVISITOR);?>
                                            </label>
                                        </div>
                                        <? } ?>
                                        
                                        <?
                                        $settings = $socialObj->getSectionSettings($moduleVisitor, SELECTED_DOMAIN_ID);
                                        if (is_array($settings)) foreach ($settings as $key => $setting) {
                                            unset($check);
                                            if ($setting->getString("value") == "yes"){
                                                $check = "checked";
                                            }
                                        ?>
                                        
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="<?=$setting->getString("name");?>" <?=$check?> value="yes">
                                                <?=constant($setting->getString("label"));?>
                                            </label>
                                        </div>
                                        
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="visitor" value="visitor" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_APPROVAL))?></div>
                <div class="panel-body form-horizontal">
                    <div class="options-content">
                        
                        <ul class="nav nav-pills" role="tablist">
                            <? foreach ($approvalModules as $k => $approvalModule) { ?>
							<li class="<?=(!$k ? "active" : "")?>"><a href="#approval-<?=$approvalModule?>" data-toggle="tab" role="tab"><?=system_showText(constant("LANG_SITEMGR_APPROVE_".strtoupper($approvalModule)))?></a></li>
                            <? } ?>
						</ul>
                        
                        <div class="row tab-content content-pills">
                        <? foreach ($approvalModules as $k => $approvalModule) { ?>
                            <div class="tab-pane <?=(!$k ? "active" : "")?>" id="approval-<?=$approvalModule?>">
                                <div class="form-group form-horizontal">
                                    <label class="control-label col-sm-4">
                                        <?=system_showText(LANG_SITEMGR_MUST_APPROVE)?>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="<?=$approvalModule?>_approve_paid" name="<?=$approvalModule?>_approve_paid"  value="on" <?=${$approvalModule."_approve_paid_checked"}?>>
                                                <?=system_showText(constant("LANG_SITEMGR_APPROVE_".strtoupper($approvalModule)."_AFTER_PAYMENT"))?>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="<?=$approvalModule?>_approve_free" name="<?=$approvalModule?>_approve_free"  value="on" <?=${$approvalModule."_approve_free_checked"}?>>
                                                <?=system_showText(constant("LANG_SITEMGR_APPROVE_FREE_ONLY_".strtoupper($approvalModule)))?>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="<?=$approvalModule?>_approve_updated" name="<?=$approvalModule?>_approve_updated"  value="on" <?=${$approvalModule."_approve_updated_checked"}?>>
                                                <?=system_showText(constant("LANG_SITEMGR_APPROVE_UPDATED_ONLY_".strtoupper($approvalModule)))?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-horizontal">
                                    <label class="control-label col-sm-4">
                                        <?=system_showText(LANG_SITEMGR_WILL_RECEIVE)?>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="new_<?=$approvalModule?>_email" name="new_<?=$approvalModule?>_email"  value="on" <?=${"new_".$approvalModule."_email_checked"}?>>
                                                <?=ucfirst(system_showText(constant("LANG_SITEMGR_APPROVE_NEW_ONLY_".strtoupper($approvalModule))))?>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="update_<?=$approvalModule?>_email" name="update_<?=$approvalModule?>_email"  value="on" <?=${"update_".$approvalModule."_email_checked"}?>>
                                                <?=system_showText(constant("LANG_SITEMGR_APPROVE_UPDATED_ONLY_".strtoupper($approvalModule)))?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="approvalrequirement" value="approvalrequirement" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div>

            <? if (API_FEATURE == "on" || !defined("API_FEATURE")) { ?>

            <div class="panel panel-default">
                <div class="panel-heading"><?=system_showText(LANG_SITEMGR_API)?> <a href="javascript:void(0);"><i data-toggle="modal" data-target="#modal-api" class="form-tip icon-help10"></i></a></div>
                
                <div class="panel-body form-horizontal">
                    <div class="form-group">
                        
                        <div class="control-label col-sm-3">
                            <?=system_showText(LANG_SITEMGR_SETTINGS_API_ENABLE)?>
                        </div>
                        
                        <div class="checkbox col-sm-9">
                            <label>
                                <input type="checkbox" name="edirectory_api_enabled" value="on" <?=$edirectory_api_enabled_checked?> onclick="setNewKey();">
                                <?=system_showText(LANG_SITEMGR_SETTINGS_API_ENABLE_TIP);?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group form-horizontal">  
                        <div class="control-label col-sm-3">
                            <?=system_showText(LANG_SITEMGR_SETTINGS_APIKEY)?>
                        </div>                        
                        <div class="col-sm-9">
                            <input type="text"  class="form-control"  name="edirectory_api_key_disabled" id="edirectory_api_key_disabled" value="<?=$edirectory_api_key?>" readonly maxlength="50" />
                            <input type="hidden" name="edirectory_api_key" id="edirectory_api_key" value="<?=$edirectory_api_key?>">
                            <input type="hidden" id="new_key" name="edirectory_api_key_new" value="<?=$edirectory_api_key_new?>">
                            <p class="help-block small"><?=system_showText(LANG_SITEMGR_API_NOTE);?></p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="api" value="api" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div>

            <? } ?>

            <div class="panel panel-default">
                <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_DEFAULTCONDITIONTEXT))?></div>

                <div class="panel-body form-horizontal">
                    <div class="form-group">
                        <div class="row">
                            <div class="control-label col-sm-3">
                                <?=system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_CONDITIONS)?>
                            </div>

                            <div class="checkbox col-sm-8">
                                <textarea class="form-control textarea-counter" data-chars="1000" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>" name="promotion_default_conditions" rows="8"><?=$promotion_default_conditions?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="promotionDefaults" value="1" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div>

        </div>
    </form>