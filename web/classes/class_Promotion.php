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
# * FILE: /classes/class_Promotion.php
# ----------------------------------------------------------------------------------------------------

class Promotion extends Handle
{

    var $id;
    var $account_id;
    var $image_id;
    var $thumb_id;
    var $cover_id;
    var $updated;
    var $entered;
    var $name;
    var $seo_name;
    var $description;
    var $long_description;
    var $seo_description;
    var $keywords;
    var $seo_keywords;
    var $start_date;
    var $end_date;
    var $conditions;
    var $number_views;
    var $data_in_array;
    var $visibility_start;
    var $visibility_end;
    var $realvalue;
    var $dealvalue;
    var $deal_type;
    var $amount;
    var $friendly_url;
    var $listing_id;
    var $listing_status;
    var $listing_level;
    var $listing_location_1;
    var $listing_location_2;
    var $listing_location_3;
    var $listing_location_4;
    var $listing_location_5;
    var $listing_address;
    var $listing_address2;
    var $listing_zipcode;
    var $listing_latitude;
    var $listing_longitude;

    /**
     * <code>
     *        $promotionObj = new Promotion($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Promotion
     * @access Public
     * @param integer $var
     */
    function Promotion($var = '', $domain_id = false)
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id) {
                $db = db_getDBObjectByDomainID($domain_id, $dbMain);
            } else {
                if (defined("SELECTED_DOMAIN_ID")) {
                    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $db = db_getDBObject();
                }
            }
            unset($dbMain);
            $sql = "SELECT * FROM Promotion WHERE id = $var";
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

        if ($row["id"]) {
            $this->id = $row["id"];
        } else {
            if (!$this->id) {
                $this->id = 0;
            }
        }

        $this->account_id = ($row["account_id"]) ? $row["account_id"] : 0;

        if ($row["image_id"]) {
            $this->image_id = $row["image_id"];
        } else {
            if (!$this->image_id) {
                $this->image_id = 'NULL';
            }
        }
        if ($row["thumb_id"]) {
            $this->thumb_id = $row["thumb_id"];
        } else {
            if (!$this->thumb_id) {
                $this->thumb_id = 'NULL';
            }
        }
        if ($row["cover_id"]) {
            $this->cover_id = $row["cover_id"];
        } else {
            if (!$this->cover_id) {
                $this->cover_id = 'NULL';
            }
        }
        if ($row["updated"]) {
            $this->updated = $row["updated"];
        } else {
            if (!$this->updated) {
                $this->updated = 0;
            }
        }
        if ($row["entered"]) {
            $this->entered = $row["entered"];
        } else {
            if (!$this->entered) {
                $this->entered = 0;
            }
        }

        $this->name = ($row["name"]) ? $row["name"] : ($this->name ? $this->name : "");
        $this->seo_name = ($row["seo_name"]) ? $row["seo_name"] : ($this->seo_name ? $this->seo_name : "");
        $this->description = $row["description"];
        $this->long_description = $row["long_description"];
        $this->seo_description = ($row["seo_description"]) ? $row["seo_description"] : ($this->seo_description ? $this->seo_description : "");
        $this->keywords = $row["keywords"];
        $this->seo_keywords = ($row["seo_keywords"]) ? $row["seo_keywords"] : ($this->seo_keywords ? $this->seo_keywords : "");
        $this->conditions = $row["conditions"];
        $this->number_views = ($row["number_views"]) ? $row["number_views"] : ($this->number_views ? $this->number_views : 0);

        $this->setDate("start_date", $row["start_date"]);
        $this->setDate("end_date", $row["end_date"]);

        $this->visibility_start = ($row["visibility_start"]) ? $row["visibility_start"] : ($this->visibility_start ? $this->visibility_start : 0);
        $this->visibility_end = ($row["visibility_end"]) ? $row["visibility_end"] : ($this->visibility_end ? $this->visibility_end : 0);
        $this->realvalue = ($row["realvalue"]) ? $row["realvalue"] : ($this->realvalue ? $this->realvalue : 0);
        $this->dealvalue = $row["dealvalue"];
        $this->deal_type = ($row["deal_type"]) ? $row["deal_type"] : ($this->deal_type ? $this->deal_type : "monetary value");
        $this->amount = ($row["amount"]) ? $row["amount"] : ($this->amount ? $this->amount : 0);
        $this->friendly_url = ($row["friendly_url"]) ? $row["friendly_url"] : ($this->friendly_url ? $this->friendly_url : "");

        $this->listing_id = ($row["listing_id"]) ? $row["listing_id"] : ($this->listing_id ? $this->listing_id : 'NULL');
        $this->listing_status = ($row["listing_status"]) ? $row["listing_status"] : ($this->listing_status ? $this->listing_status : "");
        $this->listing_level = ($row["listing_level"]) ? $row["listing_level"] : ($this->listing_level ? $this->listing_level : 0);
        $this->listing_location_1 = ($row["listing_location_1"]) ? $row["listing_location_1"] : ($this->listing_location_1 ? $this->listing_location_1 : 0);
        $this->listing_location_2 = ($row["listing_location_2"]) ? $row["listing_location_2"] : ($this->listing_location_2 ? $this->listing_location_2 : 0);
        $this->listing_location_3 = ($row["listing_location_3"]) ? $row["listing_location_3"] : ($this->listing_location_3 ? $this->listing_location_3 : 0);
        $this->listing_location_4 = ($row["listing_location_4"]) ? $row["listing_location_4"] : ($this->listing_location_4 ? $this->listing_location_4 : 0);
        $this->listing_location_5 = ($row["listing_location_5"]) ? $row["listing_location_5"] : ($this->listing_location_5 ? $this->listing_location_5 : 0);
        $this->listing_address = ($row["listing_address"]) ? $row["listing_address"] : ($this->listing_address ? $this->listing_address : "");
        $this->listing_address2 = ($row["listing_address2"]) ? $row["listing_address2"] : ($this->listing_address2 ? $this->listing_address2 : "");
        $this->listing_zipcode = ($row["listing_zipcode"]) ? $row["listing_zipcode"] : ($this->listing_zipcode ? $this->listing_zipcode : "");
        $this->listing_latitude = ($row["listing_latitude"]) ? $row["listing_latitude"] : ($this->listing_latitude ? $this->listing_latitude : "");
        $this->listing_longitude = ($row["listing_longitude"]) ? $row["listing_longitude"] : ($this->listing_longitude ? $this->listing_longitude : "");

        $this->data_in_array = $row;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->Save();
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function Save($updateTimeline = true)
    {

        $this->prepareToSave();

        $aux_old_account = str_replace("'", "", $this->old_account_id);
        $aux_account = str_replace("'", "", $this->account_id);

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

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
            $sql = "UPDATE Promotion SET"
                . " account_id = $this->account_id,"
                . " image_id = $this->image_id,"
                . " thumb_id = $this->thumb_id,"
                . " cover_id = $this->cover_id,"
                . " updated = NOW(),"
                . " name = $this->name,"
                . " seo_name = $this->seo_name,"
                . " description = $this->description,"
                . " long_description = $this->long_description,"
                . " seo_description = $this->seo_description,"
                . " keywords = $this->keywords,"
                . " seo_keywords = $this->seo_keywords,"
                . " conditions = $this->conditions,"
                . " number_views = $this->number_views,"
                . " start_date = $this->start_date,"
                . " end_date = $this->end_date,"
                . " visibility_start = $this->visibility_start,"
                . " visibility_end = $this->visibility_end,"
                . " realvalue = $this->realvalue,"
                . " dealvalue = $this->dealvalue,"
                . " deal_type = $this->deal_type,"
                . " amount = $this->amount,"
                . " friendly_url = $this->friendly_url,"
                . " listing_id = $this->listing_id,"
                . " listing_status = $this->listing_status,"
                . " listing_level = $this->listing_level,"
                . " listing_location1 = $this->listing_location_1,"
                . " listing_location2 = $this->listing_location_2,"
                . " listing_location3 = $this->listing_location_3,"
                . " listing_location4 = $this->listing_location_4,"
                . " listing_location5 = $this->listing_location_5,"
                . " listing_address = $this->listing_address,"
                . " listing_address2 = $this->listing_address2,"
                . " listing_zipcode = $this->listing_zipcode,"
                . " listing_latitude = $this->listing_latitude,"
                . " listing_longitude = $this->listing_longitude"
                . " WHERE id = $this->id";

            $dbObj->query($sql);

            if ($aux_old_account != $aux_account && $aux_account != 0) {
                $accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
                $accDomain->Save();
                $accDomain->saveOnDomain($aux_account, $this);
            }

        } else {
            $sql = "INSERT INTO Promotion (
							account_id,
							image_id,
							thumb_id,
							cover_id,
							updated,
							entered,
							name,
							seo_name,
							description,
							long_description,
							seo_description,
							keywords,
							seo_keywords,
							fulltextsearch_keyword,
							fulltextsearch_where,
							conditions,
							number_views,
							start_date,
							end_date,
							visibility_start,
							visibility_end ,
							realvalue ,
							dealvalue,
							deal_type,
							amount,
							friendly_url,
							listing_id,
							listing_status,
							listing_level,
                            listing_location1,
                            listing_location2,
                            listing_location3,
                            listing_location4,
                            listing_location5,
                            listing_address,
                            listing_address2,
                            listing_zipcode,
                            listing_latitude,
                            listing_longitude

						) VALUES (
							$this->account_id,
							$this->image_id,
							$this->thumb_id,
							$this->cover_id,
							NOW(),
							NOW(),
							$this->name,
							$this->seo_name,
							$this->description,
							$this->long_description,
							$this->seo_description,
							$this->keywords,
							$this->seo_keywords,
							'',
							'',
							$this->conditions,
							$this->number_views,
							$this->start_date,
							$this->end_date,
							$this->visibility_start,
							$this->visibility_end,
							$this->realvalue,
							$this->dealvalue,
							$this->deal_type,
							$this->amount,
							$this->friendly_url,
							$this->listing_id,
							$this->listing_status,
							$this->listing_level,
                            $this->listing_location_1,
                            $this->listing_location_2,
                            $this->listing_location_3,
                            $this->listing_location_4,
                            $this->listing_location_5,
                            $this->listing_address,
                            $this->listing_address2,
                            $this->listing_zipcode,
                            $this->listing_latitude,
                            $this->listing_longitude
						)";
            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);

            if ($aux_account != 0) {
                $accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
                $accDomain->Save();
                $accDomain->saveOnDomain($aux_account, $this);
            }
        }

        if ($updateTimeline && (sess_getAccountIdFromSession() && string_strpos($_SERVER["PHP_SELF"], "deal.php") !== false)) {
            $rowTimeline = array();
            $rowTimeline["item_type"] = "promotion";
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
     *        $promotionObj->Delete();
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
        $sql = "SELECT id FROM Review WHERE item_type = 'promotion' AND item_id = $this->id";
        $result = $dbObj->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $reviewObj = new Review($row["id"]);
            $reviewObj->Delete($domain_id);
        }

        ### REDEEMS
        $sql = "DELETE FROM Promotion_Redeem WHERE promotion_id = $this->id";
        $dbObj->query($sql);

        $sql = "DELETE FROM Promotion WHERE id = $this->id";
        $dbObj->query($sql);

        ### Timeline
        $sql = "DELETE FROM Timeline WHERE item_type = 'promotion' AND item_id = $this->id";
        $dbObj->query($sql);

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

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("deal.synchronization")->addDelete($this->id);
            $symfonyContainer->get("listing.synchronization")->addUpsert($this->id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->updateImage($imageArray);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->updateImage($imageArray);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name updateImage
     * @access Public
     * @param array $imageArray
     */
    function updateImage($imageArray)
    {
        unset($imageObj);
        if ($this->image_id) {
            $imageobj = new Image($this->image_id);
            if ($imageobj) {
                $imageobj->delete();
            }
        }
        $this->image_id = $imageArray["image_id"];
        unset($imageObj);
        if ($this->thumb_id) {
            $imageObj = new Image($this->thumb_id);
            if ($imageObj) {
                $imageObj->delete();
            }
        }
        $this->thumb_id = $imageArray["thumb_id"];
        unset($imageObj);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->setFullTextSearch();
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->setFullTextSearch();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setFullTextSearch
     * @access Public
     */
    function setFullTextSearch($secondDB = false)
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        if ($this->name) {
            $string = str_replace(" || ", " ", $this->name);
            $fulltextsearch_keyword[] = $string;
            $addkeyword = format_addApostWords($string);
            if ($addkeyword != '') {
                $fulltextsearch_keyword[] = $addkeyword;

            }
            unset($addkeyword);
        }

        /*
         * Get Listing title to add on fulltext search of Deals
         */
        if ($this->listing_id) {
            $sql_listing = "SELECT fulltextsearch_keyword FROM Listing WHERE id = " . $this->listing_id;
            $row_listing = mysql_fetch_assoc($dbObj->query($sql_listing));
            if ($row_listing["fulltextsearch_keyword"]) {
                $fulltextsearch_keyword[] = $row_listing["fulltextsearch_keyword"];
            }
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

        if (is_array($fulltextsearch_keyword)) {
            $fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
            $sql = "UPDATE Promotion SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
            $result = $dbObj->query($sql);
        }

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("deal.synchronization")->addUpsert($this->id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->setNumberViews($id);
     * <br /><br />
     *        //Using this in Promotion() class.
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
        $sql = "UPDATE Promotion SET number_views = " . $this->number_views . " + 1 WHERE Promotion.id = " . $id;
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("deal.synchronization")->addViewUpdate($id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->deletePerAccount($account_id);
     * <br /><br />
     *        //Using this in Promotion() class.
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
            $sql = "SELECT * FROM Promotion WHERE account_id = $account_id";
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
     *        $promotionObj->setPromoCode($code, $used);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->setPromoCode($code, $used);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setPromoCode
     * @access Public
     * @param boolean $code
     * @param boolean $used
     */
    function setPromoCode($code = false, $used = false)
    {
        if (!$code) {
            return false;
        }

        $sql = "UPDATE Promotion_Redeem SET used = " . (int)$used . " WHERE redeem_code = " . db_formatString($code);
        $dbObj = db_getDBObject(DEFAULT_DB, true);
        $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);
        $result = $dbDomain->query($sql);

        return true;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->findByFriendlyURL($friendly_url);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->findByFriendlyURL($friendly_url);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name findByFriendlyURL
     * @access Public
     * @param boolean $friendly_url
     */
    function findByFriendlyURL($friendly_url = false)
    {
        if (!$friendly_url) {
            return false;
        }

        $friendly_url = str_replace("htm", '', $friendly_url);
        $friendly_url = str_replace("html", '', $friendly_url);
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT id FROM Promotion WHERE friendly_url = " . db_formatString($friendly_url);

        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        $result = $dbObj->query($sql);
        $row = mysql_fetch_assoc($result);

        return ((int)$row["id"]);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->getDealsFromUser($account_id);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->getDealsFromUser($friendly_url);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getDealsFromUser
     * @access Public
     * @param boolean $account_id
     */
    function getDealsFromUser($account_id = false, $max = false)
    {
        if (!$account_id) {
            return false;
        }
        $sql = "SELECT * FROM Promotion_Redeem WHERE account_id = $account_id ORDER BY datetime DESC " . ($max ? "LIMIT $max" : "");
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $result = $dbDomain->query($sql);
        $res = false;
        while ($row = mysql_fetch_assoc($result)) {
            $res[] = $row;
        }

        return $res;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->getDealInfo($account_id);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->getDealInfo($account_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getDealInfo
     * @access Public
     * @param boolean $account_id
     */
    function getDealInfo($account_id = false)
    {

        if (!$this->id) {
            return false;
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

        $sql = "SELECT account_id FROM Promotion_Redeem WHERE promotion_id = {$this->id}";
        $result = $dbDomain->query($sql);
        $totalSold = (int)mysql_num_rows($result);

        $info["sold"] = $totalSold;
        $info["left"] = $this->amount;
        $info["timeleft"] = explode("-", $this->end_date);

        if ($this->amount == 0) {
            $info["doneByAmount"] = true;
        }

        $end_date_arr = explode("-", $this->end_date);
        if (mktime(24, 59, 59, $end_date_arr[1], $end_date_arr[2], $end_date_arr[0]) <= mktime(date("H"), date("m"),
                date("i"), date("m"), date("d"), date("Y"))
        ) {
            $info["doneByendDate"] = true;
        }

        if ($account_id) {
            $sql = "SELECT * FROM Promotion_Redeem WHERE promotion_id = {$this->id} AND account_id = $account_id";
            $result = $dbDomain->query($sql);
            $row = mysql_fetch_assoc($result);
            $info["account"] = $row;
        }

        return $info;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->alreadyRedeemed($avg, $id);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->alreadyRedeemed($avg, $id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name alreadyRedeemed
     * @access Public
     * @param integer $promotion_id
     */
    function alreadyRedeemed($promotion_id = false, $account_id = false)
    {
        if (!$promotion_id) {
            return false;
        }
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        if ($account_id) {
            $sql = "SELECT redeem_code FROM Promotion_Redeem WHERE promotion_id = {$promotion_id} AND account_id = " . $account_id;
        } else {
            $sql = "SELECT redeem_code FROM Promotion_Redeem WHERE promotion_id = {$promotion_id} AND account_id = " . sess_getAccountIdFromSession();
        }
        $result = $dbDomain->query($sql);
        $row = mysql_fetch_assoc($result);

        return $row["redeem_code"];
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->getTagLine($link);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->getTagLine($link);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getTagLine
     * @access Public
     * @param integer $link
     */
    function getTagLine($link = false)
    {
        if (!$link) {
            $link = DEFAULT_URL . "/" . ALIAS_PROMOTION_MODULE . "/" . $this->getString("friendly_url") . ".html";
        }

        $listingObj = new Listing();
        $listRow = $listingObj->getListingDetail($this->listing_id);
        if ($listRow) {
            $text = " " . system_showText(LANG_FROM) . " " . $listRow["title"] . " " . system_showText(DEAL_AT) . ": " . $link;
        }

        return system_showText(DEAL_LIKEDTHIS) . $text;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->cleanup();
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->cleanup();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name cleanup
     * @access Public
     */
    function cleanup()
    {
        if (!$this->id) {
            return false;
        }
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $this->listing_id = 'NULL';
        $this->setFullTextSearch();

        $sql = "UPDATE Promotion
                SET    fulltextsearch_where = '',
                       listing_id           = NULL,
                       listing_status       = '',
                       listing_level        = 0,
                       listing_location1    = NULL,
                       listing_location2    = NULL,
                       listing_location3    = NULL,
                       listing_location4    = NULL,
                       listing_location5    = NULL,
                       listing_address      = '',
                       listing_address2     = '',
                       listing_zipcode      = '',
                       listing_latitude     = '',
                       listing_longitude    = ''
                WHERE id = {$this->id}";

        if ($dbObj->query($sql)) {

            if ($symfonyContainer = SymfonyCore::getContainer()) {
                $symfonyContainer->get("deal.synchronization")->addUpsert($this->id);
                $symfonyContainer->get("listing.synchronization")->addUpsert($this->id);
            }

            return true;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->autoSetListing($acc_id);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->autoSetListing($acc_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name autoSetListing
     * @access Public
     * @param integer $acc_id
     */
    function autoSetListing($acc_id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $listingLevel = new ListingLevel();
        $levels = $listingLevel->getValues();
        $str_levels = "";

        foreach ($levels as $level) {
            if ($listingLevel->getDeals($level) > 0) {
                $str_levels .= $level . ",";
            }
        }

        $str_levels = string_substr($str_levels, 0, -1);

        $sql = "SELECT id FROM Listing WHERE account_id = " . $acc_id . " AND level IN ($str_levels)";
        $result = $dbObj->query($sql);

        $sql = "SELECT id FROM Promotion WHERE account_id = " . $acc_id;
        $result2 = $dbObj->query($sql);

        if (mysql_num_rows($result) == 1 && mysql_num_rows($result2) == 1) {
            $row = mysql_fetch_assoc($result);
            $listingObj = new Listing($row["id"]);
            //$listingObj->setNumber("promotion_id", $this->id);
            $listingObj->save();
        }
    }


    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->getPromotionByFriendlyURL($friendly_url);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->getPromotionByFriendlyURL($friendly_url);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getPromotionByFriendlyURL
     * @param string $friendly_url
     * @access Public
     */
    function getPromotionByFriendlyURL($friendly_url)
    {
        $dbObj = db_getDBObject();
        $sql = "SELECT * FROM Promotion WHERE friendly_url = '" . $friendly_url . "'";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result)) {
            $this->makeFromRow(mysql_fetch_assoc($result));

            return true;
        } else {
            return false;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->setListingId($listingObj);
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->setListingId($listingObj);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setListingId
     * @access Public
     * @param Listing $listingObj
     */
    function setListingId($listingObj)
    {

        if (($listingObj->id > 0) && ($this->id > 0)) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);

            $sql_listing = "SELECT fulltextsearch_where FROM Listing WHERE id = " . $this->listing_id;
            $row_listing = mysql_fetch_assoc($dbObj->query($sql_listing));
            if ($row_listing["fulltextsearch_where"]) {
                $sql = "UPDATE Promotion SET fulltextsearch_where = " . db_formatString($row_listing["fulltextsearch_where"]) . " WHERE id = " . $this->id;
                $dbObj->query($sql);
            }

            /**
             * Get information of listing to save on Deal
             */
            $this->account_id = $listingObj->account_id;
            $this->listing_address = $listingObj->address;
            $this->listing_address2 = $listingObj->address2;
            $this->listing_id = $listingObj->id;
            $this->listing_latitude = $listingObj->latitude;
            $this->listing_longitude = $listingObj->longitude;
            $this->listing_level = $listingObj->level;
            $this->listing_location_1 = $listingObj->location_1;
            $this->listing_location_2 = $listingObj->location_2;
            $this->listing_location_3 = $listingObj->location_3;
            $this->listing_location_4 = $listingObj->location_4;
            $this->listing_location_5 = $listingObj->location_5;
            $this->listing_status = $listingObj->status;
            $this->listing_zipcode = $listingObj->zip_code;
            $this->Save(false);
        }
    }

    function setListingNull(){
        $this->listing_address = "";
        $this->listing_address2 = "";
        $this->listing_id = 'NULL';
        $this->listing_latitude = "";
        $this->listing_longitude = "";
        $this->listing_level = 0;
        $this->listing_location_1 = 'NULL';
        $this->listing_location_2 = 'NULL';
        $this->listing_location_3 = 'NULL';
        $this->listing_location_4 = 'NULL';
        $this->listing_location_5 = 'NULL';
        $this->listing_status = "";
        $this->listing_zipcode = "";
    }


    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $promotionObj->unLinkListingID();
     * <br /><br />
     *        //Using this in Promotion() class.
     *        $this->unLinkListingID();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name unLinkListingID
     * @access Public
     */
    function unLinkListingID()
    {

        $this->setListingNull();

        $this->Save();
    }

    //used only on old api3
    function getDealByListing($listing_id)
    {

        $db = db_getDBObject();

        /**
         * Get deal using listing_id
         */
        $sql = "SELECT * FROM Promotion WHERE listing_id = " . $listing_id . " LIMIT 1";
        $result = $db->query($sql);
        $total_result = mysql_num_rows($result);
        if ($total_result > 0) {
            unset($array_info);
            $row = mysql_fetch_assoc($result);
            $this->makeFromRow($row);

            $array_info["deal_data"] = $this->data_in_array;
            $array_info["deal_info"] = $this->getDealInfo();

            if (is_array($array_info)) {
                return $array_info;
            } else {
                return false;
            }
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
            if($this->listing_id and $this->listing_status == 'A'){
                $symfonyContainer->get("deal.synchronization")->addUpsert($this->id);
            } else {
                $symfonyContainer->get("deal.synchronization")->addDelete($this->id);
            }
        }
    }

    function getPromotionInfo($promotion_ids = null)
    {
        $promotions = [];
        if ($promotion_ids) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);

            $sql = "SELECT id, name FROM Promotion WHERE id IN (" . $promotion_ids . ")";
            $result = $dbObj->query($sql);
            while ($row = mysql_fetch_assoc($result)) {
                $promotions[] = $row;
            }
        }
        return $promotions;
    }

    function getDealById($deal_id){

        $db = db_getDBObject();

        /**
         * Get deal using listing_id
         */
        $sql = "select * from Promotion where id = ".$deal_id;
        $result = $db->query($sql);
        $total_result = mysql_num_rows($result);
        if($total_result > 0){
            unset($array_info);
            $row = mysql_fetch_assoc($result);
            $this->makeFromRow($row);

            $array_info["deal_data"] = $this->data_in_array;
            $array_info["deal_info"] = $this->getDealInfo();

            if(is_array($array_info)){
                return $array_info;
            }else{
                return false;
            }
        }else{
            return false;
        }


    }

    function getMultipleDealByListing($listing_id){

        $results = false;
        $db = db_getDBObject();

        /**
         * Get deal using listing_id
         */
        $sql = "SELECT * FROM Promotion WHERE listing_id = ".$listing_id."";
        $result = $db->query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            $results[] = $row;
        }

        return $results;

    }

    function updateListingPromotionEntry($promotion_id, $listing_id)
    {

        if (!$listing_id && !$promotion_id) {
            return false;
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        //Fetch Listing Details
        $listingObj = new Listing();
        $listRow = $listingObj->getListingDetail($listing_id);


        $friendly_url_combination = $this->getFriendlyURLCombination($listing_id, $promotion_id);
        $seo_name = $this->getSEOname($listing_id, $promotion_id);

        if (!isset($promotionKeywordsNewString)) {
            $promotionKeywordsNewString = '';
        }

        if (!$listRow['account_id']) {
            $listRow['account_id'] = 'NULL';
        }

        //Update Promotion entry
        $sql = "UPDATE Promotion SET
                        fulltextsearch_where     = '{$listRow['fulltextsearch_where']}',
                        account_id                 = {$listRow['account_id']},
                        listing_id                 = {$listing_id},
                        seo_name                = '$seo_name',
                        listing_status             = '{$listRow['status']}',
                        listing_level             = '{$listRow['level']}',
                        listing_location1         = NULL,
                        listing_location2         = NULL,
                        listing_location3         = NULL,
                        listing_location4         = NULL,
                        listing_location5         = NULL,
                        listing_address         = '{$listRow['address']}',
                        listing_address2         = '{$listRow['address2']}',
                        listing_zipcode         = '{$listRow['zip_code']}',
                        listing_latitude         = '{$listRow['latitude']}',
                        listing_longitude         = '{$listRow['longitude']}',
                        keywords                  = '$promotionKeywordsNewString',
                        seo_keywords              = '" . str_replace(' || ', ', ', $promotionKeywordsNewString) . "'
                   WHERE id = " . $promotion_id;

        $dbObj->query($sql);

        if (!$this->id) {
            $this->id = $promotion_id;
        }

        //Entity fix
        $this->listing_id = $listing_id;
        $this->listing_status = $listRow['status'];

        $this->synchronize();
    }

    function getFriendlyURLCombination($listing_id = 0, $deal_id = false){

        unset($nextId);
        if($listing_id){
            $list_name = "";
            $list_name = $this->getListingName($listing_id);
            $list_name = trim($list_name);
            $list_name = str_replace("'","",$list_name);
            $list_name = str_replace("  ","-",$list_name);
            $list_name = str_replace(" ","-",$list_name);
        }
        $deal_name = "";
        $deal_name = $this->name;
        $deal_name = trim($deal_name);
        $deal_name = str_replace("'","",$deal_name);
        $deal_name = str_replace("  ","-",$deal_name);
        $deal_name = str_replace(" ","-",$deal_name);

        if($list_name){
            $friendly_url = $list_name . "-" . $deal_name;
        }else{
            $friendly_url = $deal_name;
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        $sql = "SELECT * FROM Promotion WHERE friendly_url = '" . strtolower($friendly_url) . "'";
        if($deal_id){
            $sql .= ' AND id != ' . $deal_id;
        }


        $result = $dbObj->query($sql);

        if(mysql_num_rows($result) >= 1){

            $sql = "SHOW TABLE STATUS LIKE 'Promotion'";
            $result = $dbObj->query($sql);
            $row = mysql_fetch_array($result);
            $nextId = $row['Auto_increment'];

            if($deal_id){
                return strtolower($friendly_url) . "-" . trim($this->id,"'");
            } else {
                return strtolower($friendly_url) . "-" . $nextId;
            }
        } else {
            return strtolower($friendly_url);
        }
    }

    function getListingName($listing_id = 0){
        if (!$listing_id) $listing_id = $this->listing_id;

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        //$aux_deal_info = array();
        $sql = "SELECT title FROM Listing WHERE id = ".$listing_id;
        $result = $dbObj->query($sql);
        $listing_name = "";
        while($row = mysql_fetch_row($result)){
            $listing_name = $row[0];
        }
        if ($listing_name) {
            return $listing_name;
        }
        else return false;
    }

    function getSEOname($listing_id = 0, $deal_id = false){

        if($listing_id){
            $list_name = $this->getListingName($listing_id);
            $list_name = trim($list_name,"'");
        }
        $deal_name = $this->name;
        $deal_name = trim($deal_name,"'");

        $seo_name = $deal_name;
        if($list_name){
            $seo_name = $list_name . " | " . $deal_name;
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        $sql = "SELECT * FROM Promotion WHERE seo_name = '" . ($seo_name) . "'";
        if($deal_id){
            $sql .= ' AND id != ' . $deal_id;
        }

        $result = $dbObj->query($sql);
        if(mysql_num_rows($result) >= 1){
            $sql = "SHOW TABLE STATUS LIKE 'Promotion'";
            $result = $dbObj->query($sql);
            $row = mysql_fetch_array($result);
            $nextId = $row['Auto_increment'];

            if($deal_id){
                return $seo_name . " | " . trim($this->id,"'");
            } else {
                return $seo_name . " | " . $nextId;
            }
        }

        return $seo_name;
    }

    function getPromotionsOfListing($listing_id){
        $sql = "SELECT id, `name` FROM Promotion WHERE listing_id = ".$listing_id;
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        $result = $dbObj->query($sql);
        return $result;
    }

    function unLinkPromotionListing($deals_id = null, $listing_id){
        $dbObj = db_getDBObject();

        $sql = "UPDATE Promotion SET    fulltextsearch_where = '',
                                            listing_id = NULL,
                                            listing_status = '',
                                            listing_level = 0,
                                            listing_location1 = NULL,
                                            listing_location2 = NULL,
                                            listing_location3 = NULL,
                                            listing_location4 = NULL,
                                            listing_location5 = NULL,
                                            listing_address = '',
                                            listing_address2 = '',
                                            listing_zipcode = '',
                                            listing_latitude = '',
                                            listing_longitude = ''";

        $whereSegment = " WHERE listing_id = ".(int)$listing_id;

        if($deals_id){
            if (is_array($deals_id)) {
                $deals_id = implode(",", $deals_id);
            }
            $whereSegment = " WHERE id NOT IN (".$deals_id.") AND listing_id =".(int)$listing_id;
        }
        $sql .= $whereSegment;

        //prepare for synchronize the Ids of the promotions that are being unlinked
        $sqlGetPromotionsIdToBeUnliked = "SELECT id FROM Promotion " . $whereSegment;
        $result = $dbObj->query($sqlGetPromotionsIdToBeUnliked);

        $dbObj->query($sql);

        //synchronizing Promotions that were unlinked to the listing
        if ($symfonyContainer = SymfonyCore::getContainer()) {
            while ($row = mysql_fetch_assoc($result)) {
                $symfonyContainer->get("deal.synchronization")->addDelete($row);
            }
        }
    }

    function getAllDealsAvailable($account_id = null, $section = null){
        $accountId   = (int) $account_id;

        $dbMain = db_getDBObject( DEFAULT_DB, true );
        $dbObj  = db_getDBObjectByDomainID( SELECTED_DOMAIN_ID, $dbMain );



        $orSegment = '';
        if ($section == 'sitemgr'){
            //to get deals that has no account linked, only for sitemgr
            $orSegment = " OR (ISNULL(account_id) OR account_id = 0)";
        }
        //get deals
        $sql = "SELECT id, name
                    FROM Promotion
                    WHERE (
                        (ISNULL(listing_id) OR listing_id = 0) AND
                        (account_id = {$accountId} ". $orSegment ." )
                        )
                    ORDER BY name";

        $result = $dbObj->query( $sql );

        return $result;
    }
}
