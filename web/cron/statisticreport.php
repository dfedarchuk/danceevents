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

# --------------------------------------------------------------------------------------------------
# * FILE: cron/statisticreport.php
# --------------------------------------------------------------------------------------------------

function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());

    return ((float)$usec + (float)$sec);
}

if (!isset($_GET['refresh'])) {

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ini_set("html_errors", false);
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $path = "";
    $full_name = "";
    $file_name = "";
    $full_name = $_SERVER["SCRIPT_FILENAME"];
    if (strlen($full_name) > 0) {
        $osslash = ((strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '\\' : '/');
        $file_pos = strpos($full_name, $osslash . "cron" . $osslash);
        if ($file_pos !== false) {
            $file_name = substr($full_name, $file_pos);
        }
        $path = substr($full_name, 0, (strlen($file_name) * (-1)));
    }
    if (strlen($path) == 0) {
        $path = "..";
    }
    define("EDIRECTORY_ROOT", $path);
    define("BIN_PATH", EDIRECTORY_ROOT . "/bin");
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $_inCron = true;
    include_once(EDIRECTORY_ROOT . "/conf/config.inc.php");
    include_once(EDIRECTORY_ROOT . "/functions/log_funct.php");

    ////////////////////////////////////////////////////////////////////////////////////////////////////

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
						AND CC.`type` = 'statisticreport'
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

        $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'statisticreport'";
        mysql_query($sqlUpdate, $link);
        $messageLog = "Starting cron";
        log_addCronRecord($link, "statisticreport", $messageLog, false, $cron_log_id);

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

    $_inCron = true;
}

if (!$_inCron) {
    ////////////////////////////////////////////////////////////////////////////////////////////////////
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
    mysql_select_db($db);
    ////////////////////////////////////////////////////////////////////////////////////////////////////
}

# --------------------------------------------------------------------------------------------------
# getting the start date and time
# --------------------------------------------------------------------------------------------------
$cron_startdate = date('Y-m-d H:i:s');

# --------------------------------------------------------------------------------------------------
# top Keywords
# --------------------------------------------------------------------------------------------------
$messageLog = "Top Keywords - LINE: " . __LINE__;
log_addCronRecord($link, "statisticreport", $messageLog, true, $cron_log_id);
$sql = "SELECT DATE(search_date) AS day, keyword, module, count(keyword) AS quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND keyword <> '' GROUP BY keyword, module ORDER BY search_date ASC, module ASC, quantity DESC, keyword ASC";
$results = mysql_query($sql, $linkDomain) or die(mysql_error());

while ($row = mysql_fetch_array($results)) {
    $sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+" . db_formatNumber($row['quantity']) . ") WHERE `day` = " . db_formatString($row['day']) . " AND `module` = " . db_formatString($row['module']) . " AND `key` = 'keywords' AND `value` = " . db_formatString($row['keyword']) . " LIMIT 1";
    mysql_query($sql, $linkDomain);
    if (!mysql_affected_rows($linkDomain)) {
        $sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (" . db_formatString($row['day']) . "," . db_formatString($row['module']) . ",'keywords'," . db_formatString($row['keyword']) . "," . db_formatNumber($row['quantity']) . ")";
        mysql_query($sql, $linkDomain);
    }
}

# --------------------------------------------------------------------------------------------------
# top Where
# --------------------------------------------------------------------------------------------------
$messageLog = "Top Where - LINE: " . __LINE__;
log_addCronRecord($link, "statisticreport", $messageLog, true, $cron_log_id);
$sql = "SELECT DATE(search_date) AS day, search_where, module, count(search_where) AS quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND search_where <> '' GROUP BY search_where, module ORDER BY search_date ASC, module ASC, quantity DESC, search_where ASC";
$results = mysql_query($sql, $linkDomain) or die(mysql_error());

while ($row = mysql_fetch_array($results)) {
    $sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+" . db_formatNumber($row['quantity']) . ") WHERE `day` = " . db_formatString($row['day']) . " AND `module` = " . db_formatString($row['module']) . " AND `key` = 'where' AND `value` = " . db_formatString($row['search_where']) . " LIMIT 1";
    mysql_query($sql, $linkDomain);
    if (!mysql_affected_rows($linkDomain)) {
        $sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (" . db_formatString($row['day']) . "," . db_formatString($row['module']) . ",'where'," . db_formatString($row['search_where']) . ", " . db_formatNumber($row['quantity']) . ")";
        mysql_query($sql, $linkDomain);
    }
}

# ----------------------------------------------------------------------------------------------------
# top Category
# ----------------------------------------------------------------------------------------------------
$messageLog = "Top Category - LINE: " . __LINE__;
log_addCronRecord($link, "statisticreport", $messageLog, true, $cron_log_id);
$sql = "SELECT DATE(search_date) AS day, category_id, module, count(category_id) AS quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND category_id > 0 GROUP BY category_id, module ORDER BY search_date ASC, category_id ASC, module ASC";
$results = mysql_query($sql, $linkDomain) or die(mysql_error());

$listingCategory = new ListingCategory();
$eventCategory = new EventCategory();
$classifiedCategory = new ClassifiedCategory();
$articleCategory = new ArticleCategory();
$blogCategory = new BlogCategory();

