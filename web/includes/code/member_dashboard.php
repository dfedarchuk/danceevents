<?php
/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
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
# * FILE: /includes/code/member_dashboard.php
# ----------------------------------------------------------------------------------------------------

//Gamefication box
$auxColorTheme = unserialize(ARRAY_DEFAULT_COLORS);
$colorKnob = $auxColorTheme[EDIR_THEME][EDIR_SCHEME]["colorKnob"];
if (!$colorKnob) {
    $colorKnob = "199adb";
}
if (strtolower($item_type) != "banner") {
    $arrayCompletion = system_gamefyItems(strtolower($item_type), $itemObj);
} else {
    $arrayCompletion["total"] = 100;
}

//Get fields according to level
if (strtolower($item_type) != "banner" && strtolower($item_type) != "article") {
    unset($array_fields);
    $array_fields = system_getFormFields($item_type, $itemObj->getNumber("level"));
}

//General information
switch ($item_type) {
    case "Listing" :
        $item_link = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/listing.php?id=" . $itemObj->getNumber("id");
        $item_levellink = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/listinglevel.php?id=" . $itemObj->getNumber("id");
        $fieldTitle = "title";
        $levelObj = new ListingLevel();
        $moduleURL = LISTING_DEFAULT_URL;
        $reviewTable = "Listing";
        $leadTable = "Listing";
        $levelTable = "ListingLevel";

        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
        if ($levelsWithReview && in_array($itemObj->getNumber("level"), $levelsWithReview)) {
            setting_get("review_listing_enabled", $review_enabled);
        }
        $reports = retrieveListingReport($itemObj->getNumber("id"));
        $superReports = new ListingReports($itemObj);
        break;
    case "Event" :
        $item_link = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . EVENT_FEATURE_FOLDER . "/event.php?id=" . $itemObj->getNumber("id");
        $item_levellink = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . EVENT_FEATURE_FOLDER . "/eventlevel.php?id=" . $itemObj->getNumber("id");
        $fieldTitle = "title";
        $levelObj = new EventLevel();
        $moduleURL = EVENT_DEFAULT_URL;
        $review_enabled = "off";
        $leadTable = "Event";
        $levelTable = "EventLevel";

        $superReports = new EventReports($itemObj);

        break;
    case "Classified" :
        $item_link = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . CLASSIFIED_FEATURE_FOLDER . "/classified.php?id=" . $itemObj->getNumber("id");
        $item_levellink = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . CLASSIFIED_FEATURE_FOLDER . "/classifiedlevel.php?id=" . $itemObj->getNumber("id");
        $fieldTitle = "title";
        $levelObj = new ClassifiedLevel();
        $moduleURL = CLASSIFIED_DEFAULT_URL;
        $review_enabled = "off";
        $leadTable = "Classified";
        $levelTable = "ClassifiedLevel";

        $superReports = new ClassifiedReports($itemObj);
        break;

    case "Article" :
        $item_link = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . ARTICLE_FEATURE_FOLDER . "/article.php?id=" . $itemObj->getNumber("id");
        $fieldTitle = "title";
        $moduleURL = ARTICLE_DEFAULT_URL;
        $levelObj = new ArticleLevel();
        setting_get("review_article_enabled", $review_enabled);
        $reviewTable = "Article";

        $superReports = new ArticleReports($itemObj);
        break;
    case "Promotion" :
        $item_link = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . PROMOTION_FEATURE_FOLDER . "/deal.php?id=" . $itemObj->getNumber("id");
        $fieldTitle = "name";
        $moduleURL = PROMOTION_DEFAULT_URL;
        $review_enabled = "off";
        $reviewTable = "Promotion";

        $superReports = new PromotionReports($itemObj);
        break;
    case "Banner" :
        $item_link = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . BANNER_FEATURE_FOLDER . "/banner.php?id=" . $itemObj->getNumber("id");
        $fieldTitle = "caption";
        $review_enabled = "off";
        $reports = retrieveBannerReport($itemObj->getNumber("id"));
        $superReports = new BannerReports($itemObj);
        break;
}

/* Reports start date : 6 months ago */
$startDate = new DateTime("-6 months");

/* Get report data from $startDate to today. */
$reportData = $superReports->compileData( $startDate, new DateTime() );

/* Converts data to Javascript representation and adds to the JSHandler buffer */
JavaScriptHandler::registerLoose( $superReports->getJavascript( $reportData ) );

$showChart = $reportData['maximumValue'] != 0;

