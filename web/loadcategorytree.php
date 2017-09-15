<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /loadcategorytree.php
	# ----------------------------------------------------------------------------------------------------

	define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$_GET["prefix"] = system_denyInjections($_GET["prefix"]);
	$_GET["category"] = system_denyInjections($_GET["category"]);
	$_GET["domain_id"] = system_denyInjections($_GET["domain_id"]);

    if ($_GET["category"] == "ListingCategory") {
        $catObj = new ListingCategory();

        /*
         * For sitemgr get correct categories
         */
        if ($_GET["domain_id"]) {
            $catObj->setNumber("domain_id", $_GET["domain_id"]);
        }

        $dbObj_main = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID($_GET["domain_id"], $dbObj_main);

        $return = "";

        if (string_strpos(string_strtolower($_GET["category"]), "category") !== false) {
            if ($_GET["action"] == "template") {
                $listingtemplate = new ListingTemplate($_GET["template_id"]);
                if ($listingtemplate) {
                    $templatecategories = $listingtemplate->getCategories();
                }
                if ($templatecategories) {
                    foreach ($templatecategories as $templatecategory) {
                        $arraycategories[] = $templatecategory->getNumber("id");
                    }
                    $categories = $catObj->getAllCategoriesHierarchyXML(NULL, $_GET["category_id"], implode(",", $arraycategories), $_GET["domain_id"]);
                } else {
                    $categories = $catObj->getAllCategoriesHierarchyXML(NULL, $_GET["category_id"], null, $_GET["domain_id"]);
                }
            } else {
                $categories = $catObj->getAllCategoriesHierarchyXML(NULL, $_GET["category_id"], null, $_GET["domain_id"]);
            }
        }

        if ($categories) {

            $arrayCategoriesIds = explode(",",$_GET["ajax_categories"]);

            $xml_categories = simplexml_load_string($categories);
            if (count($xml_categories->info) > 0) {
                for ($i = 0; $i < count($xml_categories->info); $i++) {
                    unset($categories);
                    foreach ($xml_categories->info[$i]->children() as $key => $value) {
                        $categories[$key] = $value;
                    }
                    if ($categories) {
                        if (in_array($categories["id"], $arrayCategoriesIds)) {
                            $style = "style=\"display:none;\"";
                            $styleSpan = "class=\"selected\"";
                        } else {
                            $style = "";
                            $styleSpan = "";
                        }

                        if ($_GET["new_tree"] == "true") {
                            if ($_GET["action"] != "main" && (($categories["children"] > 0) && (($categories["level"] + 1) < LISTING_CATEGORY_LEVEL_AMOUNT))) {
                                //Load subcategories
                                $return .= "<li><span class=\"btn btn-opencategory\" id=\"openTree_".$categories["id"]."\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", 0, '".DEFAULT_URL."'".($_GET["domain_id"] ? ",".$_GET["domain_id"] : "").", true);\" ><i class=\"ionicons ion-ios7-plus-outline\"></i><i class=\"ionicons ion-ios7-minus-outline hidden\"></i> ".$categories["title"]."</span>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$categories["id"]."\"></ul>\n</li>\n";
                            } else {
                                //Add category
                                $return .= "<li class=\"no-child\"><span $styleSpan id=\"span_".$categories["id"]."\" data-catID=\"".$categories["id"]."\">".$categories["title"]."</span></li>";
                                $return .= "<li id=\"liContent".$categories["id"]."\" style=\"display:none\">".$categories["title"]."</li>";
                            }
                        } else {
                            if ($_GET["action"] == "main") {
                                //Listing Type Form
                                $return .= "<li class=\"categoryBullet\">".$categories["title"]." <a id='categoryAdd".$categories["id"]."' $style href=\"javascript:void(0);\" onclick=\"JS_addCategory(".$categories["id"].");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
                                $return .= "<li id=\"liContent".$categories["id"]."\" style=\"display:none\">".$categories["title"]."</li>";
                            } else {
                                //Load subcategories
                                if (($categories["children"] > 0) && (($categories["level"] + 1) < LISTING_CATEGORY_LEVEL_AMOUNT)) {
                                    $return .= "<li><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", 0, '".DEFAULT_URL."'".($_GET["domain_id"] ? ",".$_GET["domain_id"]:"").");\" class=\"switchOpen\" id=\"".$_GET["prefix"]."opencategorytree_id_".$categories["id"]."\">+</a><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", 0, '".DEFAULT_URL."'".($_GET["domain_id"] ? ",".$_GET["domain_id"]:"").");\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."opencategorytree_title_id_".$categories["id"]."\">".$categories["title"]."</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", '".DEFAULT_URL."');\" class=\"switchClose\" id=\"".$_GET["prefix"]."closecategorytree_id_".$categories["id"]."\" style=\"display: none;\">-</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$categories["id"].", '".DEFAULT_URL."');\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."closecategorytree_title_id_".$categories["id"]."\" style=\"display: none;\">".$categories["title"]."</a>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$categories["id"]."\" style=\"display: none;\"></ul>\n</li>\n";
                                } else {
                                    //Add category
                                    $return .= "<li class=\"categoryBullet\">".$categories["title"]." <a id='categoryAdd".$categories["id"]."' href=\"javascript:void(0);\" $style onclick=\"JS_addCategory(".$categories["id"].");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
                                    $return .= "<li id=\"liContent".$categories["id"]."\" style=\"display:none\">".$categories["title"]."</li>";
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $return = "<li class=\"informationMessage\">".system_showText(LANG_CATEGORY_NOTFOUND)."</li>";
        }

        echo $return;
        exit;
    }

	$return = "";

    if (string_strpos(string_strtolower($_GET["category"]), "category") !== false) {
        $isNullSegment = "";
        if (!($_GET["category_id"] > 0)){
            $isNullSegment = "ISNULL(category_id) OR ";
        }
        $sql_categories = "SELECT id, title FROM ".$_GET["category"]." WHERE ". $isNullSegment ." category_id = ".db_formatNumber($_GET["category_id"])." AND title <> '' AND enabled = 'y' ORDER BY title";
        $categories = db_getFromDBBySQL($_GET["category"], $sql_categories,'',true, $_GET["domain_id"]);
    }

    if ($categories) {

        $arrayCategoriesIds = explode(",",$_GET["ajax_categories"]);

        $dbObj_main = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID($_GET["domain_id"], $dbObj_main);
        foreach ($categories as $category) {

            if (in_array($category->getNumber("id"), $arrayCategoriesIds)) {
                $style = "style=\"display:none;\"";
                $styleSpan = "class=\"selected\"";
            } else {
                $style = "";
                $styleSpan = "";
            }

            if ($_GET["new_tree"] == "true") {
                $path_count = count($category->getFullPath());
                $sql = "SELECT id FROM ".$_GET["category"]." WHERE category_id =".$category->getNumber("id")." AND title <> '' AND enabled = 'y'";
                $result = $dbObj->query($sql);
                if ($_GET["action"] != "main" && (($path_count < CATEGORY_LEVEL_AMOUNT) && (mysql_num_rows($result) > 0))) {
                    //Load subcategories
                    $return .= "<li><span class=\"btn btn-opencategory\" id=\"openTree_".$category->getNumber("id")."\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".DEFAULT_URL."'".($_GET["domain_id"] ? ",".$_GET["domain_id"] : "").", true);\" ><i class=\"ionicons ion-ios7-plus-outline\"></i><i class=\"ionicons ion-ios7-minus-outline hidden\"></i> ".$category->getString("title")."</span>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$category->getNumber("id")."\"></ul>\n</li>\n";
                } else {
                    //Add category
                    $return .= "<li class=\"no-child\"><span $styleSpan id=\"span_".$category->getNumber("id")."\" data-catID=\"".$category->getNumber("id")."\">".$category->getString("title")."</span></li>";
                    $return .= "<li id=\"liContent".$category->getNumber("id")."\" style=\"display:none\">".$category->getString("title")."</li>";
                }
            } else {

                if ($_GET["action"] == "main") {
                    $return .= "<li class=\"categoryBullet\">".$category->getString("title")." <a id='categoryAdd".$category->getNumber("id")."' $style href=\"javascript:void(0);\" onclick=\"JS_addCategory(".$category->getNumber("id").");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
                    $return .= "<li id=\"liContent".$category->getNumber("id")."\" style=\"display:none\">".$category->getString("title")."</li>";
                } else {
                    $path_count = count($category->getFullPath());
                    $sql = "SELECT id FROM ".$_GET["category"]." WHERE category_id =".$category->getNumber("id")." AND title <> '' AND enabled = 'y'";
                    $result = $dbObj->query($sql);
                    if (($path_count < CATEGORY_LEVEL_AMOUNT) && (mysql_num_rows($result) > 0)) {
                        $return .= "<li><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".DEFAULT_URL."',".$_GET["domain_id"].");\" class=\"switchOpen\" id=\"".$_GET["prefix"]."opencategorytree_id_".$category->getNumber("id")."\">+</a><a href=\"javascript:void(0);\" onclick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".DEFAULT_URL."',".$_GET["domain_id"].");\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."opencategorytree_title_id_".$category->getNumber("id")."\">".$category->getString("title")."</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"switchClose\" id=\"".$_GET["prefix"]."closecategorytree_id_".$category->getNumber("id")."\" style=\"display: none;\">-</a><a href=\"javascript:void(0);\" onclick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."closecategorytree_title_id_".$category->getNumber("id")."\" style=\"display: none;\">".$category->getString("title")."</a>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$category->getNumber("id")."\" style=\"display: none;\"></ul>\n</li>\n";
                    } else {
                        $return .= "<li class=\"categoryBullet\">".$category->getString("title")." <a id='categoryAdd".$category->getNumber("id")."' href=\"javascript:void(0);\" $style onclick=\"JS_addCategory(".$category->getNumber("id").");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
                        $return .= "<li id=\"liContent".$category->getNumber("id")."\" style=\"display:none\">".$category->getString("title")."</li>";
                    }
                }

            }
        }
    } else {
        $return = "<li class=\"informationMessage\">".system_showText(LANG_CATEGORY_NOTFOUND)."</li>";
    }

	echo $return;
