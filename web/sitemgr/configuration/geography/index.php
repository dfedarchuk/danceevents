<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/geography/index.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$_locations = explode(",", EDIR_LOCATIONS);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/index.php";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/location_settings.php");

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
            <h1><?=system_ShowText(LANG_SITEMGR_TIME_GEO)?></h1>
            <p><?=system_showText(LANG_SITEMGR_GEO_TIP);?></p>
        </section>

        <div class="row tab-options">

            <? include(SM_EDIRECTORY_ROOT."/layout/nav-tabs-geography.php"); ?>

            <div class="row tab-content">

                <section class="tab-pane active">

                    <form class="form-horizontal" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                        <input type="hidden" name="datesettings" value="true">

                        <? include(INCLUDES_DIR."/forms/form-datesettings.php"); ?>

                    </form>

                    <form name="location_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <? include(INCLUDES_DIR."/forms/form-locationsettings.php"); ?>
                    </form>

                    <?
                    // Check if some location was added manually
                    setting_get("added_location_manually", $added_location_manually);
                    if (file_exists(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/configuration/geography/locations/load_location.php") && ($added_location_manually != "Y")) {
                        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/configuration/geography/locations/load_location.php");
                        $enableButton = false;
                    ?>

                        <div class="col-sm-9">

                            <p class="alert alert-success" <?=(isset($_GET["successLoad"]) ? "" : "style=\"display:none\"")?> id="load_success"><?=system_showText(LANG_SITEMGR_LOAD_SUCCESS);?></p>
                            <p class="alert alert-warning" style="display:none" id="load_error"><?=system_showText(LANG_SITEMGR_LOAD_ERROR);?></p>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?=system_showText(LANG_SITEMGR_LOAD_LOCATIONS)?>
                                    <p class="small"><?=system_showText(LANG_SITEMGR_LOAD_LOCATIONS_TIP);?></p>
                                </div>
                                <div id="loading_location_status" class="alert alert-loading alert-block text-center hidden">
                                    <img src="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/assets/img/loading-64.gif">
                                </div>

                                <? if (is_array($_array_location_options)) { ?>

                                <div class="panel-body">
                                    <div class="form-group">

                                        <form id="load_location" method="post" action="<?=$_SERVER["PHP_SELF"]?>" />

                                            <? foreach ($_array_location_options as $location_option) { ?>

                                            <div class="checkbox">
                                                <label>
                                                    <? if (is_array($loaded_locations) && (array_search($location_option["value"], $loaded_locations) !== false)) { ?>
                                                        <input type="checkbox" name="load_location_option" value="<?=$location_option["value"]?>" checked disabled>
                                                    <? } else { $enableButton = true; ?>
                                                        <input type="checkbox" name="load_location_option" value="<?=$location_option["value"]?>" />
                                                    <? } ?>
                                                    <?=$location_option["label"]?>
                                                </label>
                                            </div>
                                            <? } ?>

                                        </form>

                                        <?
                                        $looseJS = "
                                            function PrepareToLoadLocations() {
                                                $('#loading_location_status').removeClass('hidden');
                                                $('#load_success').css('display', 'none');
                                                $('#load_error').css('display', 'none');
                                                var location_options = $('#load_location').serialize();
                                                $.post('".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/locations/ajax_load_locations.php', { 
                                                    load_location_option: location_options 
                                                }, function( data ) {
                                                    $('#loading_location_status').addClass('hidden');
                                                    if ($.trim(data) == 'done') {
                                                        window.location.href = '".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/index.php?successLoad';
                                                    } else {
                                                        $('#load_error').css('display', '');
                                                    }
                                                });
                                            }

                                            ";
                                        JavaScriptHandler::registerLoose($looseJS);
                                        ?>

                                    </div>

                                </div>

                                <div class="panel-footer">
                                    <button type="button" value="<?=system_showText(LANG_SITEMGR_SUBMIT)?>" class="btn btn-<?=($enableButton ? "primary" : "default")?> " <?=($enableButton ? "onclick=\"PrepareToLoadLocations();\"" : "disabled")?>><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                                </div>

                                <? } ?>

                            </div>
                        </div>

                <? } ?>

                </section>

            </div>
        </div>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/location.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
