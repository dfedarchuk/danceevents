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
	# * FILE: /functions/import_funct.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * Generate a Lot File with all insert SQL command of the .csv file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_generateSQLLot
	 * @example import_generateSQLLot($file_name, $importID, $dbObj);
	 * @param string $filename
	 * @param integer $importID
	 * @param object $dbObj
	 */
	function import_generateSQLLot($importID, &$dbObj, $type = "listing", $arrayErrors) {
		/*
		 * GENERATE SQL LOT FILE
		 */
		$sqlVar = "SHOW VARIABLES WHERE `Variable_Name` = 'bulk_insert_buffer_size'";
		$resVar = $dbObj->Query($sqlVar);
		$rowVar = mysql_fetch_assoc($resVar);

		$sqlVar2 = "SHOW VARIABLES WHERE `Variable_Name` = 'max_allowed_packet'";
		$resVar2 = $dbObj->Query($sqlVar2);
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

		$sqlLog = "SELECT `phisicalname` FROM `ImportLog` WHERE `id` = $importID";
		$resLog = $dbObj->Query($sqlLog);
		$rowLog = mysql_fetch_assoc($resLog);

		$fileNames = explode(",", $rowLog["phisicalname"]);
		foreach ($fileNames as $key => $file_name) {
			if (count($fileNames) > 1) {
				$file_name = $key."_".$file_name;
			}

			$read_file_path = IMPORT_FOLDER."/".$file_name;
			$write_file_path = IMPORT_FOLDER."/".str_replace(".csv", "", $file_name).".txt";

			$Block_insert_buffer = 0;
			$Line_insert_buffer = 0;

			$readFile = fopen($read_file_path, "r");
			$writeFile = fopen($write_file_path, "w+");

			$csvDelimiter = import_detectDelimiter($read_file_path);

			$sqlBlock = "";

			$i = 0;
			$headerCount = 0;
			$lineCount = 0;
			$lineDiff = 0;
			while ($readLine = fgetcsv($readFile, 16384, $csvDelimiter)) {
				if ($i > 0) {
					if (strlen($sqlBlock) == 0 && strlen($sqlLine) == 0) {
						if ($type != "listing"){ //working only for Event
							$sqlLine = "INSERT INTO `ImportTemporary_".ucfirst($type)."` (`id`, `import_log_id`, `file_line_number`, `error`, `".$type."_title`, `".$type."_seo_title`, `".$type."_email`, `".$type."_url`, `".$type."_address`, `".$type."_locationname`, `".$type."_contactname`, `".$type."_startdate`, `".$type."_enddate`, `".$type."_starttime`, `".$type."_starttime_mode`, `".$type."_endtime`, `".$type."_endtime_mode`, `".$type."_location1`, `".$type."_location1_abbreviation`, `".$type."_location2`, `".$type."_location2_abbreviation`, `".$type."_location3`, `".$type."_location3_abbreviation`, `".$type."_location4`, `".$type."_location4_abbreviation`, `".$type."_location5`, `".$type."_location5_abbreviation`, `".$type."_zip`, `".$type."_latitude`, `".$type."_longitude`, `".$type."_phone`, `".$type."_description`, `".$type."_long_description`, `".$type."_seo_description`, `".$type."_keyword`, `".$type."_renewal_date`, `".$type."_status`, `".$type."_level`, `".$type."_category_1`, `".$type."_category_2`, `".$type."_category_3`, `".$type."_category_4`, `".$type."_category_5`, `".$type."_id`, `custom_id`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`) VALUES ";
						} else {
							$sqlLine = "INSERT INTO `ImportTemporary` (`id`, `import_log_id`, `file_line_number`, `error`, `listing_title`, `listing_seo_title`, `listing_email`, `listing_url`, `listing_address`, `listing_address2`, `listing_location1`, `listing_location1_abbreviation`, `listing_location2`, `listing_location2_abbreviation`, `listing_location3`, `listing_location3_abbreviation`, `listing_location4`, `listing_location4_abbreviation`, `listing_location5`, `listing_location5_abbreviation`, `listing_zip`, `listing_latitude`, `listing_longitude`, `listing_phone`, `listing_fax`, `listing_description`, `listing_long_description`, `listing_seo_description`, `listing_keyword`, `listing_renewal_date`, `listing_status`, `listing_level`, `listing_category_1`, `listing_category_2`, `listing_category_3`, `listing_category_4`, `listing_category_5`, `listing_template`, `listing_id`, `custom_id`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`) VALUES ";
						}
						
					}

					$sqlLine .= "(";
					$sqlLine .= "NULL,";
					$sqlLine .= "$importID,";
					$sqlLine .= "$i,";
                    if (in_array($i+1, $arrayErrors)) {
                        $sqlLine .= "'y',";
                    } else {
                        $sqlLine .= "'n',";
                    }
					foreach ($readLine as $key => $readCol) {
						$sqlLine .= db_formatString(import_removeLineBreaks($readCol)).($key == count($readLine) - 1? "": ",");
					}
					$lineCcount = count($readLine);
					$lineDiff = $headerCount - $lineCcount;
					if ($lineCount < $headerCount) {
						for ($cc = 0; $cc < $lineDiff; $cc++) {
							$sqlLine .= ",".db_formatString("");
						}						
					}
					$sqlLine .= ")";

					$Line_insert_buffer = strlen($sqlLine);

					if (($Block_insert_buffer + $Line_insert_buffer) <= $MySQL_insert_buffer) {
						$sqlBlock .= $sqlLine.",";
						$sqlLine = "";
						$Block_insert_buffer = strlen($sqlBlock);
					} else {
						$sqlBlock = string_substr($sqlBlock, 0, -1);
						$sqlBlock .= ";\n";
						fwrite($writeFile, $sqlBlock, strlen($sqlBlock));
						$auxLine = $sqlLine;
						if ($type != "listing"){ //working only for Event
							$sqlLine = "INSERT INTO `ImportTemporary_".ucfirst($type)."` (`id`, `import_log_id`, `file_line_number`, `error`, `".$type."_title`, `".$type."_seo_title`, `".$type."_email`, `".$type."_url`, `".$type."_address`, `".$type."_locationname`, `".$type."_contactname`, `".$type."_startdate`, `".$type."_enddate`, `".$type."_starttime`, `".$type."_starttime_mode`, `".$type."_endtime`, `".$type."_endtime_mode`, `".$type."_location1`, `".$type."_location1_abbreviation`, `".$type."_location2`, `".$type."_location2_abbreviation`, `".$type."_location3`, `".$type."_location3_abbreviation`, `".$type."_location4`, `".$type."_location4_abbreviation`, `".$type."_location5`, `".$type."_location5_abbreviation`, `".$type."_zip`, `".$type."_latitude`, `".$type."_longitude`, `".$type."_phone`, `".$type."_description`, `".$type."_long_description`, `".$type."_seo_description`, `".$type."_keyword`, `".$type."_renewal_date`, `".$type."_status`, `".$type."_level`, `".$type."_category_1`, `".$type."_category_2`, `".$type."_category_3`, `".$type."_category_4`, `".$type."_category_5`, `".$type."_id`, `custom_id`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`) VALUES ";
						} else {
							$sqlLine = "INSERT INTO `ImportTemporary` (`id`, `import_log_id`, `file_line_number`, `error`, `listing_title`, `listing_seo_title`, `listing_email`, `listing_url`, `listing_address`, `listing_address2`, `listing_location1`, `listing_location1_abbreviation`, `listing_location2`, `listing_location2_abbreviation`, `listing_location3`, `listing_location3_abbreviation`, `listing_location4`, `listing_location4_abbreviation`, `listing_location5`, `listing_location5_abbreviation`, `listing_zip`, `listing_latitude`, `listing_longitude`, `listing_phone`, `listing_fax`, `listing_description`, `listing_long_description`, `listing_seo_description`, `listing_keyword`, `listing_renewal_date`, `listing_status`, `listing_level`, `listing_category_1`, `listing_category_2`, `listing_category_3`, `listing_category_4`, `listing_category_5`, `listing_template`, `listing_id`, `custom_id`, `account_username`, `account_password`, `account_first_name`, `account_last_name`, `account_company`, `account_address`, `account_address2`, `account_country`, `account_state`, `account_city`, `account_zip`, `account_phone`, `account_fax`, `account_email`, `account_url`) VALUES ";
						}

						$sqlLine .= $auxLine.",";
						$Line_insert_buffer = strlen($sqlLine);
						$sqlBlock = "";
						$sqlBlock .= $sqlLine;
						$sqlLine = "";
						$Block_insert_buffer = strlen($sqlBlock);
					}
				} else {
					$headerCount = count($readLine);
				}
				$i++;
			}

			if (strlen($sqlBlock) != 0) {
				$sqlBlock = string_substr($sqlBlock, 0, -1);
				$sqlBlock .= ";\n";
				fwrite($writeFile, $sqlBlock, strlen($sqlBlock));
				$sqlBlock = "";
			}

			fclose($readFile);
			fclose($writeFile);
		}
	}

	/**
	 * Detect UTF-8 encoding in string lines
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_isUFT8
	 * @example import_isUFT8($string);
	 * @param string $string
	 * @return boolean
	 */
	function import_isUFT8($string){
		return preg_match('%(?:
			[\xC2-\xDF][\x80-\xBF]						# non-overlong 2-byte
			|\xE0[\xA0-\xBF][\x80-\xBF]					# excluding overlongs
			|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}			# straight 3-byte
			|\xED[\x80-\x9F][\x80-\xBF]					# excluding surrogates
			|\xF0[\x90-\xBF][\x80-\xBF]{2}				# planes 1-3
			|[\xF1-\xF3][\x80-\xBF]{3}                  # planes 4-15
			|\xF4[\x80-\x8F][\x80-\xBF]{2}				# plane 16
			)+%xs', $string);
	}

	/**
	 * Format values to put in .csv file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_formatToCSV
	 * @example import_formatToCSV($field, $delimiter);
	 * @param string $field
	 * @param string $delimiter ,
	 * @return string $field
	 */
	function import_formatToCSV($field, $delimiter = ",") {
		$field = str_replace("\n\r", "", $field);
		$field = str_replace("\r\n", "", $field);
		$field = str_replace("\n", "", $field);
		$field = str_replace("\r", "", $field);
		$field = str_replace("'", "\'", $field);
		$field = str_replace('"', '\"', $field);
		if ($delimiter == "|" || $delimiter == "*" || $delimiter == "\\" || $delimiter == "/" || $delimiter == ".") $delimiter = "\\".$delimiter;
		if (preg_match("/$delimiter/", $field)) {
			$field = "\"".$field."\"";
		}
		return $field;
	}
	
	/**
	 * Removes the line breaks into the field
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_removeLineBreaks
	 * @example import_removeLineBreaks($field);
	 * @param string $field
	 * @return string $field
	 */
	function import_removeLineBreaks ($field) {
		$field = str_replace("\n\r", "", $field);
		$field = str_replace("\r\n", "", $field);
		$field = str_replace("\n", "", $field);
		$field = str_replace("\r", "", $field);
		
		return $field;
	}

	/**
	 * Detect the column delimiter of the .csv file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_detectDelimiter
	 * @example import_detectDelimiter($file);
	 * @param string $file
	 * @return string $delUsed
	 */
	function import_detectDelimiter($file) {
		$delimiters = Array(",", "\t", ";", "|", "*", "\\", "/", "_", ":", ".");
		$delOccur = Array();
		$fileHandle = fopen($file, "r");
		$line = fgets($fileHandle);
		foreach ($delimiters as $delimiter) {
			$delOccur[$delimiter] = string_substr_count($line, $delimiter);
		}

		$delCount = 0;
		$delUsed = "";
		foreach ($delOccur as $del => $occur) {
			if ($occur > $delCount) {
				$delCount = $occur;
				$delUsed = $del;
			}
		}
		return $delUsed;
	}

	/**
	 * Check empty csv files
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_checkEmptyFile
	 * @example import_checkEmptyFile($fileName, &$error);
	 * @param string $file
	 * @param string $error
	 * @return boolean  
	 */
	function import_checkEmptyFile($file, &$error) {
        if (file_exists($file)){
            $error = "";
            $fileHandle = fopen($file, "r");
            $line1 = fgets($fileHandle);
            $line2 = fgets($fileHandle);

            if (!$line2) return false;
            else if (!$line1) return false;
            else return true;
        } else {
            $error = system_showText(LANG_SITEMGR_MSGERROR_FILENOTEXISTS);
            return false;
        }
	}

	/**
	 * Update import log history
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_setHistory
	 * @example import_setHistory($history, $link, $log_id);
	 * @param string $history
	 * @param mixed $dblink
	 * @param integer $log_id
	 */
	function import_setHistory($history, $dblink, $log_id) {
		$history = $history."||";
		$aux_str = addslashes($history);
		$sql = "UPDATE ImportLog SET history = CONCAT(history, '".$aux_str."') WHERE id = '".$log_id."'";
		mysql_query($sql, $dblink);
	}

	/**
	 * Return import log history text
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_getHistory
	 * @example import_getHistory($history);
	 * @param string $history
	 * @return string $str_history
	 */
	function import_getHistory($history) {
		$arrayHistory = explode("||",$history);
		$str_history = "";
		if (is_array($arrayHistory)){
			foreach($arrayHistory as $history){

				$arrayAux = explode("[", $history);
				if (count($arrayAux)>1){
					if (defined($arrayAux[0])){
						$str_history .= constant($arrayAux[0])." ".str_replace("]", "", $arrayAux[1])."<br />";
					} else if (defined(str_replace("].", "", $arrayAux[1]))){
						$str_history .= $arrayAux[0]." ".constant(str_replace("].", "", $arrayAux[1])).".<br />";
					}
				} else {
					if (defined($history)){
						$str_history .= constant($history)."<br />";
					} else {
						$str_history .= html_entity_decode(nl2br($history))."<br />";
					}
				}
			}
		} else {
			$str_history .= html_entity_decode(nl2br($history));
		}

		return $str_history;
	}

	/**
	 * Update import log file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_logDebug
	 * @example import_logDebug($message);
	 * @param string $message
	 */
	function import_logDebug($message, $support = false) {
		if ($support){
			$sitemgr_email = EDIR_SUPPORT_EMAIL;
			$eDirMailerObj = new EDirMailer(EDIR_SUPPORT_EMAIL, "[eDirectory Cron] - Import Speed Report", $message, $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (IMPORT_DEBUG == "on") {
			setting_get("sitemgr_email", $sitemgr_email);

			$filename = EDIRECTORY_ROOT.IMPORTFOLDER."/importdebug.log";
			if (!$handle = fopen($filename, "a")) {
				$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file open (".$filename.").", $sitemgr_email);
				$eDirMailerObj->send();
				exit;
			}
			if (fwrite($handle, "(".IMPORT_PROCESS_ID.") ".$message."\n") === false) {
				$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file write (".$filename.").", $sitemgr_email);
				$eDirMailerObj->send();
				exit;
			}
			if (!fclose($handle)) {
				$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file close (".$filename.").", $sitemgr_email);
				$eDirMailerObj->send();
				exit;
			}
		}
	}

	/**
	 * Get running import progress
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_getRunningImports
	 * @example import_getRunningImports($domain_id);
	 * @param integer $domain_id
	 * @return array $array
	 */
	function import_getRunningImports($domain_id, $type = "listing") {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);

		$sql = "SELECT id FROM ImportLog WHERE status = 'P' AND action = 'RI' AND type = '$type'";
		$resultTotal = $dbObj->query($sql);

		$sql = "SELECT `last_importlog` FROM Control_Import_".ucfirst($type)." WHERE domain_id = ".$domain_id;
		$resultLastImport = $dbMain->Query($sql);
		$rowLastImport = mysql_fetch_assoc($resultLastImport);

		$sql = "SELECT `status` FROM ImportLog WHERE id = ".$rowLastImport["last_importlog"]." AND type = '".$type."'";
		$resultLastImport = $dbObj->Query($sql);
		$rowLastImportStatus = mysql_fetch_assoc($resultLastImport);

		//actual running import
		$sql = "SELECT `id`, `progress`, `status`, `linesadded` FROM ImportLog WHERE `status` in ('R', 'P') AND action = 'RI' AND type = '".$type."'";
		$result = $dbObj->query($sql);

		unset($dbMain);
		unset($dbObj);

		if (mysql_num_rows($result) > 0){
			$row = mysql_fetch_assoc($result);
			$array["id"] = $row["id"];
			$array["progress"] = $row["progress"];
			$array["linesadded"] = $row["linesadded"];
			$array["status"] = $row["status"];
			$array["pending_imports"] = mysql_num_rows($resultTotal);
			$array["last_importlog"] = $rowLastImport["last_importlog"];
			$array["last_importlog_status"] = $rowLastImportStatus["status"] ? $rowLastImportStatus["status"] : 0;
			return $array;
		} else {
			return mysql_num_rows($resultTotal);
		}

	}

	/**
	 * Format date field to DB default format
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_formatDate
	 * @example import_formatDate($date);
	 * @param string $date
	 * @return string $date_formated
	 */
	function import_formatDate($date) {

		if (string_strpos($date, "/")) {

			$aux = explode("/", $date);

			if (count($aux) == 3) {

				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$month = $aux[0];
					$day = $aux[1];
					$year = $aux[2];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$month = $aux[1];
					$day = $aux[0];
					$year = $aux[2];
				}

				if (checkdate((int)$month, (int)$day, (int)$year)) {
					$date_formated = $year."-".$month."-".$day;
				} else {
					$date_formated = "0000-00-00";
				}

			} else {
				$date_formated = "0000-00-00";
			}

		} else if (string_strpos($date, "-")) {

			$aux = explode("-", $date);

			if (count($aux) == 3) {

				if (checkdate((int)$aux[1], (int)$aux[2], (int)$aux[0])) {
					$date_formated = $date;
				} else {
					$date_formated = "0000-00-00";
				}

			} else {
				$date_formated = "0000-00-00";
			}

		} else {
			$date_formated = "0000-00-00";
		}

		return $date_formated;
	}

	/**
	 * Reload the import folder and retrieve the files array
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_reloadFileList
	 * @example import_reloadFileList();
	 * @return mixed $fileInfo
	 */
	function import_reloadFileList ($domain_id = SELECTED_DOMAIN_ID) {
		$path = EDIRECTORY_ROOT."/custom/domain_".$domain_id."/import_files";
		$files = glob($path."/*.csv");
		unset($fileInfo, $auxInfo);
		if (is_array($files) && $files[0]) {
			$fileCount = 0;
			foreach ($files as $file) {
				if (string_strpos($file, "preview_") === false) {
					$auxInfo["file_path"]			= $file;
					$auxInfo["file_name"]			= str_replace($path."/", "", $file);

					$auxDName = explode(".", $auxInfo["file_name"]);
					$auxDExt = array_pop($auxDName);
					if (is_array($auxDName) && $auxDName[0]) $auxFName = implode(".", $auxDName);

					$auxInfo["file_display_name"]	= system_showTruncatedText($auxFName, 100, "[...].".$auxDExt);
					$auxInfo["file_size"]			= round(filesize($file) / 1024);
					$auxInfo["file_time"]			= date(DEFAULT_DATE_FORMAT." - H:i:s", filemtime($file));
					if ($auxInfo["file_size"] >= 1024) $auxInfo["file_size"] = round($auxInfo["file_size"] / 1024, 2)." Mb";
					else $auxInfo["file_size"] .= " Kb";

					$fileInfo[$fileCount] = $auxInfo;
					unset($auxInfo);

					$fileCount++;
				}
			}
			if (is_array($fileInfo) && $fileInfo[0]) {
				array_multisort($fileInfo[0], SORT_ASC, SORT_STRING);
			}
		}
		return $fileInfo;
	}

	/**
	 * Render the file list in html format
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name import_reloadFileList
	 * @example
	 * Normal Usege -> import_reloadFileList($fileInfo);
	 * Ajax Usage -> import_reloadFileList($fileInfo, true);
	 * @return string HtmlCode
	 */
	function import_renderFileList ($fileInfo, $ajax = false) {
		if (count($fileInfo) && $fileInfo[0]) { ?>
			<input type="hidden" id="rowFile" value=""/>
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table load-ftp-table">
				<? foreach ($fileInfo as $k => $fInfo) { ?>
					<? if ($fInfo["file_name"] && $fInfo["file_size"] && $fInfo["file_time"]) { ?>
					<?
						$tdClass = "";
						if (($k % 2) == 0) {
							$tdClass = "stripe";
						}
					?>
					<tr onclick="selectRow('listFileName_<?=$k;?>');">
						<td class="table-select-file <?=$tdClass;?>"><input type="radio" id="listFileName_<?=$k;?>" name="listFileName" value="<?=$fInfo["file_name"];?>"/></td>
						<td class="table-file-name <?=$tdClass;?>"><?=$fInfo["file_display_name"];?></td>
						<td class="table-file-size <?=$tdClass;?>"><?=$fInfo["file_size"];?></td>
						<td class="table-file-date <?=$tdClass;?>"><?=$fInfo["file_time"];?></td>
					</tr>
					<? } ?>
				<? } ?>
			</table>
		<? } else { ?>
			<p class="informationMessage"><?=system_showText(LANG_MSG_IMPORT_NOFILES_INFTP);?></p>
		<? 
			if ($ajax) echo "[||]EMPTY";
		}
	}
    
  
    function import_getLogTip($status, $action) {
        $tip = "";
        if ($status == "P") {
            if ($action == "RI") {
                $tip = "cron import.php ready to run. Table ImportTemporary has already been populated.";
            } elseif ($action == "NC") {
                $tip = "cron prepare_import.php ready to run. The CSV file still exists at folder custom/domain_x/import_files and the table ImportTemporary has not been populated.";
            } elseif ($action == "NA") {
                $tip = "prepare_import.php successfully done. Waiting for sitemgr approval.";
            } elseif ($action == "C") {
                $tip = "cron prepare_import.php is running.";
            } else {
                $tip = "Invalid combination";
            }
        } elseif ($status == "F") {
            if ($action == "D") {
                $tip = "import successfully done.";
            } elseif ($action == "NR") {
                $tip = "import done and roll back scheduled.";
            } else {
                $tip = "Invalid combination";
            }
        } elseif ($status == "C") {
            if ($action == "D") {
                $tip = "roll back successfully done.";
            } else {
                $tip = "Invalid combination";
            }
        } elseif ($status == "D") {
            if ($action == "RI") {
                $tip = "log deleted before import be done (items are removed from ImportTemporary and the CSV file is deleted from custom folder).";
            } elseif ($action == "NC") {
                $tip = "log deleted before prepare_import.php be done (CSV is deleted from custom folder).";
            } elseif ($action == "NA") {
                $tip = "log deleted before sitemgr approves it (items are removed from ImportTemporary and the CSV file is deleted from custom folder).";
            } elseif ($action == "D") {
                $tip = "log deleted after a finished import. (imported items are not deleted, only the import record is no longer shown to sitemgr).";
            } else {
                $tip = "Invalid combination";
            }
        } elseif ($status == "W") {
            if ($action == "RI") {
                $tip = "import has just been stopped by sitemgr. Status will be changed to S (stopped).";
            } else {
                $tip = "Invalid combination";
            }
        } elseif ($status == "E") {
            if ($action == "D") {
                $tip = "import error (wrong CSV file or wrong sql lote file, check the column mysql_error in ImportLog table).";
            } else {
                $tip = "Invalid combination";
            }
        } elseif ($status == "R") {
            if ($action == "RI") {
                $tip = "import.php is running.";
            } else {
                $tip = "Invalid combination";
            }
        } elseif ($status == "S") {
            if ($action == "D") {
                $tip = "import stopped by sitemgr.";
            } else {
                $tip = "Invalid combination";
            }
        } else {
            $tip = "Invalid Status";
        }
        return $tip;
    }
    
    function import_validateStatusCombinations($status, $action) {
        if ($status == "P") {
            if ($action == "RI" || $action == "NC" || $action == "NA" || $action == "C") {
                return true;
            } else {
                return false;
            }
        } elseif ($status == "F") {
            if ($action == "D" || $action == "NR") {
                return true;
            } else {
                return false;
            }
        } elseif ($status == "C") {
            if ($action == "D") {
                return true;
            } else {
                return false;
            }
        } elseif ($status == "D") {
            if ($action == "RI" || $action == "NC" || $action == "NA" || $action == "D") {
                return true;
            } else {
                return false;
            }
        } elseif ($status == "W") {
            if ($action == "RI") {
                return true;
            } else {
                return false;
            }
        } elseif ($status == "E") {
            if ($action == "D") {
                return true;
            } else {
                return false;
            }
        } elseif ($status == "R") {
            if ($action == "RI") {
                return true;
            } else {
                return false;
            }
        } elseif ($status == "S") {
            if ($action == "D") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }
?>