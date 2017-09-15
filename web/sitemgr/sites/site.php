<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/sites/site.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = DEFAULT_URL."/".SITEMGR_ALIAS."/sites";
	$url_base = DEFAULT_URL."/".SITEMGR_ALIAS."";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/domain.php");

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-domains.php");

?> 

        <main class="wrapper-dashboard togglesidebar container-fluid">
            
            <?php
            require(SM_EDIRECTORY_ROOT."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?>

            <form role="form" name="domain" id="domain" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                <section id="edit-listing" class="row heading">
                    <div class="container">
                        <h1><?=system_showText(LANG_SITEMGR_SITES_ADD);?></h1>
                    </div>
                </section>
                
                <? if (!$deniedOperation) {?>

               <section class="row edit-listing">
                    <div class="container">
                        <? include(INCLUDES_DIR."/forms/form-domain.php"); ?>
                    </div>
               </section>
                                
                <p class="errorMessage" id="finishError" style="display: none"></p>
                
                <div id="domainProgress" style="display:none;">
                    <div class="alert alert-loading alert-block text-center">
                        <p class="alert alert-info">
                            <?=system_showText(LANG_SITEMGR_DOMAIN_PROCESS_MSG);?>
                        </p>
                        <p>
                            <span id="domain_message"><?=system_showText(LANG_SITEMGR_DOMAIN_PROCESS_STARTING);?><br /><img src="<?=DEFAULT_URL."/".SITEMGR_ALIAS;?>/assets/img/loading-64.gif" /></span>
                        </p>
                        <p>
                            <span id="domain_progress">0</span>
                            <span id="dmoain_progress_percentage">%</span>
                        </p>
                    </div>
				</div>

               <section class="row footer-action" id="domainButtons">
                    <div class="container">
                        <div class="col-xs-12 text-right">
                            <a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS."/sites/")?>" class="btn btn-default"><?=system_showText(LANG_CANCEL);?></a>
                            <span class="separator"> <?=system_showText(LANG_OR);?>  </span>
                            <button type="submit" id="bt_submit" name="submit_button" class="btn btn-primary" value="Submit"><?=system_showText(LANG_MSG_SAVE_CHANGES);?></button>
                        </div>
                    </div>
               </section>
                
                <? } else { ?>
                    <div class="col-xs-12">
                        <p class="alert alert-warning">
                            <?=system_showText(LANG_SITEMGR_DOMAIN_CONTACT_SUPPORT);?>
                        </p>
                    </div>
                <? } ?>

           </form>

        </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/sites.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>