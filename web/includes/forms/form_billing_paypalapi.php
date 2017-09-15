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
	# * FILE: /includes/forms/form_billing_paypalapi.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_paypalapi.inc.php");

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);

	if ( PAYPALAPIPAYMENT_FEATURE == "on" )
    {

        if ( !PAYPALAPI_USERNAME || !PAYPALAPI_PASSWORD || !PAYPALAPI_SIGNATURE )
        {
            echo "<p class=\"errorMessage\">".system_showText( LANG_GATEWAY_NO_AVAILABLE )." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/help.php\" class=\"billing-contact\">".system_showText( LANG_LABEL_ADMINISTRATOR )."</a>.</p>";
        }
        else
        {

            if ( $bill_info["listings"] )
            {
                foreach ( $bill_info["listings"] as $id => $info )
                {
                    $cart_items .= "
					<input type=\"hidden\" name=\"listing_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"listing_price[]\" value=\"".$info["total_fee"]."\" />";
                }
            }

            if ( $bill_info["events"] )
            {
                foreach ( $bill_info["events"] as $id => $info )
                {
                    $cart_items .= "
					<input type=\"hidden\" name=\"event_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"event_price[]\" value=\"".$info["total_fee"]."\" />";
                }
            }

            if ( $bill_info["banners"] )
            {
                foreach ( $bill_info["banners"] as $id => $info )
                {
                    $cart_items .= "
					<input type=\"hidden\" name=\"banner_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"banner_price[]\" value=\"".$info["total_fee"]."\" />";
                }
            }

            if ( $bill_info["classifieds"] )
            {
                foreach ( $bill_info["classifieds"] as $id => $info )
                {
                    $cart_items .= "
					<input type=\"hidden\" name=\"classified_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"classified_price[]\" value=\"".$info["total_fee"]."\" />";
                }
            }

            if ( $bill_info["articles"] )
            {
                foreach ( $bill_info["articles"] as $id => $info )
                {
                    $cart_items .= "
					<input type=\"hidden\" name=\"article_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"article_price[]\" value=\"".$info["total_fee"]."\" />";
                }
            }

            if ( $bill_info["custominvoices"] )
            {
                foreach ( $bill_info["custominvoices"] as $id => $info )
                {
                    $customInvoiceTitle = system_showTruncatedText( $info["title"], 25 );
                    $cart_items .= "
					<input type=\"hidden\" name=\"custominvoice_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"custominvoice_price[]\" value=\"".$info["subtotal"]."\" />";
                }
            }

            $paypalapi_amount     = str_replace( ",", ".", $bill_info["total_bill"] );
            $contactObj           = new Contact( sess_getAccountIdFromSession() );
            $paypalapi_first_name = $contactObj->getString( "first_name" );
            $paypalapi_last_name  = $contactObj->getString( "last_name" );
?>

			<script type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("paypalapibutton").disabled = true;
					document.paypalapiform.submit();
				}
				//-->
			</script>

			<form name="paypalapiform" target="_self" action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=$payment_process?>/processpayment.php?payment_method=<?=$payment_method?>" method="post">

				<div style="display: none;">

                    <?
                        $paypalapi_subtotal   = $paypalapi_amount;
                        if ( $payment_tax_status == "on" )
                        {
                            $paypalapi_tax    = $payment_tax_value;
                            $paypalapi_amount = payment_calculateTax( $paypalapi_subtotal, $payment_tax_value );
                            $taxAmount        = payment_calculateTax( $paypalapi_subtotal, $payment_tax_value, true, false );
                        }
                        else
                        {
                            $paypalapi_tax = 0;
                        }
                    ?>

					<input type="hidden" name="paypalapi_tax" value="<?=$paypalapi_tax?>" />
					<input type="hidden" name="paypalapi_subtotal" value="<?=$paypalapi_subtotal?>" />
					<input type="hidden" name="amount" value="<?=$paypalapi_amount?>" />
					<input type="hidden" name="currency" value="<?=PAYPALAPI_CURRENCY?>" />
					<input type="hidden" name="paymentType" value="Sale" />
					<input type="hidden" name="paypalapi_package_id" value="<?=$package_id?>" />

					<?=$cart_items?>

					<input type="hidden" name="pay" value="1" />

				</div>

				<div class="col-sm-8 col-sm-offset-2 well">
					<h3>
						<?=system_showText(LANG_LABEL_BILLING_INFO);?>
					</h3>
					<div class="row">
						<div class="form-group col-sm-4">
							<label><?=system_showText(LANG_LABEL_CARD_TYPE);?>:</label>
                            <select class="form-control" name="creditCardType" class="payment-cardtype">
                                <option></option>
                                <option value="Visa">Visa</option>
                                <option value="MasterCard">MasterCard</option>
                                <option value="Discover">Discover</option>
                                <option value="Amex">American Express</option>
                            </select>
						</div>
						<div class="form-group col-sm-8">
							<label><?=system_showText(LANG_LABEL_CARD_NUMBER);?>:</label>
							<input class="form-control" type="text" name="creditCardNumber" value="" />
						</div>
						<div class="form-group col-sm-6">

							<label><?=system_showText(LANG_LABEL_CARD_EXPIRE_DATE);?>:</label>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="expdate_month" class="payment-datemonth">
                                            <option></option>
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="expdate_year" class="payment-dateyear">
                                            <option></option>
                                            <?
                                            for ($i=date("Y"); $i<date("Y")+10; $i++) {
                                                echo "<option value=\"".$i."\">".$i."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>
						</div>
                        <div class="form-group col-sm-6">
                            <label><?=system_showText(LANG_LABEL_CARD_VERIFICATION_NUMBER);?>:</label>
                            <input class="form-control" type="text" name="cvv2Number" value="" />
                        </div>
					</div>
					</div>
					<div class="col-sm-8 col-sm-offset-2 well">
						<h3><?=system_showText(LANG_LABEL_CUSTOMER_INFO);?></h3>
						<div class="row">
							<div class="form-group col-sm-6">
								<label><?=system_showText(LANG_LABEL_FIRST_NAME);?>:</label>
								<input class="form-control" type="text" name="firstName" value="<?=$paypalapi_first_name?>" />
							</div>
							<div class="form-group col-sm-6">
								<label><?=system_showText(LANG_LABEL_LAST_NAME);?>:</label>
								<input class="form-control" type="text" name="lastName" value="<?=$paypalapi_last_name?>" />
							</div>
                            <div class="form-group col-sm-12">
                                <label><?=system_showText(LANG_LABEL_ADDRESS);?>:</label>
                                <input class="form-control" type="text" name="address1" value="" />
                            </div>
							<div class="form-group col-sm-6">
								<label><?=system_showText(LANG_LABEL_COUNTRY)?>:</label>
								<select class="form-control" id="country" name="country">
									<option value="AU">Australia</option>
                                    <option value="BR">Brasil</option>
									<option value="CA">Canada</option>
									<option value="GB">United Kingdom</option>
									<option value="US" selected="selected">United States</option>
								</select>
							</div>
							<div class="form-group col-sm-6">
								<label><?=system_showText(LANG_LABEL_STATE)?> / <?=system_showText(LANG_LABEL_PROVINCE)?> :</label>
								<input class="form-control"  type="text" name="state" value="" />
							</div>
							<div class="form-group col-sm-6">
								<label><?=system_showText(LANG_LABEL_CITY)?>:</label>
								<input class="form-control"  type="text" name="city" value="" />
							</div>
							<div class="form-group col-sm-6">
								<label><?=string_ucwords(system_showText(LANG_LABEL_ZIP));?>:</label>
								<input class="form-control" type="text" name="zip" value="" />
							</div>
						</div>
					</div>
				</div>

				<?php
                    if ($payment_process == "signup")
                    {
                        $buttonGateway = "<button class=\"btn btn-success btn-lg\"  type=\"button\" id=\"paypalapibutton\" onclick=\"submitOrder();\">".system_highlightWords(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))."</button>";
                    }
                    else  { ?>
					<div class="row text-center">
						<button class="btn btn-success" type="button" id="paypalapibutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD);?></button>
					</div>
				<?  } ?>

			</form>
			<?
		}
	}
?>
