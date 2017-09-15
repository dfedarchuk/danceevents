<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/support/index.php
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

$url_redirect = DEFAULT_URL."/".SITEMGR_ALIAS."/support/index.php";
extract($_GET);
extract($_POST);

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($rewriteFile == "constants") {

        $fileConstPath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php";

        $constValues = [];
        $constValues["event_feature"] = EVENT_FEATURE;
        $constValues["banner_feature"] = BANNER_FEATURE;
        $constValues["classified_feature"] = CLASSIFIED_FEATURE;
        $constValues["article_feature"] = ARTICLE_FEATURE;
        $constValues["promotion_feature"] = PROMOTION_FEATURE;
        $constValues["blog_feature"] = BLOG_FEATURE;
        $constValues["zipproximity_feature"] = ZIPCODE_PROXIMITY;
        $constValues["custominvoice_feature"] = CUSTOM_INVOICE_FEATURE;
        $constValues["claim_feature"] = CLAIM_FEATURE;
        $constValues["listingtemplate_feature"] = LISTINGTEMPLATE_FEATURE;
        $constValues["mobile_feature"] = MOBILE_FEATURE;
        $constValues["multilanguage_feature"] = MULTILANGUAGE_FEATURE;
        $constValues["maintenance_feature"] = MAINTENANCE_FEATURE;
        $constValues["sitemap_feature"] = SITEMAP_FEATURE;
        $constValues["branded_print"] = BRANDED_PRINT;
        $constValues["paymentsystem_feature"] = PAYMENTSYSTEM_FEATURE;
        $constValues["name"] = EDIRECTORY_TITLE;
        $constValues["members"] = "on";
        $constValues["disabled"] = "on";
        $constValues["jpg_as_png"] = $const_jpg_as_png == "y" ? "on" : "off";
        $constValues["resize_images"] = $const_free_ratio == "y" ? "off" : "on";
        $constValues["sitemap_www"] = "off";
        $constValues["sitemap_forcehttps"] = $sitemap_forcehttps == "y" ? "on" : "off";

        if (!system_writeConstantsFile($fileConstPath, SELECTED_DOMAIN_ID, $constValues)) {
            $errorFolder = true;
        }

    } elseif ($rewriteFile == "scalability") {

        $fileScalPath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/scalability.inc.php";

        $scalValues = [];
        $scalValues["listing_scalability"] = $scalability_listing == "y" ? "on" : "off";
        $scalValues["promotion_scalability"] = $scalability_promotion == "y" ? "on" : "off";
        $scalValues["event_scalability"] = $scalability_event == "y" ? "on" : "off";
        $scalValues["banner_scalability"] = $scalability_banner == "y" ? "on" : "off";
        $scalValues["classified_scalability"] = $scalability_classified == "y" ? "on" : "off";
        $scalValues["article_scalability"] = $scalability_article == "y" ? "on" : "off";
        $scalValues["blog_scalability"] = $scalability_blog == "y" ? "on" : "off";
        $scalValues["listingcateg_scalability"] = $scalability_listingcateg == "y" ? "on" : "off";
        $scalValues["eventcateg_scalability"] = $scalability_eventcateg == "y" ? "on" : "off";
        $scalValues["classifiedcateg_scalability"] = $scalability_classifiedcateg == "y" ? "on" : "off";
        $scalValues["articlecateg_scalability"] = $scalability_articlecateg == "y" ? "on" : "off";
        $scalValues["blogcateg_scalability"] = $scalability_blogcateg == "y" ? "on" : "off";

        if (!system_writeScalabilityFile($fileScalPath, SELECTED_DOMAIN_ID, $scalValues)) {
            $errorFolder = true;
        }

    } elseif ($rewriteFile == "generalSettings") {

        if (!setting_set("mailapp_via_cron", $mailapp_via_cron)) {
            if (!setting_new("mailapp_via_cron", $mailapp_via_cron)) {
                $error = true;
            }
        }

        if (!setting_set("disable_whatsapp_share_button", $disable_whatsapp_share_button)) {
            if (!setting_new("disable_whatsapp_share_button", $disable_whatsapp_share_button)) {
                $error = true;
            }
        }

        // standardized unchecked option, coming `null`
        $mailapp_via_cron = $mailapp_via_cron ?: 'off';
        $disable_whatsapp_share_button = $disable_whatsapp_share_button ?: 'off';

        // Aggregation Size

        $domain = new Domain(SELECTED_DOMAIN_ID);
        $classSymfonyYml = new Symfony('search.yml');
        $yamlFile = [
            'settings' => [
                'aggregationSize' => $aggregation_size,
            ],
        ];

        // Save YAML File
        $classSymfonyYml->save('Configs', ['search' => $yamlFile]);

    }

    if ($errorFolder) {
        $errorMessage = "Error trying to rewrite file. Please, check the permissions from /custom folder.";
    } elseif ($errorValidation) {
        $errorMessage = $errorValidation;
    } else {
        header("Location: ".$url_redirect."?message=ok");
        exit;
    }

}

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$myUID = getmyuid();
if (function_exists("posix_getuid")) {
    $ownerUID = posix_getuid();
}
$rightPerm = "777";
if ($myUID == $ownerUID) { //suPHP
    $rightPerm = " < 777";
}

