<!-- create navigation modal -->
<?php

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
$loadSitemgrLangs = true;
include("../../../conf/loadconfig.inc.php");

/**
 * Array with Modules and URL
 */
unset($array_modules);
$auxArrayModules = unserialize(THEME_NAVIGATION_MENU);
$array_modules[] = array("name" => LANG_SITEMGR_NAVIGATION_CUSTOM_LINK, "url" => "custom");
$array_modules = array_merge($auxArrayModules['header'], $array_modules);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"
        id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_NAVIGATION) ?></h4>
</div>
<div class="modal-body">
    <form class="form">
        <input type="hidden" id="divIdNav" />
        <div class="form-group">
            <label for="navLabel"
                   class="control-label"><?= system_showText(LANG_SITEMGR_LABEL_PAGETITLE) ?>
                :</label>
            <input type="text" class="form-control" id="navLabel"
                   placeholder="<?= system_showText(LANG_SITEMGR_LABEL_PAGETITLE) ?>">
        </div>
        <div class="form-group">
            <label for="navLink"
                   class="control-label"><?= system_showText(LANG_SITEMGR_LABEL_PAGELINK) ?>
                :</label>
            <select class="form-control navLink" id="navLink" data-modalaux="header">
                <? for($j = 0; $j < count($array_modules); $j++) {

                    $moduleOn = false;
                    if ($array_modules[$j]["module"]) {
                        if ((constant($array_modules[$j]["module"]) == "on") && (constant("CUSTOM_".$array_modules[$j]["module"]) == "on")) {
                            $moduleOn = true;
                        }
                    } else {
                        $moduleOn = true;
                    }

                    if ($moduleOn) {

                        $labelName = (strpos($array_modules[$j]["name"], "LANG_MENU") !== false || strpos($array_modules[$j]["name"], "TERMS") !== false || strpos($array_modules[$j]["name"], "PRIVACY") !== false ? constant($array_modules[$j]["name"]) : $array_modules[$j]["name"]);
                        $selected = false;
                        if (($array_modules[$j]["url"] == $arrayOptions[$i]["link"]) || ($array_modules[$j]["url"] == "custom" && $arrayOptions[$i]["custom"] == "y")) {
                            $selected = "selected = \"selected\"";
                        } ?>

                        <option value="<?=$array_modules[$j]["url"]?>" <?=($selected ? $selected : "")?>>
                            <?=string_ucwords($labelName)?>
                        </option>
                    <? }
                } ?>
            </select>
        </div>
        <div id="navCustomLinkDiv" class="form-group">
            <label for="navCustomLink"
                   class="control-label"><?= system_showText(LANG_SITEMGR_NAVIGATION_CUSTOM_LINK) ?>
                :</label>
            <input type="text" class="form-control navCustomLink" id="navCustomLink"
                   placeholder="<?= system_showText(LANG_SITEMGR_NAVIGATION_CUSTOM_LINK) ?>">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-lg"
            data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL) ?></button>
    <button type="button" id="saveNavButton" class="btn btn-primary btn-lg saveNavButton action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"
            data-modalaux="header"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
</div>
