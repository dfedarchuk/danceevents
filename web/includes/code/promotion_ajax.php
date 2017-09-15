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
    # * FILE: /includes/code/promotion_ajax.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    if ($_POST["request"] == "ajax" || $_GET["domain_id"]) {
        if ($_GET["domain_id"]) {
            define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
        } else {
            define("SELECTED_DOMAIN_ID", $_POST["domain_id"]);
        }
        include("../../conf/loadconfig.inc.php");
    }
    
    header("Content-Type: ".($_GET["sitemgr"] ? "application/json;" : "text/html;")." charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    if ($_GET[($_GET["sitemgr"] ? "term" : "q")]) {
        $sqlPromotions = "SELECT `id`, 
                                `name`
                            FROM `Promotion` 
                            WHERE (
                                    `listing_id` = 0
                                    AND `account_id` = ".$_GET["account_id"]."
                                    AND name LIKE ".db_formatString("%".$_GET[($_GET["sitemgr"] ? "term" : "q")]."%")."
                                    AND end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')
                                  )
                        ORDER BY `name`";

        $resPromotions = $dbObj->query($sqlPromotions);
        $countJson = 0;
        $resultsJson = array();
        if (mysql_num_rows($resPromotions)) {

            while ($rowPromotions = mysql_fetch_assoc($resPromotions)) {
                if ($_GET["sitemgr"]) {
                    $resultsJson[$countJson]["value"] = $rowPromotions["name"];
                    $resultsJson[$countJson]["auxID"] = $rowPromotions["id"];
                    $countJson++;
                } else {
                    echo $rowPromotions["name"]."|".$rowPromotions["id"]." \n ";
                }
            }
        }
        if ($_GET["sitemgr"]) {
            echo json_encode($resultsJson);
        }
    }
         
?>