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
	# * FILE: /includes/forms/form_billing_stripe.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_stripe.inc.php");

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);

	if ( STRIPEPAYMENT_FEATURE == "on" )
    {

        if ( !STRIPE_APIKEY )
        {
            echo "<p class=\"errorMessage\">".system_showText( LANG_GATEWAY_NO_AVAILABLE )." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/help.php\" class=\"billing-contact\">".system_showText( LANG_LABEL_ADMINISTRATOR )."</a>.</p>";
        }
        else
        {

            if ( $bill_info["listings"] )
            {
                foreach ( $bill_info["listings"] as $id => $info )
                {
                    $metadaDataItems .= system_showText(LANG_LISTING_FEATURE_NAME)."\nTitle: {$info["title"]}\nID: $id\nLevel: {$info["level"]}\n";
                    $cart_items .= "
					<input type=\"hidden\" name=\"listing_extracategory[]\" value=\"".$info["extra_category_amount"]."\">
					<input type=\"hidden\" name=\"listing_id[]\" value=\"$id\">
					<input type=\"hidden\" name=\"listing_price[]\" value=\"".$info["total_fee"]."\">";
                }
            }

            if ( $bill_info["events"] )
            {
                foreach ( $bill_info["events"] as $id => $info )
                {
                    $metadaDataItems .= system_showText(LANG_EVENT_FEATURE_NAME)."\nTitle: {$info["title"]}\nID: $id\nLevel: {$info["level"]}\n";
                    $cart_items .= "
					<input type=\"hidden\" name=\"event_id[]\" value=\"$id\">
					<input type=\"hidden\" name=\"event_price[]\" value=\"".$info["total_fee"]."\">";
                }
            }

            if ( $bill_info["banners"] )
            {
                foreach ( $bill_info["banners"] as $id => $info )
                {
                    $metadaDataItems .= system_showText(LANG_BANNER_FEATURE_NAME)."\nTitle: {$info["caption"]}\nID: $id\nLevel: {$info["level"]}\n";
                    $cart_items .= "
					<input type=\"hidden\" name=\"banner_id[]\" value=\"$id\">
					<input type=\"hidden\" name=\"banner_price[]\" value=\"".$info["total_fee"]."\">";
                }
            }

            if ( $bill_info["classifieds"] )
            {
                foreach ( $bill_info["classifieds"] as $id => $info )
                {
                    $metadaDataItems .= system_showText(LANG_CLASSIFIED_FEATURE_NAME)."\nTitle: {$info["title"]}\nID: $id\nLevel: {$info["level"]}\n";
                    $cart_items .= "
					<input type=\"hidden\" name=\"classified_id[]\" value=\"$id\">
					<input type=\"hidden\" name=\"classified_price[]\" value=\"".$info["total_fee"]."\">";
                }
            }

            if ( $bill_info["articles"] )
            {
                foreach ( $bill_info["articles"] as $id => $info )
                {
                    $metadaDataItems .= system_showText(LANG_ARTICLE_FEATURE_NAME)."\nTitle: {$info["title"]}\nID: $id\nLevel: {$info["level"]}\n";
                    $cart_items .= "
					<input type=\"hidden\" name=\"article_id[]\" value=\"$id\">
					<input type=\"hidden\" name=\"article_price[]\" value=\"".$info["total_fee"]."\">";
                }
            }

            if ( $bill_info["custominvoices"] )
            {
                foreach ( $bill_info["custominvoices"] as $id => $info )
                {
                    $customInvoiceTitle = system_showTruncatedText( $info["title"], 25 );
                    $metadaDataItems .= system_showText(LANG_CUSTOM_INVOICE)." $customInvoiceTitle";
                    $cart_items .= "
					<input type=\"hidden\" name=\"custominvoice_id[]\" value=\"$id\">
					<input type=\"hidden\" name=\"custominvoice_price[]\" value=\"".$info["subtotal"]."\">";
                }
            }

            $stripe_amount      = str_replace( ",", ".", $bill_info["total_bill"] );
            $contactObj         = new Contact( sess_getAccountIdFromSession() );
            $customer_email     = $contactObj->getString( "email" );
            $customer_first_name = $contactObj->getString( "first_name" );
            $customer_last_name  = $contactObj->getString( "last_name" );

            $stripe_subtotal   = $stripe_amount;
            if ( $payment_tax_status == "on" )
            {
                $stripe_tax    = $payment_tax_value;
                $stripe_amount = payment_calculateTax( $stripe_subtotal, $payment_tax_value );
                $taxAmount     = payment_calculateTax( $stripe_subtotal, $payment_tax_value, true, false );
            }
            else
            {
                $stripe_tax = 0;
            }
?>

			<script>
				<!--
				function submitOrder() {
					document.getElementById("stripebutton").disabled = true;
				}
				//-->
			</script>

			<form name="stripeform" action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=$payment_process?>/processpayment.php?payment_method=<?=$payment_method?>" method="post" onsubmit="submitOrder();">

                <input type="hidden" name="stripe_tax" value="<?=$stripe_tax?>">
                <input type="hidden" name="stripe_subtotal" value="<?=$stripe_subtotal?>">
                <input type="hidden" name="amount" value="<?=$stripe_amount?>">
                <input type="hidden" name="stripe_package_id" value="<?=$package_id?>">
                <input type="hidden" name="customer_email" value="<?=$customer_email?>">
                <input type="hidden" name="customer_first_name" value="<?=$customer_first_name?>">
                <input type="hidden" name="customer_last_name" value="<?=$customer_last_name?>">
                <input type="hidden" name="statement_descriptor" value="<?=$statement_descriptor?>">
                <input type="hidden" name="metadata[items]" value="<?=system_showTruncatedText($metadaDataItems, 500, "")?>">
                <input type="hidden" name="metadata[tax]" value="<?=CURRENCY_SYMBOL.$taxAmount?>">
                <input type="hidden" name="metadata[subtotal]" value="<?=CURRENCY_SYMBOL.$stripe_subtotal?>">

                <?=$cart_items?>

                <input type="hidden" name="pay" value="1">

				<div class="col-sm-8 col-sm-offset-2 well center">
					<h3>
						<?=system_showText(LANG_LABEL_CREDIT_CARD_INFORMATION);?>
					</h3>

					<div class="row">

						<div class="form-group col-sm-6">
							<input class="form-control" type="number" placeholder="<?=system_showText(LANG_LABEL_CARD_NUMBER);?>" name="cardnumber" value="" required>
						</div>

                    </div>

                    <div class="row">

						<div class="form-group col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" type="number" placeholder="CVC" name="cvv" value="" required>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="month" required>
                                        <option value="">MM</option>
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
                                <div class="col-sm-3">
                                    <select class="form-control" name="year">
                                        <option value="">YY</option>
                                        <?
                                        for ($i = date("Y"); $i < date("Y") + 15; $i++) {
                                            echo "<option value=\"".$i."\">".$i."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
					    </div>
					</div>

				</div>

                <div class="col-sm-8 col-sm-offset-2 well">
                    <h3><?=system_showText(LANG_LABEL_CUSTOMER_INFO);?></h3>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <input class="form-control" type="text" placeholder="<?=system_showText(LANG_LABEL_CARDHOLDER_NAME);?>" name="name" value="<?=$name?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" placeholder="<?=system_showText(LANG_LABEL_ADDRESS);?>" name="address1" value="<?=$address1?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" placeholder="<?=system_showText(LANG_LABEL_ADDRESS2);?>" name="address2" value="<?=$address2?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" placeholder="<?=system_showText(LANG_LABEL_COUNTRY)?>" name="country" value="<?=$country?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" placeholder="<?=system_showText(LANG_LABEL_STATE)?>" name="state" value="<?=$state?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" placeholder="<?=system_showText(LANG_LABEL_CITY)?>" name="city" value="<?=$city?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" placeholder="<?=string_ucwords(system_showText(LANG_LABEL_ZIP));?>" name="zip" value="<?=$zip?>">
                        </div>
                    </div>
                </div>

                <div class="col-sm-5 col-sm-offset-5">
                    <button class="btn btn-success btn-lg" type="submit" value="Submit" id="stripebutton"><?=system_showText(($payment_process == "signup" ? LANG_LABEL_PLACE_ORDER_CONTINUE : LANG_BUTTON_PAY_BY_CREDIT_CARD));?></button>
                </div>

			</form>
			<?
		}
	}