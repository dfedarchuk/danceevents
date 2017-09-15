<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-livemode.php
	# ----------------------------------------------------------------------------------------------------

    //Modal section
    if (string_strpos($_SERVER["PHP_SELF"], "/sites/site.php") !== false) {
        $modalMessage = system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE4);
        $close = false;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/appbuilder/finalstep.php") !== false || string_strpos($_SERVER["PHP_SELF"], "/appbuilder/") !== false || string_strpos($_SERVER["PHP_SELF"], "/notification.php") !== false || string_strpos($_SERVER["PHP_SELF"], "/advert.php") !== false) {
        $modalMessage = system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2);
        $modalMessage2 = system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ACTIVATIONISREQUIRED);
        $close = true;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/language") !== false) {
        $modalMessage = system_showText(LANG_SITEMGR_LANGUAGE_DEMO_MESSAGE);
        $close = true;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/design") !== false) {
        $modalMessage = system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE);
        $close = true;
    } elseif (
            string_strpos($_SERVER["PHP_SELF"], "basic-information/index.php") !== false ||
            string_strpos($_SERVER["PHP_SELF"], "contentlevel.php") !== false ||
            string_strpos($_SERVER["PHP_SELF"], "promote-apps/index.php") !== false
            ) {
        $modalMessage = system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2);
        $close = true;
    }

?>

    <div class="modal fade" id="modal-live" tabindex="-1" role="dialog" aria-labelledby="modal-live" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-danger">
                <div class="modal-header">
                    <? if ($close) { ?>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <? } ?>
                    <h4 class="modal-title">Oops...</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="live_messages" id="message_1"><?=$modalMessage;?></p>
                    <p class="live_messages" id="message_2" style="display:none"><?=$modalMessage2;?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="modal-back" type="button" onclick="BackHistory();"><?=system_showText(LANG_SITEMGR_BACK);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
