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
# * FILE: /includes/code/banner.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
// fixing url field if needed.
if (trim($_POST["destination_url"])) {
    if (string_strpos($_POST["destination_url"], "://") === false) {
        $_POST["destination_url"] = "http://" . $_POST["destination_url"];
    }
    $_POST["destination_url"] = $_POST["destination_url"];
}

// validating spaces in caption
$_POST["caption"] = preg_replace('/\s\s+/', ' ', $_POST["caption"]);

// Security ////////////////////////////////////////////////////////////////
if ((sess_isAccountLogged()) && (string_strpos($url_base, "/" . MEMBERS_ALIAS . ""))) {

    unset($_POST["renewal_date"]);
    unset($_GET["renewal_date"]);
    unset($renewal_date);
    unset($_POST["status"]);
    unset($_GET["status"]);
    unset($status);
    unset($_POST["account_id"]);
    unset($_GET["account_id"]);
    unset($account_id);

    $_POST["account_id"] = sess_getAccountIdFromSession();

    $id = ($_POST["id"]) ? $_POST["id"] : (($_GET["id"]) ? $_GET["id"] : "");

    if ($id) {

        $bannerObj = new Banner($id);
        $levelObj = new BannerLevel(true);

        if ($_POST["account_id"] != $bannerObj->getNumber("account_id")) {
            header("Location: $url_redirect/");
            exit;
        }

        // code to get banner price - begin
        $bannerLevelObjTmp = new BannerLevel(true);
        $pricingInfo = payment_getPricing("banner", $bannerLevelObjTmp, $bannerObj->getNumber("type"));
        unset($bannerLevelObjTmp);
        // code to get banner price - end

        ##################################################
        // problem was that free banners can NOT CHANGED type.
        if ($pricingInfo["main_price"] > 0) {
            // so now if banner is free, member can CHANGED its type.
            if (
                (
                    ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) &&
                    ($bannerObj->getString("impressions") > 0)
                )
                ||
                (
                    ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) &&
                    (!$bannerObj->needToCheckOut())
                )
                ||
                (($bannerObj) && ($bannerObj->getPrice('monthly') <= 0 && $bannerObj->getPrice('yearly') <= 0))
            ) {

                unset($_POST["type"]);
                unset($_GET["type"]);
                unset($type);
                $_POST["type"] = $bannerObj->getNumber("type");

            }
        }
        ##################################################

        if (!is_int($_POST["unpaid_impressions"] / $levelObj->getImpressionBlock($_POST["type"]))) {
            unset($_POST["unpaid_impressions"]);
        }
    }

    unset($bannerObj);
    unset($levelObj);

}
////////////////////////////////////////////////////////////////////////////

extract($_POST);
if ($_GET["caption"]) {
    $_GET["caption"] = htmlspecialchars($_GET["caption"]);
}
extract($_GET);

$noImageUp = false;
/**
 * Images upload
 ****************************************************************************/
