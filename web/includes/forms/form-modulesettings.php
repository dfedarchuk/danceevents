<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-modulesettings.php
	# ----------------------------------------------------------------------------------------------------

?>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="manageModule" value="<?=$manageModule?>">

    <div class="form-group">
        <h4>
            <?=string_ucwords(system_showText(constant("LANG_SITEMGR_LABEL_CHANGE_".strtoupper($manageModule == "blog" ? "post" : $manageModule)."_STATUS")))?> - <?=$moduleObj->getString($manageModule == "banner" ? "caption" : "title")?>
            <? if ($manageModule != "blog" && $moduleObj->needToCheckOut()) { ?>
            <i class="text-warning small"> <?=string_ucwords(system_showText(LANG_SITEMGR_UNPAIDITEM))?></i>
            <? } ?>
        </h4>
    </div>

    <div id="warningSettings" class="hidden alert alert-warning"></div>

    <div class="form-group row">
        <div class="col-xs-6">
            <label><?=system_showText(LANG_SITEMGR_STATUS)?></label>
            <div class="selectize">
                <?=$statusDropDown?>
            </div>
        </div>
    </div>

    <?
    if ($manageModule != "blog") {

        if ($manageModule == "banner") {

            if (!$moduleObj->hasRenewalDate()) { ?>
                <input type="hidden" name="hasrenewaldate" value="no">
            <? }

            if (!$moduleObj->hasImpressions()) { ?>
                <input type="hidden" name="hasimpressions" value="no">
            <? }

            if ( PAYMENTSYSTEM_FEATURE == "on" && ($moduleObj->getPrice('monthly') > 0 || $moduleObj->getPrice('yearly') > 0) ) {

                //Pre-fill the renewal_date based upon the term purchased for each module
                $current_renewal = $moduleObj->getDate("renewal_date");

                // Monthly
                $moduleObj->renewal_date = $moduleObj->getNextRenewalDate();
                $renewal_date_monthly = $moduleObj->getDate("renewal_date");

                // Yearly
                $moduleObj->setDate("renewal_date", $current_renewal);
                $moduleObj->renewal_date = $moduleObj->getNextRenewalDate(1, "Y");
                $renewal_date_yearly = $moduleObj->getDate("renewal_date");
                ?>

                <div class="form-group">
                    <div class="row form-horizontal">
                        <div class="col-xs-3 radio">
                            <label>
                                <input type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_IMPRESSION?>" <?=(($moduleObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) ? "checked" : "" )?> onclick="bannerDisableRenewalDate()">
                                <?=system_showText(LANG_SITEMGR_IMPRESSIONS)?>
                            </label>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="impressions" id="impressions" value="<?=$moduleObj->getString("impressions");?>" maxlength="6" <?=((!$moduleObj->getString("expiration_setting") || $moduleObj->getString("expiration_setting") != BANNER_EXPIRATION_IMPRESSION) ? "disabled=true" : "")?> class="form-control">
                        </div>
                        <div class="col-xs-5">
                            <label class="control-label"><?=system_showText(LANG_SITEMGR_UNPAID_IMPRESSIONS)?>: <?=$moduleObj->getString("unpaid_impressions");?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row form-horizontal">
                        <div class="col-xs-3 radio">
                            <label>
                                <input type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_RENEWAL_DATE?>" <?=((!$moduleObj->getString("expiration_setting") || $moduleObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) ? "checked" : "" )?> onclick="bannerDisableImpressions()">
                                <?=system_showText(LANG_SITEMGR_RENEWALDATE)?>
                            </label>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="renewal_date" id="renewal_date" value="<?=$current_renewal?>" placeholder="(<?=format_printDateStandard()?>)" <?=(($moduleObj->getString("expiration_setting") && $moduleObj->getString("expiration_setting") != BANNER_EXPIRATION_RENEWAL_DATE) ? "disabled=true" : "" )?> class="form-control date-input">
                        </div>
                        <div class="col-xs-5">
                            <label class="control-label">
                                <?=ucfirst(system_showText(LANG_SITEMGR_RENEWALDATE_AUTOFILL2))?>:<br>
                                <a href="javascript:void(0);" onclick="document.forms['setting_item'].elements['renewal_date'].value='<?=$renewal_date_monthly;?>'"><?=system_showText(LANG_MONTHLY)?></a>
                                <?=system_showText(LANG_OR)?>
                                <a href="javascript:void(0);" onclick="document.forms['setting_item'].elements['renewal_date'].value='<?=$renewal_date_yearly;?>'"><?=system_showText(LANG_YEARLY)?></a>
                            </label>
                        </div>
                    </div>
                </div>

            <? } else { ?>
                <input type="hidden" name="expiration_setting" value="<?=BANNER_EXPIRATION_RENEWAL_DATE?>">
                <input type="hidden" name="renewal_date">
            <? }

        } else {

            if ($moduleObj->hasRenewalDate()) {

                //Pre-fill the renewal_date based upon the term purchased for each module
                $current_renewal = $moduleObj->getDate("renewal_date");

                // Monthly
                $moduleObj->renewal_date = $moduleObj->getNextRenewalDate();
                $renewal_date_monthly = $moduleObj->getDate("renewal_date");

                // Yearly
                $moduleObj->setDate("renewal_date", $current_renewal);
                $moduleObj->renewal_date = $moduleObj->getNextRenewalDate(1, "Y");
                $renewal_date_yearly = $moduleObj->getDate("renewal_date");
                ?>
                <div class="form-group">
                    <label for="renewaldate"><?=system_showText(LANG_SITEMGR_RENEWALDATE)?></label>
                    <div class="row form-horizontal">
                        <div class="col-xs-6">
                            <input type="text" name="renewal_date" id="renewal_date" value="<?=$current_renewal?>" placeholder="(<?=format_printDateStandard()?>)" class="form-control date-input" >
                        </div>
                        <div class="col-xs-6">
                            <label class="control-label">
                                <?=ucfirst(system_showText(LANG_SITEMGR_RENEWALDATE_AUTOFILL2))?>:
                                <a href="javascript:void(0);" onclick="document.forms['setting_item'].elements['renewal_date'].value='<?=$renewal_date_monthly;?>'"><?=system_showText(LANG_MONTHLY)?></a>
                                <?=system_showText(LANG_OR)?>
                                <a href="javascript:void(0);" onclick="document.forms['setting_item'].elements['renewal_date'].value='<?=$renewal_date_yearly;?>'"><?=system_showText(LANG_YEARLY)?></a>
                            </label>
                        </div>
                    </div>
                </div>

            <? } else { ?>
                <input type="hidden" name="hasrenewaldate" value="no">
            <? }
        }

        if ($moduleObj->getString("account_id")) { ?>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="email_notification" id="email_notification" <?=(($_POST["email_notification"] == "1" || !isset($_POST["email_notification"])) ? "checked=\"checked\"" : "" );?> value="1">
                    <?=system_showText(LANG_SITEMGR_SETTING_SENDNOTIFICATION)?>
                </label>
            </div>
        </div>

        <? if (PAYMENT_FEATURE == "on") {
            if (MANUALPAYMENT_FEATURE == "on") { ?>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="add_transaction" id="add_transaction" <?=(($_POST["add_transaction"] == "1") ? "checked=\"checked\"" : "" )?> value="1" onclick="toogleTrans(this)" >
                        <?=system_showText(LANG_SITEMGR_SETTING_ADDTRANSACTIONRECORD)?>
                    </label>
                </div>
            </div>

            <div id="trans_form" style="display: <?=(($_POST["add_transaction"] == "1") ? "block" : "none" )?>;">
                <div class="form-group row">
                    <div class="col-xs-6">
                        <label><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?></label>
                        <input type="text" class="form-control mail-select" name="account_id" id="account_id" placeholder="<?=system_showText(LANG_SITEMGR_SELECT_ACC);?>" value="<?=$account_id?>">
                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                    </div>
                    <div class="col-xs-6">
                        <label for="amount"><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></label>
                        <input type="text" name="amount" id="amount" value="<?=$_POST["amount"]?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes"><?=system_showText(LANG_SITEMGR_LABEL_NOTES)?></label>
                    <textarea name="notes" id="notes" value="1" cols="50" rows="5" class="form-control"><?=$_POST["notes"]?></textarea>
                </div>
            </div>

            <? }
            }
        }
    }
