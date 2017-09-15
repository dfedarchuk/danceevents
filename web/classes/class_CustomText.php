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
# * FILE: /classes/class_customtext.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *        $customTextObj = new CustomText($var);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 8.0.00
 * @package Classes
 * @name CustomText
 * @method CustomText
 * @method makeFromRow
 * @method Save
 * @method Delete
 * @access Public
 */
class CustomText extends Handle
{
    /**
     * @var varchar
     * @access Private
     */
    var $name;
    /**
     * @var varchar
     * @access Private
     */
    var $value;

    /**
     * <code>
     *        $customTextObj = new CustomText($var);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name CustomText
     * @access Public
     * @param array $var
     */
    function CustomText($var = '')
    {
        if ($var) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }

            unset($dbMain);

            $sql = "SELECT * FROM CustomText WHERE name = " . db_formatString($var);

            $row = mysql_fetch_array($db->query($sql));
            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = [];
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

        $this->name = ($row["name"]) ? $row["name"] : ($this->name ? $this->name : 0);
        $this->value = ($row["value"]) ? $row["value"] : "";

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $customTextObj->Save();
     * <br /><br />
     *        //Using this in CustomText() class.
     *        $this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function Save($update = true)
    {

        $this->prepareToSave();

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        if ($update) {

            $sql = "SELECT * FROM CustomText WHERE name = $this->name";
            $verify = $dbObj->query($sql);

            if (!mysql_numrows($verify)) {

                $sql = "INSERT INTO CustomText"
                    . " (name, "
                    . " value)"
                    . " VALUES"
                    . " ($this->name,"
                    . " $this->value)";

            } else {

                $sql = "UPDATE CustomText SET"
                    . " name  = $this->name,"
                    . " value = $this->value"
                    . " WHERE name = $this->name";

            }

            $dbObj->query($sql);

        } else {

            $sql = "INSERT INTO CustomText"
                . " (name,"
                . " value)"
                . " VALUES"
                . " ($this->name,"
                . " $this->value)";

            $dbObj->query($sql);

        }

        $this->prepareToUse();

    }
}
