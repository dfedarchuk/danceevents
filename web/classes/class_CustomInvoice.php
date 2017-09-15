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
	# * FILE: /classes/class_customInvoice.php
	# ----------------------------------------------------------------------------------------------------

	class CustomInvoice extends Handle {

		var $id;
		var $account_id;
		var $title;
		var $date;
		var $sent_date;
		var $amount;
		var $paid;
		var $sent;
		var $completed;

		function CustomInvoice($var="", $domain_id = false) {

			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$this->domain_id = $domain_id;
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				}else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM CustomInvoice WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));

				$this->old_account_id = $row["account_id"];

				$this->makeFromRow($row);
				unset($db);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}

		}

		function makeFromRow($row="") {

			$this->id			= ($row["id"])			? $row["id"]			: ($this->id			? $this->id			: 0);
			$this->account_id	= ($row["account_id"])	? $row["account_id"]	: ($this->account_id	? $this->account_id	: 0);
			$this->title		= ($row["title"])		? $row["title"]			: ($this->title			? $this->title		: 0);
			$this->date			= ($row["date"])		? $row["date"]			: ($this->date			? $this->date		: "");
			$this->sent_date	= ($row["sent_date"])	? $row["sent_date"]		: ($this->sent_date		? $this->sent_date	: "");
			$this->subtotal		= ($row["subtotal"])	? $row["subtotal"]		: ($this->subtotal		? $this->subtotal	: 0);
			$this->tax			= ($row["tax"])			? $row["tax"]			: ($this->tax			? $this->tax		: 0);
			$this->amount		= ($row["amount"])		? $row["amount"]		: ($this->amount		? $this->amount		: 0);
			$this->paid			= ($row["paid"])		? $row["paid"]			: ($this->paid			? $this-paid		: "");
			$this->sent			= ($row["sent"])		? $row["sent"]			: ($this->sent			? $this->sent		: "");
			$this->completed	= ($row["completed"])	? $row["completed"]		: ($this->completed		? $this->completed	: "y");

		}

		function Save() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else	if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$this->prepareToSave();

			$aux_old_account = str_replace("'", "", $this->old_account_id);
			$aux_account = str_replace("'", "", $this->account_id);

			if ($this->id) {

				$sql  = "UPDATE CustomInvoice SET"
					. " account_id = $this->account_id,"
					. " title = $this->title,"
					. " date = NOW(),"
					. " sent_date = $this->sent_date,"
					. " subtotal = $this->subtotal,"
					. " tax = $this->tax,"
					. " amount = $this->amount,"
					. " paid = $this->paid,"
					. " sent = $this->sent,"
					. " completed = $this->completed"
					. " WHERE id = $this->id";
				$dbObj->query($sql);

				if ($aux_old_account != $aux_account && $aux_account != 0) {
					$accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($aux_account, $this);
				}

			} else {

				$sql = "INSERT INTO CustomInvoice"
					. " (account_id,"
					. " title,"
					. " date,"
					. " sent_date,"
					. " subtotal,"
					. " tax,"
					. " amount,"
					. " paid,"
					. " sent,"
					. " completed"
					. " )"
					. " VALUES"
					. " ("
					. " $this->account_id,"
					. " $this->title,"
					. " NOW(),"
					. " $this->sent_date,"
					. " $this->subtotal,"
					. " $this->tax,"
					. " $this->amount,"
					. " $this->paid,"
					. " $this->sent,"
					. " $this->completed"
					. " )";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

				if ($aux_account != 0) {
					$accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($aux_account, $this);
				}

			}

			$this->PrepareToUse();
			unset($dbObj);

		}

		function setItems($items_desc, $items_price) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "DELETE FROM CustomInvoice_Items WHERE custominvoice_id = $this->id";
			$dbObj->query($sql);
			if ($items_desc && (count($items_desc) == count($items_price)) && $this->id) {
				foreach ($items_desc as $key => $each_item_desc) {
					if ($each_item_desc) {
						$sql = "INSERT INTO CustomInvoice_Items (custominvoice_id, description, price) VALUES ($this->id, ".db_formatString($each_item_desc).", ".db_formatString($items_price[$key]).")";
						$result = $dbObj->query($sql);
					}
				}
				unset($dbObj);
			} else {
				unset($dbObj);
				return false;
			}
		}

		function getItems() {
			if ($this->id) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM CustomInvoice_Items WHERE custominvoice_id='".$this->id."' ORDER BY id";
				$result = $dbObj->query($sql);
				while($row = mysql_fetch_assoc($result)) $data[] = $row;

				unset($dbObj);

				if ($data) return $data;
				else return false;
			}
		}

		function getTextItems() {

			if ($this->id) {

				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM CustomInvoice_Items WHERE custominvoice_id='".$this->id."' ORDER BY id";
				$result = $dbObj->query($sql);
				while($row = mysql_fetch_assoc($result)) $data[] = $row;

				if ($data) {
					foreach ($data as $each_item) {
						$textItems[] = $each_item["description"];
					}
				}

				if ($textItems) $return_items = implode("\n", $textItems);

				unset($dbObj);

				return $return_items;
			}

		}

		function getTextPrices() {

			if ($this->id) {

				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM CustomInvoice_Items WHERE custominvoice_id='".$this->id."' ORDER BY id";
				$result = $dbObj->query($sql);
				while($row = mysql_fetch_assoc($result)) $data[] = $row;

				if ($data) {
					foreach ($data as $each_item) {
						$textPrices[] = $each_item["price"];
					}
				}

				if ($textPrices) $return_prices = implode("\n", $textPrices);

				unset($dbObj);

				return $return_prices;
			}

		}

		function getPrice() {
			return $this->amount;
		}

		function Delete($domain_id = false) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
			}

			$sql = "UPDATE Invoice_CustomInvoice SET custom_invoice_id = '0' WHERE custom_invoice_id = $this->id";
			$dbObj->query($sql);

			$sql = "UPDATE Payment_CustomInvoice_Log SET custom_invoice_id = '0' WHERE custom_invoice_id = $this->id";
			$dbObj->query($sql);

			$sql = "DELETE FROM CustomInvoice_Items WHERE custominvoice_id = $this->id";
			$dbObj->query($sql);

			$sql = "DELETE FROM CustomInvoice WHERE id = $this->id";
			$dbObj->query($sql);

			unset($dbObj);

		}

		function deletePerAccount($account_id = 0, $domain_id = false) {
			if (is_numeric($account_id) && $account_id > 0) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id) {
					$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
				} else {
					if (defined("SELECTED_DOMAIN_ID")) {
						$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
					} else {
						$dbObj = db_getDBObject();
					}
					unset($dbMain);
				}
				$sql = "SELECT * FROM CustomInvoice WHERE account_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete($domain_id);
				}

				unset($dbObj);
			}
		}
	}

?>
