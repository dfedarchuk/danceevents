<?php
$payment_stripeStatus = "off";
$payment_paypalStatus = "off";
$payment_paypalapiStatus = "off";
$payment_payflowStatus = "off";
$payment_twocheckoutStatus = "off";
$payment_worldpayStatus = "off";
$payment_authorizeStatus = "off";
$payment_pagseguroStatus = "off";

$payment_recurring = "off";

# ****************************************************************************************************
# CUSTOMIZATIONS
# NOTE: The $payment_currency in this file is only for this domain
# Any changes will require an update in the table "Setting_Payment"
# to set the property "PAYMENT_CURRENCY" with the value bellow on the domain database.
# ****************************************************************************************************
$payment_currency = "USD";

$currency_symbol = "$";

$invoice_payment = "on";
$manual_payment = "on";