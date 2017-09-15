<?

	/*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*\
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
	\*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/validate_querystring.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	//facebook comment bug fix
	if (string_strpos($_SERVER["HTTP_REFERER"], "facebook.com/l.php") !== false){
		if ($_GET["id"] && string_strpos($_SERVER["REQUEST_URI"], "/index.php") !== false){
			header("Location: ".DEFAULT_URL);
			exit;
		}
	}

	if ($_GET["id"]) if (!is_numeric($_GET["id"]) || ($_GET["id"] <= 0) || (string_strpos($_GET["id"], "x") !== false) || (string_strpos($_GET["id"], ".") !== false)) $_GET["id"] = 0;
	if ($_POST["id"]) if (!is_numeric($_POST["id"]) || ($_POST["id"] <= 0) || (string_strpos($_POST["id"], "x") !== false) || (string_strpos($_POST["id"], ".") !== false)) $_POST["id"] = 0;

	if ($_GET["category_id"]) if (!is_numeric($_GET["category_id"]) || ($_GET["category_id"] <= 0) || (string_strpos($_GET["category_id"], "x") !== false) || (string_strpos($_GET["category_id"], ".") !== false)) $_GET["category_id"] = 0;
	if ($_POST["category_id"]) if (!is_numeric($_POST["category_id"]) || ($_POST["category_id"] <= 0) || (string_strpos($_POST["category_id"], "x") !== false) || (string_strpos($_POST["category_id"], ".") !== false)) $_POST["category_id"] = 0;

	if ($_GET["location_1"]) if (!is_numeric($_GET["location_1"]) || ($_GET["location_1"] <= 0) || (string_strpos($_GET["location_1"], "x") !== false) || (string_strpos($_GET["location_1"], ".") !== false)) $_GET["location_1"] = 0;
	if ($_POST["location_1"]) if (!is_numeric($_POST["location_1"]) || ($_POST["location_1"] <= 0) || (string_strpos($_POST["location_1"], "x") !== false) || (string_strpos($_POST["location_1"], ".") !== false)) $_POST["location_1"] = 0;

	if ($_GET["location_2"]) if (!is_numeric($_GET["location_2"]) || ($_GET["location_2"] <= 0) || (string_strpos($_GET["location_2"], "x") !== false) || (string_strpos($_GET["location_2"], ".") !== false)) $_GET["location_2"] = 0;
	if ($_POST["location_2"]) if (!is_numeric($_POST["location_2"]) || ($_POST["location_2"] <= 0) || (string_strpos($_POST["location_2"], "x") !== false) || (string_strpos($_POST["location_2"], ".") !== false)) $_POST["location_2"] = 0;

	if ($_GET["location_3"]) if (!is_numeric($_GET["location_3"]) || ($_GET["location_3"] <= 0) || (string_strpos($_GET["location_3"], "x") !== false) || (string_strpos($_GET["location_3"], ".") !== false)) $_GET["location_3"] = 0;
	if ($_POST["location_3"]) if (!is_numeric($_POST["location_3"]) || ($_POST["location_3"] <= 0) || (string_strpos($_POST["location_3"], "x") !== false) || (string_strpos($_POST["location_3"], ".") !== false)) $_POST["location_3"] = 0;

	if ($_GET["location_4"]) if (!is_numeric($_GET["location_4"]) || ($_GET["location_4"] <= 0) || (string_strpos($_GET["location_4"], "x") !== false) || (string_strpos($_GET["location_4"], ".") !== false)) $_GET["location_4"] = 0;
	if ($_POST["location_4"]) if (!is_numeric($_POST["location_4"]) || ($_POST["location_4"] <= 0) || (string_strpos($_POST["location_4"], "x") !== false) || (string_strpos($_POST["location_4"], ".") !== false)) $_POST["location_4"] = 0;

	if ($_GET["location_5"]) if (!is_numeric($_GET["location_5"]) || ($_GET["location_5"] <= 0) || (string_strpos($_GET["location_5"], "x") !== false) || (string_strpos($_GET["location_5"], ".") !== false)) $_GET["location_5"] = 0;
	if ($_POST["location_5"]) if (!is_numeric($_POST["location_5"]) || ($_POST["location_5"] <= 0) || (string_strpos($_POST["location_5"], "x") !== false) || (string_strpos($_POST["location_5"], ".") !== false)) $_POST["location_5"] = 0;
    
	if ($_GET["account_id"]) if (!is_numeric($_GET["account_id"]) || ($_GET["account_id"] <= 0) || (string_strpos($_GET["account_id"], "x") !== false) || (string_strpos($_GET["account_id"], ".") !== false)) $_GET["account_id"] = 0;
	if ($_POST["account_id"]) if (!is_numeric($_POST["account_id"]) || ($_POST["account_id"] <= 0) || (string_strpos($_POST["account_id"], "x") !== false) || (string_strpos($_POST["account_id"], ".") !== false)) $_POST["account_id"] = 0;

	if ($_GET["listing_id"]) if (!is_numeric($_GET["listing_id"]) || ($_GET["listing_id"] <= 0) || (string_strpos($_GET["listing_id"], "x") !== false) || (string_strpos($_GET["listing_id"], ".") !== false)) $_GET["listing_id"] = 0;
	if ($_POST["listing_id"]) if (!is_numeric($_POST["listing_id"]) || ($_POST["listing_id"] <= 0) || (string_strpos($_POST["listing_id"], "x") !== false) || (string_strpos($_POST["listing_id"], ".") !== false)) $_POST["listing_id"] = 0;

	if ($_GET["promotion_id"]) if (!is_numeric($_GET["promotion_id"]) || ($_GET["promotion_id"] <= 0) || (string_strpos($_GET["promotion_id"], "x") !== false) || (string_strpos($_GET["promotion_id"], ".") !== false)) $_GET["promotion_id"] = 0;
	if ($_POST["promotion_id"]) if (!is_numeric($_POST["promotion_id"]) || ($_POST["promotion_id"] <= 0) || (string_strpos($_POST["promotion_id"], "x") !== false) || (string_strpos($_POST["promotion_id"], ".") !== false)) $_POST["promotion_id"] = 0;

	if ($_GET["event_id"]) if (!is_numeric($_GET["event_id"]) || ($_GET["event_id"] <= 0) || (string_strpos($_GET["event_id"], "x") !== false) || (string_strpos($_GET["event_id"], ".") !== false)) $_GET["event_id"] = 0;
	if ($_POST["event_id"]) if (!is_numeric($_POST["event_id"]) || ($_POST["event_id"] <= 0) || (string_strpos($_POST["event_id"], "x") !== false) || (string_strpos($_POST["event_id"], ".") !== false)) $_POST["event_id"] = 0;

	if ($_GET["banner_id"]) if (!is_numeric($_GET["banner_id"]) || ($_GET["banner_id"] <= 0) || (string_strpos($_GET["banner_id"], "x") !== false) || (string_strpos($_GET["banner_id"], ".") !== false)) $_GET["banner_id"] = 0;
	if ($_POST["banner_id"]) if (!is_numeric($_POST["banner_id"]) || ($_POST["banner_id"] <= 0) || (string_strpos($_POST["banner_id"], "x") !== false) || (string_strpos($_POST["banner_id"], ".") !== false)) $_POST["banner_id"] = 0;

	if ($_GET["classified_id"]) if (!is_numeric($_GET["classified_id"]) || ($_GET["classified_id"] <= 0) || (string_strpos($_GET["classified_id"], "x") !== false) || (string_strpos($_GET["classified_id"], ".") !== false)) $_GET["classified_id"] = 0;
	if ($_POST["classified_id"]) if (!is_numeric($_POST["classified_id"]) || ($_POST["classified_id"] <= 0) || (string_strpos($_POST["classified_id"], "x") !== false) || (string_strpos($_POST["classified_id"], ".") !== false)) $_POST["classified_id"] = 0;

	if ($_GET["article_id"]) if (!is_numeric($_GET["article_id"]) || ($_GET["article_id"] <= 0) || (string_strpos($_GET["article_id"], "x") !== false) || (string_strpos($_GET["article_id"], ".") !== false)) $_GET["article_id"] = 0;
	if ($_POST["article_id"]) if (!is_numeric($_POST["article_id"]) || ($_POST["article_id"] <= 0) || (string_strpos($_POST["article_id"], "x") !== false) || (string_strpos($_POST["article_id"], ".") !== false)) $_POST["article_id"] = 0;

	if ($_GET["item_id"]) if (!is_numeric($_GET["item_id"]) || ($_GET["item_id"] <= 0) || (string_strpos($_GET["item_id"], "x") !== false) || (string_strpos($_GET["item_id"], ".") !== false)) $_GET["item_id"] = 0;
	if ($_POST["item_id"]) if (!is_numeric($_POST["item_id"]) || ($_POST["item_id"] <= 0) || (string_strpos($_POST["item_id"], "x") !== false) || (string_strpos($_POST["item_id"], ".") !== false)) $_POST["item_id"] = 0;

	if ($_GET["dist"]) if (!is_numeric($_GET["dist"]) || ($_GET["dist"] <= 0) || (string_strpos($_GET["dist"], "x") !== false) || (string_strpos($_GET["dist"], ".") !== false)) $_GET["dist"] = 0;
	if ($_POST["dist"]) if (!is_numeric($_POST["dist"]) || ($_POST["dist"] <= 0) || (string_strpos($_POST["dist"], "x") !== false) || (string_strpos($_POST["dist"], ".") !== false)) $_POST["dist"] = 0;

	if ($_GET["screen"]) if (!is_numeric($_GET["screen"]) || ($_GET["screen"] <= 0) || (string_strpos($_GET["screen"], "x") !== false) || (string_strpos($_GET["screen"], ".") !== false)) $_GET["screen"] = 0;
	if ($_POST["screen"]) if (!is_numeric($_POST["screen"]) || ($_POST["screen"] <= 0) || (string_strpos($_POST["screen"], "x") !== false) || (string_strpos($_POST["screen"], ".") !== false)) $_POST["screen"] = 0;

    if ($_GET["avg_review"]) if (!is_numeric($_GET["avg_review"]) || ($_GET["avg_review"] < 0) || ($_GET["avg_review"] > 5) || (string_strpos($_GET["avg_review"], "x") !== false) || (string_strpos($_GET["avg_review"], ".") !== false)) $_GET["avg_review"] = 0;
	if ($_POST["avg_review"]) if (!is_numeric($_POST["avg_review"]) || ($_POST["avg_review"] < 0) || ($_POST["avg_review"] > 5) || (string_strpos($_POST["avg_review"], "x") !== false) || (string_strpos($_POST["avg_review"], ".") !== false)) $_POST["avg_review"] = 0;
    
    if ($_GET["price"]) if (!is_numeric($_GET["price"]) || ($_GET["price"] < 0) || ($_GET["price"] > 4) || (string_strpos($_GET["price"], "x") !== false) || (string_strpos($_GET["price"], ".") !== false)) $_GET["price"] = 0;
	if ($_POST["price"]) if (!is_numeric($_POST["price"]) || ($_POST["price"] < 0) || ($_POST["price"] > 4) || (string_strpos($_POST["price"], "x") !== false) || (string_strpos($_POST["price"], ".") !== false)) $_POST["price"] = 0;
    
    if ($_GET["filter_deal"]) if ($_GET["filter_deal"] != "yes") $_GET["filter_deal"] = 0;
    if ($_POST["filter_deal"]) if ($_POST["filter_deal"] != "yes") $_POST["filter_deal"] = 0;
    
	if ($_GET["zip"]) if (string_strlen($_GET["zip"]) > 10) $_GET["zip"] = "";
	if ($_POST["zip"]) if (string_strlen($_POST["zip"]) > 10) $_POST["zip"] = "";
    
    if ($_GET["categories"]) {
        $auxCats = explode("-", $_GET["categories"]);
        $validAuxCats = array();
        foreach ($auxCats as $auxCat) {
            if (is_numeric($auxCat) && ($auxCat > 0) && (string_strpos($auxCat, "x") === false) && (string_strpos($auxCat, ".") === false)) {
                $validAuxCats[] = $auxCat;
            }
        }
        $_GET["categories"] = implode("-", $validAuxCats);
    }
    
    if ($_POST["categories"]) {
        $auxCats = explode("-", $_POST["categories"]);
        $validAuxCats = array();
        foreach ($auxCats as $auxCat) {
            if (is_numeric($auxCat) && ($auxCat > 0) && (string_strpos($auxCat, "x") === false) && (string_strpos($auxCat, ".") === false)) {
                $validAuxCats[] = $auxCat;
            }
        }
        $_POST["categories"] = implode("-", $validAuxCats);
    }
    
    $locationsToShow = system_retrieveLocationsToShow("array");
    if (is_array($locationsToShow)) {
        foreach ($locationsToShow as $locToShow) {
            if ($_GET["filter_location_".$locToShow]) {
                $auxLocs = explode("-", $_GET["filter_location_".$locToShow]);
                $validAuxLocs = array();
                foreach ($auxLocs as $auxLoc) {
                    if (is_numeric($auxLoc) && ($auxLoc > 0) && (string_strpos($auxLoc, "x") === false) && (string_strpos($auxLoc, ".") === false)) {
                        $validAuxLocs[] = $auxLoc;
                    }
                }
                $_GET["filter_location_".$locToShow] = implode("-", $validAuxLocs);
            }

            if ($_POST["filter_location_".$locToShow]) {
                $auxLocs = explode("-", $_POST["filter_location_".$locToShow]);
                $validAuxLocs = array();
                foreach ($auxLocs as $auxLoc) {
                    if (is_numeric($auxLoc) && ($auxLoc > 0) && (string_strpos($auxLoc, "x") === false) && (string_strpos($auxLoc, ".") === false)) {
                        $validAuxLocs[] = $auxLoc;
                    }
                }
                $_POST["filter_location_".$locToShow] = implode("-", $validAuxLocs);
            }
        }
    }
    
    if ($_GET["rating"]) {
        $auxRating = explode("-", $_GET["rating"]);
        $validAuxRating = array();
        foreach ($auxRating as $auxR) {
            if (is_numeric($auxR) && ($auxR > 0) && (string_strpos($auxR, "x") === false) && (string_strpos($auxR, ".") === false)) {
                $validAuxRating[] = $auxR;
            }
        }
        $_GET["rating"] = implode("-", $validAuxRating);
    }
    
    if ($_POST["rating"]) {
        $auxRating = explode("-", $_POST["rating"]);
        $validAuxRating = array();
        foreach ($auxRating as $auxR) {
            if (is_numeric($auxR) && ($auxR > 0) && (string_strpos($auxR, "x") === false) && (string_strpos($auxR, ".") === false)) {
                $validAuxRating[] = $auxR;
            }
        }
        $_POST["rating"] = implode("-", $validAuxRating);
    }

	if ($_GET["filter_price"]) {
        $auxPrice = explode("-", $_GET["filter_price"]);
        $validAuxPrice = array();
        foreach ($auxPrice as $auxP) {
            if (is_numeric($auxP) && ($auxP > 0) && (string_strpos($auxP, "x") === false) && (string_strpos($auxP, ".") === false)) {
                $validAuxPrice[] = $auxP;
            }
        }
        $_GET["filter_price"] = implode("-", $validAuxPrice);
    }
    
    if ($_POST["filter_price"]) {
        $auxPrice = explode("-", $_POST["filter_price"]);
        $validAuxPrice = array();
        foreach ($auxPrice as $auxP) {
            if (is_numeric($auxP) && ($auxP > 0) && (string_strpos($auxP, "x") === false) && (string_strpos($auxP, ".") === false)) {
                $validAuxPrice[] = $auxP;
            }
        }
        $_POST["filter_price"] = implode("-", $validAuxPrice);
    }

	if ($_GET["searchby"]) if (($_GET["searchby"] != "zipcode") && ($_GET["searchby"] != "location")) $_GET["searchby"] = "";
	if ($_POST["searchby"]) if (($_POST["searchby"] != "zipcode") && ($_POST["searchby"] != "location")) $_POST["searchby"] = "";

	if ($_GET["keyword"]) {
		$_GET["keyword"] = str_replace("%", "", $_GET["keyword"]);
		$_GET["keyword"] = system_denyInjections(trim($_GET["keyword"])); 
	}
	if ($_POST["keyword"]) {
		$_POST["keyword"] = str_replace("%", "", $_POST["keyword"]);
		$_POST["keyword"] = system_denyInjections(trim($_POST["keyword"]));
	}

	if ($_GET["where"]) {
		$_GET["where"] = str_replace("%", "", $_GET["where"]);
		$_GET["where"] = system_denyInjections(trim($_GET["where"]));
	}
	if ($_POST["where"]) {
		$_POST["where"] = str_replace("%", "", $_POST["where"]);
		$_POST["where"] = system_denyInjections(trim($_POST["where"]));
	}
    
    if ($_GET["openMap"]) {
        if ($_GET["openMap"] != 1) {
            unset($_GET["openMap"]);
        }
    }
    
    if ($_GET["filter_valid_for"]) {
        if ($_GET["filter_valid_for"] != "deal_week" && $_GET["filter_valid_for"] != "deal_1_day" && $_GET["filter_valid_for"] != "deal_2_day") {
            unset($_GET["filter_valid_for"]);
        }
    }
    
    if ($_POST["filter_valid_for"]) {
        if ($_POST["filter_valid_for"] != "deal_week" && $_POST["filter_valid_for"] != "deal_1_day" && $_POST["filter_valid_for"] != "deal_2_day") {
            unset($_POST["filter_valid_for"]);
        }
    }

?>
