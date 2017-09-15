<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/configuration/general-settings/index.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

extract($_POST);
extract($_GET);

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Promotion Default Condition
    if ($promotionDefaults) {
        ((customtext_set("promotion_default_conditions", $promotion_default_conditions)
                or customtext_new("promotion_default_conditions", $promotion_default_conditions)) and
            $success = true)
        or $error = true;
    }

    //eDirectory API
    if ($api) {

        $domain = new Domain(SELECTED_DOMAIN_ID);
        $symfony = new Symfony('domain.yml');

        if (!setting_set("edirectory_api_enabled", $edirectory_api_enabled)) {
            setting_new("edirectory_api_enabled", $edirectory_api_enabled);
        }

        setting_get("edirectory_api_key", $aux_edirectory_api_key);

        /*
         * Workaround to avoid api key being replaced after the apps were already published.
         */

        if (!$aux_edirectory_api_key) {
            if (!setting_set("edirectory_api_key", $edirectory_api_key)) {
                setting_new("edirectory_api_key", $edirectory_api_key);
            }
        }

        $edirectory_api_enabled == "on" and $symfony->save('api_tokens', [
            $domain->getString('url') => $edirectory_api_key,
        ]);

        $success = true;

    }

    //MaintenanceMode
    if ($maintenance && !DEMO_LIVE_MODE) {

        if ($maintenance_mode) {
            $maintenance_mode = "on";
        } else {
            $maintenance_mode = "off";
        }
        if (!setting_set("maintenance_mode", $maintenance_mode)) {
            setting_new("maintenance_mode", $maintenance_mode);
        }

        $success = true;
    }

    //Approval Requirement
    if ($approvalrequirement) {

        if (!setting_set("listing_approve_paid", $listing_approve_paid)) {
            if (!setting_new("listing_approve_paid", $listing_approve_paid)) {
                $error = true;
            }
        }
        if (!setting_set("listing_approve_free", $listing_approve_free)) {
            if (!setting_new("listing_approve_free", $listing_approve_free)) {
                $error = true;
            }
        }
        if (!setting_set("listing_approve_updated", $listing_approve_updated)) {
            if (!setting_new("listing_approve_updated", $listing_approve_updated)) {
                $error = true;
            }
        }
        if (!setting_set("new_listing_email", $new_listing_email)) {
            if (!setting_new("new_listing_email", $new_listing_email)) {
                $error = true;
            }
        }

        if (!setting_set("update_listing_email", $update_listing_email)) {
            if (!setting_new("update_listing_email", $update_listing_email)) {
                $error = true;
            }
        }

        if (!setting_set("event_approve_paid", $event_approve_paid)) {
            if (!setting_new("event_approve_paid", $event_approve_paid)) {
                $error = true;
            }
        }
        if (!setting_set("event_approve_free", $event_approve_free)) {
            if (!setting_new("event_approve_free", $event_approve_free)) {
                $error = true;
            }
        }
        if (!setting_set("event_approve_updated", $event_approve_updated)) {
            if (!setting_new("event_approve_updated", $event_approve_updated)) {
                $error = true;
            }
        }
        if (!setting_set("new_event_email", $new_event_email)) {
            if (!setting_new("new_event_email", $new_event_email)) {
                $error = true;
            }
        }

        if (!setting_set("update_event_email", $update_event_email)) {
            if (!setting_new("update_event_email", $update_event_email)) {
                $error = true;
            }
        }
        if (!setting_set("classified_approve_paid", $classified_approve_paid)) {
            if (!setting_new("classified_approve_paid", $classified_approve_paid)) {
                $error = true;
            }
        }
        if (!setting_set("classified_approve_free", $classified_approve_free)) {
            if (!setting_new("classified_approve_free", $classified_approve_free)) {
                $error = true;
            }
        }
        if (!setting_set("classified_approve_updated", $classified_approve_updated)) {
            if (!setting_new("classified_approve_updated", $classified_approve_updated)) {
                $error = true;
            }
        }
        if (!setting_set("new_classified_email", $new_classified_email)) {
            if (!setting_new("new_classified_email", $new_classified_email)) {
                $error = true;
            }
        }

        if (!setting_set("update_classified_email", $update_classified_email)) {
            if (!setting_new("update_classified_email", $update_classified_email)) {
                $error = true;
            }
        }
        if (!setting_set("article_approve_paid", $article_approve_paid)) {
            if (!setting_new("article_approve_paid", $article_approve_paid)) {
                $error = true;
            }
        }
        if (!setting_set("article_approve_free", $article_approve_free)) {
            if (!setting_new("article_approve_free", $article_approve_free)) {
                $error = true;
            }
        }
        if (!setting_set("article_approve_updated", $article_approve_updated)) {
            if (!setting_new("article_approve_updated", $article_approve_updated)) {
                $error = true;
            }
        }
        if (!setting_set("new_article_email", $new_article_email)) {
            if (!setting_new("new_article_email", $new_article_email)) {
                $error = true;
            }
        }

        if (!setting_set("update_article_email", $update_article_email)) {
            if (!setting_new("update_article_email", $update_article_email)) {
                $error = true;
            }
        }
        if (!setting_set("banner_approve_paid", $banner_approve_paid)) {
            if (!setting_new("banner_approve_paid", $banner_approve_paid)) {
                $error = true;
            }
        }
        if (!setting_set("banner_approve_free", $banner_approve_free)) {
            if (!setting_new("banner_approve_free", $banner_approve_free)) {
                $error = true;
            }
        }
        if (!setting_set("banner_approve_updated", $banner_approve_updated)) {
            if (!setting_new("banner_approve_updated", $banner_approve_updated)) {
                $error = true;
            }
        }
        if (!setting_set("new_banner_email", $new_banner_email)) {
            if (!setting_new("new_banner_email", $new_banner_email)) {
                $error = true;
            }
        }

        if (!setting_set("update_banner_email", $update_banner_email)) {
            if (!setting_new("update_banner_email", $update_banner_email)) {
                $error = true;
            }
        }

        $success = true;

    }

    //Claim
    if ($claim) {
        if (!setting_set("claim_approve", $claim_approve)) {
            if (!setting_new("claim_approve", $claim_approve)) {
                $error = true;
            }
        }
        if (!setting_set("claim_deny", $claim_deny)) {
            if (!setting_new("claim_deny", $claim_deny)) {
                $error = true;
            }
        }
        if (!setting_set("claim_approveemail", $claim_approveemail)) {
            if (!setting_new("claim_approveemail", $claim_approveemail)) {
                $error = true;
            }
        }
        if (!setting_set("claim_denyemail", $claim_denyemail)) {
            if (!setting_new("claim_denyemail", $claim_denyemail)) {
                $error = true;
            }
        }

        if (trim($claim_textlink) == "") {
            $claim_textlink = "Is this your ".LISTING_FEATURE_NAME."?";
        }

        if (!customtext_set("claim_textlink", $claim_textlink)) {
            if (!customtext_new("claim_textlink", $claim_textlink)) {
                $error = true;
            }
        }

        $success = true;
    }

    //Available Modules
    if ($modules_options && !DEMO_LIVE_MODE) {

        if (ARTICLE_FEATURE == "on") {
            if (!setting_set("custom_article_feature", $check_article_feature)) {
                if (!setting_new("custom_article_feature", $check_article_feature)) {
                    $error = true;
                }
            }
        }

        if (BANNER_FEATURE == "on") {
            if (!setting_set("custom_banner_feature", $check_banner_feature)) {
                if (!setting_new("custom_banner_feature", $check_banner_feature)) {
                    $error = true;
                }
            }
        }

        if (BLOG_FEATURE == "on") {
            if (!setting_set("custom_blog_feature", $check_blog_feature)) {
                if (!setting_new("custom_blog_feature", $check_blog_feature)) {
                    $error = true;
                }
            }
        }

        if (CLASSIFIED_FEATURE == "on") {
            if (!setting_set("custom_classified_feature", $check_classified_feature)) {
                if (!setting_new("custom_classified_feature", $check_classified_feature)) {
                    $error = true;
                }
            }
        }

        if (EVENT_FEATURE == "on") {
            if (!setting_set("custom_event_feature", $check_event_feature)) {
                if (!setting_new("custom_event_feature", $check_event_feature)) {
                    $error = true;
                }
            }
        }

        if (PROMOTION_FEATURE == "on") {
            if (!setting_set("custom_promotion_feature", $check_promotion_feature)) {
                if (!setting_new("custom_promotion_feature", $check_promotion_feature)) {
                    $error = true;
                }
            }
        }

        // Saves yaml
        // @todo navigation
        $domain = new Domain(SELECTED_DOMAIN_ID);
        $symfony = new Symfony('domains/'.$domain->getString('url').'.configs.yml');

        $modules = [];
        $modules_array = ['article', 'banner', 'blog', 'classified', 'event', 'promotion'];
        foreach ($modules_array as $module) {
            if (!is_null(${'check_'.$module.'_feature'})) {
                $modules['modules.available'][] = str_replace('promotion', 'deal', $module);
            }
        }
        $modules['modules.available'] = count($modules['modules.available']) ? implode(',',
            $modules['modules.available']) : '';

        $symfony->save('Configs', ['parameters' => $modules]);

        $success = true;

    }

    if ($visitor) {

        //Change settings
        $socialObj = new SettingSocialNetwork('', SELECTED_DOMAIN_ID);
        $socialObj->setSectionSettings($_POST, SELECTED_DOMAIN_ID);

        if (!is_dir(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork")) {
            mkdir(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork");
        }

        $file = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork/socialnetwork.inc.php";
        $file = fopen($file, 'w+');

        $visitorprofile = ($enable_visitorprofile ? "on" : "off");

        $buffer = "<?".PHP_EOL;
        $buffer .= "	define(\"SOCIALNETWORK_FEATURE\", \"".$visitorprofile."\");".PHP_EOL;
        $buffer .= "?>".PHP_EOL;

        fwrite($file, $buffer, strlen($buffer));
        fclose($file);

        //Saves in the settings table
        if (!setting_set('socialnetwork_feature', $visitorprofile)) {
            if (!setting_new('socialnetwork_feature', $visitorprofile)) {
                $error = true;
            }
        }

        if (!$enable_visitorprofile) {
            $sql = " UPDATE `Setting_Social_Network` SET `value` = 'no'";
            $dbObj->query($sql);
        }

        $success = true;

    }

    if ($reviews) {

        if (!setting_set("review_listing_enabled", $review_listing_enabled)) {
            if (!setting_new("review_listing_enabled", $review_listing_enabled)) {
                $error = true;
            }
        }

        if (!setting_set("review_article_enabled", $review_article_enabled)) {
            if (!setting_new("review_article_enabled", $review_article_enabled)) {
                $error = true;
            }
        }


        if (!setting_set("review_promotion_enabled", $review_promotion_enabled)) {
            if (!setting_new("review_promotion_enabled", $review_promotion_enabled)) {
                $error = true;
            }
        }

        if (!setting_set("review_blog_enabled", $review_blog_enabled)) {
            if (!setting_new("review_blog_enabled", $review_blog_enabled)) {
                $error = true;
            }
        }

        if (!setting_set("review_approve", $review_approve)) {
            if (!setting_new("review_approve", $review_approve)) {
                $error = true;
            }
        }

        $success = true;
    }

}

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
// Promotion Default Condition
customtext_get("promotion_default_conditions", $promotion_default_conditions);

//eDirectory API
setting_get("edirectory_api_key", $edirectory_api_key);
setting_get("edirectory_api_enabled", $edirectory_api_enabled);
if ($edirectory_api_enabled) {
    $edirectory_api_enabled_checked = "checked";
}

//Generate new eDirectory API key
$domainObj = new Domain(SELECTED_DOMAIN_ID);
$domain = $domainObj->getString("url");
$edir_key = getKey($domain);
if (!$edirectory_api_key) {
    $edirectory_api_key_new = md5($domain . VERSION . $edir_key);

    unset($new_key);
    $j = 0;
    for ($i = 0; $i < strlen($edirectory_api_key_new); $i++) {
        if ($j < 4) {
            $new_key .= substr($edirectory_api_key_new, $i, 1);
        } else {
            $new_key .= "-" . substr($edirectory_api_key_new, $i, 1);
            $j = 0;
        }
        $j++;
    }
    $edirectory_api_key_new = $new_key;
} else {
    $edirectory_api_key_new = $edirectory_api_key;
}

//Maintenance mode
setting_get("maintenance_mode", $maintenance_mode);

//Approval Requirements
setting_get("listing_approve_paid", $listing_approve_paid);
if ($listing_approve_paid) {
    $listing_approve_paid_checked = "checked";
}

setting_get("listing_approve_free", $listing_approve_free);
if ($listing_approve_free) {
    $listing_approve_free_checked = "checked";
}

setting_get("listing_approve_updated", $listing_approve_updated);
if ($listing_approve_updated) {
    $listing_approve_updated_checked = "checked";
}

setting_get("new_listing_email", $new_listing_email);
if ($new_listing_email) {
    $new_listing_email_checked = "checked";
}

setting_get("update_listing_email", $update_listing_email);
if ($update_listing_email) {
    $update_listing_email_checked = "checked";
}

setting_get("article_approve_paid", $article_approve_paid);
if ($article_approve_paid) {
    $article_approve_paid_checked = "checked";
}

setting_get("article_approve_free", $article_approve_free);
if ($article_approve_free) {
    $article_approve_free_checked = "checked";
}

setting_get("article_approve_updated", $article_approve_updated);
if ($article_approve_updated) {
    $article_approve_updated_checked = "checked";
}

setting_get("new_article_email", $new_article_email);
if ($new_article_email) {
    $new_article_email_checked = "checked";
}

setting_get("update_article_email", $update_article_email);
if ($update_article_email) {
    $update_article_email_checked = "checked";
}

setting_get("classified_approve_paid", $classified_approve_paid);
if ($classified_approve_paid) {
    $classified_approve_paid_checked = "checked";
}

setting_get("classified_approve_free", $classified_approve_free);
if ($classified_approve_free) {
    $classified_approve_free_checked = "checked";
}

setting_get("classified_approve_updated", $classified_approve_updated);
if ($classified_approve_updated) {
    $classified_approve_updated_checked = "checked";
}

setting_get("new_classified_email", $new_classified_email);
if ($new_classified_email) {
    $new_classified_email_checked = "checked";
}

setting_get("update_classified_email", $update_classified_email);
if ($update_classified_email) {
    $update_classified_email_checked = "checked";
}

setting_get("event_approve_paid", $event_approve_paid);
if ($event_approve_paid) {
    $event_approve_paid_checked = "checked";
}

setting_get("event_approve_free", $event_approve_free);
if ($event_approve_free) {
    $event_approve_free_checked = "checked";
}

setting_get("event_approve_updated", $event_approve_updated);
if ($event_approve_updated) {
    $event_approve_updated_checked = "checked";
}

setting_get("new_event_email", $new_event_email);
if ($new_event_email) {
    $new_event_email_checked = "checked";
}

setting_get("update_event_email", $update_event_email);
if ($update_event_email) {
    $update_event_email_checked = "checked";
}

setting_get("banner_approve_paid", $banner_approve_paid);
if ($banner_approve_paid) {
    $banner_approve_paid_checked = "checked";
}

setting_get("banner_approve_free", $banner_approve_free);
if ($banner_approve_free) {
    $banner_approve_free_checked = "checked";
}

setting_get("banner_approve_updated", $banner_approve_updated);
if ($banner_approve_updated) {
    $banner_approve_updated_checked = "checked";
}

setting_get("new_banner_email", $new_banner_email);
if ($new_banner_email) {
    $new_banner_email_checked = "checked";
}

setting_get("update_banner_email", $update_banner_email);
if ($update_banner_email) {
    $update_banner_email_checked = "checked";
}

$approvalModules = [];
$approvalModules[] = "listing";
if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
    $approvalModules[] = "event";
}
if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
    $approvalModules[] = "classified";
}
if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
    $approvalModules[] = "article";
}
if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
    $approvalModules[] = "banner";
}

