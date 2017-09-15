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
	# * FILE: /classes/class_Account_Activation.php
	# ----------------------------------------------------------------------------------------------------

    /**
	 * <code>
	 *		$acc_ActObj = new Account_Activation($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 9.8.20
	 * @package Classes
	 * @name Account_Activation
	 * @method Account_Activation
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method deletePerAccount
	 * @access Public
	 */
	class Account_Activation extends Handle {

        /**
		 * @var integer
		 * @access Private
		 */
		var $account_id;
        /**
		 * @var string
		 * @access Private
		 */
		var $unique_key;
        /**
		 * @var date
		 * @access Private
		 */
		var $entered;

        /**
		 * <code>
		 *		$acc_ActObj = new Account_Activation($id);
		 *		//OR
		 *		$acc_ActObj = new Account_Activation($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name Account_Activation
		 * @access Public
		 * @param mixed $var
		 */
		function Account_Activation($var='') {
			if (!is_array($var) && ($var)) {
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM Account_Activation WHERE unique_key = '$var'";
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
		function makeFromRow($row='') {
			$this->account_id = ($row["account_id"]) ? $row["account_id"] : ($this->account_id  ? $this->account_id : 0);
			$this->unique_key = ($row["unique_key"]) ? $row["unique_key"] : ($this->unique_key  ? $this->unique_key : "");
			$this->entered    = ($row["entered"])    ? $row["entered"]    : ($this->entered     ? $this->entered    : 0);
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$acc_ActObj->Save();
		 * <br /><br />
		 *		//Using this in Account_Activation() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name Save
		 * @access Public
		 */
		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject(DEFAULT_DB, true);

			$sql = "INSERT INTO Account_Activation"
				. " (account_id, unique_key, entered)"
				. " VALUES"
				. " ($this->account_id, $this->unique_key, $this->entered)";

			$dbObj->query($sql);
			$this->account_id = mysql_insert_id($dbObj->link_id);

			$this->prepareToUse();

		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$acc_ActObj->Delete();
		 * <br /><br />
		 *		//Using this in Account_Activation() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name Delete
		 * @access Public
		 */
		function Delete() {
			$dbObj = db_getDBObject(DEFAULT_DB, true);
			$sql = "DELETE FROM Account_Activation WHERE unique_key = ".db_formatString($this->unique_key)."";
			$dbObj->query($sql);
			$sql = "DELETE FROM Account_Activation WHERE account_id = ".db_formatNumber($this->account_id)."";
			$dbObj->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$acc_ActObj->deletePerAccount($account_id);
		 * <br /><br />
		 *		//Using this in Account_Activation() class.
		 *		$this->deletePerAccount($account_id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.8.20
		 * @name deletePerAccount
		 * @access Public
		 * @param integer $account_id
		 */
		function deletePerAccount($account_id = 0) {
            /**
             * <Lucas Trentim (2015)>
             * @todo: This should definitely be a static function.
             */
			if (is_numeric($account_id) && $account_id > 0) {
				$dbObj = db_getDBObject(DEFAULT_DB, true);

				$sql = "SELECT * FROM Account_Activation WHERE account_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete();
				}
			}
		}

	}