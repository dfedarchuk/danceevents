<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/promote/helpme/index.php
	# ----------------------------------------------------------------------------------------------------
    
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();
    
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-promote.php");

?> 

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading row">
            <h1><?=system_showText(LANG_SITEMGR_PROMOTE_HELP)?></h1>
            <p><?=system_showText(LANG_SITEMGR_PROMOTE_TITLE);?></p>
        </section>

        <section class="well well-intro">
            <div class="row">
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-document50"></i>
                </div>
                <div class="col-sm-11 col-xs-9">
                    <h2>Whitepapers</h2>
                    <p><?=system_showText(LANG_SITEMGR_PROMOTE_1);?></p>
                    <a href="http://www.<?=$sitemgr_language == "pt_br" ? "edirectory.com.br/recursos-guia/" : "edirectory.com/directory-resources/"?>" target="_blank" class="btn btn-info"><?=system_showText(LANG_SITEMGR_PROMOTE_6);?></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-ion-ios7-search-strong"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_PROMOTE_2);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/seo-center/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?></a>
                </div>
                <? if (MAIL_APP_FEATURE == "on") { ?>
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-paper113"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTERS)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_PROMOTE_3);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/newsletter/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTERS)?></a>
                </div>
                <? } ?>
            </div>
            <div class="row">
                <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-cent1"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_PROMO_PACK)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_PROMOTE_5);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/promotions/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_PROMO_PACK)?></a>
                </div>
                <? } ?>
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-medal41"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_AWARD_BADGE)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_PROMOTE_4);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/awards/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_AWARD_BADGE)?></a>
                </div>
            </div>
        </section>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>