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
	# * FILE: /conf/payment_stripe.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# STRIPE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (STRIPEPAYMENT_FEATURE == "on") {
		$dbObjPayment = db_getDBObject();
		if (REALTRANSACTION == "on") {
			$stripe_apikey = "";
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'STRIPE_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "STRIPE_APIKEY") $stripe_apikey = crypt_decrypt($row["value"]);
			}
			define("STRIPE_APIKEY",    $stripe_apikey);
		} else {
			define("STRIPE_APIKEY",    "sk_test_duUABpgkvJ1O2NLBBzqIsMI5");
		}
		unset($dbObjPayment);
	}