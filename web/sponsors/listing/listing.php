<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /sponsors/listing/listing.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;
	$item_form    = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing.php");

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
                    <?=system_showText($id ? LANG_LABEL_EDIT : LANG_ADD)?> <?=system_showText(LANG_LISTING_FEATURE_NAME);?>
                </h2>
                <br>
            </div>
        </div>
    </section>

    <section class="block">
        <div class="container">
            <?
            if ($id) {
                include(MEMBERS_EDIRECTORY_ROOT."/".LISTING_FEATURE_FOLDER."/navbar.php");
            }
            ?>

            <div class="well">

                <h2 class="theme-title"><?=system_showText(LANG_LISTING_INFORMATION)?></h2>

                <div class="row">
                    <form name="listing" id="listing" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

                        <? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

                        <input type="hidden" name="ieBugFix" value="1">

                        <? /* Microsoft IE Bug */ ?>

                        <input type="hidden" name="process" id="process" value="<?=$process?>">
                        <input type="hidden" name="id" id="id" value="<?=$id?>">
                        <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>">
                        <input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>">
                        <input type="hidden" name="level" id="level" value="<?=$level?>">
                        <input type="hidden" name="using_package" id="using_package" value="<?=($package_id ? "y" : "n")?>">
                        <input type="hidden" name="package_id" id="package_id" value="<?=$package_id?>">
                        <input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>">

                        <? if ($message_listing) { ?>
                            <div class="col-sm-12 alert alert-warning" role="alert">
                                <p><?=$message_listing;?></p>
                            </div>
                        <? } ?>

                        <? include(INCLUDES_DIR."/forms/form-listing.php"); ?>

                        <? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

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