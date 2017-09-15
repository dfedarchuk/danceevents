<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/design/page-editor/custom.php
# ----------------------------------------------------------------------------------------------------

use ArcaSolutions\WysiwygBundle\Entity\Widget;

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

/* Gets the container */
$container = SymfonyCore::getContainer();

/* Gets the WYSIWYG and Translation services */
$wysiwygService = $container->get('wysiwyg.service');
$trans = $container->get('translator');

/* Gets Lang */
setting_get("sitemgr_language", $sitemgr_language);
$sitemgrLanguage = substr($sitemgr_language, 0, 2);

// @formatter:off
$widgetTypes = [
    Widget::HEADER_TYPE     => $trans->trans('Header', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::COMMON_TYPE     => $trans->trans('Common', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::SEARCH_TYPE     => $trans->trans('Search', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::BANNER_TYPE     => $trans->trans('Banners', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::LISTING_TYPE    => $trans->trans('Listings', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::EVENT_TYPE      => $trans->trans('Events', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::ARTICLE_TYPE    => $trans->trans('Articles', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::DEAL_TYPE       => $trans->trans('Deals', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::BLOG_TYPE       => $trans->trans('Blog', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::CLASSIFIED_TYPE => $trans->trans('Classifieds', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
    Widget::FOOTER_TYPE     => $trans->trans('Footer', [], 'widgets', /** @Ignore */ $sitemgrLanguage),
];
// @formatter:on

/* Gets Page and Widgets */
$page = $wysiwygService->getPage($_GET['page']);
$groupedWidgets = $wysiwygService->getGroupedWidgets($_GET['type']);
$settings = $container->get('settings')->getDomainSetting('arcamailer_enable_list');

/* Gets Page Widgets */
$pageWidgets = $wysiwygService->getPageWidget($page->getId());
$excludeWidgets = [];
foreach ($wysiwygService->getWidgetNonDuplicate() as $widgetGroup => $widgetsTitle) {
    $titleWidgets = array_flip($widgetsTitle);
    if (count(array_intersect_key($titleWidgets, $pageWidgets)) > 0) {
        $excludeWidgets = array_merge($excludeWidgets, $widgetsTitle);
    }
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"
        id="myModalLabel"><?= system_showText(LANG_SITEMGR_INSERT_WIDGET) ?></h4>
</div>
<div class="modal-body">
    <ul class="nav nav-tabs" role="tablist">
        <?php
        $i = 0;
        foreach ($widgetTypes as $widgetType => $widgetTypeName) { ?>
            <li role="presentation" class="<?= ($i == 0 ? 'active' : '') ?>">
                <a href="#tab-<?= ($widgetType == 'header' ? 'headers' : $widgetType) ?>"
                   aria-controls="<?= ($widgetType == 'header' ? 'headers' : $widgetType) ?>" role="tab"
                   data-toggle="tab">
                    <?= ucfirst($widgetTypeName) ?>
                </a>
            </li>
            <?php
            $i++;
        }
        ?>
    </ul>

    <div class="tab-content">
        <?php
        $i = 0;
        foreach ($widgetTypes as $widgetType => $widgetTypeName) { ?>
            <div role="tabpanel" class="tab-pane<?= ($i == 0 ? ' active' : '') ?>"
                 id="tab-<?= ($widgetType == 'header' ? 'headers' : $widgetType) ?>">
                <div class="row text-center">
                    <?php
                    $w = 0;
                    foreach ($groupedWidgets[$widgetType] as $widget) {
                        if (in_array($widget['title'], $excludeWidgets)) {
                            continue;
                        }
                        ?>
                        <div class="col-md-6">
                            <div
                                class="thumbnail <?= ($widget['title'] == 'Signup for our newsletter' && $settings == null ? 'linkWidget' : 'addWidget') ?>"
                                data-widgetid="<?= $widget['id'] ?>" data-pageId="<?= $page->getId() ?>"
                                data-title="<?= $widget['title'] ?>" data-type="<?= $widget['type'] ?>">
                                <div class="caption">
                                    <h4><?= /** @Ignore */
                                        $trans->trans($widget['title'], [], 'widgets', /** @Ignore */
                                            $sitemgrLanguage) ?></h4>
                                    <? $imgPath = "../../assets/img/widget-placeholder/".EDIR_THEME."/".system_generateFriendlyURL($widget['title']).".jpg";
                                    if (!file_exists(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/assets/img/widget-placeholder/".EDIR_THEME."/".system_generateFriendlyURL($widget['title']).".jpg")) {
                                        $imgPath = "../../assets/img/widget-placeholder/".EDIR_THEME."/custom-content.jpg";
                                    } ?>
                                    <img
                                        src="<?= $imgPath ?>"/>
                                </div>
                            </div>
                        </div>
                        <?php
                        $w++;
                    }
                    ?>
                    <div class="col-md-12 text-left <?= $w != 0 ? 'hide' : ''; ?>">
                        <div class="alert alert-warning" role="alert">
                            <?= $trans->trans('No widgets available. Widgets of this section can be placed just once in a page. Please check if your page already have a widget of this type',
                                [], 'widgets', /** @Ignore */
                                $sitemgrLanguage); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
        <div role="tabpanel" class="tab-pane text-center" id="widget2">
            <h3><?= system_showText(LANG_SITEMGR_CONFIGURE_NEWSLETTER_TITLE) ?></h3>
            <p><?= system_showText(LANG_SITEMGR_CONFIGURE_NEWSLETTER_TEXT) ?></p>
            <p><a class="btn btn-primary"
                  href="#"><?= system_showText(LANG_SITEMGR_CONFIGURE_NEWSLETTER) ?></a>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">
        <?= system_showText(LANG_SITEMGR_CANCEL) ?>
    </button>
</div>
