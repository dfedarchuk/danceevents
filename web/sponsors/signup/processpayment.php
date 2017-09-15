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
	# * FILE: /sponsors/signup/processpayment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/signup";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$process = "signup";
	include(INCLUDES_DIR."/code/billing_".$payment_method.".php");

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
                <br>
                <ol class="breadcrumb breadcrumb-steps breadcrumb-steps-inverse text-center">
                    <li><strong>1:</strong> <?=system_showText(LANG_ADVERTISE_IDENTIFICATION);?></li>
                    <li><strong>2:</strong> <?=system_showText(LANG_CHECKOUT);?></li>
                    <li class="active"><strong>3:</strong> <?=system_showText(LANG_ADVERTISE_CONFIRMATION);?></li>
                </ol>
                <br>
            </div>
        </div>

    </section>

    <main>
        <section class="block">
            <div class="container">
                <div class="well">

                    <div class="order">

                        <?
                        if ($payment_success == "y") {

                            $listingPaid = db_getFromDB("listing", "account_id", $acctId, "1", "title", "array", false, true);
                            if ($listingPaid) {
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listing.php?id=".$listingPaid["id"]."&process=signup";

                                //Item title
                                $itemDesc = array();
                                $itemDesc[] = "<p>\"{$listingPaid["title"]}\"</p>";

                                //Get level
                                $levelObj = new ListingLevel();
                                $itemDesc[] = "<p>".system_showText(LANG_LISTING_FEATURE_NAME)." ".ucfirst($levelObj->getLevel($listingPaid["level"]))."</p>";

                                //Get extra categories
                                $dbObject = db_getDBObject(DEFAULT_DB, true);
                                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObject);
                                $category_amount = 0;
                                $sql = "SELECT category_id FROM Listing_Category WHERE listing_id = {$listingPaid["id"]}";
                                $result = $db->query($sql);
                                if(mysql_num_rows($result)){
                                    while($row = mysql_fetch_assoc($result)){
                                        $category_amount++;
                                    }

                                }
                                $extraCateg = $category_amount - $levelObj->getFreeCategory($listingPaid["level"]);

                                if ($extraCateg > 0) {
                                    $itemDesc[] = "<p>".system_showText(LANG_LABEL_EXTRA_CATEGORY).": ".$extraCateg."</p>";
                                }

                                //Get listing type
                                if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                                    if ($listingPaid["listingtemplate_id"]) {
                                        $listingTemplateObj = new ListingTemplate($listingPaid["listingtemplate_id"]);
                                        $itemDesc[] = "<p>".system_showText(LANG_LISTING_LABELTEMPLATE).": ".$listingTemplateObj->getString("title")."</p>";
                                    }
                                }

                            }

                            $eventPaid = db_getFromDB("event", "account_id", $acctId, "1", "title", "array", false, true);
                            if ($eventPaid) {
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".EVENT_FEATURE_FOLDER."/event.php?id=".$eventPaid["id"]."&process=signup";

                                //Item title
                                $itemDesc = array();
                                $itemDesc[] = "<p>\"{$eventPaid["title"]}\"</p>";

                                //Get level
                                $levelObj = new EventLevel();
                                $itemDesc[] = "<p>".system_showText(LANG_EVENT_FEATURE_NAME)." ".ucfirst($levelObj->getLevel($eventPaid["level"]))."</p>";
                            }

                            $bannerPaid = db_getFromDB("banner", "account_id", $acctId, "1", "caption", "array", false, true);
                            if ($bannerPaid) {
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".BANNER_FEATURE_FOLDER."/banner.php?id=".$bannerPaid["id"]."&process=signup";

                                //Item title
                                $itemDesc = array();
                                $itemDesc[] = "<p>\"{$bannerPaid["caption"]}\"</p>";

                                //Get level
                                $levelObj = new BannerLevel();
                                $itemDesc[] = "<p>".system_showText(LANG_BANNER_FEATURE_NAME)." ".string_ucwords($levelObj->getDisplayName($bannerPaid["type"]))."</p>";
                            }

                            $classifiedPaid = db_getFromDB("classified", "account_id", $acctId, "1", "title", "array", false, true);
                            if ($classifiedPaid) {
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$classifiedPaid["id"]."&process=signup";

                                //Item title
                                $itemDesc = array();
                                $itemDesc[] = "<p>\"{$classifiedPaid["title"]}\"</p>";

                                //Get level
                                $levelObj = new ClassifiedLevel();
                                $itemDesc[] = "<p>".system_showText(LANG_CLASSIFIED_FEATURE_NAME)." ".ucfirst($levelObj->getLevel($classifiedPaid["level"]))."</p>";
                            }

                            $articlePaid = db_getFromDB("article", "account_id", $acctId, "1", "title", "array", false, true);
                            if ($articlePaid) {
                                $next = DEFAULT_URL."/".MEMBERS_ALIAS."/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$articlePaid["id"]."&process=signup";

                                //Item title
                                $itemDesc = array();
                                $itemDesc[] = "<p>\"".LANG_ARTICLE_FEATURE_NAME." ".$articlePaid["title"]."\"</p>";

                            }
                        ?>

                        <h1><?=system_showText(LANG_ADVERTISE_THANKYOU);?></h1>

                        <div id="order-detail">

                            <h3><?=system_showText(LANG_ADVERTISE_ORDERDESC);?></h3>
                            <br>

                            <?=implode("", $itemDesc);?>

                        </div>

                        <div id="thanks">

                            <h3><?=system_showText(LANG_ADVERTISE_THANKS);?></h3>

                            <? if ($payment_message) {
                                echo $payment_message;
                            } ?>
                            <p>
                                <?=system_showText(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP);?> <?=system_showText(LANG_MSG_IF_IT_DOES_NOT_WORK);?> <a href="<?=$next?>"><?=string_strtolower(system_showText(LANG_LABEL_CLICK_HERE));?></a>.
                            </p>

                        </div>

                        <script>
                            window.setTimeout("window.location='<?=$next?>'", 15000);
                        </script>

                        <?

                        } else { ?>

                            <div id="order-detail">
                                <? if ($payment_message) {
                                    echo $payment_message;
                                } ?>
                            </div>

                        <? } ?>

                    </div>

                </div>
	        </div>
        </section>
    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");