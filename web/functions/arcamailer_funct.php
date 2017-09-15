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
	# * FILE: /functions/arcamailer_funct.php
	# ----------------------------------------------------------------------------------------------------

    function arcamailer_curlRequest($postFields, $getInfo = "") {
        $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        $ch = curl_init("http://arcamailer.com/api/api.php".($getInfo ? $getInfo : ""));
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        if (!$getInfo) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $output = curl_exec($ch);

        $return = unserialize($output);
        
        return $return;
    }

    function arcamailer_addSubscriber($array, &$success, $accID = 0) {
        
        setting_get("arcamailer_customer_listid", $edir_list_id);
        
        $postFields = array();
        $postFields["action"] = "addSubscriber";
        $postFields["listID"] = $edir_list_id;
        $postFields["subscriber_name"] = $array["name"];
        $postFields["subscriber_email"] = $array["email"];
        $postFields["subscriber_type"] = $array["type"];

        $return = arcamailer_curlRequest($postFields);
        
        if ($return["success"] == 1) {
            
            //Log
            $postFields["account_id"] = $accID;
            arcamailer_subscriberLog("add", $postFields);
            
            $success = true;
            return system_showText(LANG_ARCAMAILER_SUBSCRIBEDONE);
            
        } else {
            
            $success = false;
            return $return["message"];
            
        }
        
    }
    
    function arcamailer_Unsubscribe($email, $accID = 0) {
        
        setting_get("arcamailer_customer_listid", $edir_list_id);
        
        $postFields = array();
        $postFields["action"] = "UnSubscriber";
        $postFields["listID"] = $edir_list_id;
        $postFields["email"] = $email;
        $postFields["subscriber_email"] = $email;

        $return = arcamailer_curlRequest($postFields);

        //Log
        $postFields["account_id"] = $accID;
        arcamailer_subscriberLog("delete", $postFields);
                        
    }
    
    function arcamailer_checkSubscriber() {
        
        setting_get("arcamailer_customer_listid", $edir_list_id);

        if ($edir_list_id) {

            $accID = sess_getAccountIdFromSession();
            $accountObj = new Account($accID);
            $contactObj = new Contact($accID);
            
            if ($accountObj->getString("newsletter") == "y") {
                
                setting_get("arcamailer_customer_listid", $edir_list_id);
                $query = "?action=getSubscriberInfo&listID=$edir_list_id&email=".$contactObj->getString("email")."";

                $return = arcamailer_curlRequest("", $query);

                //user not subscribed anymore
                if ($return["success"] != 1) {
                    $accountObj->setString("newsletter", "n");
                    $accountObj->save();
                    
                    $infoLog["account_id"] = $accID;
                    $infoLog["subscriber_email"] = $contactObj->getString("email");
                    $infoLog["listID"] = $edir_list_id;
                    arcamailer_subscriberLog("delete", $infoLog);
                }
            }

        }

    }
    
    function arcamailer_subscriberLog($action, $info) {
        
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        
        if ($action == "add") {
            
            $sql = "INSERT INTO MailApp_Subscribers (
                                        account_id, 
                                        subscriber_name, 
                                        subscriber_email, 
                                        subscriber_type, 
                                        list_id
                                        ) VALUES (
                                        ".db_formatNumber($info["account_id"]).",
                                        ".db_formatString($info["subscriber_name"]).",
                                        ".db_formatString($info["subscriber_email"]).",
                                        ".db_formatString($info["subscriber_type"]).",
                                        ".db_formatString($info["listID"]).")";
            $dbObj->query($sql);
            
        } elseif ($action == "delete") {
            
            $sql = "DELETE FROM MailApp_Subscribers WHERE 
                                                    account_id = ".db_formatNumber($info["account_id"])." AND 
                                                    subscriber_email = ".db_formatString($info["subscriber_email"])." AND
                                                    list_id = ".db_formatString($info["listID"])."";
            $dbObj->query($sql);
            
        }
        
    }
     

?>