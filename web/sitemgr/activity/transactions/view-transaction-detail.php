<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/transactions/view-transaction-detail.php
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
        header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
        exit;
    }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) {
        header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
        exit;
    }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);
    
    if (!$id) {
        exit;
    }
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");
    
    $url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
    
    include(INCLUDES_DIR."/code/transaction.php");
    
    $log_id = $transaction["id"];
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $sql = "SELECT level FROM Payment_Classified_Log WHERE payment_log_id = $log_id LIMIT 1";
    $result = $dbObj->query($sql);
    $log_level = mysql_fetch_assoc($result);

    $str_time = "";

    $startTimeStr = explode(":", $transaction["transaction_datetime"]);
    $startTimeStr[0] = string_substr($startTimeStr[0],-2);
    if (CLOCK_TYPE == '24') {
        $start_time_hour = $startTimeStr[0];
    } elseif (CLOCK_TYPE == '12') {
        if ($startTimeStr[0] > "12") {
            $start_time_hour = $startTimeStr[0] - 12;
            $start_time_am_pm = "pm";
        } elseif ($startTimeStr[0] == "12") {
            $start_time_hour = 12;
            $start_time_am_pm = "pm";
        } elseif ($startTimeStr[0] == "00") {
            $start_time_hour = 12;
            $start_time_am_pm = "am";
        } else {
            $start_time_hour = $startTimeStr[0];
            $start_time_am_pm = "am";
        }
    }
    if ($start_time_hour < 10) $start_time_hour = "0".($start_time_hour+0);
    $start_time_min = $startTimeStr[1];
    $str_time .= $start_time_hour.":".$start_time_min." ".$start_time_am_pm;

    $transac_date = explode(" ",$transaction["transaction_datetime"]);
    ?>

    <? if ($transaction["system_type"] == "manual") {?>
        <p class="text-muted"><i><?=system_showText(LANG_TRANSACTION_MANUAL);?></i></p>
    <? } ?>

    <h2><?=system_showText(LANG_TRANSACTION_INFO)?></h2>

    <ul class="list-unstyled">
        <li>
            <strong><?=system_showText(LANG_LABEL_ACCOUNT)?>:</strong>
            <? if ($transaction["account_id"]) echo "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?id=".$transaction["account_id"]."\" title = \"".$transaction["username"]."\">"; ?>
                <?=system_showTruncatedText(system_showAccountUserName($transaction["username"]), 50);?>
            <? if ($transaction["account_id"]) echo "</a>"; ?>
        </li>

        <li>
            <strong><?=system_showText(LANG_LABEL_PAYMENT_TYPE)?>:</strong>
            <?
            if (($transaction["system_type"] != "stripe") && ($transaction["system_type"] != "paypal") && ($transaction["system_type"] != "manual") && ($transaction["system_type"] != "pagseguro")) {
                echo system_showText(LANG_CREDITCARD);
            } else {
                echo ucfirst($transaction["system_type"]);
            }
            if ($transaction["recurring"] == "y") {
                echo "&nbsp;<em>".system_showText(LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS)."</em>";
            }
            ?>
        </li>
        <li><strong><?=system_showText(LANG_LABEL_ID)?>:</strong> <?=$transaction["transaction_id"]?></li>
        <li><strong><?=system_showText(LANG_LABEL_STATUS)?>:</strong> <?=@constant(string_strtoupper(("LANG_LABEL_".$transaction["transaction_status"])))?></li>
        <li><strong><?=system_showText(LANG_LABEL_DATE)?>:</strong> <?=$transac_date[0]." - ".$str_time;?></li>
        <li><strong><?=system_showText(LANG_LABEL_IP)?>:</strong> <?=$transaction["ip"]?></li>
        <li><strong><?=system_showText(LANG_LABEL_SUBTOTAL)?>:</strong> <?=$transaction["transaction_subtotal"]?> (<?=$transaction["transaction_currency"]?>)</li>
        <li><strong><?=system_showText(LANG_LABEL_TAX)?>:</strong> <?=$transaction["transaction_tax"]?> (<?=$transaction["transaction_currency"]?>)</li>
        <li><strong><?=system_showText(LANG_LABEL_AMOUNT)?>:</strong> <?=$transaction["transaction_amount"]?> (<?=$transaction["transaction_currency"]?>)</li>
        <li><strong><?=system_showText(LANG_LABEL_NOTES)?>:</strong> <?=$transaction["notes"]?></li>
    </ul>

    <? if ($transaction_listing_log) {
        ?>

        <h2 class="standardSubTitle"><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                    <th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
                    <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <th ><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                        <? } ?>
                    <? } ?>
                    <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                    <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($transaction_listing_log as $each_listing) { ?>
                <tr>
                    <td>
                        <?
                        $transactionListingObj = new Listing($each_listing["listing_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($transactionListingObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=LISTING_FEATURE_FOLDER;?>/listing.php?id=<?=$each_listing["listing_id"]?>" title="<?=$each_listing["listing_title"];?>"><?=system_showTruncatedText($each_listing["listing_title"], 50);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_listing["listing_title"], 50);?><?
                        }
                        ?>
                        <?=($each_listing["listingtemplate"]?"<span class=\"itemNote\">(".$each_listing["listingtemplate"].")</span>":"");?>
                    </td>
                    <td ><?=$each_listing["extra_categories"]?></td>
                    <td><?=string_ucwords($each_listing["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td ><?=$each_listing["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td ><?=($each_listing["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_listing["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
                    <td >
                        <?=$each_listing["amount"]." (".$transaction["transaction_currency"].")";?>
                    </td>
                </tr>
            <? } ?>
           </tbody>
        </table>
        </div>
    <? } ?>

    <? if ($transaction_event_log) { ?>

        <h2 class="standardSubTitle"><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></h2>

        <div class="content-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                    <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <th ><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                        <? } ?>
                    <? } ?>
                    <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                    <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($transaction_event_log as $each_event) { ?>
                <tr>
                    <td>
                        <?
                        $transactionEventObj = new Event($each_event["event_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($transactionEventObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=EVENT_FEATURE_FOLDER;?>/event.php?id=<?=$each_event["event_id"]?>" title="<?=$each_event["event_title"];?>"><?=system_showTruncatedText($each_event["event_title"], 50);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_event["event_title"], 50);?><?
                        }
                        ?>
                    </td>
                    <td><?=string_ucwords($each_event["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td ><?=$each_event["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td ><?=($each_event["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_event["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
                    <td >
                        <?=$each_event["amount"]." (".$transaction["transaction_currency"].")";?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
    <? } ?>

    <? if ($transaction_banner_log) { ?>

        <h2 class="standardSubTitle"><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></h2>

        <div class="content-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?=system_showText(LANG_LABEL_CAPTION)?></th>
                    <th><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
                    <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <th ><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                        <? } ?>
                    <? } ?>
                    <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                    <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($transaction_banner_log as $each_banner) {?>
                <tr>
                    <td>
                        <?
                        $transactionBannerObj = new Banner($each_banner["banner_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($transactionBannerObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=BANNER_FEATURE_FOLDER;?>/banner.php?id=<?=$each_banner["banner_id"]?>" title="<?=$each_banner["banner_caption"]?>"><?=system_showTruncatedText($each_banner["banner_caption"], 50);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_banner["banner_caption"], 50);?><?
                        }
                        ?>
                    </td>
                    <td ><?=(($each_banner["impressions"]) ? $each_banner["impressions"] : system_showText(LANG_LABEL_UNLIMITED))?></td>
                    <td><?=string_ucwords($each_banner["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td ><?=$each_banner["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td ><?=($each_banner["renewal_date"] == "0000-00-00") ? (($each_banner["impressions"]) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_NA))) : format_date($each_banner["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
                    <td >
                        <?=$each_banner["amount"]." (".$transaction["transaction_currency"].")";?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
    <? } ?>

    <? if ($transaction_classified_log) { ?>

        <h2 class="standardSubTitle"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></h2>

        <div class="content-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                    <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <th ><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                        <? } ?>
                    <? } ?>
                    <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                    <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($transaction_classified_log as $each_classified) { ?>
                <tr>
                    <td>
                        <?
                        $transactionClassifiedObj = new Classified($each_classified["classified_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($transactionClassifiedObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=CLASSIFIED_FEATURE_FOLDER;?>/classified.php?id=<?=$each_classified["classified_id"]?>" title="<?=$each_classified["classified_title"]?>"><?=system_showTruncatedText($each_classified["classified_title"], 50);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_classified["classified_title"], 50);?><?
                        }
                        ?>
                    </td>
                    <td><?=string_ucwords($each_classified["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td ><?=$each_classified["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td ><?=($each_classified["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_classified["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
                    <td >
                        <?=$each_classified["amount"]." (".$transaction["transaction_currency"].")";?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
    <? } ?>

    <? if ($transaction_article_log) { ?>

        <h2 class="standardSubTitle"><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></h2>

        <div class="content-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <th ><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                        <? } ?>
                    <? } ?>
                    <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                    <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($transaction_article_log as $each_article) { ?>
                <tr>
                    <td>
                        <?
                        $transactionArticleObj = new Article($each_article["article_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($transactionArticleObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=ARTICLE_FEATURE_FOLDER;?>/article.php?id=<?=$each_article["article_id"]?>" title="<?=$each_article["article_title"]?>"><?=system_showTruncatedText($each_article["article_title"], 50);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_article["article_title"], 50);?><?
                        }
                        ?>
                    </td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td ><?=$each_article["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td ><?=($each_article["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_article["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
                    <td >
                        <?=$each_article["amount"]." (".$transaction["transaction_currency"].")";?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
    <? } ?>

    <? if ($transaction_custominvoice_log) { ?>
        <h2 class="standardSubTitle"><?=system_showText(LANG_CUSTOM_INVOICES);?></h2>

        <div class="content-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                    <th ><?=system_showText(LANG_LABEL_ITEMS);?></th>
                    <th><?=system_showText(LANG_LABEL_DATE);?></th>
                    <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($transaction_custominvoice_log as $each_custominvoice) { ?>
                <tr>
                    <td>
                        <?
                        $transactionCustomInvoiceObj = new CustomInvoice($each_custominvoice["custom_invoice_id"]);					

                        if ($transactionCustomInvoiceObj->getNumber("id") > 0) { ?>
                            <a href="<?=$url_base?>/activity/custominvoices/index.php?search_id=<?=$each_custominvoice["custom_invoice_id"]?>" title="<?=$each_custominvoice["title"]?>"><?=system_showTruncatedText($each_custominvoice["title"], 50);?></a>
                        <? } else {
                            ?><?=$each_custominvoice["title"]?><?
                        }
                        ?>
                    </td>
                    <td><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/index.php?search_id=".$each_custominvoice["custom_invoice_id"];?>&items=<?=urlencode($each_custominvoice["items"])?>&items_price=<?=urlencode($each_custominvoice["items_price"])?>&view=payment_log"><?=system_showText(LANG_VIEWITEMS)?></a></td>
                    <td><?=format_date($each_custominvoice["date"])?></td>
                    <td >
                        <?=$each_custominvoice["amount"]." (".$transaction["transaction_currency"].")";?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
    <? } ?>

    <? if ($transaction_package_log) { ?>
        <h2 class="standardSubTitle"><?=system_showText(LANG_PACKAGE_SING);?></h2>

        <div class="content-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                    <th ><?=system_showText(LANG_LABEL_ITEMS);?></th>
                    <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($transaction_package_log as $each_package) { ?>
                <tr>
                    <td>
                        <?
                        $transactionPackageObj = new Package($each_package["package_id"]);

                        if ($transactionPackageObj->getNumber("id") > 0) { ?>
                            <a href="<?=$url_base?>/promote/promotions/package.php?id=<?=$each_package["package_id"]?>" title="<?=$each_package["package_title"]?>"><?=system_showTruncatedText($each_package["package_title"], 50);?></a>
                        <? } else {
                            ?><?=$each_package["package_title"]?><?
                        }
                        ?>
                    </td>
                    <td>
                        <?=$each_package["items"];?>
                    </td>
                    <td>
                        <?=$each_package["amount"]." (".$transaction["transaction_currency"].")";?>
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
    <? } ?>