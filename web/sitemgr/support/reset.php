<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/support/reset.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# THIS PAGE IS ONLY USED BY THE SUPPORT
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();

if (!sess_getSMIdFromSession()) {
    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
    exit;
} else {
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $sql = "SELECT username FROM SMAccount WHERE id = ".sess_getSMIdFromSession();
    $row = mysql_fetch_assoc($dbMain->query($sql));
    if ($row["username"] != ARCALOGIN_USERNAME) {
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
        exit;
    }
}

$url_redirect = DEFAULT_URL."/".SITEMGR_ALIAS."/support/reset.php";
extract($_GET);
extract($_POST);

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
if ($action) {

    switch ($action) {
        case "sitemgr":
            if ($sitemgrpass) {
                $pwDBObj = db_getDBObject(DEFAULT_DB, true);
                $sql = "UPDATE Setting SET value = ".db_formatString(md5($sitemgrpass))." WHERE name = 'sitemgr_password'";
                $pwDBObj->query($sql);
            }
            if ($sitemgrusername) {
                $pwDBObj = db_getDBObject(DEFAULT_DB, true);
                $sql = "UPDATE Setting SET value = ".db_formatString($sitemgrusername)." WHERE name = 'sitemgr_username'";
                $pwDBObj->query($sql);
            }
            break;
        case "langFiles":
            $langObj = new Lang();
            $langObj->writeLanguageFile();

            if (!setting_set("configChecker_lang", "on")) {
                if (!setting_new("configChecker_lang", "on")) {
                    $error = true;
                }
            }
            break;
        case "Theme":
            //Update theme folder
            $auxThemes = explode(",", EDIR_THEMES);
            $customThemeFolder = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme";

            if ((int)system_checkPerm($customThemeFolder) < (int)PERMISSION_CUSTOM_FOLDER) {
                $stepError = true;
            }

            if (!$stepError) {

                unset($themes);
                $customThemeFolder = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme";
                $dir = opendir($customThemeFolder);
                while ($theme_folder = readdir($dir)) {
                    if (in_array($theme_folder, $auxThemes)) {
                        $themes[] = $theme_folder;
                    }
                }

                foreach ($themes as $theme) {
                    $src = EDIRECTORY_ROOT."/theme/$theme";
                    $dst = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme/".$theme;
                    if ((int)system_checkPerm($dst) >= (int)PERMISSION_CUSTOM_FOLDER) {
                        $domain = new Domain(SELECTED_DOMAIN_ID);
                        $domain->copyThemeToDomain($src, $dst);
                    } else {
                        $errorFolder = true;
                    }
                }

            } else {
                $errorFolder = true;
            }

//            if (!setting_set("configChecker_theme", "on")) {
//                if (!setting_new("configChecker_theme", "on")) {
//                    $error = true;
//                }
//            }
            break;
        case "signIn":
            if (!setting_set("foreignaccount_google", "")) {
                if (!setting_new("foreignaccount_google", "")) {
                    $error = true;
                }
            }

            if (!setting_set("foreignaccount_facebook", "")) {
                if (!setting_new("foreignaccount_facebook", "")) {
                    $error = true;
                }
            }

            if (!setting_set("foreignaccount_facebook_apisecret", "")) {
                if (!setting_new("foreignaccount_facebook_apisecret", "")) {
                    $error = true;
                }
            }

            if (!setting_set("foreignaccount_facebook_apiid", "")) {
                if (!setting_new("foreignaccount_facebook_apiid", "")) {
                    $error = true;
                }
            }

            if (!setting_set("configChecker_signIn", "on")) {
                if (!setting_new("configChecker_signIn", "on")) {
                    $error = true;
                }
            }
            break;
        case "twitter":
            if (!setting_set("twitter_account", "")) {
                if (!setting_new("twitter_account", "")) {
                    $error = true;
                }
            }

            if (!setting_set("configChecker_twitter", "on")) {
                if (!setting_new("configChecker_twitter", "on")) {
                    $error = true;
                }
            }
            break;
        case "fbComments":
            if (!setting_set("commenting_fb", "")) {
                if (!setting_new("commenting_fb", "")) {
                    $error = true;
                }
            }

            if (!setting_set("foreignaccount_facebook_apiid", "")) {
                if (!setting_new("foreignaccount_facebook_apiid", "")) {
                    $error = true;
                }
            }

            if (!setting_set("commenting_fb_user_id", "")) {
                if (!setting_new("commenting_fb_user_id", "")) {
                    $error = true;
                }
            }

            if (!setting_set("configChecker_fbComments", "on")) {
                if (!setting_new("configChecker_fbComments", "on")) {
                    $error = true;
                }
            }
            break;
        case "twilio":
            if (!setting_set("twilio_enabled_call", "")) {
                if (!setting_new("twilio_enabled_call", "")) {
                    $error = true;
                }
            }

            if (!setting_set("twilio_account_sid", "")) {
                if (!setting_new("twilio_account_sid", "")) {
                    $error = true;
                }
            }

            if (!setting_set("twilio_auth_token", "")) {
                if (!setting_new("twilio_auth_token", "")) {
                    $error = true;
                }
            }

            if (!setting_set("configChecker_twilio", "on")) {
                if (!setting_new("configChecker_twilio", "on")) {
                    $error = true;
                }
            }
            break;
        case "gmaps":
            $googleSettings = new GoogleSettings();
            $googleSettings->mapsKey = "";
            $googleSettings->mapsStatus = "off";
            $googleSettings->Save();

            if (!setting_set("configChecker_gmaps", "on")) {
                if (!setting_new("configChecker_gmaps", "on")) {
                    $error = true;
                }
            }
            break;
        case "gads":
            $googleSettings = new GoogleSettings();
            $googleSettings->adClient = "";
            $googleSettings->adStatus = "off";
            $googleSettings->Save();

            if (!setting_set("configChecker_gads", "on")) {
                if (!setting_new("configChecker_gads", "on")) {
                    $error = true;
                }
            }
            break;
        case "ganalytics":
            $googleSettings = new GoogleSettings();
            $googleSettings->adClient = "";
            $googleSettings->analyticsFront = "";
            $googleSettings->analyticsMembers = "";
            $googleSettings->analyticsSiteManager = "";
            $googleSettings->Save();

            if (!setting_set("configChecker_ganalytics", "on")) {
                if (!setting_new("configChecker_ganalytics", "on")) {
                    $error = true;
                }
            }
            break;
        case "footer":
            if (!setting_set("setting_linkedin_link", "")) {
                if (!setting_new("setting_linkedin_link", "")) {
                    $error = true;
                }
            }
            if (!setting_set("setting_facebook_link", "")) {
                if (!setting_new("setting_facebook_link", "")) {
                    $error = true;
                }
            }

            if (!setting_set("configChecker_footer", "on")) {
                if (!setting_new("configChecker_footer", "on")) {
                    $error = true;
                }
            }
            break;
        case "systemEmail":
            if (!setting_set("sitemgr_email", "")) {
                if (!setting_new("sitemgr_email", "")) {
                    $error = true;
                }
            }

            if (!setting_set("sitemgr_send_email", "")) {
                if (!setting_new("sitemgr_send_email", "")) {
                    $error = true;
                }
            }

            if (!setting_set("configChecker_systemEmail", "on")) {
                if (!setting_new("configChecker_systemEmail", "on")) {
                    $error = true;
                }
            }
            break;
        case "smtpEmail":

            if (!setting_set("phpMailer_error", "1")) {
                if (!setting_new("phpMailer_error", "1")) {
                    $error = true;
                }
            }

            if (!setting_set("emailconf_method", "")) {
                if (!setting_new("emailconf_method", "")) {
                    $error = true;
                }
            }

            if (!setting_set("emailconf_host", "")) {
                if (!setting_new("emailconf_host", "")) {
                    $error = true;
                }
            }

            if (!setting_set("emailconf_port", "")) {
                if (!setting_new("emailconf_port", "")) {
                    $error = true;
                }
            }

            if (!setting_set("emailconf_auth", "")) {
                if (!setting_new("emailconf_auth", "")) {
                    $error = true;
                }
            }

            if (!setting_set("emailconf_email", "")) {
                if (!setting_new("emailconf_email", "")) {
                    $error = true;
                }
            }

            if (!setting_set("emailconf_username", "")) {
                if (!setting_new("emailconf_username", "")) {
                    $error = true;
                }
            }

            if (!setting_set("emailconf_password", "")) {
                if (!setting_new("emailconf_password", "")) {
                    $error = true;
                }
            }

            if (!setting_set("configChecker_smtpEmail", "on")) {
                if (!setting_new("configChecker_smtpEmail", "on")) {
                    $error = true;
                }
            }
            break;
        case "todoItems":
            $dbObjMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);
            $sql = "UPDATE Setting SET value = 'yes' WHERE name LIKE '%todo_%'";
            $dbObj->query($sql);
            $sql = "UPDATE Setting SET value = '0' WHERE name = 'percentage_todo'";
            $dbObj->query($sql);
            break;
    }

    if ($error) {
        $errorMessage = "System error!";
    } elseif ($errorFolder) {
        $errorMessage = "Wrong permissions on custom folder!";
    } else {
        header("Location: ".$url_redirect."?message=ok");
        exit;
    }
}

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
setting_get("sitemgr_username", $sm_username);
setting_get("configChecker_lang", $configChecker_lang);
setting_get("configChecker_theme", $configChecker_theme);
setting_get("configChecker_signIn", $configChecker_signIn);
setting_get("configChecker_twitter", $configChecker_twitter);
setting_get("configChecker_fbComments", $configChecker_fbComments);
setting_get("configChecker_twilio", $configChecker_twilio);
setting_get("configChecker_gmaps", $configChecker_gmaps);
setting_get("configChecker_gads", $configChecker_gads);
setting_get("configChecker_ganalytics", $configChecker_ganalytics);
setting_get("configChecker_footer", $configChecker_footer);
setting_get("configChecker_systemEmail", $configChecker_systemEmail);
setting_get("configChecker_smtpEmail", $configChecker_smtpEmail);

