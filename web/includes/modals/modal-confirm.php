<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-confirm.php
	# ----------------------------------------------------------------------------------------------------

?>
    <input type="hidden" name="modal-confirm-form" id="modal-confirm-form" value="" />
    <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-confirm" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-danger">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_SITEMGR_HOLD_ON);?></h4>
                </div>
                <div class="modal-body text-center">
                    <p id="modal-confirm-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL)?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#'+$('#modal-confirm-form').val()).submit();" id="modal-confirm-button"><?=system_showText(LANG_SITEMGR_YESCONTINUE);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->