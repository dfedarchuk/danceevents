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
	# * FILE: /includes/code/custominvoice_items.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on" && INVOICEPAYMENT_FEATURE != "on") { exit; }
	if (CUSTOM_INVOICE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$customInvoiceItems = false;

	if (!$view || $view != "payment_log") {
		if ($id) {
			$customInvoice = new CustomInvoice($id);
			if ($customInvoice->getNumber("account_id") != sess_getAccountIdFromSession()) {
				exit;
			}
			$customInvoiceItems = $customInvoice->getItems();
		} else {
			exit;
		}
	} else {

		if (!$items && !$items_price) { exit; }

		$customInvoice = new CustomInvoice($id);
		if ($customInvoice->getNumber("account_id") != sess_getAccountIdFromSession()) {
			exit;
		}

		$customInvoiceItems = true;

		$customInvoicePaymentItems = $items;
		$customInvoicePaymentPrices = $items_price;

		$customInvoicePaymentItems = explode("\n", $customInvoicePaymentItems);
		$customInvoicePaymentPrices = explode("\n", $customInvoicePaymentPrices);

	}
?>