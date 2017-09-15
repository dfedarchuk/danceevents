<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /forms/form-discountcode.php
	# ----------------------------------------------------------------------------------------------------


?>

    <div class="col-sm-6">
        <div class="panel panel-form">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_INFORMATION)?>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="id-code"><?=system_showText(LANG_SITEMGR_LABEL_CODE)?></label>
                    <input id="id-code" type="text" name="id" value="<?=$id?>" class="form-control" maxlength="10">
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="col-sm-12 row">
                            <label><?=system_showText(LANG_SITEMGR_LABEL_TYPE)?></label>
                        </div>
                        <div class="col-sm-12 form-horizontal row">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="type" value="percentage" <?=(($type == "percentage") ? "checked=true" : "")?> onclick="changeLabelOpt2();" >
                                    <?=system_showText(LANG_SITEMGR_LABEL_PERCENTAGE)?>
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="type" value="monetary value" <?=((!$type || $type == "monetary value") ? "checked=true" : "")?> onclick="changeLabelOpt1();" >
                                    <?=system_showText(LANG_SITEMGR_LABEL_FIXEDVALUE)?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="id-amount"><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></label>
                        <div class="input-group">
                            <span class="input-group-addon" id="option1" <?=(($type == "percentage") ? "style='display:none' " : "")?>  ><? echo CURRENCY_SYMBOL; ?></span>
                            <input id="id-amount" type="text" name="amount" value="<?=(($amount) ? $amount : "0.00")?>" class="form-control" maxlength="10" >
                            <span class="input-group-addon" id="option2" <?=((!$type || $type == "monetary value") ? "style='display:none' " : "")?>  > % </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="col-sm-12 row">
                            <label><?=system_showText(LANG_SITEMGR_DISCOUNTCODE_DURATION)?> </label>
                        </div>
                        <div class="col-sm-12 form-horizontal row">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="recurring" value="no"  <?=((!$recurring || $recurring == "no") ? "checked=true" : "")?> />
                                    <?=system_showText(LANG_SITEMGR_DISCOUNTCODE_DURATION_ONCE)?>
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="recurring" value="yes"  <?=(($recurring == "yes") ? "checked=true" : "")?> />
                                    <?=system_showText(LANG_SITEMGR_DISCOUNTCODE_DURATION_FOREVER)?>
                                </label>
                            </div>
                            <p class="help-block small"><?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_ALLOWREPEAT_TEXT)?></p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="expire_date"><?=system_showText(LANG_SITEMGR_DISCOUNTCODE_REDEEMBY)?></label>
                    <input type="text" name="expire_date" id="expire_date" value="<?=($expire_date ? $expire_date : "")?>" class="form-control date-input" placeholder="<?=format_printDateStandard()?>" maxlength="10">
                    <p class="help-block small"><?=system_showText(LANG_SITEMGR_DISCOUNTCODE_REDEEMBY_TIP)?></p>
                </div>

                <? if ($x_id) { ?>
                <div class="form-group">
                    <label><?=system_showText(LANG_SITEMGR_STATUS)?></label>
                    <div class="selectize">
                        <?=$discountCodeStatusDropDown?>
                    </div>
                </div>
                <? } ?>

                <div class="form-group">
                    <div class="col-sm-12 row">
                        <label><?=system_showText(LANG_SITEMGR_AVAILABLEOF)?></label>
                    </div>
                    <div class="col-sm-12 form-horizontal row">
                        <div class="checkbox-inline">
                            <label>
                                <input type="checkbox" name="listing"  <?=(($listing == "on") ? ("checked=true") : (""))?> >
                                <?=system_showText(LANG_SITEMGR_LISTING_SING)?>
                            </label>
                        </div>
                        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" name="event"  <?=(($event == "on") ? ("checked=true") : (""))?> >
                                    <?=system_showText(LANG_SITEMGR_EVENT_SING)?>
                                </label>
                            </div>
                        <? } ?>
                        <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" name="banner"  <?=(($banner == "on") ? ("checked=true") : (""))?> />
                                    <?=system_showText(LANG_SITEMGR_BANNER_SING)?>
                                </label>
                            </div>
                        <? } ?>
                        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" name="classified"  <?=(($classified == "on") ? ("checked=true") : (""))?> />
                                    <?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?>
                                </label>
                            </div>
                        <? } ?>
                        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" name="article"  <?=(($article == "on") ? ("checked=true") : (""))?> />
                                    <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?>
                                </label>
                            </div>
                        <? } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>