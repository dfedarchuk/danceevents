<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-slider.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-6">

        <div class="form-group">
            <label for="<?=$slider_number?>_title"><?=system_showText(LANG_SITEMGR_SLIDER_TITLE)?></label>
            <input class="form-control" type="text" id="<?=$slider_number?>_title" name="<?=$slider_number?>_title" value="<?=$array_slider[$slider_number]["title"]?>" maxlength="50" placeholder="<?=system_showText(LANG_SITEMGR_SLIDER_TITLE_EXPLAIN)?>">
        </div>

        <div class="form-group">
            <label for="<?=$slider_number?>_summary"><?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?></label>
            <textarea class="form-control textarea-counter" id="<?=$slider_number?>_summary" name="<?=$slider_number?>_summary" rows="5" cols="1" data-chars="250" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>"><?=$array_slider[$slider_number]["summary"]?></textarea>
        </div>

        <div class="form-group">
            <label for="<?=$slider_number?>_link"><?=system_showText(LANG_SITEMGR_SLIDER_LINK_LABEL)?></label>
            <input class="form-control" id="<?=$slider_number?>_link" type="text" name="<?=$slider_number?>_link" value="<?=$array_slider[$slider_number]["link"]?>" placeholder="<?=system_showText(LANG_SITEMGR_SLIDER_EXPLAIN_LINK)?>">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="<?=$slider_number?>_target_window" value="self" <?=(!$array_slider[$slider_number]["target"] || $array_slider[$slider_number]["target"] == "blank" ? "checked='checked'" : "")?>><?=system_showText(LANG_OPENNEWWINDOW);?>
            </label>
        </div>

    </div>

    <input type="hidden" id="<?=$slider_number?>web_id" name="<?=$slider_number?>_id" value="<?=$array_slider[$slider_number]["id"]?>">

    <div class="col-sm-4">
        <div class="form-group">
            <label><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?> <small class="text-muted">(<?=IMAGE_SLIDER_WIDTH?>px x <?=IMAGE_SLIDER_HEIGHT?>px JPG, GIF <?=system_showText(LANG_OR);?> PNG)</small></label>
            <p class="help-block"><?=system_showText(LANG_SITEMGR_SLIDER_WARNING);?></p>
            <input class="pull-right file-withinput" size="38" type="file" name="<?=$slider_number?>_image">
            <input type="hidden" id="<?=$slider_number?>_image_id" name="<?=$slider_number?>_image_id" value="<?=$array_slider[$slider_number]["image_id"]?>"><br>
        </div>
    </div>

    <? if ($array_slider[$slider_number]["image_id"]) { ?>
        <div class="col-sm-12">
        <?
        $imageObj = new Image($array_slider[$slider_number]["image_id"]);
        if ($imageObj->imageExists()) {
            echo $imageObj->getTag(true, IMAGE_SLIDER_WIDTH, IMAGE_SLIDER_HEIGHT, ($array_slider[$slider_number]["title"]), true, false, "slider-preview");
        } else { ?>
            <img class="slider-preview" src="https://placehold.it/<?=IMAGE_SLIDER_WIDTH?>x<?=IMAGE_SLIDER_HEIGHT?>"/>
        <? } ?>

        </div>
    <?
    } ?>

    <div class="footer-action col-sm-12 text-center">
        <button type="button" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "document.slider.submit();"?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
    </div>
