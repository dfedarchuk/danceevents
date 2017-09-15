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
	# * FILE: /includes/forms/form_listinglevel.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label);

	$levelValue = $levelObj->getValues();
	unset($strArray);
	foreach ($levelValue as $value) {
		$strAux = "<div class=\"plan-box\"><div class=\"plan-title\">".$levelObj->showLevel($value)."</div><div class=\"plan-info\"><mark>";

        $pricingInfo = payment_getPricing("listing", $levelObj, $value, system_showText(LANG_PER));

        if ($pricingInfo["main_price"] > 0) {
            $strAux .= CURRENCY_SYMBOL.$pricingInfo["main_price"];
        } else {
            $strAux .= system_showText(LANG_LABEL_FREE);
        }
        $strAux .= "</mark><p class=\"small\"> ";
        if ($pricingInfo["main_price"] > 0) {
            $strAux .= $pricingInfo["renewal_label"];
        } else {
            $strAux .= "&nbsp;";
        }
        $strAux .= " ".$pricingInfo["renewal_sub"];
		$strAux .= "</p></div></div>";
		$strArray[] = $strAux;
	}

?>

    <h3 class="text-uppercase text-center"><?=system_showText(LANG_LABEL_PRICE_PLURAL);?></h3>

    <section class="block">

        <div class="plans-container">
            <? echo implode("", $strArray); ?>
        </div>

        <? if ($payment_tax_status == "on") { ?>
            <p class="text-center"><br>
               <? echo " (+".$payment_tax_value."% ".$payment_tax_label.")"; ?>
            </p>
        <? } ?>

    </section>

	<h3 class="theme-title"><?=system_showText(LANG_MENU_SELECTLISTINGLEVEL)?></h3>

    <? if ((!$listing) || (($listing) && ($listing->needToCheckOut())) || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || ($claimlistingid) || (($listing) && ($listing->getPrice('monthly') <= 0 && $listing->getPrice('yearly') <= 0))) { ?>

        <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && system_showListingTypeDropdown($listingtemplate_id)) { ?>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="form-group">
                        <label for="listingtemplate_id">
                            <?=system_showText(LANG_LISTING_TEMPLATE);?>:
                        </label>
                        <select id="listingtemplate_id" name="listingtemplate_id" class="btn-sm bs3-select form-control">
                            <?
                            $dbMain = db_getDBObject(DEFAULT_DB, true);
                            $dbObjLT = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                            $sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY editable, title";
                            $resultLT = $dbObjLT->query($sqlLT);
                            while ($rowLT = mysql_fetch_assoc($resultLT)) {
                                $listingtemplate = new ListingTemplate($rowLT["id"]);
                                echo "<option value=\"".$listingtemplate->getNumber("id")."\"";
                                if ($listingtemplate_id == $listingtemplate->getNumber("id")) {
                                    echo " selected";
                                }
                                echo ">".$listingtemplate->getString("title");
                                if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        <? } else { ?>
            <input type="hidden" name="listingtemplate_id" value="<?=$listingtemplate_id?>">
        <? } ?>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <?
                    $levelvalues = $levelObj->getLevelValues();
                    foreach ($levelvalues as $levelvalue) {
                        ?>
                           <div class="radio">
                                <label>
                                    <input type="radio" name="level" value="<?=$levelvalue?>" <? if ($levelArray[$levelObj->getLevel($levelvalue)]) echo "checked"; ?> >
                                    <?=$levelObj->showLevel($levelvalue)?>
                                </label>
                           </div>
                        <?
                    }
                   ?>
                </div>
            </div>
        </div>

    <? } else {

        if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && system_showListingTypeDropdown($listingtemplate_id)) { ?>

            <?=system_showText(LANG_LISTING_TEMPLATE)?>:

            <?
            $listingtemplate = new ListingTemplate($listing->getNumber("listingtemplate_id"));
            if (($listingtemplate) && ($listingtemplate->getNumber("id") > 0)) {
                echo $listingtemplate->getString("title");
            } else {
                echo system_showText(LANG_LABEL_DEFAULT);
            }
            if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
            else echo " (".system_showText(LANG_LABEL_FREE).")";
            ?>

        <? } ?>

        <input type="hidden" name="listingtemplate_id" value="<?=$listingtemplate_id?>">

        <?=system_showText(LANG_LISTING_LEVEL);?> :
        <?=string_ucwords($levelObj->getLevel($level));?>
        <input type="hidden" name="level" value="<?=$level?>">

    <? } ?>