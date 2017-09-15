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
	# * FILE: /conf/language.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINITIONS
	# ----------------------------------------------------------------------------------------------------

	
	//set default language
	//any changes in lines below must to be changed in database (table lang)
	$edir_default_language = "en_us";
	$edir_default_languagenumber = "1";

	//set all available languages separated by comma
	//up to 5 languages (edirectory performance)
	//if you want more than 5 languages, contact edirectory customization team
	//any changes in lines below must to be changed in database (table lang)
	$edir_languages = "en_us,pt_br,it_it";
	$edir_languagenames = "English,Português,Italiano";
	$edir_languagenumbers = "1,2,5";

	//up to 5 languages (edirectory performance)
	//if you want more than 5 languages, contact edirectory customization team
	define("MAX_ENABLED_LANGUAGES", 1);

	//loading the definitions file

	$definitions_file = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/lang/language.inc.php';
	if (file_exists($definitions_file)) {
		include_once($definitions_file);
	}	
	
	//code to setup one specific language from all available languages
	$edir_language = $edir_default_language;
    setcookie("edir_language", $edir_language, time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");
	
	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	include(EDIRECTORY_ROOT."/includes/code/language.php");
	unset($edir_default_language);
	unset($edir_default_languagenumber);
	unset($edir_languages);
	unset($edir_languagenames);
	unset($edir_languagenumbers);
	unset($edir_language);
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	
	# ----------------------------------------------------------------------------------------------------
	# JUST FOR FACEBOOK API
	# ----------------------------------------------------------------------------------------------------
	$langPart = explode("_", EDIR_LANGUAGE);
	if ($langPart[0] == "ge") {
		$langPart[0] = "de";
		$langPart[1] = "DE";
	} else {
		$langPart[1] = strtoupper($langPart[1]);
	}
	define("EDIR_LANGUAGEFACEBOOK", implode("_", $langPart));
    
    # ----------------------------------------------------------------------------------------------------
    # LANGUAGE REFERENCE TO PHPMAILER
    # ----------------------------------------------------------------------------------------------------
    unset($array_lang_reference);

    $array_lang_reference["en"] = "en_us";
    $array_lang_reference["es"] = "es_es";
    $array_lang_reference["fr"] = "fr_fr";
    $array_lang_reference["de"] = "ge_ge";
    $array_lang_reference["it"] = "it_it";
    $array_lang_reference["br"] = "pt_br";
    $array_lang_reference["tr"] = "tr_tr";
    define("PHPMAILER_LANGUAGES",  serialize($array_lang_reference));
    
    unset($array_lang_reference);
?>
