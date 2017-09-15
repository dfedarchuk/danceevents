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
    # * FILE: /profile/add.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");

    if (sess_getAccountIdFromSession()) {
        header("Location: ".DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # MAINTENANCE MODE
    # ----------------------------------------------------------------------------------------------------
    verify_maintenanceMode();

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSessionFront();

    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

    if (SOCIALNETWORK_FEATURE == "off") { exit; }

    if (sess_isAccountLogged()) {
        header("Location: ".SOCIALNETWORK_URL."/");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/add_account.php");

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = $headertagtitle;
    $headertag_description = $headertagdescription;
    $headertag_keywords = $headertagkeywords;
    include(EDIRECTORY_ROOT."/frontend/header.php");

    # ----------------------------------------------------------------------------------------------------
    # BODY
    # ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/newsletter.php");
    setting_get("foreignaccount_google", $foreignaccount_google);

    /*
     * Workaround for pin a bookmark without login
     */
    if ($_GET['bookmark_remember']) {
        $bookmarkQueryString = '&bookmark_remember=' . $_GET['bookmark_remember'];
    }

    /*
     * Workaround for make a redeem without login
     */
    if ($_GET['redeem_remember']) {
        $redeemQueryString = '&redeem_remember=' . $_GET['redeem_remember'];
    }

    if ($_GET['userperm']) {
        $userpermQueryString = '&userperm=' . $_GET['userperm'];
    }

?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_JOIN_PROFILE);?></h1>
                <br>
            </div>
        </div>
    </section>

    <main>

        <div class="container well well-light">

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="custom-content">
                        <h2><?= system_showText(LANG_LABEL_SIGNUPTODAY); ?></h2>
                        <p>&nbsp;</p>
                        <p style="color: #eeeeee; font-size: 150px; text-align: center;">
                            <span class="fa-stack">
                                <em class="fa fa-circle fa-stack-2x"></em>&nbsp;<em class="fa fa-users fa-stack-1x fa-inverse"></em>
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
                            <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/" class="btn btn-default"><?=system_showText(LANG_GO_TO_SPONSOR_AREA)?></a>
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="panel panel-theme">
                        <div class="panel-body">

                            <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {

                                $urlRedirect = "?destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/");
                                if (FACEBOOK_APP_ENABLED == "on") {
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                }

                                if ($foreignaccount_google == "on") {
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                } ?>

                                <p><?=system_showText(LANG_OR_SIGNUPEMAIL);?></p>

                            <? } ?>

                            <form role="form" class="form" name="add_account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?><?=sprintf('?%s%s%s', $bookmarkQueryString, $redeemQueryString, $userpermQueryString)?>" method="post">

                                <? include(INCLUDES_DIR."/forms/form_addaccount.php"); ?>

                                <?php if (isset($_POST['referer']) || $_SERVER['HTTP_REFERER']) { ?>
                                    <input type="hidden" name="referer" value="<?=isset($_POST['referer']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER']?>">
                                <?php } ?>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="<?=SOCIALNETWORK_URL?>/login.php" class="btn btn-primary"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div>

    </main>

<?

    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/frontend/footer.php");
