<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-listing-twilio.php
	# ----------------------------------------------------------------------------------------------------
?>
    <div class="col-md-8">

        <div class="panel panel-form">

            <div class="form-group">
                <div class="panel-heading"><?=system_showText(LANG_CLICKTOCALL_TIPTITLE)?></div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-sm-12">
                            
                            <? if ($error) { ?>
                                <p class="alert alert-warning"><?=$message?></p>
                            <? } elseif ($message) { ?>
                                <p class="alert alert-success"><?=$message?></p>
                            <? } ?>

                        </div>
                        <div class="form-group col-sm-12">

                            <label for="item_clicktocall_number" class="col-sm-3 control-label">
                                <?=system_showText(system_showText(LANG_CLICKTOCALL_PHONE));?>
                            </label>
                            <div class="col-sm-5">
                                <input type="text" name="item_clicktocall_number" id="item_clicktocall_number" value="<?=$item_clicktocall_number ? $item_clicktocall_number : ""?>" maxlength="15" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> class="form-control">
                                <p class="help-block"><?=system_showText(LANG_CLICKTOCALL_TIP7)?></p>
                            </div>

                            <button type="submit" name="submit_button" class="btn btn-primary" value="Submit">
                                <?=system_showText(LANG_CLICKTOCALL_ACTIVATE)?>
                            </button>
                            <button type="button" name="check_button" class="btn btn-warning <?=!$itemObj->getString("clicktocall_number") ? "disabled" : "" ?>" <?=!$itemObj->getString("clicktocall_number") ? " disabled=\"disabled\"" : "onclick=\"changeSendForm('clearNumber');\""?> value="clear" >
                                <?=system_showText(LANG_BUTTON_CLEAR)?>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <p><?=system_showText(LANG_CLICKTOCALL_TIP1)?></p>
                <p><?=system_showText(LANG_CLICKTOCALL_TIP2)?></p>
            </div>
        </div>
    </div>