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
	# * FILE: /conf/payment_paypal.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# PAYPAL CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (PAYPALPAYMENT_FEATURE == "on") {
		$dbObjPayment = db_getDBObject();
		if (REALTRANSACTION == "on") {
			$paypal_account = "";
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPAL_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "PAYPAL_ACCOUNT") $paypal_account = crypt_decrypt($row["value"]);
			}
			define("PAYPAL_ACCOUNT",    $paypal_account);
			define("PAYPAL_URL",        "www.paypal.com");
		} else {
			define("PAYPAL_ACCOUNT",    "test@demodirectory.com");
			define("PAYPAL_URL",        "www.sandbox.paypal.com");
		}
		define("PAYPAL_URL_FOLDER", "/cgi-bin/webscr");
		define("PAYPAL_LC",         "US");
		define("PAYPAL_CURRENCY",   PAYMENT_CURRENCY);

		unset($dbObjPayment);
	}