<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/itemexportfile.php
	# ----------------------------------------------------------------------------------------------------

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

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	
	if ($_GET["export_type"] == "listing") {
		$item_scalability = LISTING_SCALABILITY_OPTIMIZATION;
		$field1 = "total_listing_exported";
		$field2 = "last_listing_id";
		$tableCron = "Control_Export_Listing";
	} elseif($_GET["export_type"] == "event") {
		$item_scalability = EVENT_SCALABILITY_OPTIMIZATION;
		$tableCron = "Control_Export_Event";
		$field1 = "total_event_exported";
		$field2 = "last_event_id";
	} else {
		$item_scalability = LISTING_SCALABILITY_OPTIMIZATION;
		$tableCron = "Control_Export_Listing";
		$field1 = "total_listing_exported";
		$field2 = "last_listing_id";
	}

	if ($item_scalability == "on") {
		$db = db_getDBObject(DEFAULT_DB, true);
		/*
		 * Check if cron is running
		 */
		$sql = "SELECT finished FROM $tableCron WHERE domain_id = ".SELECTED_DOMAIN_ID." AND type = 'csv'";
		$result = $db->query($sql);
		$aux_row_control = mysql_fetch_assoc($result);
		if ($aux_row_control["finished"] == "Y") {
			/*
			 * Prepare to cron make export
			 */
			$update = "UPDATE $tableCron SET
							 last_run_date = NOW(),
							 scheduled = 'Y',
							 filename = '".$_GET["file"]."',
							 $field1 = 0,
							 $field2 = 0
						WHERE domain_id = ".SELECTED_DOMAIN_ID." AND type = 'csv'";
			if (!$_GET["removecontrol"]) {
				$db->query($update);
            }
		}
	} else {
		export_ExportToCSV($_GET["export_type"], $_GET["file"], $_GET["removecontrol"], SELECTED_DOMAIN_ID);
	}

?>