<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-domains.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="sidebar togglepush" id="sidebar" role="navigation">

        <div class="main-sidebar nano">
            <ul class="nav nav-pills nav-stacked  nano-content">

                <li id="navDashboard">
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/"><i class="icon-dashboard5"></i><?=system_showText(LANG_SITEMGR_DASHBOARD);?></a>
                </li>

                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/sites/index.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/sites/"?>"><i class="icon-uniE603"></i><?=system_showText(LANG_SITEMGR_MANAGE_SITES);?></a>
                </li>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/sites/site.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/sites/site.php"?>"><i class="icon-add121"></i><?=system_showText(LANG_SITEMGR_SITES_ADD);?></a>
                </li>
            </ul>
        </div>

    </div>