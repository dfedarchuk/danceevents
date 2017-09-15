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
	# * FILE: /classes/class_listingTemplate.php
	# ----------------------------------------------------------------------------------------------------

	class ListingTemplate extends Handle {

		var $id;
		var $layout_id;
		var $title;
		var $updated;
		var $entered;
		var $status;
		var $price;
		var $editable;

		function ListingTemplate($var='', $domain_id = false) {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				}else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM ListingTemplate WHERE id = $var";
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
			$this->id						= ($row["id"])						? $row["id"]					: ($this->id			? $this->id				: 0);
			$this->layout_id				= ($row["layout_id"])				? $row["layout_id"]				: ($this->layout_id		? $this->layout_id		: 0);
			$this->title					= ($row["title"])					? $row["title"]					: ($this->title			? $this->title			: "");
			$this->updated					= ($row["updated"])					? $row["updated"]				: ($this->updated		? $this->updated		: "");
			$this->entered					= ($row["entered"])					? $row["entered"]				: ($this->entered		? $this->entered		: "");
			$this->status					= ($row["status"])					? $row["status"]				: ($this->status		? $this->status			: "");
			$this->price					= ($row["price"])					? $row["price"]					: ($this->price			? $this->price			: "0.00");
			$this->editable                 = ($row["editable"])                ? $row["editable"]              : "y";
		}

		function Save() {
			$this->prepareToSave();
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			if ($this->id) {
				$sql  = "UPDATE ListingTemplate SET"
					. " layout_id             = $this->layout_id,"
					. " title                 = $this->title,"
					. " updated               = NOW(),"
					. " status                = $this->status,"
					. " price                 = $this->price"
					. " WHERE id  = $this->id";
				$dbObj->query($sql);

			} else {
				$sql = "INSERT INTO ListingTemplate"
					. " ("
					. " layout_id,"
					. " title,"
					. " updated,"
					. " entered,"
					. " status,"
					. " price,"
					. " cat_id"
					. " )"
					. " VALUES"
					. " ("
					. " $this->layout_id,"
					. " $this->title,"
					. " NOW(),"
					. " NOW(),"
					. " $this->status,"
					. " $this->price,"
					. " ''"
					. " )";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		function clearListingTemplateFields() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "DELETE FROM ListingTemplate_Field WHERE listingtemplate_id = $this->id";
			$dbObj->query($sql);
		}

		function addListingTemplateField($ltf) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql = "INSERT INTO ListingTemplate_Field"
				. " ("
				. " listingtemplate_id,"
				. " field,"
				. " label,"
				. " fieldvalues,"
				. " instructions,"
				. " required,"
				. " search,"
				. " searchbykeyword,"
				. " searchbyrange,"
				. " show_order,"
				. " enabled"
				. " )"
				. " VALUES"
				. " ("
				. " ".db_formatNumber($this->id).","
				. " ".db_formatString($ltf["field"]).","
				. " ".db_formatString($ltf["label"]).","
				. " ".db_formatString($ltf["fieldvalues"]).","
				. " ".db_formatString($ltf["instructions"]).","
				. " ".db_formatString($ltf["required"]).","
				. " ".db_formatString($ltf["search"]).","
				. " ".db_formatString($ltf["searchbykeyword"]).","
				. " ".db_formatString($ltf["searchbyrange"]).","
				. " ".db_formatString($ltf["show_order"]).","
				. " ".db_formatString($ltf["enabled"] ? $ltf["enabled"] : "n").""
				. " )";
			$dbObj->query($sql);
		}

		function retrieveAllTemplates(){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT * FROM ListingTemplate WHERE 1";
			$sql .= " ORDER BY title";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_array($result)) $data[] = $row;
			if($data) return $data; else return false;
		}

		function getListingTemplateFields($field_name="", $enabled = false) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT * FROM ListingTemplate_Field WHERE listingtemplate_id = $this->id ".($enabled ? "AND enabled = 'y'" : "");
			if (string_strlen(trim($field_name))>0) {
				$field_name = db_formatString($field_name);
				$sql .= " AND field = $field_name ";
			}
			$sql .= " ORDER BY show_order";
			$result = $dbObj->query($sql);
			if ($result && (mysql_num_rows($result) >= 1)) {
				while ($row = mysql_fetch_array($result)) {
					$fields[] = $row;
				}
				if ($fields) {
					return $fields;
				}
			}
			return false;
		}

        function getFieldByLabel($label = "", $enabled = true){
            $dbMain = db_getDBObject(DEFAULT_DB, true);

			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT field FROM ListingTemplate_Field WHERE label = ".db_formatString($label)." ".($enabled ? "AND enabled = 'y'" : "");
            $sql .= " ORDER BY show_order";
			$result = $dbObj->query($sql);
			if ($result && (mysql_num_rows($result) >= 1)) {
				while ($row = mysql_fetch_array($result)) {
					$fields = $row["field"];
				}
				if ($fields) {
					return $fields;
				}
			}
			return false;


        }

		function Delete() {

			$this->clearListingTemplateFields();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			/*
			 * Need make $listingObj->save() to update listing table to front
			 */
			$sql = "SELECT id FROM Listing WHERE listingtemplate_id = ".$this->id;
			$result = $dbObj->query($sql);
			if(mysql_num_rows($result) > 0){
				while($row = mysql_fetch_assoc($result)){
					unset($listingObj);
					$listingObj = new Listing($row["id"]);
					$listingObj->setString("listingtemplate_id", "NULL");
					$listingObj->Save();
				}
			}

			$sql = "DELETE FROM ListingTemplate WHERE id = $this->id";
			$dbObj->query($sql);

		}

		function getCategories() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT cat_id FROM ListingTemplate WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_id"]) {
					$cat_id = explode(",", $row["cat_id"]);
					foreach ($cat_id as $catid) {
						$categories[] = new ListingCategory($catid);
					}
				}
			}
			return $categories;
		}

		function setCategories($array) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$cat_id = "";
			if ($array) {
				foreach ($array as $category) {
					if ($category) {
						$catid[] = $category;
					}
				}
			}
			if ($catid) $cat_id = implode(",", $catid);
			$sql = "UPDATE ListingTemplate SET cat_id = ".db_formatString($cat_id)." WHERE id = $this->id";
			$dbObj->query($sql);
		}

	}

?>
