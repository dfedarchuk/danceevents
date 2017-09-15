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
# * FILE: /functions/colorscheme_funct.php
# ----------------------------------------------------------------------------------------------------

function colorscheme_generateDynamicCSS($clear = false, $array = null)
{
    $newInfo = [];

    if ($array) {
        array_key_exists("colorNavbar", $array) and $newInfo["SCHEME_COLORNAVBAR"] = $array['colorNavbar'];
        array_key_exists("colorNavbarLink", $array) and $newInfo["SCHEME_COLORNAVBARLINK"] = $array['colorNavbarLink'];
        array_key_exists("colorFooterLink", $array) and $newInfo["SCHEME_COLORFOOTERLINK"] = $array['colorFooterLink'];
        array_key_exists("color1", $array) and $newInfo["SCHEME_COLOR1"] = $array['color1'];
        array_key_exists("color2", $array) and $newInfo["SCHEME_COLOR2"] = $array['color2'];
    }

    $dynamicPHPPath = THEMEFILE_DIR . "/" . EDIR_THEME . "/colorscheme.php";
    $arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);

    $domainRoot = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/theme/" . EDIR_THEME;
    $dynamicCSSPath = $domainRoot . "/colorscheme.css";

    $handle = fopen($dynamicCSSPath, 'w+');

    if ($clear) {
        fwrite($handle, "");
        fclose($handle);

        return;
    }

    include_once(CLASSES_DIR . "/class_miniJS.php");

    //array with all colors and image to be replaced
    $constReplace = [
        "SCHEME_COLORNAVBAR",
        "SCHEME_COLORNAVBARLINK",
        "SCHEME_COLORFOOTERLINK",
        "SCHEME_COLOR1",
        "SCHEME_COLOR2",
        "SCHEME_FONTOPTION"
    ];

    $phpContent = file_get_contents($dynamicPHPPath);

    $regexPattern = "/<!--Marker-->.*<!--Marker-->/s";
    $phpContent = preg_replace($regexPattern, "", $phpContent); //remove the file header info

    foreach ($constReplace as $const) {
        unset($newValue);

        if (array_key_exists($const, $newInfo)) {
            $newValue = $newInfo[$const];
        } elseif ($const == "SCHEME_FONTOPTION") { //replace font family value
            $auxFont = array_key_exists("SCHEME_FONTOPTION", $newInfo) ? $newInfo['fontOption'] : (defined($const) ? constant($const) : $arrayDefault[EDIR_THEME][EDIR_SCHEME]["fontName"]);

            switch ($auxFont) {
                case 1:
                default:
                    $newValue = $arrayDefault[EDIR_THEME][EDIR_SCHEME]["fontName"];
                    break;
                case 2:
                    $newValue = "Arial, Helvetica, Sans-serif";
                    break;
                case 3:
                    $newValue = "\"Courier New\", Courier, monospace";
                    break;
                case 4:
                    $newValue = "Georgia, \"Times New Roman\", Times, serif";
                    break;
                case 5:
                    $newValue = "Tahoma, Geneva, sans-serif";
                    break;
                case 6:
                    $newValue = "\"Trebuchet MS\", Arial, Helvetica, sans-serif";
                    break;
                case 7:
                    $newValue = "Verdana, Geneva, sans-serif";
                    break;
            }
        } elseif (defined($const) && $const != "SCHEME_EMPTY") { //read the new value to be replaced
            $newValue = constant($const);
        }

        if ($newValue) {
            $phpContent = str_replace("<?=$const?>", $newValue, $phpContent);
        }
    }

    fwrite($handle, ($phpContent));
    fclose($handle);
}

function colorscheme_themeSchemeFile($array, $select_scheme, $edir_theme, $use_scheme, &$status)
{
    $status = "";
    $fileschemeConfigPath = EDIRECTORY_ROOT . '/custom/domain_' . SELECTED_DOMAIN_ID . '/theme/' . $edir_theme . '_scheme.inc.php';

    if (!$fileschemeConfig = fopen($fileschemeConfigPath, 'w+')) {
        $status = 'error';

    } else {

        $auxCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);

        $themes = explode(",", EDIR_THEMES);
        $buffer = "<?php" . PHP_EOL . "\$edir_scheme=\"$edir_theme\";" . PHP_EOL;

        $schemes = explode(",", constant("EDIR_SCHEMES"));
        foreach ($schemes as $scheme) {
            foreach ($array as $key => $value) {
                if ($select_scheme == $scheme) {
                    $buffer .= "\$arrayScheme[\"$scheme\"][\"$key\"] = \"" . ($value ? $value : "SCHEME_EMPTY") . "\";" . PHP_EOL;
                } else {
                    $buffer .= "\$arrayScheme[\"$scheme\"][\"$key\"] = \"" . $auxCurValues[$scheme][$key] . "\";" . PHP_EOL;
                }
            }
        }

        if (!fwrite($fileschemeConfig, $buffer, strlen($buffer))) {
            $status = 'error';
        }

        fclose($fileschemeConfig);
    }
}
