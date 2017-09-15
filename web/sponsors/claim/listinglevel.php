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
	# * FILE: /sponsors/claim/listinglevel.php
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

	if (!is_array($listingObject->getGalleries())) {
		$gallery = new Gallery();
		$aux = array("account_id"=>0,"title"=>$listingObject->getString("title"),"entered"=>"NOW()","updated"=>"now()");
		$gallery->makeFromRow($aux);
		$gallery->save();
		$listingObject->setGalleries($gallery->getNumber("id"));
	}


	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'a' ORDER BY date_time DESC LIMIT 1";
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
		$status = new ItemStatus();
		$listingObject->setDate("renewal_date", "00/00/0000");
		$listingObject->setString("status", $status->getDefaultStatus());
		$listingObject->setString("level", $_POST["level"]);
		$listingObject->setNumber("listingtemplate_id", $_POST["listingtemplate_id"]);
		$listingObject->save();
		$claimObject->setString("step", "b");
		$claimObject->save();
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/claim/listing.php?claimlistingid=".$claimlistingid);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$listing = $listingObject;
	$listing->extract();
	$levelObj = new ListingLevel();
    if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
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
						<?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span>3 <?=system_showText(LANG_LABEL_STEPS);?> &raquo;</span>
					</h1>

					<form name="listinglevel" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

						<input type="hidden" name="claimlistingid" value="<?=$claimlistingid?>">

						<? include(INCLUDES_DIR."/forms/form_listinglevel.php"); ?>

						<p class="text-center">
							<br>
								<button class="btn btn-success btn-lg" type="submit"><?=system_showText(LANG_BUTTON_NEXT)?></button>
							<br>
						</p>


					</form>

				</div>

			</div>
		</section>
	</main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");