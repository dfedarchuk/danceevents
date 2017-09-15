<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */
?>
<form name="commentingOptions" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
	<div class="panel panel-default">
		<div class="panel-heading">Facebook Connections</div>	
		<div class="panel-body">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="check_fb" name="fb_op" <?=($commenting_fb ? "checked=checked" : "");?> onclick="changeOption('fb', this);">
						Use Facebook system to allow comments on your website. <small class="help-block"><?=system_showText(LANG_SITEMGR_COMMENTING_TIP3)?></small>
					</label>
				</div>
				
			</div>
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" checked>
						Allow redeem deals with facebook connection. 
					</label>
				</div>
				
			</div>
			<div class="row" id="facebook">
				<div class="form-group col-md-4">
					<label for="fb_appID"><?=system_showText(LANG_FACEBOOK_APP_ID);?></label>
					<input class="form-control" type="text" id="fb_appID" name="foreignaccount_facebook_apiid" value="<?=$foreignaccount_facebook_apiid?>" <?=($commenting_fb ? "" : "disabled");?>/>
				</div>
				<div class="form-group col-md-4">
					<label for="fb_userID"><?=system_showText(LANG_FACEBOOK_USER_ID);?></label>
					<input class="form-control" type="text" id="fb_userID" name="fb_user_id" value="<?=$fb_user_id?>" <?=($commenting_fb ? "" : "disabled");?>/>
				</div>
				<div class="form-group col-md-4">
					<label for="fb_number_comments"><?=system_showText(LANG_FACEBOOK_NUMBER_COMMENTS);?></label>
					<input class="form-control" type="text" id="fb_number_comments" name="fb_number_comments" value="<?=$fb_number_comments?>" <?=($commenting_fb ? "" : "disabled");?>/>
				</div>
			</div>
			
		</div>
		<div class="panel-footer">
			<button class="btn btn-primary" type="submit">Save Changes</button>
		</div>
	</div>
</form>