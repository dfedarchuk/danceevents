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
	# * FILE: /search_username.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");
    
    $currentAcc = $_GET["current_acc"];
	
    $skipValidation = false;
	if ($_GET['username'] == 'erro') {
		$error = "&#149;&nbsp;".system_showText(LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME);
	} else {
        if ($_GET['username'] == LANG_LABEL_USERNAME) { //IE 7/8/9 fix with placeholder plugin
            $checkIE = is_ie(false, $ieVersion);
            if ($checkIE && $ieVersion < 10) {
                $_GET['username'] = "";
                $skipValidation = true;
            }
        }
        if (!$skipValidation) {
            $error = validate_username($_GET['username']);
        }
	}
	if ($error) {
		$error = str_replace("&#149;&nbsp;", "", $error);
		echo "<span class=\"UsernameRegistered\">".$error."</span>";
	} else {
	
		$input = string_strtolower(trim($_GET['username']));
		$option = string_strtolower(trim($_GET['option']));
		$whereStr = db_formatString($input);
		$checkUsername = true;
		if ($input){

			if ($option == 'sitemgr') {

				$smaccount_exists = db_getFromDB('smaccount', 'username', db_formatString($_GET['username']));
                $accExistsID = $smaccount_exists->getNumber("id");
				if ($accExistsID){
					$checkUsername = false;
				} else {
					setting_get("sitemgr_username", $sm_username);
					if ($sm_username == $_GET['username']) {
						$checkUsername = false;
					}
				}
				
			} elseif ($option == 'members') {

				$account_exists = db_getFromDB('account', 'username', db_formatString($_GET['username']));
                $accExistsID = $account_exists->getNumber("id");
				if ($accExistsID) {
					$checkUsername = false;
				}
			}

			if ($checkUsername) {
				echo "<span class=\"UsernameNotRegistered\">".system_showText(LANG_USERNAME_NOT_REGISTERED)."</span>";
			} else {
                if (!$currentAcc || $accExistsID != $currentAcc) {
                    echo "<span class=\"UsernameRegistered\">".system_showText(LANG_USERNAME_ALREADY_REGISTERED)."</span>";
                } else {
                    echo "&nbsp;";
                }
			}
		}
	}