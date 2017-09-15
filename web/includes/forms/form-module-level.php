<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-module-level.php
	# ----------------------------------------------------------------------------------------------------
    JavaScriptHandler::registerLoose('
        window.defaultButtonLabel = "'.system_showText(LANG_LABEL_SELECT).'";
        window.selectedButtonLabel = "'.system_showText(LANG_LABEL_SELECTED).'";
    ');
?>

    <section class="row">
        <div class="form-thumbnails">
            <div class="row level-choice">
                <input type="hidden" name="level" id="level" value="">
                <? foreach ($levelvalues as $levelvalue) {
                    $pricingInfo = payment_getPricing($addingModule, $levelObj, $levelvalue);
                    $levelPrice = (is_numeric($pricingInfo["main_price"]) ? CURRENCY_SYMBOL : "").$pricingInfo["main_price"].$pricingInfo["renewal_label"];
                    ?>
                <div class="col-md-2 col-xs-6">
                    <div class="thumbnail levelSelect">
                        <h4><?=$levelObj->showLevel($levelvalue)?></h4>
                        <p class="text-primary"><?=$levelPrice;?></p>
                        <? if ($pricingInfo["renewal_sub"]) { ?>
                        <p class="text-primary"><?=$pricingInfo["renewal_sub"];?></p>
                        <? } ?>
                        <button type="button" class="btn btn-default btn-xs" onclick="selectLevel($(this), <?=$levelvalue;?>);"><?=system_showText(LANG_LABEL_SELECT);?></button>
                    </div>
                </div>
                <? } ?>
            </div>
        </div>
    </section>

    <? if ($addingModule == "listing" && LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && system_showListingTypeDropdown($listingtemplate_id)) { ?>
    <section class="row type-choice hidden">
        <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="">
        <input type="hidden" name="listingtemplate_feature" id="listingtemplate_feature" value="yes">
        <div class="form-thumbnails">
            <h4><?=system_showText(LANG_SITEMGR_LABEL_SELECT_LISTINGTEMPLATE);?></h4>
            <p><?=str_replace("[a]", "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/listing-types/\" target=\"_blank\">",str_replace("[/a]", "</a>", system_showText(LANG_SELECT_LISTINGTEMPLATE_TIP)));?></p>
            <br>
            <div class="row">
                <? while ($rowLT = mysql_fetch_assoc($resultLT)) {
                    $listingtemplate = new ListingTemplate($rowLT["id"]); ?>
                <div class="col-md-2 col-xs-6">
                    <div class="thumbnail typeSelect">
                        <div class="caption">
                            <h6><?=$listingtemplate->getString("title");?></h6>
                            <p class="text-primary">
                                <? if ($listingtemplate->getString("price") > 0) { ?>
                                <?="+".CURRENCY_SYMBOL.$listingtemplate->getString("price");?>
                                <? } else { echo "&nbsp;"; } ?>
                            </p>
                            <button type="button" class="btn btn-default btn-xs" onclick="selectType($(this), <?=$rowLT["id"];?>);"><?=system_showText(LANG_LABEL_SELECT);?></button>
                        </div>
                    </div>
                </div>
                <? } ?>
            </div>
        </div>
    </section>
    <? } else { ?>
        <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>">
    <? } ?>
