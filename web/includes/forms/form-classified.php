<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form-classified.php
# ----------------------------------------------------------------------------------------------------

JavaScriptHandler::registerOnReady(
    "$('#listing-association').selectize({
        create: false, 
        sortField: 'text', 
        persist: false, 
        allowEmptyOption: false
    });"
);

$levelObjAux = new ClassifiedLevel();
?>

<div class="col-md-7">

    <!-- Item Name is separated from all informations -->
    <div class="form-group" id="tour-title">
        <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_CLASSIFIED_TITLE),
            "tour-title"); ?>
        <label for="name" class="label-lg"><?= system_showText(LANG_CLASSIFIED_TITLE); ?></label>
        <input type="text" class="form-control input-lg" name="title" id="name" value="<?= $title ?>"
               maxlength="100" <?= (!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."'); populateField(this.value, 'seo_title', true);\" " : "" ?>
               placeholder="<?= system_showText(LANG_HOLDER_CLASSIFIEDTITLE) ?>">
    </div>

    <!-- Panel Basic Informartion  -->
    <div class="panel panel-form">

        <div class="form-group row">

            <? if (is_array($array_fields) && in_array("price", $array_fields)) { ?>
                <div class="col-xs-6" id="tour-price">
                    <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_PRICE),
                        "tour-price"); ?>
                    <label for="price"><?= system_showText(LANG_LABEL_PRICE) ?></label>
                    <?
                    if ($classified_price != 'NULL') {
                        $price_value = explode(".", $classified_price);
                    }
                    ?>
                    <div class="input-group">
                        <span class="input-group-addon"><? echo CURRENCY_SYMBOL; ?></span>
                        <input type="number"
                               class="form-control <?= ($highlight == "description" && $classified_price == 'NULL' ? "highlight" : "") ?>"
                               name="classified_price_int" id="price_int"
                               value="<?= $price_value[0] ? $price_value[0] : $classified_price_int ?>" maxlength="7">
                        <span class="input-group-addon"> &nbsp;.&nbsp; </span>
                        <input type="number"
                               class="form-control <?= ($highlight == "description" && $classified_price == 'NULL' ? "highlight" : "") ?>"
                               name="classified_price_cent" id="price_cent"
                               value="<?= $price_value[1] ? $price_value[1] : $classified_price_cent ?>" maxlength="2">
                    </div>
                </div>
            <? }

            if (!$members) {
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_CLASSIFIED_LEVEL),
                    "tour-level"); ?>

                <div class="col-xs-6 selectize" id="tour-level">
                    <label for="level"><?= system_showText(LANG_CLASSIFIED_LEVEL) ?></label>
                    <select name="level" id="level" onchange="changeModuleLevel();">
                        <?
                        $levelvalues = $levelObjAux->getLevelValues();
                        foreach ($levelvalues as $levelvalue) { ?>
                            <option
                                value="<?= $levelvalue ?>" <?= (($levelArray[$levelObjAux->getLevel($levelvalue)]) ? "selected" : "") ?>>
                                <?= $levelObjAux->showLevel($levelvalue); ?>
                            </option>
                        <? } ?>
                    </select>
                </div>
            <? } ?>

            <?php
            $count = count($listings);
            if ($count > 0) {
                ?>
                <div class="col-xs-6 selectize">
                    <label for="listing"><?= system_showText(LANG_LABEL_CHOOSE_LISTING) ?></label>
                    <?php
                    for ($i = 0; $i < $count; $i++) {
                        if ($i === 0) {
                            printf(
                                '<select id="%s" name="%s">',
                                'listing-association',
                                'listing_id'
                            );
                            // It tried really hard to create an option without value and make it work, I couldn't...
                            printf(
                                '<option %s value="%s">%s</option>',
                                '',
                                0,
                                LANG_LABEL_CHOOSE_LISTING
                            );
                        }

                        $selected = ($listings[$i]['id'] == $classified->getNumber('listing_id'))
                            || ($listings[$i]['id'] == $listing_id);
                        // option tag
                        printf(
                            '<option %s value="%d">%s</option>',
                            $selected ? 'selected' : '',
                            $listings[$i]['id'],
                            $listings[$i]['title']
                        );
                        // close select
                        $i === ($count - 1) and printf(
                            '</select>'
                        );
                    }
                    ?>
                </div>
                <?php
            }
            ?>

        </div>


        <div class="panel-heading"><?= system_showText(LANG_BASIC_INFO) ?></div>

        <div class="panel-body">

            <div class="form-group row" id="tour-categories">

                <?
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CATEGORY_PLURAL),
                    "tour-categories");
                ?>
                <div class="col-xs-12">
                    <label for="categories"><?= system_showText(LANG_LABEL_CATEGORY_PLURAL); ?></label>
                </div>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="categories"
                           placeholder="<?= system_showText(LANG_SELECT_CATEGORIES); ?>">
                </div>

                <input type="hidden" name="return_categories" value="">

                <?= str_replace("<select", "<select class=\"hidden\"", $feedDropDown); ?>

                <div class="col-sm-3">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                            data-target="#modal-categories"
                            id="action-categoryList"><?= system_showText(LANG_LABEL_SELECT); ?> <i
                            class="ionicons ion-ios7-photos-outline"></i></button>
                </div>

            </div>

            <? if (!$members) { ?>
                <div class="form-group row">
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ACCOUNT),
                        "tour-owner");
                    ?>
                    <div class="col-sm-4" id="tour-owner">
                        <label for="account_id"><?= system_showText(LANG_LABEL_ACCOUNT); ?></label>
                        <input type="text" class="form-control mail-select" name="account_id" id="account_id"
                               placeholder="<?= system_showText(LANG_LABEL_ACCOUNT); ?>" value="<?= $account_id ?>">
                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                    </div>
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_STATUS),
                        "tour-status");
                    ?>
                    <div class="col-sm-4" id="tour-status">
                        <label for="status"><?= system_showText(LANG_LABEL_STATUS); ?></label>
                        <?= ($statusDropDown) ?>
                    </div>
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_RENEWAL_DATE),
                        "tour-expiration");
                    ?>
                    <div class="col-sm-4" id="tour-expiration">
                        <label for="expirationdate"><?= system_showText(LANG_LABEL_RENEWAL_DATE); ?></label>
                        <input type="text" class="form-control date-input" id="expirationdate" name="renewal_date"
                               value="<?= $renewal_date ?>"
                               placeholder="<?= system_showText(LANG_SITEMGR_CHANGEEXPIRATIONDATE) ?>">
                    </div>
                </div>

            <? } ?>

            <? if (is_array($array_fields) && in_array("summary_description", $array_fields)) {
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_SUMMARY_DESCRIPTION),
                    "tour-summary");
                ?>
                <div class="form-group" id="tour-summary">
                    <label for="summary"><?= system_showText(LANG_LABEL_SUMMARY_DESCRIPTION) ?></label>
                    <textarea id="summary" name="summarydesc"
                              class="textarea-counter form-control <?= ($highlight == "description" && !$summarydesc ? "highlight" : "") ?>" <?= (!$id) ? " onblur=\"populateField(this.value, 'seo_description', true);\" " : "" ?>
                              rows="2" data-chars="250" data-msg="<?= system_showText(LANG_MSG_CHARS_LEFT) ?>"
                              placeholder="<?= system_showText(LANG_HOLDER_CLASSIFIEDSUMMARY); ?>"><?= $summarydesc; ?></textarea>
                </div>
            <? } ?>

            <? if (is_array($array_fields) && in_array("long_description", $array_fields)) {
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_DESCRIPTION),
                    "tour-description");
                ?>
                <div class="form-group" id="tour-description">
                    <label for="full-description"><?= system_showText(LANG_LABEL_DESCRIPTION) ?></label>
                    <textarea name="detaildesc" id="full-description"
                              class="form-control <?= ($highlight == "description" && !$detaildesc ? "highlight" : "") ?>"
                              rows="5"
                              placeholder="<?= system_showText(LANG_HOLDER_CLASSIFIEDDESCRIPTION); ?>"><?= $detaildesc ?></textarea>
                </div>
            <? } ?>

            <?
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH),
                "tour-keywords");
            ?>
            <div class="form-group" id="tour-keywords">
                <label for="keywords"><?= system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH) ?></label>
                <input type="text" name="keywords" id="keywords"
                       class="form-control tag-input <?= ($highlight == "additional" && !$keywords ? "highlight" : "") ?>"
                       placeholder="<?= system_showText(LANG_HOLDER_KEYWORDS); ?>" value="<?= $keywords ?>">
                <p class="help-block small"><?= ucfirst(system_showText(LANG_LABEL_MAX)); ?> <?= MAX_KEYWORDS ?> <?= system_showText(LANG_LABEL_KEYWORDS); ?></p>
            </div>

        </div>

    </div>

    <!-- Panel Contact Informartion  -->
    <?
    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CONTACT_INFORMATION),
        "tour-contact");
    ?>
    <div class="panel panel-form" id="tour-contact">

        <div class="panel-heading">
            <?= system_showText(LANG_LABEL_CONTACT_INFORMATION) ?>
        </div>

        <div class="panel-body">

            <div class="form-group row">

                <? if (is_array($array_fields) && in_array("contact_name", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="contactname"><?= system_showText(LANG_LABEL_CONTACT_NAME); ?></label>
                        <input type="text" name="contactname" id="contactname" value="<?= $contactname ?>"
                               class="form-control <?= ($highlight == "description" && !$contactname ? "highlight" : "") ?>">
                    </div>
                <? } ?>

                <? if (is_array($array_fields) && in_array("contact_email", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="email"><?= system_showText(LANG_LABEL_CONTACT_EMAIL); ?></label>
                        <input type="email" name="email" id="email" value="<?= $email ?>"
                               class="form-control <?= ($highlight == "description" && !$email ? "highlight" : "") ?>">
                    </div>
                <? } ?>

            </div>

            <div class="form-group row">

                <? if (is_array($array_fields) && in_array("contact_phone", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="phone"><?= system_showText(LANG_LABEL_CONTACT_PHONE); ?></label>
                        <input type="tel" name="phone" id="phone" value="<?= $phone ?>"
                               class="form-control <?= ($highlight == "description" && !$phone ? "highlight" : "") ?>">
                    </div>
                <? } ?>

                <? if (is_array($array_fields) && in_array("fax", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="fax"><?= system_showText(LANG_LABEL_CONTACT_FAX); ?></label>
                        <input type="tel" name="fax" id="fax" value="<?= $fax ?>"
                               class="form-control <?= ($highlight == "description" && !$fax ? "highlight" : "") ?>">
                    </div>
                <? } ?>

            </div>

            <div class="form-group row">

                <? if (is_array($array_fields) && in_array("url", $array_fields)) { ?>
                    <div class="col-sm-12">
                        <label for="url"><?= system_showText(LANG_LABEL_URL); ?></label>
                        <input type="url" name="url" id="url" value="<?= $url ?>"
                               class="form-control <?= ($highlight == "additional" && !$url ? "highlight" : "") ?>"
                               maxlength="255">
                    </div>
                <? } ?>

            </div>

            <div class="form-group row">
                <div class="col-xs-12">
                    <label for="address"><?= system_showText(system_showText(LANG_LABEL_ADDRESS1)); ?></label>
                    <input type="text" name="address" id="address" value="<?= $address ?>" maxlength="50"
                           class="form-control <?= ($highlight == "description" && !$address ? "highlight" : "") ?>" <?= ($loadMap ? "onblur=\"loadMap(document.classified);\"" : "") ?>
                           placeholder="<?= system_showText(LANG_ADDRESS_EXAMPLE) ?>">
                </div>
            </div>

            <div class="form-group row">

                <div class="col-sm-6">
                    <label for="address2"><?= system_showText(system_showText(LANG_LABEL_ADDRESS2)); ?></label>
                    <input type="text" name="address2" id="address2" value="<?= $address2 ?>" maxlength="50"
                           class="form-control <?= ($highlight == "description" && !$address2 ? "highlight" : "") ?>"
                           placeholder="<?= system_showText(LANG_ADDRESS2_EXAMPLE) ?>">
                </div>

                <div class="col-sm-6">
                    <label for="zip_code"><?= string_ucwords(ZIPCODE_LABEL) ?></label>
                    <input type="text" name="zip_code" id="zip_code" value="<?= $zip_code ?>" maxlength="10"
                           class="form-control <?= ($highlight == "description" && !$zip_code ? "highlight" : "") ?>" <?= ($loadMap ? "onblur=\"loadMap(document.classified);\"" : "") ?>>
                </div>
            </div>

            <?
            include(EDIRECTORY_ROOT."/includes/code/load_location.php");

            if ($loadMap) { ?>

                <div class="form-group row">
                    <div class="col-xs-12" id="tableMapTuning" <?= ($hasValidCoord ? "" : "style=\"display: none\"") ?>>
                        <div id="map" style="height: 200px"></div>
                        <input type="hidden" name="latitude_longitude" id="myLatitudeLongitude"
                               value="<?= $latitude_longitude ?>">
                        <input type="hidden" name="map_zoom" id="map_zoom" value="<?= $map_zoom ?>">
                        <input type="hidden" name="latitude" id="latitude" value="<?= $latitude ?>">
                        <input type="hidden" name="longitude" id="longitude" value="<?= $longitude ?>">
                    </div>
                </div>

            <? } ?>

        </div>

    </div>

    <? include(INCLUDES_DIR."/forms/form-module-seocenter.php"); ?>

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
                    <? if (((!$classified->getNumber("id")) || (($classified) && ($classified->needToCheckOut())) || (string_strpos($url_base,
                                "/".SITEMGR_ALIAS."")) || (($classified) && ($classified->getPrice('monthly') <= 0 && $classified->getPrice('yearly') <= 0))) && ($process != "signup")
                    ) { ?>
                        <label for="discount_id"><?= system_showText(LANG_HOLDER_DISCOUNTCODE); ?></label>
                        <input type="text" name="discount_id" id="discount_id" class="form-control"
                               value="<?= $discount_id ?>" maxlength="10" placeholder="">
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

    <? if ($levelObjAux->getdetail($level) == "y") { ?>

        <!-- Cover Image-->
        <div class="panel panel-form-media">
            <div class="panel-heading">
                <?= system_showText(LANG_LABEL_COVERIMAGE); ?>
                <span class="btn btn-sm btn-danger delete pull-right <?= (!(int)$cover_id ? "hidden" : "") ?>"
                      id="buttonReset">
                    <i class="icon-ion-ios7-trash-outline"
                       onclick="sendCoverImage('classified', '<?= $_SERVER["PHP_SELF"] ?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'deleteCover');"></i>
                </span>
                <div class="pull-right">
                    <input type="file" name="cover-image" class="file-noinput"
                           onchange="sendCoverImage('classified', '<?= $_SERVER["PHP_SELF"] ?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'uploadCover');">
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
                        <input type="hidden" name="cover_id" value="<?= $cover_id; ?>">
                        <?
                    } ?>
                </div>

                <input type="hidden" name="curr_cover_id" value="<?= $cover_id; ?>">

                <p id="returnMessage" class="alert alert-warning" style="display:none;"></p>

            </div>
            <div class="panel-footer text-center">
                <p class="small text-muted"><?= system_showText(LANG_LABEL_RECOMMENDED_DIMENSIONS); ?>
                    : <?= COVER_IMAGE_WIDTH ?> x <?= COVER_IMAGE_HEIGHT ?> px (JPG, GIF <?= system_showText(LANG_OR); ?>
                    PNG)</p>
                <p class="small text-muted"><?= system_showText(LANG_MSG_MAX_FILE_SIZE) ?> <?= UPLOAD_MAX_SIZE; ?>
                    MB. <?= system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED); ?></p>
            </div>
        </div>

    <? } ?>

        <!-- Images-->
        <?
        $renderImageFields = false;

        if ((is_array($array_fields) && in_array("main_image", $array_fields)) || $levelMaxImages > 0) {
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_IMAGE_PLURAL), "tour-images");
            $renderImageFields = true;
        }
        $imageUploader->buildform($renderImageFields);
        ?>

        <!-- Video-->
        <? if ($levelObjAux->getVideo($level) == "y") {
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_VIDEO), "tour-video");
            ?>
            <div class="panel panel-form-media" id="tour-video">
                <div class="panel-heading">
                    <?=system_showText(LANG_LABEL_VIDEO);?>
                </div>
                <div class="panel-body form-group">
                    <div class="center-block text-center">
                        <i id="icon" class="icon-movie"></i>
                        <div id="videoMsg" class="alert alert-warning fade in hidden" role="alert"><small><?=system_showText(LANG_VIDEO_NOTFOUND)?></small></div>
                        <div id="video_frame" style="display:none"></div>
                        <input type="url" name="video_url" id="video" value="<?=$video_url?>" class="form-control <?=($highlight == "media" && !$video_snippet ? "highlight" : "")?>" placeholder="<?=system_showText(LANG_HOLDER_VIDEO);?>" onchange="autoEmbed();">
                        <input type="hidden" id="video_snippet" name="video_snippet" value="<?=$video_snippet?>">
                        <br>
                        <input type="text" maxlength="250" name="video_description" value="<?=$video_description?>" class="form-control" maxlength="250" placeholder="<?=system_showText(LANG_HOLDER_VIDEOCAPTION);?>">
                    </div>
                </div>
            </div>
        <? } ?>


        <!-- Attached File-->
        <? if ($levelObjAux->getAdditionalFiles($level) == "y") {
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ATTACH_ADDITIONAL_FILE), "tour-file");
            ?>
            <div class="panel panel-form-media" id="tour-file">
                <div class="panel-heading">
                    <?=system_showText(LANG_LABEL_ATTACH_ADDITIONAL_FILE)?>
                </div>
                <div class="panel-body">

                    <? if ($classified->getString("attachment_file") && file_exists(EXTRAFILE_DIR."/".$classified->getString("attachment_file"))) { ?>
                        <div class="files uploaded-files">
                            <div class="row item" id="div_attachment">
                                <div class="col-sm-2 col-xs-4">
                                    <span class="icon-ion-ios7-paper-outline icon-3x"></span>
                                </div>
                                <div class="col-sm-3 col-xs-8 pull-right">
                                    <p><span onclick="removeAttachment();" class="btn btn-sm btn-primary  pull-right action-delete-image"><i class="icon-ion-ios7-trash-outline"></i></span></p>
                                    <input type="hidden" name="remove_attachment" id="remove_attachment" value="">
                                </div>
                                <div class="col-sm-7 col-xs-12">
                                    <strong><?=($classified->getString("attachment_caption") ? $classified->getString("attachment_caption") : system_showText(LANG_MSG_ATTACHMENT_HAS_NO_CAPTION))?></strong>
                                    <p>
                                        <a href="<?=EXTRAFILE_URL?>/<?=$classified->getString("attachment_file")?>" target="_blank">
                                            <?=$classified->getString("attachment_file")?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <? } ?>

                    <input type="file" name="attachment_file" class="file-withinput" maxlength="250" class="filestyle upload-files <?=($highlight == "additional" && !$attachment_file ? "highlight" : "")?>">


                    <br>

                    <div class="center-block text-center">
                        <input type="text" name="attachment_caption" value="<?=$attachment_caption?>" class="form-control" maxlength="250" placeholder="<?=system_showText(LANG_HOLDER_ATTACHCAPTION);?>">
                    </div>

                </div>
                <div class="panel-footer text-center">
                    <p class="small text-muted"><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB</p>
                    <p class="small text-muted"><?=system_showText(LANG_MSG_ALLOWED_FILE_TYPES)?>: pdf, doc, docx, txt, jpg, gif, png</p>
                </div>
            </div>
        <? } ?>
    </div>

