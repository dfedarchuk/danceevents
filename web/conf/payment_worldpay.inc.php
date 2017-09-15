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
	# * FILE: /conf/payment_worldpay.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# WORLDPAY CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (WORLDPAYPAYMENT_FEATURE == "on") {
		if (REALTRANSACTION == "on") {
			$worldpay_instid = "";
			$dbObjPayment = db_getDBObject();
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'WORLDPAY_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "WORLDPAY_INSTID") $worldpay_instid = crypt_decrypt($row["value"]);
			}
			unset($dbObjPayment);
			define("WORLDPAY_INSTID",   $worldpay_instid);
			define("WORLDPAY_TESTMODE", "0");
            define("WORLDPAY_HOST",     "https://secure.worldpay.com/wcc/purchase");
		} else {
			define("WORLDPAY_INSTID",   "214424");
			define("WORLDPAY_TESTMODE", "100");
            define("WORLDPAY_HOST",     "https://secure-test.worldpay.com/wcc/purchase");
		}
		define("WORLDPAY_LANG",     "en");
		define("WORLDPAY_CURRENCY", PAYMENT_CURRENCY);
	}
?>