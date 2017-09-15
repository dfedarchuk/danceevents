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
	# * FILE: /includes/modals/modal-search-custominvoice.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

    //Account
    $accountDropDown = "<input type=\"text\" class=\"form-control mail-select\" name=\"search_account_id\" id=\search_account_id\" placeholder=\"".LANG_LABEL_ACCOUNT."\" value=\"".$search_account_id."\">";
    system_generateAccountDropdown($auxAccountSelectize);
    
?>

    <div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="modal-search" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=system_showText(LANG_CLOSE);?></span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_SEARCH_ADVANCEDSEARCH);?></h4>
                </div>
                
                <form name="search" id="search" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
                    <div class="modal-body">
                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?></label>
                            <div class="col-sm-8  selectize">
                                <?=$accountDropDown;?>
                            </div>
                        </div>
                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label" for="search_title"><?=system_showText(LANG_SITEMGR_TITLE)?></label>
                            <div class="col-sm-8"><input type="text" name="search_title" id="search_title" value="<?=$search_title?>" class="form-control"></div>
                        </div>

                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_DATERANGE)?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><?=system_showText(LANG_SITEMGR_LABEL_FROM)?></span>
                                    <input class="form-control date-input" type="text" name="search_date_from" value="<?=$search_date_from?>" maxlength="10" placeholder="<?=format_printDateStandard()?>">
                                    <span class="input-group-addon"><?=system_showText(LANG_SITEMGR_LABEL_TO2)?> </span>
                                    <input class="form-control date-input" type="text" name="search_date_to" value="<?=$search_date_to?>" maxlength="10" placeholder="<?=format_printDateStandard()?>">    
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"><?=system_showText(LANG_SITEMGR_STATUS)?></label>
                            <div class="col-sm-8">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="paid" <?=($search_status == "paid") ? "checked" : ""?>>
                                        <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID)?>
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="sent" <?=($search_status == "sent") ? "checked" : ""?>>
                                        <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT)?>
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="pending" <?=($search_status == "pending") ? "checked" : ""?>>
                                        <?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)?>
                                    </label>
                                </div>
                            </div>
                        </div>

                     </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL);?></button>
                        <button type="submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->