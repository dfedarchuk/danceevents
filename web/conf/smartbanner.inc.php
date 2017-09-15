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
	# * FILE: /conf/smartbanner.inc.php
	# ----------------------------------------------------------------------------------------------------

    //demodirectory Brazil
	if (strpos($_SERVER["HTTP_HOST"], "demodirectory.com.br") !== false) {
          
        $idIOS = "594460635";
            $idAndroid = "br.com.arcasolutions";
        
    //demodirectory US
    } elseif (strpos($_SERVER["HTTP_HOST"], "demodirectory.com") !== false) {
        
        $idIOS = "337135168";
        $idAndroid = "com.arcasolutions";
        
    }
    
    define("DEMO_MOBILE_APPURL_IOS", $idIOS);
    define("DEMO_MOBILE_APPURL_ANDROID", $idAndroid);