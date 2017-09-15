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
	# * FILE: /location.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
	# FILE HEADER
	# ----------------------------------------------------------------------------------------------------
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	unset($return);

	$id =  $_GET["id"];
	$level = $_GET["level"];
	$childLevel = $_GET["childLevel"];
	$type = $_GET["type"];
	if ($type == 'byId') {
		if ($childLevel) {
			$objLocationLabel = "Location".$childLevel;
			${"Location"+$childLevel}= new $objLocationLabel;
			${"Location"+$childLevel}->SetString("location_".$level, $id);
			$retrieved_locations = ${"Location"+$childLevel}->retrieveLocationByLocation($level);
			if ($retrieved_locations) {
				$return = "<option id=\"l_location_".$childLevel."\" value=\"\"></option>";
				foreach ($retrieved_locations as $each_location) {
					$location_id = $each_location['id'];
					$location_name = $each_location['name'];
					$return .= "<option id=\"option_L".$childLevel."_ID".$location_id."\" value=\"".$location_id."\">".trim($location_name)."</option>";
				}
			} else $return = "empty";
		}
		else $return = "empty";
	} elseif ($type == 'All') {		
		$objLocationLabel = "Location".$level;
		${"Location".$level}= new $objLocationLabel;
		$retrieved_locations = ${"Location".$level}->retrieveAllLocation();
		if ($retrieved_locations) {
			$return = "<option id=\"l_location_".$level."\" value=\"\"></option>";
			foreach ($retrieved_locations as $each_location) {
				$location_id = $each_location['id'];
				$location_name = $each_location['name'];
				$return .= "<option id=\"option_L".$level."_ID".$location_id."\" value=\"".$location_id."\">".trim($location_name)."</option>";
			}
		} else $return = "empty";
	}	
	echo $return;