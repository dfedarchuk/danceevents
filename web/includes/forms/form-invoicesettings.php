<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-invoicesettings.php
	# ----------------------------------------------------------------------------------------------------

?>
    <input type="hidden" name="id" value="<?=$id?>" />

    <div class="panel panel-default">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_INVOICE_MODIFYINVOICESTATUS)?> - <?=$invoiceObj->getString("id")?>
        </div>
        <div class="panel-body">
            <div class="form-group form-horizontal">
                <label class="col-sm-4 control-label"><?=system_showText(LANG_SITEMGR_STATUS)?></label>
                <div class="col-sm-8 selectize"> <?=$statusDropDown?></div>
            </div>
        </div>
    </div>
                
               
               
         