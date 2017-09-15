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
	# * FILE: /classes/class_export.php
	# ----------------------------------------------------------------------------------------------------

	class Export extends Handle {

		private $db_mainObj;
		private $db_domainObj;
		
		private $domain_id;
		private $export_fileDir;
		private $export_from;
		
		private $fields_table;
		private $fields_file;
		private $fields_sql;
		private $fields_header;
		private $fields_excluded;

		private $item_limit;
		private $item_start;
		private $item_end;
		private $item_count;
		private $item_block;
		private $item_step;
		private $item_current;
		private $item_type;
		private $item_table;
		private $item_filter;
		
		private $filter_locationLevel;
		private $filter_locationId;
		private $filter_categoryId;
		
		private $file_basename;
		private $file_extension;
		private $file_path;
		
		private $zip_filename;
		private $zip_filepath;
		private $zip_obj;
		
		private $progress_filename;
		private $progress_filepath;
		private $progress_value;
		
		private $error_status;
		
		function Export($request = false) {
			$this->resetAttributes();

			if (is_array($request)) {
				
				$this->domain_id				= $request["domain_id"];
				$this->item_limit				= $request["item_limit"];
				$this->item_start				= $request["item_start"]? $request["item_start"] : 0;
				$this->item_count				= $request["item_count"]? $request["item_count"] : 0;
				$this->item_current				= $request["item_current"]? $request["item_current"] : 0;
				$this->item_block				= $request["item_block"]? $request["item_block"] : 0;
				$this->item_step				= $request["item_step"]? $request["item_step"] : 0;
				$this->item_end					= $request["item_limit"];
				$this->item_type				= $request["item_type"];
				$this->item_filter				= $request["item_filter"];
				$this->fields_excluded			= explode(", ", $request["fields_excluded"]);
				$this->filter_locationLevel		= $request["filter_locationLevel"];
				$this->filter_locationId		= $request["filter_locationId"];
				$this->filter_categoryId		= $request["filter_categoryId"];
				$this->file_basename			= $request["file_basename"];
				$this->file_extension			= $request["file_extension"];
				$this->zip_filename				= $request["zip_filename"];
				$this->export_from				= $request["export_from"];
				
				$this->progress_filename		= "export_".str_replace(".zip", "", $this->zip_filename).".progress";
				$this->progress_value			= 0;
				
				if ($this->item_type == "Email") {
					$this->item_table = "`Listing`";
				} else {
					$this->item_table = "`$this->item_type`";
				}

				$this->db_mainObj				= db_getDBObject(DEFAULT_DB, true);
				$this->db_domainObj				= db_getDBObjectByDomainID($this->domain_id, $this->db_mainObj);
				
				$this->zip_obj					= new Zip();

				$this->setDefautlPath($request["path"]);
			}
		}
		
		function resetAttributes () {
			$classAttr = get_class_vars(__CLASS__);
			foreach ($classAttr as $attr => $value) {
				$this->$attr = "";
			}
		}
		
		function execute () {
			switch ($this->item_type) {
				case "Account":
					$this->generateAccountData();
					break;
				case "Location":
					$this->generateLocationData();
					break;
				case "Email":
					$this->generateEmailData();
					break;
				default:
					if ($this->item_type == "Listing" && $this->export_from == "cron") $this->generateListingData();
					else $this->generateModulesData();
					break;
			}
			
			if ($this->error_status) return "error";
			else return "success" . " - " . system_showText(LANG_SITEMGR_EXPORT_SUCCESSFULLY) . " - " . $this->zip_filename;
		}
		
		static function formatFileHeader ($field = false) {
			if ($field) {
				$auxField = str_replace("_id",	"",		$field);
				$auxField = str_replace("_",	" ",	$auxField);
				
				$auxField = ucwords($auxField);
				return $auxField;
			} else {
				return false;
			}
		}
		
		function getUsernameByID ($user_id = false) {
			if ($user_id) {
				$dbMain = &$this->db_mainObj;
				$sqlAcc = "SELECT `username` FROM `Account` WHERE `id` = $user_id";
				$resAcc = $dbMain->Query($sqlAcc);
				$rowAcc = mysql_fetch_assoc($resAcc);
				$username = $rowAcc["username"];
				return $username;
			} else {
				return false;
			}
		}
		
		function getFormatedData ($data_array = false) {
			if ($data_array && is_array($data_array)) {
				$data_arrayNEW = array_map("export_formatToCSV", $data_array);
				return $data_arrayNEW;
			} else {
				return false;
			}
		}
		
		function setDefautlPath ($path = false) {
			if (is_dir($path)) {
				$this->export_fileDir = $path;
			} else {
				$this->export_fileDir = EDIRECTORY_ROOT."/custom/domain_".$this->domain_id."/export_files";
			}
		}
		
		function calcDataBlocks ($fields = "", $where = "") {
			if (!$this->item_block && !$this->item_count) {
				if ($this->item_type == "Account" || $this->item_type == "Location") $dbObj = &$this->db_mainObj;
				else $dbObj = &$this->db_domainObj;

				if (!$fields) $fields = "COUNT(`id`) AS `total`";

				$sqlBlock = "SELECT 
					$fields
				FROM $this->item_table
				$where";

				$resBlock = $dbObj->Query($sqlBlock);
				$rowBlock = mysql_fetch_assoc($resBlock);
				$itemCount = $rowBlock["total"];
				$itemBlocks = round($itemCount / $this->item_limit, 1);
				if ($itemBlocks < 1) $itemBlocks = 1;

				$this->item_block = $itemBlocks;
				$this->item_count = $itemCount;
			}
		}
		
		function generateFields () {
			if ($this->item_count) {
				$this->fields_file		= "";
				$this->fields_header	= "";
				$this->fields_table		= "";
				$this->fields_sql		= "";

				if ($this->item_type == "Email") {
					$this->fields_file		= "";
					$this->fields_header	= "";
					$this->fields_table		= "`email`";
					$this->fields_sql		= "`email`";
				} else if ($this->item_type == "Account") {
					$dbMain = &$this->db_mainObj;

					$sqlFields = "SHOW FIELDS FROM $this->item_table";
					$resFields = $dbMain->query($sqlFields);

					while ($rowFields = mysql_fetch_assoc($resFields)) {
						if (array_search($rowFields["Field"], $this->fields_excluded) === false) {
							$this->fields_table[]	= "A.`".$rowFields["Field"]."`";
							$this->fields_file[]	= $rowFields["Field"];
						}
					}

					$sqlFields = "SHOW FIELDS FROM `Contact`";
					$resFields = $dbMain->query($sqlFields);

					while ($rowFields = mysql_fetch_assoc($resFields)) {
						if (array_search($rowFields["Field"], $this->fields_excluded) === false && array_search($rowFields["Field"], $this->fields_file) === false) {
							$this->fields_table[]	= "C.`".$rowFields["Field"]."`";
							$this->fields_file[]	= $rowFields["Field"];
						}
					}

					$fieldsCsv = array_map("Export::formatFileHeader", $this->fields_file);
					$this->fields_header = implode(",", $fieldsCsv)."\n";
					$this->fields_sql = implode(", ", $this->fields_table);
				} else {
					if ($this->item_type == "Location") $dbObj = &$this->db_mainObj;
					else $dbObj = &$this->db_domainObj;

					$sqlFields = "SHOW FIELDS FROM $this->item_table";
					$resFields = $dbObj->query($sqlFields);

					unset($fields, $fieldsCsv);
					while ($rowFields = mysql_fetch_assoc($resFields)) {
						if (array_search($rowFields["Field"], $this->fields_excluded) === false) {
							$this->fields_table[]	= "`".$rowFields["Field"]."`";
							$this->fields_file[]	= $rowFields["Field"];
						}
					}
					$fieldsCsv = array_map("Export::formatFileHeader", $this->fields_file);
					$this->fields_header = implode(",", $fieldsCsv)."\n";
					$this->fields_sql = implode(", ", $this->fields_table);
				}
			}
		}
		
		function generateLocationData () {
			$edirLocations = explode(",", EDIR_ALL_LOCATIONS);
			$edirLocationsNames = explode(",", EDIR_ALL_LOCATIONNAMES);	
			
			unset($fileNames);
			
			foreach ($edirLocations as $k => $location) {
				$this->item_table = "`".$this->item_type."_$location`";
				
				unset($this->item_count, $this->item_block);				
				$this->calcDataBlocks();
				$this->generateFields();
				
				if ($this->item_count) {
					$dbMain = &$this->db_mainObj;
				
					$this->file_basename = string_strtolower($this->item_type)."_".string_strtolower($edirLocationsNames[$k]);
					for ($b = 0; $b < $this->item_block; $b++) {
						if ($b > 0) $this->item_start += $this->item_end;
						else $this->item_start = $b;

						$this->file_path = $this->export_fileDir."/".$this->file_basename."_".$b.".".$this->file_extension;
						$fileNames[string_strtolower($edirLocationsNames[$k])][] = $this->file_basename."_".$b.".".$this->file_extension;
						$fileHandle = fopen($this->file_path, "wb+");
						$cslLine = $this->fields_header;

						$sqlData = "SELECT 
										$this->fields_sql 
									FROM $this->item_table
									ORDER BY {$this->fields_table[0]} 
									LIMIT $this->item_start, $this->item_end";
						$resData = $dbMain->Query($sqlData);

						while ($rowData = mysql_fetch_assoc($resData)) {
							$dataCSV = array_map("export_formatToCSV", $rowData);
							$cslLine .= implode(",", $dataCSV)."\n";
						}
						fwrite($fileHandle, $cslLine, strlen($cslLine));
						fclose($fileHandle);
					}					
				}
			}
			$this->file_basename = string_strtolower($this->item_type);
			$this->zipFile($fileNames);
		}
		
		function generateAccountData () {
			$this->calcDataBlocks();
			$this->generateFields();

			if ($this->item_count) {
				$dbMain = &$this->db_mainObj;
				
				$this->file_basename = string_strtolower($this->item_type);
				for ($b = 0; $b < $this->item_block; $b++) {
					if ($b > 0) $this->item_start += $this->item_end;
					else $this->item_start = $b;

					$this->file_path = $this->export_fileDir."/".$this->file_basename."_".$b.".".$this->file_extension;
					$fileHandle = fopen($this->file_path, "wb+");
					$cslLine = $this->fields_header;

					$sqlData = "SELECT 
									$this->fields_sql 
								FROM $this->item_table A
								LEFT JOIN `Contact` C ON (C.`account_id` = A.`id`)
								ORDER BY {$this->fields_table[0]} 
								LIMIT $this->item_start, $this->item_end";
					$resData = $dbMain->Query($sqlData);

					while ($rowData = mysql_fetch_assoc($resData)) {
						$dataCSV = array_map("export_formatToCSV", $rowData);
						$cslLine .= implode(",", $dataCSV)."\n";
					}
					fwrite($fileHandle, $cslLine, strlen($cslLine));
					fclose($fileHandle);
				}
				$this->zipFile();
			}
		}
		
		function generateEmailData () {
			$dbDomain = &$this->db_domainObj;
			$where = '';

			switch ($this->item_filter) {
				case "category":
					if (is_numeric($this->filter_categoryId)) {
						$sqlSelCat = "SELECT `root_id`, `left`, `right` FROM `ListingCategory` WHERE `id` = $this->filter_categoryId";
						$resSelCat = $dbDomain->Query($sqlSelCat);
						$rowSelCat = mysql_fetch_assoc($resSelCat);
						
						$root_id = $rowSelCat["root_id"];
						$left = $rowSelCat["left"];
						$right = $rowSelCat["right"];
						
						$sqlChieldCat = "SELECT `id` FROM `ListingCategory` WHERE `root_id` = $root_id AND `left` >= $left AND `right` <= $right";
						$resChieldCat = $dbDomain->Query($sqlChieldCat);

						unset($categories);
						while ($rowChieldCat = mysql_fetch_assoc($resChieldCat)) {
							$categories[] = $rowChieldCat["id"];
						}
						
						$sqlLCat = "SELECT `listing_id` FROM `Listing_Category` WHERE `category_id` IN (".implode(",", $categories).")";
						$resLCat = $dbDomain->Query($sqlLCat);
						
						unset($listings);
						while ($rowLCat = mysql_fetch_assoc($resLCat)) {
							$listings[] = $rowLCat["listing_id"];
						}

						if ($listings[0] && is_array($listings)) {
							$where =  "WHERE `email` != '' AND `id` IN (".implode(",", $listings).")";
						} else {
							$where = "";
						}
					} else {
						$this->error_status = true;
					}
					break;
				case "location":
					if ($this->filter_locationLevel && is_numeric($this->filter_locationId)) {
						$where = "WHERE `email` != '' AND `$this->filter_locationLevel` = $this->filter_locationId";
					}
					break;
				default:
					$where = "WHERE `email` != ''";
					break;
			}
			
			if (!$this->error_status && $where) {
				$this->item_table = "`Listing`";
				$fields = "COUNT(DISTINCT(`email`)) AS `total`";

				$this->calcDataBlocks($fields, $where);
				$this->generateFields();

				if ($this->item_count) {
					
					$this->file_basename = string_strtolower($this->item_type);
					for ($b = 0; $b < $this->item_block; $b++) {
						if ($b > 0) $this->item_start += $this->item_end;
						else $this->item_start = $b;

						$this->file_path = $this->export_fileDir."/".$this->file_basename."_".$b.".".$this->file_extension;
						$fileHandle = fopen($this->file_path, "wb+");

						$sqlData = "SELECT 
										DISTINCT(`email`) 
									FROM $this->item_table 
									$where 
									ORDER BY `email`  
									LIMIT $this->item_start, $this->item_end";
						$resData = $dbDomain->Query($sqlData);
						$cslLine = "";
						while ($rowData = mysql_fetch_assoc($resData)) {
							$dataCSV = array_map("export_formatToCSV", $rowData);
							$cslLine .= $dataCSV["email"].";\n";
						}
						fwrite($fileHandle, $cslLine, strlen($cslLine));
						fclose($fileHandle);
					}
					$this->zipFile();
				}
			}
		}
		
		function generateModulesData () {
			$this->calcDataBlocks();
			$this->generateFields();

			if ($this->item_count) {
				$dbDomain = &$this->db_domainObj;

				$this->file_basename = string_strtolower($this->item_type);
				for ($b = 0; $b < $this->item_block; $b++) {
					if ($b > 0) $this->item_start += $this->item_end;
					else $this->item_start = $b;

					$this->file_path = $this->export_fileDir."/".$this->file_basename."_".$b.".".$this->file_extension;
					$fileHandle = fopen($this->file_path, "wb+");
					$cslLine = $this->fields_header;

					$sqlData = "SELECT 
									$this->fields_sql 
								FROM $this->item_table 
								ORDER BY {$this->fields_table[0]} 
								LIMIT $this->item_start, $this->item_end";
					$resData = $dbDomain->Query($sqlData);

					while ($rowData = mysql_fetch_assoc($resData)) {
						$dataCSV = array_map("export_formatToCSV", $rowData);
						$cslLine .= implode(",", $dataCSV)."\n";
					}
					fwrite($fileHandle, $cslLine, strlen($cslLine));
					fclose($fileHandle);
				}
				$this->zipFile();
			}
		}
		
		function generateListingData () {
			$this->calcDataBlocks();
			$this->generateFields();

			if ($this->item_count) {
				$dbDomain = &$this->db_domainObj;

				$this->file_basename = string_strtolower($this->item_type);

				$this->file_path = $this->export_fileDir."/".$this->file_basename."_".$this->item_step.".".$this->file_extension;
				$fileHandle = fopen($this->file_path, "wb+");
				$cslLine = $this->fields_header;

				$sqlData = "SELECT 
								$this->fields_sql 
							FROM $this->item_table 
							ORDER BY {$this->fields_table[0]} 
							LIMIT $this->item_start, $this->item_end";

				$resData = $dbDomain->Query($sqlData);

				while ($rowData = mysql_fetch_assoc($resData)) {
					$dataCSV = array_map("export_formatToCSV", $rowData);
					$cslLine .= implode(",", $dataCSV)."\n";

					$this->calculateProgress($rowData["id"]);
				}
				fwrite($fileHandle, $cslLine, strlen($cslLine));
				fclose($fileHandle);
				
				if ($this->item_current >= $this->item_count) $this->zipFile();
			}
		}
		
		function calculateProgress ($last_listing_id) {
			$this->progress_filepath = $this->export_fileDir."/".$this->progress_filename;
			
			$this->item_current++;
			$this->progress_value = floor(($this->item_current / $this->item_count) * 100);

			$progressHandle = fopen($this->progress_filepath, "w+");
			fwrite($progressHandle, $this->progress_value, strlen($this->progress_value));
			fclose($progressHandle);
			
			$dbMain = &$this->db_mainObj;
			
			if ($this->item_current >= $this->item_count) {
				$sqlField = "`running_cron`  = 'N', `finished` = 'Y', `scheduled` = 'N'";
			} else {
				$sqlField = "`running_cron`  = 'Y', `finished` = 'N', `scheduled` = 'Y'";
			}
			$sqlCron = "UPDATE `Control_Export_Listing` SET `last_listing_id` = $last_listing_id, `total_listing_exported` = $this->item_current, $sqlField WHERE `domain_id` = $this->domain_id AND `type` = 'csv - data'";
			$dbMain->Query($sqlCron);
		}
		
		function zipFile ($fileNames = false) {
			$zipObj = &$this->zip_obj;
			$this->zip_filename = $this->zip_filename ? $this->zip_filename : $this->file_basename.".zip";
			$this->zip_filepath = $this->export_fileDir."/".$this->zip_filename;
			
			$zipObj->setZipFile($this->zip_filepath);

			if ($fileNames && is_array($fileNames)) {
				foreach ($fileNames as $level => $files) {
					foreach ($files as $file) {
						$this->file_path = $this->export_fileDir."/".$file;
						$fileContent = file_get_contents($this->file_path);
						$zipObj->addFile($fileContent, $level."/".$file);
						unlink($this->file_path);
					}
				}
			} else {
				for ($b = 0; $b < $this->item_block; $b++) {
					$this->file_path = $this->export_fileDir."/".$this->file_basename."_".$b.".".$this->file_extension;
					$fileContent = file_get_contents($this->file_path);
					$zipObj->addFile($fileContent, $this->file_basename."_".$b.".".$this->file_extension);
					unlink($this->file_path);
				}
			}
			$zipObj->finalize();
		}
	}