<?php

class Event extends Handle
{
    var $id;
    var $account_id;
    var $title;
    var $seo_title;
    var $friendly_url;
    var $image_id;
    var $thumb_id;
    var $cover_id;
    var $description;
    var $seo_description;
    var $long_description;
    var $video_snippet;
    var $video_url;
    var $keywords;
    var $seo_keywords;
    var $updated;
    var $entered;
    var $start_date;
    var $start_time;
    var $end_date;
    var $end_time;
    var $location;
    var $address;
    var $zip_code;
    var $location_1;
    var $location_2;
    var $location_3;
    var $location_4;
    var $location_5;
    var $url;
    var $contact_name;
    var $phone;
    var $email;
    var $renewal_date;
    var $discount_id;
    var $facebook_page;
    var $status;
    var $level;
    var $recurring;
    var $day;
    var $dayofweek;
    var $week;
    var $month;
    var $until_date;
    var $repeat_event;
    var $number_views;
    var $latitude;
    var $longitude;
    var $map_zoom;
    var $locationManager;
    var $data_in_array;
    var $domain_id;
    var $package_id;
    var $package_price;

    /**
     * <code>
     *        $eventObj = new Event($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @param integer $var
     */
    function Event($var = '', $domain_id = false)
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
            $sql = "SELECT * FROM Event WHERE id = $var";
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
     * @param array $row
     */
    function makeFromRow($row = '')
    {
        $statusObj = new ItemStatus();
        $level = new EventLevel();

        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->account_id = ($row["account_id"]) ? $row["account_id"] : 0;
        $this->title = ($row["title"]) ? $row["title"] : ($this->title ? $this->title : "");
        $this->seo_title = ($row["seo_title"]) ? $row["seo_title"] : ($this->seo_title ? $this->seo_title : "");
        $this->friendly_url = ($row["friendly_url"]) ? $row["friendly_url"] : "";
        $this->image_id = ($row["image_id"]) ? $row["image_id"] : ($this->image_id ? $this->image_id : 'NULL');
        $this->thumb_id = ($row["thumb_id"]) ? $row["thumb_id"] : ($this->thumb_id ? $this->thumb_id : 'NULL');
        $this->cover_id = ($row["cover_id"]) ? $row["cover_id"] : ($this->cover_id ? $this->cover_id : 'NULL');
        $this->description = (isset($row["description"])) ? $row["description"] : ($this->description ? $this->description : "");
        $this->seo_description = (isset($row["seo_description"])) ? $row["seo_description"] : ($this->seo_description ? $this->seo_description : "");
        $this->long_description = (isset($row["long_description"])) ? $row["long_description"] : ($this->long_description ? $this->long_description : "");
        $this->video_snippet = (isset($row["video_snippet"])) ? $row["video_snippet"] : ($this->video_snippet ? $this->video_snippet : "");
        $this->video_url = (isset($row["video_url"])) ? $row["video_url"] : ($this->video_url ? $this->video_url : "");
        $this->keywords = ($row["keywords"]) ? $row["keywords"] : "";
        $this->seo_keywords = (isset($row["seo_keywords"])) ? $row["seo_keywords"] : ($this->seo_keywords ? $this->seo_keywords : "");
        $this->updated = ($row["updated"]) ? $row["updated"] : ($this->updated ? $this->updated : "");
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : "");
        $this->setDate("start_date", $row["start_date"]);
        $this->start_time = (isset($row["start_time"])) ? (empty($row["start_time"])? 'NULL': $row["start_time"] ): ($this->start_time ? $this->start_time : 'NULL');
        $this->setDate("end_date", $row["end_date"]);
        $this->end_time  = (isset($row["end_time"])) ? (empty($row["end_time"])? 'NULL': $row["end_time"] ): ($this->end_time ? $this->end_time : 'NULL');
        $this->location = (isset($row["location"])) ? $row["location"] : ($this->location ? $this->location : "");
        $this->address = ($row["address"]) ? $row["address"] : "";
        $this->zip_code = ($row["zip_code"]) ? $row["zip_code"] : "";
        $this->location_1 = ($row["location_1"]) ? $row["location_1"] : 0;
        $this->location_2 = ($row["location_2"]) ? $row["location_2"] : 0;
        $this->location_3 = ($row["location_3"]) ? $row["location_3"] : 0;
        $this->location_4 = ($row["location_4"]) ? $row["location_4"] : 0;
        $this->location_5 = ($row["location_5"]) ? $row["location_5"] : 0;
        $this->url = (isset($row["url"])) ? $row["url"] : ($this->url ? $this->url : "");
        $this->contact_name = (isset($row["contact_name"])) ? $row["contact_name"] : ($this->contact_name ? $this->contact_name : "");
        $this->phone = (isset($row["phone"])) ? $row["phone"] : ($this->phone ? $this->phone : "");
        $this->email = (isset($row["email"])) ? $row["email"] : ($this->email ? $this->email : "");
        $this->renewal_date = ($row["renewal_date"]) ? $row["renewal_date"] : ($this->renewal_date ? $this->renewal_date : 0);
        $this->discount_id = ($row["discount_id"]) ? $row["discount_id"] : "";
        $this->facebook_page = (isset($row["facebook_page"])) ? $row["facebook_page"] : ($this->facebook_page ? $this->facebook_page : "");
        $this->status = ($row["status"]) ? $row["status"] : $statusObj->getDefaultStatus();
        $this->level = ($row["level"]) ? $row["level"] : ($this->level ? $this->level : $level->getDefaultLevel());
        $this->recurring = ($row["recurring"]) ? $row["recurring"] : "N";
        $this->day = ($row["day"]) ? $row["day"] : 0;
        $this->dayofweek = ($row["dayofweek"]) ? $row["dayofweek"] : "";
        $this->week = ($row["week"]) ? $row["week"] : "";
        $this->month = ($row["month"]) ? $row["month"] : 0;
        $this->setDate("until_date", ($row["until_date"] ? $row["until_date"] : "0000-00-00"));
        $this->repeat_event = ($row["repeat_event"]) ? $row["repeat_event"] : "N";

