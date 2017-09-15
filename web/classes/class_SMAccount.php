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
	# * FILE: /classes/class_smaccount.php
	# ----------------------------------------------------------------------------------------------------

	class SMAccount extends Handle {

		var $id;
		var $updated;
		var $entered;
		var $username;
		var $password;
		var $permission;
		var $iprestriction;
		var $name;
		var $phone;
		var $email;
		var $active;

		function SMAccount($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM SMAccount WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {
			$this->id				= ($row["id"])				? $row["id"]			: ($this->id			? $this->id				: 0);
			$this->updated			= ($row["updated"])			? $row["updated"]		: ($this->updated		? $this->updated		: "");
			$this->entered			= ($row["entered"])			? $row["entered"]		: ($this->entered		? $this->entered		: "");
			$this->username			= ($row["username"])		? $row["username"]		: ($this->username		? $this->username		: "");
			$this->password			= ($row["password"])		? $row["password"]		: ($this->password		? $this->password		: "");
			$this->permission		= ($row["permission"])		? $row["permission"]	: ($this->permission	? $this->permission		: 0);
			$this->name				= ($row["name"])			? $row["name"]			: "";
			$this->phone			= ($row["phone"])			? $row["phone"]			: "";
			$this->email			= ($row["email"])			? $row["email"]			: "";
			$this->active			= ($row["active"])			? $row["active"]		: ($this->active		? $this->active			: "");
			$this->iprestriction	= ($row["iprestriction"])	? $row["iprestriction"]	: ($this->iprestriction	? $this->iprestriction	: "");
		}

		function Save() {
			$insert_password = $this->password;
			$aux_username = $this->username;
			$aux_password = $this->password;
			$this->prepareToSave();
			$dbObj = db_getDBObject(DEFAULT_DB, true);
			
			
			if ($this->id) {
				$sql  = "UPDATE SMAccount SET"
					. " updated				= NOW(),"
					. " username			= $this->username,"
					. " permission			= $this->permission,"
					. " iprestriction		= $this->iprestriction,"
					. " name				= $this->name,"
					. " phone				= $this->phone,"
					. " email				= $this->email,"
					. " active				= $this->active,"
					. " complementary_info  = ".db_formatString(md5($aux_username.$aux_password))
					. " WHERE id      = $this->id";
				
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO SMAccount"
					. " ("
					. " updated,"
					. " entered,"
					. " username,"
					. " password,"
					. " permission,"
					. " iprestriction,"
					. " name,"
					. " phone,"
					. " email,"
					. " active,"
					. " complementary_info"
					. " )"
					. " VALUES"
					. " ("
					. " NOW(),"
					. " NOW(),"
					. " $this->username,"
					. " ".db_formatString(md5($insert_password)).","
					. " $this->permission,"
					. " $this->iprestriction,"
					. " $this->name,"
					. " $this->phone,"
					. " $this->email,"
					. " $this->active,"
					. " ".db_formatString(md5($aux_username.(string_strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($aux_password) : $aux_password))." "
					. " )";
				
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			
			$this->prepareToUse();
		}

		function updatePassword() {
			$dbObj = db_getDBObject(DEFAULT_DB, true);
			$sql = "UPDATE SMAccount SET password = ".db_formatString(md5($this->password)).", complementary_info = ".db_formatString(md5($this->username.$this->password))." WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function Delete() {
			$dbObj = db_getDBObject(DEFAULT_DB, true);
			$sql = "DELETE FROM SMAccount WHERE id = $this->id";
			$dbObj->query($sql);
		}

	}

?>
