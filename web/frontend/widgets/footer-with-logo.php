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
    # * FILE: /frontend/widgets/footer-with-logo.php
    # ----------------------------------------------------------------------------------------------------

    customtext_get("footer_copyright", $footer_copyright);

?>

        <? if (!$_GET['userperm']) { ?>
            <!-- Footer Begin -->
            <footer class="footer-static-bottom footer-with-logo">

                <div class="footer-links">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-sm-6">
                                <p>
                                    <a href="<?=DEFAULT_URL?>" target="_parent" title="<?=EDIRECTORY_TITLE?>">
                                        <img class="brand-logo img-responsive" style="max-height: 200px" alt="<?=EDIRECTORY_TITLE?>" src="<?=system_getHeaderLogo(false);?>">
                                    </a>
                                </p>

                                <?=$footer_copyright?>

                                <?php  if (BRANDED_PRINT == "on") { ?>
                                <p>
                                    <?=system_showText(LANG_POWEREDBY)?>
                                    <a href="http://www.edirectory.com" target="_blank" rel="nofollow">eDirectory Cloud Service</a>&trade;
                                </p>
                                <? } ?>
                            </div>

                            <div class="col-md-5 col-sm-6 text-right text-left-sm">
                                <div class="list-columns">
                                    <? include(EDIRECTORY_ROOT."/frontend/footer_menu.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer End -->
        <? } ?>
