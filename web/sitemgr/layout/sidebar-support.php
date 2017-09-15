<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-support.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="sidebar togglepush" id="sidebar" role="navigation">

        <div class="main-sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/support/index.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/"?>"><i class="icon-ruler9"></i>System Settings</a>
                </li>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/support/reset.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/reset.php"?>"><i class="icon-repair6"></i>Reset Settings</a>
                </li>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/support/crontab.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/crontab.php"?>"><i class="icon-stocks7"></i>Crontab</a>
                </li>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/support/domain.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/domain.php"?>"><i class="icon-uniE603"></i>Domains</a>
                </li>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/support/cronlog.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/cronlog.php"?>"><i class="icon-line31"></i>Cron Log</a>
                </li>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/support/import.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/import.php"?>"><i class="icon-arrow429"></i>Import</a>
                </li>
                <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "/support/alias.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/alias.php"?>"><i class="icon-folder56"></i>Alias Options</a>
                </li>
            </ul>
        </div>
        
    </div>