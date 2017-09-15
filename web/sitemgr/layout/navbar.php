<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------

    /*
	 * Get Domains
	 */
	$domainDropDown = domain_getDropDown(DEFAULT_URL, $_SERVER["REQUEST_URI"], $_SERVER["QUERY_STRING"], SELECTED_DOMAIN_ID);
?>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <div class="navbar-header navbar-left">

            <? if (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false) { ?>
            <a  id="navBrand" class="<?=(sess_isSitemgrLogged() && string_strpos($_SERVER["PHP_SELF"], "resetpassword.php") === false && string_strpos($_SERVER["PHP_SELF"], "setlogin.php") === false ? "admin-logo" : "admin-logo")?>" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?>>
                <img src="<?=system_getHeaderLogoSitemgr();?>" <?=(trim(EDIRECTORY_TITLE) ? "alt=\"".EDIRECTORY_TITLE."\"" : "")?> />
            </a>
            <? } ?>

            <? if (sess_isSitemgrLogged() && string_strpos($_SERVER["PHP_SELF"], "registration.php") === false && string_strpos($_SERVER["PHP_SELF"], "resetpassword.php") === false && string_strpos($_SERVER["PHP_SELF"], "setlogin.php") === false) { ?>
            <span class="btn btn-navbar sidebar-control">
                <i class="icon-uniE605"></i>
            </span>
            <? } ?>

            <? if ($domainDropDown && string_strpos($_SERVER["PHP_SELF"], "registration.php") === false && string_strpos($_SERVER["PHP_SELF"], "forgot.php") === false && string_strpos($_SERVER["PHP_SELF"], "resetpassword.php") === false && string_strpos($_SERVER["PHP_SELF"], "setlogin.php") === false) { ?>
            <span class="dropdown">
                <a href="#" role="button" data-toggle="dropdown" class="btn btn-navbar">
                    <small class="icon-expand22"></small>
                </a>
                <ul class="dropdown-menu domain-control" role="menu" aria-labelledby="dLabel">
                    <li class="heading"><?=system_showText(str_replace("[site]", "<i>".$domainDropDown[SELECTED_DOMAIN_ID]["name"]."</i>", LANG_SITEMGR_DOMAINS_TIP))?></li>
                    <li class="divider"></li>
                    <? foreach ($domainDropDown as $domainItem) { ?>
                    <li role="presentation" <?=($domainItem["id"] == SELECTED_DOMAIN_ID ? "class=\"active\"" : "");?> data-id="<?=$domainItem["id"];?>" <?=($domainItem["disabled"] ? "" : $domainItem["onclick"])?>>
                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                            <?=$domainItem["name"];?>
                        </a>
                    </li>
                    <? } ?>
                </ul>
            </span>
            <? } ?>
            
        </div>

        <? if (sess_isSitemgrLogged() && string_strpos($_SERVER["PHP_SELF"], "registration.php") === false && string_strpos($_SERVER["PHP_SELF"], "resetpassword.php") === false && string_strpos($_SERVER["PHP_SELF"], "setlogin.php") === false) { ?>
         
        <div class="navbar-slide <?=($_SESSION["is_arcalogin"] ? "extended" : "")?>" id="navUser">            
            <span class="navbar-control">               
                <i class="icon-ion-ios7-gear-outline"></i>
            </span>
            <ul class="nav navbar-nav">
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SITES)) { ?>
                <li id="navUserSites">
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/sites/">
                        <i class="icon-earth94"></i><?=system_showText(LANG_SITEMGR_NAVBAR_DOMAIN_PLURAL);?>
                    </a>
                </li>
                <? } ?>
                <li id="navUserAccounts">
                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/sponsor/">
                        <i class="icon-ion-person-stalker"></i><?=system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS);?>
                    </a>
                    <? } else { ?>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/myaccount.php">
                        <i class="icon-ion-person-stalker"></i><?=system_showText(LANG_MENU_ACCOUNT);?>
                    </a>
                    <? } ?>
                </li>
                <li id="navUserFaq">
                    <a href="http://support.edirectory.com" target="_blank">
                        <i class="icon-help10"></i><?=system_showText(LANG_SITEMGR_SUPPORT);?>
                    </a>
                </li>  
                <? if ($_SESSION["is_arcalogin"]) { ?> 
                <li>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/">
                        <i class="icon-ruler9"></i>Config Checker
                    </a>   
                </li>                     
            <? } ?>              
                <li>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/logout.php">
                        <i class="icon-ion-log-in"></i><?=system_showText(LANG_SITEMGR_MENU_LOGOUT)?>
                    </a>
                </li>
            </ul>
        </div>
        <? } ?>
    </div>