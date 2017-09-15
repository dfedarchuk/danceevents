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
	# * FILE: /conf/payment_authorize.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUTHORIZE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (AUTHORIZEPAYMENT_FEATURE == "on") {
		$dbObjPayment = db_getDBObject();
		if (REALTRANSACTION == "on") {
			$authorize_login = "";
			$authorize_txnkey = "";
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'AUTHORIZE_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "AUTHORIZE_LOGIN") $authorize_login = crypt_decrypt($row["value"]);
				if ($row["name"] == "AUTHORIZE_TXNKEY") $authorize_txnkey = crypt_decrypt($row["value"]);
			}
			define("AUTHORIZE_LOGIN",   $authorize_login);
			define("AUTHORIZE_TXNKEY",  $authorize_txnkey);
			if (RECURRING_FEATURE == "on") {
				define("AUTHORIZE_POST_URL",    "https://api.authorize.net/xml/v1/request.api");
			} else {
				define("AUTHORIZE_POST_URL",    "https://secure.authorize.net/gateway/transact.dll");
			}
		} else {
			define("AUTHORIZE_LOGIN",   "9LxuDD6t4LD");
			define("AUTHORIZE_TXNKEY",  "43Dhzse243WF4q2s");
			if (RECURRING_FEATURE == "on") {
				define("AUTHORIZE_POST_URL",    "https://apitest.authorize.net/xml/v1/request.api");
			} else {
				define("AUTHORIZE_POST_URL",    "https://test.authorize.net/gateway/transact.dll");
			}
		}
		define("AUTHORIZE_CURRENCY", PAYMENT_CURRENCY);

		unset($dbObjPayment);
	}