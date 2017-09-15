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
	# * FILE: /includes/views/view_invoice_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<h2 class="theme-title"><?=system_showText(LANG_INVOICEINFO);?></h2>

	<dl class="dl-horizontal">
		<?
		$str_time = format_getTimeString($invoice["date"]);
		$invoice_issuingdate = explode(" ",$invoice["date"]);
		$invoice_paymentdate = explode(" ",$invoice["payment_date"]);
		$str_timePaymentDate = format_getTimeString($invoice["payment_date"]);
		?>
		<dt><?=system_showText(LANG_LABEL_ID);?>:</dt>
		<dd> <?=$invoice["id"]?></dd>
		<dt><?=system_showText(LANG_LABEL_STATUS);?>:</dt>
		<dd><?=$invoice["status"]?></dd>
		<dt><?=system_showText(LANG_ISSUINGDATE);?>:</dt>
		<dd> <?=$invoice_issuingdate[0]." - ".$str_time?></dd>
		<dt><?=system_showText(LANG_PAYMENTDATE);?>:</dt>
		<dd> <?=(($invoice["payment_date"]) ? $invoice_paymentdate[0]." - ".$str_timePaymentDate : system_showText(LANG_NONE))?></dd>
		<dt><?=system_showText(LANG_EXPIREDATE);?>:</dt>
		<dd> <?=$invoice["expire_date"]?></dd>
		<dt><?=system_showText(LANG_LABEL_IP);?>:</dt> <dd><?=$invoice["ip"]?></dd>
		<dt><?=system_showText(LANG_LABEL_SUBTOTAL);?>:</dt><dd> <?=$invoice["subtotal"]?> (<?=$invoice["currency"]?>)</dd>
		<dt><?=system_showText(LANG_LABEL_TAX);?>:</dt> <dd><?=$invoice["tax"]?> (<?=$invoice["currency"]?>)</dd>
		<dt><?=system_showText(LANG_LABEL_AMOUNT);?>:</dt><dd> <?=$invoice["amount"]?> (<?=$invoice["currency"]?>)</dd>
		<? if (string_strpos($url_base, "/".MEMBERS_ALIAS."")) { ?><dd><a title="<?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?>" target="_blank" href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/invoice.php?id=<?=$id?>"><i class="fa fa-print"></i> <?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?></a></dd><? } ?>

	</dl>
	<br>
<? if($invoice_listing){ ?>
	<h2 class="theme-title"><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
			<th><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
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
					<a href="<?=$url_base?>/<?=LISTING_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_listing["listing_id"]?>"><?=system_showTruncatedText($each_invoice_listing["listing_title"], 35);?></a>
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
<? } ?>

<? if($invoice_event){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
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
						?><a href="<?=$url_base?>/<?=EVENT_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_event["event_id"]?>"><?=system_showTruncatedText($each_invoice_event["event_title"], 35);?></a><?
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
<? } ?>

<? if($invoice_banner){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th><?=system_showText(LANG_LABEL_CAPTION)?></th>
			<th><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
			<th><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
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
						?><a href="<?=$url_base?>/<?=BANNER_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_banner["banner_id"]?>"><?=$each_invoice_banner["banner_caption"]?></a><?
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
<? } ?>

<? if($invoice_classified){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
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
						?><a href="<?=$url_base?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_classified["classified_id"]?>"><?=system_showTruncatedText($each_invoice_classified["classified_title"], 35);?></a><?
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
<? } ?>

<? if($invoice_article){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
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
						?><a href="<?=$url_base?>/<?=ARTICLE_FEATURE_FOLDER;?>/view.php?id=<?=$each_invoice_article["article_id"]?>"><?=system_showTruncatedText($each_invoice_article["article_title"], 35);?></a><?
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
<? } ?>

<? if($invoice_custominvoice){ ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_CUSTOM_INVOICES);?></h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th width="120px"><?=system_showText(LANG_LABEL_ITEMS);?></th>
			<th width="70"><?=system_showText(LANG_LABEL_DATE);?></th>
			<th width="100"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_custominvoice as $each_invoice_custominvoice) { ?>
			<tr>
				<td>
					<?
					$invoiceCustomInvoiceObj = new CustomInvoice($each_invoice_custominvoice["custom_invoice_id"]);
					if ($invoiceCustomInvoiceObj->getNumber("id") > 0) {
						if (string_strpos($url_base, "/".SITEMGR_ALIAS."") !== false) {
							?><a href="<?=$url_base?>/custominvoices/view.php?id=<?=$each_invoice_custominvoice["custom_invoice_id"]?>"><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?></a><?
						} else {
							?><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?><?
						}
					} else {
						?><?=system_showTruncatedText($each_invoice_custominvoice["title"], 35);?><?
					}
					?>
				</td>
				<td><a data-toggle="modal" data-target="#modal-custominvoice-<?=$each_invoice_custominvoice["custom_invoice_id"]?>" class="link-table" style="cursor: pointer;"><?=ucfirst(system_showText(LANG_VIEWITEMS))?></a></td>
				<td><?=format_date($each_invoice_custominvoice["date"])?></td>
				<td style="text-align:center; width: 100px;">
					<?=$each_invoice_custominvoice["subtotal"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
<?
	foreach($invoice_custominvoice as $each_invoice_custominvoice) {
		$id = $each_invoice_custominvoice["custom_invoice_id"];
		include(INCLUDES_DIR."/modals/modal-custominvoice.php");
	}

} ?>

<? if ($invoice_package) { ?>
	<h2 class="standardSubTitle"><?=system_showText(LANG_PACKAGE_PLURAL);?></h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th width="120px"><?=system_showText(LANG_LABEL_ITEMS);?></th>
			<th width="100"><?=system_showText(LANG_LABEL_ITEMPRICE);?></th>
		</tr>
		<? foreach($invoice_package as $each_invoice_package) { ?>
			<tr>
				<td>
					<?
					$invoicePackageObj = new Package($each_invoice_package["package_id"]);
                    
					if ($invoicePackageObj->getNumber("id") > 0) {
						if (string_strpos($url_base, "/".SITEMGR_ALIAS."") !== false) {
							?><a href="<?=$url_base?>/package/view.php?id=<?=$each_invoice_package["package_id"]?>"><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?></a><?
						} else {
							?><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?><?
						}
					} else {
						?><?=system_showTruncatedText($each_invoice_package["package_title"], 35);?><?
					}
					?>
				</td>
				<td><a data-toggle="modal" data-target="#modal-package-<?=$each_invoice_package["package_id"]?>" class="link-table" style="cursor: pointer;"><?=ucfirst(system_showText(LANG_VIEWITEMS))?></a></td>
				<td style="text-align:center; width: 100px;">
					<?=$each_invoice_package["subtotal"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
<?
	foreach($invoice_package as $each_invoice_package) {
		$id = $each_invoice_package["package_id"];
		$items = $each_invoice_package["items"];
		$items_price = $each_invoice_package["items_price"];
		include(INCLUDES_DIR."/modals/modal-packageitems.php");
	}
} ?>