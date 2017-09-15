<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/listing/claim/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") {
		header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/claim";
	$url_base     = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
    
	// Page Browsing /////////////////////////////////////////
	
	$claim_fields = 
		"id, 
		account_id, 
		listing_title, 
		listing_id, 
		date_time, 
		status,
		if (status='complete','1',
		if (status='progress','2',
		if (status='incomplete','3',
		if (status='approved','4',  
		if (status='denied','5',0))))) as id_status";
    
    //Search
    if ($search_id) $sql_where[] = " id = ".db_formatString($search_id)." ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";
	if ($search_title) $sql_where[] = " ( listing_title LIKE ".db_formatString("%".$search_title."%")." OR old_title LIKE ".db_formatString("%".$search_title."%")." OR new_title LIKE ".db_formatString("%".$search_title."%")." ) ";
	if ($search_no_owner == 1) $sql_where[] = " account_id = 0 ";
	elseif ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	
	$pageObj  = new pageBrowsing("Claim", $screen, RESULTS_PER_PAGE, "id_status, date_time DESC, id Desc", "title", $letter, ($where ? $where : false), $claim_fields);
	$claims = $pageObj->retrievePage();	

	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/claim/index.php";

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
        
        include(SM_EDIRECTORY_ROOT."/layout/submenu-content.php"); ?>

        <div class="content-full">
            <? if ($claims) { ?>
                <div class="list-content">
                    <? include(INCLUDES_DIR."/lists/list-claim.php"); ?>

                    <div class="content-control-bottom pagination-responsive">
                        <? include(INCLUDES_DIR."/lists/list-pagination.php"); ?>
                    </div>
                </div>

                <div class="view-content">
                    <? include(SM_EDIRECTORY_ROOT."/content/".LISTING_FEATURE_FOLDER."/claim/view-claim.php"); ?>
                </div>

            <? } else {
                include(SM_EDIRECTORY_ROOT."/layout/norecords.php");
            } ?>
        </div>
        
    </main>

    <? include(INCLUDES_DIR."/modals/modal-search-claim.php"); ?>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>