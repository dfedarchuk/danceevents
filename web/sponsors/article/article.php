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
	# * FILE: /sponsors/article/article.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;
	$item_form = 1;

	/*
	 * Check if need show package
	 */
	if (!$id && !$show_package && !$package_id && $_SERVER['REQUEST_METHOD'] != "POST") {
		/*
		 * Check if exists package
		 */
		$articleLevelObj = new ArticleLevel();
		$level = $articleLevelObj->getDefault();

		$packageObj = new Package();
		$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "article", $level);
		$hasPackage = false;
		if ((is_array($array_package_offers)) and (count($array_package_offers) > 0) and $array_package_offers[0]) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/".ARTICLE_FEATURE_FOLDER."/order_package.php?show_package=1&level=".$level);
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/article.php");

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
				<h2>
					<?=system_showText($id ? LANG_LABEL_EDIT : LANG_ADD)?> <?=system_showText(LANG_ARTICLE_FEATURE_NAME);?>
				</h2>
				<br>
			</div>
		</div>
	</section>

	<section class="block">
		<div class="container">
			<div class="well">

				<h2 class="theme-title"><?=system_showText(LANG_ARTICLE_INFORMATION)?></h2>

				<div class="row">

					<form name="article" id="article" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

						<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

						<input type="hidden" name="ieBugFix" value="1">

						<? /* Microsoft IE Bug */ ?>

						<input type="hidden" name="process" id="process" value="<?=$process?>">
						<input type="hidden" name="id" id="id" value="<?=$id?>">
						<input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>">
						<input type="hidden" name="level" id="level" value="<?=$level?>">
						<input type="hidden" name="using_package" id="using_package" value="<?=($package_id ? "y" : "n")?>">
						<input type="hidden" name="package_id" id="package_id" value="<?=$package_id?>">
						<input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>">

						<? if ($message_article) { ?>
							<div class="col-sm-12 alert alert-warning" role="alert">
								<p><?=$message_article;?></p>
							</div>
						<? } ?>

						<? include(INCLUDES_DIR."/forms/form-article.php"); ?>

						<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)*/ ?>

						<input type="hidden" name="ieBugFix2" value="1">

						<? /* Microsoft IE Bug */ ?>

					</form>

				</div>

				<div class="row">
					<form action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/" method="get">
						<div class="row text-center">
							<button class="btn btn-link" type="submit"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
							<button class="btn btn-success" type="button" onclick="JS_submit()"><?=system_showText(LANG_MSG_SAVE_CHANGES)?></button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</section>

<?php
	include(INCLUDES_DIR."/modals/modal-categoryselect.php");
	include(INCLUDES_DIR."/modals/modal-crop.php");

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");