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
	# * FILE: /classes/class_SettingSocialNetwork.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 7.5.00
	 * @name SettingSociaNetwork
	 * @param integer $var
	 * @method SettingSociaNetwork
	 * @method makeFromRow
	 * @method setSectionSettings
	 * @method getSectionSettings
	 * @example 
	 * <code>
	 *		$socialObj = new SettingSocialNetwork($name)
	 * </code>
	 */
	class SettingSocialNetwork extends Handle {
		
		var $name;
		var $value;
		var $label;

		/**
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name SettingSociaNetwork($var)
		 * @param integer $var
		 * @example
		 * <code>
		 *		$socialObj = new SettingSocialNetwork($name)
		 * </code>
		 */
		function SettingSocialNetwork($var='') {
			if ($var) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				
				$sql = "SELECT * FROM Setting_Social_Network WHERE name = ".db_formatString($var);
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}
		}
		
		function makeFromRow($row='') {
			
			$row["name"]?		$this->name = $row["name"]:			$this->name = "";
			$row["value"]?		$this->value = $row["value"]:		$this->value = "";
			$row["label"]?		$this->label = $row["label"]:		$this->label = "";
			
		}

		function setSectionSettings($data) {
			if ($data) {
				extract($data);
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT name FROM Setting_Social_Network";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					if (${$row["name"]} == "")
						${$row["name"]} = "no";
					$sql = "UPDATE Setting_Social_Network SET value = '".${$row["name"]}."' WHERE name = '".$row["name"]."'";
					$dbObj->query($sql);
				}
			}
		}

		function getSectionSettings($section = "") {
			if ($section) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT name FROM Setting_Social_Network WHERE name LIKE '".$section."_%'";
				$result = $dbObj->query($sql);
				unset($sett);
				while ($row = mysql_fetch_array($result)) {
					$sett[] = new SettingSocialNetwork($row[0],$domain_id);
				}
				return $sett;
			} else {
				return false;
			}
		}
		
		function convertTableToArray(){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

            $sql = "SELECT * FROM Setting_Social_Network";
            $result = $dbObj->query($sql);
			if(mysql_num_rows($result)){
				unset($array_setting);
				$array_setting = array();
				while($row = mysql_fetch_assoc($result)){
					$array_setting[$row["name"]]["name"]	= $row["name"];
					$array_setting[$row["name"]]["value"]	= $row["value"];
					$array_setting[$row["name"]]["label"]	= $row["label"];
				}
				return $array_setting;
			}else{
				return false;
			}

		}
	}
	
?>