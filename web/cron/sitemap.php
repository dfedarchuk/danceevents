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
# * FILE: /cron/sitemap.php
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
include_once(EDIRECTORY_ROOT . "/conf/config.inc.php");
include_once(EDIRECTORY_ROOT . "/functions/log_funct.php");

////////////////////////////////////////////////////////////////////////////////////////////////////
function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());

    return ((float)$usec + (float)$sec);
}

$time_start = getmicrotime();
////////////////////////////////////////////////////////////////////////////////////////////////////

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


////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlDomain = "	SELECT
						D.`id`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					WHERE CC.`running` = 'N'
					AND CC.`type` = 'sitemap'
					AND D.`status` = 'A'
					AND (ADDDATE(CC.`last_run_date`, INTERVAL 1 DAY) <= NOW() OR CC.`last_run_date` = '0000-00-00 00:00:00')
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

$resDomain = mysql_query($sqlDomain, $link);

if (mysql_num_rows($resDomain) > 0) {
    $rowDomain = mysql_fetch_assoc($resDomain);
    define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'sitemap'";
    mysql_query($sqlUpdate, $link);

    $messageLog = "Starting cron";
    log_addCronRecord($link, "sitemap", $messageLog, false, $cron_log_id);
} else {
    exit;
}
////////////////////////////////////////////////////////////////////////////////////////////////////

$_inCron = false;
include_once(EDIRECTORY_ROOT . "/conf/loadconfig.inc.php");
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
include_once(FUNCTIONS_DIR . "/sitemap_funct.php");
include_once(FUNCTIONS_DIR . "/sitemapgen_funct.php");
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
sitemapgen_makeSitemap(EDIRECTORY_ROOT);
sitemapgen_makeSitemapNews(EDIRECTORY_ROOT);
////////////////////////////////////////////////////////////////////////////////////////////////////

$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'sitemap'";
mysql_query($sqlUpdate, $link);

////////////////////////////////////////////////////////////////////////////////////////////////////
$time_end = getmicrotime();
$time = $time_end - $time_start;
print "Sitemap Generator on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - " . round($time,
        2) . " seconds.\n";
if (!setting_set("last_datetime_sitemap", date("Y-m-d H:i:s"))) {
    if (!setting_new("last_datetime_sitemap", date("Y-m-d H:i:s"))) {
        print "last_datetime_sitemap error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
        $messageLog = "Database error - LINE: " . __LINE__;
        log_addCronRecord($link, "sitemap", $messageLog, true, $cron_log_id);
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////

$messageLog = "Cron finished";
log_addCronRecord($link, "sitemap", $messageLog, true, $cron_log_id, true, round($time, 2));
