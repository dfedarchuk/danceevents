<?php

class Classified extends Handle
{
    var $id;
    var $account_id;
    var $location_1;
    var $location_2;
    var $location_3;
    var $location_4;
    var $location_5;
    var $entered;
    var $updated;
    var $renewal_date;
    var $discount_id;
    var $title;
    var $seo_title;
    var $friendly_url;
    var $email;
    var $url;
    var $contactname;
    var $address;
    var $address2;
    var $phone;
    var $fax;
    var $summarydesc;
    var $seo_summarydesc;
    var $detaildesc;
    var $keywords;
    var $seo_keywords;
    var $image_id;
    var $thumb_id;
    var $cover_id;
    var $zip_code;
    var $level;
    var $status;
    var $latitude;
    var $longitude;
    var $map_zoom;
    var $locationManager;
    var $classified_price;
    var $number_views;
    var $data_in_array;
    var $domain_id;
    var $package_id;
    var $package_price;
    var $listing_id;
    var $video_snippet;
    var $video_url;
    var $video_description;
    var $attachment_file;
    var $attachment_caption;

    /**
     * <code>
     *        $classifiedObj = new Classified($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Classified
     * @access Public
     * @param integer $var
     */
    function Classified($var = '', $domain_id = false)
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
            $sql = "SELECT * FROM Classified WHERE id = {$var}";
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
    function makeFromRow($row = '')
    {
        $status = new ItemStatus();
        $level = new ClassifiedLevel();

        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->account_id = ($row["account_id"]) ? $row["account_id"] : 0;
        $this->location_1 = ($row["location_1"]) ? $row["location_1"] : 0;
        $this->location_2 = ($row["location_2"]) ? $row["location_2"] : 0;
        $this->location_3 = ($row["location_3"]) ? $row["location_3"] : 0;
        $this->location_4 = ($row["location_4"]) ? $row["location_4"] : 0;
        $this->location_5 = ($row["location_5"]) ? $row["location_5"] : 0;
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : "");
        $this->updated = ($row["updated"]) ? $row["updated"] : ($this->updated ? $this->updated : "");
        $this->renewal_date = ($row["renewal_date"]) ? $row["renewal_date"] : ($this->renewal_date ? $this->renewal_date : 0);
        $this->discount_id = ($row["discount_id"]) ? $row["discount_id"] : "";
        $this->title = ($row["title"]) ? $row["title"] : ($this->title ? $this->title : "");
        $this->seo_title = (isset($row["seo_title"])) ? $row["seo_title"] : ($this->seo_title ? $this->seo_title : "");
        $this->friendly_url = ($row["friendly_url"]) ? $row["friendly_url"] : "";
        $this->email = (isset($row["email"])) ? $row["email"] : ($this->email ? $this->email : "");
        $this->url = (isset($row["url"])) ? $row["url"] : ($this->url ? $this->url : "");
        $this->contactname = (isset($row["contactname"])) ? $row["contactname"] : ($this->contactname ? $this->contactname : "");
        $this->address = ($row["address"]) ? $row["address"] : "";
        $this->address2 = ($row["address2"]) ? $row["address2"] : "";
        $this->phone = (isset($row["phone"])) ? $row["phone"] : ($this->phone ? $this->phone : "");
        $this->fax = (isset($row["fax"])) ? $row["fax"] : ($this->fax ? $this->fax : "");
        $this->summarydesc = (isset($row["summarydesc"])) ? $row["summarydesc"] : ($this->summarydesc ? $this->summarydesc : "");
        $this->seo_summarydesc = (isset($row["seo_summarydesc"])) ? $row["seo_summarydesc"] : ($this->seo_summarydesc ? $this->seo_summarydesc : "");
        $this->detaildesc = (isset($row["detaildesc"])) ? $row["detaildesc"] : ($this->detaildesc ? $this->detaildesc : "");
        $this->keywords = ($row["keywords"]) ? $row["keywords"] : "";
        $this->seo_keywords = (isset($row["seo_keywords"])) ? $row["seo_keywords"] : ($this->seo_keywords ? $this->seo_keywords : "");
        $this->image_id = (isset($row["image_id"])) ? (empty($row["image_id"])? 'NULL': $row["image_id"] ): ($this->image_id ? $this->image_id : 'NULL');
        $this->thumb_id = (isset($row["thumb_id"])) ? (empty($row["thumb_id"])? 'NULL': $row["thumb_id"] ): ($this->thumb_id ? $this->thumb_id : 'NULL');
        $this->cover_id = (isset($row["cover_id"])) ? (empty($row["cover_id"])? 'NULL': $row["cover_id"] ): ($this->cover_id ? $this->cover_id : 'NULL');
        $this->zip_code = ($row["zip_code"]) ? $row["zip_code"] : "";
        $this->level = ($row["level"]) ? $row["level"] : ($this->level ? $this->level : $level->getDefaultLevel());
        $this->status = ($row["status"]) ? $row["status"] : $status->getDefaultStatus();
        $this->latitude = $row["latitude"] ?: "";
        $this->longitude = $row["longitude"] ?: "";
        $this->map_zoom = ($row["map_zoom"]) ? $row["map_zoom"] : 0;
        $this->classified_price = (isset($row["classified_price"])) ? (empty($row["classified_price"])? 'NULL': $row["classified_price"] ): ($this->classified_price ? $this->classified_price : 'NULL');
        $this->number_views = ($row["number_views"]) ? $row["number_views"] : ($this->number_views ? $this->number_views : 0);
        $this->data_in_array = $row;
        $this->package_id = ($row["package_id"]) ? $row["package_id"] : ($this->package_id ? $this->package_id : 0);
        $this->package_price = ($row["package_price"]) ? $row["package_price"] : ($this->package_price ? $this->package_price : 0);
        $this->listing_id = ($row["listing_id"]) ? (int)$row["listing_id"] : "NULL";
        $this->video_snippet = (isset($row["video_snippet"])) ? $row["video_snippet"] : ($this->video_snippet ? $this->video_snippet : "NULL");
        $this->video_url = (isset($row["video_url"])) ? $row["video_url"] : ($this->video_url ? $this->video_url : "NULL");
        $this->video_description = (isset($row["video_description"])) ? $row["video_description"] : ($this->video_description ? $this->video_description : "NULL");
        $this->attachment_file = (isset($row["attachment_file"])) ? $row["attachment_file"] : ($this->attachment_file ? $this->attachment_file : "");
        $this->attachment_caption = (isset($row["attachment_caption"])) ? $row["attachment_caption"] : ($this->attachment_caption ? $this->attachment_caption : "");

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->Save();
     * <br /><br />
     *        //Using this in Classified() class.
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
        if ($this->video_snippet == "''") {
            $this->video_snippet = "NULL";
        }
        if ($this->video_url == "''") {
            $this->video_url = "NULL";
        }
        if ($this->video_description == "''") {
            $this->video_description = "NULL";
        }
        if($this->classified_price < 0.1){
            $this->classified_price = "NULL";
        }

