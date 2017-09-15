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
	# * FILE: /sponsors/transactions/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }

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

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";

    //TRANSACTIONS
	$sql_where[] = " account_id = $acctId ";
	$sql_where[] = " hidden = 'n' ";
    $where .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Payment_Log", $screen, false, "transaction_datetime DESC, id DESC", "", "", $where);
	$transactions = $pageObj->retrievePage("array");

    //INVOICES
	if (INVOICEPAYMENT_FEATURE == "on") {
        $invoiceStatusObj = new InvoiceStatus();
        unset($sql_where);
        unset($where);
        $sql_where[] = " hidden = 'n' ";
        if ($acctId) {
            $sql_where[] = " account_id = $acctId ";
        }
        if ($invoiceStatusObj->getDefault()) {
            $sql_where[] = " status != '".$invoiceStatusObj->getDefault()."' ";
        }
        if ($sql_where) {
            $where .= " ".implode(" AND ", $sql_where)." ";
        }
        $pageObj  = new pageBrowsing("Invoice", $screen, false, "date DESC", "", "", $where);
        $invoices = $pageObj->retrievePage("array");
    }

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

				<?
				if ($transactions || $invoices) {
					include(INCLUDES_DIR."/tables/table_transaction_members.php");
				} else { ?>
					<div class="alert alert-warning"><?=system_showText(LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM)?></div>
				<? } ?>

			</div>
		</div>
	</section>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");