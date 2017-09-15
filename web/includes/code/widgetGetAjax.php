<?

/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
#                                                                    #
# This file may not be redistributed in whole or part.               #
# eDirectory is licensed on a per-domain basis.                      #
#                                                                    #
# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
#                                                                    #
# http://www.edirectory.com | http://www.edirectory.com/license.html #
######################################################################
\*==================================================================*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/code/widgetGetAjax.php
# ----------------------------------------------------------------------------------------------------


# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$container = SymfonyCore::getContainer();
$wysiwygService = $container->get('wysiwyg.service');

$translator = $container->get('translator');
setting_get("sitemgr_language", $sitemgr_language);
$sitemgrLanguage = substr($sitemgr_language, 0, 2);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['resetPage'])) {
        $page = $container->get('doctrine')->getRepository('WysiwygBundle:Page')->find($_GET['resetPage']);

        $pageType = $page->getPageType()->getTitle();
        $wysiwygService->setTheme($wysiwygService->getSelectedTheme()->getTitle());
        // Get Default Widgets Method
        $method = 'get'.str_replace(' ', '', $pageType).'DefaultWidgets';

        $pageWidgetsArr = $wysiwygService->$method();

        $i = 0;
        if ($pageWidgetsArr) {
            foreach ($pageWidgetsArr as $pageWidgetTitle) {
                $widget = $container->get('doctrine')->getRepository('WysiwygBundle:Widget')->findOneBy(['title' => $pageWidgetTitle]);
                $i++;
                $widgetId = $widget->getId();
                $pageWidgetId = '';
                $widgetModal = $widget->getModal();
                $widgetTitle = /** @Ignore */
                    $translator->trans($widget->getTitle(), [], 'widgets', $sitemgrLanguage);
                $widgetTitleImg = $widget->getTitle();

                include(INCLUDES_DIR."/lists/list-widgets.php");
            }
        }

    } else {
        $widget = $wysiwygService->getOriginalWidget((int)$_GET['widgetId']);

        $i = rand(20, 9999);
        /* @var \ArcaSolutions\WysiwygBundle\Entity\Widget $widget */
        $widgetId = $widget->getId();
        $pageWidgetId = '';
        $widgetModal = $widget->getModal();
        $widgetTitle = /** @Ignore */
            $translator->trans($widget->getTitle(), [], 'widgets', $sitemgrLanguage);
        $widgetTitleImg = $widget->getTitle();
        $widgetType = $widget->getType();

        include(INCLUDES_DIR.'/lists/list-widgets.php');
    }
}
