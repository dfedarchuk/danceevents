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
	# * FILE: /conf/twilio.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# TWILIO API
	# ----------------------------------------------------------------------------------------------------
	/*
	 * GETTING THE TWILIO INFORMATION FROM DATABASE
	 */
	setting_get("twilio_enabled_call", $twilio_enabled_call);
	setting_get("twilio_account_sid", $twilio_account_sid);
	setting_get("twilio_auth_token", $twilio_auth_token);

	if ($twilio_enabled_call && $twilio_account_sid && $twilio_auth_token) {
		define("TWILIO_APP_ENABLED", "on");
		define("TWILIO_APP_ENABLED_SMS", "off");
		if ($twilio_enabled_call){
			define("TWILIO_APP_ENABLED_CALL", "on");
		} else {
			define("TWILIO_APP_ENABLED_CALL", "off");
		}
	} else {
		define("TWILIO_APP_ENABLED",        "off");
		define("TWILIO_APP_ENABLED_SMS",    "off");
		define("TWILIO_APP_ENABLED_CALL",   "off");
	}

	/*
	 * JUST FOR "demodirectory.com"
	 */
	if (DEMO_LIVE_MODE) {
		if (string_strpos($_SERVER["HTTP_HOST"], "demodirectory.com") !== false) {
			define("TWILIO_APP_DEMO",   "true");
			define("TWILIO_API_SID",    "AC399c366225f42a21d7cbb7817be656ea");
			define("TWILIO_API_AUTH",   "920b553ae8ecda92d8abcc8f04c94778");
		} else {
			define("TWILIO_APP_DEMO", "false");
		}
	} else {
		define("TWILIO_APP_DEMO", "false");
	}

	/*
	 * FOR DEV AND LIVE
	 */
	if (TWILIO_APP_DEMO != "true") {
		define("TWILIO_API_SID",    $twilio_account_sid);
		define("TWILIO_API_AUTH",   $twilio_auth_token);
	}
	
	unset(
		$twilio_enabled_call, 
		$twilio_account_sid, 
		$twilio_auth_token
	);

?>