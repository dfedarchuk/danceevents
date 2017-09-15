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
	# * FILE: /functions/log_funct.php
	# ----------------------------------------------------------------------------------------------------

    function log_addCronRecord($link, $type, $message, $update = false, &$log_id, $finished = false, $time = "") {
        if ((defined("ENABLE_CRON_LOG") && ENABLE_CRON_LOG)) {
            if ($update) {
                $sql = "UPDATE Cron_Log SET history = CONCAT(history, '\n$message') ".($finished ? ", finished = 'y', time = '$time'" : "")." WHERE id = ".($log_id ? $log_id : 0)."";
                mysql_query($sql, $link);
            } else {
                $sql = "INSERT INTO Cron_Log (domain_id, cron, date, history) VALUES (".SELECTED_DOMAIN_ID.", '$type', NOW(), '$message')";
                mysql_query($sql, $link);
                $log_id = mysql_insert_id($link);
            }
        }
    }
?>