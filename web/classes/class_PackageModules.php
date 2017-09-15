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
	# * FILE: /classes/class_PackageModules.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$PackageModulesObj = new PackageModules($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name PackageModules
	 * @method PackageModules
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @access Public
	 */

	class PackageModules extends Handle {

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
		var $package_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $parent_domain_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $module;
		/**
		 * @var string
		 * @access Private
		 */
		var $module_name;
		/**
		 * @var integer
		 * @access Private
		 */
		var $module_id;
		/**
		 * @var date
		 * @access Private
		 */
		var $date;
		
		/**
		 * <code>
		 *		$PackageModulesObj = new PackageModules($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name PackageModules
		 * @access Public
		 * @param integer $var
		 */
		function __construct($var="") {
			if (is_numeric($var) && ($var)) {
				unset($dbMain);
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM PackageModules WHERE id = $var";
				$row = mysql_fetch_array($dbMain->query($sql));
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

			$this->id					= ($row["id"])					? $row["id"]				: ($this->id					? $this->id					: 0);
			$this->account_id			= ($row["account_id"])			? $row["account_id"]		: ($this->account_id			? $this->account_id			: 0);
			$this->package_id			= ($row["package_id"])			? $row["package_id"]		: ($this->package_id			? $this->package_id			: 0);
			$this->domain_id			= ($row["domain_id"])			? $row["domain_id"]			: ($this->domain_id				? $this->domain_id			: 0);
			$this->parent_domain_id		= ($row["parent_domain_id"])	? $row["parent_domain_id"]	: ($this->parent_domain_id		? $this->parent_domain_id	: 0);
			$this->module				= ($row["module"])				? $row["module"]			: ($this->module				? $this->module				: "");
			$this->module_name			= ($row["module_name"])			? $row["module_name"]		: ($this->module_name			? $this->module_name		: "");
			$this->module_id			= ($row["module_id"])			? $row["module_id"]			: ($this->module_id				? $this->module_id			: 0);
			$this->date					= ($row["date"])				? $row["date"]				: ($this->date					? $this->date				: "");

		}
		
	
		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$PackageModulesObj->Save();
		 * <br /><br />
		 *		//Using this in PackageModules() class.
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

				$sql = "UPDATE PackageModules SET"
					. " account_id			= $this->account_id,"
					. " package_id			= $this->package_id,"
					. " domain_id			= $this->domain_id,"
					. " parent_domain_id    = $this->parent_domain_id,"
					. " module				= $this->module,"
					. " module_name			= $this->module_name,"
					. " module_id			= $this->module_id,"
					. " date				= $this->date"
					. " WHERE id			= $this->id";

				$dbMain->query($sql);

			} else {

				$sql = "INSERT INTO PackageModules"
					. " (account_id,"
					. " package_id,"
					. " domain_id,"
					. " parent_domain_id,"
					. " module,"
					. " module_name,"
					. " module_id,"
					. " date)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->package_id,"
					. " $this->domain_id,"
					. " $this->parent_domain_id,"
					. " $this->module,"
					. " $this->module_name,"
					. " $this->module_id,"
					. " NOW())";


				$dbMain->query($sql);

				$this->id = mysql_insert_id($dbMain->link_id);

			}

			$this->prepareToUse();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$PackageModulesObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$sql = "DELETE FROM PackageModules WHERE id = $this->id";
			$dbMain->query($sql);

		}

	}

?>
