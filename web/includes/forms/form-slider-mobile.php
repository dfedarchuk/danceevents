<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-slider-mobile.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-6">

        <div class="form-group">
            <label for="<?=$slider_number?><?=$slideArea?>_title"><?=system_showText(LANG_LABEL_DESCRIPTION)?></label>
            <input class="form-control" type="text" id="<?=$slider_number?><?=$slideArea?>_title" name="<?=$slider_number?>_title" value="<?=${"array_slider".$slideArea}[$slider_number]["title"]?>" maxlength="40" placeholder="<?=system_showText(LANG_SITEMGR_SLIDER_TITLE_EXPLAIN)?>">
        </div>

        <div class="form-group">
            <label for="<?=$slider_number?><?=$slideArea?>_link"><?=system_showText(LANG_SITEMGR_LINKSTO)?></label>
            <input class="form-control" type="text" id="<?=$slider_number?><?=$slideArea?>_link" name="<?=$slider_number?>_link" value="<?=${"array_slider".$slideArea}[$slider_number]["link"]?>" placeholder="<?=system_showText(LANG_SITEMGR_SLIDER_EXPLAIN_LINK)?>">
            <input type="hidden" id="<?=$slider_number?><?=$slideArea?>_autocomplete_id" name="<?=$slider_number?><?=$slideArea?>_autocomplete_id" value="<?=${"array_slider".$slideArea}[$slider_number]["autocomplete_id"]?>">
            <input type="hidden" id="<?=$slider_number?><?=$slideArea?>_autocomplete_module" name="<?=$slider_number?><?=$slideArea?>_autocomplete_module" value="<?=${"array_slider".$slideArea}[$slider_number]["autocomplete_module"]?>">
            <p class="help-block"><?=system_showText(constant("LANG_SITEMGR_SLIDERMOBILE_LINK_TIP_".strtoupper($slideArea)))?></p>
        </div>

    </div>

    <input type="hidden" id="<?=$slider_number?><?=$slideArea?>_id" name="<?=$slider_number?>_id" value="<?=${"array_slider".$slideArea}[$slider_number]["id"]?>">

    <div class="col-sm-4">
        <div class="form-group">
            <label><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?> <small class="text-muted">(<?=IMAGE_MOBILE_SLIDER_WIDTH?>px x <?=IMAGE_MOBILE_SLIDER_HEIGHT?>px JPG, GIF <?=system_showText(LANG_OR);?> PNG)</small></label>
            <p class="help-block"><?=system_showText(LANG_SITEMGR_SLIDER_WARNING);?></p>
            <input class="pull-right file-withinput" size="38" type="file" name="<?=$slider_number?>_image">
            <input type="hidden" name="<?=$slider_number?>_image_id" value="<?=${"array_slider".$slideArea}[$slider_number]["image_id"]?>"><br>
        </div>
    </div>

    <? if (${"array_slider".$slideArea}[$slider_number]["image_id"]) { ?>
        <div class="col-sm-12">
        <?
        $imageObj = new Image(${"array_slider".$slideArea}[$slider_number]["image_id"]);
        if ($imageObj->imageExists()) {
            echo $imageObj->getTag(true, IMAGE_MOBILE_SLIDER_WIDTH, IMAGE_MOBILE_SLIDER_HEIGHT, (${"array_slider".$slideArea}[$slider_number]["title"]), true, false, "slider-preview");
        } else { ?>
            <img class="slider-preview" src="https://placehold.it/<?=IMAGE_MOBILE_SLIDER_WIDTH?>x<?=IMAGE_MOBILE_SLIDER_HEIGHT?>"/>
        <? } ?>

        </div>
    <?
    } ?>

    <div class="footer-action col-sm-12 text-center">
        <button type="button" class="btn btn-primary action-save" <?=(${"array_slider".$slideArea}[$slider_number]["link"] ? "" : "disabled")?> data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "document.slider$slideArea.submit();"?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
    </div>
