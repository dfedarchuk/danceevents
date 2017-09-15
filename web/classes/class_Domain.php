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
# * FILE: /classes/class_Domain.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *        $domainObj = new Domain($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 8.0.00
 * @package Classes
 * @name Domain
 * @access Public
 */
class Domain extends Handle
{

    /**
     * @var integer
     * @access Private
     */
    var $id;
    /**
     * @var integer
     * @access Private
     */
    var $smaccount_id;
    /**
     * @var string
     * @access Private
     */
    var $name;
    /**
     * @var string
     * @access Private
     */
    var $database_host;
    /**
     * @var string
     * @access Private
     */
    var $database_port;
    /**
     * @var string
     * @access Private
     */
    var $database_username;
    /**
     * @var string
     * @access Private
     */
    var $database_password;
    /**
     * @var string
     * @access Private
     */
    var $database_name;
    /**
     * @var string
     * @access Private
     */
    var $url;
    /**
     * A - Active
     * D - Deleted
     * P - Pending
     * When a Domain is deleted the domain status is set to "D"
     * When an error occurs while the domain is created as its status is 'P'
     * @var char
     * @access Private
     */
    var $status;
    /**
     * @var string
     * @access Private
     */
    var $activation_status;
    /**
     * @var date
     * @access Private
     */
    var $created;
    /**
     * When a Domain is deleted this field is set to Current Date
     * @var date
     * @access Private
     */
    var $deleted_date;
    /**
     * @var integer
     * @access Private
     */
    var $percent;
    /**
     * @var boolean
     * @access Private
     */
    var $error;
    /**
     * @var string
     * @access Private
     */
    var $event_feature;
    /**
     * @var string
     * @access Private
     */
    var $banner_feature;
    /**
     * @var string
     * @access Private
     */
    var $classified_feature;
    /**
     * @var string
     * @access Private
     */
    var $article_feature;

    /**
     * @var boolean
     * @access Private
     */
    private $new_db_closed;

    /**
     * @var string
     */
    private $lang = '';

    /**
     * Needed database privileges to create a Domain
     * @var string
     * @access Private
     */
    const NEEDED_PRIVILEGES = "Alter,Create,Create view,Delete,Drop,Index,Insert,Select,Update";
    /**
     * Name of Domain folders
     * @var string
     * @access Private
     */
    const CUSTOM_FOLDERS = "conf,content_files,editor_files,extra_files,image_files,export_files,import_files,lang,location,payment,sitemap,socialnetwork,theme";

    /**
     * <code>
     *        $domainObj = new Domain($id);
     *        //OR
     *        $domainObj = new Domain($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Domain
     * @access Public
     * @param mixed $var
     * @return Domain
     */
    function Domain($var = '')
    {
        $db = db_getDBObject(DEFAULT_DB, true);
        if (is_numeric($var) && ($var)) {

            /*
             * Get information of constants of domain
             */
            unset($row);
            $row = db_getDomainInformation($var);
            if (is_array($row)) {
                $this->makeFromRow($row);
            } else {
                $sql = "SELECT * FROM Domain WHERE id = $var";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            }


        } else {
            if (is_string($var) && ($var)) {
                $sql = "SELECT * FROM Domain WHERE url = '$var' LIMIT 1";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            } else {
                if (!is_array($var)) {
                    $var = [];
                }
                $this->makeFromRow($var);
            }
        }
    }

