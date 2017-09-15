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
	# * FILE: /functions/customtext_funct.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		customtext_new($name, $value);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name customtext_new
	 * @access Public
	 * @param varchar $name
	 * @param varchar $value
	 */
	function customtext_new($name, $value) {
		if ($name) {
			$customtextObj = new CustomText($name);
			if (!$customtextObj->getString("name")) {
				$customtextObj->setString("name", $name);
				$customtextObj->setString("value", $value);
				$customtextObj->Save($update = false);
				return true;
			}
		}
		return false;
	}

	/**
	 * <code>
	 *		customtext_get($name, $value);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name customtext_get
	 * @access Public
	 * @param varchar $name
	 * @param varchar $value
	 */
	function customtext_get($name, &$value) {
		if ($name) {
			$customtextObj = new CustomText($name);
			if ($customtextObj->getString("name")) {
				$value = $customtextObj->getString("value");
				return true;
			}
		}
		$value = "";
		return false;
	}

	/**
	 * <code>
	 *		customtext_getByArray($array);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name customtext_getByArray
	 * @access Public
	 * @param array $array
	 */
	function customtext_getByArray($array) {

		if (is_array($array) && count($array) > 0) {

			unset($aux_array);
			$aux_array = array();
            $aux_array = implode(" OR ",$array);

            $db = db_getDBObject();
			$sql = "SELECT name, value FROM CustomText WHERE (".$aux_array.")";

			$result = $db->query($sql);
			if(mysql_num_rows($result)){
				unset($return_array);
				$return_array = array();
				while($row = mysql_fetch_assoc($result)){
					$return_array[$row["name"]] = $row["value"];
				}
				return $return_array;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}

	/**
	 * <code>
	 *		customtext_set($name, $value);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name customtext_set
	 * @access Public
	 * @param varchar $name
	 * @param varchar $value
	 */
	function customtext_set($name, $value) {
		if ($name) {
			$customtextObj = new CustomText($name);
			if ($customtextObj->getString("name")) {
				$customtextObj->setString("value", $value);
				$customtextObj->Save();
				return true;
			}
		}
		return false;
	}

	/**
	 * <code>
	 *		customtext_delete($name);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name customtext_delete
	 * @access Public
	 * @param varchar $name
	 */
	function customtext_delete($name) {
		if ($name) {
			$customtextObj = new CustomText($name);
			return $customtextObj->Delete();
		}
		return false;
	}

?>
