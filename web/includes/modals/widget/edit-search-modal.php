<!-- edit search modal -->
<?php
$content = json_decode($content, true);
?>
<div class="modal-dialog modal-lg widget-search" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span
                    class="widgetTitle"><?= $widgetTitle ?></span></h4>
            <p>
                <small
                    class="help-block"><?= str_replace("[dimension]",
                        IMAGE_THEME_BACKGROUND_W." x ".IMAGE_THEME_BACKGROUND_H,
                        system_showText(LANG_SITEMGR_BACKGROUND_TIP)); ?></small>
            </p>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-thumbnails">
                        <div class="upload-logo">
                            <form method="post" id="form_search_image" name="bgImage">
                                <input id="bgImageInput" name="background_image" type="file" style="display: none;"
                                       onchange="saveImage('form_search_image', 'bgimage', 'bgImage', 'image-background', null, 'messageAlertSearch')">
                            </form>

                            <div id="image-background" class="img-background text-center">
                                <?php
                                if (file_exists(EDIRECTORY_ROOT.BKIMAGE_PATH."/".BKIMAGE_NAME.".".BKIMAGE_EXT)) {
                                    ?>
                                    <div class="edit-hover">
                                        <a href="#" class="bgImageButton">
                                            <img id="bgImage"
                                                 src="<?= DEFAULT_URL.BKIMAGE_PATH."/".BKIMAGE_NAME.".".BKIMAGE_EXT ?>?<?=time()?>"
                                                 alt="eDirectory">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="new">
                                        <a class="thumbnail add-new bgImageButton" href="#">
                                            <div class="caption">
                                                <h6><i class="fa fa-plus-circle"
                                                       aria-hidden="true"></i> <?= system_showText(LANG_SITEMGR_ADD_SEARCH_IMAGE) ?>
                                                </h6>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <form class="form" name="form_search" id="form_search">
                        <input id="pageWidgetId" name="pageWidgetId" type="hidden" value="<?= $pageWidgetId ?>" />
                        <input type="hidden" name="saveWidgetForAllPages" value="1">
                        <div class="form-group">
                            <label for="labelStartYourSearch" class="control-label">
                                <?= system_showText(LANG_SITEMGR_SEARCH_LABEL_1) ?>
                            </label>
                            <input type="text" class="form-control" id="labelStartYourSearch"
                                   name="labelStartYourSearch" value="<?= $content['labelStartYourSearch'] ?>"
                                   placeholder="<?= system_showText(LANG_SITEMGR_START_SEARCH_HERE) ?>">
                        </div>
                        <div class="form-group">
                            <label for="labelWhatLookingFor" class="control-label">
                                <?= system_showText(LANG_SITEMGR_SEARCH_LABEL_2) ?>
                            </label>
                            <input type="text" class="form-control" id="labelWhatLookingFor"
                                   name="labelWhatLookingFor" value="<?= $content['labelWhatLookingFor'] ?>"
                                   placeholder="<?= system_showText(LANG_SITEMGR_WHAT_LOOKING_FOR) ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-6 text-left">
                </div>
                <div class="col-xs-6 text-right">
                    <button type="button" class="btn btn-lg"
                            data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL); ?></button>
                    <button type="button" class="btn btn-primary btn-lg action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('search');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
