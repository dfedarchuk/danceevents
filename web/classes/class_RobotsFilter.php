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
    # * FILE: /classes/class_RobotsFilter.php
    # ----------------------------------------------------------------------------------------------------

    class RobotsFilter extends Handle {

        var $id;
        var $value;

        function RobotsFilter($var='') {
            if (is_numeric($var) && ($var)) {
                $db = db_getDBObject(DEFAULT_DB,true);
                $sql = "SELECT * FROM RobotsFilter WHERE id = $var";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            } else {
                if (!is_array($var)) {
                    $var = array();
                }
                $this->makeFromRow($var);
            }
        }

        function makeFromRow($row='') {
            if ($row['id']) $this->id = $row['id'];
            else if (!$this->id) $this->id = 0;
            if ($row['value']) $this->value = $row['value'];
            else if (!$this->value) $this->value = 0;
        }

        function Save() {
            $this->prepareToSave();
            $dbObj = db_getDBObject(DEFAULT_DB,true);
            if ($this->id) { 
                $sql  = "UPDATE RobotsFilter SET"
                    . " value = $this->value,"
                    . " WHERE id = $this->id";
                $dbObj->query($sql);
            } else {
                $sql = "INSERT INTO RobotsFilter"
                    . " (value)"
                    . " VALUES"
                    . " ($this->value)";
                $dbObj->query($sql);
                $this->id = mysql_insert_id($dbObj->link_id);
            }
            $this->prepareToUse();
        }

        function Delete() {

            $dbObj = db_getDBObject(DEFAULT_DB,true);
            $sql = "DELETE FROM RobotsFilter WHERE id = $this->id";
            $dbObj->query($sql);

        }
        
        function Clear() {
        
            $dbObj = db_getDBObject(DEFAULT_DB,true);
            $sql = "DELETE FROM RobotsFilter WHERE 1";
            $dbObj->query($sql);
            
        }

        function retrieveAll() {
			if (!defined("ROBOTFILTER_ALL_IPS")) {
				$dbObj = db_getDBObject(DEFAULT_DB,true);
				$sql = "SELECT value FROM RobotsFilter WHERE 1";
				$results = $dbObj->query($sql);
				while ($row = mysql_fetch_array($results)) $robots[] = $row["value"];
				define("ROBOTFILTER_ALL_IPS", serialize($robots));
			} else {
				$robots = unserialize(ROBOTFILTER_ALL_IPS);
			}
            if ($robots) return $robots;
            else return false;
        }
        
        function getAccess($ip) {
            $robots = $this->retrieveAll();
			$deny = array();
            if ($robots) {           
                foreach ($robots as $robot) {
                    $robot_node = explode(".", $robot);
                    $ip_node = explode(".", $ip);
                    if ( $robot_node[0] == $ip_node[0] && $robot_node[1] == "*" ) $deny[] = 1;  
                    else if ( $robot_node[0] == $ip_node[0] && $robot_node[1] == $ip_node[1] && $robot_node[2] == "*" ) $deny[] = 1;  
                    else if ( $robot_node[0] == $ip_node[0] && $robot_node[1] == $ip_node[1] && $robot_node[2] == $ip_node[2] && $robot_node[3] == "*" ) $deny[] = 1;  
                    else if ( $robot_node[0] == $ip_node[0] && $robot_node[1] == $ip_node[1] && $robot_node[2] == $ip_node[2] && $robot_node[3] == $ip_node[3] && $robot_node[4] == "*" ) $deny[] = 1;  
                    else if ( $robot_node[0] == $ip_node[0] && $robot_node[1] == $ip_node[1] && $robot_node[2] == $ip_node[2] && $robot_node[3] == $ip_node[3] && $robot_node[4] == $ip_node[4] ) $deny[] = 1;
                }
            } else $access = true;
            if (in_array(1, $deny)) $access = false;
            else $access = true; 
            return $access;
        }

    }

?>
