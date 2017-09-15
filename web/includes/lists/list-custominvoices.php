<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/lists/list-custominvoices.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    if ($msg == 1) {
        echo "<p class=\"alert alert-success\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_DELETE_SUCCESS)."</p>";
    }
    if ($error_message) {
        echo "<p class=\"alert alert-warning\">".(is_numeric($error_message) ? $msg_bulkupdate[$error_message] : $error_message)."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"alert alert-success\">".LANG_SITEMGR_CUSTOMINVOICES_DELETE_SUCCESS."</p>";
    } elseif(is_numeric($message) && isset($msg_custominvoice[$message])) {
        echo "<p class=\"alert alert-".(!$error ? "success" : "warning")."\">".$msg_custominvoice[$message]."</p>";
    }
    unset($msg);
?>

    <section>

        <form name="item_list" role="form">

            <ul class="list-content-item list">

                <?
                $cont = 0;
                
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

                if ($custominvoices) foreach ($custominvoices as $customInvoice) {
                    $cont++;
                    $id = $customInvoice->getNumber("id");
                    
                    // ---------------- //
                    $sql = "SELECT payment_log_id FROM Payment_CustomInvoice_Log WHERE custom_invoice_id = $id ORDER BY date DESC LIMIT 1";
                    $r = $db->query($sql);
                    $aux_transaction_data = mysql_fetch_assoc($r);
                    if($aux_transaction_data) {
                        $sql = "SELECT id, transaction_datetime, transaction_id FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]} AND hidden = 'n'";
                        $r = $db->query($sql);
                        $transaction_data = mysql_fetch_assoc($r);
                    } else {
                        unset($transaction_data);
                    }
                    // ---------------- //
                    $sql = "SELECT IC.invoice_id,IC.custom_invoice_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_CustomInvoice IC WHERE IC.custom_invoice_id = $id AND I.status = 'R' AND I.id = IC.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
                    $r = $db->query($sql);
                    $invoice_data = mysql_fetch_assoc($r);
                    // ---------------- //
                    list($t_month,$t_day,$t_year)     = explode("/",format_date($transaction_data["transaction_datetime"],DEFAULT_DATE_FORMAT,"datetime"));
                    list($i_month,$i_day,$i_year)     = explode("/",format_date($invoice_data["payment_date"],DEFAULT_DATE_FORMAT,"datetime"));
                    list($t_hour,$t_minute,$t_second) = explode(":",format_date($transaction_data["transaction_datetime"],"H:i:s","datetime"));
                    list($i_hour,$i_minute,$i_second) = explode(":",format_date($invoice_data["payment_date"],"H:i:s","datetime"));
                    $t_ts_date = mktime((int)$t_hour,(int)$t_minute,(int)$t_second,(int)$t_month,(int)$t_day,(int)$t_year);
                    $i_ts_date = mktime((int)$i_hour,(int)$i_minute,(int)$i_second,(int)$i_month,(int)$i_day,(int)$i_year);

                    if (PAYMENT_FEATURE == "on") {
                        if (((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) && (INVOICEPAYMENT_FEATURE == "on")) {
                            if($t_ts_date < $i_ts_date){
                                if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/activity/invoices/index.php?search_id=".$invoice_data["id"];
                                else unset($history_lnk);
                            } else {
                                if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions/index.php?search_id=".$transaction_data["transaction_id"];
                                else unset($history_lnk);
                            }
                        } elseif ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) {
                            if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions/index.php?search_id=".$transaction_data["transaction_id"];
                            else unset($history_lnk);
                        } elseif (INVOICEPAYMENT_FEATURE == "on") {
                            if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/activity/invoices/index.php?search_id=".$invoice_data["id"];
                            else unset($history_lnk);
                        } else {
                            unset($history_lnk);
                        }
                    } else {
                        unset($history_lnk);
                    }
                    
                    //Prepare info to preview
                    $previewCustomInvoice[$cont]["id"] = $id;
                    $previewCustomInvoice[$cont]["paid"] = $customInvoice->getString("paid");
                    $previewCustomInvoice[$cont]["transation"] = $history_lnk;
                    $account = db_getFromDB("account", "id", db_formatNumber($customInvoice->getNumber("account_id")));
                    $account_id = $customInvoice->getNumber("account_id");
                    $str_time = format_getTimeString($customInvoice->getString("date"));
                    $date = format_date($customInvoice->getString("date"), DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time;
                    
                    if ($customInvoice->getString("paid") == "y") {
                        $status = system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID);
                        $statusStyle = "status-active";
                    } elseif ($customInvoice->getString("sent") == "y") {
                        $status = system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT);
                        $statusStyle = "status-suspended";
                    } else {
                        $status = system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT);
                        $statusStyle = "status-pending";
                    }
                    
                    
                // --------------- HTML code ------------------- //?>

                <li class="content-item" data-id="<?=$id?>">
                    
                    <div class="check-bulk">
                        <input type="checkbox" id="custominvoice_id<?=$cont?>" name="item_check[]" value="<?=$id?>" onclick="bulkSelect('custominvoice');"/>
                    </div>
                    <div class="item">
                        <h3 class="item-title"><?=$customInvoice->getString("title");?></h3>
                        <p>
                            <? if ($account_id > 0) {  ?>
                                <a title="<?=system_showAccountUserName($account->getString("username"));?>" href="<?=$url_base?>/account/sponsor/sponsor.php?id=<?=$account_id?>" class="link-table">
                                    <?=system_showAccountUserName($account->getString("username"));?>
                                </a>
                            <? } else { ?>
                                <span title="<?=system_showAccountUserName($account->getString("username"))?>" style="cursor:default">
                                    <?=system_showAccountUserName($account->getString("username"));?>
                                </span>
                            <? } ?>
                        </p>
                        <p>
                            <span class="pull-left"><?=$date?></span>
                            <span class="pull-right"><span class="<?=$statusStyle?>"><?=$status?></span></span>
                        </p>
                       
                    </div>
                </li>
            <? } ?>

            </ul>

        </form>

    </section>