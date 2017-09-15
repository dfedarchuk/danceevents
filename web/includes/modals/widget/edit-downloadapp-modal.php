<!-- edit download app modal -->
<?php
$content = json_decode($content, true);
?>
<div class="modal-dialog" role="document" id="">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span
                    class="widgetTitle"><?= $widgetTitle ?></span></h4>
        </div>
        <div class="modal-body">
            <form class="form" name="form_downloadapp" id="form_downloadapp">
                <input id="pageWidgetId" name="pageWidgetId" type="hidden" value="<?= $pageWidgetId ?>" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="labelDownloadOurApp" class="control-label">
                                <?= system_showText(LANG_SITEMGR_TITLE) ?>:
                            </label>
                            <input type="text" class="form-control" id="labelDownloadOurApp"
                                   name="labelDownloadOurApp" value="<?= $content['labelDownloadOurApp'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="labelAvailablePlayStore" class="control-label">
                                <?= system_showText(LANG_SITEMGR_ANDROID_LABEL) ?>:
                            </label>
                            <input type="text" class="form-control" id="labelAvailablePlayStore"
                                   name="labelAvailablePlayStore" value="<?= $content['labelAvailablePlayStore'] ?>"
                                   placeholder="<?= system_showText(LANG_SITEMGR_ANDROID_LABEL_TIP) ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="labelAvailableAppleStore" class="control-label">
                                <?= system_showText(LANG_SITEMGR_APPLE_LABEL) ?>:
                            </label>
                            <input type="text" class="form-control" id="labelAvailableAppleStore"
                                   name="labelAvailableAppleStore" value="<?= $content['labelAvailableAppleStore'] ?>"
                                   placeholder="<?= system_showText(LANG_SITEMGR_APPLE_LABEL_TIP) ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linkPlayStore" class="control-label">
                                <?= system_showText(LANG_SITEMGR_PLAY_STORE_LINK) ?>:
                            </label>
                            <input type="text" class="form-control" id="linkPlayStore" name="linkPlayStore" value="<?= $content['linkPlayStore'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linkAppleStore" class="control-label">
                                <?= system_showText(LANG_SITEMGR_APPLE_STORE_LINK) ?>:
                            </label>
                            <input type="text" class="form-control" id="linkAppleStore" name="linkAppleStore" value="<?= $content['linkAppleStore'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="checkboxOpenWindow" class="control-label">
                                    <input class="required" type="checkbox" value="1" name="checkboxOpenWindow"
                                           id="checkboxOpenWindow" <?= $content['checkboxOpenWindow']? "checked" : "" ?>>
                                    <?= system_showText(LANG_SITEMGR_OPEN_NEW_WINDOW) ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group checkbox">
                    <label>
                        <input type="checkbox" class="inputCheck" name="saveWidgetForAllPages" checked="checked">
                        <?= system_showText(LANG_SITEMGR_LABEL_SAVE_WIDGET_FOR_ALL_PAGES) ?>
                    </label>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-lg"
                            data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL); ?></button>
                    <button type="button" class="btn btn-primary btn-lg action-save"
                            data-loading-text="<?= system_showText(LANG_LABEL_FORM_WAIT); ?>"
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('downloadapp');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
