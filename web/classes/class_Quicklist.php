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
	# * FILE: /classes/class_Quicklist.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$quicklistObj = new Quicklist($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 7.5.00
	 * @package Classes
	 * @name Quicklist
	 * @access Public
	 * @method Quicklist
	 * @method makeFromRow
	 * @method Add
	 * @method Delete
	 */
	class Quicklist extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $account_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $item_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $item_type;

		/**
		 * <code>
		 *		$quicklistObj = new Quicklist($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Quicklist
		 * @access Public
		 * @param mixed $var
		 */
		function Quicklist($var='', $account_id='', $item_id='', $item_type='') {
			if (is_numeric($var) && ($var) && !$account_id && !$item_id & !$item_type) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Quicklist WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else if (!is_numeric($var) && (!$var) && !$account_id && !$item_id & !$item_type)  {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			} else if (is_numeric($account_id) && $account_id != 0 && is_numeric($item_id) && $item_id != 0 && $item_type) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Quicklist WHERE account_id = $account_id AND item_id = $item_id AND item_type = '".$item_type."'";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name makeFromRow
		 * @access Private
		 * @param array $row
		 */
		function makeFromRow($row='') {
			if ($row['id']) $this->id = $row['id'];
			else if (!$this->id) $this->id = 0;
			if ($row['account_id']) $this->account_id = $row['account_id'];
			else if (!$this->account_id) $this->account_id = 0;
			if ($row['item_id']) $this->item_id = $row['item_id'];
			else if (!$this->item_id) $this->item_id = 0;
			if ($row['item_type']) $this->item_type = $row['item_type'];
			else if (!$this->item_type) $this->item_type = "";
			
		}

		function getQuicklist($from = "all", $acc = 0) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);

			if (is_numeric($acc)) {
				if ($from == "all") {
					$sql = "SELECT * FROM Quicklist WHERE id = $acc";
				} else if ($from == "article" || $from == "classified" || $from == "event" || $from == "listing" || $from == "promotion") {
					$sql = "SELECT item_id FROM Quicklist WHERE account_id = $acc AND item_type = '".$from."'";
				}

				$result = $dbObj->Query($sql);

				unset($items);
				while ($row = mysql_fetch_array($result)) {
					$items .= $row["item_id"].",";
				}

				$items = string_substr($items, 0, -1);

				return $items;
			} else {
				return null;
			}
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$quicklistObj->Add();
		 * <br /><br />
		 *		//Using this in Quicklist() class.
		 *		$this->Add();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Add
		 * @access Public
		 */
		function Add() {
			$this->prepareToSave();
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			
			if ($this->account_id && $this->item_id && $this->item_type) {
				$sql = "INSERT INTO Quicklist (account_id, item_id, item_type) VALUES
						($this->account_id, $this->item_id, $this->item_type);";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}

			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$quicklistObj->Delete();
		 * <br /><br />
		 *		//Using this in Quicklist() class.
		 *		$this->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {
			$dbObj = db_getDBObject();

			/**
			* Deleting this object
			**/
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Quicklist WHERE id = $this->id";
			$dbObj->query($sql);
		}
	}
?>