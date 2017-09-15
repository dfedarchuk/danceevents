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
	if (INVOICEPAYMENT_FEATURE != "on") {
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
    
    include(INCLUDES_DIR."/code/invoice.php");
    
?>
    <h2><?=system_showText(LANG_INVOICEINFO);?></h2>

	<ul class="list-unstyled">
		<li>
            <strong><?=system_showText(LANG_LABEL_ACCOUNT);?>:</strong>
			<? if ($invoice["account_id"]) echo "<a href=\"".$url_base."/account/sponsor/sponsor.php?id=".$invoice["account_id"]."\">"; ?>
				<?=system_showTruncatedText(system_showAccountUserName($invoice["username"]), 35);?>
			<? if ($invoice["account_id"]) echo "</a>"; ?>
		</li>

		<?
		$str_time = format_getTimeString($invoice["date"]);
		$invoice_issuingdate = explode(" ",$invoice["date"]);
		$invoice_paymentdate = explode(" ",$invoice["payment_date"]);
		$str_timePaymentDate = format_getTimeString($invoice["payment_date"]);
		?>

		<li><strong><?=system_showText(LANG_LABEL_ID);?>:</strong> <?=$invoice["id"]?><? if (string_strpos($url_base, "/".MEMBERS_ALIAS."")) { ?>&nbsp;<a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/invoice.php?id=<?=$id?>" target="_blank"><img src="<?=DEFAULT_URL?>/assets/images/structure/icon_print.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?>" /></a><? } ?></li>
		<li><strong><?=system_showText(LANG_LABEL_STATUS);?>:</strong> <?=$invoice["status"]?></li>
		<li><strong><?=system_showText(LANG_ISSUINGDATE);?>:</strong> <?=$invoice_issuingdate[0]." - ".$str_time?></li>
		<li><strong><?=system_showText(LANG_PAYMENTDATE);?>:</strong> <?=(($invoice["payment_date"]) ? $invoice_paymentdate[0]." - ".$str_timePaymentDate : system_showText(LANG_NONE))?></li>
		<li><strong><?=system_showText(LANG_EXPIREDATE);?>:</strong> <?=$invoice["expire_date"]?></li><li>
		<strong><?=system_showText(LANG_LABEL_IP);?>:</strong> <?=$invoice["ip"]?></li>
		<li><strong><?=system_showText(LANG_LABEL_SUBTOTAL);?>:</strong> <?=$invoice["subtotal"]?> (<?=$invoice["currency"]?>)</li>
		<li><strong><?=system_showText(LANG_LABEL_TAX);?>:</strong> <?=$invoice["tax"]?> (<?=$invoice["currency"]?>)</li>
		<li><strong><?=system_showText(LANG_LABEL_AMOUNT);?>:</strong> <?=$invoice["amount"]?> (<?=$invoice["currency"]?>)</li>
	</ul>

    <? if($invoice_listing){ ?>
        <h2><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                <th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
                <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                <? if (PAYMENT_FEATURE == "on") { ?>
                    <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                        <th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                    <? } ?>
                <? } ?>
                <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
            </tr>
            <? foreach($invoice_listing as $each_invoice_listing) { ?>
                <tr>
                    <td>
                        <?
                        $invoiceListingObj = new Listing($each_invoice_listing["listing_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($invoiceListingObj->getNumber("id") > 0 && $validMember) {
                        ?>
                        <a href="<?=$url_base?>/content/<?=LISTING_FEATURE_FOLDER;?>/listing.php?id=<?=$each_invoice_listing["listing_id"]?>"><?=system_showTruncatedText($each_invoice_listing["listing_title"], 35);?></a>
                        <?
                        } else {
                        ?>
                        <?=$each_invoice_listing["listing_title"]?>
                        <?
                        }
                        ?>
                        <?=($each_invoice_listing["listingtemplate"]?"<span class=\"itemNote\">(".$each_invoice_listing["listingtemplate"].")</span>":"");?>
                    </td>
                    <td><?=$each_invoice_listing["extra_categories"]?></td>
                    <td><?=string_ucwords($each_invoice_listing["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td><?=$each_invoice_listing["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td><?=$each_invoice_listing["renewal_date"]?></td>
                    <td>
                        <?=$each_invoice_listing["amount"]." (".$invoice["currency"].")";?>
                    </td>
                </tr>
            <? }?>
        </table>
    </div>
    <? } ?>

    <? if($invoice_event){ ?>
        <h2><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                <? if (PAYMENT_FEATURE == "on") { ?>
                    <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                        <th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                    <? } ?>
                <? } ?>
                <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
            </tr>
            <? foreach($invoice_event as $each_invoice_event) { ?>
                <tr>
                    <td>
                        <?
                        $invoiceEventObj = new Event($each_invoice_event["event_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($invoiceEventObj->getNumber("id") > 0  && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=EVENT_FEATURE_FOLDER;?>/event.php?id=<?=$each_invoice_event["event_id"]?>"><?=system_showTruncatedText($each_invoice_event["event_title"], 35);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_invoice_event["event_title"], 35);?><?
                        }
                        ?>
                    </td>
                    <td><?=string_ucwords($each_invoice_event["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td><?=$each_invoice_event["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td><?=$each_invoice_event["renewal_date"]?></td>
                    <td>
                        <?=$each_invoice_event["amount"]." (".$invoice["currency"].")";?>
                    </td>
                </tr>
            <? }?>
        </table>
    </div>
    <? } ?>

    <? if($invoice_banner){ ?>
        <h2><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?=system_showText(LANG_LABEL_CAPTION)?></th>
                <th><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
                <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                <? if (PAYMENT_FEATURE == "on") { ?>
                    <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                        <th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                    <? } ?>
                <? } ?>
                <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
            </tr>
            <? foreach($invoice_banner as $each_invoice_banner) { ?>
                <tr>
                    <td>
                        <?
                        $invoiceBannerObj = new Banner($each_invoice_banner["banner_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($invoiceBannerObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=BANNER_FEATURE_FOLDER;?>/banner.php?id=<?=$each_invoice_banner["banner_id"]?>"><?=$each_invoice_banner["banner_caption"]?></a><?
                        } else {
                            ?><?=$each_invoice_banner["banner_caption"]?><?
                        }
                        ?>
                    </td>
                    <td><?=$each_invoice_banner["impressions"]?></td>
                    <td><?=string_ucwords($each_invoice_banner["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td><?=$each_invoice_banner["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td><?=$each_invoice_banner["renewal_date"]?></td>
                    <td>
                        <?=$each_invoice_banner["amount"]." (".$invoice["currency"].")";?>
                    </td>
                </tr>
            <? }?>
        </table>
    </div>
    <? } ?>

    <? if($invoice_classified){ ?>
        <h2><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                <? if (PAYMENT_FEATURE == "on") { ?>
                    <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                        <th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                    <? } ?>
                <? } ?>
                <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
            </tr>
            <? foreach($invoice_classified as $each_invoice_classified) { ?>
                <tr>
                    <td>
                        <?
                        $invoiceClassifiedObj = new Classified($each_invoice_classified["classified_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($invoiceClassifiedObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=CLASSIFIED_FEATURE_FOLDER;?>/classified.php?id=<?=$each_invoice_classified["classified_id"]?>"><?=system_showTruncatedText($each_invoice_classified["classified_title"], 35);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_invoice_classified["classified_title"], 35);?><?
                        }
                        ?>
                    </td>
                    <td><?=string_ucwords($each_invoice_classified["level_label"]);?></td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td><?=$each_invoice_classified["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td><?=$each_invoice_classified["renewal_date"]?></td>
                    <td>
                        <?=$each_invoice_classified["amount"]." (".$invoice["currency"].")";?>
                    </td>
                </tr>
            <? }?>
        </table>
    </div>
    <? } ?>

    <? if($invoice_article){ ?>
        <h2><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                <? if (PAYMENT_FEATURE == "on") { ?>
                    <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                        <th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                    <? } ?>
                <? } ?>
                <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
            </tr>
            <? foreach($invoice_article as $each_invoice_article) { ?>
                <tr>
                    <td>
                        <?
                        $invoiceArticleObj = new Article($each_invoice_article["article_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

                        if ($invoiceArticleObj->getNumber("id") > 0 && $validMember) {
                            ?><a href="<?=$url_base?>/content/<?=ARTICLE_FEATURE_FOLDER;?>/article.php?id=<?=$each_invoice_article["article_id"]?>"><?=system_showTruncatedText($each_invoice_article["article_title"], 35);?></a><?
                        } else {
                            ?><?=system_showTruncatedText($each_invoice_article["article_title"], 35);?><?
                        }
                        ?>
                    </td>
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                            <td><?=$each_invoice_article["discount_id"]?></td>
                        <? } ?>
                    <? } ?>
                    <td><?=$each_invoice_article["renewal_date"]?></td>
                    <td>
                        <?=$each_invoice_article["amount"]." (".$invoice["currency"].")";?>
                    </td>
                </tr>
            <? }?>
        </table>
    </div>
    <? } ?>

    <? if($invoice_custominvoice){ ?>
        <h2><?=system_showText(LANG_CUSTOM_INVOICES);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMS);?></th>
                <th><?=system_showText(LANG_LABEL_DATE);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
            </tr>
            <? foreach($invoice_custominvoice as $each_invoice_custominvoice) { ?>
                <tr>
                    <td>
                        <?
                        $invoiceCustomInvoiceObj = new CustomInvoice($each_invoice_custominvoice["custom_invoice_id"]);
                        if ($invoiceCustomInvoiceObj->getNumber("id") > 0) { ?>
                            <a href="<?=$url_base?>/activity/custominvoices/index.php?search_id=<?=$each_invoice_custominvoice["custom_invoice_id"]?>"><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?></a>
                        <? } else {
                            ?><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?><?
                        }
                        ?>
                    </td>
                    <td><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/index.php?search_id=".$each_invoice_custominvoice["custom_invoice_id"]?>&items=<?=urlencode($each_invoice_custominvoice["items"])?>&items_price=<?=urlencode($each_invoice_custominvoice["items_price"])?>&view=payment_log"><?=system_showText(LANG_VIEWITEMS)?></a></td>
                    <td><?=format_date($each_invoice_custominvoice["date"])?></td>
                    <td>
                        <?=$each_invoice_custominvoice["subtotal"]." (".$invoice["currency"].")";?>
                    </td>
                </tr>
            <? }?>
        </table>
    </div>
    <? } ?>

    <? if ($invoice_package) { ?>
        <h2><?=system_showText(LANG_PACKAGE_PLURAL);?></h2>
        <div class="content-table">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?=system_showText(LANG_LABEL_TITLE);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMS);?></th>
                <th><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
            </tr>
            <? foreach($invoice_package as $each_invoice_package) { ?>
                <tr>
                    <td>
                        <?
                        $invoicePackageObj = new Package($each_invoice_package["package_id"]);

                        if ($invoicePackageObj->getNumber("id") > 0) { ?>
                            <a href="<?=$url_base?>/promote/promotions/package.php?id=<?=$each_invoice_package["package_id"]?>"><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?></a>
                        <? } else {
                            ?><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?><?
                        }
                        ?>
                    </td>
                    <td>
                        <?=$each_invoice_package["subtotal"]." (".$invoice["currency"].")";?>
                    </td>
                </tr>
            <? } ?>
        </table>
    </div>
    <? } ?>