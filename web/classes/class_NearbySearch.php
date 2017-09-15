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
# * FILE: /classes/class_NearbySearch.php
# ----------------------------------------------------------------------------------------------------

class NearbySearch extends Handle
{
    var $id;
    var $token;
    var $radius;
    var $latitude;
    var $longitude;

    function NearbySearch($var = "", $domain_id = false)
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
            $sql = "SELECT * FROM NearbySearch WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));

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
        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->token = ($row["token"]) ? $row["token"] : ($this->token ? $this->token : "");
        $this->radius = ($row["radius"]) ? $row["radius"] : 'NULL';
        $this->latitude = ($row["latitude"]) ? $row["latitude"] : 'NULL';
        $this->longitude = ($row["longitude"]) ? $row["longitude"] : 'NULL';

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $nearbySearchObj->Save();
     * <br /><br />
     *        //Using this in Listing() class.
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
        if ($this->id) {
            $sql = "UPDATE NearbySearch SET"
                . " token         = $this->token,"
                . " radius           = $this->radius,"
                . " latitude           = $this->latitude,"
                . " longitude           = $this->longitude"
                . " WHERE id           = $this->id";

            $dbObj->query($sql);
        } else {
            $sql = "INSERT INTO NearbySearch"
                . " (token,"
                . " radius,"
                . " latitude,"
                . " longitude,"
                . " VALUES"
                . " ($this->token,"
                . " $this->radius,"
                . " $this->latitude,"
                . " $this->longitude)";

            $dbObj->query($sql);

            $this->id = mysql_insert_id($dbObj->link_id);
        }

        $this->prepareToUse();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $nearbySearchObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 11.2.xx
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

        $sql = "DELETE FROM NearbySearch WHERE id = $this->id";
        $dbObj->query($sql);

    }
}
