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
	# * FILE: /sponsors/claim/listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

    /* This was added here from code/listing.php because image cropping
     * was failing to bypass the Validate Feature session below. */


    if ( $_SERVER['REQUEST_METHOD'] == "POST" )
    {
        $url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
        NewImageUploader::treatPost($url_base, "Listing");
    }

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
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'b' ORDER BY date_time DESC LIMIT 1";
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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$_POST["id"] = $claimlistingid;
	include(EDIRECTORY_ROOT."/includes/code/listing.php");

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
					<li><strong>1:</strong> <?=system_showText(LANG_LABEL_ACCOUNT_SIGNUP);?></li>
					<li class="active"><strong>2:</strong> <?=system_showText(LANG_LISTING_UPDATE);?></li>
					<li><strong>3:</strong> <?=system_showText(LANG_LABEL_CHECKOUT);?></li>
				</ol>
				<br>
			</div>
		</div>

	</section>

	<main>
		<section class="block">

			<div class="container">

				<div class="well">

					<h1 class="theme-title">
						<?=system_showText(LANG_LISTING_INFORMATION)?>
					</h1>
					<div class="row">
						<form name="listing" id="listing" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

							<input type="hidden" name="ieBugFix" value="1">

							<input type="hidden" name="process" id="process" value="claim">
							<input type="hidden" name="id" id="id" value="<?=$id?>">
							<input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>">
							<input type="hidden" name="claim_id" id="claim_id" value="<?=$claimID?>">
							<input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>">
							<input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>">
							<input type="hidden" name="level" id="level" value="<?=$level?>">
							<input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>">

							<div class="col-sm-12">

								<? if ($message_listing) { ?>
									<div class="alert alert-warning" role="alert">
										<p><?=$message_listing;?></p>
									</div>
								<? } ?>

								<? include(INCLUDES_DIR."/forms/form-listing.php"); ?>
							</div>
							<input type="hidden" name="ieBugFix2" value="1">

							<div class="col-sm-12">
								<hr>
								<p class="text-center">
									<br>
										<button class="btn btn-success btn-lg" type="button" onclick="JS_submit()"><?=system_showText(LANG_BUTTON_NEXT)?></button>
									<br>
								</p>
							</div>

						</form>
					</div>

				</div>
	
			</div>
		</section>
	</main>

<?
	include(INCLUDES_DIR."/modals/modal-categoryselect.php");
	include(INCLUDES_DIR."/modals/modal-crop.php");

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");