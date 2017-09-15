<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /sponsors/account/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    if (MAIL_APP_FEATURE == "on") {
        arcamailer_checkSubscriber();
    }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	// required because of the cookie var
	$username = "";

	// Default CSS class for message box
	$message_style = "alert alert-warning";

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$validate_demodirectoryDotCom = true;
		if (DEMO_LIVE_MODE) {
			$validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
		}

		if ($validate_demodirectoryDotCom) {
			if (SOCIALNETWORK_FEATURE == "off") {
				$_POST["publish_contact"] = 'n';
			} else {
				if ($_POST['publish_contact'] == "on") {
					$_POST["publish_contact"] = 'y';
				} else {
					$_POST["publish_contact"] = 'n';
				}
			}
            $_POST['notify_traffic_listing'] = ($_POST['notify_traffic_listing'] ? 'y' : 'n');

			if ((string_strlen($_POST["password"])) || (string_strlen($_POST["retype_password"]))) {
				$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
			} else {
				$validate_membercurrentpassword = true;
			}

			if ($validate_demodirectoryDotCom) {
				if ((string_strlen($_POST["password"])) || (string_strlen($_POST["retype_password"]))) {
					$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
				} else {
					$validate_membercurrentpassword = true;
				}

				$account = new Account($account_id);
				$validate_account = validate_MEMBERS_account($_POST, $message_account, sess_getAccountIdFromSession());
				$validate_contact = validate_form("contact", $_POST, $message_contact);
			}

			if ($validate_demodirectoryDotCom && $validate_membercurrentpassword && $validate_account && $validate_contact) {
				$account = new Account($account_id);
                $lastNewsletter = $account->getString("newsletter");

                $notifyUser = false;
				if ($_POST["password"]) {
                    $notifyUser = true;
					$account->setString("password", $_POST["password"]);
					$account->updatePassword();
				}
                if ($_POST["username"]) {
                    if ($account->getString("username") != $_POST["username"]) {
                        $notifyUser = true;
                    }
                    $account->setString("username", $_POST["username"]);
                }

				$account->setString("notify_traffic_listing", $_POST['notify_traffic_listing']);
				$account->setString("publish_contact", $_POST["publish_contact"]);

                if ($_POST["newsletter"]) {
                    $actualNewsletter = "y";
                } else {
                    $actualNewsletter = "n";
                }

                $account->setString("newsletter", $actualNewsletter);

				$account->Save();

				$contact = new Contact($_POST);
				$contact->Save();

                if ($actualNewsletter != $lastNewsletter) {

                    //Subscribe
                    if ($actualNewsletter == "y") {

                        $fields["name"] = $contact->getString("first_name")." ".$contact->getString("last_name");
                        $fields["type"] = "sponsor";
                        $fields["email"] = $contact->getString("email");
                        arcamailer_addSubscriber($fields, $success, $account->getNumber("id"));

                    //Unsubscribe
                    } else {
                        arcamailer_Unsubscribe($contact->getString("email"), $account->getNumber("id"));
                    }

                }

				$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact);

                if (system_checkEmail(SYSTEM_SPONSOR_ACCOUNT_UPDATE) && $_POST["type"] == "tab_2" && $notifyUser) {
                    system_sendPassword(SYSTEM_SPONSOR_ACCOUNT_UPDATE, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name']);
                }

				$message = system_showText(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED);
				$message_style = "alert alert-success";
			} else {
				$message = "";
				$message_style = "";
			}
		} else {
			$message = "";
			$message_style = "";
		}

	    // removing slashes added if required
	    $_POST = format_magicQuotes($_POST);
	    $_GET  = format_magicQuotes($_GET);

		extract($_GET);
	    extract($_POST);
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (sess_getAccountIdFromSession()) {

		$account = new Account(sess_getAccountIdFromSession());
		$contact = new Contact(sess_getAccountIdFromSession());

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $account->extract();
            $contact->extract();
        }
	} else {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>
	<section class="top-search">

		<? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

		<div class="well well-translucid">
			<div class="container">
				<br>
				<h2><?=system_showText(LANG_LABEL_ACCOUNT);?></h2>
				<br>
			</div>
		</div>
	</section>

    <section class="block">
        <div class="container">
            <div class="well">
                <div class="row">
                    <div class="col-sm-12 member-form">
						<? if ((!$contact->getString("email"))) { ?>
							<div class="alert alert-warning"><?=system_showText(LANG_MSG_FOREIGNACCOUNTWARNING);?></div>
							<?
						}

						include(INCLUDES_DIR."/forms/form_members_messages.php");
						?>

                        <form name="account" id="account" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                            <input type="hidden" name="account_id" value="<?=$account_id?>">

                            <?
							include(INCLUDES_DIR."/forms/form_account_members.php");
							include(INCLUDES_DIR."/forms/form_contact_members.php");
							?>

                            <div id="form-action" class="row">
                                <br><br>
                                <hr>
                                <div class="col-sm-3 col-sm-offset-5">
                                    <button class="btn btn-success btn-block" type="submit" value="Submit"><?=system_showText(LANG_MSG_SAVE_CHANGES)?></button>
								</div>
                            </div>

                        </form>
                    </div>
                </div>


        	</div>
        </div>
    </section>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
