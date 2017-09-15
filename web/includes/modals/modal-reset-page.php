<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/modals/modal-reset-page.php
# ----------------------------------------------------------------------------------------------------

?>

<div class="modal fade" id="modal-reset-page" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
    <div class="modal-dialog modal-danger">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title"><?= system_showText(LANG_SITEMGR_RESET_PAGE) ?></h4>
            </div>
            <div class="modal-body text-center">
                <form role="form" name="form_reset_page" id="form_reset_page"
                      action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>?id=<?= $_GET['id'] ?>" method="post">
                    <input type="hidden" name="resetPageId" value="<?= $_GET['id'] ?>">
                    <p><?= system_showText(LANG_SITEMGR_RESET_PAGE_DESCRIPTION) ?></p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal"><?= system_showText(LANG_CANCEL)?></button>
                <button type="button" class="btn btn-primary confirmation-reset-page" onclick="$('#form_reset_page').submit();"><?= system_showText(LANG_BUTTON_YES_CONTINUE) ?></button>
            </div>
        </div>
    </div>
</div>
