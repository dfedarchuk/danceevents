<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-listingtype.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="col-md-7">

        <!-- Item Name is separated from all informations -->
        <div class="form-group">
            <label for="title" class="label-lg"><?=system_showText(LANG_SITEMGR_TITLE)?></label>
            <input class="form-control input-lg" type="text" name="title" id="title" value="<?=$title?>" maxlength="100" />
        </div>
        <br>
        <!-- Panel Basic Informartion  -->
        <div class="panel panel-form">

            <div class="panel-heading">
                <?=string_ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> - <?=system_showText(LANG_SITEMGR_INFORMATION)?>
            </div>

            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-xs-12">
                        <label for="categories"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SELECTCATEGORIES)?></label>
                    </div>
                    <div class="col-xs-9">                 
                        <input type="text" class="form-control" id="categories" placeholder="<?=system_showText(LANG_SELECT_CATEGORIES);?>">
                        <input type="hidden" name="return_categories" value="" />
                        <?=str_replace("<select", "<select class=\"hidden\"", $feedDropDown);?>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-categories" id="action-categoryList"><?=system_showText(LANG_LABEL_SELECT);?> <i class="ionicons ion-ios7-photos-outline"></i></button>
                    </div>
                </div>

                <div class="form-group row">
                    <? if ($editable == "y") { ?>
                    <div class="col-xs-6">
                        <div class="col-xs-12 row">
                            <label><?=system_showText(LANG_SITEMGR_STATUS)?></label>
                        </div>
                        <div class="col-xs-12 form-horizontal row">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="status" value="enabled" <? if ((!$status) || ($status == "enabled")) echo "checked"; ?> >
                                    <?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
                                </label>
                            </div>
                            <div class="radio-inline">
                                 <label>
                                    <input type="radio" name="status" value="disabled" <? if ($status == "disabled") echo "checked"; ?> >
                                     <?=system_showText(LANG_SITEMGR_LABEL_DISABLED)?>
                                 </label>
                            </div>
                        </div>
                    </div>
                    <? } else { ?>
                        <input type="hidden" name="status" value="enabled">
                    <? } ?>
                    <div class="col-xs-6">
                        <label for="price"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDITIONALPRICE)?></label>
                        <input class="form-control" type="text" name="price" id="price" value="<?=$price?>" placeholder="00.00"/>
                    </div>
                </div>
            </div>

        </div>
        
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

        <!-- Extra Checkbox Fields  -->
        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRACHECKBOXFIELDS)?>
            </div>  
            <div class="panel-body">
                <div class="row text-center">
                    <div class="col-xs-6">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                    </div>
                    <div class="col-xs-6">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                    </div>
                </div>
                <?
                    $showextrafield = 0;
                    for ($i=0; $i<$count_customcheckbox; $i++) {
                        ?>
                        <div class="form-group row <?=(!$label["custom_checkbox$i"] && $i != $showextrafield ? "hidden" : "") ?>" id="custom_checkbox<?=$i?>">
                      
                            <div class="col-xs-6">
                                <input type="text" name="label[custom_checkbox<?=$i?>]" value="<?=$label["custom_checkbox$i"]?>" onkeydown="checkboxLabelChanging(<?=$i?>)" class="form-control" >
                            </div>
                            <div class="col-xs-6">
                                <input type="text" name="instructions[custom_checkbox<?=$i?>]" value="<?=$instructions["custom_checkbox$i"]?>" class="form-control" >
                            </div>
                        </div>
                        <?
                    }
                ?>
            </div>
        </div>

        <!-- Extra Dropdown Fields  -->
        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRADROPDOWNFIELDS)?>
            </div>
            <div class="panel-body">
                <div class="row text-center">
                    <div class="col-xs-3">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                    </div>
                    <div class="col-xs-4">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_VALUES)?></label>
                    </div>
                    <div class="col-xs-3">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                    </div>
                    <div class="col-xs-2">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?></label>
                    </div>
                </div>

                <?
                    $showextrafield = 0;
                    for ($i=0; $i<$count_customdropdown; $i++) {
                        ?>
                        <div class="form-group row <?=(!$label["custom_dropdown$i"] && $i != $showextrafield ? "hidden" : "") ?>"  id="custom_dropdown<?=$i?>">
                           
                            <div class="col-xs-3">
                                <input type="text" name="label[custom_dropdown<?=$i?>]" value="<?=$label["custom_dropdown$i"]?>" onkeydown="dropdownLabelChanging(<?=$i?>)" class="form-control"/>
                            </div>
                            <div class="col-xs-4">
                                <textarea name="fieldvalues[custom_dropdown<?=$i?>]" rows="1" class="form-control"><?=$fieldvalues["custom_dropdown$i"]?></textarea>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" name="instructions[custom_dropdown<?=$i?>]" value="<?=$instructions["custom_dropdown$i"]?>" class="form-control"/>
                            </div>
                            <div class="col-xs-2 text-center">
                                <input type="checkbox" name="required[custom_dropdown<?=$i?>]" value="y" <?=($required["custom_dropdown$i"]=="y") ? "checked" : ""?> />
                            </div>
                        </div>
                        <?
                    }
                ?>
            </div>
        </div>

        <!-- Extra Text Fields  -->
        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRATEXTFIELDS)?>
            </div>
            <div class="panel-body">
                <div class="row text-center">
                    <div class="col-xs-5">
                         <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                    </div>
                    <div class="col-xs-4">
                         <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                    </div>
                    <div class="col-xs-3">
                         <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?></label>
                    </div>
                </div>

            <?
            $showextrafield = 0;
            for ($i=0; $i<$count_customtext; $i++) {
                ?>
                <div class="form-group row <?=(!$label["custom_text$i"] && $i != $showextrafield ? "hidden" : "") ?>" id="custom_text<?=$i?>">
                    <div class="col-xs-5">
                        <input type="text" name="label[custom_text<?=$i?>]" value="<?=$label["custom_text$i"]?>" onkeydown="textLabelChanging(<?=$i?>)" class="form-control" />
                    </div>
                    <div class="col-xs-4">
                        <input type="text" name="instructions[custom_text<?=$i?>]" value="<?=$instructions["custom_text$i"]?>" class="form-control" />
                    </div>
                    <div class="col-xs-3 text-center">
                        <input type="checkbox" name="required[custom_text<?=$i?>]" value="y" <?=($required["custom_text$i"]=="y") ? "checked" : ""?> />
                    </div>
                </div>
                <?
            }
            ?>

            </div>
        </div>

        <!-- Extra Description Fields  -->
        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRASHORTDESCRIPTIONFIELDS)?>
            </div>
            <div class="panel-body">
                <div class="row text-center">
                    <div class="col-xs-5">
                        <label>
                            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
                        </label>
                    </div>
                    <div class="col-xs-4">
                        <label>
                            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
                        </label>
                    </div>
                    <div class="col-xs-3">
                        <label>
                            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>
                        </label>
                    </div>
                </div>


            <?
            $showextrafield = 0;
            for ($i=0; $i<$count_customshortdesc; $i++) {
                ?>
                <div class="form-group row <?=(!$label["custom_short_desc$i"] && $i != $showextrafield ? "hidden" : "") ?>" id="custom_short_desc<?=$i?>">
             
                    <div class="col-xs-5">
                        <input type="text" name="label[custom_short_desc<?=$i?>]" value="<?=$label["custom_short_desc$i"]?>" onkeydown="shortdescLabelChanging(<?=$i?>)" class="form-control" >
                    </div>
                    <div class="col-xs-4">
                        <input type="text" name="instructions[custom_short_desc<?=$i?>]" value="<?=$instructions["custom_short_desc$i"]?>" class="form-control" >
                    </div>
                    <div class="col-xs-3 text-center">
                        <input type="checkbox" name="required[custom_short_desc<?=$i?>]" value="y" <?=($required["custom_short_desc$i"]=="y") ? "checked" : ""?> >
                    </div>
                </div>
                <?
            }
            ?>
            </div>
        </div>
         
        <!-- Extra Long Description Fields  -->
        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRALONGDESCRIPTIONFIELDS)?>
            </div>
            <div class="panel-body">
                <div class="row text-center">
                    <div class="col-xs-5">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?></label>
                    </div>
                    <div class="col-xs-4">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?></label>
                    </div>
                    <div class="col-xs-3">
                        <label><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?></label>
                    </div>
                </div>


            <?
            $showextrafield = 0;
            for ($i=0; $i<$count_customlongdesc; $i++) {
                ?>
                <div class="form-group row <?=(!$label["custom_long_desc$i"] && $i != $showextrafield ? "hidden" : "") ?>" id="custom_long_desc<?=$i?>">
               
                    <div class="col-xs-5">
                        <input type="text" name="label[custom_long_desc<?=$i?>]" value="<?=$label["custom_long_desc$i"]?>" onkeydown="longdescLabelChanging(<?=$i?>)" class="form-control" />
                    </div>
                    <div class="col-xs-4">
                        <input type="text" name="instructions[custom_long_desc<?=$i?>]" value="<?=$instructions["custom_long_desc$i"]?>" class="form-control" />
                    </div>
                    <div class="col-xs-3 text-center">
                        <input type="checkbox" name="required[custom_long_desc<?=$i?>]" value="y" <?=($required["custom_long_desc$i"]=="y") ? "checked" : ""?> class="" />
                    </div>
                </div>
                <?
            }
            ?>
            </div>
        </div>          

    </div>

    <input type="hidden" name="layout_id" value="<?=$layout_id;?>" />

    <!-- ######################## -->
    <!-- Modal Categories -->
    <!-- ######################## -->

    <div class="modal fade" id="modal-categories" tabindex="-1" role="dialog" aria-labelledby="modal-categories" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_CATEGORIES_SUBCATEGS)?></h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        <p class="help-block"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_CATEGORYTIP)?></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="multiple-categories">
                                <ul id="listing_categorytree_id_0">&nbsp;</ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" id="category-select" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="action-categories"><?=system_showText(LANG_BUTTON_OK);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->