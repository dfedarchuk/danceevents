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
	# * FILE: /sponsors/signup/invoice.php
	# ----------------------------------------------------------------------------------------------------

    /**
     * <Lucas Trentim (2015)>
     * @todo : This code also needs a HUGE amount of attention.
     */

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

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
	$payment_method = "invoice";

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

    <div class="well well-light">
        <div class="container">
        
        <div class="content-main order" id="screen5" style="display: block;">

            <div class="order">

                <div id="billing-detail">

                    <h2><?=system_showText(LANG_ADVERTISE_BILLINGDETAIL);?></h2>
                    <p><?=system_showText(LANG_ADVERTISE_BILLINGDETAIL_TIP);?></p>
                    <br>
                    <br>
                    <div>

                        <? if ($paymentSystemError) {  ?>

                            <p class="alert alert-warning">
                                <?=$payment_message?><br>
                                <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                            </p>

                        <? } elseif ($payment_message) {  ?>

                            <p class="alert alert-warning">
                                <?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br>
                                <?=$payment_message?><br>
                                <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                            </p>

                        <? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) { ;

                            if ($itemCount > 1) {
                                echo "<p class=\"alert alert-info\">".system_showText(LANG_ADVERTISE_ALREADYUSER1)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_ADVERTISE_ALREADYUSER2)."</a>.</p>";
                            } else {
                                echo "<p class=\"alert alert-info\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</p>";
                            }

                        } else { ;

                            $continueInvoice = true;

                            if ($bill_info["listings"]) {
                                $listing = new Listing($_POST);
                            } elseif ($bill_info["events"]) {
                                $event = new Event($_POST);
                            } elseif ($bill_info["banners"]) {
                                $banner = new Banner($_POST);
                            } elseif ($bill_info["classifieds"]) {
                                $classified = new Classified($_POST);
                            } elseif ($bill_info["articles"]) {
                                $article = new Article($_POST);
                            }

                            setting_get("sitemgr_email", $sitemgr_email);
                            $contact = new Contact($acctId);

                            // sending e-mail to user //////////////////////////////////////////////////////////////////////////
                            if ($emailNotificationObj = system_checkEmail(SYSTEM_INVOICE_NOTIFICATION)) {
                                $subject = $emailNotificationObj->getString("subject");
                                $body = $emailNotificationObj->getString("body");

                                $body = str_replace("ACCOUNT_NAME", $contact->getString("first_name")." ".$contact->getString("last_name"), $body);
                                $body = str_replace("DEFAULT_URL", DEFAULT_URL."/".MEMBERS_ALIAS."/billing/invoice.php?id=".$bill_info["invoice_number"]."\n", $body);

                                if ( $bill_info["listings"] )
                                {
                                    $body    = system_replaceEmailVariables( $body, $listing->getNumber( 'id' ), 'listing' );
                                    $subject = system_replaceEmailVariables( $subject, $listing->getNumber( 'id' ), 'listing' );
                                }
                                elseif ( $bill_info["events"] )
                                {
                                    $body    = system_replaceEmailVariables( $body, $event->getNumber( 'id' ), 'event' );
                                    $subject = system_replaceEmailVariables( $subject, $event->getNumber( 'id' ), 'event' );
                                }
                                elseif ( $bill_info["banners"] )
                                {
                                    $body    = system_replaceEmailVariables( $body, $banner->getNumber( 'id' ), 'banner' );
                                    $subject = system_replaceEmailVariables( $subject, $banner->getNumber( 'id' ), 'banner' );
                                }
                                elseif ( $bill_info["classifieds"] )
                                {
                                    $body    = system_replaceEmailVariables( $body, $classified->getNumber( 'id' ), 'classified' );
                                    $subject = system_replaceEmailVariables( $subject, $classified->getNumber( 'id' ), 'classified' );
                                }
                                elseif ( $bill_info["articles"] )
                                {
                                    $body    = system_replaceEmailVariables( $body, $article->getNumber( 'id' ), 'article' );
                                    $subject = system_replaceEmailVariables( $subject, $article->getNumber( 'id' ), 'article' );
                                }

                                $body = html_entity_decode($body);
                                $subject = html_entity_decode($subject);

                                Mailer::mail( $contact->getString( "email" ), $subject, $body."TESTING", $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                            }

                            $invoiceObj = new Invoice($bill_info["invoice_number"]);
                            $invoiceObj->setString("status", "P");
                            $invoiceObj->Save();

                            if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);
                            if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info);
                            if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info);
                            if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info);
                            if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info);

                            ?>

                            <table class="table table-striped table-bordered">

                                <tr>
                                    <th><?=system_showText(LANG_LABEL_INVOICENUMBER);?></th>

                                    <th>
                                        <?
                                        if ($ispackage == "true" && $auxitem_name) {
                                            echo system_showText(LANG_LABEL_ITEMS);
                                        } else {
                                            if ($bill_info["listings"]) {
                                                echo system_showText(LANG_LISTING_FEATURE_NAME);
                                            } elseif ($bill_info["events"]) {
                                                echo system_showText(LANG_EVENT_FEATURE_NAME);
                                            } elseif ($bill_info["banners"]) {
                                                echo system_showText(LANG_BANNER_FEATURE_NAME);
                                            } elseif ($bill_info["classifieds"]) {
                                                echo system_showText(LANG_CLASSIFIED_FEATURE_NAME);
                                            } elseif ($bill_info["articles"]) {
                                                echo system_showText(LANG_ARTICLE_FEATURE_NAME);
                                            }
                                        }
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
                                    <td><?=$bill_info["invoice_number"]?></td>

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
                                    <td ><?=$bill_info["invoice_number"]?></td>

                                    <td><?=($auxpackage_name != $item_name? $auxpackage_name." - ".$item_name." ".$item_levelName: $auxpackage_name)?><br><?=$auxdomains_names?></td>

                                    <td><?=$auxlevel_names?></td>

                                    <? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
                                        <td>&nbsp;</td>
                                    <? } ?>

                                    <? if (PAYMENT_FEATURE == "on" && $info["discount_id"] && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) ) { ?>
                                        <td>&nbsp;</td>
                                    <? } ?>

                                    <? if ($bill_info["banners"]) { ?>
                                        <td>&nbsp;</td>
                                    <? } ?>

                                    <? if ($payment_tax_status == "on" || $ispackage == "true") { ?>
                                        <td><?=$aux_package_item_price;?></td>
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

                    </div>

                </div>

                <? if ($continueInvoice) { ?>
                    <br><br>
                <hr>

                <div id="payment-method">

                    <div class="left textright">
                        <h3><?=system_showText(LANG_ADVERTISE_PAYMENT);?></h3>
                        <p><?=system_showText(LANG_ADVERTISE_PAYMENT_TIP2);?></p>
                    </div>

                    <div>
                        <br><br>
                        <div class="option">

                            <table class="table table-bordered">

                                <tr>
                                    <th><?=system_showText(LANG_LABEL_MAKE_CHECKS_PAYABLE)?>:</th>
                                    <td><strong><?=EDIRECTORY_TITLE?></strong></td>
                                </tr>

                                <tr>
                                    <th></th>
                                    <td>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/invoice.php?id=<?=$bill_info["invoice_number"]?>" target="_blank"><?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?></a>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-right"><input type="checkbox" name="terms" id="terms" value="1"></th>
                                    <td><i style="cursor:help" data-toggle="tooltip" data-placement="top" title="<?=system_showText(LANG_LABEL_REQUIRED_FIELD);?>">* </i><a href="<?=DEFAULT_URL."/".ALIAS_TERMS_URL_DIVISOR?>" target="_blank"><?=system_showText(LANG_MSG_AGREE_TO_TERMS);?></a> <?=system_showText(LANG_MSG_I_WILL_SEND_PAYMENT);?></td>
                                </tr>

                            </table>

                            <?
                            if ($bill_info["listings"]) {
                                $thisListingID = array_keys($bill_info["listings"]);
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listing.php?id=".$thisListingID[0]."&process=signup";
                            } elseif ($bill_info["events"]) {
                                $thisEventID = array_keys($bill_info["events"]);
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".EVENT_FEATURE_FOLDER."/event.php?id=".$thisEventID[0]."&process=signup";
                            } elseif ($bill_info["banners"]) {
                                $thisBannerID = array_keys($bill_info["banners"]);
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".BANNER_FEATURE_FOLDER."/banner.php?id=".$thisBannerID[0]."&process=signup";
                            } elseif ($bill_info["classifieds"]) {
                                $thisClassifiedID = array_keys($bill_info["classifieds"]);
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$thisClassifiedID[0]."&process=signup";
                            } elseif ($bill_info["articles"]) {
                                $thisArticleID = array_keys($bill_info["articles"]);
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$thisArticleID[0]."&process=signup";
                            }
                            ?>

                            <script type="text/javascript">
                                <!--

                                function next() {
                                    if (document.getElementById("terms").checked){
                                        document.location="<?=$next?>";
                                    } else {
                                        alert('<?=system_showText(LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE);?>');
                                    }
                                }

                                //-->
                            </script>
                        </div>
                    </div>

                </div>

                <div class="blockcontinue text-right">

                    <button class="btn btn-success btn-lg" type="button" onclick="next();"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>

                </div>

                <? } ?>

            </div>

        </div>

    </div>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");