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
# * FILE: /includes/code/layout_editor.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------
extract($_POST);
extract($_GET);

//Ajax requests
if ($_GET["action"] == "ajax") {

    //Upload background image
    if ($_GET["type"] == "uploadBackground") {

        $return = "";
        $error = false;

        if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {

            if ($_FILES) {

                $i = 1;
                $image_errors = [];

                $maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1) . "00000";

                foreach ($_FILES as $key => $value) {

                    if (strlen($value["tmp_name"]) > 0) {
                        if (image_upload_check($value["tmp_name"])) {
                            if (strlen($value["name"])) {
                                $_POST[$key] = $value["name"];
                            }
                        } else {
                            $image_errors[] = "&#149;&nbsp; " . system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
                        }

                        if ($value["size"] > $maxImageSize) {
                            $image_errors[] = "&#149;&nbsp; " . system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS . " " . UPLOAD_MAX_SIZE . "MB.");
                        }
                    }
                    $i++;
                }

                if (count($image_errors) == 0) {
                    if ($_FILES["file_background_image"]["error"] == 0) {

                        $image_upload = image_uploadForSitemgr(EDIRECTORY_ROOT . BKIMAGE_PATH . "/" . BKIMAGE_NAME . "." . BKIMAGE_EXT,
                            $_FILES["file_background_image"]["tmp_name"]);
                        if ($image_upload["success"]) {
                            $bkImgage = front_getBackground(true);
                            $return = $bkImgage;
                        } else {
                            $error = true;
                            $return = system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);
                        }

                    } else {
                        $error = true;
                        $return = system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);
                    }
                } else {
                    $error = true;
                    foreach ($image_errors as $imgError) {
                        $return .= $imgError . "<br />";
                    }
                }

            } else {
                $error = true;
                $return = system_showText(LANG_SITEMGR_IMAGE_EMPTY);
            }
        }

        echo ($error ? "error" : "ok") . "||" . $return;

        //Save background image
    } elseif ($_GET["type"] == "general") {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $error = false;

            if ($_POST["form_id"] == "theme_background_image") {

                $buttonReset = "";

                if ($_POST["reset_form"] == "reset") {

                    @unlink(EDIRECTORY_ROOT . BKIMAGE_PATH . "/" . BKIMAGE_NAME . "." . BKIMAGE_EXT);

                    $buttonReset = "hide";

                    $newImageReturn = front_getBackground(true);

                    $msg = system_showText(LANG_SITEMGR_BACKGROUND_UPDATED);

                } else {
                    $msg = system_showText(LANG_SITEMGR_IMAGE_EMPTY);
                    $error = true;
                }
            }

            echo ($error ? "error" : "success") . "||" . $msg . ($buttonReset ? "||" . $buttonReset . "||" . $newImageReturn : "");
        }

    }
    exit;
}

$filethemeConfigPath = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/theme/theme.inc.php";
$folderthemesPath = EDIRECTORY_ROOT . "/theme";
unset($array);

