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
# * FILE: /conf/loadconfig.inc.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# DEMONSTRATION MODE
# ----------------------------------------------------------------------------------------------------

if (isset($_SERVER["HTTP_HOST"])) {
    if (strpos($_SERVER["HTTP_HOST"], "demodirectory") === false) {
        define("DEMO_MODE", 0);
    } else {
        define("DEMO_MODE", 1);
    }
    if (strpos($_SERVER["HTTP_HOST"], "demodirectory.com") === false) {
        define("DEMO_LIVE_MODE", 0);
    } else {
        define("DEMO_LIVE_MODE", 1);
    }
    if ((strpos($_SERVER["HTTP_HOST"], "arcasolutions.com") === false) && (strpos($_SERVER["HTTP_HOST"],
                "intranet") === false)
    ) {
        define("DEMO_DEV_MODE", 0);
    } else {
        define("DEMO_DEV_MODE", 1);
    }
}

# ----------------------------------------------------------------------------------------------------
# DEFINE EDIRECTORY FOLDER
# ----------------------------------------------------------------------------------------------------
if (!defined("EDIRECTORY_FOLDER")) {
    define("EDIRECTORY_FOLDER", "");
}

# ----------------------------------------------------------------------------------------------------
# TMP FOLDER PATH DEFINITION
# ----------------------------------------------------------------------------------------------------
define("TMP_FOLDER", $_SERVER["DOCUMENT_ROOT"] . EDIRECTORY_FOLDER . "/custom/tmp");


# ----------------------------------------------------------------------------------------------------
# LOGS
# ----------------------------------------------------------------------------------------------------
define("ENABLE_LOG", true);
define("LOG_PATH", $_SERVER["DOCUMENT_ROOT"] . EDIRECTORY_FOLDER . "/custom/log");
define("SHOW_REGISTRATION_LOG", true);
define("ACTIVATION_DEBUG", true);
define("QUERY_LOG_DB", true); // Save log of queries on DB - SQL_Log
define("QUERY_LOG_FILE", true);
define("LOG_SIZE_ROTATE", 1); // Value in MB
define("ENABLE_CRON_LOG", true);
define("CRON_LOG_CLEAR_INTERVAL", 7); //days

# ----------------------------------------------------------------------------------------------------
# DEFINE EDIRECTORY ROOT
# ----------------------------------------------------------------------------------------------------
if (!defined("EDIRECTORY_ROOT")) {
    define("EDIRECTORY_ROOT", $_SERVER["DOCUMENT_ROOT"] . EDIRECTORY_FOLDER);
}

/* Initializes Symfony kernel if not in cron */
    $s = DIRECTORY_SEPARATOR;
    $symfonyCore = EDIRECTORY_ROOT . "{$s}classes{$s}class_SymfonyCore.php";

    if (file_exists($symfonyCore)) {
        require_once $symfonyCore;
        SymfonyCore::initialize();
    } else {
        echo "Unable to initialize framework. Please contact support";
        exit();
    }

# ----------------------------------------------------------------------------------------------------
# PHPINI
# ----------------------------------------------------------------------------------------------------
include("phpini.inc.php");

# ----------------------------------------------------------------------------------------------------
# DIRECTORY ALIAS DEFINITIONS
# ----------------------------------------------------------------------------------------------------
define("MEMBERS_ALIAS", "sponsors");
define("SITEMGR_ALIAS", "sitemgr");

# ----------------------------------------------------------------------------------------------------
# DOMAIN CONSTANT
# ----------------------------------------------------------------------------------------------------
include(EDIRECTORY_ROOT . "/custom/domain/domain.inc.php");

isset($_inCron) or $_inCron = false;
isset($resetDomainSession) or $resetDomainSession = false;

