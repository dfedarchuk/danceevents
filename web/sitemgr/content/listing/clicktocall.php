<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/listing/clicktocall.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
    
    $url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER;
    $url_base 	  = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
    $sitemgr 	  = 1;
    
    $errorPage = "$url_redirect/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";

    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (TWILIO_APP_ENABLED != "on" || TWILIO_APP_ENABLED_CALL != "on"){
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}
    
    if ($id) {
		$levelObj = new ListingLevel();
		$listing = new Listing($id);
        $accId = $listing->getNumber("account_id");
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		$listingHasClickToCall = $levelObj->getHasCall($listing->getNumber("level"));
		if ((!$listingHasClickToCall) || ($listingHasClickToCall != "y")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/clicktocall.php");
    
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

        <form role="form" name="clicktocall_form" id="clicktocall_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					
            <input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
            <input type="hidden" name="id" id="id" value="<?=$id?>" />						
            <input type="hidden" name="item_title" id="item_title" value="<?=$item_title?>" />						
            <input type="hidden" name="module" id="module" value="<?=$module?>" />						
            <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />
            <input type="hidden" name="action_clicktocall" id="action_clicktocall" value="addCallerID" />
            
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

                    <div class="pull-right top-actions">
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                        <button type="button" name="check_button" value="validate" class="btn btn-primary action-save <?=!$enableSave ? "disabled" : ""?>" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" <?=!$enableSave ? "disabled=\"disabled\"" : "onclick=\"changeSendForm('checkClickToCall');\""?>><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="container">
                            <? include(INCLUDES_DIR."/forms/form-listing-twilio.php"); ?>
                        </div>
                    </div>
                </div>
                
            </section>
            
            <section class="row footer-action">
                
           		<div class="container">
	           		<div class="col-xs-12 text-right">
		           		<a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                        <button type="button" name="check_button" value="validate" class="btn btn-primary action-save <?=!$enableSave ? "disabled" : ""?>" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" <?=!$enableSave ? "disabled=\"disabled\"" : "onclick=\"changeSendForm('checkClickToCall');\""?>><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
					</div>
				</div>
                
            </section>
            
        </form>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>