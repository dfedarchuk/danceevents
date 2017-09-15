<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form-banner.php
# ----------------------------------------------------------------------------------------------------

$levelObj = new BannerLevel(true);
?>

<div class="col-md-7">

    <div class="form-group row">
        <?
        system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_BANNER_TYPE), "tour-level");
        ?>
        <div class="col-xs-6 selectize" id="tour-level">
            <label for="level"><?= system_showText(LANG_BANNER_TYPE) ?></label>
            <? if (!isset($id) || ($id == null) || ($process == "signup")) { ?>
                <?= $bannerTypeDropDown; ?><? } else { ?>
                <br>
                <?= $levelObj->showLevel($type) . " (" . $levelObj->getWidth($type) . "px x " . $levelObj->getHeight($type) . "px)" . ($levelObj->getStatus($type) == "n" ? " (" . LANG_BANNER_DISABLED . ")" : "") ?>
                <input type="hidden" name="type" value="<?= $type ?>">
            <? } ?>
        </div>
    </div>

    <!-- Item Name is separated from all informations -->
    <div class="form-group" id="tour-title">
        <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CAPTION), "tour-title"); ?>
        <label for="name"><?= system_showText(LANG_LABEL_CAPTION); ?></label>
        <input type="text" class="form-control textarea-counter" data-chars="25" data-msg="<?= system_showText(LANG_MSG_CHARS_LEFT) ?>" id="name" name="caption_images" value="<?= $caption ?>" onblur="fillCaption(this.value)">
        <input type="hidden" id="mainCaption" name="caption" value="<?= $caption ?>" maxlength="25">
    </div>

    <div id="banner_with_text">

        <div class="form-group" id="tour-title">
            <label for="caption_text"><?= system_showText(LANG_LABEL_CAPTION); ?></label>
            <input type="text" class="form-control textarea-counter" data-chars="25" data-msg="<?= system_showText(LANG_MSG_CHARS_LEFT) ?>" id="caption_text" name="caption_text" value="<?= $caption ?>" onblur="fillCaption(this.value)">
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <label for="content_line1"><?= system_showText(LANG_LABEL_DESCRIPTION_LINE1) ?></label>
                <input type="text" name="content_line1" value="<?= $content_line1 ?>" class="form-control textarea-counter" data-chars="30" data-msg="<?= system_showText(LANG_MSG_CHARS_LEFT) ?>">
            </div>

            <div class="col-sm-6">
                <label for="content_line2"><?= system_showText(LANG_LABEL_DESCRIPTION_LINE2) ?></label>
                <input type="text" name="content_line2" value="<?= $content_line2 ?>" class="form-control textarea-counter" data-chars="30" data-msg="<?= system_showText(LANG_MSG_CHARS_LEFT) ?>">
            </div>
        </div>

    </div>

    <!-- Panel Basic Informartion  -->

    <div class="panel panel-form">

        <div class="panel-heading"><?= system_showText($members ? LANG_ORDER_BANNER : LANG_BASIC_INFO) ?></div>

        <div class="panel-body">
            <? if (!$members) { ?>

                <div class="form-group row">
                    <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ACCOUNT),
                        "tour-owner"); ?>
                    <div class="col-sm-6" id="tour-owner">
                        <label for="account_id"><?= system_showText(LANG_LABEL_ACCOUNT); ?></label>
                        <input type="text" class="form-control mail-select" name="account_id" id="account_id" placeholder="<?= system_showText(LANG_LABEL_ACCOUNT); ?>" value="<?= $account_id ?>">
                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                    </div>
                    <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_STATUS),
                        "tour-status"); ?>
                    <div class="col-sm-6" id="tour-status">
                        <label for="status"><?= system_showText(LANG_LABEL_STATUS); ?></label>
                        <?= ($statusDropDown) ?>
                    </div>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_RENEWAL_DATE),
                    "tour-expiration"); ?>
                <div class="form-group form-inline">
                    <div class="radio" id="tour-expiration">
                        <label>
                            <input type="radio" name="expiration_setting" id="expiration_setting" value="<?= BANNER_EXPIRATION_RENEWAL_DATE ?>" <?= ((!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) ? "checked" : "") ?> onclick="bannerDisableImpressions()">
                            <?= system_showText(LANG_LABEL_RENEWAL_DATE); ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control date-input" name="renewal_date" id="renewal_date" value="<?= $renewal_date ?>" placeholder="<?= system_showText(LANG_SITEMGR_CHANGEEXPIRATIONDATE) ?>" <?= (($expiration_setting && $expiration_setting != BANNER_EXPIRATION_RENEWAL_DATE) ? "disabled=true" : "") ?>>
                    </div>
                </div>
                <?
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_IMPRESSIONS),
                    "tour-impressions");
                ?>
                <div class="form-group form-inline">
                    <div class="radio" id="tour-impressions">
                        <label>
                            <input type="radio" name="expiration_setting" id="expiration_setting" value="<?= BANNER_EXPIRATION_IMPRESSION ?>" <?= (($expiration_setting == BANNER_EXPIRATION_IMPRESSION) ? "checked" : "") ?> onclick="bannerDisableRenewalDate()">
                            <?= system_showText(LANG_LABEL_IMPRESSIONS); ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="impressions" id="impressions" value="<?= $impressions ?>" maxlength="6" <?= ((!$expiration_setting || $expiration_setting != BANNER_EXPIRATION_IMPRESSION) ? "disabled=true" : "") ?> >
                    </div>
                </div>
            <? } elseif ((sess_isAccountLogged()) && (string_strpos($url_base, "/" . MEMBERS_ALIAS . ""))) { ?>

                <div class="form-group form-inline">
                    <div class="radio" id="tour-expiration">
                        <label>
                            <input <? if ($process == "signup") {
                                echo "disabled=disabled";
                            } ?> type="radio" name="expiration_setting" id="expiration_setting" value="<?= BANNER_EXPIRATION_RENEWAL_DATE ?>" <?= ((!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) ? "checked" : "") ?> onclick="bannerDisableImpressions()">
                            <?= system_showText(LANG_BANNER_BY_TIME_PERIOD); ?>
                            <? if ($process == "signup") {
                                if (!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) { ?>
                                    <input type="hidden" name="expiration_setting" value="<?= BANNER_EXPIRATION_RENEWAL_DATE ?>"/> <? }
                            } ?>
                        </label>
                    </div>
                </div>

                <div class="form-group form-inline">
                    <div class="radio" id="tour-expiration">
                        <label>
                            <input <? if ($process == "signup") {
                                echo "disabled=disabled";
                            } ?> type="radio" name="expiration_setting" id="expiration_setting" value="<?= BANNER_EXPIRATION_IMPRESSION ?>" <?= (($expiration_setting == BANNER_EXPIRATION_IMPRESSION) ? "checked" : "") ?> onclick="bannerDisableRenewalDate()">
                            <?= system_showText(LANG_LABEL_IMPRESSIONS) ?>
                            : <?= system_showText(LANG_ADD); ?> <?= $bannerImpressionDropDown ?> <?= system_showText(LANG_IMPRESSIONPAIDOF); ?>
                            : <strong><?= (($impressions) ? $impressions : "0") ?></strong>.
                            <? if ($process == "signup") {
                                if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION) { ?>
                                    <input type="hidden" name="expiration_setting" value="<?= BANNER_EXPIRATION_IMPRESSION ?>"/> <? }
                            } ?>
                        </label>
                    </div>
                </div>

            <? } ?>
        </div>
    </div>

    <!-- Panel Details Informartion  -->
    <div class="panel panel-form">

        <div class="panel-heading"><?= system_showText(LANG_BANNER_DETAIL_PLURAL) ?></div>

        <div class="panel-body">
            <div class="form-group">
                <label><?= system_showText(LANG_SECTION); ?></label>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="radio-inline">
                            <label><input type="radio" id="section" name="section" value="general" checked="checked" onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_GENERALPAGES); ?>
                            </label></div>
                        <div class="radio-inline">
                            <label><input type="radio" id="section" name="section" value="listing" <? if ($section == "listing") {
                                    echo "checked=\"checked\"";
                                } ?> onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_LISTING_FEATURE_NAME); ?>
                            </label></div>
                        <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") { ?>
                            <div class="radio-inline">
                                <label><input type="radio" id="section" name="section" value="promotion" <? if ($section == "promotion") {
                                        echo "checked=\"checked\"";
                                    } ?> onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_PROMOTION_FEATURE_NAME); ?>
                                </label></div>
                        <? } ?>
                        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                            <div class="radio-inline">
                                <label><input type="radio" id="section" name="section" value="event" <? if ($section == "event") {
                                        echo "checked=\"checked\"";
                                    } ?> onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_EVENT_FEATURE_NAME); ?>
                                </label></div>
                        <? } ?>
                        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                            <div class="radio-inline">
                                <label><input type="radio" id="section" name="section" value="classified" <? if ($section == "classified") {
                                        echo "checked=\"checked\"";
                                    } ?> onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_CLASSIFIED_FEATURE_NAME); ?>
                                </label></div>
                        <? } ?>
                        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                            <div class="radio-inline">
                                <label><input type="radio" id="section" name="section" value="article" <? if ($section == "article") {
                                        echo "checked=\"checked\"";
                                    } ?> onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_ARTICLE_FEATURE_NAME); ?>
                                </label></div>
                        <? } ?>
                        <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
                            <div class="radio-inline">
                                <label><input type="radio" id="section" name="section" value="blog" <? if ($section == "blog") {
                                        echo "checked=\"checked\"";
                                    } ?> onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_BLOG_FEATURE_NAME); ?>
                                </label></div>
                        <? } ?>
                        <? if (string_strpos($url_base, "/" . SITEMGR_ALIAS . "")) { ?>
                            <div class="radio-inline">
                                <label><input type="radio" id="section" name="section" value="global" <? if ($section == "global") {
                                        echo "checked=\"checked\"";
                                    } ?> onclick="fillBannerCategorySelect('<?= DEFAULT_URL ?>', this.form.category_id, this.value, this.form, <?= SELECTED_DOMAIN_ID ?>, 'banner');"> <?= system_showText(LANG_SITEMGR_BANNER_GLOBAL); ?>
                                </label></div>
                        <? } ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <?= system_showText(LANG_LABEL_CATEGORY) ?>
                </label>

                <div class="simple-select">
                    <?= $categoryDropDown ?>
                </div>
            </div>

            <div class="form-group">
                <label><?= system_showText(LANG_OPENNEWWINDOW); ?></label>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="target_window" value="1" <? if ($target_window == "1") {
                                    echo "checked";
                                } ?>>
                                <?= system_showText(LANG_NO); ?>
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="target_window" value="2" <? if (($target_window == "2") || (!$target_window)) {
                                    echo "checked";
                                } ?>>
                                <?= system_showText(LANG_YES); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputurl"><?= system_showText(LANG_LABEL_DESTINATION_URL) ?></label>
                <input class="form-control" id="inputurl" type="url" maxlength="250" name="destination_url" value="<?= $destination_url ?>">
            </div>

            <div class="form-group">
                <label for="inputurl2"><?= system_showText(LANG_LABEL_DISPLAY_URL) ?>
                    <small class="text-muted">(<?= system_showText(LANG_MSG_MAX_30_CHARS) ?>)</small>
                </label>
                <input class="form-control" id="inputurl2" type="text" name="display_url" value="<?= $display_url ?>" maxlength="30">
            </div>

            <div class="form-group" id="script_banner">
                <label for="bscript"><?= system_showText(LANG_SCRIPT_BANNER) ?></label>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="show_type" value="1" <?= ($show_type == "1") ? "checked" : ""; ?> >
                                <?= system_showText(LANG_SHOWSCRIPTCODE); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="show_type_banner" class="row">
                    <div class="col-xs-6">
                        <textarea rows="4" cols="50" id="bscript" name="script" class="form-control" placeholder="<?= system_showText(LANG_LABEL_SCRIPT) ?>"><?= $script ?></textarea>
                    </div>
                    <div class="col-xs-6">
                        <p class="help-block">
                            <?= system_showText(LANG_SCRIPTCODEHELP); ?>
                            <?= system_showText(LANG_SCRIPTCODEHELP2) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Panel Promotional Code  -->
    <? if (PAYMENT_FEATURE == "on" && (CREDITCARDPAYMENT_FEATURE == "on" || INVOICEPAYMENT_FEATURE == "on")) {
        system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_DISCOUNT_CODE),
            "tour-discount");
        ?>
        <div class="panel panel-form" id="tour-discount">

            <div class="panel-heading">
                <?= system_showText(LANG_LABEL_DISCOUNT_CODE); ?>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <? if (
                        (
                            (!$thisBannerObject) ||
                            (($expiration_setting == BANNER_EXPIRATION_IMPRESSION) && ($impressions <= 0)) ||
                            (($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) && ($thisBannerObject) && ($thisBannerObject->needToCheckOut())) ||
                            ($url_base == DEFAULT_URL . "/" . SITEMGR_ALIAS . "") ||
                            (($thisBannerObject) && ($thisBannerObject->getPrice('monthly') <= 0 && $thisBannerObject->getPrice('yearly') <= 0))
                        )
                        &&
                        ($process != "signup")
                    ) {
                        ?>
                        <label for="discount_id"><?= system_showText(LANG_HOLDER_DISCOUNTCODE); ?></label>
                        <input type="text" name="discount_id" id="discount_id" class="form-control" value="<?= $discount_id ?>" maxlength="10">
                    <? } else { ?>
                        <p><?= (($discount_id) ? $discount_id : system_showText(LANG_NA)) ?></p>
                        <input type="hidden" name="discount_id" value="<?= $discount_id ?>" maxlength="10">
                    <? } ?>
                </div>

            </div>

        </div>
    <? } ?>

