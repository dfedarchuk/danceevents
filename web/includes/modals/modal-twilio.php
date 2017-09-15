<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-twilio.php
	# ----------------------------------------------------------------------------------------------------

?>
    <div class="modal fade" id="modal-twilio" tabindex="-1" role="dialog" aria-labelledby="modal-twilio" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_CLICKTOCALL_REPORT)?></h4>
                </div>
                <div class="modal-body" id="twilio_reports">
                    <div class="text-center">
                        <img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/loading-32.gif" title="<?=LANG_DEAL_PLEASEWAITLOADING?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=system_showText(LANG_CLOSE)?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->