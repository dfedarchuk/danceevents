<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-search-claim.php
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=system_showText(LANG_CLOSE);?></span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_SEARCH_ADVANCEDSEARCH);?></h4>
                </div>
                
                <form name="search" id="search" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
                    <div class="modal-body">
                       
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label><?=system_showText(LANG_LABEL_ACCOUNT);?></label>
                                <div class="selectize">
                                    <?=$accountDropDown;?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label><?=system_showText(LANG_SITEMGR_LISTING_LISTINGTITLE);?></label>
                                <input type="text" name="search_title" value="<?=$search_title?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?=system_showText(LANG_LABEL_STATUS);?></label>
                            <div class="form-horizontal">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="progress" <? if ($search_status == "progress") echo "checked"; ?> >
                                        <?=system_showText(LANG_SITEMGR_CLAIM_STATUS_PROGRESS)?>
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="incomplete" <? if ($search_status == "incomplete") echo "checked"; ?> >
                                        <?=system_showText(LANG_SITEMGR_CLAIM_STATUS_INCOMPLETE)?>
                                    </label>
                                </div>  
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="complete" <? if ($search_status == "complete") echo "checked"; ?> >
                                        <?=system_showText(LANG_SITEMGR_CLAIM_STATUS_COMPLETE)?>
                                    </label>
                                </div>  
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="approved" <? if ($search_status == "approved") echo "checked"; ?> >
                                        <?=system_showText(LANG_SITEMGR_CLAIM_STATUS_APPROVED)?>
                                    </label>
                                </div>  
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="search_status" value="denied" <? if ($search_status == "denied") echo "checked"; ?> >
                                        <?=system_showText(LANG_SITEMGR_CLAIM_STATUS_DENIED)?>
                                    </label>
                                </div>  


                            </div>
                        </div>
                          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL);?></button>
                        <button type="submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->