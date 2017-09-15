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
	# * FILE: /classes/class_PackageItems.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$PackageItemsObj = new PackageItems($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name PackageItems
	 * @method PackageItems
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @access Public
	 */

	class PackageItems extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $package_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $module;
		/**
		 * @var integer
		 * @access Private
		 */
		var $level;
		/**
		 * @var decimal
		 * @access Private
		 */
		var $price;
		

		/**
		 * <code>
		 *		$packageItemObj = new PackageItem($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Package
		 * @access Public
		 * @param integer $var
		 */
		function PackageItems($var="", $pack_id="") {

			$db = db_getDBObject(DEFAULT_DB, true);

			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM PackageItems WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else if (is_numeric($pack_id) && ($pack_id)) {
				$db = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM PackageItems WHERE package_id = $pack_id";
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

			$this->id				= ($row["id"])					? $row["id"]				: ($this->id					? $this->id				: 0);
			$this->package_id		= ($row["package_id"])			? $row["package_id"]		: ($this->package_id			? $this->package_id		: 0);
			$this->domain_id		= ($row["domain_id"])			? $row["domain_id"]			: ($this->domain_id				? $this->domain_id		: 0);
			$this->module			= ($row["module"])				? $row["module"]			: ($this->module				? $this->module			: "");
			$this->level			= ($row["level"])				? $row["level"]				: ($this->level					? $this->level			: 0);
			$this->price			= ($row["price"])				? $row["price"]				: ($this->price					? $this->price			: "");
			
		}
		
		

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$packageItemObj->Save();
		 * <br /><br />
		 *		//Using this in PackageItem() class.
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

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->id) {

				$sql = "UPDATE PackageItems SET"
					. " package_id		= $this->package_id,"
					. " domain_id	    = $this->domain_id,"
					. " module		    = $this->module,"
					. " level		    = $this->level,"
					. " price		    = $this->price"
					. " WHERE id        = $this->id";

				$dbMain->query($sql);

			} else {

				$sql = "INSERT INTO PackageItems"
					. " (package_id,"
					. " domain_id,"
					. " module,"
					. " level,"
					. " price)"
					. " VALUES"
					. " ($this->package_id,"
					. " $this->domain_id,"
					. " $this->module,"
					. " $this->level,"
					. " $this->price)";

				$dbMain->query($sql);

				$this->id = mysql_insert_id($dbMain->link_id);
			}
			
			$this->prepareToUse();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$packageItemObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$sql = "DELETE FROM PackageItems WHERE id = $this->id";
			$dbObj->query($sql);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$packageItemObj->getItemsByPackageId($package_id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getItemsByPackageId
		 * @access Public
		 * @param integer $package_id
		 */
		function getItemsByPackageId($package_id){

			if($package_id){
				/*
				 * Get properties of object
				 */
				unset($aux_fields);
				foreach($this as $key => $value){
					$aux_fields[] = $key;
				}

				$dbMain = db_getDBObject(DEFAULT_DB,true);
				$sql = "SELECT ".implode(", ",$aux_fields)." FROM PackageItems WHERE package_id = ".$package_id;
				$result = $dbMain->query($sql);
				if(mysql_num_rows($result)){
					unset($array_package_items);
					while($row = mysql_fetch_assoc($result)){
						if ($row["domain_id"]){
							$domain = new Domain($row["domain_id"]);
							if ($domain->getString("status") == "A")
								$array_package_items[] = $row;
						} else {
							$array_package_items[] = $row;
						}
					}
					return $array_package_items;
				}else{
					return false;
				}
			}else{
				return false;

			}

		}


		function DeleteItemsByPackageID($package_id){

			if(is_numeric($package_id)){
				$dbMain = db_getDBObject(DEFAULT_DB,true);
				$sql = "DELETE FROM PackageItems WHERE package_id =".$package_id;
				$dbMain->query($sql);
				return true;
			}else{
				return false;
			}

		}

	}

?>
