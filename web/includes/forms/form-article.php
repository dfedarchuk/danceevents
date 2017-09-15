<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-article.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-md-7">

        <!-- Item Name is separated from all informations -->
        <div class="form-group" id="tour-title">
            <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_ARTICLE_TITLE), "tour-title"); ?>
            <label for="name" class="label-lg"><?=system_showText(LANG_ARTICLE_TITLE);?></label>
            <input type="text" class="form-control input-lg" name="title" id="name" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."'); populateField(this.value, 'seo_title', true);\" " : ""?> placeholder="<?=system_showText(LANG_HOLDER_ARTICLETITLE)?>">
        </div>

        <!-- Panel Basic Informartion  -->
        <div class="panel panel-form">

            <div class="panel-heading"><?=system_showText(LANG_BASIC_INFO)?></div>

            <div class="panel-body">

                <div class="form-group row" id="tour-categories">

                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CATEGORY_PLURAL), "tour-categories");
                    ?>
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

                <? if (!$members) { ?>
                <div class="form-group row">
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ACCOUNT), "tour-owner");
                    ?>
                    <div class="col-sm-4" id="tour-owner">
                        <label for="account_id"><?=system_showText(LANG_LABEL_ACCOUNT);?></label>
                        <input type="text" class="form-control mail-select" name="account_id" id="account_id" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?= is_numeric($account_id)? $account_id : 0 ?>">
                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                    </div>
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_STATUS), "tour-status");
                    ?>
                    <div class="col-sm-4" id="tour-status">
                        <label for="status"><?=system_showText(LANG_LABEL_STATUS);?></label>
                        <?=($statusDropDown)?>
                    </div>
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_RENEWAL_DATE), "tour-expiration");
                    ?>
                    <div class="col-sm-4" id="tour-expiration">
                        <label for="expirationdate"><?=system_showText(LANG_LABEL_RENEWAL_DATE);?></label>
                        <input type="text" class="form-control date-input" id="expirationdate" name="renewal_date" value="<?=$renewal_date?>" placeholder="<?=system_showText(LANG_SITEMGR_CHANGEEXPIRATIONDATE)?>">
                    </div>
                </div>
                <? } ?>

                <div class="form-group row">

                    <div class="col-sm-4" id="tour-author">
                        <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_ARTICLE_AUTHOR), "tour-author"); ?>
                        <label for="author"><?=system_showText(LANG_ARTICLE_AUTHOR);?></label>
                        <input type="text" class="form-control <?=($highlight == "description" && !$author ? "highlight" : "")?>" name="author" maxlength="100" id="author" value="<?=$author?>">
                    </div>

                    <div class="col-sm-4" id="tour-authorurl">
                        <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_ARTICLE_AUTHOR_URL), "tour-authorurl"); ?>
                        <label for="author_url"><?=system_showText(LANG_ARTICLE_AUTHOR_URL);?></label>
                        <input type="url" class="form-control <?=($highlight == "description" && !$author_url ? "highlight" : "")?>" name="author_url" maxlength="250" id="author_url" value="<?=$author_url?>">
                    </div>

                    <div class="col-sm-4" id="tour-publication">
                        <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_PUBLICATION_DATE), "tour-publication"); ?>
                        <label for="publication"><?=system_showText(LANG_LABEL_PUBLICATION_DATE);?></label>
                        <input type="text" class="form-control date-input" name="publication_date" id="publication" placeholder="<?=format_printDateStandard()?>" value="<?=$publication_date?>">
                    </div>

                </div>

                <div class="form-group" id="tour-abstract">
                    <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ABSTRACT), "tour-abstract"); ?>
                    <label for="abstract"><?=system_showText(LANG_LABEL_ABSTRACT)?></label>
                    <textarea id="abstract" name="abstract" class="textarea-counter form-control" rows="2" <?=(!$id) ? " onblur=\"populateField(this.value, 'seo_description', true);\" " : ""?> data-chars="250" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>" placeholder="<?=system_showText(LANG_HOLDER_ARTICLESUMMARY);?>"><?=$abstract;?></textarea>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CONTENT), "tour-content"); ?>
                <div class="form-group" id="tour-content">
                    <label><?=system_showText(LANG_LABEL_CONTENT)?></label>
                    <div class="table-responsive">
                        <?
                        // TinyMCE Editor Init
                        //fix ie bug with images
                        if (!($content)) $content =  "&nbsp;".$content;

                        // calling CKEditor
                        system_addCKEditor("content", $content, 30, 15);
                        ?>
                    </div>
                </div>

                <?
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH), "tour-keywords");
                ?>
                <div class="form-group" id="tour-keywords">
                    <label for="keywords"><?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?></label>
                    <input type="text" name="keywords" id="keywords" class="form-control tag-input <?=($highlight == "additional" && !$keywords ? "highlight" : "")?>" placeholder="<?=system_showText(LANG_HOLDER_KEYWORDS);?>" value="<?=$keywords?>">
                    <p class="help-block small"><?=ucfirst(system_showText(LANG_LABEL_MAX));?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?></p>
                </div>

            </div>

        </div>

        <? include(INCLUDES_DIR."/forms/form-module-seocenter.php"); ?>

        <!-- Panel Promotional Code  -->
        <? if (PAYMENT_FEATURE == "on" && (CREDITCARDPAYMENT_FEATURE == "on" || INVOICEPAYMENT_FEATURE == "on")) {
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_DISCOUNT_CODE), "tour-discount");
        ?>
        <div class="panel panel-form" id="tour-discount">

            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_DISCOUNT_CODE);?>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <? if (((!$article->getNumber("id")) || (($article) && ($article->needToCheckOut())) || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || (($article) && ($article->getPrice('monthly') <= 0 && $article->getPrice('yearly') <= 0))) && ($process != "signup")) { ?>
                        <label for="discount_id" ><?=system_showText(LANG_HOLDER_DISCOUNTCODE);?></label>
                        <input type="text" name="discount_id" id="discount_id" class="form-control" value="<?=$discount_id?>" maxlength="10" placeholder="">
                    <? } else { ?>
                        <p><?=(($discount_id) ? $discount_id : system_showText(LANG_NA) )?></p>
                        <input type="hidden" name="discount_id" value="<?=$discount_id?>" maxlength="10">
                    <? } ?>
                </div>

            </div>

        </div>
        <? } ?>

    </div>

    <div class="col-md-5">

        <!-- Cover Image-->
        <div class="panel panel-form-media">
            <div class="panel-heading">
                <?= system_showText(LANG_LABEL_COVERIMAGE);?>
                <span class="btn btn-sm btn-danger delete pull-right <?=(!(int)$cover_id ? "hidden" : "")?>" id="buttonReset">
                    <i class="icon-ion-ios7-trash-outline" onclick="sendCoverImage('article', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'deleteCover');" ></i>
                </span>
                <div class="pull-right">
                    <input type="file" name="cover-image" class="file-noinput" onchange="sendCoverImage('article', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'uploadCover');">
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

        <?php
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_IMAGE_PLURAL), "tour-images");
            $imageUploader->buildform(true);
        ?>
    </div>
