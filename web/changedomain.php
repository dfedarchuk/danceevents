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
	# * FILE: /changedomain.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$host = string_strtoupper(str_replace("www.","",$_SERVER["HTTP_HOST"]));

		extract($_POST);
		if ($domain_id && $http_host && $request_uri) {

			if ($members == 'false') {
				$_SESSION[$host."_DOMAIN_ID_SITEMGR"] = $domain_id;
				setcookie($host."_DOMAIN_ID_SITEMGR", $domain_id, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				setcookie("SECTION_SITEMGR", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				setcookie("SECTION_MEMBERS", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			} else {
				$_SESSION[$host."_DOMAIN_ID_MEMBERS"] = $domain_id;
				setcookie($host."_DOMAIN_ID_MEMBERS", $domain_id, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				setcookie("SECTION_MEMBERS", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				setcookie("SECTION_SITEMGR", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			}
		} else if (!$domain_id) {

			if ($members == 'false') {
				unset($_SESSION[$host."_DOMAIN_ID_SITEMGR"]);
				setcookie($host."_DOMAIN_ID_SITEMGR", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				setcookie("SECTION_SITEMGR", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				unset($_COOKIE["SECTION_MEMBERS"]);
			} else {
				unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"]);
				setcookie($host."_DOMAIN_ID_SITEMGR", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				setcookie("SECTION_MEMBERS", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				unset($_COOKIE["SECTION_SITEMGR"]);
			}
		}
		$str_review = "";

		if (string_strpos($http_host.$request_uri,"item_type") && $dashboard !='true'){
			if (string_strpos($query_string,"&") !== false){
				$aux = explode("&",$query_string);
			} else {
				$aux = explode("?",$query_string);
			}

			if (array_search("item_type=listing",$aux))	$key = array_search("item_type=listing",$aux);
			else if (array_search("item_type=article",$aux))$key = array_search("item_type=article",$aux);
			else $key = 0;

			$strreview = "?".$aux[$key];
		}

		if (string_strpos($request_uri, '/locations/')!==false) {
			$request_uri = string_substr($request_uri, 0, string_strpos($request_uri, '/locations/')) . '/locations/location_1/index.php';
			$query_string = '';
		}

		if (!string_strpos($http_host.$request_uri,"/account") && $dashboard !='true')
			$request_uri = str_replace("?".$query_string,"",$request_uri);
		$request_uri .= $strreview;
		$return = $http_host.$request_uri;

		echo $return;
	}
