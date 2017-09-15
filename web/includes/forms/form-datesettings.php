<?php
/**
 * Created by PhpStorm.
 * User: fernandonascimento
 * Date: 13/10/15
 * Time: 17:36
 */
?>

    <div class="col-sm-9">

        <? if ($message) { ?>
            <p class="alert alert-<?=$message_style?>" role="alert"><?=$message;?></p>
        <? } ?>

        <div class="panel panel-default">
            <div class="panel-heading"><?=ucwords(system_showText(LANG_SITEMGR_DATETIME))?></div>
            <div class="panel-body">

                <!-- Multiple Radios (inline) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="date_format"><?=system_showText(LANG_SITEMGR_SETTINGS_DATEFORMAT)?></label>
                    <div class="col-md-4">
                        <label class="radio-inline" for="date_format-0">
                            <input type="radio" name="date_format" id="date_format-0" value="m/d/Y" <?=($date_format == "m/d/Y" ? "checked=\"checked\"" : "")?>>
                            mm-dd-yyyy
                        </label>
                        <label class="radio-inline" for="date_format-1">
                            <input type="radio" name="date_format" id="date_format-1" value="d/m/Y" <?=($date_format == "d/m/Y" ? "checked=\"checked\"" : "")?>>
                            dd-mm-yyyy
                        </label>
                    </div>
                </div>

                <!-- Multiple Radios (inline) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="clock_type"><?=system_showText(LANG_SITEMGR_SETTINGS_CLOCKTYPE)?></label>
                    <div class="col-md-4">
                        <label class="radio-inline" for="clock_type-0">
                            <input type="radio" name="clock_type" id="clock_type-0" value="12" <?=($clock_type == "12" ? "checked=\"checked\"" : "")?>>
                            12 <?=system_showText(LANG_LABEL_HOURS)?>
                        </label>
                        <label class="radio-inline" for="clock_type-1">
                            <input type="radio" name="clock_type" id="clock_type-1" value="24" <?=($clock_type == "24" ? "checked=\"checked\"" : "")?>>
                            24 <?=system_showText(LANG_LABEL_HOURS)?>
                        </label>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="timezone"><?=system_showText(LANG_SITEMGR_SETTINGS_TIMEZONE)?></label>
                    <div class="col-md-4">
                        <?=$timeZoneDropdown?>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" name="datetime_settings" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
            </div>
        </div>
    </div>
