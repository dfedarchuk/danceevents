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
# * FILE: /cron/email_traffic.php
# ----------------------------------------------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////////////
define("BLOCK", 1000);
////////////////////////////////////////////////////////////////////////////////////////////////////

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
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					WHERE CC.`running` = 'N'
					AND CC.`type` = 'email_traffic'
					AND D.`status` = 'A'
					AND (ADDDATE(CC.`last_run_date`, INTERVAL 20 MINUTE) <= NOW() OR CC.`last_run_date` = '0000-00-00 00:00:00')
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

$resDomain = mysql_query($sqlDomain, $link);

if (mysql_num_rows($resDomain) > 0) {
    $rowDomain = mysql_fetch_assoc($resDomain);
    define("SELECTED_DOMAIN_ID", $rowDomain["id"]);

    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'email_traffic'";
    mysql_query($sqlUpdate, $link);
    $messageLog = "Starting cron";
    log_addCronRecord($link, "email_traffic", $messageLog, false, $cron_log_id);

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $domainHost = $rowDomain["database_host"] . ($rowDomain["database_port"] ? ":" . $rowDomain["database_port"] : "");
    $domainUser = $rowDomain["database_username"];
    $domainPass = $rowDomain["database_password"];
    $domainDBName = $rowDomain["database_name"];
    $domainURL = $rowDomain["url"];

    $linkDomain = mysql_connect($domainHost, $domainUser, $domainPass, true);
    mysql_query("SET NAMES 'utf8'", $linkDomain);
    mysql_query('SET character_set_connection=utf8', $linkDomain);
    mysql_query('SET character_set_client=utf8', $linkDomain);
    mysql_query('SET character_set_results=utf8', $linkDomain);
    mysql_select_db($domainDBName);
    ////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
    exit;
}
////////////////////////////////////////////////////////////////////////////////////////////////////

$_inCron = false;
include_once(EDIRECTORY_ROOT . "/conf/loadconfig.inc.php");
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////

$url = $domainURL;
(SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? $url_protocol = "https://" : $url_protocol = "http://";
$default_url = $url_protocol . $url . (EDIRECTORY_FOLDER ? EDIRECTORY_FOLDER : "");
setting_get("sitemgr_email", $sitemgr_email);
setting_get("edir_default_language", $edir_default_language);
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
$last_listing_traffic = 0;
if (!setting_get("last_listing_traffic", $last_listing_traffic)) {
    if (!setting_set("last_listing_traffic", "0")) {
        if (!setting_new("last_listing_traffic", "0")) {
            print "Email Traffic - last_listing_traffic error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
            $messageLog = "Database error - LINE: " . __LINE__;
            log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);
        }
    }
}
if (!$last_listing_traffic) {
    $last_listing_traffic = 0;
}

unset($allNot);
$sqlNot = "SELECT * FROM Email_Notification WHERE deactivate = '0' AND id = " . SYSTEM_EMAIL_TRAFFIC;
$resultNot = mysql_query($sqlNot, $linkDomain);
if (mysql_num_rows($resultNot) > 0) {
    $messageLog = "Read Email Notification info - LINE: " . __LINE__;
    log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);
    while ($rowNot = mysql_fetch_assoc($resultNot)) {
        $allNot[$edir_default_language]["bcc"] = $rowNot["bcc"];
        $allNot[$edir_default_language]["content_type"] = $rowNot["content_type"];
        $allNot[$edir_default_language]["body"] = $rowNot["body"];
        $allNot[$edir_default_language]["subject"] = $rowNot["subject"];
    }
} else {
    $messageLog = "Email Notification disabled - LINE: " . __LINE__;
    log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);
}

