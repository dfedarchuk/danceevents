<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-api.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

    $docLink = "<a target=\"_blank\" href=\"".system_showText(DEFAULT_URL."/api/doc?token=".($edirectory_api_key ? $edirectory_api_key : "[".LANG_SITEMGR_API_TIP6."]"))."\">";
    $docLabel = system_showText(LANG_SITEMGR_API_TIP9);
    $docLabel = str_replace("[OPENLINK]", $docLink, $docLabel);
    $docLabel = str_replace("[CLOSELINK]", "</a>", $docLabel);
    
    $defaultVAR = array	(
		0	=>	array("variable" => "* key",          "description" => system_showText(LANG_SITEMGR_API_VAR_KEY)),
		1	=>	array("variable" => "* module",       "description" => system_showText(LANG_SITEMGR_API_VAR_MODULE)),
		2	=>	array("variable" => "* keyword",      "description" => system_showText(LANG_SITEMGR_API_VAR_KEYWORD)),
		3	=>	array("variable" => "where",        "description" => system_showText(LANG_SITEMGR_API_VAR_WHERE)),
		4	=>	array("variable" => "screen",		"description" => system_showText(LANG_SITEMGR_API_VAR_SCREEN)),
		5	=>	array("variable" => "letter",		"description" => system_showText(LANG_SITEMGR_API_VAR_LETTER))
	);
?>

    <div class="modal fade" id="modal-api" tabindex="-1" role="dialog" aria-labelledby="modal-api" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=system_showText(LANG_CLOSE);?></span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_SITEMGR_API_TIP1)?></h4>
                </div>
                
                <div class="modal-body">
                    <p><?=system_showText(LANG_SITEMGR_API_TIP2)?></p><br>
                    <p>1) <?=system_showText(LANG_SITEMGR_API_TIP3)?></p>
                    <p>2) <?=system_showText(LANG_SITEMGR_API_TIP4)?></p>
                    <br>
                    <pre><code><?=system_showText(DEFAULT_URL."/api/?token=".($edirectory_api_key ? $edirectory_api_key : "[".LANG_SITEMGR_API_TIP6."]"))?></code></pre>
                    <br>
                    <p><?=$docLabel?></p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->