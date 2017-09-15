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
	# * FILE: /classes/class_setting.php
	# ----------------------------------------------------------------------------------------------------

	class Setting extends Handle {

		var $name;
		var $value;
		var $in_main_db = Array("sitemgr_username",
							    "sitemgr_password",
			                    "sitemgr_faillogin_count",
			                    "sitemgr_faillogin_datetime",
			                    "sitemgr_first_login",
			                    "sitemgr_language",
                                "loaded_locations",
                                "added_location_manually",
			                    "complementary_info");

		function Setting($var='') {
			if ($var) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (in_array($var, $this->in_main_db)) {
					$db = $dbMain;
				} else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);

				$sql = "SELECT * FROM Setting WHERE name = ".db_formatString($var);
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

			$this->name		= ($row["name"])	? $row["name"]	: ($this->name	? $this->name	: 0);
			$this->value	= ($row["value"])	? $row["value"]	: "";

		}

		function Save($update = true) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (in_array($this->name, $this->in_main_db)) {
				$dbObj = $dbMain;
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);

			$this->prepareToSave();

			if ($update) {

				$sql = "UPDATE Setting SET"
					. " value      = $this->value"
					. " WHERE name = $this->name";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Setting"
					. " (name,"
					. " value)"
					. " VALUES"
					. " ($this->name,"
					. " $this->value)";

				$dbObj->query($sql);

			}

			$this->prepareToUse();
			setting_constants();

		}

		function Delete() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (in_array($this->name, $this->in_main_db)) {
				$dbObj = $dbMain;
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$sql = "DELETE FROM Setting WHERE name = ".db_formatString($this->name);
			$dbObj->query($sql);
			if (mysql_affected_rows($dbObj->link_id)) {
				setting_constants();
				return true;
			}
			return false;
		}

		function convertTableToArray(){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

            $sql    = "SELECT * FROM Setting";
            $result = $dbObj->query($sql);
			if(mysql_num_rows($result)){
				unset($array_setting);
				$array_setting = array();
				while($row = mysql_fetch_assoc($result)){
					$array_setting[$row["name"]]["name"]	= $row["name"];
					$array_setting[$row["name"]]["value"]	= $row["value"];
				}
				return $array_setting;
			}else{
				return false;
			}

		}

	}

?>
