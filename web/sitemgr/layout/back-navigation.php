<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/back-navigation.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="col-xs-12">
        <div class="back-navigation">
            <a href="javascript:void(0);" onclick="window.history.go(<?=(isset($_GET["message"]) ? "-2" : "-1")?>);"><span>&#171;</span><?=system_showText(LANG_SITEMGR_BACK)?></a>
        </div>
    </div>