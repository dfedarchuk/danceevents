<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/itemexportcheck.php
	# ----------------------------------------------------------------------------------------------------

	$_inCron = false;
	$_inCronCheck = true;
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	if (!defined("SELECTED_DOMAIN_ID")){
		define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
	}
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$checkExport = false;
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	
	if ($_GET["export_type"] == "listing") {
		$item_scalability = LISTING_SCALABILITY_OPTIMIZATION;
	} elseif($_GET["export_type"] == "event") {
		$item_scalability = EVENT_SCALABILITY_OPTIMIZATION;
	} else {
		$item_scalability = LISTING_SCALABILITY_OPTIMIZATION;
	}

	if (!$_GET["file"]) {
		mail(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: not get file.");
		exit;
	}
	if ($_GET["type"] == "xls") {
		$filename = IMPORT_FOLDER."/export_".str_replace(".zip", "", $_GET["file"]).".progress";
	} else {
		$filename = IMPORT_FOLDER."/export_".str_replace(".csv", "", $_GET["file"]).".progress";
	}
 
	if (file_exists($filename)) { 
		if (!$handle = fopen($filename, "r")) {
			echo system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 10001<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT);
		} else {
			$progress = fgets($handle);
			if (!fclose($handle)) {
				echo system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 10002<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT);
			} else {
				if ($progress < $_GET["lastprogress"]) $progress = $_GET["lastprogress"];
				echo $progress;

			}
		}
	} else {
		if ($item_scalability == "on") {
			echo system_showText(LANG_SITEMGR_EXPORT_WAITING_CRON);
		} else {
			echo system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 10000<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT);
		}

	}

?>