//Item Title
$item_title = $itemObj->getString($fieldTitle);

//Item Renewal
$item_new = "";
$item_renewal = "";
$hastocheckout = false;

//Increase visibility button
$visibilityButton = false;

if (strtolower($item_type) != "banner" && strtolower($item_type) != "promotion" && strtolower($item_type) != "article") {

    $levelsEnabled = $levelObj->getValues();

    //Show button if there are more than one active level
    if (count($levelsEnabled) > 1) {

        $dbMain = db_getDBObject(DEFAULT_DB, false);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

        //Get highest level
        $sql = "SELECT value FROM $levelTable WHERE detail = 'y' AND active = 'y' ORDER BY value LIMIT 1";
        $rowLevel = mysql_fetch_assoc($dbObj->query($sql));

        //Show button if item's level is lower than the highest active level and it's a free or unpaid item
        if ($rowLevel["value"] > 0 && $rowLevel["value"] < $itemObj->getNumber("level") && (($itemObj->getPrice('monthly') <= 0 && $itemObj->getPrice('yearly') <= 0) || $itemObj->needToCheckOut())) {
            $visibilityButton = true;
        }

    }
}

if (strtolower($item_type) != "promotion") {

    $impressions_fieldText = "";

    if (strtolower($item_type) == "banner" && $itemObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) {

        if ($itemObj->hasImpressions()) {
            $impressions_field = $itemObj->getString("impressions");
        } else {
            $impressions_field = 0;
        }

        $impressions_fieldText .= $impressions_field . " " . system_showText(LANG_LABEL_IMPRESSIONS_LEFT);

    } elseif ($itemObj->hasRenewalDate()) {

        $renewal_date = format_date($itemObj->getString("renewal_date"));

        if ($renewal_date) {

            //Full Renewal date Formated
            $item_renewal_formatted = format_date($itemObj->getString("renewal_date"), DEFAULT_DATE_FORMAT,
                "datestring");

            /*
            * Get timestamp from today
            */
            $sd_timestamp = system_getTimeStamp(date(DEFAULT_DATE_FORMAT));
            /*
            * Get timestamp from renewal date
            */
            $ed_timestamp = system_getTimeStamp($renewal_date);

            /*
            * Get the difference in days beteween two dates
            */
            $diffdays = system_getDiffDays($sd_timestamp, $ed_timestamp);

            $item_renewal = $diffdays;

            if ($diffdays <= 30) {
                $item_renewal = $diffdays;
                if ($diffdays == 1) {
                    $item_renewal_period = system_showText(LANG_DAY);
                } elseif ($diffdays == 30 || $diffdays == 31) {
                    $item_renewal_period = system_showText(LANG_MONTH);
                    $item_renewal = 1;
                } else {
                    $item_renewal_period = system_showText(LANG_DAY_PLURAL);
                }
            } else {
                $item_renewal = "";
            }

        } else {

            if ($itemObj->needToCheckOut() && $itemObj) {
                $hastocheckout = true;
            } else {
                $item_new = system_showText(LANG_LABEL_NEW);
            }
        }

    }
}

//Status validation to show share links
$item_status = "";
if (strtolower($item_type) == "promotion") {
    if ($itemObj->getNumber("listing_id") && $itemObj->getString("listing_status") == "A" && (validate_date_deal($itemObj->getDate("start_date"),
            $itemObj->getDate("end_date"))) && (validate_period_deal($itemObj->getNumber("visibility_start"),
            $itemObj->getNumber("visibility_end")))
    ) {
        $item_status = "A";
    }
} elseif (strtolower($item_type) != "banner") {
    $item_status = $itemObj->getString("status");
}

//Share links
if (strtolower($item_type) != "banner") {

    $linkTwitter = $moduleURL . "/" . $itemObj->getString("friendly_url") . ".html";
    $linkFacebook = $moduleURL . "/" . $itemObj->getString("friendly_url") . ".html";

    $shareFacebook = "href=\"https://www.facebook.com/sharer.php?u=" . $linkFacebook . "&amp;t=" . urlencode($itemObj->getString("title")) . "\" target=\"_blank\"";
    $shareTwitter = "href=\"https://twitter.com/?status=" . $linkTwitter . "\" target=\"_blank\"";
}

//Reports
$item_hasphone = false;
$item_haswebsite = false;
$item_hasfax = false;
$item_hasemail = false;

