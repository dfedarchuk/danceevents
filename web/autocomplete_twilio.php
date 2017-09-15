<?

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
    # * FILE: /autocomplete_twilio.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------

    if ($_GET["domain_id"]) {
        define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
    } else {
        define("SELECTED_DOMAIN_ID", $_POST["domain_id"]);
    }

    include("./conf/loadconfig.inc.php");

    header("Content-Type: ".($_GET["sitemgr"] ? "application/json;" : "text/html;")." charset=".EDIR_CHARSET, TRUE);
  
    # ----------------------------------------------------------------------------------------------------
    # INPUT VERIFICATION
    # ----------------------------------------------------------------------------------------------------
    $limit = $_GET['limit'] ? db_formatNumber($_GET['limit']) : AUTOCOMPLETE_MAXITENS;
    $accId = $_GET['account_id'] ? db_formatNumber($_GET['account_id']) : 0;
    $input    = string_strtolower(trim($_GET[($_GET["sitemgr"] ? "term" : "q")]));
    $whereStr = db_formatString('%'.$input.'%');
   
    # ----------------------------------------------------------------------------------------------------
    # AUTO COMPLETE
    # ----------------------------------------------------------------------------------------------------
    if ($input) {
        
        $rows = array();
        $dbObj_main = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj_main);
        
        //numbers
        $sql = "SELECT id, title, clicktocall_number FROM Listing WHERE ( clicktocall_number LIKE $whereStr ) AND account_id = $accId LIMIT $limit";
        $_rows = $dbObj->unbuffered_query($sql);
        while ($row = mysql_fetch_array($_rows)){
            if ($row['clicktocall_number']){
                $rows[] = $row;
            }
        }
        
        $aResults = array();
        $auxResults = array();
        $countJson = 0;
        $resultsJson = array();
        foreach ($rows as $row) {
            unset($auxListing);
            $auxListing = $row["clicktocall_number"]." - ".system_showText(LANG_LABEL_ACTIVATED_BY)." \"".$row["title"]."\"";
            if (!in_array($row["clicktocall_number"], $auxResults)) {
                $aResults[] = ($auxListing."|".$row["clicktocall_number"]);
                $auxResults[] = $row["clicktocall_number"];
                $resultsJson[$countJson]["label"] = $auxListing;
                $resultsJson[$countJson]["value"] = $row["clicktocall_number"];
                $countJson++;
            }
        }
        
        if ($_GET["sitemgr"]) {
            echo json_encode($resultsJson);
        } else {
            echo implode("\n", $aResults);	
        }
        	
	}