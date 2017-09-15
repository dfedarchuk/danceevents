<?php

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
# * FILE: /includes/code/add_mult_categories.php
# ----------------------------------------------------------------------------------------------------

####################################################################################################
### PAY ATTENTION - SAME CODE FOR LISTING, EVENT, CLASSIFIED, ARTICLE AND BLOG
####################################################################################################

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST["action"] == "add_mult_categories") {
        if ($_POST["multiple_categories"]) {
            $categories_lines = explode("\r\n", $_POST["multiple_categories"]);
            $module_table = ucfirst($_POST["moduleFolder"]) . "Category";
            $i = 0;

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);

            foreach ($categories_lines as $current_module_category) {
                unset($current_category_tree);
                $current_category_tree = explode("->", $current_module_category);
                for ($count = 0; $count < count($current_category_tree); $count++) {
                    $current_category_tree[$count] = trim($current_category_tree[$count]);
                }
                $j = 0;
                $first_category = true;
                $last_category_id = null;
                if ($current_category_tree) {
                    foreach ($current_category_tree as $current_category) {
                        if (empty($current_category)){
                            continue;
                        }
                        if ($first_category) {
                            $sql_category_id = "category_id IS NULL";
                        } else {
                            $sql_category_id = "category_id = " . db_formatString($last_category_id);
                        }

                        $sqlCategory = "SELECT id FROM $module_table WHERE $sql_category_id AND title = " . db_formatString($current_category, "", true);
                        $resultCategory = $db->query($sqlCategory);
                        if (mysql_num_rows($resultCategory) <= 0) {
                            $category_friendly_url = system_generateFriendlyURL($current_category);

                            unset($moduleCategoryObj);
                            $moduleCategoryObj = new $module_table();
                            $moduleCategoryObj->setString("title", $current_category);
                            if ($first_category) {
                                $moduleCategoryObj->setString("category_id", 'NULL');
                            } else {
                                $moduleCategoryObj->SetNumber("category_id", $last_category_id);
                            }
                            $moduleCategoryObj->setString("page_title", $current_category);
                            $moduleCategoryObj->setString("friendly_url", $category_friendly_url);
                            $moduleCategoryObj->setString("featured", $_POST["featured"] == "y" ? "y" : "n");
                            $moduleCategoryObj->setString("enabled", "y");

                            $moduleCategoryObj->Save(false);
                            $current_category_id = $moduleCategoryObj->getNumber("id");

                            $validateModules = ["ListingCategory", "EventCategory", "ClassifiedCategory", "ArticleCategory", "BlogCategory"];
                            foreach ($validateModules as $table_category) {
                                $sqlCategory = "SELECT id FROM $table_category WHERE ".($table_category == "ListingCategory" ? "id != " . $current_category_id . " AND "  : "")." friendly_url = " . db_formatString($category_friendly_url);
                                $resultCategory = $db->query($sqlCategory);

                                if (mysql_num_rows($resultCategory) > 0) {
                                    $category_friendly_url .= FRIENDLYURL_SEPARATOR . $current_category_id;
                                    $sqlCategory = "UPDATE $module_table SET friendly_url = " . db_formatString($category_friendly_url) . " WHERE id = " . $current_category_id . "";
                                    $db->query($sqlCategory);
                                }
                            }
                            if (in_array($module_table, ['ListingCategory', 'BlogCategory'])){
                                $moduleCategoryObj->updateFullFriendlyURL();
                            }
                        } else {
                            $rowCategory = mysql_fetch_assoc($resultCategory);
                            $current_category_id = $rowCategory["id"];
                        }
                        $last_category_id = $current_category_id;
                        $first_category = false;
                        $categoryIDArray[$i][$j] = $current_category_id;
                        $j++;
                    }
                }
                $i++;
            }

            $message = 10;
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".$_POST["moduleFolder"]."/categories/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;
        }
    }
}
