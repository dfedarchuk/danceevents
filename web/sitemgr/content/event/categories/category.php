<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/event/categories/category.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/categories";
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
	$table_category = "EventCategory";
	include(INCLUDES_DIR."/code/category.php");
    
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
        ?>

        <form role="form" name="category" id="category" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

            <input type="hidden" id="id" name="id" value="<?=$id?>" />
            <input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
            <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />
            
            <section class="row heading">
	           	<div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <? if ($id) { ?>
        	           		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))." ".ucwords(system_showText(LANG_SITEMGR_CATEGORY))?> <i><?=$category->getString("title")?></i></h1>
                            <? } else { ?>
                            <h1><?=string_ucwords(system_showText(LANG_SITEMGR_ADD))." ".ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></h1>
                            <? } ?>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-right top-actions">
                                <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/categories/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                                <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                                <button type="submit" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                            </div>
                        </div>
                    </div>
                    <? if ($message_category) { ?>
                    <div class="alert alert-warning" role="alert">
                        <p><?=$message_category;?></p>
                    </div>
                    <? } ?>
                </div>
            </section>
			
			<section class="row section-form">
                <div class="container">
                    <? include(INCLUDES_DIR."/forms/form-category.php"); ?>
                </div>
            </section>
            
            <section class="row footer-action">
                
           		<div class="container">
	           		<div class="col-xs-12 text-right">
		           		<a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/categories/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                        <button type="submit" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
					</div>
				</div>
                
            </section>
            
        </form>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/category.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>