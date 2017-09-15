<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/leads/index.php
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

	$url_redirect = DEFAULT_URL."/".SITEMGR_ALIAS."/activity/leads";
	$url_base     = DEFAULT_URL."/".SITEMGR_ALIAS;

	extract($_GET);
	extract($_POST);
    
    if (!$item_type) {
        $item_type = "listing";
    }

	if ($item_type == "classified") {
        if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") {
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
            exit;
        }
    } elseif ($item_type == "event") {

        if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") {
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
            exit;
        }

    }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/lead.php");
	
	if (!$itemObj) {
    	if ($item_type == "listing") {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == "classified") {
    	    $itemObj = new Classified($item_id);
    	} else if ($item_type == "event") {
    	    $itemObj = new Event($item_id);
    	}
    }

	// Page Browsing /////////////////////////////////////////
    if (is_numeric($search_id))  $sql_where[] = " id = ".db_formatNumber($search_id);
	if ($item_id) 				 $sql_where[] = " type = '$item_type' AND item_id = '$item_id' ";
	if ($item_type && !$item_id) $sql_where[] = " type = '$item_type'";

	if ($sql_where) {
		$where .= " ".implode(" AND ", $sql_where)." ";
    }
    
	$pageObj  = new pageBrowsing("Leads", $screen, RESULTS_PER_PAGE, "entered DESC", "first_name", $letter, $where);
	$leadsArr = $pageObj->retrievePage("array");
    
	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/activity/leads/index.php?item_type=$item_type&item_id=$item_id&item_screen=$item_screen&item_letter=$item_letter";
    
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

    <main class="wrapper togglesidebar container-fluid">        

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <div class="container">
                <h1><?=LANG_MANAGE_LEADS?></h1>
            </div>
        </section>

        <div class="row tab-options">
            <ul role="tablist" class="nav nav-tabs">

                <li class="<?=($item_type == "listing" ? "active" : "")?>">
                    <a href="<?=$url_redirect?>/" role="tab"><?=system_showText(LANG_SITEMGR_LISTING_LEADS)?></a>
                </li>

                <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                <li class="<?=($item_type == "event" ? "active" : "")?>">
                    <a href="<?=$url_redirect?>/?item_type=event" role="tab"><?=system_showText(LANG_SITEMGR_EVENT_LEADS)?></a>
                </li>
                <? } ?>

                <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                <li class="<?=($item_type == "classified" ? "active" : "")?>">
                    <a href="<?=$url_redirect?>/?item_type=classified" role="tab"><?=system_showText(LANG_SITEMGR_CLASSIFIED_LEADS)?></a>
                </li>
                <? } ?>

                <li class="<?=($item_type == "general" ? "active" : "")?>">
                    <a href="<?=$url_redirect?>/?item_type=general" role="tab"><?=system_showText(LANG_SITEMGR_GENERAL_LEADS)?></a>
                </li>
            </ul>

            <div class="row tab-content">

                <section class="tab-pane active">
                    <div class="col-sm-12">
                        <? if ($leadsArr) { ?>
                            <div class="panel panel-default">

                                <? include(INCLUDES_DIR."/tables/table_lead.php"); ?>

                                <div class="content-control-bottom pagination-responsive">
                                    <? include(INCLUDES_DIR."/lists/list-pagination.php"); ?>
                                </div>
                            </div>
                        <? } else { ?>
                            <p class="alert alert-warning"><?=system_showText(LANG_NORECORD)?></p>
                        <? } ?>
                    </div>
                </section>
                
                <div style="display:none">
                    <form name="Lead_post" id="Lead_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="hiddenValue">
                        <input type="hidden" name="item_id" value="<?=$item_id;?>" />
                        <input type="hidden" name="item_type" value="<?=$item_type;?>" />
                        <input type="hidden" name="screen" value="<?=$screen;?>" /> 
                        <input type="hidden" name="letter" value="<?=$letter;?>" />
                    </form>
                </div>

            </div>

        </div>

    </main>

    <? include(INCLUDES_DIR."/modals/modal-delete.php"); ?>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/lead.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>