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
	# * FILE: /includes/code/import_settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
	
	// Default CSS class for message
	$message_style = "success";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		//LISTING
		if ($import_sameaccount==1) {
			if (!is_numeric($account_id)) {
				$actions[] = "&#149;&nbsp;".system_showText(ucfirst(LANG_LISTING_FEATURE_NAME_PLURAL)." - ".LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED);
				$message_style = "warning";
				$error_sameaccount = true;
			} else {
				if(!setting_set("import_sameaccount", $import_sameaccount))
					if(!setting_new("import_sameaccount", $import_sameaccount))
						$error = true;
				if(!setting_set("import_account_id", $account_id))
					if(!setting_new("import_account_id", $account_id))
						$error = true;
			}
		} else {
			if(!setting_set("import_sameaccount", $import_sameaccount))
				if(!setting_new("import_sameaccount", $import_sameaccount))
					$error = true;
			if(!setting_set("import_account_id", ""))
				if(!setting_new("import_account_id", ""))
					$error = true;
		}

		if(!setting_set("import_from_export", $import_from_export))
			if(!setting_new("import_from_export", $import_from_export))
				$error = true;

		if(!setting_set("import_update_listings", $import_update_listings))
			if(!setting_new("import_update_listings", $import_update_listings))
				$error = true;
            
        if(!setting_set("import_update_friendlyurl", $import_update_friendlyurl))
			if(!setting_new("import_update_friendlyurl", $import_update_friendlyurl))
				$error = true;

		if(!setting_set("import_featured_categs", $import_featured_categs))
			if(!setting_new("import_featured_categs", $import_featured_categs))
				$error = true;

		if(!setting_set("import_enable_listing_active", $import_enable_listing_active))
			if(!setting_new("import_enable_listing_active", $import_enable_listing_active))
				$error = true;

		if(!setting_set("import_defaultlevel", $import_defaultlevel))
			if(!setting_new("import_defaultlevel", $import_defaultlevel))
				$error = true;

		//EVENT
		if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
			if ($import_sameaccount_event==1) {
				if (!is_numeric($account_id_event)) {
					$actions[] = "&#149;&nbsp;".system_showText(ucfirst(LANG_EVENT_FEATURE_NAME_PLURAL)." - ".LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED);
					$message_style = "warning";
					$_GET["type"] = "event";
					$error_sameaccount_event = true;
				} else {
					if(!setting_set("import_sameaccount_event", $import_sameaccount_event))
						if(!setting_new("import_sameaccount_event", $import_sameaccount_event))
							$error = true;
					if(!setting_set("import_account_id_event", $account_id_event))
						if(!setting_new("import_account_id_event", $account_id_event))
							$error = true;
				}
			} else {
				if(!setting_set("import_sameaccount_event", $import_sameaccount_event))
					if(!setting_new("import_sameaccount_event", $import_sameaccount_event))
						$error = true;
				if(!setting_set("import_account_id_event", ""))
					if(!setting_new("import_account_id_event", ""))
						$error = true;
			}

			if(!setting_set("import_from_export_event", $import_from_export_event))
				if(!setting_new("import_from_export_event", $import_from_export_event))
					$error = true;

			if(!setting_set("import_update_events", $import_update_events))
				if(!setting_new("import_update_events", $import_update_events))
					$error = true;
                
            if(!setting_set("import_update_friendlyurl_event", $import_update_friendlyurl_event))
				if(!setting_new("import_update_friendlyurl_event", $import_update_friendlyurl_event))
					$error = true;

			if(!setting_set("import_featured_categs_event", $import_featured_categs_event))
				if(!setting_new("import_featured_categs_event", $import_featured_categs_event))
					$error = true;

			if(!setting_set("import_enable_event_active", $import_enable_event_active))
				if(!setting_new("import_enable_event_active", $import_enable_event_active))
					$error = true;

			if(!setting_set("import_defaultlevel_event", $import_defaultlevel_event))
				if(!setting_new("import_defaultlevel_event", $import_defaultlevel_event))
					$error = true;
		} else {
			$error_sameaccount_event = false;
		}

		if (!$error) {
			if (!$error_sameaccount && !$error_sameaccount_event) $actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_IMPORT_INFORMATIONWASCHANGED);
		} else {
			$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
			$message_style = "warning";
		}
		if($actions) {
			$message_imports .= implode("<br />", $actions);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	
	//LISTING
	setting_get("import_sameaccount", $import_sameaccount);
	if ($import_sameaccount) $import_sameaccount = "checked";

	setting_get("import_account_id", $account_id);

	setting_get("import_from_export", $import_from_export);
	if ($import_from_export) $import_from_export = "checked";

	setting_get("import_enable_listing_active", $import_enable_listing_active);
	if ($import_enable_listing_active) $import_enable_listing_active = "checked";

	setting_get("import_defaultlevel", $import_defaultlevel);

	setting_get("import_update_listings", $import_update_listings);
	if ($import_update_listings) $import_update_listings = "checked";
    
    setting_get("import_update_friendlyurl", $import_update_friendlyurl);
	if ($import_update_friendlyurl) $import_update_friendlyurl = "checked";

	setting_get("import_featured_categs", $import_featured_categs);
	if ($import_featured_categs) $import_featured_categs = "checked";
	
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
		//EVENT
		setting_get("import_sameaccount_event", $import_sameaccount_event);
		if ($import_sameaccount_event) $import_sameaccount_event = "checked";

		setting_get("import_account_id_event", $account_id_event);

		setting_get("import_from_export_event", $import_from_export_event);
		if ($import_from_export_event) $import_from_export_event = "checked";

		setting_get("import_enable_event_active", $import_enable_event_active);
		if ($import_enable_event_active) $import_enable_event_active = "checked";

		setting_get("import_defaultlevel_event", $import_defaultlevel_event);

		setting_get("import_update_events", $import_update_events);
		if ($import_update_events) $import_update_events = "checked";
        
        setting_get("import_update_friendlyurl_event", $import_update_friendlyurl_event);
        if ($import_update_friendlyurl_event) $import_update_friendlyurl_event = "checked";

		setting_get("import_featured_categs_event", $import_featured_categs_event);
		if ($import_featured_categs_event) $import_featured_categs_event = "checked";
	}

?>