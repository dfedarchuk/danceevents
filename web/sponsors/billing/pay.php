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
	# * FILE: /sponsors/billing/pay.php
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
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/billing";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$second_step = $_POST["second_step"] ? $_POST["second_step"] : $_GET["second_step"];
	if (!$second_step) {
		header("Location: ".$url_base."/billing/index.php");
		exit;
	}

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label);

	include(INCLUDES_DIR."/code/billing.php");

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
                <h2> <?=system_showText(LANG_LABEL_BILLING);?></h2>
                <br>
            </div>
        </div>
    </section>

    <section class="block">
        <div class="container">

            <? include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php"); ?>

            <div class="well">

                <? if ($paymentSystemError) { ?>

                    <ul class="list-unstyled">
                        <li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
                    </ul>

                    <div class="alert alert-warning"><?=$payment_message?></div>

                <? } elseif ($payment_message) { ?>

                    <ul class="list-view">
                        <li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
                    </ul>

                    <div class="alert alert-warning">
                        <?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br>
                        <?=$payment_message?>
                    </div>

                <? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"]) && (!$bill_info["custominvoices"])) { ?>

                    <a href="javascript:history.back(-1);" class="btn btn-xs btn-link"><?=system_showText(LANG_LABEL_BACK);?></a>


                    <?
                    echo "<div class=\"alert alert-warning\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</div>";
                    ?>

                <? } else { ?>

                    <? include(INCLUDES_DIR."/tables/table_billing_second_step.php"); ?>

                <? } ?>
            </div>
        </div>
    </section>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");