        if ($this->recurring == "N") {
            $this->day = 0;
            $this->dayofweek = "";
            $this->week = "";
            $this->month = 0;
            $this->until_date = "0000-00-00";
        }

        $this->number_views = ($row["number_views"]) ? $row["number_views"] : ($this->number_views ? $this->number_views : 0);
        $this->latitude = $row["latitude"] ?: "";
        $this->longitude = $row["longitude"] ?: "";
        $this->map_zoom = ($row["map_zoom"]) ? $row["map_zoom"] : 0;
        $this->data_in_array = $row;
        $this->package_id = ($row["package_id"]) ? $row["package_id"] : ($this->package_id ? $this->package_id : 0);
        $this->package_price = ($row["package_price"]) ? $row["package_price"] : ($this->package_price ? $this->package_price : 0);

        //video_url added on v10.4. This will get the url for existing videos (iframe)
        if ($this->video_snippet && !$this->video_url) {
            $this->video_url = system_getVideoURL($this->video_snippet);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->Save();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @access Public
     */
    function Save()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if ($this->domain_id) {
            $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
            $aux_log_domain_id = $this->domain_id;
        } else {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                $aux_log_domain_id = SELECTED_DOMAIN_ID;
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

            $sql = "UPDATE Event SET"
                . " account_id        = $this->account_id,"
                . " title             = $this->title,"
                . " seo_title         = $this->seo_title,"
                . " friendly_url      = $this->friendly_url,"
                . " image_id          = $this->image_id,"
                . " thumb_id          = $this->thumb_id,"
                . " cover_id          = $this->cover_id,"
                . " description       = $this->description,"
                . " seo_description   = $this->seo_description,"
                . " long_description  = $this->long_description,"
                . " video_snippet     = $this->video_snippet,"
                . " video_url         = $this->video_url,"
                . " keywords          = $this->keywords,"
                . " seo_keywords      = $this->seo_keywords,"
                . " updated           = NOW(),"
                . " start_date        = $this->start_date,"
                . " start_time        = $this->start_time,"
                . " end_date          = $this->end_date,"
                . " end_time          = $this->end_time,"
                . " location          = $this->location,"
                . " address           = $this->address,"
                . " zip_code          = $this->zip_code,"
                . " location_1        = $this->location_1,"
                . " location_2        = $this->location_2,"
                . " location_3        = $this->location_3,"
                . " location_4        = $this->location_4,"
                . " location_5        = $this->location_5,"
                . " url               = $this->url,"
                . " contact_name      = $this->contact_name,"
                . " phone             = $this->phone,"
                . " email             = $this->email,"
                . " renewal_date      = $this->renewal_date,"
                . " discount_id       = $this->discount_id,"
                . " facebook_page     = $this->facebook_page,"
                . " status            = $this->status,"
                . " level             = $this->level,"
                . " recurring         = $this->recurring,"
                . " day               = $this->day,"
                . " dayofweek         = $this->dayofweek,"
                . " week              = $this->week,"
                . " month             = $this->month,"
                . " until_date        = $this->until_date,"
                . " repeat_event      = $this->repeat_event,"
                . " number_views      = $this->number_views,"
                . " latitude          = $this->latitude,"
                . " longitude         = $this->longitude,"
                . " map_zoom          = $this->map_zoom,"
                . " package_id        = $this->package_id,"
                . " package_price     = $this->package_price"
                . " WHERE id          = $this->id";

            $dbObj->query($sql);

            if ($aux_old_account != $aux_account && $aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }

        } else {
            $sql = "INSERT INTO Event"
                . " (account_id,"
                . " title,"
                . " seo_title,"
                . " friendly_url,"
                . " image_id,"
                . " thumb_id,"
                . " cover_id,"
                . " description,"
                . " seo_description,"
                . " long_description,"
                . " video_snippet,"
                . " video_url,"
                . " keywords,"
                . " seo_keywords,"
                . " updated,"
                . " entered,"
                . " start_date,"
                . " start_time,"
                . " end_date,"
                . " end_time,"
                . " location,"
                . " address,"
                . " zip_code,"
                . " location_1,"
                . " location_2,"
                . " location_3,"
                . " location_4,"
                . " location_5,"
                . " url,"
                . " contact_name,"
                . " phone,"
                . " email,"
                . " renewal_date,"
                . " discount_id,"
                . " facebook_page,"
                . " status,"
                . " level,"
                . " fulltextsearch_keyword,"
                . " fulltextsearch_where,"
                . " recurring,"
                . " day,"
                . " dayofweek,"
                . " week,"
                . " month,"
                . " until_date,"
                . " repeat_event,"
                . " number_views,"
                . " latitude,"
                . " longitude,"
                . " map_zoom,"
                . " package_id,"
                . " package_price)"
                . " VALUES"
                . " ($this->account_id,"
                . " $this->title,"
                . " $this->seo_title,"
                . " $this->friendly_url,"
                . " $this->image_id,"
                . " $this->thumb_id,"
                . " $this->cover_id,"
                . " $this->description,"
                . " $this->seo_description,"
                . " $this->long_description,"
                . " $this->video_snippet,"
                . " $this->video_url,"
                . " $this->keywords,"
                . " $this->seo_keywords,"
                . " NOW(),"
                . " NOW(),"
                . " $this->start_date,"
                . " $this->start_time,"
                . " $this->end_date,"
                . " $this->end_time,"
                . " $this->location,"
                . " $this->address,"
                . " $this->zip_code,"
                . " $this->location_1,"
                . " $this->location_2,"
                . " $this->location_3,"
                . " $this->location_4,"
                . " $this->location_5,"
                . " $this->url,"
                . " $this->contact_name,"
                . " $this->phone,"
                . " $this->email,"
                . " $this->renewal_date,"
                . " $this->discount_id,"
                . " $this->facebook_page,"
                . " $this->status,"
                . " $this->level,"
                . " '',"
                . " '',"
                . " $this->recurring,"
                . " $this->day,"
                . " $this->dayofweek,"
                . " $this->week,"
                . " $this->month,"
                . " $this->until_date,"
                . " $this->repeat_event,"
                . " $this->number_views,"
                . " $this->latitude,"
                . " $this->longitude,"
                . " $this->map_zoom,"
                . " $this->package_id,"
                . " $this->package_price)";

            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);

            if ($aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }

        }

