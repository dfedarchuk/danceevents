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
# * FILE: /classes/class_Timeline.php
# ----------------------------------------------------------------------------------------------------

class Timeline extends Handle
{
    var $id;
    var $item_type;
    var $item_id;
    var $action;
    var $datetime;

    var $div_type;
    var $icon_type;
    var $user_image;
    var $user_name;
    var $user_id;
    var $user_sponsor;
    var $item_title;
    var $item_image;
    var $item_description;
    var $item_review;
    var $item_url;
    var $item_detaillink;
    var $item_detaillabel;

    function Timeline($var = "", $renderTimeline = false)
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);

            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }

            unset($dbMain);

            $sql = "SELECT * FROM Timeline WHERE id = {$var}";
            $row = mysql_fetch_array($db->query($sql));
            $this->makeFromRow($row, $renderTimeline);

        } else {
            if (!is_array($var)) {
                $var = [];
            }
            $this->makeFromRow($var, $renderTimeline);
        }
    }

    function makeFromRow($row = "", $renderTimeline = false)
    {
        $this->id        = ($row["id"])        ? $row["id"]        : ($this->id ? $this->id : 0);
        $this->item_type = ($row["item_type"]) ? $row["item_type"] : ($this->item_type ? $this->item_type : "");
        $this->item_id   = ($row["item_id"])   ? $row["item_id"]   : ($this->item_id ? $this->item_id : 0);
        $this->action    = ($row["action"])    ? $row["action"]    : ($this->action ? $this->action : "");
        $this->datetime  = ($row["datetime"])  ? $row["datetime"]  : ($this->datetime ? $this->datetime : "");

        if ($renderTimeline) {
            if ($this->item_type == "invoice" || $this->item_type == "transaction") {
                $this->div_type = "deal";
                $this->icon_type = "icon-cent1";

                if ($this->item_type == "invoice") {
                    $itemObj = new Invoice($this->item_id);
                    $amount = format_money($itemObj->getNumber("amount"));
                    $this->item_detaillink = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/activity/invoices/index.php?search_id=" . $this->item_id;
                } elseif ($this->item_type == "transaction") {
                    $itemObj = new PaymentLog($this->item_id);
                    $amount = format_money($itemObj->getNumber("transaction_amount"));
                    $this->item_detaillink = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/activity/transactions/index.php?search_id=" . $itemObj->getNumber("transaction_id");
                }

                $accObj = new Account($itemObj->account_id);
                $contactObj = new Contact($itemObj->account_id);

                if ($accObj->getNumber("id")) {
                    $this->user_name = $contactObj->getString("first_name") . " " . $contactObj->getString("last_name");
                    $this->user_image = system_getUserImage($accObj->getNumber("id"));
                    $this->user_id = $itemObj->account_id;
                    $this->user_sponsor = $accObj->getString("is_sponsor");
                } else {
                    $this->id = 0;
                }

                $this->item_description = system_showText(LANG_SITEMGR_PAID);
                $this->item_detaillabel = CURRENCY_SYMBOL . $amount;

            } elseif ($this->item_type == "review" || $this->item_type == "comment" || $this->item_type == "lead" || $this->item_type == "reply") {
                $this->div_type = "comment";
                $this->icon_type = "icon-comments";

                if ($this->item_type == "review" || $this->item_type == "lead") {

                    if ($this->item_type == "lead") {
                        $itemObj = new Lead($this->item_id);
                    } else {
                        $itemObj = new Review($this->item_id);
                    }

                    $moduleStr = ucfirst($this->item_type == "review" ? $itemObj->item_type : $itemObj->type);
                    if ($moduleStr && class_exists($moduleStr)) {
                        $moduleObj = new $moduleStr($itemObj->item_id);
                    }

                    $accObj = new Account($itemObj->member_id);
                    $contactObj = new Contact($itemObj->member_id);

                    if ($accObj->getNumber("id")) {
                        $this->user_name = $contactObj->getString("first_name") . " " . $contactObj->getString("last_name");
                        $this->user_image = system_getUserImage($accObj->getNumber("id"));
                        $this->user_id = $itemObj->member_id;
                        $this->user_sponsor = $accObj->getString("is_sponsor");
                    } else {
                        if ($this->item_type == "lead") {
                            $this->user_name = $itemObj->getString("first_name") . " " . $itemObj->getString("last_name");
                        } else {
                            $this->user_name = $itemObj->getString("reviewer_name");
                        }

                        $this->user_image = system_getUserImage(0);
                    }

                    if ($this->item_type == "lead") {
                        $this->item_description = ucfirst(system_showText(LANG_SITEMGR_TIMELINE_LEAD));
                        $this->item_url = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/activity/leads/index.php?search_id=" . $itemObj->id . "&item_type=" . $itemObj->type;
                        $auxMessage = @unserialize($itemObj->getString("message"));
                        $this->item_review = $auxMessage["LANG_LABEL_MESSAGE"];
                    } else {
                        $this->item_description = ucfirst(system_showText(LANG_SITEMGR_TIMELINE_REVIEW));
                        $this->item_url = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/activity/reviews-comments/index.php?search_id=" . $itemObj->id . "&item_type=" . $itemObj->item_type;
                        $this->item_review = $itemObj->getString("review");
                    }

                    if (is_object($moduleObj)) {
                        $this->item_title = $moduleObj->getString($itemObj->item_type == "promotion" ? "name" : "title");
                    }

                } elseif ($this->item_type == "comment" || $this->item_type == "reply") {

                    $commentObj = new Comments($this->item_id);

                    $moduleObj = new Post($commentObj->post_id);
                    $this->item_url = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/activity/reviews-comments/index.php?search_id=" . $commentObj->id . "&reply_id=" . $commentObj->reply_id . "&item_type=blog";
                    $this->item_title = $moduleObj->getString("title");

                    $accObj = new Account($commentObj->member_id);
                    $contactObj = new Contact($commentObj->member_id);

                    if ($accObj->getNumber("id")) {
                        $this->user_name = $contactObj->getString("first_name") . " " . $contactObj->getString("last_name");
                        $this->user_image = system_getUserImage($accObj->getNumber("id"));
                        $this->user_id = $commentObj->member_id;
                        $this->user_sponsor = $accObj->getString("is_sponsor");
                    } else {
                        $this->id = 0;
                    }

                    $this->item_description = ucfirst(system_showText(LANG_SITEMGR_TIMELINE_COMMENT));
                    $this->item_review = $commentObj->getString("description");

                }

                if (is_object($moduleObj) && $moduleObj->getNumber("image_id")) {
                    $imageObj = new Image($moduleObj->getNumber("image_id"));

                    if ($imageObj->imageExists()) {
                        $this->item_image = $imageObj->getPath();
                    }
                }

            } elseif ($this->item_type == "newsletter") {
                $this->div_type = "newsletter";
                $this->icon_type = "icon-ion-paper-airplane";
                setting_get("arcamailer_list_label", $edir_list_label);

                $accObj = new Account($this->item_id);
                $contactObj = new Contact($this->item_id);

                if ($accObj->getNumber("id") && $edir_list_label) {
                    $this->user_name = $contactObj->getString("first_name") . " " . $contactObj->getString("last_name");
                    $this->user_image = system_getUserImage($this->item_id);
                    $this->user_id = $this->item_id;
                    $this->user_sponsor = $accObj->getString("is_sponsor");
                } else {
                    $this->id = 0;
                }

                $this->item_description = system_showText(LANG_SITEMGR_JOINED_NEWSLETTER) . " \"" . $edir_list_label . "\"";

            } elseif ($this->item_type == "account") {
                $this->div_type = "account";
                $this->icon_type = "icon-profile11";

                $accObj = new Account($this->item_id);
                $contactObj = new Contact($this->item_id);

                if ($accObj->getNumber("id")) {
                    $this->user_name = $contactObj->getString("first_name") . " " . $contactObj->getString("last_name");
                    $this->user_image = system_getUserImage($this->item_id);
                    $this->user_id = $this->item_id;
                    $this->user_sponsor = $accObj->getString("is_sponsor");
                } else {
                    $this->id = 0;
                }

                $this->item_description = ucfirst(system_showText(LANG_SITEMGR_CREATED_ACCOUNT));

            } else {
                $this->div_type = "listing";
                $this->icon_type = "icon-document50";

                //Get user information
                $moduleStr = ucfirst($this->item_type);
                if ($moduleStr) {
                    $moduleObj = new $moduleStr($this->item_id);

                    if ($this->item_type == "claim") {
                        $moduleObj = new Listing($moduleObj->getNumber("listing_id"));
                    }

                    $accID = $moduleObj->getNumber("account_id");
                    $accObj = new Account($accID);
                    $contactObj = new Contact($accID);

                    if ($moduleObj->getNumber("id") && $accObj->getNumber("id")) {
                        $this->user_name = $contactObj->getString("first_name") . " " . $contactObj->getString("last_name");
                        $this->user_image = system_getUserImage($accID);
                        $this->user_id = $accID;
                        $this->user_sponsor = $accObj->getString("is_sponsor");
                    } else {
                        $this->id = 0;
                    }

                    //Get item information
                    if ($this->item_type == "banner") {
                        $fieldTitle = "caption";
                    } elseif ($this->item_type == "promotion") {
                        $fieldTitle = "name";
                    } else {
                        $fieldTitle = "title";
                    }

                    $this->item_title = $moduleObj->getString($fieldTitle);
                    if ($moduleObj->getNumber("image_id")) {
                        $imageObj = new Image($moduleObj->getNumber("image_id"));
                        if ($imageObj->imageExists()) {
                            $this->item_image = $imageObj->getPath();
                        }
                    }

                    if ($this->item_type == "claim") {
                        $this->item_description = system_showText(LANG_SITEMGR_CLAIMEDLISTING);
                        $this->item_url = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/content/listing/claim/index.php?search_id=" . $this->item_id;
                    } else {
                        $this->item_description = ucfirst(system_showText(($this->action == "new" ? LANG_SITEMGR_CREATED : LANG_SITEMGR_UPDATED))) . " " . strtolower(system_showText(@constant("LANG_" . strtoupper($this->item_type) . "_FEATURE_NAME")));
                        $this->item_url = DEFAULT_URL . "/" . SITEMGR_ALIAS . "/content/" . ($this->item_type == "promotion" ? "deal" : $this->item_type) . "/" . ($this->item_type == "promotion" ? "deal" : $this->item_type) . ".php?id=" . $moduleObj->getNumber("id");
                    }
                }
            }
        }
    }

    function Save()
    {
        if ($this->item_id > 0) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);

            $this->prepareToSave();

            $sql = "INSERT INTO Timeline (`item_type`, `item_id`, `action`, `datetime` )"
                . " VALUES ({$this->item_type}, {$this->item_id}, {$this->action}, NOW())";

            $dbObj->query($sql);

            $this->id = mysql_insert_id($dbObj->link_id);

            $this->prepareToUse();
        }
    }

}
