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
# * FILE: /cron/prepare_import.php
# ----------------------------------------------------------------------------------------------------

function import_progress($filename, $message)
{
    if (!$handle = fopen($filename, "a")) {
        setting_get("sitemgr_email", $sitemgr_email);
        $eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Prepare Import Process",
            "Error: file open (" . $filename . ").", $sitemgr_email);
        $eDirMailerObj->send();
        exit;
    }
    if (fwrite($handle, $message) === false) {
        setting_get("sitemgr_email", $sitemgr_email);
        $eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Prepare Import Process",
            "Error: file write (" . $filename . ").", $sitemgr_email);
        $eDirMailerObj->send();
        exit;
    }
    if (!fclose($handle)) {
        setting_get("sitemgr_email", $sitemgr_email);
        $eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory] - Prepare Import Process",
            "Error: file close (" . $filename . ").", $sitemgr_email);
        $eDirMailerObj->send();
        exit;
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////
define("IMPORT_TIME_DEBUG", "off");
define("IMPORT_TIME_EMAIL_DEBUG", "off");
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
$host = _DIRECTORYDB_HOST;
$db = _DIRECTORYDB_NAME;
$user = _DIRECTORYDB_USER;
$pass = _DIRECTORYDB_PASS;
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
$link = @mysql_connect($host, $user, $pass);
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

$check_convert_time = 0;
$check_header_time = 0;
$generate_lot_time = 0;
$run_lot_time = 0;
$validate_line_time = 0;
$number_of_blocks = 0;

$checkRunningCron = false;

$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					LEFT JOIN `Control_Import_Listing` AS CIL ON (CIL.`domain_id` = D.`id`)
					WHERE CC.`running` = 'Y'
					AND CC.`type` = 'prepare_import'
					AND CIL.`running` = 'N'
					AND D.`status` = 'A'
					ORDER BY
						IF (CC.`last_run_date` IS NULL, 0, 1),
						CC.`last_run_date`,
						D.`id`
					LIMIT 1";

$resDomain = mysql_query($sqlDomain, $link);

if (mysql_num_rows($resDomain) > 0) {
    $checkRunningCron = true;
}
////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlDomain = "	SELECT
						D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
					FROM `Domain` AS D
					LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
					LEFT JOIN `Control_Import_Listing` AS CIL ON (CIL.`domain_id` = D.`id`)
					WHERE CC.`running` = 'N'
					AND CC.`type` = 'prepare_import'
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $domainHost = $rowDomain["database_host"] . ($rowDomain["database_port"] ? ":" . $rowDomain["database_port"] : "");
    $domainUser = $rowDomain["database_username"];
    $domainPass = $rowDomain["database_password"];
    $domainDBName = $rowDomain["database_name"];
    $domainURL = $rowDomain["url"];

    $link_domain = @mysql_connect($domainHost, $domainUser, $domainPass, true);
    mysql_query("SET NAMES 'utf8'", $link_domain);
    mysql_query('SET character_set_connection=utf8', $link_domain);
    mysql_query('SET character_set_client=utf8', $link_domain);
    mysql_query('SET character_set_results=utf8', $link_domain);
    mysql_select_db($domainDBName);
    ////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
    $checkRunningCron = true;
}

