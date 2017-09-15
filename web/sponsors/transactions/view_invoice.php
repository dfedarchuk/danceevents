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
	# * FILE: /sponsors/transactions/view_invoice.php
	# ----------------------------------------------------------------------------------------------------

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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		include(INCLUDES_DIR."/code/invoice.php");
	} else {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/transactions/");
		exit;
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
				if (is_array($invoice) && ((is_array($invoice_listing)) || (is_array($invoice_event)) || (is_array($invoice_banner)) || (is_array($invoice_classified)) || (is_array($invoice_article)) || (is_array($invoice_custominvoice)))) {
					include_once(EDIRECTORY_ROOT."/includes/views/view_invoice_detail.php");
				} else { ?>
				<p class="alert alert-info"><?=system_showText(LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT)?><p>
					<? } ?>

			</div>
		</div>
	</section>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");