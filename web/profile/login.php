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
    # * FILE: /profile/login.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------

    include("../conf/loadconfig.inc.php");

    if (sess_getAccountIdFromSession() and !$_GET['userperm']) {
        header("Location: ".DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # MAINTENANCE MODE
    # ----------------------------------------------------------------------------------------------------
    verify_maintenanceMode();

    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

    include(EDIRECTORY_ROOT."/includes/code/profile_login.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" || $_GET["facebookerror"] || $_GET["googleerror"] || $_GET["key"] || $_GET["activation_key"]) {
        include(EDIRECTORY_ROOT."/includes/code/login.php");
    }

    /* these var are, also, used in login modal */
    $bookmarkQueryString = $redeemQueryString = $userpermQueryString = '';
    /*
     * Workaround for pin a bookmark without login
     */
    if ($_GET['bookmark_remember']) {
        $bookmarkQueryString = '&bookmark_remember=' . $_GET['bookmark_remember'];
        $url .= $bookmarkQueryString;
    }

    /*
     * Workaround for make a redeem without login
     */
    if ($_GET['redeem_remember']) {
        $redeemQueryString = '&redeem_remember=' . $_GET['redeem_remember'];
        $url .= $redeemQueryString;
    }

    if ($_GET['userperm']) {
        $userpermQueryString = '&userperm=' . $_GET['userperm'];
    }

    if (!$_GET['userperm'] or $_SERVER['REQUEST_METHOD'] === 'POST') {

        # ----------------------------------------------------------------------------------------------------
        # HEADER
        # ----------------------------------------------------------------------------------------------------
        include(EDIRECTORY_ROOT."/frontend/header.php");

        # ----------------------------------------------------------------------------------------------------
        # BODY
        # ----------------------------------------------------------------------------------------------------

        ?>

        <section class="top-search">

            <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

            <div class="well well-translucid">
                <div class="container">
                    <br>

                    <h1><?= system_showText(LANG_LABEL_LOGIN); ?></h1>
                    <br>
                </div>
            </div>

        </section>

        <!-- Main Content Begin -->
        <main>

            <div class="container well well-light">

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="panel panel-theme">
                            <div class="panel-body">

                                <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {

                                    if (FACEBOOK_APP_ENABLED == "on") {
                                        $urlRedirect = "?destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                                        include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                    }

                                    if ($foreignaccount_google == "on" ) {
                                        $urlRedirect = "?destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                                        include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                    } ?>

                                    <p class="text-center"><?= system_showText(LANG_OR_SIGNINEMAIL); ?></p>

                                <? } ?>

                                <form role="form" class="form" name="login" method="post"
                                      action="<?=DEFAULT_URL?><?= $url ?>">

                                    <?
                                    $members_section = true;
                                    include(INCLUDES_DIR."/forms/form_login.php"); ?>

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a href="<?= SOCIALNETWORK_URL ?>/add.php?<?=sprintf('%s%s%s', $bookmarkQueryString, $redeemQueryString, $userpermQueryString)?>"
                                       class="btn btn-default"><?= system_showText(LANG_LABEL_SIGNUPNOW); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <h2><?= system_showText(LANG_LABEL_WELCOMEBACK); ?></h2>
                        <p>&nbsp;</p>
                        <p style="color: #eeeeee; font-size: 150px; text-align: center;">
                            <span class="fa-stack">
                                <em class="fa fa-circle fa-stack-2x"></em>&nbsp;<em class="fa fa-sign-in fa-stack-1x fa-inverse"></em>
                            </span>&nbsp;
                        </p>
                        <p style="font-size: 1.2em;">
                            <?= system_showText(LANG_LABEL_JOINUSTODAY); ?>
                            <span><?= system_showText(LANG_LABEL_LOGINEXPLANATION); ?></span>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <br>
                        <p class="text-center">
                            <a href="<?= DEFAULT_URL?>/<?= MEMBERS_ALIAS ?>/" class="btn btn-default"><?=system_showText(LANG_GO_TO_SPONSOR_AREA)?></a>
                        </p>
                    </div>
                </div>
            </div>

        </main><!-- Main Content End -->

<?

        # ----------------------------------------------------------------------------------------------------
        # FOOTER
        # ----------------------------------------------------------------------------------------------------
        include(EDIRECTORY_ROOT."/frontend/footer.php");

    } else {
        # ----------------------------------------------------------------------------------------------------
        # LOGIN MODAL
        # ----------------------------------------------------------------------------------------------------
        include(EDIRECTORY_ROOT."/profile/login_modal.php");
    }