    /**
     * @param string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * <code>
     *        $this->makeFromRow($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @param array|string $row
     * @access Public
     */
    function makeFromRow($row = '')
    {
        $row["id"] ? $this->id = $row["id"] : $this->id = 0;
        $row["smaccount_id"] ? $this->smaccount_id = $row["smaccount_id"] : $this->smaccount_id = 0;
        $row["name"] ? $this->name = $row["name"] : $this->name = "";
        $row["database_host"] ? $this->database_host = $row["database_host"] : $this->database_host = "";
        $row["database_port"] ? $this->database_port = $row["database_port"] : $this->database_port = "";
        $row["database_username"] ? $this->database_username = $row["database_username"] : $this->database_username = "";
        $row["database_password"] ? $this->database_password = $row["database_password"] : $this->database_password = "";
        $row["database_name"] ? $this->database_name = $row["database_name"] : $this->database_name = "";
        $row["url"] ? $this->url = $row["url"] : $this->url = "";
        $row["status"] ? $this->status = $row["status"] : $this->status = "P";
        $row["activation_status"] ? $this->activation_status = $row["activation_status"] : $this->activation_status = "P";
        $this->setDate("created", $row["created"]);
        $this->setDate("deleted_date", $row["deleted_date"]);
        $row["event_feature"] ? $this->event_feature = $row["event_feature"] : $this->event_feature = "";
        $row["banner_feature"] ? $this->banner_feature = $row["banner_feature"] : $this->banner_feature = "";
        $row["classified_feature"] ? $this->classified_feature = $row["classified_feature"] : $this->classified_feature = "";
        $row["article_feature"] ? $this->article_feature = $row["article_feature"] : $this->article_feature = "";

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $domainObj->Save();
     * <br /><br />
     *        //Using this in Domain() class.
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

        $dbObj = db_getDBObject(DEFAULT_DB, true);

        if ($this->id) {
            $sql = "UPDATE Domain SET"
                ." smaccount_id = $this->smaccount_id,"
                ." name = $this->name,"
                ." database_host = $this->database_host,"
                ." database_port = $this->database_port,"
                ." database_username = $this->database_username,"
                ." database_password = $this->database_password,"
                ." database_name = $this->database_name,"
                ." url = $this->url,"
                ." article_feature = $this->article_feature,"
                ." banner_feature = $this->banner_feature,"
                ." classified_feature = $this->classified_feature,"
                ." event_feature = $this->event_feature"
                ." WHERE id = $this->id";

            $dbObj->query($sql);
        } else {
            $sql = "INSERT INTO Domain"
                ." (smaccount_id, name, database_host, database_port, database_username, database_password, database_name, url, status, activation_status, created, article_feature, banner_feature, classified_feature, event_feature)"
                ." VALUES"
                ." ($this->smaccount_id, $this->name, $this->database_host, $this->database_port, $this->database_username, $this->database_password, $this->database_name, $this->url, 'P','P',  CURDATE(), $this->article_feature, $this->banner_feature, $this->classified_feature, $this->event_feature)";

            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);
        }
        $this->prepareToUse();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $domainObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Delete
     * @access Public
     */
    function Delete()
    {
        $dbObj = db_getDBObject(DEFAULT_DB, true);

        if ($this->status == "A") {
            /*
             * Changing the Domain Status to 'D' (Deleted)
             */
            $sql = "UPDATE Domain SET status = 'D', deleted_date = CURDATE() WHERE id = $this->id";
            $dbObj->query($sql);

        } else {
            if (is_numeric($this->id) && $this->id) {

                /*
                 * Deleting the domain Custom Folder (custom/domain_[ID]
                 */
                $customFolder = EDIRECTORY_ROOT."/custom/domain_$this->id";
                if (is_dir($customFolder)) {
                    $this->deleteFolder($customFolder);
                }

                /*
                 * Dropping the Domain Data Base
                 */
                // Instancing the new Data Base Connection
                $dbHostNEW = $this->database_host.($this->database_port ? ":".$this->database_port : "");
                $dbUserNEW = $this->database_username;
                $dbPassNEW = $this->database_password;
                $dbNameNEW = $this->database_name;

                $new_link = mysql_connect($dbHostNEW, $dbUserNEW, $dbPassNEW, true);
                @mysql_selectdb($dbNameNEW, $new_link);
                // Only if Data Base exists then Drop the Data Base
                if (!mysql_error()) {
                    $sqlDrop = "DROP DATABASE `".DB_NAME_PREFIX."_domain_$this->id`";
                    mysql_query($sqlDrop, $new_link);
                }

                // Control Export Listing
                $sql = "DELETE FROM `Control_Export_Listing` WHERE domain_id = $this->id";
                $dbObj->query($sql);

                // Control Export Event
                $sql = "DELETE FROM `Control_Export_Event` WHERE domain_id = $this->id";
                $dbObj->query($sql);

                // Control Import Listing
                $sql = "DELETE FROM `Control_Import_Listing` WHERE domain_id = $this->id";
                $dbObj->query($sql);

                // Control Import Event
                $sql = "DELETE FROM `Control_Import_Event` WHERE domain_id = $this->id";
                $dbObj->query($sql);

                // Control Export MailApp
                $sql = "DELETE FROM `Control_Export_MailApp` WHERE domain_id = $this->id";
                $dbObj->query($sql);

                // Control Cron
                $sql = "DELETE FROM `Control_Cron` WHERE `domain_id` = $this->id";
                $dbObj->query($sql);

                // Account
                $sql = "DELETE FROM `Account_Domain` WHERE `domain_id` = $this->id";
                $dbObj->query($sql);

                // Package
                $sql = "DELETE FROM `Package` WHERE `parent_domain` = $this->id";
                $dbObj->query($sql);

                // PackageItems
                $sql = "DELETE FROM `PackageItems` WHERE `domain_id` = $this->id";
                $dbObj->query($sql);

                // PackageModules
                $sql = "DELETE FROM `PackageModules` WHERE `parent_domain_id` = $this->id";
                $dbObj->query($sql);

                // PackageModules
                $sql = "DELETE FROM `PackageModules` WHERE `domain_id` = $this->id";
                $dbObj->query($sql);

                // Table Cron_Log
                $sql = "DELETE FROM `Cron_Log` WHERE `domain_id` = $this->id";
                $dbObj->query($sql);

                // Table Domain
                $sql = "DELETE FROM `Domain` WHERE id = $this->id";
                $dbObj->query($sql);

            }
        }

        /*
         * Rewrite the Domain Config File
         */
        $sql = "SELECT `id`, `url` FROM `Domain` WHERE `status` = 'A'";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result) > 0) {
            $domainFilePath = EDIRECTORY_ROOT."/custom/domain/domain.inc.php";
            $domainFile = fopen($domainFilePath, "w+");
            unset($buffer);
            $buffer = "<?".PHP_EOL;
            while ($row = mysql_fetch_assoc($result)) {
                $buffer .= "\$domainInfo[\"".$row["url"]."\"] = ".$row["id"].";".PHP_EOL;
            }
            $buffer .= "?>".PHP_EOL;
            fwrite($domainFile, $buffer, strlen($buffer));
            fclose($domainFile);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $domainObj->ActiveDomain();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name ActiveDomain
     * @access Public
     */
    function ActiveDomain()
    {
        $dbObj = db_getDBObject(DEFAULT_DB, true);

        if ($this->id && $this->status == "P") {
            $this->status = "A";
            /*
             * Changing the Domain Status to 'A' (Active)
             */
            $sql = "UPDATE Domain SET status = 'A' WHERE id = $this->id";
            $dbObj->query($sql);

            $this->changeActivationStatus();
        }

        /*
         * Create the Domain Config File
         */
        $sql = "SELECT `id`, `url` FROM `Domain` WHERE `status` = 'A'";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result) > 0) {
            $domainFilePath = EDIRECTORY_ROOT."/custom/domain/domain.inc.php";
            $domainFile = fopen($domainFilePath, "w+");
            unset($buffer);
            $buffer = "<?".PHP_EOL;
            while ($row = mysql_fetch_assoc($result)) {
                $buffer .= "\$domainInfo[\"".$row["url"]."\"] = ".$row["id"].";".PHP_EOL;
            }
            $buffer .= "?>".PHP_EOL;
            fwrite($domainFile, $buffer, strlen($buffer));
            fclose($domainFile);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $domainObj->checkUserProvilegies();
     * <br /><br />
     *        //Using this in Domain() class.
     *        $this->checkUserProvilegies();
     * </code>
     * Select the database user privileges (SHOW PRIVILEGES) and compare with the constant NEEDED_PRIVILEGES
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name checkUserProvilegies
     * @access Public
     * @return array $privileges
     */
    function checkUserProvilegies($link = false)
    {
        $neededPrivileges = explode(",", Domain::NEEDED_PRIVILEGES);
        $hasPrivileges = [];

        $dbObj = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT * FROM information_schema.user_privileges";

        if ($link) {
            $result = mysql_query($sql, $link);
        } else {
            $result = $dbObj->query($sql);
        }

        unset($privileges);
        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_assoc($result)) {
                $hasPrivileges[] = ucfirst(strtolower($row["PRIVILEGE_TYPE"]));
            }
        }

        foreach ($neededPrivileges as $neededPrivilege) {
            if (in_array($neededPrivilege, $hasPrivileges)) {
                $privileges["granted"][] = $neededPrivilege;
            } else {
                $privileges["denied"][] = $neededPrivilege;
            }
        }
        if ($privileges["denied"]) {
            foreach ($privileges["denied"] as $k => $denied) {
                if (!in_array($denied, $neededPrivileges)) {
                    unset($privileges["denied"][$k]);
                }
            }

            if ($_SESSION["is_arcalogin"]) {
                unset($privileges['denied']);
            }
        }

        return $privileges;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $domainObj->createDatabaseDomain($temp_id);
     * </code>
     * Create the new Domain structure (New Database, Fulders, Files and Records on Main Database)
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @access Public
     */
    function createDatabaseDomain()
    {
        /*
         * Get the sample data to make the new Domain connection
         */
        $dbObj = db_getDBObject(DEFAULT_DB, true);

        $sql = "SELECT `database_host`, `database_port`, `database_name`, `database_username`, `database_password` FROM `Domain` WHERE `status` = 'A' ORDER BY `id` LIMIT 1";
        $result = $dbObj->query($sql);

        // Only if one or more Domain(s) exist in Main Database
        if (mysql_num_rows($result) > 0) {

            $row = mysql_fetch_assoc($result);

            // Startin the Percentage With 0%
            $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_CREATING_DATABASE), "0");

            // Make a connection with the sample data to get the sample database
            $dbHost = $row["database_host"].($row["database_port"] ? ":".$row["database_port"] : "");
            $dbUser = $row["database_username"];
            $dbPass = $row["database_password"];
            $dbName = $row["database_name"];

            $sample_link = mysql_connect($dbHost, $dbUser, $dbPass, true);

            // Only if success
            if ($sample_link) {
                // Set the charset of the new connection
                mysql_query("SET NAMES 'utf8'", $sample_link);
                mysql_query('SET character_set_connection=utf8', $sample_link);
                mysql_query('SET character_set_client=utf8', $sample_link);
                mysql_query('SET character_set_results=utf8', $sample_link);
                // Select the sample database
                mysql_selectdb($dbName, $sample_link);

                // Make a connection with the new data to create the new Database
                $dbHostNEW = $this->database_host.($this->database_port ? ":".$this->database_port : "");
                $dbUserNEW = !empty($_POST['domain_dbuser']) ? $_POST['domain_dbuser'] : $this->database_username;
                $dbPassNEW = !empty($_POST['domain_dbpass']) ? $_POST['domain_dbpass'] : $this->database_password;
                $dbNameNEW = $this->database_name;

                $new_link = mysql_connect($dbHostNEW, $dbUserNEW, $dbPassNEW, true);

                // Only if success
                if ($new_link) {
                    // Set the charset of the new connection
                    mysql_query("SET NAMES 'utf8'", $new_link);
                    mysql_query('SET character_set_connection=utf8', $new_link);
                    mysql_query('SET character_set_client=utf8', $new_link);
                    mysql_query('SET character_set_results=utf8', $new_link);
                    mysql_query('SET foreign_key_checks = 0');

                    if (empty($_POST['domain_db'])) {
                        // Create the new database "domain_[ID]"
                        $sqlCreateDatabase = "CREATE DATABASE `$this->database_name` CHARSET 'utf8' COLLATE 'utf8_unicode_ci'";
                        mysql_query($sqlCreateDatabase, $new_link);
                        // Adds user permission to new database
                        list($newDbHost, $newDbPort) = explode(':', $dbHost);
                        $sqlCreateDatabase = "GRANT ALL PRIVILEGES ON ".$this->database_name.".* TO '$dbUser'@'$newDbHost'";
                        mysql_query($sqlCreateDatabase, $new_link);
                    }

                    // Make the instance of the new database connection object
                    $new_dbObj = db_getDBObjectByDomainID($this->id, $dbObj);

                    // Insert Control Export Listing
                    $sql = "INSERT INTO `Control_Export_Listing` (`id`, `domain_id`, `last_run_date`, `total_listing_exported`, `last_listing_id`, `block`, `finished`, `filename`, `type`, `running_cron`, `scheduled`) VALUES
									(1, $this->id, NOW(), 0, 0, 50000, 'Y', '', 'csv', 'N', 'N'),
									(2, $this->id, NOW(), 0, 0, 10000, 'Y', '', 'csv - data', 'N', 'N');";
                    $dbObj->query($sql);

                    // Insert Control Export Event
                    $sql = "INSERT INTO `Control_Export_Event` (`id`, `domain_id`, `last_run_date`, `total_event_exported`, `last_event_id`, `block`, `finished`, `filename`, `type`, `running_cron`, `scheduled`) VALUES
									(1, $this->id, NOW(), 0, 0, 50000, 'Y', '', 'csv', 'N', 'N'),
									(2, $this->id, NOW(), 0, 0, 10000, 'Y', '', 'csv - data', 'N', 'N');";
                    $dbObj->query($sql);

                    // Insert Control Import Listing
                    $sql = "INSERT INTO `Control_Import_Listing` (`domain_id`, `last_run_date`) VALUES ($this->id, NOW());";
                    $dbObj->query($sql);

                    // Insert Control Import Event
                    $sql = "INSERT INTO `Control_Import_Event` (`domain_id`, `last_run_date`) VALUES ($this->id, NOW());";
                    $dbObj->query($sql);

                    // Insert Control Export MailApp
                    $sql = "INSERT INTO `Control_Export_MailApp` (`domain_id`, `last_run_date`) VALUES ($this->id, NOW());";
                    $dbObj->query($sql);

                    // Insert Control Cron
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'daily_maintenance');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'email_traffic');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'renewal_reminder');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'report_rollup');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'sitemap');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'statisticreport');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'location_update');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'prepare_import');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'prepare_import_events');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'rollback_import');";
                    $dbObj->query($sqlCC);
                    $sqlCC = "INSERT INTO `Control_Cron` (`domain_id`, `running`, `last_run_date`, `type`) VALUES ($this->id, 'N', NOW(), 'rollback_import_events');";
                    $dbObj->query($sqlCC);

                    // Get all tables of the sample database
                    $sqlTables = "SHOW TABLES";
                    $resultTables = mysql_query($sqlTables, $sample_link);

                    // Only if has results
                    if (mysql_num_rows($resultTables) > 0) {
                        // Select the new database
                        mysql_selectdb($dbNameNEW, $new_link);
                        // Courses all tables from the sample database
                        while ($rowTables = mysql_fetch_array($resultTables)) {
                            unset($sqlShowCT);
                            // Get the "CREATE TABLE" command from the sample table
                            $sqlShowCT = "SHOW CREATE TABLE ".$rowTables[0];
                            $resultCT = mysql_query($sqlShowCT, $sample_link);

                            // Only if has results
                            if (mysql_num_rows($resultCT) > 0) {
                                $rowCT = mysql_fetch_array($resultCT);
                                // Create the new table from the sample table structure
                                $sqlNewTable = $rowCT[1];
                                mysql_query($sqlNewTable, $new_link);
                            }
                        }
                    }

                    /*
                     * Configuring the New Domain in Main Database and Seccondary Database
                     */

                    // All process below need to check if exists some error to continue ($this->CheckError())
                    // If exists some error the process stop immediately

                    // Set the Percentage to 10%
                    // Copy the data to Domain Database
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_DATABASE), "10");
                        $this->importDump($new_dbObj);
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 78%
                    // Create the Domain Custom Folders "custom/domain_[ID]/ * (All folders conteined in CUSTOM_FOLDERS constant)
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_CREATING_CUSTOM_FOLDERS),
                            "78");
                        $this->createCustomFolders();
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 80%
                    // Copy the Theme Folder to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_THEME), "80");
                        $rootThemeFolder = EDIRECTORY_ROOT."/theme/default";
                        $customThemeFolder = EDIRECTORY_ROOT."/custom/domain_$this->id/theme/default";
                        $this->copyThemeToDomain($rootThemeFolder, $customThemeFolder);
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 90%
                    // Copy the Location File to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LOCATION), "90");
                        $this->createCustomLocationFile();
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 92%
                    // Copy the Scalability File to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SCALABILITY),
                            "92");
                        $this->createCustomScalabilityFile();
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 93%
                    // Copy the SSL File to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SSL), "93");
                        $this->createCustomSSLFile();
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }
                    // Set the Percentage to 94%
                    // Copy the Constant File to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_CONSTANT), "94");
                        $this->createCustomConstantFile();
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 95%
                    // Copy the Lang File to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_LANGUAGEFILE),
                            "95");
                        $this->copyCustomFileToDoman("lang", "language.inc.php");
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 97%
                    // Copy the Payment File to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_PAYMENT), "97");
                        $this->copyCustomFileToDoman("payment", "payment.inc.php");
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 99%
                    // Copy the Social Network File to Domain Folder
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_COPYING_SOCIALNETWORK),
                            "99");
                        $this->copyCustomFileToDoman("socialnetwork", "socialnetwork.inc.php");
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }

                    // Set the Percentage to 100%
                    // Finishing the Process
                    if (!$this->checkError()) {
                        $this->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_FINISHING), "100");
                    } else {
                        if (!$this->new_db_closed) {
                            $this->new_db_closed = true;
                            $new_dbObj->close();
                        }
                    }
                } else {
                    // Set the error file
                    $this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_NEWDB));
                }
            } else {
                // Set the error file
                $this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPDB));
            }
        } else {
            // Set the error file
            $this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_NODOMAIN));
        }
    }

    /**
     * @param mysql $dbObj Mysql connection
     */
    private function importDump($dbObj)
    {
        $dumpName = 'empty_domain_'.$this->lang.'.dump.sql';
        $dumpFile = EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/sites/default_database/".$dumpName;
        if ($dumpFileSQL = new SplFileObject($dumpFile)) {
            while (!$dumpFileSQL->eof()) {
                $command = rtrim($dumpFileSQL->fgets(), ';');
                if (trim($command)) {
                    $dbObj->query($command);

                    if (mysql_error()) {
                        $this->writeErrorFile("database", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SQLCOMMAND));
                    }
                }
            }
        } else {
            // Set the error file
            $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_SPFILE));
        }
    }

    function createCustomFolders()
    {
        $arrCustomDir = explode(",", Domain::CUSTOM_FOLDERS);
        $baseFolder = EDIRECTORY_ROOT."/custom";
        $domainFolder = $baseFolder."/domain_$this->id";
        mkdir($domainFolder);
        if (is_dir($domainFolder)) {
            foreach ($arrCustomDir as $customDir) {
                mkdir($domainFolder."/".$customDir);
                if (!is_dir($domainFolder."/".$customDir)) {
                    if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
                        $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
                    } else {
                        $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
                    }
                    break;
                }
            }
        } else {
            if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
            }
        }
    }

    function copyThemeToDomain($src, $dst)
    {
        $themeFilePath = EDIRECTORY_ROOT."/custom/domain_$this->id/theme/theme.inc.php";
        if ($themeFile = fopen($themeFilePath, "w+")) {
            $buffer = "";
            $buffer .= "<?".PHP_EOL;
            $buffer .= "\$edir_theme=\"default\";".PHP_EOL;
            $buffer .= "?>".PHP_EOL;
            fwrite($themeFile, $buffer, strlen($buffer));
            fclose($themeFile);
            $this->_copyThemeToDomain($src, $dst);
        } else {
            if ((int)system_checkPerm($dst) < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
            }
        }
    }

    function _copyThemeToDomain($src, $dst)
    {
        $baseFolder = EDIRECTORY_ROOT."/custom";
        $dir = opendir($src);
        if (!file_exists($dst) && string_strpos($src, "/.") === false) {
            mkdir($dst);
        }
        if (is_dir) {
            while (false !== ($file = readdir($dir))) {
                if (($file != '.') && ($file != '..')) {
                    if (string_strpos($src, "/.") === false) {
                        if (is_dir($src.'/'.$file)) {
                            $this->_copyThemeToDomain($src.'/'.$file, $dst.'/'.$file);
                        } else {
                            copy($src.'/'.$file, $dst.'/'.$file);
                            if (!file_exists($dst.'/'.$file)) {
                                if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
                                    $this->writeErrorFile("file",
                                        system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
                                } else {
                                    $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_THEMEFILE));
                                }
                                break;
                            }
                        }
                    } else {
                        continue;
                    }
                }
            }
            closedir($dir);
        } else {
            if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
            }
        }
    }

    function copyImagesFolderToDomain($src, $dst)
    {
        $baseFolder = EDIRECTORY_ROOT."/custom/domain_$this->id";
        $dir = opendir($src);
        if (!file_exists($dst) && string_strpos($src, "/.") === false) {
            mkdir($dst);
        }
        if (is_dir) {
            while (false !== ($file = readdir($dir))) {
                if (($file != '.') && ($file != '..')) {
                    if (string_strpos($src, "/.") === false) {
                        if (is_dir($src.'/'.$file)) {
                            $this->copyImagesFolderToDomain($src.'/'.$file, $dst.'/'.$file);
                        } else {
                            copy($src.'/'.$file, $dst.'/'.$file);
                            if (!file_exists($dst.'/'.$file)) {
                                if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
                                    $this->writeErrorFile("file",
                                        system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
                                } else {
                                    $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_THEMEFILE));
                                }
                                break;
                            }
                        }
                    } else {
                        continue;
                    }
                }
            }
            closedir($dir);
        } else {
            if ((int)system_checkPerm($baseFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFOLDER));
            }
        }
    }

    function createCustomLocationFile()
    {
        $fileLocPath = EDIRECTORY_ROOT."/custom/domain_$this->id/location/location.inc.php";
        if ($fileLoc = fopen($fileLocPath, 'w+')) {

            $buffer = "<?php".PHP_EOL;

            $buffer .= "\$edir_default_locations = \"";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "\$edir_default_locationids = \"";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "\$edir_default_locationnames = \"";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "\$edir_default_locationshow = \"";
            $buffer .= "\";".PHP_EOL.PHP_EOL;

            $buffer .= "\$edir_locations = \"1,3,4";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "\$edir_locationnames = \"COUNTRY,STATE,CITY";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "\$edir_locationnames_plural = \"COUNTRIES,STATES,CITIES";
            $buffer .= "\";".PHP_EOL.PHP_EOL;

            $buffer .= "\$edir_all_locations = \"1,2,3,4,5";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "\$edir_all_locationnames = \"COUNTRY,REGION,STATE,CITY,NEIGHBORHOOD";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "\$edir_all_locationnames_plural = \"COUNTRIES,REGIONS,STATES,CITIES,NEIGHBORHOODS";
            $buffer .= "\";".PHP_EOL;
            $buffer .= "?>".PHP_EOL;

            $return_flag = fwrite($fileLoc, $buffer, strlen($buffer));

            fclose($fileLoc);
        } else {
            if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
            }
        }
    }

    function createCustomScalabilityFile()
    {
        $fileScalPath = EDIRECTORY_ROOT."/custom/domain_$this->id/conf/scalability.inc.php";

        $scalValues = [];
        $scalValues["listing_scalability"] = "off";
        $scalValues["promotion_scalability"] = "off";
        $scalValues["event_scalability"] = "off";
        $scalValues["banner_scalability"] = "off";
        $scalValues["classified_scalability"] = "off";
        $scalValues["article_scalability"] = "off";
        $scalValues["blog_scalability"] = "off";
        $scalValues["listingcateg_scalability"] = "off";
        $scalValues["eventcateg_scalability"] = "off";
        $scalValues["classifiedcateg_scalability"] = "off";
        $scalValues["articlecateg_scalability"] = "off";
        $scalValues["blogcateg_scalability"] = "off";

        if (!system_writeScalabilityFile($fileScalPath, $this->id, $scalValues)) {

            if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
            }

        }
    }

    function createCustomSSLFile()
    {
        $fileSSLPath = EDIRECTORY_ROOT."/custom/domain_$this->id/conf/ssl.inc.php";
        if ($fileSSL = fopen($fileSSLPath, "w+")) {
            $buffer = "";
            $buffer .= "<?".PHP_EOL;;
            $buffer .= "/*==================================================================*\\".PHP_EOL;
            $buffer .= "######################################################################".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# This file may not be redistributed in whole or part.               #".PHP_EOL;
            $buffer .= "# eDirectory is licensed on a per-domain basis.                      #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# http://www.edirectory.com | http://www.edirectory.com/license.html #".PHP_EOL;
            $buffer .= "######################################################################".PHP_EOL;
            $buffer .= "\*==================================================================*/".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# * FILE: /custom/domain_$this->id/conf/ssl.inc.php".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# FLAGS - on/off".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"SSL_ENABLED\", \"off\");".PHP_EOL;
            $buffer .= "define(\"FORCE_PROFILE_SSL\", \"off\");".PHP_EOL;
            $buffer .= "define(\"FORCE_MEMBERS_SSL\", \"off\");".PHP_EOL;
            $buffer .= "define(\"FORCE_ORDER_SSL\", \"off\");".PHP_EOL;
            $buffer .= "define(\"FORCE_CLAIM_SSL\", \"off\");".PHP_EOL;
            $buffer .= "define(\"FORCE_SITEMGR_SSL\", \"off\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# SSL".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "if (SSL_ENABLED == \"on\") {".PHP_EOL;
            $buffer .= "	if (FORCE_PROFILE_SSL == \"on\") {".PHP_EOL;
            $buffer .= "		if ((HTTPS_MODE != \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/profile\") !== false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/\".SOCIALNETWORK_FEATURE_NAME.\"/login.php\") === false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/\".SOCIALNETWORK_FEATURE_NAME.\"/logout.php\") === false)) {".PHP_EOL;
            $buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
            $buffer .= "			exit;".PHP_EOL;
            $buffer .= "		}".PHP_EOL;
            $buffer .= "	}".PHP_EOL;
            $buffer .= "	if (FORCE_MEMBERS_SSL == \"on\") {".PHP_EOL;
            $buffer .= "		if ((HTTPS_MODE != \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/".MEMBERS_ALIAS."\") !== false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"facebookauth.php\") === false)) {".PHP_EOL;
            $buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
            $buffer .= "			exit;".PHP_EOL;
            $buffer .= "		}".PHP_EOL;
            $buffer .= "		if ((HTTPS_MODE != \"on\") && (FORCE_ORDER_SSL == \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"order_\") !== false)) {".PHP_EOL;
            $buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
            $buffer .= "			exit;".PHP_EOL;
            $buffer .= "		}".PHP_EOL;
            $buffer .= "		if ((HTTPS_MODE != \"on\") && (FORCE_CLAIM_SSL == \"on\") && (string_strpos(\$_SERVER[\"REQUEST_URI\"], \"/\".ALIAS_CLAIM_URL_DIVISOR.\"/\") !== false)) {".PHP_EOL;
            $buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
            $buffer .= "			exit;".PHP_EOL;
            $buffer .= "		}".PHP_EOL;
            $buffer .= "	}".PHP_EOL;
            $buffer .= "	if (FORCE_SITEMGR_SSL == \"on\") {".PHP_EOL;
            $buffer .= "		if ((HTTPS_MODE != \"on\") && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/".SITEMGR_ALIAS."\") !== false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"/registration.php\") === false) && (string_strpos(\$_SERVER[\"PHP_SELF\"], \"&popup=1\") === false)) {".PHP_EOL;
            $buffer .= "			header(\"Location: \".\"https://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
            $buffer .= "			exit;".PHP_EOL;
            $buffer .= "		}".PHP_EOL;
            $buffer .= "	}".PHP_EOL;
            $buffer .= "} else {".PHP_EOL;
            $buffer .= "	if (HTTPS_MODE == \"on\") {".PHP_EOL;
            $buffer .= "		header(\"Location: \".\"http://\".\$_SERVER[\"HTTP_HOST\"].\$_SERVER[\"REQUEST_URI\"]);".PHP_EOL;
            $buffer .= "		exit;".PHP_EOL;
            $buffer .= "	}".PHP_EOL;
            $buffer .= "}".PHP_EOL;
            $buffer .= "?>".PHP_EOL;

            fwrite($fileSSL, $buffer, strlen($buffer));
            fclose($fileSSL);
        } else {
            if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
            }
        }
    }

    function createCustomConstantFile()
    {
        $fileConstPath = EDIRECTORY_ROOT."/custom/domain_$this->id/conf/constants.inc.php";

        $constValues = [];
        $constValues["event_feature"] = $this->event_feature;
        $constValues["banner_feature"] = $this->banner_feature;
        $constValues["classified_feature"] = $this->classified_feature;
        $constValues["article_feature"] = $this->article_feature;
        $constValues["promotion_feature"] = "on";
        $constValues["blog_feature"] = "on";
        $constValues["zipproximity_feature"] = "on";
        $constValues["custominvoice_feature"] = "on";
        $constValues["claim_feature"] = "on";
        $constValues["listingtemplate_feature"] = "on";
        $constValues["mobile_feature"] = "on";
        $constValues["multilanguage_feature"] = "on";
        $constValues["maintenance_feature"] = "on";
        $constValues["sitemap_feature"] = "on";
        $constValues["branded_print"] = "on";
        $constValues["paymentsystem_feature"] = "on";
        $constValues["name"] = $this->name;
        $constValues["redirect_user"] = "on";
        $constValues["members"] = "on";
        $constValues["disabled"] = "on";
        $constValues["free_ratio"] = "off";
        $constValues["jpg_as_png"] = "off";
        $constValues["resize_images"] = "on";
        $constValues["sitemap_www"] = "off";
        $constValues["sitemap_forcehttps"] = "off";

        if (!system_writeConstantsFile($fileConstPath, $this->id, $constValues)) {

            if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
            }

        }
    }

    function copyCustomFileToDoman($folder, $file)
    {
        $srcFile = EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/sites/default_custom_file/$folder/$file";
        $dstFolder = EDIRECTORY_ROOT."/custom/domain_$this->id/$folder/$file";
        copy($srcFile, $dstFolder);
        if (!file_exists($dstFolder)) {
            if ((int)system_checkPerm(EDIRECTORY_ROOT."/custom") < (int)PERMISSION_CUSTOM_FOLDER) {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING));
            } else {
                $this->writeErrorFile("file", system_showText(LANG_SITEMGR_DOMAIN_ERROR_CREATEFILE));
            }
        }
    }

    function incFilePercentage($message, $per)
    {

        $this->percent = $per;

        $fileLoadingPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_loading.txt";
        $fileLogPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_log.txt";

        if (file_exists($fileLogPath)) {
            $fileLog = fopen($fileLogPath, 'r');
            $logText = fread($fileLog, filesize($fileLogPath));
            fclose($fileLog);
            unset($fileLog);

            $fileLog = fopen($fileLogPath, "w+");
            $bufferLog = "";
            $bufferLog .= $logText."\n\r";
            $bufferLog .= "Process -> $message - $this->percent% - ".date('l jS \of F Y h:i:s A')."\n\r";
            fwrite($fileLog, $bufferLog, string_strlen($bufferLog));
            fclose($fileLog);
        } else {
            $fileLog = fopen($fileLogPath, "w+");
            $bufferLog = "";
            $bufferLog .= "Process -> $message - $this->percent% - ".date('l jS \of F Y h:i:s A')."\n\r";
            fwrite($fileLog, $bufferLog, string_strlen($bufferLog));
            fclose($fileLog);
        }

        $fileLoading = fopen($fileLoadingPath, 'w+');
        $bufferLoading = "";
        $bufferLoading .= "$message|";
        $bufferLoading .= "$this->percent".PHP_EOL;
        fwrite($fileLoading, $bufferLoading, string_strlen($bufferLoading));
        fclose($fileLoading);
    }

    function writeErrorFile($errorType, $errorMessage)
    {
        $this->error = true;
        $fileErrorPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_error.txt";
        unset($returnMessage);
        $returnMessage = '';
        if ($errorType == "database") {
            $returnMessage .= system_showText(LANG_SITEMGR_DOMAIN_ERROR_DBERROR)." ";
        } else {
            if ($errorType == "file") {
                $returnMessage .= system_showText(LANG_SITEMGR_DOMAIN_ERROR_FOLDERERROR)." ";
            }
        }

        $fileError = fopen($fileErrorPath, "w+");
        $bufferError = "";
        $bufferError = $returnMessage.$errorMessage.PHP_EOL;
        fwrite($fileError, $bufferError, string_strlen($bufferError));
        fclose($fileError);
    }

    function checkError()
    {
        if (!$this->error) {
            $fileErrorPath = EDIRECTORY_ROOT."/custom/domain_".$this->id."_error.txt";
            if (file_exists($fileErrorPath)) {
                $this->error = true;

                return true;
            } else {
                $this->error = false;

                return false;
            }
        } else {
            $this->error = true;

            return true;
        }
    }

    function deleteFolder($directory, $empty = false)
    {
        if (string_substr($directory, -1) == "/") {
            $directory = string_substr($directory, 0, -1);
        }

        if (!file_exists($directory) || !is_dir($directory)) {
            return false;
        } elseif (!is_readable($directory)) {
            return false;
        } else {
            $directoryHandle = opendir($directory);

            while ($contents = readdir($directoryHandle)) {
                if ($contents != '.' && $contents != '..') {
                    $path = $directory."/".$contents;

                    if (is_dir($path)) {
                        $this->deleteFolder($path);
                    } else {
                        unlink($path);
                    }
                }
            }

            closedir($directoryHandle);

            if ($empty == false) {
                if (!rmdir($directory)) {
                    return false;
                }
            }

            return true;
        }
    }

    function getAllDomains($array_fields, $status, $less_this_domain = false)
    {

        $dbObj = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT ".(is_array($array_fields) ? implode(",",
                $array_fields) : $array_fields)." FROM `Domain` WHERE `status` = '".$status."'".($less_this_domain ? " AND `id` != ".$less_this_domain : "")." ORDER BY name";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result)) {
            unset($domains);
            while ($row = mysql_fetch_assoc($result)) {
                $domains[] = $row;
            }
            if ($domains) {
                return $domains;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    function changeActivationStatus()
    {
        $auxAStatus = isRegistered($this->url, $this->id);

        if ($auxAStatus && $this->activation_status == "P") {
            $this->activation_status = "A";

            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $this->prepareToSave();
            $sql = "UPDATE `Domain` SET `activation_status` = $this->activation_status WHERE `id` = $this->id";
            $dbObj->query($sql);
            $this->prepareToUse();
        } else {
            if (!$auxAStatus && $this->activation_status == "A") {
                $this->activation_status = "P";

                $dbObj = db_getDBObject(DEFAULT_DB, true);
                $this->prepareToSave();
                $sql = "UPDATE `Domain` SET `activation_status` = $this->activation_status WHERE `id` = $this->id";
                $dbObj->query($sql);
                $this->prepareToUse();
            }
        }
    }
}

?>
