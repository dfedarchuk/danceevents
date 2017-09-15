<!-- edit location modal -->
<?php
$content = json_decode($content, true);
?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span
                    class="widgetTitle"><?= $widgetTitle ?></span></h4>
        </div>
        <div class="modal-body">
            <div class="alert" id="messageAlertLocation" style="display: none">
                <div></div>
            </div>

            <div class="row">

                <form class="form" name="form_location" id="form_location">
                    <input type="hidden" name="pageWidgetId" id="pageWidgetId" value="<?= $pageWidgetId ?>" />
                    <input type="hidden" name="saveWidgetForAllPages" value="1">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="labelExploreMorePlaces"
                                   class="control-label"><?= system_showText(LANG_SITEMGR_WIDGET_LOCATIONBROWSE_TITLE); ?></label>
                            <input type="text" class="form-control" id="labelExploreMorePlaces"
                                   name="labelExploreMorePlaces" value="<?= $content['labelExploreMorePlaces'] ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="labelMoreLocations"
                                   class="control-label"><?= system_showText(LANG_SITEMGR_WIDGET_LOCATIONBROWSE_BUTTON); ?></label>
                            <input type="text" class="form-control" id="labelMoreLocations"
                                   name="labelMoreLocations" value="<?= $content['labelMoreLocations'] ?>" placeholder="">
                        </div>
                    </div>
                </form>

                <div class="col-md-6">

                    <h5><?= system_showText(LANG_SITEMGR_COLOR_BACKGROUNDIMAGE); ?></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_location_image" name="form_image">
                                <input id="bgImageLocationInput" name="background_image_location" type="file"
                                       style="display: none;"
                                       onchange="saveImage('form_location_image', 'image', 'bgImageLocation', 'image-background-location', null, 'messageAlertLocation')">
                            </form>
                            <div id="image-background-location" class="img-background text-center">
                                <?php
                                if (file_exists(EDIRECTORY_ROOT.BKIMAGE_PATH."/".BKIMAGE_NAME."_location.".BKIMAGE_EXT)) {
                                    ?>
                                    <div class="edit-hover">
                                        <a href="#" class="bgImageLocationButton" tabindex="198">
                                            <img id="bgImageLocation"
                                                 src="<?= DEFAULT_URL.BKIMAGE_PATH."/".BKIMAGE_NAME."_location.".BKIMAGE_EXT ?>?<?=time()?>"
                                                 alt="eDirectory">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="new">
                                        <a class="thumbnail add-new bgImageLocationButton" href="#">
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
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <small class="help-block"><?= str_replace("[dimension]",
                                        IMAGE_THEME_BACKGROUND_W." x ".IMAGE_THEME_BACKGROUND_H,
                                        system_showText(LANG_SITEMGR_BACKGROUND_TIP)); ?></small>
                            </p>
                        </div>
                    </div>

                    <div id="loading_backgroundimage"
                         class="alert alert-loading alert-block text-center hidden">
                        <img src="<?= DEFAULT_URL; ?>/<?= SITEMGR_ALIAS ?>/assets/img/loading-64.gif">
                    </div>

                </div>

            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-6 text-left">
                </div>
                <div class="col-xs-6 text-right widget-modal-buttons">
                    <button type="button" class="btn btn-lg"
                            data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL); ?></button>
                    <button type="button" class="btn btn-primary btn-lg action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('location');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>
        <div class="alert alert-warning text-center">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <?= system_showText(LANG_SITEMGR_CHANGES_WIDGET) ?>
        </div>
    </div>
</div>
