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
	# * FILE: /includes/forms/form_billing_paypal.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_paypal.inc.php");

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);

	if (PAYPALPAYMENT_FEATURE == "on") {

		if (!PAYPAL_ACCOUNT) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_GATEWAY_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			$block_bannerbyimpression = false;
			$block_custominvoice = false;

			$itemCount = 1;

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {

				$renewal_cycle = ($_SESSION["order_renewal_period_listing_{$id}"] ? $_SESSION["order_renewal_period_listing_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				if (RECURRING_FEATURE == "on") {
					$itemspaid_id[] = "l:".$id.":".$renewal_cycle;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"listing:$id:$renewal_cycle\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
					if ($payment_tax_status == "on") $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"".$payment_tax_value."\" />";
					else $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"0\" />";
				}

				$itemCount++;

			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {

				$renewal_cycle = ($_SESSION["order_renewal_period_event_{$id}"] ? $_SESSION["order_renewal_period_event_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				if (RECURRING_FEATURE == "on") {
					$itemspaid_id[] = "e:".$id.":".$renewal_cycle;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"event:$id:$renewal_cycle\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
					if ($payment_tax_status == "on") $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"".$payment_tax_value."\" />";
					else $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"0\" />";
				}

				$itemCount++;

			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {

				if ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) {
					$block_bannerbyimpression = true;
				}

				$renewal_cycle = ($_SESSION["order_renewal_period_banner_{$id}"] ? $_SESSION["order_renewal_period_banner_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				if (RECURRING_FEATURE == "on") {
					$itemspaid_id[] = "b:".$id.":".$renewal_cycle;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["caption"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"banner:$id:$renewal_cycle\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
					if ($payment_tax_status == "on") $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"".$payment_tax_value."\" />";
					else $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"0\" />";
				}

				$itemCount++;

			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {

				$renewal_cycle = ($_SESSION["order_renewal_period_classified_{$id}"] ? $_SESSION["order_renewal_period_classified_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				if (RECURRING_FEATURE == "on") {
					$itemspaid_id[] = "c:".$id.":".$renewal_cycle;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"classified:$id:$renewal_cycle\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
					if ($payment_tax_status == "on") $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"".$payment_tax_value."\" />";
					else $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"0\" />";
				}

				$itemCount++;

			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {

				$renewal_cycle = ($_SESSION["order_renewal_period_article_{$id}"] ? $_SESSION["order_renewal_period_article_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				if (RECURRING_FEATURE == "on") {
					$itemspaid_id[] = "a:".$id.":".$renewal_cycle;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"article:$id:$renewal_cycle\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
					if ($payment_tax_status == "on") $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"".$payment_tax_value."\" />";
					else $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"0\" />";
				}

				$itemCount++;

			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {

				$block_custominvoice = true;

				if (RECURRING_FEATURE == "on") {
					$itemspaid_id[] = "i:".$id;
				} else {
					$customInvoiceTitle = system_showTruncatedText($info["title"], 25);
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$customInvoiceTitle."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"custominvoice:$id\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["subtotal"]."\" />";
					if ($payment_tax_status == "on") $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"".$payment_tax_value."\" />";
					else $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"0\" />";
				}

				$itemCount++;

			}

			if ($bill_info["package"]) {

				$renewal_cycle = $_SESSION["order_renewal_period"];
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				if (RECURRING_FEATURE == "on") {
					$itemspaid_id[] = "p:".$bill_info["package"]["id"].":".$renewal_cycle;
				} else {
					$packageId = $bill_info["package"]["id"];
					$packageTitle = system_showTruncatedText($bill_info["package"]["title"], 25);
					$packageVal = $bill_info["package"]["value"];
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$packageTitle."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"package:$packageId:$renewal_cycle\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$packageVal."\" />";
					if ($payment_tax_status == "on") $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"".$payment_tax_value."\" />";
					else $cart_items .= "<input type=\"hidden\" name=\"tax_rate_".$itemCount."\" value=\"0\" />";
				}

				$itemCount++;
			}

			$stoppayment = false;

			if (RECURRING_FEATURE == "on") {
				$itemspaid_string = implode("|", $itemspaid_id);
				if (string_strlen($itemspaid_string) > 200) {
					echo "<p class=\"alert alert-warning\">Too many items to pay, the payment gateway does not allow. Please pay less items per time!</p>";
					$stoppayment = true;
				} elseif (count($itemspaid_id) > 1) {
					echo "<p class=\"alert alert-warning\">Please select only one item to proceed with your subscription.</p>";
					$stoppayment = true;
				}
			}

			if (!$stoppayment) {

				$contactObj = new Contact(sess_getAccountIdFromSession());
				$amount = str_replace(",", ".", $bill_info["total_bill"]);
				$subtotal = $amount;
				if ($payment_tax_status == "on") {
					$amount = payment_calculateTax($amount, $payment_tax_value);
				}
				$paypal_return = DEFAULT_URL."/".MEMBERS_ALIAS."/".$payment_process."/processpayment.php?payment_method=".$payment_method."";
				$paypal_cancel_return = DEFAULT_URL."/".MEMBERS_ALIAS."/".$payment_process."/processpayment.php?payment_method=".$payment_method."&cancel=true";
				$paypal_notify_url = DEFAULT_URL."/".MEMBERS_ALIAS."/billing/receipt.php";
				$paypal_account_id = sess_getAccountIdFromSession();
				$paypal_first_name = $contactObj->getString("first_name");
				$paypal_last_name = $contactObj->getString("last_name");
				$paypal_email = $contactObj->getString("email");
				$paypal_address = $contactObj->getString("address");
				$paypal_city = $contactObj->getString("city");
				$paypal_state = $contactObj->getString("state");
				$paypal_zip = $contactObj->getString("zip");
				$phone = str_replace(".", "", $contactObj->getString("phone"));
				$phone = str_replace("-", "", $phone);
				$phone = str_replace(" ", "", $phone);
				$paypal_night_phone_a = string_substr($phone, 0, 3);
				$paypal_night_phone_b = string_substr($phone, 3, 3);
				$paypal_night_phone_c = string_substr($phone, 6);

				?>

				<script type="text/javascript">
					<!--
					function submitOrder() {
						document.getElementById("paypalbutton").disabled = true;
						document.paypalform.submit();
					}
					//-->
				</script>

				<form name="paypalform" target="_self" action="https://<?=PAYPAL_URL?><?=PAYPAL_URL_FOLDER?>" method="post">

					<div style="display: none;">

						<input type="hidden" name="cmd" value="_ext-enter" />

						<? if (RECURRING_FEATURE == "on") { ?>
							<input type="hidden" name="redirect_cmd" value="_xclick-subscriptions" />
						<? } else { ?>
							<input type="hidden" name="redirect_cmd" value="_cart" />
							<input type="hidden" name="upload"       value="1" />
						<? } ?>

						<input type="hidden" name="business"      value="<?=PAYPAL_ACCOUNT?>" />
						<input type="hidden" name="no_note"       value="1" />
						<input type="hidden" name="no_shipping"   value="1" />
						<input type="hidden" name="currency_code" value="<?=PAYPAL_CURRENCY?>" />
						<input type="hidden" name="lc"            value="<?=PAYPAL_LC?>" />
						<input type="hidden" name="cbt"           value="Finish" />
						<input type="hidden" name="rm"            value="2" />
						<input type="hidden" name="return"        value="<?=$paypal_return?>" />
						<input type="hidden" name="cancel_return" value="<?=$paypal_cancel_return?>" />
						<input type="hidden" name="notify_url"    value="<?=$paypal_notify_url?>" />
						<input type="hidden" name="page_style"    value="PayPal" />
						<? if ($payment_tax_status == "on") { ?>
							<input type="hidden" name="custom"	  value="account_id:<?=$paypal_account_id?>::ip:<?=$_SERVER["REMOTE_ADDR"]?>::tax:<?=payment_calculateTax($subtotal, $payment_tax_value, true, false);?>::domain_id:<?=SELECTED_DOMAIN_ID;?>::package_id:<?=$package_id?>::renewal:<?=$_SESSION["order_renewal_period"]?>" />
						<? } else { ?>
							<input type="hidden" name="custom"    value="account_id:<?=$paypal_account_id?>::ip:<?=$_SERVER["REMOTE_ADDR"]?>::domain_id:<?=SELECTED_DOMAIN_ID;?>::package_id:<?=$package_id?>::renewal:<?=$_SESSION["order_renewal_period"]?>" />
						<? } ?>

						<? if (RECURRING_FEATURE == "on") { ?>
							<input type="hidden" name="a3"  value="<?=$amount?>" />
							<input type="hidden" name="p3"  value="1" />
							<input type="hidden" name="t3"  value="<?=$renewal_cycle?>" />
							<input type="hidden" name="src" value="1" />
							<input type="hidden" name="sra" value="1" />
							<input type="hidden" name="item_name" value="<?=EDIRECTORY_TITLE?> Subscription (Recurring)" />
						<? } ?>

						<?
						if (RECURRING_FEATURE == "on") {
							if ($itemspaid_id) {
								echo "<input type=\"hidden\" name=\"on0\" value=\"itemsPaid\" />";
								echo "<input type=\"hidden\" name=\"os0\" value=\"".$itemspaid_string."\" />";
							}
						} else {
							echo $cart_items;
						}
						?>

						<input type="hidden" name="first_name" value="<?=$paypal_first_name?>" />
						<input type="hidden" name="last_name"  value="<?=$paypal_last_name?>" />
						<input type="hidden" name="email"      value="<?=$paypal_email?>" />
						<input type="hidden" name="address1"   value="<?=$paypal_address?>" />
						<input type="hidden" name="city"       value="<?=$paypal_city?>" />
						<input type="hidden" name="state"      value="<?=$paypal_state?>" />
						<input type="hidden" name="zip"        value="<?=$paypal_zip?>" />

						<input type="hidden" name="night_phone_a" value="<?=$paypal_night_phone_a?>" />
						<input type="hidden" name="night_phone_b" value="<?=$paypal_night_phone_b?>" />
						<input type="hidden" name="night_phone_c" value="<?=$paypal_night_phone_c?>" />

					</div>

					<? if ($payment_process == "signup") {

                        $buttonGateway = "<button class=\"btn btn-success btn-lg\" type=\"button\" id=\"paypalbutton\" onclick=\"submitOrder();\">".system_highlightWords(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))."</button>";

                    } else { ?>
						<p class="row text-center">
							<button class="btn btn-success" type="button" id="paypalbutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_PAYPAL);?></button>
						</p>
					<? } ?>

				</form>

				<?

			}

		}

	}

?>