if (REPORT_PHONE_FAX && is_array($array_fields) && (in_array("phone", $array_fields) || in_array("contact_phone", $array_fields))) {
    $item_hasphone = true;
}
if (is_array($array_fields) && in_array("url", $array_fields)) {
    $item_haswebsite = true;
}
if (REPORT_PHONE_FAX && is_array($array_fields) && in_array("fax", $array_fields)) {
    $item_hasfax = true;
}
if (is_array($array_fields) && (in_array("email", $array_fields) || in_array("contact_email", $array_fields))) {
    $item_hasemail = true;
}

$item_hasreview = false;

if ($review_enabled == "on") {

    $item_hasreview = true;

    //Avg review
    $item_avgreview = $itemObj->getNumber("avg_review");

    // Page Browsing /////////////////////////////////////////
    $where = "Review.item_type = '" . strtolower($item_type) . "' AND Review.item_id = '$item_id' AND Review.item_id = $reviewTable.id AND $reviewTable.account_id = '$acctId'";

    $pageObj = new pageBrowsing("Review, $reviewTable", $screen, false, "approved, added DESC", "review_title", $letter,
        $where, "Review.*");
    $reviewsArrTmp = $pageObj->retrievePage("array");
    $newReviews = 0;
    if ($reviewsArrTmp) {
        foreach ($reviewsArrTmp as $each_reviewsArrTmp) {
            $reviewsArr[] = new Review($each_reviewsArrTmp["id"]);
            if ($each_reviewsArrTmp["new"] == "y") {
                $newReviews++;
            }
        }
    }

    if ($newReviews == 1) {
        $newReviewsTip = str_replace("[x]", $newReviews, system_showText(LANG_LABEL_NEW_REVIEW));
    } else {
        $newReviewsTip = str_replace("[x]", $newReviews, system_showText(LANG_LABEL_NEW_REVIEWS));
    }

}

if ($reports) {

    foreach ($reports as $key => $report) {
        //Total Stats for box "Activity Report"
        $item_phoneviews += $report["phone"];
        $item_faxviews += $report["fax"];
        $item_websiteviews += $report["click"];
        $item_leads += $report["email"];
        $banner_views += $report["view"];
        $banner_clicks += $report["click_thru"];

    }

}

//Number views
$item_hasDetail = false;
if (($levelObj && $levelObj->getDetail($itemObj->getNumber("level")) == "y") || strtolower($item_type) == "promotion") {
    $item_hasDetail = true;
    $item_numberviews = $itemObj->getNumber("number_views");
}

//Website clicks
$showBannerClicks = false;
if ($itemObj->getString("destination_url")) {
    $showBannerClicks = true;
}

$item_hasActivity = false;
if ($item_hasDetail || $item_hasphone || $item_haswebsite || $item_hasfax || $item_hasemail || $item_hasreview || strtolower($item_type) == "banner") {
    $item_hasActivity = true;
}

//Leads
if ($item_hasemail) {

    // Page Browsing /////////////////////////////////////////
    $where = " Leads.type = '" . strtolower($item_type) . "' AND Leads.item_id = '$item_id' AND Leads.item_id = $leadTable.id AND $leadTable.account_id = '$acctId'";

    $pageObj = new pageBrowsing("Leads, $leadTable", $screen, false, "entered DESC", "first_name", $letter, $where,
        "Leads.*");
    $leadsArrTmp = $pageObj->retrievePage("array");
    $newLeads = 0;
    if ($leadsArrTmp) {
        foreach ($leadsArrTmp as $each_leadssArrTmp) {
            $auxLeadObj = new Lead($each_leadssArrTmp["id"]);
            $leadsArr[] = $auxLeadObj->data_in_array;
            if ($each_leadssArrTmp["new"] == "y") {
                $newLeads++;
            }
        }
    }

    if ($newLeads == 1) {
        $newLeadsTip = str_replace("[x]", $newLeads, system_showText(LANG_LABEL_NEW_LEAD));
    } else {
        $newLeadsTip = str_replace("[x]", $newLeads, system_showText(LANG_LABEL_NEW_LEADS));
    }

}

//Deals Redeemed
if (strtolower($item_type) == "promotion") {
    $pageObj = new pageBrowsing("Promotion_Redeem", $screen, false, "id DESC", false, false, "promotion_id = $item_id",
        "*", false, false, false, SELECTED_DOMAIN_ID);
    $dealsRedeemed = $pageObj->retrievePage("array");
}

//Max reviews/leads shown per block
$maxItems = 3;

if (is_ie(true) || ($checkIE && $ieVersion <= 8)) {
    $showChart = false;
} else {
    $showChart = true;
}
