<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-module-seocenter.php
	# ----------------------------------------------------------------------------------------------------

?>
    <!-- Panel SEO Information  -->
    <div class="panel panel-form">

        <div class="panel-heading"><?=system_showText(LANG_LABEL_SEO_TUNING)?></div>

        <div class="panel-body">

            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="seo_title"><?=system_showText(LANG_LABEL_SEO_TUNING)?> <?=system_showText(LANG_LABEL_TITLE)?></label>
                    <input type="text" class="form-control" name="<?=$seoTitleField?>" id="seo_title" value="<?=$$seoTitleField?>" maxlength="100" placeholder="<?=system_showText(LANG_HOLDER_LISTINGTITLE)?>">
                </div>

                <div class="col-sm-6">
                    <label for="friendly_url"><?=system_showText(LANG_LABEL_PAGE_NAME)?></label>
                    <input type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="seo_keywords"><?=system_showText(LANG_SEO_KEYWORDS)?></label>
                <input type="text" name="seo_keywords" id="seo_keywords" value="<?=$seo_keywords?>" class="form-control tag-input">
            </div>

            <div class="form-group">
                <label for="seo_description"><?=system_showText(LANG_LABEL_DESCRIPTION)?></label>
                <textarea id="seo_description" name="<?=$seoDescField?>" id="seo_description" rows="5" class="form-control textarea-counter" data-chars="250" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>"><?=$$seoDescField;?></textarea>
            </div>

        </div>

    </div>
