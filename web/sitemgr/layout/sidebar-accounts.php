<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-accounts.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="sidebar togglepush" id="sidebar" role="navigation">

        <div class="main-sidebar nano">
            <ul class="nav nav-pills nav-stacked nano-content">

                <li id="navDashboard">
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/"><i class="icon-dashboard5"></i><?=system_showText(LANG_SITEMGR_DASHBOARD);?></a>
                </li> 
                
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/account/sponsor/") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/"?>"><i class="icon-briefcase30"></i><?=system_showText(LANG_SITEMGR_ACC_SPONSOR);?></a>
                </li>
                <? if (SOCIALNETWORK_FEATURE == "on") { ?>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/account/visitor/") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/visitor/"?>"><i class="icon-profile11"></i><?=system_showText(LANG_SITEMGR_ACC_VISITOR);?></a>
                </li>
                <? } ?>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/account/manager/") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/"?>"><i class="icon-ion-ios7-locked-outline"></i><?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS);?></a>
                </li>
                <? } ?>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/account/myaccount.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/myaccount.php"?>"><i class="icon-male80"></i><?=system_showText(LANG_MENU_ACCOUNT);?></a>
                </li>
            </ul>
        </div>

    </div>