<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/deal/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    if ( PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on" || CUSTOM_HAS_PROMOTION != "on"){
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
        exit;
    }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".PROMOTION_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
    $manageOrder = system_getManageOrderBy($_POST["order_by"] ? $_POST["order_by"] : $_GET["order_by"], "Promotion", PROMOTION_SCALABILITY_OPTIMIZATION, $fields);

	extract($_GET);
	extract($_POST);
    
    $manageModule = "promotion";
    $manageModuleFolder = PROMOTION_FEATURE_FOLDER;
    
    # ----------------------------------------------------------------------------------------------------
	# MANAGE MOBULDE BACKEND - SEARCH / BULK UPDATE / DELETE
	# ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/admin-manage-module.php");

	// Page Browsing /////////////////////////////////////////
	unset($pageObj);
	$pageObj = new pageBrowsing("Promotion", $screen, RESULTS_PER_PAGE, ($_GET["newest"] ? "id DESC" : $manageOrder), "name", $letter, $where, $fields);
	$promotions = $pageObj->retrievePage();
	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".PROMOTION_FEATURE_FOLDER."/index.php";
    
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

    <main class="wrapper togglesidebar container-fluid" id="view-content-list">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <?// Content Control is subscribed by bulk update using the Css classes SHOW and HIDDEN.?>
        <div class="content-control hidden" id="bulkupdate">
            <div class="row">
                <?
                //Bulk Update Include
                include(INCLUDES_DIR."/forms/form-bulkupdate.php");
                ?>
            </div>
        </div>

        <? include(SM_EDIRECTORY_ROOT."/layout/submenu-content.php"); ?>

        <div class="content-full">
            <? if ($promotions) { ?>
                <div class="list-content">
                    <? include(INCLUDES_DIR."/lists/list-module.php"); ?>

                    <div class="content-control-bottom pagination-responsive">
                        <? include(INCLUDES_DIR."/lists/list-pagination.php"); ?>
                    </div>
                </div>

                <div class="view-content">
                    <? include(SM_EDIRECTORY_ROOT."/content/view-module.php"); ?>
                </div>

            <? } else {
                include(SM_EDIRECTORY_ROOT."/layout/norecords.php");
            } ?>
        </div>

    </main>

    <?
    include(INCLUDES_DIR."/modals/modal-delete.php");
    include(INCLUDES_DIR."/modals/modal-bulk.php");
    include(INCLUDES_DIR."/modals/modal-search-module.php");
    ?>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/general.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>