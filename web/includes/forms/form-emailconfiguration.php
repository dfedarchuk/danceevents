<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-emailconfiguration.php
	# ----------------------------------------------------------------------------------------------------
?>

    <form role="form" name="adminemail" id="adminemail" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" onsubmit="return submitForm()">
        <input type="hidden" name="ajaxVerify" id="ajaxVerify" value="1" />
        <input type="hidden" name="emailconf_method" value="smtp" />
        
        <? if ($message_confemail) { ?>
            <p class="alert alert-<?=$message_style?>"><?=$message_confemail?></p>
        <? }

        if (string_strpos($_SERVER["PHP_SELF"], "domain") === false) {
            $styleButtonClick = "onclick=\"switchAuth(this.value);";
        }
        $styleButtonClick .=" disableButton();\"";
        ?>
        
        <div id="form-smtp" class="panel panel-default">
            <div class="panel-heading"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SMTPSERVERINFORMATION)?></div>
            <div class="panel-body form-horizontal">
                <div class="form-group">
                    <label for="host" class="control-label col-sm-3"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_LABEL_SERVER)?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="emailconf_host" id="host" <? if ($emailconf_host) echo "value=\"$emailconf_host\""; ?> <?=$styleButtonChange?>>
                    </div>
                    <label for="port" class="control-label col-sm-2"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_LABEL_PORT)?></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="emailconf_port" id="port" <? if ($emailconf_port) echo "value=\"$emailconf_port\""; ?> <?=$styleButtonChange?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="radio">
                            <label for="auth1"><input type="radio" name="emailconf_auth" id="auth1" value="normal" <?=$styleButtonClick?>><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION1)?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        <div class="radio">
                            <label for="auth2" class="row col-sm-12">
                                <div class="col-sm-10">
                                    <input type="radio" name="emailconf_auth" id="auth2" value="secure" <?=$styleButtonClick?>><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION2)?>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="selectize col-sm-2">
                        <select name="emailconf_protocol" id="protocol" onchange="switchPorts(this.value)">
                            <option value="ssl" <?=($emailconf_protocol == "ssl" ? "selected" : "")?> >SSL</option>
                            <option value="tls" <?=($emailconf_protocol == "tls" ? "selected" : "")?> >TLS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="radio">
                            <label for="auth3"><input type="radio" name="emailconf_auth" id="auth3" value="noauth" <?=$styleButtonClick?>><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION3)?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-sm-3">
                        <?=system_showText(LANG_SITEMGR_LABEL_EMAILADDRESS)?>
                    </label>
                    <div class="col-sm-5">
                        <div id="email_group">
                            <input type="text" class="form-control" name="emailconf_email" id="email" <? if ($emailconf_email) echo "value=\"$emailconf_email\""; ?> onkeyup="emailChange(this.value)" onkeypress="emailChange(this.value)" onblur="emailBlur(this.form)" <?=$styleButtonChange?>>
                            <span class="" id="email_status"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="control-label col-sm-3">
                        <?=system_showText(LANG_SITEMGR_USERNAME)?>
                    </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="emailconf_username" id="username" <? if ($emailconf_username) echo "value=\"$emailconf_username\""; ?>  <?=$styleButtonChange?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label col-sm-3">
                        <?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>
                    </label>
                    <div class="col-sm-5">
                        <input class="form-control" type="password" name="emailconf_password" id="password" <?=$styleButtonChange?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-3">
                        <div id="response"></div>
                    </div>
                </div>
            </div>
            <? if (!$step) { ?>
            <div class="panel-footer">
                <button type="submit" name="bt_submit" id="bt_submit" value="Submit" class="btn btn-<?=($emailconf_method == 'smtp' ? "default" : "primary")?>" <?=($emailconf_method == 'smtp' ? "disabled=\"disabled\"" : "")?> data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SAVECONFIGURATION)?></button>
            </div>
            <? } ?>
        </div>
    </form>