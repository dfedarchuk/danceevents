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
# * FILE: /includes/code/location_settings.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------

$googleSettings = new GoogleSettings();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($datesettings) {

        $localRedirect = "?message=6";
        $fileConstPath = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/conf/constants.inc.php";
        $constValues = [];
        $constValues["date_format"] = ($date_format ? $date_format : DEFAULT_DATE_FORMAT);
        $constValues["clock_type"] = ($clock_type ? $clock_type : CLOCK_TYPE);

        SymfonyCore::getContainer()->get("languagehandler")->setDateFormat($date_format);
        SymfonyCore::getContainer()->get("languagehandler")->setTimeFormat($clock_type);

        if (!system_writeConstantsFile($fileConstPath, SELECTED_DOMAIN_ID, $constValues)) {
            $error = true;
        }

        setting_set('date_format', $constValues["date_format"]) or setting_new('date_format', $constValues["date_format"])
        or MessageHandler::registerError(array("DBerror" => system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE)));

        setting_set('clock_type', $constValues["clock_type"]) or setting_new('clock_type', $constValues["clock_type"])
        or MessageHandler::registerError(array("DBerror" => system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE)));

        if ($opt_timezone != "Default Time Zone") {
            $fileConfigPath = EDIRECTORY_ROOT . '/custom/domain_' . SELECTED_DOMAIN_ID . '/timezone.inc.php';
            if ($fileConfig = fopen($fileConfigPath, 'w+')) {
                $buffer = "<?php" . PHP_EOL . "ini_set('date.timezone', '$opt_timezone');" . PHP_EOL;
                if (!fwrite($fileConfig, $buffer, strlen($buffer))) {
                    $error = true;
                }

                setting_set('date_timezone', $opt_timezone) or setting_new('date_timezone', $opt_timezone)
                or MessageHandler::registerError(array("DBerror" => system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE)));
            }
        } else {
            @unlink(EDIRECTORY_ROOT . '/custom/domain_' . SELECTED_DOMAIN_ID . '/timezone.inc.php');
        }

        if ($error) {
            $localRedirect = "?error=true&message=7";
        }

        $url_redirect .= $localRedirect;
        header("Location: $url_redirect");
        exit;
    }

    // Default CSS class for message
    $message_style = "success";

    $locations_info = db_getFromDB("settinglocation", false, false, false, "id", "array");

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    /* Saves geoLocation feature */
    if ($location_setting == 'geolocation') {
        $error = false;
        $localRedirect = "?message=1";

        /* Saves google geolocation key */
        $geoLocationKey = trim($google_geocoding_key);

        if (($geoip_feature == 'on' || $nearby_feature_enabled == "on") and empty($geoLocationKey)) {
            $error = 8;
        }

        $nearby_default_radius = preg_replace("/[^1-9,.]/", "", $nearby_default_radius);

        if ($nearby_feature_enabled == "on" and empty($nearby_default_radius)){
            $error = 9;
        }

        if (! $error) {
            $googleSettings->geoLocationKey = $geoLocationKey;
            $googleSettings->geoLocationStatus = $geoip_feature ? 'on' : 'off';
            if ( !$googleSettings->Save()) {
                $error = true;
            }
            if (!setting_set("nearby_feature_enabled", $nearby_feature_enabled )) {
                setting_new("nearby_feature_enabled", $nearby_feature_enabled );
            }
            if (!setting_set("nearby_default_radius", $nearby_default_radius)) {
                setting_new("nearby_default_radius", $nearby_default_radius);
            }
        }

        if ($error) {
            /* Error message */
            $localRedirect = "?error=true&message=".$error;
        }

        $url_redirect .= $localRedirect;
        header("Location: $url_redirect");
        exit;
    }

    $flag_set_as_default = true;
    $last_enabled = '';

    /*
     * Getting last location enabled, run the entire post looking for fields
     */
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST['location_' . $i . '_enabled']) && $_POST['location_' . $i . '_enabled'] == 'on') {
            $last_enabled = $i;
        }
    }

    foreach ($locations_info as $each_location_info) {
        $location_level = $each_location_info["id"];
        $default_location_id = ${"default_L" . $location_level . "_id"};
        if ($default_location_id) {
            $location_name = ${"default_L" . $location_level . "_name"};
            if ($flag_set_as_default) {
                $sql = "SELECT count(id) AS total FROM Listing WHERE location_" . $location_level . " <> " . $default_location_id . " AND location_" . $location_level . " > 0";
                $r = $db->query($sql);
                $row = mysql_fetch_assoc($r);
                if ($row['total']) {
                    $flag_set_as_default = false;
                    $non_default_found = 'LISTING';
                    $non_default_level = $location_level;
                }
            }
            if ($flag_set_as_default) {
                $sql = "SELECT count(id) AS total FROM Event WHERE location_" . $location_level . " <> " . $default_location_id . " AND location_" . $location_level . " > 0";
                $r = $db->query($sql);
                $row = mysql_fetch_assoc($r);
                if ($row['total']) {
                    $flag_set_as_default = false;
                    $non_default_found = 'EVENT';
                    $non_default_level = $location_level;
                }
            }
            if ($flag_set_as_default) {
                $sql = "SELECT count(id) AS total FROM Classified WHERE location_" . $location_level . " <> " . $default_location_id . " AND location_" . $location_level . " > 0";
                $r = $db->query($sql);
                $row = mysql_fetch_assoc($r);
                if ($row['total']) {
                    $flag_set_as_default = false;
                    $non_default_found = 'CLASSIFIED';
                    $non_default_level = $location_level;
                }
            }
        }
    }

    if (!$flag_set_as_default) {
        $url_redirect .= "?error=true&message=4&level=" . $non_default_level . "&location_name=" . $location_name . "&non_default_found=" . $non_default_found;
        header("Location: $url_redirect");
        exit;
    } else {

        $flag_disable_location = true;
        foreach ($locations_info as $each_location_info) {
            $location_level = $each_location_info["id"];
            if (!${"location_" . $location_level . "_enabled"} && $flag_disable_location) {
                $sql = "SELECT count(id) AS total FROM Listing WHERE location_" . $location_level . " > 0 ";
                $r = $db->query($sql);
                $row = mysql_fetch_assoc($r);
                if ($row['total']) {
                    $flag_disable_location = false;
                    $non_disable_found = 'LISTING';
                    $non_disable_level = $location_level;
                }
            }
            if (!${"location_" . $location_level . "_enabled"} && $flag_disable_location) {
                $sql = "SELECT count(id) AS total FROM Event WHERE location_" . $location_level . " > 0 ";
                $r = $db->query($sql);
                $row = mysql_fetch_assoc($r);
                if ($row['total']) {
                    $flag_disable_location = false;
                    $non_disable_found = 'EVENT';
                    $non_disable_level = $location_level;
                }
            }
            if (!${"location_" . $location_level . "_enabled"} && $flag_disable_location) {
                $sql = "SELECT count(id) AS total FROM Classified WHERE location_" . $location_level . " > 0 ";
                $r = $db->query($sql);
                $row = mysql_fetch_assoc($r);
                if ($row['total']) {
                    $flag_disable_location = false;
                    $non_disable_found = 'CLASSIFIED';
                    $non_disable_level = $location_level;
                }
            }
        }
        if (!$flag_disable_location) {
            $url_redirect .= "?error=true&message=5&level=" . $non_disable_level . "&non_disable_found=" . $non_disable_found;
            header("Location: $url_redirect");
            exit;
        } else {

            if (!($location_1_enabled . $location_2_enabled . $location_3_enabled . $location_4_enabled . $location_5_enabled)) {
                $url_redirect .= "?error=true&message=2";
                header("Location: $url_redirect");
                exit;
            } else {

                $enabled_locations = false;
                $non_enabled_locations = false;

                $show_locations = false;
                $dont_show_location = false;
                $blank_show_location = false;

                $location_names = false;
                $location_names_plural = false;

                $defalult_locations = false;
                $defalult_locations_id = false;
                $defalult_locations_show = false;
                $defalult_locations_name = false;

                foreach ($locations_info as $each_location_info) {
                    $location_level = $each_location_info["id"];
                    ${(${"location_" . $location_level . "_enabled"} ? "" : "non_") . "enabled_locations"}[] .= $location_level;
                    ${(${"default_L" . $location_level . "_show"} == 'y' ? "" : (${"default_L" . $location_level . "_show"} == 'n' ? "dont_" : "blank_")) . "show_locations"}[] .= $location_level;
                    if (${"location_" . $location_level . "_enabled"}) {
                        $location_names[] = $each_location_info["name"];
                        $location_names_plural[] = $each_location_info["name_plural"];
                    }
                    $all_locations[] = $location_level;
                    $all_location_names[] = $each_location_info["name"];
                    $all_location_names_plural[] = $each_location_info["name_plural"];

                    if (${"default_L" . $location_level . "_id"}) {

                        $defalult_locations[] = $location_level;
                        $defalult_locations_id[] = ${"default_L" . $location_level . "_id"};
                        $defalult_locations_show[] = ${"default_L" . $location_level . "_show"};
                        $defalult_locations_name[] = ${"default_L" . $location_level . "_name"};
                    }
                    $defaultID = ${"default_L" . $location_level . "_id"} ? ${"default_L" . $location_level . "_id"} : 0;
                    system_changeAtributeById("Setting_Location", "default_id", $location_level, $defaultID,
                        SELECTED_DOMAIN_ID);
                }

                $all_locations = implode(",", $all_locations);
                $all_location_names = implode(",", $all_location_names);
                $all_location_names_plural = implode(",", $all_location_names_plural);

                $enabled_locations = implode(",", $enabled_locations);
                $location_names = implode(",", $location_names);
                $location_names_plural = implode(",", $location_names_plural);

                system_changeAtributeById("Setting_Location", "enabled", $enabled_locations, "y", SELECTED_DOMAIN_ID);
                if ($non_enabled_locations) {
                    $non_enabled_locations = implode(",", $non_enabled_locations);
                    system_changeAtributeById("Setting_Location", "enabled", $non_enabled_locations, "n",
                        SELECTED_DOMAIN_ID);
                }

                if ($show_locations) {
                    $show_locations = implode(",", $show_locations);
                    system_changeAtributeById("Setting_Location", "Setting_Location.show", $show_locations, "y",
                        SELECTED_DOMAIN_ID);
                }

                if ($dont_show_locations) {
                    $dont_show_locations = implode(",", $dont_show_locations);
                    system_changeAtributeById("Setting_Location", "Setting_Location.show", $dont_show_locations, "n",
                        SELECTED_DOMAIN_ID);
                }

                if ($blank_show_locations) {
                    $blank_show_locations = implode(",", $blank_show_locations);
                    system_changeAtributeById("Setting_Location", "Setting_Location.show", $blank_show_locations, "b",
                        SELECTED_DOMAIN_ID);
                }

                if ($defalult_locations) {
                    $defalult_locations = implode(",", $defalult_locations);
                    $defalult_locations_id = implode(",", $defalult_locations_id);
                    $defalult_locations_show = implode(",", $defalult_locations_show);
                    $defalult_locations_name = implode(",", $defalult_locations_name);
                }

                $filePath = EDIRECTORY_ROOT . '/custom/domain_' . SELECTED_DOMAIN_ID . '/location/location.inc.php';

                if (!$file = fopen($filePath, 'w+')) {
                    $url_redirect .= "?error=true&message=3";
                    header("Location: $url_redirect");
                    exit;
                } else {

                    $buffer = "<?php" . PHP_EOL;

                    $buffer .= "\$edir_default_locations = \"";
                    $buffer .= ($defalult_locations ? $defalult_locations : '');
                    $buffer .= "\";" . PHP_EOL;
                    $buffer .= "\$edir_default_locationids = \"";
                    $buffer .= ($defalult_locations_id ? $defalult_locations_id : '');
                    $buffer .= "\";" . PHP_EOL;
                    $buffer .= "\$edir_default_locationnames = \"";
                    $buffer .= ($defalult_locations_name ? $defalult_locations_name : '');
                    $buffer .= "\";" . PHP_EOL;
                    $buffer .= "\$edir_default_locationshow = \"";
                    $buffer .= ($defalult_locations_show ? $defalult_locations_show : '');
                    $buffer .= "\";" . PHP_EOL . PHP_EOL;

                    $buffer .= "\$edir_locations = \"";
                    $buffer .= $enabled_locations;
                    $buffer .= "\";" . PHP_EOL;
                    $buffer .= "\$edir_locationnames = \"";
                    $buffer .= $location_names;
                    $buffer .= "\";" . PHP_EOL;
                    $buffer .= "\$edir_locationnames_plural = \"";
                    $buffer .= $location_names_plural;
                    $buffer .= "\";" . PHP_EOL . PHP_EOL;

                    $buffer .= "\$edir_all_locations = \"";
                    $buffer .= $all_locations;
                    $buffer .= "\";" . PHP_EOL;
                    $buffer .= "\$edir_all_locationnames = \"";
                    $buffer .= $all_location_names;
                    $buffer .= "\";" . PHP_EOL;
                    $buffer .= "\$edir_all_locationnames_plural = \"";
                    $buffer .= $all_location_names_plural;
                    $buffer .= "\";" . PHP_EOL . PHP_EOL;

                    $return_flag = fwrite($file, $buffer, strlen($buffer));

                    fclose($file);

                    /* Updates elasticsearch index in order to propagate changes to levels */
                    SymfonyCore::rebuildElasticsearchLocations();

                    //Save featured option
                    if (!setting_set("explorelocations_level", $_POST["radio_browse"])) {
                        if (!setting_new("explorelocations_level", $_POST["radio_browse"])) {
                            $error = true;
                        }
                    }

                    $url_redirect .= "?message=1";

                    header("Location: $url_redirect");
                    exit;
                }
            }

        }
    }
}

