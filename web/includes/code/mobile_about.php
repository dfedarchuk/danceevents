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
# * FILE: /includes/code/mobile_about.php
# ----------------------------------------------------------------------------------------------------

extract($_POST);
extract($_GET);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errorMessage == "";
    if ($email && !validate_email($email)) {
        $errorMessage = system_showText(LANG_REVIEW_EMPTY_EMAIL);
    } else {
        if (!setting_set("appbuilder_about_email", $email)) {
            if (!setting_new("appbuilder_about_email", $email)) {
                $error = true;
            }
        }
    }

    if (!setting_set("appbuilder_about_phone", $phone)) {
        if (!setting_new("appbuilder_about_phone", $phone)) {
            $error = true;
        }
    }

    if ($website && string_strpos($website, "http://") === false) {
        $website = "http://".$website;
    }
    if (!setting_set("appbuilder_about_website", $website)) {
        if (!setting_new("appbuilder_about_website", $website)) {
            $error = true;
        }
    }

    if (!setting_set("appbuilder_about_text", $about)) {
        if (!setting_new("appbuilder_about_text", $about)) {
            $error = true;
        }
    }

    if (!$errorMessage) {
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/about/?success=1");
        exit;
    }

}

setting_get("appbuilder_about_email", $email);
if (!$email) {
    setting_get("contact_email", $email);
}
setting_get("appbuilder_about_phone", $phone);
if (!$phone) {
    setting_get("contact_phone", $phone);
}
setting_get("appbuilder_about_website", $website);
if (!$website) {
    $website = DEFAULT_URL;
}
setting_get("appbuilder_about_text", $about);
setting_get("appbuilder_logo_id", $appbuilder_logo_id);
setting_get("appbuilder_logo_extension", $appbuilder_logo_extension);