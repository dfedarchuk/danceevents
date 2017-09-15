<?php

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
    # * FILE: /frontend/widgets/navigation-left-logo-plus-social.php
    # ----------------------------------------------------------------------------------------------------

    //Links to twitter, facebook and linkedin
    setting_get("twitter_account", $setting_twitter_link);
    setting_get("setting_facebook_link", $setting_facebook_link);
    setting_get("setting_linkedin_link", $setting_linkedin_link);
    setting_get("setting_instagram_link", $setting_instagram_link);
    setting_get("setting_googleplus_link", $setting_googleplus_link);
    setting_get("setting_pinterest_link", $setting_pinterest_link);

    if (!$_GET['userperm']) { ?>
        <!-- Header and navbar with Responsive features -->
        <header class="navbar navbar-static-top navbar-logo-plus-social">
            <div id="navbarMenu" class="navbar-default">
                <div class="header-brand">
                    <div class="container">

                        <nav class="navbar">
                            <div class="navbar-brand">
                                <a href="<?=DEFAULT_URL?>" target="_parent" title="<?=EDIRECTORY_TITLE?>">
                                    <img class="brand-logo" alt="<?=EDIRECTORY_TITLE?>" src="<?=system_getHeaderLogo(false);?>">
                                </a>
                            </div>

                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".main-navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="navbar-label">Menu</span>
                                </button>
                                <button type="button" class="navbar-toggle search-toggle" data-toggle="collapse"
                                        data-target="#search-responsive" id="open-search-responsive" style="display: none;">
                                    <span class="sr-only">Open Search</span>
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse main-navbar" id="main-navbar">
                                <ul class="nav navbar-nav navbar-right hidden-xs">

                                    <?php
                                    if ($setting_twitter_link ||
                                        $setting_facebook_link ||
                                        $setting_linkedin_link ||
                                        $setting_instagram_link ||
                                        $setting_googleplus_link ||
                                        $setting_pinterest_link
                                    ) { ?>
                                        <?php if ($setting_facebook_link) { ?>
                                            <li class="inline-sm">
                                                <a target="_blank" href="<?=$setting_facebook_link?>" class="social-links"><span class="fa fa-facebook"></span> <span class="sr-only">Facebook</span></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_linkedin_link) { ?>
                                            <li class="inline-sm">
                                                <a target="_blank" href="<?=$setting_linkedin_link?>" class="social-links"><span class="fa fa-linkedin"></span> <span class="sr-only">Linkedin</span></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_twitter_link) { ?>
                                            <li class="inline-sm">
                                                <a target="_blank" href="<?=$setting_twitter_link?>" class="social-links"><span class="fa fa-twitter"></span> <span class="sr-only">Twitter</span></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_instagram_link) { ?>
                                            <li class="inline-sm">
                                                <a target="_blank" href="<?=$setting_instagram_link?>" class="social-links"><span class="fa fa-instagram"></span> <span class="sr-only">Instagram</span></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_googleplus_link) { ?>
                                            <li class="inline-sm">
                                                <a target="_blank" href="<?=$setting_googleplus_link?>" class="social-links"><span class="fa fa-google"></span> <span class="sr-only">Google Plus</span></a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_pinterest_link) { ?>
                                            <li class="inline-sm">
                                                <a target="_blank" href="<?=$setting_pinterest_link?>" class="social-links"><span class="fa fa-pinterest"></span> <span class="sr-only">Pinterest</span></a>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php if (sess_getAccountIdFromSession()) { ?>
                                        <li class="dropdown">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false"><?=system_showText(LANG_LABEL_WELCOME)." ".( (trim($contactWelcome["first_name"])) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"] : "" )?>
                                                <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <?php if ($contactWelcome["has_profile"] == "y" && SOCIALNETWORK_FEATURE == "on") { ?>
                                                    <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME?>"><?=system_showText(LANG_LABEL_PROFILE)?></a></li>
                                                    <li><a href="<?=DEFAULT_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                                    <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php"?>"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS);?></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a> </li>
                                                    <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                                <?php } ?>
                                            </ul>

                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="<?=DEFAULT_URL?>/profile/add.php"><?=(LANG_BUTTON_SIGNUP)?></a>
                                        </li>

                                        <li>
                                            <a href="<?=DEFAULT_URL?>/profile/login.php"><?=(LANG_BUTTON_LOGIN)?></a>
                                        </li>
                                    <?php } ?>

                                    <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>" class="btn btn-success"><?=system_showText(LANG_LABEL_SPONSORAREA)?></a></li>

                                </ul>

                                <div class="visible-xs-block">
                                    <? include(EDIRECTORY_ROOT."/frontend/header_menu.php"); ?>
                                </div>

                                <ul class="nav navbar-nav navbar-login">
                                    <?php if (sess_getAccountIdFromSession()) { ?>
                                        <li class="dropdown">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false"><?=system_showText(LANG_LABEL_WELCOME)." ".( (trim($contactWelcome["first_name"])) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"] : "" )?>
                                                <span class="caret"></span></a>

                                            <ul class="dropdown-menu" role="menu">
                                                <?php if ($contactWelcome["has_profile"] == "y" && SOCIALNETWORK_FEATURE == "on") { ?>
                                                    <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME?>"><?=system_showText(LANG_LABEL_PROFILE)?></a></li>
                                                    <li><a href="<?=DEFAULT_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                                    <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php"?>"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS);?></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a> </li>
                                                    <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                                <?php } ?>
                                            </ul>

                                        </li>
                                    <?php } else { ?>
                                        <li><a href="/profile/add.php"><?=system_showText(LANG_BUTTON_SIGNUP)?></a></li>
                                        <li><a href="/profile/login.php"><?=system_showText(LANG_LABEL_LOGIN)?></a></li>

                                    <?php } ?>
                                    <li><a href="/sponsors"><?=system_showText(LANG_LABEL_SPONSORAREA)?></a></li>
                                </ul>

                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>

                    </div>
                </div>
            </div>

            <div class="navbar-inverse hidden-xs">
                <div class="container">
                    <div class="collapse navbar-collapse main-navbar">
                        <ul class="nav navbar-nav navbar-left">
                            <? include(EDIRECTORY_ROOT."/frontend/header_menu.php"); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    <? }
