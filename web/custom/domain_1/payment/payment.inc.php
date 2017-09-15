<?php
$payment_simplepayStatus = "off";
$payment_paypalStatus = "off";
$payment_paypalapiStatus = "off";
$payment_payflowStatus = "off";
$payment_twocheckoutStatus = "off";
$payment_psigateStatus = "off";
$payment_worldpayStatus = "off";
$payment_itransactStatus = "off";
$payment_linkpointStatus = "off";
$payment_authorizeStatus = "on";

$payment_simplepayRecurring = "off";
$payment_paypalRecurring = "off";
$payment_linkpointRecurring = "off";
$payment_authorizeRecurring = "off";

$period_renewalListing = "1Y";
$period_renewalEvent = "1Y";
$period_renewalBanner = "1Y";
$period_renewalClassified = "1Y";
$period_renewalArticle = "1Y";

# ****************************************************************************************************
# CUSTOMIZATIONS
# NOTE: The $payment_currency in this file is only for the domain 1
# Any changes will require an update in the table "Setting_Payment"
# to set the property "PAYMENT_CURRENCY" with the value bellow on the domain 1 database.
# ****************************************************************************************************
$payment_currency = "BRL";

$currency_symbol = "$";
$invoice_payment = "on";
$manual_payment = "on";
