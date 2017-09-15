<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/geography/locations/location_1/location_1.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography";

	# ----------------------------------------------------------------------------------------------------
	# LOCATION RELATIONSHIP
	# ----------------------------------------------------------------------------------------------------
	$_locations = explode(",", EDIR_LOCATIONS);
	$_location_level = 1;
	if (!in_array($_location_level, $_locations)) {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
		exit;
	}
	$_location_node_params = system_buildLocationNodeParams($_GET);
	system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	define("LOCATION_AREA","LOCATION1");
	define("LOCATION_TITLE", string_ucwords(system_showText(constant("LANG_SITEMGR_LABEL_".LOCATION1_SYSTEM))));
	include_once(EDIRECTORY_ROOT."/includes/code/location.php");

	if ($success) {
		$message = 2;
		header("Location: ".$url_base."/locations/location_1/index.php?operation=".$operation."&loc_name=".$location_name);
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-configuration.php");
?>
    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <form role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" name="location_data_in" id="location_data_in" method="post">

            <input type="hidden" name="operation"  id="operation"  value="<?=$btn_action?>" />

            <section class="row heading">

	           	<div class="container">
                    <? if ($id) { ?>
	           		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))." ".system_showText(LOCATION_TITLE)?> <i><?=$location_name?></i></h1>
                    <? } else { ?>
                    <h1><?=string_ucwords(system_showText(LANG_SITEMGR_ADD))." ".system_showText(LOCATION_TITLE)?></h1>
                    <? } ?>
				</div>

                <? if ($location_message) { ?>
				<div class="container alert alert-warning" role="alert">
			        <p><?=$location_message;?></p>
                </div>
                <? } ?>
            </section>

			<section class="row tab-options">

                <div class="container">
                    <div class="pull-right top-actions">
                        <a href="<?=$url_base."/locations/location_1/index.php?".($_location_node_params?$_location_node_params : "")?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                        <button type="submit" name="bt_operation_submit" id="bt_operation_submit" value="<?=$btn_label?>" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="container">
                            <? include(INCLUDES_DIR."/forms/form-location.php"); ?>
                        </div>
                    </div>
                </div>

            </section>

            <section class="row footer-action">

           		<div class="container">
	           		<div class="col-xs-12 text-right">
		           		<a href="<?=$url_base."/locations/location_1/index.php?".($_location_node_params?$_location_node_params : "")?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?> </span>
                        <button type="submit" name="bt_operation_submit" id="bt_operation_submit" value="<?=$btn_label?>" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
					</div>
				</div>

            </section>

        </form>

    </main>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