        if ((sess_getAccountIdFromSession() && string_strpos($_SERVER["PHP_SELF"],
                    "event.php") !== false) || string_strpos($_SERVER["PHP_SELF"], "order_") !== false
        ) {
            $rowTimeline = array();
            $rowTimeline["item_type"] = "event";
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
     *        $eventObj->Delete();
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

        ### GALERY
        //before deleting the gallery, it needs to clear event image ids
        $sql = "UPDATE Event SET image_id = NULL, cover_id = NULL, thumb_id = NULL WHERE id = $this->id";
        $dbObj->query($sql);

        $sql = "SELECT gallery_id FROM Gallery_Item WHERE item_id = $this->id AND item_type = 'event'";
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
        $sql = "UPDATE Invoice_Event SET event_id = '0' WHERE event_id = $this->id";
        $dbObj->query($sql);

        ### PAYMENT
        $sql = "UPDATE Payment_Event_Log SET event_id = '0' WHERE event_id = $this->id";
        $dbObj->query($sql);

        ### Timeline
        $sql = "DELETE FROM Timeline WHERE item_type = 'event' AND item_id = $this->id";
        $dbObj->query($sql);

        ### Quicklist (Favorites)
        $sql = "DELETE FROM Quicklist WHERE item_type = 'event' AND item_id = $this->id";
        $dbObj->query($sql);

        ### EVENT
        $sql = "DELETE FROM Event WHERE id = $this->id";
        $dbObj->query($sql);

        if ($domain_id) {
            $domain_idDash = $domain_id;
        } else {
            $domain_idDash = SELECTED_DOMAIN_ID;
        }

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("event.synchronization")->addDelete($this->id);
        }

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getCategories();
     * <br /><br />
     *        //Using this in Event() class.
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
        $sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Event WHERE id = $this->id";
        $r = $dbObj->query($sql);
        while ($row = mysql_fetch_array($r)) {
            if ($row["cat_1_id"]) {
                $categories[] = new EventCategory($row["cat_1_id"]);
            }
            if ($row["cat_2_id"]) {
                $categories[] = new EventCategory($row["cat_2_id"]);
            }
            if ($row["cat_3_id"]) {
                $categories[] = new EventCategory($row["cat_3_id"]);
            }
            if ($row["cat_4_id"]) {
                $categories[] = new EventCategory($row["cat_4_id"]);
            }
            if ($row["cat_5_id"]) {
                $categories[] = new EventCategory($row["cat_5_id"]);
            }
        }

