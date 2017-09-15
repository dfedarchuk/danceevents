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
# * FILE: /cron/rollback_import.php
# ----------------------------------------------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////////////
ini_set("html_errors", false);
////////////////////////////////////////////////////////////////////////////////////////////////////
define("EDIRECTORY_ROOT", __DIR__ . "/..");
define("BIN_PATH", EDIRECTORY_ROOT . "/bin");
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
$_inCron = true;
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

function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());

    return ((float)$usec + (float)$sec);
}

$time_start = getmicrotime();

////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlDomain = "	SELECT
                            D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
                        FROM `Domain` AS D
                        LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
                        LEFT JOIN `Control_Import_Listing` AS CIL ON (CIL.`domain_id` = D.`id`)
                        WHERE CC.`running` = 'N'
                        AND CC.`type` = 'rollback_import'
                        AND CIL.`running` = 'N'
                        AND D.`status` = 'A'
                        ORDER BY
                            IF (CC.`last_run_date` IS NULL, 0, 1),
                            CC.`last_run_date`,
                            D.`id`
                        LIMIT 1";

$resDomain = mysql_query($sqlDomain, $link);

if (mysql_num_rows($resDomain) > 0) {
    $rowDomain = mysql_fetch_assoc($resDomain);
    define("SELECTED_DOMAIN_ID", $rowDomain["id"]);
    $messageLog = "Starting cron";
    log_addCronRecord($link, "rollback_import", $messageLog, false, $cron_log_id);
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $domainHost = $rowDomain["database_host"] . ($rowDomain["database_port"] ? ":" . $rowDomain["database_port"] : "");
    $domainUser = $rowDomain["database_username"];
    $domainPass = $rowDomain["database_password"];
    $domainDBName = $rowDomain["database_name"];
    $domainURL = $rowDomain["url"];

    $link_domain = mysql_connect($domainHost, $domainUser, $domainPass, true);
    mysql_query("SET NAMES 'utf8'", $link_domain);
    mysql_query('SET character_set_connection=utf8', $link_domain);
    mysql_query('SET character_set_client=utf8', $link_domain);
    mysql_query('SET character_set_results=utf8', $link_domain);
    mysql_select_db($domainDBName);
    ////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
    exit;
}
////////////////////////////////////////////////////////////////////////////////////////////////////

$_inCron = false;
include_once(EDIRECTORY_ROOT . "/conf/loadconfig.inc.php");
////////////////////////////////////////////////////////////////////////////////////////////////////

$sqlIL = "SELECT `id` FROM `ImportLog` WHERE (`status` = 'F' OR `status` = 'S') AND `action` = 'NR' AND `type` = 'listing' ORDER BY `date` AND `time`";
$resIL = mysql_query($sqlIL, $link_domain);
if (mysql_num_rows($resIL) > 0) {
    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'rollback_import'";
    mysql_query($sqlUpdate, $link);

    $rowIL = mysql_fetch_assoc($resIL);
    $importID = $rowIL["id"];

    $import = new ImportLog($importID);

    $sqlLog = "SELECT COUNT(id) AS total FROM `ImportLog` WHERE `status` = 'P' AND `type` = 'listing'";
    $resLog = mysql_query($sqlLog, $link_domain);
    $rowLog = mysql_fetch_assoc($resLog);
    if ($rowLog["total"] > 0) {
        $sqlCron = "UPDATE `Control_Import_Listing` SET `scheduled` = 'Y', `running` = 'N' WHERE `domain_id` = " . SELECTED_DOMAIN_ID;
    } else {
        $sqlCron = "UPDATE `Control_Import_Listing` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = " . SELECTED_DOMAIN_ID;
    }
    mysql_query($sqlCron, $link);

    $import->setHistory("LANG_SITEMGR_IMPORT_PROCCESSCANCELLED");

    $messageLog = "Select Listings - LINE: " . __LINE__;
    log_addCronRecord($link, "rollback_import", $messageLog, true, $cron_log_id);
    $num_listings = 0;
    $sql = "SELECT id FROM Listing WHERE importID = " . db_formatNumber($importID);
    $result = mysql_query($sql, $link_domain);

    if ($result) {
        $messageLog = "Delete Listings - LINE: " . __LINE__;
        log_addCronRecord($link, "rollback_import", $messageLog, true, $cron_log_id);
        while ($row = mysql_fetch_assoc($result)) {
            $listingObj = new Listing($row["id"]);
            if ($listingObj->getNumber("id") > 0) {
                $listingObj->Delete(SELECTED_DOMAIN_ID, false);
                $num_listings++;
            }
        }
    }

    $import->setHistory($num_listings . "[" . (($num_listings != 1) ? "LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL" : "LANG_MSG_IMPORT_ITEM_ROLLEDBACK") . "].");

    $messageLog = "Select Accounts - LINE: " . __LINE__;
    log_addCronRecord($link, "rollback_import", $messageLog, true, $cron_log_id);
    $num_accounts = 0;
    $sql = "SELECT id FROM Account WHERE importID = " . db_formatNumber($import->getNumber("id")) . " AND domain_importID = " . db_formatNumber(SELECTED_DOMAIN_ID);
    $result = mysql_query($sql, $link);

    if ($result) {
        $messageLog = "Delete Accounts - LINE: " . __LINE__;
        log_addCronRecord($link, "rollback_import", $messageLog, true, $cron_log_id);
        while ($row = mysql_fetch_assoc($result)) {
            $accountObj = new Account($row["id"]);
            if ($accountObj->getNumber("id") > 0) {
                $accountObj->Delete();
                $num_accounts++;
            }
        }
    }
    $import->setHistory($num_accounts . "[" . (($num_accounts != 1) ? "LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL" : "LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK") . "].");
    $import->setHistory("LANG_SITEMGR_IMPORT_ROLLBACKDONE");

    $import->setString("status", "C");
    $import->setString("action", "D");
    $import->save();

    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'rollback_import'";
    mysql_query($sqlUpdate, $link);
} else {
    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'rollback_import'";
    mysql_query($sqlUpdate, $link);
    $messageLog = "Cron finished";
    log_addCronRecord($link, "rollback_import", $messageLog, true, $cron_log_id, true, round($time, 2));
    exit;
}

////////////////////////////////////////////////////////////////////////////////////////////////////

$time_end = getmicrotime();
import_logDebug("End Date/Time: " . date("Y-m-d H:i:s"));
import_logDebug("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
$time = $time_end - $time_start;

print "Roll Back Process on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - Listings Rolled Back: " . $num_listings . " - Accounts Rolled Back: " . $num_accounts . "\n";

if (!setting_set("last_datetime_rollback_import", date("Y-m-d H:i:s"))) {
    if (!setting_new("last_datetime_rollback_import", date("Y-m-d H:i:s"))) {
        print "last_datetime_rollback_import error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
        $messageLog = "Database error - LINE: " . __LINE__;
        log_addCronRecord($link, "rollback_import", $messageLog, true, $cron_log_id);
    }
}
$messageLog = "Cron finished";
log_addCronRecord($link, "rollback_import", $messageLog, true, $cron_log_id, true, round($time, 2));
////////////////////////////////////////////////////////////////////////////////////////////////////
