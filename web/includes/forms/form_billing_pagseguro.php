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
	# * FILE: /includes/forms/form_billing_pagseguro.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_pagseguro.inc.php");

    setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
    customtext_get("payment_tax_label", $payment_tax_label);

	if (PAGSEGUROPAYMENT_FEATURE == "on") {

        $str_params = "";
        $arrayParams = Array();
        $arrayParams[] = sess_getAccountIdFromSession(); //account_id
        $arrayParams[] = SELECTED_DOMAIN_ID; //domain id
        $arrayParams[] = $package_id; //package id
        $arrayParams[] = $_SERVER["REMOTE_ADDR"]; //user ip
        $arrayParams[] = PAYMENT_CURRENCY; //currency
        $arrayParams[] = str_replace(",", ".", $bill_info["total_bill"]); //subtotal
        $arrayParams[] = ($payment_tax_status == "on" ? $payment_tax_value : 0); //tax value
        $str_params = implode("||", $arrayParams);

        $paymentRequest = new PagSeguroPaymentRequest();

        $stop = false;
        if ($bill_info["listings"]) {
            foreach ($bill_info["listings"] as $id => $info) {

                $renewal_cycle = ($_SESSION["order_renewal_period_listing_{$id}"] ? $_SESSION["order_renewal_period_listing_{$id}"] : $_SESSION["order_renewal_period"]);
                $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

                if ($info["title"] && $info["total_fee"]) {
                    $paymentRequest->addItem(
                        Array(
                            "id" => "listing:" . $id . ":" . $renewal_cycle,
                            "description" => $info["title"],
                            "quantity" => 1,
                            "amount" => $info["total_fee"]
                        )
                    );
                } else {
                    $stop = true;
                    break;
                }
            }
        }

        if ($bill_info["events"]) {
            foreach ($bill_info["events"] as $id => $info) {

                $renewal_cycle = ($_SESSION["order_renewal_period_event_{$id}"] ? $_SESSION["order_renewal_period_event_{$id}"] : $_SESSION["order_renewal_period"]);
                $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

                if ($info["title"] && $info["total_fee"]) {
                    $paymentRequest->addItem(
                        Array(
                            "id" => "event:" . $id . ":" . $renewal_cycle,
                            "description" => $info["title"],
                            "quantity" => 1,
                            "amount" => $info["total_fee"]
                        )
                    );
                } else {
                    $stop = true;
                    break;
                }
            }
        }

        if ($bill_info["banners"]) {
            foreach ($bill_info["banners"] as $id => $info) {

                $renewal_cycle = ($_SESSION["order_renewal_period_banner_{$id}"] ? $_SESSION["order_renewal_period_banner_{$id}"] : $_SESSION["order_renewal_period"]);
                $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

                if ($info["caption"] && $info["total_fee"]) {
                    $paymentRequest->addItem(
                        Array(
                            "id" => "banner:" . $id . ":" . $renewal_cycle,
                            "description" => $info["caption"],
                            "quantity" => 1,
                            "amount" => $info["total_fee"]
                        )
                    );
                } else {
                    $stop = true;
                    break;
                }
            }
        }

        if ($bill_info["classifieds"]) {
            foreach ($bill_info["classifieds"] as $id => $info) {

                $renewal_cycle = ($_SESSION["order_renewal_period_classified_{$id}"] ? $_SESSION["order_renewal_period_classified_{$id}"] : $_SESSION["order_renewal_period"]);
                $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

                if ($info["title"] && $info["total_fee"]) {
                    $paymentRequest->addItem(
                        Array(
                            "id" => "classified:" . $id . ":" . $renewal_cycle,
                            "description" => $info["title"],
                            "quantity" => 1,
                            "amount" => $info["total_fee"]
                        )
                    );
                } else {
                    $stop = true;
                    break;
                }
            }
        }

        if ($bill_info["articles"]) {
            foreach ($bill_info["articles"] as $id => $info) {

                $renewal_cycle = ($_SESSION["order_renewal_period_article_{$id}"] ? $_SESSION["order_renewal_period_article_{$id}"] : $_SESSION["order_renewal_period"]);
                $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

                if ($info["title"] && $info["total_fee"]) {
                    $paymentRequest->addItem(
                        Array(
                            "id" => "article:" . $id . ":" . $renewal_cycle,
                            "description" => $info["title"],
                            "quantity" => 1,
                            "amount" => $info["total_fee"]
                        )
                    );
                } else {
                    $stop = true;
                    break;
                }
            }
        }

        if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {
            $customInvoiceTitle = $info["title"];
            if (strlen($customInvoiceTitle) > 25) $customInvoiceTitle = substr($info["title"], 0, 22)."...";

            if ($customInvoiceTitle && $info["subtotal"]){
                $paymentRequest->addItem(
                    Array(
                        "id" => "custominvoice:".$id,
                        "description" => $customInvoiceTitle,
                        "quantity" => 1,
                        "amount" => $info["subtotal"]
                    )
                );
            } else {
                $stop = true;
                break;
            }
        }

        if ($bill_info["package"]) {
            $packageId = $bill_info["package"]["id"];
            $packageTitle = system_showTruncatedText($bill_info["package"]["title"], 25);
            $packageVal = $bill_info["package"]["value"];

            $renewal_cycle = $_SESSION["order_renewal_period"];
            $renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

            if ($packageTitle && $packageVal) {
                $paymentRequest->addItem(
                    Array(
                        "id" => "package:".$id . ":" . $renewal_cycle,
                        "description" => $packageTitle,
                        "quantity" => 1,
                        "amount" => $packageVal
                    )
                );
            }
        }

        $pagseguro_subtotal = str_replace(",", ".", $bill_info["total_bill"]);

        $tax_amount = payment_calculateTax($pagseguro_subtotal, $payment_tax_value, true, false);
        if ($payment_tax_status == "on") {
            if ($tax_amount){
                $paymentRequest->setExtraAmount($tax_amount);
            } else {
                $stop = true;
            }
        }

        $contactObj = new Contact(sess_getAccountIdFromSession());
        $pagseguro_first_name = trim($contactObj->getString("first_name"))." ".trim($contactObj->getString("last_name"));
        $pagseguro_email = $contactObj->getString("email");
        $pagseguro_address = $contactObj->getString("address");
        $pagseguro_address2 = $contactObj->getString("address2");
        $pagseguro_city = $contactObj->getString("city");
        $pagseguro_state = $contactObj->getString("state");
        $pagseguro_country = $contactObj->getString("country");
        $pagseguro_zip = $contactObj->getString("zip");

        $paymentRequest->setSender(
            $pagseguro_first_name,
            $pagseguro_email
        );

        $r = "/^([0-9]{2})\.?([0-9]{3})-?([0-9]{3})$/"; //Validate ZIP to match Brazil postal code format

        if (!preg_match ($r, $pagseguro_zip) ) {
            $pagseguro_zip = "";
        }

        $paymentRequest->setShippingAddress(
            $pagseguro_zip,
            $pagseguro_address,
            "",
            $pagseguro_address2,
            "",
            $pagseguro_city,
            "",
            $pagseguro_country
        );

        if (PAYMENT_CURRENCY == "BRL"){
            $paymentRequest->setCurrency(PAYMENT_CURRENCY);
        } else {
            $stop = true;
        }

        if (!$stop){
            $paymentRequest->setShippingType(3);
            $paymentRequest->setReference($str_params);
            $paymentRequest->setRedirectURL(DEFAULT_URL."/".MEMBERS_ALIAS."/".$payment_process."/processpayment.php?payment_method=pagseguro");

            $credentials = new PagSeguroAccountCredentials(
                PAGSEGURO_EMAIL,
                PAGSEGURO_TOKEN
            );

            $url = $paymentRequest->register($credentials);
        }
	}

    if (!$stop) {

        if ($payment_process == "signup") {
            $buttonGateway = "<input type=\"image\" src=\"../../assets/images/structure/pagseguro_button.gif\" name=\"submit\" alt=\"Pague com o PagSeguro - é rápido, grátis e seguro!\" style=\"border-style:none; margin:0 auto;\" onclick=\"window.location='$url'\" />";

        } else { ?>
            <p class="row text-center">
                <input type="image" src="../../assets/images/structure/pagseguro_button.gif" name="submit" alt="Pague com o PagSeguro - é rápido, grátis e seguro!" style="border-style:none; margin:0 auto;" onclick="window.location='<?=$url?>'" />
            </p>
        <? }

    } else { ?>
        <p class="alert alert-info"><?=system_showText(LANG_MSG_PAYMENT_INVALID_PARAMS).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN)?></p>
    <? } ?>
