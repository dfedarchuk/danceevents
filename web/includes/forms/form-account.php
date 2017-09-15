<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-account.php
	# ----------------------------------------------------------------------------------------------------

    $readonly = "";
	if (DEMO_LIVE_MODE && ($username == "demo@demodirectory.com")) { $readonly = "readonly"; }
	    
    $isForeignAcc = false;
    if ((string_strpos($username, "facebook::") !== false || string_strpos($username, "google::") !== false)) {
        $isForeignAcc = true;
    } ?>

    <div class="col-sm-12 col-md-7">

        <!-- Panel Basic Informartion  -->
        <div class="panel panel-form">

            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_ACCOUNT_INFORMATION)?>
            </div>

            <div class="panel-body">

                <div class="form-group row">
                    <? if ((string_strpos($username, "facebook::") === false && string_strpos($username, "google::") === false)) { ?>
                    <div class="col-sm-6">
                        <label for="username"><?=system_showText(LANG_LABEL_USERNAME)?></label>
                        <input type="email" name="username" id="username" value="<?=$username?>" class="form-control" onblur="populateField(this.value, 'email');"/>
                    </div>
                    <? } else { ?>
                        <input type="hidden" name="username" value="<?=$username?>" />
                    <? }
                    if (!$isForeignAcc) { ?>
                    <div class="col-sm-6">
                        <label for="password"><?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?></label>
                        <input type="text" name="password" id="password" class="form-control" <?=$readonly?> value="<?=($autopw) ? system_generatePassword() : "";?>" />
                    </div>
                    <? } elseif (($id || $account_id) && $isForeignAcc) { ?>
                    <div class="col-sm-6">
                        <label for="email"><?=system_showText(LANG_LABEL_EMAIL)?></label>
                        <input type="text" name="email" id="email" value="<?=$email?>" class="form-control" />
                    </div>
                    <? } ?>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="first_name"><?=system_showText(LANG_LABEL_FIRST_NAME);?></label>
                        <input type="text" name="first_name" id="first_name" value="<?=$first_name?>" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                        <label for="last_name"><?=system_showText(LANG_LABEL_LAST_NAME);?></label>
                        <input type="text" name="last_name" id="last_name" value="<?=$last_name?>" class="form-control" />
                    </div>
                </div>

            </div>

        </div>

        <!-- Panel Contact Informartion  -->
        <div class="panel panel-form" id="tour-contact">

            <div class="panel-heading">
                <?=system_showText(LANG_LABEL_CONTACT_INFORMATION);?> <small class="small text-muted"><?=system_showText(LANG_SITEMGR_LABEL_SPAN_OPTIONAL)?></small>
            </div>

            <div class="panel-body">

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="company"><?=system_showText(LANG_LABEL_COMPANY);?> </label>
                        <input type="text" name="company" id="company" value="<?=$company?>" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                        <label for="website"><?=system_showText(LANG_LABEL_URL)?></label>
                        <input type="text" class="form-control" name="url" id="website" placeholder="Ex: www.website.com" value="<?=$url;?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="phone"><?=system_showText(LANG_LABEL_PHONE)?></label>
                        <input type="tel" name="phone" value="<?=$phone?>" class="form-control" id="phone">
                    </div>
                    <div class="col-sm-6">
                        <label for="fax"><?=system_showText(LANG_LABEL_FAX)?></label>
                        <input type="text" name="fax" value="<?=$fax?>" class="form-control" id="fax">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="address1"><?=system_showText(LANG_LABEL_ADDRESS1)?></label>
                        <input type="text" name="address" value="<?=$address?>" maxlength="50" class="form-control" id="address1" placeholder="Ex: <?=system_showText(LANG_ADDRESS_EXAMPLE)?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="address2"><?=system_showText(LANG_LABEL_ADDRESS2)?></label>
                        <input type="text" name="address2" value="<?=$address2?>" maxlength="50" class="form-control" id="address2" placeholder="Ex: <?=system_showText(LANG_ADDRESS2_EXAMPLE)?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="city"><?=system_showText(LANG_LABEL_CITY)?></label>
                        <input type="text" name="city" value="<?=$city?>" class="form-control" id="city">
                    </div>
                    <div class="col-sm-6">
                        <label for="state"><?=system_showText(LANG_LABEL_STATE)?></label>
                        <input type="text" name="state" value="<?=$state?>" class="form-control" id="state">
                    </div>
                </div>

                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="country"><?=system_showText(LANG_LABEL_COUNTRY)?></label>
                        <input type="text" name="country" value="<?=$country?>" class="form-control" id="country">
                    </div>
                    <div class="col-sm-6">
                        <label for="zipcode"><?=string_ucwords(ZIPCODE_LABEL)?></label>
                        <input type="text" name="zip" value="<?=$zip?>" class="form-control" id="zipcode">
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-5 col-md-5 col-xs-12">
        <br>
        <div class="panel panel-form-media">
            
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_EXTRA_OPTIONS);?>
            </div>
            
            <div class="panel-body">
                <? if (string_strpos($_SERVER["PHP_SELF"], "sponsor.php") !== false) { ?>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="notify_traffic_listing" <?=($notify_traffic_listing == "y" || $notify_traffic_listing == "on" || (!$id && $_SERVER["REQUEST_METHOD"] != "POST")) ? "checked=\"checked\"": "" ?> /> <?=system_showText(LANG_SITEMGR_NOTIFY_TRAFFIC);?>
                            <p class="small text-muted"><?=system_showText(LANG_LABEL_NOTIFY_TRAFFIC_TIP);?></p>
                        </label>
                    </div>

                    <? if (SOCIALNETWORK_FEATURE == "on") { ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="enable_profile" value="on" <?=($enable_profile == "on" || $has_profile == "y" ? "checked=\"checked\"": "")?>> <?=system_showText(LANG_SITEMGR_SN_ENABLE_MEMBER_SECTION);?>
                            <p class="small text-muted"><?=system_showText(LANG_SITEMGR_SPONSOR_VISITOR_TIP);?></p>
                        </label>
                    </div>
                    <? } ?>

                    <input type="hidden" name="account_option" value="is_sponsor">

                <? } else { ?>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="upgrade_visitor" <?=($upgrade_visitor ? "checked=\"checked\"": "");?> /> <?=system_showText(LANG_SITEMGR_UPGRADEVISITOR);?>
                            <p class="small text-muted"><?=system_showText(LANG_SITEMGR_UPGRADEVISITOR_TIP);?></p>
                        </label>
                    </div>

                    <input type="hidden" name="account_option" value="is_member">
                <? } ?>
            </div>
        </div>

    </div>

    <? if (($id || $account_id) && $isForeignAcc) { ?>
        <input type="hidden" name="isforeignAcc" value="y" />
        <input type="hidden" name="foreignaccount" value="y" />
    <? } else { ?>
        <input type="hidden" name="email" id="email" value="<?=$email?>" />
    <? } ?>