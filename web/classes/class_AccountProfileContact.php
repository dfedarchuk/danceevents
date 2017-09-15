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
	# * FILE: /classes/class_AccountProfileContact.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$accountObj = new AccountProfileContact($domain_id, $account_id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name AccountProfileContact
	 * @access Public
	 */
	class AccountProfileContact extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $account_id;
        /**
		 * @var varchar
		 * @access Private
		 */
		var $username;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $first_name;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $last_name;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $nickname;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $friendly_url;
		/**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $facebook_image;
		/**
		 * @var char
		 * @access Private
		 */
		var $has_profile;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;

		/**
		 * <code>
		 *		$accountObj = new AccountProfileContact($domain_id, $account_id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name AccountProfileContact
		 * @access Public
		 * @param integer $domain_id
		 * @param integer $var
		 */
		function AccountProfileContact($domain_id, $var='') {
			if (is_numeric($var) && ($var)) {
				$this->domain_id = $domain_id;
				$main_db = db_getDBObject(DEFAULT_DB, true);
				$db = db_getDBObjectByDomainID($this->domain_id, $main_db);
				$sql = "SELECT * FROM AccountProfileContact WHERE account_id = $var";
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
		function makeFromRow($row='') {
			if ($row['account_id']) { $this->account_id = $row['account_id']; $this->has_account = 1; }
			else if (!$this->account_id) { $this->account_id = 0; $this->has_account = 0; }
            if ($row['username']) $this->username = $row['username'];
			else if (!$this->username) $this->username = "";
			if ($row['first_name']) $this->first_name = $row['first_name'];
			else if (!$this->first_name) $this->first_name = "";
			if ($row['last_name']) $this->last_name = $row['last_name'];
			else if (!$this->last_name) $this->last_name = "";
			if ($row['nickname']) $this->nickname = $row['nickname'];
			else if (!$this->nickname) $this->nickname = "";
			if ($row['friendly_url']) $this->friendly_url = $row['friendly_url'];
			else if (!$this->friendly_url) $this->friendly_url = "";
			if ($row['image_id']) $this->image_id = $row['image_id'];
			else if (!$this->image_id) $this->image_id = 0;
			if ($row['facebook_image']) $this->facebook_image = $row['facebook_image'];
			else if (!$this->facebook_image) $this->facebook_image = "";
			if ($row['has_profile']) $this->has_profile = $row['has_profile'];
			else if (!$this->has_profile) $this->has_profile = "n";
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accountObj->Save();
		 * <br /><br />
		 *		//Using this in AccountProfileContact() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
			$this->prepareToSave();

			$main_db = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID($this->domain_id, $main_db);
			if ($this->has_account) {
				$sql  = "UPDATE AccountProfileContact SET"
					. " username = $this->username,"
					. " first_name = $this->first_name,"
					. " last_name = $this->last_name,"
					. " nickname = $this->nickname,"
					. " friendly_url = $this->friendly_url,"
					. " image_id = $this->image_id,"
					. " facebook_image = $this->facebook_image,"
					. " has_profile = $this->has_profile"
					. " WHERE account_id = $this->account_id";

				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO AccountProfileContact"
					. " (account_id, username, first_name, last_name, nickname, friendly_url, image_id, facebook_image, has_profile)"
					. " VALUES"
					. " ($this->account_id, $this->username, $this->first_name, $this->last_name, $this->nickname, $this->friendly_url, $this->image_id, $this->facebook_image, $this->has_profile)";

				$dbObj->query($sql);
			}

			$this->prepareToUse();
		}

		function Delete() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id) {
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
			}
			$sql = "DELETE FROM AccountProfileContact WHERE account_id = $this->account_id";
			$dbObj->query($sql);
		}
	}
?>
