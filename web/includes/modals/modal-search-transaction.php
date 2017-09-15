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
	# * FILE: /includes/modals/modal-search-transaction.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

    //Account
    $accountDropDown = "<input type=\"text\" class=\"form-control mail-select\" name=\"search_account_id\" id=\search_account_id\" placeholder=\"".LANG_LABEL_ACCOUNT."\" value=\"".$search_account_id."\">";
    system_generateAccountDropdown($auxAccountSelectize);
    
    //System Drop Down
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
	$query_rsSystems = "SELECT DISTINCT system_type FROM Payment_Log WHERE hidden = 'n' ORDER BY system_type";
	$rsSystems = $db->query($query_rsSystems);
	$arraySystems = array();
	while($row = mysql_fetch_assoc($rsSystems)) {
		array_push($arraySystems, $row['system_type']);
	}
	$systemsDropDown = html_selectBox("search_system", $arraySystems, $arraySystems, $search_system, "", "class=\"input-dd-form-searchtransaction\"", "-- ".system_showText(LANG_LABEL_SELECT_SELECTASYSTEM)." --");

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
                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?></label>
                            <div class="col-sm-8  selectize">
                                <?=$accountDropDown;?>
                            </div>
                        </div>
                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_TRANSACTIONID)?></label>
                            <div class="col-sm-8"> <input type="text" name="search_id" id="search_id" value="<?=$search_id?>" class="form-control"></div>
                        </div>
                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_PAYMENTSYSTEM)?></label>
                            <div class="col-sm-8 selectize">  <?=$systemsDropDown; ?> </div>
                        </div>
                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_AMOUNTRANGE)?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><?=system_showText(LANG_SITEMGR_LABEL_FROM)?></span>
                                    <input class="form-control" type="text" name="search_amount_range1" value="<? if ($search_amount_range1) echo format_money($search_amount_range1)?>"  maxlength="10">
                                    <span class="input-group-addon"><?=system_showText(LANG_SITEMGR_LABEL_TO2)?> </span>
                                    <input class="form-control" type="text" name="search_amount_range2" value="<? if ($search_amount_range2) echo format_money($search_amount_range2)?>"  maxlength="10">    
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_PAYMENTDATERANGE)?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><?=system_showText(LANG_SITEMGR_LABEL_FROM)?></span>
                                    <input class="form-control date-input" type="text" name="search_date_range1" value="<?=$search_date_range1?>"   maxlength="10">
                                    <span class="input-group-addon"><?=system_showText(LANG_SITEMGR_LABEL_TO2)?> </span>
                                    <input class="form-control date-input" type="text" name="search_date_range2" value="<?=$search_date_range2?>"  maxlength="10">    
                                </div>
                            </div>
                        </div>

                         <div class="form-group form-horizontal row">
                            <label class="col-sm-4 control-label"> <?=system_showText(LANG_SITEMGR_LABEL_DISCOUNTCODE)?></label>
                            <div class="col-sm-8"> <input class="form-control" type="text" name="search_discount_code" id="search_discount_code" value="<?=$search_discount_code?>" maxlength="10" > </div>
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