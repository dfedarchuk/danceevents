<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-export-payment.php
	# ----------------------------------------------------------------------------------------------------

	list($month, $day, $year) = explode("/",date(DEFAULT_DATE_FORMAT, mktime(0, 0, 0, date("m"), date("d"), date("Y"))));
	$date_start = implode("/", array($month, $day, $year-1));
	$date_end = implode("/", array($month, $day, $year));

    if ($message_export_payment) { ?>
        <div id="warning" class="alert alert-warning">
            <?=$message_export_payment?>
        </div>
    <? } ?>

    <div class="form-group form-horizontal row">
        <label class="control-label col-xs-3" for="account_id"><?=system_showText(LANG_LABEL_ACCOUNT);?></label>
        <div class="col-xs-9">
        <input type="text" class="form-control mail-select" name="account_id" id="account_id" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?=$account_id?>">
            <? system_generateAccountDropdown($auxAccountSelectize); ?>
        </div>
    </div>
    <div class="form-group form-horizontal row">
        <label class="control-label col-xs-3" for="date_start"><?=system_showText(LANG_SITEMGR_LABEL_STARTDATE)?></label>
        <div class="col-xs-9">
            <input type="text" name="date_start" id="date_start" value="<?=$_POST["date_start"] ? $_POST["date_start"]: $date_start?>" maxlength="10" class="form-control date-input">
        </div>
    </div>

    <div class="form-group form-horizontal row">
        <label class="control-label col-xs-3" for="date_end"><?=system_showText(LANG_SITEMGR_LABEL_ENDDATE)?></label>
        <div class="col-xs-9">
            <input type="text" name="date_end" id="date_end" value="<?=$_POST["date_end"] ? $_POST["date_end"]: $date_end?>" maxlength="10" class="form-control date-input">
        </div>
    </div>

    <div class="form-group form-horizontal row">
        <label class="control-label col-xs-3"><?=system_showText(LANG_SITEMGR_EXPORT_RECORDTYPE)?></label>
        <div class="col-xs-9">
            <div class="radio">
                <label>
                    <input type="radio" name="type" value="invoice" <?=$type_invoice?>>
                    <?=system_showText(LANG_SITEMGR_EXPORT_INVOICERECORDS)?>
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="type" value="payment" <?=$type_online?>>
                    <?=system_showText(LANG_SITEMGR_EXPORT_TRANSACTIONRECORDS)?>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group form-horizontal row">
        <label class="control-label col-xs-3"><?=system_showText(LANG_SITEMGR_EXPORT_DELIMITER)?></label>
        <div class="col-xs-9">
            <div class="radio">
                <label>
                    <input type="radio" name="delimiter" value="semicolon"> 
                     [ ; ] - <?=system_showText(LANG_SITEMGR_EXPORT_SEMICOLON)?>
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="delimiter" value="comma" checked="checked">
                    [ , ] - <?=system_showText(LANG_SITEMGR_EXPORT_COMMA)?>
                </label>
            </div>
        </div>
    </div>