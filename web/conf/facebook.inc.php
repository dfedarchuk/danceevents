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
	# * FILE: /conf/facebook.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK API
	# ----------------------------------------------------------------------------------------------------
	/*
	 * GETTING THE FACEBOOK INFORMATION FROM DATABASE
	 */
	setting_get("foreignaccount_facebook",				$foreignaccount_facebook);
	setting_get("foreignaccount_facebook_apiid",		$foreignaccount_facebook_apiid);
	setting_get("foreignaccount_facebook_apisecret",	$foreignaccount_facebook_apisecret);
    setting_get("commenting_fb_user_id",                $fb_user_id);

	if ($foreignaccount_facebook && $foreignaccount_facebook_apiid && $foreignaccount_facebook_apisecret) {
		define("FACEBOOK_APP_ENABLED",  $foreignaccount_facebook);
	} else {
		define("FACEBOOK_APP_ENABLED",  "off");
	}

	/*
	 * JUST FOR "demodirectory.com"
	 */
	if (DEMO_LIVE_MODE) {
		if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com") !== false) {
			define("FACEBOOK_APP_DEMO",     "true");
            if ($_SERVER["HTTP_HOST"] == "demodirectory.com.br") {
                define("FACEBOOK_API_ID",       "386600388083879");
                define("FACEBOOK_USER_ID",      "100004673012955");
                define("FACEBOOK_API_SECRET",   "1aea610b11c3391d2c14087b3849dfd4");
            } else {
                define("FACEBOOK_API_ID",       "252603471534094");
                define("FACEBOOK_USER_ID",      "100004673012955");
                define("FACEBOOK_API_SECRET",   "da19c0b595be961f52211fa392534eaf");
            }
		} else {
			define("FACEBOOK_APP_DEMO",     "false");
		}
	} else {
		define("FACEBOOK_APP_DEMO",         "false");
	}

	/*
	 * FOR DEV AND LIVE
	 */
	if (FACEBOOK_APP_DEMO != "true") {
		define("FACEBOOK_API_ID",       $foreignaccount_facebook_apiid);
		define("FACEBOOK_USER_ID",      $fb_user_id);
		define("FACEBOOK_API_SECRET",   $foreignaccount_facebook_apisecret);
	}

	/*
	 * GETTING LOGIN AND LOGOUT INFORMATION
	 */
	define("FACEBOOK_REDIRECT_URI",     DEFAULT_URL."/".MEMBERS_ALIAS."/facebookauth.php");
	define("FACEBOOK_PERMISSION_SCOPE", "email");

	unset(
		$foreignaccount_facebook,
		$foreignaccount_facebook_apiid,
		$foreignaccount_facebook_apisecret
	);
