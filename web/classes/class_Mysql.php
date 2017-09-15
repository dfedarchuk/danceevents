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
# * FILE: /classes/class_mysql.php
# ----------------------------------------------------------------------------------------------------

class mysql
{
    public $result = '';

    function mysql($DB_KEY)
    {
        $this->_reset_properties();
        $this->SERVER_NAME = $_SERVER[SERVER_NAME];
        $this->PHP_SELF = $_SERVER[PHP_SELF];
        $this->db_key = $DB_KEY;
        $this->db_host = constant("_".$DB_KEY."_HOST");
        $this->db_user = constant("_".$DB_KEY."_USER");
        $this->db_pass = constant("_".$DB_KEY."_PASS");
        $this->db_name = constant("_".$DB_KEY."_NAME");
        $this->db_email = constant("_".$DB_KEY."_EMAIL");
        $this->db_debug = constant("_".$DB_KEY."_DEBUG");
        $this->mysql_error = false;
        $this->expire_connection = mktime(date("G"), date("i"), date("s") + MYSQL_TIMEOUT, date("n"), date("j"),
            date("Y"));

        if ($this->db_debug == "display") {
            $this->db_debug = 1;
        } else {
            $this->db_debug = 0;
        }


        /*
         * Check connection in Connection Pool
         */
        $link = ConnectionPool::instance()->getConnection($this->db_name);
        if (!$link) {
            $this->link_id = mysql_connect($this->db_host, $this->db_user, $this->db_pass, true);

            // Set MySQL Parameters
            mysql_query("SET NAMES 'utf8'", $this->link_id);
            mysql_query('SET character_set_connection=utf8', $this->link_id);
            mysql_query('SET character_set_client=utf8', $this->link_id);
            mysql_query('SET character_set_results=utf8', $this->link_id);
            mysql_query("SET SESSION time_zone = '{$this->getOffSet()}'", $this->link_id);

            if ($this->link_id) {
                $this->select_db_name = mysql_select_db($this->db_name, $this->link_id);
                if (!$this->select_db_name) {
                    $this->_handle_error("constructor: select_db", $this->db_debug);
                }
            } else {
                $this->_handle_error("constructor: mysql_connect", $this->db_debug);
            }
            ConnectionPool::instance()->registerConnection($this, $this->db_name);
        } else {
            $this->link_id = $link;
        }
    }

    function getOffSet()
    {
        $now = new DateTime();
        $mins = $now->getOffset() / 60;

        $sgn = ($mins < 0 ? -1 : 1);
        $mins = abs($mins);
        $hrs = floor($mins / 60);
        $mins -= $hrs * 60;

        return sprintf('%+d:%02d', $hrs * $sgn, $mins);
    }

    # ----------------------------------------------------------------------------------------------------
    # external methods
    # ----------------------------------------------------------------------------------------------------
    function getmicrotime()
    {
        list($usec, $sec) = explode(" ", microtime());

        return ((float)$usec + (float)$sec);
    }


    function query(&$query, $db_debug = 0)
    {
        $this->mysql_error = false;
        $db_debug = max($db_debug, $this->db_debug);

        /*
         * Get time to execute query
         */
        $start_time = $this->getmicrotime();

        $result = mysql_query($query, $this->link_id);

        $end_time = $this->getmicrotime();

        if (QUERY_LOG_FILE && ENABLE_LOG) {
            $this->sql_log($query, $end_time - $start_time);
        }

        if (!$result) {
            $this->_handle_error($query, $db_debug);
        }

        $this->result = $result;

        return $this->result;
    }


    function unbuffered_query(&$query, $db_debug = 0)
    {
        $this->mysql_error = false;
        $db_debug = max($db_debug, $this->db_debug);

        /*
        * Get time to execute query
        */
        $start_time = $this->getmicrotime();

        $result = mysql_unbuffered_query($query, $this->link_id);

        $end_time = $this->getmicrotime();

        if (QUERY_LOG_FILE && ENABLE_LOG) {
            $this->sql_log($query, $end_time - $start_time);
        }

        if (!$result) {
            $this->_handle_error($query, $db_debug);
        }
        $this->result = $result;

        return $this->result;
    }

