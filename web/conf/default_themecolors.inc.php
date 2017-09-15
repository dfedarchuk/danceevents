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
	# * FILE: /conf/default_themecolors.inc.php
	# ----------------------------------------------------------------------------------------------------

	//Theme: Default
	//Scheme Color: Default

	//Main pallete colors
	$arrayColors["default"]["default"]["color1"] = "164378";
	$arrayColors["default"]["default"]["color2"] = "199adb";

	//Advanced colors
	$arrayColors["default"]["default"]["colorNavbar"] = "fff";
	$arrayColors["default"]["default"]["colorNavbarLink"] = "252525";
	$arrayColors["default"]["default"]["colorFooterLink"] = "fff";
	$arrayColors["default"]["default"]["fontOption"] = "1";
	$arrayColors["default"]["default"]["fontName"] = "\"Source Sans Pro\", \"Trebuchet MS\", sans-serif";

	$arrayColors["default"]["default"]["colorKnob"] = "199adb";

	# ----------------------------------------------------------------------------------------------------
	//Theme: Doctor
	//Scheme Color: Doctor

	//Main pallete colors
	$arrayColors["doctor"]["doctor"]["color1"] = "244576";
	$arrayColors["doctor"]["doctor"]["color2"] = "638cbf";

	//Advanced colors
	$arrayColors["doctor"]["doctor"]["colorNavbar"] = "ffffff";
	$arrayColors["doctor"]["doctor"]["colorNavbarLink"] = "2d2d2c";
	$arrayColors["doctor"]["doctor"]["colorFooterLink"] = "2d2d2c";
	$arrayColors["doctor"]["doctor"]["fontOption"] = "1";
	$arrayColors["doctor"]["doctor"]["fontName"] = "\"Source Sans Pro\", \"Trebuchet MS\", sans-serif";

	$arrayColors["doctor"]["doctor"]["colorKnob"] = "333333";

	# ----------------------------------------------------------------------------------------------------
	//Theme: Restaurant
	//Scheme Color: Restaurant

	//Main pallete colors
	$arrayColors["restaurant"]["restaurant"]["color1"] = "722302";
	$arrayColors["restaurant"]["restaurant"]["color2"] = "180c0c";

	//Advanced colors
	$arrayColors["restaurant"]["restaurant"]["colorNavbar"] = "f1f4f0";
	$arrayColors["restaurant"]["restaurant"]["colorNavbarLink"] = "722302";
	$arrayColors["restaurant"]["restaurant"]["colorFooterLink"] = "22161b";
	$arrayColors["restaurant"]["restaurant"]["fontOption"] = "1";
	$arrayColors["restaurant"]["restaurant"]["fontName"] = "Bitter, Georgia, \"Times New Roman\", Times, serif;";

	$arrayColors["restaurant"]["restaurant"]["colorKnob"] = "333333";
	# ----------------------------------------------------------------------------------------------------
	//Theme: Wedding
	//Scheme Color: Wedding

	//Main pallete colors
	$arrayColors["wedding"]["wedding"]["color1"] = "7f4c4c";
	$arrayColors["wedding"]["wedding"]["color2"] = "ff9797";

	//Advanced colors
	$arrayColors["wedding"]["wedding"]["colorNavbar"] = "fcfcfc";
	$arrayColors["wedding"]["wedding"]["colorNavbarLink"] = "7f4c4c";
	$arrayColors["wedding"]["wedding"]["colorFooterLink"] = "ffffff";
	$arrayColors["wedding"]["wedding"]["fontOption"] = "1";
	$arrayColors["wedding"]["wedding"]["fontName"] = "\"Source Sans Pro\", \"Trebuchet MS\", sans-serif;";

	$arrayColors["wedding"]["wedding"]["colorKnob"] = "333333";

	define("ARRAY_DEFAULT_COLORS", serialize($arrayColors));
?>
