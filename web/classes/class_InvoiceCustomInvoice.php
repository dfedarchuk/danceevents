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
	# * FILE: /classes/class_InvoiceCustomInvoice.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$invoiceCustomInvoiceObj = new InvoiceCustomInvoice($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name InvoiceCustomInvoice
	 * @method InvoiceCustomInvoice
	 * @method makeFromRow
	 * @method Save
	 * @access Public
	 */
	class InvoiceCustomInvoice extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $invoice_id;
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
		 * @var test
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
		var $subtotal;
		/**
		 * @var integer
		 * @access Private
		 */
		var $tax;
		/**
		 * @var real
		 * @access Private
		 */
		var $amount;

		/**
		 * <code>
		 *		$invoiceCustomInvoiceObj = new InvoiceCustomInvoice($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name InvoiceCustomInvoice
		 * @access Public
		 * @param integer $var
		 */
		function InvoiceCustomInvoice($var="") {
			if (is_array($var) && ($var)) $this->makeFromRow($var);
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
			$this->invoice_id			= ($row["invoice_id"])			? $row["invoice_id"]		: ($this->invoice_id		? $this->invoice_id			: 0);
			$this->custom_invoice_id	= ($row["custom_invoice_id"])	? $row["custom_invoice_id"]	: ($this->custom_invoice_id	? $this->custom_invoice_id	: 0);
			$this->title				= ($row["title"])				? $row["title"]				: ($this->title				? $this->title				: 0);
			$this->date					= ($row["date"])				? $row["date"]				: ($this->date				? $this->date				: 0);
			$this->items				= ($row["items"])				? $row["items"]				: ($this->items				? $this->items				: 0);
			$this->items_price			= ($row["items_price"])			? $row["items_price"]		: ($this->items_price		? $this->items_price		: 0);
			$this->subtotal				= ($row["subtotal"])			? $row["subtotal"]			: ($this->subtotal			? $this->subtotal			: 0);
			$this->tax					= ($row["tax"])					? $row["tax"]				: ($this->tax				? $this->tax				: 0);
			$this->amount				= ($row["amount"])				? $row["amount"]			: ($this->amount			? $this->amount				: 0);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$invoiceCustomInvoiceObj->Save();
		 * <br /><br />
		 *		//Using this in InvoiceCustomInvoice() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {

			$this->PrepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);

			$sql = "INSERT INTO Invoice_CustomInvoice"
				. " (invoice_id,"
				. " custom_invoice_id,"
				. " title,"
				. " date,"
				. " items,"
				. " items_price,"
				. " subtotal,"
				. " tax,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->invoice_id,"
				. " $this->custom_invoice_id,"
				. " $this->title,"
				. " $this->date,"
				. " $this->items,"
				. " $this->items_price,"
				. " $this->subtotal,"
				. " $this->tax,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}

?>