if ($allNot && (count($allNot) > 0)) {
    $messageLog = "Select accounts to send email - LINE: " . __LINE__;
    log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);

    $allNotSQL = "(DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 30 DAY), '%Y%m%d') >= DATE_FORMAT(last_traffic_sent, '%Y%m%d'))";
    $sqlAccount = "SELECT id FROM Account WHERE notify_traffic_listing = 'y' AND is_sponsor = 'y'";
    $resultAccount = mysql_query($sqlAccount, $link);
    $idsAccount = "";
    if (mysql_num_rows($resultAccount) > 0) {
        while ($rowAcc = mysql_fetch_assoc($resultAccount)) {
            $idsAccount .= $rowAcc["id"] . ",";
        }
    }

    $idsAccount = string_substr($idsAccount, 0, -1);

    $listingLevelObj = new ListingLevel();
    $levelValue = $listingLevelObj->getValues();
    $idsLevels = "";

    foreach ($levelValue as $value) {
        setting_get("email_traffic_listing_" . $value, ${"email_traffic_listing_" . $value});
        if (${"email_traffic_listing_" . $value}) {
            $idsLevels .= $value . ",";
        }
    }

    $idsLevels = string_substr($idsLevels, 0, -1);

    if ($idsAccount && $idsLevels) {
        $sql = "" .
            " SELECT " .
            " id, " .
            " account_id " .
            " FROM " .
            " Listing " .
            " WHERE " .
            " account_id IN (" . $idsAccount . ") " .
            " AND " .
            " status = 'A' " .
            " AND " .
            " level IN (" . $idsLevels . ") " .
            " AND " . $allNotSQL .
            " ORDER BY " .
            " id " .
            " LIMIT " .
            $last_listing_traffic . ", " . BLOCK . "";
        $result = mysql_query($sql, $linkDomain);
        $num_rows = mysql_num_rows($result);
        if (mysql_num_rows($result) > 0) {
            $messageLog = "Send email to accounts - LINE: " . __LINE__;
            log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);
            while ($row = mysql_fetch_assoc($result)) {

                $contactObj = new Contact($row["account_id"]);

                if ($contactObj->getString("email")) {

                    $email_data["body"] = $allNot[$edir_default_language]["body"];
                    $email_data["subject"] = $allNot[$edir_default_language]["subject"];
                    $email_data["bcc"] = $allNot[$edir_default_language]["bcc"];
                    $email_data["content_type"] = $allNot[$edir_default_language]["content_type"];

                    $email_data["subject"] = str_replace("DEFAULT_URL", $default_url, $email_data["subject"]);
                    $email_data["body"] = str_replace("DEFAULT_URL", $default_url, $email_data["body"]);

                    if ($email_data["content_type"] == "text/plain") {
                        $email_data["body"] = nl2br($email_data["body"]);
                    }

                    $data_email = retrieveListingReport($row["id"]);
                    $table = report_PrepareListingStatsReviewToEmail($data_email, $row["id"], "listing",
                        $default_url);
                    $email_data["body"] = str_replace("[TABLE_STATS]", $table, $email_data["body"]);

                    $email_data["subject"] = system_replaceEmailVariables($email_data["subject"], $row["id"],
                        "listing");
                    $email_data["body"] = system_replaceEmailVariables($email_data["body"], $row["id"], "listing");

                    $to = $contactObj->getString("email");
                    $bcc = $email_data["bcc"];
                    $subject = $email_data["subject"];
                    $message = $email_data["body"];
                    $content_type = $email_data["content_type"];

                    if ($content_type == "text/plain") {
                        $style = "<html>
										<body>
											<div>";

                        $style2 = "		</div>
										</body>
										</html>";

                        $message = $style . $message . $style2;
                        $content_type = "text/html";
                    }

                    if ($table) {
                        Mailer::mail($to, $subject, $message, $content_type, null, $bcc);
                    }
                }

                $sql = "UPDATE Listing SET last_traffic_sent = NOW() WHERE id = " . $row["id"] . "";
                mysql_query($sql, $linkDomain);
            }
        }
    }
}

if ($num_rows < BLOCK) {
    if (!setting_set("last_listing_traffic", "0")) {
        print "Email Traffic - last_listing_traffic error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
        $messageLog = "Database error - LINE: " . __LINE__;
        log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);
    }
    $last_listing_traffic = 0;
} else {
    if (!setting_set("last_listing_traffic", ($last_listing_traffic + BLOCK))) {
        print "Email Traffic - last_listing_traffic error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
        $messageLog = "Database error - LINE: " . __LINE__;
        log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);
    }
    $last_listing_traffic = $last_listing_traffic + BLOCK;
}

$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'email_traffic'";
mysql_query($sqlUpdate, $link);

////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
$time_end = getmicrotime();
$time = $time_end - $time_start;
print "Email Traffic on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - " . round($time,
        2) . " seconds.\n";
if (!setting_set("last_datetime_listingtraffic", date("Y-m-d H:i:s"))) {
    if (!setting_new("last_datetime_listingtraffic", date("Y-m-d H:i:s"))) {
        print "last_datetime_listingtraffic error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
        $messageLog = "Database error - LINE: " . __LINE__;
        log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id);
    }
}
$messageLog = "Cron finished";
log_addCronRecord($link, "email_traffic", $messageLog, true, $cron_log_id, true, round($time, 2));
////////////////////////////////////////////////////////////////////////////////////////////////////
