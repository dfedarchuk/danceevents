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
	# * FILE: /classes/class_account.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$accountObj = new Account($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 7.5.00
	 * @package Classes
	 * @name Account
	 * @access Public
	 */
	class Account extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var date
		 * @access Private
		 */
		var $entered;
		/**
		 * @var date
		 * @access Private
		 */
		var $updated;
		/**
		 * @var date
		 * @access Private
		 */
		var $lastlogin;
		/**
		 * @var string
		 * @access Private
		 */
		var $facebook_username;
		/**
		 * @var string
		 * @access Private
		 */
		var $username;
		/**
		 * @var string
		 * @access Private
		 */
		var $password;
		/**
		 * @var char
		 * @access Private
		 */
		var $foreignaccount;
		/**
		 * @var char
		 * @access Private
		 */
		var $is_sponsor;
		/**
		 * @var char
		 * @access Private
		 */
		var $has_profile;
		/**
		 * @var char
		 * @access Private
		 */
		var $publish_contact;
		/**
		 * @var char
		 * @access Private
		 */
		var $notify_traffic_listing;
        /**
		 * @var char
		 * @access Private
		 */
		var $active;
        /**
		 * @var char
		 * @access Private
		 */
		var $newsletter;
		/**
		 * @var string
		 * @access Private
		 */
		var $stripe_id;

		/**
		 * <code>
		 *		$accountObj = new Account($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Account
		 * @access Public
		 * @param integer $var
		 */
		function Account($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM Account WHERE id = $var";
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
		 * @version 7.5.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row='') {
			if ($row["id"]) $this->id = $row["id"];
			else if (!$this->id) $this->id = 0;
			if ($row["entered"]) $this->entered = $row["entered"];
			else if (!$this->entered) $this->entered = 0;
			if ($row["updated"]) $this->updated = $row["updated"];
			else if (!$this->updated) $this->updated = 0;
			if ($row["lastlogin"]) $this->lastlogin = $row["lastlogin"];
			else if (!$this->lastlogin) $this->lastlogin = 0;
			if ($row["facebook_username"]) $this->facebook_username = $row["facebook_username"];
			else if (!$this->facebook_username) $this->facebook_username = "";
			if ($row["username"]) $this->username = $row["username"];
			else if (!$this->username) $this->username = "";
			if ($row["password"]) $this->password = $row["password"];
			else if (!$this->password) $this->password = "";
			if ($row["foreignaccount"]) $this->foreignaccount = $row["foreignaccount"];
			else if (!$this->foreignaccount) $this->foreignaccount = "n";
			if ($row["is_sponsor"]) $this->is_sponsor = $row["is_sponsor"];
			else if (!$this->is_sponsor) $this->is_sponsor = "n";
			if ($row["has_profile"]) $this->has_profile = $row["has_profile"];
			else if (!$this->has_profile) $this->has_profile = "y";
			if ($row["publish_contact"]) $this->publish_contact = $row["publish_contact"];
			else if (!$this->publish_contact) $this->publish_contact = "n";
			if ($row["notify_traffic_listing"]) $this->notify_traffic_listing = $row["notify_traffic_listing"];
			else if (!$this->notify_traffic_listing) $this->notify_traffic_listing = "n";
            if ($row["active"]) $this->active = $row["active"];
			else if (!$this->active) $this->active = "n";
            if ($row["newsletter"]) $this->newsletter = $row["newsletter"];
			else if (!$this->newsletter) $this->newsletter = "n";
			if ($row["stripe_id"]) $this->stripe_id = $row["stripe_id"];
			else if (!$this->stripe_id) $this->stripe_id = "";
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->Save();
		 * <br /><br />
		 *		//Using this in Account() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
			$insert_password = $this->password;

			$aux_username = $this->username;
			$aux_password = $this->password;

			$this->prepareToSave();

			$dbObj = db_getDBObject(DEFAULT_DB,true);
			if ($this->id) {
				$sql  = "UPDATE Account SET"
					. " updated = NOW(),"
					. " facebook_username = $this->facebook_username,"
					. " username = $this->username,"
					. " foreignaccount = $this->foreignaccount,"
					. " publish_contact = $this->publish_contact,"
					. " notify_traffic_listing = $this->notify_traffic_listing,"
					. " active = $this->active,"
					. " newsletter = $this->newsletter,"
					. " stripe_id = $this->stripe_id,"
					. " complementary_info = ".db_formatString(md5(MEMBERS_LOGIN_PAGE.$aux_username.$aux_password))
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Account"
					. " (entered, updated, facebook_username, username, password, foreignaccount, is_sponsor, has_profile, publish_contact, notify_traffic_listing, complementary_info, active, newsletter)"
					. " VALUES"
					. " (NOW(), NOW(), $this->facebook_username, $this->username, ".db_formatString(((string_strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($insert_password) : $insert_password)).", $this->foreignaccount, $this->is_sponsor, $this->has_profile, $this->publish_contact, $this->notify_traffic_listing, ".db_formatString(md5(MEMBERS_LOGIN_PAGE.$aux_username.((string_strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($aux_password) : $aux_password))).", $this->active, $this->newsletter)";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

                $rowTimeline = array();
                $rowTimeline["item_type"] = "account";
                $rowTimeline["action"] = "new";
                $rowTimeline["item_id"] = $this->id;
                $timelineObj = new Timeline($rowTimeline);
                $timelineObj->save();

			}

			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->updateLastLogin();
		 * <br /><br />
		 *		//Using this in Account() class.
		 *		$this->updateLastLogin();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name updateLastLogin
		 * @access Public
		 */
		function updateLastLogin() {
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$sql = "UPDATE Account SET lastlogin = NOW() WHERE id = $this->id";
			$dbObj->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->updatePassword();
		 * <br /><br />
		 *		//Using this in Account() class.
		 *		$this->updatePassword();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name updatePassword
		 * @access Public
		 */
		function updatePassword() {
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$sql = "UPDATE Account SET updated = NOW(), password = ".db_formatString(((string_strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($this->password) : $this->password)).", complementary_info = ".db_formatString(md5(MEMBERS_LOGIN_PAGE.$this->username.$this->password))." WHERE id = $this->id";
			$dbObj->query($sql);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {
			$dbObjMain = db_getDBObject(DEFAULT_DB, true);
            $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

			if (is_numeric($this->id) && $this->id > 0) {

				$accDomainObj = new Account_Domain();
				$domains = $accDomainObj->getAll($this->id);

				/*
				 * Contact Cascade
				 */
				$contactObj = new Contact($this->id);
				$contactObj->Delete();
				unset($contactObj);

				/*
				 * Profile Cascade
				 */
				$profileObj = new Profile($this->id);
				$profile_name = addslashes($profileObj->getString("nickname"));
				$profileObj->Delete();
				unset($profileObj);

				/*
				 * Redeem Profile Name Update
				 */
				$sql = "UPDATE `Promotion_Redeem` SET `profile_name` = ".db_formatString($profile_name)." WHERE `account_id` = $this->id";
				$dbDomain->Query($sql);

                /*
				 * Account Activation Cascade
				 */
				$accActObj = new Account_Activation();
				$accActObj->deletePerAccount($this->id);
				unset($accActObj);

				/*
				 * Forgot Password Cascade
				 */
				$fgtPassObj = new forgotPassword();
				$fgtPassObj->deletePerAccount($this->id);
				unset($fgtPassObj);

				/*
				 * Aux Objects
				 */
				$auxObj = Array("Article", "Banner", "Classified", "Comments", "CustomInvoice", "Event", "Gallery", "Listing", "Promotion", "Review");
				foreach ($auxObj as $class) {
					${$class."Obj"} = new $class();
				}

				if (is_array($domains)) foreach ($domains as $domain) {
					unset($dbObj);
					$dbObj = db_getDBObjectByDomainID($domain, $dbObjMain);

					foreach ($auxObj as $class) {
						${$class."Obj"}->deletePerAccount($this->id, $domain);
					}

					/*
					 * Invoice Cascade
					 */
					$sql = "UPDATE Invoice SET account_id = '0' WHERE account_id = $this->id";
					$dbObj->query($sql);

					/*
					 * Payment Log Cascade
					 */
					$sql = "UPDATE Payment_Log SET account_id = '0' WHERE account_id = $this->id";
					$dbObj->query($sql);

					/*
					 * Claim Cascade
					 */
					$sql = "UPDATE Claim SET status = 'incomplete' WHERE account_id = $this->id AND status = 'progress'";
					$dbObj->query($sql);
					$sql = "UPDATE Claim SET account_id = '0' WHERE account_id = $this->id";
					$dbObj->query($sql);

					/*
					 * Deleting Account from Import Setting
					 */
					$sql = "SELECT `value` FROM `Setting` WHERE `name` = 'import_account_id'";
					$result = $dbObj->Query($sql);
					$row = mysql_fetch_assoc($result);
					if ($row["value"] == $this->id) {
						$sql = "UPDATE `Setting` SET `value` = '' WHERE `name` = 'import_account_id'";
						$dbObj->Query($sql);
					}

					/*
					 * Deleting Account from Import Setting
					 */
					$sql = "SELECT `value` FROM `Setting` WHERE `name` = 'import_account_id_event'";
					$result = $dbObj->Query($sql);
					$row = mysql_fetch_assoc($result);
					if ($row["value"] == $this->id) {
						$sql = "UPDATE `Setting` SET `value` = '' WHERE `name` = 'import_account_id_event'";
						$dbObj->Query($sql);
					}

					/*
					 * AccountProfileContact Cascade
					 */
					$apcObj = new AccountProfileContact($domain, $this->id);
					$apcObj->Delete();

					$accDObj = new Account_Domain($this->id, $domain);
					$accDObj->Delete();

                    ### Timeline
                    $sql = "DELETE FROM Timeline WHERE (item_type = 'newsletter' OR item_type = 'account') AND item_id = $this->id";
                    $dbObj->query($sql);
				}

				foreach ($auxObj as $class) {
					unset(${$class."Obj"});
				}

				/*
				 * This Account
				 */
                $sql = "DELETE FROM Account WHERE id = $this->id";
                $dbObjMain->query($sql);
            }
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->getCustomInvoicesNumber();
		 * <br /><br />
		 *		//Using this in Account() class.
		 *		$this->getCustomInvoicesNumber();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name getCustomInvoicesNumber
		 * @access Public
		 * @param integer $domain_id
		 * @return integer
		 */
		function getCustomInvoicesNumber($domain_id = false) {
			$dbObjMain = db_getDBObject(DEFAULT_DB,true);
			if ($domain_id != 0) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbObjMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);
			} else {
				$dbObj = db_getDBObject();
			}
			$sql = "SELECT COUNT(id) as custom_invoice_number FROM CustomInvoice WHERE account_id = $this->id AND paid != 'y' AND sent = 'y'";
			$r = $dbObj->query($sql);
			$row = mysql_fetch_assoc($r);
			if ($row["custom_invoice_number"]) return $row["custom_invoice_number"];
			else return false;
		}

		/**
		 * if $option = true set the field is_sponsor to 'y' else set the field to 'n'
		 * <br />
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->changeMemberStatus(true);
		 *		<br /> or <br />
		 *		$accountObj->changeMemberStatus(false);
		 * <br /><br />
		 *		//Using this in Account() class.
		 *		$this->changeMemberStatus(true);
		 *		<br /> or <br />
		 *		$this->changeMemberStatus(false);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name changeMemberStatus
		 * @access Public
		 * @param boolean $option
		 */
		function changeMemberStatus($option = false){
			$option == true? $this->is_sponsor = 'y': $this->is_sponsor = 'n';

			$sql = "UPDATE Account SET is_sponsor = '$this->is_sponsor' WHERE id = $this->id";
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$dbObj->query($sql);
		}

		/**
		 * if $option = true set the field has_profile to 'y' else set the field to 'n'
		 * <br />
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->changeProfileStatus(true);
		 *		<br /> or <br />
		 *		$accountObj->changeProfileStatus(false);
		 * <br /><br />
		 *		//Using this in Account() class.
		 *		$this->changeProfileStatus(true);
		 *		<br /> or <br />
		 *		$this->changeProfileStatus(false);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name changeProfileStatus
		 * @access Public
		 * @param boolean $option
		 */
		function changeProfileStatus($option = false){
			$option == true? $this->has_profile = 'y': $this->has_profile = 'n';

			$sql = "UPDATE Account SET has_profile = '$this->has_profile' WHERE id = $this->id";
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$dbObj->query($sql);
		}


		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$items = $accountObj->getAccountItems();
		 * <br /><br />
		 *		//Using this in Account() class.
		 *		$items = $this->getAccountItems();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name getAccountItems
		 * @access Public
		 * @return boolean
		 */
		function getAccountItems(){
			$dbObjMain = db_getDBObject(DEFAULT_DB, true);

			$accDomainObj = new Account_Domain();
			$domains = $accDomainObj->getAll($this->id);

			if ($domains && count($domains) > 0) {
				foreach ($domains as $domain_id) {
					$dbObj = db_getDBObjectByDomainID($domain_id, $dbObjMain);

					$sql = "SELECT COUNT(id) AS COUNT FROM Listing WHERE account_id = $this->id";
					$result = $dbObj->query($sql);
					$row = mysql_fetch_assoc($result);
					$items = $row["COUNT"] > 0 ? true: false;

					if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on" && !$items) {
						$sql = "SELECT COUNT(id) AS COUNT FROM Article WHERE account_id = $this->id";
						$result = $dbObj->query($sql);
						$row = mysql_fetch_assoc($result);
						$items = $row["COUNT"] > 0 ? true: false;
					}

					if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on" && !$items) {
						$sql = "SELECT COUNT(id) AS COUNT FROM Banner WHERE account_id = $this->id";
						$result = $dbObj->query($sql);
						$row = mysql_fetch_assoc($result);
						$items = $row["COUNT"] > 0 ? true: false;
					}

					if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" && !$items) {
						$sql = "SELECT COUNT(id) AS COUNT FROM Classified WHERE account_id = $this->id";
						$result = $dbObj->query($sql);
						$row = mysql_fetch_assoc($result);
						$items = $row["COUNT"] > 0 ? true: false;
					}

					if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" && !$items) {
						$sql = "SELECT COUNT(id) AS COUNT FROM Event WHERE account_id = $this->id";
						$result = $dbObj->query($sql);
						$row = mysql_fetch_assoc($result);
						$items = $row["COUNT"] > 0 ? true: false;
					}

					if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && !$items) {
						$sql = "SELECT COUNT(id) AS COUNT FROM Promotion WHERE account_id = $this->id";
						$result = $dbObj->query($sql);
						$row = mysql_fetch_assoc($result);
						$items = $row["COUNT"] > 0 ? true: false;
					}

					if (CUSTOM_INVOICE_FEATURE == "on" && !$items) {
						$count = $this->getCustomInvoicesNumber($domain_id);
						$items = $count > 0 ? true: false;
					}

					if ($items) break;
				}
			} else {
				$items = false;
			}

			return $items;
		}

	}
?>
