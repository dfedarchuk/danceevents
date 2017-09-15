<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/listing/deal.php
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

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing_promotion.php");
    $levelObj = $level = new ListingLevel($listing->getNumber("level"));
    
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

        $listingObj = new Listing($id);
        $levelDealObj = $listingObj->getLevel($id);
        $account_id = $listingObj->getNumber("account_id");

        $levelObj = new ListingLevel();
        $limit = $levelObj->getDeals($levelDealObj);

        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        
        if ($id) {
            $arrayCompletion = system_gamefyItems("listing", $listing);
        ?>
        
        <div class="row">
            <div class="progress">
                <div class="progress-bar" data-placement="bottom" data-toggle="tooltip" data-original-title="<?=$arrayCompletion["total"]?>% <?=ucfirst(LANG_LABEL_COMPLETED)?>" role="progressbar" aria-valuenow="<?=$arrayCompletion["total"]?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$arrayCompletion["total"]?>%;">
                    <span class="sr-only"><?=$arrayCompletion["total"]?>% <?=ucfirst(LANG_LABEL_COMPLETED)?></span>
                </div>
			</div>
		</div>
        
        <? } ?>

        <form role="form" name="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?=$id?>" />
            <input type="hidden" name="promotion_id" id="promotion_id" value="<?=$promotion_id?>" />
            <input type="hidden" name="listing_id" value="<?=$listing_id?>">
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />
            <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
            
            <section class="row heading">
                
	           	<div class="container">
                    <div class="col-sm-8">
                        <? if ($id) { ?>
    	           		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))." ".system_showText(LANG_SITEMGR_LISTING_SING)?> <i><?=$listing->getString("title")?></i></h1>
                        <? } else { ?>
                        <h1><?=string_ucwords(system_showText(LANG_SITEMGR_ADD))." ".system_showText(LANG_SITEMGR_LISTING_SING)?></h1>
                        <? } ?>
                    </div>
				</div>
         
            </section>
			
			<section class="row tab-options">
            		
                <div class="container">
                    <? include(SM_EDIRECTORY_ROOT."/layout/nav-tabs-content-listing.php"); ?>

                    <? if (CUSTOM_PROMOTION_FEATURE == "on") { ?>
                    <div class="pull-right top-actions">
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                        <button type="submit" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                    <? } ?>
                </div>

                <? if (CUSTOM_PROMOTION_FEATURE == "on") { ?>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="container">
                            <? include(INCLUDES_DIR."/forms/form-listing-promotion.php"); ?>
                        </div>
                    </div>
                </div>
                <? } ?>
                
            </section>
            
            <? if (CUSTOM_PROMOTION_FEATURE == "on") { ?>
            <section class="row footer-action">
                
           		<div class="container">
	           		<div class="col-xs-12 text-right">
		           		<a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                        <button type="submit" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
					</div>
				</div>
                
            </section>
            <? } else { ?>
                <p class="alert alert-info"><?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?></p>
            <? } ?>
            
        </form>

        <form id="formlistingpromotioncancel" action="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />
            <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
        </form>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>