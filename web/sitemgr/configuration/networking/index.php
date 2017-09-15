<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/networking/index.php
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
	$_POST = array_map("trim", $_POST);
    extract($_POST);
	extract($_GET);

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error   = false;
        $success = true;

        if ($signin) {

            //Facebook
			if (($foreignaccount_facebook && $foreignaccount_facebook_apisecret && $foreignaccount_facebook_apiid) || (!$foreignaccount_facebook && !$foreignaccount_facebook_apisecret && !$foreignaccount_facebook_apiid)) {
				if (!setting_set("foreignaccount_facebook", $foreignaccount_facebook))
					if (!setting_new("foreignaccount_facebook", $foreignaccount_facebook))
						$error = true;

				if (!setting_set("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
					if (!setting_new("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
						$error = true;

				if (!setting_set("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
					if (!setting_new("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
						$error = true;
			} else {
				$error = false;

				if ($foreignaccount_facebook_apisecret && $foreignaccount_facebook_apiid) {

					if (!setting_set("foreignaccount_facebook", $foreignaccount_facebook))
						if (!setting_new("foreignaccount_facebook", $foreignaccount_facebook))
							$error = true;

					if (!setting_set("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
						if (!setting_new("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
							$error = true;

					if (!setting_set("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
						if (!setting_new("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
							$error = true;
				} else if (!$foreignaccount_facebook || !$foreignaccount_facebook_apisecret || !$foreignaccount_facebook_apiid) {
					$error = true;
				}
			}

            if ($fb_op) {
				if(!setting_set("commenting_fb", "on")) {
					if(!setting_new("commenting_fb", "on")) {
						$error = true;
					}
				}
			} else {
				if(!setting_set("commenting_fb", "")) {
					if(!setting_new("commenting_fb", "")) {
						$error = true;
					}
				}
			}

            if ($fb_user_id){
				if (is_numeric($fb_user_id)){
					if(!setting_set("commenting_fb_user_id", $fb_user_id)) {
						if(!setting_new("commenting_fb_user_id", $fb_user_id)) {
							$error = true;
						}
					}
				} else {
					$error = true;
					$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR2);
				}
			} else {
				$error = true;
				$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR4);
			}

            //Google
            if (($foreignaccount_google && $foreignaccount_google_clientid && $foreignaccount_google_clientsecret) || (!$foreignaccount_google && !$foreignaccount_google_clientid && !$foreignaccount_google_clientsecret)) {
				if (!setting_set("foreignaccount_google", $foreignaccount_google))
					if (!setting_new("foreignaccount_google", $foreignaccount_google))
						$error = true;

				if (!setting_set("foreignaccount_google_clientid", $foreignaccount_google_clientid))
					if (!setting_new("foreignaccount_google_clientid", $foreignaccount_google_clientid))
						$error = true;

				if (!setting_set("foreignaccount_google_clientsecret", $foreignaccount_google_clientsecret))
					if (!setting_new("foreignaccount_google_clientsecret", $foreignaccount_google_clientsecret))
						$error = true;
			} else {
				$error = false;

				if ($foreignaccount_google_clientid && $foreignaccount_google_clientsecret) {

					if (!setting_set("foreignaccount_google", $foreignaccount_google))
						if (!setting_new("foreignaccount_google", $foreignaccount_google))
							$error = true;

					if (!setting_set("foreignaccount_google_clientid", $foreignaccount_google_clientid))
						if (!setting_new("foreignaccount_google_clientid", $foreignaccount_google_clientid))
							$error = true;

					if (!setting_set("foreignaccount_google_clientsecret", $foreignaccount_google_clientsecret))
						if (!setting_new("foreignaccount_google_clientsecret", $foreignaccount_google_clientsecret))
							$error = true;
				} else if (!$foreignaccount_google || !$foreignaccount_google_clientid || !$foreignaccount_google_clientsecret) {
					$error = true;
				}
			}

            if (!$error) {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CONFIGURATIONWASCHANGED);
            } else {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_EMPTYKEYS);
                $message_style = "errorMessage";
            }
            if ($actions) {
                $message_foreignaccount .= implode("<br />", $actions);
            }

            $success = !$error;
        }
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

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    //Sign In Options
    /**
	 * Facebook Account
	 */
	setting_get("foreignaccount_facebook", $foreignaccount_facebook);
	if ($foreignaccount_facebook == "on") $foreignaccount_facebook_checked = "checked";
	if (!$foreignaccount_facebook_apisecret) setting_get("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret);
	if (!$foreignaccount_facebook_apiid) setting_get("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid);

	/**
	 * Google Account
	 */
	setting_get("foreignaccount_google", $foreignaccount_google);
	if ($foreignaccount_google == "on") $foreignaccount_google_checked = "checked";
    if (!$foreignaccount_google_clientid) setting_get("foreignaccount_google_clientid", $foreignaccount_google_clientid);
	if (!$foreignaccount_google_clientsecret) setting_get("foreignaccount_google_clientsecret", $foreignaccount_google_clientsecret);

    /*
     * Facebook User ID
     */
	if (FACEBOOK_APP_ENABLED == "on") {
		$returnUrl = DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/networking/index.php";
        $urlRedirect = "?destiny=".urlencode($returnUrl);

        require_once(CLASSES_DIR."/class_FacebookLogin.php");
        $fbLogin = new FacebookLogin();
        $checkLink = $fbLogin->getFBLoginURL($urlRedirect);
    }

    if (!$commenting_fb) setting_get("commenting_fb", $commenting_fb);
    if (!$fb_user_id) setting_get("commenting_fb_user_id", $fb_user_id);

    if ($_GET["user_id"]) {
		$fb_user_id = $_GET["user_id"];
	}

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_NETWORKING);?></h1>
            <p><?=system_showText(LANG_SITEMGR_SETTINGS_SHARE_TIP1);?></p>
            <? if ($success) { ?>
            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);?></p>
            <? } ?>
        </section>

        <section class="section-form row">
                <div class="col-xs-12">
                    <? include(INCLUDES_DIR."/forms/form-networking.php"); ?>
                </div>
        </section>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
