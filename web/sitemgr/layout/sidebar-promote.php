<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-promote.php
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
            <h1><?=system_showText(LANG_SITEMGR_PROMOTE);?></h1>
            <p><?=system_showText(LANG_SITEMGR_PROMOTE_TIP);?></p>
            <div class="navigation nano">
                <div class="list-group nano-content">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/helpme/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/promote/helpme") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_PROMOTE_HELP);?></a>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/seo-center/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/promote/seo-center") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER);?></a>
                    <? if (MAIL_APP_FEATURE == "on") { ?>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/newsletter/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/promote/newsletter") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTER_SING);?></a>
                    <? } ?>
                    <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/promotions/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/promote/promotions") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_PROMO_PACK);?></a>
                    <? } ?>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/awards/"?>" class="list-group-item <?=(string_strpos($_SERVER["PHP_SELF"], "/promote/awards") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_AWARD_BADGE);?></a>
                </div>
            </div>
        </div>

    </div>