if ($checkRunningCron) {

    $messageLog = "Starting cron";
    log_addCronRecord($link, "prepare_import", $messageLog, false, $cron_log_id);

    $return = system("ps aux | grep prepare_import.php | grep -v grep | wc -l", $retval);
    if (($return <= 1) && (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN')) {

        $messageLog = "Restore flags - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        $filenameControl = EDIRECTORY_ROOT . "/custom/log/prepare_import_control_listing.progress";
        $filenameProgress = EDIRECTORY_ROOT . "/custom/log/prepare_import_listing.progress";

        if (file_exists($filenameControl)) {
            if ($handleControl = fopen($filenameControl, "r")) {
                $controlInfo = fgets($handleControl);
                fclose($handleControl);

                $controlInfoAux = explode("|", $controlInfo);
                $domain_id = $controlInfoAux[1];
                $importlog_id = $controlInfoAux[3];

                if (is_numeric($domain_id) && is_numeric($importlog_id)) {
                    $sqlDomain = "SELECT `database_host`, `database_port`, `database_username`, `database_password`, `database_name`, `url` FROM `Domain` WHERE `id` = $domain_id	LIMIT 1";
                    $resDomain = mysql_query($sqlDomain, $link);
                    if (mysql_num_rows($resDomain) > 0) {

                        $rowDomain = mysql_fetch_assoc($resDomain);
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

                        $sql = "UPDATE ImportLog SET `action` = 'NC' WHERE id = $importlog_id AND `action` = 'C' AND type = 'listing'";
                        mysql_query($sql, $link_domain);

                        $sql = "DELETE FROM ImportTemporary WHERE import_log_id = $importlog_id";
                        mysql_query($sql, $link_domain);

                        $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `type` = 'prepare_import'";
                        mysql_query($sqlUpdate, $link);

                        if (unlink($filenameControl)) {
                            $messageLog = "Remove control .progress file $filenameControl. - LINE: " . __LINE__;
                            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
                        } else {
                            $messageLog = "Unable to unlink control .progress file $filenameControl. Check permissions. - LINE: " . __LINE__;
                            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
                        }

                        if (unlink($filenameProgress)) {
                            $messageLog = "Remove .progress file $filenameProgress. - LINE: " . __LINE__;
                            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
                        } else {
                            $messageLog = "Unable to unlink .progress file $filenameProgress. Check permissions. - LINE: " . __LINE__;
                            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
                        }
                    }
                }
            }
        }
    }
    $messageLog = "Cron finished";
    $time_end = getmicrotime();
    $time = $time_end - $time_start;
    log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id, true, round($time, 2));
    exit;
}
////////////////////////////////////////////////////////////////////////////////////////////////////

$_inCron = false;
include_once(EDIRECTORY_ROOT . "/conf/loadconfig.inc.php");
////////////////////////////////////////////////////////////////////////////////////////////////////

