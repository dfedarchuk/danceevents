<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/geography/locations/ajax_load_locations.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../../conf/loadconfig.inc.php");
    
    if (file_exists(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/configuration/geography/locations/load_location.php")) {
        include_once(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/configuration/geography/locations/load_location.php");
    }