<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/get_video.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    
    include(CLASSES_DIR."/AutoEmbed-1.8/AutoEmbed.class.php");
    
    $AE = new AutoEmbed();
    
    $_POST["video"] = str_replace("https://", "http://", $_POST["video"]);
    
    // load the embed source from a remote url
    if (!$AE->parseUrl($_POST["video"])) {
        // No embeddable video found (or supported)
        echo "error";
    } else {
        $AE->setWidth('380');
        if (HTTPS_MODE == "on") {
            echo str_replace("http://", "https://", $AE->getEmbedCode());
        } else {
            echo $AE->getEmbedCode();
        }
    }
?>