if ($message) {

    $message_style = ($error ? "warning" : "success");
    if ($message == 1) {
        $message = system_showText(LANG_SITEMGR_LOCATION_CONFIGURATION_SUCCESSFULLYCHANGED);
    } elseif ($message == 2) {
        $message = system_showText(LANG_SITEMGR_LOCATION_MUSTCHOOSELOCATION);
    } elseif ($message == 3) {
        $message = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
    } elseif ($message == 4) {
        $message = system_showText(LANG_SITEMGR_LOCATION_YOUCANTSETDEFAULT1) . ' ' . $location_name . ' ' . system_showText(LANG_SITEMGR_LOCATION_YOUCANTSETDEFAULT2) . ' ' . constant("LANG_SITEMGR_" . $non_default_found . "_PLURAL") . ' ' . system_showText(constant("LANG_SITEMGR_LOCATION_YOUCANTSETDEFAULT3" . (($level == '4' || $level == '2') ? 'a' : ''))) . ' ' . string_strtolower(constant("LANG_SITEMGR_NAVBAR_" . constant("LOCATION" . $level . "_SYSTEM_PLURAL"))) . '.';
    } elseif ($message == 5) {
        $message = system_showText(LANG_SITEMGR_LOCATION_YOUCANTDISABLE1) . ' ' . constant("LANG_SITEMGR_LABEL_" . constant("LOCATION" . $level . "_SYSTEM")) . ' ' . system_showText(LANG_SITEMGR_LOCATION_YOUCANTDISABLE2) . ' ' . constant("LANG_SITEMGR_" . $non_disable_found . "_PLURAL") . ' ' . system_showText(LANG_SITEMGR_LOCATION_YOUCANTDISABLE3) . '.';
    } elseif ($message == 6) {
        $message = system_showText(LANG_SITEMGR_DATETIME_CHANGED);
    } elseif ($message == 7) {
        $message = system_showText(LANG_SITEMGR_DATETIME_FAILURE_CHANGED);
    } elseif ($message == 8) {
        $message = system_showText(LANG_SITEMGR_GOOGLEGEOCODING_ERROR_KEY);
    } elseif ($message == 9) {
        $message = system_showText(LANG_SITEMGR_NEARBY_RADIUS_ERROR);
    }

}

