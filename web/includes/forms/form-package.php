<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-package.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="col-sm-8">
        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_PACKAGE_SETTINGS_LABEL);?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?=system_showText(LANG_SITEMGR_PACKAGE_WHEN_SOMEONE_ORDER)?></label>
                            <div class="selectize">
                                <? if (is_array($array_dropdown_module_level_actual)) { ?>
                                    <select name="ordered_item">
                                        <option value="" >--<?=system_showText(LANG_CHOOSE_PERIOD)?>--</option>
                                        <? for($i = 0; $i < count($array_dropdown_module_level_actual); $i++) { ?>
                                            <option value="<?=$array_dropdown_module_level_actual[$i]["option_id"]?>" <?=($array_dropdown_module_level_actual[$i]["option_id"] == $ordered_item ? " selected " : "")?>>
                                                <?=$array_dropdown_module_level_actual[$i]["label"]?>
                                            </option>
                                        <? } ?>
                                    </select>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?=system_showText(LANG_SITEMGR_PACKAGE_OFFER_ITEM)?></label>
                            <div class="selectize">
                                <? if (is_array($array_commom_domain)) { ?>
                                    <select name="offer_item" onchange="ShowOptionPackage(this.value);">
                                        <option value="" >--<?=system_showText(LANG_CHOOSE_PERIOD)?>--</option>
                                        <? for($i = 0; $i < count($array_commom_domain); $i++) { ?>
                                            <option value="<?=$array_commom_domain[$i]["option_id"]?>" <?=($array_commom_domain[$i]["option_id"] == $offer_item ? " selected " : "")?>>
                                                <?=$array_commom_domain[$i]["label"]?>
                                            </option>
                                        <? } ?>
                                        <option value="custom_package" <?=($offer_item == "custom_package" ? " selected " : "")?>><?=system_showText(LANG_SITEMGR_PACKAGE_CUSTOM_OPTION_LABEL)?></option>
                                    </select>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="div_domains">
                    <div class="row">
                        <div class="col-sm-6"><?=system_showText(LANG_SITEMGR_DOMAIN_PLURAL);?></div>
                        <div class="col-sm-6"><?=system_showText(LANG_SITEMGR_LABEL_PRICE);?></div>
                    </div>
                        <?
                        for ($i = 0; $i < count($array_domains); $i++) {
                            /*
                            * When edit, check domain_id as item of this package
                            * $aux_package_items_domains = Array with domains on Package
                            * $aux_package_items_values  = Array with values per domain of package
                            */
                            unset($aux_checked_true,$aux_value);

                                /*
                                * Check if domain_id exists on this package
                                */
                                if (is_array($aux_package_items_domains)) {
                                    if (in_array($array_domains[$i]["id"], $aux_package_items_domains)) {
                                        $aux_checked_true = "checked";
                                    } else {
                                        $aux_checked_true = "";
                                    }
                                } else {
                                    $aux_checked_true = "";
                                }

                                /*
                                * Get value of item on domain of package
                                */
                                if (is_array($aux_package_items_values)) {
                                    if (array_key_exists($array_domains[$i]["id"], $aux_package_items_values)) {
                                        $aux_value = $aux_package_items_values[$array_domains[$i]["id"]];
                                    } else {
                                        $aux_value = "";
                                    }
                                } else {
                                    if ($_POST["value_domain_".$array_domains[$i]["id"]]) {
                                        $aux_value = $_POST["value_domain_".$array_domains[$i]["id"]];
                                    } else {
                                        $aux_value = "";
                                    }
                                }

                            if (!$aux_value && !$aux_checked_true) {
                                $auxDisable = "disabled";
                            } else {
                                $auxDisable = "";
                            }
                        ?>
                            <div class="row">
                                <div class="col-sm-6 form-horizontal">
                                    <div class="checkbox-inline">
                                        <label>
                                            <input type="checkbox" id="package_<?=$i?>" value="<?=$array_domains[$i]["id"]?>" name="packageItem_domain_id[]" onclick="enablePriceField(this)" <?=$aux_checked_true;?>>
                                            <?=$array_domains[$i]["name"]?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><?=CURRENCY_SYMBOL;?></span>
                                        <input class="form-control" type="text" id="value_domain_<?=$array_domains[$i]["id"]?>" name="value_domain_<?=$array_domains[$i]["id"]?>" value="<?=$aux_value?>" <?=$auxDisable;?>  maxlength="8">
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                </div>

            </div>
        </div>

        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_PACKAGEINFORMATION);?>
            </div>
            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="id-packagetitle"><?=system_showText(LANG_SITEMGR_PACKAGE_TITLE);?></label>
                        <input id="id-packagetitle" class="form-control" type="text" name="title" value="<?=$title?>" maxlength="100" >
                        <input type="hidden" name="offer_domain_id" value="<?=SELECTED_DOMAIN_ID?>">
                    </div>
                    <div class="col-sm-6">
                        <label><?=system_showText(LANG_SITEMGR_STATUS);?></label>
                        <?=$statusDropDown?>
                    </div>
                </div>

                <div class="form-group row" id="table_custom" style="display:none">
                    <div class="col-sm-6 form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><?=CURRENCY_SYMBOL;?></span>
                            <input class="form-control" type="text" name="price" value="<?=$price?>" maxlength="8" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_PRICE);?>">
                        </div>
                    </div>
                </div>

                <div class="form-group" id="div_editor">
                    <label><?=system_showText(LANG_LABEL_CONTENT)?></label>

                    <? // TinyMCE Editor Init
                        //fix ie bug with images
                        if (!($content)) $content =  "&nbsp;".$content;

                        // calling CKEditor
                        setting_get('sitemgr_language', $lang);
                        system_addCKEditor("content", $content, 30, 15, $lang);
                    ?>
                </div>

            </div>
        </div>

    </div>

    <div class="col-sm-4">
        <br>
        <div class="panel panel-form-media">
            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>
            </div>

            <div class="panel-body">
            <?
            if ($thumb_id) {
                $imageObj = new Image($thumb_id);
                if ($imageObj->imageExists()) {
                    ?>

                        <?=$imageObj->getTag(true, IMAGE_PACKAGE_THUMB_WIDTH, IMAGE_PACKAGE_THUMB_HEIGHT, $packageObj->getString("title", false));?>

                        <div class="form-group checkbox">
                            <label>
                                <input type="checkbox" name="remove_image" class="inputCheck" value="1" >
                                <?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
                            </label>
                        </div>

                    <?
                }
            }
            ?>
                <input type="file" class="file-withinput" name="image" id="image" size="50">
                <input type="hidden" name="image_id" value="<?=$image_id?>">

            </div>
            <div class="panel-footer">
                <small class="text-muted"><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></small>
            </div>
        </div>

    </div>

	<?
	if ($_POST["offer_item"]) {
        $offer_item = $_POST["offer_item"];
    }
    ?>
