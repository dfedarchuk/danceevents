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
	# * FILE: /includes/code/login.php
	# ----------------------------------------------------------------------------------------------------

    $members_section = true;

    if ($_GET["np"]) {
		$message_login = system_showText(LANG_MSG_NO_PERMISSION)."<br />";
		$message_login .= "<a href=\"".DEFAULT_URL."/".ALIAS_ADVERTISE_URL_DIVISOR."/\">".system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS)."</a> ";
		if (SOCIALNETWORK_FEATURE == "on") {
			$message_login .= system_showText(LANG_OR)." <a href=\"".SOCIALNETWORK_URL."\">".system_showText(LANG_MSG_GO_PROFILE)."</a>";
		}
	}

	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
	$destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
	$destiny = urldecode($destiny);
	if ($destiny) {
		$destiny = system_denyInjections($destiny);
		if (string_strpos($destiny, "://") !== false) {
			if (string_strpos($destiny, $_SERVER["HTTP_HOST"]) === false) {
				$destiny = "";
			}
		}
	}
	if ($_SERVER["QUERY_STRING"]) {
		if (string_strpos($_SERVER["QUERY_STRING"], "query=") !== false) {
			$query = string_substr($_SERVER["QUERY_STRING"], string_strpos($_SERVER["QUERY_STRING"], "query=")+6);
		} else {
			$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
			$query = urldecode($query);
		}
	} else {
		$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
		$query = urldecode($query);
	}
	if ($query) {
		$query = system_denyInjections($query);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($_POST["userform"] == "currentuser" && ($_POST["claim"] || $_POST["advertise"])) {
			if ($destiny) {
				$url = $destiny;
				if ($query) $url .= "?".$query;
			} else {
				$url = DEFAULT_URL."/".MEMBERS_ALIAS."/";
			}
			$accountObj = new Account($_POST["acc"]);
			$accountObj->changeMemberStatus(true);

			$accDomain = new Account_Domain($accountObj->getNumber("id"), SELECTED_DOMAIN_ID);
			$accDomain->Save();
			$accDomain->saveOnDomain($accountObj->getNumber("id"), $accountObj);

			$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

			setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);

			header("Location: ".$url);
			exit;
		} else {

			if (sess_authenticateAccount($_POST["username"], $_POST["password"], $authmessage)) {

				sess_registerAccountInSession($_POST["username"]);
				setcookie("username_members", $_POST["username"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

				setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

				$AccountObj = db_getFromDB("account", "username", db_formatString($_POST["username"]));
				if ($_POST["automatic_login"]) {
					setcookie("automatic_login_members", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
					$_POST["password"] = string_strtolower(PASSWORD_ENCRYPTION) == "on" ? md5($_POST["password"]) : $_POST["password"];
					$aux = md5(MEMBERS_LOGIN_PAGE.trim($_POST["username"]).$_POST["password"]);
					setcookie("complementary_info_members", $aux, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

					$AccountObj->Save();

				} else {
					setcookie("automatic_login_members", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				}

				if ($destiny) {
					$url = $destiny;
					if ($query) $url .= "?".$query;
				} else {
					$url = DEFAULT_URL."/".MEMBERS_ALIAS."/";
				}

				$profileObj = new Profile(sess_getAccountIdFromSession());
				$profileObj->setNumber("account_id", sess_getAccountIdFromSession());
				$profileObj->Save();

				$accountObj = new Account(sess_getAccountIdFromSession());
				if ($_POST["advertise"] || $_POST["claim"]) {
					$accountObj->changeMemberStatus(true);
				}

				$accDomain = new Account_Domain($accountObj->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($accountObj->getNumber("id"), $accountObj, false, $profileObj);

				if ((string_strpos($_SERVER["HTTP_REFERER"], "".MEMBERS_ALIAS."") === false || string_strpos($_SERVER["HTTP_REFERER"], "".MEMBERS_ALIAS."/login.php")) && !$_POST["advertise"] && !$_POST["claim"]) {
					if (($AccountObj->getString("is_sponsor") == "y" || SOCIALNETWORK_FEATURE == "off") && (string_strpos($url, "profile") === false)) {
						$url = DEFAULT_URL."/".MEMBERS_ALIAS."/";
					} else {
						if (SOCIALNETWORK_FEATURE == "off"){
							$url = DEFAULT_URL."/".MEMBERS_ALIAS."/";
						} else {
							$url = SOCIALNETWORK_URL."/";
						}
					}
				}

				$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

				setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);

				if ($_GET['userperm'] == true) {
					$_x_http_refer = $_SESSION["HTTP_REFER"];
					unset($_SESSION["HTTP_REFER"]);

					/*
					 * Workaround to pin a bookmark without login
					 */
					if ($_GET['bookmark_remember']){
						// Sets a cookie to use in front JS
						setcookie('open_bookmark', $_GET['bookmark_remember'], time()+60*60, '/');
					} elseif ($_GET['redeem_remember']){
						/*
						 * Workaround for make a redeem without login
						 */
						// Sets a cookie to use in front JS
						setcookie('open_redeem', $_GET['redeem_remember'], time()+60*60, '/');
					} else {
						// Opens modal automatically
						$_SESSION['_sf2_attributes']['modal'] = 1;
					}

					if ($_x_http_refer) {
						header("Location: ".$_x_http_refer);
					} else {
						header("Location: ".$_SERVER["HTTP_REFERER"]);
					}

				} else {
					header("Location: ".$url);
				}
				exit;

			}

		}

		$username = $_POST["username"];

		$message_login = $authmessage;

	} elseif ($_GET["facebookerror"]) {

		$facebookerror = $_GET["facebookerror"];
		$message_login = $facebookerror;
		$username = $_COOKIE["username_members"];

	} elseif ($_GET["googleerror"]) {

		$googleerror = $_GET["googleerror"];

		if ($googleerror){;

			if ($googleerror == "cancel"){
				$message_login = system_showText(LANG_MSG_GOOGLE_CANCEL);
			} else {
				$message_login = system_showText(LANG_MSG_OPENID_ERROR);
			}
		}

	} elseif ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "members")) {

			$accountObj = new Account($forgotPasswordObj->getString("account_id"));

			if ($accountObj->getNumber("id")) {

				sess_registerAccountInSession($accountObj->getString("username"));
				setcookie("username_members", $accountObj->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

                if (string_strpos($_SERVER["PHP_SELF"], "/".SOCIALNETWORK_FEATURE_NAME."/login.php") !== false) {
                    $resetLink = DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/resetpassword.php?key=".$_GET["key"];
                } else {
                    $resetLink = DEFAULT_URL."/".MEMBERS_ALIAS."/resetpassword.php?key=".$_GET["key"];
                }

				header("Location: ".$resetLink);
				exit;

			} else {
				$message_login = system_showText(LANG_MSG_WRONG_ACCOUNT);
			}

		} else {
			$message_login = system_showText(LANG_MSG_WRONG_KEY);
		}

	} elseif ($_GET["activation_key"]) {

		$activationObj = new Account_Activation($_GET["activation_key"]);

		if ($activationObj->getString("unique_key")) {

			$accountObj = new Account($activationObj->getString("account_id"));

			if ($accountObj->getNumber("id")) {

				sess_registerAccountInSession($accountObj->getString("username"));
				setcookie("username_members", $accountObj->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

                $accountObj->setString("active", "y");
                $accountObj->save();

                $activationObj->delete();

                if ($accountObj->getString("is_sponsor") == "y") {
                    header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/account/index.php?messageAct=1");
                } else {
                    header("Location: ".SOCIALNETWORK_URL."/index.php?messageAct=1");
                }
                exit;

			} else {
				$message_login = system_showText(LANG_MSG_WRONG_ACCOUNT);
			}

		} else {
			$message_login = system_showText(LANG_MSG_WRONG_ACTIVATION_KEY);
		}

	} else {

		$username = $_COOKIE["username_members"];
		if ($_COOKIE["automatic_login_members"] == "true") $checked = "checked";
		else $checked = "";

	}

	setting_get("foreignaccount_google", $foreignaccount_google);

?>