/* Gets datetime values */
setting_get('date_format', $date_format);
setting_get('clock_type', $clock_type);

if ($date_format == '') {
    $date_format = DEFAULT_DATE_FORMAT;
}

if ($clock_type == '') {
    $clock_type = CLOCK_TYPE;
}

/* Gets google geolocation key */
$google_geocoding_status = $googleSettings->geoLocationStatus;
$google_geocoding_key = $googleSettings->geoLocationKey;

setting_get("nearby_feature_enabled", $nearby_feature_enabled);
setting_get("nearby_default_radius", $nearby_default_radius);

if ($_POST["explorelocations_level"]) {
    $explorelocations_level = $_POST["explorelocations_level"];
} else {
    setting_get("explorelocations_level", $explorelocations_level);
}

$locations_info = db_getFromDB("settinglocation", false, false, false, "id", "array", SELECTED_DOMAIN_ID);

foreach ($locations_info as $each_location_info) {
    $location_level = $each_location_info["id"];
    ${"location_" . $location_level . "_checked"} = ($each_location_info["enabled"] == "y" ? "checked" : "");

}

$non_activatable_locations = system_retrieveNonActivableLocations(SELECTED_DOMAIN_ID);

//Timezone
$zones = timezone_identifiers_list();
$timeZone = ini_get("date.timezone");
if (!$timeZone) {
    $timeZone = "Default Time Zone";
}
array_unshift($zones, "Default Time Zone");
$timeZoneDropdown = html_selectBox("opt_timezone", $zones, $zones, $timeZone, "", "form-control");