// Default CSS class for message
$message_style = "success";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !DEMO_LIVE_MODE && $submitAction == "changetheme") {

    if ($select_theme) {
        $status = "success";

        $src = EDIRECTORY_ROOT . "/theme/$select_theme";
        $dst = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/theme/" . $select_theme;
        if (!is_dir($dst)) {
            $domain = new Domain(SELECTED_DOMAIN_ID);
            $domain->copyThemeToDomain($src, $dst);
        }

        if (!$filethemeConfig = fopen($filethemeConfigPath, "w+")) {
            $status = "error";
        } else {

            $buffer = "<?php" . PHP_EOL . "\$edir_theme=\"$select_theme\";" . PHP_EOL;

            if (!fwrite($filethemeConfig, $buffer, strlen($buffer))) {
                $status = "error";
            }

            if ($select_theme == EDIR_THEME) {
                $auxCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);

                $array["colorNavbar"] = $auxCurValues[$scheme]["colorNavbar"];
                $array["colorNavbarLink"] = $auxCurValues[$scheme]["colorNavbarLink"];
                $array["colorFooterLink"] = $auxCurValues[$scheme]["colorFooterLink"];
                $array["color1"] = $auxCurValues[$scheme]["color1"];
                $array["color2"] = $auxCurValues[$scheme]["color2"];
                $array["fontOption"] = $auxCurValues[$scheme]["fontOption"];

                colorscheme_themeSchemeFile($array, $scheme, $select_theme, $scheme, $status);
            } else {
                @include_once(EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/theme/" . $select_theme . "_scheme.inc.php");
                $scheme = $edir_scheme;
            }

        }

        // saves theme in yml file
        $domain = new Domain(SELECTED_DOMAIN_ID);
        $classSymfonyYml = new Symfony('domain.yml');
        $theme_domain = [
            'multi_domain' => [
                'hosts' => [
                    $domain->getString('url') => [
                        'template' => $_POST['select_theme'],
                    ]
                ]
            ]
        ];
        $classSymfonyYml->save('Configs', $theme_domain);

        $container = SymfonyCore::getContainer();
        $theme = $container->get("doctrine")->getRepository("WysiwygBundle:Theme")->findOneBy([
            'title' => ucfirst($_POST['select_theme']),
        ]);

        if (!$container->get("doctrine")->getRepository("WysiwygBundle:PageWidget")->findBy(['themeId' => $theme->getId()])) {
            $loader = new \Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader($container);
            $loader->loadFromDirectory(EDIRECTORY_ROOT . "/../src/ArcaSolutions/WysiwygBundle/DataFixtures/ORM/Common");
            $loader->loadFromDirectory(EDIRECTORY_ROOT . "/../src/ArcaSolutions/WysiwygBundle/DataFixtures/ORM/Theme" . ucfirst($_POST['select_theme']));

            $em = $container->get("doctrine.orm.domain_entity_manager");
            $purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger();

            $executor = new \Doctrine\Common\DataFixtures\Executor\ORMExecutor($em, $purger);
            $executor->execute($loader->getFixtures(), true);
        }

    } else {
        $status = "error";
    }

    header("Location: " . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/design/themes/index.php?status=$status$ajaxCategory&selected_themesuccess=$select_theme");
    exit;
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !DEMO_LIVE_MODE && $submitAction == "changecolors") {

    if ($action == "submit") {

        $array["colorNavbar"] = $colorNavbar;
        $array["colorNavbarLink"] = $colorNavbarLink;
        $array["colorFooterLink"] = $colorFooterLink;
        $array["color1"] = $color1;
        $array["color2"] = $color2;
        $array["fontOption"] = $font;

        colorscheme_themeSchemeFile($array, $scheme, EDIR_THEME, ($aux_action ? $scheme : EDIR_SCHEME), $status);

        colorscheme_generateDynamicCSS(false, $array);

        header("Location: " . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/design/colors-fonts/index.php?status=successcolors&selected_themesuccess=".EDIR_THEME);
        exit;

    } elseif ($action == "reset") {

        $arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
        $arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);

        $array["colorNavbar"] = $arrayDefault[$theme][$scheme]["colorNavbar"] ? $arrayDefault[$theme][$scheme]["colorNavbar"] : "SCHEME_EMPTY";
        $colorNavbar = $arrayDefault[$theme][$scheme]["colorNavbar"] ? $arrayDefault[$theme][$scheme]["colorNavbar"] : false;

        $array["colorNavbarLink"] = $arrayDefault[$theme][$scheme]["colorNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorNavbarLink"] : "SCHEME_EMPTY";
        $colorNavbarLink = $arrayDefault[$theme][$scheme]["colorNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorNavbarLink"] : false;

        $array["colorFooterLink"] = $arrayDefault[$theme][$scheme]["colorFooterLink"] ? $arrayDefault[$theme][$scheme]["colorFooterLink"] : "SCHEME_EMPTY";
        $colorFooterLink = $arrayDefault[$theme][$scheme]["colorFooterLink"] ? $arrayDefault[$theme][$scheme]["colorFooterLink"] : false;

        $array["color1"] = $arrayDefault[$theme][$scheme]["color1"] ? $arrayDefault[$theme][$scheme]["color1"] : "SCHEME_EMPTY";
        $color1 = $arrayDefault[$theme][$scheme]["color1"] ? $arrayDefault[$theme][$scheme]["color1"] : false;

        $array["color2"] = $arrayDefault[$theme][$scheme]["color2"] ? $arrayDefault[$theme][$scheme]["color2"] : "SCHEME_EMPTY";
        $color2 = $arrayDefault[$theme][$scheme]["color2"] ? $arrayDefault[$theme][$scheme]["color2"] : false;

        $array["fontOption"] = $arrayDefault[$theme][$scheme]["fontOption"] ? $arrayDefault[$theme][$scheme]["fontOption"] : "SCHEME_EMPTY";
        $font = 1;

        colorscheme_themeSchemeFile($array, $scheme, EDIR_THEME, EDIR_SCHEME, $status);

        colorscheme_generateDynamicCSS(true);

        header("Location: " . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/design/colors-fonts/index.php?status=successcolors");
        exit;
    }
}

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
setting_get("sitemgr_language", $sitemgr_language);

unset($folders);
$folderthemes = opendir($folderthemesPath);
$folders = [];
while ($folder = readdir($folderthemes)) {
    if ($folder != "sample" && $folder != "." && $folder != "..") {
        $folders[] = $folder;
    }
}
unset($valuesArray);
unset($namesArray);

$_valuesArray = explode(",", EDIR_THEMES);
$_namesArray = explode(",", EDIR_THEMENAMES);
$availableThemes = [];
$countThemes = 0;
for ($i = 0; $i < count($_valuesArray); $i++) {
    if (in_array($_valuesArray[$i], $folders)) {
        if ($_namesArray[$i]) {
            $availableThemes[$countThemes]["name"] = $_namesArray[$i];
            $availableThemes[$countThemes]["value"] = $_valuesArray[$i];

            switch ($_valuesArray[$i]) {
                case "default"      :
                    $availableThemes[$countThemes]["preview_url"] = ($sitemgr_language == "pt_br" ? "http://demodirectory.com.br/" : "http://demodirectory.com/");
                    break;
            }

            $countThemes++;

        }
    }
}

$edir_theme = (EDIR_THEME == "" ? "default" : EDIR_THEME);

//Messages
if ($status == "success") {
    $message = system_showText(LANG_SITEMGR_SETTINGS_THEMES_THEMEWASCHANGED);
    $message_style = "success";
} elseif ($status == "failed") {
    $message = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
    $message_style = "warning";
} elseif ($status == "successcolors") {
    $message = system_showText(LANG_SITEMGR_COLOR_SAVED);
    $message_style = "success";
}

if ($_SERVER['REQUEST_METHOD'] != "POST") {

    if (!DEMO_LIVE_MODE) {
        $arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
        if (!$arrayCurValues) {
            $arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
            $arrayCurValues = $arrayDefault[EDIR_THEME];
        }
    } else {
        $arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
        $arrayCurValues = $arrayDefault[EDIR_THEME];
    }

    $colorNavbar = $arrayCurValues[($selected_themesuccess ? $selected_themesuccess : EDIR_THEME)]["colorNavbar"];
    $colorNavbarLink = $arrayCurValues[($selected_themesuccess ? $selected_themesuccess : EDIR_THEME)]["colorNavbarLink"];
    $colorFooterLink = $arrayCurValues[($selected_themesuccess ? $selected_themesuccess : EDIR_THEME)]["colorFooterLink"];
    $color1 = $arrayCurValues[($selected_themesuccess ? $selected_themesuccess : EDIR_THEME)]["color1"];
    $color2 = $arrayCurValues[($selected_themesuccess ? $selected_themesuccess : EDIR_THEME)]["color2"];
    $fontOption = $arrayCurValues[($selected_themesuccess ? $selected_themesuccess : EDIR_THEME)]["fontOption"];

} else {
    $fontOption = $font;
}

$arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
$arrayAuxCurValues = $arrayDefault[EDIR_THEME];

unset($arrayFont);
unset($arrayNameFont);
unset($arrayValueFont);

$arrayNameFont[] = $arrayAuxCurValues[($selected_themesuccess ? $selected_themesuccess : EDIR_THEME)]["fontName"];
$arrayNameFont[] = "Arial, Helvetica, Sans-serif";
$arrayNameFont[] = "Courier New, Courier, monospace";
$arrayNameFont[] = "Georgia, Times New Roman, Times, serif";
$arrayNameFont[] = "Tahoma, Geneva, sans-serif";
$arrayNameFont[] = "Trebuchet MS, Arial, Helvetica, sans-serif";
$arrayNameFont[] = "Verdana, Geneva, sans-serif";

$arrayValueFont[] = 1; //Open Sans
$arrayValueFont[] = 2; //Arial, Helvetica, Sans-serif
$arrayValueFont[] = 3; //'Courier New', Courier, monospace
$arrayValueFont[] = 4; //Georgia, 'Times New Roman', Times, serif
$arrayValueFont[] = 5; //Tahoma, Geneva, sans-serif
$arrayValueFont[] = 6; //'Trebuchet MS', Arial, Helvetica, sans-serif
$arrayValueFont[] = 7; //Verdana, Geneva, sans-serif

$arrayFont = html_selectBox("font", $arrayNameFont, $arrayValueFont, $fontOption, "", "", "");

$table_colors_1 = [0 => "NavbarLink", 1 => "FooterLink"];
$table_colors_2 = [0 => "Navbar"];
$table_colors_3 = [0 => "1", 1 => "2"];