$sqlIL = "SELECT * FROM `ImportLog` WHERE `status` = 'P' AND `action` = 'NC' AND type = 'listing' AND `mysqlerror` = '' ORDER BY `date` AND `time`";
$resIL = mysql_query($sqlIL, $link_domain);
if (mysql_num_rows($resIL) > 0) {
    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'prepare_import'";
    mysql_query($sqlUpdate, $link);

    $messageLog = "Starting cron";
    log_addCronRecord($link, "prepare_import", $messageLog, false, $cron_log_id);

    $rowIL = mysql_fetch_assoc($resIL);
    $importID = $rowIL["id"];

    $file = IMPORT_FOLDER . "/" . $rowIL["phisicalname"];
    $delimiter = import_detectDelimiter($file);

    $importlogObj = new ImportLog($rowIL);
    $importlogObj->setString("action", "C");
    $importlogObj->Save();

    /* Workaround eDirectory */
    if ($importlogObj->getString('account_id') == '') {
        unset($importlogObj);
        $importlogObj = new ImportLog($rowIL);
    }


    $check_convert_start = getmicrotime();
    $messageLog = "Check if need to convert csv file - LINE: " . __LINE__;
    log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
    if (function_exists("mb_detect_encoding") && function_exists("mb_convert_encoding")) {
        $handle = fopen($file, "r");
        $charsetContent = import_isUFT8(fgets($handle));
        while ($fileLine = fgetcsv($handle, 16384, $delimiter)) {
            foreach ($fileLine as $fileCol) {
                if (!import_isUFT8($fileCol) && !$charsetContent) {
                    $needToConvert = true;
                    break;
                }
            }
            if ($needToConvert) {
                $messageLog = "Need to convert csv file - LINE: " . __LINE__;
                log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
                break;
            }
        }
        fclose($handle);
    } else {
        $messageLog = "Do not need to convert csv file - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        $needToConvert = false;
    }
    $check_convert_end = getmicrotime();
    $check_convert_time += $check_convert_end - $check_convert_start;

    $check_header_start = getmicrotime();
    $handle = fopen(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/content/datacenter/edirectory_sample.csv", "r");
    $sample_header = fgets($handle);
    fclose($handle);
    $messageLog = "Open sample to validate header - LINE: " . __LINE__;
    log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
    if (file_exists($file)) {
        if (!$handle = fopen($file, "r")) {
            $import_stop = true;
        }
        $imported_header = fgets($handle);
        if (!fclose($handle)) {
            $import_stop = true;
        }
    } else {
        $import_stop = true;
    }
    $messageLog = "Validate header - LINE: " . __LINE__;
    log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
    if (!$import_stop) {
        $sample_header = explode(",", $sample_header);

        $imported_header = str_replace("\"", "", $imported_header);
        $imported_header = explode($delimiter, $imported_header);
        unset($wrong_imported_header);
        unset($wrong_header_fields);
        if (count($sample_header) < count($imported_header)) {
            $import_stop = true;
            $wrong_imported_header = true;
        }
        for ($i = 0; $i < count($sample_header); $i++) {
            $sample_header[$i] = str_replace("\n\r", "", $sample_header[$i]);
            $sample_header[$i] = str_replace("\r\n", "", $sample_header[$i]);
            $sample_header[$i] = str_replace("\n", "", $sample_header[$i]);
            $sample_header[$i] = str_replace("\r", "", $sample_header[$i]);
            $imported_header[$i] = str_replace("\n\r", "", $imported_header[$i]);
            $imported_header[$i] = str_replace("\r\n", "", $imported_header[$i]);
            $imported_header[$i] = str_replace("\n", "", $imported_header[$i]);
            $imported_header[$i] = str_replace("\r", "", $imported_header[$i]);

            if ($sample_header[$i] != $imported_header[$i]) {
                $import_stop = true;
                $wrong_header_fields[] = preg_replace('/[^0-9a-zA-Z ]/i', '', $sample_header[$i]);
            }
        }
    }
    $check_header_end = getmicrotime();
    $check_header_time += $check_header_end - $check_header_start;

    if (!$import_stop) {
        $remove_header_start = getmicrotime();
        $handle = fopen($file, "r");
        $file_header = fgetcsv($handle, 16384, $delimiter);
        $remove_header_end = getmicrotime();
        $remove_header_time += $remove_header_end - $remove_header_start;

        $totallines = 0;
        $file_line_number = 2;
        $lineNumber = 1;
        $sqlBlock = "";
        $sqlLine = "";
        $tempError = false;

        /*
         * GENERATE SQL LOT FILE
         */
        $sqlVar = "SHOW VARIABLES WHERE `Variable_Name` = 'bulk_insert_buffer_size'";
        $resVar = mysql_query($sqlVar, $link_domain);
        $rowVar = mysql_fetch_assoc($resVar);

        $sqlVar2 = "SHOW VARIABLES WHERE `Variable_Name` = 'max_allowed_packet'";
        $resVar2 = mysql_query($sqlVar2, $link_domain);
        $rowVar2 = mysql_fetch_assoc($resVar2);

        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $MySQL_insert_buffer = 4200;
        } else {
            if ($rowVar["Value"] > $rowVar2["Value"]) {
                $MySQL_insert_buffer = round($rowVar2["Value"] / 2);
            } else {
                $MySQL_insert_buffer = round($rowVar["Value"] / 2);
            }
        }
        $Block_insert_buffer = 0;
        $Line_insert_buffer = 0;

        if (!$charsetContent && $needToConvert == true) {
            $needToConvert == true;
        } else {
            $needToConvert = false;
        }

        $filenameControl = EDIRECTORY_ROOT . "/custom/log/prepare_import_control_listing.progress";
        $message_control .= "DomainID|" . SELECTED_DOMAIN_ID . "|ImportLogID|" . $importID . "";

        import_progress($filenameControl, $message_control);

        $messageLog = "Generating sql batch file - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        $lineErrors = [];
        $errorlines = 0;
        while ($line = fgetcsv($handle, 16384, $delimiter)) {
            $generate_lot_start = getmicrotime();
            if (!$tempError && !$import_stop) {
                unset($csvLine);
                if (strlen($sqlBlock) == 0 && strlen($sqlLine) == 0) {
                    $sqlLine = "INSERT INTO `ImportTemporary` (`id`, `import_log_id`, `file_line_number`, `listing_title`, `listing_seo_title`, `listing_email`, `listing_url`, `listing_address`, `listing_address2`, `listing_location1`, `listing_location1_abbreviation`, `listing_location2`, `listing_location2_abbreviation`, `listing_location3`, `listing_location3_abbreviation`, `listing_location4`, `listing_location4_abbreviation`, `listing_location5`, `listing_location5_abbreviation`, `listing_zip`, `listing_latitude`, `listing_longitude`, `listing_phone`, `listing_fax`, `listing_description`, `listing_long_description`, `listing_seo_description`, `listing_keyword`, `listing_renewal_date`, `listing_status`, `listing_level`, `listing_category_1`, `listing_category_2`, `listing_category_3`, `listing_category_4`, `listing_category_5`, `listing_template`, `listing_id`, `custom_id`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`) VALUES ";
                }

                $sqlLine .= "(";
                $sqlLine .= "NULL,";
                $sqlLine .= "$importID,";
                $sqlLine .= "$lineNumber,";

                $filenameProgress = EDIRECTORY_ROOT . "/custom/log/prepare_import_listing.progress";

                $message_progress = "Generating \"Insert\" query - line $lineNumber\n";

                import_progress($filenameProgress, $message_progress);
                /*
                 * This block creates the SqlLine Command line field by field
                 * because the system performance, this method has a better performance than foreach command
                 */
                unset($c);
                $c = 0;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c]), "NULL", false, false) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                        "UTF-8") : $line[$c])) . ",";
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . ",";
                }
                $c++;
                $sqlLine .= db_formatString(import_removeLineBreaks(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                    "UTF-8") : $line[$c]));
                if ($lineNumber <= 10) {
                    $csvLine .= import_formatToCSV(!import_isUFT8($line[$c]) && $needToConvert == true ? mb_convert_encoding($line[$c],
                            "UTF-8") : $line[$c], ",") . "\n";
                }

                $sqlLine .= ")";

                $Line_insert_buffer = strlen($sqlLine);

                if (($Block_insert_buffer + $Line_insert_buffer) <= $MySQL_insert_buffer) {
                    $sqlBlock .= $sqlLine . ",";
                    $sqlLine = "";
                    $Block_insert_buffer = strlen($sqlBlock);
                } else {

                    $message_progress = "Populating Import Temporary - line $lineNumber\n";

                    import_progress($filenameProgress, $message_progress);

                    $sqlBlock = string_substr($sqlBlock, 0, -1);
                    $sqlBlock .= ";\n";
                    $run_lot_start = getmicrotime();
                    mysql_query($sqlBlock, $link_domain);
                    if ($mysql_error = mysql_error($link_domain)) {
                        $tempError = true;
                    }
                    $run_lot_end = getmicrotime();
                    $run_lot_time += $run_lot_end - $run_lot_start;
                    $number_of_blocks++;
                    $auxLine = $sqlLine;
                    $sqlLine = "INSERT INTO `ImportTemporary` (`id`, `import_log_id`, `file_line_number`, `listing_title`, `listing_seo_title`, `listing_email`, `listing_url`, `listing_address`, `listing_address2`, `listing_location1`, `listing_location1_abbreviation`, `listing_location2`, `listing_location2_abbreviation`, `listing_location3`, `listing_location3_abbreviation`, `listing_location4`, `listing_location4_abbreviation`, `listing_location5`, `listing_location5_abbreviation`, `listing_zip`, `listing_latitude`, `listing_longitude`, `listing_phone`, `listing_fax`, `listing_description`, `listing_long_description`, `listing_seo_description`, `listing_keyword`, `listing_renewal_date`, `listing_status`, `listing_level`, `listing_category_1`, `listing_category_2`, `listing_category_3`, `listing_category_4`, `listing_category_5`, `listing_template`, `listing_id`, `custom_id`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`) VALUES ";
                    $sqlLine .= $auxLine . ",";
                    $Line_insert_buffer = strlen($sqlLine);
                    $sqlBlock = "";
                    $sqlBlock .= $sqlLine;
                    $sqlLine = "";
                    $Block_insert_buffer = strlen($sqlBlock);
                }
            }
            $generate_lot_end = getmicrotime();
            $generate_lot_time += $generate_lot_end - $generate_lot_start;
            $lineNumber++;

            if ($tempError && !$inHistory) {
                $inHistory = true;
                $import_stop = true;
                $importlogObj->setHistory("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE");
                $importlogObj->setString("mysqlerror", $mysql_error);
                break;
            }

            $columns_error = false;

            $message_progress = "Validating CSV fields - line $lineNumber\n";

            import_progress($filenameProgress, $message_progress);

            if (count($line) > count($sample_header)) {
                $columns_error = true;
            } else {
                $validate_line_start = getmicrotime();
                for ($i = 0; $i < count($sample_header); $i++) {
                    $line[$i] = !$line[$i] ? "" : $line[$i];
                    // REMOVING BREAK LINES IN CATEGORIES
                    // PAY ATTENTION IN ORDER OF FIELDS
                    if ($i == 28 || $i == 29 || $i == 30 || $i == 31 || $i == 32) {
                        $line[$i] = str_replace("\r\n", "", $line[$i]);
                        $line[$i] = str_replace("\n\r", "", $line[$i]);
                        $line[$i] = str_replace("\r", "", $line[$i]);
                        $line[$i] = str_replace("\n", "", $line[$i]);
                    }

                    if ($i == 36 || $i == 37 || $i == 0 || $i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14 || $i == 17 || $i == 18 || $i == 24 || $i == 25) {
                        if ($i == 36) { //validate username
                            if (($errorInvalid = validate_username($line[$i]))) {
                                if (!$line[$i]) {
                                    $username_noowner = true;
                                } else {
                                    if (string_strpos($line[$i], "facebook::") === false && string_strpos($line[$i], "google::") === false) {
                                        $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDUSERNAMELINE[".$file_line_number."].");
                                        $import_stop = 1;
                                    }
                                }
                            }
                        }

                        if ($i == 37) { //validate password
                            if ((($errorInvalid = validate_password($line[$i])) || (strpos($line[$i],
                                            "\"") !== false)) && (!$username_noowner)
                            ) {
                                $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDPASSWORDLINE[" . $file_line_number . "].");
                                $import_stop = 1;
                            }
                        }

                        if ($i == 0) { //validate listing title
                            if (!$line[$i]) {
                                $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDTITLELINE[" . $file_line_number . "].");
                                $import_stop = 1;
                            }
                        }

                        if ($i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14) { //validate locations

                            $location_coluns = "";
                            if (EDIR_DEFAULT_LOCATIONS) {
                                $_default_locations = explode(",", EDIR_DEFAULT_LOCATIONS);
                                $_default_locationsnames = explode(",", EDIR_DEFAULT_LOCATIONNAMES);
                                $_edir_locations = explode(",", EDIR_LOCATIONS);

                                foreach ($_edir_locations as $key => $value) {
                                    if (in_array($value, $_default_locations)) {
                                        if (array_search($value, $_default_locations) != false) {
                                            $default_locations[$value] = $_default_locationsnames[array_search($value,
                                                $_default_locations)];
                                        }
                                    }
                                }

                                if ($i == 6) {
                                    $j = 1;
                                } else {
                                    if ($i == 8) {
                                        $j = 2;
                                    } else {
                                        if ($i == 10) {
                                            $j = 3;
                                        } else {
                                            if ($i == 12) {
                                                $j = 4;
                                            } else {
                                                if ($i == 14) {
                                                    $j = 5;
                                                }
                                            }
                                        }
                                    }
                                }

                                $j_value = $default_locations[$j];

                                if (is_array($default_locations)) {
                                    if (in_array($j_value, $default_locations)) {
                                        $location_coluns .= "listing_location" . $j . ", ";
                                        ${"default_location_" . $j} = $default_locations[$j];

                                        if (string_strtolower(trim($line[$i])) != string_strtolower(trim(${"default_location_" . $j}))) {
                                            $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLOCATIONLINE[" . $file_line_number . "].");
                                            $import_stop = 1;
                                        }
                                    }
                                }
                            }
                        }

                        if ($i == 17) { //validate latitude
                            if ($line[$i]) {
                                if (!is_numeric($line[$i]) || $line[$i] < -90 || $line[$i] > 90) {
                                    $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLATITUDELINE[" . $file_line_number . "].");
                                    $import_stop = 1;
                                }
                            }
                        }

                        if ($i == 18) { //validate longitude
                            if ($line[$i]) {
                                if (!is_numeric($line[$i]) || $line[$i] < -180 || $line[$i] > 180) {
                                    $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDLONGITUDELINE[" . $file_line_number . "].");
                                    $import_stop = 1;
                                }
                            }
                        }

                        if ($i == 24) { //validate keywords
                            $keywords = explode(" || ", $line[$i]);
                            if (count($keywords) > MAX_KEYWORDS) {
                                $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDKEYWORDS[" . $file_line_number . "].");
                                $import_stop = 1;
                            } else {
                                for ($j = 0; $j < count($keywords); $j++) {
                                    if (string_strlen($keywords[$j]) > 50) {
                                        $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDKEYWORDS2[" . $file_line_number . "].");
                                        $import_stop = 1;
                                    }
                                }
                            }
                        }

                        if ($i == 25) { //validate renewal date
                            if ($line[$i]) {
                                if (!validate_date($line[$i])) {
                                    $importlogObj->setHistory("LANG_MSG_IMPORT_INVALIDRENEWALDATE[" . $file_line_number . "].");
                                    $import_stop = 1;
                                }
                            }
                        }
                    }
                }
                $validate_line_end = getmicrotime();
                $validate_line_time += $validate_line_end - $validate_line_start;
            }

            if ($import_stop) {
                $lineErrors[] = $file_line_number;
                $errorlines++;
                $import_stop = 0; //continue even with errors
            }

            if ($columns_error) {
                $lines_error[] = $file_line_number;
            }
            $file_line_number++;
            $totallines++;
        }

        $messageLog = "Execute sql batch file - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        if (strlen($sqlBlock) != 0) {
            $sqlBlock = string_substr($sqlBlock, 0, -1);
            $sqlBlock .= ";\n";
            $run_lot_start = getmicrotime();
            mysql_query($sqlBlock, $link_domain);
            if ($mysql_error = mysql_error($link_domain)) {
                $tempError = true;
            }
            $run_lot_end = getmicrotime();
            $run_lot_time += $run_lot_end - $run_lot_start;
            $number_of_blocks++;
            $sqlBlock = "";
        }

        if ($tempError && !$inHistory) {

            $messageLog = "Erorr importing to ImportTemporary. Check mysqlerror on ImportLog. - LINE: " . __LINE__;
            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
            $inHistory = true;
            $import_stop = true;
            $importlogObj->setHistory("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE");
            $importlogObj->setString("mysqlerror", $mysql_error);
        }

        if (count($lines_error) > 0) {
            $importlogObj->setHistory("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG[" . implode(", ", $lines_error) . "].");
            $import_stop = 1;
        }
        fclose($handle);
    }

    //Get Settings
    setting_get("default_url", $default_url);
    if (EDIRECTORY_FOLDER) {
        $default_url .= EDIRECTORY_FOLDER;
    }

    setting_get("sitemgr_import_email", $sitemgr_import_email);
    $sitemgr_import_emails = explode(",", $sitemgr_import_email);

    if ($import_stop) {
        $messageLog = "Import error. Check errors on import log history. - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        if ($wrong_imported_header) {
            $importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_HEADER");
        }
        if ($wrong_header_fields) {
            $importlogObj->setHistory("LANG_MSG_IMPORT_WRONG_HEADER2[" . implode(", ", $wrong_header_fields) . "]");
        }
        $importlogObj->setString("status", "E");
        $importlogObj->setString("action", "D");
        $importlogObj->setString("progress", "100%");
        $importlogObj->setString("delimiter", $delimiter == "\t" ? "tab" : $delimiter);
        $importlogObj->save();

        $sqlT = "DELETE FROM `ImportTemporary` WHERE `import_log_id` = " . $importlogObj->getNumber("id");
        mysql_query($sqlUpdate, $link_domain);

        // site manager warning message ////////////////////////////////////////////////////////////////////
        $messageLog = "Notify sitemgr - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);

        $emailSubject = "[" . EDIRECTORY_TITLE . "] " . system_showText(LANG_NOTIFY_PREPAREIMPORT);
        $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER) . ",<br /><br />
							" . system_showText(LANG_NOTIFY_PREPAREIMPORT_1) . " \"" . $importlogObj->getString("filename") . "\" " . system_showText(LANG_NOTIFY_PREPAREIMPORT_2) . "<br /><br />
							" . system_showText(LANG_NOTIFY_PREPAREIMPORT_3) . ":<br />";
        $sitemgr_msg .= "<br /><a href=\"http://" . $default_url . "/" . SITEMGR_ALIAS . "/content/datacenter/index.php?log_id=" . $importlogObj->getNumber("id") . "\" target=\"_blank\">http://" . $default_url . "/" . SITEMGR_ALIAS . "/content/datacenter/index.php?log_id=" . $importlogObj->getNumber("id") . "</a><br /><br />";

        system_notifySitemgr($sitemgr_import_emails, $emailSubject, $sitemgr_msg);

    } else {

        if (is_array($lineErrors) && $lineErrors[0]) {
            foreach ($lineErrors as $lineError) {
                $sqlError = "UPDATE ImportTemporary SET `error` = 'y' WHERE import_log_id = " . $importlogObj->getNumber("id") . " AND file_line_number = " . ($lineError - 1);
                mysql_query($sqlError, $link_domain);
            }
        }

        $messageLog = "Prepare import done - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);

        $importlogObj->setNumber("totallines", $totallines);
        $importlogObj->setString("errorlines", $errorlines);
        $importlogObj->setString("action", "RI");
        $importlogObj->save();
        $importlogObj->setHistory("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE");
        $importlogObj->setHistory("LANG_MSG_IMPORT_TOTALLINESREADY[" . (int)$importlogObj->getNumber("totallines") . "].");
        $importlogObj->setHistory("LANG_MSG_IMPORT_TOTALLINESERROR[" . (int)$importlogObj->getString("errorlines") . "].");

        if (unlink($filenameControl)) {
            $messageLog = "Remove control .progress file $filenameControl. - LINE: " . __LINE__;
            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        } else {
            $messageLog = "Unable to unlink control .progress file $filenameControl. Check permissions. - LINE: " . __LINE__;
            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        }

        if (unlink($filenameProgress)) {
            $messageLog = "Remove .progress file $filenameProgress. - LINE: " . __LINE__;
            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        } else {
            $messageLog = "Unable to unlink .progress file $filenameProgress. Check permissions. - LINE: " . __LINE__;
            log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);
        }

        // site manager warning message ////////////////////////////////////////////////////////////////////
        $messageLog = "Notify sitemgr - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);

        $emailSubject = "[" . EDIRECTORY_TITLE . "] " . system_showText(LANG_NOTIFY_PREPAREIMPORT);
        $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER) . ",<br /><br />
							" . system_showText(LANG_NOTIFY_PREPAREIMPORT_1) . " \"" . $importlogObj->getString("filename") . "\" " . system_showText(LANG_NOTIFY_PREPAREIMPORT_4) . "<br /><br />
							" . system_showText(LANG_NOTIFY_PREPAREIMPORT_5) . ":<br />";
        $sitemgr_msg .= "<br /><a href=\"http://" . $default_url . "/" . SITEMGR_ALIAS . "/content/datacenter/index.php?log_id=" . $importlogObj->getNumber("id") . "\" target=\"_blank\">http://" . $default_url . "/" . SITEMGR_ALIAS . "/content/datacenter/index.php?log_id=" . $importlogObj->getNumber("id") . "</a><br /><br />";

        system_notifySitemgr($sitemgr_import_emails, $emailSubject, $sitemgr_msg);

        $messageLog = "Updating flags to import - LINE: " . __LINE__;
        log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id);

        /*
        * Import Schedule
        */
        $sqlCron = "UPDATE `Control_Import_Listing` SET `scheduled` = 'Y' WHERE `domain_id` = " . SELECTED_DOMAIN_ID;
        mysql_query($sqlCron, $link);
    }


    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'prepare_import'";
    mysql_query($sqlUpdate, $link);
} else {
    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N', `last_run_date` = NOW() WHERE `domain_id` = " . SELECTED_DOMAIN_ID . " AND `type` = 'prepare_import'";
    mysql_query($sqlUpdate, $link);
    exit;
}

