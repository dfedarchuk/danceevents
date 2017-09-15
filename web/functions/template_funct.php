<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/template_funct.php
	# ----------------------------------------------------------------------------------------------------

	function template_CreateDynamicField($fieldvalues, $themeTemplate = false, &$hideExtraFieldsTable) {
		$fieldType = preg_replace('/[0-9]/i', '', $fieldvalues["field"]);
        if ($themeTemplate || (string_strpos($fieldvalues["label"], "LANG_LABEL") !== false)){
            $fieldvalues["label"] = @constant($fieldvalues["label"]);
        }

            switch ($fieldType) {
                case "custom_text":
                    $hideExtraFieldsTable = false; ?>
                    <div class="form-group">
                        <label for="<?=$fieldvalues["field"]?>"><?=$fieldvalues["label"]?> <?=($fieldvalues["required"] == "y") ? "" : "<small class=\"small text-muted\">(optional)</small>"?></label>
                        <input class="form-control" type="text" name="<?=$fieldvalues["field"]?>" id="<?=$fieldvalues["field"]?>" value="<?=$fieldvalues["form_value"]?>" maxlength="250" <?=($fieldvalues["instructions"]) ? "placeholder=\"".$fieldvalues["instructions"]."\"" : ""?> />
                    </div>
                    <?
                break;
                case "custom_short_desc":
                    $hideExtraFieldsTable = false;
                    $_SESSION["custom_type_field"] = $fieldvalues["field"]; //used for auxiliary script on footer
                    ?>
                    <div class="form-group">
                        <label for="<?=$fieldvalues["field"]?>"><?=$fieldvalues["label"]?> <?=($fieldvalues["required"] == "y") ? "" : "<small class=\"small text-muted\">(optional)</small>"?></label>
                        <textarea id="<?=$fieldvalues["field"]?>" name="<?=$fieldvalues["field"]?>" class="form-control textarea-counter" rows="5" cols="1" data-chars="250" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>"><?=$fieldvalues["form_value"]?></textarea>
                    </div>
                    <?
                break;
                case "custom_long_desc":
                    $hideExtraFieldsTable = false; ?>
                    <div class="form-group">
                        <label for="<?=$fieldvalues["field"]?>"><?=$fieldvalues["label"]?> <?=($fieldvalues["required"] == "y") ? "" : "<small class=\"small text-muted\">(optional)</small>"?></label>
                        <textarea id="<?=$fieldvalues["field"]?>" name="<?=$fieldvalues["field"]?>" class="form-control" rows="5" <?=($fieldvalues["instructions"]) ? "placeholder=\"".$fieldvalues["instructions"]."\"" : ""?>><?=$fieldvalues["form_value"]?></textarea>
                    </div>
                    <?
                break;
                case "custom_checkbox":
                    $hideExtraFieldsTable = false; ?>
                    <div class="form-group">
                        <div class="checkbox">
                            <label for="<?=$fieldvalues["field"]?>">
                                <input type="checkbox" name="<?=$fieldvalues["field"]?>" id="<?=$fieldvalues["field"]?>" value="y" <?=($fieldvalues["form_value"] == "y") ? "checked" : ""?> />
                                <?=$fieldvalues["label"]?> <small class="small text-muted"><?=($fieldvalues["instructions"]) ? "(".$fieldvalues["instructions"].")" : ""?></small>
                            </label>
                        </div>
                    </div>
                    <?
                break;
                case "custom_dropdown":
                    $hideExtraFieldsTable = false; ?>
                    <div class="form-group selectize">
                        <label><?=$fieldvalues["label"]?> <small class="small text-muted"><?=($fieldvalues["instructions"]) ? "(".$fieldvalues["instructions"].")" : ""?></small> <?=($fieldvalues["required"] == "y") ? "" : "<small class=\"small text-muted\">(optional)</small>"?></label>
                        <select name="<?=$fieldvalues["field"]?>">
                            <option value=""><?=$fieldvalues["label"];?></option>
                            <?
                            $auxfieldvalues = explode(",", $fieldvalues["fieldvalues"]);
                            foreach ($auxfieldvalues as $fieldvalue) {
                                ?><option value="<?=$fieldvalue;?>" <? if ($fieldvalue == $fieldvalues["form_value"]) { echo "selected"; } ?>><?=$fieldvalue;?></option><?
                            }
                            ?>
                        </select>
                    </div>
                    <?
                break;
            }
	}
?>
