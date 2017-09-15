<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/account/sponsor/sponsor.php
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
    
    // required because of the cookie var
	$username = "";	

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (($password == '0' && string_strlen($password) < 4)) {
			$message_account = system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";
		} else {
			
			$_POST['notify_traffic_listing'] = ($_POST['notify_traffic_listing'] ? 'y' : 'n');

			if ($account_id) {
				
				$account = new Account($account_id);

				if ($password) $message_account = validate_password($password, "", false);
				$validate_contact = validate_form("contact", $_POST, $message_contact);
                
                if ($isforeignAcc != "y") {
                    
                    $usernameError = validate_username($username);
                    if ($usernameError) $message_account .= $usernameError;

                    $account_exists = db_getFromDB('account', 'username', db_formatString($username));
                    if ($account_exists->getNumber("id") && $account_id != $account_exists->getNumber("id")){
                        $message_account .= "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_DIFFERENT_USERNAME);
                    }
                    
                }

				if (!$message_account && $validate_contact) {
                    
                    $notifyUser = false;
                    
					if ($_POST['password']) {
                        $notifyUser = true;
						$account->setString("password", $_POST['password']);
						$account->updatePassword();
					}
                    if ($_POST["username"]) {
                        if ($account->getString("username") != $_POST["username"]) {
                            $notifyUser = true;
                        }
                        $account->setString("username", $_POST["username"]);
                    }
					
					$account->setString("notify_traffic_listing", $_POST['notify_traffic_listing']);
								
					$contact = new Contact($_POST);
					$contact->Save();
					$account->Save();

					$profileObj = new Profile($account_id);
					$profileObj->setNumber("account_id", $account_id);
					if (!$profileObj->getString("nickname")) {
						$profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
					}
					$profileObj->Save();

					switch ($account_option) {
						case "is_sponsor": {
							$account->changeMemberStatus(true);
							if ($enable_profile == "on") {
                                $account->changeProfileStatus(true);
                            } else {
                                $account->changeProfileStatus(false);
                            }
							break;
						}
						case "is_member": {
							$account->changeMemberStatus(false);
							$account->changeProfileStatus(true);
							break;
						}
					}

					$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);
					
					if ($_POST["account_option"] == "is_sponsor") {
						$enType = SYSTEM_SPONSOR_ACCOUNT_UPDATE;
					} else {
						$enType = SYSTEM_VISITOR_ACCOUNT_UPDATE;
					}

					if (system_checkEmail($enType) && $notifyUser) {
						system_sendPassword($enType, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name']);
					}

					$message = 0;
					header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?message=".$message."&id=".$account->getNumber("id"));
					exit;
				}

			} else {

				$validate_account = validate_SM_account($_POST, $message_account);
				$validate_contact = validate_form("contact", $_POST, $message_contact);
				if ($validate_account && $validate_contact) {
					$account = new Account($_POST);
					$account->save();
					$contact = new Contact($_POST);
					$contact->setNumber("account_id", $account->getNumber("id"));
					$contact->save();
					$profile = new Profile($account->getNumber("id"));
					$profile->setNumber("account_id", $account->getNumber("id"));
					if (!$profile->getString("nickname")) {
						$profile->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
					}
					$profile->Save();

					switch ($account_option) {
						case "is_sponsor": {
							$account->changeMemberStatus(true);
                            if ($enable_profile == "on") {
                                $account->changeProfileStatus(true);
                            } else {
                                $account->changeProfileStatus(false);
                            }
							break;
						}
						case "is_member": {
							$account->changeMemberStatus(false);
							$account->changeProfileStatus(true);
							break;
						}
					}

					$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profile);

					if ($_POST["account_option"] == "is_sponsor") {
						$enType = SYSTEM_SPONSOR_ACCOUNT_CREATE;
					} else {
						$enType = SYSTEM_VISITOR_ACCOUNT_CREATE;
					}

					if (system_checkEmail($enType)) {
                        $linkActivation = system_getAccountActivationLink($account->getNumber("id"));
						system_sendPassword($enType, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name'], $linkActivation);
					}

					$message = 1;
					header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?message=".$message."&id=".$account->getNumber("id"));
					exit;
				}

			}
		}
		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($_GET['id']) {
		$account = new Account($_GET["id"]);
		$account->extract();
		$has_items = $account->getAccountItems();
		$contact = new Contact($_GET["id"]);
		$contact->extract();
		if ($account->getString("is_sponsor") == "y") {
			$enType = SYSTEM_SPONSOR_ACCOUNT_CREATE;
		} else {
			$enType = SYSTEM_VISITOR_ACCOUNT_CREATE;
		}
		$notification = system_checkEmail($enType);
	} else {
		$notification = system_checkEmail(SYSTEM_SPONSOR_ACCOUNT_CREATE);
		$has_items = false;
	}

	if ($has_items) {
		$pStyle = "disabled";
		$pMessage = "<span>(".system_showText(LANG_LABEL_MSG_PROFILE_STATUS).")</span>";
	} else {
		$pStyle = "";
		$pMessage = "";
	}

	if ($is_sponsor == "y") {
		$cSponsor = "checked";
		$cMember = "";
	} else if ($is_sponsor == "n" && $has_profile == "y") {
		$cSponsor = "";
		$cMember = "checked";
	} else {
		$cSponsor = "checked";
		$cMember = "";
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

        <form role="form" name="account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                
            <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
            <input type="hidden" name="letter" value="<?=$letter?>" />
            <input type="hidden" name="screen" value="<?=$screen?>" />
            <input type="hidden" name="account_id" value="<?=$account_id?>" />

            <section class="row heading">
                <div class="container">
                	<div class="col-xs-12">
                    	<h1><?=system_showText(($id || $account_id ? LANG_SITEMGR_EDIT_SPONSOR : LANG_SITEMGR_ADD_SPONSOR));?></h1>
                    	<p><?=$first_name?> <?=$last_name?></p>
                	</div>
            	</div>
            </section>

            <? if (is_numeric($message) && isset($msg_account[$message])) { ?>
            <div class="container alert alert-info fade in" role="alert">
                <h4><?=$msg_account[$message]?></h4>
            </div>
            <? } elseif ((string_strlen(trim($message_member)) > 0) || (string_strlen(trim($message_account)) > 0) || (string_strlen(trim($message_contact)) > 0) ) { ?>

                <div class="container alert alert-warning fade in" role="alert">
                <? if (string_strlen(trim($message_member)) > 0) { ?>
                    <?=$message_member?>

                    <? if ((string_strlen(trim($message_account)) > 0)) { ?>
                        <br />
                    <? } ?>

                <? } ?>

                <? if (string_strlen(trim($message_account)) > 0) { ?>
                    <?=$message_account?>

                    <? if ((string_strlen(trim($message_contact)) > 0)) { ?>
                        <br />
                    <? } ?>    

                <? } ?>

                <? if (string_strlen(trim($message_contact)) > 0) { ?>
                    <?=$message_contact?>
                <? } ?>
                </div>

            <? } ?>

            <section class="row edit-listing">
                <div class="container">
	                    <? 
	                    if (!($id || $account_id)) {
	                        $autopw = true; 
	                    } else {
	                        $accountID = $id ? $id : $account_id;
	                    }
	                    include(INCLUDES_DIR."/forms/form-account.php"); ?>
                </div>
            </section>

            <section class="row footer-action">
                <div class="container">
                	<div class="row">
	                    <div class="col-xs-12 text-right">
	                        <a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/index.php?screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""))?>" class="btn btn-default"><?=system_showText(LANG_CANCEL);?></a>
	                        <span class="separator"> <?=system_showText(LANG_OR);?> </span>
	                        <button type="submit" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_MSG_SAVE_CHANGES);?></button>
	                    </div>
                    </div>
                </div>
            </section>

        </form>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