        if ($this->id) {

            $updateItem = true;

            $sql = "UPDATE Classified SET"
                . " account_id         = $this->account_id,"
                . " location_1         = $this->location_1,"
                . " location_2         = $this->location_2,"
                . " location_3         = $this->location_3,"
                . " location_4         = $this->location_4,"
                . " location_5         = $this->location_5,"
                . " updated            = NOW(),"
                . " renewal_date       = $this->renewal_date,"
                . " discount_id        = $this->discount_id,"
                . " title              = $this->title,"
                . " seo_title          = $this->seo_title,"
                . " friendly_url       = $this->friendly_url,"
                . " email              = $this->email,"
                . " url                = $this->url,"
                . " contactname        = $this->contactname,"
                . " address            = $this->address,"
                . " address2           = $this->address2,"
                . " phone              = $this->phone,"
                . " fax                = $this->fax,"
                . " summarydesc        = $this->summarydesc,"
                . " seo_summarydesc    = $this->seo_summarydesc,"
                . " detaildesc         = $this->detaildesc,"
                . " keywords           = $this->keywords,"
                . " seo_keywords       = $this->seo_keywords,"
                . " image_id           = $this->image_id,"
                . " thumb_id           = $this->thumb_id,"
                . " cover_id           = $this->cover_id,"
                . " zip_code           = $this->zip_code,"
                . " level              = $this->level,"
                . " status             = $this->status,"
                . " latitude           = $this->latitude,"
                . " longitude          = $this->longitude,"
                . " map_zoom           = $this->map_zoom,"
                . " classified_price   = $this->classified_price,"
                . " number_views	   = $this->number_views,"
                . " package_id         = $this->package_id,"
                . " package_price	   = $this->package_price,"
                . " listing_id	       = $this->listing_id,"
                . " video_snippet      = $this->video_snippet,"
                . " video_url          = $this->video_url,"
                . " video_description  = $this->video_description,"
                . " attachment_file    = $this->attachment_file,"
                . " attachment_caption = $this->attachment_caption"
                . " WHERE id           = $this->id";
            $dbObj->query($sql);

            if ($aux_old_account != $aux_account && $aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }

        } else {
            $sql = "INSERT INTO Classified"
                . " (account_id,"
                . " location_1,"
                . " location_2,"
                . " location_3,"
                . " location_4,"
                . " location_5,"
                . " updated,"
                . " entered,"
                . " renewal_date,"
                . " discount_id,"
                . " title,"
                . " seo_title,"
                . " friendly_url,"
                . " email,"
                . " url,"
                . " contactname,"
                . " address,"
                . " address2,"
                . " phone,"
                . " fax,"
                . " summarydesc,"
                . " seo_summarydesc,"
                . " detaildesc,"
                . " keywords,"
                . " seo_keywords,"
                . " fulltextsearch_keyword,"
                . " fulltextsearch_where,"
                . " image_id,"
                . " thumb_id,"
                . " cover_id,"
                . " zip_code,"
                . " level,"
                . " status,"
                . " latitude,"
                . " longitude,"
                . " map_zoom,"
                . " classified_price,"
                . " number_views,"
                . " package_id,"
                . " package_price,"
                . " listing_id,"
                . " video_snippet,"
                . " video_url,"
                . " video_description,"
                . " attachment_file,"
                . " attachment_caption)"
                . " VALUES"
                . " ($this->account_id,"
                . " $this->location_1,"
                . " $this->location_2,"
                . " $this->location_3,"
                . " $this->location_4,"
                . " $this->location_5,"
                . " NOW(),"
                . " NOW(),"
                . " $this->renewal_date,"
                . " $this->discount_id,"
                . " $this->title,"
                . " $this->seo_title,"
                . " $this->friendly_url,"
                . " $this->email,"
                . " $this->url,"
                . " $this->contactname,"
                . " $this->address,"
                . " $this->address2,"
                . " $this->phone,"
                . " $this->fax,"
                . " $this->summarydesc,"
                . " $this->seo_summarydesc,"
                . " $this->detaildesc,"
                . " $this->keywords,"
                . " $this->seo_keywords,"
                . " '',"
                . " '',"
                . " $this->image_id,"
                . " $this->thumb_id,"
                . " $this->cover_id,"
                . " $this->zip_code,"
                . " $this->level,"
                . " $this->status,"
                . " $this->latitude,"
                . " $this->longitude,"
                . " $this->map_zoom,"
                . " $this->classified_price,"
                . " $this->number_views,"
                . " $this->package_id,"
                . " $this->package_price,"
                . " $this->listing_id,"
                . " $this->video_snippet,"
                . " $this->video_url,"
                . " $this->video_description,"
                . " $this->attachment_file,"
                . " $this->attachment_caption)";

            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);

