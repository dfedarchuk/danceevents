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
    # * FILE: /validateAdvertise.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("./conf/loadconfig.inc.php");

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");

    extract($_POST);

    if ($item_type != "banner") {
        $_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
        $_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
        $_POST["friendly_url"] = trim($_POST["friendly_url"]);
        $_POST["friendly_url"] = system_denyInjections($_POST["friendly_url"]);

        $sqlFriendlyURL = "";
        $sqlFriendlyURL .= "SELECT friendly_url FROM ".ucfirst($item_type)." WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." LIMIT 1";

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObjFriendlyURL = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
        if (mysql_num_rows($resultFriendlyURL) > 0) {
            $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
        }
        if (!$_POST["friendly_url"]) {
            $_POST["friendly_url"] = uniqid();
        }
    }

    if ($item_type == "event") {
        $_POST["start_date"] = system_denyInjections($_POST["start_date"]);
        $start_date = $_POST["start_date"];
        $_POST["end_date"] = system_denyInjections($_POST["end_date"]);
        $end_date = $_POST["end_date"];
    }

    $validate_item = validate_form($item_type, $_POST, $message_item);
    $validate_discount = is_valid_discount_code($_POST["discount_id"], $item_type, $_POST["id"], $message_discount, $discount_error_num);

    if (!$validate_item || !$validate_discount || !$has_payment) {
        $msgError .= $message_item;
        $msgError .= (string_strlen($msgError) ? "<br />" : "").$message_discount;
        if (!$has_payment) {
            $msgError .= (string_strlen($msgError) && $message_discount ? "<br />" : "")."&#149;&nbsp;".system_showText(LANG_MSG_NO_PAYMENT_METHOD_SELECTED);
        }

        echo $msgError;
    } else {
        echo "ok";
    }