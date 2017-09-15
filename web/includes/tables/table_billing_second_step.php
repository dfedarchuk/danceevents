<?php

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
	# * FILE: /includes/tables/table_billing_second_step.php
	# ----------------------------------------------------------------------------------------------------

	$max_item_sum = 20;
	$stop_payment = false;

?>

	<h2 class="theme-title">
        <?=system_showText(LANG_BIILING_INFORMATION);?>
        <small class="pull-right"><a class="btn btn-xs btn-link" href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/billing/pay.php"?>"><?=system_showText(LANG_LABEL_BACK);?></a></small>
    </h2>


	<?
	# ----------------------------------------------------------------------------------------------------
	# LISTINGS
	# ----------------------------------------------------------------------------------------------------
	if(count($bill_info["listings"]) > $max_item_sum){

		?> <div class="alert alert-warning"><?=system_showText(str_replace("[MAX_ITEMS_MODULE]", $max_item_sum." ".LISTING_FEATURE_NAME_PLURAL, LANG_MSG_PROCCESS_MAXITEMS));?> <br /> <?=system_showText(LANG_MSG_PROCCESS_AGAIN);?></div><?

		$arr_size = count($bill_info["listings"]);
		for($i=0; $i < $arr_size; $i++){
			$dump = array_pop($bill_info["listings"]);
		}

		$stop_payment = true;

	}
	?>

	<? if ($bill_info["listings"]) { ?>
		<table class="table table-bordered table-striped">
			<tr>
				<th><?=system_showText(LANG_LISTING_NAME);?></th>
				<th width="100"><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
				<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<th width="120"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
					<? } ?>
				<? } ?>
				<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				<th width="60"><?=system_showText(LANG_LABEL_PRICE_PLURAL);?></th>
			</tr>
			<? foreach($bill_info["listings"] as $id => $info) { ?>
				<tr>
					<td><?=system_showTruncatedText($info["title"], 35);?><?=($info["listingtemplate"]?"<span class=\"itemNote\"> (".$info["listingtemplate"].")</span>":"");?></td>
					<td style="text-align:center"><?=$info["extra_category_amount"]?></td>
					<td><?=string_ucwords($info["level"])?></td>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<td style="text-align:center"><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA)?></td>
						<? } ?>
					<? } ?>
					<td><?=format_date($info["renewal_date"])?></td>
					<td><?=CURRENCY_SYMBOL.$info["total_fee"];?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>

	<?
	# ----------------------------------------------------------------------------------------------------
	# EVENTS
	# ----------------------------------------------------------------------------------------------------
	if(count($bill_info["events"]) > $max_item_sum){

		?> <div class="alert alert-warning"><?=system_showText(str_replace("[MAX_ITEMS_MODULE]", $max_item_sum." ".EVENT_FEATURE_NAME_PLURAL, LANG_MSG_PROCCESS_MAXITEMS));?> <br /> <?=system_showText(LANG_MSG_PROCCESS_AGAIN);?></div><?

		$arr_size = count($bill_info["events"]);
		for($i=0; $i < $arr_size; $i++){
			$dump = array_pop($bill_info["events"]);
		}

		$stop_payment = true;

	}
	?>

	<? if ($bill_info["events"]) { ?>
		<table class="table table-bordered table-striped">
			<tr>
				<th><?=system_showText(LANG_EVENT_NAME);?></th>
				<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<th width="120"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
					<? } ?>
				<? } ?>
				<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				<th width="60"><?=system_showText(LANG_LABEL_PRICE_PLURAL);?></th>
			</tr>
			<? foreach($bill_info["events"] as $id => $info) { ?>
				<tr>
					<td><?=system_showTruncatedText($info["title"], 35);?></td>
					<td><?=string_ucwords($info["level"])?></td>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<td style="text-align:center"><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA)?></td>
						<? } ?>
					<? } ?>
					<td><?=format_date($info["renewal_date"])?></td>
					<td><?=CURRENCY_SYMBOL.$info["total_fee"];?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>

	<?
	# ----------------------------------------------------------------------------------------------------
	# BANNERS
	# ----------------------------------------------------------------------------------------------------
	if(count($bill_info["banners"]) > $max_item_sum){

		?> <div class="alert alert-warning"><?=system_showText(str_replace("[MAX_ITEMS_MODULE]", $max_item_sum." ".BANNER_FEATURE_NAME_PLURAL, LANG_MSG_PROCCESS_MAXITEMS));?> <br /> <?=system_showText(LANG_MSG_PROCCESS_AGAIN);?></div><?

		$arr_size = count($bill_info["banners"]);
		for($i=0; $i < $arr_size; $i++){
			$dump = array_pop($bill_info["banners"]);
		}

		$stop_payment = true;

	}
	?>

	<? if ($bill_info["banners"]) { ?>
		<table class="table table-bordered table-striped">
			<tr>
				<th><?=system_showText(LANG_BANNER_NAME)?></th>
				<th width="100"><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
				<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<th width="120"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
					<? } ?>
				<? } ?>
				<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				<th width="60"><?=system_showText(LANG_LABEL_PRICE_PLURAL);?></th>
			</tr>
			<? foreach($bill_info["banners"] as $id => $info) { ?>
				<tr>
					<td><?=system_showTruncatedText($info["caption"], 35);?></td>
					<td><?=(($info["expiration_setting"] != BANNER_EXPIRATION_IMPRESSION) ? system_showText(LANG_LABEL_UNLIMITED) : $info["unpaid_impressions"])?></td>
					<td><?=string_ucwords($info["level"])?></td>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<td style="text-align:center"><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA)?></td>
						<? } ?>
					<? } ?>
					<td><?=(($info["expiration_setting"] != BANNER_EXPIRATION_RENEWAL_DATE) ? system_showText(LANG_LABEL_UNLIMITED) : format_date($info["renewal_date"]))?></td>
					<td><?=CURRENCY_SYMBOL.$info["total_fee"];?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>

	<?
	# ----------------------------------------------------------------------------------------------------
	# CLASSIFIEDS
	# ----------------------------------------------------------------------------------------------------
	if(count($bill_info["classifieds"]) > $max_item_sum){

		?> <div class="alert alert-warning"><?=system_showText(str_replace("[MAX_ITEMS_MODULE]", $max_item_sum." ".CLASSIFIED_FEATURE_NAME_PLURAL, LANG_MSG_PROCCESS_MAXITEMS));?> <br /> <?=system_showText(LANG_MSG_PROCCESS_AGAIN);?></div><?

		$arr_size = count($bill_info["classifieds"]);
		for($i=0; $i < $arr_size; $i++){
			$dump = array_pop($bill_info["classifieds"]);
		}

		$stop_payment = true;

	}
	?>

	<? if ($bill_info["classifieds"]) { ?>
		<table class="table table-bordered table-striped">
			<tr>
				<th><?=system_showText(LANG_CLASSIFIED_NAME);?></th>
				<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<th width="120"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
					<? } ?>
				<? } ?>
				<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				<th width="60"><?=system_showText(LANG_LABEL_PRICE_PLURAL);?></th>
			</tr>
			<? foreach($bill_info["classifieds"] as $id => $info) { ?>
				<tr>
					<td><?=system_showTruncatedText($info["title"], 35);?></td>
					<td><?=string_ucwords($info["level"])?></td>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<td style="text-align:center"><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA)?></td>
						<? } ?>
					<? } ?>
					<td><?=format_date($info["renewal_date"])?></td>
					<td><?=CURRENCY_SYMBOL.$info["total_fee"];?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>

	<?
	# ----------------------------------------------------------------------------------------------------
	# ARTICLES
	# ----------------------------------------------------------------------------------------------------
	if(count($bill_info["articles"]) > $max_item_sum){

		?> <div class="alert alert-warning"><?=system_showText(str_replace("[MAX_ITEMS_MODULE]", $max_item_sum." ".ARTICLE_FEATURE_NAME_PLURAL, LANG_MSG_PROCCESS_MAXITEMS));?> <br /> <?=system_showText(LANG_MSG_PROCCESS_AGAIN);?></div><?

		$arr_size = count($bill_info["articles"]);
		for($i=0; $i < $arr_size; $i++){
			$dump = array_pop($bill_info["articles"]);
		}

		$stop_payment = true;

	}
	?>

	<? if ($bill_info["articles"]) { ?>
		<table class="table table-bordered table-striped">
			<tr>
				<th><?=system_showText(LANG_ARTICLE_NAME)?></th>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<th width="120"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
					<? } ?>
				<? } ?>
				<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				<th width="60"><?=system_showText(LANG_LABEL_PRICE_PLURAL);?></th>
			</tr>
			<? foreach($bill_info["articles"] as $id => $info) { ?>
				<tr>
					<td><?=system_showTruncatedText($info["title"], 35);?></td>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<td style="text-align:center"><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA)?></td>
						<? } ?>
					<? } ?>
					<td><?=format_date($info["renewal_date"])?></td>
					<td><?=CURRENCY_SYMBOL.$info["total_fee"];?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>

	<?
	# ----------------------------------------------------------------------------------------------------
	# CUSTOM INVOICES
	# ----------------------------------------------------------------------------------------------------
	if(count($bill_info["custominvoices"]) > $max_item_sum){

		?> <div class="alert alert-warning"><?=system_showText(str_replace("[MAX_ITEMS_MODULE]", $max_item_sum." ".LANG_CUSTOM_INVOICES, LANG_MSG_PROCCESS_MAXITEMS));?> <br /> <?=system_showText(LANG_MSG_PROCCESS_AGAIN);?></div><?

		$arr_size = count($bill_info["custominvoices"]);
		for($i=0; $i < $arr_size; $i++){
			$dump = array_pop($bill_info["custominvoices"]);
		}

		$stop_payment = true;

	}
	?>

	<? if ($bill_info["custominvoices"]) { ?>
		<table class="table table-bordered table-striped">
			<tr>
				<th><?=system_showText(LANG_LABEL_TITLE)?></th>
				<th width="120"><?=system_showText(LANG_LABEL_ITEMS)?></th>
				<th width="70"><?=system_showText(LANG_LABEL_DATE)?></th>
				<th width="60"><?=system_showText(LANG_LABEL_AMOUNT)?></th>
			</tr>
			<? foreach($bill_info["custominvoices"] as $id => $info) { ?>
				<tr>
					<td><?=system_showTruncatedText($info["title"], 35);?></td>
					<td><a data-toggle="modal" data-target="#modal-custominvoice-<?=$info["id"]?>" class="link-table" style="cursor: pointer;"><?=ucfirst(system_showText(LANG_VIEWITEMS))?></a></td>
					<td><?=format_date($info["date"])?></td>
					<td><?=CURRENCY_SYMBOL.$info["subtotal"];?></td>
				</tr>
			<? } ?>
		</table>
	<?
		foreach($bill_info["custominvoices"] as $id => $info) {
			include(INCLUDES_DIR."/modals/modal-custominvoice.php");
		}

	} ?>

	<? if (!$stop_payment) { ?>

		<?
		# ----------------------------------------------------------------------------------------------------
		# TOTAL BILL
		# ----------------------------------------------------------------------------------------------------
		if($bill_info["total_bill"]){
			?>
			<table class="table table-bordered">
				<? if ($payment_tax_status || $bill_info["tax_amount"] > 0) { ?>
					<tr>
						<th class="text-right"><?=system_showText(LANG_SUBTOTALAMOUNT);?> &nbsp;</th>
						<td class="text-right">
							<strong><?=CURRENCY_SYMBOL.$bill_info["total_bill"];?></strong>
						</td>
					</tr>
					<tr>
						<th class="text-right"><?=$payment_tax_label." (".$bill_info["tax_amount"]."%)";?> &nbsp;</th>
						<td class="text-right">
							<strong><?=CURRENCY_SYMBOL.payment_calculateTax($bill_info["total_bill"], $bill_info["tax_amount"], true, false);?></strong>
						</td>
					</tr>
				<? } ?>
				<tr>
					<th class="text-right"><?=system_showText(LANG_LABEL_TOTAL_PRICE);?> &nbsp;</th>
					<td class="active text-right">
						<strong><?=CURRENCY_SYMBOL.format_money($bill_info["amount"]);?></strong>
					</td>
				</tr>
			</table>
			<?
		}
		?>

		<?
		if (($payment_method == "invoice") && (INVOICEPAYMENT_FEATURE == "on")) {
			?>
            <div class="row text-center">
                <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/invoice.php?id=<?=$bill_info["invoice_number"]?>" target="_blank" class="btn btn-success"><?=system_showText(LANG_LABEL_PAY_BY_INVOICE);?></a>
            </div>
			<?
		} else {
			$payment_process = "billing" ?>
			<br><br>
			<hr>
			<br>
			<div class="row">
				<?
				include(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php");
				?>
			</div>

		<?
        }
		?>

	<? } ?>
