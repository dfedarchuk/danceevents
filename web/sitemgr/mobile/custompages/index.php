<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/mobile/custompages/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
  	require_once(CLASSES_DIR."/class_AppCustomPage.php");

 	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();
        
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        if ( DEMO_LIVE_MODE )
        {
            AppCustomPage::HandleDemoPost();
        }
        else
        {
            AppCustomPage::HandlePost();
        }
    }

    setting_get("sitemgr_language", $sirTrevorLanguage);

    $sirTrevorLanguageFile = SM_EDIRECTORY_ROOT."/assets/js/sir-trevor/locales/".$sirTrevorLanguage.".js";

    file_exists( $sirTrevorLanguageFile ) or $sirTrevorLanguage = "en_us";

    $sirTrevorLanguageURL = DEFAULT_URL."/".SITEMGR_ALIAS."/assets/js/sir-trevor/locales/{$sirTrevorLanguage}.js";

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    
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
    <link href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/style/plugins/jquery.openCarousel.css" rel="stylesheet" type="text/css">

    <main class="wrapper togglesidebar container-fluid appbuilder-wrap">

        <section class="row heading">
            <div class="container">
                <h1><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_TITLE);?></h1>

                <p class="subheading"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_SUBHEADING1);?> <?=system_showText(LANG_SITEMGR_CUSTOMPAGES_SUBHEADING2);?></p>
                <p class="subheading"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_SUBHEADING3);?></p>
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
                    <div id="messagebox"> </div>

                    <div class="hidden-sm hidden-xs">
                    <form id="custompageform">
                        <div class="form-left">
                            <h4><?=system_showText(LANG_SITEMGR_PAGE_PREVIEW);?></h4>
                            <p><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_PREVIEW_TEXT);?></p>

                            <div id="device-apple" class="cover-preview-image device-apple">
                                
                                <div class="about-preview-image custompage-preview">
                                    <span class="lang-aboutus custom-page-name"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_PREVIEW_NAME_EMPTY);?></span>
                                    <div class="custom-page-items">
                                        <div class="custom-item-general"><?= system_showText(LANG_SITEMGR_CUSTOMPAGES_EMPTY) ?></div>
                                    </div>    
                                </div>
                                
                                <div class="change-device">
                                    <a class="icon-device-apple active" href="javascript:void(0);"></a>
                                    <a class="icon-device-android" href="javascript:void(0);"></a>
                                </div>
                                
                            </div>
                            
                            <div id="device-android" class="cover-preview-image device-android" style="display:none;">
                                
                                <div class="about-preview-image custompage-preview">
                                    <span class="lang-aboutus custom-page-name"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_PREVIEW_NAME_EMPTY);?></span>
                                    <div class="custom-page-items">
                                        <div class="custom-item-general"><?= system_showText(LANG_SITEMGR_CUSTOMPAGES_EMPTY); ?></div>
                                    </div>    
                                </div>
                                
                                <div class="change-device">
                                    <a class="icon-device-apple" href="javascript:void(0);"></a>
                                    <a class="icon-device-android active" href="javascript:void(0);"></a>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="form-right" id="form-cpages">
                            <div class="row cpages-navigation">
                                <ul class="cpages">
                                    <li class="cpage-new"><a href="" alt="Create a custom page"><span class="cpage-icon icon-add121"></span><span class="cpage-name"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_ADD_BUTTON);?></span></li></a>
                                </ul>
                                <?/* The custom page carousel will be printed here */?>

                            </div>
                            <div class="row cpage-content">
                                <div class="row">
                                    <div class="cpage-icon">
                                        <a href="#" id="pageiconimage"> <i class="icon-light33"></i></a>
                                        <span class="icon-bold12"></span>
                                    </div>
                                    <div class="cpage-name form-group">
                                        <label for="title"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_NAME);?></label>
                                        <input type="hidden"   id="pageid" name="pageid">
                                        <input type="hidden"   id="icon" name="icon" value="ic_Design_Paper">
                                        <input type="text"     id="title" class="form-control" name="title">

                                    </div>
                                    <div class="c-page-remove">
                                        <button type="button" class='btn btn-primary btn-sm form-tip cpaddtomenubutton' data-toggle="tooltip" data-original-title="<?=system_showText(LANG_SITEMGR_CUSTOMPAGES_ADDTOMENU_TIP);?>"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_ADDTOMENU)?> </button>
                                        <button class='btn btn-danger btn-sm cpdeletebutton' style="display: none;"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_REMOVE)?></button>
                                        <button class="btn btn-success btn-sm cpsavebutton"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_ADD);?></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="plugin-sir-trevor">
                                        <textarea class="js-st-instance" id="json" name="json" id="savebutton"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="c-page-remove" id="bottommenu" style="display:none">
                                        <button class='btn btn-danger btn-sm cpdeletebutton' style="display: none;"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_REMOVE)?></button>
                                        <button class="btn btn-success btn-sm cpsavebutton"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES_ADD);?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    </div>

                    <div class="visible-sm visible-xs">
                        <div class="alert alert-danger"><?=system_showText(LANG_SITEMGR_NOT_RESPONSIVE)?></div>
                    </div>

                    <div class="action">
                        <button id="nextbutton" type="button" class="btn btn-primary"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>

                </section>
                
            </div>

        </section>
        
    </main>


<?
    include(INCLUDES_DIR."/modals/modal-confirm.php");
    include(INCLUDES_DIR."/modals/modal-iconselect.php");
    
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/appbuilder.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>