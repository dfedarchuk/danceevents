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
	# * FILE: /conf/location.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINITIONS
	# ----------------------------------------------------------------------------------------------------
    //set all available locations separated by comma
	//up to 5 locations
	//if you want more than 5 locations, contact edirectory customization team
	//any changes in lines below must to be changed in database (table settings)

	$edir_default_locations = "";
	$edir_default_locationids = "";
	$edir_default_locationnames = "";
	$edir_default_locationshow = "";

	$edir_locations = "1,3,4";
	$edir_locationnames = "COUNTRY,STATE,CITY";
	$edir_locationnames_plural = "COUNTRIES,STATES,CITIES";

	define("EDIR_ALL_LOCATIONS", "1,2,3,4,5");
	$edir_all_locations = EDIR_ALL_LOCATIONS;
	$edir_all_locationnames = "COUNTRY,REGION,STATE,CITY,NEIGHBORHOOD";
	$edir_all_locationnames_plural = "COUNTRIES,REGIONS,STATES,CITIES,NEIGHBORHOODS";

	//loading the definitions file
	$definitions_file = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/location/location.inc.php';
	if (file_exists($definitions_file)) {
		include_once($definitions_file);
	}

	define("EDIR_ALL_LOCATIONNAMES",        $edir_all_locationnames);
	define("EDIR_ALL_LOCATIONNAMES_PLURAL", $edir_all_locationnames_plural);

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
		
	$edir_all_locations = explode(",", $edir_all_locations);
	$edir_all_locationnames = explode(",", $edir_all_locationnames);
	$edir_all_locationnames_plural = explode(",", $edir_all_locationnames_plural);

	foreach ($edir_all_locations as $each_location) {
		$each_location_index = ($each_location - 1);
		$_tmp_locationname = "LOCATION".$each_location."_SYSTEM";
		$_tmp_locationname_plural = "LOCATION".$each_location."_SYSTEM_PLURAL";
		define ($_tmp_locationname, $edir_all_locationnames[$each_location_index]);
		define ($_tmp_locationname_plural, $edir_all_locationnames_plural[$each_location_index]);	
	}

	$edir_enable_locations = explode(",", $edir_locations);
	foreach ($edir_enable_locations as $each_location) {
		$each_location_index = ($each_location - 1);
		$_tmp_locationname = "LOCATION_ENABLED".$each_location;
		define ($_tmp_locationname, $edir_all_locationnames[$each_location_index]);
	}

	define("EDIR_DEFAULT_LOCATIONS",        $edir_default_locations);
	define("EDIR_DEFAULT_LOCATIONIDS",      $edir_default_locationids);
	define("EDIR_DEFAULT_LOCATIONNAMES",    $edir_default_locationnames);
	define("EDIR_DEFAULT_LOCATIONSHOW",     $edir_default_locationshow);
	define("EDIR_LOCATIONS",                $edir_locations);

	unset($edir_default_locations);
	unset($edir_default_locationids);
	unset($edir_default_locationnames);
	unset($edir_default_locationshow);

	unset($edir_locations);
	unset($edir_locationnames);
	unset($edir_locationnames_plural);

	unset($edir_all_locations);
	unset($edir_all_locationnames);
	unset($edir_all_locationnames_plural);

	unset($each_location);
	unset($each_location_index);
	

?>
