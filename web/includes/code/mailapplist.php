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
	# * FILE: /includes/code/mailapplist.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_POST["type"] == "ajax") {
        
        define("SELECTED_DOMAIN_ID", $_POST["domain_id"]);
        
        include("../../conf/loadconfig.inc.php");

        header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
        header("Accept-Encoding: gzip, deflate");
        header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check", FALSE);
        header("Pragma: no-cache");
        
        $dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        
        $sql = "SELECT id, status, progress FROM MailAppList WHERE status IN ('P', 'R') LIMIT 1";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            $current_id = $row["id"];
            $current_status = $row["status"];
            $current_progress = $row["progress"];
        }
        
        $sql = "SELECT last_exportlog FROM Control_Export_MailApp";
        $result = $dbMain->query($sql);
        $rowLast = mysql_fetch_assoc($result);
        
        $sql = "SELECT status FROM MailAppList WHERE id = ".$rowLast["last_exportlog"];
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            $last_status = $row["status"];
        }
        
        echo "current_id||".$current_id."||current_status"."||".$current_status."||current_progress||".$current_progress."||last_id||".$rowLast["last_exportlog"]."||last_status||".$last_status;
        exit;
        
    }
    
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if ($hiddenValue) {
            $id = intval($hiddenValue);
            $mailListObj = new MailAppList($id);
            $mailListObj->Delete();
            header("Location: $url_redirect/arcamailerexport.php?message=1&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "" )."");
            exit;
        } else {
        
            $_POST["title"] = trim($_POST["title"]);
            $_POST["filename"] = system_generateFriendlyURL($_POST["title"])."_".str_replace("/", "-", format_date(date("Y-m-d"))).date("his").".csv";
            $_POST["categories"] = ($_POST["module"] == "all" ? "" : $_POST["return_categories_all"]);

            if (validate_form("mailapp", $_POST, $message_mailapp)) {

                unset($mailappObj);
                $mailappObj = new MailAppList($_POST);
                $mailappObj->Save();

                if ($mailappObj->getString("useCron") == "n") {
                    $mailappObj->exportList(SELECTED_DOMAIN_ID, 0, false, $mailappObj->getNumber("id"));
                }

                $message = 0;

                header("Location: ".$url_redirect."/arcamailerexport.php?message=".$message."&screen=".$screen."&letter=".$letter."");
                exit;

            }

            // removing slashes added if required
            $_POST = format_magicQuotes($_POST);
            $_GET  = format_magicQuotes($_GET);

            extract($_POST);
            extract($_GET);
        
        }

	}  elseif ($action == "downFile" && $id) {
        $mailListObj = new MailAppList($id);
        $filePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files/".$mailListObj->getString("filename");
        $displayName = str_replace(".csv", "", $mailListObj->getString("filename"));
        if ($mailListObj->getString("status") == "F" && file_exists($filePath)) {
            system_downloadFile($filePath, $displayName, "csv");
        } else {
            header("Location: $url_redirect/arcamailerexport.php?emessage=2&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "" )."");
            exit;
        }
    }
    
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
        
    //Modules Dropdown
    $modulesDropdownOptions = "";
    $availableModules = array();
    $moduleValues = array();
    $contModules = 3;
    $moduleValues[0]["label"] = system_showText(LANG_SITEMGR_MAILAPP_SELECMODULE);
    $moduleValues[0]["value"] = "";
    $moduleValues[1]["label"] = system_showText(LANG_SITEMGR_ALL);
    $moduleValues[1]["value"] = "all";
    $moduleValues[2]["label"] = system_showText(LANG_LISTING_FEATURE_NAME);
    $moduleValues[2]["value"] = "Listing";
    $availableModules[] = "listing";
    
    if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
        $availableModules[] = "event";
        $moduleValues[$contModules]["label"] = system_showText(LANG_EVENT_FEATURE_NAME);
        $moduleValues[$contModules]["value"] = "Event";
        $contModules++;
    }
    
    if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
        $availableModules[] = "classified";
        $moduleValues[$contModules]["label"] = system_showText(LANG_CLASSIFIED_FEATURE_NAME);
        $moduleValues[$contModules]["value"] = "Classified";
        $contModules++;
    }
    
    if (ARTICLE_FEATURE == "on"  && CUSTOM_ARTICLE_FEATURE == "on") {
        $availableModules[] = "article";
        $moduleValues[$contModules]["label"] = system_showText(LANG_ARTICLE_FEATURE_NAME);
        $moduleValues[$contModules]["value"] = "Article";
        $contModules++;
    }
    
    foreach ($moduleValues as $moduleValue) {
        $modulesDropdownOptions .= "<option value=\"".$moduleValue["value"]."\" ".($module == $moduleValue["value"] ? "selected=\"selected\"" : "").">".$moduleValue["label"]."</option>";
    }

    //Categories
    $feed_all = "<select name='feed_all' id='feed_all' multiple size='5' style=\"width:500px\">";

    foreach ($availableModules as $avModule) {
        
        unset(${"categories_".$avModule});
        unset($arr_category);
        unset($arr_return_categories);
        $return_categories = ${"return_categories_".$avModule};
        $categObj = ucfirst($avModule)."Category";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($return_categories) {
                $return_categories_array = explode(",", $return_categories);
                foreach ($return_categories_array as $each_category) {
                    ${"categories_".$avModule}[] = new $categObj($each_category);
                }
            }
        }
        if (${"categories_".$avModule}) {
            for ($i = 0; $i < count(${"categories_".$avModule}); $i++) {
                $arr_category[$i]["name"] = ${"categories_".$avModule}[$i]->getString("title");
                $arr_category[$i]["value"] = ${"categories_".$avModule}[$i]->getNumber("id");
                $arr_return_categories[] = ${"categories_".$avModule}[$i]->getNumber("id");
            }
            if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
            array_multisort($arr_category);
            ${"feedDropDown_".$avModule} = "<select name='feed_$avModule' id='feed_$avModule' multiple size='5' style=\"width:500px\">";
            if ($arr_category) foreach ($arr_category as $each_category) {
                ${"feedDropDown_".$avModule} .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
                $feed_all .= "<option value='".$avModule."_".$each_category["value"]."'>".constant("LANG_".strtoupper($avModule)."_FEATURE_NAME")." &raquo ".$each_category["name"]."</option>";
                $feedAjaxCategory[] = $each_category["value"];
            }
            ${"feedDropDown_".$avModule} .= "</select>";
        } else {
            if ($return_categories) {
                $return_categories_array = explode(",", $return_categories);
                if ($return_categories_array) {
                    foreach ($return_categories_array as $each_category) {
                        ${"categories_".$avModule}[] = new ListingCategory($each_category);
                    }
                }
            }
            ${"feedDropDown_".$avModule} = "<select name='feed_$avModule' id='feed_$avModule' multiple size='5' style=\"width:500px\">";
            if (${"categories_".$avModule}) {
                foreach (${"categories_".$avModule} as $category) {
                    $name = $category->getString("title");
                    ${"feedDropDown_".$avModule} .= "<option value='".$category->getNumber("id")."'>$name</option>";
                    $feed_all .= "<option value='".$avModule."_".$category->getNumber("id")."'>".constant("LANG_".strtoupper($avModule)."_FEATURE_NAME")." &raquo ".$name."</option>";
                    $feedAjaxCategory[] = $category->getNumber("id");
                }
            }
            ${"feedDropDown_".$avModule} .= "</select>";
        }
        
    }
    $feed_all .= "</select>";


?>