////////////////////////////////////////////////////////////////////////////////////////////////////

$time_end = getmicrotime();
import_logDebug("End Date/Time: " . date("Y-m-d H:i:s"));
import_logDebug("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
$time = $time_end - $time_start;
if (!$import_stop) {
    print "Import Correction Process on Domain " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . " - " . string_ucwords(LISTING_FEATURE_NAME_PLURAL) . ": " . $totallines . " - " . round($time,
            2) . " seconds.\n";

    $str_debug = "Check Content Encoding: " . round($check_convert_time,
            2) . "\nCheck Header: " . round($check_header_time,
            2) . "\nGenerate SQL Lot: " . round($generate_lot_time - $run_lot_time,
            2) . "\nRun SQL Lot: " . round($run_lot_time,
            2) . "\nNumber of Blocks: " . $number_of_blocks . "\nValidate CSV Line: " . round($validate_line_time,
            2) . "\n";
    if (IMPORT_TIME_DEBUG == "on") {
        print "++++++++++++++++++\n\n";
        print "Time spent (seconds) in each correction operation:\n\n";
        print $str_debug;
    }

    if (!setting_set("last_datetime_prepare_import", date("Y-m-d H:i:s"))) {
        if (!setting_new("last_datetime_prepare_import", date("Y-m-d H:i:s"))) {
            print "last_datetime_prepare_import error - Domain - " . SELECTED_DOMAIN_ID . " - " . date("Y-m-d H:i:s") . "\n";
        }
    }
}
$messageLog = "Cron finished";
log_addCronRecord($link, "prepare_import", $messageLog, true, $cron_log_id, true, round($time, 2));
////////////////////////////////////////////////////////////////////////////////////////////////////
