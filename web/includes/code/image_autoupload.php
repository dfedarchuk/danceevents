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
	# * FILE: /includes/code/image_autoupload.php
	# ----------------------------------------------------------------------------------------------------
   
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    $loadSitemgrLangs = true;
    
    if ($_GET["domain_id"]) {
        define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
    }
    
	include("../../conf/loadconfig.inc.php");
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");

    $return = "";
    $error = false;
    $alertDimension = false;

    if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {

        if ($_FILES) {
 
            $i = 1;
            $image_errors = array();

            $maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1)."00000";

            foreach ($_FILES as $key => $value) {

                if (strlen($value["tmp_name"]) > 0) {
                    if (image_upload_check($value["tmp_name"])) {
                        if (strlen($value["name"])) {
                            $_POST[$key] = $value["name"];
                        }
                    } else {
                        $image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
                    }	

                    if ($value["size"] > $maxImageSize) {
                        $image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS." ".UPLOAD_MAX_SIZE."MB.");
                    }
                }
                $i++;
            }

            if (count($image_errors) == 0) {
                if ($_FILES["image"]["error"] == 0) {

                    $info = @getimagesize($_FILES["image"]["tmp_name"]);
                    $types = array("1" => "gif", "2" => "jpg", "3" => "png");
                    $extension = $types[$info[2]];

                    if ($_GET["filename"] == "appbuilder_logo") {
                        $imgWidth = 430;
                        $imgHeight = 320;
                    } elseif ($_GET["filename"] == "appbuilder_icon") {
                        $imgWidth = 1024;
                        $imgHeight = 1024;
                    } elseif ($_GET["filename"] == "appbuilder_splash") {
                        $imgWidth = 2048;
                        $imgHeight = 2048;
                    }
                    
                    if ($info[0] != $imgWidth || $info[1] != $imgHeight) {
                        $alertDimension = true;
                    }

                    setting_get($_GET["filename"]."_id", ${$_GET["filename"]."_id"});
                    
                    if (!${$_GET["filename"]."_id"}) {
                        ${$_GET["filename"]."_id"} = 1;
                    } else {
                        ${$_GET["filename"]."_id"}++;
                    }
                    
                    if (!setting_set($_GET["filename"]."_id", ${$_GET["filename"]."_id"})) {
                        setting_new($_GET["filename"]."_id", ${$_GET["filename"]."_id"});
                    }
                    
                    if (!setting_set($_GET["filename"]."_extension", $extension)) {
                        setting_new($_GET["filename"]."_extension", $extension);
                    }
                    
                    $image_upload = image_uploadForSitemgr(EDIRECTORY_ROOT.IMAGE_APPBUILDER_PATH."/".$_GET["filename"]."_".${$_GET["filename"]."_id"}.".".$extension, $_FILES["image"]["tmp_name"]);
                    if ($image_upload["success"]) {
                        if ($_GET["fullpath"]) {
                            $return = DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/".$_GET["filename"]."_".${$_GET["filename"]."_id"}.".".$extension;
                        } else {
                            $return = "<img src=\"".DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/".$_GET["filename"]."_".${$_GET["filename"]."_id"}.".".$extension."\" />";
                        }
                    } else {
                        $error = true;
                        $return = system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);
                    }
                    
                } else {
                    $error = true;
                    $return = system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);
                }        
            } else {
                $error = true;
                foreach ($image_errors as $imgError) {
                    $return .= $imgError."<br />";
                }
            }

         } else {
             $error = true;
             $return = system_showText(LANG_SITEMGR_BACKGROUND_EMPTY);
        }
    }
         
    echo ($error ? "error" : "ok".($alertDimension ? "_alert" : ""))."||".$return;
?>