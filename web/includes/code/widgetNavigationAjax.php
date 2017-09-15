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

    // Reset tha navigation to the default
    if ($_GET['reset']) {
        $auxArrayModules = unserialize(THEME_NAVIGATION_MENU);
        $area = $_GET['area'];
        $array_modules = $auxArrayModules[$area];
        $wysiwygService->removesDisabledModules($array_modules, 'url');
        $navbarHtml = "";

        for ($i = 0; $i < count($array_modules); $i++) {
            $arrayOptions[$i]['label'] = constant($array_modules[$i]['name']);
            $arrayOptions[$i]['custom'] = 'n';
            $arrayOptions[$i]['link'] = $array_modules[$i]['url'];
            include(INCLUDES_DIR.'/forms/form-navigation-structure.php');
        }

    } else {
        // Create a new item on the navigation
        $i = 1;
        if ($_GET['area']) {
            $area = $_GET['area'];
        }
        $arrayOptions[1]['label'] = $translator->trans('New Item', [], 'widgets', /** @Ignore */
            $sitemgrLanguage);
        $arrayOptions[1]['custom'] = "n";
        $arrayOptions[1]['link'] = "DEFAULT_URL";
        include(INCLUDES_DIR.'/forms/form-navigation-structure.php');
    }

    echo $navbarHtml;
}
