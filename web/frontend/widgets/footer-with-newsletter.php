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
    # * FILE: /frontend/widgets/footer-with-newsletter.php
    # ----------------------------------------------------------------------------------------------------

    if (MAIL_APP_FEATURE == "on") {

        setting_get("arcamailer_customer_listid", $edir_list_id);
        setting_get("arcamailer_enable_list", $edir_enable_list);
        setting_get("arcamailer_list_label", $edir_list_label);
        setting_get("arcamailer_list_label_sub", $arcamailer_list_label_sub);

        if ($edir_enable_list && $edir_list_id) {
            $showNewsletter = true;
            $signupLabel = $edir_list_label ? $edir_list_label : LANG_ARCAMAILER_SIGNUP;
        }
    }

    customtext_get("footer_copyright", $footer_copyright);

?>

            <? if (!$_GET['userperm']) { ?>
            <!-- Footer Begin -->
            <footer class="footer-static-bottom footer-with-newsletter">

                <?php
                if ($setting_twitter_link ||
                    $setting_facebook_link ||
                    $setting_linkedin_link ||
                    $setting_instagram_link ||
                    $setting_googleplus_link ||
                    $setting_pinterest_link
                ) { ?>

                <ul class="footer-social-links">
                    <?php if ($setting_facebook_link) { ?>
                        <li class="inline-sm">
                            <a target="_blank" href="<?=$setting_facebook_link?>" class="social-links"><span class="fa fa-facebook"></span> <span class="sr-only">Facebook</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($setting_linkedin_link) { ?>
                        <li class="inline-sm">
                            <a target="_blank" href="<?=$setting_linkedin_link?>" class="social-links"><span class="fa fa-linkedin"></span> <span class="sr-only">Linkedin</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($setting_twitter_link) { ?>
                        <li class="inline-sm">
                            <a target="_blank" href="<?=$setting_twitter_link?>" class="social-links"><span class="fa fa-twitter"></span> <span class="sr-only">Twitter</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($setting_instagram_link) { ?>
                        <li class="inline-sm">
                            <a target="_blank" href="<?=$setting_instagram_link?>" class="social-links"><span class="fa fa-instagram"></span> <span class="sr-only">Instagram</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($setting_googleplus_link) { ?>
                        <li class="inline-sm">
                            <a target="_blank" href="<?=$setting_googleplus_link?>" class="social-links"><span class="fa fa-google"></span> <span class="sr-only">Google Plus</span></a>
                        </li>
                    <?php } ?>
                    <?php if ($setting_pinterest_link) { ?>
                        <li class="inline-sm">
                            <a target="_blank" href="<?=$setting_pinterest_link?>" class="social-links"><span class="fa fa-pinterest"></span> <span class="sr-only">Pinterest</span></a>
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>

                <div class="footer-links">
                    <div class="container">
                        <div class="row">

                            <?php if ($contactInfoStr || $contact_phone) { ?>

                            <div class="col-sm-2 col-xs-6">
                                <h5><?=system_showText(LANG_MENU_CONTACT)?></h5>

                                <div itemscope itemtype="http://schema.org/Organization">
                                    <address class="contact-address" itemprop="name" content="Demo Directory">

                                        <?php if ($contactInfoStr) { ?>
                                            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
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
                                                    <span itemprop="addressCountry"><?=$contact_country?></span><br>
                                                <?php } ?>
                                                <?php if ($contact_phone) { ?>
                                                    <br><span itemprop="telephone"><b><?=$contact_phone?></b></span>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>

                                    </address>
                                </div>
                            </div>

                            <?php } ?>

                            <div class="col-sm-6 col-xs-12">
                                <h5><?=system_showText(LANG_SITE_CONTENT)?></h5>

                                <div class="list-columns-3">
                                    <? include(EDIRECTORY_ROOT."/frontend/footer_menu.php"); ?>
                                </div>
                            </div>

                            <? if ($showNewsletter) { ?>

                            <div class="col-sm-5 col-xs-12">
                                <div id="formNewsletter" class="newsletter">
                                    <div class="newsletter-box">

                                        <h5><?=$signupLabel?></h5>

                                        <? if ($arcamailer_list_label_sub) { ?>
                                            <p><?=$arcamailer_list_label_sub?></p>
                                        <? } ?>

                                        <form class="form-inline">

                                            <div class="row">
                                                <span class="showmessage col-md-10 col-md-offset-1 hidden">
                                                    <span class="alert alert-success" role="alert">
                                                        <i class="fa fa-check"></i>
                                                        <?=system_showText(LANG_ARCAMAILER_SUBSCRIBEDONE)?>
                                                    </span>
                                                </span>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="<?=system_showText(LANG_LABEL_NAME)?>" name="name" id="newsname">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="<?=system_showText(LANG_LABEL_EMAIL)?>" name="email" id="newsemail">
                                            </div>

                                            <button data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT)?>" class="btn btn-success action-save"><?=system_showText(LANG_BUTTON_SIGNUP)?></button>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            <? } ?>

                        </div>
                    </div>
                </div>

                <?php  if (BRANDED_PRINT == "on" || $footer_copyright) { ?>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <?php if ($footer_copyright) { ?>
                            <div class="col-sm-8">
                                <?=$footer_copyright?>
                            </div>
                            <? } ?>

                            <?php if (BRANDED_PRINT == "on") { ?>
                                <div class="<?=(!$footer_copyright ? "col-sm-offset-8" : "")?> col-sm-4 text-right">
                                    <?=system_showText(LANG_POWEREDBY)?> <a href="http://www.edirectory.com<?=(string_strpos($_SERVER["HTTP_HOST"], ".com.br") !== false ? ".br" : "")?>" target="_blank" rel="nofollow">eDirectory Cloud Service &trade;</a>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
                <?php  } ?>

            </footer>
            <!-- Footer End -->
            <? } ?>
