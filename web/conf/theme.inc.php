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
	# * FILE: /conf/theme.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINITIONS
	# ----------------------------------------------------------------------------------------------------

	//set default theme
	$edir_default_theme = "default";

	//set all available themes separated by comma
	$edir_themes = "default,doctor,restaurant,wedding";
	$edir_themenames = "eDirectory Default,Medical Guide,Restaurant Guide, Wedding";

	//code to setup one specific theme from all available themes
	$edir_theme = "default";

    @include_once(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme/theme.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

	$arrayThemes = explode(",", $edir_themes);
	if (DEMO_DEV_MODE == 0) {
		if(strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."")){
			define("THEMEFILE_RELATIVE_PATH", "/custom/domain_".URL_DOMAIN_ID."/theme");
		}else{
			define("THEMEFILE_RELATIVE_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/theme");
		}
	} else {
		define("THEMEFILE_RELATIVE_PATH", "/theme");
	}
    
    define("THEMEFILE_DIR", str_replace("//", "/", EDIRECTORY_ROOT.THEMEFILE_RELATIVE_PATH));
	define("THEMEFILE_URL", DEFAULT_URL.THEMEFILE_RELATIVE_PATH);
    
    //HTML Editor Feature
    if(strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."")){
        define("HTMLEDITOR_THEMEFILE_RELATIVE_PATH", "/custom/domain_".URL_DOMAIN_ID."/theme");
    }else{
        define("HTMLEDITOR_THEMEFILE_RELATIVE_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/theme");
    }
    
    define("HTMLEDITOR_THEMEFILE_DIR", str_replace("//", "/", EDIRECTORY_ROOT.HTMLEDITOR_THEMEFILE_RELATIVE_PATH));
	define("HTMLEDITOR_THEMEFILE_URL", DEFAULT_URL.HTMLEDITOR_THEMEFILE_RELATIVE_PATH);

	define("EDIR_DEFAULT_THEME",    $edir_default_theme);
	define("EDIR_THEMES",           $edir_themes);
	define("EDIR_THEMENAMES",       $edir_themenames);
	define("EDIR_THEME",            $edir_theme);

	unset($edir_default_theme);
	unset($edir_themes);
	unset($edir_themenames);
	unset($edir_theme);

	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

?>