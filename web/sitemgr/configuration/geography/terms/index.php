<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/configuration/terms/index.php
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

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_POST);
extract($_GET);

$manageModule = "nearbySearch";

# ----------------------------------------------------------------------------------------------------
# SEARCH & BULK UPDATE
# ----------------------------------------------------------------------------------------------------
if ($search_title) {
    $where = " token LIKE ".db_formatString('%'.$search_title.'%')." ";
}

include(INCLUDES_DIR."/code/bulkupdate.php");

# ----------------------------------------------------------------------------------------------------
# Page Browsing
# ----------------------------------------------------------------------------------------------------
$pageObj = new pageBrowsing("NearbySearch", $screen, RESULTS_PER_PAGE, "id DESC", "token", $letter, $where);
$nearbyTerms= $pageObj->retrievePage();
$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/terms/index.php";

if (!$msg && !$error_msg && !$error_message){
    $msg =  ($action == "delete")? "successdel" : null;
}

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

    <main class="wrapper togglesidebar container-fluid" id="view-content-list">

        <?php
        require(SM_EDIRECTORY_ROOT . "/registration.php");
        require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1><?=system_ShowText(LANG_SITEMGR_TIME_GEO)?></h1>
            <p><?=system_showText(LANG_SITEMGR_GEO_TIP);?></p>
        </section>

        <div class="row tab-options terms geography-terms">

            <? include(SM_EDIRECTORY_ROOT."/layout/nav-tabs-geography.php"); ?>

            <div class="row tab-content">

                <section class="tab-pane active">

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

                        <? if ($nearbyTerms) { ?>

                            <div class="list-content">

                                <? /*
                                <p>--><?//= system_showText(LANG_SITEMGR_GEO_CONTENT_TIP); ?><!--</p>
                                */ ?>

                                <? include(INCLUDES_DIR."/lists/list-terms.php"); ?>

                                <div class="content-control-bottom pagination-responsive">
                                    <? include(INCLUDES_DIR."/lists/list-pagination.php"); ?>
                                </div>

                            </div>

                            <div class="view-content">
                                <? include(SM_EDIRECTORY_ROOT."/configuration/geography/terms/view-term.php"); ?>
                            </div>
                        <? } else {
                            include(SM_EDIRECTORY_ROOT."/layout/norecords.php");
                        } ?>
                    </div>

                </section>

            </div>

        </div>

    </main>

<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(INCLUDES_DIR."/modals/modal-bulk.php");
include(EDIRECTORY_ROOT."/includes/code/maptuning_forms.php");
include(SM_EDIRECTORY_ROOT . "/layout/footer.php");