//Claim
setting_get("claim_approve", $claim_approve);
if ($claim_approve) {
    $claim_approve_checked = "checked";
}
setting_get("claim_deny", $claim_deny);
if ($claim_deny) {
    $claim_deny_checked = "checked";
}
setting_get("claim_approveemail", $claim_approveemail);
if ($claim_approveemail) {
    $claim_approveemail_checked = "checked";
}
setting_get("claim_denyemail", $claim_denyemail);
if ($claim_denyemail) {
    $claim_denyemail_checked = "checked";
}
customtext_get("claim_textlink", $claim_textlink);

//Modules
setting_get("custom_article_feature", $check_article_feature);
if ($check_article_feature) {
    $custom_article_feature_checked = "checked";
}
setting_get("custom_banner_feature", $check_banner_feature);
if ($check_banner_feature) {
    $custom_banner_feature_checked = "checked";
}
setting_get("custom_blog_feature", $check_blog_feature);
if ($check_blog_feature) {
    $custom_blog_feature_checked = "checked";
}
setting_get("custom_classified_feature", $check_classified_feature);
if ($check_classified_feature) {
    $custom_classified_feature_checked = "checked";
}
setting_get("custom_event_feature", $check_event_feature);
if ($check_event_feature) {
    $custom_event_feature_checked = "checked";
}
setting_get("custom_promotion_feature", $check_promotion_feature);
if ($check_promotion_feature) {
    $custom_promotion_feature_checked = "checked";
}

