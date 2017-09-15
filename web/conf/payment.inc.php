<?php

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
	# * FILE: /conf/payment.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	$payment_stripeStatus = "off";	
	$payment_paypalStatus = "off";
	$payment_paypalapiStatus = "off";
	$payment_payflowStatus = "off";
	$payment_twocheckoutStatus = "off";
	$payment_worldpayStatus = "off";
	$payment_authorizeStatus = "off";
	$payment_pagseguroStatus = "off";

	$payment_recurring = "off";
	
	$payment_currency = "USD";
	$currency_symbol = "$";
	
	$invoice_payment = "on";
	$manual_payment = "on";

	//loading the definitions file

	include(EDIRECTORY_ROOT."/custom/domain/domain.inc.php");
	if (strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."") !== false) $_domain_id = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
	else $_domain_id = SELECTED_DOMAIN_ID;

	$definitions_file = EDIRECTORY_ROOT.'/custom/domain_'.$_domain_id.'/payment/payment.inc.php';
	if (file_exists($definitions_file)) {
		include_once($definitions_file);
	}
	unset($_domain_id, $domainInfo);

	# ****************************************************************************************************
	# EDIRECTORY PAYMENT GATEWAY
	# ****************************************************************************************************
	define("INVOICEPAYMENT_FEATURE",    $invoice_payment);
	define("MANUALPAYMENT_FEATURE",     $manual_payment);
	
	unset($invoice_payment);
	unset($manual_payment);
	# ****************************************************************************************************
	# NORMAL PAYMENT GATEWAY
	# ****************************************************************************************************
	define("STRIPEPAYMENT_FEATURE",         $payment_stripeStatus);
	define("PAYPALPAYMENT_FEATURE",         $payment_paypalStatus);
	define("PAYPALAPIPAYMENT_FEATURE",      $payment_paypalapiStatus);
	define("PAYFLOWPAYMENT_FEATURE",        $payment_payflowStatus);
	define("TWOCHECKOUTPAYMENT_FEATURE",    $payment_twocheckoutStatus);
	define("WORLDPAYPAYMENT_FEATURE",       $payment_worldpayStatus);
	define("AUTHORIZEPAYMENT_FEATURE",      $payment_authorizeStatus);
	define("PAGSEGUROPAYMENT_FEATURE",      $payment_pagseguroStatus);

	unset($payment_stripeStatus);
	unset($payment_paypalStatus);
	unset($payment_paypalapiStatus);
	unset($payment_twocheckoutStatus);
	unset($payment_worldpayStatus);
	unset($payment_authorizeStatus);
	unset($payment_pagseguroStatus);
	
	# ****************************************************************************************************
	# RECURRING PAYMENT GATEWAY
	# ****************************************************************************************************

	define("RECURRING_FEATURE",    			$payment_recurring);

	unset($payment_recurring);

	# ****************************************************************************************************
	# IMPORTANT: This is the default currency for all payment systems. To change it to another currency,
	# you just need to change this define, and it will affect all system. You can also use a different
	# currency for each type of payment by just setting the currency constant for each payment system.
	# ****************************************************************************************************
	# ----------------------------------------------------------------------------------------------------
	# CURRENCY
	# ----------------------------------------------------------------------------------------------------
	define("PAYMENT_CURRENCY",  $payment_currency);
	define("CURRENCY_SYMBOL",   $currency_symbol);

	unset($payment_currency);
	unset($currency_symbol);

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	if ((PAYMENTSYSTEM_FEATURE == "off") || ((PAYMENTSYSTEM_FEATURE == "on") && (INVOICEPAYMENT_FEATURE == "off") && (MANUALPAYMENT_FEATURE == "off") && (PAYPALPAYMENT_FEATURE == "off") && (STRIPEPAYMENT_FEATURE == "off") && (PAYPALAPIPAYMENT_FEATURE == "off") && (PAYFLOWPAYMENT_FEATURE == "off") && (TWOCHECKOUTPAYMENT_FEATURE == "off") && (WORLDPAYPAYMENT_FEATURE == "off") && (AUTHORIZEPAYMENT_FEATURE == "off") && (PAGSEGUROPAYMENT_FEATURE == "off"))) {
		define("PAYMENT_FEATURE", "off");
	} else {
		define("PAYMENT_FEATURE", "on");
	}
	if ((STRIPEPAYMENT_FEATURE == "on") ||  (PAYPALPAYMENT_FEATURE == "on") || (PAYPALAPIPAYMENT_FEATURE == "on") || (PAYFLOWPAYMENT_FEATURE == "on") || (TWOCHECKOUTPAYMENT_FEATURE == "on") || (WORLDPAYPAYMENT_FEATURE == "on") || (AUTHORIZEPAYMENT_FEATURE == "on") || (PAGSEGUROPAYMENT_FEATURE == "on")) {
		define("CREDITCARDPAYMENT_FEATURE", "on");
	} else {
		define("CREDITCARDPAYMENT_FEATURE", "off");
	}
	if (DEMO_DEV_MODE || DEMO_LIVE_MODE) {
		define("REALTRANSACTION", "off");
	} else {
		define("REALTRANSACTION", "on");
	}
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

	# ----------------------------------------------------------------------------------------------------
	# INVOICE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (INVOICEPAYMENT_FEATURE == "on") {
		define("INVOICEPAYMENT_CURRENCY", PAYMENT_CURRENCY);
	}

	# ----------------------------------------------------------------------------------------------------
	# MANUAL CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (MANUALPAYMENT_FEATURE == "on") {
		define("MANUAL_STATUS",     "Completed");
		define("MANUAL_CURRENCY",   PAYMENT_CURRENCY);
	}