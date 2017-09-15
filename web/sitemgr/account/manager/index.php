<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/account/manager/index.php
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

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager";
	$url_base     = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------	
	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Delete account
        if ($action == "delete") {
            $account = new SMAccount($id);
            $account->delete();
            $message = 4;
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;
        }
	}
    
    //Search (Contact)
    $sql_where = array();
    if ($search_username) {
        $search_term = explode(" ", $search_username);
        $auxWhere = array();
        foreach ($search_term as $term) {
            $auxWhere[] = "username LIKE ".db_formatString('%'.$term.'%');
            $auxWhere[] = "email LIKE ".db_formatString('%'.$term.'%');
            $auxWhere[] = "name LIKE ".db_formatString('%'.$term.'%');
        }
        
        $sql_where[] = implode($auxWhere, " OR ");
    }
    
    $where_clause = implode(" AND ", $sql_where);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	// Page Browsing ////////////////////////////////////////
	$pageObj = new pageBrowsing("SMAccount", $screen, RESULTS_PER_PAGE, "username", "username", $letter, $where_clause, "*", false, false, true);
	$smaccounts = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/index.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-accounts.php");

?> 

        <main class="wrapper-dashboard togglesidebar container-fluid" id="view-content-list">
            
            <?php
            require(SM_EDIRECTORY_ROOT."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?> 

            <div class="content-control">
                <div class="row">
                    <div class="col-md-4 col-sm-8 col-xs-6 control-search">
                        <div class="control-searchbar">
                            <form class="form-inline" name="account" action="<?=system_getFormAction($_SERVER["PHP_SELF"]);?>" role="search" method="get">
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="search_username" value="<?=$search_username?>" class="form-control search hidden-xs" placeholder="<?=system_showText(LANG_SITEMGR_SEARCH_ACC);?>">
                                        <div class="input-group-btn">
                                            <!-- Button -->
                                            <button type="submit" class="btn btn-default hidden-xs"><?=system_showText(LANG_SITEMGR_SEARCH);?></button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-6 control-responsive">
                        <a class="btn btn-primary btn-responsive" title="<?=system_showText(LANG_SITEMGR_ADD_MANAGER);?>" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/manager.php"?>"><i class="icon-cross8"></i></a>
                    </div>

                    <div class="col-md-3 col-sm-12 control-add">
                        <div class="control-bar">
                            <a class="btn btn-sm btn-primary" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/manager.php"?>"><i class="icon-cross8"></i> <?=system_showText(LANG_SITEMGR_ADD_MANAGER);?></a>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="content-full">
                <? if ($smaccounts) { ?>
				<div class="list-content">
	            	<? include(INCLUDES_DIR."/lists/list-managers.php"); ?>
	           
		           	<div class="content-control-bottom pagination-responsive">
		            	<?include(INCLUDES_DIR."/lists/list-pagination.php");?>
		            </div>
	            </div>
	            <div class="view-content">
	            	<? include(SM_EDIRECTORY_ROOT."/account/manager/view-account.php"); ?>
	            </div>
                <? } else {
                    include(SM_EDIRECTORY_ROOT."/layout/norecords.php");
                } ?>
            </div>

        </main>

        <?
        include(INCLUDES_DIR."/modals/modal-delete.php");
        ?>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>