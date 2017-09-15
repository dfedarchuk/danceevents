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
	# * FILE: /sponsors/layout/footer.php
	# ----------------------------------------------------------------------------------------------------
?>

    </main><!-- Close container MAIN-->

    <footer id="footer" class="footer-static-bottom">
        <div class="footer-links">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <ul class="list-unstyled">

                            <? if (sess_getAccountIdFromSession()) { ?>

                            <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MEMBERS_DASHBOARD)?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/logout.php" class="sign-up"><?=system_showText(LANG_BUTTON_LOGOUT)?></a></li>
                            <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/help.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a></li>
                            <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/faq.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a></li>
                            <li><a href="<?=DEFAULT_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></li>

                            <? } else { ?>

                            <li><a href="<?=DEFAULT_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></li>

                            <? } ?>

                        </ul>
                     </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <?
                        customtext_get("footer_copyright", $footer_copyright);

                        if (!$footer_copyright) {
                            $footer = "Copyright &copy; ".date("Y")." Arca Solutions, Inc. All Rights Reserved.";
                        } else {
                            $footer = $footer_copyright;
                        }
                        ?>

                        <?=$footer?>
                    </div>
                    <div class="col-sm-4 text-right">
                        <?php
                        if (BRANDED_PRINT == "on") { ?>
                            <?=system_showText(LANG_POWEREDBY)?> <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank" rel="nofollow">eDirectory Cloud Service&trade;</a>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>

        <?
        // GOOGLE ANALYTICS FEATURE
        if (!DEMO_DEV_MODE && !DEMO_LIVE_MODE && (GOOGLE_ANALYTICS_ENABLED == "on")) {
            $google_analytics_page = "members";
            include(INCLUDES_DIR."/code/google_analytics.php");
        }
        ?>

    </footer>


    <!-- Auxiliary vars -->
    <script>
        DEFAULT_URL = "<?=DEFAULT_URL?>";
        MEMBERS_ALIAS = "<?=MEMBERS_ALIAS?>";
        DATEPICKER_FORMAT = '<?=(DEFAULT_DATE_FORMAT == "m/d/Y" ? "mm/dd/yyyy" : "dd/mm/yyyy")?>';
        DATEPICKER_LANGUAGE = '<?=EDIR_LANGUAGE?>';
    </script>

    <!-- Core Scripts -->

    <!-- Modernizr -->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/modernizr.custom.13060.js"></script>

    <!-- jQuery -->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/jquery-1.11.1.min.js"></script>

    <!-- jQuery - Sortable package only -->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/jquery-ui-1.11.1.min.js"></script>

    <!-- jQuery - Text Area Counter -->
    <script src="<?=DEFAULT_URL?>/scripts/jquery/jquery.textareaCounter.plugin.js"></script>

    <!-- Bootstrap -->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/bootstrap.min.js"></script>

    <!-- Additional scripts -->
    <script src="<?=language_getFilePath(EDIR_LANGUAGE, true);?>"></script>
    <script src="<?=DEFAULT_URL?>/scripts/specialChars.js"></script>
    <script src="<?=DEFAULT_URL?>/scripts/banner.js"></script>
    <script src="<?=DEFAULT_URL?>/scripts/common.js"></script>
    <script src="<?=DEFAULT_URL?>/scripts/location.js"></script>
    <script src="<?=DEFAULT_URL?>/scripts/jquery/jquery.knob.js"></script>
    <script src="<?=DEFAULT_URL?>/scripts/Chart.js"></script>

    <!-- External Plugins -->

    <!--Bootstrap Date Picker-->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/bootstrap-datepicker-master/bootstrap-datepicker.js"></script>
    <? if (EDIR_LANGUAGE != "en_us") { ?>
        <script src="<?=language_getDatePickPath(EDIR_LANGUAGE, SELECTED_DOMAIN_ID, false, true);?>"></script>
    <? } ?>

    <!-- Jquery Time Picker-->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/jquery-timepicker-master/jquery.timepicker.min.js"></script>

    <!-- Bootstrap file style-->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/bootstrap-filestyle/bootstrap-filestyle.js"></script>

    <!--Selectize-->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/selectize.js-master/selectize.min.js"></script>

    <!-- Bootstrap bootbox-->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/bootstrap-bootbox/bootbox.min.js"></script>

    <!-- jQuery - jScroll -->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/jquery.jscroll.min.js"></script>

    <!-- Bootstrap bootbox Locales-->
    <script>
        bootbox.setDefaults({
            /**
             * @optional String
             * @default: en
             * which locale settings to use to translate the three
             * standard button labels: OK, CONFIRM, CANCEL
             */
            locale: "<?=$edirlanguageArr[0]?>"
        });
    </script>

    <!-- Shrink Header -->
    <script src="<?=DEFAULT_URL?>/assets/js/shrink.js"></script>

    <!--[if lt IE 9]>
    <script src="<?=DEFAULT_URL."/scripts/html5shiv.js"?>"></script>
    <script src="<?=DEFAULT_URL."/scripts/jquery/excanvas.compiled.js"?>"></script>
    <![endif]-->

    <? if (!empty($_SESSION[SM_LOGGEDIN])) { ?>

    <script>
        function sitemgrSection() {
            location = "<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/sitemgraccess.php?logout";
        }
    </script>

    <? } ?>

    <script>

        $(function() {
            <? if (sess_getAccountIdFromSession()) { ?>
            //Update Billing Notification
            $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", {
                ajax_type: 'getunpaidItems'
            }, function (ret) {
                if (ret > 0) {
                    $("#billing_notify").html(ret);
                    $("#billing_notify").fadeIn();
                }
            });

            <? } ?>

        });

    </script>

    <!--Custom javascripts for admin section -->
    <? if ($customJS && file_exists($customJS)) {
        include($customJS);
    } ?>

    <!-- Main Script -->
    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/adminpanel.js"></script>

    <?
    if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php"))
    {
        include(EDIRECTORY_ROOT."/frontend/livebar.php");
    }

    if ( class_exists( "JavaScriptHandler" ) )
    {
        JavaScriptHandler::render();
    }
    ?>

	</body>

</html>