    /**
     * Method to close connection
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @name close ()
     */
    function close()
    {
        if (!mysql_close($this->link_id)) {
            $db_debug = max($db_debug, $this->db_debug);
            $to = $this->db_email;
            $from = "db_debug@".$this->SERVER_NAME;
            $subject = "ERROR: http://".$this->SERVER_NAME.$this->PHP_SELF;
            $message = "\n\n Error closing connection\n\n";
            if ($this->link_id) {
                $message .= " Errno: ".mysql_errno($this->link_id)."\n";
                $message .= " Error: ".mysql_error($this->link_id)."\n";
            }
            $message .= "_SERVER data\n";
            $server_values = [
                'REMOTE_ADDR',
                'REMOTE_PORT',
                'SCRIPT_FILENAME',
                'REQUEST_METHOD',
                'QUERY_STRING',
                'REQUEST_URI',
            ];
            while (list($temp, $name) = each($server_values)) {
                $message .= sprintf("%15s : %s\n", $name, $_SERVER[$name]);
            }
            if ($db_debug) {
                echo "<PRE>$message</PRE>\n";
            } else {
                echo "Database Error. System Administrator has been notified and this problem will be solved as soon as possible. We are sorry for the inconvenience.";
                if ($this->link_id) {
                    $this->_mymail($to, $subject, $message, $from);
                }
            }
        } else {
            ConnectionPool::instance()->unsetConnection($this->db_name);
        }
    }


