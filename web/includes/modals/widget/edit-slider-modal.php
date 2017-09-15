<!-- edit slider modal -->
<?php
$content = json_decode($content, true);
?>
<div class="modal-dialog modal-lg widget-slider" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span
                    class="widgetTitle"><?= $widgetTitle ?></span></h4>
        </div>
        <div class="modal-body">
            <div class="alert" id="messageAlertSlider" style="display: none">
                <div></div>
            </div>
            <input type="hidden" name="number_of_items" value="<?= TOTAL_SLIDER_ITEMS ?>">
            <input type="hidden" id="deletedSlides" name="deletedSlides" value="">

            <form id="form_slider" name="form_slider">
                <input type="hidden" id="pageWidgetId" name="pageWidgetId" value="<?= $pageWidgetId ?>">
                <input type="hidden" name="saveWidgetForAllPages" value="1">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="labelStartYourSearch" class="control-label">
                                <?= system_showText(LANG_SITEMGR_SEARCH_LABEL_1) ?>
                            </label>
                            <input type="text" class="form-control" id="labelStartYourSearch"
                                   name="labelStartYourSearch" value="<?= $content['labelStartYourSearch'] ?>"
                                   placeholder="<?= system_showText(LANG_SITEMGR_START_SEARCH_HERE) ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="labelWhatLookingFor" class="control-label">
                                <?= system_showText(LANG_SITEMGR_SEARCH_LABEL_2) ?>
                            </label>
                            <input type="text" class="form-control" id="labelWhatLookingFor"
                                   name="labelWhatLookingFor" value="<?= $content['labelWhatLookingFor'] ?>"
                                   placeholder="<?= system_showText(LANG_SITEMGR_WHAT_LOOKING_FOR) ?>">
                        </div>
                    </div>
                </div>
            </form>
            <form id="form_slider_info" name="form_slider_info">
                <hr />

                <div class="row">
                    <div class="col-md-12">
                        <ul id="sortableSlider" class="list-sortable ui-sortable row">
                            <?= $slider ?>
                        </ul>
                        <a href="#" class="createSliderItem" data-maxslides="<?=TOTAL_SLIDER_ITEMS?>">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </form>

            <div id="sliderInfoDiv">
                <?= $sliderInfo ?>
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
                            id="<?= DEMO_LIVE_MODE ? "livemodeMessage" : "saveSliderWidget" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>
        <div class="alert alert-warning text-center">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <?= system_showText(LANG_SITEMGR_CHANGES_WIDGET) ?>
        </div>
    </div>
</div>
