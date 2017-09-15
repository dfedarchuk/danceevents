<?php
	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /sponsors/signup/payment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/signup";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$itemCount = 0;

	$listingsToPay = db_getFromDB("listing", "account_id", $acctId, "", "title", "array", false, true);
	foreach ($listingsToPay as $listingToPay) {
		$listing_id[] = $listingToPay["id"];
		$itemCount++;
	}

	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
		$eventsToPay = db_getFromDB("event", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($eventsToPay as $eventToPay) {
			$event_id[] = $eventToPay["id"];
			$itemCount++;
		}
	}

	if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
		$bannersToPay = db_getFromDB("banner", "account_id", $acctId, "", "caption", "array", false, true);
		foreach ($bannersToPay as $bannerToPay) {
			$banner_id[] = $bannerToPay["id"];
			$itemCount++;
		}
	}

	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
		$classifiedsToPay = db_getFromDB("classified", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($classifiedsToPay as $classifiedToPay) {
			$classified_id[] = $classifiedToPay["id"];
			$itemCount++;
		}
	}

	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
		$articlesToPay = db_getFromDB("article", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($articlesToPay as $articleToPay) {
			$article_id[] = $articleToPay["id"];
			$itemCount++;
		}
	}

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label);

	$second_step = 1;
    
    $gatewaysNoForm = array();
    $gatewaysNoForm[] = "paypal";
    $gatewaysNoForm[] = "payflow";
    $gatewaysNoForm[] = "pagseguro";

	if ($itemCount == 1 || $ispackage == "true") include(INCLUDES_DIR."/code/billing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
    
?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <br>
                <ol class="breadcrumb breadcrumb-steps breadcrumb-steps-inverse text-center">
                    <li><strong>1:</strong> <?=system_showText(LANG_ADVERTISE_IDENTIFICATION);?></li>
                    <li class="active"><strong>2:</strong> <?=system_showText(LANG_CHECKOUT);?></li>
                    <li><strong>3:</strong> <?=system_showText(LANG_ADVERTISE_CONFIRMATION);?></li>
                </ol>
                <br>
            </div>
        </div>

    </section>

    <section class="block">
        <div class="container">

            <div class="well">

                <div class="content-main order" id="screen5" style="display: block;">

                    <div class="order">

                        <div id="billing-detail">

                            <h1><?=system_showText(LANG_ADVERTISE_BILLINGDETAIL);?></h1>
                            <p><?=system_showText(LANG_ADVERTISE_BILLINGDETAIL_TIP);?></p>
                            <br>
                            <div>

                                <? if ($paymentSystemError) { ?>

                                    <p class="alert alert-warning">
                                        <?=$payment_message?><br>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                                    </p>

                                <? } elseif ($payment_message) { ?>

                                    <p class="alert alert-warning">
                                        <?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br>
                                        <?=$payment_message?><br>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                                    </p>

                                <? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) {

                                    if ($itemCount > 1) {
                                        echo "<p class=\"alert alert-info\">".system_showText(LANG_ADVERTISE_ALREADYUSER1)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_ADVERTISE_ALREADYUSER2)."</a>.</p>";
                                    } else {
                                        echo "<p class=\"alert alert-info\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</p>";
                                    }

                                } else { ?>

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>
                                                <?
                                                $showName = true;
                                                if ($ispackage == "true" && $auxitem_name) {
                                                    echo system_showText(LANG_LABEL_ITEMS);
                                                    $showName = false;
                                                }

                                                if ($bill_info["listings"]) {
                                                    foreach ($bill_info["listings"] as $id => $info);
                                                    if ($showName) echo system_showText(LANG_LISTING_FEATURE_NAME);
                                                    $statement_descriptor = $info["title"]." - ".system_showText(LANG_LISTING_FEATURE_NAME);
                                                } elseif ($bill_info["events"]) {
                                                    foreach ($bill_info["events"] as $id => $info);
                                                    if ($showName) echo system_showText(LANG_EVENT_FEATURE_NAME);
                                                    $statement_descriptor = $info["title"]." - ".system_showText(LANG_EVENT_FEATURE_NAME);
                                                } elseif ($bill_info["banners"]) {
                                                    foreach ($bill_info["banners"] as $id => $info);
                                                    if ($showName) echo system_showText(LANG_BANNER_FEATURE_NAME);
                                                    $statement_descriptor = $info["caption"]." - ".system_showText(LANG_BANNER_FEATURE_NAME);
                                                } elseif ($bill_info["classifieds"]) {
                                                    foreach ($bill_info["classifieds"] as $id => $info);
                                                    if ($showName) echo system_showText(LANG_CLASSIFIED_FEATURE_NAME);
                                                    $statement_descriptor = $info["title"]." - ".system_showText(LANG_CLASSIFIED_FEATURE_NAME);
                                                } elseif ($bill_info["articles"]) {
                                                    foreach ($bill_info["articles"] as $id => $info);
                                                    if ($showName) echo system_showText(LANG_ARTICLE_FEATURE_NAME);
                                                    $statement_descriptor = $info["title"]." - ".system_showText(LANG_ARTICLE_FEATURE_NAME);
                                                }
                                                $statement_descriptor .= " ".string_ucwords($info["level"]);
                                                ?>
                                            </th>

                                            <th><?=system_showText(LANG_LABEL_LEVEL);?></th>

                                            <? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
                                                <th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
                                            <? } ?>

                                            <? if ((PAYMENT_FEATURE == "on") && $info["discount_id"] && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
                                                <th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                                            <? } ?>

                                            <? if ($bill_info["banners"]) { ?>
                                                <th><?=system_showText(LANG_LABEL_EXPIRATION);?></th>
                                            <? } ?>

                                            <? if ($payment_tax_status == "on" || ($ispackage == "true" && $auxitem_name)) { ?>
                                                <th><?=(($ispackage == "true" && $auxitem_name) ? system_showText(LANG_LABEL_PRICE_PLURAL) : system_showText(LANG_SUBTOTAL));?></th>
                                            <? } ?>

                                            <? if ($payment_tax_status == "on" && $ispackage != "true") { ?>
                                                <th><?=$payment_tax_label." (".$payment_tax_value."%)";?></th>
                                            <? } ?>

                                            <? if ($ispackage != "true") { ?>
                                                <th><?=system_showText(LANG_LABEL_TOTAL);?></th>
                                            <? } ?>

                                        </tr>

                                        <tr>
                                            <td>
                                                <?
                                                if ($bill_info["banners"]) {
                                                    echo $info["caption"];
                                                } else {
                                                    echo $info["title"];
                                                }
                                                ?>
                                                <?=($info["listingtemplate"] ? "<span class=\"itemNote\">(".$info["listingtemplate"].")</span>" : "");?>
                                            </td>

                                            <td><?=string_ucwords($info["level"])?></td>

                                            <? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
                                                <td><?=$info["extra_category_amount"];?></td>
                                            <? } ?>

                                            <? if ((PAYMENT_FEATURE == "on") && $info["discount_id"] && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
                                                <td><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA);?></td>
                                            <? } ?>

                                            <? if ($bill_info["banners"]) { ?>
                                                <td>
                                                    <?
                                                    if ($info["expiration_setting"] == BANNER_EXPIRATION_RENEWAL_DATE) echo system_showText(LANG_LABEL_BY_PERIOD);
                                                    elseif ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) echo system_showText(LANG_LABEL_BY_IMPRESSIONS);
                                                    ?>
                                                </td>
                                            <? } ?>

                                            <? if ($payment_tax_status == "on" || ($ispackage == "true" && $auxitem_name)) { ?>
                                                <td><?=CURRENCY_SYMBOL." ".($aux_package_total > 0 ? format_money($bill_info["total_bill"]-$aux_package_total) : $bill_info["total_bill"]);?></td>
                                            <? } ?>

                                            <? if ($payment_tax_status == "on" && $ispackage != "true" ) { ?>
                                                <td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
                                            <? } ?>

                                            <? if ($ispackage != "true") { ?>
                                                <td>
                                                    <?
                                                    if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
                                                    else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
                                                    ?>
                                                </td>
                                            <? } ?>

                                        </tr>

                                        <? if ($ispackage == "true" && $auxitem_name) { ?>
                                            <tr>
                                                <td><?=($auxpackage_name != $item_name? $auxpackage_name." - ".$item_name." ".$item_levelName: $auxpackage_name)?><br><?=$auxdomains_names?></td>

                                                <td><?=$auxlevel_names?></td>

                                                <? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
                                                    <td style="text-align:center;">&nbsp;</td>
                                                <? } ?>

                                                <? if (PAYMENT_FEATURE == "on" && $info["discount_id"] && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) ) { ?>
                                                    <td style="text-align:center;">&nbsp;</td>
                                                <? } ?>

                                                <? if ($bill_info["banners"]) { ?>
                                                    <td>&nbsp;</td>
                                                <? } ?>

                                                <? if ($payment_tax_status == "on" || $ispackage == "true") { ?>
                                                    <td><br><?=$aux_package_item_price;?></td>
                                                <? } ?>

                                                <? if ($payment_tax_status == "on" && $ispackage != "true") { ?>
                                                    <td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
                                                <? } ?>

                                                <? if ($ispackage != "true") { ?>
                                                    <td>
                                                        <?
                                                        if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
                                                        else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
                                                        ?>
                                                    </td>
                                                <? } ?>

                                            </tr>
                                        <? } ?>

                                    </table>

                                    <? if ($ispackage == "true" && $auxitem_name) { ?>

                                        <table class="table table-bordered table-striped">

                                            <? if ($payment_tax_status || $bill_info["tax_amount"] > 0) { ?>
                                                <tr>
                                                    <th><?=system_showText(LANG_SUBTOTALAMOUNT);?></th>
                                                    <td>
                                                        <?=CURRENCY_SYMBOL.$bill_info["total_bill"];?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th><?=$payment_tax_label." (".$bill_info["tax_amount"]."%)";?></th>
                                                    <td>
                                                        <?=CURRENCY_SYMBOL.payment_calculateTax($bill_info["total_bill"], $bill_info["tax_amount"], true, false);?>
                                                    </td>
                                                </tr>
                                            <? } ?>

                                            <tr>
                                                <th><?=system_showText(LANG_LABEL_TOTAL_PRICE);?></th>
                                                <td>
                                                    <?=CURRENCY_SYMBOL.format_money($bill_info["amount"]);?>
                                                </td>
                                            </tr>

                                        </table>

                                    <? } ?>

                                <? } ?>
                                <br>
                                <hr>
                                <br>

                            </div>

                        </div>

                        <? if (!in_array($payment_method, $gatewaysNoForm)) { ?>

                        <div id="payment-method">

                            <h2><?=system_showText(LANG_ADVERTISE_PAYMENT);?></h2>
                            <p><?=system_showText(LANG_ADVERTISE_PAYMENT_TIP);?></p>
                            <br>

                            <div class="row">

                                <? }
                                $buttonGateway = "";
                                $payment_process = "signup";
                                if (file_exists(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php")) {
                                    include(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php");
                                } else { ?>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <p class="alert alert-warning"> <?=system_showText(LANG_MSG_NO_PAYMENT_METHOD_SELECTED)?></p>
                                    </div>
                                <?
                                }

                                if (!in_array($payment_method, $gatewaysNoForm)) { ?>
                            </div>

                        </div>

                    <? } ?>

                        <div class="text-center">
                            <br>

                            <? if ($buttonGateway) {
                                echo $buttonGateway;
                            } ?>

                            <br>
                            <br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");