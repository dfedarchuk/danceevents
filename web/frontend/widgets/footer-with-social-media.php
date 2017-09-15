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
    # * FILE: /frontend/widgets/footer-with-social-media.php
    # ----------------------------------------------------------------------------------------------------

    customtext_get("footer_copyright", $footer_copyright);
?>

            <? if (!$_GET['userperm']) { ?>
            <!-- Footer Begin -->
            <footer class="footer-static-bottom footer-with-socialmedia">

                <div class="footer-links">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ($setting_twitter_link ||
                                $setting_facebook_link ||
                                $setting_linkedin_link ||
                                $setting_instagram_link ||
                                $setting_googleplus_link ||
                                $setting_pinterest_link
                            ) { ?>
                            <div class="col-xs-12 text-center">
                                <h4><?=system_showText(LANG_FOLLOW_US)?></h4>
                                <div class="center-block text-center">
                                    <?php if ($setting_facebook_link) { ?>
                                        <a target="_blank" href="<?=$setting_facebook_link?>" class="social-links"><span class="fa fa-facebook"></span> <span class="sr-only">Facebook</span></a>
                                    <?php } ?>
                                    <?php if ($setting_linkedin_link) { ?>
                                        <a target="_blank" href="<?=$setting_linkedin_link?>" class="social-links"><span class="fa fa-linkedin"></span> <span class="sr-only">Linkedin</span></a>
                                    <?php } ?>
                                    <?php if ($setting_twitter_link) { ?>
                                        <a target="_blank" href="<?=$setting_twitter_link?>" class="social-links"><span class="fa fa-twitter"></span> <span class="sr-only">Twitter</span></a>
                                    <?php } ?>
                                    <?php if ($setting_instagram_link) { ?>
                                        <a target="_blank" href="<?=$setting_instagram_link?>" class="social-links"><span class="fa fa-instagram"></span> <span class="sr-only">Instagram</span></a>
                                    <?php } ?>
                                    <?php if ($setting_googleplus_link) { ?>
                                        <a target="_blank" href="<?=$setting_googleplus_link?>" class="social-links"><span class="fa fa-google"></span> <span class="sr-only">Google Plus</span></a>
                                    <?php } ?>
                                    <?php if ($setting_pinterest_link) { ?>
                                        <a target="_blank" href="<?=$setting_pinterest_link?>" class="social-links"><span class="fa fa-pinterest"></span> <span class="sr-only">Pinterest</span></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php
                            if (BRANDED_PRINT == "on" || $footer_copyright) { ?>
                            <div class="footer-bottom">
                                <?php  if (BRANDED_PRINT == "on") { ?>
                                    <p><?=system_showText(LANG_POWEREDBY)?> <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank" rel="nofollow">eDirectory Cloud Service</a>&trade;</p>
                                <? } ?>

                                <? if ($footer_copyright) { ?>
                                <p><?=$footer_copyright?></p>
                                <? } ?>
                            </div>
                            <? } ?>

                            <div class="col-sm-12 text-center">
                                <?
                                $ulClass = "list-inline list-footer";
                                $liClass = "";
                                include(EDIRECTORY_ROOT."/frontend/footer_menu.php");
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </footer>

            <!-- Footer End -->
            <? } ?>
