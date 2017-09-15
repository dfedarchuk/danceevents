<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-activity.php
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
            <h1><?=system_showText(LANG_SITEMGR_ACTIVITY);?></h1>
            <p><?=system_showText(LANG_SITEMGR_ACTIVITY_TIP);?></p>
            <div class="navigation nano">
                <div class="list-group nano-content">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/traffic/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/activity/traffic/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_TRAFFIC);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/reports/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/activity/reports/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_REPORTS);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/leads/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/activity/leads/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_LEADS);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/reviews-comments/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/activity/reviews-comments/") !== false ? "active" : "")?>"><?= ucfirst(system_showText(LANG_SITEMGR_REVIEWS)) ?></a>
                    <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/transactions/") !== false || string_strpos($_SERVER["PHP_SELF"], "/invoices/") !== false  || string_strpos($_SERVER["PHP_SELF"], "/custominvoices/") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_REVENUE_REPORTS);?></a>
                    <? } ?>
                </div>
            </div>
        </div>

    </div>