$activeModules = [];
if (EVENT_FEATURE == "on" && FORCE_DISABLE_EVENT_FEATURE != "on") {
    $activeModules[] = "event";
}
if (CLASSIFIED_FEATURE == "on" && FORCE_DISABLE_CLASSIFIED_FEATURE != "on") {
    $activeModules[] = "classified";
}
if (ARTICLE_FEATURE == "on" && FORCE_DISABLE_ARTICLE_FEATURE != "on") {
    $activeModules[] = "article";
}
if (BANNER_FEATURE == "on") {
    $activeModules[] = "banner";
}
if (PROMOTION_FEATURE == "on" && FORCE_DISABLE_PROMOTION_FEATURE != "on") {
    $activeModules[] = "promotion";
}
if (BLOG_FEATURE == "on") {
    $activeModules[] = "blog";
}

//Visitor Profile options
$socialObj = new SettingSocialNetwork('', SELECTED_DOMAIN_ID);
$modulesVisitor = ["general", "listing", "article"];
$enable_visitorprofile = ($_POST["enable_visitorprofile"] ? $_POST["enable_visitorprofile"] : SOCIALNETWORK_FEATURE);

//Reviews
setting_get("review_listing_enabled", $review_listing_enabled);
if ($review_listing_enabled) {
    $review_listing_enabled_checked = "checked";
}

