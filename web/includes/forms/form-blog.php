<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-blog.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-md-7">

        <!-- Item Name is separated from all informations -->
        <div class="form-group" id="tour-title">
            <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_BLOG_TITLE), "tour-title"); ?>
            <label for="name" class="label-lg"><?=system_showText(LANG_BLOG_TITLE);?></label>
            <input type="text" class="form-control input-lg" name="title" id="name" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."'); populateField(this.value, 'seo_title', true);\" " : ""?> placeholder="<?=system_showText(LANG_HOLDER_BLOGTITLE)?>">
        </div>

        <!-- Panel Basic Informartion  -->
        <div class="panel panel-form">

            <div class="panel-heading"><?=system_showText(LANG_BASIC_INFO)?></div>

            <div class="panel-body">

                <div class="form-group row" id="tour-categories">

                    <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CATEGORY_PLURAL), "tour-categories"); ?>
                    <div class="col-xs-12">
                        <label for="categories"><?=system_showText(LANG_LABEL_CATEGORY_PLURAL);?></label>
                    </div>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="categories" placeholder="<?=system_showText(LANG_SELECT_CATEGORIES);?>">
                    </div>

                    <input type="hidden" name="return_categories" value="">

                    <?=str_replace("<select", "<select class=\"hidden\"", $feedDropDown);?>

                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-categories" id="action-categoryList"><?=system_showText(LANG_LABEL_SELECT);?> <i class="ionicons ion-ios7-photos-outline"></i></button>
                    </div>

                </div>

                <div class="form-group row">
                    <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_STATUS), "tour-status"); ?>
                    <div class="col-sm-4" id="tour-status">
                        <label for="status"><?=system_showText(LANG_LABEL_STATUS);?></label>
                        <?=($statusDropDown)?>
                    </div>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_POST_CONTENT), "tour-content"); ?>
                <div class="form-group" id="tour-content">
                    <label><?=system_showText(LANG_LABEL_POST_CONTENT)?></label>
                    <div class="table-responsive">
                    <?
                    // TinyMCE Editor Init
                    //fix ie bug with images
                    if (!($content)) $content =  "&nbsp;".$content;

                    // calling CKEditor
                    setting_get('sitemgr_language', $lang);
                    system_addCKEditor("content", $content, 30, 15, $lang);
                    ?>
                    </div>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH), "tour-keywords"); ?>
                <div class="form-group" id="tour-keywords">
                    <label for="keywords"><?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?></label>
                    <input type="text" name="keywords" id="keywords" class="form-control tag-input <?=($highlight == "additional" && !$keywords ? "highlight" : "")?>" placeholder="<?=system_showText(LANG_HOLDER_KEYWORDS);?>" value="<?=$keywords?>">
                    <p class="help-block small"><?=ucfirst(system_showText(LANG_LABEL_MAX));?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?></p>
                </div>

            </div>

        </div>

        <? include(INCLUDES_DIR."/forms/form-module-seocenter.php"); ?>

    </div>

    <div class="col-md-5">

        <!-- Cover Image-->
        <div class="panel panel-form-media">
            <div class="panel-heading">
                <?= system_showText(LANG_LABEL_COVERIMAGE);?>
                <span class="btn btn-sm btn-danger delete pull-right <?=(!(int)$cover_id ? "hidden" : "")?>" id="buttonReset">
                    <i class="icon-ion-ios7-trash-outline" onclick="sendCoverImage('blog', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'deleteCover');" ></i>
                </span>
                <div class="pull-right">
                    <input type="file" name="cover-image" class="file-noinput" onchange="sendCoverImage('blog', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'uploadCover');">
                </div>
            </div>
            <div class="panel-body">
                <div id="coverimage" class="files">
                    <? if ((int)$cover_id) {
                        $imgObj = new Image($cover_id);
                        if ($imgObj->imageExists()) {
                            echo $imgObj->getTag(false, 0, 0, "", false, false, "img-responsive");
                        }

                        ?>
                        <input type="hidden" name="cover_id"  value="<?=$cover_id;?>">
                        <?
                    } ?>
                </div>

                <input type="hidden" name="curr_cover_id"  value="<?=$cover_id;?>">

                <p id="returnMessage" class="alert alert-warning" style="display:none;"></p>

            </div>
            <div class="panel-footer text-center">
                <p class="small text-muted"><?=system_showText(LANG_LABEL_RECOMMENDED_DIMENSIONS);?>: <?=COVER_IMAGE_WIDTH?> x <?=COVER_IMAGE_HEIGHT?> px (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</p>
                <p class="small text-muted"><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></p>
            </div>
        </div>

        <!-- Image-->
        <?php
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_IMAGE), "tour-image");
            $imageUploader->buildform( true,"tour-image", false );
        ?>
    </div>
