<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/promote/promotions/package.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/promote/promotions";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;
	$item_form = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/package.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");


    # ----------------------------------------------------------------------------------------------------
    # SIDEBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/sidebar-promote.php");

?>
    <main class="wrapper togglesidebar container-fluid">

        <?
        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <form name="package" role="form" id="package" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>">
            <input type="hidden" name="id" value="<?=$id?>">
            <section class="row heading">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <?
                            if ($id) {
                                $prefix = system_showText(LANG_SITEMGR_EDIT);
                            } else {
                                $prefix = system_showText(LANG_SITEMGR_ADD);
                            }
                            ?>
                            <h1><?=$prefix?> <?=system_showText(LANG_SITEMGR_PACKAGE_SING)?></h1>

                        </div>
                        <div class="col-sm-4 text-right">
                            <div class="top-actions">
                                <button type="submit" name="submit_button" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                            </div>
                        </div>
                    </div>
                    <?
                    if ($message_package) {
                        echo "<p class=\"alert alert-warning\">".$message_package."</p>";
                    }
                    ?>
                </div>
            </section>

            <section class="section-form row">
                <div class="container">
                    <? include(INCLUDES_DIR."/forms/form-package.php"); ?>
                </div>
            </section>

            <section class="row footer-action">
                <div class="container">
                    <div class="col-xs-12 text-right">
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/promotions/" ?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?> </span>
                        <button type="submit" name="submit_button" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                </div>
            </section>

        </form>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/package.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>