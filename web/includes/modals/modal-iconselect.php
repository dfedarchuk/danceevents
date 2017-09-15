<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-iconselect.php
	# ----------------------------------------------------------------------------------------------------

?>
    <div class="modal fade" id="modal-iconselect" tabindex="-1" role="dialog" aria-labelledby="modal-iconselect" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_ICON_MODAL_TITLE);?></h4>
                </div>
                <div class="modal-body">
                    <?= AppCustomPage::renderIconModal(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL)?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->