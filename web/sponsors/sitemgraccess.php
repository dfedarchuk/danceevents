<?php

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
	# * FILE: /sponsors/sitemgraccess.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (!empty($_SESSION[SM_LOGGEDIN])) {

		if (isset($_GET["logout"])) {

			if ($_SESSION[SESS_ACCOUNT_ID]) {

				$acctObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
				$db = db_getDBObject(DEFAULT_DB, true);
				$dbLogoutObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
				$logoutSQL = "INSERT INTO Report_Login (datetime, ip, type, page, username) values (NOW(), ".db_formatString(getenv("REMOTE_ADDR")).", 'logout', ".db_formatString($_SERVER["PHP_SELF"]).", ".db_formatString($acctObj->getString("username")).")";
				$dbLogoutObj->query($logoutSQL);

			}


			unset($_SESSION[SESS_ACCOUNT_ID]);
			unset($_GET["account"]);

			echo "
				<script type=\"text/javascript\">
					window.close();
					opener.focus();
				</script>
			";

			exit;

		}

		if ($_GET["account"]) {

			$accountObj = db_getFromDB("account", "username", db_formatString($_GET["account"]));

			if ($accountObj->getNumber("id")) {

				$_SESSION[SESS_ACCOUNT_ID] = $accountObj->getNumber("id");

				$db = db_getDBObject(DEFAULT_DB, true);
				$dbLoginObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
				$loginSQL = "INSERT INTO Report_Login (datetime, ip, type, page, username) values (NOW(), ".db_formatString(getenv("REMOTE_ADDR")).", 'login', ".db_formatString($_SERVER["PHP_SELF"]).", ".db_formatString($_GET["account"]).")";
				$dbLoginObj->query($loginSQL);

			} else {
				unset($_SESSION[SESS_ACCOUNT_ID]);
			}

		} else {
			unset($_SESSION[SESS_ACCOUNT_ID]);
		}

		if ($_GET["action"] == 'profile') {
			$profile = new Profile($accountObj->getNumber("id"));
			$profileLink = SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/";
			header("Location: ".$profileLink);
			exit;
		} elseif ($_GET["action"] == 'edit_profile') {
			header("Location: ".SOCIALNETWORK_URL."/");
			exit;
		} else {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			exit;
		}
	}