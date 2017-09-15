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
	# * FILE: /conf/payment_twocheckout.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# TWOCHECKOUT CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (TWOCHECKOUTPAYMENT_FEATURE == "on") {
		if (REALTRANSACTION == "on") {
			$twocheckout_login = "";
			$dbObjPayment = db_getDBObject();
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'TWOCHECKOUT_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "TWOCHECKOUT_LOGIN") $twocheckout_login = crypt_decrypt($row["value"]);
			}
			unset($dbObjPayment);
			define("TWOCHECKOUT_LOGIN", $twocheckout_login);
			define("TWOCHECKOUT_DEMO",  "N");
		} else {
			define("TWOCHECKOUT_LOGIN", "1244082");
			define("TWOCHECKOUT_DEMO",  "Y");
		}
		//define("TWOCHECKOUT_POST_URL",  "https://www.2checkout.com/2co/buyer/purchase"); // Old Page
		define("TWOCHECKOUT_POST_URL",  "https://www.2checkout.com/checkout/spurchase"); // New Page
		define("TWOCHECKOUT_LANG",      "en");
		define("TWOCHECKOUT_CURRENCY",  PAYMENT_CURRENCY);
	}

?>