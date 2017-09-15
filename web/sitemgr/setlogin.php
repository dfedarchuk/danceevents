<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/setlogin.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
	$destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
	if ($_SERVER["QUERY_STRING"]) {
		if (string_strpos($_SERVER["QUERY_STRING"], "query=") !== false) {
			$query = string_substr($_SERVER["QUERY_STRING"], string_strpos($_SERVER["QUERY_STRING"], "query=")+6);
		} else {
			$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
			$query = urldecode($query);
		}
	} else {
		$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
		$query = urldecode($query);
	}
	if ($destiny) {
        
        if (EDIRECTORY_FOLDER){
            $url = EDIRECTORY_FOLDER.str_replace(EDIRECTORY_FOLDER, "", $destiny);
        } else {
            $url = $destiny;
        }
        
		if ($query) $url .= "?".$query;
	} else {
		$url = DEFAULT_URL."/".SITEMGR_ALIAS."/";
	}

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if (DEMO_DEV_MODE || DEMO_LIVE_MODE) {
		header("Location: ".$url);
		exit;
	} else {
		setting_get("sitemgr_first_login", $sitemgr_first_login);
		if ($sitemgr_first_login != "yes") {
			header("Location: ".$url);
			exit;
		}
		$smusername = "";
		if ($_SESSION[SESS_SM_ID]) {
			$smacctObj = db_getFromDB("smaccount", "id", db_formatNumber($_SESSION[SESS_SM_ID]));
			$smusername = $smacctObj->getString("username");
		}
		if ($smusername == ARCALOGIN_USERNAME) {
			header("Location: ".$url);
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($changelogin) {

			$validate_sitemgrcurrentpassword = true;
			setting_get("sitemgr_password", $sitemgr_password);
			if ($sitemgr_password != md5($current_password)) {
				$validate_sitemgrcurrentpassword = false;
				$error_currentpassword = system_showText(LANG_SITEMGR_MSGERROR_CURRENTPASSWORDINCORRECT);
			}

			$_POST["setlogin"] = true;
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
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDWASCHANGED);
				}

				if ($actions) {
					$message_changelogin .= implode("<br />", $actions);
				}

                //Update todo Items
                todo_updateItemsFirstLogin();

				header("Location: ".$url);
				exit;
			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("sitemgr_username", $username);

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
            <div class="col-md-5 col-md-offset-1">
                <section class="heading">
                    <h1><?=system_showText(LANG_SITEMGR_HOME_WELCOME)?>!</h1>
                    <p><?=nl2br(system_showText(LANG_SITEMGR_SETLOGIN_INFO1))?></p>
                </section>
            </div>
            <div class="col-md-5">

                <? if ($_SESSION[SESS_SM_ID]) { ?>
                
                    <br><br>
                    <p class="alert alert-warning">
                        <?=system_showText(LANG_SITEMGR_SETLOGIN_ERROR1)?><br /><br />
                        <?=system_showText(LANG_SITEMGR_SETLOGIN_ERROR2)?>
                    </p>

                <? } else { ?>

                    <form name="changelogin" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                        <input type="hidden" name="destiny" value="<?=$destiny?>" />
                        <input type="hidden" name="query" value="<?=urlencode($query)?>" />
                        <br><br>
                        <div class="panel panel-default">
                            <div class="panel-heading"><?=string_ucwords(system_showText(LANG_SITEMGR_MANAGEACCOUNT_SITEMGRACCOUNT))?></div>
                            <div class="panel-body">
                                <? include(INCLUDES_DIR."/forms/form-changelogin.php"); ?>
                            </div>
                            <div class="panel-footer text-center">
                                <button type="submit" name="changelogin" value="Submit" class="btn btn-primary"><?=system_showText(LANG_LABEL_ACCOUNT_CHANGEPASS);?></button>
                            </div>
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