<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/event/eventlevel.php
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/event.php?level=".$_POST["level"]);
        exit;
    }
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    $levelObj = new EventLevel();
    $levelvalues = $levelObj->getLevelValues();
    
    $addingModule = "event";
    
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-content.php");

?> 

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?> 

        <form role="form" name="event_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

           <section class="heading">
                <h1><?=system_showText(LANG_MENU_ADDEVENT);?></h1>
                <h2><?=system_showText(LANG_MENU_SELECTEVENTLEVEL);?></h2>
                <p><?=str_replace("[a]", "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/payment/\" target=\"_blank\">",str_replace("[/a]", "</a>", system_showText(LANG_SELECTLEVEL_TIP)));?></p>
            </section>

            <? include(INCLUDES_DIR."/forms/form-module-level.php"); ?>

            <section class="row footer-action hidden">
                <div class="col-xs-12 text-center">
                    <button type="submit" class="btn btn-success"><?=system_showText(LANG_BUTTON_NEXT);?></button>
                </div>
            </section>

        </form>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>