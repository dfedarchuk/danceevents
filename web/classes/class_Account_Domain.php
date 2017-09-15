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
	# * FILE: /classes/class_Account_Domain.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$accDomainObj = new Account_Domain($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Account_Domain
	 * @access Public
	 */
	class Account_Domain extends Handle {

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
		var $domain_id;

		/**
		 * <code>
		 *		$accDomainObj = new Account_Domain($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Article_CategoryDomain
		 * @access Public
		 * @param integer $var
		 */
		function Account_Domain($account_id = false, $domain_id = false) {
			if (is_numeric($domain_id) && ($domain_id) && is_numeric($account_id) && ($account_id)) {
				$this->account_id = $account_id;
				$this->domain_id = $domain_id;
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM Account_Domain WHERE domain_id = $this->domain_id AND account_id = $this->account_id";
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
		 * @version 8.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row='') {
			if ($row['id']) $this->id = $row['id'];
			else if (!$this->id) $this->id = 0;
			if ($row['account_id']) $this->account_id = $row['account_id'];
			else if (!$this->account_id) $this->account_id = 0;
			if ($row['domain_id']) $this->domain_id = $row['domain_id'];
			else if (!$this->domain_id) $this->domain_id = 0;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accDomainObj->Save();
		 * <br /><br />
		 *		//Using this in Account_Domain() class.
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
			$dbObj = db_getDBObject(DEFAULT_DB, true);
			if ($this->id) {
				$sql  = "UPDATE Account_Domain SET"
					. " account_id = $this->account_id,"
					. " domain_id = $this->domain_id"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Account_Domain"
					. " (account_id, domain_id)"
					. " VALUES"
					. " ($this->account_id, $this->domain_id)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}

			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$accDomainObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {
			$dbObj = db_getDBObject(DEFAULT_DB, true);
			$sql = "DELETE FROM Account_Domain WHERE account_id = $this->account_id AND domain_id = $this->domain_id";
			$dbObj->query($sql);
		}

		/**
		 * <code>
		 *	This function get all domains with the account has items
		 *		//Using this in forms or other pages.
		 *		$accDomainObj->getAll($account_id);
		 *		// Or
		 *		$accDomainObj->getAll($account_id, "text");
		 * <br /><br />
		 *		//Using this in Account_Domain() class.
		 *		$this->getAll($account_id, "text");
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getAll
		 * @access Public
		 * @param integer $account_id
		 * @param varchar $type [array, text]
		 * @return mixed $domains
		 */
		function getAll ($account_id, $type = "array") {
			$dbObj = db_getDBObject(DEFAULT_DB, true);
			$sql = "SELECT
						AD.`domain_id`
					FROM `Account_Domain` AD
					LEFT JOIN `Domain` D ON (AD.`domain_id` = D.`id`)
					WHERE AD.`account_id` = $account_id
					AND D.`status` = 'A' ORDER BY D.`name`";
			$result = $dbObj->Query($sql);
			if (mysql_num_rows($result) > 0) {
				unset ($domains);
				while ($row = mysql_fetch_assoc($result)) {
					if ($type == "text") {
						$domains .= $row["domain_id"].",";
					} else {
						$domains[] = $row["domain_id"];
					}
				}
				if ($type == "text") {
					$domains = string_substr($domains, 0, -1);
				}

				return $domains;
			} else {
				return false;
			}
		}

		function saveOnDomain ($accID, $accObj = false, $contObj = false, $profObj = false) {
			$domains = $this->getAll($accID);
			if (is_array($domains) && count($domains) > 0) {
				foreach ($domains as $domain) {
					unset($dbObj, $apcObj);
					$apcObj = new AccountProfileContact($domain, $accID);
					if ($accObj && $accObj instanceof Account) {
						$apcObj->setNumber("account_id", $accID);
						$apcObj->setString("has_profile", $accObj->getString("has_profile"));
						$apcObj->setString("username", $accObj->getString("username"));
					} else {
						$accObj = new Account($accID);
						$apcObj->setNumber("account_id", $accID);
						$apcObj->setString("has_profile", $accObj->getString("has_profile"));
						$apcObj->setString("username", $accObj->getString("username"));
					}

					if ($contObj && $contObj instanceof Contact) {
						$apcObj->setString("first_name", $contObj->getString("first_name"));
						$apcObj->setString("last_name", $contObj->getString("last_name"));
					} else {
						$contObj = new Contact($accID);
						$apcObj->setString("first_name", $contObj->getString("first_name"));
						$apcObj->setString("last_name", $contObj->getString("last_name"));
					}

					if ($profObj && $profObj instanceof Profile) {
						$apcObj->setString("nickname", $profObj->getString("nickname"));
						$apcObj->setString("friendly_url", $profObj->getString("friendly_url"));
						$apcObj->setNumber("image_id", $profObj->getNumber("image_id"));
						$apcObj->setString("facebook_image", $profObj->getString("facebook_image"));
					} else {
						$profObj = new Profile($accID);
						$apcObj->setString("nickname", $profObj->getString("nickname"));
						$apcObj->setString("friendly_url", $profObj->getString("friendly_url"));
						$apcObj->setNumber("image_id", $profObj->getNumber("image_id"));
						$apcObj->setString("facebook_image", $profObj->getString("facebook_image"));
					}
					$apcObj->Save();
				}
			}
		}


		function getAllItemsByModule(&$dbObj,$tableName,$account_id,$domain_id){

			if($dbObj && $tableName && $account_id){

				/*
				 * Fields
				 */
				unset($array_fields);
				$array_fields[] = "id";
				$array_fields[] = "status";

				if ($tableName == "Banner") {
					$array_fields[] = "type";
                    $fields = "`caption`";
					$array_fields[] = $fields;
				} else {
					$array_fields[] = "level";
					$array_fields[] = "title";
				}

				unset($array_order);
				$array_order[] = ($tableName == "Banner" ? "type" : "level");
				$array_order[] = ($tableName == "Banner" ? "caption" : "title");

				/*
				 * Preparing to get level name
				 */
				unset($levelObj,$className);
				$className = $tableName."Level";
				$levelObj = new $className();

				/*
				 * Preparing to get status title
				 */
				unset($statusObj);
				$statusObj = new ItemStatus();

				/*
				 * Preparing SQL
				 */
				$sql = "SELECT ".implode(", ", $array_fields)." FROM ".$tableName." WHERE account_id =".$account_id." ORDER BY ".$array_order[0]." DESC, ".$array_order[1];

				$result = $dbObj->query($sql);
				if(mysql_num_rows($result)){
					unset($array_items);
					$i = 0;
					while($row = mysql_fetch_assoc($result)){
						for($j=0;$j<count($array_fields);$j++){

							/*
							 * Get level name
							 */
							if($array_fields[$j] == "level" || $array_fields[$j] == "type"){
								$array_items[$i]["level_name"] = $levelObj->getName($row[$array_fields[$j]]);
							}

							/*
							 * Check if need checkout
							 */
							if($array_fields[$j] == "id"){
								unset($obj);
								$obj = new $tableName($row[$array_fields[$j]],$domain_id);
								$array_items[$i]["NeedToCheckout"] = $obj->needToCheckOut();
							}

							/*
							 * Get status and title
							 */
							if($array_fields[$j] == "status"){
								$array_items[$i][$array_fields[$j]] = $statusObj->getStatusWithStyle($row[$array_fields[$j]]);
							}else{
								if ($tableName == "Banner") $keyField = "caption";
								else $keyField = $array_fields[$j];
								$array_items[$i][$keyField] = $row[$keyField];
							}


						}


						$i++;
					}

					return $array_items;
				}else{
					return false;
				}

			}else{
				return false;
			}

		}


		function getAllItemsByAccountID($account_id,$domain_id,$array_tables){

			if($account_id && $domain_id && $array_tables){
				unset($dbObj);
				$dbObj = db_getDBObjectByDomainID($domain_id, true);

				unset($array_items);



				if(is_array($array_tables)){
					$j = 0;
					for($i=0;$i<count($array_tables);$i++){
						unset($aux_array);
						$aux_array = $this->getAllItemsByModule($dbObj,$array_tables[$i],$account_id,$domain_id);

						if($aux_array){
							$array_items[$j]["table"] = $array_tables[$i];
							$array_items[$j]["items"] = $aux_array;
							$j++;
						}
					}

				}elseif($array_tables){
					unset($aux_array);
					$aux_array = $this->getAllItemsByModule($dbObj,$array_tables[$i],$account_id,$domain_id);
					if(is_array($aux_array)){
						$array_items[0]["table"] = $array_tables;
						$array_items[0]["items"] = $aux_array;
					}
				}

				if(is_array($array_items)){
					return $array_items;
				}else{
					return false;
				}
			}

		}
	}
?>
