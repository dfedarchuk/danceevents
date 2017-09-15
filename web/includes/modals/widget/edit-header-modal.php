<!-- edit header modal -->
<?php
$favIconFile = glob(EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/content_files/favicon_*");
$content = json_decode($content, true);
$trans = json_decode($trans, true);
?>
<div class="modal-dialog modal-lg widget-header" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span class="widgetTitle"><?= $widgetTitle ?></span></h4>
        </div>
        <div class="modal-body">
            <div class="alert" id="messageAlertHeader" style="display: none">
                <div></div>
            </div>

            <div class="add-favicon">
                <div class="add-favicon-tab">
                    <form name="form_favicon" id="form_favicon">
                        <? if (file_exists($favIconFile[0])) { ?>
                            <div class="edit-hover">
                                <a href="#" class="favIconButton">
                                    <img
                                        id="favIconImg"
                                        src="<?= str_replace(EDIRECTORY_ROOT, DEFAULT_URL, $favIconFile[0]) ?>?<?= rand(0, 1000) ?>"
                                        alt="Favicon">
                                </a>
                                <span class="page-title"></span>
                            </div>
                        <? } else { ?>

                            <div class="thumbnail">
                                &nbsp;
                            </div>
                                <a href="#" class="favIconButton">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    <?= system_showText(LANG_SITEMGR_ADD_FAVICON); ?>
                                </a>

                        <? } ?>
                        <input type="file" id="favIconInput" name="favicon_file" style="display: none;" onchange="saveImage('form_favicon', 'favicon', 'favIconImg', 'form_favicon', null, 'messageAlertHeader')">
                    </form>
                </div>
                <p class="help-block">
                    <small><?= system_showText(LANG_SITEMGR_ICONTIP); ?></small>
                </p>
            </div>

            <hr />

            <div class="row">
                <div class="col-md-12">
                    <form name="header" id="header" method="post"
                          action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>"
                          enctype="multipart/form-data">
                        <?
                        MessageHandler::render();

                        include(INCLUDES_DIR . "/forms/form-logo.php");
                        ?>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div id="aux_litext" style="display: none;"><?= $aux_LI_code ?></div>

                    <h4 class="subtitle">
                        <?= system_showText(LANG_SITEMGR_SETTINGS_NAVIGATION); ?>
                        <a class="pull-right" onclick="resetNavigation('header')">
                            <small><?= system_showText(LANG_SITEMGR_RESET_NAVIGATION) ?></small>
                        </a>
                    </h4>
                    <form role="form" id="form_navigation" name="form_navigation"
                          action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>"
                          method="post">
                        <input type="hidden" name="domain_id" value="<?= SELECTED_DOMAIN_ID ?>">
                        <? include(INCLUDES_DIR . "/forms/form-navigation.php"); ?>
                    </form>

                    <form id="reset_navigation" name="reset_navigation"
                          action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>"
                          method="post">
                        <input type="hidden" name="resetNavigation" value="reset"/>
                        <input type="hidden" name="area" value="<?= $navigation_area ?>"/>
                    </form>
                </div>
            </div>

            <div class="showLabels">
                <div class="row">
                    <div class="col-sm-12">
                        <p>
                            <a role="button" class="arrow-toggle collapsed" data-toggle="collapse" href="#collapseShowLabels" aria-expanded="false" aria-controls="collapseShowLabels" tabindex="25">
                                <?= system_showText(LANG_SITEMGR_WIDGET_SHOW_LOGIN_BAR_LABELS) ?>
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                <i class="fa fa-chevron-up" aria-hidden="true"></i>
                            </a>
                        </p>

                        <div class="collapse" id="collapseShowLabels" style="height: auto;">
                            <form class="form" name="form_header" id="form_header">
                                <div id="labelInputs">
                                    <input type="hidden" name="pageWidgetId" value="<?= $pageWidgetId ?>" />
                                    <? echo $wysiwygService->getGenericLabelInputs($content, $trans); ?>
                                </div>
                                <input type="hidden" name="saveWidgetForAllPages" value="1">
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-lg"
                            data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL); ?></button>
                    <button type="button" class="btn btn-primary btn-lg action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('header');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>

        </div>

        <div class="alert alert-warning text-center">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <?=system_showText(LANG_SITEMGR_CHANGES_WIDGET)?>
        </div>
    </div>
</div>
