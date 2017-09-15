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
	# * FILE: /conf/accountpermission.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION SECTION AMOUNT
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_SECTION", 8);

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION ID
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_SITES", 1);
	define("SITEMGR_PERMISSION_ACCOUNTS", 2);
	define("SITEMGR_PERMISSION_CONTENT", 4);
	define("SITEMGR_PERMISSION_ACTIVITY", 8);
	define("SITEMGR_PERMISSION_PROMOTE", 16);
	define("SITEMGR_PERMISSION_DESIGN", 32);
	define("SITEMGR_PERMISSION_CONFIG", 64);
	define("SITEMGR_PERMISSION_MOBILE", 128);
        
	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION (ID,LABEL_SECTION,LABEL_SPAN,FOLDERS)
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_0", SITEMGR_PERMISSION_SITES.",".ucfirst(system_showText(LANG_SITEMGR_DOMAIN_PLURAL)).",".(system_showText(LANG_SITEMGR_PERM_CONTENT_TIP)).",sites");
	define("SITEMGR_PERMISSION_1", SITEMGR_PERMISSION_ACCOUNTS.",".ucfirst(system_showText(LANG_SITEMGR_ACCOUNT_PLURAL)).",,account");
	define("SITEMGR_PERMISSION_2", SITEMGR_PERMISSION_CONTENT.",".ucfirst(system_showText(LANG_SITEMGR_CONTENT_MANAGER)).",".(system_showText(LANG_SITEMGR_PERM_SETTINGS_TIP)).",content");
	define("SITEMGR_PERMISSION_3", SITEMGR_PERMISSION_ACTIVITY.",".ucfirst(system_showText(LANG_SITEMGR_ACTIVITY)).",,activity");
	define("SITEMGR_PERMISSION_4", SITEMGR_PERMISSION_PROMOTE.",".ucfirst(system_showText(LANG_SITEMGR_PROMOTE)).",".(system_showText(LANG_SITEMGR_PERM_LOCATION_TIP)).",promote");
	define("SITEMGR_PERMISSION_5", SITEMGR_PERMISSION_DESIGN.",".ucfirst(system_showText(LANG_SITEMGR_DESIGN_CUSTOM)).",,design");
	define("SITEMGR_PERMISSION_6", SITEMGR_PERMISSION_CONFIG.",".ucfirst(system_showText(LANG_SITEMGR_CONFIG)).",".(system_showText(LANG_SITEMGR_PERM_ACCOUNT_TIP)).",configuration");
	define("SITEMGR_PERMISSION_7", SITEMGR_PERMISSION_MOBILE.",".ucfirst(system_showText(LANG_SITEMGR_MOBILE_APPS)).",".(system_showText(LANG_SITEMGR_PERM_REVENUE_TIP)).",mobile");
	

?>