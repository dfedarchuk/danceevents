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
	# * FILE: /classes/class_MailAppList.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$mailappObj = new MailAppList($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 9.8.20
	 * @package Classes
	 * @name MailAppList
	 * @method MailAppList
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method exportList
	 * @method updateProgress
	 * @access Public
	 */

	class MailAppList extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var string
		 * @access Private
		 */
		var $title;
		/**
		 * @var char
		 * @access Private
		 */
		var $status;
		/**
		 * @var string
		 * @access Private
		 */
		var $filename;
		/**
		 * @var string
		 * @access Private
		 */
		var $categories;
		/**
		 * @var char
		 * @access Private
		 */
		var $progress;
        /**
		 * @var integer
		 * @access Private
		 */
		var $total_item_exported;
        /**
		 * @var integer
		 * @access Private
		 */
		var $last_account_exported;
		/**
		 * @var datetime
		 * @access Private
		 */
		var $date;
        /**
		 * @var string
		 * @access Private
		 */
        var $useCron;
        

		/**
		 * <code>
		 *		$mailappObj = new MailAppList($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name MailAppList
		 * @access Public
		 * @param integer $var
		 */
		function MailAppList($var="", $domain_id = false) {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$this->domain_id = $domain_id;
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				} elseif (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM MailAppList WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));

				$this->makeFromRow($row);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}
		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row="") {

            setting_get("mailapp_via_cron", $mailapp_via_cron);
            
			$this->id                       = ($row["id"])                      ? $row["id"]                        : ($this->id                        ? $this->id                     : 0);
            $this->title                    = ($row["title"])                   ? $row["title"]                     : ($this->title                     ? $this->title                  : "");
            $this->status                   = ($row["status"])                  ? $row["status"]                    : ($this->status                    ? $this->status                 : "P");
            $this->filename                 = ($row["filename"])                ? $row["filename"]                  : ($this->filename                  ? $this->filename               : "");
            $this->categories               = ($row["categories"])              ? $row["categories"]                : ($this->categories                ? $this->categories             : "");
			$this->progress                 = ($row["progress"])                ? $row["progress"]                  : ($this->progress                  ? $this->progress               : "0");
            $this->total_item_exported      = ($row["total_item_exported"])     ? $row["total_item_exported"]       : ($this->total_item_exported       ? $this->total_item_exported    : 0);
            $this->last_account_exported    = ($row["last_account_exported"])   ? $row["last_account_exported"]     : ($this->last_account_exported     ? $this->last_account_exported  : 0);
            $this->date                     = ($row["date"])                    ? $row["date"]                      : ($this->date                      ? $this->date                   : "");
            $this->useCron                  = ($mailapp_via_cron                ? "y"                               : "n");
            
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$mailappObj->Save();
		 * <br /><br />
		 *		//Using this in MailAppList() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name Save
		 * @access Public
		 */
		function Save() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else	if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			$this->prepareToSave();

			if ($this->id) {

				$this_status = $this->status;
				$this_id = $this->id;

				$sql = "UPDATE MailAppList SET"
                               ." title                  = $this->title,"
                               ." status                 = $this->status,"
                               ." filename               = $this->filename,"
                               ." categories             = $this->categories,"
                               ." progress               = $this->progress"
                               ." WHERE id               = $this->id";

				$dbObj->query($sql);


			} else {
                
				$sql = "INSERT INTO MailAppList"
					. " (title,"
					. " status,"
					. " filename,"
					. " categories,"
                    . " progress,"
                    . " date)"
					. " VALUES"
					. " ($this->title,"
					. " $this->status,"
					. " $this->filename,"
					. " $this->categories,"
					. " $this->progress,"
                    . " NOW())";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

            //Import Schedule
            if ($this->useCron == "'y'") {
                $sqlCron = "UPDATE `Control_Export_MailApp` SET `scheduled` = 'Y' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
                $dbMain->query($sqlCron);
            }

			$this->prepareToUse();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$mailappObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name Delete
		 * @access Public
		 * @param integer $domain_id
		 */
		function Delete($domain_id = false) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
			}
            
            if ($this->status != "R") {
            
                ## Export list file
                $filePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files/".$this->filename;
                if (file_exists($filePath)) {
                    if (unlink($filePath)) {
                        $deleted = true;
                    }
                }

                ### MailAppList
                $sql = "DELETE FROM MailAppList WHERE id = $this->id";
                $dbObj->query($sql);

                ### Control_Export_MailApp
                if ($this->useCron == "y") {
                    $sqlLog = "SELECT COUNT(id) AS total FROM `MailAppList` WHERE `status` = 'P'";
                    $resLog = $dbObj->query($sqlLog);
                    $rowLog = mysql_fetch_assoc($resLog);
                    if ($rowLog["total"] > 0) {
                        $sqlCron = "UPDATE `Control_Export_MailApp` SET `scheduled` = 'Y', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
                    } else {
                        $sqlCron = "UPDATE `Control_Export_MailApp` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
                    }
                    $dbMain->query($sqlCron);
                }
                
            }

		}
        
        /**
		 * <code>
		 *		//Using this in crons.
		 *		$mailappObj->exportList();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name exportList
		 * @access Public
		 */
        function exportList($domain_id = false, $last_export_log = 0, $inCron = true, $exportID = false) {
            
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
			}
            
            $export_stop = false;
            $newExport = false;
            
            if (!$exportID) {
                //Check if need to continue a stopped export
                $sql = "SELECT id FROM MailAppList WHERE status = 'R' AND id = ".$last_export_log;
                $result = $dbObj->query($sql);
                if (!mysql_num_rows($result)) {
                    $newExport = true;
                }

                if ($newExport) {
                    $sql = "SELECT id FROM MailAppList WHERE status = 'P' ORDER BY id LIMIT 1";
                    $result = $dbObj->query($sql);
                    if (mysql_num_rows($result) > 0) {
                        $row = mysql_fetch_assoc($result);
                        $exportlog_id = $row["id"];
                        $sql = "UPDATE MailAppList SET status = 'R' WHERE id = ".$exportlog_id;
                        $dbObj->query($sql);
                    } else {
                        $export_stop = true;
                    }
                }
            } else {
                $newExport = true;
                $exportlog_id = $exportID;
            }
            
            if (!$export_stop) {
                $sql = "SELECT * FROM MailAppList WHERE ".($exportID ? "id = $exportID" : "status = 'R'")." ORDER BY id LIMIT 1";
                $result = $dbObj->query($sql);
                
                if (mysql_num_rows($result) > 0) {

                    $row = mysql_fetch_assoc($result);
                    $exportlog_id = $row["id"];
                    $filename = $row["filename"];
                    
                    $aux_add_header = true;
					if (!$newExport) {
						$aux_add_header = false;
					}
                    
                    //Writing header
                    if ($aux_add_header) {
                
                        $export_header = "First Name,Last Name,Email Address\n";
                                               
                        //Aux to start new process
                        $aux_total_item = 0;
                        
                        if (!$handle = fopen(EXPORT_FOLDER."/".$filename, "a")) {
                            $this->updateError($exportlog_id);
                            $export_stop = true;
                        }

                        if (fwrite($handle, $export_header) === false) {
                            $this->updateError($exportlog_id);
                            $export_stop = true;
                        }
                        
                    } else {
                        //Aux to start new process
                        $aux_total_item = $row["total_item_exported"];

                        if (!$handle = fopen(EXPORT_FOLDER."/".$filename, "a")) {
                            $this->updateError($exportlog_id);
                            $export_stop = true;
                        }
                    }
                    
                    if (!$export_stop) {
                        
                        $i = $aux_total_item;
                        
                        $categoriesStr = $row["categories"];

                        if ($categoriesStr) {
                            
                            $categoriesArray = explode(",", $categoriesStr);
                            if (string_strpos($categoriesStr, "listing") !== false) {
                                $catObj = new ListingCategory();
                            }
                            $queries = array();
                        
                            foreach ($categoriesArray as $category) {

                                unset($exportCategory, $sql);
                                $exportCategory = explode("_", $category);
                                $table = ucfirst($exportCategory[0]);

                                if ($table == "Listing") {

                                    $sql = "SELECT DISTINCT(`account_id`) FROM Listing WHERE";

                                    $parents_category_ids = $catObj->getHierarchy($exportCategory[1], $get_parents = true, $get_children = false);
                                    $parents_category_ids .= ",".$catObj->getHierarchy($exportCategory[1], $get_parents = false, $get_children = true);

                                    $sqlC = "SELECT 
                                            DISTINCT Listing.id 
                                            FROM 
                                            Listing 
                                            INNER JOIN Listing_Category ON (Listing.id = Listing_Category.listing_id) 
                                            WHERE
                                            Listing_Category.category_id IN (".$parents_category_ids.")
                                            ";
                                    $rs = $dbObj->query($sqlC);
                                    $listing_ids_from_category = array();
                                    while ($rowCateg = mysql_fetch_assoc($rs)) {
                                        $listing_ids_from_category[] = $rowCateg["id"];
                                    }
                                    $category_listing_ids = (count($listing_ids_from_category) > 0) ? implode(",", $listing_ids_from_category) : "'0'";

                                    $sql .=  "`id` IN ($category_listing_ids)";

                                } else {

                                    $sql = "SELECT DISTINCT(`account_id`) FROM $table WHERE";

                                    $sql .= "($table.cat_1_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_1_level1_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_1_level2_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_1_level3_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_1_level4_id = ".$exportCategory[1]." OR 
                                                    $table.cat_2_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_2_level1_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_2_level2_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_2_level3_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_2_level4_id = ".$exportCategory[1]." OR 
                                                    $table.cat_3_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_3_level1_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_3_level2_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_3_level3_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_3_level4_id = ".$exportCategory[1]." OR 
                                                    $table.cat_4_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_4_level1_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_4_level2_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_4_level3_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_4_level4_id = ".$exportCategory[1]." OR 
                                                    $table.cat_5_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_5_level1_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_5_level2_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_5_level3_id = ".$exportCategory[1]." OR 
                                                    $table.parcat_5_level4_id = ".$exportCategory[1].")";

                                }
                                
                                $queries[] = $sql;
                            }
                        } else {
                            
                            $queries[] = "SELECT DISTINCT(`account_id`) FROM Listing WHERE account_id != 0";
                            
                            if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
                                $queries[] = "SELECT DISTINCT(`account_id`) FROM Event WHERE account_id != 0";
                            }
                            
                            if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
                                $queries[] = "SELECT DISTINCT(`account_id`) FROM Classified WHERE account_id != 0";
                            }
                            
                            if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
                                $queries[] = "SELECT DISTINCT(`account_id`) FROM Article WHERE account_id != 0";
                            }
                            
                        }
                        
                        //Get account_id
                        unset($account_sql);
                        $account_ids = array();
                        for ($j = 0; $j < count($queries); $j++) {

                            if ($j > 0) {
                                $account_sql .= " UNION ";
                            }
                            $account_sql .= $queries[$j];

                        }

                        $result = $dbObj->query($account_sql);
                        if (mysql_num_rows($result) > 0) {
                            while ($rowAc = mysql_fetch_assoc($result)) {
                                $account_ids[] = $rowAc["account_id"];
                            }
                        } else {
                            $account_ids[] = "0";
                        }
                        
                        $sqlCount = "SELECT COUNT(id) as `total` FROM Account WHERE id IN (".(implode(",", $account_ids)).")";
                        $result_count = $dbMain->query($sqlCount);

                        if ($result_count) {
                            if ($row_count = mysql_fetch_assoc($result_count)) {
                                $item_amount = $row_count["total"];
                            }
                        } else {
                            $item_amount = 0;
                        }
                        
                        $sql = "SELECT account_id, first_name, last_name, email FROM Contact WHERE account_id IN (".(implode(",", $account_ids)).") AND account_id > ".$row["last_account_exported"]." ORDER BY account_id ".($inCron ? "LIMIT ".EXPORT_MAIL_BLOCK : "");
                        $result = $dbMain->query($sql);
                                                
                        if ($result && $item_amount) {

                            while (($row = mysql_fetch_assoc($result)) && ($i <= $item_amount) && !$export_stop) {
                                
                                $first_name = "";
                                $last_name = "";
                                $email = "";
                                                                
                                $first_name = export_formatToCSV($row["first_name"]);
                                $last_name = export_formatToCSV($row["last_name"]);
                                $email = export_formatToCSV($row["email"]);
                                
                                $this_item_line = "".$first_name.",".$last_name.",".$email."\n";
                                
                                if (fwrite($handle, $this_item_line) === false) {
                                    $this->updateError($exportlog_id);
                                    $export_stop = true;
                                }
                                
                                $this->updateProgress($exportlog_id, floor($i/$item_amount*100));
                                
                                $i++;
                                
                                $sql = "UPDATE MailAppList SET total_item_exported = total_item_exported + 1, last_account_exported = ".$row["account_id"]." WHERE id = $exportlog_id";
                                $dbObj->query($sql);
                                
                            }
                            
                            if ($i >= $item_amount) {
                                $this->updateProgress($exportlog_id, 100);
                            } else {
                                $needToContinue = true;
                            }
                        } else {
                            $this->updateProgress($exportlog_id, 100);
                        }
                    }
                }
            }
            
            $sqlLog = "SELECT COUNT(id) AS total FROM `MailAppList` WHERE `status` = 'P'";
            $resLog = $dbObj->query($sqlLog);
            $rowLog = mysql_fetch_assoc($resLog);

            if ($inCron) {
                if ($rowLog["total"] > 0 || ($needToContinue && !$export_stop) && $exportlog_id) {
                    $sqlCron = "UPDATE `Control_Export_MailApp` SET `scheduled` = 'Y', `running` = 'N', `last_exportlog` = $exportlog_id WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
                } else {
                    $sqlCron = "UPDATE `Control_Export_MailApp` SET `scheduled` = 'N', `running` = 'N', `last_exportlog` = $exportlog_id WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
                }
                $dbMain->query($sqlCron);
            }
            
        }
        
        function updateProgress($logID, $progress) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
             
            $sql = "UPDATE MailAppList SET progress = $progress".($progress == "100" ? ", status = 'F'" : "")." WHERE id = ".$logID;
            $dbObj->query($sql);
                        
        }
        
        function updateError($logID) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
             
            $sql = "UPDATE MailAppList SET status = 'E' WHERE id = ".$logID;
            $dbObj->query($sql);
        }
        
	}
?>