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
	# * FILE: /includes/code/fill_banner_category.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	// Security Check
	session_start();
	if(sess_isSitemgrLogged() == false && sess_isAccountLogged() == false){ exit; }

	header("Content-Type: text/xml; charset=".EDIR_CHARSET);

	if ($_GET["domain_id"]){
		$domain_id = $_GET["domain_id"];
	} else {
		$domain_id = SELECTED_DOMAIN_ID;
	}

	if ($_GET["section"]) {

		if ($_GET["from"] == "search") {

            $fields = "`id`, `enabled`, `title`";
            $wLang = "enabled = 'y'";
		} else {
			$fields = "*";
			$wLang = "enabled = 'y'";
		}

		$section = $_GET["section"];

		$return = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n";
		$return .= "<response>\n";

		if ($section == "general") {
			$return .= "<id>0</id>\n";
			$return .= "<name>".system_showText(LANG_ALLPAGESBUTITEMPAGES)."</name>\n";
		} elseif($section == "global") {
            $return .= "<id>0</id>\n";
            $return .= "<name>".system_showText(LANG_ALLPAGES)."</name>\n";
        } else {

			$return .= "<id>0</id>\n";
			$return .= "<name>".system_showText(LANG_NONCATEGORYSEARCH)."</name>\n";

			if ($section == "listing" || $section == "promotion") $tableCategory = "listingcategory";
			elseif ($section == "event") $tableCategory = "eventcategory";
			elseif ($section == "classified") $tableCategory = "classifiedcategory";
			elseif ($section == "article") $tableCategory = "articlecategory";
			elseif ($section == "blog") $tableCategory = "blogcategory";

            $categoryScalability = @constant(string_strtoupper(($section == "promotion" ? "listing" : $section))."CATEGORY_SCALABILITY_OPTIMIZATION");
			$where = "category_id IS NULL AND $wLang";
			$categories = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title", "object", $domain_id, false, $fields, $where);
			if ($categories) {
				foreach ($categories as $category) {
					if ($category->getString("title") && $category->getString("enabled") == "y") {
						if ($categoryScalability != "on") {
							$return .= "<id>0</id>\n";
							$return .= "<name>--------------------------------------------------</name>\n";
						}
						$return .= "<id>".$category->getNumber("id")."</id>\n";
						$return .= "<name>".html_entity_decode(htmlspecialchars($category->getString("title")))."</name>\n";
						if ($categoryScalability != "on") {
							$where = "category_id = ".$category->getNumber("id")." AND $wLang";
							$subcategories = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title", "object", $domain_id, false, $fields, $where);
							if ($subcategories) {
								foreach ($subcategories as $subcategory) {
									if ($subcategory->getString("title") && $subcategory->getString("enabled") == "y") {
										$return .= "<id>".$subcategory->getNumber("id")."</id>\n";
										$return .= "<name>- ".html_entity_decode(htmlspecialchars($subcategory->getString("title")))."</name>\n";
										$where = "category_id = ".$subcategory->getNumber("id");
										$subcategories2 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title", "object", $domain_id, false, $fields, $where);
										if ($subcategories2) {
											foreach ($subcategories2 as $subcategory2) {
												if ($subcategory2->getString("title") && $subcategory2->getString("enabled2") == "y") {
													$return .= "<id>".$subcategory2->getNumber("id")."</id>\n";
													$return .= "<name>-- ".html_entity_decode(htmlspecialchars($subcategory2->getString("title")))."</name>\n";
													$where = "category_id = ".$subcategory2->getNumber("id")." AND $wLang";
													$subcategories3 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title", "object", $domain_id, false, $fields, $where);
													if ($subcategories3) {
														foreach ($subcategories3 as $subcategory3) {
															if ($subcategory3->getString("title") && $subcategory3->getString("enabled") == "y") {
																$return .= "<id>".$subcategory3->getNumber("id")."</id>\n";
																$return .= "<name>--- ".html_entity_decode(htmlspecialchars($subcategory3->getString("title")))."</name>\n";
																$where = "category_id = ".$subcategory3->getNumber("id")." AND $wLang";
																$subcategories4 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title", "object", $domain_id, false, $fields, $where);
																if ($subcategories4) {
																	foreach ($subcategories4 as $subcategory4) {
																		if ($subcategory4->getString("title") && $subcategory4->getString("enabled") == "y") {
																			$return .= "<id>".$subcategory4->getNumber("id")."</id>\n";
																			$return .= "<name>---- ".html_entity_decode(htmlspecialchars($subcategory4->getString("title")))."</name>\n";
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}

			if ($categoryScalability != "on") {
				$return .= "<id>0</id>\n";
				$return .= "<name>--------------------------------------------------</name>\n";
			}

		}

		$return .= "</response>\n";

		echo $return;

	}

?>
