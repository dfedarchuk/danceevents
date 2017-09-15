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
	# * FILE: /sponsors/billing/stripe_webhook.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on") { exit; }

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//Get json content
		$input = @file_get_contents("php://input");
		$event_json = json_decode($input);

		//Webhook works only for paid invoices
		if ($event_json->type == "invoice.payment_succeeded") {
			$event_subscriptions = $event_json->data->object->lines->data;

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			//An invoice can hold multiples subscriptions
			foreach ($event_subscriptions as $subscription) {
				$subscriptionID = $subscription->id;

				//Update Log Payment date
				$sql = "SELECT id FROM Payment_Log WHERE transaction_id = '".$subscriptionID."' AND system_type = 'stripe' AND DATE_FORMAT(transaction_datetime, '%Y-%m-%d') != ".db_formatDate(date("Y-m-d", $event_json->data->object->date))." ORDER BY transaction_datetime DESC limit 1";
				$r = $db->query($sql);

				if (mysql_num_rows($r) > 0) {

					$row = mysql_fetch_assoc($r);
					$paymentLogObj = new PaymentLog($row["id"]);
					$transactionLog["transaction_datetime"] = date("Y-m-d H:m:s", $event_json->data->object->date);
					$paymentLogObj->MakeFromRow($transactionLog);
					$paymentLogObj->Save();

					//Renew items
					$modules = array("listing", "event", "classified", "article", "banner");
					$data["renewal"] = ($subscription->plan->interval == "month" ? "monthly" : "yearly");

					foreach ($modules as $module) {

						$sql = "SELECT {$module}_id, amount FROM Payment_".ucfirst($module)."_Log WHERE payment_log_id = '".$row["id"]."' ORDER BY id DESC limit 1";
						$result = $db->query($sql);

						if (mysql_num_rows($result) > 0) {
							while ($rowLog = mysql_fetch_assoc($result)) {
								$data["{$module}_id"][] = $rowLog["{$module}_id"];
								$data["{$module}_price"][] = $rowLog["amount"];
							}
							Payments::renewItem($paymentLogObj, $data, $module);
						}
					}
					$paymentLogObj->sendNotification();

				}

			}
		}

		http_response_code(200);

	}
