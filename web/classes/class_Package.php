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
	# * FILE: /classes/class_Package.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$PackageObj = new Package($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Package
	 * @method Package
	 * @access Public
	 */

	class Package extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var string
		 * @access Private
		 */
		var $title;
		/**
		 * @var integer
		 * @access Private
		 */
		var $parent_domain;
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
		 * @var string
		 * @access Private
		 */
		var $status;
		/**
		 * @var entered
		 * @access Private
		 */
		var $entered;
		/**
		 * @var datetime
		 * @access Private
		 */
		var $updated;
		/**
		 * @var string
		 * @access Private
		 */
		var $content;
		/**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $thumb_id;
		/**
		 * @var char
		 * @access Private
		 */
		var $show_info;



		/**
		 * <code>
		 *		$packageObj = new Package($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Package
		 * @access Public
		 * @param integer $var
		 */
		function __construct($var="") {
			if (is_numeric($var) && ($var)) {
				unset($dbMain);
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$sql = "SELECT * FROM Package WHERE id = $var";
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

			$this->id				= ($row["id"])					? $row["id"]				: ($this->id					? $this->id				: 0);
			$this->title			= ($row["title"])				? $row["title"]				: ($this->title					? $this->title			: "");
			$this->parent_domain	= ($row["parent_domain"])		? $row["parent_domain"]		: ($this->parent_domain			? $this->parent_domain	: 0);
			$this->module			= ($row["module"])				? $row["module"]			: ($this->module				? $this->module			: "");
			$this->level			= ($row["level"])				? $row["level"]				: ($this->level					? $this->level			: 0);
			$this->status			= ($row["status"])				? $row["status"]			: ($this->status				? $this->status			: "");
			$this->image_id			= ($row["image_id"])			? $row["image_id"]			: ($this->image_id				? $this->image_id		: 0);
			$this->thumb_id			= ($row["thumb_id"])			? $row["thumb_id"]			: ($this->thumb_id				? $this->thumb_id		: 0);
			$this->show_info		= ($row["show_info"])			? $row["show_info"]			: ($this->show_info				? $this->show_info		: "");
			$this->content			= ($row["content"])             ? $row["content"]			: ($this->content				? $this->content		: "");
			$this->entered			= ($row["entered"])				? $row["entered"]			: ($this->entered				? $this->entered		: "");
			$this->updated			= ($row["updated"])				? $row["updated"]			: ($this->updated				? $this->updated		: "");


		}
		
		

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$packageObj->Save();
		 * <br /><br />
		 *		//Using this in Package() class.
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

				$sql = "UPDATE Package SET"
					. " title            = $this->title,"
					. " parent_domain    = $this->parent_domain,"
					. " module		     = $this->module,"
					. " level		     = $this->level,"
					. " status		     = $this->status,"
					. " show_info	     = $this->show_info,"
					. " image_id	     = $this->image_id,"
					. " thumb_id	     = $this->thumb_id,"
					. " content         = $this->content,"
					. " updated		     = NOW()"
					. " WHERE id         = $this->id";

				$dbMain->query($sql);

			} else {

				$sql = "INSERT INTO Package"
					. " (title,"
					. " parent_domain,"
					. " module,"
					. " level,"
					. " status,"
					. " show_info,"
					. " image_id,"
					. " thumb_id,"
					. " content,"
					. " entered,"
					. " updated)"
					. " VALUES"
					. " ($this->title,"
					. " $this->parent_domain,"
					. " $this->module,"
					. " $this->level,"
					. " $this->status,"
					. " $this->show_info,"
					. " $this->image_id,"
					. " $this->thumb_id,"
					. " $this->content,"
					. " NOW(),"
					. " NOW())";

				$dbMain->query($sql);

				$this->id = mysql_insert_id($dbMain->link_id);

			}

			$this->prepareToUse();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$packageObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete($SMAccount) {

			/*
			 * Save log of Package Items
			 */
			$messageLog = "Deleted in ".date("M")."/".date("d")."/".date("Y")." - ".date("h").":".date("i").":".date("s")." ".date("A");
			domain_saveLogForPackageItems($this->id,$messageLog,$SMAccount);

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$sql = "DELETE FROM Package WHERE id = $this->id";
			$dbMain->query($sql);

			$sql = "DELETE FROM PackageModules WHERE package_id = $this->id";
			$dbMain->query($sql);

			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete();
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete();
			}

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$packageObj->updateImage($imageArray);
		 * <br /><br />
		 *		//Using this in Package() class.
		 *		$this->updateImage($imageArray);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name updateImage
		 * @access Public
		 * @param array $imageArray
		 */
		function updateImage($imageArray) {
			unset($imageObj);
			if ($this->image_id) {
				$imageobj = new Image($this->image_id);
				if ($imageobj) $imageobj->delete();
			}
			$this->image_id = $imageArray["image_id"];
			unset($imageObj);
			if ($this->thumb_id) {
				$imageObj = new Image($this->thumb_id);
				if ($imageObj) $imageObj->delete();
			}
			$this->thumb_id = $imageArray["thumb_id"];
			unset($imageObj);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$packageObj->getPackagesByDomainID();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getPackagesByDomainID
		 * $param integer $domain_id
		 * $param string $module
		 * $param integer $level
		 * @access Public
		 */
		function getPackagesByDomainID($domain_id=0,$module=0,$level=0){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id){
				$sql = "SELECT * FROM Package WHERE parent_domain = {$domain_id} AND module = '{$module}' AND level = {$level} AND status = 'A'";
			} else {
				$sql = "SELECT * FROM Package WHERE id = $this->id AND status = 'A'";
			}
			$result = $dbMain->query($sql);
			if (mysql_num_rows($result)) {
				unset($array_packages);
				unset($packageItemsObj);
				$packageItemsObj = new PackageItems();
				$i = 0;
				while($row = mysql_fetch_assoc($result)){
					$array_packages[$i]["package_id"] = $row["id"];
					$array_packages[$i]["title"] = $row["title"];

					/*
					 * Get items of package
					 */
					unset($aux_package_items);
					$aux_package_items = $packageItemsObj->getItemsByPackageId($row["id"]);
					if(is_array($aux_package_items)){
						$array_packages[$i]["items"] = $aux_package_items;
					}else{
						$array_packages[$i]["items"] = false;
					}
					$i++;
				}
				return $array_packages;
			}
			else {
				return false;
			}
		}

	}

?>
