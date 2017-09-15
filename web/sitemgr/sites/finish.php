<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/sites/finish.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# AJAX
# ----------------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $langs = [
        'pt' => 'pt_br',
        'en' => 'en_us',
        'es' => 'es_es',
    ];

    if ($_POST["action"] == "save") {
        if ($_POST["domain_server"] == "default") {
            $_db_host = explode(":", _DIRECTORYDB_HOST);
            $sINFO["database_host"] = $_db_host[0];
            $sINFO["database_port"] = $_db_host[1];
            $sINFO["database_username"] = _DIRECTORYDB_USER;
            $sINFO["database_password"] = _DIRECTORYDB_PASS;
            $has_server = true;
        } else {
            $sINFO = explode(" : ", $_POST["domain_server"]);

            if ($sINFO[0]) {
                $where = " WHERE database_host = '".$sINFO[0]."' ";
            }
            if ($sINFO[1]) {
                $where .= " AND database_port = '".$sINFO[1]."' ";
            }

            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = "SELECT database_host, database_port, database_name, database_username, database_password FROM Domain ".($where ? $where : "")." ORDER BY id LIMIT 1";
            $result = $dbObj->query($sql);
            if (mysql_num_rows($result) > 0) {
                $row = mysql_fetch_assoc($result);

                unset($sINFO);
                $sINFO["database_host"] = $row["database_host"];
                $sINFO["database_port"] = $row["database_port"];
                $sINFO["database_username"] = $row["database_username"];
                $sINFO["database_password"] = $row["database_password"];
                $has_server = true;
            } else {
                $has_server = false;
            }
        }

        if ($has_server) {
            $domain = new Domain($_POST["domain_id"]);

            $database_name = $_POST['domain_db'] ?
                $_POST['domain_db'] :
                DB_NAME_PREFIX."_domain_".$domain->getNumber("id");

            $domain->setNumber("smaccount_id", sess_getSMIdFromSession() ? sess_getSMIdFromSession() : 0);
            $domain->setString("database_host", $sINFO["database_host"]);
            $domain->setString("database_port", $sINFO["database_port"]);
            $domain->setString("database_username", $sINFO["database_username"]);
            $domain->setString("database_password", $sINFO["database_password"]);
            $domain->setString("database_name", $database_name);
            $domain->setString("name", $_POST["domain_name"]);
            $url = trim(string_strtolower($_POST["domain_url"]));
            $url = str_replace("http://", "", $url);
            $url = str_replace("https://", "", $url);
            $url = str_replace("www.", "", $url);
            $domain->setString("url", $url);
            $domain->Save();

            // Prepare the code to yaml
            $yaml = [
                'newDomain'               => true,
                $domain->getString('url') => [
                    'id'       => (int)$domain->getNumber("id"),
                    'path'     => 'custom/domain_'.$domain->getNumber("id").'/',
                    'template' => 'default',
                    'locale'   => $langs[$_POST['domain_lang']],
                    'database' => DB_NAME_PREFIX.'_domain_'.$domain->getNumber("id"),
                    'elastic'  => DB_NAME_PREFIX.'_domain_'.$domain->getNumber("id"),
                    'title'    => $domain->getString('name'),
                    'branded'  => 'on',
                ],
            ];

            // Saving yaml file (new edirectory)
            $symfony = new Symfony('domain.yml');
            $symfony->save('multi_domain', $yaml);

            $domain->incFilePercentage(system_showText(LANG_SITEMGR_DOMAIN_PROCESS_STARTING), "0");

            echo $domain->getNumber("id");
        }
    } else {
        if ($_POST["action"] == "create") {
            $domain = new Domain($_POST["domain_id"]);
            $domain->setLang($_POST['domain_lang']);
            $domain->createDatabaseDomain();
        } else {
            if ($_POST["action"] == "read") {
                $errorFilePath = EDIRECTORY_ROOT."/custom/domain_".$_POST["domain_id"]."_error.txt";
                $filePath = EDIRECTORY_ROOT."/custom/domain_".$_POST["domain_id"]."_loading.txt";
                if (!file_exists($errorFilePath)) {
                    if (file_exists($filePath)) {
                        $file = fopen($filePath, 'r');
                        $text = fread($file, filesize($filePath));
                        fclose($file);

                        $arrText = explode("|", $text);
                        if ($arrText[1] == 100) {
                            $SRClogFile = EDIRECTORY_ROOT."/custom/domain_".$_POST["domain_id"]."_log.txt";
                            $DSTlogFile = EDIRECTORY_ROOT."/custom/domain_".$_POST["domain_id"]."/domain_".$_POST["domain_id"]."_log.txt";
                            copy($SRClogFile, $DSTlogFile);
                            unlink($SRClogFile);

                            unlink($filePath);
                        }
                    } else {
                        $SRClogFile = EDIRECTORY_ROOT."/custom/domain_".$_POST["domain_id"]."_log.txt";
                        $DSTlogFile = EDIRECTORY_ROOT."/custom/log/domain_".$_POST["domain_id"]."_log.txt";
                        $text = system_showText(LANG_SITEMGR_DOMAIN_ERROR_FOLDERERROR)." ".system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING)."|error";
                        unlink($errorFilePath);
                        copy($SRClogFile, $DSTlogFile);
                        unlink($SRClogFile);
                        unlink($filePath);

                        $domainObj = new Domain($_POST["domain_id"]);
                        $domainObj->setString("status", "D");
                        $domainObj->Delete();
                    }
                } else {
                    $SRClogFile = EDIRECTORY_ROOT."/custom/domain_".$_POST["domain_id"]."_log.txt";
                    $DSTlogFile = EDIRECTORY_ROOT."/custom/log/domain_".$_POST["domain_id"]."_log.txt";
                    $file = fopen($errorFilePath, 'r');
                    $error = fread($file, filesize($errorFilePath));
                    fclose($file);

                    $text = $error."|error";
                    unlink($errorFilePath);
                    copy($SRClogFile, $DSTlogFile);
                    unlink($SRClogFile);
                    unlink($filePath);

                    $domainObj = new Domain($_POST["domain_id"]);
                    $domainObj->setString("status", "D");
                    $domainObj->Delete();
                }

                echo $text;
            }
        }
    }
} else {
    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/sites/");
    exit;
}
