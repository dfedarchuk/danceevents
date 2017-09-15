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
	# * FILE: /functions/language_funct.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Function to create a constant with table of language Information
	 */
	function language_constants(){
		if(defined('LANGUAGE_INFORMATION')) return false;
		unset($langObj,$array_languages);

		$langObj = new Lang();
		$array_languages = $langObj->convertTableToArray();

		if(is_array($array_languages)){
			define("LANGUAGE_INFORMATION", serialize($array_languages));
		}

	}

	/*
	 * Function to get information about language
	 */
	function language_getLanguageInformation($index){

		if(!defined('LANGUAGE_INFORMATION')){
			language_constants();
		}

		$aux_language_information = unserialize(LANGUAGE_INFORMATION);
		$array_language_information = $aux_language_information[$index];

		if(is_array($array_language_information)){
			return $array_language_information;
		}else{
			return false;
		}

	}
    
    function language_getDatePickPath($lang = EDIR_LANGUAGE, $domain_id = SELECTED_DOMAIN_ID, $relative = false, $newPlugin = false) {
        if ($newPlugin) {
            $pluginName = "bootstrap-datepicker.";
            $pluginPath = "/".SITEMGR_ALIAS."/assets/js/bootstrap-datepicker-master/locales";
        } else {
            $pluginName = "jquery.datepick-";
            $pluginPath = "/scripts/jquery/jquery_ui/js";
        }
        if (file_exists(EDIRECTORY_ROOT."/custom/domain_".$domain_id."/lang/$pluginName$lang.js")) {
            if ($relative) {
                return "/custom/domain_".$domain_id."/lang/$pluginName$lang.js";
            } else {
                return DEFAULT_URL."/custom/domain_".$domain_id."/lang/$pluginName$lang.js";
            }
        } else {
            if ($relative) {
                return "$pluginPath/$pluginName$lang.js";
            } else {
                return DEFAULT_URL."$pluginPath/$pluginName$lang.js";
            }
        }
    }
    
    function language_getFilePath($lang = EDIR_LANGUAGE, $script = false, $relative = false, $sitemgr = false, $domain_id = SELECTED_DOMAIN_ID, $editor = false, $original = false){
        
        if ($script){
            $ext = "js";
        } else {
            $ext = "php";
        }
        
        $path = "";
        $preview = false;
        $previewHash = md5("sitemgrPreview");
        
        if ($editor && (isset($_GET[$previewHash])) && file_exists(EDIRECTORY_ROOT."/custom/domain_".$domain_id."/lang/editor/preview_".$lang.".".$ext) && !$original){
            $preview = true;
        }
        
        if (file_exists(EDIRECTORY_ROOT."/custom/domain_".$domain_id."/lang".($editor ? "/editor" : "")."/".($preview ? "preview_" : "").$lang.($sitemgr ? "_sitemgr" : "").".".$ext) && !$original){
            if ($script){
                if ($relative){
                    $path = "/custom/domain_".$domain_id."/lang".($editor ? "/editor" : "")."/".($preview ? "preview_" : "").$lang.".".$ext;
                } else {
                    $path = DEFAULT_URL."/custom/domain_".$domain_id."/lang".($editor ? "/editor" : "").($preview ? "preview_" : "")."/".$lang.".".$ext;
                }
            } else {
                $path = EDIRECTORY_ROOT."/custom/domain_".$domain_id."/lang".($editor ? "/editor" : "")."/".($preview ? "preview_" : "").$lang.($sitemgr ? "_sitemgr" : "").".".$ext;
            }
        } else {
            if ($script){
                if ($relative){
                    $path = "/lang".($editor ? "/editor" : "")."/".$lang.".".$ext;
                } else {
                    $path = DEFAULT_URL."/lang".($editor ? "/editor" : "")."/".$lang.".".$ext;
                }
            } else {
                $path = EDIRECTORY_ROOT."/lang".($editor ? "/editor" : "")."/".$lang.($sitemgr ? "_sitemgr" : "").".".$ext;
            }
        }
        
        return $path;
    }
    
    function language_createJSFiles($filePath, $language) {
               
        //JS language file
        unset($buffer);
        $fileLangPath = str_replace(".php", ".js", $filePath);
        if ($fileLang = fopen($fileLangPath, "w+")) {
            $buffer .= "//Javascript language variables".PHP_EOL;
            $buffer .= "//ANY CHANGE ON THESE CONSTANTS MUST ALSO BE APPLIED ON THE CORRESPONDING php FILE (lang/en_us.php)".PHP_EOL.PHP_EOL;
            $buffer .= "//REMEMBER TO UPDATE the FUNCTION language_createJSFiles (functions/language_funct.php) IF YOU ADD NEW CONSTANTS".PHP_EOL.PHP_EOL;

            $buffer .= "//Wait, Loading Category Tree...".PHP_EOL;
            $buffer .= "LANG_JS_LOADCATEGORYTREE = \"".system_findTranslationFor("LANG_JS_LOADCATEGORYTREE", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;
            
            $buffer .= "//Wait, Loading Locations...".PHP_EOL;
            $buffer .= "LANG_JS_LOADLOCATIONTREE = \"".system_findTranslationFor("LANG_JS_LOADLOCATIONTREE", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Loading...".PHP_EOL;
            $buffer .= "LANG_JS_LOADING = \"".system_findTranslationFor("LANG_JS_LOADING", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//This item was added to your Favorites. You can view your Favorites in your profile page.".PHP_EOL;
            $buffer .= "LANG_JS_FAVORITEADD = \"".system_findTranslationFor("LANG_JS_FAVORITEADD", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//This item was removed from your Favorites.".PHP_EOL;
            $buffer .= "LANG_JS_FAVORITEDEL = \"".system_findTranslationFor("LANG_JS_FAVORITEDEL", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//weak".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_WEAK = \"".system_findTranslationFor("LANG_JS_LABEL_WEAK", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//bad".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_BAD = \"".system_findTranslationFor("LANG_JS_LABEL_BAD", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//good".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_GOOD = \"".system_findTranslationFor("LANG_JS_LABEL_GOOD", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//strong".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_STRONG = \"".system_findTranslationFor("LANG_JS_LABEL_STRONG", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//There was a problem retrieving the XML data:".PHP_EOL;
            $buffer .= "LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING = \"".system_findTranslationFor("LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Click here to select an account.".PHP_EOL;
            $buffer .= "LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT = \"".system_findTranslationFor("LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Please provide at least a 3 letter word for the search!".PHP_EOL;
            $buffer .= "LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST = \"".system_findTranslationFor("LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Server response failure!".PHP_EOL;
            $buffer .= "LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE = \"".system_findTranslationFor("LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Press ESC Key to close.".PHP_EOL;
            $buffer .= "LANG_JS_COLORPICKER_CLOSEMSG = \"".system_findTranslationFor("LANG_JS_COLORPICKER_CLOSEMSG", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Hide Map".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_HIDEMAP = \"".system_findTranslationFor("LANG_JS_LABEL_HIDEMAP", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Show Map".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_SHOWMAP = \"".system_findTranslationFor("LANG_JS_LABEL_SHOWMAP", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Show Graphics".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_SHOWGRAPHICS = \"".system_findTranslationFor("LANG_JS_LABEL_SHOWGRAPHICS", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//Hide Graphics".PHP_EOL;
            $buffer .= "LANG_JS_LABEL_HIDEGRAPHICS = \"".system_findTranslationFor("LANG_JS_LABEL_HIDEGRAPHICS", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;

            $buffer .= "//This item was already added to your Favorites.<br />You can view your Favorites in your profile page.".PHP_EOL;
            $buffer .= "LANG_JS_FAVORITES_ADDED = \"".system_findTranslationFor("LANG_JS_FAVORITES_ADDED", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;
            
            $buffer .= "//Wait...".PHP_EOL;
            $buffer .= "LANG_JS_WAIT = \"".system_findTranslationFor("LANG_JS_WAIT", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;
            
            $buffer .= "//Continue".PHP_EOL;
            $buffer .= "LANG_JS_CONTINUE = \"".system_findTranslationFor("LANG_JS_CONTINUE", EDIR_LANGUAGE, $filePath)."\";".PHP_EOL;
            
            $buffer .= "//Close".PHP_EOL;
            $buffer .= "LANG_JS_CLOSE = \"".system_findTranslationFor("LANG_JS_CLOSE", EDIR_LANGUAGE, $filePath)."\";";
            
            fwrite($fileLang, $buffer, strlen($buffer));
            fclose($fileLang);
        }
        
        //Datepicker plugin translation - FRONT/SPONSORS
        unset($buffer);
        $filePluginPath = str_replace("$language.php", "jquery.datepick-$language.js", $filePath);
        if ($filePlugin = fopen($filePluginPath, "w+")) {
            
            //Region
            $auxLang = explode("_", $language);
            $regional = $auxLang[0]."-".  strtoupper($auxLang[1]);
            
            //Months
            $strMonths = system_findTranslationFor("LANG_DATE_MONTHS", EDIR_LANGUAGE, $filePath);
            $arrayMonths = array_map("ucfirst", explode(",", $strMonths));
            
            //Days
            $strDays = system_findTranslationFor("LANG_DATE_WEEKDAYS", EDIR_LANGUAGE, $filePath);
            $arrayDays = array_map("ucfirst", explode(",", $strDays));
            
            //Date format
            $auxDateForm = system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_LANGUAGE, $filePath);
            if ($auxDateForm == "m/d/Y") {
                $auxDateForm = "mm/dd/yyyy";
            } else {
                $auxDateForm = "dd/mm/yyyy";
            }
            
            //Previous/Next labels
            $prev = ucfirst(system_findTranslationFor("LANG_PAGING_PREVIOUSPAGEMOBILE", EDIR_LANGUAGE, $filePath));
            $next = ucfirst(system_findTranslationFor("LANG_PAGING_NEXTPAGEMOBILE", EDIR_LANGUAGE, $filePath));
            
            $buffer .= "(function($) {
                                $.datepicker.regional['$regional'] = {
                                    monthNames: ['".$arrayMonths[0]."','".$arrayMonths[1]."','".$arrayMonths[2]."','".$arrayMonths[3]."','".$arrayMonths[4]."','".$arrayMonths[5]."',
                                    '".$arrayMonths[6]."','".$arrayMonths[7]."','".$arrayMonths[8]."','".$arrayMonths[9]."','".$arrayMonths[10]."','".$arrayMonths[11]."'],
                                    monthNamesShort: ['".system_showTruncatedText($arrayMonths[0], "3", "")."','".system_showTruncatedText($arrayMonths[1], "3", "")."','".system_showTruncatedText($arrayMonths[2], "3", "")."','".system_showTruncatedText($arrayMonths[3], "3", "")."','".system_showTruncatedText($arrayMonths[4], "3", "")."','".system_showTruncatedText($arrayMonths[5], "3", "")."',
                                    '".system_showTruncatedText($arrayMonths[6], "3", "")."','".system_showTruncatedText($arrayMonths[7], "3", "")."','".system_showTruncatedText($arrayMonths[8], "3", "")."','".system_showTruncatedText($arrayMonths[9], "3", "")."','".system_showTruncatedText($arrayMonths[10], "3", "")."','".system_showTruncatedText($arrayMonths[11], "3", "")."'],
                                    dayNames: ['".$arrayDays[0]."','".$arrayDays[1]."','".$arrayDays[2]."','".$arrayDays[3]."','".$arrayDays[4]."','".$arrayDays[5]."','".$arrayDays[6]."'],
                                    dayNamesShort: ['".system_showTruncatedText($arrayDays[0], "3", "")."','".system_showTruncatedText($arrayDays[1], "3", "")."','".system_showTruncatedText($arrayDays[2], "3", "")."','".system_showTruncatedText($arrayDays[3], "3", "")."','".system_showTruncatedText($arrayDays[4], "3", "")."','".system_showTruncatedText($arrayDays[5], "3", "")."','".system_showTruncatedText($arrayDays[6], "3", "")."'],
                                    dayNamesMin: ['".system_showTruncatedText($arrayDays[0], "3", "")."','".system_showTruncatedText($arrayDays[1], "3", "")."','".system_showTruncatedText($arrayDays[2], "3", "")."','".system_showTruncatedText($arrayDays[3], "3", "")."','".system_showTruncatedText($arrayDays[4], "3", "")."','".system_showTruncatedText($arrayDays[5], "3", "")."','".system_showTruncatedText($arrayDays[6], "3", "")."'],
                                    dateFormat: '".$auxDateForm."', firstDay: 0,
                                    renderer: $.datepicker.defaultRenderer,
                                    prevText: '$prev', prevStatus: '',
                                    prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                                    nextText: '$next', nextStatus: '',
                                    nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                                    currentText: '', currentStatus: '',
                                    todayText: '', todayStatus: '',
                                    clearText: '', clearStatus: '',
                                    closeText: '', closeStatus: '',
                                    yearStatus: '', monthStatus: '',
                                    weekText: '', weekStatus: '',
                                    dayStatus: '', defaultStatus: '',
                                    isRTL: false
                                };
                                $.datepicker.setDefaults($.datepicker.regional['$regional']);
                            })(jQuery);";
            
            fwrite($filePlugin, $buffer, strlen($buffer));
            fclose($filePlugin);
        }
        
        //Bootstrap Datepicker plugin translation - ADMIN
        unset($buffer);
        $filePluginPath = str_replace("$language.php", "bootstrap-datepicker.$language.js", $filePath);
        if ($filePlugin = fopen($filePluginPath, "w+")) {
            
            //Region
            $auxLang = explode("_", $language);
            $regional = $auxLang[0]."-".strtoupper($auxLang[1]);
            
            //Months
            $strMonths = system_findTranslationFor("LANG_DATE_MONTHS", EDIR_LANGUAGE, $filePath);
            $arrayMonths = array_map("ucfirst", explode(",", $strMonths));
            
            //Days
            $strDays = system_findTranslationFor("LANG_DATE_WEEKDAYS", EDIR_LANGUAGE, $filePath);
            $arrayDays = array_map("ucfirst", explode(",", $strDays));
            
            //Date format
            $auxDateForm = system_findTranslationFor("DEFAULT_DATE_FORMAT", EDIR_LANGUAGE, $filePath);
            if ($auxDateForm == "m/d/Y") {
                $auxDateForm = "mm/dd/yyyy";
            } else {
                $auxDateForm = "dd/mm/yyyy";
            }
            
            //Previous/Next labels
            $prev = ucfirst(system_findTranslationFor("LANG_PAGING_PREVIOUSPAGEMOBILE", EDIR_LANGUAGE, $filePath));
            $next = ucfirst(system_findTranslationFor("LANG_PAGING_NEXTPAGEMOBILE", EDIR_LANGUAGE, $filePath));
            
            $buffer .= ";(function($){
                        $.fn.datepicker.dates['".strtolower(str_replace("-", "_", $regional))."'] = {
                            days: ['".$arrayDays[0]."','".$arrayDays[1]."','".$arrayDays[2]."','".$arrayDays[3]."','".$arrayDays[4]."','".$arrayDays[5]."','".$arrayDays[6]."'],
                            daysShort: ['".system_showTruncatedText($arrayDays[0], "3", "")."','".system_showTruncatedText($arrayDays[1], "3", "")."','".system_showTruncatedText($arrayDays[2], "3", "")."','".system_showTruncatedText($arrayDays[3], "3", "")."','".system_showTruncatedText($arrayDays[4], "3", "")."','".system_showTruncatedText($arrayDays[5], "3", "")."','".system_showTruncatedText($arrayDays[6], "3", "")."'],
                            daysMin: ['".system_showTruncatedText($arrayDays[0], "2", "")."','".system_showTruncatedText($arrayDays[1], "2", "")."','".system_showTruncatedText($arrayDays[2], "2", "")."','".system_showTruncatedText($arrayDays[3], "2", "")."','".system_showTruncatedText($arrayDays[4], "2", "")."','".system_showTruncatedText($arrayDays[5], "2", "")."','".system_showTruncatedText($arrayDays[6], "2", "")."'],
                            months: ['".$arrayMonths[0]."','".$arrayMonths[1]."','".$arrayMonths[2]."','".$arrayMonths[3]."','".$arrayMonths[4]."','".$arrayMonths[5]."'],
                            monthsShort: ['".system_showTruncatedText($arrayMonths[0], "3", "")."','".system_showTruncatedText($arrayMonths[1], "3", "")."','".system_showTruncatedText($arrayMonths[2], "3", "")."','".system_showTruncatedText($arrayMonths[3], "3", "")."','".system_showTruncatedText($arrayMonths[4], "3", "")."','".system_showTruncatedText($arrayMonths[5], "3", "")."'],
                            today: '".system_showText(LANG_SITEMGR_BUTTON_TODAY)."',
                            clear: '".system_showText(LANG_BUTTON_CLEAR)."'
                        };
                    }(jQuery));";
            
            fwrite($filePlugin, $buffer, strlen($buffer));
            fclose($filePlugin);
        }
    }
?>