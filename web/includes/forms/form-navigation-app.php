<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-navigation-app.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="form-left">

        <h4><?=system_showText(LANG_SITEMGR_BUILDER_MENUPREVIEW);?></h4>
        <p><?=system_showText(LANG_SITEMGR_BUILDER_MENUPREVIEW_TIP);?></p>

        <div id="device-apple" class="cover-preview-image device-apple">
            <div class="tab-bar">
                <? for ($i = 0; $i < $limitPreview; $i++) { ?>
                <span id="preview_box_apple_<?=$i?>" class="menusample"><i></i><b id="preview_label_apple_<?=$i?>"><?=$arrayOptions[$i]["label"]?></b></span>
                <? } ?>
                <? for ($i = $limitPreview; $i < 4; $i++) { ?>
                <span id="preview_box_apple_<?=$i?>" class="menusample" style="display:none;"><i></i><b id="preview_label_apple_<?=$i?>"></b></span>
                <? } ?>
                <span class="menusample menumore" id="menusamplemore" <?=count($arrayOptions) > 4 ? "" : "style=display:none;"?>><i></i><?=ucfirst(system_showText(LANG_MORE))?></span>
            </div>
            <div class="change-device">
                <a class="icon-device-apple active" href="javascript:void(0);"></a>
                <a class="icon-device-android"></a>
            </div>
        </div>

        <div id="device-android" class="cover-preview-image device-android" style="display:none;">
            <div class="tab-bar">
                <? for ($i = 0; $i < count($arrayOptions); $i++) { ?>
                <span id="preview_box_android_<?=$i?>" class="menusample"><i></i><b id="preview_label_android_<?=$i?>"><?=$arrayOptions[$i]["label"]?></b></span>
                <? } ?>
            </div>
            <div class="change-device">
                <a class="icon-device-apple" href="javascript:void(0);"></a>
                <a class="icon-device-android active"></a>
            </div>
        </div>

    </div>

    <div class="form-right form-extended">

        <h4><?=system_showText(LANG_SITEMGR_BUILDER_CONFIGMENU)?></h4> <a class="pull-right text-warning" href="javascript:void(0)" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "ResetNavigation();"?>"><?=system_showText(LANG_SITEMGR_BUILDER_RESETMENU);?></a>
        <p><?=system_showText(LANG_SITEMGR_BUILDER_CONFIGMENU_TIP)?></p>

        <div class="sortable-title">
            <span><?=system_showText(LANG_SITEMGR_ORDER);?></span>
            <span><?=system_showText(LANG_SITEMGR_MENUITEMS)?></span>
            <span class="pull-right"><?=system_showText(LANG_LABEL_DELETE)?></span>
        </div>
        
        <ul id="sortable" class="list-sortable">
                        
            <? for ($i = 0; $i < count($arrayOptions); $i++) { ?>
            
                <li id="<?=$i?>" <?=$arrayOptions[$i]["fixed"] ? "class=\"static\"" : ""?>>
                    <p id="preview_item<?=$i?>">
                        <? if (!$arrayOptions[$i]["fixed"]) { ?>
                        <i class="drag"></i>
                        <? } ?>
                        <span <?=($arrayOptions[$i]["fixed"] ? "class=\"fixed-option\"" : "")?> id="navigation_text_preview_<?=$i?>"><?=$arrayOptions[$i]["label"]?></span>
                        <input type="hidden" name="navigation_text_cancel_<?=$i?>" id="navigation_text_cancel_<?=$i?>" value="<?=$arrayOptions[$i]["label"]?>">
                        <span class="options">
                            <span class="edit-list" onclick="editMenu(<?=$i?>, true);"><?=system_showText(LANG_LABEL_EDIT);?></span>
                            <i class="iab-delete" id="remove_item<?=$i?>" <?=$arrayOptions[$i]["fixed"] ? "style=display:none" : ""?> onclick="javascript:removeItem(<?=$i?>, true)"></i>
                        </span>
                    </p>
                    
                    <div id="edit_item<?=$i?>" style="display:none;" class="open-edit">
                        <p class="list-label">
                            <span><?=system_showText(LANG_SITEMGR_BUILDER_CONFIGMENU_LABEL);?></span>
                            <span><?=system_showText(LANG_SITEMGR_LINKSTO);?></span>
                        </p>
                        <p class="list-edit">
                            <input type="text" onkeyup="updatePreview(this); updateItem(<?=$i?>, this);" name="navigation_text_<?=$i?>" id="navigation_text_<?=$i?>" value="<?=$arrayOptions[$i]["label"]?>" maxlength="20" />
                            <i class="iab-linkto"></i>
                            <select onchange="disableDropdown(); checkOption(<?=$i?>);" name="dropdown_link_to_<?=$i?>" id="dropdown_link_to_<?=$i?>">
                                <option>---</option>
                                <? for ($j = 0; $j < count($array_modules); $j++) {

                                    $moduleOn = false;
                                    if ($array_modules[$j]["module"]) {
                                        if ((constant($array_modules[$j]["module"]) == "on") && (constant("CUSTOM_".$array_modules[$j]["module"]) == "on")) {
                                            $moduleOn = true;
                                        }
                                    } else {
                                        $moduleOn = true;
                                    }

                                    if ($moduleOn) {

                                        $labelName = strpos($array_modules[$j]["name"], "LANG_") !== false ? constant($array_modules[$j]["name"]) : $array_modules[$j]["name"];
                                        $selected = false;
                                        if (($array_modules[$j]["url"] == $arrayOptions[$i]["link"])) {
                                            $selected = "selected = \"selected\"";
                                        } ?>

                                        <option value="<?=$array_modules[$j]["url"]?>" <?=($selected ? $selected : "")?>>
                                            <?=string_ucwords($labelName)?>
                                        </option>
                                    <? }
                                }

                                echo AppCustomPage::getMenuOptions( $arrayOptions[$i]["id"] );
                                ?>
                            </select>
                            <a class="btn-mini" onclick="editMenu(<?=$i?>, false);"><?=system_showText(LANG_BUTTON_CANCEL);?></a>
                            <a class="btn-mini btn-success" onclick="NextStep(false, <?=$i?>);"><?=system_showText(LANG_SITEMGR_SAVE);?></a>
                        </p>
                    </div>
                    
                </li>
            
            <? } ?>
                
        </ul>
        
        <br />
        
        <p class="text-right">
            <a class="text-success uppercase" id="add_item" href="javascript:void(0)" onclick="CreateNewItem(true);" <?=(count($arrayOptions) >= $limitItems) ? "style=\"display:none;\"" : ""?>><?=system_showText(LANG_SITEMGR_BUILDER_CONFIGMENU_ADD);?><i class="iab-add"></i></a>
        </p>
        
        <p><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_6_TIP);?></p>

    </div>