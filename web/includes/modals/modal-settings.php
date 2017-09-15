<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-settings.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos($_SERVER["PHP_SELF"], "/content/".LISTING_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_LISTING_SING)." ".system_showText(LANG_SITEMGR_STATUS);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".EVENT_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_EVENT_SING)." ".system_showText(LANG_SITEMGR_STATUS);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".CLASSIFIED_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_CLASSIFIED_SING)." ".system_showText(LANG_SITEMGR_STATUS);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".ARTICLE_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_ARTICLE_SING)." ".system_showText(LANG_SITEMGR_STATUS);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".BANNER_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_BANNER_SING)." ".system_showText(LANG_SITEMGR_STATUS);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".BLOG_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_BLOG_SING)." ".system_showText(LANG_SITEMGR_STATUS);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/invoices/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_INVOICE)." ".system_showText(LANG_SITEMGR_STATUS);
    }
?>
    <input type="hidden" name="setting-id" id="setting-id" value="" />

    <div class="modal fade" id="modal-settings" tabindex="-1" role="dialog" aria-labelledby="modal-setting" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=$modalTitle;?></h4>
                </div>
                <div class="modal-body">
                    <form name="setting_item" id="setting_item" method="post" action="#">
                        <div id="settings-content">
                            <div class="text-center">
                                <img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/loading-32.gif" title="<?=LANG_DEAL_PLEASEWAITLOADING?>">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL)?></button>
                    <button type="button" class="btn btn-primary action-save" id="btn-save" data-action="redirect" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="submitFormSettings();"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->