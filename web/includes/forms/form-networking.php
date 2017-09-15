<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-networking.php
	# ----------------------------------------------------------------------------------------------------
?>

    <form name="networking" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">Facebook</div>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fb_op" <?=($commenting_fb ? "checked=checked" : "");?>>
                                    <?=system_showText(LANG_SITEMGR_FB_COMMENTING);?>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="foreignaccount_facebook" id="foreignaccount_facebook" value="on" <?=$foreignaccount_facebook_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEFACEBOOK)?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-3">
                        <div class="form-group col-md-4">
                            <label for="fb_appID"><?=system_showText(LANG_FACEBOOK_APP_ID);?></label>
                            <input type="text" class="form-control" name="foreignaccount_facebook_apiid" id="fb_appID" value="<?=$foreignaccount_facebook_apiid?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?>>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fb_appSecret"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPISECRET);?></label>
                            <input type="text" class="form-control" name="foreignaccount_facebook_apisecret" id="fb_appSecret" value="<?=$foreignaccount_facebook_apisecret?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?>>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fb_userID"><?=system_showText(LANG_FACEBOOK_USER_ID);?></label> <a href="<?=$checkLink?>"><i class="form-tip icon-help10" title="<?=system_showText(LANG_SITEMGR_COMMENTING_TIP6)?>"></i></a>
                            <input class="form-control" type="text" name="fb_user_id" value="<?=$fb_user_id?>">
                        </div>
                    </div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3 control-label">Google</div>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="foreignaccount_google" id="foreignaccount_google" value="on" <?=$foreignaccount_google_checked?>>
                                    <?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEGOOGLE)?>
                                </label>
                            </div>				
                        </div>
                    </div>	
                </div>	
                <div class="row">
                    <div class="col-sm-offset-3">
                        <div class="col-md-4 form-group">
                            <label for="g_id">Client ID</label>
                            <input type="text" class="form-control" name="foreignaccount_google_clientid" id="g_id" value="<?=$foreignaccount_google_clientid?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?>>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="g_scret">Client Secret</label>
                            <input type="text" class="form-control" name="foreignaccount_google_clientsecret" id="g_scret" value="<?=$foreignaccount_google_clientsecret?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" name="signin" value="signin" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
            </div>
        </div>

        
    </form>