if ($_FILES) {

    $uploadObj = new UploadFiles();

    $error_size = 0;

    foreach ($_FILES as $key => $file) {

        if ($file["error"] == 0) {

            // Convert JPG to PNG
            if (FORCE_SAVE_JPG_AS_PNG == "on") {
                $aux_file = image_ConvertJPGtoPNG($file["tmp_name"], $file["size"], BANNER_UPLOAD_MAX_SIZE_INBYTE);
                if ($aux_file) {

                    unset($aux_info);
                    $aux_info = getimagesize($aux_file);

                    $file["tmp_name"] = $aux_file;
                    $file["size"] = filesize($aux_file);
                    $file["type"] = $aux_info["mime"];

                    $uploadObj->set("allow_move_files", true);
                } else {
                    $uploadObj->set("allow_move_files", false);
                }
            } else {
                $uploadObj->set("allow_move_files", false);
            }

            $types = ["1" => "GIF", "2" => "JPG", "13" => "SWF", "4" => "SWF", "3" => "PNG"];
            $info = @getimagesize($file["tmp_name"]);
            $extension = string_strtolower($types[$info[2]]);
            $row_image['type'] = $types[$info[2]];
            $row_image['width'] = $info[0];
            $row_image['height'] = $info[1];

            if (string_strpos($_SERVER["PHP_SELF"], "" . SITEMGR_ALIAS . "")) {
                $row_image['prefix'] = "sitemgr_";
            } else {
                $row_image['prefix'] = $_SESSION[SESS_ACCOUNT_ID] . "_";
            }

            if ($_POST["account_id"]) {
                $row_image['prefix'] = $_POST["account_id"] . "_";
            }


            $imageObj = new Image($row_image);
            $imageObj->Save();

            $file_name = $imageObj->getString("prefix") . "photo_" . $imageObj->getNumber("id") . "." . $extension;

            $supported_extensions = [
                "gif"  => "image/gif",
                "jpg"  => "image/jpeg,image/pjpeg",
                "jpeg" => "image/jpeg,image/pjpeg",
                "png"  => "image/png,image/x-png",
                "swf"  => "application/x-shockwave-flash"
            ];

            $uploadObj->set("name", $file_name);                                    // file name.
            $uploadObj->set("type", $file["type"]);                                // file type.
            $uploadObj->set("tmp_name", $file["tmp_name"]);                        // tmp file name.
            $uploadObj->set("error", $file["error"]);                            // file error.
            $uploadObj->set("size", $file["size"]);                                // file size.
            $uploadObj->set("fld_name", $key);                                    // file field name.
            $uploadObj->set("max_file_size", BANNER_UPLOAD_MAX_SIZE_INBYTE);    // banners will have max 400Kb.
            $uploadObj->set("supported_extensions",
                $supported_extensions);        // Allowed extensions and types for uploaded file.
            $uploadObj->set("randon_name",
                false);                                // Generate a unique name for uploaded file? bool(true/false).
            $uploadObj->set("replace",
                false);                                    // Replace existent files or not? bool(true/false).
            $uploadObj->set("file_perm",
                0444);                                    // Permission for uploaded file. 0444 (Read only).
            $uploadObj->set("dst_dir",
                IMAGE_DIR);                                // Destination directory for uploaded files.
            $result = $uploadObj->moveFileToDestination();                        // $result = bool (true/false). Succeed or not.

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
                $_POST["file"] = true; // to form validation work.

                // delete image that will be replaced.
                if ($id) {
                    $bannerObj = new Banner($id);
                    $bannerObj->setString("image_id", "NULL");
                    $bannerObj->save();
                    $imageObj = new Image($bannerObj->getNumber("image_id"));
                    $imageObj->Delete();
                }

                unset($bannerObj);
                unset($imageObj);

            }
        } elseif ($file["error"] == 1) {
            $error_size = 2;
        }

        $i++;
    }


}

/**
 * Delete operation
 ****************************************************************************/
if ($operation == "delete") {

    $message = 0;

    $bannerObj = new Banner($id);
    $bannerObj->Delete();
    unset($bannerObj);

    header("Location: " . $url_redirect . "/index.php?message=" . $message . "&screen=$screen&letter=$letter" . (($url_search_params) ? "&$url_search_params" : "") . "");
    exit;

}

/**
 * Insert Operation
 ****************************************************************************/
