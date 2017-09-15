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
    # * FILE: /frontend/widgets/navigation-with-centered-logo.php
    # ----------------------------------------------------------------------------------------------------

    if (!$_GET['userperm']) { ?>
        <!-- Header and navbar with Responsive features -->
        <header class="navbar navbar-static-top navbar-centered-logo">

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
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar">
                                    <span class="sr-only">Main navigation/span>
                                    <span class="navbar-label">Menu</span>
                                </button>
                                <button type="button" class="navbar-toggle search-toggle" data-toggle="collapse"
                                        data-target="#search-responsive" id="open-search-responsive" style="display: none;">
                                    <span class="sr-only">Open Search</span>
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="main-navbar">

                                <ul class="nav navbar-nav">
                                    <?
                                    $skipUL = true;
                                    include(EDIRECTORY_ROOT."/frontend/header_menu.php");
                                    ?>

                                    <?php if (sess_getAccountIdFromSession()) { ?>
                                        <li class="dropdown">
                                            <a class="btn btn-primary-inverted" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false"><?=system_showText(LANG_LABEL_WELCOME)?>
                                                <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <?php if ($contactWelcome["has_profile"] == "y" && SOCIALNETWORK_FEATURE == "on") { ?>
                                                <li class="nav-header"><span><?=system_showText(LANG_LABEL_WELCOME)." ".( (trim($contactWelcome["first_name"])) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"] : "" )?></span></li>
                                                <li class="divider"></li>
                                                <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/"?>"><?=system_showText(LANG_LABEL_PROFILE)?></a></li>
                                                <li><a href="<?=DEFAULT_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                                <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php"?>"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS);?></a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                                <? } else { ?>
                                                <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/faq.php"?>"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                                <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/account/"?>"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS);?></a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                                <? } ?>
                                            </ul>
                                        </li>
                                    <? } elseif (SOCIALNETWORK_FEATURE == "on") { ?>
                                        <li <?=(string_strpos($_SERVER["PHP_SELF"], "add.php") !== false ? "class=\"active\"" : "")?>><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME?>/add.php"><?=(LANG_BUTTON_SIGNUP)?></a></li>
                                        <li><a class="btn btn-primary-inverted" href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME?>/login.php"><?=(LANG_BUTTON_LOGIN)?></a></li>
                                    <? } ?>

                                </ul>

                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>

                    </div>
                </div>
            </div>

        </header>
    <? }
