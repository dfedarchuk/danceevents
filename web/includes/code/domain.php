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
# * FILE: /includes/code/domain.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------

extract($_POST);

unset($_GET);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (validate_form("domain", $_POST, $message_domain)) {

        $domainObj = new Domain();
        $domainObj->setString("article_feature", $article_feature ? "on" : "off");
        $domainObj->setString("banner_feature", $banner_feature ? "on" : "off");
        $domainObj->setString("classified_feature", $classified_feature ? "on" : "off");
        $domainObj->setString("event_feature", $event_feature ? "on" : "off");
        $domainObj->Save();

        $domain_id = $domainObj->getNumber("id");

        $selected_server = $server;
        $is_valid = true;
    }
}

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
//Check user privileges. If one of them is missing, user can not add a new domain
$deniedOperation = false;

$folderPerm = true;

//if (system_checkPerm(EDIRECTORY_ROOT."/custom") != PERMISSION_CUSTOM_FOLDER) {
if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
    $folderPerm = system_checkPerm(EDIRECTORY_ROOT."/custom");
    $deniedOperation = true;
}


if (ini_get("safe_mode")) {
    $safeMode = true;
    $deniedOperation = true;
} else {
    $safeMode = false;
}

$dbObj = db_getDBObject(DEFAULT_DB, true);

$sqlDomain = "SELECT DISTINCT `database_host`, `database_port`, `database_username`, `database_password`, `database_name` FROM `Domain` WHERE `status` = 'A'";
$resDomain = $dbObj->Query($sqlDomain);

$domainDB = ['information_schema'];
if (mysql_num_rows($resDomain) > 0) {
    unset($servers);

    $_aux_conf = explode(":", _DIRECTORYDB_HOST);
    $_db_host = $_aux_conf[0];
    $_db_port = $_aux_conf[1];

    $domainCheck = new Domain();
    $privileges = $domainCheck->checkUserProvilegies(false);

    $hasPrivilegies = false;
    if (count($privileges["denied"]) <= 0) {
        $servers[] = system_showText(LANG_SITEMGR_DOMAIN_CURRENT_SERVER);
        $hasPrivilegies = true;
    }

    while ($rowDomain = mysql_fetch_assoc($resDomain)) {
        if ($rowDomain["database_host"] != $_db_host || $rowDomain["database_port"] != $_db_port) {

            $host_link = $rowDomain["database_host"];
            $rowDomain["database_port"] ? $host_link .= ":".$rowDomain["database_port"] : "";
            $link = mysql_connect($host_link, $rowDomain["database_username"], $rowDomain["database_password"]);
            $privileges = $domainCheck->checkUserProvilegies($link);

            if (count($privileges["denied"]) <= 0) {
                $servers[] = $rowDomain["database_host"].($rowDomain["database_port"] ? " : ".$rowDomain["database_port"] : "");
                $hasPrivilegies = true;
            }
        }
        $domainDB[] = $rowDomain['database_name'];
    }

    /* Getting the all database */
    $sqlDatabase = "SHOW DATABASES";
    $resDatabase = $dbObj->Query($sqlDatabase);

    $databases = [];
    if (mysql_num_rows($resDatabase)) {
        while ($rowDatabase = mysql_fetch_assoc($resDatabase)) {
            if (!in_array($rowDatabase['Database'], $domainDB) && (!preg_match('/_main$/', $rowDatabase['Database']))) {
                $databases[] = $rowDatabase['Database'];
            }
        }
    }

    if (!$hasPrivilegies) {
        $deniedOperation = true;
    }
}

?>