while ($row = mysql_fetch_array($results)) {

    if ($row['module'] == 'l') {
        $listingCategory->setNumber('id', $row['category_id']);
        $categoriesArray = $listingCategory->getFullPath();
    }

    if ($row['module'] == 'e') {
        $eventCategory->setNumber('id', $row['category_id']);
        $categoriesArray = $eventCategory->getFullPath();
    }

    if ($row['module'] == 'c') {
        $classifiedCategory->setNumber('id', $row['category_id']);
        $categoriesArray = $classifiedCategory->getFullPath();
    }

    if ($row['module'] == 'a') {
        $articleCategory->setNumber('id', $row['category_id']);
        $categoriesArray = $articleCategory->getFullPath();
    }

    if ($row['module'] == 'p') {
        $blogCategory->setNumber('id', $row['category_id']);
        $categoriesArray = $blogCategory->getFullPath();
    }

    if ($row['module'] == 'd') {
        $listingCategory->setNumber('id', $row['category_id']);
        $categoriesArray = $listingCategory->getFullPath();
    }

    $categoryPath = [];
    $categoriesArray = (array)$categoriesArray;

    if (is_array($categoriesArray)) foreach ($categoriesArray as $eachCategory) {
        $categoryPath[] = $eachCategory['title'];
    }
    $categoryTitle = implode(" >> ", $categoryPath);

    if (string_strlen(trim($categoryTitle))) {
        $sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+" . db_formatNumber($row['quantity']) . ") WHERE `day` = " . db_formatString($row['day']) . " AND `module` = " . db_formatString($row['module']) . " AND `key` = 'categories' AND `value` = " . db_formatString($categoryTitle) . " LIMIT 1";
        mysql_query($sql, $linkDomain);
        if (!mysql_affected_rows($linkDomain)) {
            $sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (" . db_formatString($row['day']) . "," . db_formatString($row['module']) . ",'categories'," . db_formatString($categoryTitle) . ", " . db_formatNumber($row['quantity']) . ")";
            mysql_query($sql, $linkDomain);
        }
    }

}

unset($listingCategory);
unset($eventCategory);
unset($classifiedCategory);
unset($articleCategory);

# ----------------------------------------------------------------------------------------------------
# top Locations
# ----------------------------------------------------------------------------------------------------
$messageLog = "Top Locations - LINE: " . __LINE__;
log_addCronRecord($link, "statisticreport", $messageLog, true, $cron_log_id);
$_locations = explode(",", EDIR_LOCATIONS);

$location_coluns_array = "";
foreach ($_locations as $_location_level) {
    $objLocationLabel = "Location" . $_location_level;
    ${"Location" . $_location_level} = new $objLocationLabel;
    $location_coluns_array[] = "location_" . $_location_level;
}
$location_coluns = implode(", ", $location_coluns_array);

$sql = "SELECT DATE(search_date) AS day, " . $location_coluns . ", module, count(" . $location_coluns_array[0] . ") as quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND " . $location_coluns_array[0] . " > 0 GROUP BY " . $location_coluns . ", module ORDER BY search_date ASC";

$results = mysql_query($sql, $linkDomain) or die(mysql_error());

while ($row = mysql_fetch_array($results)) {

    $locationPath = [];

    foreach ($_locations as $_location_level) {
        if ($row['location_' . $_location_level] > 0) {
            ${"Location" . $_location_level}->setNumber('id', $row['location_' . $_location_level]);
            $getLocation = ${"Location" . $_location_level}->retrieveLocationById();
            $locationPath[] = $getLocation['name'];
        }
    }

    if (!in_array(null, $locationPath, true)) {

        $location = implode(" >> ", $locationPath);

        if (string_strlen(trim($location))) {
            $sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+" . db_formatNumber($row['quantity']) . ") WHERE `day` = " . db_formatString($row['day']) . " AND `module` = " . db_formatString($row['module']) . " AND `key` = 'locations' AND `value` = " . db_formatString($location) . " LIMIT 1";
            mysql_query($sql, $linkDomain);
            if (!mysql_affected_rows($linkDomain)) {
                $sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (" . db_formatString($row['day']) . "," . db_formatString($row['module']) . ",'locations'," . db_formatString($location) . ", " . db_formatNumber($row['quantity']) . ")";
                mysql_query($sql, $linkDomain);
            }
        }
    }
}

foreach ($_locations as $_location_level) {
    unset (${"Location" . $_location_level});
}

# ----------------------------------------------------------------------------------------------------
# clear old data
# ----------------------------------------------------------------------------------------------------
$messageLog = "Clear Old Data - LINE: " . __LINE__;
log_addCronRecord($link, "statisticreport", $messageLog, true, $cron_log_id);
$sql = "DELETE FROM `Report_Statistic` WHERE `search_date` <= NOW()";
mysql_query($sql, $linkDomain) or die(mysql_error());

$sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'statisticreport'";
mysql_query($sqlUpdate, $link);

////////////////////////////////////////////////////////////////////////////////////////////////////
$time_end = getmicrotime();
$time = $time_end - $time_start;
if (!$_GET['refresh']) {
    print "Process Statistic on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - " . round($time,
            2) . " seconds.\n";
} else {
    print date("Y-m-d H:i:s") . " - " . round($time, 2);
}
if (!setting_set("last_datetime_statisticreport", date("Y-m-d H:i:s"))) {
    if (!setting_new("last_datetime_statisticreport", date("Y-m-d H:i:s"))) {
        print "last_datetime_statisticreport error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
        $messageLog = "Database error - LINE: " . __LINE__;
        log_addCronRecord($link, "statisticreport", $messageLog, true, $cron_log_id);
    }
}
$messageLog = "Cron finished";
log_addCronRecord($link, "statisticreport", $messageLog, true, $cron_log_id, true, round($time, 2));
////////////////////////////////////////////////////////////////////////////////////////////////////
