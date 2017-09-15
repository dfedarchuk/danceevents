<?
    /*
     * # Admin Panel for eDirectory
     * @copyright Copyright 2014 Arca Solutions, Inc.
     * @author Basecode - Arca Solutions, Inc.
     */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /ed-admin/activity/review-comments/index.php
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

    $url_redirect = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/activity/reviews-comments";
    $url_base = DEFAULT_URL . "/" . SITEMGR_ALIAS . "";

    extract($_GET);
    extract($_POST);

    $manageModule = "review";

    if ($item_type == "article") {
        if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") {
            header("Location: " . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/");
            exit;
        }
    }

    //Delete
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($action == "delete" && $id && $item_type) {

            //Delete Review
            $reviewObj = new Review($id);
            $reviewObj->delete();

            $avg = $reviewObj->getRateAvgByItem($item_type, $item_id);
            if (!is_numeric($avg))
                $avg = 0;

            if ($item_type == "listing") {
                $listing = new Listing();
                $listing->setAvgReview($avg, $item_id);
            } else if ($item_type == "article") {
                $articles = new Article();
                $articles->setAvgReview($avg, $item_id);
            }

            $message = 2;
            header("Location: " . $url_redirect . "/index.php?reply_id=$is_reply&message=" . $message . "&item_type=$item_type&screen=$screen&letter=$letter");
            exit;
        }
    }

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    $tableActivity = "Review";
    $tableActivityLetter = "review_title";
    $tableActivityOrder = "approved, added DESC";
    if (!$itemObj) {
        switch ($item_type){
            case "listing":
                $itemObj = new Listing($item_id);
                break;
            case "article":
                $itemObj = new Article($item_id);
                break;
        }
    }

    // Page Browsing /////////////////////////////////////////
    if ($item_type) {
        $sql_where[] = " item_type = '$item_type'";
        if ($item_id) {
            $sql_where[] = " item_id = '$item_id' ";
        }
    }
    if (isset($search_status)){
        $sql_where[] = " approved = " . (int)$search_status;
    }

    if ($search_id) {
        $sql_where[] = " id = " . db_formatNumber($search_id);
    }

    if ($sql_where) {
        $where .= " " . implode(" AND ", $sql_where) . " ";
    }

    $pageObj = new pageBrowsing($tableActivity, $screen, RESULTS_PER_PAGE, $tableActivityOrder, $tableActivityLetter, $letter, $where);
    $reviewsArr = $pageObj->retrievePage("object");

    $paging_url = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/activity/reviews-comments/index.php?item_type=$item_type&item_id=$item_id&reply_id=$reply_id";

    $msgArray = $msg_review;

    # ----------------------------------------------------------------------------------------------------
    # BULK UPDATE
    # ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/bulkupdate.php");

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT . "/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT . "/layout/navbar.php");

    # ----------------------------------------------------------------------------------------------------
    # SIDEBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT . "/layout/sidebar-activity.php");
    ?>


    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT . "/registration.php");
        require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
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
            <? if ($reviewsArr) { ?>
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
    ?>

    <?php
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT . "/assets/custom-js/review.php";
    include(SM_EDIRECTORY_ROOT . "/layout/footer.php");
    ?>
