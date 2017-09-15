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
	# * FILE: /sponsors/banner/banner.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$url_redirect = $url_base;
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$banner = new Banner($id);
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			exit;
		}
	}

	include(EDIRECTORY_ROOT."/includes/code/banner.php");

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
					<?=system_showText($id ? LANG_LABEL_EDIT : LANG_ADD)?> <?=system_showText(LANG_BANNER_FEATURE_NAME);?>
				</h2>
				<br>
			</div>
		</div>
	</section>

	<section class="block">
		<div class="container">

			<div class="well">

				<div class="row">
					<form name="banner" id="banner" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

						<? if ($id) { ?>
						<input type="hidden" name="process" id="process" value="<?=$process?>">
						<input type="hidden" name="operation" value="update">
						<input type="hidden" name="id" value="<?=$id?>">
						<input type="hidden" name="account_id" value="<?=$acctId?>">
						<input type="hidden" name="level" value="<?=$level?>">
						<? } else { ?>
						<input type="hidden" name="operation" value="add">
						<input type="hidden" name="account_id" value="<?=$acctId?>">
						<input type="hidden" name="type" value="<?=$type?>">
						<? } ?>

						<? if ($error_message) { ?>
							<div class="col-sm-12 alert alert-warning" role="alert">
								<p><?=$error_message;?></p>
							</div>
						<? } ?>

						<?
						include(INCLUDES_DIR."/forms/form-banner.php");
						?>

					</form>
				</div>

				<div class="row">
					<form action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/" method="get">
						<div class="row text-center">
							<button class="btn btn-link" type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
							<button class="btn btn-success" type="button" onclick="document.banner.submit();"><?=system_showText(LANG_MSG_SAVE_CHANGES)?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");