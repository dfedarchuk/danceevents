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
	# * FILE: /conf/ssl.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	define("SSL_ENABLED",       "off");
    define("FORCE_PROFILE_SSL", "off");
	define("FORCE_MEMBERS_SSL", "off");
	define("FORCE_ORDER_SSL",   "off");
	define("FORCE_CLAIM_SSL",   "off");
	define("FORCE_SITEMGR_SSL", "off");

	# ----------------------------------------------------------------------------------------------------
	# SSL
	# ----------------------------------------------------------------------------------------------------
    if (SSL_ENABLED == "on") {
		if (FORCE_PROFILE_SSL == "on") {
			if ((HTTPS_MODE != "on") && (string_strpos($_SERVER["PHP_SELF"], "/profile") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}
		if (FORCE_MEMBERS_SSL == "on") {
			if ((HTTPS_MODE != "on") && (string_strpos($_SERVER["PHP_SELF"], "/sponsors") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
			if ((HTTPS_MODE != "on") && (FORCE_ORDER_SSL == "on") && (string_strpos($_SERVER["PHP_SELF"], "order_") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
            if ((HTTPS_MODE != "on") && (FORCE_CLAIM_SSL == "on") && (string_strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CLAIM_URL_DIVISOR."/") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}
		if (FORCE_SITEMGR_SSL == "on") {
			if ((HTTPS_MODE != "on") && (string_strpos($_SERVER["PHP_SELF"], "/sitemgr") !== false) && (string_strpos($_SERVER["PHP_SELF"], "/registration.php") === false) && (string_strpos($_SERVER["PHP_SELF"], "&popup=1") === false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}
	} else {
		if (HTTPS_MODE == "on") {
			header("Location: "."http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
			exit;
		}
	}

?>
