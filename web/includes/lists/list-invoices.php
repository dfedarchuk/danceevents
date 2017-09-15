<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/lists/list-invoices.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    
    switch( (int)$msg )
    {
        case 1 : echo "<p class=\"alert alert-success\">".system_showText(LANG_SITEMGR_INVOICE_DELETE_SUCCESS)."</p>"; break;
    }

    switch( (int)$message )
    {
        case 1 : echo "<p class=\"alert alert-success\">".system_showText(LANG_SITEMGR_INVOICE_SAVE)."</p>"; break;
    }
    
    if ($error_message) {
        echo "<p class=\"alert alert-warning\">".(is_numeric($error_message) ? $msg_bulkupdate[$error_message] : $error_message)."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"alert alert-success\">".LANG_SITEMGR_INVOICE_DELETE_SUCCESS."</p>";
    }
    unset($msg);
?>

    <section>

        <form name="item_list" role="form">

            <ul class="list-content-item list">

                <?
                $cont = 0;
                
                if ($invoices) foreach ($invoices as $invoice) {
                    $cont++;
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
                    
                    //Prepare info to preview
                    $previewInvoice[$cont]["id"] = $id;
                    $previewInvoice[$cont]["status"] = $invoice["status"];
                    
                    ?>

                <? // --------------- HTML code ------------------- //?>

                <li class="content-item" data-id="<?=$id?>">
                    
                    <div class="status text-hide"><?=$invoiceStatusObj->getStatusWithStyle($invoice["status"]);?></div>
                    
                    <div class="check-bulk">
                        <input type="checkbox" id="invoice_id<?=$cont?>" name="item_check[]" value="<?=$id?>" onclick="bulkSelect('invoice');"/>
                    </div>
                    <div class="item">
                        <h3 class="item-title"><?=$id?> - <span class="text-success"><?=$amount?> (<?=$invoice["currency"]?>)</span></h3>
                        <p>
                            <? if ($account_id > 0) {  ?>
                                <a title="<?=system_showAccountUserName($username)?>" href="<?=$url_base?>/account/sponsor/sponsor.php?id=<?=$account_id?>" class="link-table">
                                    <?=system_showTruncatedText(system_showAccountUserName($username), 60);?>
                                </a>
                            <? } else { ?>
                                <span title="<?=system_showAccountUserName($username)?>" style="cursor:default">
                                    <?=system_showTruncatedText(system_showAccountUserName($username), 60);?>
                                </span>
                            <? } ?>
                        </p>
                        <p><?=$date?></p>
                        <p><span class="pull-right"><?=$invoiceStatusObj->getStatusWithStyle($invoice["status"]);?></span></p>
                    </div>
                </li>
            <? } ?>

            </ul>

        </form>

    </section>