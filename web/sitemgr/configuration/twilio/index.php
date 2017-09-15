<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/twilio/index.php
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	$_POST = array_map("trim", $_POST);
	extract($_POST);
	extract($_GET);

	$message_style = "success";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ((($twilio_enabled_call) && $twilio_account_sid && $twilio_auth_token) || (!$twilio_enabled_call && !$twilio_account_sid && !$twilio_auth_token)) {

			if (!setting_set("twilio_enabled_call", $twilio_enabled_call))
				if (!setting_new("twilio_enabled_call", $twilio_enabled_call))
					$error = true;

			if (!setting_set("twilio_account_sid", $twilio_account_sid))
				if (!setting_new("twilio_account_sid", $twilio_account_sid))
					$error = true;

			if (!setting_set("twilio_auth_token", $twilio_auth_token))
				if (!setting_new("twilio_auth_token", $twilio_auth_token))
					$error = true;

			if (!setting_set("twilio_clicktocall_message", $twilio_clicktocall_message))
				if (!setting_new("twilio_clicktocall_message", $twilio_clicktocall_message))
					$error = true;
		} else {
			$error = false;

			if ($twilio_account_sid && $twilio_auth_token) {

				if (!setting_set("twilio_enabled_call", $twilio_enabled_call))
					if (!setting_new("twilio_enabled_call", $twilio_enabled_call))
						$error = true;

				if (!setting_set("twilio_account_sid", $twilio_account_sid))
					if (!setting_new("twilio_account_sid", $twilio_account_sid))
						$error = true;

				if (!setting_set("twilio_auth_token", $twilio_auth_token))
					if (!setting_new("twilio_auth_token", $twilio_auth_token))
						$error = true;

				if (!setting_set("twilio_clicktocall_message", $twilio_clicktocall_message))
					if (!setting_new("twilio_clicktocall_message", $twilio_clicktocall_message))
						$error = true;
			} else if ((!$twilio_enabled_call) || !$twilio_account_sid || !$twilio_auth_token) {
				$error = true;
			}

		}

		if ($twilio_enabled_call && !$twilio_clicktocall_message){
			$error = true;
		}

		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_TWILIO_CONFIGURATIONWASCHANGED);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_TWILIO_EMPTYKEYS);
			$message_style = "warning";
		}
		if ($actions) {
			$message_twilio .= implode("<br />", $actions);
		}
	}

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	if (!$twilio_enabled_call) setting_get("twilio_enabled_call", $twilio_enabled_call);
	if (!$twilio_account_sid && !DEMO_LIVE_MODE) setting_get("twilio_account_sid", $twilio_account_sid);
	if (!$twilio_auth_token && !DEMO_LIVE_MODE) setting_get("twilio_auth_token", $twilio_auth_token);
	if (!$twilio_clicktocall_message) setting_get("twilio_clicktocall_message", $twilio_clicktocall_message);
	if ($twilio_enabled_call) $twilio_checked_call = "checked";

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

<!--        <div class="row">
            <div class="progress">
              <div class="progress-bar" data-placement="bottom" data-toggle="tooltip" data-original-title="5% Complete" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                <span class="sr-only">5% Complete</span>
              </div>
            </div>
        </div>-->

        <section class="heading">
            <h1><?=system_showText(LANG_LABEL_CLICKTOCALL);?></h1>
            <p><?=system_showText(LANG_SITEMGR_TWILIO_MSG1);?> <a href="http://www.twilio.com/pricing/" target="_blank"><?=system_showText(LANG_SITEMGR_TWILIO_MSG2)?></a></p>
            <p><?=system_showText(LANG_SITEMGR_TWILIO_MSG3);?></p>
            <? if ($message_twilio) { ?>
            <p class="alert alert-<?=$message_style?>"><?=$message_twilio;?></p>
            <? } ?>
        </section>

        <section class="row section-form">
            <div class="form-container row">
                <div class="col-md-9">
                    <? include(INCLUDES_DIR."/forms/form-twilio.php"); ?>
                </div>
            </div>
        </section>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/settings.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
