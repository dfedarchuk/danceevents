<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/dashboard/timeline.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/timeline.php");
    
    $dbObj = db_getDBObject(DEFAULT_DB, true);
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);
    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y'";
    $totalNew = mysql_fetch_assoc($dbDomain->query($sql));

    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y' AND item_type = 'listing'";
    $totalNewListing = mysql_fetch_assoc($dbDomain->query($sql));

    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y' AND item_type = 'promotion'";
    $totalNewDeal = mysql_fetch_assoc($dbDomain->query($sql));

    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y' AND item_type = 'banner'";
    $totalNewBanner = mysql_fetch_assoc($dbDomain->query($sql));

    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y' AND item_type = 'event'";
    $totalNewEvent = mysql_fetch_assoc($dbDomain->query($sql));

    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y' AND item_type = 'classified'";
    $totalNewClassified = mysql_fetch_assoc($dbDomain->query($sql));

    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y' AND item_type = 'article'";
    $totalNewArticle = mysql_fetch_assoc($dbDomain->query($sql));

    $sql = "SELECT count(id) AS total FROM Timeline WHERE new = 'y' AND item_type != 'listing' AND item_type != 'promotion' AND item_type != 'banner' AND item_type != 'event' AND item_type != 'classified' AND item_type != 'article'";
    $totalNewGeneral = mysql_fetch_assoc($dbDomain->query($sql));
    
    $sql = "SELECT count(id) AS total FROM Timeline";
    $totalTimeline = mysql_fetch_assoc($dbDomain->query($sql));

?>

    <section class="timeline">
        
        <div class="timeline-control">
            
            <div class="tml-heading">
                <h2><?=system_showText(LANG_SITEMGR_TIMELINE);?>
                    <small><?=$totalNew["total"]?> <?=system_showText(LANG_SITEMGR_TIMELINE_ACTIONS);?></small>
                </h2>
            </div>
            
            <? if (is_array($timeline) || $totalTimeline["total"]) { ?>
            
            <div class="tml-nav">
                <ul class="nav nav-tabs">
                    <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/"?>" data-placement="bottom" title="<?=system_showText(LANG_SITEMGR_TIMELINE_ALL);?>" class="list-group-item <?=(!$where? "active" : "")?>"><?=system_showText(LANG_SITEMGR_ALL);?></a></li>
                    
                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONTENT) || permission_hasSMPermSection(SITEMGR_PERMISSION_ACTIVITY) || permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
                    
                    <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/?where=general"?>" id="t-general" data-placement="bottom" title="<?=system_showText(LANG_SITEMGR_TIMELINE_GENERAL);?>" class="list-group-item <?=($where == "general" ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_GENERAL);?></a></li>
                    
                    <? } ?>
                    
                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONTENT)) { ?>
                    
                        <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/?where=listing"?>" class="list-group-item <?=($where == "listing" ? "active" : "")?>"><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></a></li>

                        <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION) { ?>
                        <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/?where=promotion"?>" id="t-promotion" class="list-group-item <?=($where == "promotion" ? "active" : "")?>"><?=system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL);?></a></li>
                        <? } ?>

                        <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                        <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/?where=banner"?>" id="t-banner" class="list-group-item <?=($where == "banner" ? "active" : "")?>"><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></a></li>
                        <? } ?>

                        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                        <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/?where=event"?>" id="t-event" class="list-group-item <?=($where == "event" ? "active" : "")?>"><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></a></li>
                        <? } ?>

                        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                        <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/?where=classified"?>" id="t-classified" class="list-group-item <?=($where == "classified" ? "active" : "")?>"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></a></li>
                        <? } ?>

                        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                        <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/?where=article"?>" id="t-article" class="list-group-item <?=($where == "article" ? "active" : "")?>"><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></a></li>
                        <? } ?>
                    
                    <? } ?>
                </ul>
            </div>
            
            <? } ?>
            
        </div>
        
        <? if (is_array($timeline)) { ?>
        
        <div class="row timeline-group">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <input type="hidden" id="timeline_total_pages" value="<?=$pageObj->getNumber('pages')?>">
                
                <div class="timelinescroll">                

                    <?
                    foreach ($timeline as $item) if ($item->getNumber("id")) {
                        include(SM_EDIRECTORY_ROOT."/dashboard/timeline-item.php");
                    }
                    ?>
                        
                    <div class="next hidden">
                        <a id="t-next" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/dashboard/timeline-pagination.php?where=$where&screen=2"?>">next</a>
                    </div>

                </div>
            </div>
        </div>
        
        <? } else { ?>
        
        <div class="timeline-empty">
            <h1>Oops,</h1>
            <p><?=system_showText(LANG_SITEMGR_TIMELINE_EMPTY);?></p>
            <p><?=system_showText(LANG_SITEMGR_TIMELINE_EMPTY2);?></p>
        </div>
        
        <? } ?>

    </section>