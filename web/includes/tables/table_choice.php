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
	# * FILE: /includes/tables/table_choice.php
	# ----------------------------------------------------------------------------------------------------

	$designations = "";

	if ($tPreview) {
		//Get fields according to level
        unset($array_fields);
        $array_fields = system_getFormFields("Listing", $levelValue);
		if (is_array($array_fields) && in_array("badges", $array_fields)){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			$sqlEC = "SELECT `image_id`, `name` FROM `Editor_Choice` WHERE `available` = 1";
			$resEC = $dbDomain->Query($sqlEC);
			if (mysql_num_rows($resEC)) {
				$designations .= "<div class=\"badges\">";
				while ($rowEC = mysql_fetch_assoc($resEC)) {
					$imgObj = new Image($rowEC["image_id"]);
					if ($imgObj->imageExists()) {
						$designations .= $imgObj->getTag(IS_UPGRADE == "on" ? true : false, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $rowEC["name"], false)." ";
					}
				}
				$designations .= "</div>";
			}
			unset($imgObj, $rowEC, $resEC, $sqlEC, $dbDomain, $dbMain);
		}
	} else {
		if (is_array($listing)) {
			$aux = $listing;
		} else if (is_object($listing)) {
			$aux = $listing->data_in_array;
		}

		/// Display the Choices images ///////////////////////////////////////////////////////

		$tmp_id = ($aux["id"]) ? $aux["id"] : ((htmlspecialchars($aux["id"])) ? htmlspecialchars($aux["id"]) : 0);
		$listingChoices = db_getFromDB("listing_choice", "listing_id", $tmp_id, "all", "editor_choice_id", "array", SELECTED_DOMAIN_ID);

		if ($listingChoices) {

			$designations .= "<div class=\"badges\">";

			foreach ($listingChoices as $list) {

				$editorChoiceObj = new EditorChoice($list["editor_choice_id"]);
				$imageObj        = new Image($editorChoiceObj->getString("image_id"));

				if ($imageObj->imageExists()) {
					$designations .= $imageObj->getTag(IS_UPGRADE == "on" ? true : false, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $editorChoiceObj->getString("name", false), false)." ";
				}

			}

			$designations .= "</div>";

		}

		////////////////////////////////////////////////////////////////////////////////////

		unset($aux);
	}
?>
