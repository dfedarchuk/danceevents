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
# * FILE: /includes/code/widgetActionAjax.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
$loadSitemgrLangs = true;
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$container = SymfonyCore::getContainer();
$wysiwygService = $container->get('wysiwyg.service');
$translator = $container->get('translator');
setting_get("sitemgr_language", $sitemgr_language);
$sitemgrLanguage = substr($sitemgr_language, 0, 2);

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // Get Original Widget Content to translate (Widget Table)
    $originalWidget = $wysiwygService->getOriginalWidget($_GET['widgetId']);
    $labelsArray = json_decode($originalWidget->getContent(), true);

    // Get widget information if is already saved on database (Page_Widget Table)
    if ($_GET['pageWidgetId']) {
        $pageWidget = $wysiwygService->getWidgetFromPage($_GET['pageWidgetId']);
        $returnArray['pageWidgetId'] = $pageWidget->getId();
    } else {
        // Use the default information to start editing a new widget
        $pageWidget = $originalWidget;
    }

    // LABELS EXCEPTIONS THAT NEED A DIFFERENT TRANSLATION
    foreach ($labelsArray as $key => $label) {
        // Translations for label fields that initially is null OR is a number field
        if ($key == 'labelCopyrightText') {
            $label = $translator->trans('Copyright', [], 'widgets', /** @Ignore */
                $sitemgrLanguage);
        }
        if ($key == 'limit') {
            $label = $translator->trans('Limit', [], 'widgets', /** @Ignore */
                $sitemgrLanguage);
        }
        ///

        $transLabelsArray[$key] = /** @Ignore */
            $translator->trans($label, [], 'widgets', $sitemgrLanguage);
    }

    // Load Navigations or slider structure
    if ($_GET['modal'] == 'header') {
        $navbar = $wysiwygService->reloadNavbar();
        $returnArray['navbar'] = $navbar;
    }

    if ($_GET['modal'] == 'footer') {
        $navbar = $wysiwygService->reloadNavbar('footer');
        $returnArray['navbarFooter'] = $navbar;
    }

    if ($_GET['modal'] == 'slider') {
        $slider = $wysiwygService->reloadSlider();
        $returnArray['slider'] = $slider['sliderHtml'];
        $returnArray['sliderInfo'] = $slider['sliderInfoHtml'];
    }
    ///////

    // Create return array
    $returnArray['widgetTitle'] = /** @Ignore */
    $translator->trans($originalWidget->getTitle(), [], 'widgets', $sitemgrLanguage);
    $returnArray['widgetTitleImg'] = $originalWidget->getTitle();
    $returnArray['content'] = $pageWidget->getContent();
    $returnArray['trans'] = json_encode(isset($transLabelsArray) ? $transLabelsArray : []);

    if (isset($_GET['action']) && $_GET['action'] == 'edit'){
        extract($returnArray);
        include(INCLUDES_DIR.'/modals/widget/'.$_GET['modalFullName'].'.php');
    } else {
        echo json_encode($returnArray);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Save widget information
    $return = [];
    // Prepare content to be saved on the Page_Widget table
    if (isset($_POST['contentArr']) && $_POST['contentArr'] != '[]' and $_POST['contentArr'] != '') {
        $contentArr = json_decode($_POST['contentArr'], true);
        $pageWidgetId = null;
        $page = null;
        $widget = null;
        $theme = null;
        $widgetContent = [];
        $saveWidgetForAllPages = null;

        foreach ($contentArr as $content) {
            if ($content['name'] == 'pageWidgetId') {
                $pageWidgetId = $content['value'];
            } elseif ($content['name'] == 'saveWidgetForAllPages') {
                $saveWidgetForAllPages = $content['value'];
            } elseif ($content['name'] == 'customHtml') {
                $widgetContent[$content['name']] = $_POST['customHtml'] ? $_POST['customHtml'] : '';
            } else {
                $widgetContent[$content['name']] = $content['value'];
            }
        }

        $return = [
            'success'      => false,
            'errorMessage' => [
                $translator->trans('Something wrong', [], 'widgets', /** @Ignore */
                    $sitemgrLanguage),
            ],
        ];

        if ($pageWidgetId) {
            $returnWidget = $wysiwygService->saveWidgetContent($pageWidgetId, json_encode($widgetContent));
        } else {
            $returnWidget = $wysiwygService->saveWidget(json_encode($widgetContent), $_POST['pageId'],
                $_POST['widgetId']);
            $isNew = true;
        }

        if ($returnWidget) {
            $return = [
                'success'     => true,
                'isNewWidget' => ($isNew ? $isNew : false),
                'newWidgetId' => $returnWidget->getId(),
                'message'     => $translator->trans('Widget successfully saved.', [], 'widgets', /** @Ignore */
                    $sitemgrLanguage),
            ];
        }

        //Save the content of this widget to all pages that contains this widget
        if ($saveWidgetForAllPages) {
            $container->get("doctrine")->getRepository("WysiwygBundle:PageWidget")->updateWidgetContentForAllPages(
                $_POST['widgetId'],
                $wysiwygService->getSelectedTheme()->getId(),
                json_encode($widgetContent)
            );
        }

        //Save Newsletter
        if (isset($_POST['modal']) && $_POST['modal'] == 'newsletter') {
            // Label
            if (!setting_set('arcamailer_list_label', $widgetContent['labelSignupFor'])) {
                if (!setting_new('arcamailer_list_label', $widgetContent['labelSignupFor'])) {
                    // Nothing here
                }
            }

            // Description
            if (!setting_set('arcamailer_list_label_sub', $widgetContent['labelNewsletterDesc'])) {
                if (!setting_new('arcamailer_list_label_sub', $widgetContent['labelNewsletterDesc'])) {
                    // Nothing here
                }
            }

            setting_get('arcamailer_enable_list', $arcamailer);
            if ($arcamailer != 'on') {
                if (!setting_set('arcamailer_enable_list', 'on')) {
                    if (!setting_new('arcamailer_enable_list', 'on')) {
                        // Nothing here
                    }
                }
            }
        }
    }

    //Save Navigation header
    if (isset($_POST['navbarArr']) && $_POST['navbarArr']) {
        $area = strpos($_POST['modal'], 'header') !== false ? 'header' : 'footer';
        $wysiwygService->saveNavigation(json_decode($_POST['navbarArr'], true), $area);
    }

    // Save the social links on the database (Header / Footer Widgets)
    if (isset($_POST['socialLinks']) && $_POST['socialLinks']) {
        $wysiwygService->saveSocialLinks(json_decode($_POST['socialLinks'], true));
    }

    // Delete a slide from Slider, every time you delete one item,
    // the ID is added on a input that will be used here
    if (isset($_POST['deletedSlides']) && $_POST['deletedSlides']) {
        $wysiwygService->deleteSlider($_POST['deletedSlides']);
    }

    // Save Slider
    if (isset($_POST['sliderJson']) && $_POST['sliderJson']) {
        $wysiwygService->saveSlider($_POST['sliderJson']);
    }

    if (isset($_POST['removeWidget']) && $_POST['removeWidget']) {
        $return = [
            'success'      => false,
            'errorMessage' => $translator->trans('Something went wrong!', [], 'widgets', /** @Ignore */
                $sitemgrLanguage),
        ];

        if (($_POST['pageWidgetId'] != 'null' && $wysiwygService->deleteWidgetFromPage($_POST['pageWidgetId'])) || $_POST['pageWidgetId'] == 'null') {
            $return = [
                'success' => true,
                'message' => $translator->trans('Widget successfully deleted.', [], 'widgets', /** @Ignore */
                    $sitemgrLanguage),
            ];
        }
    }

    echo json_encode($return);
}
