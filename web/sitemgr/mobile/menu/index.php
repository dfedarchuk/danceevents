<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/mobile/menu/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
    include_once(CLASSES_DIR."/class_AppCustomPage.php");

 	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();
        
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $appBuilder = true;
	include(INCLUDES_DIR."/code/navigation.php");
    
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
    include(SM_EDIRECTORY_ROOT."/layout/sidebar-mobile.php");

?>
    	
    <main class="wrapper togglesidebar container-fluid">

        <section class="row heading">
            <div class="container">
                <h1><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_6);?></h1>
                <p><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_6_MESSAGE)?> <?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_6_MESSAGE_CONT)?> <?=system_showText(LANG_SITEMGR_CONFIGURE_UPDATE_TIP)?></p>
                <? if ($errorMessage) { ?>
                    <p class="alert alert-warning" id="auxErrorMessage2"><?=$errorMessage?></p>
                <? } elseif ($successMessage == 1) { ?>
                    <p class="alert alert-success" id="successMessage"><?=system_showText(LANG_SITEMGR_MENU_SUCCESS);?></p>
                <? } ?>
                <p class="alert alert-warning" id="auxErrorMessage" style="display:none"></p>
            </div>
        </section>

        <section class="row appbuilder">
            <div class="appbuilder-container">
            
                <?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                ?>

                <section class="container">
                    <div id="aux_litext" style="display: none;"><?=$aux_LI_code?></div>
                    
    				<form id="form_menu" name="form_menu" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        
                        <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>">
                        <input type="hidden" name="order_options" id="order_options" value="" />
                        <input type="hidden" name="aux_count_li" id="aux_count_li" value="<?=count($arrayOptions)?>" />
                        <input type="hidden" name="SaveByAjax" value="true" id="SaveByAjax" value=""/>
                        <input type="hidden" name="limitItems" id="limitItems" value="<?=$limitItems;?>"/>
                        <input type="hidden" name="limitPreview" id="limitPreview" value="<?=$limitPreview;?>"/>
                        <input type="hidden" name="navigation_area" value="tabbar" />
                        <input type="hidden" name="tab_selected" id="tab_selected" value="apple" />
    					
                        <div class="hidden-sm hidden-xs">                   
                            <? include(INCLUDES_DIR."/forms/form-navigation-app.php"); ?>
                        </div> 

                        <div class="visible-sm visible-xs">                   
                            <div class="alert alert-danger"><?=system_showText(LANG_SITEMGR_NOT_RESPONSIVE)?></div>
                        </div> 

                        <div class="action">
    						<button type="button" class="btn btn-primary" onclick="NextStep(true);"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
    					</div>

    				</form>
                    
                    <form id="reset_navigation" name="reset_navigation" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="resetNavigation" value="reset" />
                        <input type="hidden" name="area" value="tabbar" />
                    </form>

                </section>
                
            </div>

        </section>
        
    </main>
	
<?
    include(INCLUDES_DIR."/modals/modal-confirm.php");
    
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/appbuilder.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>