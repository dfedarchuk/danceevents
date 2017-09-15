<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */
?>
<div class="col-sm-12">

    <?php
        if( checkActiveTab( "gateways" ) )
        {
            MessageHandler::render();
        }

        /* This javascript will modify the sub options of a select deppending on what the user has chosen.
         * I.e chosing Days will change the value subselect options to span from 1 to 30 */
        $onReadyJS = '
            $(".hiddenPaneRevealer").change( function(){
                enableGateway( $(this).data("hiddenpanel"), this );
            });
               ';
        JavaScriptHandler::registerOnReady($onReadyJS);

        /* This javascript function toggles submenu visibility for each gateway */
        $looseJS = '

        function enableGateway(gtw, obj){
            var wrapper = null;
            switch(gtw) {
                case "stripe"             : wrapper = $("#wrap-stripe"); break;
                case "paypal"             : wrapper = $("#wrap-paypal"); break;
                case "paypalapi"          : wrapper = $("#wrap-paypalapi"); break;
                case "pagseguro"          : wrapper = $("#wrap-pagseguro"); break;
                case "twocheckout"        : wrapper = $("#wrap-twocheckout"); break;
                case "authorize"          : wrapper = $("#wrap-authorize"); break;
                case "payflow"            : wrapper = $("#wrap-payflow"); break;
                case "worldpay"           : wrapper = $("#wrap-worldpay"); break;
            }

            if (obj.checked ) {
                wrapper.removeClass("hidden");
            } else {
                wrapper.addClass("hidden");
            }
        };
            ';
        JavaScriptHandler::registerLoose($looseJS);
    ?>

	<div class="panel panel-default">
		<div class="panel-heading"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_HEADING);?></div>

		<div class="panel-body">

			<?// ------------ Enable Recurring ------------- ?>
			<div class="row">
				<div class="form-group col-sm-12">
					<div class="checkbox">
						<label for='recurringCheckbox'>
							<br>
							<input id='recurringCheckbox' type="checkbox" name="gateway[recurring]" data-hiddenpanel="recurring" class="hiddenPaneRevealer" <?= ($gatewayInfo['recurring'] == "on" ? 'checked="checked"' : "" )?>>
							<?=system_showText(LANG_SITEMGR_ENABLE);?> <?=system_showText(LANG_SITEMGR_SETTINGS_RECURRING)?>
							<p class="help-block small"><?=system_showText(LANG_SITEMGR_SETTINGS_RECURRING_TIP)?></p>
						</label>

					</div>
				</div>
			</div>

			<hr class="small">

			<?// ------------ Stripe Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
						<label for='stripeCheckbox'>
							<input id='stripeCheckbox' type="checkbox" name="gateway[stripe][payment_stripeStatus]" data-hiddenpanel="stripe"  class="hiddenPaneRevealer" <?= ($gatewayInfo['stripe']['payment_stripeStatus'] == "on" ? 'checked="checked"' : "" )?>>
							<?=system_showText(LANG_SITEMGR_ENABLE);?> Stripe
						</label>
					</div>
				</div>
				<div id="wrap-stripe" class="<?= ($gatewayInfo['stripe']['payment_stripeStatus'] == "on" ? '' : "hidden" )?>">
					<div class="form-group col-sm-3">
						<label for="stripeAPIKey"><?=system_showText(LANG_SITEMGR_SETTINGS_APIKEY)?></label>
						<input id="stripeAPIKey" type="text" class="form-control"  name="gateway[stripe][stripe_apikey]" value="<?= $gatewayInfo['stripe']['stripe_apikey'] ?>">
					</div>
					<div class="form-group col-sm-9 col-sm-offset-3">
						<p class="alert alert-warning"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_STRIPE_TIP)?></p>
					</div>
				</div>
			</div>

			<hr class="small">

			<?// ------------ Paypal Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
						<label for='paypalCheckbox'>
							<input id='paypalCheckbox' type="checkbox" name="gateway[paypal][payment_paypalStatus]" data-hiddenpanel="paypal"  class="hiddenPaneRevealer" <?= ($gatewayInfo['paypal']['payment_paypalStatus'] == "on" ? 'checked="checked"' : "" )?>>
                            <?=system_showText(LANG_SITEMGR_ENABLE);?> Paypal Standard
						</label>
					</div>
				</div>
				<div id="wrap-paypal" class="<?= ($gatewayInfo['paypal']['payment_paypalStatus'] == "on" ? '' : "hidden" )?>">
					<div class="form-group col-sm-3">
						<label for="paypalAccount"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCOUNT)?></label>
						<input id="paypalAccount" type="text" class="form-control"  name="gateway[paypal][paypal_account]" value="<?= $gatewayInfo['paypal']['paypal_account'] ?>">
					</div>
				</div>
			</div>

			<hr class="small">

			<?// ------------ Paypal API Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
						<label for='paypalAPICheckbox'>
							<input id='paypalAPICheckbox' type="checkbox" data-hiddenpanel="paypalapi"  class="hiddenPaneRevealer" name="gateway[paypalAPI][payment_paypalapiStatus]" <?= ($gatewayInfo['paypalAPI']['payment_paypalapiStatus'] == "on" ? 'checked="checked"' : "" )?> >
							<?=system_showText(LANG_SITEMGR_ENABLE);?> Paypal Express Checkout
						</label>
					</div>
				</div>
				<div id="wrap-paypalapi" class="<?= ($gatewayInfo['paypalAPI']['payment_paypalapiStatus'] == "on" ? '' : "hidden" )?>">
					<div class="form-group col-sm-3">
						<label for="paypalAPIUsername"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_USERNAME)?></label>
						<input id="paypalAPIUsername" class="form-control" type="text"  name="gateway[paypalAPI][paypalapi_username]" value="<?= $gatewayInfo['paypalAPI']['paypalapi_username'] ?>">
					</div>
					<div class="form-group col-sm-2">
						<label for="paypalAPIPassword"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_PASSWORD)?></label>
						<input id='paypalAPIPassword' class="form-control" type="text" name="gateway[paypalAPI][paypalapi_password]" value="<?= $gatewayInfo['paypalAPI']['paypalapi_password'] ?>">
					</div>
					<div class="form-group col-sm-2">
						<label for="paypalAPISignature"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_SIGNATURE)?></label>
						<input id='paypalAPISignature' class="form-control" type="text" name="gateway[paypalAPI][paypalapi_signature]" value="<?= $gatewayInfo['paypalAPI']['paypalapi_signature'] ?>">
					</div>
				</div>
			</div>

			<hr class="small">

			<?// ------------ Authorize.Net Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
						<label for='authorizeCheckbox'>
							<input id='authorizeCheckbox' type="checkbox" data-hiddenpanel="authorize"  class="hiddenPaneRevealer" name="gateway[authorize][payment_authorizeStatus]" <?= ($gatewayInfo['authorize']['payment_authorizeStatus'] == "on" ? 'checked="checked"' : "" )?>>
							<?=system_showText(LANG_SITEMGR_ENABLE);?> Authorize.Net
						</label>
					</div>
				</div>
				<div id="wrap-authorize" class="<?= ($gatewayInfo['authorize']['payment_authorizeStatus'] == "on" ? '' : "hidden" )?>">
                    <div class="form-group col-sm-3">
                        <label for="authorizeLogin"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_LOGIN)?></label>
                        <input id='authorizeLogin' class="form-control" type="text"  name="gateway[authorize][authorize_login]" value="<?= $gatewayInfo['authorize']['authorize_login'] ?>">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="authorizeKey"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_TRANSACTIONKEY)?></label>
                        <input id='authorizeKey' class="form-control" type="text"  name="gateway[authorize][authorize_txnkey]" value="<?= $gatewayInfo['authorize']['authorize_txnkey'] ?>">
                    </div>
				</div><!-- wrapper-->
			</div>

			<hr class="small">
			
			<?// ------------ PagSeguro Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
                        <label for="pagseguroCheckbox">
							<input id='pagseguroCheckbox' type="checkbox" data-hiddenpanel="pagseguro"  class="hiddenPaneRevealer" name="gateway[pagseguro][payment_pagseguroStatus]" <?= ($gatewayInfo['pagseguro']['payment_pagseguroStatus'] == "on" ? 'checked="checked"' : "" )?> >
							<?=system_showText(LANG_SITEMGR_ENABLE);?> PagSeguro
						</label>
					</div>
				</div>
				<div id="wrap-pagseguro" class="<?= ($gatewayInfo['pagseguro']['payment_pagseguroStatus'] == "on" ? '' : "hidden" )?>">
                    <div class="form-group col-sm-3">
                        <label for="pagseguroUsername"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCOUNT)?></label>
                        <input id="pagseguroUsername" class="form-control" type="text"  name="gateway[pagseguro][pagseguro_email]" value="<?= $gatewayInfo['pagseguro']['pagseguro_email'] ?>">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="pagseguroPassword"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAGSEGUROTOKEN)?></label>
                        <input id='pagseguroPassword' class="form-control" type="text" name="gateway[pagseguro][pagseguro_token]" value="<?= $gatewayInfo['pagseguro']['pagseguro_token'] ?>">
                    </div>
				</div>
			</div>

			<hr class="small">
			
			<?// ------------ 2CheckOut Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
						<label for='twocheckoutCheckbox'>
							<input id='twocheckoutCheckbox' type="checkbox" data-hiddenpanel="twocheckout"  class="hiddenPaneRevealer" name="gateway[twoCheckout][payment_twocheckoutStatus]" <?= ($gatewayInfo['twoCheckout']['payment_twocheckoutStatus'] == "on" ? 'checked="checked"' : "" )?>>
							<?=system_showText(LANG_SITEMGR_ENABLE);?> 2CheckOut
						</label>
					</div>
				</div>
				<div id="wrap-twocheckout" class="<?= ($gatewayInfo['twoCheckout']['payment_twocheckoutStatus'] == "on" ? '' : "hidden" )?>">
                    <div class="form-group col-sm-3">
                        <label for="twocheckoutUsername"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCOUNT)?></label>
                        <input id='twocheckoutUsername' class="form-control" type="text"  name="gateway[twoCheckout][twocheckout_login]" value="<?= $gatewayInfo['twoCheckout']['twocheckout_login'] ?>">
                    </div>
				</div>
			</div>

			<hr class="small">

			<?// ------------ PayFlow Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
						<label for='payflowCheckbox'>
							<input id='payflowCheckbox' type="checkbox" name="gateway[payflow][payment_payflowStatus]" data-hiddenpanel="payflow"  class="hiddenPaneRevealer" <?= ($gatewayInfo['payflow']['payment_payflowStatus'] == "on" ? 'checked="checked"' : "" )?>>
							<?=system_showText(LANG_SITEMGR_ENABLE);?> PayFlow Link
						</label>
					</div>
				</div>
				<div id="wrap-payflow" class="<?= ($gatewayInfo['payflow']['payment_payflowStatus'] == "on" ? '' : "hidden" )?>">
                    <div class="form-group col-sm-3">
                        <label for="payflowUsername"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_LOGIN)?></label>
                        <input id='payflowUsername' class="form-control" type="text"  name="gateway[payflow][payflow_login]" value="<?= $gatewayInfo['payflow']['payflow_login'] ?>">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="payflowPartner"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_PARTNER)?></label>
                        <input id='payflowPartner' class="form-control" type="text"  name="gateway[payflow][payflow_partner]" value="<?= $gatewayInfo['payflow']['payflow_partner'] ?>">
                    </div>
				</div>
			</div>

			<hr class="small">

			<?// ------------ Worldpay Gateway ------------- ?>
			<div class="row">
				<div class="form-group col-sm-3">
					<div class="checkbox">
						<label for='worldpayCheckbox'>
							<input id='worldpayCheckbox' type="checkbox" name="gateway[worldpay][payment_worldpayStatus]" data-hiddenpanel="worldpay"  class="hiddenPaneRevealer" <?= ($gatewayInfo['worldpay']['payment_worldpayStatus'] == "on" ? 'checked="checked"' : "" )?>>
							<?=system_showText(LANG_SITEMGR_ENABLE);?> WorldPay
						</label>
					</div>
				</div>
				<div id="wrap-worldpay" class="<?= ($gatewayInfo['worldpay']['payment_worldpayStatus'] == "on" ? '' : "hidden" )?>">
                    <div class="form-group col-sm-3">
                        <label for="worldpayUsername"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_INSTALATIONID)?></label>
                        <input id='worldpayUsername' class="form-control" type="text"  name="gateway[worldpay][worldpay_instid]"  value="<?= $gatewayInfo['worldpay']['worldpay_instid'] ?>">
                    </div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<button class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" type="submit" name="action" value="gateways"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
		</div>
	</div>

</div>