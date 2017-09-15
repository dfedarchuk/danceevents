<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/transactions/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") {
        header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
        exit;
    }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$_GET  = format_magicQuotes($_GET);
    extract($_GET);
	extract($_POST);

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    $where = "hidden = 'n'";
    include(INCLUDES_DIR."/code/transaction_manage.php");

    // Page Browsing /////////////////////////////////////////
	$pageObj  = new pageBrowsing("Payment_Log", $screen, RESULTS_PER_PAGE, "transaction_datetime DESC, id DESC", "", "", $where);
	$transactions = $pageObj->retrievePage("array");

    $paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions/index.php";

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-activity.php");

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
                include(INCLUDES_DIR."/forms/form-bulkupdate-transaction.php");
                ?>
            </div>
        </div>

        <div class="content-control" id="search-all">

            <div class="row">
                <form role="form" name="searchTop" class="form-inline" role="search" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
                    <div class="col-md-4 col-xs-8 control-search">
                        <div class="control-searchbar">
                            <div class="bulk-check-all">
                                <label class="sr-only">Check all</label>
                                <input type="checkbox" id="check-all">
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control search" name="search_id" value="<?=$search_id?>" onblur="populateField(this.value, 'search_id');" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_TRANSACTIONID);?>">
                                    <div class="input-group-btn">
                                        <!-- Button and dropdown menu -->
                                        <button type="submit" class="btn btn-default"><?=system_showText(LANG_SITEMGR_SEARCH);?></button>
                                        <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="modal" data-target="#modal-search" href="#" >
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-5 col-sm-4 control-responsive">
                    <span class="btn btn-info btn-responsive" data-toggle="dropdown" title="Groups"><i class="icon-ion-ios7-folder-outline"></i></span>
                    <div class="dropdown-menu control-folders">
                        <div class="btn-group btn-group-sm">
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions"?>" class="btn btn-info <?=(string_strpos($_SERVER["PHP_SELF"], "transactions/index.php") !== false ? "active" : "")?>"><?=(system_showText(LANG_SITEMGR_TRANSACTIONS))?></a>
                            <?php if (INVOICEPAYMENT_FEATURE == "on") { ?>
                                <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/invoices/"?>" class="btn btn-info <?=(string_strpos($_SERVER["PHP_SELF"], "/invoices/index.php") !== false ? "active" : "")?>"><?=ucfirst(system_showText(LANG_SITEMGR_INVOICE_PLURAL))?></a>
                            <?php } ?>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/"?>" class="btn btn-info <?=(string_strpos($_SERVER["PHP_SELF"], "/custominvoices/index.php") !== false ? "active" : "")?>"><?=ucfirst(system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL))?></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="content-full">
            <? if ($transactions) { ?>
                <div class="list-content">
                    <? include(INCLUDES_DIR."/lists/list-transactions.php"); ?>

                    <div class="content-control-bottom pagination-responsive">
                        <? include(INCLUDES_DIR."/lists/list-pagination.php"); ?>
                    </div>
                </div>

                <div class="view-content">
                    <? include(SM_EDIRECTORY_ROOT."/activity/transactions/view-transaction.php"); ?>
                </div>

            <? } else {
                include(SM_EDIRECTORY_ROOT."/layout/norecords.php");
            } ?>
        </div>

    </main>

    <?
    include(INCLUDES_DIR."/modals/modal-delete.php");
    include(INCLUDES_DIR."/modals/modal-bulk.php");
    include(INCLUDES_DIR."/modals/modal-search-transaction.php");
    ?>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
