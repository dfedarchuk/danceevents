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
	# * FILE: /functions/front_funct.php
	# ----------------------------------------------------------------------------------------------------

    function front_getHeaderTag(&$headertag_title, &$headertag_author, &$headertag_description, &$headertag_keywords) {

        unset($aux_get_header_tag);
        $aux_get_header_tag = array();
        if (!$headertag_title) {
            $aux_get_header_tag[] = "name = 'header_title'";
        }

        if (!$headertag_author) {
            $aux_get_header_tag[] = "name = 'header_author'";
        }

        if (!$headertag_description) {
            $aux_get_header_tag[] = "name = 'header_description'";
        }

        if (!$headertag_keywords) {
            $aux_get_header_tag[] = "name = 'header_keywords'";
        }

        $return_headertag = customtext_getByArray($aux_get_header_tag);
        if (is_array($return_headertag)) {

            extract ($return_headertag);

            if (array_key_exists ("header_title", $return_headertag)) {
                $headertag_title = ($header_title ? $header_title : EDIRECTORY_TITLE);
            }

            if (array_key_exists ("header_author", $return_headertag)) {
                $headertag_author = ($header_author ? $header_author : "");
            }

            if (array_key_exists ("header_description", $return_headertag)) {
                $headertag_description = ($header_description ? $header_description : "");
            }

            if (array_key_exists ("header_keywords", $return_headertag)) {
                $headertag_keywords	= ($header_keywords ? $header_keywords : "");
            }

        }

        $headertag_title .= " | ".EDIRECTORY_TITLE;

    }

    function front_searchMetaTag() {
        $metaTags = "";
		unset($array_tags);
		$array_tags = array();
		$array_tags[] = "'google'";
		$array_tags[] = "'live'";
		$searchMetaObj = new SearchMetaTag();
		$aux_array_meta_tags = $searchMetaObj->isSetFieldByArray($array_tags);
		if(is_array($aux_array_meta_tags)){
			for($i=0;$i<count($aux_array_meta_tags);$i++){
				$metaTags .= $aux_array_meta_tags[$i];
			}
		}
        return $metaTags;
    }

    function front_getCopyright(&$footer, $linebreak = false) {
        customtext_get("footer_copyright", $footer_copyright);
        $footer = $footer_copyright;
    }

    function front_googleTagManager() {
        if (!DEMO_LIVE_MODE && GOOGLE_TAGMANAGER_ENABLED == "on") {
			include(INCLUDES_DIR."/code/google_tagmanager.php");
        }
    }

    function front_errorPage() {
        header("Location: ".DEFAULT_URL."/404.html");
        exit;
    }

    function front_getBackground($image = false) {

        if (file_exists(EDIRECTORY_ROOT.BKIMAGE_PATH."/".BKIMAGE_NAME.".".BKIMAGE_EXT)) {
            if ($image) {
                return "<img src=\"".DEFAULT_URL.BKIMAGE_PATH."/".BKIMAGE_NAME.".".BKIMAGE_EXT."\" alt=\"".EDIRECTORY_TITLE."\"/>";
            }
            return "background-image: url(".DEFAULT_URL.BKIMAGE_PATH."/".BKIMAGE_NAME.".".BKIMAGE_EXT.");";
        }

        if ($image) {
            return "<img src=\"".DEFAULT_URL."/assets/images/bg-image.jpg\" alt=\"".EDIRECTORY_TITLE."\"/>";
        }

        return "background-image: url(".DEFAULT_URL."/assets/images/bg-image.jpg);";

    }
