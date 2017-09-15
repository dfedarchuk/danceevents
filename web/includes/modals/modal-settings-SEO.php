<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-settings-SEO.php
	# ----------------------------------------------------------------------------------------------------

    JavaScriptHandler::registerOnReady('
        $("#modal-settings-SEO-button").click(function(){
            var sentData = {
                google_tag : $("#googleTag").val(),
                live_tag   : $("#liveTag").val()
            };

            $.post( "'.DEFAULT_URL."/".SITEMGR_ALIAS."/promote/seo-center/index.php".'", sentData ).done( function( returnedData ) {
                $("#modal-settings-SEO-messagebox").html( returnedData );
                $("#modal-settings-SEO-button").button( "reset" );
            });
        });
    ');
?>

    <div class="modal fade" id="modal-settings-SEO" tabindex="-1" role="dialog" aria-labelledby="modal-settings-SEO" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=system_showText(LANG_CLOSE);?></span></button>
                    <h4 class="modal-title"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY))?></h4>
                </div>
                <div class="modal-body">
                    <div id='modal-settings-SEO-messagebox'></div>

                    <p>
                        <?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP1)?><br />
                        <?=system_showText(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_TIP2))?><br /><br />
                    </p>

                    <div class="panel panel-default">
                        <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLE))?></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-10 col-sm-offset-1">
                                    <label for="googleTag"><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLETAG)?></label>
                                    <input id='googleTag' class="form-control" type="text" value="<?=string_htmlentities($googleTag)?>" placeholder="<?=string_htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE1))?>">
                                    <a href="https://www.google.com/webmasters/tools/dashboard" target="blank"><?=system_showText(LANG_SITEMGR_SEARCHMETATAGS_GOOGLE)?></a><br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_LIVE))?></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-10 col-sm-offset-1">
                                    <label for="liveTag"><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_LIVETAG)?></label>
                                    <input id='liveTag' class="form-control" type="text" value="<?=string_htmlentities($liveTag)?>" placeholder="<?=string_htmlentities(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_EXAMPLE3))?>">
                                    <a href="http://www.bing.com/toolbox/webmaster" target="blank"><?=system_showText(LANG_SITEMGR_SEARCHMETATAGS_LIVE)?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL);?></button>
                    <button type="button" class="btn btn-primary action-save" id="modal-settings-SEO-button" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->