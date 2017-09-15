<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/resetpassword.php
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_SESSION[SESS_SM_ID]) {
			$smaccountObj = new SMAccount($_SESSION[SESS_SM_ID]);
			$sitemgr_username = $smaccountObj->getString("username");
		} else {
			setting_get("sitemgr_username", $sitemgr_username);
		}

		if ($_POST["password"]) {
			if ($_SESSION[SESS_SM_ID]) {
				$message = validate_password($_POST["password"], $_POST["retype_password"], true);
				if (!$message) {
					$smaccountObj->setString("password", $_POST["password"]);
					$smaccountObj->updatePassword();
					$success_message = system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDSUCCESSUPDATED);
				}
			} else {
				if (validate_SM_changelogin($_POST, $message)) {
					$pwDBObj = db_getDBObject(DEFAULT_DB, true);
					$sql = "UPDATE Setting SET value = ".db_formatString(md5($_POST["password"]))." WHERE name = 'sitemgr_password'";
					$pwDBObj->query($sql);
					$success_message = system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDSUCCESSUPDATED);
				}
			}
		} else {
			$message = system_showText(LANG_SITEMGR_MSGERROR_PASSWORDISREQUIRED);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "sitemgr")) {

			if (!$forgotPasswordObj->getString("account_id")) {
				setting_get("sitemgr_username", $sitemgr_username);
			} else {
				$smaccountObj = new SMAccount($forgotPasswordObj->getString("account_id"));
				$sitemgr_username = $smaccountObj->getString("username");
			}

			$forgotPasswordObj->Delete();

			if (!$sitemgr_username) {
				$error_message = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGACCOUNT);
			}

		} else {
			$error_message = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGKEY);
		}

	} else {
		$error_message = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGKEY);
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
	<div class="container">
		<div class="container-fluid row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
		      
			<?
            require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            
            if ($success_message) { ?>
                <br>
				<p class="alert alert-success"><?=$success_message;?></p>
			<? } elseif ($error_message && !$message) { ?>
                <br>
				<p class="alert alert-danger"><?=$error_message;?></p>
			<? } else { ?>

				<? if ($message) { ?>
                    <br>
					<p class="alert alert-warning"><?=$message;?></p>
				<? } ?>

				<form name="formResetPassword" role="form" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

					<h2><?=string_ucwords(system_showText(LANG_SITEMGR_RESET))?> <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_PASSWORD))?></h2>

                    <div class="form-group">
                        <label class="control-label" for="id-password"><?=system_showText(LANG_LABEL_NEW_PASSWORD)?></label>
                        <input type="password" autocomplete="off" name="password" id="id-password" required maxlength="<?=PASSWORD_MAX_LEN?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="label-control" for="retype-password"><?=system_showText(LANG_SITEMGR_LABEL_RETYPEPASSWORD)?></label>
                        <input type="password" autocomplete="off" name="retype_password" id="retype-password" required class="form-control" />					
                    </div>

                    <div class="form-group">
                        <button type="submit" value="Submit" class="btn btn-primary btn-block"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>	
                    </div>
							
				</form>

			<? } ?>

			</div>
		</div>
	</div>



			


<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
