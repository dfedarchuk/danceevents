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
    # * FILE: /theme/default/frontend/footer.php
    # ----------------------------------------------------------------------------------------------------

    customtext_get("footer_copyright", $footer_copyright);
?>

        <? if (!$_GET['userperm']) { ?>
            <!-- Footer Begin -->
            <footer class="footer-static-bottom">
                <?=($contentFooter["content"])?>
                <div class="footer-links">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h5><?=system_showText(LANG_SITE_CONTENT)?></h5>
                                <div class="list-columns-2">
                                    <? include(system_getFrontendPath("footer_menu.php", "frontend")); ?>
                                </div>
                            </div>

                            <?php if ($contactInfoStr || $contact_phone) { ?>

                                <div class="col-sm-3 col-xs-6">
                                    <h5><?=system_showText(LANG_MENU_CONTACT)?></h5>

                                    <div itemscope itemtype="http://schema.org/Organization">
                                        <address class="contact-address" itemprop="name" content="Demo Directory">

                                            <?php if ($contactInfoStr) { ?>
                                                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                                    <span class="fa fa-map-marker"></span>
                                                    <?php if ($contact_address) { ?>
                                                        <span itemprop="streetAddress"><?=$contact_address?></span><br>
                                                    <?php } ?>
                                                    <?php if ($contact_city) { ?>
                                                        <span itemprop="addressLocality"><?=$contact_city?></span>,
                                                    <?php } ?>
                                                    <?php if ($contact_state) { ?>
                                                        <span itemprop="addressRegion"><?=$contact_state?></span>
                                                    <?php } ?>
                                                    <?php if ($contact_zipcode) { ?>
                                                        <span itemprop="postalCode"><?=$contact_zipcode?></span>
                                                    <?php } ?>
                                                    <?php if ($contact_country) { ?>
                                                        <br><span itemprop="addressCountry"><?=$contact_country?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if ($contact_phone) { ?>
                                                <span class="fa fa-phone"></span>
                                                <span itemprop="telephone"><?=$contact_phone?></span>
                                            <?php } ?>

                                        </address>
                                    </div>
                                </div>

                            <?php } ?>

                            <?php
                            if ($setting_twitter_link ||
                                $setting_facebook_link ||
                                $setting_linkedin_link ||
                                $setting_instagram_link ||
                                $setting_googleplus_link ||
                                $setting_pinterest_link
                            ) { ?>

                                <div class="col-sm-3 col-xs-6">
                                    <h5><?=system_showText(LANG_FOLLOW_US)?></h5>
                                    <ul class="list-unstyled">
                                        <?php if ($setting_facebook_link) { ?>
                                            <li>
                                                <a target="_blank" href="<?=$setting_facebook_link?>" class="social-links"><span class="fa fa-facebook"></span> Facebook </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_linkedin_link) { ?>
                                            <li>
                                                <a target="_blank" href="<?=$setting_twitter_link?>" class="social-links"><span class="fa fa-linkedin"></span> Linkedin </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_twitter_link) { ?>
                                            <li>
                                                <a target="_blank" href="http://www.twitter.com/<?=$setting_twitter_link?>" class="social-links"><span class="fa fa-twitter"></span> Twitter </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_instagram_link) { ?>
                                            <li>
                                                <a target="_blank" href="<?=$setting_instagram_link?>" class="social-links"><span class="fa fa-instagram"></span> Instagram </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_googleplus_link) { ?>
                                            <li>
                                                <a target="_blank" href="<?=$setting_googleplus_link?>" class="social-links"><span class="fa fa-google"></span> Google Plus </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ($setting_pinterest_link) { ?>
                                            <li>
                                                <a target="_blank" href="<?=$setting_pinterest_link?>" class="social-links"><span class="fa fa-pinterest"></span> Pinterest </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>

                <?php  if (BRANDED_PRINT == "on" || $footer_copyright) { ?>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <? if ($footer_copyright) { ?>
                            <div class="col-sm-8">
                                <?=$footer_copyright?>
                            </div>
                            <? } ?>

                            <?php  if (BRANDED_PRINT == "on") { ?>
                                <div class="<?=(!$footer_copyright ? "col-sm-offset-8 " : "")?> col-sm-4 text-right">
                                    <?=system_showText(LANG_POWEREDBY)?> <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank">eDirectory Cloud Service&trade;</a>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </footer>
            <!-- Footer End -->
        <? } ?>