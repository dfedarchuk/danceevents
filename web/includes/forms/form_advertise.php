<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /includes/forms/form_advertise.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/newsletter.php");

    $defaultusername = $username;
    $defaultpassword = "";
    if (DEMO_MODE) {
        $defaultusername = "demo@demodirectory.com";
        $defaultpassword = "abc123";
    }

    $msgLogged = "";

    $defaultActionForm = $formloginaction.($advertiseItem == "banner" ? "&amp;query=type=".($_POST["type"] ? $_POST["type"] : $_GET["type"]) : "&amp;query=level=".($_POST["level"] ? $_POST["level"] : $_GET["level"]));

    if ($advertiseItem == "listing") {
        $defaultActionForm .= "&amp;listingtemplate_id=".($_POST["listingtemplate_id"] ? $_POST["listingtemplate_id"] : $_GET["listingtemplate_id"]);
    }
?>

    <div style="display:none">

        <form id="formDirectory" name="formDirectory" method="post" action="<?=$defaultActionForm;?>">

            <input type="hidden" name="advertise" value="yes">
            <input type="hidden" name="destiny" value="<?=$destiny?>">
            <input type="hidden" name="query" value="<?=urlencode($query)?>">

            <input type="hidden" name="username" id="form_username" value="">
            <input type="hidden" name="password" id="form_password" value="">

        </form>

    </div>

    <form name="order_item" action="<?=system_getFormAction($_SERVER["REQUEST_URI"])?>" method="post" class="form" onsubmit="JS_submit();">

        <input type="hidden" name="advertise" value="yes">
        <input type="hidden" name="signup" value="true">

        <? if ($advertiseItem == "banner") { ?>
            <input type="hidden" name="type" id="type" value="<?=$type?>">
            <input type="hidden" name="expiration_setting" id="expiration_setting" value="<?=$expiration_setting?>">
            <input type="hidden" name="unpaid_impressions" id="unpaid_impressions" value="<?=$unpaid_impressions?>">
        <? } else { ?>
            <input type="hidden" name="level" id="level" value="<?=$level?>">
        <? } ?>

        <? if ($advertiseItem == "listing") { ?>
            <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>">
        <? } ?>

        <div class="content-main" id="screen1" <?=($message_account || $message_contact ? "style=\"display: none;\"" : "style=\"display: block;\"")?>>

            <div class="order-head">
                <h2 class="theme-title">
                    <?=$labelName;?>
                </h2>
            </div>

            <div class="order">

                <span id="errorMessage" class="hidden">&nbsp;</span>

                <div id="listing-info">

                    <h3><?=system_showText(constant("LANG_".strtoupper($advertiseItem)."INFO"));?></h3>
                    <p>
                        <?=system_showText(constant("LANG_".strtoupper($advertiseItem)."INFO_TIP"));?>
                        <? if ($advertiseItem == "listing" && LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                            echo system_showText(LANG_LISTINGINFO_TIP2);
                        } ?>
                    </p>
                    <br>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 well">

                            <div class="form-group">
                                <label id="title_label" for="<?=$advertiseItem?>-title"><?=($template_title_field !== false && $advertiseItem == "listing") ? $template_title_field[0]["label"] : ($advertiseItem == "banner" ? system_showText(LANG_LABEL_CAPTION) : system_showText(LANG_LABEL_TITLE))?> <span class="sr-only"><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                                <? if ($advertiseItem == "banner") { ?>
                                    <input class="form-control" type="text" name="caption" id="<?=$advertiseItem?>-title" value="<?=$caption?>" onblur="updateFormAction(); $('#adv_title').html(this.value);">
                                <? } else { ?>
                                    <input class="form-control" type="text" name="title" id="<?=$advertiseItem?>-title" value="<?=$title?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>'); updateFormAction(); $('#adv_title').html(this.value);">
                                    <input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>">
                                <? } ?>
                            </div>

                            <? if ($advertiseItem == "banner") { ?>

                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type_expiration_setting" value="<?=$type?>_<?=BANNER_EXPIRATION_RENEWAL_DATE?>" <? if (BANNER_EXPIRATION_RENEWAL_DATE == $expiration_setting) { echo "checked=\"checked\""; } ?> onclick="typeSwitch('<?=$type?>', '<?=BANNER_EXPIRATION_RENEWAL_DATE?>');">
                                        <?
                                            $pricingInfo = payment_getPricing("banner", $bannerLevelObj, $type);
                                            $price = $pricingInfo["main_price"];
                                            $priceRenewal = $pricingInfo["renewal_label"];
                                            if ($price > 0) {
                                                echo CURRENCY_SYMBOL.$price.$priceRenewal." ".($pricingInfo["renewal_sub"] ? $pricingInfo["renewal_sub"] : "");
                                            } else {
                                                echo system_showText(LANG_FREE);
                                            }
                                        ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type_expiration_setting" value="<?=$type?>_<?=BANNER_EXPIRATION_IMPRESSION?>" <? if (BANNER_EXPIRATION_IMPRESSION == $expiration_setting) { echo "checked=\"checked\""; } ?> onclick="typeSwitch('<?=$type?>', '<?=BANNER_EXPIRATION_IMPRESSION?>');">
                                        <?
                                        if ($bannerLevelObj->getImpressionPrice($type) > 0) {
                                            echo CURRENCY_SYMBOL.$bannerLevelObj->getImpressionPrice($type);
                                        } else {
                                            echo CURRENCY_SYMBOL.system_showText(LANG_FREE);
                                        }
                                        echo " ".system_showText(LANG_PER)." ".$bannerLevelObj->getImpressionBlock($type)." ".system_showText(LANG_IMPRESSIONS);
                                        ?>
                                    </label>
                                </div>
                            </div>

                            <? } ?>


                            <? if ($advertiseItem == "listing" && LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") { ?>

                            <? if (system_showListingTypeDropdown($listingtemplate_id)) { ?>

                            <div class="form-group">

                                <label for="listing-template"><?=system_showText(LANG_LISTING_LABELTEMPLATE)?></label>

                                <select class="form-control" id="listing-template" name="select_listingtemplate_id" onchange="templateSwitch(this.value);">
                                    <?=$listingTypeOptions;?>
                                </select>

                            </div>

                            <? } else { ?>
                                <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>">
                            <? } ?>

                            <? } ?>

                            <? if ($advertiseItem == "event") { ?>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="start_date"><?=system_showText(LANG_LABEL_STARTDATE)?> <span class="sr-only"><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                                        <input class="form-control date-input" type="text" name="start_date" id="start_date" value="<?=$start_date?>"> <span>(<?=format_printDateStandard()?>)</span>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="end_date"><?=system_showText(LANG_LABEL_ENDDATE)?> <span class="sr-only"><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                                        <input class="form-control date-input" type="text" name="end_date" id="end_date" value="<?=$end_date?>"> <span>(<?=format_printDateStandard()?>)</span>
                                    </div>
                                </div>
                            <? } ?>

                        </div>
                    </div>
                    <hr>

                </div>

                <? if ($advertiseItem == "listing") { ?>
                <div id="categories">

                    <div class="left textright">

                        <h3><?=system_showText(LANG_CATEGORIES_TITLE)?></h3>
                        <p>
                            <span id="extracategory_note"><?=string_ucwords(system_showText(($listingLevelObj->getFreeCategory($level) > 1) ? LANG_CATEGORY_PLURAL : LANG_CATEGORY))?> <strong><?=system_showText(LANG_INCLUDED)?>:</strong> <?=$listingLevelObj->getFreeCategory($level)?>. <?=system_showText(LANG_CATEGORIES_PRICEDESC1)?> <strong><?=system_showText(LANG_CATEGORIES_PRICEDESC2)?> <?=CURRENCY_SYMBOL?> <?=$listingLevelObj->getCategoryPrice($level)?></strong> <?=system_showText(LANG_CATEGORIES_PRICEDESC3)?></span>
                            <?=system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." <strong>".system_showText(LISTING_MAX_CATEGORY_ALLOWED)."</strong> ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?>
                        </p>
                        <p class="warningBOXtext"><?=system_showText(LANG_CATEGORIES_MSG1)?><br><?=system_showText(LANG_CATEGORIES_MSG2)?></p>
                        <br>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">

                                <input type="hidden" name="return_categories" value="">

                                <div class="treeView well well-primary">

                                    <ul id="listing_categorytree_id_0" class="categoryTreeview">
                                        <li>&nbsp;</li>
                                    </ul>

                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label><?=system_showText(LANG_LISTING_CATEGORIES);?> <span class="sr-only"><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                                <div class="multiple-select">
                                    <?=$feedDropDown?>
                                </div>
                                <div class="text-center" id="removeCategoriesButton" style="display:none;">
                                    <a href="javascript:void(0);" onclick="JS_removeCategory(document.order_item.feed, true);"><?=(system_showText(LANG_CATEGORY_REMOVESELECTED))?></a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <hr>

                </div>
                <? } ?>

                <? if (!$msgLogged) { ?>

                <div id="payment-method" class=" <?=$checkoutpayment_class?>">

                    <h3><?=system_showText(LANG_LABEL_PAYMENT_METHOD);?></h3>
                    <p><?=system_showText(LANG_LABEL_PAYMENT_METHOD_TIP);?></p>
                    <br>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 well ">

                            <div class="form-group">
                                <? include(INCLUDES_DIR."/forms/form_paymentmethod.php"); ?>
                            </div>

                            <? if (PAYMENT_FEATURE == "on" && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>

                            <div class="form-group">
                                <label for="promocode"><?=string_ucwords(system_showText(LANG_LABEL_DISCOUNTCODE))?></label>
                                <input class="form-control" type="text" id="promocode" name="discount_id" value="<?=$discount_id?>" maxlength="10" onblur="orderCalculate(); updateFormAction();">
                            </div>

                            <? } ?>

                        </div>
                    </div>

                </div>

                <? } else { ?>

                <input type="hidden" name="userLogged" id="userLogged" value="1">
                <br class="clear">
                <? } ?>
                <hr>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div id="loadingOrderCalculate" class="loadingOrderCalculate"><?=system_showText(LANG_WAITLOADING)?></div>

                        <input type="hidden" name="free_item" id="free_item" value="">

                        <? if (PAYMENT_FEATURE == "on" && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>

                        <div id="check_out_payment" class="<?=$checkoutpayment_class?>">

                            <div class="text-center">
                                <div id="checkoutpayment_total" class="orderTotalAmount"></div>
                                <br>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="button" id="button1" onclick="<?=("nextStep('$advertiseItem', ".($advertiseItem == "listing" ? "document.order_item.feed" : "false").", '$advertiseItem-title', ".($hasPackage ? "true" : "false").");")?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
                            <p class="text-center">
                                <br>
                                <a href="<?=DEFAULT_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>/"><?=system_showText(LANG_ADVERTISE_BACK);?></a>
                                <em><?=$msgLogged;?></em>
                            </p>
                        </div>
                        <? } ?>

                        <div id="check_out_free" class="<?=$checkoutfree_class?>">

                            <div class="text-center">
                                <div id="checkoutfree_total" class="orderTotalAmount"></div>
                                <br>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="button" id="button2" onclick="<?=("nextStep('$advertiseItem', ".($advertiseItem == "listing" ? "document.order_item.feed" : "false").", '$advertiseItem-title', ".($hasPackage ? "true" : "false").");")?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
                            <p class="text-center">
                                <br>
                                <a href="<?=DEFAULT_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>/"><?=system_showText(LANG_ADVERTISE_BACK);?></a>
                                <em><?=$msgLogged;?></em>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <? if ($hasPackage) { ?>

        <div id="screenPackage" style="display: none;">

            <h2 class="theme-title">
                <?=$labelName;?>
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <? include(EDIRECTORY_ROOT."/includes/forms/form_advertise_package.php");?>
                </div>
                <hr>
                <div class="col-sm-4 col-sm-offset-4 text-center">
                    <button class="btn btn-primary btn-sm" type="button" onclick="<?="acceptPackage('n'); ".("nextStep('$advertiseItem', ".($advertiseItem == "listing" ? "document.order_item.feed" : "false").", '$advertiseItem-title', false, true);")?>"><?=system_showText(LANG_BUTTON_NO_THANKS)?></button>
                    <p>
                        <br>
                        <a href="javascript: void(0);" onclick="backStep(true);"><?=system_showText(LANG_ADVERTISE_BACK);?></a>
                    </p>
                </div>
            </div>

        </div>

        <? } ?>

        <div id="screen2" <?=($message_account || $message_contact ? "style=\"display: block;\"" : "style=\"display: none;\"")?>>

            <ol class="breadcrumb breadcrumb-steps text-center" id="checkout_steps">
                <li class="active"><strong>1:</strong> <?=system_showText(LANG_ADVERTISE_IDENTIFICATION);?></li>
                <li><strong>2:</strong> <?=system_showText(LANG_CHECKOUT);?></li>
                <li><strong>3:</strong> <?=system_showText(LANG_ADVERTISE_CONFIRMATION);?></li>
            </ol>

			<div class="row">

			    <div class="col-sm-6 col-sm-offset-3">

			        <h1 class="text-center capitalized">
			            <?=system_showText(LANG_ADVERTISE_CHECKOUT)?> <br><q id="adv_title"><?=($advertiseItem == "banner" && $caption ? $caption : ($title ? $title : ""))?></q>
			        </h1>
                    <p class="text-center"><?=system_showText(LANG_ADVERTISE_SIGNUP);?></p>

			        <hr>

			        <div id="advertise_login" style="display:none">

			            <section class="login-box">

			                <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {

                                if ($facebookEnabled) {
                                    $fbLabel = system_showText(LANG_LOGINFACEBOOKUSER);
                                    $urlRedirect = "?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/$advertiseItem.php");
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                    unset($fbLabel);
                                }

                                if ($googleEnabled) {
                                    $goLabel = system_showText(LANG_LOGINGOOGLEUSER);
                                    $urlRedirect = "?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/$advertiseItem.php");
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                    unset($goLabel);
                                }
                                ?>

			                    <p class="text-center divisor"><br><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>

			                <? }

                            $advertise_section = true;
                            include(INCLUDES_DIR."/forms/form_login.php"); ?>

			            </section>

			            <section class="login-underbox">
                            <br>
			                <p class="text-center"><a class="link-highlight" href="javascript:void(0);" onclick="$('#advertise_login').css('display', 'none'); $('#advertise_signup').fadeIn(500);"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>
			            </section>

			        </div>

			        <div id="advertise_signup">

			            <section class="login-box">

			                <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {

                                if ($facebookEnabled) {
                                    $fbLabel = system_showText(LANG_SIGNUPFACEBOOKUSER);
                                    $urlRedirect = "?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/$advertiseItem.php");
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                    unset($fbLabel);
                                }

                                if ($googleEnabled) {
                                    $goLabel = system_showText(LANG_SIGNUPGOOGLEUSER);
                                    $urlRedirect = "?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/$advertiseItem.php");
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                    unset($goLabel);
                                }
                                ?>

			                    <p class="text-center divisor"><br><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>

			                <? }

                            $advertise_section = true;
                            include(INCLUDES_DIR."/forms/form_addaccount.php"); ?>

			            </section>

			            <section class="login-underbox">
                            <br>
			                <p class="text-center"><a href="javascript:void(0);" onclick="$('#advertise_signup').css('display', 'none'); $('#advertise_login').fadeIn(500);"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a></p>
			            </section>

			        </div>

			    </div>

			</div>

        </div>

    </form>
