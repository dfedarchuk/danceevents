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
	# * FILE: /conf/default_scheme.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINITIONS
	# ----------------------------------------------------------------------------------------------------

	//set default scheme
	$edir_default_scheme = "doctor";

	//set all available schemes separated by comma
	$edir_schemes = "doctor";
	$edir_schemenames = "Medical Guide";

	//code to setup one specific scheme from all available schemes
	$edir_scheme = "doctor";

	if (DEMO_LIVE_MODE == 0) {
		@include_once(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme/doctor_scheme.inc.php');
	} else {
		if ($_COOKIE["edir_scheme"] && (strpos($edir_schemes, $_COOKIE["edir_scheme"]) !== false)) {
			$edir_scheme = $_COOKIE["edir_scheme"];
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

	define("EDIR_DEFAULT_SCHEME",       $edir_default_scheme);
	define("EDIR_SCHEMES",              $edir_schemes);
	define("EDIR_SCHEMENAMES",          $edir_schemenames);
	define("EDIR_SCHEME",               $edir_scheme);
	define("EDIR_CURR_SCHEME_VALUES",   serialize($arrayScheme));
	
	if (is_array($arrayScheme[EDIR_SCHEME])){
		foreach($arrayScheme[EDIR_SCHEME] as $key=>$value){
			if (strpos($value, "SCHEME_") === false){
				define("SCHEME_".strtoupper($key), $value);
			}
		}
	}

	unset($edir_default_scheme);
	unset($edir_schemes);
	unset($edir_schemenames);
	unset($edir_scheme);

	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

?>