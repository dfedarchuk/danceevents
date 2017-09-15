<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-email.php
	# ----------------------------------------------------------------------------------------------------

if ($message) { ?>
    <div class="alert <?=$message_style?>">
        <?=$message?>
    </div>
<? } ?>

<div class="col-sm-7">

    <div class="panel panel-form">

        <div class="panel-heading">
            <?=system_showText(LANG_LABEL_DESCRIPTION)?>
        </div>

        <div class="panel-body">

            <? if ($emailNotificationObj->getNumber("id") == 36) { ?>
            <div class="form-group">
                <label><?=system_showText(LANG_SITEMGR_SEND_LISTINGLEVELS)?></label>
                <div class="form-horizontal">
                  <? foreach ($levelValue as $value) { ?>
                    <div class="checkbox-inline">
                        <label>
                            <input type="checkbox" name="email_traffic_listing_<?=$value?>" value="on" <?=((${"email_traffic_listing_".$value} == "on") ? "checked": "")?> style="width: auto; border: 0;" class="inputCheck" />
                            <?=$listingLevelObj->showLevel($value)?>
                        </label>
                    </div>
                  <? } ?>
                </div>
            </div>
            <? } ?>

            <div class="form-group">
                <label><?=system_showText(LANG_SITEMGR_LABEL_CONTENTTYPE)?></label>
                <div class="form-horizontal">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="content_type" value="text/html" <?=(($content_type == "text/html") ? "checked": "")?> onclick="cKEditor(true);" />
                            <?=system_showText(LANG_SITEMGR_LABEL_HTML)?>
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="content_type" value="text/plain" <?=(($content_type == "text/plain") ? "checked": "")?> onclick="cKEditor(false);" />
                            <?=system_showText(LANG_SITEMGR_LABEL_TEXT)?>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="bcc"><?=system_showText(LANG_SITEMGR_LABEL_BCC)?></label>
                <input class="form-control" type="email" name="bcc" id="bcc" maxlength="255" size="35" value="<?=$bcc?>" />
            </div>

            <div class="form-group">
                <label for="subject"><?=system_showText(LANG_SITEMGR_LABEL_SUBJECT)?></label>
                <input class="form-control" type="text" name="subject" id="subject" maxlength="255" size="35" value="<?=$subject?>" />
            </div>

        </div>

    </div>

</div>

<div class="col-sm-5">
    <br>
    <div class="panel panel-form-media">

        <div class="panel-heading">
            <?=system_showText(LANG_LABEL_OPTIONS)?>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <label><?=system_showText(LANG_SITEMGR_LABEL_RESTOREDEFAULTMESSAGE)?>:</label>
                <p>
                    <input class="btn btn-default" type="button" name="reset_html" id="reset_html" value="<?=system_showText(LANG_SITEMGR_LABEL_HTML)?>" onclick="confirmRestore('<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_OVERWRITEDEFAULTQUESTION)?>',this.id,this.form.name)" class="input-button-form2 button-space" />
                    <input class="btn btn-default" type="button" name="reset_text" id="reset_text" value="<?=system_showText(LANG_SITEMGR_LABEL_TEXT)?>" onclick="confirmRestore('<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_OVERWRITEDEFAULTQUESTION)?>',this.id,this.form.name)" class="input-button-form2 button-space" />
                    <input class="btn btn-default" type="hidden" name="hiddenValue">
                </p>
            </div>

        </div>

    </div>

</div>

<div class="col-sm-12">
    <!-- Panel HTML Content -->
    <div class="panel panel-form">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_LABEL_BODY)?>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?
                // calling CKEditor
                $load = $content_type == "text/html" ? true : false;
                setting_get('sitemgr_language', $lang);
                system_addCKEditor("body", $body, 20, 15, $lang, 'width: 100%', $load, true, true);
                ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_HELP_VARIABLESDESCRIPTION)?>
        </div>
        <div class="panel-body">
            <p><?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_HELP_USEVARIABLES)?></p>
        </div>
        <table class="table table-bordered small">
        <? if ($variables) { ?>
            <? foreach ($variables as $var) { ?>
                <tr>
                    <th><?=$var?></th>
                    <td><?=$defaultVAR[$var]?></td>
                </tr>
            <? } ?>
        <? } ?>
        </table>
    </div>

</div>
