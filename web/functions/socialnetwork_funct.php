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
	# * FILE: /functions/socialnetwork_funct.php
	# ----------------------------------------------------------------------------------------------------


	function socialnetwork_writeLink($member_id, $module, $type, $image = false, $ref = false, $tb = false, $class = "", $user = true, $classImg = "", $sponsorArea = false) {
		if ($member_id == 0) {
			return false;
		}
		$account = new Account($member_id);
		$profile = new Profile($member_id);
		$contact = db_getFromDB("contact", "account_id", db_formatNumber($member_id), "1");

		$name_title = string_htmlentities(string_ucwords($profile->nickname && $account->has_profile == "y"? $profile->nickname: $contact->first_name." ".$contact->last_name));
		if ($profile->getNumber("account_id") > 0) {
			$name_link = string_ucwords($profile->nickname && $account->has_profile == "y"? $profile->nickname: $contact->first_name." ".$contact->last_name);
            $name_link = system_showTruncatedText($name_link, 30);
		}

		if ($account->has_profile == "y" && SOCIALNETWORK_FEATURE == "on" && $account->getNumber("id") > 0) {

            if (is_numeric($image)) {
                $imgObj = new Image($image, true);
                if ($imgObj->imageExists()) {
                    if ($ref == true) {
                        if ($user) {
                            $link = "<a ".$class." href=\"javascript:void(0);\" onclick=\"urlRedirect('".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/');\" title=\"".$name_title."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor: default;\" title=\"".$name_title."\">";
                        }
                    } else {
                        if ($user) {
                            $link = "<a ".$class." href=\"".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/\" title=\"".$name_title."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default;\" title=\"".$name_title."\">";
                        }

                    }
                    $link .= $imgObj->getTag(true, PROFILE_IMAGE_WIDTH, PROFILE_IMAGE_HEIGHT, "", false, false, $classImg);
                    $link .= "</a>";

                } else {
                    if ($ref == true) {
                        if ($user) {
                            $link = "<a ".$class." href=\"javascript:void(0);\" onclick=\"urlRedirect('".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/');\" title=\"".$name_title."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\">";
                        }
                    } else {
                        if ($user) {
                            $link = "<a ".$class." href=\"".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/\" title=\"".$name_title."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\">";
                        }
                    }
                    if ($profile->facebook_image) {
                        $facebookImage = $profile->facebook_image;
                        if (HTTPS_MODE == "on") {
                            $facebookImage = str_replace("http://", "https://", $profile->facebook_image);
                        }
                        image_getNewDimension(PROFILE_IMAGE_WIDTH, PROFILE_IMAGE_HEIGHT, 100, 100, $newWidth, $newHeight);
                        $link .= "<img ".($classImg ? "class=\"$classImg\"" : "")." width=\"$newWidth\" height=\"$newHeight\" src=\"".$facebookImage."\" border=\"0\" title=\"".$name_title."\" alt=\"".$name_title."\" />";
                    } else {
                        if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS)){
                            $link .= "<span class=\"no-image no-link\"></span>";
                        } elseif ($sponsorArea) {
                            $link .= "<img src=\"".DEFAULT_URL."/assets/images/structure/icon-user-thumb.gif\" alt=\"$name_title\">";
                        } else {
                            $link .= "<span class=\"no-image\"></span>";
                        }
                    }
                    $link .= "</a>";

                }
            } else if (!$image && !$ref) {
                if ($tb == true) {
                    if ($user) {
                        $link = "<a ".$class." href=\"javascript:void(0);\" onclick=\"urlRedirect('".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/');\" title=\"".$name_title."\">".$name_link."</a>";
                    } else {
                        $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\">".$name_link."</a>";
                    }
                } else {
                    if ($user) {
                        $link = "<a ".$class." href=\"".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/\" title=\"".$name_title."\">".$name_link."</a>";
                    } else {
                        $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\">".$name_link."</a>";
                    }
                }
            } else if ($ref == true) {
                if ($user) {
                    $link = SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/";
                } else {
                    $link = "href=\"javascript:void(0);\" style=\"cursor:default\"";
                }
            }


		} elseif (!$sponsorArea) {
			if (SOCIALNETWORK_FEATURE == "on" && $ref) {
				$link = "<img width=\"".PROFILE_IMAGE_WIDTH."\" height=\"".PROFILE_IMAGE_HEIGHT."\" src=\"".DEFAULT_URL."/assets/images/structure/icon-user-thumb.gif\" border=\"0\" alt=\"No Image\" />";
			} else {
				if ($name_link) {
					$link = "<strong>".$name_link."</strong>";
				}
			}
		}

		return $link;
	}

	function socialnetwork_retrieveInfoProfile($account_id) {
		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$sql = "SELECT * FROM Account, Contact, Profile WHERE Contact.account_id = Profile.account_id AND Profile.account_id = $account_id AND Account.id = $account_id";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_assoc($result);

		return $row;
	}
