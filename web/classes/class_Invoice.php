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
	# * FILE: /classes/class_Invoice.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$invoiceObj = new Invoice($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Invoice
	 * @method Invoice
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @access Public
	 */

	class Invoice extends Handle {

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
		 * @var string
		 * @access Private
		 */
		var $username;
		/**
		 * @var string
		 * @access Private
		 */
		var $ip;
		/**
		 * @var date
		 * @access Private
		 */
		var $date;
		/**
		 * @var char
		 * @access Private
		 */
		var $status;
		/**
		 * @var real
		 * @access Private
		 */
		var $amount;
		/**
		 * @var integer
		 * @access Private
		 */
		var $tax_amount;
		/**
		 * @var real
		 * @access Private
		 */
		var $subtotal_amount;
		/**
		 * @var string
		 * @access Private
		 */
		var $currency;
		/**
		 * @var date
		 * @access Private
		 */
		var $expire_date;
		/**
		 * @var date
		 * @access Private
		 */
		var $payment_date;

		/**
		 * <code>
		 *		$invoiceObj = new Invoice($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Invoice
		 * @access Public
		 * @param integer $var
		 */
		function Invoice($var="") {

			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Invoice WHERE id = $var";
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

			$invoiceStatusObj = new InvoiceStatus();

			$this->id				= ($row["id"])				? $row["id"]				: ($this->id				? $this->id					: 0);
			$this->account_id		= ($row["account_id"])		? $row["account_id"]		: ($this->account_id		? $this->account_id			: 0);
			$this->username			= ($row["username"])		? $row["username"]			: ($this->username			? $this->username			: "");
			$this->ip				= ($row["ip"])				? $row["ip"]				: ($this->ip				? $this->ip					: "");
			$this->date				= ($row["date"])			? $row["date"]				: ($this->date				? $this->date				: "");
			$this->status			= ($row["status"])			? $row["status"]			: ($this->status			? $this->status				: $invoiceStatusObj->getDefaultStatus());
			$this->amount			= ($row["amount"])			? $row["amount"]			: ($this->amount			? $this->amount				: 0);
			$this->tax_amount		= ($row["tax_amount"])		? $row["tax_amount"]		: ($this->tax_amount		? $this->tax_amount			: 0);
			$this->subtotal_amount	= ($row["subtotal_amount"])	? $row["subtotal_amount"]	: ($this->subtotal_amount	? $this->subtotal_amount	: 0);
			$this->currency			= ($row["currency"])		? $row["currency"]			: ($this->currency			? $this->currency			: "");
			$this->expire_date		= ($row["expire_date"])		? $row["expire_date"]		: ($this->expire_date		? $this->expire_date		: "");
			$this->payment_date		= ($row["payment_date"])	? $row["payment_date"]		: ($this->payment_date		? $this->payment_date		: 0);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$invoiceObj->Save();
		 * <br /><br />
		 *		//Using this in Invoice() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save($updateDashboard = false) {

			$this->PrepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			if ($this->id) {

				$sql  = "UPDATE Invoice SET"
					. " account_id = $this->account_id,"
					. " username = $this->username,"
					. " ip = $this->ip,"
					. " date = $this->date,"
					. " status = $this->status,"
					. " amount = $this->amount,"
					. " tax_amount = $this->tax_amount,"
					. " subtotal_amount = $this->subtotal_amount,"
					. " currency = $this->currency,"
					. " expire_date = $this->expire_date,"
					. " payment_date = $this->payment_date"
					. " WHERE id = $this->id";
				
					$dbObj->query($sql);

					if ($this->status == "'R'" && $updateDashboard) {
                        $rowTimeline = array();
                        $rowTimeline["item_type"] = "invoice";
                        $rowTimeline["action"] = "new";
                        $rowTimeline["item_id"] = str_replace("'", "", $this->id);
                        $timelineObj = new Timeline($rowTimeline);
                        $timelineObj->save();
                    }

			} else {

				$sql = "INSERT INTO Invoice"
					. " (account_id,"
					. " username,"
					. " ip,"
					. " date,"
					. " status,"
					. " amount,"
					. " tax_amount,"
					. " subtotal_amount,"
					. " currency,"
					. " expire_date,"
					. " payment_date"
					. " )"
					. " VALUES"
					. " ("
					. " $this->account_id,"
					. " $this->username,"
					. " $this->ip,"
					. " $this->date,"
					. " $this->status,"
					. " $this->amount,"
					. " $this->tax_amount,"
					. " $this->subtotal_amount,"
					. " $this->currency,"
					. " $this->expire_date,"
					. " $this->payment_date"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->PrepareToUse();

		}
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$invoiceObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete(){
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
            $sql = "UPDATE Invoice SET hidden = 'y' WHERE id = ".$this->id;
            $dbObj->query($sql);
        }

	}

?>
