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

    <div class="modal fade" id="modal-reset" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-danger">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_SITEMGR_RESET_NAVIGATION)?></h4>
                </div>
                <div class="modal-body text-center">
                    <h3><?=system_showText(LANG_LABEL_ATTENTION)?></h3>
                    <p><?=LANG_SITEMGR_RESET_NAVIGATION_TEXT?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL)?></button>
                    <button type="button" class="btn btn-danger" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "document.reset_navigation.submit();"?>"><?=system_showText(LANG_SITEMGR_YESCONTINUE);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->