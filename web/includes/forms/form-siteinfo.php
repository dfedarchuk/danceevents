<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-siteinfo.php
	# ----------------------------------------------------------------------------------------------------
?>

	<div class="panel panel-default">
		<div class="panel-heading"><?=system_showText(LANG_SITEMGR_BASIC_INFO_WEBSITEDESC);?></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group">
						<label for="header_title"><?=system_showText(LANG_SITEMGR_BASIC_INFO_WEBSITETITLE);?></label>
						<input type="text" name="header_title" id="header_title" value="<?=$header_title?>" maxlength="255" class="form-control">
					</div>
                    <div class="form-group">
						<label for="header_author"><?=system_showText(LANG_SITEMGR_LABEL_AUTHOR)?></label>
						<input type="text" name="header_author" id="header_author" value="<?=$header_author?>" maxlength="255" class="form-control">
					</div>
					<div class="form-group">
						<label for="header_description"><?=system_showText(LANG_LABEL_DESCRIPTION)?></label>
						<textarea name="header_description" id="header_description" class="form-control textarea-counter" data-chars="150" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>" rows="6"><?=$header_description?></textarea>
					</div>
                    <div class="form-group">
						<label for="header_keywords"><?=ucfirst(system_showText(LANG_LABEL_KEYWORDS))?></label>
						<input type="text" name="header_keywords" id="header_keywords" value="<?=$header_keywords?>" class="form-control tag-input">
					</div>
                    <div class="form-group">
						<label for="copyright"><?=ucfirst(system_showText(LANG_SITEMGR_LABEL_COPYRIGHTTEXT))?></label>
						<input type="text" name="copyright" id="copyright" maxlength="50" data-chars="50" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>" value="<?=$copyright?>" class="form-control textarea-counter">
					</div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="setting_facebook_link">Facebook</label>
                            <input type="text" name="setting_facebook_link" id="setting_facebook_link" value="<?=$setting_facebook_link?>" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="setting_linkedin_link">LinkedIn</label>
                            <input type="text" name="setting_linkedin_link" id="setting_linkedin_link" value="<?=$setting_linkedin_link?>" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="twitter_account"><?=ucfirst(system_showText(LANG_LABEL_TWITTER_ACCOUNT))?></label>
                            <input type="text" name="twitter_account" id="twitter_account" value="<?=$twitter_account?>" class="form-control">
                        </div>
                    </div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="setting_instagram_link">Instagram</label>
							<input type="text" name="setting_instagram_link" id="setting_instagram_link" value="<?=$setting_instagram_link?>" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label for="setting_googleplus_link">Google Plus</label>
							<input type="text" name="setting_googleplus_link" id="setting_googleplus_link" value="<?=$setting_googleplus_link?>" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label for="setting_pinterest_link">Pinterest</label>
							<input type="text" name="setting_pinterest_link" id="setting_pinterest_link" value="<?=$setting_pinterest_link?>" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<br>
					<p class="help-block"><?=system_showText(LANG_SITEMGR_BASIC_INFO_WEBSITEDESC_TIP);?></p>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<button type="button" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "document.header.submit();"?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
		</div>
	</div>
