<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/account/myaccount.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    
    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$success = false;
    
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($smaccount) {
		
			if ((string_strlen($_POST["password"]))||(string_strlen($_POST["retype_password"]))) {
				$validate_sitemgrcurrentpassword = validate_sitemgrCurrentPassword($_POST, $_SESSION[SESS_SM_ID], $message_smpassword);
			} else {
				$validate_sitemgrcurrentpassword = true;
			}			
		    
			if (validate_smaccount($_POST, $message_smaccount) && $validate_sitemgrcurrentpassword) {

				if ($permission) {
					$permissions = $permission;
					$permission = 0;
					foreach ($permissions as $each_permission) {
						$permission += $each_permission;
					}
				} else {
					$permission = 0;
				}
				$_POST["permission"] = $permission;

				$smaccount = new SMAccount($_POST["id"]);
				$smaccount->makeFromRow($_POST);
				$smaccount->save();

				if ($password) {
					$smaccount->setString("password", $password);
					$smaccount->updatePassword();
				}

				$success = true;
				$message_smaccount = system_showText(LANG_SITEMGR_MANAGEACCOUNT_SUCCESSUPDATED) ;

			}
	    }		
		if ($changelogin) {
			$validate_sitemgrcurrentpassword = true;
			if ((string_strlen($password))||(string_strlen($retype_password))) {
				setting_get("sitemgr_password", $sitemgr_password);
				if ($sitemgr_password != md5($current_password)) {
					$validate_sitemgrcurrentpassword = false;
					$error_currentpassword = system_showText(LANG_SITEMGR_MSGERROR_CURRENTPASSWORDINCORRECT);
				}
			}
			if ($validate_sitemgrcurrentpassword && validate_SM_changelogin($_POST, $message_changelogin)) {
				if ($username) {
					setting_get("sitemgr_username", $sm_username);
					if ($username != $sm_username) {
						setting_set("sitemgr_username", $username);
						$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MANAGEACCOUNT_USERNAMEWASCHANGED);
					}
				}
				if ($password) {
					$pwDBObj = db_getDBObject(DEFAULT_DB, true);
					$sql = "UPDATE Setting SET value = ".db_formatString(md5($password))." WHERE name = 'sitemgr_password'";
					$pwDBObj->query($sql);
					$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDWASCHANGED);
				}
				if ($actions) {
					$success = true;
					$message_changelogin .= implode("<br />", $actions);
				}
			}
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($_SESSION[SESS_SM_ID]) {
		$smaccount = new SMAccount($_SESSION[SESS_SM_ID]);
		$smaccount->extract();
	} else {
		setting_get("sitemgr_username", $username);
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-accounts.php");

?> 

        <main class="wrapper-dashboard togglesidebar container-fluid">
            
            <?php
            require(SM_EDIRECTORY_ROOT."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?>

            <section class="heading">
                    <h1><?=system_showText(LANG_SITEMGR_MENU_MYACCOUNT);?></h1>
            </section>

            <? if ($_SESSION[SESS_SM_ID]) { ?>
            
            <form role="form" name="smaccount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <section class="section-form">
                	<div class="row">
	                    <div class="col-xs-12">
	                            <input type="hidden" name="id" value="<?=$_SESSION[SESS_SM_ID]?>" />
	                            <? include(INCLUDES_DIR."/forms/form-manager.php"); ?>
	                    </div>
                	</div>
                    <div class="row">
		                <section class="footer-action">
		                    <div class="col-sm-7 text-right">
		                        <button type="submit" name="smaccount" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_MSG_SAVE_CHANGES);?></button>
		                    </div>
		                </section>
                    </div>
                </section>

            </form>
            
            <? } else { ?>
            
            <form role="form" name="changelogin" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <section class="section-form">
                    <div class="col-lg-6 col-sm-8 col-xs-12">
                    	<div class="panel panel-default">
                    		<div class="panel-body">
                            	<? include(INCLUDES_DIR."/forms/form-changelogin.php"); ?>
                    		</div>
                    		<div class="panel-footer">
								<button type="submit" name="changelogin" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_MSG_SAVE_CHANGES);?></button>
                    		</div>
                    	</div>
                    </div>
                </section>
            
            </form>
            
            <? } ?>

        </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>