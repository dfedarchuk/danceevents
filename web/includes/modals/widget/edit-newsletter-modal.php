<!-- edit newsletter modal -->
<?php
$content = json_decode($content, true);
?>
<div class="modal-dialog modal-lg widget-newsletter" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
                id="myModalLabel"><?= system_showText(LANG_SITEMGR_EDIT_WIDGET); ?> - <span
                    class="widgetTitle"><?= $widgetTitle ?></span></h4>
        </div>
        <div class="modal-body">
            <div class="alert" id="messageAlertNewsletter" style="display: none">
                <div></div>
            </div>
            <div class="row">
                <form class="form" name="form_newsletter" id="form_newsletter">
                    <input type="hidden" name="pageWidgetId" id="pageWidgetId" value="<?= $pageWidgetId ?>" />
                    <input type="hidden" name="saveWidgetForAllPages" value="1">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="labelSignupFor"
                                   class="control-label"><?= system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTER_LABEL); ?></label>
                            <input type="text" class="form-control" id="labelSignupFor" name="labelSignupFor"
                                   placeholder="" value="<?= $content['labelSignupFor'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="labelNewsletterDesc"
                                   class="control-label"><?= system_showText(LANG_SITEMGR_LABEL_DESCRIPTION); ?></label>
                            <textarea class="form-control" rows="5" placeholder="" id="labelNewsletterDesc"
                                      name="labelNewsletterDesc"><?= $content['labelNewsletterDesc'] ?></textarea>
                        </div>
                    </div>
                </form>

                <div class="col-md-6">

                    <p id="returnMessage" class="alert" style="display:none;"></p>

                    <h5><?= system_showText(LANG_SITEMGR_COLOR_BACKGROUNDIMAGE); ?></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_newsletter_image" name="form_image">
                                <input id="bgImageNewsletterInput" name="background_image_newsletter" type="file"
                                       style="display: none;"
                                       onchange="saveImage('form_newsletter_image', 'image', 'bgImageNewsletter', 'image-background-newsletter', null, 'messageAlertNewsletter')">
                            </form>
                            <div id="image-background-newsletter" class="img-background text-center">
                                <?php if (file_exists(EDIRECTORY_ROOT.BKIMAGE_PATH."/".BKIMAGE_NAME."_newsletter.".BKIMAGE_EXT)) { ?>
                                    <div class="edit-hover">
                                        <a href="#" class="bgImageNewsletterButton">
                                            <img id="bgImageNewsletter"
                                                 src="<?= DEFAULT_URL.BKIMAGE_PATH."/".BKIMAGE_NAME."_newsletter.".BKIMAGE_EXT ?>?<?=time()?>"
                                                 alt="eDirectory">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="new">
                                        <a class="thumbnail add-new bgImageNewsletterButton" href="#">
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

                    <div id="loading_backgroundimage" class="alert alert-loading alert-block text-center hidden">
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
                            onclick="<?= DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "saveWidget('newsletter');" ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                </div>
            </div>
        </div>
        <div class="alert alert-warning text-center">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <?= system_showText(LANG_SITEMGR_CHANGES_WIDGET) ?>
        </div>
    </div>
</div>
