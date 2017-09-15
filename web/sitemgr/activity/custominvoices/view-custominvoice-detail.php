<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/invoices/view-invoice-detail.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    $loadSitemgrLangs = true;	
    include("../../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") {
        exit;
    }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) {
        exit;
    }
	if (CUSTOM_INVOICE_FEATURE != "on") {
        exit;
    }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);
    
    if ($id) {
        $customInvoice = new CustomInvoice($id);
		$account = new Account($customInvoice->getNumber("account_id"));
		$contactObj = db_getFromDB("contact", "account_id", $account->getNumber("id"));
    } else {
        exit;
    }
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");
    
    $url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
    
?>
    <table class="table">
        <tr>
            <th colspan="2">
                <h1><?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?></h1>
            </th>
        </tr>
        <tr>
            <td width="50%">
                <p><b><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?></b></p>
                <p><?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 35);?></p>
            </td>
            <td width="50%">
                <p><b><?=system_showText(LANG_SITEMGR_TITLE)?></b></p>
                <p><?=$customInvoice->getString("title", true, 35);?></p>
            </td>
        </tr>
        <tr>
            <td width="50%">
                <p><b><?=system_showText(LANG_SITEMGR_NUMBER)?></b></p>
                <p><?=$customInvoice->getString("id")?></p>
            </td>
            <td width="50%">
                <p><b><?=system_showText(LANG_SITEMGR_STATUS)?></b></p>
                <p><?=($customInvoice->getString("paid") == "y" ? system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID) : ($customInvoice->getString("sent") == "y" ? system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)))?></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 300px;"><?=system_showText(LANG_SITEMGR_LABEL_ITEM)?></th>
                        <th><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></th>
                    </tr>
                    <?
                    $total_custom_invoice_price = 0;
                    $custom_invoice_items = $customInvoice->getItems();
                    if ($custom_invoice_items) {
                        foreach ($custom_invoice_items as $each_custom_invoice_item) {
                            ?>
                            <tr>
                                <td><?=$each_custom_invoice_item["description"]?></td>
                                <td>
                                    <?
                                    if ($each_custom_invoice_item["price"] > 0) {
                                        echo CURRENCY_SYMBOL." ".format_money($each_custom_invoice_item["price"]);
                                        $total_custom_invoice_price += $each_custom_invoice_item["price"];
                                    } else {
                                        echo system_showText(LANG_SITEMGR_FREE);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?
                        }
                    }
                    
                    $tax = $customInvoice->getNumber("tax");
                    setting_get("payment_tax_status", $taxStatus);
                    $subtotal = $total_custom_invoice_price;

                    if ($taxStatus == "on" && $customInvoice->getString("paid") == "y") {
                        $tax = payment_calculateTax($total_custom_invoice_price, $tax, true, false);
                    } else {
                        $tax = 0;
                    }
                    if ($taxStatus == "on" && $customInvoice->getString("paid") == "y") {
                        $total_custom_invoice_price = $total_custom_invoice_price + $tax;
                    }

                    if ($taxStatus == "on") { ?>

                    <tr>
                        <td><strong><?=string_ucwords(system_showText(LANG_LABEL_SUBTOTAL))?></strong></td>
                        <td><?=CURRENCY_SYMBOL." ".format_money($subtotal);?></td>
                    </tr>

                    <tr>
                        <td><strong><?=string_ucwords(system_showText(LANG_LABEL_TAX))?></strong></td>
                        <td><?=CURRENCY_SYMBOL." ".format_money($tax);  ?><? if ($customInvoice->getString("paid") != "y")  echo "*" ;?></td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td><strong><?=string_ucwords(system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALPAYMENTS1))?></strong></td>
                        <td><?=CURRENCY_SYMBOL." ".format_money($total_custom_invoice_price);?></td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

    <? if ($taxStatus) { ?>
        <p>* <?=system_showText(LANG_SITEMGR_LABEL_TAX_AFTER_PAID)?></p>
    <? } ?>