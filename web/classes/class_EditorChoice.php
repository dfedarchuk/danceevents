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
# * FILE: /classes/class_editorChoice.php
# ----------------------------------------------------------------------------------------------------

class EditorChoice extends Handle
{
    var $id;
    var $available;
    var $name;
    var $image_id;
    var $image;

    /**
     * <code>
     *        $editorChoiceObj = new EditorChoice($var);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name EditorChoice
     * @access Public
     * @param array $var
     */
    function EditorChoice($var = "")
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);
            $sql = "SELECT * FROM Editor_Choice WHERE id = $var";
            $row = mysql_fetch_array($dbObj->query($sql));
            if ($row["image_id"]) {
                $sql = "SELECT * FROM Image WHERE id = {$row["image_id"]}";
                $image = mysql_fetch_array($dbObj->query($sql));
            }
            $this->image = ($image) ? $image : "";
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
        $this->id = ($row["id"]) ? $row["id"] : 0;
        $this->available = ($row["available"]) ? $row["available"] : 0;
        $this->name = ($row["name"]) ? $row["name"] : "";
        $this->image_id = ($row["image_id"]) ? $row["image_id"] : 0;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $editorChoiceObj->Save();
     * <br /><br />
     *        //Using this in EditorChoice() class.
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
        $this->prepareToSave();

        if ($this->id) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }

            unset($dbMain);

            $sql = "UPDATE Editor_Choice SET"
                . " available = $this->available,"
                . " name      = $this->name,"
                . " image_id  = $this->image_id"
                . " WHERE id  = $this->id";
            $dbObj->query($sql);
        } else {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }

            unset($dbMain);

            $sql = "INSERT INTO Editor_Choice"
                . " (available,"
                . " name,"
                . " image_id)"
                . " VALUES"
                . " ($this->available,"
                . " $this->name,"
                . " $this->image_id)";
            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);
        }

        $this->prepareToUse();

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("badge.synchronization")->addUpsert($this->id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $editorChoiceObj->Delete();
     * <br /><br />
     *        //Using this in EditorChoice() class.
     *        $this->Delete();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Delete
     * @access Public
     */
    function Delete()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        $sql = "DELETE FROM Listing_Choice WHERE editor_choice_id = $this->id";
        $dbObj->query($sql);
        $sql = "DELETE FROM Editor_Choice WHERE id = $this->id";
        $dbObj->query($sql);

        $imageObj = new Image($this->image_id);
        $imageObj->Delete();

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("badge.synchronization")->addDelete($this->id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $editorChoiceObj->retrieve($id);
     * <br /><br />
     *        //Using this in EditorChoice() class.
     *        $this->retrieve($id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name retrieve
     * @access Public
     * @param integer $id
     * @return array $data
     */
    function retrieve($id)
    {
        $sql = "SELECT * FROM Editor_Choice WHERE id = {$id}";
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        $result = $dbObj->query($sql);
        $data = mysql_fetch_assoc($result);

        return $data;
    }
}
