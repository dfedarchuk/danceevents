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
	# * FILE: /sponsors/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------

    if (count($sponsorItems) > 0) { ?>

    <div class="responsive-scrollmenu">

        <div class="scroll-content">

        <? if (count($arrayForms)) {

            foreach ($arrayForms as $form) { ?>

            <div style="display:none">
                <?
                /*
                * Auxiliary forms used to delete items
                */
                ?>
                <form name="delete_<?=$form;?>" id="delete_<?=$form;?>" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                    <input type="hidden" name="hiddenValue">
                    <input type="hidden" name="module" value="<?=$form;?>">
                </form>
            </div>

        <? }
        }

        foreach ($sponsorItems as $item) { ?>

            <div id="<?=ucfirst($item["module"])."_".$item["id"]?>" class="webitem <?=$item["class"];?>">

                <div class="desc" <?=$item["clickFunction"]?>>

                    <p class="title">
                        <b><?=$item["title"];?></b>

                        <? if ($item["status_label"]) { ?>
                            <span class="status"><?=$item["status_style"];?></span>
                        <? } ?>
                    </p>

                    <p class="simple">
                        <?=$item["label"]." ".$item["level"];?>

                        <? if ($item["alert_deal"]) { ?>
                            <span><?=$item["alert_deal"];?></span>
                        <? } ?>
                    </p>

                </div>

                <div class="action">
                    <a href="javascript:void(0)" <?=$item["clickFunction"]?> ><?=system_showText(LANG_LABEL_STATS);?></a>
                    <a href="<?=$item["link_edit"];?>"><?=system_showText(LANG_LABEL_EDIT);?></a>
                    <? if ($item["link_preview"]) { ?>
                    <a href="<?=$item["link_preview"];?>" target="_blank"><?=system_showText(LANG_LABEL_PREVIEW);?></a>
                    <? } ?>
                    <? if ($item["link_promotion"]) { ?>
                        <a href="<?=$item["link_promotion"];?>"><?=ucfirst(system_showText(LANG_LISTING_ADDPROMOTION));?></a>
                    <? }

                    if ($item["link_remove"]) { ?>
                        <a href="javascript:void(0);" onclick="<?=$item["link_remove"]?>"><?=system_showText(LANG_LABEL_REMOVE);?></a>
                    <? } ?>

                </div>

            </div>

         <? } ?>

        </div>
    </div>

    <? }

    if (string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS."/index.php") !== false) { ?>

        <div class="addcontent">

            <p><?=system_showText(LANG_ADD_NEW_CONTENT);?></p>

            <ul>
                <li>
                    <?=system_showText(LANG_ADD)?> <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_LISTING_FEATURE_NAME);?></a>
                </li>

                <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                <li>
                    <?=system_showText(LANG_ADD)?> <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=BANNER_FEATURE_FOLDER;?>/banner.php"><?=system_showText(LANG_BANNER_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                <li>
                    <?=system_showText(LANG_ADD)?> <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_EVENT_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                <li>
                    <?=system_showText(LANG_ADD)?> <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME);?></a>
                </li>
                <? } ?>

                <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                <li>
                    <?=system_showText(LANG_ADD)?> <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_ARTICLE_FEATURE_NAME);?></a>
                </li>
                <? } ?>
            </ul>

        </div>

    <? } elseif (string_strpos($_SERVER["PHP_SELF"], "billing") !== false || string_strpos($_SERVER["PHP_SELF"], "transactions") !== false) { ?>


            <nav>

                <ul class="nav nav-tabs nav-justified">
                    <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/billing") !== false) ? "class=\"active\"" : "") ?> >
                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/"><?=system_showText(LANG_MENU_CHECKOUT)?></a>
                    </li>
                    <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/transaction") !== false) ? "class=\"active\"" : "") ?> >
                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/transactions/"><?=system_showText(LANG_MENU_TRANSACTIONHISTORY)?></a>
                    </li>
                </ul>

            </nav>

    <? } ?>
