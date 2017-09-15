<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/promote/newsletter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
 	
 	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MAIL_APP_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();
    
    extract($_POST);
    extract($_GET);
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/mailappsignup.php");
    
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
            
            <?php
            require(SM_EDIRECTORY_ROOT."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?>

            <section class="heading">
                <h1><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTERS);?></h1>
                <p><img style="margin-right: 20px" src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/newsletter/arcamailer.png"><img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/newsletter/campaignmonitor.png"></p>
                <br>

                <div class="row">
                    <div class="col-sm-8">
                        <p><?=str_replace("[/a]", "</a>", (str_replace("[a]", "<a href=\"".MAILAPP_LIVE_URL."\" target=\"_blank\">", system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_1))));?></p>
                        <p><?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_2);?></p>
                        <p><?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_3);?></p>
                        <p><?=str_replace("[/a]", "</a>", (str_replace("[a]", "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/export/arcamailerexport.php\" target=\"_blank\">", system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_4))));?></p>
                        <strong><p><?=str_replace("[/a]", "</a>", (str_replace("[a]", "<a href=\"https://www.campaignmonitor.com/resources/\" target=\"_blank\">", system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_5))));?></p></strong>
                        <p><?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_1);?></p>
                    </div>
                    <div class="col-sm-4 text-right">
                        <img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/newsletter/newsletter-sample.png">
                    </div>
                </div>
            </section>

            <section class="row">
                <? include(INCLUDES_DIR."/forms/form-mailappsignup.php"); ?>
            </section>
            <br>
            
        </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/newsletter.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>