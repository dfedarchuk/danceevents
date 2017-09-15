<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/configuration/language/index.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();

# ----------------------------------------------------------------------------------------------------
# VALIDATING FEATURES
# ----------------------------------------------------------------------------------------------------
if (MULTILANGUAGE_FEATURE != "on") {
    exit;
}

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
$url_redirect = "" . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/configuration/geography/language/index.php";
$url_base = "" . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/configuration/geography/language";
extract($_GET);
extract($_POST);
$actionFrom = "changeLang";

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
include(EDIRECTORY_ROOT . "/includes/code/language_center.php");

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/header.php");

# ----------------------------------------------------------------------------------------------------
# NAVBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/navbar.php");

# ----------------------------------------------------------------------------------------------------
# SIDEBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/sidebar-configuration.php");

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT . "/registration.php");
        require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1><?= system_ShowText(LANG_SITEMGR_TIME_GEO) ?></h1>

            <p><?= system_showText(LANG_SITEMGR_GEO_TIP); ?></p>
        </section>

        <div class="row tab-options">

            <? include(SM_EDIRECTORY_ROOT . "/layout/nav-tabs-geography.php"); ?>

            <div class="row tab-content">

                <section class="tab-pane active">
                    <? include(INCLUDES_DIR . "/forms/form-languages.php"); ?>
                </section>

            </div>
        </div>

    </main>

<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
$customJS = SM_EDIRECTORY_ROOT . "/assets/custom-js/location.php";
include(SM_EDIRECTORY_ROOT . "/layout/footer.php");
