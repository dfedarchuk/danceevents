<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/sidebar-dashboard.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="sidebar togglepush" id="sidebar" role="navigation">

        <div class="main-sidebar nano">
            <ul class="nav nav-pills nav-stacked nano-content">
                
                <li id="navDashboard" class="<?=(string_strpos($_SERVER["PHP_SELF"], "index.php") !== false ? "active" : "")?>">
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/"><i class="icon-dashboard5"></i><?=system_showText(LANG_SITEMGR_DASHBOARD);?></a>
                </li>
                
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONTENT)) { ?>
                <li id="navContent" >
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=LISTING_FEATURE_FOLDER?>/"><i class="icon-document49"></i><?=system_showText(LANG_SITEMGR_CONTENT_MANAGER);?></a>
                </li>
                <? } ?>
                
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACTIVITY)) { ?>
                <li id="navActivity" >
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/activity/traffic/"><i class="icon-connecting7"></i><?=system_showText(LANG_SITEMGR_ACTIVITY);?></a>
                </li>
                <? } ?>
                
                 <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PROMOTE)) { ?>
                <li id="navPromote" >
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/promote/helpme/"><i class="icon-uniE601"></i><?=system_showText(LANG_SITEMGR_PROMOTE);?></a>
                </li>
                <? } ?>
                
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_DESIGN)) { ?>
                <li id="navDesign" >
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/design/page-editor/"><i class="icon-paint14"></i><?=system_showText(LANG_SITEMGR_DESIGN_CUSTOM);?></a>
                </li>
                <? } ?>
                
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONFIG)) { ?>
                <li id="navConfig" >
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/configuration/basic-information/"><i class="icon-repair6"></i><?=system_showText(LANG_SITEMGR_CONFIG);?></a>
                </li>
                <? } ?>
                
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_MOBILE)) { ?>
                <li id="navAppbuilder" >
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/"><i class="icon-mobile143"></i><?=system_showText(LANG_SITEMGR_MOBILE_APPS);?></a>
                </li>
                <? } ?>

                <? if (BRANDED_PRINT == "on") { ?>
                <li class="branding-message">
                    <?=system_showText(LANG_POWEREDBY)?> <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank" rel="nofollow">eDirectory Cloud Service</a>&trade; <?=VERSION?>. &copy; Arca Solutions Inc.
                </li>
                <? } ?>
            </ul>
        </div>

    </div>