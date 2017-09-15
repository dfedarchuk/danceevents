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
	# * FILE: /includes/forms/form_contact_members.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/newsletter.php");
?>

    <div id="contact-info">

        <h3><?=system_showText(LANG_LABEL_CONTACT_INFORMATION);?></h3>
        <p><?=system_showText(LANG_LABEL_ACCOUNT_CONTACT_TIP);?></p>
        <br>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 well">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name"><?=system_showText(LANG_LABEL_FIRST_NAME);?> <a href="javascript: void(0);"></a></label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="<?=$first_name?>">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_name"><?=system_showText(LANG_LABEL_LAST_NAME);?> <a href="javascript: void(0);"></a></label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="<?=$last_name?>">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="company"><?=system_showText(LANG_LABEL_COMPANY)?></label>
                            <input class="form-control" type="text" name="company" id="company" value="<?=$company?>">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="address"><?=system_showText(LANG_LABEL_ADDRESS1)?> </label>
                            <input class="form-control" type="text" name="address" id="address" value="<?=$address?>" maxlength="50">
                            <p class="help-block"><?=system_showText(LANG_ADDRESS_EXAMPLE)?></p>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="address2"><?=system_showText(LANG_LABEL_ADDRESS2)?></label>
                            <input class="form-control" type="text" name="address2" id="address2" value="<?=$address2?>" maxlength="50">
                            <p class="help-block"><?=system_showText(LANG_ADDRESS2_EXAMPLE)?></p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="country"><?=system_showText(LANG_LABEL_COUNTRY)?></label>
                            <input class="form-control" type="text" name="country" id="country" value="<?=$country?>">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="state"><?=system_showText(LANG_LABEL_STATE)?></label>
                            <input class="form-control" type="text" name="state" id="state" value="<?=$state?>">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="city"><?=system_showText(LANG_LABEL_CITY)?></label>
                            <input class="form-control" type="text" name="city" id="city" value="<?=$city?>">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="zip"><?=string_ucwords(ZIPCODE_LABEL)?></label>
                            <input class="form-control" type="text" name="zip" id="zip" value="<?=$zip?>">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="phone"><?=system_showText(LANG_LABEL_PHONE)?></label>
                            <input class="form-control" type="phone" name="phone" id="phone" value="<?=$phone?>">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fax"><?=system_showText(LANG_LABEL_FAX)?></label>
                            <input class="form-control" type="phone" name="fax" id="fax" value="<?=$fax?>">
                        </div>
                    </div>

                    <? if (($id || $account_id) && $isForeignAcc) { ?>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="email"><?=system_showText(LANG_LABEL_EMAIL)?> <a href="javascript: void(0);"></a></label>
                            <input class="form-control" type="email" name="email" id="email" value="<?=$email?>">
                        </div>
                    </div>
                    <? } ?>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="url"><?=system_showText(LANG_LABEL_URL)?></label>
                            <input class="form-control" type="text" name="url" id="url" value="<?=str_replace($protocol_replace, "", $url)?>">
                        </div>
                    </div>

                    <? if (($id || $account_id) && $isForeignAcc) { ?>
                        <input type="hidden" name="isforeignAcc" value="y">
                        <input type="hidden" name="foreignaccount" value="y">
                    <? } else { ?>
                        <input type="hidden" name="email" id="email" value="<?=$email?>">
                    <? } ?>
                </div>
            </div>
        </div>
    </div>

    <? if (SOCIALNETWORK_FEATURE == "on" || $is_sponsor == "y") { ?>

    <div id="settings">

        <h3><?=system_showText(LANG_LABEL_CONTACT_SETTINGS);?></h3>
        <p><?=system_showText(LANG_LABEL_CONTACT_SETTINGS_TIP);?></p>
        <br>

        <? if (SOCIALNETWORK_FEATURE == "on") { ?>
        <div class="checkbox" style="<?=$has_profile == "y" || !$has_profile ? "" : "display: none;";?>">
            <label>
                <input id="inputpublish" type="checkbox" name="publish_contact" <?=($publish_contact == "y" || $publish_contact == "on") ? "checked=\"checked\"": "" ?>>
                <?=system_showText(LANG_LABEL_PUBLISH_MY_CONTACT);?>
            </label>
        </div>
        <? } ?>

        <? if ($is_sponsor == "y") { ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="notify_traffic_listing" id="notify_traffic_listing" <?=($notify_traffic_listing == "y" || $notify_traffic_listing == "on" || (!$id && $_SERVER["REQUEST_METHOD"] != "POST")) ? "checked=\"checked\"": "" ?>>
                <?=system_showText(LANG_LABEL_NOTIFY_TRAFFIC);?>
            </label>
        </div>
        <? } ?>

        <? if ($showNewsletter) { ?>
        <div class="checkbox">
            <label>
                <input id="inputnewsletter" type="checkbox" name="newsletter" value="y" <?=($newsletter == "y" || $newsletter == "on") ? "checked=\"checked\"": "" ?>>
                <?=$signupLabel?>
            </label>
        </div>
        <? } ?>

    </div>

    <? }
