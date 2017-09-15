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
	# * FILE: /conf/payment_paypalapi.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# PAYPALAPI CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (PAYPALAPIPAYMENT_FEATURE == "on") {
		if (REALTRANSACTION == "on") {
			$paypalapi_username = "";
			$paypalapi_password = "";
			$paypalapi_signature = "";
			$dbObjPayment = db_getDBObject();
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPALAPI_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "PAYPALAPI_USERNAME") $paypalapi_username = crypt_decrypt($row["value"]);
				if ($row["name"] == "PAYPALAPI_PASSWORD") $paypalapi_password = crypt_decrypt($row["value"]);
				if ($row["name"] == "PAYPALAPI_SIGNATURE") $paypalapi_signature = crypt_decrypt($row["value"]);
			}
			unset($dbObjPayment);
			define("PAYPALAPI_USERNAME",    $paypalapi_username);
			define("PAYPALAPI_PASSWORD",    $paypalapi_password);
			define("PAYPALAPI_SIGNATURE",   $paypalapi_signature);
			define("PAYPALAPI_ENDPOINT",    "https://api-3t.paypal.com/nvp");
		} else {
			define("PAYPALAPI_USERNAME",    "business_api1.demodirectory.com");
			define("PAYPALAPI_PASSWORD",    "ZBGBWNVHBY6MCDLJ");
			define("PAYPALAPI_SIGNATURE",   "AZmoiYJ9oEJo7oB6agRHujyPtlIUAeLVTov.5xkmRE9gkDT4P0iWnpKy");
			define("PAYPALAPI_ENDPOINT",    "https://api-3t.sandbox.paypal.com/nvp");
		}
		define("PAYPALAPI_USE_PROXY",   FALSE);
		define("PAYPALAPI_PROXY_HOST",  "127.0.0.1");
		define("PAYPALAPI_PROXY_PORT",  "808");
		define("PAYPALAPI_VERSION",     "2.3");
		define("PAYPALAPI_CURRENCY",    PAYMENT_CURRENCY);
	}
?>