$customPerm = (int)system_checkPerm(EDIRECTORY_ROOT."/custom");
$binPerm = (int)system_checkPerm(EDIRECTORY_ROOT."/bin");

if (($rightPerm == "777" && $customPerm == 777) || ($rightPerm == " < 777" && $customPerm < 777)) {
    $styleCustom = "style = \"color: green\"";
} else {
    $styleCustom = "style = \"color: red\"";
}

if (($rightPerm == "777" && $binPerm == 777) || ($rightPerm == " < 777" && $binPerm < 777)) {
    $styleBin = "style = \"color: green\"";
} else {
    $styleBin = "style = \"color: red\"";
}

$arrayHtacces = [];
$arrayHtaccesMissing = [];
$arrayHtacces[] = EDIRECTORY_ROOT."/.htaccess";
$arrayHtacces[] = EDIRECTORY_ROOT."/classes/.htaccess";
$arrayHtacces[] = EDIRECTORY_ROOT."/conf/.htaccess";
$arrayHtacces[] = EDIRECTORY_ROOT."/cron/.htaccess";
$arrayHtacces[] = EDIRECTORY_ROOT."/functions/.htaccess";
$arrayHtacces[] = EDIRECTORY_ROOT."/includes/.htaccess";
$arrayHtacces[] = EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/.htaccess";

foreach ($arrayHtacces as $htFile) {
    if (!file_exists($htFile)) {
        $arrayHtaccesMissing[] = $htFile;
    }
}

if (!$errorValidation) {
    setting_get("mailapp_via_cron", $mailapp_via_cron);
    setting_get("disable_whatsapp_share_button", $disable_whatsapp_share_button);
}

$symfonyKernel = SymfonyCore::getKernel();

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

        <?php
        /*
        Stats Panel
        */
        ?>
        <section class="heading">

            <h1>Config Checker</h1>

            <p>System Settings</p>

            <p class="text-info">eDirectory Version: <b><?= $symfonyKernel::VERSION ?></b></p>

            <? if ($errorMessage) { ?>
                <p class="alert alert-warning"><?= $errorMessage ?></p>
            <? } elseif ($_GET["message"] == "ok") { ?>
                <p class="alert alert-success">Settings changed!</p>
            <? } ?>

        </section>

        <form name="configChecker" id="configChecker" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>"
              method="post" enctype="multipart/form-data">
            <input type="hidden" id="rewriteFile" name="rewriteFile" value=""/>
            <section class="row section-form">
                <div class="col-xs-12">
                    <?php
                    include(INCLUDES_DIR."/forms/form-support-system.php");
                    ?>
                </div>
            </section>

            <section class="row footer-action">
                <div class="col-xs-12 text-center">
                    <button type="button" class="btn btn-primary " onclick="JS_submit('generalSettings');">Save
                        Settings
                    </button>
                </div>
            </section>

        </form>

    </main>

<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/support.php";
include(SM_EDIRECTORY_ROOT."/layout/footer.php");
