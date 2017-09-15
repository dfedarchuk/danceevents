<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/import_settings.php");
    
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

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_DATATOOL);?></h1>
            <p><?=system_showText(LANG_SITEMGR_DATACONTENT_TIP_1);?></p>
            <p><?=system_showText(LANG_SITEMGR_DATACONTENT_TIP_2);?></p>
        </section>

        <div class="tab-options">
            <ul role="tablist" class="row nav nav-tabs">
                <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/index.php"?>"><?=system_showText(LANG_SITEMGR_IMPORT_TOOL);?></a></li>
                <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/export.php"?>"><?=system_showText(LANG_SITEMGR_EXPORT_TOOL);?></a></li>
                <li class="active"><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/settings.php"?>"><?=system_showText(LANG_SITEMGR_LABEL_SETTINGS);?></a></li>
            </ul>

            <div class="row tab-content">
                <div class="col-sm-12">
                <section class="tab-pane active">

                    <form name="importsettings" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <? include(INCLUDES_DIR."/forms/form-datacenter-settings.php"); ?>     				
                    </form>

                </section>
                </div>
            </div>
        </div>
        
    </main>

<?php
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/import.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>