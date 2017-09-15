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
# * FILE: /includes/views/member_dashboard.php
# ----------------------------------------------------------------------------------------------------

?>

<div class="dashboard">

    <header>

        <? if ($visibilityButton) { ?>
            <a href="<?= $item_levellink; ?>" class="btn btn-primary"><?= system_showText(LANG_LABEL_INCREASEVISIBILITY); ?></a>
        <? } ?>

        <h1><?= $item_title; ?></h1>

        <? if ($impressions_fieldText) { ?>
            <p>
                <b><?= $impressions_fieldText; ?></b>

                <? if (!$impressions_field) { ?>
                    <a class="floating-tip" href="<?= DEFAULT_URL ?>/<?= MEMBERS_ALIAS ?>/billing/index.php"><?= system_showText(LANG_LABEL_RENEW); ?></a>
                <? } ?>
            </p>
        <? } elseif ($item_new) { ?>
            <p><b><?= $item_new; ?></b></p>
        <? } elseif ($item_renewal) { ?>
            <p id="item_renewal" title="<?= system_showText(LANG_LABEL_EXPIRESON); ?> <?= $item_renewal_formatted; ?>"><?= system_showText(LANG_LABEL_EXPIRESON); ?>
                <b><?= $item_renewal; ?></b> <?= $item_renewal_period ?>
                <a class="floating-tip" href="<?= DEFAULT_URL ?>/<?= MEMBERS_ALIAS ?>/billing/index.php"><?= system_showText(LANG_LABEL_RENEW); ?></a>
            </p>
        <? } elseif ($hastocheckout) { ?>
            <p>
                <a class="floating-tip" href="<?= DEFAULT_URL ?>/<?= MEMBERS_ALIAS ?>/billing/index.php"><?= system_showText(@constant("LANG_MSG_CONTINUE_TO_PAY_" . string_strtoupper($item_type))); ?></a>
            </p>
        <? } ?>

    </header>

    <? if ($arrayCompletion["total"] < 100) { ?>

        <section class="game-completion">

            <div class="row">

                <div class="col-sm-5">
                    <h5><?= system_showText(constant("LANG_LABEL_" . string_strtoupper($item_type) . "_COMPLETION")); ?></h5>

                    <p><?= system_showText(LANG_LABEL_GAMEFY_TIP); ?></p>
                </div>

                <div class="col-sm-7">

                    <div class="completion-chart">
                        <input type="text" value="<?= $arrayCompletion["total"] ?>" class="dial"><span>%</span>
                    </div>

                    <div class="step large-step <?= ($arrayCompletion["highlight"] == "desc" ? "highlight" : "") ?>">

                        <? if (is_numeric($arrayCompletion["desc"]) && $arrayCompletion["desc"] < 100) { ?>
                            <p>
                                <a href="<?= $item_link ?>&highlight=description"><?= system_showText(LANG_LABEL_GAMEFY_DESC); ?></a>
                            </p>
                        <? } ?>

                        <? if (is_numeric($arrayCompletion["media"]) && $arrayCompletion["media"] < 100) { ?>
                            <p>
                                <a href="<?= $item_link ?>&highlight=media"><?= system_showText(LANG_LABEL_GAMEFY_MEDIA); ?></a>
                            </p>
                        <? } ?>

                        <? if (is_numeric($arrayCompletion["additional"]) && $arrayCompletion["additional"] < 100) { ?>
                            <p>
                                <a href="<?= $item_link ?>&highlight=additional"><?= system_showText(LANG_LABEL_GAMEFY_ADDITIONAL); ?></a>
                            </p>
                        <? } ?>

                    </div>

                </div>

            </div>

        </section>

    <? }

    /* Will print chart HTML if $showChart is true :
     * If its not IE or if there was any data to show */
    $showChart and $superReports and $superReports->renderGraphs($reportData);

    if ($item_hasActivity) { ?>

        <section class="stats-summary">

            <h2><?= system_showText(LANG_LABEL_ACTIVITYREPORT); ?></h2>

            <div class="row">

                <? if ($item_hasDetail || $item_type == "Banner") { ?>

                    <div class="col-sm-4">
                        <h1><?= ($item_type == "Banner" ? $banner_views : $item_numberviews); ?></h1>

                        <p><?= system_showText(LANG_LABEL_TOTALVIEWERS); ?></p>
                    </div>

                <? }

                if ($item_type == "Banner" && $showBannerClicks) { ?>

                    <div class="col-sm-4">
                        <h1><?= $banner_clicks; ?></h1>

                        <p><?= system_showText(LANG_LABEL_WEBSITEVIEWS); ?></p>
                    </div>

                <? } ?>

                <div class="col-sm-4">

                    <?
                    if ($item_hasemail) { ?>

                        <h5><?= count($leadsArr) ?></h5>

                        <p><?= system_showText(constant("LANG_LABEL_LEAD" . (count($leadsArr) == 1 ? "" : "S"))); ?></p>

                        <? if (count($leadsArr)) { ?>
                            <p>
                                <a href="javascript:void(0);" onclick="scrollPage('#leads-list');"><?= system_showText(LANG_LABEL_SEE_LEADS); ?></a>
                                <? if ($newLeads) { ?>
                                    <em class="alert-new" title="<?= $newLeadsTip; ?>"><?= ($newLeads > 10 ? "9+" : $newLeads) ?></em>
                                <? } ?>
                            </p>
                        <? } ?>


                    <? }

                    if (($item_hasphone || $item_haswebsite || $item_hasfax) && strtolower($item_type) == "listing") { ?>


                        <? if ($item_hasphone) { ?>
                            <p><?= $item_phoneviews; ?> <?= system_showText(constant("LANG_LABEL_PHONEVIEW" . ($item_phoneviews == 1 ? "" : "S"))); ?></p>
                        <? } ?>

                        <? if ($item_haswebsite) { ?>
                            <p><?= $item_websiteviews; ?> <?= system_showText(constant("LANG_LABEL_WEBSITEVIEW" . ($item_websiteviews == 1 ? "" : "S"))); ?></p>
                        <? } ?>

                        <? if ($item_hasfax) { ?>
                            <p><?= $item_faxviews; ?> <?= system_showText(constant("LANG_LABEL_FAXVIEW" . ($item_faxviews == 1 ? "" : "S"))); ?></p>
                        <? } ?>

                    <? }

                    ?>


                </div>

                <?
                if ($item_hasreview) { ?>

                    <div class="col-sm-4">

                        <div class="large-rating">
                            <div class="stars-rating">
                                <div class="rate-<?= $item_avgreview; ?>"></div>
                            </div>
                        </div>

                        <p><?= system_showText(LANG_LABEL_BASED_ON); ?> <?= count($reviewsArr) ?> <?= (count($reviewsArr) == 1 ? LANG_REVIEW : LANG_REVIEW_PLURAL) ?></p>

                        <? if (count($reviewsArr)) { ?>
                            <p>
                                <a href="javascript:void(0);" onclick="scrollPage('#reviews-list');"><?= system_showText(LANG_LABEL_SEE_REVIEWS); ?></a>
                                <? if ($newReviews) { ?>
                                    <em class="alert-new" title="<?= $newReviewsTip; ?>"><?= ($newReviews > 10 ? "9+" : $newReviews) ?></em>
                                <? } ?>
                            </p>
                        <? } ?>

                    </div>

                <? } ?>

            </div>

        </section>

    <? }

    if ($item_hasreview) { ?>

        <section class="reviews-list" id="reviews-list">

            <h2><?= system_showText(LANG_REVIEW_PLURAL); ?></h2>

            <div class="row head">

                <? if ($item_status == "A") { ?>

                    <div class="col-sm-9">
                        <p>
                            <a <?= $shareFacebook ?>><i class="fa fa-facebook-square"></i></a>
                            <a <?= $shareTwitter ?>><i class="fa fa-twitter-square"></i></a>
                            <?= system_showText(LANG_LABEL_DASHBOARD_SHARE); ?>
                        </p>
                    </div>

                <? } ?>

                <div class="col-sm-<?= ($item_status == "A" ? "3" : "12") ?>">
                    <p class="paging"><?= count($reviewsArr) ?> <?= (count($reviewsArr) == 1 ? LANG_REVIEW : LANG_REVIEW_PLURAL) ?></p>
                </div>

            </div>

            <?
            $countReview = 1;

            if ($reviewsArr) {
                foreach ($reviewsArr as $each_rate) {

                    //Review Title
                    if ($each_rate->getString("review_title")) {
                        $review_title = $each_rate->getString("review_title");
                    } else {
                        $review_title = system_showText(LANG_NA);
                    }

                    //Reviewer Name
                    if ($each_rate->getString("reviewer_name")) {
                        $reviewer_name = $each_rate->getString("reviewer_name");
                    } else {
                        $reviewer_name = system_showText(LANG_NA);
                    }

                    //Reviewer Image
                    $imgTag = "";
                    if ($each_rate->getNumber("member_id")) {
                        $profile = new Profile($each_rate->getNumber("member_id"));
                        $imgTag = socialnetwork_writeLink($each_rate->getNumber("member_id"), "", "",
                            $profile->getNumber("image_id"), false, false, "", true, "user-profile", true);
                    } elseif (SOCIALNETWORK_FEATURE == "on") {
                        $imgTag = "<img src=\"" . DEFAULT_URL . "/assets/images/structure/icon-user-thumb.gif\" alt=\"$reviewer_name\">";
                    }

                    //Review Status
                    $pending = true;
                    if ($each_rate->getNumber("approved") == 0) {

                        if (string_strlen(trim($each_rate->getString("response"))) > 0) {

                            //Pending Review and Pending Reply
                            if ($each_rate->getNumber("responseapproved") == 0) {
                                $reviewStatus = system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY);
                            } else {
                                //Pending Review
                                $reviewStatus = system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW);
                            }

                        } else {
                            //Pending Review
                            $reviewStatus = system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW);
                        }

                    } elseif ($each_rate->getNumber("approved") == 1) {

                        if (string_strlen(trim($each_rate->getString("response"))) == 0) {

                            //Review approved
                            $pending = false;
                            $reviewStatus = system_showText(LANG_MSG_REVIEW_ALREADY_APPROVED);

                        } elseif (string_strlen($each_rate->getString("response")) > 0) {

                            //Reply pending
                            if ($each_rate->getNumber("responseapproved") == 0) {
                                $reviewStatus = system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY);
                            } else {
                                //Review and reply approved
                                $pending = false;
                                $reviewStatus = system_showText(LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED);
                            }

                        }

                    }

                    ?>

                    <div class="item-review" id="item-review_<?= $countReview ?>" <?= $countReview > $maxItems ? "style=\"display:none;\"" : "" ?>>

                        <div class="review-summary <?= ($each_rate->getString("new") == "y" ? "new" : ""); ?>" onclick="reviewBox('show', <?= $each_rate->getNumber("id") ?>);" id="review-summary-<?= $each_rate->getNumber("id") ?>">

                    <span class="pull-right">
                        <a href="javascript:void(0);"><?= system_showText(LANG_LABEL_VIEW) ?> </a>
                        |<a href="javascript:void(0);" onclick="showReply(<?= $each_rate->getNumber("id"); ?>);"> <?= system_showText(($each_rate->getString("response") ? LANG_LABEL_EDIT_REPLY : LANG_LABEL_REPLY)); ?></a>
                    </span>

                            <b><?= $review_title; ?></b>

                            <br>

                            <div class="stars-rating">
                                <div class="rate-<?= $each_rate->getString("rating") ?>"></div>
                            </div>

                            <time> <?= ($each_rate->getString("added")) ? format_date($each_rate->getString("added"),
                                    DEFAULT_DATE_FORMAT, "datestring") : system_showText(LANG_NA); ?></time>

                            <p><?= system_showTruncatedText($each_rate->getString("review", true), 60) ?> -
                                <em><?= $reviewer_name ?></em></p>

                        </div>

                        <div class="review-detail" id="review-detail-<?= $each_rate->getNumber("id") ?>" style="display:none">

                            <a href="javascript:void(0);" onclick="reviewBox('hide', <?= $each_rate->getNumber("id") ?>);" class="pull-right"><?= ucfirst(system_showText(LANG_HIDE)) ?></a>

                            <? if ($pending) { ?>
                                <small class="text-warning"><?= $reviewStatus; ?></small>
                            <? } ?>
                            <div>
                                <?= $imgTag; ?>

                                <p><?= system_showText(LANG_LABEL_REVIEWBY); ?> <b><?= $reviewer_name ?></b></p>

                                <time><?= ($each_rate->getString("added")) ? format_date($each_rate->getString("added"),
                                        DEFAULT_DATE_FORMAT, "datestring") : system_showText(LANG_NA); ?></time>

                                <div class="large-rating">
                                    <div class="stars-rating">
                                        <div class="rate-<?= $each_rate->getString("rating") ?>"></div>
                                    </div>
                                </div>
                            </div>

                            <q class="review-text"><?= $each_rate->getString("review", true); ?></q>

                            <? if (string_strlen(trim($each_rate->getString("response"))) > 0) { ?>
                                <blockquote class="blockquote-sm">
                                    <span><?= system_showtext(LANG_LABEL_REPLY); ?>:</span>
                                    <?= nl2br($each_rate->getString("response")); ?>
                                </blockquote>
                            <? } ?>

                            <span class="text-right">
                        <a class="btn btn-primary btn-xs" href="javascript:void(0);" onclick="showReply(<?= $each_rate->getNumber("id"); ?>);" id="link_reply<?= $each_rate->getNumber("id"); ?>"><?= system_showText(($each_rate->getString("response") ? LANG_LABEL_EDIT_REPLY : LANG_LABEL_REPLY)); ?></a>
                        <a class="btn btn-default btn-xs" href="javascript:void(0);" onclick="hideReply(<?= $each_rate->getNumber("id"); ?>);" id="cancel_reply<?= $each_rate->getNumber("id"); ?>" style="display:none;"><?= system_showText(LANG_CANCEL); ?></a>
                    </span>


                            <div class="replythis" style="display:none;" id="review_reply<?= $each_rate->getNumber("id"); ?>">

                                <form name="formReply<?= $each_rate->getNumber("id"); ?>" id="formReply<?= $each_rate->getNumber("id"); ?>" method="post" action="javascript:void(0);">

                                    <p class="successMessage" id="msgReviewS<?= $each_rate->getNumber("id"); ?>" style="display:none"><?= system_showText(LANG_REPLY_SUCCESSFULLY); ?></p>

                                    <p class="errorMessage" id="msgReviewE<?= $each_rate->getNumber("id"); ?>" style="display:none"><?= system_showText(LANG_REPLY_EMPTY); ?></p>

                                    <input type="hidden" name="item_id" value="<?= $each_rate->getNumber("item_id"); ?>">
                                    <input type="hidden" name="item_type" value="<?= $each_rate->getNumber("item_type"); ?>">
                                    <input type="hidden" name="idReview" value="<?= $each_rate->getNumber("id"); ?>">
                                    <input type="hidden" name="ajax_type" value="review_reply">

                                    <div class="form-group">
                                        <label for="reply<?= $each_rate->getNumber("id"); ?>"><?= system_showText(LANG_LABEL_WRITE_REPLY); ?></label>
                                        <textarea class="form-control" cols="40" rows="8" name="reply" id="reply<?= $each_rate->getNumber("id"); ?>"><?= $each_rate->getString("response"); ?></textarea>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" name="submit" id="submitReply<?= $each_rate->getNumber("id"); ?>" onclick="saveReply(<?= $each_rate->getNumber("id"); ?>);" class="btn btn-success"><?= system_showText(LANG_BUTTON_SUBMIT) ?></button>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    <?
                    $countReview++;
                }
            }

            if ($countReview > ($maxItems + 1)) { ?>

                <div class="viewmore">
                    <a id="linkMorereviews" href="javascript:void(0);" onclick="showmore('item-review_', 'linkMorereviews', <?= $countReview ?>, <?= $maxItems ?>);"><?= system_showText(LANG_VIEWMORE); ?></a>
                    <input type="hidden" id="item-review_" value="<?= $maxItems ?>">
                </div>

            <? } ?>

        </section>

    <? }

    if ($item_hasemail) { ?>

        <section class="reviews-list" id="leads-list">

            <h2><?= system_showText(LANG_LABEL_LEADS); ?></h2>

            <div class="row head">

                <? if ($item_status == "A") { ?>

                    <div class="col-sm-9">
                        <p>
                            <a <?= $shareFacebook ?>><i class="fa fa-facebook-square"></i></a>
                            <a <?= $shareTwitter ?>><i class="fa fa-twitter-square"></i></a>
                            <?= system_showText(LANG_LABEL_DASHBOARD_SHARE2); ?>
                        </p>
                    </div>

                <? } ?>

                <div class="col-sm-<?= ($item_status == "A" ? "3" : "12") ?>">
                    <p class="paging"><?= count($leadsArr) ?> <?= (count($leadsArr) == 1 ? LANG_LABEL_LEAD : LANG_LABEL_LEADS) ?></p>
                </div>

            </div>

            <?
            $countLead = 1;
            if ($leadsArr) {
                foreach ($leadsArr as $each_lead) {

                    $auxMessage = @unserialize($each_lead["message"]);
                    if (is_array($auxMessage)) {
                        $each_lead["message"] = "";
                        foreach ($auxMessage as $key => $value) {
                            $each_lead["message"] .= (defined($key) ? constant($key) : $key) . ($value ? ": " . $value : "") . "\n";
                        }
                    }

                    $replied = false;
                    if ($each_lead["reply_date"] && $each_lead["reply_date"] != "0000-00-00 00:00:00") {
                        $replied = true;
                        $titleIco = system_showText(LANG_LEAD_REPLIED_ICO) . " (" . format_date($each_lead["reply_date"],
                                DEFAULT_DATE_FORMAT, "datestring") . ")";
                    }
                    $titleIcoToday = system_showText(LANG_LEAD_REPLIED_ICO) . " (" . format_date(date("Y") . "-" . date("m") . "-" . date("d"),
                            DEFAULT_DATE_FORMAT, "datestring") . ")";

                    $lead_name = $each_lead["first_name"] . ($each_lead["last_name"] ? " " . $each_lead["last_name"] : "");

                    ?>

                    <div class="panel panel-default item-review" id="item-lead_<?= $countLead ?>" <?= $countLead > $maxItems ? "style=\"display:none;\"" : "" ?>>

                        <div class="panel-heading review-summary <?= ($each_lead["new"] == "y" ? "new" : ""); ?>" onclick="leadBox('show', <?= $each_lead["id"] ?>);" id="lead-summary-<?= $each_lead["id"] ?>">

                            <a href="javascript:void(0);" class="pull-right"><?= system_showText(LANG_LABEL_VIEW) ?></a>

                            <b><?= $lead_name ?> </b>

                            <time> <?= ($each_lead["entered"]) ? format_date($each_lead["entered"], DEFAULT_DATE_FORMAT,
                                    "datestring") : system_showText(LANG_NA); ?></time>

                            <span><?= $each_lead["subject"]; ?></span>

                        </div>

                        <div class="review-detail" id="lead-detail-<?= $each_lead["id"] ?>" style="display:none">
                            <div class="panel-body">
                                <a href="javascript:void(0);" onclick="leadBox('hide', <?= $each_lead["id"] ?>);" class="pull-right"><?= ucfirst(system_showText(LANG_HIDE)); ?></a>

                                <? if ($replied) { ?>
                                    <p id="title_replied<?= $each_lead["id"] ?>" class="text-success"><?= system_showText($titleIco) ?></p>
                                <? } ?>
                                <p id="new_replied<?= $each_lead["id"] ?>" style="display:none;" class="text-success"><?= $titleIcoToday; ?></p>

                                <p><?= system_showText(LANG_LABEL_FROM); ?> <b><?= $lead_name ?></b></p>

                                <time><?= ($each_lead["entered"]) ? format_date($each_lead["entered"],
                                        DEFAULT_DATE_FORMAT, "datestring") : system_showText(LANG_NA); ?></time>

                                <p class="review-text">
                                <blockquote class="blockquote-sm"><?= nl2br($each_lead["message"]); ?></blockquote>
                                </p>


                            </div>
                            <div class="panel-footer">
                                <div class="text-right">
                                    <a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="showLead(<?= $each_lead["id"]; ?>);" id="link_lead<?= $each_lead["id"]; ?>"><?= system_showText(LANG_LABEL_REPLY); ?></a>
                                    <a class="btn btn-xs btn-default" href="javascript:void(0);" onclick="hideLead(<?= $each_lead["id"]; ?>);" id="cancel_lead<?= $each_lead["id"]; ?>" style="display:none;"><?= system_showText(LANG_CANCEL); ?></a>
                                </div>

                                <div class="replythis" style="display:none;" id="lead_reply<?= $each_lead["id"]; ?>">


                                    <form name="formLead<?= $each_lead["id"]; ?>" id="formLead<?= $each_lead["id"]; ?>" method="post" action="javascript:void(0);">

                                        <p class="alert alert-success" id="msgLeadS<?= $each_lead["id"]; ?>" style="display:none"><?= system_showText(LANG_LEAD_REPLIED); ?></p>

                                        <p class="alert alert-warning" id="msgLeadE<?= $each_lead["id"]; ?>" style="display:none"></p>

                                        <input type="hidden" name="item_id" value="<?= $item_id; ?>">
                                        <input type="hidden" name="item_type" value="<?= $item_type; ?>">
                                        <input type="hidden" name="type" value="<?= $item_type; ?>">
                                        <input type="hidden" name="idLead" value="<?= $each_lead["id"]; ?>">
                                        <input type="hidden" name="action" value="reply">
                                        <input type="hidden" name="ajax_type" value="lead_reply">

                                        <div class="form-group">
                                            <label for="lead-mail"><?= system_showText(LANG_LABEL_TO); ?>: </label>
                                            <input id="lead-mail" class="form-control" type="email" name="to" value="<?= ($to && $action == "reply" && $idLead == $each_lead["id"] ? $to : $each_lead["email"]); ?>">


                                            <label for="lead-message"><?= system_showText(LANG_LABEL_MESSAGE); ?>
                                                :</label>
                                            <textarea id="lead-message" class="form-control" name="message" rows="5"><?= ($message && $action == "reply" && $idLead == $each_lead["id"] ? $message : ""); ?></textarea>
                                        </div>

                                        <div class="text-center ">
                                            <hr>
                                            <button type="button" name="submit" id="submitLead<?= $each_lead["id"]; ?>" onclick="saveLead(<?= $each_lead["id"]; ?>);" class="btn btn-success"><?= system_showText(LANG_BUTTON_SUBMIT) ?></button>
                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>

                    </div>

                    <?
                    $countLead++;
                }
            }

            if ($countLead > ($maxItems + 1)) { ?>

                <div class="viewmore">
                    <a id="linkMoreleads" href="javascript:void(0);" onclick="showmore('item-lead_', 'linkMoreleads', <?= $countLead ?>, <?= $maxItems ?>);"><?= system_showText(LANG_VIEWMORE); ?></a>
                    <input type="hidden" id="item-lead_" value="<?= $maxItems ?>">
                </div>

            <? } ?>

        </section>

    <? }

    if (strtolower($item_type) == "promotion") { ?>

        <section id="deals-list" class="reviews-list">

            <h2><?= system_showText(LANG_LABEL_ACCOUNT_DEALS) ?></h2>

            <div class="row head">

                <? if ($item_status == "A") { ?>

                    <div class="col-sm-9">
                        <p>
                            <a <?= $shareFacebook ?>><i class="fa fa-facebook-square"></i></a>
                            <a <?= $shareTwitter ?>><i class="fa fa-twitter-square"></i></a>
                            <?= system_showText(LANG_LABEL_DASHBOARD_SHARE3); ?>
                        </p>
                    </div>

                <? } ?>

                <div class="col-sm-<?= ($item_status == "A" ? "3" : "12") ?>">
                    <p class="paging"><?= count($dealsRedeemed) ?> <?= (count($dealsRedeemed) == 1 ? system_showText(LANG_PROMOTION_FEATURE_NAME) : system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL)) ?></p>
                </div>

            </div>

            <?
            $countDeal = 1;
            if ($dealsRedeemed) {
                foreach ($dealsRedeemed as $eachDeal) {

                    $profileObj = new Profile($eachDeal["account_id"]);
                    $imgTag = "";
                    if ($profileObj->getString("nickname")) {
                        $eachDeal["profile_name"] = $profileObj->getString("nickname");
                        $imgTag = socialnetwork_writeLink($eachDeal["account_id"], "", "",
                            $profileObj->getNumber("image_id"), false, false, "", true, "user-profile", true);
                    } elseif (SOCIALNETWORK_FEATURE == "on") {
                        $imgTag = "<img src=\"" . DEFAULT_URL . "/assets/images/structure/icon-user-thumb.gif\" alt=\"$reviewer_name\">";
                    }

                    ?>

                    <div class="item-review" id="item-deal_<?= $countDeal ?>" <?= $countDeal > $maxItems ? "style=\"display:none;\"" : "" ?>>

                        <div class="review-summary" onclick="dealBox('show', <?= $eachDeal["id"] ?>);" id="deal-summary-<?= $eachDeal["id"] ?>">

                            <a class="pull-right" href="javascript:void(0);"><?= ucfirst(system_showText(LANG_LABEL_VIEW)); ?></a>

                            <b><?= $eachDeal["profile_name"] ?></b>

                            <time> <?= ($eachDeal["datetime"]) ? format_date($eachDeal["datetime"], DEFAULT_DATE_FORMAT,
                                    "datestring") : system_showText(LANG_NA); ?></time>

                            <span id="label_used<?= $eachDeal["id"] ?>" <?= ($eachDeal["used"] ? "style=\"display:none\"" : "") ?>><?= ucwords(system_showText(system_showText(LANG_DEAL_OPENED))); ?></span>

                        </div>

                        <div class="review-detail" id="deal-detail-<?= $eachDeal["id"] ?>" style="display:none">

                            <a href="javascript:void(0);" onclick="dealBox('hide', <?= $eachDeal["id"] ?>);" class="pull-right"><?= ucfirst(system_showText(LANG_HIDE)); ?></a>

                            <?= $imgTag; ?>

                            <p><?= system_showText(LANG_LABEL_REDEEMED_BY); ?> <b><?= $eachDeal["profile_name"] ?></b>
                            </p>

                            <time><?= ($eachDeal["datetime"]) ? format_date($eachDeal["datetime"], DEFAULT_DATE_FORMAT,
                                    "datestring") : system_showText(LANG_NA); ?></time>

                            <p><em><?= system_showText(LANG_LABEL_CODE) ?>: <?= $eachDeal["redeem_code"] ?></em></p>


                            <form class="form-inline">
                                <label>
                                    <input type="radio" name="status" <?= $eachDeal["used"] ? "checked" : "" ?> onclick="changeDealStatus('useDeal', <?= $eachDeal["id"] ?>, '<?= $eachDeal["redeem_code"] ?>');"><?= ucwords(system_showText(LANG_DEAL_CHECKOUT)); ?>
                                </label>
                                <label>
                                    <input type="radio" name="status" <?= $eachDeal["used"] ? "" : "checked" ?> onclick="changeDealStatus('freeUpDeal', <?= $eachDeal["id"] ?>, '<?= $eachDeal["redeem_code"] ?>');"><?= ucwords(system_showText(LANG_DEAL_OPENED)); ?>
                                </label>
                            </form>


                        </div>

                    </div>

                    <?
                    $countDeal++;
                }
            }

            if ($countDeal > ($maxItems + 1)) { ?>

                <div class="viewmore">
                    <a id="linkMoredeals" href="javascript:void(0);" onclick="showmore('item-deal_', 'linkMoredeals', <?= $countDeal ?>, <?= $maxItems ?>);"><?= system_showText(LANG_VIEWMORE); ?></a>
                    <input type="hidden" id="item-deal_" value="<?= $maxItems ?>">
                </div>

            <? } ?>

        </section>

    <? } ?>

</div>