            if ($aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }

        }

        if ((sess_getAccountIdFromSession() && string_strpos($_SERVER["PHP_SELF"],
                    "classified.php") !== false) || string_strpos($_SERVER["PHP_SELF"], "order_") !== false
        ) {
            $rowTimeline = array();
            $rowTimeline["item_type"] = "classified";
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
     *        $classifiedObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Delete
     * @access Public
     */
    function Delete($domain_id = false)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if ($domain_id) {
            $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
            $domain_extra_file_dir = EDIRECTORY_ROOT . "/custom/domain_$domain_id/extra_files/";
        } else {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            $domain_extra_file_dir = EXTRAFILE_DIR;
            unset($dbMain);
        }

        ### GALERY
        //before deleting the gallery, it needs to clear classified image ids
        $sql = "UPDATE Classified SET image_id = NULL, cover_id = NULL, thumb_id = NULL WHERE id = $this->id";
        $dbObj->query($sql);

        $sql = "SELECT gallery_id FROM Gallery_Item WHERE item_id = $this->id AND item_type = 'classified'";
        $row = mysql_fetch_array($dbObj->query($sql));
        $gallery_id = $row["gallery_id"];
        if ($gallery_id) {
            $gallery = new Gallery($gallery_id);
            $gallery->delete();
        }

        ### IMAGES
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

        ### ATTACHMENT
        if ($this->attachment_file) {
            if (file_exists($domain_extra_file_dir . $this->attachment_file)) {
                @unlink($domain_extra_file_dir . $this->attachment_file);
            }
        }

        ### INVOICE
        $sql = "UPDATE Invoice_Classified SET classified_id = '0' WHERE classified_id = $this->id";
        $dbObj->query($sql);

        ### PAYMENT
        $sql = "UPDATE Payment_Classified_Log SET classified_id = '0' WHERE classified_id = $this->id";
        $dbObj->query($sql);

        ### Timeline
        $sql = "DELETE FROM Timeline WHERE item_type = 'classified' AND item_id = $this->id";
        $dbObj->query($sql);

        ### Quicklist (Favorites)
        $sql = "DELETE FROM Quicklist WHERE item_type = 'classified' AND item_id = $this->id";
        $dbObj->query($sql);

        ### CLASSIFIED
        $sql = "DELETE FROM Classified WHERE id = $this->id";
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("classified.synchronization")->addDelete($this->id);
        }

        if ($domain_id) {
            $domain_idDash = $domain_id;
        } else {
            $domain_idDash = SELECTED_DOMAIN_ID;
        }

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->getCategories();
     * <br /><br />
     *        //Using this in Classified() class.
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
        $sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Classified WHERE id = $this->id";
        $r = $dbObj->query($sql);
        while ($row = mysql_fetch_array($r)) {
            if ($row["cat_1_id"]) {
                $categories[] = new ClassifiedCategory($row["cat_1_id"]);
            }
            if ($row["cat_2_id"]) {
                $categories[] = new ClassifiedCategory($row["cat_2_id"]);
            }
            if ($row["cat_3_id"]) {
                $categories[] = new ClassifiedCategory($row["cat_3_id"]);
            }
            if ($row["cat_4_id"]) {
                $categories[] = new ClassifiedCategory($row["cat_4_id"]);
            }
            if ($row["cat_5_id"]) {
                $categories[] = new ClassifiedCategory($row["cat_5_id"]);
            }
        }

        return $categories;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->setCategories();
     * <br /><br />
     *        //Using this in Classified() class.
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

        $cat_1_id = 'NULL';
        $parcat_1_level1_id = 0;
        $parcat_1_level2_id = 0;
        $parcat_1_level3_id = 0;
        $parcat_1_level4_id = 0;
        $cat_2_id = 'NULL';
        $parcat_2_level1_id = 0;
        $parcat_2_level2_id = 0;
        $parcat_2_level3_id = 0;
        $parcat_2_level4_id = 0;
        $cat_3_id = 'NULL';
        $parcat_3_level1_id = 0;
        $parcat_3_level2_id = 0;
        $parcat_3_level3_id = 0;
        $parcat_3_level4_id = 0;
        $cat_4_id = 'NULL';
        $parcat_4_level1_id = 0;
        $parcat_4_level2_id = 0;
        $parcat_4_level3_id = 0;
        $parcat_4_level4_id = 0;
        $cat_5_id = 'NULL';
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
                        $sql = "SELECT * FROM ClassifiedCategory WHERE id = $cat_id";
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
        $sql = "UPDATE Classified SET cat_1_id = " . $cat_1_id . ", parcat_1_level1_id = " . $parcat_1_level1_id . ", parcat_1_level2_id = " . $parcat_1_level2_id . ", parcat_1_level3_id = " . $parcat_1_level3_id . ", parcat_1_level4_id = " . $parcat_1_level4_id . ", cat_2_id = " . $cat_2_id . ", parcat_2_level1_id = " . $parcat_2_level1_id . ", parcat_2_level2_id = " . $parcat_2_level2_id . ", parcat_2_level3_id = " . $parcat_2_level3_id . ", parcat_2_level4_id = " . $parcat_2_level4_id . ", cat_3_id = " . $cat_3_id . ", parcat_3_level1_id = " . $parcat_3_level1_id . ", parcat_3_level2_id = " . $parcat_3_level2_id . ", parcat_3_level3_id = " . $parcat_3_level3_id . ", parcat_3_level4_id = " . $parcat_3_level4_id . ", cat_4_id = " . $cat_4_id . ", parcat_4_level1_id = " . $parcat_4_level1_id . ", parcat_4_level2_id = " . $parcat_4_level2_id . ", parcat_4_level3_id = " . $parcat_4_level3_id . ", parcat_4_level4_id = " . $parcat_4_level4_id . ", cat_5_id = " . $cat_5_id . ", parcat_5_level1_id = " . $parcat_5_level1_id . ", parcat_5_level2_id = " . $parcat_5_level2_id . ", parcat_5_level3_id = " . $parcat_5_level3_id . ", parcat_5_level4_id = " . $parcat_5_level4_id . " WHERE id = $this->id";
        $dbObj->query($sql);
        $this->setFullTextSearch();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->getCategories();
     * <br /><br />
     *        //Using this in Classified() class.
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

        $levelObj = new ClassifiedLevel();

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

            if (is_valid_discount_code($this->discount_id, "classified", $this->id, $discount_message,
                $discount_error)) {

                if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

                    if ($discountCodeObj->getString("type") == "percentage") {
                        $price = $price * (1 - $discountCodeObj->getString("amount") / 100);
                    } elseif ($discountCodeObj->getString("type") == "monetary value") {
                        $price = $price - $discountCodeObj->getString("amount");
                    }

                } elseif (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;

                    $sql = "UPDATE Classified SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                    $result = $dbObj->query($sql);
                }

            } else {

                if (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;
                    $sql = "UPDATE Classified SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                } else {
                    $sql = "UPDATE Classified SET discount_id = '' WHERE id = " . $this->id;
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
     *        $classifiedObj->hasRenewalDate();
     * <br /><br />
     *        //Using this in Classified() class.
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
     *        $classifiedObj->needToCheckOut();
     * <br /><br />
     *        //Using this in Classified() class.
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
     *        $classifiedObj->getNextRenewalDate($times);
     * <br /><br />
     *        //Using this in Classified() class.
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
     *        //Using this in Classified() class.
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
     *        //Using this in Classified() class.
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
     *        $classifiedObj->getLocationString($format,$forceManagerCreation);
     * <br /><br />
     *        //Using this in Classified() class.
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
     *        $classifiedObj->setFullTextSearch();
     * <br /><br />
     *        //Using this in Classified() class.
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

        if ($this->summarydesc) {
            $fulltextsearch_keyword[] = string_substr($this->summarydesc, 0, 100);
        }

        if ($this->address) {
            $fulltextsearch_where[] = $this->address;
        }

        if ($this->zip_code) {
            $fulltextsearch_where[] = $this->zip_code;
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
                    $sql = "SELECT * FROM ClassifiedCategory WHERE id = $category_id";
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
                        $category_id = "NULL";
                    }
                }
            }
        }

        if (is_array($fulltextsearch_keyword)) {
            $fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
            $sql = "UPDATE Classified SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
            $result = $dbObj->query($sql);
        }

        if (is_array($fulltextsearch_where)) {
            $fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
            $sql = "UPDATE Classified SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
            $result = $dbObj->query($sql);
        }

        $this->synchronize();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->getGalleries();
     * <br /><br />
     *        //Using this in Classified() class.
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
        $sql = "SELECT * FROM Gallery_Item WHERE item_type='classified' AND item_id = $this->id ORDER BY gallery_id";
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
     *        $classifiedObj->setGalleries($gallery);
     * <br /><br />
     *        //Using this in Classified() class.
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
        $sql = "DELETE FROM Gallery_Item WHERE item_type='classified' AND item_id = $this->id";
        $dbObj->query($sql);
        if ($gallery) {
            $sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'classified')";
            $rs3 = $dbObj->query($sql);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->hasDetail();
     * <br /><br />
     *        //Using this in Classified() class.
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
        $classifiedLevel = new ClassifiedLevel();
        $detail = $classifiedLevel->getDetail($this->level);
        unset($classifiedLevel);

        return $detail;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->setNumberViews($id);
     * <br /><br />
     *        //Using this in Classified() class.
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

        $sql = "UPDATE Classified SET number_views = " . $this->number_views . " + 1 WHERE Classified.id = " . $id;
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("classified.synchronization")->addViewUpdate($id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $classifiedObj->deletePerAccount($account_id);
     * <br /><br />
     *        //Using this in Classified() class.
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
            $sql = "SELECT * FROM Classified WHERE account_id = $account_id";
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
     *        $classifiedObj->getClassifiedByFriendlyURL($friendly_url);
     * <br /><br />
     *        //Using this in Classified() class.
     *        $this->getClassifiedByFriendlyURL($friendly_url);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getClassifiedByFriendlyURL
     * @param string $friendly_url
     * @access Public
     */
    function getClassifiedByFriendlyURL($friendly_url)
    {
        $dbObj = db_getDBObject();
        $sql = "SELECT * FROM Classified WHERE friendly_url = '" . $friendly_url . "'";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result)) {
            $this->makeFromRow(mysql_fetch_assoc($result));

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Listing $listing
     * @return array
     * @throws Exception
     */
    public static function getClassifiedByListing(Listing $listing)
    {
        if ($listing->id === 0) {
            throw new \Exception('You must pass a valid listing');
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $where = 'listing_id = '.$listing->id;

        /* the limit in SQL is linked with the limit of the plugin used, improve it */
        $sql = "SELECT id, listing_id, title from Classified WHERE {$where} LIMIT 1000";
        $result = $dbObj->query($sql);

        $array = [];
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $array[] = $row;
            }
        }

        return $array;
    }

    /**
     * @param int $accountId
     * @return array return Classified[]
     *
     * return Classified[]
     * @throws Exception
     */
    public static function getClassifiedsByUser($accountId)
    {
        if ((int)$accountId === 0) {
            throw new \Exception('You must pass an account.');
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $where = "account_id = {$accountId}";

        /* the limit in SQL is linked with the limit of the plugin used, improve it */
        $sql = "SELECT id, listing_id, title from Classified WHERE {$where} LIMIT 1000";
        $result = $dbObj->query($sql);

        $array = [];
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $array[] = $row;
            }
        }

        return $array;
    }

    /**
     * Get classifieds that does not have an account and that which has account_id of listing
     * @param Listing $listing
     * @return array
     */
    public static function getClassifiedsBySitemgrRulesUsingListing(Listing $listing)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        // without account
        $where = '(account_id = 0 OR account_id IS NULL)';
        if ((int)$listing->account_id > 0) {
            // with account
            $where .= ' OR account_id = '.$listing->account_id;
        }

        /* the limit in SQL is linked with the limit of the plugin used, improve it */
        $sql = "SELECT id, listing_id, title from Classified WHERE {$where} LIMIT 1000";
        $result = $dbObj->query($sql);

        $array = [];
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $array[] = $row;
            }
        }

        return $array;
    }

    /**
     * @param Classified $classified
     * @param Listing $listing
     * @return bool
     * @throws Exception
     */
    public function setListingAssociation(Classified $classified, Listing $listing)
    {
        if ($classified->id === 0) {
            throw new \Exception('You must pass a valid classified');
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        /* validates relationship */
        if (sess_isSitemgrLogged()) {
            if (!($classified->account_id == 0 || $classified->account_id == $listing->account_id)) {
                throw new \Exception(
                    system_showText(
                        LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_SITEMGR_ACCOUNT_DIFFER
                    ), 1);
            }
        } else {
            if (!($classified->account_id == $listing->account_id)) {
                throw new \Exception(
                    system_showText(
                        LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_USER_ACCOUNT_DIFFER
                    ), 2);
            }
        }

        try {
            // make the association
            $sql = "UPDATE Classified SET listing_id = {$listing->id} WHERE id = {$classified->id}";
            $dbObj->query($sql);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function cleanListingAssociation(Listing $listing)
    {
        if ($listing->id === 0) {
            throw new \Exception('You must pass a valid listing');
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        try {
            // make the association
            $sql = "UPDATE Classified SET listing_id = NULL WHERE listing_id = {$listing->id}";
            $dbObj->query($sql);

            return true;
        } catch (Exception $e) {
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
                $symfonyContainer->get("classified.synchronization")->addUpsert($this->id);
            } else {
                $symfonyContainer->get("classified.synchronization")->addDelete($this->id);
            }
        }
    }
}