setting_get("review_article_enabled", $review_article_enabled);
if ($review_article_enabled) {
    $review_article_enabled_checked = "checked";
}

setting_get("review_blog_enabled", $review_blog_enabled);
if ($review_blog_enabled) {
    $review_blog_enabled_checked = "checked";
}

setting_get("review_approve", $review_approve);
if ($review_approve) {
    $review_approve_checked = "checked";
}

//Get maintenance page id
$sql = "SELECT id FROM Page WHERE pagetype_id = (SELECT id FROM PageType WHERE title = '".\ArcaSolutions\WysiwygBundle\Services\Wysiwyg::MAINTENANCE_PAGE."')";
$result = $dbObj->query($sql);
$idMaintance = mysql_fetch_assoc($result);

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
include(SM_EDIRECTORY_ROOT."/layout/sidebar-configuration.php");

?>

<main class="wrapper togglesidebar container-fluid">

    <?php
    require(SM_EDIRECTORY_ROOT."/registration.php");
    require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
    require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
    ?>

    <section class="heading">
        <h1><?= system_showText(LANG_SITEMGR_GENERAL_SETTINGS); ?></h1>
        <p><?= system_showText(LANG_SITEMGR_SETTINGS_TIP_1); ?></p>
    </section>

    <section class="row section-form">
        <? include(INCLUDES_DIR."/forms/form-settings.php"); ?>
    </section>

</main>

<? include(INCLUDES_DIR."/modals/modal-api.php"); ?>

<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/settings.php";
include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
