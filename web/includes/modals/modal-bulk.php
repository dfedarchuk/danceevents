<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-bulk.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="modal fade" id="modal-bulk" tabindex="-1" role="dialog" aria-labelledby="modal-bulk" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-danger">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=system_showText(LANG_CLOSE);?></span></button>
                    <h4 class="modal-title">&nbsp;</h4>
                </div>
                <div class="modal-body text-center">
                    <p id="alert_delete" style="display:none;"><?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?></p>
                    <p id="alert_update" style="display:none;"><?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" onclick="$('#delete_all').attr('value', '');" data-dismiss="modal"><?=system_showText(LANG_CANCEL);?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#form-bulk').submit();"><?=system_showText(LANG_BUTTON_OK);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->