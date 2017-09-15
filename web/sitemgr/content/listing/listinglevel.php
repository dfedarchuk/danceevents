<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/listing/listinglevel.php
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
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/listing.php?level=".$_POST["level"]."&listingtemplate_id=".$_POST["listingtemplate_id"]);
        exit;
    }
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    $levelObj = new ListingLevel();
    $levelvalues = $levelObj->getLevelValues();
    
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbObjLT = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY editable, title";
    $resultLT = $dbObjLT->query($sqlLT);
    
    $addingModule = "listing";
    
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

        <form role="form" name="listing_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

           <section class="heading">
                <h1><?=system_showText(LANG_MENU_ADDLISTING);?></h1>
                <h2><?=system_showText(LANG_MENU_SELECTLISTINGLEVEL);?></h2>
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