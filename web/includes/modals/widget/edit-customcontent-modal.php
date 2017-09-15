<!-- edit custom content modal -->
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span class="widgetTitle"><?= $widgetTitle ?></span></h4>
        </div>
        <div class="modal-body">
            <form id="form_customcontent" role="form" name="htmleditor" class="html-editor">
                <input type="hidden" id="pageWidgetId" name="pageWidgetId" value="<?= $pageWidgetId ?>" />
                <div class="row">
                    <div class="col-md-12">
                        <?
                        $content = json_decode($content, true);
                        // calling CKEditor
                        setting_get('sitemgr_language', $lang);
                        system_addCKEditor(
                            "customHtml",
                            isset($content['customHtml'])? $content['customHtml'] : '' ,
                            100,
                            15,
                            $lang,
                            '',
                            true,
                            false
                        );
                        ?>
                    </div>
                </div>
                <div class="form-group checkbox">
                    <label>
                        <input type="checkbox" class="inputCheck" name="fullWidth" id="fullWidth" <?= $content['fullWidth']? "checked" : "" ?>>
                        <?= system_showText(LANG_SITEMGR_WIDGET_FULL_WIDTH) ?>
                    </label>
                </div>

            </form>

        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-lg"
                            data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL); ?></button>
                    <button type="button" class="btn btn-primary btn-lg action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('customcontent');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
