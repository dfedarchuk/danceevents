<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-design.php
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
            <h1><?=system_showText(LANG_SITEMGR_DESIGN_CUSTOM);?></h1>
            <p><?=system_showText(LANG_SITEMGR_DESIGN_CUSTOM_TIP);?></p>
            <div class="navigation nano">
                <div class="list-group nano-content">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/page-editor/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/design/page-editor/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_PAGE_EDITOR);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/themes/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/design/themes/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_MENU_THEMES);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/colors-fonts/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/design/colors-fonts/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_COLORS_FONTS);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/css-editor/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/design/css-editor/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_CSS_EDITOR);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/email-editor/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/design/email-editor") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_EMAIL_EDITOR);?></a>
                </div>
            </div>
        </div>

    </div>
