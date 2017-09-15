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
    # * FILE: /profile/index.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # MAINTENANCE MODE
    # ----------------------------------------------------------------------------------------------------
    verify_maintenanceMode();

    //Remove item from favorites
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "remove") {
        extract($_POST);
        if (is_numeric($account_id) && $account_id != 0 && is_numeric($item_id) && $item_id != 0 && $item_type) {
            $quicklistObj = new Quicklist("", $account_id, $item_id, $item_type);
            $quicklistObj->Delete();
            exit;
        }
    }

    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

    if (SOCIALNETWORK_FEATURE == "off") { exit; }

    if (isset($_GET["oauth_token"])) {
        header("Location: ".DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php?oauth_token=".$_GET["oauth_token"]);
        exit;
    }
    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSessionFront();

    # ----------------------------------------------------------------------------------------------------
    # MODE REWRITE
    # ----------------------------------------------------------------------------------------------------
    setting_get("review_listing_enabled", $review_enabled);
    setting_get("review_article_enabled", $review_article_enabled);
    include(EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/mod_rewrite.php");

    # ----------------------------------------------------------------------------------------------------
    # BODY
    # ----------------------------------------------------------------------------------------------------
    $info = socialnetwork_retrieveInfoProfile($id);

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = ($id ? $info["nickname"] : $headertagtitle);
    $headertag_description = ($id ? str_replace("\n", "", $info["personal_message"]) : $headertagdescription);
    $headertag_keywords = $headertagkeywords;
    include(EDIRECTORY_ROOT."/frontend/header.php");

    //Prepare User information
    extract($_GET);

    $accObj = new Account($id);
    $publish = $accObj->getString("publish_contact");
    $profileObj = new Profile(sess_getAccountIdFromSession());
    $profileObj->extract();

    //Facebook integration
    $urlRedirect = "?attach_account=true&is_sponsor=n&edir_account=".sess_getAccountIdFromSession()."&destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/index.php?facebookattached");

    if (isset($_GET["signoffFacebook"])){
        $facebookMessage = system_showText(LANG_LABEL_FB_ACT_DISC).".";

        $accountObj = new Account(sess_getAccountIdFromSession());
        $accountObj->setString("facebook_username", "");
        $accountObj->setString("foreignaccount", "n");
        $accountObj->Save();

        $profileObj = new Profile(sess_getAccountIdFromSession());
        $profileObj->setString("facebook_uid", "");
        $profileObj->Save();
    }

    //Recent activity
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $userActivity = array();

    //Get Deals Redeemed
    $sql = "SELECT Promotion_Redeem.id, datetime, redeem_code, promotion_id, amount FROM Promotion_Redeem, Promotion WHERE Promotion.id = Promotion_Redeem.promotion_id AND Promotion_Redeem.account_id  = ".db_formatNumber($id);
    $result = $dbDomain->query($sql);
    while ($row = mysql_fetch_assoc($result)) {

        $promotionObj = new Promotion($row["promotion_id"]);

        if ($promotionObj->getNumber("id")) {

            $userActivity["deal_".$row["id"]]["id"] = $row["id"];
            $userActivity["deal_".$row["id"]]["added"] = $row["datetime"];
            $userActivity["deal_".$row["id"]]["redeem_code"] = $row["redeem_code"];
            $userActivity["deal_".$row["id"]]["used"] = $row["used"];
            $userActivity["deal_".$row["id"]]["promotion_id"] = $row["promotion_id"];
            $userActivity["deal_".$row["id"]]["title"] = $promotionObj->getString("name");
            $userActivity["deal_".$row["id"]]["amount"] = $row["amount"];

            if ($promotionObj->getNumber("listing_id") && $promotionObj->getString("listing_status") == "A" && (validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"), $promotionObj->getNumber("visibility_end")))) {
                $userActivity["deal_".$row["id"]]["title_url"] = "<a href=\"".$promotionObj->getFriendlyURL(false, PROMOTION_DEFAULT_URL)."\">".$promotionObj->getString("name")."</a>";
            } else {
                $userActivity["deal_".$row["id"]]["title_url"] = $promotionObj->getString("name");
            }

        }

    }

    //Get Reviews
    $sql = "SELECT id, item_type, item_id, review, review_title, rating, response, responseapproved, added FROM Review WHERE member_id = ".db_formatNumber($id)." AND approved = 1";
    $result = $dbDomain->query($sql);
    $levelObj = new ListingLevel(true);
    while ($row = mysql_fetch_assoc($result)) {

        switch ($row["item_type"]) {
            case "listing":
                $itemObj = new Listing($row["item_id"]);
                $friendlyURL = LISTING_DEFAULT_URL;
                if ($itemObj->getString("status") == "A") {
                    $itemAvailable = true;
                    if ($levelObj->getDetail($itemObj->getNumber("level")) == "y") {
                        $hasDetail = true;
                    } else {
                        $hasDetail = false;
                    }
                } else {
                    $itemAvailable = false;
                }
                break;

            case "article":
                $itemObj = new Article($row["item_id"]);
                $friendlyURL = ARTICLE_DEFAULT_URL;
                if ($itemObj->getString("status") == "A") {
                    $itemAvailable = true;
                } else {
                    $itemAvailable = false;
                }
                $hasDetail = true;
                break;

            case "promotion":
                $itemObj = new Promotion($row["item_id"]);
                $friendlyURL = Promotion_DEFAULT_URL;
                if ($itemObj->getNumber("listing_id") && $itemObj->getString("listing_status") == "A" && (validate_date_deal($itemObj->getDate("start_date"), $itemObj->getDate("end_date"))) && (validate_period_deal($itemObj->getNumber("visibility_start"), $itemObj->getNumber("visibility_end")))) {
                    $itemAvailable = true;
                } else {
                    $itemAvailable = false;
                }
                $hasDetail = true;
                break;
        }

        if ($itemObj->getNumber("id") && $itemAvailable) {
            $userActivity["review_".$row["id"]]["id"] = $row["id"];
            $userActivity["review_".$row["id"]]["item_type"] = $row["item_type"];
            $userActivity["review_".$row["id"]]["item_id"] = $row["item_id"];
            $userActivity["review_".$row["id"]]["review"] = $row["review"];
            $userActivity["review_".$row["id"]]["review_title"] = $row["review_title"];
            $userActivity["review_".$row["id"]]["rating"] = $row["rating"];
            $userActivity["review_".$row["id"]]["response"] = $row["response"];
            $userActivity["review_".$row["id"]]["responseapproved"] = $row["responseapproved"];
            $userActivity["review_".$row["id"]]["added"] = $row["added"];
            $userActivity["review_".$row["id"]]["title"] = $itemObj->getString(($row["item_type"] == "promotion" ? "name" : "title"));
            $userActivity["review_".$row["id"]]["title_url"] = "<a href=\"".$itemObj->getFriendlyURL(false, $friendlyURL)."\">".$itemObj->getString(($row["item_type"] == "promotion" ? "name" : "title"))."</a>";
        }
    }

    //Get Blog Comments
    $sql = "SELECT id, post_id, description, added FROM Comments WHERE member_id = $id AND approved = 1";
    $result = $dbDomain->query($sql);
    while ($row = mysql_fetch_assoc($result)) {

        $postObj = new Post($row["post_id"]);

        if ($postObj->getNumber("id") && $postObj->getString("status") == "A") {
            $userActivity["comment_".$row["id"]]["id"] = $row["id"];
            $userActivity["comment_".$row["id"]]["description"] = $row["description"];
            $userActivity["comment_".$row["id"]]["added"] = $row["added"];
            $userActivity["comment_".$row["id"]]["title"] = $postObj->getString("title");
            $userActivity["comment_".$row["id"]]["title_url"] = "<a href=\"".$postObj->getFriendlyURL(false, BLOG_DEFAULT_URL)."\">".$postObj->getString("title")."</a>";
        }

    }

    //Order by date
    $ord = array();
    foreach ($userActivity as $key => $value){
        $ord[] = strtotime($value["added"]);
    }

    array_multisort($ord, SORT_DESC, $userActivity);

?>
    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_LABEL_PROFILE);?></h1>
                <br>
            </div>
        </div>
    </section>

    <main>

        <div class="container well well-light">

            <div class="block">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="theme-box theme-box-primary">
                            <h2 class="theme-box-title"><?=system_showText(LANG_LABEL_ABOUT_ME);?>
                                <? if ($id == sess_getAccountIdFromSession()) { ?>
                                <a href="<?=SOCIALNETWORK_URL;?>/edit.php" class="view-more"><?=LANG_LABEL_EDITPROFILE;?></a>
                                <? } ?>
                            </h2>
                            <div class="theme-box-content">
                                <div class="text-center">
                                    <?
                                    if (!$info["facebook_image"]) {
                                        $imgObj = new Image($info["image_id"], true);
                                        if ($imgObj->imageExists()) {
                                            echo $imgObj->getTag(true, PROFILE_MEMBERS_IMAGE_WIDTH, PROFILE_MEMBERS_IMAGE_HEIGHT, "", false, false, "img-profile big");
                                        }
                                    } else {

                                        if (HTTPS_MODE == "on") {
                                            $info["facebook_image"] = str_replace("http://", "https://", $info["facebook_image"]);
                                        } ?>

                                        <img class="img-profile big" width="70" height="70" src="<?=$info["facebook_image"]?>" border="0" alt="Facebook Image"/>

                                    <? } ?>
                                    <h4><?=htmlspecialchars($info["nickname"]);?></h4>
                                    <? if ($info["entered"]) { ?>
                                        <p><?=system_showText(LANG_LABEL_MEMBER_SINCE);?> <?=format_date($info["entered"])?></p>
                                    <? } ?>
                                    <? if ($info["country"] || $info["state"] || $info["city"]) {
                                    $arrayLocUser = array();
                                    if ($info["country"]) { $arrayLocUser[] = $info["city"];}
                                    if ($info["state"]) {  $arrayLocUser[] = $info["state"]; }
                                    if ($info["city"]) {  $arrayLocUser[] = $info["country"]; }
                                    ?>

                                    <p>
                                        <?=ucfirst(system_showtext(LANG_FROM))?>
                                        <?=(implode(", ", $arrayLocUser))?>
                                    </p>
                                    <? } ?>
                                    <hr>
                                </div>

                                <? if ($publish == "y") {

                                    if ($info["company"]) { ?>
                                        <p><?=ucfirst(system_showText(LANG_LABEL_COMPANY)).": " .nl2br(htmlspecialchars($info["company"]))?></p>
                                    <? }

                                    if ($info["address"] || $info["address2"] || $info["phone"] || $info["fax"]) { ?>
                                        <address>
                                            <p><?=nl2br(htmlspecialchars($info["address"]))?>
                                                <? if ($info["address2"]) { ?>
                                                    <br /><?=nl2br(htmlspecialchars($info["address2"]))?>
                                                <? } ?>
                                            </p>
                                            <? if ($info["phone"]) { ?>
                                                <p><?=system_showText(LANG_LABEL_PHONE)?>: <?=$info["phone"];?></p>
                                            <? } ?>
                                            <? if ($info["fax"]) { ?>
                                                <p><?=system_showText(LANG_LABEL_FAX)?>: <?=$info["fax"];?></p>
                                            <? } ?>
                                        </address>
                                    <? }

                                    if ($info["url"]) { ?>
                                        <p><a href="<?=nl2br(htmlspecialchars($info["url"]))?>" title="<?=system_showText(LANG_LABEL_URL)." ".system_showText(LANG_PAGING_PAGEOF)." ".$info["nickname"]?>" target="_blank"><?=nl2br(htmlspecialchars($info["url"]));?></a></p>
                                    <? }
                                }

                                if ($info["personal_message"]) { ?>
                                    <p><?=nl2br(htmlspecialchars($info["personal_message"]))?></p>
                                <? } ?>

                                <?
                                if ($id == sess_getAccountIdFromSession() && ((FACEBOOK_APP_ENABLED == "on" && $accObj->getString("username") != $accObj->getString("facebook_username")))) {

                                    if ($_GET["error"] == "disableAttach") { ?>
                                        <p class="alert alert-warning"><?=system_showText(LANG_FB_ALREADY_LINKED)?></p>
                                    <? }

                                    if (isset($_GET["facebookerror"])) { ?>
                                        <p class="alert alert-warning"><?=system_showText(LANG_MSG_ERROR_NUMBER)." 10001. ".system_showText(LANG_MSG_TRY_AGAIN);?></p>
                                    <? }

                                    if ($accObj->getString("username") != $accObj->getString("facebook_username") && FACEBOOK_APP_ENABLED == "on") {

                                        //Account already associated
                                        if ($profileObj && $profileObj->facebook_uid != "") {

                                            //Unlink account
                                            if (isset($_GET["facebookattached"])) { ?>
                                                <p class="alert alert-success"><?=system_showText(LANG_LABEL_FB_SIGNFB_CONN);?></p>
                                            <? } ?>

                                            <p><a class="btn btn-xs btn-default btn-block" href="<?=DEFAULT_URL?>/<?=SOCIALNETWORK_FEATURE_NAME?>/index.php?signoffFacebook"><?=system_showText(LANG_LABEL_UNLINK_FB);?></a></p>
                                            <?
                                            //Account not associated
                                        } else {

                                            $linkAttachFB = true;

                                            //Link Account
                                            if ($facebookMessage) { ?>
                                                <p class="alert alert-success"><?=$facebookMessage?></p>
                                            <? }

                                            include(INCLUDES_DIR."/forms/form_facebooklogin.php");

                                        }
                                    }

                                }

                                ?>

                            </div>
                        </div>


                    </div>

                    <div class="col-sm-8">
                        <div class="theme-box theme-box-primary">
                            <h3 class="theme-box-title">
                                <?=system_showText(LANG_LABEL_PROFILE_RECENT_ACTIVITY)?>
                            </h3>
                            <div class="theme-box-content">
                                <? if ($id == sess_getAccountIdFromSession()) { ?>
                                <h3><?=system_showText(LANG_LABEL_WELCOME);?>, <?=htmlspecialchars($info["nickname"]);?>!</h3>
                                <p><?=system_showText(LANG_LABEL_PROFILE_TIP1);?></p>
                                <? } ?>

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                    <?
                                    if (count($userActivity)) {
                                        foreach ($userActivity as $key => $activity) { ?>
                                            <div class="panel panel-accordion">
                                                <div class="panel-heading" role="tab" id="<?=$key?>">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$key?>" aria-expanded="true" aria-controls="collapse-<?=$key?>">

                                                            <? if (string_strpos($key, "deal") !== false) { ?>
                                                                <?=system_showText(LANG_LABEL_REDEEMED);?> <b><?=$activity["title"]?></b>
                                                            <? } elseif (string_strpos($key, "review") !== false) { ?>
                                                                <?=system_showText(LANG_LABEL_RATED);?> <b><?=$activity["title"]?></b> <?=system_showText(LANG_WITH);?> <span class="stars-rating"><span class="rate-<?=$activity["rating"]?>"></span></span>
                                                            <? } elseif (string_strpos($key, "comment") !== false) { ?>
                                                                <?=system_showText(LANG_LABEL_COMMENTED);?> <b><?=$activity["title"]?></b>
                                                            <? } ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse-<?=$key?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?=$key?>" aria-expanded="false">
                                                    <div class="panel-body">
                                                        <? if (string_strpos($key, "deal") !== false) { ?>
                                                            <?=system_showText(LANG_BLOG_ON)?> <?=format_date($activity["added"], DEFAULT_DATE_FORMAT, "datestring");?>
                                                            <h5>
                                                                <?=$activity["title_url"]?>
                                                                <? if ($id == sess_getAccountIdFromSession() && !$activity["used"]) { ?>
                                                                    <a class="pull-right" href="#" onclick="javascript:window.open('/<?=PROMOTION_FEATURE_FOLDER?>/redeem/<?=$activity['promotion_id'];?>');"><?=system_showText(LANG_LABEL_PRINT);?></a>
                                                                <? } ?>
                                                            </h5>

                                                            <? if ($id == sess_getAccountIdFromSession()) { ?>
                                                                <p><?=system_showText(LANG_LABEL_DEAL_CODE);?> <b><?=$activity["redeem_code"];?></b></p>

                                                            <? } ?>

                                                        <? } elseif (string_strpos($key, "review") !== false) { ?>
                                                            <?=system_showText(LANG_BLOG_ON)?> <?=format_date($activity["added"], DEFAULT_DATE_FORMAT, "datestring");?>
                                                            <h5><?=$activity["title_url"]?></h5>
                                                            <h5><?=$activity["review_title"]?></h5>
                                                            <p class="review"><?=$activity["review"]?></p>

                                                            <? if ($activity["responseapproved"]) { ?>
                                                                <p class="reply"><?=$activity["response"]?></p>
                                                            <? } ?>


                                                        <? } elseif (string_strpos($key, "comment") !== false) { ?>
                                                            <?=system_showText(LANG_BLOG_ON)?> <?=format_date($activity["added"], DEFAULT_DATE_FORMAT, "datestring");?>
                                                            <h5><?=$activity["title_url"]?></h5>
                                                            <p class="review"><?=$activity["description"]?></p>

                                                        <? } ?>
                                                    </div>
                                                </div>
                                            </div>

                                        <? } ?>
                                    <? } ?>

                                </div>
                            </div>
                        </div>
                        <?
                        if (!$_GET["id"]) {
                            $id = sess_getAccountIdFromSession();
                        } else {
                            $id = $_GET["id"];
                        }
                        $favoritesItems = system_getUserActivities("favorites", $id);

                        if (is_array($favoritesItems) && count($favoritesItems)) {

                            setting_get("review_listing_enabled", $review_enabled);
                            $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");

                            ?>

                            <div class="theme-box theme-box-primary">
                                <h2 class="theme-box-title"><?=system_showText(LANG_LABEL_FAVORITES);?></h2>
                                <? foreach ($favoritesItems as $module => $favorites) {

                                    if (is_array($favorites)) {

                                        foreach ($favorites as $favorite) {

                                            include(INCLUDES_DIR."/views/view_favorite.php");
                                        }
                                    }

                                } ?>
                            </div>
                        <? } ?>
                    </div>

                </div>
            </div>


        </div>
    </main>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/frontend/footer.php");
