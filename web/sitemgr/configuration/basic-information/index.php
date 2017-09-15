<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/general-information/index.php
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
    
    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/content_basic_settings.php");
    
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-configuration.php");
?> 

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

<!--        <div class="row">
            <div class="progress">
                <div class="progress-bar" data-placement="bottom" data-toggle="tooltip" data-original-title="5% Complete" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                    <span class="sr-only">5% Complete</span>
                </div>
            </div>
        </div>-->

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_BASIC_INFO);?></h1>
            <p><?=system_showText(LANG_SITEMGR_BASIC_INFO_TIP);?></p>
        </section>

        <section class="row section-form">
                <div class="col-md-9">
                    <form name="header" id="header" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">
                        <?
                        MessageHandler::render();

                        include(INCLUDES_DIR."/forms/form-logo.php");
                        include(INCLUDES_DIR."/forms/form-siteinfo.php");
                        include(INCLUDES_DIR."/forms/form-contactinfo.php");
                        ?>
                    </form>
                </div>
        </section>
    </main>

<?php
    # ----------------------------------------------------------------------------------------------------
	# CUSTOM JAVASCRIPT
	# ----------------------------------------------------------------------------------------------------
    /* This will change the text and color on the buttons when the user has set a file for upload. */
    JavaScriptHandler::registerOnReady('
        $(".morphOnSelect").change( function(){
            $("label[for=\'"+$(this).prop("id")+"\']").removeClass("btn-primary").addClass("btn-success").html("'. system_showText( stripslashes( LANG_SITEMGR_SETTINGS_GENERAL_HITTOCONFIRM_BUTTON ) ) .'");
        });
    ');

    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/settings.php";

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");