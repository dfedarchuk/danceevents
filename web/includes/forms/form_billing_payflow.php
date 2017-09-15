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
	# * FILE: /includes/forms/form_billing_payflow.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_payflow.inc.php");

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);

	if (PAYFLOWPAYMENT_FEATURE == "on") {

		if (!PAYFLOW_LOGIN || !PAYFLOW_PARTNER) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_GATEWAY_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {
				$listing_ids[] = $id;
				$listing_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_listing_{$id}"] ? $_SESSION["order_renewal_period_listing_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$listing_renewals[] = $renewal_cycle;
			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {
				$event_ids[] = $id;
				$event_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_event_{$id}"] ? $_SESSION["order_renewal_period_event_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$event_renewals[] = $renewal_cycle;
			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {
				$banner_ids[] = $id;
				$banner_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_banner_{$id}"] ? $_SESSION["order_renewal_period_banner_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$banner_renewals[] = $renewal_cycle;
			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {
				$classified_ids[] = $id;
				$classified_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_classified_{$id}"] ? $_SESSION["order_renewal_period_classified_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$classified_renewals[] = $renewal_cycle;
			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {
				$article_ids[] = $id;
				$article_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_article_{$id}"] ? $_SESSION["order_renewal_period_article_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$article_renewals[] = $renewal_cycle;
			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {
				$custominvoice_ids[] = $id;
				$custominvoice_amounts[] = $info["subtotal"];
			}

			$amount = str_replace(",", ".", $bill_info["total_bill"]);
			if ($listing_ids){
				$listing_ids = implode("::",$listing_ids);
			}
			if ($listing_amounts){
				$listing_amounts = implode("::",$listing_amounts);
			}
			if ($listing_renewals){
				$listing_renewals = implode("::",$listing_renewals);
			}
			if ($event_ids){
				$event_ids = implode("::",$event_ids);
			}
			if ($event_amounts){
				$event_amounts = implode("::",$event_amounts);
			}
			if ($event_renewals){
				$event_renewals = implode("::",$event_renewals);
			}
			if ($banner_ids){
				$banner_ids = implode("::",$banner_ids);
			}
			if ($banner_amounts){
				$banner_amounts = implode("::",$banner_amounts);
			}
			if ($banner_renewals){
				$banner_renewals = implode("::",$banner_renewals);
			}
			if ($classified_ids){
				$classified_ids = implode("::",$classified_ids);
			}
			if ($classified_amounts){
				$classified_amounts = implode("::",$classified_amounts);
			}
			if ($classified_renewals){
				$classified_renewals = implode("::",$classified_renewals);
			}
			if ($article_ids){
				$article_ids = implode("::",$article_ids);
			}
			if ($article_amounts){
				$article_amounts = implode("::",$article_amounts);
			}
			if ($article_renewals){
				$article_renewals = implode("::",$article_renewals);
			}
			if ($custominvoice_ids){
				$custominvoice_ids = implode("::",$custominvoice_ids);
			}
			if ($custominvoice_amounts){
				$custominvoice_amounts = implode("::",$custominvoice_amounts);
			}
			$payflow_account_id = sess_getAccountIdFromSession();

			?>

			<script type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("payflowbutton").disabled = true;
					document.payflowform.submit();
				}
				//-->
			</script>

			<form name="payflowform" target="_self" action="<?=PAYFLOW_POST_URL?>" method="post">

				<div style="display: none;">
					<?
					$subtotal = $amount;
					$_SESSION["payflow_subtotal"] = $subtotal;
					if ($payment_tax_status == "on") {
						$amount = payment_calculateTax($subtotal, $payment_tax_value);
						$taxAmount = payment_calculateTax($subtotal, $payment_tax_value, true, false);
					}
					$_SESSION["payflow_package_id"] = $package_id;
					$_SESSION["payflow_domain_id"] = SELECTED_DOMAIN_ID;
					?>

					<input type="hidden" name="LOGIN"		value="<?=PAYFLOW_LOGIN?>" />
					<input type="hidden" name="PARTNER"		value="<?=PAYFLOW_PARTNER?>" />
					<input type="hidden" name="AMOUNT"		value="<?=$amount?>" />
					<input type="hidden" name="TAX"			value="<?=$taxAmount?>" />
					<input type="hidden" name="TYPE"		value="S" />
					<input type="hidden" name="INVOICE"		value="<?=uniqid(0);?>" />
					<input type="hidden" name="CUSTID"		value="<?=$payflow_account_id?>" />

					<input type="hidden" name="USER1" value="1" />
					<input type="hidden" name="USER2" value="<?=$listing_ids."||".$listing_amounts."||".$listing_renewals?>" />
					<input type="hidden" name="USER3" value="<?=$event_ids."||".$event_amounts."||".$event_renewals?>" />
					<input type="hidden" name="USER4" value="<?=$banner_ids."||".$banner_amounts."||".$banner_renewals?>" />
					<input type="hidden" name="USER5" value="<?=$classified_ids."||".$classified_amounts."||".$classified_renewals?>" />
					<input type="hidden" name="USER6" value="<?=$article_ids."||".$article_amounts."||".$article_renewals?>" />
					<input type="hidden" name="USER7" value="<?=$custominvoice_ids."||".$custominvoice_amounts?>" />

				</div>

				<? if ($payment_process == "signup") {

                    $buttonGateway = "<button class=\"btn btn-success btn-lg \" type=\"button\" id=\"payflowbutton\" onclick=\"submitOrder();\">".system_highlightWords(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))."</button>";

                } else { ?>
					<p class="row text-center">
						<button class="btn btn-success" type="button" id="payflowbutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD);?></button>
					</p>
				<? } ?>

			</form>

			<?

		}

	}

?>