if ($operation == "add") {

    $_POST["caption"] = trim($_POST["caption"]);
    if ((validate_form("banner", $_POST, $val_message, $error_size)) && is_valid_discount_code($_POST["discount_id"],
            "banner", $_POST["id"], $val_message, $discount_error_num)
    ) {

        if (($uploadObj->error_type == 0) || ($uploadObj->error_type == 6)) {
            $message = "";
        }
        $error_message .= $val_message . "<br />";
        $message = 1;

        $emailNotification = true;

        // Saving Banner
        $bannerObj = new Banner($_POST);
        if (string_strpos($url_base, "/" . SITEMGR_ALIAS . "")) {
            $bannerObj->setDate("renewal_date", $_POST['renewal_date']); // set date of correct format
        }
        if (!$bannerObj->hasImpressions()) {
            $bannerObj->setNumber("unpaid_impressions", 0);
            $bannerObj->setString("unlimited_impressions", "y");
        } else {
            $bannerObj->setString("unlimited_impressions", "n");
        }

        $bannerObj->Save();
        $id = $bannerObj->getString("id");
        $domain = new Domain(SELECTED_DOMAIN_ID);
        if ((sess_isAccountLogged()) && (string_strpos($url_base, "/" . MEMBERS_ALIAS . ""))) {

            // site manager warning message /////////////////////////////////////
            $domain_url = DEFAULT_URL;
            $domain_url = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $domain_url);

            $acctId = sess_getAccountIdFromSession();
            $accountObj = new Account($acctId);
            $contactObj = new Contact($acctId);

            setting_get("sitemgr_banner_email", $sitemgr_banner_email);
            $sitemgr_banner_emails = explode(",", $sitemgr_banner_email);

            setting_get("new_banner_email", $new_banner_email);

            $emailSubject = system_showText(LANG_NOTIFY_BANNER);
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER) . ",<br /><br />";
            $sitemgr_msg .= ucfirst(system_showText(LANG_BANNER_FEATURE_NAME)) . " \"" . $bannerObj->getString("caption") . "\" " . system_showText(LANG_NOTIFY_ITEMS_2) . " \"" . system_showAccountUserName($accountObj->getString("username")) . "\" " . system_showText(LANG_NOTIFY_ITEMS_3) . "<br /><br />";
            $sitemgr_msg .= "<a href=\"" . $domain_url . "/" . SITEMGR_ALIAS . "/content/" . BANNER_FEATURE_FOLDER . "/banner.php?id=" . $bannerObj->getNumber("id") . "\" target=\"_blank\">" . $domain_url . "/" . SITEMGR_ALIAS . "/content/" . BANNER_FEATURE_FOLDER . "/banner.php?id=" . $bannerObj->getNumber("id") . "</a><br /><br />";
            $sitemgr_msg .= EDIRECTORY_TITLE;
            $error = false;

            if ($new_banner_email) {
                system_notifySitemgr($sitemgr_banner_emails, $emailSubject, $sitemgr_msg);
            }
        }

        if ($_POST["account_id"] > 0) {
            $accountObj = new Account($_POST["account_id"]);
            $contactObj = new Contact($_POST["account_id"]);
            if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_BANNER)) {

                setting_get("sitemgr_email", $sitemgr_email);
                $sitemgr_emails = explode(",", $sitemgr_email);
                setting_get("sitemgr_banner_email", $sitemgr_banner_email);

                if ($sitemgr_banner_email) {
                    $sitemgr_email = $sitemgr_banner_email;
                }

                if ($sitemgr_emails[0]) {
                    $sitemgr_email = $sitemgr_emails[0];
                }

                $subject = $emailNotificationObj->getString("subject");
                $body = $emailNotificationObj->getString("body");
                $body = system_replaceEmailVariables($body, $id, 'banner');
                $body = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
                $subject = system_replaceEmailVariables($subject, $id, 'banner');
                $body = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
                $domain = new Domain(SELECTED_DOMAIN_ID);
                $body = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
                $body = html_entity_decode($body);
                $subject = html_entity_decode($subject);

                Mailer::mail($contactObj->getString("email"), $subject, $body,
                    $emailNotificationObj->getString("content_type"), null, $emailNotificationObj->getString("bcc"));
            }
        }

        $newest = "1";

        setting_get("banner_approve_free", $banner_approve_free);

        if (!$banner_approve_free && !$bannerObj->needToCheckOut()) {
            $bannerObj->setString("status", "A");
            $bannerObj->save();
        }

        unset($bannerObj);

        if (string_strpos($url_base, "/" . MEMBERS_ALIAS . "")) {
            header("Location: " . $url_redirect . "/index.php?module=banner&message=" . $message . "&newest=" . $newest);
        } else {
            header("Location: " . $url_redirect . "/index.php?message=" . $message . "&newest=" . $newest . "&screen=$screen&letter=$letter" . (($url_search_params) ? "&$url_search_params" : "") . "");
        }
        exit;

    } else {

        $imageObj = new Image($_POST["image_id"]);
        $imageObj->Delete();
        unset($imageObj);

    }

    $error_message .= $val_message . "<br />";
    // removing slashes added if required
    $_POST = format_magicQuotes($_POST);
    $_GET = format_magicQuotes($_GET);

    extract($_POST);
    extract($_GET);

}

/**
 * Update Operation
 ****************************************************************************/
