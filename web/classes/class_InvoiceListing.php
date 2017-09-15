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
	# * FILE: /classes/class_InvoiceListing.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$invoiceListingObj = new InvoiceListing($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name InvoiceListing
	 * @access Public
	 */
	class InvoiceListing extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $invoice_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $listing_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $listing_title;
		/**
		 * @var string
		 * @access Private
		 */
		var $discount_id;
		/**
		 * @var integer
		 * @access Private
		 */
        var $level;
		/**
		 * @var string
		 * @access Private
		 */
		var $level_label;
		/**
		 * @var date
		 * @access Private
		 */
		var $renewal_date;
		/**
		 * @var integer
		 * @access Private
		 */
		var $categories;
		/**
		 * @var integer
		 * @access Private
		 */
		var $extra_categories;
		/**
		 * @var string
		 * @access Private
		 */
		var $listingtemplate_title;
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
		 *		$invoiceListingObj = new InvoiceListing($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name InvoiceListing
		 * @access Public
		 * @param integer $var
		 */
		function InvoiceListing($var="") {
			if (is_array($var) && ($var))
				$this->makeFromRow($var);
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

			$this->invoice_id				= ($row["invoice_id"])				? $row["invoice_id"]			: ($this->invoice_id			? $this->invoice_id				: 0);
			$this->listing_id				= ($row["listing_id"])				? $row["listing_id"]			: ($this->listing_id			? $this->listing_id				: 0);
			$this->listing_title			= ($row["listing_title"])			? $row["listing_title"]			: ($this->listing_title			? $this->listing_title			: "");
			$this->discount_id				= ($row["discount_id"])				? $row["discount_id"]			: ($this->discount_id			? $this->discount_id			: "");
            $this->level                    = ($row["level"])                   ? $row["level"]                 : ($this->level                 ? $this->level                  : 0);
			$this->level_label				= ($row["level_label"])				? $row["level_label"]			: ($this->level_label			? $this->level_label			: "");
			$this->renewal_date				= ($row["renewal_date"])			? $row["renewal_date"]			: ($this->renewal_date			? $this->renewal_date			: 0);
			$this->renewal_period			= ($row["renewal_period"])			? $row["renewal_period"]		: ($this->renewal_period		? $this->renewal_period			: "M");
			$this->categories				= ($row["categories"])				? $row["categories"]			: ($this->categories			? $this->categories				: 0);
			$this->extra_categories			= ($row["extra_categories"])		? $row["extra_categories"]		: ($this->extra_categories		? $this->extra_categories		: 0);
			$this->listingtemplate_title	= ($row["listingtemplate_title"])	? $row["listingtemplate_title"]	: ($this->listingtemplate_title	? $this->listingtemplate_title	: "");
			$this->amount					= ($row["amount"])					? $row["amount"]				: ($this->amount				? $this->amount					: 0);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$invoiceListingObj->Save();
		 * <br /><br />
		 *		//Using this in InvoiceListing() class.
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
//			$dbMain->close();
			unset($dbMain);

			$sql = "INSERT INTO Invoice_Listing"
				. " (invoice_id,"
				. " listing_id,"
				. " listing_title,"
				. " discount_id,"
                . " level,"
				. " level_label,"
				. " renewal_date,"
				. " renewal_period,"
				. " categories,"
				. " extra_categories,"
				. " listingtemplate_title,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->invoice_id,"
				. " $this->listing_id,"
				. " $this->listing_title,"
				. " $this->discount_id,"
                . " $this->level,"
				. " $this->level_label,"
				. " $this->renewal_date,"
				. " $this->renewal_period,"
				. " $this->categories,"
				. " $this->extra_categories,"
				. " $this->listingtemplate_title,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}
?>
