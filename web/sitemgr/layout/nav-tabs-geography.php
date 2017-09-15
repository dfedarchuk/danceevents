<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/nav-tabs-geography.php
	# ----------------------------------------------------------------------------------------------------

    $_locations = explode(",", EDIR_LOCATIONS);
    $firsLevel = $_locations[0];
?>
    <ul class="nav nav-tabs" role="tablist">
        <li <?=(string_strpos($_SERVER["PHP_SELF"], "geography/index.php") !== false || string_strpos($_SERVER["PHP_SELF"], "geography/terms/") !== false ? "class=\"active\"" : "")?>>
            <a role="tab" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/"?>"><?=system_showText(LANG_SITEMGR_GEO_LOCATIONSETTINGS);?></a>
        </li>
        <li <?=(string_strpos($_SERVER["PHP_SELF"], "geography/locations/") !== false ? "class=\"active\"" : "")?>>
            <a role="tab" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/locations/location_$firsLevel/index.php"?>"><?=system_showText(LANG_SITEMGR_GEO_LOCATIONDATA);?></a>
        </li>
        <li <?=(string_strpos($_SERVER["PHP_SELF"], "geography/language/") !== false ? "class=\"active\"" : "")?>>
            <a role="tab" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/language/"?>"><?=system_showText(LANG_SITEMGR_GEO_LANGUAGE)?></a>
        </li>
    </ul>
