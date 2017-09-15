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
	# * FILE: /sponsors/listing/clicktocall.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (TWILIO_APP_ENABLED != "on" || TWILIO_APP_ENABLED_CALL != "on"){
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	if ($id) {
		$level = new ListingLevel();
		$listing = new Listing($id);
        $accId = $listing->getNumber("account_id");
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			exit;
		}
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			exit;
		}
		$listingHasClickToCall = $level->getHasCall($listing->getNumber("level"));
		if ((!$listingHasClickToCall) || ($listingHasClickToCall != "y")) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/clicktocall.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");
    ?>

	<section class="top-search">

		<? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

		<div class="well well-translucid">
			<div class="container">
				<br>
				<h2><?=system_showText(LANG_ADD)?> <?=system_showText(LANG_LISTING_FEATURE_NAME);?></h2>
				<br>
			</div>
		</div>
	</section>

	<section class="block">
		<div class="container">

			<? include(MEMBERS_EDIRECTORY_ROOT."/".LISTING_FEATURE_FOLDER."/navbar.php"); ?>

			<div class="well">

				<form name="clicktocall_form" id="clicktocall_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

					<input type="hidden" name="id" id="id" value="<?=$id?>">
					<input type="hidden" name="item_title" id="item_title" value="<?=$item_title?>">
					<input type="hidden" name="module" id="module" value="<?=$module?>">
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="action_clicktocall" id="action_clicktocall" value="addCallerID">

					<div class="row">
						<? include(INCLUDES_DIR."/forms/form-listing-twilio.php"); ?>
					</div>

					<div class="text-center">
						<div class="btn-toolbar">
							<button class="btn btn-primary <?=!$enableSave ? "disabled" : ""?>" id="buttonSaveCopy" <?=!$enableSave ? "disabled" : "onclick=\"changeSendForm('checkClickToCall');\""?> type="button" name="check_button" value="validate">
								<?=system_showText(LANG_MSG_SAVE_CHANGES)?>
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</section>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");