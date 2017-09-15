<!-- edit contact form modal -->
<?php
$content = json_decode($content, true);
$trans = json_decode($trans, true);
?>
<div class="modal-dialog widget-contactform" role="document" id="">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span class="widgetTitle"><?= $widgetTitle ?></span></h4>
        </div>
        <div class="modal-body">
            <section class="section-form">
                <div class="col-sm-12">
                    <p><?=system_showText(LANG_SITEMGR_LEADS_TIP2)?></p>
                    <p id="successMessage" class="alert alert-success" style="display:none;"><?=system_showText(LANG_SITEMGR_LEADS_SUCCESS)?></p>
                </div>
                <div class="col-sm-12">
                    <input type="hidden" name="domain_url" id="domain_url" value="<?=$domainURL?>" />
                    <input type="hidden" name="livemode" id="livemode" value="<?=(DEMO_LIVE_MODE ? 1 : 0)?>" />
                    <input type="hidden" name="livemode_msg" id="livemode_msg" value="<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2);?>" />
                    <div id="form-builder" class="form-builder"></div>
                </div>
            </section>
            <form class="form" id="form_contactform" name="form_contactform">
                <div id="labelInputs">
                    <input type="hidden" name="pageWidgetId" value="<?= $pageWidgetId ?>" />
                    <? echo $wysiwygService->getGenericLabelInputs($content, $trans); ?>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-lg"
                            data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL); ?></button>
                    <input type="submit" id="frmb-0-save-button" class="frmb-submit btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"
                           value="<?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?>" tabindex="67">
                </div>
            </div>
        </div>
    </div>
</div>
