<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-forgot.php
	# ----------------------------------------------------------------------------------------------------

?>

    <form name="forgot_item" id="forgot_item" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
        <input type="hidden" name="id" id="forgot-id" value="" />
        <input type="hidden" name="username" id="forgot-username" value="" />
        <input type="hidden" name="letter" value="<?=$letter?>" />
        <input type="hidden" name="screen" value="<?=$screen?>" />
        <input type="hidden" name="action" value="forgot" />
    </form>

    <div class="modal fade" id="modal-forgot" tabindex="-1" role="dialog" aria-labelledby="modal-forgot" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-danger">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=string_ucwords(system_showText(LANG_SITEMGR_FORGOTTENPASSWORD))?></h4>
                </div>
                <div class="modal-body text-center">
                    <p><?=system_showText(LANG_SITEMGR_ACCOUNT_FORGOTEMAILQUESTION)?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL)?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#forgot_item').submit();"><?=system_showText(LANG_SITEMGR_YESCONTINUE);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->