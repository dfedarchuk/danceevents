<?

  /* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/code/location_select.php
# ----------------------------------------------------------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST["location_father_id"] && $_POST["location_id"]) {
		$location_child_id = $_POST["location_id"];
		$_locations = explode(",", EDIR_LOCATIONS);

		unset($success_msg);
		foreach ($location_child_id as $child_id) {
			$locationObjName = "Location" . $_POST["location_child_level"];
			$child_location = new $locationObjName($child_id);

			$locationObjName = "Location" . $_POST["location_father_level"];
			$father_location = new $locationObjName($_POST["location_father_id"]);


			foreach ($_locations as $each_level) {
				if ($each_level < $_POST["location_father_level"]) {
					$child_location->setNumber('location_' . $each_level, $father_location->getNumber('location_' . $each_level));
				}
			}
			$child_location->setNumber('location_' . $_POST["location_father_level"], $father_location->getNumber('id'));
			$child_location->Save();
		}
		$success_msg .= string_ucwords(constant("LANG_SITEMGR_".(count($location_child_id) > 1? "NAVBAR": "LOCATION")."_".constant("LOCATION".$_POST["location_child_level"]."_SYSTEM".(count($location_child_id) > 1? "_PLURAL": ""))))." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSUPDATED);
		$_GET["operation"] = "";
	} else {
        if ($_GET["operation"]!='cancel'){
            unset($error_msg);
            if (!$_POST["location_father_id"]) {
                $error_msg .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_NO_FIELD_SELECTED);
            }

            if ($_POST["idList"] == "") {
                $error_msg .= ($error_msg? "<br />": "")."&#149;&nbsp;".system_showText(LANG_MSG_ERROR_NO_ITEM_SELECTED);
            }
        }
		$_GET["operation"] = "";

	}

}
?>