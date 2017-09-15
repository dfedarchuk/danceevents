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
    # * FILE: /classes/class_searchMetaTags.php
    # ----------------------------------------------------------------------------------------------------

    class SearchMetaTag  extends Handle {

        ##################################################
        # PRIVATE
        ##################################################

        var $id;
        var $name;
        var $code;
        
        function SearchMetaTag($var='') {
            
            if ($var) {
                $dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
                $sql = "SELECT * FROM Setting_Search_Tag WHERE name = '$var'";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            } else {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
                $sql = "SELECT * FROM Setting_Search_Tag ORDER BY id";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            }    
			
        }
        
        function makeFromRow($row='') {
            
            $this->id                = ($row["id"])                    ? $row["id"]                : ($this->id                    ? $this->id                :  '');
            $this->name              = ($row["name"])                  ? $row["name"]              : ($this->name                  ? $this->name              :  '');
            $this->value             = ($row["value"])                 ? $row["value"]             : ($this->value                 ? $this->value             :  '');

        }
        
        function Save($update = true) {
            
            $this->prepareToSave();
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
            
            if ($update) {
                
                $sql = "UPDATE Setting_Search_Tag SET"
                    . " value      = $this->value"
                    . " WHERE name = $this->name";

                $dbObj->query($sql);
                
            } else {
                
                $sql = "INSERT INTO Setting_Search_Tag"
                    . " (name,"
                    . " value)"
                    . " VALUES"
                    . " ($this->name,"
                    . " $this->value)";
                
                $dbObj->query($sql);
                
            }
            
            $this->prepareToUse();
            
        }
        
        function isSetField() {
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
            
            $sql    = "SELECT * FROM Setting_Search_Tag WHERE name='$this->name'";
			
            $result = $dbObj->query($sql);
            
            if (mysql_fetch_array($result)) {
			    return true;
            }
   
        }
		
		function isSetFieldByArray($array) {
            
			if (is_array($array)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);

				$aux_where = implode(",",$array);

				$sql = "SELECT name, value FROM Setting_Search_Tag WHERE name IN (".$aux_where.")";

				$result = $dbObj->query($sql);
				if (mysql_num_rows($result)) {
					unset($aux_return);
					$aux_return = array();
					while ($row = mysql_fetch_assoc($result)) {
						$aux_return[] = $row["value"];
					}
					return $aux_return;
				} else {
					return false;
				}
				
			}
   
        }	
		
        function Delete() {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

            $sql = "DELETE FROM Setting_Search_Tag WHERE id = '$this->id'";
            $dbObj->query($sql);

        }

        ##################################################
        # PUBLIC
        ##################################################
    
    
    }
?>