</div>


<div class="col-md-5">
    <br>
    <!-- Image-->
    <div class="panel panel-form-media" id="banner_with_images">
        <div class="panel-heading">
            <?= system_showText(LANG_LABEL_FILE) . " <small id='imageSizeLabel'>(" . $levelObj->getWidth($type) . "px x " . $levelObj->getHeight($type) . "px)</small>"; ?>
        </div>

        <div class="panel-body">

            <div id="filesImages" class="banner-image">

                <input id="upload-images" type="file" name="file" class="filestyle upload-files file-withinput">

                <? if ($image_id > 0 && $id) {
                    $bannerObj = new Banner();
                    $banner_info = $bannerObj->retrieve($id);
                    echo "<br>" . $bannerObj->makeBanner($banner_info);
                } ?>

            </div>
        </div>

        <div class="panel-footer text-center">
            <p class="small text-muted"><?= system_showText(LANG_MSG_MAX_FILE_SIZE) ?> <?= BANNER_UPLOAD_MAX_SIZE; ?> KB.</p>

            <p class="small text-muted"><?= system_showText(LANG_MSG_ALLOWED_FILE_TYPES) ?>: SWF, GIF, JPEG, PNG. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></p>

            <p class="small text-muted"><?= system_showText(LANG_BANNERFILEHELP); ?></p>
        </div>

    </div>

</div>
