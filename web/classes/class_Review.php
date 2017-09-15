<?

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
# * FILE: /classes/class_review.php
# ----------------------------------------------------------------------------------------------------

class Review extends Handle
{

    var $id;
    var $item_type;
    var $item_id;
    var $member_id;
    var $added;
    var $ip;
    var $rating;
    var $review_title;
    var $review;
    var $reviewer_name;
    var $reviewer_email;
    var $reviewer_location;
    var $approved;
    var $response;
    var $responseapproved;
    var $new;
    var $like;
    var $dislike;
    var $like_ips;
    var $dislike_ips;

    function Review($var = "")
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
            $sql = "SELECT * FROM Review WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));
            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = [];
            }
            $this->makeFromRow($var);
        }
    }

    function makeFromRow($row = "")
    {

        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->item_type = ($row["item_type"]) ? $row["item_type"] : ($this->item_type ? $this->item_type : "");
        $this->item_id = ($row["item_id"]) ? $row["item_id"] : ($this->item_id ? $this->item_id : 0);
        $this->member_id = ($row["member_id"]) ? $row["member_id"] : ($this->member_id ? $this->member_id : "NULL");
        $this->added = ($row["added"]) ? $row["added"] : ($this->added ? $this->added : "");
        $this->ip = ($row["ip"]) ? $row["ip"] : ($this->ip ? $this->ip : "");
        $this->rating = ($row["rating"]) ? $row["rating"] : ($this->rating ? $this->rating : "");
        $this->review_title = ($row["review_title"]) ? $row["review_title"] : "";
        $this->review = ($row["review"]) ? $row["review"] : "";
        $this->reviewer_name = ($row["reviewer_name"]) ? $row["reviewer_name"] : "";
        $this->reviewer_email = ($row["reviewer_email"]) ? $row["reviewer_email"] : "";
        $this->reviewer_location = ($row["reviewer_location"]) ? $row["reviewer_location"] : "";
        $this->approved = ($row["approved"]) ? $row["approved"] : 0;
        $this->response = ($row["response"]) ? $row["response"] : "";
        $this->responseapproved = ($row["responseapproved"]) ? $row["responseapproved"] : 0;
        $this->new = ($row["new"]) ? $row["new"] : ($this->new ? $this->new : "y");
        $this->like = ($row["like"]) ? $row["like"] : ($this->like ? $this->like : 0);
        $this->dislike = ($row["dislike"]) ? $row["dislike"] : ($this->dislike ? $this->dislike : 0);
        $this->like_ips = ($row["like_ips"]) ? $row["like_ips"] : ($this->like_ips ? $this->like_ips : "");
        $this->dislike_ips = ($row["dislike_ips"]) ? $row["dislike_ips"] : ($this->dislike_ips ? $this->dislike_ips : "");

    }

    function Save()
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $this_status = $this->approved;
        $this_statusResponse = $this->responseapproved;

        $this->prepareToSave();

        if ($this->id) {

            $sql = "SELECT approved FROM Review WHERE id = $this->id";
            $result = $dbObj->query($sql);
            if ($row = mysql_fetch_assoc($result)) {
                $last_status = $row["approved"];
            }

            $sql = "UPDATE Review SET"
                . " item_type           = $this->item_type,"
                . " item_id             = $this->item_id,"
                . " member_id           = $this->member_id,"
                . " added               = $this->added,"
                . " ip                  = $this->ip,"
                . " rating              = $this->rating,"
                . " review_title        = $this->review_title,"
                . " review              = $this->review,"
                . " reviewer_name       = $this->reviewer_name,"
                . " reviewer_email      = $this->reviewer_email,"
                . " reviewer_location   = $this->reviewer_location,"
                . " approved            = $this->approved,"
                . " response            = $this->response,"
                . " responseapproved    = $this->responseapproved,"
                . " new                 = $this->new,"
                . " `like`              = $this->like,"
                . " `dislike`           = $this->dislike,"
                . " `like_ips`          = $this->like_ips,"
                . " `dislike_ips`       = $this->dislike_ips"
                . " WHERE id            = $this->id";

            $dbObj->query($sql);

            if ($this->item_type == "'article'") {
                $article = new Article(str_replace("'", "", $this->item_id));
                $item_title = $article->getString("title");
                $item = "review_article";
            } else {
                if ($this->item_type == "'promotion'") {
                    $promotion = new Promotion(str_replace("'", "", $this->item_id));
                    $item_title = $promotion->getString("name");
                    $item = "review_promotion";
                } else {
                    $listing = new Listing(str_replace("'", "", $this->item_id));
                    $item_title = $listing->getString("title");
                    $item = "review_listing";
                }
            }

        } else {

            $sql = "INSERT INTO Review"
                . " (item_type,"
                . " item_id,"
                . " member_id,"
                . " added,"
                . " ip,"
                . " rating,"
                . " review_title,"
                . " review,"
                . " reviewer_name,"
                . " reviewer_email,"
                . " reviewer_location,"
                . " approved,"
                . " response,"
                . " responseapproved"
                . " )"
                . " VALUES"
                . " ("
                . " $this->item_type,"
                . " $this->item_id,"
                . " $this->member_id,"
                . " NOW(),"
                . " $this->ip,"
                . " $this->rating,"
                . " $this->review_title,"
                . " $this->review,"
                . " $this->reviewer_name,"
                . " $this->reviewer_email,"
                . " $this->reviewer_location,"
                . " $this->approved,"
                . " $this->response,"
                . " $this->responseapproved"
                . " )";

            $dbObj->query($sql);

            $this->id = mysql_insert_id($dbObj->link_id);

            if ($this->item_type == "'article'") {
                $article = new Article(str_replace("'", "", $this->item_id));
                $item_title = $article->getString("title");
                $item = "review_article";
            } else {
                if ($this->item_type == "'promotion'") {
                    $promotion = new Promotion(str_replace("'", "", $this->item_id));
                    $item_title = $promotion->getString("name");
                    $item = "review_promotion";
                } else {
                    $listing = new Listing(str_replace("'", "", $this->item_id));
                    $item_title = $listing->getString("title");
                    $item = "review_listing";
                }
            }

            $rowTimeline = [];
            $rowTimeline["item_type"] = "review";
            $rowTimeline["action"] = "new";
            $rowTimeline["item_id"] = $this->id;
            $timelineObj = new Timeline($rowTimeline);
            $timelineObj->save();

        }

        $this->prepareToUse();

    }

    function Delete($domain_id = false)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if ($domain_id) {
            $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
        } else {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);
        }

        ### Timeline
        $sql = "DELETE FROM Timeline WHERE item_type = 'review' AND item_id = $this->id";
        $dbObj->query($sql);

        $sql = "DELETE FROM Review WHERE id = $this->id";
        $dbObj->query($sql);

        switch ($this->item_type) {
            case "article":
                $item = "review_article";

                if ($this->item_id and $symfonyContainer = SymfonyCore::getContainer()) {
                    $symfonyContainer->get("article.synchronization")->addUpsert($this->item_id);
                }
            break;
            case "listing":
                $item = "review_listing";

                if ($this->item_id and $symfonyContainer = SymfonyCore::getContainer()) {
                    $symfonyContainer->get("listing.synchronization")->addUpsert($this->item_id);
                }
                break;
        }

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $reviewObj->deletePerAccount($account_id);
     * <br /><br />
     *        //Using this in Review() class.
     *        $this->deletePerAccount($account_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name deletePerAccount
     * @access Public
     * @param integer $account_id
     * @param integer $domain_id
     */
    function deletePerAccount($account_id = 0, $domain_id = false)
    {
        if (is_numeric($account_id) && $account_id > 0) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id) {
                $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
            } else {
                if (defined("SELECTED_DOMAIN_ID")) {
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $dbObj = db_getDBObject();
                }
                unset($dbMain);
            }
            $sql = "SELECT * FROM Review WHERE member_id = $account_id";
            $result = $dbObj->query($sql);
            while ($row = mysql_fetch_array($result)) {
                $this->makeFromRow($row);
                $this->Delete($domain_id);
            }
        }
    }

    function getRateAvgByItem($item_type, $item_id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
//			$dbMain->close();
        unset($dbMain);
        $sql = "SELECT AVG(rating) AS rate FROM Review WHERE item_type = " . db_formatString($item_type) . " AND item_id = " . db_formatNumber($item_id) . " AND approved = '1' ";
        $result = $dbObj->query($sql);
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $rate = $row["rate"];
            }
        }

        return (isset($rate) && $rate != 0) ? round($rate, 2) : system_showText(LANG_NA);
    }

    function getDeniedIpsByItem($item_type, $item_id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
//			$dbMain->close();
        unset($dbMain);
        $sql = "SELECT ip FROM Review WHERE (added >= DATE_SUB(NOW(), INTERVAL '5' MINUTE)) AND item_type = " . db_formatString($item_type) . " AND item_id = " . db_formatNumber($item_id) . "";
        $result = $dbObj->query($sql);
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $ips[] = $row["ip"];
            }
        }

        return $ips;
    }

    /**
     * Function to get all reviews from a item
     * @return array
     */
    function getReviewByItemID()
    {

        $db = db_getDBObject();
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT * FROM Review WHERE item_type = " . db_formatString($this->item_type) . " AND item_id = " . db_formatNumber($this->item_id) . " AND review IS NOT NULL AND review != '' AND approved = 1 ORDER BY added DESC";
        $result = $db->query($sql);

        if (mysql_num_rows($result)) {

            unset($aux_array_reviews);
            $aux_array_reviews = [];
            while ($row = mysql_fetch_assoc($result)) {
                unset($aux_fields);
                foreach ($row as $key => $value) {
                    $aux_fields[$key] = (is_numeric($value) && $key != "approved" && $key != "responseapproved" ? (float)$value : $value);
                }
                //Get user image
                if (SOCIALNETWORK_FEATURE == "on") {

                    if ($row["member_id"] > 0 and $row["member_id"] != null) {

                        $sql = "SELECT image_id, facebook_image, A.has_profile
                                    FROM Profile
                                    LEFT JOIN Account A ON (A.id = account_id)
                                    WHERE account_id = " . db_formatNumber($row["member_id"]) . "";
                        $resultImage = $dbMain->query($sql);
                        $rowImage = mysql_fetch_assoc($resultImage);

                        if ($rowImage["has_profile"] == "y") {
                            $imgObj = new Image($rowImage["image_id"], true);
                            if ($imgObj->imageExists()) {
                                $aux_fields["member_img"] = $imgObj->getPath();
                                //No image
                            } else {
                                if ($rowImage["facebook_image"]) {
                                    $aux_fields["member_img"] = $rowImage["facebook_image"];
                                } else {
                                    $aux_fields["member_img"] = DEFAULT_URL . "/assets/images/structure/icon-user-thumb.gif";
                                }
                            }
                            //No image
                        } else {
                            $aux_fields["member_img"] = DEFAULT_URL . "/assets/images/structure/icon-user-thumb.gif";
                        }

                        //No image
                    } else {
                        $aux_fields["member_img"] = DEFAULT_URL . "/assets/images/structure/icon-user-thumb.gif";
                    }
                } else {
                    $aux_fields["member_img"] = "";
                }
                $aux_array_reviews[] = $aux_fields;
            }

            if (is_array($aux_array_reviews)) {
                return $aux_array_reviews;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    function ApproveReviewAndReply(){
        $message = 0;
        if ($this->id) {
            $domain = new Domain(SELECTED_DOMAIN_ID);

            $lastReviewStatus = $this->getNumber("approved");
            $lastReplyStatus = $this->getNumber("responseapproved");

            $this->setNumber('approved', 1);
            if ($this->getString("response")) {
                $this->setNumber('responseapproved', 1);
            }
            $this->Save();

            $avg = $this->getRateAvgByItem($this->item_type, $this->item_id);

            if (!is_numeric($avg)) {
                $avg = 0;
            }

            if ($this->item_type == 'listing') {
                $listing = new Listing();
                $listing->setAvgReview($avg, $this->item_id);
            } else {
                if ($this->item_type == 'article') {
                    $articles = new Article();
                    $articles->setAvgReview($avg, $this->item_id);
                }
            }

            /* send e-mail to owner - Review */
            if ($lastReviewStatus != $this->getNumber("approved")) {
                if ($this->getString('item_type') == 'listing') {
                    $itemObj = new Listing($this->getNumber('item_id'));
                    $contactObj = new Contact($itemObj->getNumber("account_id"));

                    if ($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW)) {

                        $subject = $emailNotificationObj->getString("subject");
                        $subject = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                        $subject = html_entity_decode($subject);

                        $body = $emailNotificationObj->getString("body");
                        $body = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                        $body = str_replace($_SERVER["HTTP_HOST"], $domain->getString("url"), $body);
                        $body = html_entity_decode($body);

                        Mailer::mail($contactObj->getString("email"), $subject, $body,
                            $emailNotificationObj->getString("content_type"), null,
                            $emailNotificationObj->getString("bcc"));
                    }
                }

                if ($this->getString('item_type') == 'article') {
                    $itemObj = new Article($this->getNumber('item_id'));
                    $contactObj = new Contact($itemObj->getNumber("account_id"));

                    if ($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW)) {
                        $subject = $emailNotificationObj->getString("subject");
                        $subject = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
                        $subject = html_entity_decode($subject);

                        $body = $emailNotificationObj->getString("body");
                        $body = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
                        $body = str_replace($_SERVER["HTTP_HOST"], $domain->getString("url"), $body);
                        $body = html_entity_decode($body);

                        Mailer::mail($contactObj->getString("email"), $subject, $body,
                            $emailNotificationObj->getString("content_type"), null,
                            $emailNotificationObj->getString("bcc"));
                    }
                }
            }

            $message = 1;

            /* send e-mail to owner - REPLY */
            if ($lastReplyStatus != $this->getNumber("responseapproved")) {
                if ($this->getString('item_type') == 'listing') {
                    $itemObj = new Listing($this->getNumber('item_id'));
                    $contactObj = new Contact($itemObj->getNumber("account_id"));

                    if ($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY)) {
                        $subject = $emailNotificationObj->getString("subject");
                        $subject = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                        $subject = html_entity_decode($subject);

                        $body = $emailNotificationObj->getString("body");
                        $body = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                        $body = str_replace($_SERVER["HTTP_HOST"], $domain->getString("url"), $body);
                        $body = html_entity_decode($body);

                        Mailer::mail($contactObj->getString("email"), $subject, $body,
                            $emailNotificationObj->getString("content_type"), null,
                            $emailNotificationObj->getString("bcc"));
                    }
                }

                if ($this->getString('item_type') == 'article') {
                    $itemObj = new Article($this->getNumber('item_id'));
                    $contactObj = new Contact($itemObj->getNumber("account_id"));

                    if ($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY)) {
                        $subject = $emailNotificationObj->getString("subject");
                        $subject = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
                        $subject = html_entity_decode($subject);

                        $body = $emailNotificationObj->getString("body");
                        $body = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
                        $body = str_replace($_SERVER["HTTP_HOST"], $domain->getString("url"), $body);
                        $body = html_entity_decode($body);

                        Mailer::mail($contactObj->getString("email"), $subject, $body,
                            $emailNotificationObj->getString("content_type"), null,
                            $emailNotificationObj->getString("bcc"));
                    }
                }

                $message = 7;
            }

            if ($lastReviewStatus != $this->getNumber("approved") && $lastReplyStatus != $this->getNumber("responseapproved")) {
                $message = 8;
            }

        }

        return $message;
    }
}

