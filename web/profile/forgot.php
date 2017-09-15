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
    # * FILE: /profile/forgot.php
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
    # AUX
    # ----------------------------------------------------------------------------------------------------
    $cancel_section = SOCIALNETWORK_FEATURE_NAME."/login.php";
    $section = "members";
    include(INCLUDES_DIR."/code/forgot_password.php");

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    $headertag_title = system_showText(LANG_LABEL_FORGOTTEN_PASSWORD);
    include(EDIRECTORY_ROOT."/frontend/header.php");

    ?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_LABEL_FORGOTTEN_PASSWORD);?></h1>
                <br>
            </div>
        </div>
    </section>

    <main>

        <div class="container well well-light">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-theme">
                        <div class="panel-body">
                            <form role="form" class="form" name="forgotpassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                                <? include(INCLUDES_DIR."/forms/form_forgot_password.php"); ?>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="<?=DEFAULT_URL;?>/<?=$cancel_section;?>"><?=system_showText(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD);?></a><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
    <?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/frontend/footer.php");