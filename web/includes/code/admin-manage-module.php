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
    # * FILE: /includes/code/admin-module-search.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
    $where = false;
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    $_GET  = format_magicQuotes($_GET);

    /************************************************
	* @desc Category auxiliar code
	************************************************/
	if (is_numeric($search_category_id) && !in_array($manageModule, ["promotion", "banner", "review"])) {

        if ($manageModule == "listing") {

            $catObj = new ListingCategory();
            $parents_category_ids = $catObj->getHierarchy($search_category_id, $get_parents = true, $get_children = false);
            $parents_category_ids .= ",".$catObj->getHierarchy($search_category_id, $get_parents = false, $get_children = true);

            $sql = "SELECT 
                    DISTINCT Listing.id 
                    FROM 
                    Listing 
                    INNER JOIN Listing_Category ON (Listing.id = Listing_Category.listing_id) 
                    WHERE
                    Listing_Category.category_id IN (".$parents_category_ids.")";

        } elseif ($manageModule == "blog") {

            $catObj = new BlogCategory();
            $parents_category_ids = $catObj->getHierarchy($search_category_id, $get_parents = true, $get_children = false);
            $parents_category_ids .= ",".$catObj->getHierarchy($search_category_id, $get_parents = false, $get_children = true);

            $sql = "SELECT 
				DISTINCT Post.id 
				FROM 
				Post 
				INNER JOIN Blog_Category ON (Post.id = Blog_Category.post_id) 
				WHERE
				Blog_Category.category_id IN (".$parents_category_ids.")";
        } elseif ($manageModule == "banner") {
            $sql = "SELECT id FROM Banner WHERE category_id = '$search_category_id'";
        } else {
            $sql = "SELECT id FROM ".ucfirst($manageModule)." WHERE cat_1_id = '$search_category_id' OR parcat_1_level1_id = '$search_category_id' OR cat_2_id = '$search_category_id' OR parcat_2_level1_id = '$search_category_id' OR cat_3_id = '$search_category_id' OR parcat_3_level1_id = '$search_category_id' OR cat_4_id = '$search_category_id' OR parcat_4_level1_id = '$search_category_id' OR cat_5_id = '$search_category_id' OR parcat_5_level1_id = '$search_category_id'";
        }

        $rs = $db->query($sql);
        while ($row = mysql_fetch_assoc($rs)) $module_ids_from_category[] = $row["id"];
        $category_module_ids = ($module_ids_from_category) ? implode(",", $module_ids_from_category) : "'0'";
	}

	/************************************************
	* @desc DiscountCode auxiliar code
	************************************************/
	if ($search_discount && !in_array($manageModule, ["promotion", "banner", "review"])) {

		//Invoice
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " {$manageModule}_id ";
		$sql .= " FROM ";
		$sql .= " Invoice_".ucfirst($manageModule)." ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $module_ids_from_discount[] = $row["{$manageModule}_id"];

		//Payment
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " {$manageModule}_id ";
		$sql .= " FROM ";
		$sql .= " Payment_".ucfirst($manageModule)."_Log ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $module_ids_from_discount[] = $row["{$manageModule}_id"];

		//Module
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " ".ucfirst($manageModule)." ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $module_ids_from_discount[] = $row["id"];

		/************************************************
		* @desc Removing the ids of items that are not in the category, if the category filter is active
		************************************************/
		if (is_numeric($search_category_id) && count($module_ids_from_discount) > 0) {
			if (count($module_ids_from_category) > 0) {
				$tmparray = array();
				for ($i = 0; $i < count($module_ids_from_discount); $i++) {
					if (in_array($module_ids_from_discount[$i], $module_ids_from_category)) {
						$tmparray[] = $module_ids_from_discount[$i];
					}
				}
				$module_ids_from_discount = $tmparray;
				unset($tmparray);
			} else {
				$module_ids_from_discount = "";
			}
		}

		$discount_module_ids = ($module_ids_from_discount) ? implode(",", $module_ids_from_discount) : "'0'";

	}

	/************************************************
	* @desc Category and DiscountCode auxiliar code
	************************************************/
	if ($discount_module_ids) {
		$search_module_ids = $discount_module_ids;
	} else if ($category_module_ids) {
		$search_module_ids = $category_module_ids;
	}

    /************************************************
	* @desc Title
	************************************************/
    if ($search_title) {
        if ($manageModule == "banner") {
            $sql_where[] = " caption LIKE ".db_formatString('%'.$search_title.'%')." ";
        } else {
            $search_title = str_replace("\\", "", $search_title);
            $search_for_keyword_fields[] = ($manageModule == "blog" ? "Post" : ucfirst($manageModule)).".fulltextsearch_keyword";
            $sql_where[] = system_getSQLFullTextSearch($search_title, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
        }
    }

    /************************************************
	* @desc Account
	************************************************/
    if ($manageModule != "blog") {
        if ($search_account_id && is_numeric($search_account_id) ) {
            $sql_where[] = " account_id = $search_account_id ";
        } else if (is_numeric($search_account_id)) {
            $sql_where[] = " (account_id = 0 or account_id IS NULL) ";
        }
    }

    /************************************************
	* @desc Level
	************************************************/
    if ($manageModule != "promotion" && $manageModule != "blog" && $manageModule != "banner") {
        if ($level && is_numeric($level)) {
            $sql_where[] = " level = '$level' ";
        } else if ($search_level && is_numeric($search_level)) {
            $sql_where[] = " level = '$search_level' ";
        }
    } elseif ($manageModule == "banner") {
        $bannerLevelObj = new BannerLevel(true);
        $levelsTheme = $bannerLevelObj->getValues();
        if (is_array($levelsTheme) && $levelsTheme[0]){
            $whereLevelThemes = " type IN (".implode(", ", $levelsTheme).")";
            $sql_where[] = $whereLevelThemes;
        }

        if ($search_section)    $sql_where[] = " section = ".db_formatString($search_section);
        if ($search_category)   $sql_where[] = " category_id = ".db_formatNumber($search_category);

        if (is_numeric($level)) {
            $sql_where[] = " type = '$level' ";
        } else if ($search_type) {
            $sql_where[] = " type = ".db_formatString($search_type)." ";
        }
    }

    /************************************************
	* @desc Status
	************************************************/
	if ($search_status && $manageModule != "promotion") {
        $sql_where[] = " status = ".db_formatString($search_status)." ";
    }

    /************************************************
	* @desc Categories
	************************************************/
	if ($search_module_ids) {
        $sql_where[] = " id IN (".$search_module_ids.") ";
    }

    /************************************************
	* @desc Location
	************************************************/
    if ($manageModule != "promotion" && $manageModule != "blog" && $manageModule != "article") {

        $_locations = explode(",", EDIR_LOCATIONS);
        foreach($_locations as $_location_level) {
            if (is_numeric(${"search_location_".$_location_level})) {
                $sql_where[] = " location_".$_location_level." = '${"search_location_".$_location_level}' ";
            }
        }
        unset($_locations);

        /************************************************
        * @desc Zicode
        ************************************************/
        if ($search_zipcode) {
            $sql_where[] = " zip_code LIKE ".db_formatString($search_zipcode)." ";
        }

    }

    /************************************************
	* @desc Event Date Range
	************************************************/
	if ($manageModule == "event" && (isset($search_date_period1) && $search_date_period1 != "") && (isset($search_date_period2) && $search_date_period2 != "")) {

		if (!validate_date($search_date_period1) || !validate_date($search_date_period2)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		} elseif (!validate_date_interval($search_date_period1, $search_date_period2) && ($search_date_period1 != $search_date_period2)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		}

		$where_period  = "((start_date <= ".db_formatDate($search_date_period2)." AND (end_date >= ".db_formatDate($search_date_period1)." OR until_date >= ".db_formatDate($search_date_period1)." OR repeat_event = 'Y')) AND (";
		$where_period .= "(start_date <= ".db_formatDate($search_date_period1)." AND (end_date >= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date >= ".db_formatDate($search_date_period1)." AND (end_date >= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date >= ".db_formatDate($search_date_period1)." AND (end_date <= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date <= ".db_formatDate($search_date_period1)." AND (end_date >= ".db_formatDate($search_date_period2)." OR until_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "OR (start_date <= ".db_formatDate($search_date_period1)." AND (end_date <= ".db_formatDate($search_date_period2)." OR end_date >= ".db_formatDate($search_date_period2)." OR repeat_event = 'Y')) ";
		$where_period .= "))";

		$sql_where[] = $where_period;

	} else if ((isset($search_date_period1) && $search_date_period1 != "") || (isset($search_date_period2) && $search_date_period2 != "")) {

		if (isset($search_date_period1) && $search_date_period1 != "") {
			if (validate_date($search_date_period1)) {
				$sql_where[] = " start_date >= ".db_formatDate($search_date_period1);
			} else {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
				$sql_where[] = " false ";
			}
		} else if (isset($search_date_period2) && $search_date_period2 != "") {
			if (validate_date($search_date_period2)) {
				$sql_where[] = " (end_date <= ".db_formatDate($search_date_period2)." AND end_date!='0000-00-00') OR ((until_date <= ".db_formatDate($search_date_period2)." AND recurring = 'Y' AND repeat_event = 'N') OR (repeat_event = 'Y' AND start_date <=".db_formatDate($search_date_period2)."))";
			} else {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
				$sql_where[] = " false ";
			}
		}

	}

    /************************************************
	* @desc Renewal date
	************************************************/
    if ($manageModule != "promotion" && $manageModule != "blog") {
        if (isset($search_expiration_date) && $search_expiration_date != "") {
            if (validate_isFutureDate($search_expiration_date)) {
                if ($search_opt_expiration_date == 1) {
                    $sql_where[] = " renewal_date = ".db_formatDate($search_expiration_date);
                } else if ($search_opt_expiration_date == 2) {
                    $sql_where[] = " (TO_DAYS(renewal_date) <= TO_DAYS(".db_formatDate($search_expiration_date)."))";
                }
            } else {
                $error_message = system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATE_INFUTURE);
                $sql_where[] = " false ";
            }
        }
    }

    /************************************************
	* @desc Listing Type
	************************************************/
	if ($manageModule == "listing" && string_strlen(trim($search_listingtemplate_id)) > 0) {
		if ($search_listingtemplate_id == "D") {
			$sql_where[] = " listingtemplate_id = 0";
		} else {
			$sql_where[] = " listingtemplate_id = ".db_formatNumber($search_listingtemplate_id);
		}
	}

	if ($sql_where) $where = " ".implode(" AND ", $sql_where)." ";

    # ----------------------------------------------------------------------------------------------------
	# BULK UPDATE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/bulkupdate.php");

    # ----------------------------------------------------------------------------------------------------
	# DELETE
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Delete item
        if ($action == "delete") {
            $objStr = ucfirst($manageModule == "blog" ? "post" : $manageModule);
            $moduleObj = new $objStr($_POST['id']);
            $moduleObj->delete();
            if ($manageModule == "listing" || $manageModule == "promotion") {
                $message = 4;
            } elseif ($manageModule == "banner") {
                $message = 0;
            } else {
                $message = 2;
            }
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".$manageModuleFolder."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;
        }
    }
