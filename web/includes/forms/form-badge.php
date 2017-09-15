<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-badge.php
	# ----------------------------------------------------------------------------------------------------
	
    $imageObj = new Image($default_images[$i]);
?>
    <div class="row col-sm-8 col-sm-offset-2">
        <div class="col-sm-2 text-right">
            <img src="<?=($imageObj->imageExists() ? $imageObj->getPath() : "https://placehold.it/50X50")?>" alt="<?=$default_name[$i];?>">
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="bdname<?=$i?>"><?=system_showText(LANG_SITEMGR_LABEL_NAME)?></label>
                <input class="form-control" type="text" id="bdname<?=$i?>" name="name[]" value="<?=$_POST['name'][$i] ? htmlspecialchars(stripslashes($_POST['name'][$i])) : $default_name[$i]?>">
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-2">
            <div class="form-group">
                <label for="image<?=$i+1?>"><?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_FILE)?></label>
                <input type="file" class="filestyle upload-files file-withinput" id="image<?=$i+1?>" name="file<?=$i+1?>">
                <p class="help-block"><?=IMAGE_DESIGNATION_WIDTH?>px x <?=IMAGE_DESIGNATION_HEIGHT?>px. <?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></p>
            </div>
        </div>        
        <div class="col-sm-6 col-sm-offset-2">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="available_<?=$i?>" value="1" <?=$default_available[$i]?>><?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_LISTINGACCOUNTSCANSELECT)?>
                    </label>
                </div>
            </div>
        </div>
    </div>