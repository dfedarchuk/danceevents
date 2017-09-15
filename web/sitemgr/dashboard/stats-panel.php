<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/dashboard/stats-panel.php
	# ----------------------------------------------------------------------------------------------------

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    /*
     * Total Listings
     */
    $sql = "SELECT count(id) AS total FROM Listing";
    $totalListing = mysql_fetch_assoc($dbObj->query($sql));
    
    /*
     * Total Reviews
     */
    setting_get("review_listing_enabled", $review_listing_enabled);
    setting_get("review_article_enabled", $review_article_enabled);
    if ($review_listing_enabled == "on" || $review_article_enabled == "on") {
        $sql = "SELECT count(id) AS total FROM Review";
        $totalReview = mysql_fetch_assoc($dbObj->query($sql));
    }
    
    /*
     * Total Revenue
     */
    $revenue = system_getRevenue(true);
    $auxRevenue = explode(".", $revenue["total"]);
    
    /*
     * Total Sponsors
     */
    $sql = "SELECT count(id) AS total FROM Account WHERE is_sponsor = 'y'";
    $totalSponsor = mysql_fetch_assoc($dbMain->query($sql));

?>
    <section class="row panels">
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONTENT)) { ?>
        <div class="col-sm-6 col-lg-3 col-xs-6">
            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/"?>" data-placement="bottom" title="<?=$totalListing["total"]." ".system_showText(LANG_LISTING_FEATURE_NAME_PLURAL)?>" class="panel panel-primary panel-stats">
                <div class="panel-heading"><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></div>
                <div class="panel-body">
                    <em><?=$totalListing["total"]?></em> <i class="icon-ion-ios7-bookmarks-outline pull-right hidden-xs"></i>
                </div>
            </a>
        </div>
        <? } ?>
        
        <? if (($review_listing_enabled == "on" || $review_article_enabled == "on") && permission_hasSMPermSection(SITEMGR_PERMISSION_ACTIVITY)) { ?>
        <div class="col-sm-6 col-lg-3 col-xs-6">
            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/reviews-comments/"?>" data-placement="bottom" title="<?=$totalReview["total"]." ".system_showText(LANG_REVIEW_PLURAL)?>" class="panel panel-info panel-stats">
                <div class="panel-heading"><?=system_showText(LANG_REVIEW_PLURAL);?></div>
                <div class="panel-body">
                    <em><?=$totalReview["total"]?></em><i class="icon-chat16 pull-right hidden-xs"></i>
                </div>
            </a>
        </div>
        <? } ?>
        
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACTIVITY)) { ?>
        <div class="col-sm-6 col-lg-3 col-xs-6">
            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions/"?>" data-placement="bottom" title="<?=CURRENCY_SYMBOL.$revenue["total"]." ".system_showText(LANG_SITEMGR_TOTALREVENUE)?>" class="panel panel-primary panel-stats">
                <div class="panel-heading"><?=system_showText(LANG_SITEMGR_REVENUE)?></div>
                <div class="panel-body">
                    <em><?=CURRENCY_SYMBOL.$auxRevenue[0];?>.</em><small><?=$auxRevenue[1]?></small>
                </div>
            </a>
        </div>
        <? } ?>
        
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
        <div class="col-sm-6 col-lg-3 col-xs-6">
            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/"?>" data-placement="bottom" title="<?=$totalSponsor["total"]." ".system_showText(LANG_SITEMGR_MEMBERS)?>" class="panel panel-info panel-stats">
                <div class="panel-heading"><?=system_showText(LANG_SITEMGR_MEMBERS);?></div>
                <div class="panel-body">
                    <em><?=$totalSponsor["total"];?></em> <i class="icon-ion-ios7-people-outline pull-right hidden-xs"></i>
                </div>
            </a>
        </div>
        <? } ?>
        
    </section>