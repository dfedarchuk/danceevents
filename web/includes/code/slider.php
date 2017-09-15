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
	# * FILE: /includes/code/slider.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["autocomplete"]) {

		header("Content-Type: application/json; charset=".EDIR_CHARSET, TRUE);

		# ----------------------------------------------------------------------------------------------------
		# INPUT VERIFICATION
		# ----------------------------------------------------------------------------------------------------
		$slideArea = $_GET['slideArea'];
		$input    = string_strtolower(trim($_GET[("term")]));

		# ----------------------------------------------------------------------------------------------------
		# AUTO COMPLETE
		# ----------------------------------------------------------------------------------------------------
		if ($input) {

			$rows = array();
			$dbObj_main = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj_main);

			$modules = [];
			$modules[] = "Listing";

			if ($slideArea == "app_home") {
				if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
					$modules[] = "Event";
				}
				if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
					$modules[] = "Classified";
				}
				if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
					$modules[] = "Article";
				}
				if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
					$modules[] = "Promotion";
				}
				if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") {
					$modules[] = "Post";
				}
			}

			//Modules
			foreach ($modules as $module) {
				$sql = "SELECT '$module' as module, id, ".($module == "Promotion" ? "name as title" : "title")." FROM $module WHERE (".($module == "Promotion" ? "name" : "title")." LIKE ".db_formatString('%'.$input.'%').") ".($module == "Promotion" ? "" : "AND status = 'A'")." ";

				if ($module == "Event") {
					$sql .= " AND ((Event.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') OR Event.until_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND repeat_event = 'N') OR (repeat_event = 'Y'))";
				} elseif ($module == "Promotion") {
					$sql .= " AND Promotion.listing_status = 'A' AND Promotion.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND Promotion.start_date <= DATE_FORMAT(NOW(), '%Y-%m-%d') AND Promotion.listing_id > 0";
				}

				$_rows = $dbObj->unbuffered_query($sql);
				while ($row = mysql_fetch_array($_rows)) {
					$rows[] = $row;
				}
			}
			$countJson = 0;
			$resultsJson = array();
			foreach ($rows as $row) {
				$auxItem = constant("LANG_".strtoupper(($row["module"] == "Post" ? "Blog" : $row["module"]))."_FEATURE_NAME")." - ".$row["title"];
				$resultsJson[$countJson]["label"] = $auxItem;
				$resultsJson[$countJson]["value"] = $auxItem;
				$resultsJson[$countJson]["id"] = $row["id"];
				$resultsJson[$countJson]["module"] = ($row["module"] == "Promotion" ? "Deal" : ($row["module"] == "Post" ? "Blog" : $row["module"]));
				$countJson++;
			}

			echo json_encode($resultsJson);

		}
		exit;
	
	} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["settings"] && !DEMO_LIVE_MODE) {

		if (!$_POST["area"]) $_POST["area"] = "web";

		/*
		 * Prepare POST to validate
		 */
		 if ($_FILES) {
		 	$i = 1;
		 	$image_errors = array();

		 	$maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1)."00000";

		 	foreach ($_FILES as $key => $value) {

		 		if (strlen($value["tmp_name"]) > 0) {
		 			if (image_upload_check($value["tmp_name"])) {
		 				if (strlen($value["name"])) {
		 					$_POST[$key] = $value["name"];
		 				}
		 			} else {
		 				$image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_ITEM_SLIDER." ".$i." - ".LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
		 			}

		 			if ($value["size"] > $maxImageSize) {
		 				$image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_ITEM_SLIDER." ".$i." - ".system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS." ".UPLOAD_MAX_SIZE."MB."));
		 			}

					//Validate image dimensions
					if ($_POST["area"] != "web") {
						$info = @getimagesize($value["tmp_name"]);
						if ($info[0] != IMAGE_MOBILE_SLIDER_WIDTH || $info[1] != IMAGE_MOBILE_SLIDER_HEIGHT) { //wrong image dimensions. Check if it's proportional

							if (($info[0] % IMAGE_MOBILE_SLIDER_WIDTH) || ($info[1] % IMAGE_MOBILE_SLIDER_HEIGHT)) { //image is not proportional.
								$image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_SLIDER_WARNING);
							}

						}
					}

		 		}
		 		$i++;
		 	}
		 }

		/*
		 * Validate form
		 */
		if ((count($image_errors) == 0)) {
			/*
			 * Get all items of slider to save
			 */
			$array_save_slider = array();

			for ($i = 1; $i <= $_POST["number_of_items"]; $i++) {

				/*
				 * Preparing items to save
				 */
				$array_save_slider[$i]["title"] = trim($_POST[$i."_title"]);

                // strip \r chars provided by Windows, in order to keep character count standard
                if ($_POST[$i."_summary"]) {
                    $array_save_slider[$i]["summary"] = str_replace("\r", "", $_POST[$i."_summary"]);
                }

				if ($_POST["area"] != "web") {
					if (!$_POST[$i . "_link"] && $i == $_POST["last_slide_changed"]) {
						$image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_SLIDERAPP_EMPTYLINK)." ".$i.".";
					} else {
					    $slideModule = $_POST[$i . $_POST["area"] . "_autocomplete_module"];
					    switch ($slideModule) {
                            case "post": $slideModule = "blog";
                                            break;
                            case "promotion": $slideModule = "deal";
                                            break;
                        }
						$array_save_slider[$i]["link"] = strtolower($slideModule."_".$_POST[$i . $_POST["area"] . "_autocomplete_id"]);
					}

				} else {
					if ($_POST[$i . "_link"]) {
						// fixing url field if needed.
						if (trim($_POST[$i . "_link"]) != "") {
							if (string_strpos($_POST[$i . "_link"], "://") === false) {
								$_POST[$i . "_link"] = "http://".$_POST[$i . "_link"];
							}
						}

						$array_save_slider[$i]["link"] = str_replace("\r", "", $_POST[$i . "_link"]);
					}
				}

				$array_save_slider[$i]["id"]			= $_POST[$i."_id"];
				$array_save_slider[$i]["target"]        = ($_POST[$i."_target_window"] ? "blank" : "self");
				$array_save_slider[$i]["slide_order"]	= $i;
				$array_save_slider[$i]["image_id"]		= $_POST[$i."_image_id"];
				$array_save_slider[$i]["title"]         = preg_replace('/\s\s+/', ' ', $array_save_slider[$i]["title"]);

				/*
				 * Upload Images
				 */
				if ($_FILES[$i."_image"]["error"] == 0) {
                    $imageObj = image_upload($_FILES[$i."_image"]["tmp_name"], IMAGE_SLIDER_WIDTH, IMAGE_SLIDER_HEIGHT, 'sitemgr_', false);
					if ($imageObj) {
						$array_save_slider[$i]["image_id"] = $imageObj->getNumber("id");
						unset($imageObj);
					}
				} elseif (!$_POST[$_POST["last_slide_changed"]."_image_id"] && $i == $_POST["last_slide_changed"]) {
					$image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_SLIDER_EMPTYIMAGE)." $i.";
				}

                if (!$array_save_slider[$i]["image_id"]) {
                    $array_save_slider[$i]["title"] = "";
                    $array_save_slider[$i]["summary"] = "";
                    $array_save_slider[$i]["link"] = "";
                    $array_save_slider[$i]["price"] = "";
                }
			}

			/*
			 * Saving slider items on database
			 */
			if ((count($image_errors) == 0)) {
				for ($i = 1; $i <= $_POST["number_of_items"]; $i++) {
					unset($sliderObj);

					if ($_POST["area"] != "web") {
						if (!$array_save_slider[$i]["link"]) {
							$array_save_slider[$i]["image_id"] = "";
						}
					}

					if ($array_save_slider[$i]["image_id"]) {
						$message = system_showText(LANG_SITEMGR_SLIDER_MESSAGE_SAVED);
						$array_save_slider[$i]["area"] = $_POST["area"];
						$sliderObj = new Slider($array_save_slider[$i]);
						$sliderObj->save();
					}

				}

				if ($message) {
					header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/slider/index.php?message=".urlencode($message));
				} else {
					header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/slider/index.php");
				}
				exit;

			}

		}

		if (count($image_errors) > 0) {

			if ($mobile) {
				foreach ($slideAreas as $slideArea) {
					${"array_slider".$slideArea} = [];
					foreach ($_POST as $key => $value) {
						$auxKey = substr($key,0,1);
						if (strpos($key, $slideArea) === false) {
							$auxKey2 = substr($key, 2);
						} else {
							$auxKey2 = substr($key,1);
							$auxKey2 = str_replace($slideArea."_", "", $auxKey2);
						}
						if (is_numeric($auxKey) || strpos($auxKey, $slideArea) !== false) {
							${"array_slider" . $slideArea}[$auxKey][$auxKey2] = htmlspecialchars($value);
						}
					}
				}
			} else {
				$array_slider = [];
				foreach ($_POST as $key => $value) {
					if (is_numeric(substr($key,0,1))) {
						$array_slider[substr($key, 0, 1)][substr($key, 2)] = htmlspecialchars($value);
					}
				}
			}
			$error = 1;
			$message_slider .= implode("<br />", $image_errors);
			$message = $message_slider;
		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	} elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["delete"] && !DEMO_LIVE_MODE) {

		$sliderObj = new Slider($_POST["slider_id"]);
		$sliderObj->Delete();

        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/slider/index.php");
        exit;

    } elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["order"] && !DEMO_LIVE_MODE) {

        $_POST['array_slider'] = format_magicQuotes($_POST['array_slider']);
        $success = Slider::SaveOrder($_POST['array_slider']) ? 'success' : 'failed';

        header('Content-type: application/json;charset=utf-8');
        echo json_encode(['status' => $success]);
        exit;
    }

	/**
	 * Get slider items
	 */
	$sliderObj = new Slider();

	if ($_SERVER['REQUEST_METHOD'] != "POST") {

		if ($mobile) {
			foreach ($slideAreas as $slideArea) {
				${"array_slider".$slideArea} = $sliderObj->getAllSliderItems(SELECTED_DOMAIN_ID, $slideArea);

				for ($slider_number = 1; $slider_number <= TOTAL_SLIDER_ITEMS; $slider_number++) {
					$auxLinkSlide = explode("_", ${"array_slider".$slideArea}[$slider_number]["link"]);
					if ($auxLinkSlide[0]) {
                        switch ($auxLinkSlide[0]) {
                            case "blog": $slideModule = "post";
                                break;
                            case "deal": $slideModule = "promotion";
                                break;
                            default: $slideModule = $auxLinkSlide[0];
                        }
						$auxModule = ucfirst($slideModule);
						$moduleObj = new $auxModule($auxLinkSlide[1]);
						${"array_slider" . $slideArea}[$slider_number]["autocomplete_module"] = $slideModule;
						${"array_slider" . $slideArea}[$slider_number]["autocomplete_id"] = $auxLinkSlide[1];
						${"array_slider" . $slideArea}[$slider_number]["link"] = constant("LANG_" . strtoupper(($auxLinkSlide[0] == "post" ? "Blog" : ($auxLinkSlide[0] == "deal" ? "Promotion" : $auxLinkSlide[0]))) . "_FEATURE_NAME") . " - " . $moduleObj->getString(($slideModule == "promotion" ? "name" : "title"));
					}
				}

			}
			
		} else {
			$array_slider = $sliderObj->getAllSliderItems(SELECTED_DOMAIN_ID, "web");
		}

	}