    # ----------------------------------------------------------------------------------------------------
    # SQL Log
    # ----------------------------------------------------------------------------------------------------
    function sql_log($query, $execution_time)
    {
        unset($type);
        unset($ip);
        unset($page);
        unset($session);
        unset($username);

        if (string_strpos($query, "INSERT") !== false) {
            $type = "Insert";
            $log = true;
        } else {
            if (string_strpos($query, "UPDATE") !== false) {
                $type = "Update";
                $log = true;
            } else {
                if (string_strpos($query, "DELETE") !== false) {
                    $type = "Delete";
                    $log = true;
                } else {
                    $type = "Select";
                    $log = true;
                }
            }
        }

        $ip = $_SERVER["REMOTE_ADDR"];
        $page = $_SERVER["PHP_SELF"];

        if ($_SESSION["SM_LOGGEDIN"]) {
            $session = "sitemgr";
        } elseif ($_SESSION["SESS_ACCOUNT_ID"]) {
            $session = "account_id = ".$_SESSION["SESS_ACCOUNT_ID"];
        }

        if ($type && $log) {

            if (QUERY_LOG_DB) {
                /**
                 * Version to save on DB - Disabled
                 */
                unset($sql);
                $sql = "INSERT INTO SQL_Log (`sql`, `type`, `date`, `time`, `ip`, `page`, `session`, `username`, `execution_time`)
                            VALUES (\"".substr($query, 0,
                        1000)."\", \"$type\", CURDATE(), CURTIME(), \"$ip\", \"$page\", \"$session\", \"$username\",\"$execution_time\")";

                $aux_link = mysql_connect(_DIRECTORYDB_HOST, _DIRECTORYDB_USER, _DIRECTORYDB_PASS, true);
                mysql_query("SET NAMES 'utf8'", $aux_link);
                mysql_query('SET character_set_connection=utf8', $aux_link);
                mysql_query('SET character_set_client=utf8', $aux_link);
                mysql_query('SET character_set_results=utf8', $aux_link);
                mysql_query("SET SESSION time_zone = '{$this->getOffSet()}'", $aux_link);

                if ($aux_link) {
                    mysql_select_db(_DIRECTORYDB_NAME, $aux_link);
                    mysql_query($sql, $aux_link);
                }
            } elseif (QUERY_LOG_FILE) {
                $message = "SQL: ".substr($query, 0,
                        1000)." - TYPE:".$type." - IP:".$ip." - Page:".$page." - Username:".$username." - Execution Time:".$execution_time;

                system_generateEdirLog("queries.txt", $message);
            }
        }
    }

    # ----------------------------------------------------------------------------------------------------
    # convinence method - returns number of rows for a query
    # good for doing counts
    # ----------------------------------------------------------------------------------------------------
    function numRowsQuery(&$query, $db_debug = 0)
    {
        $result = $this->query($query);

        return mysql_num_rows($result);
    }

    /*
     * optimized method. because the following query is code optmized in mysql for faster performance
     * (see mysql docs)
     */
    function getRowCount($table, $domain_id = false)
    {
        $sql = "SELECT COUNT(*) as total FROM $table";
        if ($table == "Account" || $table == "Location_1" || $table == "Location_2" || $table == "Location_3" || $table == "Location_4" || $table == "Location_5") { //Account export, force main DB
            $db = db_getDBObject(DEFAULT_DB, true);
        } else {
            if ($domain_id) { //others items export, use domain DB
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                $db = db_getDBObjectByDomainID(defined("SELECTED_DOMAIN_ID") ? SELECTED_DOMAIN_ID : $domain_id,
                    $dbMain);
            } else {
                $db = db_getDBObject(); //front
            }
        }

        if ($r = $db->query($sql)) {
            $row = mysql_fetch_assoc($r);

            return $row["total"];
        }
    }

    function getRowCountSQL($sql)
    {
        $db = db_getDBObject();
        if ($r = $db->query($sql)) {
            $row = mysql_fetch_array($r);

            return $row[0];
        }
    }

    # ----------------------------------------------------------------------------------------------------
    # internal methods
    # ----------------------------------------------------------------------------------------------------
    function _handle_error($query, $db_debug = 0)
    {
        $this->mysql_error = mysql_error($this->link_id);
        $db_debug = max($db_debug, $this->db_debug);
        $to = $this->db_email;
        $from = "db_debug@".$this->SERVER_NAME;
        $subject = "ERROR: http://".$this->SERVER_NAME.$this->PHP_SELF;
        $message = "\n\n$subject\n\n";
        $message .= "Query: $query\n\n";
        if ($this->link_id) {
            $message .= " Errno: ".mysql_errno($this->link_id)."\n";
            $message .= " Error: ".$this->mysql_error."\n";
        }
        $message .= "_SERVER data\n";
        $server_values = [
            'REMOTE_ADDR',
            'REMOTE_PORT',
            'SCRIPT_FILENAME',
            'REQUEST_METHOD',
            'QUERY_STRING',
            'REQUEST_URI',
        ];
        while (list($temp, $name) = each($server_values)) {
            $message .= sprintf("%15s : %s\n", $name, $_SERVER[$name]);
        }
        if ($db_debug) {
            echo "<PRE>$message</PRE>\n";
        } else {
            echo "Database Error. System Administrator has been notified and this problem will be solved as soon as possible. We are sorry for the inconvenience.";
            if ($this->link_id) {
                $this->_mymail($to, $subject, $message, $from);
            }
        }
    }

    function _reset_properties()
    {

        $this->SERVER_NAME = "";
        $this->PHP_SELF = "";
        $this->db_email = "";
        $this->db_host = "";
        $this->db_user = "";
        $this->db_pass = "";
        $this->db_name = "";
        $this->db_debug = "";
        $this->link_id = "";
        $this->result = "";
        $this->select_db_name = "";
    }

    function _mymail($to, $subject, $message, $from, $xheaders = "")
    {
//			$eDirMailerObj = new EDirMailer($to, $subject, $message, $from);
//			if ($xheaders) $eDirMailerObj->setExtraHeaders($xheaders);
//			return $eDirMailerObj->send();
    }

    function getMaxValue($table, $field)
    {
        $sql = "SELECT MAX($field) as max_value FROM $table";
        $r = $this->query($sql);
        $max_value_arr = mysql_fetch_assoc($r);
        if ($max_value_arr) {
            return $max_value_arr["max_value"];
        } else {
            return false;
        }
    }
}

?>
