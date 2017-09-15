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
	# * FILE: /includes/forms/form-mailappsignup.php
	# ----------------------------------------------------------------------------------------------------

?>
    <div class="col-lg-8 col-lg-offset-2 newsletter-style">

        <div class="panel panel-form-media">

            <a name="account"></a>

            <div class="panel-heading">1. <?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_1_TIP);?></div>

            <div class="panel-body">
                <form name="mailappdisconnect" id="arcamailer_disconnect" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                    <input type="hidden" name="disconnet" value="yes" />
                </form>

                <ul class="nav nav-tabs">
                    <li id="tab_account_0" <?=($account_type == "new" || !$account_type) ? "class=\"active\"" : ""?>>
                        <a href="javascript:void(0);" onclick="showAccountTabs(0, 'new');"><?=system_showText(LANG_SITEMGR_MAILAPP_NEWACCOUNT);?></a>
                    </li>
                    <li id="tab_account_1" <?=($account_type == "existing") ? "class=\"active\"" : ""?>>
                        <a href="javascript:void(0);" onclick="showAccountTabs(1, 'existing');"><?=system_showText(LANG_SITEMGR_MAILAPP_EXISTINGACCOUNT);?></a>
                    </li>
                </ul>

                <form name="mailapp" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                    <input type="hidden" name="actionForm" value="newAcc" />
                    <input type="hidden" id="accType" name="account_type" value="<?=($account_type ? $account_type : "new");?>" />

                    <div id="account_0" class="form-group" <?=($account_type == "new" || !$account_type) ? "" : "style=\"display:none;\""?>>

                        <? if ($message_mailapp && $actionForm == "newAcc" && $account_type == "new") { ?>
                            <p class="alert alert-warning"><?=$message_mailapp;?></p>
                        <? } elseif ($messageSignup) { ?>
                            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MAILAPP_ACCDONE);?></p>
                        <? } elseif ($messageConnect) { ?>
                            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MAILAPP_CONNECTDONE);?></p>
                        <? } elseif ($messageDisconnect) { ?>
                            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MAILAPP_DISCONNECTDONE);?></p>
                        <? } ?>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-bust"></i></span>
                                    <input type="text" class="form-control" id="idname" name="edir_name" placeholder="<?=system_showText(LANG_SITEMGR_MAILAPP_NAME);?>" value="<?=$edir_name;?>" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-mail20"></i></span>
                                    <input class="form-control" type="email" id="idemail" name="edir_email" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAILADDRESS);?>" value="<?=$edir_email;?>" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 selectize">
                                <select name="edir_country" id="edir_country" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>>
                                    <option value=""><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY);?></option>
                                    <?=$countryOptions;?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 selectize">
                                <select name="edir_timezone" id="edir_timezone" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>>
                                    <option value=""><?=system_showText(LANG_SITEMGR_MAILAPP_TIMEZONE);?></option>
                                    <?=$timezoneOptions;?>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <p class="help-block"> <?=system_showText(LANG_SITEMGR_MAILAPP_FREEACC);?></p>
                            </div>
                        </div>

                        <? if ($edir_customer_id) { ?>
                            <button type="button" onclick="disconnect();" class="btn btn-primary"><?=system_showText(LANG_SITEMGR_MAILAPP_DISCONNECTACC);?></button>
                        <? } else { ?>
                            <button type="submit" class="btn btn-primary"><?=system_showText(LANG_SITEMGR_MAILAPP_CREATEACC);?></button>
                        <? } ?>

                    </div>

                </form>

                <form name="mailapp2" id="mailapp2" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                    <input type="hidden" name="actionForm" value="newAcc" />
                    <input type="hidden" id="accType2" name="account_type" value="<?=($account_type ? $account_type : "new");?>" />

                    <div id="account_1" class="form-group" <?=($account_type == "existing") ? "" : "style=\"display:none;\""?>>


                        <? if ($message_mailapp && $actionForm == "newAcc" && $account_type == "existing") { ?>
                            <p class="alert alert-warning"><?=$message_mailapp;?></p>
                        <? } elseif ($messageSignup) { ?>
                            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MAILAPP_ACCDONE);?></p>
                        <? } ?>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-bust"></i></span>
                                    <input class="form-control" type="text" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?> name="arcamailer_username" placeholder="<?=system_showText(LANG_SITEMGR_MAILAPP_USERNAME);?>" value="<?=$arcamailer_username;?>" <?=($edir_list_id ? "disabled=\"disabled\"" : "")?>/>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-mail20"></i></span>
                                    <input class="form-control" type="password" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?> name="arcamailer_password" placeholder="<?=system_showText(LANG_SITEMGR_MAILAPP_PASSWORD);?>" <?=($edir_list_id ? "disabled=\"disabled\"" : "")?>/>
                                </div>
                            </div>
                        </div>

                        <? if ($edir_customer_id) { ?>
                            <button type="button" onclick="disconnect();" class="btn btn-primary"><?=system_showText(LANG_SITEMGR_MAILAPP_DISCONNECTACC);?></button>
                        <? } else { ?>
                            <button type="submit" class="btn btn-primary"><?=system_showText(LANG_SITEMGR_MAILAPP_CONNECTACC);?></button>
                        <? } ?>

                        <br>

                    </div>

                </form>

            </div>

        </div>

        <br>

        <div class="panel panel-form-media">

            <div class="panel-heading">2. <?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_2_TIP);?></div>

            <form name="mailapp" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                <input type="hidden" name="actionForm" value="newList" />
                <input type="hidden" name="edir_customer_id" value="<?=$edir_customer_id?>" />
                <input type="hidden" name="edir_list_id" value="<?=$edir_list_id?>" />

                <div class="panel-body">

                    <a name="newsletter"></a>

                    <? if ($message_mailapp && $actionForm == "newList") { ?>
                        <p class="alert alert-warning"><?=$message_mailapp;?></p>
                    <? } elseif ($messageUpdate) { ?>
                        <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MAILAPP_LISTUPDATE);?></p>
                    <? } elseif ($messageNewList) { ?>
                        <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MAILAPP_LISTCREATE);?></p>
                    <? } ?>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="idlist"><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTER);?></label>
                            <input class="form-control" type="text" id="idlist" name="edir_list" <?=(!$edir_customer_id ? "disabled=\"disabled\"" : "")?> maxlength="50" value="<?=($edir_list ? $edir_list : EDIRECTORY_TITLE." ".LANG_SITEMGR_MAILAPP_NEWSLETTER_SING);?>" <?=($edir_list_id ? "disabled=\"disabled\"" : "")?>/>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary <?=(!$edir_customer_id ? "buttonDisabled" : "")?>" <?=(!$edir_customer_id ? "disabled=\"disabled\"" : "")?>><?=system_showText(LANG_BUTTON_SUBMIT);?></button>
                        <br>
                    </div>

                </div>

            </form>

        </div>

        <br>

        <div class="panel panel-form-media">

            <div class="panel-heading">3. <?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_3_TIP);?></div>

            <div class="panel-body">
                <div class="form-group">
                    <button type="button" class="btn btn-primary " onclick="openLogin();"><?=system_showText(LANG_SITEMGR_MAILAAP_LOGIN);?></button>
                </div>
            </div>

        </div>

    </div>
