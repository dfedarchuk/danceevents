<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-mobileadvert.php
	# ----------------------------------------------------------------------------------------------------

?>
<div class="row">
    <div class="col-md-7">

        <div class="panel panel-form">

            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_INFORMATION);?>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <label for="title"><?=system_showText(LANG_SITEMGR_MOBILE_ADVERTTITLE);?></label>
                    <input class="form-control" type="text" id="title" name="title" value="<?=$title?>" maxlength="25" />
                </div>

                


                <div class="form-group">
                    <label for="url"><?=system_showText(LANG_LABEL_DESTINATION_URL)?>:</label>
                    <input class="form-control input-form-banner" type="text" id="url" name="url" value="<?=$url?>" maxlength="500" placeholder="<?=system_showText(LANG_MSG_MAX_500_CHARS)?>">
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <div class="col-xs-12 row">
                            <label><?=system_showText(LANG_SITEMGR_MOBILE_ADVERT_DEVICES)?>:</label>
                        </div>
                        <div class="col-xs-12 row form-horizontal">
                            <div class="checkbox-inline">
                                <label><input type="checkbox" name="device_ios" value="1" <?=($device_ios == "1") ? "checked" : "";?>>iOS</label>
                            </div>
                            <div class="checkbox-inline">
                                <label><input type="checkbox" name="device_android" value="1" <?=($device_android == "1") ? "checked" : "";?> >Android</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="expiration_date"><?=system_showText(LANG_SITEMGR_MOBILE_EXPIRY);?>:</label>
                        <input class="form-control date-input" type="text" name="expiration_date" id="expiration_date" value="<?=$expiration_date?>" placeholder="<?=format_printDateStandard()?>">
                    </div>
                    <div class="col-sm-4">
                        <label><?=system_showText(LANG_LABEL_STATUS)?>:</label>
                        <div class="selectize">
                            <?=$statusDropDown?>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>
    <div class="col-md-5">
        <br>
        <div class="panel panel-form-media">
            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_ADDIMAGE)?>
                <small class="text-muted">(<?=MOBILE_ADVERT_WIDTH?> x <?=MOBILE_ADVERT_HEIGHT?>)</small>
            </div>

            <div class="panel-body">
                <? if ($imagePath) { ?>
                    <?=$imageObj->getTag(true, MOBILE_ADVERT_WIDTH, MOBILE_ADVERT_HEIGHT, $title, true);?>
                    <br>
                <? } ?>
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <input type="file" class="file-withinput" name="image">
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <span class="help-block"><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=BANNER_UPLOAD_MAX_SIZE;?> KB.</span>
                <span class="help-block"><?=system_showText(LANG_MSG_ALLOWED_FILE_TYPES)?>: GIF, JPEG, PNG</span>
            </div>
        </div>
    </div>
</div>
