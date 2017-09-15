<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/dashboard/timeline-pagination.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");
    
    include(INCLUDES_DIR."/code/timeline.php");

    if (is_array($timeline)) {
        foreach ($timeline as $item) if ($item->getNumber("id")) {
            include(SM_EDIRECTORY_ROOT."/dashboard/timeline-item.php");
        }
    }
    
    if ($pageObj->getNumber("next_screen") > 1) { ?>

        <div class="next hidden">
            <a id="t-next" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/dashboard/timeline-pagination.php?where=$where&screen=".$pageObj->getNumber("next_screen")?>">next</a>
        </div>

    <? } ?>