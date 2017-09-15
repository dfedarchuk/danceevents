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
    # * FILE: /sponsors/layout/header.php
    # ----------------------------------------------------------------------------------------------------

        header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

        include(INCLUDES_DIR."/code/headertag.php");

        $accountObj = new Account(sess_getAccountIdFromSession());

        $edirlanguageArr = explode("_", EDIR_LANGUAGE);

    ?>

    <!DOCTYPE html>

    <html lang="<?=system_getHeaderLang();?>">

        <head>

            <?
            if (sess_getAccountIdFromSession()) {
                        $dbObjWelcome = db_getDBObJect(DEFAULT_DB, true);
                        $sqlWelcome = "SELECT C.first_name, C.last_name, A.has_profile, P.friendly_url FROM Contact C
                                               LEFT JOIN Account A ON (C.account_id = A.id)
                                               LEFT JOIN Profile P ON (P.account_id = A.id)
                                               WHERE A.id = ".sess_getAccountIdFromSession();
                        $resultWelcome = $dbObjWelcome->query($sqlWelcome);
                        $contactWelcome = mysql_fetch_assoc($resultWelcome);
            }

            $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>

            <title><?=( (trim($contactWelcome["first_name"])) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " . $headertag_title?></title>

            <? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Arca Solutions")); ?>
            <meta name="author" content="<?=$headertag_author?>">

            <? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
            <meta name="description" content="<?=$headertag_description?>">

            <? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
            <meta name="keywords" content="<?=$headertag_keywords?>">

            <meta charset=<?=EDIR_CHARSET;?>>

            <meta name="ROBOTS" content="noindex, nofollow">

            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

            <!--  -->
            <!-- MEMBERS AREA WITH THEME STYLE -->
            <link href="<?=DEFAULT_URL;?>/assets/<?=EDIR_THEME;?>/css/style.css" rel="stylesheet" type="text/css" media="all">

            <!-- COLOR SCHEME -->
            <?php if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme/".EDIR_THEME."/colorscheme.css")) { ?>
            <link href="<?=DEFAULT_URL;?>/custom/domain_<?=SELECTED_DOMAIN_ID;?>/theme/<?=EDIR_THEME;?>/colorscheme.css" rel="stylesheet" type="text/css" media="all">
            <? } ?>

            <!-- CUSTOM CSS -->
            <?php if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme/".EDIR_THEME."/csseditor.css")) { ?>
                <link href="<?=DEFAULT_URL;?>/custom/domain_<?=SELECTED_DOMAIN_ID;?>/theme/<?=EDIR_THEME;?>/csseditor.css" rel="stylesheet" type="text/css" media="all">
            <? } ?>

            <?=system_getFavicon();?>

        </head>

    <body>

    <!--[if lt IE 9]><div class="ie"><![endif]-->

    <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
        include(EDIRECTORY_ROOT."/frontend/livebar.php");
    } ?>

    <!-- Google Tag Manager code - DO NOT REMOVE THIS CODE  -->
    <?=front_googleTagManager();?>

    <!-- Header and navbar with Responsive features -->
    <header class="navbar navbar-static-top">
        <div id="navbarLogin" class="navbar-inverse nav-sponsors">
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <li><a href="<?=DEFAULT_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>" class="btn btn-success"><?=(LANG_MENU_ADVERTISE)?></a></li>

                        <? if (sess_getAccountIdFromSession()) { ?>

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?=system_showText(LANG_LABEL_WELCOME)." ".( (trim($contactWelcome["first_name"])) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"] : "" )?>
                                <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">

                               <? if (!empty($_SESSION[SM_LOGGEDIN])) { ?>

                               <li>
                                   <a href="javascript:sitemgrSection();"><?=system_showText(LANG_LABEL_SITEMGR_SECTION);?></a>
                               </li>

                                <? } else { ?>

                                <? if ($contactWelcome["has_profile"] == "y" && SOCIALNETWORK_FEATURE == "on") { ?>
                                <li><a href="<?=SOCIALNETWORK_URL?>/"><?=system_showText(LANG_LABEL_PROFILE)?></a></li>
                                <? } ?>

                                <li><a href="<?=DEFAULT_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a> </li>

                                <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a> </li>

                                <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a></li>

                                <li class="divider"></li>
                                <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT)?></a></li>

                                <? } ?>
                           </ul>
                        </li>

                        <? } ?>

                    </ul>
                </div>
            </div>
        </div>

        <div id="navbarMenu" class="navbar-default">
            <div class="header-brand">
                <div class="container">

                    <nav class="navbar">
                        <div id="logo-link" class="navbar-brand">
                           <a href="<?=DEFAULT_URL?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?>>
                               <img class="brand-logo" alt="<?=(trim(EDIRECTORY_TITLE) ? EDIRECTORY_TITLE : "&nbsp;")?>" src="<?=system_getHeaderLogo(false);?>">
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

                            <? if (sess_getAccountIdFromSession()) { ?>
                                <ul class="nav navbar-nav navbar-right">

                                    <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/index.php") !== false) ? "class=\"active\"" : "")?>>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MEMBERS_DASHBOARD)?></a>
                                    </li>

                                    <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/billing") !== false) || (string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/transactions") !== false) ? "class=\"active\"" : "")?>>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/"><?=system_showText(LANG_LABEL_BILLING)?><i class="notify" id="billing_notify" style="display:none"></i></a>
                                    </li>

                                    <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/account/index.php") !== false) ? "class=\"active\"" : "")?>>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                                    </li>

                                    <? if (!empty($_SESSION[SM_LOGGEDIN])) { ?>

                                    <li>
                                        <a href="javascript:sitemgrSection();"><?=system_showText(LANG_LABEL_SITEMGR_SECTION);?></a>
                                    </li>

                                    <? } ?>
                                </ul>

                              <? } ?>
                              <ul class="nav navbar-nav navbar-login">
                                <li>
                                    <a href="<?=DEFAULT_URL?>"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH)?></a>
                                </li>
                                <li><a href="<?=DEFAULT_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>" class="btn btn-success"><?=(LANG_MENU_ADVERTISE)?></a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>

                </div>
            </div>
        </div>
    </header>

    <main>
