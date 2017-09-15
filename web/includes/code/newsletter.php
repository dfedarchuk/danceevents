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
	# * FILE: /includes/code/newsletter.php
	# ----------------------------------------------------------------------------------------------------
   
    $showNewsletter = false;
    
    if (MAIL_APP_FEATURE == "on") {
        
        setting_get("arcamailer_customer_listid", $edir_list_id);
        setting_get("arcamailer_enable_list", $edir_enable_list);
        setting_get("arcamailer_list_label", $edir_list_label);
        
        if ($edir_enable_list && $edir_list_id) {
            $showNewsletter = true;
            $signupLabel = $edir_list_label ? $edir_list_label : LANG_ARCAMAILER_SIGNUP;
            
            if ($_COOKIE["hideNewsletter"] == "1") {
                $showNewsletter = false;
            }
        }
    }