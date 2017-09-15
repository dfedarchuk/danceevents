<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-listing.php
	# ----------------------------------------------------------------------------------------------------

    $levelObjAux = new ListingLevel();
?>

    <div class="col-md-7">

        <!-- Item Name is separated from all informations -->
        <div class="form-group" id="tour-title">
            <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                system_fieldsGuide($arrayTutorial, $counterTutorial, (($template_title_field !== false) ? $template_title_field[0]["label"] : system_showText(LANG_LISTING_TITLE)), "tour-title");
            ?>
            <label for="name" class="label-lg"><?=(($template_title_field !== false) ? $template_title_field[0]["label"] : system_showText(LANG_LISTING_TITLE));?></label>
            <? } else {
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LISTING_TITLE), "tour-title");
            ?>
            <label for="name" class="label-lg"><?=system_showText(LANG_LISTING_TITLE);?></label>
            <? } ?>
            <input type="text" class="form-control input-lg" name="title" id="name" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."'); populateField(this.value, 'seo_title', true); \" " : ""?> placeholder="<?=(LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && $template_title_field !== false && $template_title_field[0]["instructions"] ? $template_title_field[0]["instructions"] : system_showText(LANG_HOLDER_LISTINGTITLE))?>" required>
        </div>

        <!-- Panel Basic Information  -->
        <div class="panel panel-form">

            <? if (!$members) { ?>

            <div class="form-group row">
                <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && system_showListingTypeDropdown($listingtemplate_id)) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LISTING_TEMPLATE), "tour-template");
                ?>
                <div class="col-sm-6 selectize" id="tour-template">
                    <label for="listingtemplate_id"><?=system_showText(LANG_LISTING_TEMPLATE);?></label>
                    <select name="listingtemplate_id" id="listingtemplate_id" onchange="changeModuleLevel();">
                        <?
                        $dbMain = db_getDBObject(DEFAULT_DB, true);
                        $dbObjLT = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                        $sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY editable, title";
                        $resultLT = $dbObjLT->query($sqlLT);
                        while ($rowLT = mysql_fetch_assoc($resultLT)) {
                            $listingtemplate = new ListingTemplate($rowLT["id"]);
                            echo "<option value=\"".$listingtemplate->getNumber("id")."\"";
                            if ($listingtemplate_id == $listingtemplate->getNumber("id")) {
                                echo " selected";
                            }
                            echo ">".$listingtemplate->getString("title");
                            if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <? } else { ?>
                    <input type="hidden" name="listingtemplate_id" value="<?=$listingtemplate_id?>">
                <? } ?>

                <?
                system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LISTING_LEVEL), "tour-level");
                ?>
                <div class="col-sm-6 selectize" id="tour-level">
                    <label for="level"><?=system_showText(LANG_LISTING_LEVEL)?></label>
                    <select name="level" id="level" onchange="changeModuleLevel();">
                    <?
                    $levelvalues = $levelObjAux->getLevelValues();
                    foreach ($levelvalues as $levelvalue) { ?>
                        <option value="<?=$levelvalue?>" <?=(($levelArray[$levelObjAux->getLevel($levelvalue)]) ? "selected" : "")?>>
                            <?=$levelObjAux->showLevel($levelvalue);?>
                        </option>
                    <? } ?>
                    </select>
                </div>

            </div>

            <? } ?>

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

                    <? if (((!$listing->getNumber("id")) || $listing->getNumber("package_id")>0 || (($listing) && ($listing->needToCheckOut())) || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || (($listing) && ($listing->getPrice('monthly') <= 0 && $listing->getPrice('yearly') <= 0) || $listing->getNumber("package_id") > 0)) && ($process != "signup")) { ?>

                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-categories" id="action-categoryList"><?=system_showText(LANG_LABEL_SELECT);?> <i class="ionicons ion-ios7-photos-outline"></i></button>
                    </div>

                    <? } ?>

                </div>

                <? if (!$members) { ?>
                <div class="form-group row">
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ACCOUNT), "tour-owner");
                    ?>
                    <div class="col-sm-4" id="tour-owner">
                        <label for="account_id"><?=system_showText(LANG_LABEL_ACCOUNT);?></label>
                        <input type="text" class="form-control mail-select" name="account_id" id="account_id" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?= is_numeric($account_id)? $account_id : 0?>">
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

                <div class="form-group row">
                    <?
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_SITEMGR_CLAIM_CLAIMS), "tour-claim");
                    ?>
                    <div class="col-xs-12" id="tour-claim">
                        <div class="checkbox">
                            <label for="claim">
                                <input type="checkbox" name="claim_disable" id="claim" value="y" <? if ($claim_disable == "y") { echo "checked"; } ?>>
                                <?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_DISABLECLAIM)?>
                            </label>
                        </div>
                    </div>
                </div>
                <? } ?>

                <? if (is_array($array_fields) && in_array("summary_description", $array_fields)) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_SUMMARY_DESCRIPTION), "tour-summary");
                ?>
                <div class="form-group" id="tour-summary">
                    <label for="summary"><?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?></label>
                    <textarea id="summary" name="description" class="textarea-counter form-control <?=($highlight == "description" && !$description ? "highlight" : "")?>" <?=(!$id) ? " onblur=\"populateField(this.value, 'seo_description', true);\" " : ""?> rows="3" data-chars="250" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>" placeholder="<?=system_showText(LANG_HOLDER_LISTINGSUMMARY);?>"><?=$description;?></textarea>
                </div>
                <? } ?>

                <? if (is_array($array_fields) && in_array("long_description", $array_fields)) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_DESCRIPTION), "tour-description");
                ?>
                <div class="form-group" id="tour-description">
                    <label for="full-description"><?=system_showText(LANG_LABEL_DESCRIPTION)?></label>
                    <textarea name="long_description" id="full-description" class="form-control <?=($highlight == "description" && !$long_description ? "highlight" : "")?>" rows="5" placeholder="<?=system_showText(LANG_HOLDER_LISTINGDESCRIPTION);?>"><?=$long_description?></textarea>
                </div>
                <? } ?>

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

        <!-- Panel Contact Information  -->
        <?
        system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CONTACT_INFORMATION), "tour-contact");
        ?>
        <div class="panel panel-form" id="tour-contact">

            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_CONTACT_INFORMATION)?>
            </div>

            <div class="panel-body">
                <div class="form-group row">
                    <? if (is_array($array_fields) && in_array("email", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="email"><?=system_showText(LANG_LABEL_EMAIL)?></label>
                        <input type="email" name="email" id="email" value="<?=$email?>" maxlength="50" class="form-control <?=($highlight == "description" && !$email ? "highlight" : "")?>" placeholder="Ex: sample@email.com">
                    </div>
                    <? } ?>

                    <? if (is_array($array_fields) && in_array("url", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="website"><?=system_showText(LANG_LABEL_URL)?></label>
                        <input type="url" name="url" id="website" value="<?=$url?>" maxlength="255" class="form-control <?=($highlight == "additional" && !$url ? "highlight" : "")?>" placeholder="Ex: www.website.com">
                    </div>
                    <? } ?>
                </div>

                <div class="form-group row">
                    <? if (is_array($array_fields) && in_array("phone", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="phone"><?=system_showText(LANG_LABEL_PHONE)?></label>
                        <input type="tel" name="phone" value="<?=$phone?>" class="form-control <?=($highlight == "description" && !$phone ? "highlight" : "")?>" id="phone">
                    </div>
                    <? } ?>

                    <? if (is_array($array_fields) && in_array("fax", $array_fields)) { ?>
                    <div class="col-sm-6">
                        <label for="fax"><?=system_showText(LANG_LABEL_FAX)?></label>
                        <input type="tel" name="fax" value="<?=$fax?>" class="form-control <?=($highlight == "additional" && !$fax ? "highlight" : "")?>" id="fax">
                    </div>
                    <? } ?>
                </div>

                <div class="form-group row">
                    <div class="col-xs-12">
                        <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && $template_address_field !== false) { ?>
                        <label for="address"><?=$template_address_field[0]["label"]?></label>
                        <? } else { ?>
                        <label for="address"><?=system_showText(system_showText(LANG_LABEL_ADDRESS1));?></label>
                        <? } ?>
                        <input type="text" name="address" id="address" value="<?=$address?>" maxlength="100" class="form-control <?=($highlight == "description" && !$address ? "highlight" : "")?>" <?=($loadMap ? "onblur=\"loadMap(document.listing);\"" : "")?> placeholder="<?=(LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && $template_address_field !== false && $template_address_field[0]["instructions"] ? $template_address_field[0]["instructions"] : system_showText(LANG_ADDRESS_EXAMPLE))?>">
                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-6">
                        <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && $template_address2_field !== false) { ?>
                        <label for="address2"><?=$template_address2_field[0]["label"]?></label>
                        <? } else { ?>
                        <label for="address2"><?=system_showText(system_showText(LANG_LABEL_ADDRESS2));?></label>
                        <? } ?>
                        <input type="text" name="address2" id="address2" value="<?=$address2?>" maxlength="100" class="form-control <?=($highlight == "description" && !$address2 ? "highlight" : "")?>" placeholder="<?=(LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && $template_address2_field !== false && $template_address2_field[0]["instructions"] ? $template_address2_field[0]["instructions"] : system_showText(LANG_ADDRESS2_EXAMPLE))?>">
                    </div>

                    <div class="col-sm-6">
                        <label for="zip_code"><?=string_ucwords(ZIPCODE_LABEL)?></label>
                        <input type="text" name="zip_code" id="zip_code" value="<?=$zip_code?>" maxlength="20" class="form-control <?=($highlight == "description" && !$zip_code ? "highlight" : "")?>" <?=($loadMap ? "onblur=\"loadMap(document.listing);\"" : "")?>>
                    </div>
                </div>

                <?
                include(EDIRECTORY_ROOT."/includes/code/load_location.php");

                if ($loadMap) { ?>

                    <div class="form-group row">
                        <div class="col-xs-12" id="tableMapTuning" <?=($hasValidCoord ? "" : "style=\"display: none\"" )?>>
                            <div id="map" style="height: 200px"></div>
                            <input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>">
                            <input type="hidden" name="map_zoom" id="map_zoom" value="<?=$map_zoom?>">
                            <input type="hidden" name="latitude" id="latitude" value="<?=$latitude?>">
                            <input type="hidden" name="longitude" id="longitude" value="<?=$longitude?>">
                        </div>
                    </div>

                <? } ?>

                <? if (is_array($array_fields) && in_array("locations", $array_fields)) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_REFERENCE), "tour-reference");
                ?>
                    <div class="form-group row">
                        <div class="col-xs-12" id="tour-reference">
                            <label for="reference"><?=system_showText(LANG_LABEL_REFERENCE)?></label>
                            <textarea id="reference" name="locations" class="form-control <?=($highlight == "description" && !$locations ? "highlight" : "")?>" rows="5" placeholder="<?=system_showText(LANG_LABEL_LOCATIONS_TIP);?>"><?=$locations;?></textarea>
                        </div>
                    </div>

                <? } ?>

            </div>

        </div>

        <!-- Panel Additional Information  -->
        <? if (
                (is_array($array_fields) && in_array("social_network", $array_fields)) ||
                (is_array($array_fields) && in_array("features", $array_fields)) ||
                (is_array($array_fields) && in_array("hours_of_work", $array_fields)) ||
                (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on")
                ) { ?>
        <div class="panel panel-form">

            <div class="panel-heading">
                <?=system_showText(LANG_EXTRA_FIELDS);?>
            </div>

            <div class="panel-body">

                <? if (is_array($array_fields) && in_array("social_network", $array_fields)) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_SOCIALNETWORK), "tour-socialnetwork"); ?>
                    <div id="tour-socialnetwork">
                        <? foreach ($socialNetworkFields as $socialNetwork => $value) {
                        $fieldName = sprintf('social_network['.$socialNetworkFieldsDefaultName.']', $socialNetwork);
                        ?>
                        <div class="form-group">
                            <label for="<?=$fieldName?>"><?=$value['label']?></label>
                            <input type="text" name="<?=$fieldName?>" class="form-control <?=($highlight == "additional" && !$fieldName ? "highlight" : "")?>" id="<?=$fieldName?>" value="<?=isset($social_network[$socialNetwork]) ? $social_network[$socialNetwork] : ''?>" placeholder="<?=$value['placeholder']?>">
                        </div>
                        <? } ?>
                    </div>
                <? } ?>

                <? if (is_array($array_fields) && in_array("features", $array_fields)) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_FEATURES), "tour-features");
                ?>
                <div class="form-group" id="tour-features">
                    <label for="features"><?=system_showText(LANG_LABEL_FEATURES)?></label>
                    <textarea name="features" class="form-control <?=($highlight == "additional" && !$features ? "highlight" : "")?>" id="features" rows="5" placeholder="<?=system_showText(LANG_HOLDER_FEATURES);?>"><?=$features?></textarea>
                </div>
                <? } ?>

                <? if (is_array($array_fields) && in_array("hours_of_work", $array_fields)) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_HOURS_OF_WORK), "tour-hours");
                ?>
                <div class="form-group" id="tour-hours">
                    <label for="hours"><?=system_showText(LANG_LABEL_HOURS_OF_WORK)?></label>
                    <textarea name="hours_work" class="form-control <?=($highlight == "additional" && !$hours_work ? "highlight" : "")?>" id="hours" rows="5" placeholder="<?=system_showText(LANG_HOURWORK_SAMPLE_1."\n".LANG_HOURWORK_SAMPLE_2."\n".LANG_HOURWORK_SAMPLE_3)?>"><?=$hours_work?></textarea>
                </div>
                <? }

                unset($_SESSION["custom_type_field"]);
                if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                    include(INCLUDES_DIR."/forms/form-listing-extra-fields.php");
                } ?>

            </div>

        </div>

        <? } ?>

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
                    <? if (((!$listing->getNumber("id")) || $listing->getNumber("package_id") > 0 || (($listing) && ($listing->needToCheckOut())) || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || (($listing) && ($listing->getPrice() <= 0))) && ($process != "signup")) { ?>
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

        <? if ($levelObjAux->getdetail($level) == "y") { ?>

        <!-- Cover Image-->
        <div class="panel panel-form-media">
            <div class="panel-heading">
                <?= system_showText(LANG_LABEL_COVERIMAGE);?>
                <span class="btn btn-sm btn-danger delete pull-right <?=(!(int)$cover_id ? "hidden" : "")?>" id="buttonReset">
                    <i class="icon-ion-ios7-trash-outline" onclick="sendCoverImage('listing', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'deleteCover');" ></i>
                </span>
                <div class="pull-right">
                    <input type="file" name="cover-image" class="file-noinput" onchange="sendCoverImage('listing', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'uploadCover');">
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
        <? if (is_array($array_fields) && in_array("video", $array_fields)) {
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
        <? if (is_array($array_fields) && in_array("attachment_file", $array_fields)) {
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ATTACH_ADDITIONAL_FILE), "tour-file");
        ?>
        <div class="panel panel-form-media" id="tour-file">
            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_ATTACH_ADDITIONAL_FILE)?>
            </div>
            <div class="panel-body">

                <? if ($listing->getString("attachment_file") && file_exists(EXTRAFILE_DIR."/".$listing->getString("attachment_file"))) { ?>
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
                            <strong><?=($listing->getString("attachment_caption") ? $listing->getString("attachment_caption") : system_showText(LANG_MSG_ATTACHMENT_HAS_NO_CAPTION))?></strong>
                            <p>
                                <a href="<?=EXTRAFILE_URL?>/<?=$listing->getString("attachment_file")?>" target="_blank">
                                    <?=$listing->getString("attachment_file")?>
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

        <!-- Badges-->
        <? if (is_array($array_fields) && in_array("badges", $array_fields) && $editorChoices) {
             system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LISTING_DESIGNATION_PLURAL), "tour-badges");
        ?>
        <div class="panel panel-form-media" id="tour-badges">
            <div class="panel-heading">
                <?=system_showText(LANG_LISTING_DESIGNATION_PLURAL);?>
                <? if (!$members) { ?>
                    <div class="pull-right">
                        <small><a class="text-info" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/awards/"?>" target="_blank"><?=system_showText(LANG_HOLDER_BADGES);?></a></small>
                    </div>
                <? } ?>
            </div>
            <div class="panel-body">
                <div class="text-center form-group form-horizontal">
                    <?
                    foreach ($editorChoices as $editor) {
                        $listingChoiceObj = new ListingChoice($editor->getNumber("id"), $id);
                        $imageObj = new Image($editor->getNumber("image_id"));
                        $checkedStr = "";
                        if ($_SERVER['REQUEST_METHOD'] == "POST") {
                            if ($_POST["choice"]) {
                                if (in_array($editor->getNumber("id"), $_POST["choice"])) {
                                    $checkedStr = "checked";
                                }
                            }
                        } elseif ($listingChoiceObj->getNumber("listing_id")) {
                            $checkedStr = "checked";
                        }
                    ?>
                    <div class="checkbox-inline edir-badge">
                        <label>
                            <? if ($imageObj->imageExists()) { ?>
                            <span class="badge">
                                <?=$imageObj->getTag(IS_UPGRADE == "on" ? true : false, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $editor->getString("name", false))?>
                            </span>
                            <? } ?>
                            <input type="checkbox" name="choice[]" <?=$checkedStr?> value="<?=$editor->getNumber("id")?>">
                            <?=$editor->getString("name")?>
                        </label>
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>
        <? } ?>

    </div>
