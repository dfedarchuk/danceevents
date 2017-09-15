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
	# * FILE: /functions/todo_funct.php
	# ----------------------------------------------------------------------------------------------------
    
    /**
    * Check if there is any To Do Item left.
    *
    * @param string $itemDone
    * @param boolean $showMessage
    */
    function todo_itensDone($itemDone = "", &$showMessage = false) {
        
        $dbObj = db_getDBObJect(DEFAULT_DB, true);
        $dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);
        $sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%' AND `value` = 'yes'";
        $result = $dbObjSecond->query($sql);
        $showGetStarted = mysql_num_rows($result);
        unset($dbObj, $dbObjSecond);
        
        if (!DEMO_LIVE_MODE && !$_SESSION[SESS_SM_ID]) {
            $showGetStartedDemo = true;
        } else {
            $showGetStartedDemo = false;
        }
        
        if (($showGetStarted <= 0 || !$showGetStartedDemo)) {
            if ($itemDone) {
                $showMessage = true;
            } else {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS);
                exit;
            }
        }
        
    }
    
    /**
    * Updates To Do Items percentage
    */
    function todo_updatePercentage() {
        
        $dbObj = db_getDBObJect(DEFAULT_DB, true);
        $dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);
        
        $sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%'";
        $result = $dbObjSecond->query($sql);
        $totalItens = mysql_num_rows($result);
        
        $sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%' AND `value` = 'done'";
        $result = $dbObjSecond->query($sql);
        $doneItens = mysql_num_rows($result);
        
        if ($totalItens) {
            $perc = round((int)($doneItens * 100) / $totalItens);

            if (!setting_set("percentage_todo", $perc)) {
                setting_new("percentage_todo", $perc);
            }
        }
        
        return $perc;
        
    }
    
    /**
    * Update To Do Item and redirect user.
    *
    * @param string $item
    */
    function todo_updateItem($item, $ajax = false) {
        
        setting_get($item, $itemValue);
        
        if ($itemValue == "yes") {
            
            if (!setting_set($item, "done")) {
                if (!setting_new($item, "done")) {
                    $error = true;
                }
            }
            
            $perc = todo_updatePercentage();
            
            if (!$error && !$ajax) {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/getstarted.php?stepDone=1");
                exit;
            } elseif (!$error && $ajax) {
                return $perc;
            }
            
        } else {
            return false;
        }
        
    }
    
    /**
    * Update To Do Items after sitemgr first login.
    */
    function todo_updateItemsFirstLogin() {
        
        setting_set("todo_locations", "yes");

        setting_set("todo_email", "yes");

        setting_set("todo_pricing", "yes");

        setting_set("todo_settings", "yes");
        
        setting_set("sitemgr_first_login", "no");
        
    }

?>