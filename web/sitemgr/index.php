<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

    # ----------------------------------------------------------------------------------------------------
	# FIRST STEPS CONTROL
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["completion"]) {
        if (!setting_set("todo_".$_POST["completion"], "done")) {
            setting_new("todo_".$_POST["completion"], "done");
        }

        setting_get("todo_locations", $todo_locations);
        setting_get("todo_email", $todo_email);
        setting_get("todo_pricing", $todo_pricing);
        setting_get("todo_settings", $todo_settings);

        if ($todo_locations == "done" && $todo_email == "done" && $todo_pricing == "done" && $todo_settings == "done") {
            echo "ok";
        }

        exit;
    }

    setting_get("todo_locations", $todo_locations);
    setting_get("todo_email", $todo_email);
    setting_get("todo_pricing", $todo_pricing);
    setting_get("todo_settings", $todo_settings);

    $FirstStartDashboard = false;

    if (($todo_locations != "done" || $todo_email != "done" || $todo_pricing != "done" || $todo_settings != "done") && !DEMO_LIVE_MODE) {

        $db = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);

        if ($dbObj->getRowCount("Listing") == 0 ||
            (CUSTOM_PROMOTION_FEATURE == "on" && $dbObj->getRowCount("Promotion") == 0) ||
            (CUSTOM_BANNER_FEATURE == "on" && $dbObj->getRowCount("Banner") == 0) ||
            (CUSTOM_EVENT_FEATURE == "on" && $dbObj->getRowCount("Event") == 0) ||
            (CUSTOM_CLASSIFIED_FEATURE == "on" && $dbObj->getRowCount("Classified") == 0) ||
            (CUSTOM_ARTICLE_FEATURE == "on" && $dbObj->getRowCount("Article") == 0) ||
            (CUSTOM_BLOG_FEATURE == "on" && $dbObj->getRowCount("Post") == 0)
            )
        {
            $FirstStartDashboard = true;
        }

        $arrayCompletion = array();
        $arrayCompletion[0]["div_class"] = ($todo_locations == "done" ? "checked" : "");
        $arrayCompletion[0]["icon_class"] = ($todo_locations == "done" ? "icon-ion-ios7-checkmark-outline" : "icon-ion-ios7-circle-outline");
        $arrayCompletion[0]["check_tip"] = system_showText(($todo_locations == "done" ? LANG_SITEMGR_DASH_STEPSDONE : LANG_SITEMGR_DASH_STEPSCOMPLETE));
        $arrayCompletion[0]["link"] = DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/";
        $arrayCompletion[0]["title"] = system_showText(LANG_SITEMGR_TODO_LOCATIONS);
        $arrayCompletion[0]["tip"] = system_showText(LANG_SITEMGR_DASH_COMPLETION_LOCATIONS);
        $arrayCompletion[0]["option"] = "locations";

        $arrayCompletion[1]["div_class"] = ($todo_email == "done" ? "checked" : "");
        $arrayCompletion[1]["icon_class"] = ($todo_email == "done" ? "icon-ion-ios7-checkmark-outline" : "icon-ion-ios7-circle-outline");
        $arrayCompletion[1]["check_tip"] = system_showText(($todo_email == "done" ? LANG_SITEMGR_DASH_STEPSDONE : LANG_SITEMGR_DASH_STEPSCOMPLETE));
        $arrayCompletion[1]["link"] = DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/email/";
        $arrayCompletion[1]["title"] = system_showText(LANG_SITEMGR_TODO_STEP1);
        $arrayCompletion[1]["tip"] = system_showText(LANG_SITEMGR_TODO_STEP1_TIP1);
        $arrayCompletion[1]["option"] = "email";

        $arrayCompletion[2]["div_class"] = ($todo_pricing == "done" ? "checked" : "");
        $arrayCompletion[2]["check_tip"] = system_showText(($todo_pricing == "done" ? LANG_SITEMGR_DASH_STEPSDONE : LANG_SITEMGR_DASH_STEPSCOMPLETE));
        $arrayCompletion[2]["icon_class"] = ($todo_pricing == "done" ? "icon-ion-ios7-checkmark-outline" : "icon-ion-ios7-circle-outline");
        $arrayCompletion[2]["link"] = DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/payment/";
        $arrayCompletion[2]["title"] = system_showText(LANG_SITEMGR_SETTINGS_PRICING);
        $arrayCompletion[2]["tip"] = system_showText(LANG_SITEMGR_TODO_STEP3_TIP1);
        $arrayCompletion[2]["option"] = "pricing";

        $arrayCompletion[3]["div_class"] = ($todo_settings == "done" ? "checked" : "");
        $arrayCompletion[3]["check_tip"] = system_showText(($todo_settings == "done" ? LANG_SITEMGR_DASH_STEPSDONE : LANG_SITEMGR_DASH_STEPSCOMPLETE));
        $arrayCompletion[3]["icon_class"] = ($todo_settings == "done" ? "icon-ion-ios7-checkmark-outline" : "icon-ion-ios7-circle-outline");
        $arrayCompletion[3]["link"] = DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/basic-information/";
        $arrayCompletion[3]["title"] = system_showText(LANG_SITEMGR_TODO_STEP5);
        $arrayCompletion[3]["tip"] = system_showText(LANG_SITEMGR_TODO_STEP5_TIP2);
        $arrayCompletion[3]["option"] = "settings";

    }

    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$domainObj = new Domain(SELECTED_DOMAIN_ID);
	setting_get("default_url", $default_url);

	if ($domainObj->getString("url") !== $default_url) {
		$default_url = $domainObj->getString("url");
		if (!setting_set("default_url", $default_url)) setting_new("default_url", $default_url);
	}
	if (!setting_set("edir_default_language", EDIR_DEFAULT_LANGUAGE)) setting_new("edir_default_language", EDIR_DEFAULT_LANGUAGE);
	if (!setting_set("edir_languages", EDIR_LANGUAGES)) setting_new("edir_languages", EDIR_LANGUAGES);
	if (!setting_set("edir_languagenames", EDIR_LANGUAGENAMES)) setting_new("edir_languagenames", EDIR_LANGUAGENAMES);
	if (!setting_set("edir_language", EDIR_LANGUAGE)) setting_new("edir_language", EDIR_LANGUAGE);

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-dashboard.php");

?>

    <!-- CSS Class to change sidebar retreat, this size is different only on dashboard-->
    <main class="wrapper-dashboard togglesidebar container-fluid">

        <div class="dashboard">

            <?php
            require(SM_EDIRECTORY_ROOT."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

            /*
            Completion
            */
            include(SM_EDIRECTORY_ROOT."/dashboard/completion.php");

            if (!$FirstStartDashboard) {
                /*
                Stats Panel
                */
                include(SM_EDIRECTORY_ROOT."/dashboard/stats-panel.php");

                /*
                Timeline
                */
                include(SM_EDIRECTORY_ROOT."/dashboard/timeline.php");
            }
            ?>

        </div>

    </main>


<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
