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
# * FILE: /classes/class_Listing_Category.php
# ----------------------------------------------------------------------------------------------------

class Listing_Category extends Handle
{

    var $id;
    var $listing_id;
    var $category_id;
    var $status;
    var $category_root_id;
    var $category_node_left;
    var $category_node_right;

    /*
     * Dont save this field
     */
    var $total_listings;

    function Listing_Category($var = '')
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
            $sql = "SELECT * FROM Listing_Category WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));
            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }

    function makeFromRow($row = '')
    {
        if ($row['id']) {
            $this->id = $row['id'];
        } else {
            if (!$this->id) {
                $this->id = 0;
            }
        }
        if ($row['listing_id']) {
            $this->listing_id = $row['listing_id'];
        } else {
            if (!$this->listing_id) {
                $this->listing_id = 0;
            }
        }
        if ($row['category_id']) {
            $this->category_id = $row['category_id'];
        } else {
            if (!$this->category_id) {
                $this->category_id = "NULL";
            }
        }
        if ($row['status']) {
            $this->status = $row['status'];
        } else {
            if (!$this->status) {
                $this->status = "";
            }
        }
        if ($row['category_root_id']) {
            $this->category_root_id = $row['category_root_id'];
        } else {
            if (!$this->category_root_id) {
                $this->category_root_id = 0;
            }
        }
        if ($row['category_node_left']) {
            $this->category_node_left = $row['category_node_left'];
        } else {
            if (!$this->category_node_left) {
                $this->category_node_left = 0;
            }
        }
        if ($row['category_node_right']) {
            $this->category_node_right = $row['category_node_right'];
        } else {
            if (!$this->category_node_right) {
                $this->category_node_right = 0;
            }
        }
    }

    function Save()
    {
        $this->prepareToSave();

        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        if ($this->id) {
            $sql = "UPDATE Listing_Category SET"
                . " listing_id = $this->listing_id,"
                . " category_id = $this->category_id,"
                . " status = $this->status,"
                . " category_root_id = $this->category_root_id,"
                . " category_node_left = $this->category_node_left,"
                . " category_node_right = $this->category_node_right,"
                . " WHERE id = $this->id";
            $dbObj->query($sql);
        } else {
            $sql = "INSERT INTO Listing_Category"
                . " (listing_id, category_id, status, category_root_id, category_node_left, category_node_right)"
                . " VALUES"
                . " ($this->listing_id, $this->category_id, $this->status, $this->category_root_id, $this->category_node_left, $this->category_node_right)";
            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);
        }

        $this->prepareToUse();

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("listing.synchronization")->addUpsert($this->listing_id);
        }
    }

    function Delete()
    {
        /**
         * Deleting this object
         **/
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);;
        $sql = "DELETE FROM Listing_Category WHERE id = $this->id";
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("listing.synchronization")->addUpsert($this->listing_id);
        }

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("listing.synchronization")->addUpsert($this->listing_id);
        }
    }

    function getListings($category_id)
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);
        $sql = "SELECT DISTINCT listing_id FROM Listing_Category USE INDEX (category_status) WHERE category_id IN (" . $category_id . ") AND status = 'A'";

        $result = $dbObj->query($sql);
        $lines = mysql_num_rows($result);

        /*
         * Total of listings
         */
        $this->total_listings = $lines;
        unset($string_listings);
        if ($lines > 0) {
            $string_listings = "";
            while ($row = mysql_fetch_assoc($result)) {
                $lines--;
                $string_listings .= $row["listing_id"] . ($lines > 0 ? "," : "");
            }
        }

        if ($string_listings) {
            return $string_listings;
        } else {
            return 0;
        }
    }

    function getListingsByCategoryHierarchy($root_id, $left, $right, $letter = false)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "SELECT Listing_Category.listing_id
						FROM Listing_Category Listing_Category
						WHERE Listing_Category.category_root_id = " . $root_id . " AND
							  Listing_Category.category_node_left >= " . $left . " AND
							  Listing_Category.category_node_right <= " . $right . " AND
		  					  Listing_Category.status = 'A'";

        $result = $dbObj->query($sql);
        $lines = mysql_num_rows($result);

        /*
         * Total of listings
         */
        $aux_count_listings = 0;
        $aux_listing_id = 0;

        unset($string_listings);
        if ($lines > 0) {
            $string_listings = "";
            while ($row = mysql_fetch_assoc($result)) {
                $lines--;
                if ($row["listing_id"] != $aux_listing_id) {
                    $string_listings .= $row["listing_id"] . ($lines > 0 ? "," : "");
                    $aux_count_listings++;
                    $aux_listing_id = $row["listing_id"];
                }
            }
            $this->total_listings = $aux_count_listings;
        }

        if (string_substr($string_listings, -1) == ",") {
            $string_listings = string_substr($string_listings, 0, -1);
        }

        if ($letter) {
            if (!$string_listings) {
                $string_listings = "0";
            }
            $sql = "SELECT id FROM Listing WHERE id IN ($string_listings) AND title LIKE " . db_formatString($letter . "%");
            $result = $dbObj->query($sql);
            $count = mysql_num_rows($result);
            $this->total_listings = $count;
        }

        if ($string_listings) {
            return $string_listings;
        } else {
            return 0;
        }

    }

    function getCategoriesByListingID($listing_id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "SELECT ListingCategory.title ,
                           Listing_Category.category_id
                      FROM Listing_Category Listing_Category
                        INNER JOIN ListingCategory ListingCategory ON ListingCategory.id = Listing_Category.category_id
                     WHERE Listing_Category.listing_id =" . $listing_id . " ORDER BY ListingCategory.title";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result)) {
            $i = 0;
            while ($row = mysql_fetch_assoc($result)) {
                $categories_array[$i]["id"] = $row["category_id"];
                $categories_array[$i]["title"] = $row["title"];
                $i++;
            }

            return $categories_array;
        } else {
            return false;
        }


    }

}
