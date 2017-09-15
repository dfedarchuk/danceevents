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
	# * FILE: /classes/class_forgotPassword.php
	# ----------------------------------------------------------------------------------------------------

	class forgotPassword extends Handle {

		var $account_id;
		var $unique_key;
		var $entered;
		var $section;

		function forgotPassword($var='') {
			if (!is_array($var) && ($var)) {
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM Forgot_Password WHERE unique_key = '$var'";
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
			$this->account_id = ($row["account_id"]) ? $row["account_id"] : ($this->account_id  ? $this->account_id : 0);
			$this->unique_key = ($row["unique_key"]) ? $row["unique_key"] : ($this->unique_key  ? $this->unique_key : "");
			$this->entered    = ($row["entered"])    ? $row["entered"]    : ($this->entered     ? $this->entered    : 0);
			$this->section    = ($row["section"])    ? $row["section"]    : ($this->section     ? $this->section    : "");
		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject(DEFAULT_DB, true);

			$sql = "INSERT INTO Forgot_Password"
				. " (account_id, unique_key, entered, section)"
				. " VALUES"
				. " ($this->account_id, $this->unique_key, $this->entered, $this->section)";

			$dbObj->query($sql);
			$this->account_id = mysql_insert_id($dbObj->link_id);

			$this->prepareToUse();

		}

		function Delete() {
			$dbObj = db_getDBObJect(DEFAULT_DB, true);
			$sql = "DELETE FROM Forgot_Password WHERE unique_key = ".db_formatString($this->unique_key)."";
			$dbObj->query($sql);
			$sql = "DELETE FROM Forgot_Password WHERE section = ".db_formatString($this->section)." AND account_id = ".db_formatNumber($this->account_id)."";
			$dbObj->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$fgtPassObj->deletePerAccount($account_id);
		 * <br /><br />
		 *		//Using this in ForgotPassword() class.
		 *		$this->deletePerAccount($account_id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name deletePerAccount
		 * @access Public
		 * @param integer $account_id
		 */
		function deletePerAccount($account_id = 0) {
			if (is_numeric($account_id) && $account_id > 0) {
				$dbObj = db_getDBObject(DEFAULT_DB, true);

				$sql = "SELECT * FROM Forgot_Password WHERE account_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete();
				}
			}
		}

	}

?>