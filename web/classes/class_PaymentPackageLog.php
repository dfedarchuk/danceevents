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
	# * FILE: /classes/class_PaymentPackageLog.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$paymentPackageLogObj = new PaymentPackageLog($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name PaymentPackageLog
	 * @method PaymentPackageLog
	 * @method makeFromRow
	 * @method Save
	 * @access Public
	 */
	class PaymentPackageLog extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $payment_log_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $package_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $package_title;
		/**
		 * @var string
		 * @access Private
		 */
		var $items;
		/**
		 * @var string
		 * @access Private
		 */
		var $items_price;
		/**
		 * @var real
		 * @access Private
		 */
		var $amount;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;

		/**
		 * <code>
		 *		$paymentPackageLogObj = new PaymentPackageLog($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name PaymentPackageLog
		 * @access Public
		 * @param integer $var
		 */
		function PaymentPackageLog($var="", $domain_id = false) {
			$this->domain_id = $domain_id;
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Payment_Package_Log WHERE payment_log_id = $var";
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
		 * @version 8.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row="") {

			$this->payment_log_id		= ($row["payment_log_id"])		? $row["payment_log_id"]	: ($this->payment_log_id	? $this->payment_log_id		: 0);
			$this->package_id			= ($row["package_id"])			? $row["package_id"]		: ($this->package_id		? $this->package_id	: 0);
			$this->package_title		= ($row["package_title"])		? $row["package_title"]		: ($this->package_title		? $this->package_title      : "");
			$this->items				= ($row["items"])				? $row["items"]				: ($this->items				? $this->items				: "");
			$this->items_price			= ($row["items_price"])			? $row["items_price"]		: ($this->items_price		? $this->items_price		: "");
			$this->amount				= ($row["amount"])				? $row["amount"]			: ($this->amount			? $this->amount				: 0);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$paymentPackageLogObj->Save();
		 * <br /><br />
		 *		//Using this in PaymentPackageLog() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			$this->PrepareToSave();

			$sql = "INSERT INTO Payment_Package_Log"
				. " (payment_log_id,"
				. " package_id,"
				. " package_title,"
				. " items,"
				. " items_price,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->payment_log_id,"
				. " $this->package_id,"
				. " $this->package_title,"
				. " $this->items,"
				. " $this->items_price,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}

?>
