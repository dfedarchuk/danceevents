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
	# * FILE: /includes/code/mobileadvert.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST" && !DEMO_LIVE_MODE) {

        $_POST["title"] = trim($_POST["title"]);
		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);
        $_POST["url"] = trim($_POST["url"]);

        /**
        * Image upload
        ****************************************************************************/
        $uploadObj = new UploadFiles();

        $error_size = 0;

        if ($_FILES["image"]["tmp_name"]) {

            if ($_FILES["image"]["error"] == 0) {

                //Check image dimensions
                $forcePNG = true;
                $converted = false;
                $info = @getimagesize($_FILES["image"]["tmp_name"]);
                if ($info[0] != MOBILE_ADVERT_WIDTH || $info[1] != MOBILE_ADVERT_HEIGHT) { //wrong image dimensions. Check if it can be resized.

                    if (($info[0] % MOBILE_ADVERT_WIDTH) || ($info[1] % MOBILE_ADVERT_HEIGHT)) { //image is not proportional.
                        $error_size = 3;
                    } else { //image proportional.
                        $forcePNG = false;
                        $aux_file = image_resizeImage($_FILES["image"]["tmp_name"], MOBILE_ADVERT_WIDTH, MOBILE_ADVERT_HEIGHT);

                        if ($aux_file) {
                            unset($aux_info);
                            $aux_info = getimagesize($aux_file);

                            $_FILES["image"]["tmp_name"] = $aux_file;
                            $_FILES["image"]["size"] = filesize($aux_file);
                            $_FILES["image"]["type"] = $aux_info["mime"];

                            $converted = true;
                            $uploadObj->set("allow_move_files", true);
                        } else {
                            $uploadObj->set("allow_move_files", false);
                        }

                    }

                }

                // Convert JPG to PNG
                if (FORCE_SAVE_JPG_AS_PNG == "on" && $forcePNG) {
                    $aux_file = image_ConvertJPGtoPNG($_FILES["image"]["tmp_name"], $_FILES["image"]["size"], BANNER_UPLOAD_MAX_SIZE_INBYTE);
                    if ($aux_file) {

                        unset($aux_info);
                        $aux_info = getimagesize($aux_file);

                        $_FILES["image"]["tmp_name"] = $aux_file;
                        $_FILES["image"]["size"] = filesize($aux_file);
                        $_FILES["image"]["type"] = $aux_info["mime"];

                        $uploadObj->set("allow_move_files", true);
                    } else {
                        $uploadObj->set("allow_move_files", false);
                    }
                } elseif (!$converted) {
                    $uploadObj->set("allow_move_files", false);
                }

                $types               = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
                $info                = @getimagesize($_FILES["image"]["tmp_name"]);
                $extension           = string_strtolower($types[$info[2]]);
                $row_image['type']   = $types[$info[2]];
                $row_image['width']  = $info[0];
                $row_image['height'] = $info[1];
                $row_image['prefix'] = "sitemgr_";

                $imageObj = new Image($row_image);
                $imageObj->Save();

                $file_name = $imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".".$extension;

                $supported_extensions = array(	"gif"  => "image/gif",
                                                "jpg"  => "image/jpeg,image/pjpeg",
                                                "jpeg" => "image/jpeg,image/pjpeg",
                                                "png"  => "image/png,image/x-png");

                $uploadObj->set("name", $file_name);								// file name.
                $uploadObj->set("type", $_FILES["image"]["type"]);					// file type.
                $uploadObj->set("tmp_name", $_FILES["image"]["tmp_name"]);			// tmp file name.
                $uploadObj->set("error", $_FILES["image"]["error"]);				// file error.
                $uploadObj->set("size", $_FILES["image"]["size"]);					// file size.
                $uploadObj->set("fld_name", "image");								// file field name.
                $uploadObj->set("max_file_size", BANNER_UPLOAD_MAX_SIZE_INBYTE);	// banners will have max 400Kb.
                $uploadObj->set("supported_extensions", $supported_extensions);		// Allowed extensions and types for uploaded file.
                $uploadObj->set("randon_name", FALSE);								// Generate a unique name for uploaded file? bool(true/false).
                $uploadObj->set("replace", FALSE);									// Replace existent files or not? bool(true/false).
                $uploadObj->set("file_perm", 0444);									// Permission for uploaded file. 0444 (Read only).
                $uploadObj->set("dst_dir", IMAGE_DIR);								// Destination directory for uploaded files.
                $result = $uploadObj->moveFileToDestination();						// $result = bool (true/false). Succeed or not.

                if ($uploadObj->error_type == 2) {
                    $error_size = 2;
                } elseif ($uploadObj->error_type == 1) {
                    $error_size = 1;
                }

                if (!$result) { // no image uploaded

                    // deleting the image from database because the upload fail.
                    $imageObj->Delete();
                    unset($imageObj);

                } else { // image uploaded

                    $_POST["image_id"] = $imageObj->getNumber("id");
                    $addedImage = true;

                }
            } elseif ($file["error"] == 1) {
                $error_size = 2;
            }
        }

		if (validate_form("mobileadvert", $_POST, $message_advert, $error_size)) {

            // fixing url field if needed.
            if ( trim( $_POST["url"] ) != "" )
            {
                if ( string_strpos( $_POST["url"], "://" ) === false )
                {
                    $_POST["url"] = "http://" . $_POST["url"];
                }
                $_POST["url"] = $_POST["url"];
            }

            //prepare device info
            $deviceArray = array();
            if ($device_ios) $deviceArray[] = "ios";
            if ($device_android) $deviceArray[] = "android";

            $_POST["device"] = implode(",", $deviceArray);

			header("Location: $url_redirect/index.php?process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
			exit;

		} elseif ($addedImage) {
            $imageObj = new Image($_POST["image_id"]);
			$imageObj->Delete();
			unset($imageObj);
        }

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];

	extract($_POST);
	extract($_GET);

	// if no expiration date, prefill the field within the current date
	if (!$expiration_date) {
		$today = date('Y-m-d');
		$expiration_date = format_date($today);
	}

    //prepare device info
    if ($device) {
        $deviceArray = explode(",", $device);
        if (in_array("ios", $deviceArray)) {
            $device_ios = "1";
        }
        if (in_array("android", $deviceArray)) {
            $device_android = "1";
        }
    }

    //prepare image preview
    if ($image_id) {
        $imageObj = new Image($image_id);
        if ($imageObj->imageExists()) {
            $imagePath = $imageObj->getPath();
        }
    }

	// Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E" && $arrayValue[$i] != "P") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $status, "", "", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

?>
