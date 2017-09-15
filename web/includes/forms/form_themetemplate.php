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
	# * FILE: /includes/forms/form_themetemplate.php
	# ----------------------------------------------------------------------------------------------------

    if ($message_listingtemplate) { ?>
        <p class="alert alert-warning"><?=$message_listingtemplate?></p>
    <? } ?>

    <script type="text/javascript">

        function JS_submit() {
            document.listingtemplate.submit();
        }
    </script>

    <!-- Common Fields  -->
    <div class="panel panel-form">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_COMMONFIELDS)?>
        </div>  

        <div class="panel-body">

            <div class="row">
                <div class="col-xs-4">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_FIELD)?></label>
                </div>
                <div class="col-xs-4">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                </div>
                <div class="col-xs-4">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-4">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LISTINGTITLE)?></label>
                </div>
                <div class="col-xs-4">
                    <input type="text" name="label[title]" value="<?=$label["title"]?>" class="form-control">
                </div>
                <div class="col-xs-4">
                    <input type="text" name="instructions[title]" value="<?=$instructions["title"]?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-4">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDRESSLINE1)?></label>
                </div>
                <div class="col-xs-4">
                    <input type="text" name="label[address]" value="<?=$label["address"]?>" class="form-control">
                </div>
                <div class="col-xs-4">
                    <input type="text" name="instructions[address]" value="<?=$instructions["address"]?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-4">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDRESSLINE2)?></label>
                </div>
                <div class="col-xs-4">
                    <input type="text" name="label[address2]" value="<?=$label["address2"]?>" class="form-control">
                </div>
                <div class="col-xs-4">
                    <input type="text" name="instructions[address2]" value="<?=$instructions["address2"]?>" class="form-control">
                </div>
            </div>

        </div>

    </div>

    <?
    $count_customcheckbox = 7;
    $count_customdropdown = 3;
    $count_customtext = 4;
    ?>
    
    <!-- Extra Checkbox Fields  -->
    <div class="panel panel-form">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRACHECKBOXFIELDS)?>
        </div>  
        <div class="panel-body">
            <div class="row text-center">
                <div class="col-xs-3">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                </div>
                <div class="col-xs-3">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                </div>
                <div class="col-xs-3">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?></label>
                </div>
                <div class="col-xs-3">
                    <label><?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?></label>
                </div>
            </div>
            <? for ($i = 0; $i < $count_customcheckbox; $i++) { ?>
                <div class="form-group row">
                    <div class="col-xs-3">
                        <label><?=@constant($label["custom_checkbox$i"])?></label>
                        <input type="hidden" name="label[custom_checkbox<?=$i?>]" value="<?=$label["custom_checkbox$i"]?>">
                    </div>
                    <div class="col-xs-3">
                        <input type="text" name="instructions[custom_checkbox<?=$i?>]" value="<?=$instructions["custom_checkbox$i"]?>" class="form-control">
                    </div>
                    <div class="col-xs-3 text-center">
                        <input type="checkbox" name="search[custom_checkbox<?=$i?>]" value="y" <?=($search["custom_checkbox$i"] == "y") ? "checked" : ""?>>
                    </div>
                    <div class="col-xs-3 text-center">
                        <input type="checkbox" name="enabled[custom_checkbox<?=$i?>]" value="y" <?=($enabled["custom_checkbox$i"] == "y") ? "checked" : ""?>>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
    
    <!-- Extra Dropdown Fields  -->
    <div class="panel panel-form">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRADROPDOWNFIELDS)?>
        </div>
        <div class="panel-body">
            <div class="row text-center">
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_VALUES)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?></label>
                </div>
            </div>

            <? for ($i = 0; $i < $count_customdropdown; $i++) { ?>
                <div class="form-group row">
                    <div class="col-xs-2">
                        <label><?=@constant($label["custom_dropdown$i"])?></label>
                        <input type="hidden" name="label[custom_dropdown<?=$i?>]" value="<?=$label["custom_dropdown$i"]?>">
                    </div>
                    <div class="col-xs-2">
                        <textarea name="fieldvalues[custom_dropdown<?=$i?>]" rows="1" class="form-control"><?=$fieldvalues["custom_dropdown$i"]?></textarea>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" name="instructions[custom_dropdown<?=$i?>]" value="<?=$instructions["custom_dropdown$i"]?>" class="form-control"/>
                    </div>
                    <div class="col-xs-2 text-center">
                        <input type="checkbox" name="required[custom_dropdown<?=$i?>]" value="y" <?=($required["custom_dropdown$i"] == "y") ? "checked" : ""?> />
                    </div>
                    <div class="col-xs-2 text-center">
                        <input type="checkbox" name="search[custom_dropdown<?=$i?>]" value="y" <?=($search["custom_dropdown$i"] == "y") ? "checked" : ""?> />
                    </div>
                    <div class="col-xs-2 text-center">
                        <input type="checkbox" name="enabled[custom_dropdown<?=$i?>]" value="y" <?=($enabled["custom_dropdown$i"] == "y") ? "checked" : ""?> />
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
    
    <!-- Extra Text Fields  -->
    <div class="panel panel-form">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRATEXTFIELDS)?>
        </div>
        <div class="panel-body">
            <div class="row text-center">
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYRANGE)?></label>
                </div>
                <div class="col-xs-2">
                    <label><?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?></label>
                </div>
            </div>

            <? for ($i = 0; $i < $count_customtext; $i++) { ?>
            <div class="form-group row">
                <div class="col-xs-2">
                    <?=@constant($label["custom_text$i"])?>
                    <input type="hidden" name="label[custom_text<?=$i?>]" value="<?=$label["custom_text$i"]?>">
                </div>
                <div class="col-xs-2">
                    <input type="text" name="instructions[custom_text<?=$i?>]" value="<?=$instructions["custom_text$i"]?>" class="form-control" />
                </div>
                <div class="col-xs-2 text-center">
                    <input type="checkbox" name="required[custom_text<?=$i?>]" value="y" <?=($required["custom_text$i"] == "y") ? "checked" : ""?> />
                </div>
                <div class="col-xs-2 text-center">
                    <input type="checkbox" name="searchbykeyword[custom_text<?=$i?>]" value="y" <?=($searchbykeyword["custom_text$i"] == "y") ? "checked" : ""?> />
                </div>
                <div class="col-xs-2 text-center">
                    <input type="checkbox" name="searchbyrange[custom_text<?=$i?>]" value="y" <?=($searchbyrange["custom_text$i"] == "y") ? "checked" : ""?> />
                </div>
                <div class="col-xs-2 text-center">
                    <input type="checkbox" name="enabled[custom_text<?=$i?>]" value="y" <?=($enabled["custom_text$i"] == "y") ? "checked" : ""?> />
                </div>
            </div>
            <? } ?>

        </div>
    </div>