//SignIn Options
setting_get("foreignaccount_facebook", $foreignaccount_facebook);
setting_get("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret);
setting_get("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid);
setting_get("foreignaccount_google", $foreignaccount_google);

//Twitter Options
setting_get("twitter_account", $twitter_account);

//Facebook comments options
setting_get("commenting_fb", $commenting_fb);
setting_get("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid);
setting_get("commenting_fb_user_id", $fb_user_id);

//Twilio Options
setting_get("twilio_enabled_call", $twilio_enabled_call);
setting_get("twilio_account_sid", $twilio_account_sid);
setting_get("twilio_auth_token", $twilio_auth_token);

$googleSettings = new GoogleSettings();

//Google Maps
$google_maps_key = $googleSettings->mapsKey;
$google_maps = $googleSettings->mapsStatus == "on" ? "on" : "";

//Google Ads
$google_ad_client = $googleSettings->adClient;
$google_ad_status = $googleSettings->adStatus == "on" ? "on" : "";

//Google Analytics
$google_analytics_account = $googleSettings->analyticsAccount;
$google_analytics_front = $googleSettings->analyticsFront;
$google_analytics_members = $googleSettings->analyticsMembers;
$google_analytics_sitemgr = $googleSettings->analyticsSiteManager;

//Footer Links
setting_get("setting_linkedin_link", $setting_linkedin_link);
setting_get("setting_facebook_link", $setting_facebook_link);

//Sitemgr General E-mail
setting_get("sitemgr_email", $sitemgr_email);
setting_get("sitemgr_send_email", $send_email);

//E-Mail Sending Configuration
setting_get("emailconf_method", $emailconf_method);
setting_get("emailconf_host", $emailconf_host);
setting_get("emailconf_port", $emailconf_port);
setting_get("emailconf_auth", $emailconf_auth);
setting_get("emailconf_email", $emailconf_email);
setting_get("emailconf_username", $emailconf_username);
setting_get("emailconf_password", $emailconf_password);

if (!$configChecker_lang) {
    $onclickLang = "onclick=\"resetOption('".$url_redirect."?action=langFiles');\"";
    $classLang = "";
} else {
    $onclickLang = "onclick=\"javascript: void(0);\"";
    $classLang = "setup_done";
}

if (!$configChecker_theme) {
    $onclickTheme = "onclick=\"resetOption('".$url_redirect."?action=Theme');\"";
    $classTheme = "";
} else {
    $onclickTheme = "onclick=\"javascript: void(0);\"";
    $classTheme = "setup_done";
}

if (!$configChecker_signIn) {
    $onclicksignIn = "onclick=\"resetOption('".$url_redirect."?action=signIn');\"";
    $classsignIn = "";
} else {
    $onclicksignIn = "onclick=\"javascript: void(0);\"";
    $classsignIn = "setup_done";
}

if (!$configChecker_twitter) {
    $onclicktwitter = "onclick=\"resetOption('".$url_redirect."?action=twitter');\"";
    $classtwitter = "";
} else {
    $onclicktwitter = "onclick=\"javascript: void(0);\"";
    $classtwitter = "setup_done";
}

if (!$configChecker_fbComments) {
    $onclickfbComments = "onclick=\"resetOption('".$url_redirect."?action=fbComments');\"";
    $classfbComments = "";
} else {
    $onclickfbComments = "onclick=\"javascript: void(0);\"";
    $classfbComments = "setup_done";
}

if (!$configChecker_twilio) {
    $onclicktwilio = "onclick=\"resetOption('".$url_redirect."?action=twilio');\"";
    $classtwilio = "";
} else {
    $onclicktwilio = "onclick=\"javascript: void(0);\"";
    $classtwilio = "setup_done";
}

if (!$configChecker_gmaps) {
    $onclickgmaps = "onclick=\"resetOption('".$url_redirect."?action=gmaps');\"";
    $classgmaps = "";
} else {
    $onclickgmaps = "onclick=\"javascript: void(0);\"";
    $classgmaps = "setup_done";
}

if (!$configChecker_gads) {
    $onclickgads = "onclick=\"resetOption('".$url_redirect."?action=gads');\"";
    $classgads = "";
} else {
    $onclickgads = "onclick=\"javascript: void(0);\"";
    $classgads = "setup_done";
}

if (!$configChecker_ganalytics) {
    $onclickganalytics = "onclick=\"resetOption('".$url_redirect."?action=ganalytics');\"";
    $classganalytics = "";
} else {
    $onclickganalytics = "onclick=\"javascript: void(0);\"";
    $classganalytics = "setup_done";
}

if (!$configChecker_footer) {
    $onclickfooter = "onclick=\"resetOption('".$url_redirect."?action=footer');\"";
    $classfooter = "";
} else {
    $onclickfooter = "onclick=\"javascript: void(0);\"";
    $classfooter = "setup_done";
}

if (!$configChecker_systemEmail) {
    $onclicksystemEmail = "onclick=\"resetOption('".$url_redirect."?action=systemEmail');\"";
    $classsystemEmail = "";
} else {
    $onclicksystemEmail = "onclick=\"javascript: void(0);\"";
    $classsystemEmail = "setup_done";
}

if (!$configChecker_smtpEmail) {
    $onclicksmtpEmail = "onclick=\"resetOption('".$url_redirect."?action=smtpEmail');\"";
    $classsmtpEmail = "";
} else {
    $onclicksmtpEmail = "onclick=\"javascript: void(0);\"";
    $classsmtpEmail = "setup_done";
}

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT."/layout/header.php");

# ----------------------------------------------------------------------------------------------------
# NAVBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

# ----------------------------------------------------------------------------------------------------
# SIDEBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT."/layout/sidebar-support.php");

?>

    <main class="wrapper-dashboard togglesidebar container-fluid">

        <? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
        <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
        <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

        <section class="heading">

            <h1>Reset Settings</h1>

            <? if ($errorMessage) { ?>
                <p class="alert alert-warning"><?= $errorMessage ?></p>
            <? } elseif ($_GET["message"] == "ok") { ?>
                <p class="alert alert-success">Settings changed!</p>
            <? } ?>

        </section>

        <section class="row section-form">
            <form role="form" action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                <? include(INCLUDES_DIR."/forms/form-support-reset.php"); ?>
            </form>
        </section>

    </main>

<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/support.php";
include(SM_EDIRECTORY_ROOT."/layout/footer.php");
