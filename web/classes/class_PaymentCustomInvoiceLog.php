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
	# * FILE: /classes/class_PaymentCustomInvoiceLog.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name PaymentCustomInvoiceLog
	 * @method PaymentCustomInvoiceLog
	 * @method makeFromRow
	 * @method Save
	 * @access Public
	 */
	class PaymentCustomInvoiceLog extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $payment_log_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $custom_invoice_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $title;
		/**
		 * @var date
		 * @access Private
		 */
		var $date;
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
		 *		$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name PaymentCustomInvoiceLog
		 * @access Public
		 * @param integer $var
		 */
		function PaymentCustomInvoiceLog($var="", $domain_id = false) {
			$this->domain_id = $domain_id;
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Payment_CustomInvoice_Log WHERE payment_log_id = $var";
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
			$this->custom_invoice_id	= ($row["custom_invoice_id"])	? $row["custom_invoice_id"]	: ($this->custom_invoice_id	? $this->custom_invoice_id	: 0);
			$this->title				= ($row["title"])				? $row["title"]				: ($this->title				? $this->title				: "");
			$this->date					= ($row["date"])				? $row["date"]				: ($this->date				? $this->date				: 0);
			$this->items				= ($row["items"])				? $row["items"]				: ($this->items				? $this->items				: "");
			$this->items_price			= ($row["items_price"])			? $row["items_price"]		: ($this->items_price		? $this->items_price		: "");
			$this->amount				= ($row["amount"])				? $row["amount"]			: ($this->amount			? $this->amount				: 0);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$paymentCustomInvoiceLogObj->Save();
		 * <br /><br />
		 *		//Using this in PaymentCustomInvoiceLog() class.
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

			$sql = "INSERT INTO Payment_CustomInvoice_Log"
				. " (payment_log_id,"
				. " custom_invoice_id,"
				. " title,"
				. " date,"
				. " items,"
				. " items_price,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->payment_log_id,"
				. " $this->custom_invoice_id,"
				. " $this->title,"
				. " $this->date,"
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
