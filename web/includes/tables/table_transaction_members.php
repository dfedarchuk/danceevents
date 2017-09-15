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
	# * FILE: /includes/tables/table_transaction_members.php
	# ----------------------------------------------------------------------------------------------------

?>
    <script type="text/javascript">
        function JS_openDetail(type, id) {
            document.getElementById(type+'info_'+id).style.display = '';
            document.getElementById(type+'img_'+id).innerHTML = '<i style="cursor: pointer;" class="text-success fa fa-folder-open-o onclick="JS_closeDetail(\''+type+'\', '+id+');" ></i>'
        }

        function JS_closeDetail(type, id) {
            document.getElementById(type+'info_'+id).style.display = 'none';
            document.getElementById(type+'img_'+id).innerHTML = '<i style="cursor: pointer;" class="text-success fa fa-folder-o onclick="JS_openDetail(\''+type+'\', '+id+');" ></i>'
        }
    </script>

    <table class="table table-striped table-bordered">

        <tr>
            <th style="width:20px">&nbsp;</th>
            <th><?=system_showText(LANG_LABEL_ID);?></th>
            <th><?=system_showText(LANG_LABEL_SYSTEM);?></th>
            <th><?=system_showText(LANG_LABEL_STATUS);?></th>
            <th><?=system_showText(LANG_LABEL_DATE);?></th>
            <th><?=system_showText(LANG_LABEL_SUBTOTAL);?></th>
            <th><?=system_showText(LANG_LABEL_TAX);?></th>
            <th><?=system_showText(LANG_LABEL_AMOUNT);?></th>
            <th style="width:72px"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
        </tr>

        <?
        if ($transactions) foreach ($transactions as $transaction) {
            $id = $transaction["id"];
            $str_time = format_getTimeString($transaction["transaction_datetime"]);
            if (defined("LANG_LABEL_".$transaction["transaction_status"])) {
                $labelStatus = @constant(string_strtoupper(("LANG_LABEL_".$transaction["transaction_status"])));
            } else {
                $labelStatus = $transaction["transaction_status"];
            }
            ?>
            <tr>
                <td>
                    <div id="transactionimg_<?=$transaction["id"]; ?>">
                        <i class="fa fa-folder-o text-success" style="cursor: pointer;" onclick="JS_openDetail('transaction', '<?=$transaction["id"];?>');"></i>
                    </div>
                </td>

                <td>
                    <span title="<?=$transaction["transaction_id"]?>" style="cursor:default"><?=system_showTruncatedText($transaction["transaction_id"], 15)?></span>
                </td>

                <td>
                    <?
                    if (($transaction["system_type"] != "paypal") && ($transaction["system_type"] != "manual") && ($transaction["system_type"] != "pagseguro")) {
                        $type_field = system_showText(LANG_CREDITCARD);
                    } else {
                        $type_field = ucfirst($transaction["system_type"]);
                    }
                    ?>
                    <span title="<?=$type_field?>" style="cursor:default"><?=$type_field?></span>
                </td>

                <td>
                    <span title="<?=$labelStatus?>" style="cursor:default"><?=$labelStatus?></span>
                </td>

                <td>
                    <span title="<?=format_date($transaction["transaction_datetime"], DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time?>" style="cursor:default"><?=format_date($transaction["transaction_datetime"], DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time?></span>
                </td>

                <td>
                    <?
                    if ($transaction["transaction_subtotal"] > 0) $subtotal_field = $transaction["transaction_subtotal"]." (".$transaction["transaction_currency"].")";
                    else $subtotal_field = "0.00 (".$transaction["transaction_currency"].")";
                    ?>
                    <span title="<?=$subtotal_field?>" style="cursor:default"><?=$subtotal_field?></span>
                </td>

                <td>
                    <?
                    if ($transaction["transaction_tax"] > 0) $tax_field = payment_calculateTax($subtotal_field, $transaction["transaction_tax"], true, false)." (".$transaction["transaction_currency"].")";
                    else $tax_field = "0.00 (".$transaction["transaction_currency"].")";
                    ?>
                    <span title="<?=$tax_field?>" style="cursor:default"><?=$tax_field?></span>
                </td>

                <td>
                    <?
                    if ($transaction["transaction_amount"] > 0) $amount_field = $transaction["transaction_amount"]." (".$transaction["transaction_currency"].")";
                    else $amount_field = "0.00 (".$transaction["transaction_currency"].")";
                    ?>
                    <span title="<?=$amount_field?>" style="cursor:default"><?=$amount_field?></span>
                </td>

                <td nowrap class="main-options">
                    <a href="<?=$url_redirect?>/view.php?id=<?=$transaction["id"]?>">
                        <?=system_showText(LANG_LABEL_VIEW);?>
                    </a>
                </td>
            </tr>

            <tr id="transactioninfo_<?=$transaction["id"];?>" style="display:none;">
                <td colspan="10">
                    <? include (INCLUDES_DIR."/views/view_transaction_summary_info.php"); ?>
                </td>
            </tr>

            <tr></tr>

        <? }

        if ($invoices) foreach($invoices as $invoice) {
            $id = $invoice["id"];
            $invoiceStatusObj = new InvoiceStatus();

            $str_time    = format_getTimeString($invoice["date"]);
            $account_id  = $invoice["account_id"];
            $username    = $invoice["username"];
            $id          = $invoice["id"];
            $ip          = $invoice["ip"];
            $date        = format_date($invoice["date"],DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time;
            $status      = $invoiceStatusObj->getStatusWithStyle($invoice["status"]);
            $amount      = $invoice["amount"];
            $subtotal    = $invoice["subtotal_amount"];
            $tax		 = $invoice["tax_amount"];
            $expire_date = format_date($invoice["date"],DEFAULT_DATE_FORMAT, "date");
            $valTax		 = payment_calculateTax($subtotal,$tax,true,false);

        ?>

        <tr>
            <td>
                <div id="invoiceimg_<?=$invoice["id"]; ?>">
                    <i class="fa fa-folder-o text-success" style="cursor: pointer;" onclick="JS_openDetail('invoice', '<?=$invoice["id"];?>');"></i>
                </div>
            </td>

            <td>
                <span title="<?=$id?>" style="cursor:default"><?=$id?></span>
            </td>

            <td><?=system_showText(LANG_LABEL_INVOICE);?></td>

            <td>
                <a title="<?=$invoiceStatusObj->getStatus($invoice["status"]);?>" class="link-table"><?=$status?></a>
            </td>

            <td>
                <span title="<?=$date?>" style="cursor:default"><?=$date?></span>
            </td>

            <td>
                <span title="<?=$subtotal?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$subtotal?> (<?=$invoice["currency"]?>)</span>
            </td>

            <td>
                <span title="<?=$valTax?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$valTax?> (<?=$invoice["currency"]?>)</span>
            </td>

            <td>
                <span title="<?=$amount?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$amount?> (<?=$invoice["currency"]?>)</span>
            </td>

            <td nowrap class="main-options">
                <a href="<?=$url_redirect?>/view_invoice.php?id=<?=$id?>"><?=system_showText(LANG_LABEL_VIEW);?></a>
                <b>|</b>
                <a target="_blank" href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/invoice.php?id=<?=$id?>">
                    <?=system_showText(LANG_LABEL_PRINT);?>
                </a>
            </td>
        </tr>

        <tr id="invoiceinfo_<?=$invoice["id"];?>" style="display:none; background-color:white;">
            <td colspan="9">
                <? include(INCLUDES_DIR."/views/view_invoice_summary_info.php"); ?>
            </td>
        </tr>

        <tr></tr>

        <? } ?>

    </table>
