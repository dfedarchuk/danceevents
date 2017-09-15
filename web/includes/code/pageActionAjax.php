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
# * FILE: /includes/code/pageActionAjax.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
use ArcaSolutions\WysiwygBundle\Entity\Page;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;

include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$container = SymfonyCore::getContainer();
$wysiwygService = $container->get('wysiwyg.service');
$translator = $container->get('translator');
setting_get("sitemgr_language", $sitemgr_language);
$sitemgrLanguage = substr($sitemgr_language, 0, 2);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['action'] == 'newPage') {

        try {
            $em = $container->get('doctrine')->getManager();
            $pageType = $container->get('doctrine')->getRepository('WysiwygBundle:PageType')->findOneBy(['title' => Wysiwyg::CUSTOM_PAGE]);
            $page = new Page();
            $page->setPageType($pageType);
            $page->setTitle($translator->trans('New Page', [], 'widgets', /** @Ignore */
                $sitemgrLanguage));
            $page->setUrl(system_generateFriendlyURL($translator->trans('New Page', [], 'widgets', /** @Ignore */
                    $sitemgrLanguage)).uniqid());
            $page->setSitemap(0);

            $em->persist($page);
            $em->flush($page);

            $wysiwygService->setTheme($wysiwygService->getSelectedTheme()->getTitle());

            $customDefaultWidgets = $wysiwygService->getCustomPageDefaultWidgets();

            foreach ($customDefaultWidgets as $widgetTitle) {
                $widget = $container->get('doctrine')->getRepository('WysiwygBundle:Widget')->findOneBy(['title' => $widgetTitle]);
                $wysiwygService->saveWidget(null, $page->getId(), $widget->getId());
            }

            $return = [
                'success'  => true,
                'error'    => null,
                'redirect' => DEFAULT_URL.'/'.SITEMGR_ALIAS.'/design/page-editor/custom.php?id='.$page->getId(),
            ];

        } catch (Exception $e) {
            $return = ['success' => false, 'error' => $e->getMessage()];
        }

        echo json_encode($return);
        exit;
    }
}
