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
	# * FILE: /includes/forms/form_advertise_package.php
	# ----------------------------------------------------------------------------------------------------


    $auxitem_name = $array_package_offers[0]["items"][0]["module"];
    
    switch($auxitem_name) {
        case 'listing':         $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
                                $level = new ListingLevel();
                                $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                                if (EDIR_LANGUAGE == "en_us"){
                                    $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_levelName." ".$item_name." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
                                } else{
                                    $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
                                }
                                break;

        case 'banner':          $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
                                $level = new BannerLevel();
                                $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                                $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
                                break;

        case 'event':           $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
                                $level = new EventLevel();
                                $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                                $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
                                break;

        case 'classified':      $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
                                $level = new ClassifiedLevel();
                                $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                                $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
                                break;

        case 'article':         $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
                                $level = new ArticleLevel();
                                $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
                                $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
                                break;

        case 'custom_package':  $item_name = ucfirst(LANG_GIFT);
                                break;

    }

    $auxdomains_names = "";
    foreach ($array_package_offers as $package_offer) {
        foreach ($package_offer['items'] as $package_offer_item) {
            if ($package_offer_item['domain_id'] > 0) {
                $aux_domain_obj = new Domain($package_offer_item['domain_id']);
                $auxdomains_names .= $aux_domain_obj->getString('name').", ";
            }
        }
        $auxdomains_names = string_substr($auxdomains_names, 0, -2);
    }

    $packageObj = new Package($array_package_offers[0]["package_id"]);

    $packageImage = "";
    $imageObj = new Image($packageObj->getNumber("image_id"));
    if ($imageObj->imageExists()) {
        $packageImage = $imageObj->getTag(true, IMAGE_PACKAGE_FULL_WIDTH, IMAGE_PACKAGE_FULL_WIDTH, $packageObj->getString("title", false));
    }?>
    <div class="media">
        <?

        if ($packageImage) { ?>

        <div class="media-left">
            <?=$packageImage;?>
        </div>

        <? } ?>

        <div class="media-body">

            <h2><?=system_showText(LANG_INCREASE_VISIBILITY)?></h2>

            <? if ($packageObj->getString("content", false)) { ?>

                <div class="content-custom"><?=($packageObj->getString("content", false))?></div>

            <? } ?>

            <table class="table table-bordered table-striped">

                <tr>
                    <th colspan="4"><?=$msg_packagetr?></th>
                </tr>

                <?

                foreach ($array_package_offers as $package_offer) { //package offers

                    $aux_package_total = 0;

                    foreach ($package_offer['items'] as $package_offer_item) { //package items
                        $aux_valid_item = true;

                        if ($package_offer_item['domain_id'] > 0) {
                            $aux_domain_obj = new Domain($package_offer_item['domain_id']);
                            $aux_valid_item = ($aux_domain_obj->getString('status') == 'A');

                            $package_offer_item['domain'] = $aux_domain_obj->getString('name');
                            $package_offer_item['domain_url'] = ((string_strpos($aux_domain_obj->getString('url'), 'http://') === false) ? 'http://' : '' ) . $aux_domain_obj->getString('url').EDIRECTORY_FOLDER;
                        }

                        if ($aux_valid_item) {
                            if ($package_offer_item['module'] == 'custom_package') {
                                $aux_package_item_desc = $package_offer_item['content'];
                            } else {

                                $classLevel = string_ucwords($package_offer_item['module'])."Level";
                                $level = new $classLevel();
                                $levelName = string_ucwords($level->getName($package_offer_item['level']));

                                $aux_package_item_desc = '<a href="'.$package_offer_item['domain_url'].'" target="_blank">'.$package_offer_item['domain'].'</a>';
                            }

                            if ($package_offer_item['price'] == 0) {
                                $aux_package_item_price = CURRENCY_SYMBOL." ".system_showText(LANG_FREE);
                            } else {
                                $aux_package_item_price = CURRENCY_SYMBOL." ".$package_offer_item['price'];
                                $aux_package_total += $package_offer_item['price'];
                            } ?>

                        <tr>
                            <td colspan="3"><?=$aux_package_item_desc ? $aux_package_item_desc : system_showText(LANG_CUSTOM_OPTION)?></td>
                            <td class="text-right"><?=$aux_package_item_price;?></td>
                        </tr>
                    <? }
                    }
                }

                ?>

            </table>
        </div>

        <div class="text-center">
            <br>
            <button class="btn btn-success btn-lg" type="button" onclick="<?="acceptPackage('y'); ".($msgLogged ? "submitForm('formCurrentUser');" : "nextStep('$advertiseItem', ".($advertiseItem == "listing" ? "document.order_item.feed" : "false").", '$advertiseItem-title', false, true);").""?>"><?=system_showText(LANG_BUTTON_YES_CONTINUE)?></button>
            <br>
            <br>
            <br>
        </div>

        <input type="hidden" id="using_package" name="using_package" value="<?=($using_package)?>" />
        <input type="hidden" id="aux_package_id" name="aux_package_id" value="<?=$packageObj->getNumber("id");?>" />

    </div>