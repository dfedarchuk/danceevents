<!-- edit calendar modal -->
<?php
$content = json_decode($content, true);
?>
<div class="modal-dialog modal-lg widget-calendar" role="document">
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
                            <form method="post" id="form_calendar_image" name="form_image">
                                <input id="bgImageCalendarInput" name="background_image_calendar" type="file" style="display: none;"
                                       onchange="saveImage('form_calendar_image', 'image', 'bgImageCalendar', 'image-background-calendar', null, 'messageAlertCalendar')">
                            </form>

                            <div id="image-background-calendar" class="img-background text-center">
                                <?php
                                if (file_exists(EDIRECTORY_ROOT.BKIMAGE_PATH."/".BKIMAGE_NAME."_calendar.".BKIMAGE_EXT)) {
                                    ?>
                                    <div class="edit-hover">
                                        <a href="#" class="bgImageCalendarButton">
                                            <img id="bgImageCalendar"
                                                 src="<?= DEFAULT_URL.BKIMAGE_PATH."/".BKIMAGE_NAME."_calendar.".BKIMAGE_EXT ?>?<?=time()?>"
                                                 alt="eDirectory">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="new">
                                        <a class="thumbnail add-new bgImageCalendarButton" href="#">
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
                    <form class="form" name="form_calendar" id="form_calendar">
                        <input type="hidden" name="pageWidgetId" id="pageWidgetId" value="<?= $pageWidgetId ?>" />
                        <input type="hidden" name="saveWidgetForAllPages" value="1">
                        <div class="form-group">
                            <label for="labelSignupFor"
                                   class="control-label"><?= system_showText(LANG_SITEMGR_LABEL_CALENDAR); ?></label>
                            <input type="text" class="form-control" id="labelCalendar" name="labelCalendar"
                                   placeholder="" value="<?= $content['labelCalendar'] ?>">
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
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('calendar');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