if (!$_inCron) {


    if ($_SERVER["HTTP_HOST"]) {
        session_start();
    }

    if (function_exists('mb_strtoupper')) {
        $host = mb_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
        $host_cookie = str_replace(".", "_", $host);
    } else {
        $host = strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
        $host_cookie = str_replace(".", "_", $host);
    }

    $domainId = isset($_POST["domain_id"]) && (strpos($_SERVER['PHP_SELF'], '/sites/') === false) ? $_POST["domain_id"] : (isset($_GET["domain_id"]) ? $_GET["domain_id"] : null);

    if (!defined("SELECTED_DOMAIN_ID") && ($domainId) ){
        define("SELECTED_DOMAIN_ID", $domainId);
    }

    if ($_SERVER["HTTP_HOST"] && !$domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])]) {
        echo "Domain unavailable! Please contact the administrator.";
        exit;
    } else {
        if (strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)) {
            if (!in_array($_SESSION[$host . "_DOMAIN_ID_SITEMGR"], $domainInfo) || $resetDomainSession) {
                if (!in_array($_COOKIE[$host_cookie . "_DOMAIN_ID_SITEMGR"], $domainInfo) || $resetDomainSession) {
                    $_SESSION[$host . "_DOMAIN_ID_SITEMGR"] = $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])];
                    setcookie($host . "_DOMAIN_ID_SITEMGR", $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])], time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
                } else {
                    $_SESSION[$host . "_DOMAIN_ID_SITEMGR"] = $_COOKIE[$host_cookie . "_DOMAIN_ID_SITEMGR"];
                }
                if (!defined("SELECTED_DOMAIN_ID")){
                    define("SELECTED_DOMAIN_ID", $_SESSION[$host . "_DOMAIN_ID_SITEMGR"]);
                }
            }
        } else {
            if (strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS)) {
                if (!in_array($_SESSION[$host . "_DOMAIN_ID_MEMBERS"], $domainInfo) || $resetDomainSession) {
                    if (!in_array($_COOKIE[$host_cookie . "_DOMAIN_ID_MEMBERS"], $domainInfo) || $resetDomainSession) {
                        $_SESSION[$host . "_DOMAIN_ID_MEMBERS"] = $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])];
                        setcookie($host . "_DOMAIN_ID_MEMBERS", $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])], time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
                    } else {
                        $_SESSION[$host . "_DOMAIN_ID_MEMBERS"] = $_COOKIE[$host_cookie . "_DOMAIN_ID_MEMBERS"];
                    }
                    if (!defined("SELECTED_DOMAIN_ID")) {
                        define("SELECTED_DOMAIN_ID", $_SESSION[$host . "_DOMAIN_ID_MEMBERS"]);
                    }
                    define("URL_DOMAIN_ID", $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])]);

                }
            }
        }
    }

    if ($_SERVER["HTTP_HOST"]) {
        if (strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)) {
            if (!$_SESSION[$host . "_DOMAIN_ID_SITEMGR"] || $resetDomainSession) {
                if (!$_COOKIE[$host_cookie . "_DOMAIN_ID_SITEMGR"] || $resetDomainSession) {
                    $_SESSION[$host . "_DOMAIN_ID_SITEMGR"] = $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])];
                    setcookie($host . "_DOMAIN_ID_SITEMGR", $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])], time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
                } else {
                    $_SESSION[$host . "_DOMAIN_ID_SITEMGR"] = $_COOKIE[$host_cookie . "_DOMAIN_ID_SITEMGR"];
                }
            }
            if (!defined("SELECTED_DOMAIN_ID")) {
                define("SELECTED_DOMAIN_ID", $_SESSION[$host . "_DOMAIN_ID_SITEMGR"]);
            }
        } else {
            if (strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS)) {
                if (!$_SESSION[$host . "_DOMAIN_ID_MEMBERS"] || $resetDomainSession) {
                    if (!$_COOKIE[$host_cookie . "_DOMAIN_ID_MEMBERS"] || $resetDomainSession) {
                        $_SESSION[$host . "_DOMAIN_ID_MEMBERS"] = $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])];
                        setcookie($host . "_DOMAIN_ID_MEMBERS", $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])], time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
                    } else {
                        $_SESSION[$host . "_DOMAIN_ID_MEMBERS"] = $_COOKIE[$host_cookie . "_DOMAIN_ID_MEMBERS"];
                    }
                }
                if (!defined("SELECTED_DOMAIN_ID")) {
                    define("SELECTED_DOMAIN_ID", $_SESSION[$host . "_DOMAIN_ID_MEMBERS"]);
                }
                define("URL_DOMAIN_ID", $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])]);

            } else {
                if (!$_SESSION[$host . "_DOMAIN_ID"] || $_SESSION[$host . "_DOMAIN_ID"] != $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])]) {
                    $_SESSION[$host . "_DOMAIN_ID"] = $domainInfo[str_replace("www.", "", $_SERVER["HTTP_HOST"])];
                }

                if (!defined("SELECTED_DOMAIN_ID")) {
                    define("SELECTED_DOMAIN_ID", $_SESSION[$host . "_DOMAIN_ID"]);
                }
            }
        }
    }

    if (strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)) {
        setcookie("SECTION_SITEMGR", "true", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
        setcookie("SECTION_MEMBERS", "", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
    } else {
        if (strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS)) {
            setcookie("SECTION_MEMBERS", "true", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
            setcookie("SECTION_SITEMGR", "", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
        }
    }

    unset($domainInfo);
}

if (file_exists(EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/timezone.inc.php")) {
    include(EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/timezone.inc.php");
}

# ----------------------------------------------------------------------------------------------------
# INCLUDE GENERAL CONFIG
# ----------------------------------------------------------------------------------------------------
include("config.inc.php");

# ----------------------------------------------------------------------------------------------------
# PREPARE CONSTANT WITH DOMAIN INFORMATION
# ----------------------------------------------------------------------------------------------------
db_ArrayDomainInfo();

# ----------------------------------------------------------------------------------------------------
# PREPARE CONSTANT WITH LANGUAGE INFORMATION
# ----------------------------------------------------------------------------------------------------
language_constants();

# ----------------------------------------------------------------------------------------------------
# PREPARE CONSTANT WITH LEVELS INFORMATION
# ----------------------------------------------------------------------------------------------------
if (!$upgradeScript) {
    system_ListingLevel_Constant();
}
# ----------------------------------------------------------------------------------------------------
# PREPARE CONSTANT WITH SETTING INFORMATION
# ----------------------------------------------------------------------------------------------------
setting_constants();

SymfonyCore::setDomainDB(SELECTED_DOMAIN_ID);
