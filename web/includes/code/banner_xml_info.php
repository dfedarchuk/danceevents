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
	# * FILE: /includes/code/banner_xml_info.php
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

	if ($_GET["domain_id"]){
		$domain_id = $_GET["domain_id"];
	} else {
		$domain_id = SELECTED_DOMAIN_ID;
	}

	header('Content-Type: text/xml');
	$return = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n";
	$return .= "<response>\n";
	if($_GET["level"]) {
        $levelObj = new BannerLevel(true, $domain_id);
        $return .= "<block>".htmlspecialchars($levelObj->getImpressionBlock($_GET["level"]))."</block>\n";
	}
	$return .= "</response>\n";
	echo $return;

?>
