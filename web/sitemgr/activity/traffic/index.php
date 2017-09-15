<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/traffic/index.php
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-activity.php");

?> 


    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading row">
            <h1><?=system_showText(LANG_SITEMGR_TRAFFIC)?></h1>
            <p><?=system_showText(LANG_SITEMGR_TRAFFIC_TITLE);?></p>
        </section>

        <section class="well well-intro">
            <div class="row">
                <div class="col-sm-1 col-xs-3 text-center ">
                    <i class="icon-uniE604"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_REPORTS)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_TRAFFIC_1);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/reports/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_REPORTS)?></a>
                </div>
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-paper27"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_LEADS)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_TRAFFIC_2);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/leads/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_LEADS)?></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-ion-ios7-star-outline"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?= ucfirst(system_showText(LANG_SITEMGR_REVIEWS)) ?></h2>
                    <p><?=system_showText(LANG_SITEMGR_TRAFFIC_3);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/reviews-comments/"?>" class="btn btn-info"><?= ucfirst(system_showText(LANG_SITEMGR_REVIEWS)) ?></a>
                </div>
                <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
                <div class="col-sm-1 col-xs-3 text-center">
                    <i class="icon-line31"></i>
                </div>
                <div class="col-sm-5 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_REVENUE_REPORTS)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_TRAFFIC_4);?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_REVENUE_REPORTS)?></a>
                </div>
                <? } ?>
            </div>
        </section>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>