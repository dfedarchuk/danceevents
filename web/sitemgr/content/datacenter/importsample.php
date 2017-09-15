<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/importsample.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();
	
	if ($_GET["type"] == "event" && EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
		$filename = "edirectory_sample_event.csv";
	} else {
		$filename = "edirectory_sample.csv";
	}

	
    header("Pragma: public");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D,d M YH:i:s")." GMT");
	header("Content-Transfer-Encoding: binary");
    header("Content-Type: text/comma-separated-values");
	header("Content-Type: text/comma-separated-values; charset=utf-8", TRUE);
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Description: PHP Generated XLS Generator");
	@readfile("$filename");

?>