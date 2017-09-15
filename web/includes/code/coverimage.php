<?php

    //Ajax requests
    if ($_GET["action"] == "ajax") {
        //Upload cover image
        if ($_GET["type"] == "uploadCover") {

            $return = "";
            $error = false;

            if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {

                if ($_FILES["cover-image"] && strlen($_FILES["cover-image"]["tmp_name"]) > 0) {

                    $image_errors = array();

                    $maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1) . "00000";

                    if (!image_upload_check($_FILES["cover-image"]["tmp_name"])) {
                        $image_errors[] = "&#149;&nbsp; " . system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
                    }

                    if ($_FILES["cover-image"]["size"] > $maxImageSize) {
                        $image_errors[] = "&#149;&nbsp; " . system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS . " " . UPLOAD_MAX_SIZE . "MB.");
                    }

                    if (count($image_errors) == 0) {
                        if ($_FILES["cover-image"]["error"] == 0) {

                            $imageObj = image_upload($_FILES["cover-image"]["tmp_name"], "", "", ($_GET["account_id"] ? $_GET["account_id"] : "sitemgr_"), false, false);
                            if ($imageObj) {
                                $return = "<input type='hidden' name='cover_id' value='" . $imageObj->getNumber("id") . "'>";
                                $return .= $imageObj->getTag(false, 0, 0, "", false, false, "img-responsive");
                            }

                        } else {
                            $error = true;
                            $return = system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);
                        }
                    } else {
                        $error = true;
                        foreach ($image_errors as $imgError) {
                            $return .= $imgError . "<br />";
                        }
                    }

                } else {
                    $error = true;
                    $return = system_showText(LANG_SITEMGR_IMAGE_EMPTY);
                }
            }

            echo ($error ? "error" : "ok") . "||" . $return;

        //Delete cover image
        } elseif ($_GET["type"] == "deleteCover" && $_SERVER["REQUEST_METHOD"] == "POST") {

            if ($_POST["id"]) {
                $moduleStr = ($_GET["module"] == "blog" ? "Post" : ucfirst($_GET["module"]));
                $moduleObj = new $moduleStr($_POST["id"]);
                // Sets NULL in SQL
                $moduleObj->setString("cover_id", 'NULL');
                $moduleObj->save();
            }

            $imgObj = new Image($_POST["curr_cover_id"]);
            if ($imgObj->getNumber("id")) {
                $imgObj->delete();
            }

            $newImageReturn = "<input type='hidden' name='cover_id' value=''>";

            echo "ok||".$newImageReturn;

        }
        exit;
    }
