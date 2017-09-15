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
	# * FILE: /sponsors/login.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DOMAIN COOKIE VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if (!isset($_COOKIE["automatic_login_members"]) || $_COOKIE["automatic_login_members"] == "false") {
		$resetDomainSession = true;
	}

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/login.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h1><?=system_showText(LANG_LABEL_SPONSORAREA);?></h1>
                <br>
            </div>
        </div>

    </section>

    <div class="container well well-light">

        <!-- Login Form -->
        <div class="row">
            <div class="col-md-6 col-sm-offset-3">
                <div class="panel panel-theme">
                    <div class="panel-heading">
                        <h2><?=system_showText(LANG_LABEL_LOGIN_SPONSORAREA);?></h2>
                    </div>
                    <div class="panel-body">

                        <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {

                            if (FACEBOOK_APP_ENABLED == "on") {
                                $urlRedirect = "?destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/");
                                include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                            }
                            ?>

                            <br>

                            <? if ($foreignaccount_google == "on" ) {
                                $urlRedirect = "?destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/");
                                include(INCLUDES_DIR."/forms/form_googlelogin.php");
                            } ?>

                            <p class="text-center"><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>

                        <? } ?>

                        <form name="formDirectory" method="post" action="<?=MEMBERS_LOGIN_PAGE;?>">
                            <input type="hidden" name="advertise" value="<?=($_GET["advertise"] ? $_GET["advertise"] : $_POST["advertise"]);?>">
                            <input type="hidden" name="claim" value="<?=($_GET["claim"] ? $_GET["claim"] : $_POST["claim"]);?>">
                            <? include(INCLUDES_DIR."/forms/form_login.php"); ?>
                        </form>

                        <hr>

                        <p class="text-center">
                            <a href="<?=DEFAULT_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>/" class="btn btn-default btn-block"><?=system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS)?></a>
                            <br><br>
                            <a href="<?=DEFAULT_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a>
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="custom-content">&nbsp;</div>
            </div>
        </div>

    </div><!-- containe well well-light-->

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
