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
# * FILE: /includes/code/widgetSliderAjax.php
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

$sliderHtml = '';
$sliderInfoHtml = '';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // This will create a new item and fill the slider structure
    $i = 1;
    $r = rand(1, 9999);
    $sliders[$i] = new \ArcaSolutions\WebBundle\Entity\Slider();
    $sliders[$i]->setTitle($translator->trans('New Slide', [], 'widgets', /** @Ignore */
        $sitemgrLanguage));
    include(INCLUDES_DIR.'/forms/form-slider-structure.php');
    include(INCLUDES_DIR.'/forms/form-slider-info-structure.php');
}

echo json_encode(['slider' => $sliderHtml, 'sliderInfo' => $sliderInfoHtml, 'newId' => $r]);
