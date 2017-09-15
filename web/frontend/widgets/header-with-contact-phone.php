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
    # * FILE: /frontend/widgets/header-with-contact-phone.php
    # ----------------------------------------------------------------------------------------------------

    if (!$_GET['userperm']) { ?>
    <!-- Header and navbar with Responsive features -->
    <header class="navbar navbar-static-top navbar-contact-phone">
        <div id="navbarLogin" class="navbar-inverse">
            <div class="container">
                <div class="collapse navbar-collapse">
                    <? if ($contact_phone) { ?>
                        <ul class="nav navbar-nav">
                            <li><span><?=system_showText(LANG_MENU_CONTACT)?>: <?=$contact_phone?></span></li>
                        </ul>
                    <? } ?>

                    <ul class="nav navbar-nav navbar-right">

                        <?php if (sess_getAccountIdFromSession()) { ?>
                            <?php if ($contactWelcome["is_sponsor"] == "n") { ?>
                                <li><a href="<?=DEFAULT_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>"><?=(LANG_MENU_ADVERTISE)?></a></li>
                            <? } else { ?>
                                <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/"><?=(LANG_MEMBERS_DASHBOARD)?></a></li>
                            <? } ?>

                            <li class="dropdown">

                                <a href="<?=DEFAULT_URL."/".(SOCIALNETWORK_FEATURE == "on" ? SOCIALNETWORK_FEATURE_NAME : MEMBERS_ALIAS)."/login/"?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?=system_showText(LANG_LABEL_WELCOME)." ".( (trim($contactWelcome["first_name"])) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"] : "" )?>
                                    <?php if (sess_getAccountIdFromSession()) { ?>
                                        <span class="caret"></span>
                                    <? } ?>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <?php if (SOCIALNETWORK_FEATURE == "on") { ?>
                                        <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME?>"><?=system_showText(LANG_LABEL_PROFILE)?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                        <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php"?>"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS);?></a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?=DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                    <?php } else { ?>
                                        <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/"?>"><?=system_showText(LANG_MEMBERS_DASHBOARD)?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a> </li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/logout.php"?>"><?=system_showText(LANG_BUTTON_LOGOUT);?></a></li>
                                    <?php } ?>
                                </ul>

                            </li>

                        <? } else { ?>
                            <li> <a href="<?=DEFAULT_URL."/".ALIAS_ADVERTISE_URL_DIVISOR."/"?>"><?=system_showText(LANG_AREYOU_SPONSOR_AREA)?> <b><?=system_showText(LANG_AREYOU_SPONSOR_AREA_2)?></b></a></li>

                            <? if (SOCIALNETWORK_FEATURE == "on") { ?>
                                <li><a href="<?=DEFAULT_URL?>/<?=SOCIALNETWORK_FEATURE_NAME?>/add.php"><?=(LANG_BUTTON_SIGNUP)?></a></li>
                                <li class="divider"></li>
                                <li><a href="<?=DEFAULT_URL?>/<?=SOCIALNETWORK_FEATURE_NAME?>/login.php"><?=(LANG_BUTTON_LOGIN)?></a></li>
                            <? }
                           } ?>

                    </ul>
                </div>
            </div>
        </div>
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
                                <span class="sr-only">Toggle navigation</span>
                                <span class="navbar-label">Menu</span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="main-navbar">

                            <? include(EDIRECTORY_ROOT."/frontend/header_menu.php"); ?>

                            <ul class="nav navbar-nav navbar-login">

                                <li><a href="<?=DEFAULT_URL?>/profile/add.php"><?=(LANG_BUTTON_SIGNUP)?></a></li>
                                <li class="divider"></li>
                                <li><a href="<?=DEFAULT_URL?>/profile/login.php"><?=(LANG_BUTTON_LOGIN)?></a></li>
                                <li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/"?>"><?=(LANG_LABEL_SPONSORAREA)?></a></li>

                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>

                </div>
            </div>
        </div>
    </header>
    <? }
