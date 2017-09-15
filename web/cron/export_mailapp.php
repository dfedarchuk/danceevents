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
# * FILE: /cron/export_mailapp.php
# ----------------------------------------------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////////////
ini_set("html_errors", false);
////////////////////////////////////////////////////////////////////////////////////////////////////
define("EXPORT_MAIL_BLOCK", 50000);

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
						Domain.`id`,
                        Control_Export_MailApp.`last_exportlog`,
                        Control_Export_MailApp.`domain_id`
					FROM `Domain` AS Domain
                        LEFT OUTER JOIN `Control_Export_MailApp` AS Control_Export_MailApp ON (Control_Export_MailApp.`domain_id` = Domain.`id`)
					WHERE Control_Export_MailApp.`scheduled` = 'Y' AND
                          Control_Export_MailApp.`running` = 'N' AND
                          Domain.`status` = 'A'
					ORDER BY
						IF (Control_Export_MailApp.`last_run_date` IS NULL, 0, 1),
						Control_Export_MailApp.`last_run_date`,
						Domain.`id`
					LIMIT 1";
$resDomain = mysql_query($sqlDomain, $link);

$sqlRunning = "SELECT `domain_id` FROM `Control_Export_MailApp` WHERE `running` = 'Y' LIMIT 1";
$resRunning = mysql_query($sqlRunning, $link);

if (mysql_num_rows($resDomain) > 0 && mysql_num_rows($resRunning) == 0) {
    $rowDomain = mysql_fetch_assoc($resDomain);
    define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

    $sqlUpdate = "UPDATE `Control_Export_MailApp` SET `scheduled` = 'N', `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = " . $rowDomain["id"];
    mysql_query($sqlUpdate, $link);
    $messageLog = "Starting cron";
    log_addCronRecord($link, "export_mailapp", $messageLog, false, $cron_log_id);

    $last_export_log = $rowDomain["last_exportlog"];

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

$mailAppObj = new MailAppList();
$mailAppObj->exportList(SELECTED_DOMAIN_ID, $last_export_log);

$time_end = getmicrotime();
$time = $time_end - $time_start;

print "Export MailApp on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - " . round($time,
        2) . " seconds.\n";
$messageLog = "Cron finished";
log_addCronRecord($link, "export_mailapp", $messageLog, true, $cron_log_id, true, round($time, 2));
