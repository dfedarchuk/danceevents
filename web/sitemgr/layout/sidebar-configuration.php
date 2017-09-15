<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-configuration.php
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
            <h1><?=system_showText(LANG_SITEMGR_CONFIG);?></h1>
            <p><?=system_showText(LANG_SITEMGR_CONFIG_TIP);?></p>
            <div class="navigation nano">
                <div class="list-group nano-content">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/basic-information/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/basic-information") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_BASIC_INFO);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/general-settings/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/general-settings") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_GENERAL_SETTINGS);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/email/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/email") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/networking/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/networking") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_NETWORKING);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/geography") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_TIME_GEO);?></a>
                    <? if (PAYMENTSYSTEM_FEATURE == "on") { ?>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/payment/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/payment") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_LEVELS_TAB);?></a>
                    <? } ?>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/google/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/google") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_INTEGRATION_GOOGLE);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/twilio/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/configuration/twilio") !== false ? "active" : "")?>"><?=system_showText(LANG_LABEL_CLICKTOCALL);?></a>
                </div>
            </div>
        </div>

    </div>