if ($operation == "update") {

    $_POST["caption"] = trim($_POST["caption"]);

    if ((validate_form("banner", $_POST, $val_message, $error_size)) && is_valid_discount_code($_POST["discount_id"],
            "banner", $_POST["id"], $val_message, $discount_error_num)
    ) {

        if (($uploadObj->error_type == 0) || ($uploadObj->error_type == 6)) {
            $message = "";
        }
        $error_message .= $val_message;
        $message = 2;

        $statusObj = new ItemStatus();
        $bannerObj = new Banner($id); // Loading banner info into object
        $last_status = $bannerObj->getString("status");

        // Change or not status to Pending and define renew_date
        if (string_strpos($url_base, "/" . SITEMGR_ALIAS . "")) {

            if (!$result && $_POST["account_id"] != $bannerObj->account_id) {
                $image_idB = $bannerObj->getNumber("image_id");

                if ($image_idB) {

                    $imageChange = new Image($image_idB);
                    if ($imageChange->imageExists()) {
                        $oldPrefix = $imageChange->getString("prefix");
                        $newPrefix = $_POST["account_id"] ? $_POST["account_id"] . "_" : "sitemgr_";

                        $img_type = string_strtolower($imageChange->getString("type"));
                        $imageChange->setString("prefix", $newPrefix);
                        $imageChange->Save();

                        $dir = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/image_files";
                        $imageOld = $dir . "/" . $oldPrefix . "photo_" . $image_idB . "." . $img_type;
                        $imageNew = $dir . "/" . $newPrefix . "photo_" . $image_idB . "." . $img_type;
                        rename($imageOld, $imageNew);
                    }
                }
            }

        } else {
            $bannerStatusObj = new ItemStatus();
            if ($bannerObj->getNumber("type") != $_POST["type"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }
            if ($bannerObj->getNumber("section") != $_POST["section"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }
            if ($bannerObj->getNumber("category_id") != $_POST["category_id"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }
            if ($bannerObj->getString("target_window") != $_POST["target_window"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }

            if ($bannerObj->getString("caption") != $_POST["caption"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }

            if ($bannerObj->getString("discount_id") != $_POST["discount_id"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }
            if ($bannerObj->getString("destination_url") != $_POST["destination_url"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }
            if ($bannerObj->getString("display_url") != $_POST["display_url"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }

            if ($bannerObj->getString("content_line1") != $_POST["content_line1"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }
            if ($bannerObj->getString("content_line2") != $_POST["content_line2"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }

            if ($_POST["image_id"]) {
                $_POST["status"] = $bannerStatusObj->getDefaultStatus();
                $changed = true;
            }
        }

        if (!$bannerObj->hasRenewalDate()) {
            $_POST["renewal_date"] = "0000-00-00";
        }
        if (!$bannerObj->hasImpressions()) {
            $_POST["unpaid_impressions"] = 0;
            $_POST["unlimited_impressions"] = "y";
        } else {
            $_POST["unlimited_impressions"] = "n";
        }

        // member can create a banner free and check out it
        // aftet, renewal date will to some periods or impressions will to some blocks
        // because banner is free, member can change his banner type any time
        // if he change his banner type, he MUST pay for this new banner type (it isnt free anymore)
        // any change in banner type, renewal date and impressions go to like new banner
        // ps: just for the case new banner type
        if ($bannerObj->getNumber("type") != $_POST["type"]) {
            $_POST["renewal_date"] = "00/00/0000";
            $_POST["impressions"] = 0;
        }

        $bannerObj->makeFromRow($_POST); // Loading new info into banner

        if ($_POST["type"] < 50) { // Image banners don't have following fields.
            $bannerObj->setString("content_line1", "");
            $bannerObj->setString("content_line2", "");
        } else { // Text banners don't have images.
            $imageObj = New Image($bannerObj->getNumber("image_id"));
            $imageObj->Delete();
            $bannerObj->setString("image_id", "NULL");
        }

        $bannerObj->Save(); // Saving Banner

        if ((sess_isAccountLogged() && $changed) && (string_strpos($url_base, "/" . MEMBERS_ALIAS . ""))) {

            // site manager warning message /////////////////////////////////////
            $domain = new Domain(SELECTED_DOMAIN_ID);
            $domain_url = DEFAULT_URL;
            $domain_url = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $domain_url);

            $acctId = sess_getAccountIdFromSession();
            $accountObj = new Account($acctId);
            $contactObj = new Contact($acctId);

            setting_get("sitemgr_banner_email", $sitemgr_banner_email);
            $sitemgr_banner_emails = explode(",", $sitemgr_banner_email);

            setting_get("update_banner_email", $update_banner_email);

            $error = false;

            $emailSubject = system_showText(LANG_NOTIFY_BANNER);
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER) . ",<br /><br />";
            $sitemgr_msg .= ucfirst(system_showText(LANG_BANNER_FEATURE_NAME)) . " \"" . $bannerObj->getString("caption") . "\" " . system_showText(LANG_NOTIFY_ITEMS_1) . " \"" . system_showAccountUserName($accountObj->getString("username")) . "\" " . system_showText(LANG_NOTIFY_ITEMS_3) . "<br /><br />";
            $sitemgr_msg .= "<a href=\"" . $domain_url . "/" . SITEMGR_ALIAS . "/content/" . BANNER_FEATURE_FOLDER . "/banner.php?id=" . $bannerObj->getNumber("id") . "\" target=\"_blank\">" . $domain_url . "/" . SITEMGR_ALIAS . "/content;/" . BANNER_FEATURE_FOLDER . "/banner.php?id=" . $bannerObj->getNumber("id") . "</a><br /><br />";
            $sitemgr_msg .= EDIRECTORY_TITLE;
            $error = false;

            if ($update_banner_email) {
                system_notifySitemgr($sitemgr_banner_emails, $emailSubject, $sitemgr_msg);
            }

        }

        if (string_strpos($url_base, "/" . MEMBERS_ALIAS . "")) {
            setting_get("banner_approve_updated", $banner_approve_updated);
            if ($last_status == "A" && !$bannerObj->needToCheckOut() && !$banner_approve_updated && $process != "signup") {
                $bannerObj->setString("status", "A");
                $bannerObj->save();
            } else {
                if ($process == "signup") {
                    $bannerObj->setString("status", $last_status);
                    $bannerObj->save();
                }
            }
        }

        unset($bannerObj);

        header("Location: " . $url_redirect . "/index.php?module=banner&process=" . $process . "&newest=" . $newest . "&message=" . $message . "&screen=$screen&letter=$letter" . (($url_search_params) ? "&$url_search_params" : "") . "");
        exit;

    }

    $error_message .= $val_message . "<br />";

    $_POST = format_magicQuotes($_POST);
    $_GET = format_magicQuotes($_GET);

    extract($_POST);
    extract($_GET);

}


# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------

/**
 * Field values
 ****************************************************************************/
if ($id) {

    $bannerObj = new Banner($id);
    $banner_types = $bannerObj->GetString("banner_types");

    // Making local vars from banner object.
    $destination_url = ($_POST["destination_url"]) ? $_POST["destination_url"] : $bannerObj->getString("destination_url",
        true, 0, "", false);
    $display_url = ($_POST["display_url"]) ? $_POST["display_url"] : $bannerObj->getString("display_url", true, 0, "",
        false);

    $caption = ($_POST["caption"]) ? $_POST["caption"] : $bannerObj->getString("caption", true, 0, "", false);

    $discount_id = ($_POST["discount_id"]) ? $_POST["discount_id"] : $bannerObj->getString("discount_id", true, 0, "",
        false);
    $id = $bannerObj->getString("id");

    $image_id = ($_POST["image_id"]) ? $_POST["image_id"] : $bannerObj->getNumber("image_id");

    $status = ($_POST["status"]) ? $_POST["status"] : $bannerObj->getString("status");
    $type = ($_POST["type"]) ? $_POST["type"] : $bannerObj->getString("type");
    $section = ($_POST["section"]) ? $_POST["section"] : $bannerObj->getString("section");
    $account_id = ($_POST["account_id"]) ? $_POST["account_id"] : $bannerObj->getString("account_id");
    $category_id = ($_POST["category_id"]) ? $_POST["category_id"] : $bannerObj->getString("category_id");
    $renewal_date = ($_POST["renewal_date"]) ? $_POST["renewal_date"] : $bannerObj->getDate("renewal_date");
    $target_window = ($_POST["target_window"]) ? $_POST["target_window"] : $bannerObj->getNumber("target_window");

    $content_line1 = ($_POST["content_line1"]) ? $_POST["content_line1"] : $bannerObj->getNumber("content_line1", true,
        0, "", false);

    $content_line2 = ($_POST["content_line2"]) ? $_POST["content_line2"] : $bannerObj->getNumber("content_line2", true,
        0, "", false);

    $expiration_setting = ($_POST["expiration_setting"]) ? $_POST["expiration_setting"] : $bannerObj->getNumber("expiration_setting");
    $unpaid_impressions = ($_POST["unpaid_impressions"]) ? $_POST["unpaid_impressions"] : (($_POST["type"] == $bannerObj->getNumber("type") || !$_POST["type"]) ? $bannerObj->getNumber("unpaid_impressions") : "0");
    $impressions = ($_POST["impressions"]) ? $_POST["impressions"] : $bannerObj->getNumber("impressions");
    $show_type = ($_POST["show_type"]) ? $_POST["show_type"] : $bannerObj->getNumber("show_type");
    $script = ($_POST["script"]) ? $_POST["script"] : $bannerObj->getString("script", true, 0, "", false);

    unset($bannerObj);

    $thisBannerObject = new Banner($id);

}

/**
 * Banner Drop Down
 ****************************************************************************/
$bannerObj = new Banner();
$bannerLevel = new BannerLevel(true);

$nameArray = [];
$valueArray = [];

$sizeArray = [];

foreach ($bannerObj->banner_types as $each_type => $each_value) {

    $bannerLevelObj = new BannerLevel();
    if ($bannerLevelObj->getActive($each_value)) {
        $banner_size = "(" . $bannerLevelObj->getWidth($each_value) . "px x " . $bannerLevelObj->getHeight($each_value) . "px)";

        $sizeArray[$each_value] = $banner_size;

        $nameArray[] = string_ucwords($bannerLevel->getDisplayName($each_value)) . " " . $banner_size;
        $valueArray[] = $each_value;
    }

}

$forceTextForm = false;

if (count($valueArray) == 1 && $valueArray[0] >= 50) {
    $forceTextForm = true;
}

$cases = implode("\n", array_map(function($key, $value){
    return "case {$key}: response = '{$value}'; break;";
}, array_keys($sizeArray), $sizeArray));

$cases and JavaScriptHandler::registerOnReady(<<<JS
    BannerLevels = {
        getLabelForLevel: function(type){
            var response = null;

            switch (Number(type)){
                {$cases}
            }

            return response;
        }
    };
JS
);

$type = (int)$type == 0 ? "1" : $type;
$banner_script = (string_strpos($url_base,
    "/" . SITEMGR_ALIAS . "")) ? "onchange=\"bannerCheckType(this.value)\"" : "onchange=\"bannerCheckType(this.value); bannerFillSelect('" . DEFAULT_URL . "',this.form.unpaid_impressions, this.value," . SELECTED_DOMAIN_ID . ")\"";
$bannerTypeDropDown = html_selectBox("type", $nameArray, $valueArray, $type, $banner_script,
    "class='input-dd-form-banner'", "-- " . system_showText(LANG_LABEL_SELECT_TYPE) . " --");

unset($bannerObj);

/**
 * Impressions Drop Down
 ****************************************************************************/
$nameArray = [];
$valueArray = [];

for ($i = 0; $i < 50; $i++) {
    $bannerLevelObj = new BannerLevel(true);
    $type = ($type) ? $type : $bannerLevelObj->getDefaultLevel();
    $nameArray[] = $bannerLevelObj->getImpressionBlock($type) * $i;
    $valueArray[] = $bannerLevelObj->getImpressionBlock($type) * $i;
}
$disabled = (!$expiration_setting || $expiration_setting != BANNER_EXPIRATION_IMPRESSION) ? "disabled=true" : "";
$bannerImpressionDropDown = html_selectBox("unpaid_impressions", $nameArray, $valueArray, $unpaid_impressions,
    "id='unpaid_impressions' $disabled", "style=\" width: 120px;\"");

unset($bannerLevelObj);

/**
 * Category Drop Down
 ****************************************************************************/
$nameArray = [];
$valueArray = [];
if (!$section || $section == "general") {
    array_push($nameArray, system_showText(LANG_ALLPAGESBUTITEMPAGES));
    $categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id,
        "id=\"category_id\" disabled", "class='input-dd-form-banner' style='width: 350px;'",
        system_showText(LANG_ALLPAGESBUTITEMPAGES));
} elseif (!$section || $section == "global") {
    array_push($nameArray, system_showText(LANG_ALLPAGES));
    $categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id,
        "id=\"category_id\" disabled", "class='input-dd-form-banner' style='width: 350px;'",
        system_showText(LANG_ALLPAGES));
} else {
    if ($section == "listing" || $section == "promotion") {
        $tableCategory = "listingcategory";
    } elseif ($section == "event") {
        $tableCategory = "eventcategory";
    } elseif ($section == "classified") {
        $tableCategory = "classifiedcategory";
    } elseif ($section == "article") {
        $tableCategory = "articlecategory";
    } elseif ($section == "blog") {
        $tableCategory = "blogcategory";
    }

    $categoryScalability = @constant(string_strtoupper(($section == "promotion" ? "listing" : $section)) . "CATEGORY_SCALABILITY_OPTIMIZATION");
    unset($where);
    $where = "category_id IS NULL AND enabled = 'y'";
    $categories = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title", "object", SELECTED_DOMAIN_ID,
        false, "*", $where);
    if ($categories) {
        foreach ($categories as $category) {
            if ($category->getString("title") && $category->getString("enabled") == "y") {
                if ($categoryScalability != "on") {
                    $valueArray[] = "";
                    $nameArray[] = "--------------------------------------------------";
                }
                $valueArray[] = $category->getNumber("id");
                $nameArray[] = $category->getString("title");
                $where = "category_id = " . $category->getNumber("id") . " AND enabled = 'y'";
                $subcategories = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title", "object",
                    SELECTED_DOMAIN_ID, false, "*", $where);
                if ($subcategories && $categoryScalability != "on") {
                    foreach ($subcategories as $subcategory) {
                        if ($subcategory->getString("title") && $subcategory->getString("enabled") == "y") {
                            $valueArray[] = $subcategory->getNumber("id");
                            $nameArray[] = "- " . $subcategory->getString("title");
                            $where = "category_id = " . $subcategory->getNumber("id") . " AND enabled = 'y'";
                            $subcategories2 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title",
                                "object", SELECTED_DOMAIN_ID, false, "*", $where);
                            if ($subcategories2) {
                                foreach ($subcategories2 as $subcategory2) {
                                    if ($subcategory2->getString("title") && $subcategory2->getString("enabled") == "y") {
                                        $valueArray[] = $subcategory2->getNumber("id");
                                        $nameArray[] = "-- " . $subcategory2->getString("title");
                                        $where = "category_id = " . $subcategory2->getNumber("id") . " AND enabled = 'y'";
                                        $subcategories3 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES,
                                            "title", "object", SELECTED_DOMAIN_ID, false, "*", $where);
                                        if ($subcategories3) {
                                            foreach ($subcategories3 as $subcategory3) {
                                                if ($subcategory3->getString("title") && $subcategory3->getString("enabled") == "y") {
                                                    $valueArray[] = $subcategory3->getNumber("id");
                                                    $nameArray[] = "--- " . $subcategory3->getString("title");
                                                    $where = "category_id = " . $subcategory3->getNumber("id") . " AND enabled = 'y'";
                                                    $subcategories4 = db_getFromDB($tableCategory, "", "",
                                                        MAX_SHOW_ALL_CATEGORIES, "title", "object", SELECTED_DOMAIN_ID,
                                                        false, "*", $where);
                                                    if ($subcategories4) {
                                                        foreach ($subcategories4 as $subcategory4) {
                                                            if ($subcategory4->getString("title") && $subcategory4->getString("enabled") == "y") {
                                                                $valueArray[] = $subcategory4->getNumber("id");
                                                                $nameArray[] = "---- " . $subcategory4->getString("title");
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    if ($categoryScalability != "on") {
        $valueArray[] = "";
        $nameArray[] = "--------------------------------------------------";
    }
    $categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "id=\"category_id\"",
        "class='input-dd-form-banner' style='width:350px;'", system_showText(LANG_NONCATEGORYSEARCH));
}

// Status Drop Down
$statusObj = new ItemStatus();
unset($arrayValue);
unset($arrayName);
$arrayValue = $statusObj->getValues();
$arrayName = $statusObj->getNames();
unset($arrayValueDD);
unset($arrayNameDD);
for ($i = 0; $i < count($arrayValue); $i++) {
    if ($status == "E" || $arrayValue[$i] != "E") {
        $arrayValueDD[] = $arrayValue[$i];
        $arrayNameDD[] = $arrayName[$i];
    }
}

$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, ($status ? $status : "A"), "",
    "class=\"form-control status-select\"", "");

//Auxiliary array to prepare the tutorail
$arrayTutorial = [];
$counterTutorial = 0;