        return $categories;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->setCategories();
     * <br /><br />
     *        //Using this in Event() class.
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

        $cat_1_id = 'null';
        $parcat_1_level1_id = 0;
        $parcat_1_level2_id = 0;
        $parcat_1_level3_id = 0;
        $parcat_1_level4_id = 0;
        $cat_2_id = 'null';
        $parcat_2_level1_id = 0;
        $parcat_2_level2_id = 0;
        $parcat_2_level3_id = 0;
        $parcat_2_level4_id = 0;
        $cat_3_id = 'null';
        $parcat_3_level1_id = 0;
        $parcat_3_level2_id = 0;
        $parcat_3_level3_id = 0;
        $parcat_3_level4_id = 0;
        $cat_4_id = 'null';
        $parcat_4_level1_id = 0;
        $parcat_4_level2_id = 0;
        $parcat_4_level3_id = 0;
        $parcat_4_level4_id = 0;
        $cat_5_id = 'null';
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
                        $sql = "SELECT * FROM EventCategory WHERE id = $cat_id";
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
        $sql = "UPDATE Event SET cat_1_id = " . $cat_1_id . ", parcat_1_level1_id = " . $parcat_1_level1_id . ", parcat_1_level2_id = " . $parcat_1_level2_id . ", parcat_1_level3_id = " . $parcat_1_level3_id . ", parcat_1_level4_id = " . $parcat_1_level4_id . ", cat_2_id = " . $cat_2_id . ", parcat_2_level1_id = " . $parcat_2_level1_id . ", parcat_2_level2_id = " . $parcat_2_level2_id . ", parcat_2_level3_id = " . $parcat_2_level3_id . ", parcat_2_level4_id = " . $parcat_2_level4_id . ", cat_3_id = " . $cat_3_id . ", parcat_3_level1_id = " . $parcat_3_level1_id . ", parcat_3_level2_id = " . $parcat_3_level2_id . ", parcat_3_level3_id = " . $parcat_3_level3_id . ", parcat_3_level4_id = " . $parcat_3_level4_id . ", cat_4_id = " . $cat_4_id . ", parcat_4_level1_id = " . $parcat_4_level1_id . ", parcat_4_level2_id = " . $parcat_4_level2_id . ", parcat_4_level3_id = " . $parcat_4_level3_id . ", parcat_4_level4_id = " . $parcat_4_level4_id . ", cat_5_id = " . $cat_5_id . ", parcat_5_level1_id = " . $parcat_5_level1_id . ", parcat_5_level2_id = " . $parcat_5_level2_id . ", parcat_5_level3_id = " . $parcat_5_level3_id . ", parcat_5_level4_id = " . $parcat_5_level4_id . " WHERE id = $this->id";
        $dbObj->query($sql);
        $this->setFullTextSearch();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getCategories();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getCategories();
     * </code>
     * @copyright Copyrighion getPrice(t 2005 Arca Solutions, Inc.
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

        $levelObj = new EventLevel();

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

            if (is_valid_discount_code($this->discount_id, "event", $this->id, $discount_message, $discount_error)) {

                if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

                    if ($discountCodeObj->getString("type") == "percentage") {
                        $price = $price * (1 - $discountCodeObj->getString("amount") / 100);
                    } elseif ($discountCodeObj->getString("type") == "monetary value") {
                        $price = $price - $discountCodeObj->getString("amount");
                    }

                } elseif (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;

                    $sql = "UPDATE Event SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                    $result = $dbObj->query($sql);
                }

            } else {

                if (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;
                    $sql = "UPDATE Event SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                } else {
                    $sql = "UPDATE Event SET discount_id = '' WHERE id = " . $this->id;
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
     *        $eventObj->hasRenewalDate();
     * <br /><br />
     *        //Using this in Event() class.
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
     *        $eventObj->needToCheckOut();
     * <br /><br />
     *        //Using this in Event() class.
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
     *        $eventObj->getNextRenewalDate($times);
     * <br /><br />
     *        //Using this in Event() class.
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
                $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year + ($renewalcycle * $times)));
            }

        }

        return $nextrenewaldate;

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getDateString();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getDateString();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getDateString
     * @access Public
     * @return string
     */
    function getDateString($use_text = false)
    {
        $str_date = "";

        if ($this->getDate("start_date") == $this->getDate("end_date")) {
            $str_date = $this->getDate("start_date");
        } elseif ($this->getString("recurring") != "Y") {
            if ($use_text) {
                $str_date = "<p><strong>" . ucfirst(system_showText(LANG_LABEL_FROM)) . ": </strong>" . "<span>" . $this->getDate("start_date") . "</span></p>" . "<p><strong>" . ucfirst(system_showText(LANG_LABEL_DATE_TO)) . ": </strong>" . "<span>" . $this->getDate("end_date") . "</span></p>";
            } else {
                $str_date = $this->getDate("start_date") . " - " . $this->getDate("end_date");
            }
        } else {
            $str_date = $this->getDateStringRecurring();
        }

        return $str_date;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getDateStringEnd();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getDateStringEnd();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getDateStringEnd
     * @access Public
     * @return string
     */
    function getDateStringEnd()
    {
        $str_date = "";
        $str_date = $this->getDate("until_date");

        return $str_date;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getDateStringRecurring();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getDateStringRecurring();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getDateStringRecurring
     * @access Public
     * @return string
     */
    function getDateStringRecurring()
    {
        $str_date = "";

        if ($this->getString("recurring") == "Y") {

            $month_names = explode(",", LANG_DATE_MONTHS);
            $weekday_names = explode(",", LANG_DATE_WEEKDAYS);

            if ($this->getString("dayofweek") && $this->getNumber("week") && $this->getNumber("month")) { //yearly with determined week and random days

                $aux = system_getRecurringWeeks($this->getString("week"));
                $checkDays = system_checkDay($this->getString("dayofweek"));
                $str_date .= $checkDays;
                if ($aux) {
                    $str_date .= ", " . LANG_EVERY2 . " " . $aux . system_showText(LANG_WEEK) . " " . system_showText(LANG_OF2) . " " . ucfirst($month_names[$this->getNumber("month") - 1]);
                } else {
                    $str_date .= " " . system_showText(LANG_OF2) . " " . ucfirst($month_names[$this->getNumber("month") - 1]);
                }

            } elseif ($this->getNumber("day")) { //monthly or yearly with determined day

                if ($this->getNumber("month")) {
                    if (EDIR_LANGUAGE == "en_us") {
                        $str_date .= ucfirst($month_names[$this->getNumber("month") - 1]) . " " . system_getOrdinalLabel($this->getNumber("day")) . ", " . LANG_EVERY_YEAR;
                    } else {
                        $str_date .= ucfirst(system_showText(LANG_DAY)) . " " . $this->getNumber("day") . " " . system_showText(LANG_OF2) . " " . ucfirst($month_names[$this->getNumber("month") - 1]);
                    }
                } else {
                    if (EDIR_LANGUAGE == "en_us") {
                        $str_date .= system_getOrdinalLabel($this->getNumber("day")) . " " . ucfirst(system_showText(LANG_DAY)) . " " . LANG_OF . " " . LANG_THE_MONTH;
                    } else {
                        $str_date .= system_showText(LANG_EVERY2) . " " . system_showText(LANG_DAY) . " " . $this->getNumber("day");
                    }
                }

            } elseif ($this->getString("dayofweek")) { //weekly or monthly, with determined week and random days

                if ($this->getNumber("week")) {

                    $aux = system_getRecurringWeeks($this->getString("week"));
                    $checkDays = system_checkDay($this->getString("dayofweek"));
                    $str_date .= $checkDays . " ";
                    if ($aux) {
                        $str_date = str_replace(LANG_EVERY2 . " " . ucfirst(LANG_EVENT_WEEKEND),
                            ucfirst(LANG_EVENT_WEEKENDS) . ", ", $str_date);
                        $str_date .= LANG_EVERY2 . " " . $aux . LANG_WEEK . (EDIR_LANGUAGE == "en_us" ? " " . LANG_OF2 : "") . " " . LANG_THE_MONTH;
                    }
                } else {
                    $checkDays = system_checkDay($this->getString("dayofweek"));
                    $str_date .= $checkDays;
                }

            } else { //daily
                $str_date .= system_showText(LANG_DAILY2);
            }

        }

        return $str_date;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getTimeString();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getTimeString();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getTimeString
     * @access Public
     * @return string
     */
    function getTimeString()
    {
        $str_time = "";
        if ($this->getString("start_time") && $this->getString("end_time") && $this->getString("start_time") != 'NULL' && $this->getString("end_time") != 'NULL') {
            if ($this->getString("start_time")) {
                $str_time = format_getTimeString($this->getString("start_time"));
            } else {
                $str_time .= LANG_NA;
            }
            $str_time .= " - ";
            if ($this->getString("end_time")) {
                $str_time .= format_getTimeString($this->getString("end_time"));
            } else {
                $str_time .= LANG_NA;
            }
        }

        return $str_time;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getMonthAbbr();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getMonthAbbr();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getMonthAbbr
     * @access Public
     * @return string
     */
    function getMonthAbbr()
    {
        $aux = explode("/", $this->getDate("start_date"));
        $months = explode(",", LANG_DATE_MONTHS);
        if (DEFAULT_DATE_FORMAT == "m/d/Y") {
            $month = $aux[0];
        } else {
            $month = $aux[1];
        }

        switch ($month) {
            case "01" :
                return string_substr($months[0], 0, 3);
                break;
            case "02" :
                return string_substr($months[1], 0, 3);
                break;
            case "03" :
                return string_substr($months[2], 0, 3);
                break;
            case "04" :
                return string_substr($months[3], 0, 3);
                break;
            case "05" :
                return string_substr($months[4], 0, 3);
                break;
            case "06" :
                return string_substr($months[5], 0, 3);
                break;
            case "07" :
                return string_substr($months[6], 0, 3);
                break;
            case "08" :
                return string_substr($months[7], 0, 3);
                break;
            case "09" :
                return string_substr($months[8], 0, 3);
                break;
            case "10" :
                return string_substr($months[9], 0, 3);
                break;
            case "11" :
                return string_substr($months[10], 0, 3);
                break;
            case "12" :
                return string_substr($months[11], 0, 3);
                break;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->checkStartDate();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->checkStartDate();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name checkStartDate
     * @access Public
     * @return string
     */
    function checkStartDate()
    {
        if ($this->getString("recurring") != "Y") {
            $today = date("Y-m-d");
            $auxStartDate = explode("/", $this->getDate("start_date"));
            if (DEFAULT_DATE_FORMAT == "m/d/Y") {
                $startDate = $auxStartDate[2] . "-" . $auxStartDate[0] . "-" . $auxStartDate[1];
            } else {
                $startDate = $auxStartDate[2] . "-" . $auxStartDate[1] . "-" . $auxStartDate[0];
            }
            if ($today == $startDate) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getMonthAbbr();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getMonthAbbr();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getTimeString
     * @access Public
     * @return string
     */
    function getDayStr()
    {
        $aux = explode("/", $this->getDate("start_date"));
        if (DEFAULT_DATE_FORMAT == "m/d/Y") {
            return $aux[1];
        } else {
            return $aux[0];
        }

    }

    /**
     * <code>
     *        //Using this in Event() class.
     *        $this->setLocationManager(&$locationManager);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setLocationManager
     * @access Public
     * @param string $locationManager
     */
    function setLocationManager(&$locationManager)
    {
        $this->locationManager =& $locationManager;
    }

    /**
     * <code>
     *        //Using this in Event() class.
     *        $this->getLocationManager();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getLocationManager
     * @access Public
     * @return array
     */
    function &getLocationManager()
    {
        return $this->locationManager; /* NEVER auto-instantiate this*/
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getLocationString($format,$forceManagerCreation);
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getLocationString();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getLocationString
     * @access Public
     * @param string $format , boolean $forceManagerCreation
     * @return array
     */
    function getLocationString($format, $forceManagerCreation = false, $lineBreak = true)
    {
        if ($forceManagerCreation && !$this->locationManager) {
            $this->locationManager = new LocationManager();
        }

        return db_getLocationString($this, $format, true, $lineBreak);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->setFullTextSearch();
     * <br /><br />
     *        //Using this in Event() class.
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

        if ($this->description) {
            $fulltextsearch_keyword[] = string_substr($this->description, 0, 100);
        }

        if ($this->address) {
            $fulltextsearch_where[] = $this->address;
        }

        if ($this->location) {
            $fulltextsearch_where[] = $this->location;
        }

        if ($this->zip_code) {
            $fulltextsearch_where[] = $this->zip_code;
        }

        $Location1 = new Location1($this->location_1);
        if ($Location1->getNumber("id")) {
            $fulltextsearch_where[] = $Location1->getString("name", false);
            if ($Location1->getString("abbreviation")) {
                $fulltextsearch_where[] = $Location1->getString("abbreviation", false);
            }
        }

        $_locations = explode(",", EDIR_LOCATIONS);
        foreach ($_locations as $each_location) {
            unset ($objLocation);
            $objLocationLabel = "Location" . $each_location;
            $attributeLocation = 'location_' . $each_location;
            $objLocation = new $objLocationLabel;
            $objLocation->SetString("id", $this->$attributeLocation);
            $locationsInfo = $objLocation->retrieveLocationById();
            if ($locationsInfo["id"]) {
                $fulltextsearch_where[] = $locationsInfo["name"];
                if ($locationsInfo["abbreviation"]) {
                    $fulltextsearch_where[] = $locationsInfo["abbreviation"];
                }
            }
        }

        $categories = $this->getCategories();
        if ($categories) {
            foreach ($categories as $category) {
                unset($parents);
                $category_id = $category->getNumber("id");
                while (!is_null($category_id) && $category_id != 0) {
                    $sql = "SELECT * FROM EventCategory WHERE id = $category_id";
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
            $sql = "UPDATE Event SET fulltextsearch_keyword = {$fulltextsearch_keyword_sql} WHERE id = {$this->id}";
            $result = $dbObj->query($sql);
        }

        if (is_array($fulltextsearch_where)) {
            $fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
            $sql = "UPDATE Event SET fulltextsearch_where = {$fulltextsearch_where_sql} WHERE id = {$this->id}";
            $result = $dbObj->query($sql);
        }

        $this->synchronize();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->getGalleries();
     * <br /><br />
     *        //Using this in Event() class.
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
        $sql = "SELECT * FROM Gallery_Item WHERE item_type='event' AND item_id = $this->id ORDER BY gallery_id";
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
     *        $eventObj->setGalleries($gallery);
     * <br /><br />
     *        //Using this in Event() class.
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
        $sql = "DELETE FROM Gallery_Item WHERE item_type='event' AND item_id = $this->id";
        $dbObj->query($sql);
        if ($gallery) {
            $sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'event')";
            $rs3 = $dbObj->query($sql);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->hasDetail();
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->hasDetail();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name hasDetail
     * @access Public
     * @return char
     */
    function hasDetail()
    {
        $eventLevel = new EventLevel();
        $detail = $eventLevel->getDetail($this->level);
        unset($eventLevel);

        return $detail;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->setNumberViews($id);
     * <br /><br />
     *        //Using this in Event() class.
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
        $sql = "UPDATE Event SET number_views = " . $this->number_views . " + 1 WHERE Event.id = " . $id;
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("event.synchronization")->addViewUpdate($id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $eventObj->deletePerAccount($account_id);
     * <br /><br />
     *        //Using this in Event() class.
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
            $sql = "SELECT * FROM Event WHERE account_id = $account_id";
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
     *        $eventObj->getEventByFriendlyURL($friendly_url);
     * <br /><br />
     *        //Using this in Event() class.
     *        $this->getEventByFriendlyURL($friendly_url);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getEventByFriendlyURL
     * @param string $friendly_url
     * @access Public
     */
    function getEventByFriendlyURL($friendly_url)
    {
        $dbObj = db_getDBObject();
        $sql = "SELECT * FROM Event WHERE friendly_url = '" . $friendly_url . "'";
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
                $symfonyContainer->get("event.synchronization")->addUpsert($this->id);
            } else {
                $symfonyContainer->get("event.synchronization")->addDelete($this->id);
            }
        }
    }
}

