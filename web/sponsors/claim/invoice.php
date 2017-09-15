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
	# * FILE: /sponsors/claim/invoice.php
	# ----------------------------------------------------------------------------------------------------

        /**
     * <Lucas Trentim (2015)>
     * @todo : This code also needs a LOT of attention. It's basically a glue-eating special child
     */

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

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
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/claim";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }
	if (!$claimlistingid) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	if ($listingObject->getNumber("account_id") != $acctId) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'd' ORDER BY date_time DESC LIMIT 1";
	$resultClaim = $dbObjClaim->query($sqlClaim);
	if ($rowClaim = mysql_fetch_assoc($resultClaim)) $claimID = $rowClaim["id"];
	if (!$claimID) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	$claimObject = new Claim($claimID);
	if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$claimObject->setString("step", "e");
		$claimObject->save();
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/claim/claimfinish.php?claimlistingid=".$claimlistingid);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$listing_id[] = $listingObject->getNumber("id");
	$second_step = 1;
	$payment_method = "invoice";

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label);

	include(INCLUDES_DIR."/code/billing.php");
	if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);

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
                    <li><strong>2:</strong> <?=system_showText(LANG_LISTING_UPDATE);?></li>
                    <li class="active"><strong>3:</strong> <?=system_showText(LANG_LABEL_CHECKOUT);?></li>
                </ol>
                <br>
            </div>
        </div>
    </section>

    <div class="well well-light">
        <div class="container">

            <h2 class="theme-title"><?=system_showText(LANG_MSG_CLAIM_THIS_LISTING)?></h2>

            <div>
                <br>
                <h3><?=system_showText(LANG_LABEL_PAY_BY_INVOICE)?></h3>
                <br><br>
                <? if ($paymentSystemError) { ?>

                    <p class="errorMessage">
                        <?=$payment_message?><br>
                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php" ><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                    </p>

                <? } elseif ($payment_message) { ?>

                    <p class="errorMessage">
                        <?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br>
                        <?=$payment_message?><br>
                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                    </p>

                <?
                } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) {
                    echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</p>";
                } else {

                    $listing = new Listing($_POST);

                    /**************************************************************************************************/
                    /*                                                                                                */
                    /* E-mail notify                                                                                  */
                    /*                                                                                                */
                    /**************************************************************************************************/
                    setting_get("sitemgr_email",$sitemgr_email);
                    $contact = new Contact($acctId);

                    // sending e-mail to user //////////////////////////////////////////////////////////////////////////
                    if ( $emailNotificationObj = system_checkEmail( SYSTEM_INVOICE_NOTIFICATION ) )
                    {
                        $subject = $emailNotificationObj->getString( "subject" );
                        $subject = system_replaceEmailVariables( $subject, $listing->getNumber( 'id' ), 'listing' );
                        $subject = html_entity_decode( $subject );

                        $body = $emailNotificationObj->getString( "body" );
                        $body = str_replace( "ACCOUNT_NAME", $contact->getString( "first_name" )." ".$contact->getString( "last_name" ), $body );
                        $body = str_replace( "DEFAULT_URL", DEFAULT_URL."/".MEMBERS_ALIAS."/billing/invoice.php?id=".$bill_info["invoice_number"]."\n", $body );
                        $body = system_replaceEmailVariables( $body, $listing->getNumber( 'id' ), 'listing' );
                        $body = html_entity_decode( $body );

                        Mailer::mail( $contact->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                    }
                    ////////////////////////////////////////////////////////////////////////////////////////////////////

                    $invoiceObj = new Invoice($bill_info["invoice_number"]);
                    $invoiceObj->setString("status","P");
                    $invoiceObj->Save();
                    ?>

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="text-align:center"><?=system_showText(LANG_LABEL_INVOICENUMBER);?></th>
                            <th><?=system_showText(LANG_LISTING_FEATURE_NAME);?></th>
                            <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                            <th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
                            <?
                            if (PAYMENT_FEATURE == "on") {
                                if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
                                    ?><th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th><?
                                }
                            }
                            ?>
                            <th><?=system_showText(LANG_LABEL_RENEWAL);?></th>

                            <? if ($payment_tax_status == "on") { ?>
                                <th><?=system_showText(LANG_SUBTOTAL);?></th>
                            <? } ?>

                            <? if ($payment_tax_status == "on") { ?>
                                <th><?=$payment_tax_label."(".$payment_tax_value."%)";?></th>
                            <? } ?>

                            <th><?=system_showText(LANG_LABEL_TOTAL);?></th>
                        </tr>
                        <tr>
                            <td width="65" style="text-align:center; font-weight:bold;"><?=$bill_info["invoice_number"];?></td>
                            <td style="font-weight:bold;white-space:normal;"><?=$info["title"];?><?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?></td>
                            <td><?=string_ucwords($info["level"]);?></td>
                            <td style="text-align:center;"><?=$info["extra_category_amount"];?></td>
                            <?
                            if (PAYMENT_FEATURE == "on") {
                                if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
                                    ?><td style="text-align:center;"><?=(($info["discount_id"]) ? ($info["discount_id"]) : (system_showText(LANG_NA)));?></td><?
                                }
                            }
                            ?>
                            <td><?=format_date($info["renewal_date"]);?></td>

                            <? if ($payment_tax_status == "on") { ?>
                                <td><?=CURRENCY_SYMBOL." ".$bill_info["total_bill"];?></td>
                            <? } ?>

                            <? if ($payment_tax_status == "on") { ?>
                                <td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
                            <? } ?>

                            <td>
                                <?
                                    if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
                                    else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
                                ?>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-striped table-bordered">

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
                            <td>* <a href="<?=DEFAULT_URL."/".ALIAS_TERMS_URL_DIVISOR?>" target="_blank"><?=system_showText(LANG_MSG_AGREE_TO_TERMS)?></a> <?=system_showText(LANG_MSG_I_WILL_SEND_PAYMENT)?></td>
                        </tr>
                    </table>

                    <form name="paybyinvoice" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                        <input type="hidden" name="claimlistingid" value="<?=$claimlistingid?>">

                        <div class="text-center">
                            <br>
                            <button class="btn btn-success btn-lg" type="button" id="authorizebutton" onclick="completeTheProcess();"><?=system_showText(LANG_BUTTON_COMPLETE_THE_PROCESS)?></button>

                        </div>

                    </form>

                    <script type="text/javascript">
                        <!--
                        function completeTheProcess() {
                            if (document.getElementById("terms").checked){
                                document.paybyinvoice.submit();
                            } else {
                                alert('<?=system_showText(LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE);?>');
                            }
                        }
                        //-->
                    </script>

                <? } ?>

            </div>

        </div>
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");