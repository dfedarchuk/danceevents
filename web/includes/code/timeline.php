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
	# * FILE: /includes/code/timeline.php
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);
       
    if ($where == "general") {
        $whereStr = "item_type != 'listing' AND item_type != 'promotion' AND item_type != 'banner' AND item_type != 'event' AND item_type != 'classified' AND item_type != 'article'";
    } elseif ($where == "listing") {
        $whereStr = "item_type = 'listing'";
    } elseif ($where == "promotion") {
        $whereStr = "item_type = 'promotion'";
    } elseif ($where == "banner") {
        $whereStr = "item_type = 'banner'";
    } elseif ($where == "event") {
        $whereStr = "item_type = 'event'";
    } elseif ($where == "classified") {
        $whereStr = "item_type = 'classified'";
    } elseif ($where == "article") {
        $whereStr = "item_type = 'article'";
    }
    
    $whereStrPerm = array();
    
    if (!permission_hasSMPermSection(SITEMGR_PERMISSION_CONTENT)) {
        $whereStrPerm[] = "item_type != 'listing' AND item_type != 'promotion' AND item_type != 'banner' AND item_type != 'event' AND item_type != 'classified' AND item_type != 'article' AND item_type != 'claim'";
    }
    if (!permission_hasSMPermSection(SITEMGR_PERMISSION_ACTIVITY)) {
        $whereStrPerm[] = "item_type != 'review' AND item_type != 'lead' AND item_type != 'comment' AND item_type != 'reply' AND item_type != 'transaction' AND item_type != 'invoice' AND item_type != 'claim'";
    }
    if (!permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) {
        $whereStrPerm[] = "item_type != 'account'";
    }
    
    if (count($whereStrPerm)) {
        $whereStr = ($whereStr ? $whereStr." AND " : "").implode(" AND ", $whereStrPerm);
    }
    
    $pageObj = new pageBrowsing("Timeline", $screen, TIMELINE_RESULTS_PER_PAGE, "datetime DESC", false, false, $whereStr);
	$timeline = $pageObj->retrievePage();