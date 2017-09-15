<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-mobile.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="sidebar sidebar-ext togglepush" id="sidebar" role="navigation">

        <div class="short-sidebar">
            <?php
            /* General Sidebar*/
            include(SM_EDIRECTORY_ROOT."/layout/sidebar-general.php");
            ?>
        </div>
        <div class="second-sidebar">
            <h1><?=system_showText(LANG_SITEMGR_MOBILE_APPS);?></h1>
            <p><?=system_showText(LANG_SITEMGR_MOBILE_APPS_TIP);?></p>
            <div class="navigation nano">
                <div class="list-group nano-content">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/mobile/appbuilder") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_BUILD_YOUR_APP);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/about/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/mobile/about") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_CONFIGURE_ABOUT_PAGE);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/custompages/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/mobile/custompages") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_CUSTOMPAGES);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/menu/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/mobile/menu") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_CONFIGURE_MENU);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/slider/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/mobile/slider") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_NAVBAR_SLIDER);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/promote-apps/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/mobile/promote-apps") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_PROMOTE_APPS);?></a>
                </div>
            </div>
        </div>

    </div>
