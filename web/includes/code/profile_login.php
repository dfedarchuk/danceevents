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
	# * FILE: /includes/code/profile_login.php
	# ----------------------------------------------------------------------------------------------------

	$ItemPath = "";
	if (string_strpos($_SERVER["HTTP_REFERER"], str_replace(DEFAULT_URL, "", LISTING_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(DEFAULT_URL, "", LISTING_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(DEFAULT_URL, "", PROMOTION_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(DEFAULT_URL, "", PROMOTION_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(DEFAULT_URL, "", EVENT_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(DEFAULT_URL, "", EVENT_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(DEFAULT_URL, "", CLASSIFIED_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(DEFAULT_URL, "", CLASSIFIED_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(DEFAULT_URL, "", ARTICLE_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(DEFAULT_URL, "", ARTICLE_DEFAULT_URL)."/";
	} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(DEFAULT_URL, "", BLOG_DEFAULT_URL)) !== false) {
		$ItemPath = str_replace(DEFAULT_URL, "", BLOG_DEFAULT_URL)."/";
	} /* workaround for login in result work */
	elseif ($_GET['userperm']) {
		$ItemPath = true;
	}

	setting_get("foreignaccount_google", $foreignaccount_google);

    $nofacebook = $_GET["nofacebook"] ? true : false;

    if ($_GET["destiny"]) {
        $destiny = "destiny=".$_GET["destiny"];
    }

    if ($ItemPath) {
        $url = "/".SOCIALNETWORK_FEATURE_NAME."/login.php?userperm=true";
        if ($destiny) {
            $url .= "&".$destiny;
        }
    } else {
        $url = "/".SOCIALNETWORK_FEATURE_NAME."/login.php";
        if ($destiny) {
            $url .= "?".$destiny;
            if ($_GET["act"] == "see_profile"){
                $url .= "&userperm=true";
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        $_x_request_uri = string_substr($_x_request_uri, 0, string_strpos($_x_request_uri, "&act"));
        $_SESSION["USER_PERM"] = ($ItemPath || $_GET["act"] == "see_profile") ? true: false;
        $_SESSION["REQUEST_URI"] = $_x_request_uri;
        $_SESSION["HTTP_REFER"] = $_SERVER["HTTP_REFERER"];
        $_SESSION["ITEM_ACTION"] = $_GET["act"];
        $_SESSION["ITEM_TYPE"] = $_GET["type"];
        $_SESSION["ITEM_ID"] = $_GET[$_GET["act"]."_item"];
    }
?>
