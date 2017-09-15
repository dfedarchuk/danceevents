<!-- edit footer with logo modal -->
<?php
$content = json_decode($content, true);
$trans = json_decode($trans, true);
?>
<div class="modal-dialog modal-lg widget-footer" role="document">
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

            <div class="row">
                <div class="col-md-5">
                    <form name="footer" id="footer" method="post"
                          action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>"
                          enctype="multipart/form-data">
                        <?
                        MessageHandler::render();
                        $footerImg = true;
                        include(INCLUDES_DIR . "/forms/form-logo.php");
                        ?>
                    </form>
                </div>
                <div class="col-md-7">
                    <form role="form" id="form_navigation_footer" name="form_navigation_footer">
                        <h4 class="subtitle">
                            <?= system_showText(LANG_SITEMGR_LABEL_FOOTER_NAVIGATION); ?>
                            <a class="sortable-add createItem" data-modalaux="footer" href="javascript:void(0)">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </a>
                            <a class="pull-right" onclick="resetNavigation('footer')">
                                <small><?= system_showText(LANG_SITEMGR_RESET_NAVIGATION) ?></small>
                            </a>
                        </h4>
                        <ul id="sortableNavFooter" class="list-sortable ui-sortable">
                            <?= $navbarFooter  ?>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="showLabels">
                <div class="row">
                    <div class="col-sm-12">
                        <p>
                            <a role="button" class="arrow-toggle collapsed" data-toggle="collapse" href="#collapseShowLabelsFooter" aria-expanded="false" aria-controls="collapseShowLabelsFooter" tabindex="25">
                                <?= system_showText(LANG_SITEMGR_WIDGET_SHOW_FOOTER_LABELS) ?>
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                <i class="fa fa-chevron-up" aria-hidden="true"></i>
                            </a>
                        </p>

                        <div class="collapse" id="collapseShowLabelsFooter" style="height: auto;">
                            <form class="form" name="form_footer" id="form_footer">
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
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('footer-with-logo');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>

        <div class="alert alert-warning text-center">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <?=system_showText(LANG_SITEMGR_CHANGES_WIDGET)?>
        </div>
    </div>
</div>
