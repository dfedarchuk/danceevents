<?php

class Article extends Handle
{
    var $id;
    var $account_id;
    var $image_id;
    var $thumb_id;
    var $cover_id;
    var $updated;
    var $entered;
    var $renewal_date;
    var $discount_id;
    var $title;
    var $seo_title;
    var $friendly_url;
    var $author;
    var $author_url;
    var $publication_date;
    var $abstract;
    var $seo_abstract;
    var $content;
    var $keywords;
    var $seo_keywords;
    var $status;
    var $level;
    var $number_views;
    var $avg_review;
    var $data_in_array;
    var $domain_id;
    var $package_id;
    var $package_price;

    /**
     * <code>
     *        $articleObj = new Article($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Article
     * @access Public
     * @param integer $var
     */
    function Article($var = "", $domain_id = false)
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id) {
                $this->domain_id = $domain_id;
                $db = db_getDBObjectByDomainID($domain_id, $dbMain);
            } else {
                if (defined("SELECTED_DOMAIN_ID")) {
                    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $db = db_getDBObject();
                }
            }
            unset($dbMain);
            $sql = "SELECT * FROM Article WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));

            $this->old_account_id = $row["account_id"];

            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }

    /**
     * <code>
     *        $this->makeFromRow($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name makeFromRow
     * @access Public
     * @param array $row
     */
    function makeFromRow($row = "")
    {

        $status = new ItemStatus();
        $level = new ArticleLevel();

        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->account_id = ($row["account_id"]) ? $row["account_id"] : 'NULL';
        $this->image_id = ($row["image_id"]) ? $row["image_id"] : ($this->image_id ? $this->image_id : 'NULL');
        $this->thumb_id = ($row["thumb_id"]) ? $row["thumb_id"] : ($this->thumb_id ? $this->thumb_id : 'NULL');
        $this->cover_id = ($row["cover_id"]) ? $row["cover_id"] : ($this->cover_id ? $this->cover_id : 'NULL');
        $this->updated = ($row["updated"]) ? $row["updated"] : ($this->updated ? $this->updated : "");
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : "");
        $this->renewal_date = ($row["renewal_date"]) ? $row["renewal_date"] : ($this->renewal_date ? $this->renewal_date : 0);
        $this->discount_id = ($row["discount_id"]) ? $row["discount_id"] : "";
        $this->title = ($row["title"]) ? $row["title"] : ($this->title ? $this->title : "");
        $this->seo_title = ($row["seo_title"]) ? $row["seo_title"] : ($this->seo_title ? $this->seo_title : "");
        $this->friendly_url = ($row["friendly_url"]) ? $row["friendly_url"] : "";
        $this->author = ($row["author"]) ? $row["author"] : "";
        $this->author_url = ($row["author_url"]) ? $row["author_url"] : "";
        $this->publication_date = ($row["publication_date"]) ? $row["publication_date"] : 0;
        $this->abstract = ($row["abstract"]) ? $row["abstract"] : "";
        $this->seo_abstract = ($row["seo_abstract"]) ? $row["seo_abstract"] : ($this->seo_abstract ? $this->seo_abstract : "");
        $this->content = ($row["content"]) ? $row["content"] : "";
        $this->keywords = ($row["keywords"]) ? $row["keywords"] : "";
        $this->seo_keywords = ($row["seo_keywords"]) ? $row["seo_keywords"] : ($this->seo_keywords ? $this->seo_keywords : "");
        $this->status = ($row["status"]) ? $row["status"] : $status->getDefaultStatus();
        $this->level = ($row["level"]) ? $row["level"] : ($this->level ? $this->level : $level->getDefaultLevel());
        $this->number_views = ($row["number_views"]) ? $row["number_views"] : ($this->number_views ? $this->number_views : 0);
        $this->avg_review = ($row["avg_review"]) ? $row["avg_review"] : ($this->avg_review ? $this->avg_review : 0);
        $this->data_in_array = $row;
        $this->package_id = ($row["package_id"]) ? $row["package_id"] : ($this->package_id ? $this->package_id : 0);
        $this->package_price = ($row["package_price"]) ? $row["package_price"] : ($this->package_price ? $this->package_price : 0);

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->Save();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function Save()
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if ($this->domain_id) {
            $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
        } else {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
        }
        unset($dbMain);

        $this->prepareToSave();

        $aux_old_account = str_replace("'", "", $this->old_account_id);
        $aux_account = str_replace("'", "", $this->account_id);

        $this->friendly_url = string_strtolower($this->friendly_url);

        /*
         * TODO
         * Review calls of method save when adding/editing an item
         * Right now it's been called several times messing up some attributes values
         */
        if ($this->image_id == "''") {
            $this->image_id = "NULL";
        }
        if ($this->thumb_id == "''") {
            $this->thumb_id = "NULL";
        }
        if ($this->cover_id == "''") {
            $this->cover_id = "NULL";
        }

        if ($this->id) {

            $updateItem = true;
            $sql = "SELECT status, publication_date FROM Article WHERE id = $this->id";
            $result = $dbObj->query($sql);
            if ($row = mysql_fetch_assoc($result)) {
                $last_publication_date = $row["publication_date"];
            }

            $sql = "UPDATE Article SET"
                . " account_id          = $this->account_id,"
                . " image_id            = $this->image_id,"
                . " thumb_id            = $this->thumb_id,"
                . " cover_id            = $this->cover_id,"
                . " updated             = NOW(),"
                . " renewal_date        = $this->renewal_date,"
                . " discount_id         = $this->discount_id,"
                . " title               = $this->title,"
                . " seo_title           = $this->seo_title,"
                . " friendly_url        = $this->friendly_url,"
                . " author              = $this->author,"
                . " author_url          = $this->author_url,"
                . " publication_date    = $this->publication_date,"
                . " abstract            = $this->abstract,"
                . " seo_abstract        = $this->seo_abstract,"
                . " content             = $this->content,"
                . " keywords            = $this->keywords,"
                . " seo_keywords        = $this->seo_keywords,"
                . " status              = $this->status,"
                . " level               = $this->level,"
                . " number_views        = $this->number_views,"
                . " avg_review          = $this->avg_review,"
                . " package_id          = $this->package_id,"
                . " package_price       = $this->package_price"
                . " WHERE id            = $this->id";

            $dbObj->query($sql);

            if ($aux_old_account != $aux_account && $aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }

        } else {
            $sql = "INSERT INTO Article"
                . " (account_id,"
                . " image_id,"
                . " thumb_id,"
                . " cover_id,"
                . " updated,"
                . " entered,"
                . " renewal_date,"
                . " discount_id,"
                . " title,"
                . " seo_title,"
                . " friendly_url,"
                . " author,"
                . " author_url,"
                . " publication_date,"
                . " abstract,"
                . " seo_abstract,"
                . " content,"
                . " keywords,"
                . " seo_keywords,"
                . " fulltextsearch_keyword,"
                . " fulltextsearch_where,"
                . " status,"
                . " level,"
                . " number_views,"
                . " avg_review,"
                . " package_id,"
                . " package_price)"
                . " VALUES"
                . " ($this->account_id,"
                . " $this->image_id,"
                . " $this->thumb_id,"
                . " $this->cover_id,"
                . " NOW(),"
                . " NOW(),"
                . " $this->renewal_date,"
                . " $this->discount_id,"
                . " $this->title,"
                . " $this->seo_title,"
                . " $this->friendly_url,"
                . " $this->author,"
                . " $this->author_url,"
                . " $this->publication_date,"
                . " $this->abstract,"
                . " $this->seo_abstract,"
                . " $this->content,"
                . " $this->keywords,"
                . " $this->seo_keywords,"
                . " '',"
                . " '',"
                . " $this->status,"
                . " $this->level,"
                . " $this->number_views,"
                . " $this->avg_review,"
                . " $this->package_id,"
                . " $this->package_price)";

            $dbObj->query($sql);

            $this->id = mysql_insert_id($dbObj->link_id);

            if ($aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }

        }

        if ((sess_getAccountIdFromSession() && string_strpos($_SERVER["PHP_SELF"],
                    "article.php") !== false) || string_strpos($_SERVER["PHP_SELF"], "order_") !== false
        ) {
            $rowTimeline = array();
            $rowTimeline["item_type"] = "article";
            $rowTimeline["action"] = ($updateItem ? "edit" : "new");
            $rowTimeline["item_id"] = str_replace("'", "", $this->id);
            $timelineObj = new Timeline($rowTimeline);
            $timelineObj->save();
        }

        $this->prepareToUse();

        $this->setFullTextSearch();

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Delete
     * @access Public
     * @param integer $domain_id
     */
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

        ### REVIEWS
        $sql = "SELECT id FROM Review WHERE item_type='article' AND item_id= $this->id";
        $result = $dbObj->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $reviewObj = new Review($row["id"]);
            $reviewObj->Delete($domain_id);
        }

        ### GALERY
        //before deleting the gallery, it needs to clear article image ids
        $sql = "UPDATE Article SET image_id = NULL, cover_id = NULL, thumb_id = NULL WHERE id = $this->id";
        $dbObj->query($sql);

        $sql = "SELECT gallery_id FROM Gallery_Item WHERE item_id = $this->id AND item_type = 'article'";
        $row = mysql_fetch_array($dbObj->query($sql));
        $gallery_id = $row["gallery_id"];
        if ($gallery_id) {
            $gallery = new Gallery($gallery_id);
            $gallery->delete();
        }

        ### IMAGE
        if ($this->image_id) {
            $image = new Image($this->image_id);
            if ($image) {
                $image->Delete($domain_id);
            }
        }
        if ($this->thumb_id) {
            $image = new Image($this->thumb_id);
            if ($image) {
                $image->Delete($domain_id);
            }
        }
        if (is_numeric($this->cover_id)) {
            $image = new Image($this->cover_id);
            if ($image) {
                $image->Delete($domain_id);
            }
        }

        ### INVOICE
        $sql = "UPDATE Invoice_Article SET article_id = '0' WHERE article_id = $this->id";
        $dbObj->query($sql);

        ### PAYMENT
        $sql = "UPDATE Payment_Article_Log SET article_id = '0' WHERE article_id = $this->id";
        $dbObj->query($sql);

        ### Timeline
        $sql = "DELETE FROM Timeline WHERE item_type = 'article' AND item_id = $this->id";
        $dbObj->query($sql);

        ### Quicklist (Favorites)
        $sql = "DELETE FROM Quicklist WHERE item_type = 'article' AND item_id = $this->id";
        $dbObj->query($sql);

        ### ARTICLE
        $sql = "DELETE FROM Article WHERE id = $this->id";
        $dbObj->query($sql);

        if ($domain_id) {
            $domain_idDash = $domain_id;
        } else {
            $domain_idDash = SELECTED_DOMAIN_ID;
        }

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("article.synchronization")->addDelete($this->id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->getCategories();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->getCategories();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getCategories
     * @access Public
     * @return array
     */
    function getCategories()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Article WHERE id = $this->id";
        $r = $dbObj->query($sql);
        while ($row = mysql_fetch_array($r)) {
            if ($row["cat_1_id"]) {
                $categories[] = new ArticleCategory($row["cat_1_id"]);
            }
            if ($row["cat_2_id"]) {
                $categories[] = new ArticleCategory($row["cat_2_id"]);
            }
            if ($row["cat_3_id"]) {
                $categories[] = new ArticleCategory($row["cat_3_id"]);
            }
            if ($row["cat_4_id"]) {
                $categories[] = new ArticleCategory($row["cat_4_id"]);
            }
            if ($row["cat_5_id"]) {
                $categories[] = new ArticleCategory($row["cat_5_id"]);
            }
        }

        return $categories;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->setCategories();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->setCategories();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setCategories
     * @access Public
     */
    function setCategories($array)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        $cat_1_id = "NULL";
        $parcat_1_level1_id = 0;
        $parcat_1_level2_id = 0;
        $parcat_1_level3_id = 0;
        $parcat_1_level4_id = 0;
        $cat_2_id = "NULL";
        $parcat_2_level1_id = 0;
        $parcat_2_level2_id = 0;
        $parcat_2_level3_id = 0;
        $parcat_2_level4_id = 0;
        $cat_3_id = "NULL";
        $parcat_3_level1_id = 0;
        $parcat_3_level2_id = 0;
        $parcat_3_level3_id = 0;
        $parcat_3_level4_id = 0;
        $cat_4_id = "NULL";
        $parcat_4_level1_id = 0;
        $parcat_4_level2_id = 0;
        $parcat_4_level3_id = 0;
        $parcat_4_level4_id = 0;
        $cat_5_id = "NULL";
        $parcat_5_level1_id = 0;
        $parcat_5_level2_id = 0;
        $parcat_5_level3_id = 0;
        $parcat_5_level4_id = 0;
        if ($array) {
            $count_category_aux = 1;
            foreach ($array as $category) {
                if ($category) {
                    unset($parents);
                    $cat_id = $category;
                    $i = 0;
                    while ($cat_id != 0) {
                        $sql = "SELECT * FROM ArticleCategory WHERE id = $cat_id";
                        $rs1 = $dbObj->query($sql);
                        if (mysql_num_rows($rs1) > 0) {
                            $cat_info = mysql_fetch_assoc($rs1);
                            $cat_id = $cat_info["category_id"];
                            $parents[$i++] = $cat_id;
                        } else {
                            $cat_id = 0;
                        }
                    }
                    for ($j = count($parents) - 1; $j < 4; $j++) {
                        $parents[$j] = 0;
                    }
                    ${"cat_" . $count_category_aux . "_id"} = $category;
                    ${"parcat_" . $count_category_aux . "_level1_id"} = $parents[0];
                    ${"parcat_" . $count_category_aux . "_level2_id"} = $parents[1];
                    ${"parcat_" . $count_category_aux . "_level3_id"} = $parents[2];
                    ${"parcat_" . $count_category_aux . "_level4_id"} = $parents[3];
                    $count_category_aux++;
                }
            }
        }
        $sql = "UPDATE Article SET cat_1_id = " . $cat_1_id . ", parcat_1_level1_id = " . $parcat_1_level1_id . ", parcat_1_level2_id = " . $parcat_1_level2_id . ", parcat_1_level3_id = " . $parcat_1_level3_id . ", parcat_1_level4_id = " . $parcat_1_level4_id . ", cat_2_id = " . $cat_2_id . ", parcat_2_level1_id = " . $parcat_2_level1_id . ", parcat_2_level2_id = " . $parcat_2_level2_id . ", parcat_2_level3_id = " . $parcat_2_level3_id . ", parcat_2_level4_id = " . $parcat_2_level4_id . ", cat_3_id = " . $cat_3_id . ", parcat_3_level1_id = " . $parcat_3_level1_id . ", parcat_3_level2_id = " . $parcat_3_level2_id . ", parcat_3_level3_id = " . $parcat_3_level3_id . ", parcat_3_level4_id = " . $parcat_3_level4_id . ", cat_4_id = " . $cat_4_id . ", parcat_4_level1_id = " . $parcat_4_level1_id . ", parcat_4_level2_id = " . $parcat_4_level2_id . ", parcat_4_level3_id = " . $parcat_4_level3_id . ", parcat_4_level4_id = " . $parcat_4_level4_id . ", cat_5_id = " . $cat_5_id . ", parcat_5_level1_id = " . $parcat_5_level1_id . ", parcat_5_level2_id = " . $parcat_5_level2_id . ", parcat_5_level3_id = " . $parcat_5_level3_id . ", parcat_5_level4_id = " . $parcat_5_level4_id . " WHERE id = $this->id";
        $dbObj->query($sql);
        $this->setFullTextSearch();

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->getCategories();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->getCategories();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getCategories
     * @access Public
     * @return real
     */
    function getPrice($renewal_period = '')
    {

        /*
         * Fix to normalize variable standard. It should be monthly or yearly, but some places are sending it as M or Y.
         * Sorry.
         */
        if ($renewal_period == "M") {
            $renewal_period = "monthly";
        } elseif ($renewal_period == "Y") {
            $renewal_period = "yearly";
        }
        $price = 0;

        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if ($this->domain_id) {
            $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
        } else {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
        }

        unset($dbMain);

        $levelObj = new ArticleLevel();

        /*
         * Workaround for the scenario where the monthly price is 0 and the yearly price > 0, but the variable $renewal_period comes empty
         * In this case, the system reads the monthly price and considers the item as a free item
         */
        if (!$renewal_period && $levelObj->getPrice($this->level) <= 0 && $levelObj->getPrice($this->level, "yearly") > 0) {
            $renewal_period = "yearly";
        }

        if ($this->package_id) {
            $price = $this->package_price;
        } else {
            $price = $price + $levelObj->getPrice($this->level, ($renewal_period == "monthly" ? "" : $renewal_period));
        }

        if ($this->discount_id) {

            $discountCodeObj = new DiscountCode($this->discount_id);

            if (is_valid_discount_code($this->discount_id, "article", $this->id, $discount_message, $discount_error)) {

                if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

                    if ($discountCodeObj->getString("type") == "percentage") {
                        $price = $price * (1 - $discountCodeObj->getString("amount") / 100);
                    } elseif ($discountCodeObj->getString("type") == "monetary value") {
                        $price = $price - $discountCodeObj->getString("amount");
                    }

                } elseif (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;
                    $sql = "UPDATE Article SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                    $result = $dbObj->query($sql);
                }

            } else {

                if (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;
                    $sql = "UPDATE Article SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                } else {
                    $sql = "UPDATE Article SET discount_id = '' WHERE id = " . $this->id;
                }
                $result = $dbObj->query($sql);

            }

        }

        if ($price <= 0) {
            $price = 0;
        }

        return $price;

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->hasRenewalDate();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->hasRenewalDate();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name hasRenewalDate
     * @access Public
     * @return boolean
     */
    function hasRenewalDate()
    {
        if (PAYMENT_FEATURE != "on") {
            return false;
        }
        if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) {
            return false;
        }
        if ($this->getPrice('monthly') <= 0 && $this->getPrice('yearly') <= 0) {
            return false;
        }

        return true;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->needToCheckOut();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->needToCheckOut();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name needToCheckOut
     * @access Public
     * @return boolean
     */
    function needToCheckOut()
    {

        if ($this->hasRenewalDate()) {

            $today = date("Y-m-d");
            $today = explode("-", $today);
            $today_year = $today[0];
            $today_month = $today[1];
            $today_day = $today[2];
            $timestamp_today = mktime(0, 0, 0, $today_month, $today_day, $today_year);

            $this_renewaldate = $this->renewal_date;
            $renewaldate = explode("-", $this_renewaldate);
            $renewaldate_year = $renewaldate[0];
            $renewaldate_month = $renewaldate[1];
            $renewaldate_day = $renewaldate[2];
            $timestamp_renewaldate = mktime(0, 0, 0, $renewaldate_month, $renewaldate_day, $renewaldate_year);

            if (($this->status == "E") || ($this_renewaldate == "0000-00-00") || ($timestamp_today > $timestamp_renewaldate)) {
                return true;
            }

        }

        return false;

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->getNextRenewalDate($times);
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->getNextRenewalDate($times);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getNextRenewalDate
     * @access Public
     * @param integer $times
     * @return date
     */
    function getNextRenewalDate($times = 1, $renewalunit = "M")
    {

        $nextrenewaldate = "0000-00-00";

        if ($this->hasRenewalDate()) {

            if ($this->needToCheckOut()) {

                $today = date("Y-m-d");
                $today = explode("-", $today);
                $start_year = $today[0];
                $start_month = $today[1];
                $start_day = $today[2];

            } else {

                $this_renewaldate = $this->renewal_date;
                $renewaldate = explode("-", $this_renewaldate);
                $start_year = $renewaldate[0];
                $start_month = $renewaldate[1];
                $start_day = $renewaldate[2];

            }

            $renewalcycle = 1;

            if ($renewalunit == "Y") {
                $nextrenewaldate = date("Y-m-d",
                    mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year + ($renewalcycle * $times)));
            } elseif ($renewalunit == "M") {
                $nextrenewaldate = date("Y-m-d",
                    mktime(0, 0, 0, (int)$start_month + ($renewalcycle * $times), (int)$start_day, (int)$start_year));
            } elseif ($renewalunit == "D") {
                $nextrenewaldate = date("Y-m-d",
                    mktime(0, 0, 0, (int)$start_month, (int)$start_day + ($renewalcycle * $times), (int)$start_year));
            } else {
                $nextrenewaldate = date("Y-m-d",
                    mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year + ($renewalcycle * $times)));
            }

        }

        return $nextrenewaldate;

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->setFullTextSearch();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->setFullTextSearch();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setFullTextSearch
     * @access Public
     */
    function setFullTextSearch()
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        if ($this->title) {
            $string = str_replace(" || ", " ", $this->title);
            $fulltextsearch_keyword[] = $string;
            $addkeyword = format_addApostWords($string);
            if ($addkeyword != '') {
                $fulltextsearch_keyword[] = $addkeyword;
            }
            unset($addkeyword);
        }

        if ($this->keywords) {
            $string = str_replace(" || ", " ", $this->keywords);
            $fulltextsearch_keyword[] = $string;
            $addkeyword = format_addApostWords($string);
            if ($addkeyword != '') {
                $fulltextsearch_keyword[] = $addkeyword;
            }
            unset($addkeyword);
        }

        if ($this->abstract) {
            $fulltextsearch_keyword[] = string_substr($this->abstract, 0, 100);
        }

        if ($this->author) {
            $fulltextsearch_keyword[] = $this->author;
        }

        $categories = $this->getCategories();

        if ($categories) {
            foreach ($categories as $category) {
                unset($parents);
                $category_id = $category->getNumber("id");
                while (!is_null($category_id) && $category_id != 0) {
                    $sql = "SELECT * FROM ArticleCategory WHERE id = $category_id";
                    $result = $dbObj->query($sql);
                    if (mysql_num_rows($result) > 0) {
                        $category_info = mysql_fetch_assoc($result);

                        if ($category_info["enabled"] == "y") {
                            if ($category_info["title"]) {
                                $fulltextsearch_keyword[] = $category_info["title"];
                            }

                            if ($category_info["keywords"]) {
                                $fulltextsearch_keyword[] = str_replace(array("\r\n", "\n"), " ",
                                    $category_info["keywords"]);
                            }
                        }

                        $category_id = $category_info["category_id"];
                    } else {
                        $category_id = 'NULL';
                    }
                }
            }
        }

        if (is_array($fulltextsearch_keyword)) {
            $fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
            $sql = "UPDATE Article SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
            $result = $dbObj->query($sql);
        }

        $this->synchronize();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->getGalleries();
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->getGalleries();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getGalleries
     * @access Public
     * @return array
     */
    function getGalleries()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "SELECT * FROM Gallery_Item WHERE item_type='article' AND item_id = $this->id ORDER BY gallery_id";
        $r = $dbObj->query($sql);
        if ($this->id > 0) {
            while ($row = mysql_fetch_array($r)) {
                $galleries[] = $row["gallery_id"];
            }
        }

        return $galleries;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->setGalleries($gallery);
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->setGalleries($gallery);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setGalleries
     * @access Public
     * @param integer $gallery
     */
    function setGalleries($gallery = false)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "DELETE FROM Gallery_Item WHERE item_type='article' AND item_id = $this->id";
        $dbObj->query($sql);
        if ($gallery) {
            $sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'article')";
            $rs3 = $dbObj->query($sql);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->setNumberViews($id);
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->setNumberViews($id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setNumberViews
     * @access Public
     * @param integer $id
     */
    function setNumberViews($id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "UPDATE Article SET number_views = " . $this->number_views . " + 1 WHERE Article.id = " . $id;
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("article.synchronization")->addViewUpdate($id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->setAvgReview($avg,$id);
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->setAvgReview($avg,$id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setAvgReview
     * @access Public
     * @param integer $id
     */
    function setAvgReview($avg, $id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "UPDATE Article SET avg_review = " . $avg . " WHERE Article.id = " . $id;
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("article.synchronization")->addAverageReviewUpdate($id, $avg);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->deletePerAccount($account_id);
     * <br /><br />
     *        //Using this in Article() class.
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
            $sql = "SELECT * FROM Article WHERE account_id = $account_id";
            $result = $dbObj->query($sql);
            while ($row = mysql_fetch_array($result)) {
                $this->makeFromRow($row);
                $this->Delete($domain_id);
            }
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $articleObj->getArticleByFriendlyURL($friendly_url);
     * <br /><br />
     *        //Using this in Article() class.
     *        $this->getArticleByFriendlyURL($friendly_url);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getArticleByFriendlyURL
     * @param string $friendly_url
     * @access Public
     */
    function getArticleByFriendlyURL($friendly_url)
    {
        $dbObj = db_getDBObject();
        $sql = "SELECT * FROM Article WHERE friendly_url = '" . $friendly_url . "'";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result)) {
            $this->makeFromRow(mysql_fetch_assoc($result));

            return true;
        } else {
            return false;
        }
    }

    /**
     * Synchronizes this instance in elasticsearch
     */
    public function synchronize()
    {
        if ($symfonyContainer = SymfonyCore::getContainer()) {
            if($this->status == 'A'){
                $symfonyContainer->get("article.synchronization")->addUpsert($this->id);
            } else {
                $symfonyContainer->get("article.synchronization")->addDelete($this->id);
            }
        }
    }
}
