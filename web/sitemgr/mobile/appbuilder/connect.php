<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/mobile/appbuilder/connect.php
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

unset($domainObj);
$domainObj = new Domain(SELECTED_DOMAIN_ID);

$registeredDomain = $domainObj->getString("url");
$registeredDomainID = SELECTED_DOMAIN_ID;

$errorRegistration = true;
if ((IAMOK == "iamok") || (!isTORSBRDB())) {
    $isregisteredBin = exec(BIN_PATH."/".BIN_SERVERTYPE."/reg.bin validation null ".$registeredDomain." ".VERSION." null isregistered", $execreturn);
} else {
    $isregisteredBin = isRegistered($registeredDomain, $registeredDomainID);
}
if ($isregisteredBin) {
    $errorRegistration = false;

    if (DEMO_DEV_MODE) {
        $connectTo = "http://appbuilder.arcasolutions.com/connect.php";
    } else {
        $connectTo = "https://appbuilder.edirectory.com/connect.php";
    }

    $domain = $_SERVER["HTTP_HOST"];
    if (strpos($domain, "www.") !== false) {
        $domain = str_replace("www.", "", $domain);
    }

    $dbObj = db_getDBObject(DEFAULT_DB, true);
    $domainsql = db_formatString(strtolower($domain));
    $date_time_check = "";
    $sql = "SELECT * FROM Registration WHERE domain = $domainsql ORDER BY date_time DESC LIMIT 20";
    $result = $dbObj->query($sql);
    if ($result) {
        while ($row = mysql_fetch_assoc($result)) {
            if ((!$date_time_check) || ($date_time_check == $row["date_time"])) {
                $registration[$row["name"]] = $row["value"];
                $date_time_check == $row["date_time"];
            }
        }
    }
    $licensenumber = $registration["a"];
    $licensenumber = substr($licensenumber, 0, 4)."-".substr($licensenumber, 4, 4)."-".substr($licensenumber, 8, 4)."-".substr($licensenumber, 12, 4)."-".substr($licensenumber, 16, 4)."-".substr($licensenumber, 20, 4)."-".substr($licensenumber, 24, 4)."-".substr($licensenumber, 28, 4);
    $activationcode = $registration["b"];
    $activationcode = substr($activationcode, 0, 4)."-".substr($activationcode, 4, 4)."-".substr($activationcode, 8, 4)."-".substr($activationcode, 12, 4)."-".substr($activationcode, 16, 4)."-".substr($activationcode, 20, 4)."-".substr($activationcode, 24, 4)."-".substr($activationcode, 28, 4);

    setting_get("sitemgr_language", $sitemgr_language);
    setting_get("appbuilder_app_name", $appname);
    setting_get("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret);
    setting_get("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid);
    setting_get("foreignaccount_google_clientid", $foreignaccount_google_clientid);
    setting_get("appbuilder_icon_id", $appbuilder_icon_id);
    setting_get("appbuilder_icon_extension", $appbuilder_icon_extension);
    setting_get("appbuilder_splash_id", $appbuilder_splash_id);
    setting_get("appbuilder_splash_extension", $appbuilder_splash_extension);
    setting_get("sitemgr_email", $sitemgr_email);
    $iconPath = DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/appbuilder_icon_{$appbuilder_icon_id}.{$appbuilder_icon_extension}";
    $splashPath = DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/appbuilder_splash_{$appbuilder_splash_id}.{$appbuilder_splash_extension}";
    if (file_exists(EDIRECTORY_ROOT.IMAGE_HEADER_PATH)) {
        $edirLogo = DEFAULT_URL.IMAGE_HEADER_PATH;
    } else {
            $edirLogo = DEFAULT_URL."/assets/images/img-logo.png";
    }
    setting_get("edirectory_api_key", $edirectory_api_key);

    /*
     * Colors
     */
    $modules = ["listing","event","classified","article","promotion","post"];
    $arrayModulesColors["listing"] = "be8885";
    $arrayModulesColors["event"] = "e88f30";
    $arrayModulesColors["classified"] = "278c90";
    $arrayModulesColors["article"] = "bc6baa";
    $arrayModulesColors["promotion"] = "867fb6";
    $arrayModulesColors["post"] = "5e96c6";

    setting_get("appbuilder_colorscheme", $appbuilder_colorscheme);
    if ($appbuilder_colorscheme) {
        $colors = explode("-", $appbuilder_colorscheme);
        $color_primary = $colors[0];
        $color_tint = $colors[1];

    } else {
        $color_primary = "4698db";
        $color_tint = "89b1d2";
    }

    foreach ($modules as $module) {
        setting_get("appbuilder_colorscheme_".$module, ${"color_scheme_".$module});
        if (!${"color_scheme_".$module}) {
            ${"color_scheme_".$module} = $arrayModulesColors[$module];
        }
    }

    $symfonyKernel = SymfonyCore::getKernel();

}

if ($errorRegistration) {

    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
    exit;

} else { ?>

    <html>
    <head>
        <title>eDirectory Appbuilder Connect</title>
    </head>
    <body>
    <form name="connect" id="connect" method="post" action="<?=$connectTo;?>">
        <input type="hidden" name="apikey" value="<?=$edirectory_api_key;?>">
        <input type="hidden" name="http_host" value="<?=$_SERVER["HTTP_HOST"];?>">
        <input type="hidden" name="default_url" value="<?=DEFAULT_URL;?>">
        <input type="hidden" name="domain" value="<?=$registeredDomain;?>">
        <input type="hidden" name="version" value="<?=VERSION;?>">
        <input type="hidden" name="kernel_version" value="<?=$symfonyKernel::VERSION;?>">
        <input type="hidden" name="licensenumber" value="<?=$licensenumber;?>">
        <input type="hidden" name="activationcode" value="<?=$activationcode;?>">
        <input type="hidden" name="language" value="<?=$sitemgr_language;?>">
        <input type="hidden" name="sitemgr_alias" value="<?=SITEMGR_ALIAS;?>">
        <input type="hidden" name="app_name" value="<?=$appname;?>">
        <input type="hidden" name="facebook_apisecret" value="<?=$foreignaccount_facebook_apisecret;?>">
        <input type="hidden" name="facebook_apiid" value="<?=$foreignaccount_facebook_apiid;?>">
        <input type="hidden" name="google_clientid" value="<?=$foreignaccount_google_clientid;?>">
        <input type="hidden" name="iconpath" value="<?=$iconPath;?>">
        <input type="hidden" name="splashpath" value="<?=$splashPath;?>">
        <input type="hidden" name="edirlogo" value="<?=$edirLogo;?>">
        <input type="hidden" name="edirtitle" value="<?=EDIRECTORY_TITLE;?>">
        <input type="hidden" name="download" value="<?=$download;?>">
        <input type="hidden" name="vip" value="<?=$vip;?>">
        <input type="hidden" name="sitemgr_email" value="<?=$sitemgr_email;?>">
        <input type="hidden" name="edirectory_folder" value="<?=EDIRECTORY_FOLDER;?>">
        <input type="hidden" name="color_primary" value="<?=$color_primary;?>">
        <input type="hidden" name="color_tint" value="<?=$color_tint;?>">
        <?php foreach ($modules as $module) { ?>
        <input type="hidden" name="color_<?=($module == "promotion" ? "deal" : ($module == "post" ? "blog" : $module))?>" value="<?=${"color_scheme_".$module};?>">
        <? } ?>
    </form>
    <script>
        document.getElementById("connect").submit();
    </script>
    </body>
    </html>

<? } ?>