<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/listing/categories/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/categories";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;
	$table_category = "ListingCategory";
	$message_no_record = LANG_SITEMGR_LISTING_CATEGORY_NORECORD;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

    //Delete
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Delete category
        if ($action == "delete") {
            $category = new ListingCategory($_POST['id']);
            $category->delete();
            $message = 1;
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/categories/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;
        }
    }

    include(INCLUDES_DIR."/code/add_mult_categories.php");

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
    $isNullSegment = "";
    if (!($category_id > 0)){
        $isNullSegment = "ISNULL(category_id) OR ";
    }
	$pageObj  = new pageBrowsing("ListingCategory", $screen, RESULTS_PER_PAGE, "title, id", "title", $letter, $isNullSegment ."category_id = ".db_formatNumber($category_id), "id, `title`, enabled");
	$categories = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/categories/index.php?category_id=".$category_id;

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

        <div class="content-control" id="search-all">
            <div class="row">
                <? include(SM_EDIRECTORY_ROOT."/layout/submenu-content.php"); ?>
            </div>
        </div>

        <div class="content-full">
            <? if ($categories) { ?>
                <div class="list-content">
                    <? include(INCLUDES_DIR."/lists/list-categories.php"); ?>

                    <div class="content-control-bottom pagination-responsive">
                        <? include(INCLUDES_DIR."/lists/list-pagination.php"); ?>
                    </div>
                </div>
            <? } else {
                include(SM_EDIRECTORY_ROOT."/layout/norecords.php");?>
            <? } ?>
        </div>

    </main>

    <? include(INCLUDES_DIR."/modals/modal-delete.php"); ?>
    <? include(INCLUDES_DIR."/modals/modal-add-mult-categories.php"); ?>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
