<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-custominvoices.php
	# ----------------------------------------------------------------------------------------------------

?>

<input type="hidden" name="id" value="<?=$id?>">

<div class="col-md-8 col-sm-offset-2">
    <? MessageHandler::render(); ?>

    <div class="panel panel-default">
		<div class="panel-heading"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_INFORMATION)?></div>
		<div class="panel-body">
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="title"><?=system_showText(LANG_SITEMGR_TITLE)?></label>
					<input id="title" class="form-control" type="text" name="title" value="<?=$title?>" maxlength="100">
				</div>
				<div class="form-group col-sm-6">
					<label for='account_id'><?=system_showText(LANG_LABEL_ACCOUNT)?></label>
					<input id='account_id' class="form-control mail-select" type="text" name="account_id" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?=$account_id?>">
                    <? system_generateAccountDropdown($auxAccountSelectize); ?>
				</div>
			</div>
		</div>
	</div>

    <div class="panel panel-default">
		<div class="panel-heading"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_ITEMS)?></div>
		<div class="panel-body">
            <div class="row">
                    <div class="col-sm-6">
                        <?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?> <?=system_showText(LANG_SITEMGR_LABEL_MAX255CHARS)?>
                    </div>
                    <div class="col-sm-6">
                        <?=system_showText(LANG_SITEMGR_LABEL_PRICE)?> <i class="form-tip icon-help10" data-toggle="tooltip" data-original-title="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_MSG_DEFAULTPRICE);?>"></i>

                    </div>
                </div>

                <? for ($i = 0; $i < CUSTOM_INVOICE_ITEMS_NUMBER; $i++)
                { ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" type="text" name="item_desc[<?=$i?>]" value="<?=$item_desc[$i]?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_ITEM)?> <?=$i+1?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" type="number" step="0.01" name="item_price[<?=$i?>]" value="<?=$item_price[$i]?>" placeholder="<?=CURRENCY_SYMBOL?>">
                        </div>
                    </div>
                </div>
            <?  } ?>
		</div>
		<div class="panel-footer">
            <button class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" type="submit"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
		</div>
	</div>
</div>
