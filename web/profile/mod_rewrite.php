<?php

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
    # * FILE: /profile/mod_rewrite.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------

    $id = sess_getAccountIdFromSession();

    extract($_GET);
    $dbObj = db_getDBObject(DEFAULT_DB, true);

    if ($_GET["url_full"]) {
        $url = str_replace(EDIRECTORY_FOLDER."/".SOCIALNETWORK_FEATURE_NAME."/", "", $_GET["url_full"]);
        $parts = explode("/", $url);

        $friendlyUrl = str_replace(".html", "", $parts[0]);
        $friendlyUrl = str_replace(".htm", "", $friendlyUrl);

        $slash = string_substr($_GET["url_full"], -1);
        if ($slash != "/") {
            Header( "HTTP/1.1 301 Moved Permanently" );
            Header( "Location: ".SOCIALNETWORK_URL."/".$friendlyUrl."/");
            exit;
        }

    }

    if ((!is_numeric($id) || $id == 0) && (!$friendlyUrl)) {
        header("Location: ".SOCIALNETWORK_URL."/login.php");
        exit;
    }

    if (!$friendlyUrl && sess_getAccountIdFromSession() && $id == sess_getAccountIdFromSession()) {
        $sql = " SELECT id FROM Account
                     WHERE id = $id
                     AND has_profile = 'y'";
        $result = $dbObj->query($sql);
        $row = mysql_fetch_assoc($result);
        if (!$row) {
            header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
            exit;
        }
    }

    if ($id && !$friendlyUrl) {
        $dbObj = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT * FROM Account WHERE id = ".$id."
                    AND has_profile = 'y'";
        $result = $dbObj->query($sql);
        $row = mysql_fetch_assoc($result);
        if (!$row) {
            front_errorPage();
        }
    } else if ($friendlyUrl) {
        $dbObj = db_getDBObject(DEFAULT_DB, true);
        $sql = " SELECT A.* FROM Account A
                     LEFT JOIN Profile P ON (A.id = P.account_id)
                     WHERE P.friendly_url = '".$friendlyUrl."'
                     AND A.has_profile = 'y'";
        $result = $dbObj->query($sql);
        $row = mysql_fetch_assoc($result);
        if (!$row) {
            front_errorPage();
        } else {
            $_GET["id"] = $row["id"];
            extract($_GET);
        }
    }