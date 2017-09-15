<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-bulkupdate.php
	# ----------------------------------------------------------------------------------------------------

?>

    <form class="bulkupdate" name="form-bulk" id="form-bulk" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
        
        <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
        <input type="hidden" name="bulkListType" id="bulkListType" value="transaction" />
        <input type="hidden" name="delete_all" id="delete_all" value="" />
	
		<div class="bulk-check-all">
			<label class="sr-only"><?=system_showText(LANG_SITEMGR_CHECKALL);?></label>
			<input type="checkbox" id="uncheck-all">
		</div>
        
		<div class="bulk-buttons">
            <a data-toggle="modal" data-target="#modal-bulk" href="#" class="btn btn-warning btn-sm btn-icon btn-tip" data-placement="bottom" title="<?=system_showText(LANG_SITEMGR_DELETE_ALL)?>" onclick="confirmBulk('delete'); $('#delete_all').attr('value', 'on');"><i class="icon-waste2"></i></a>
   		</div>
	
	</form>