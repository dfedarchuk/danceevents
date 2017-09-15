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
	# * FILE: /sponsors/event/event.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$members = 1;
	$item_form    = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";

	include(EDIRECTORY_ROOT."/includes/code/event.php");

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
                    <?=system_showText($id ? LANG_LABEL_EDIT : LANG_ADD)?> <?=system_showText(LANG_EVENT_FEATURE_NAME);?>
                </h2>
                <br>
            </div>
        </div>
    </section>

    <section class="block">
        <div class="container">
            <div class="well">
                <h2 class="theme-title"><?=system_showText(LANG_EVENT_INFORMATION)?></h2>

                <div class="row">
                    <form name="event" id="event" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="process" id="process" value="<?=$process?>">
                        <input type="hidden" name="id" id="id" value="<?=$id?>">
                        <input type="hidden" name="account_id" value="<?=$acctId?>">
                        <input type="hidden" name="level" id="level" value="<?=$level?>">
                        <input type="hidden" name="using_package" id="using_package" value="<?=($package_id ? "y" : "n")?>">
                        <input type="hidden" name="package_id" id="package_id" value="<?=$package_id?>">
                        <input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>">

						<? if ($message_event) { ?>
							<div class="col-sm-12 alert alert-warning" role="alert">
								<p><?=$message_event;?></p>
							</div>
						<? } ?>

                        <? include(INCLUDES_DIR."/forms/form-event.php"); ?>

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