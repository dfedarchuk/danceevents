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
	# * FILE: /includes/forms/form_paymentmethod.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos($_SERVER["PHP_SELF"], "/claim") !== false) {
        $advertiseItem = "listing";
        $listLevelObj = new ListingLevel();
    }

    if ($advertiseItem) {

        switch ($advertiseItem) {
            case "listing":
                $pricingLevelObj = $listLevelObj;
                break;
            case "classified":
                $pricingLevelObj = $classiLevelObj;
                break;
            case "article":
                $pricingLevelObj = $articleLevelObj;
                break;
            case "event":
                $pricingLevelObj = $evLevelObj;
                break;
            case "banner":
                $pricingLevelObj = $banLevelObj;
                break;
        }

        $pricingInfo = payment_getPricing($advertiseItem, $pricingLevelObj, ($advertiseItem == "banner" ? $type : $level));
        if ($pricingInfo["monthly"] > 0 && $pricingInfo["yearly"] > 0) {
            ?>

            <div id="renewal_options">

                <div class="radio">
                    <label>
                        <input type="radio" class="renewal_radio" name="renewal_period" value="monthly"
                               checked><?= CURRENCY_SYMBOL . $pricingInfo["monthly"] . " / " . system_showText(LANG_MONTH) ?>
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" class="renewal_radio" name="renewal_period"
                               value="yearly"><?= CURRENCY_SYMBOL . $pricingInfo["yearly"] . " / " . system_showText(LANG_YEAR) ?>
                    </label>
                </div>

                <hr>

            </div>

        <?php } else { ?>

            <input type="hidden" id="renewal_radio" name="renewal_period" value="<?= $pricingInfo["renewal_period"] ?>">

            <?php

        }

    }
    $arrayGateways = array();

    if (STRIPEPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "stripe||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (AUTHORIZEPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "authorize||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (WORLDPAYPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "worldpay||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (TWOCHECKOUTPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "twocheckout||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (PAYFLOWPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "payflow||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (PAYPALAPIPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "paypalapi||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (PAYPALPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "paypal||".system_showText(LANG_LABEL_BY_PAYPAL);
    }
    
    if (PAGSEGUROPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "pagseguro||".system_showText(LANG_LABEL_BY_PAGSEGURO);
    }
    
    if (INVOICEPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "invoice||".system_showText(LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK);
    }
    
    $countGat = 0;

    if (is_array($arrayGateways) && $arrayGateways[0]) {

        foreach ($arrayGateways as $gateway) {

            $gatewayInfo = explode("||", $gateway); 
            $countGat++;
            echo "<div class=\"radio\"><label><input type=\"radio\" name=\"payment_method\" value=\"".$gatewayInfo[0]."\" id=\"radio".$countGat."\" ".($payment_method == $gatewayInfo[0] ? "checked=\"checked\"" : "")." />".$gatewayInfo[1]."</label></div>";

        }
    }