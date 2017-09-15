<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /includes/code/profile.php
	# ----------------------------------------------------------------------------------------------------

	if ($_POST["ajax"]) {
		# ----------------------------------------------------------------------------------------------------
		# LOAD CONFIG
		# ----------------------------------------------------------------------------------------------------
		include("../../conf/loadconfig.inc.php");
	}
	$validate_demodirectoryDotCom = true;
	if (DEMO_LIVE_MODE) {
		$validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($validate_demodirectoryDotCom) {
			if ($_POST["ajax"]) {

                if ($_POST["action"] == "changeStatus") {

                    if ($_POST['has_profile'] == "on" || $_POST['has_profile'] == "true") {
                        $has_profile = true;
                    } else {
                        $has_profile = false;
                    }

                    $accObj = new Account();
                    $accObj->setNumber("id", $_POST["account_id"]);
                    $accObj->changeProfileStatus($has_profile);

                    $accDomain = new Account_Domain($accObj->getNumber("id"), SELECTED_DOMAIN_ID);
                    $accDomain->Save();
                    $accDomain->saveOnDomain($accObj->getNumber("id"), $accObj);

                } elseif ($_POST["action"] == "removePhoto") {

                    $profileObj = new Profile($_POST["account_id"]);

                    $idm = $profileObj->getNumber("image_id");
                    $image = new Image($idm, true);
					if ($image) $image->Delete();

                    $profileObj->setNumber("image_id", 0);
                    $profileObj->setString("facebook_image", "");

                    $profileObj->save();

                }
			}

			extract($_POST);


			if (file_exists($_FILES['image']['tmp_name'])) {
				$imageArray = image_uploadForItem($_FILES['image']['tmp_name'], $_POST["account_id"]."_", 200, 200, "", "", true);
				if ($imageArray["success"]) {
					$_POST["facebook_image"] = "";
					$upload_image = "success";
					$remove_image = false;
					$_POST["image_id"] = $imageArray["image_id"];

					//remove old image
					$profileObj = new Profile($_POST["account_id"]);
					$oldImage = $profileObj->getNumber("image_id");
					if ($oldImage) {
						$imageAux = new Image($oldImage, true);
						if ($imageAux) $imageAux->Delete();
					}

				} else {
					$upload_image = "failed";
				}
			}

			$accObj = new Account($_POST["account_id"]);
			$profileObj = new Profile($_POST["account_id"]);

            if ($_POST["facebook_image"]) {
                $_POST["image_id"] = "";
            }

            if (!trim($_POST["nickname"])) {
                $message_profile .= "&#149;&nbsp;".system_showText(LANG_MSG_NICKANAME_REQUIRED)."<br />";
                $error = 1;
            }

            if (!$friendly_url) {
                $message_profile = "&#149;&nbsp;".system_showText(LANG_LABEL_YOURURL_REQUIRED)."<br />";
                $error = 1;
            } else {
                if (!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) {
                    $message_profile = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_INVALID_CHARS)."<br />";
                    $error = 1;
                }
            }

            if ($profileObj->fUrl_Exists($_POST["friendly_url"])) {
                $message_profile .= "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_URL_IN_USE);
                $error = 1;
            }

            if (!$error) {
                $profileObj->makeFromRow($_POST);
                $profileObj->Save();

                $accDomain = new Account_Domain($profileObj->getNumber("account_id"), SELECTED_DOMAIN_ID);
                $accDomain->Save();
                $accDomain->saveOnDomain($profileObj->getNumber("account_id"), false, false, $profileObj);

                $message = system_showText(LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED);
                $message_style = "successMessage";

                $profileObj = new Profile($account_id);
                $profileObj->extract();
            }
		}
	} else {
		if (string_strpos($_SERVER["PHP_SELF"], "/".SOCIALNETWORK_FEATURE_NAME."/") !== false && $_GET["tab"] != "tab_2") {
			$accObj = new Account(sess_getAccountIdFromSession());
            $contactObj = new Contact($accObj->getNumber("id"));
            if (!$contactObj->getString("email")) {
				header("Location: ".SOCIALNETWORK_URL."/edit.php?tab=tab_2");
				exit;
			}
		}

		$profileObj = new Profile(sess_getAccountIdFromSession());
		$profileObj->extract();
	}
