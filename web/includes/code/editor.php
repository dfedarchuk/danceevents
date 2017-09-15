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
	# * FILE: /includes/code/editor.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !DEMO_LIVE_MODE  && $submitAction == "csseditor") {

        $errorFolder = false;
        $errorMessage = "";

        $filePath = HTMLEDITOR_THEMEFILE_DIR."/".EDIR_THEME;
        $file = "csseditor.css";
        
        if (!is_dir($filePath)) {
            if (!mkdir($filePath)) {
                $errorFolder = true;
            }
        }
        
        if (get_magic_quotes_gpc()) {
            $text = stripslashes($text);
        }
                
        if ($errorFolder) {
            $errorMessage = system_showText(LANG_SITEMGR_EDITOR_PERMERROR);
        } elseif (!$text){
            $errorMessage = system_showText(LANG_SITEMGR_EDITOR_EMPTYERROR);
        }

        if (!$errorMessage || $revert) {
            
            if ($revert) {
                if (file_exists($filePath."/".$file)) {
                    unlink($filePath."/".$file);
                }
                
                $message = 1;
            } else {
                $message = 0;
                
                if (!$errorMessage) {
                    file_put_contents($filePath."/".$file, $text);
                }
            }

            if (!$errorMessage){
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/design/css-editor/index.php?message=$message");
                exit;
            } else {
                unset($message);
            }
        }
	} elseif($_SERVER["REQUEST_METHOD"] == "POST" && DEMO_LIVE_MODE) {
        $errorMessage = system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2);
    }
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    setting_get("sitemgr_language", $sitemgr_language);
    $langPart = explode("_", $sitemgr_language);
    $editorLang = $langPart[0];
    if ($editorLang == "ge") {
        $editorLang = "de";
    }
    $file = "csseditor.css";
    $fileType = "css";
    $editorSyntax = "css";
    $text = "";

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        if (file_exists(HTMLEDITOR_THEMEFILE_DIR."/".EDIR_THEME."/csseditor.css")) {
            $text = file_get_contents(HTMLEDITOR_THEMEFILE_DIR."/".EDIR_THEME."/csseditor.css");
        }
    }

    if (!$text) {
        $text = "/*\nThis is your custom Style Sheet. It's the last css resource loaded so you can\neasily overwrite css selectors from other style sheets.\n*/";
    }