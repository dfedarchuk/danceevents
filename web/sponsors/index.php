<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /sponsors/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

    extract($_GET);
    extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT - DELETE ITEMS
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($hiddenValue) { //Delete
            $id = intval($hiddenValue);

            switch ($module) {
                case "banner" :
                    $itemObj = new Banner($id);
                    $message = 0;
                    break;
                case "article" :
                    $itemObj = new Article($id);
                    $message = 2;
                    break;
                case "classified" :
                    $itemObj = new Classified($id);
                    $message = 2;
                    break;
                case "event" :
                    $itemObj = new Event($id);
                    $message = 2;
                    break;
                case "promotion" :
                    $itemObj = new Promotion($id);
                    $message = 4;
                    break;
                break;
            }

            if (sess_getAccountIdFromSession() != $itemObj->getNumber("account_id")) {
                header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
                exit;
            }

            $itemObj->delete();

            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/index.php?&module=$module&message=$message");
            exit;

        }

    }

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	/*
	 * Get sponsor's items
	 */
    $acctId = sess_getAccountIdFromSession();
    $sponsorItems = array();
    $status = new ItemStatus();
    $arrayForms = array();

    //Listings
    $sql = "SELECT id, level, title, status, friendly_url FROM Listing WHERE account_id = $acctId ORDER BY level, title";
    $listings = db_getFromDBBySQL("listing", $sql, "array", false, SELECTED_DOMAIN_ID);
    $level = new ListingLevel(true);
    $levelValues = $level->getLevelValues();
    $levelDefault = $level->getLevel($level->getDefaultLevel());
    $activeLevels = array();
    foreach ($levelValues as $levelValue) {
        if ($level->getActive($levelValue) == 'y') {
            $activeLevels[] = $levelValue;
        }
    }

    foreach ($listings as $listing) {
        $item = array();
        $item["module"] = "listing";
        $listingObj = new Listing();
        $item["label"] = system_showText(LANG_LISTING_FEATURE_NAME);
        $item["level"] = "(".(in_array($listing["level"], $activeLevels) ? $level->showLevel($listing["level"]) : string_ucwords($levelDefault)).")";
        $item["status"] = $listing["status"];
        $item["status_label"] = $status->getStatus($listing["status"]);
        $item["status_style"] = $status->getStatusWithStyle($listing["status"]);
        $item["title"] = $listing["title"];
        $item["id"] = $listing["id"];
        $listingCountDeals = $listingObj->countDeals($item['id']);
        $limitDeals= $level->getDeals($listing["level"]);
        if ( $limitDeals > 0 && $limitDeals > $listingCountDeals  && PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {
            $item["link_promotion"] = DEFAULT_URL."/".MEMBERS_ALIAS."/".PROMOTION_FEATURE_FOLDER."/deal.php?listing_id=".$listing["id"];
        }
        $item["link_edit"] = DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listing.php?id=".$listing["id"];
        $item["link_preview"] = LISTING_DEFAULT_URL."/".$listing["friendly_url"].".html";
        $item["clickFunction"] = "onclick=\"loadDashboard('Listing', {$listing["id"]})\"";

        if (!count($sponsorItems)) {
            $item["class"] = "active";
            $firstItem = "Listing";
            $firstItemId = $listing["id"];
        }

        $sponsorItems[] = $item;
    }

    //Promotions
    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {

        $sql = "SELECT id, name, listing_id, friendly_url FROM Promotion WHERE account_id = $acctId ORDER BY name";
        $promotions = db_getFromDBBySQL("promotion", $sql, "array", false, SELECTED_DOMAIN_ID);

        if (count($promotions)) {

            $arrayForms[] = "promotion";

            foreach ($promotions as $promotion) {
                $item = array();
                $item["module"] = "promotion";
                $item["label"] = system_showText(LANG_PROMOTION_FEATURE_NAME);
                $item["title"] = $promotion["name"];
                $item["id"] = $promotion["id"];
                $item["link_edit"] = DEFAULT_URL."/".MEMBERS_ALIAS."/".PROMOTION_FEATURE_FOLDER."/deal.php?id=".$promotion["id"];
                $item["link_preview"] = PROMOTION_DEFAULT_URL."/".$promotion["friendly_url"].".html";
                $item["link_remove"] = "deleteItem('".system_showText(LANG_PROMOTION_DELETE_CONFIRM)."', ".$promotion["id"].", 'delete_promotion');";
                if (!$promotion["listing_id"]) {
                    $item["alert_deal"] = system_showText(LANG_LABEL_NOTLINKED);
                }
                $item["clickFunction"] = "onclick=\"loadDashboard('Promotion', {$promotion["id"]})\"";

                if (!count($sponsorItems)) {
                    $item["class"] = "active";
                    $firstItem = "Promotion";
                    $firstItemId = $promotion["id"];
                }

                $sponsorItems[] = $item;
            }
        }

    }

    //Banners
    if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {

        $sql = "SELECT id, type, caption, status FROM Banner WHERE account_id = $acctId ORDER BY caption";
        $banners = db_getFromDBBySQL("banner", $sql, "array", false, SELECTED_DOMAIN_ID);
        $level = new BannerLevel(true);
        $levelValues = $level->getLevelValues();
        $levelDefault = $level->getLevel($level->getDefaultLevel());
        $activeLevels = array();
        foreach ($levelValues as $levelValue) {
            if ($level->getActive($levelValue) == "y") {
                $activeLevels[] = $levelValue;
            }
        }

        if (count($banners)) {

            $arrayForms[] = "banner";

            foreach ($banners as $banner) {
                $item = array();
                $item["module"] = "banner";
                $item["label"] = system_showText(LANG_BANNER_FEATURE_NAME);
                $item["level"] = "(".(in_array($banner["type"], $activeLevels) ? $level->showLevel($banner["type"]) : string_ucwords($levelDefault)).")";
                $item["status"] = $banner["status"];
                $item["status_label"] = $status->getStatus($banner["status"]);
                $item["status_style"] = $status->getStatusWithStyle($banner["status"]);
                $item["title"] = $banner["caption"];
                $item["id"] = $banner["id"];
                $item["link_edit"] = DEFAULT_URL."/".MEMBERS_ALIAS."/".BANNER_FEATURE_FOLDER."/banner.php?id=".$banner["id"];
                $item["link_remove"] = "deleteItem('".system_showText(LANG_BANNER_DELETE_CONFIRM)."', ".$banner["id"].", 'delete_banner');";
                $item["clickFunction"] = "onclick=\"loadDashboard('Banner', {$banner["id"]})\"";

                if (!count($sponsorItems)) {
                    $item["class"] = "active";
                    $firstItem = "Banner";
                    $firstItemId = $banner["id"];
                }

                $sponsorItems[] = $item;
            }

        }

    }

    if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

        $sql = "SELECT id, level, title, status, friendly_url FROM Event WHERE account_id = $acctId ORDER BY level, title";
        $events = db_getFromDBBySQL("event", $sql, "array", false, SELECTED_DOMAIN_ID);
        $level = new EventLevel(true);
        $levelValues = $level->getLevelValues();
        $levelDefault = $level->getLevel($level->getDefaultLevel());
        $activeLevels = array();
        foreach ($levelValues as $levelValue) {
            if ($level->getActive($levelValue) == 'y') {
                $activeLevels[] = $levelValue;
            }
        }

        if (count($events)) {

            $arrayForms[] = "event";

            foreach ($events as $event) {
                $item = array();
                $item["module"] = "event";
                $item["label"] = system_showText(LANG_EVENT_FEATURE_NAME);
                $item["level"] = "(".(in_array($event["level"], $activeLevels) ? $level->showLevel($event["level"]) : string_ucwords($levelDefault)).")";
                $item["status"] = $event["status"];
                $item["status_label"] = $status->getStatus($event["status"]);
                $item["status_style"] = $status->getStatusWithStyle($event["status"]);
                $item["title"] = $event["title"];
                $item["id"] = $event["id"];
                $item["link_edit"] = DEFAULT_URL."/".MEMBERS_ALIAS."/".EVENT_FEATURE_FOLDER."/event.php?id=".$event["id"];
                $item["link_preview"] = EVENT_DEFAULT_URL."/".$event["friendly_url"].".html";
                $item["link_remove"] = "deleteItem('".system_showText(LANG_EVENT_DELETE_CONFIRM)."', ".$event["id"].", 'delete_event');";
                $item["clickFunction"] = "onclick=\"loadDashboard('Event', {$event["id"]})\"";

                if (!count($sponsorItems)) {
                    $item["class"] = "active";
                    $firstItem = "Event";
                    $firstItemId = $event["id"];
                }

                $sponsorItems[] = $item;
            }

        }
    }

    //Classifieds
    if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

        $sql = "SELECT id, level, title, status, friendly_url FROM Classified WHERE account_id = $acctId ORDER BY level, title";
        $classifieds = db_getFromDBBySQL("classified", $sql, "array", false, SELECTED_DOMAIN_ID);
        $level = new ClassifiedLevel(true);
        $levelValues = $level->getLevelValues();
        $levelDefault = $level->getLevel($level->getDefaultLevel());
        $activeLevels = array();
        foreach ($levelValues as $levelValue) {
            if ($level->getActive($levelValue) == 'y') {
                $activeLevels[] = $levelValue;
            }
        }

        if (count($classifieds)) {

            $arrayForms[] = "classified";

            foreach ($classifieds as $classified) {
                $item = array();
                $item["module"] = "classified";
                $item["label"] = system_showText(LANG_CLASSIFIED_FEATURE_NAME);
                $item["level"] = "(".(in_array($classified["level"], $activeLevels) ? $level->showLevel($classified["level"]) : string_ucwords($levelDefault)).")";
                $item["status"] = $classified["status"];
                $item["status_label"] = $status->getStatus($classified["status"]);
                $item["status_style"] = $status->getStatusWithStyle($classified["status"]);
                $item["title"] = $classified["title"];
                $item["id"] = $classified["id"];
                $item["link_edit"] = DEFAULT_URL."/".MEMBERS_ALIAS."/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$classified["id"];
                $item["link_preview"] = CLASSIFIED_DEFAULT_URL."/".$classified["friendly_url"].".html";
                $item["link_remove"] = "deleteItem('".system_showText(LANG_CLASSIFIED_DELETE_CONFIRM)."', ".$classified["id"].", 'delete_classified');";
                $item["clickFunction"] = "onclick=\"loadDashboard('Classified', {$classified["id"]})\"";

                if (!count($sponsorItems)) {
                    $item["class"] = "active";
                    $firstItem = "Classified";
                    $firstItemId = $classified["id"];
                }

                $sponsorItems[] = $item;
            }
        }
    }

    if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

        $sql = "SELECT id, level, title, status, friendly_url FROM Article WHERE account_id = $acctId ORDER BY title";
        $articles = db_getFromDBBySQL("article", $sql, "array", false, SELECTED_DOMAIN_ID);
        $level = new ArticleLevel(true);
        $levelValues = $level->getLevelValues();
        $levelDefault = $level->getLevel($level->getDefaultLevel());
        $activeLevels = array();
        foreach ($levelValues as $levelValue) {
            if ($level->getActive($levelValue) == 'y') {
                $activeLevels[] = $levelValue;
            }
        }

        if (count($articles)) {

            $arrayForms[] = "article";

            foreach ($articles as $article) {
                $item = array();
                $item["module"] = "article";
                $item["label"] = system_showText(LANG_ARTICLE_FEATURE_NAME);
                $item["status"] = $article["status"];
                $item["status_label"] = $status->getStatus($article["status"]);
                $item["status_style"] = $status->getStatusWithStyle($article["status"]);
                $item["title"] = $article["title"];
                $item["id"] = $article["id"];
                $item["link_edit"] = DEFAULT_URL."/".MEMBERS_ALIAS."/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$article["id"];
                $item["link_preview"] = ARTICLE_DEFAULT_URL."/".$article["friendly_url"].".html";
                $item["link_remove"] = "deleteItem('".system_showText(LANG_ARTICLE_DELETE_CONFIRM)."', ".$article["id"].", 'delete_article');";
                $item["clickFunction"] = "onclick=\"loadDashboard('Article', {$article["id"]})\"";

                if (!count($sponsorItems)) {
                    $item["class"] = "active";
                    $firstItem = "Article";
                    $firstItemId = $article["id"];
                }

                $sponsorItems[] = $item;
            }

        }

    }

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_MEMBERS_DASHBOARD);?></h1>
                <br>
            </div>
        </div>
    </section>

    <div class="well well-light">
        <div class="container">

            <?

            //Success and error messages
            if (is_numeric($message) && isset(${"msg_".$module}[$message])) { ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="alert" class="alert alert-<?=($class ? $class : "success")?>">
                            <?=${"msg_".$module}[$message];?>
                        </div>
                    </div>
                </div>

            <? } ?>

            <div class="row responsive">

                <?
                if ($firstItemId) { ?>

                    <div class="col-md-4 responsive-menu">
                        <? include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php"); ?>
                    </div>

                    <div id="dashboard" class="col-md-8 responsive-dashboard">
                    <?
                    if ($firstItemId) {
                        $itemObj = new $firstItem($firstItemId);

                        //Prepare code for dashboard
                        $item_type = $firstItem;
                        $item_id = $firstItemId;
                        include(INCLUDES_DIR."/code/member_dashboard.php");

                        //Build dashboard
                        include(INCLUDES_DIR."/views/view_member_dashboard.php");
                    }

                    ?>

                    </div>

                <? } else { ?>

                    <div class="panel panel-theme">
                        <div class="panel-body text-center">

                            <h3><?=system_showText(LANG_ADD_NEW_CONTENT2);?></h3>
                            <?=system_showText(LANG_ADD_NEW_CONTENT2_TIP);?>
                            <hr>

                            <div class="btn-toolbar">
                                <a class="btn btn-primary" href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_LISTING_FEATURE_NAME);?></a>

                                <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                                <a class="btn btn-primary" href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=BANNER_FEATURE_FOLDER;?>/banner.php"><?=system_showText(LANG_BANNER_FEATURE_NAME);?></a>
                                <? } ?>

                                <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                                <a class="btn btn-primary" href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_EVENT_FEATURE_NAME);?></a>
                                <? } ?>

                                <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                                <a class="btn btn-primary" href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME);?></a>
                                <? } ?>

                                <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                                <a class="btn btn-primary" href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_ARTICLE_FEATURE_NAME);?></a>
                                <? } ?>
                            </div>
                            <br><br>
                        </div>

                    </div>

                <? } ?>


            </div>

        </div>
        <!-- .container -->
    </div>
    <!-- .well .well-light -->
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = MEMBERS_EDIRECTORY_ROOT."/scripts.php";
    include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
