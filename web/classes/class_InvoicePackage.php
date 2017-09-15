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
	# * FILE: /classes/class_InvoicePackage.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$invoicePackageObj = new InvoicePackage($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name InvoicePackage
	 * @access Public
	 */
	class InvoicePackage extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $invoice_id;
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
		 * @var char
		 * @access Private
		 */
		var $renewal_period;

		/**
		 * <code>
		 *		$invoicePackageObj = new InvoicePackage($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name InvoicePackage
		 * @access Public
		 * @param integer $var
		 */
		function InvoicePackage($var="") {
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
			$this->package_id			= ($row["package_id"])			? $row["package_id"]		: ($this->package_id		? $this->package_id	: 0);
			$this->package_title		= ($row["package_title"])		? $row["package_title"]		: ($this->package_title		? $this->package_title		: 0);
			$this->items				= ($row["items"])				? $row["items"]				: ($this->items				? $this->items				: 0);
			$this->items_price			= ($row["items_price"])			? $row["items_price"]		: ($this->items_price		? $this->items_price		: 0);
			$this->subtotal				= ($row["subtotal"])			? $row["subtotal"]			: ($this->subtotal			? $this->subtotal			: 0);
			$this->tax					= ($row["tax"])					? $row["tax"]				: ($this->tax				? $this->tax				: 0);
			$this->amount				= ($row["amount"])				? $row["amount"]			: ($this->amount			? $this->amount				: 0);
			$this->renewal_period		= ($row["renewal_period"])		? $row["renewal_period"]	: ($this->renewal_period	? $this->renewal_period		: "M");
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$invoicePackageObj->Save();
		 * <br /><br />
		 *		//Using this in InvoicePackage() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
            $this->renewal_period = ($this->renewal_period == "monthly") ? "M" : "Y";

			$this->PrepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$sql = "INSERT INTO Invoice_Package"
				. " (invoice_id,"
				. " package_id,"
				. " package_title,"
				. " items,"
				. " items_price,"
				. " subtotal,"
				. " tax,"
				. " renewal_period,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->invoice_id,"
				. " $this->package_id,"
				. " $this->package_title,"
				. " $this->items,"
				. " $this->items_price,"
				. " $this->subtotal,"
				. " $this->tax,"
				. " $this->renewal_period,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}

?>
