#!/usr/bin/php -q
<?php
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
# * FILE: /cron/export_listings.php
# ----------------------------------------------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////////////
ini_set("html_errors", false);
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
define("EDIRECTORY_ROOT", __DIR__ . "/..");
define("BIN_PATH", EDIRECTORY_ROOT . "/bin");
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
$_inCron = true;
$loadSitemgrLangs = true;
include_once(EDIRECTORY_ROOT . "/conf/config.inc.php");
include_once(EDIRECTORY_ROOT . "/functions/log_funct.php");


////////////////////////////////////////////////////////////////////////////////////////////////////
$host = _DIRECTORYDB_HOST;
$db = _DIRECTORYDB_NAME;
$user = _DIRECTORYDB_USER;
$pass = _DIRECTORYDB_PASS;
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
$link = mysql_connect($host, $user, $pass);
mysql_query("SET NAMES 'utf8'", $link);
mysql_query('SET character_set_connection=utf8', $link);
mysql_query('SET character_set_client=utf8', $link);
mysql_query('SET character_set_results=utf8', $link);
mysql_select_db($db);
////////////////////////////////////////////////////////////////////////////////////////////////////

$sql_check_export = "SELECT
							D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, CEL.`id`, CEL.`type`, CEL.`filename`, CEL.`domain_id`, CEL.`block`, CEL.`total_listing_exported`
						FROM `Domain` AS D
						LEFT JOIN `Control_Export_Listing` AS CEL ON (CEL.`domain_id` = D.`id`)
						WHERE CEL.`scheduled` = 'Y'
						AND D.`status` = 'A'
						ORDER BY
							IF (CEL.`last_run_date` IS NULL, 0, 1),
							CEL.`last_run_date`,
							D.`id`
						LIMIT 1";

$result_check_export = mysql_query($sql_check_export, $link);
if (mysql_num_rows($result_check_export)) {
    $row = mysql_fetch_array($result_check_export);
    $type = $row["type"];
    $filename = $row["filename"];
    $domain_id = $row["domain_id"];

    $db_host = $row["database_host"] . ($row["database_port"] ? $row["database_port"] : "");
    $db_username = $row["database_username"];
    $db_password = $row["database_password"];
    $db_name = $row["database_name"];

    $linkDomain = mysql_connect($db_host, $db_username, $db_password, true);
    mysql_query("SET NAMES 'utf8'", $linkDomain);
    mysql_query('SET character_set_connection=utf8', $linkDomain);
    mysql_query('SET character_set_client=utf8', $linkDomain);
    mysql_query('SET character_set_results=utf8', $linkDomain);
    mysql_select_db($db_name);

    $limit = $row["block"];
    $start = $row["total_listing_exported"];
    $end = $limit;

    $exportFilePath = EDIRECTORY_ROOT . "/custom/domain_$domain_id/export_files";

    define("SELECTED_DOMAIN_ID", $domain_id);

    $messageLog = "Starting cron";
    log_addCronRecord($link, "export_listings", $messageLog, false, $cron_log_id);

    $files = glob($exportFilePath . "/export_*.progress");
    if ($files[0] && is_array($files)) {
        foreach ($files as $file) {
            if (strrpos($file, "export_" . str_replace(".zip", ".progress", $filename)) === false) {
                if (unlink($file)) {
                    $messageLog = "Remove .progress file $file. - LINE: " . __LINE__;
                    log_addCronRecord($link, "export_listings", $messageLog, true, $cron_log_id);
                } else {
                    $messageLog = "Unable to unlink .progress file $file. Check permissions. - LINE: " . __LINE__;
                    log_addCronRecord($link, "export_listings", $messageLog, true, $cron_log_id);
                }
            }
        }
    }

} else {
    exit;
}

$_inCron = false;
include_once(EDIRECTORY_ROOT . "/conf/loadconfig.inc.php");
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());

    return ((float)$usec + (float)$sec);
}

$time_start = getmicrotime();
////////////////////////////////////////////////////////////////////////////////////////////////////

if ($type == "csv") {
    export_ExportToCSV("listing", false, false, $domain_id);
} else {
    if ($type == "csv - data") {
        $sqlCListing = "SELECT COUNT(`id`) AS `total` FROM `Listing`";
        $resCListing = mysql_query($sqlCListing, $linkDomain);
        $rowCListing = mysql_fetch_assoc($resCListing);
        $count = $rowCListing["total"];

        if ($start >= $count) {
            print "Export Listings on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - " . round($time,
                    2) . " seconds.\n";
            $messageLog = "Cron finished";
            exit;
        }

        $request["domain_id"] = $domain_id;
        $request["item_type"] = "Listing";
        $request["fields_excluded"] = "image_id, thumb_id, discount_id, video_snippet, custom_checkbox0, custom_checkbox1, custom_checkbox2, custom_checkbox3, custom_checkbox4, custom_checkbox5, custom_checkbox6, custom_checkbox7, custom_checkbox8, custom_checkbox9, custom_dropdown0, custom_dropdown1, custom_dropdown2, custom_dropdown3, custom_dropdown4, custom_dropdown5, custom_dropdown6, custom_dropdown7, custom_dropdown8, custom_dropdown9, custom_text0, custom_text1, custom_text2, custom_text3, custom_text4, custom_text5, custom_text6, custom_text7, custom_text8, custom_text9, custom_short_desc0, custom_short_desc1, custom_short_desc2, custom_short_desc3, custom_short_desc4, custom_short_desc5, custom_short_desc6, custom_short_desc7, custom_short_desc8, custom_short_desc9, custom_long_desc0, custom_long_desc1, custom_long_desc2, custom_long_desc3, custom_long_desc4, custom_long_desc5, custom_long_desc6, custom_long_desc7, custom_long_desc8, custom_long_desc9, listingtemplate_id, importID";
        $request["path"] = $exportFilePath;
        $request["export_from"] = "cron";
        $request["zip_filename"] = $filename;

        $block = round($count / $limit, 1);
        if ($block < 1) {
            $block = 1;
        }

        if ($start) {
            $step = round($start / $limit);
        } else {
            $step = 0;
        }

        $request["item_current"] = $start;
        $request["item_limit"] = $limit;
        $request["item_start"] = $start;
        $request["item_end"] = $end;
        $request["item_count"] = $count;
        $request["item_block"] = $block;
        $request["item_step"] = $step;
        $request["file_extension"] = "csv";

        $exportObj = new Export($request);
        $exportObj->execute();
    }
}

$time_end = getmicrotime();
$time = $time_end - $time_start;
print "Export Listings on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - " . round($time,
        2) . " seconds.\n";
$messageLog = "Cron finished";
log_addCronRecord($link, "export_listings", $messageLog, true, $cron_log_id, true, round($time, 2));
