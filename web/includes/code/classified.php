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
	# * FILE: /includes/code/classified.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	$seoTitleField = "seo_title";
	$seoDescField = "seo_summarydesc";
	$keywordSep = ",";

	include(INCLUDES_DIR."/code/coverimage.php");

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
        /*
         * Sorry for that, I tried really hard to not do this, but I can not
         * make the plugin send to me an empty listing_id, so, the only way I
         * found to do this, is sending a 0 (zero). If you improved it, email me.
         */
        isset($_POST['listing_id']) and $_POST['listing_id'] == 0 and $_POST['listing_id'] = null;

        NewImageUploader::treatPost($url_base, "Classified");

		##################################################
		### KEYWORDS
		##################################################
        unset($arr_keywords);
        unset($each_keyword);
        unset($aux_kw);
        unset($new_arr_keywords);
        unset($aux_keywords);
        $arr_keywords = explode($keywordSep, $keywords);
        foreach ($arr_keywords as $each_keyword) {
            $aux_kw = trim($each_keyword);
            if (string_strlen($aux_kw) > 0) {
                $new_arr_keywords[] = $aux_kw;
            }
        }
        if ($new_arr_keywords) {
            $aux_keywords = implode(" || ", $new_arr_keywords);
        }
        $_POST["keywords"] = $aux_keywords;
        $_POST["array_keywords"] = $new_arr_keywords;
		##################################################

		$_POST["title"] = trim($_POST["title"]);

        // strip \r chars provided by Windows, in order to keep character count standard
        if ($_POST["summarydesc"]) {
            $_POST["summarydesc"] = str_replace("\r", "", $_POST["summarydesc"]);
        }

		if ($_POST["seo_summarydesc"]) {
			$_POST["seo_summarydesc"] = str_replace(array("\r\n", "\n"), " ", $_POST["seo_summarydesc"]);
			$_POST["seo_summarydesc"] = str_replace("\"", "", $_POST["seo_summarydesc"]);
		}
		if ( $_POST["seo_keywords"] ) {
			$_POST["seo_keywords"] = str_replace("\"", "", $_POST["seo_keywords"]);
			$_POST["seo_keywords"] = str_replace(array("\r\n", "\n"), ", ", $_POST["seo_keywords"]);
		}

		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);
        $_POST["video_snippet"] = str_replace( "\"", "'", $_POST["video_snippet"] );

		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Classified WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObjFriendlyURL = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) {
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		}
        if (!$id && !$_POST["friendly_url"]) {
            $_POST["friendly_url"] = uniqid();
        }


        if ( $_FILES['attachment_file']['name'] )
        {
            $array_allowed_types  = array( 'pdf', 'doc', 'docx', 'txt', 'jpg', 'gif', 'png' );
            $arr_attachment       = explode( ".", $_FILES['attachment_file']['name'] );
            $attachment_extension = $arr_attachment[count( $arr_attachment ) - 1];
            $allow_attachment_file = false;
            if ( in_array( string_strtolower( $attachment_extension ), $array_allowed_types ) )
            {
                $allow_attachment_file = true;
            }
        }

		if (validate_form("classified", $_POST, $message_classified) && is_valid_discount_code($_POST["discount_id"], "classified", $_POST["id"], $message_classified, $discount_error_num) && (!isset($allow_attachment_file) || $allow_attachment_file)) {

			//price field
            $_POST["classified_price"] = 'NULL';
			if ( $classified_price_int || $classified_price_cent ) {
				if ( !$classified_price_int ) $classified_price_int = 0;
				$_POST["classified_price"] = $classified_price_int.".".$classified_price_cent;
			}

			// adding new locations if posted
			if ($_POST["new_location2_field"] != "" || $_POST["new_location3_field"] != "" || $_POST["new_location4_field"] != "" || $_POST["new_location5_field"] != "") {

				$locationsToSave = array();

				$_locations = explode(",", EDIR_LOCATIONS);
				$_defaultLocations = explode (",", EDIR_DEFAULT_LOCATIONS);
				$_nonDefaultLocations = array_diff_assoc($_locations, $_defaultLocations);

				foreach ($_defaultLocations as $defLoc)
					$locationsToSave[$defLoc] = $_POST["location_".$defLoc];

				$stop_insert_location = false;

				foreach ($_nonDefaultLocations as $nonDefLoc) {
					if (trim($_POST["location_".$nonDefLoc])!="")
						$locationsToSave[$nonDefLoc] = $_POST["location_".$nonDefLoc];
					else {
						if (!$stop_insert_location) {
							if (!$_POST['new_location'.$nonDefLoc.'_field']) {
								$stop_insert_location = true;
							} else {
								$objNewLocationLabel = "Location".$nonDefLoc;
								$objNewLocation = new $objNewLocationLabel;

								foreach ($locationsToSave as $level => $value)
									$objNewLocation->setString("location_".$level, $value);

								$objNewLocation->setString("name", $_POST['new_location'.$nonDefLoc.'_field']);
								$objNewLocation->setString("friendly_url", $_POST['new_location'.$nonDefLoc.'_friendly']);
								$objNewLocation->setString("default", "n");
								$objNewLocation->setString("featured", "n");

								$newLocationFlag = $objNewLocation->retrievedIfRepeated($_locations);
								if ($newLocationFlag) $objNewLocation->setNumber("id", $newLocationFlag);
								else $objNewLocation->Save();
								$_POST["location_".$nonDefLoc] = $objNewLocation->getNumber("id");
								$locationsToSave[$nonDefLoc]=$_POST["location_".$nonDefLoc];
							}
						}
					}
				}
			}

			//updating classified level to default level if current level is not active
            if (!$levelObj) {
                $levelObj = new ClassifiedLevel(true);
                $classified = new Classified($id);
                if ($levelObj->getActive($classified->getNumber("level")) == 'n') {
                    $_POST["level"] = $levelObj->getDefaultLevel();
                }
            }

            // fixing url field if needed.
            if (trim($_POST["url"]) != "") {
                if (string_strpos($_POST["url"], "://") === false) {
                    $_POST["url"] = "http://" . $_POST["url"];
                }
                $_POST["url"] = $_POST["url"];
            }

            // setting seo_description and seo_keyword when member signup for an item
            if ( $members && $process == 'signup' ) {
                (!isset($_POST["seo_summarydesc"])) ? ($_POST["seo_summarydesc"] = str_replace("\n", " ", $_POST["summarydesc"])) : '';
                (!isset($_POST["seo_keywords"])) ? ($_POST["seo_keywords"] = str_replace(" ||", ",", $_POST["keywords"])) : '';
            }

            // removing linebreaks from seo_description
            if ( !$id ) {
                ($_POST["seo_summarydesc"] = str_replace("\n", " ", $_POST["seo_summarydesc"]));
            }

            // Clean Attachment
            if ( ($remove_attachment) || (file_exists( $_FILES['attachment_file']['tmp_name'] )) )
            {
                if ( $id )
                {
                    $classified            = new Classified( $id );
                    if ( $id_attachment_file = $classified->getString( "attachment_file" ) )
                    {
                        if ( file_exists( EXTRAFILE_DIR . "/" . $id_attachment_file ) )
                        {
                            @unlink( EXTRAFILE_DIR . "/" . $id_attachment_file );
                        }
                        $classified->setString( "attachment_file", "" );
                        $_POST["attachment_file"] = "";
                        $_POST["attachment_caption"] = "";
                        $classified->save();
                    }
                    unset( $classified );
                }
            }

			$statusObj = new ItemStatus();
			$classified = new Classified($id);
			$new_classified = false;
			$update_classified = false;

			if (!$classified->GetString("id") || $classified->GetString("id") == 0){
				$new_classified = true;
				$aux_package_id = $_POST["package_id"];
				$_POST["package_id"] = 0;

				system_addItemGallery($gallery_hash, $_POST["title"], $galleryIDC, $image_id, $thumb_id);

				$message = 0;
                $emailNotification = true;
				$newest = "1";

				$classified->makeFromRow($_POST);
				if (string_strpos($url_base, "/" . SITEMGR_ALIAS . "") !== false && sess_isSitemgrLogged()) {
                    $classified->setString("status", ($status ? $status : $statusObj->getDefaultStatus()));
                    $classified->setDate("renewal_date", ($_POST["renewal_date"] ? $_POST["renewal_date"] : "00/00/0000"));
                } else {
                    $classified->setString("status", $statusObj->getDefaultStatus());
                    $classified->setDate("renewal_date", "00/00/0000");
                }

				if (string_strpos($url_base, "/".SITEMGR_ALIAS."") && $_POST["account_id"]) {
					system_renameGalleryImages($image_id, $thumb_id, $_POST["account_id"], $galleryIDC);
				}

				$_POST["package_id"] = $aux_package_id;

			} else {
				$update_classified = true;
                $gallery_id = $galleryid ? $galleryid : $gallery_id;

                system_addItemGallery($gallery_hash, $_POST["title"], $gallery_id, $image_id, $thumb_id);
                $galleryIDC = $gallery_id;
                $message = 1;
				$emailNotification = false;
				if ($classified->getString("status") != $statusObj->getDefaultStatus()) $emailNotification = true;

				if (string_strpos($url_base, "/" . SITEMGR_ALIAS . "") !== false && sess_isSitemgrLogged()) {
					if ($classified->getNumber("account_id") != $_POST["account_id"] || $_POST["account_id"]) {
						$image_idT = $classified->getNumber("image_id");
						$thumb_idT = $classified->getNumber("thumb_id");

						system_renameGalleryImages($image_idT, $thumb_idT, $_POST["account_id"], $galleryIDC);
					}

				} else {
                    //security issue
                    unset($_POST["status"]);
                    unset($_POST["renewal_date"]);

                    if (!$classified->hasRenewalDate()) {
                        $_POST["renewal_date"] = "0000-00-00";
                    }
					$last_status = $classified->getString("status");
				}

				$classified->makeFromRow($_POST);

				if (string_strpos($url_base, "/".MEMBERS_ALIAS.""))
				{
					setting_get("classified_approve_updated", $classified_approve_updated);
					if ($last_status == "A" && !$classified->needToCheckOut() && !$classified_approve_updated && $process != "signup")
					{
						$classified->setString("status", "A");
					}
					else if ($process == "signup")
					{
						$classified->setString("status", $last_status);
					}
				}
			}

			if ($image_id) {
				$classified->setNumber("image_id",$image_id);
				$classified->setNumber("thumb_id",$thumb_id);
			}

			$levelObjTmp = new ClassifiedLevel(true);
			$levelsTmp = $levelObjTmp->getLevelValues();
			if (!in_array($classified->getNumber("level"), $levelsTmp)) {
				$classified->setNumber("level", $levelObjTmp->getDefaultLevel());
			}
			unset($levelObjTmp);
			unset($levelsTmp);

            /* saves classified */
			$classified->Save();

			//setting gallery
			$classified->setGalleries($galleryIDC);


            // ATTACHMENT FILE UPLOAD
            if ( (file_exists( $_FILES['attachment_file']['tmp_name'] ) ) )
            {
                $classifiedObj = new Classified($classified->getNumber( "id" ));
                $file_name = "classified_attach_" . $classifiedObj->getNumber( "id" ) . "." . $attachment_extension;
                $classifiedObj->setString( "attachment_file", $file_name );
                $file_path = EXTRAFILE_DIR . "/" . $file_name;
                if ( filesize( $_FILES['attachment_file']['tmp_name'] ) )
                {
                    copy( $_FILES['attachment_file']['tmp_name'], $file_path );
                }
                else
                {
                    $classifiedObj->setString( "attachment_file", "" );
                }
                $classifiedObj->Save();
            }

			/**
			*
			* E-mail notify
			*
			***************************************************************************************************/
			$domain = new Domain(SELECTED_DOMAIN_ID);
			$error = false;
			if ($classified->getNumber("account_id") > 0) {
				if($message == 0) {
					$contactObj = new Contact($classified->getNumber("account_id"));
					if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_CLASSIFIED)) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = explode(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$subject = $emailNotificationObj->getString("subject");
						$body    = $emailNotificationObj->getString("body");
						$body = system_replaceEmailVariables($body,$classified->getNumber('id'),'classified');
						$subject = system_replaceEmailVariables($subject,$classified->getNumber('id'),'classified');
						$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
						$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);

                        Mailer::mail($contactObj->getString("email"), $subject, $body, $emailNotificationObj->getString("content_type"), null, $emailNotificationObj->getString("bcc") );
					}
				}
			}
			if ($emailNotification) {
				if (!string_strpos($url_base, "/".SITEMGR_ALIAS."")) {

                    // site manager warning message /////////////////////////////////////
					$domain_url = DEFAULT_URL;
					$domain_url = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $domain_url);

					setting_get("sitemgr_classified_email", $sitemgr_classified_email);
					$sitemgr_classified_emails = explode(",", $sitemgr_classified_email);

					$account = new Account($acctId);
                    setting_get("new_classified_email", $new_classified_email);
					setting_get("update_classified_email", $update_classified_email);
                    $sentUp = 0;
					$sentNew = 0;

					$emailSubject = system_showText(LANG_NOTIFY_CLASSIFIED);
					$sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />";

                    if ($_POST["id"]) {
                        $sitemgr_msg .= ucfirst(LANG_CLASSIFIED_FEATURE_NAME)." \"".$classified->getString("title")."\" ".system_showText(LANG_NOTIFY_ITEMS_1)." \"".system_showAccountUserName($account->getString("username"))."\" ".system_showText(LANG_NOTIFY_ITEMS_3)."<br /><br />";
                        $sentUp = 1;
                    } else {
                        $sitemgr_msg .= ucfirst(LANG_CLASSIFIED_FEATURE_NAME)." \"".$classified->getString("title")."\" ".system_showText(LANG_NOTIFY_ITEMS_2)." \"".system_showAccountUserName($account->getString("username"))."\" ".system_showText(LANG_NOTIFY_ITEMS_3)."<br /><br />";
                        $sentNew = 1;
                    }
                    $link_sitemgrmsg = "<a href=\"".$domain_url."/content/".SITEMGR_ALIAS."/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$classified->getNumber("id")."\" target=\"_blank\">".$domain_url."/".SITEMGR_ALIAS."/content/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$classified->getNumber("id")."</a><br /><br />";
                    $sitemgr_msg .= $link_sitemgrmsg.EDIRECTORY_TITLE;

                    if (($update_classified_email && $sentUp == 1) || ($new_classified_email && $sentNew == 1)) {
                        system_notifySitemgr($sitemgr_classified_emails, $emailSubject, $sitemgr_msg);
					}
				}
			}
			/**************************************************************************************************/

			// setting categories
			$return_categories_array = explode(",", $return_categories);
			$classified->setCategories($return_categories_array);

			/*
			 * Check if is bought package
			 */
			if($_POST["using_package"] == "y"){
				/*
				 * Check if exists package
				 */
				$packageObj = new Package();
				$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "classified", $classified->level);
				$hasPackage = false;
				if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {

					unset($array_info_package);
					$array_info_package["item_type"]		= "classified";
					$array_info_package["item_id"]			= $classified->getNumber("id");
					$array_info_package["item_name"]		= $classified->getString("title");
					$array_info_package["item_friendly_ur"]	= $classified->getString("friendly_url");
					$array_info_package["package_id"][0]	= $package_id;
					package_buying_package($array_info_package, false, true);

				}
			}

			if ($new_classified){
				setting_get("classified_approve_free", $classified_approve_free);

				if (!$classified_approve_free && !$classified->needToCheckOut()){
					$classified->setString("status", "A");
					$classified->save();
				}
			}

			header("Location: $url_redirect/index.php?module=classified&process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "" )."");
			exit;

		} else if ( !$allow_attachment_file )
        {
            $message_classified .= "<br />" . system_showText( LANG_MSG_ATTACHED_FILE_DENIED ) . "<br />";
        }

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}

    $video_snippet = str_replace( "\"", "'", $video_snippet );

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
	$gallery_hash = $_POST["gallery_hash"] ? $_POST["gallery_hash"] : "classified".($id ? "_$id" : "")."_".uniqid(rand(), true);

	// Location General Defines
	$_non_default_locations = "";
	$_default_locations_info = "";
	if (EDIR_DEFAULT_LOCATIONS) {

		system_retrieveLocationsInfo ($_non_default_locations, $_default_locations_info);

		$last_default_location	  =	$_default_locations_info[count($_default_locations_info)-1]['type'];
		$last_default_location_id = $_default_locations_info[count($_default_locations_info)-1]['id'];

		if ($_non_default_locations) {
			$objLocationLabel = "Location".$_non_default_locations[0];
			${"Location".$_non_default_locations[0]} = new $objLocationLabel;
			${"Location".$_non_default_locations[0]}->SetString("location_".$last_default_location, $last_default_location_id);
			${"locations".$_non_default_locations[0]} = ${"Location".$_non_default_locations[0]}->retrieveLocationByLocation($last_default_location);
		}

	} else {
		$_non_default_locations = explode(",", EDIR_LOCATIONS);
		$objLocationLabel = "Location".$_non_default_locations[0];
		${"Location".$_non_default_locations[0]} = new $objLocationLabel;
		${"locations".$_non_default_locations[0]}  = ${"Location".$_non_default_locations[0]}->retrieveAllLocation();
	}
	// End Location General Defines

	if ($id) {

		if (string_strpos($url_base, "/".MEMBERS_ALIAS."")) {
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$classified = db_getFromDB("classified", $by_key, $by_value, 1, "", "object", SELECTED_DOMAIN_ID);
		} else {
			$classified = db_getFromDB("classified", "id", db_formatNumber($id), 1, "", "object", SELECTED_DOMAIN_ID);
		}

		if ((sess_getAccountIdFromSession() != $classified->getNumber("account_id")) && (!string_strpos($url_base, "/".SITEMGR_ALIAS.""))) {
			header("Location: $url_redirect/");
			exit;
		}

		if ($_SERVER['REQUEST_METHOD'] != "POST"){
			$classified->extract();
        }

		// Location defines begin for edit classified
		$stop_search_locations = false;
		//if there is at least one non default location
		if ($_non_default_locations) {
			foreach($_non_default_locations as $_location_level) {
				system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
				if (${'location_'.$_location_level} && $_location_child_level) {
					if (!$stop_search_locations) {
						$objLocationLabel = "Location".$_location_child_level;
						${"Location".$_location_child_level} = new $objLocationLabel;
						${"Location".$_location_child_level}->SetString("location_".$_location_level, ${"location_".$_location_level});
						${"locations".$_location_child_level} = ${"Location".$_location_child_level}->retrieveLocationByLocation($_location_level);
					} else 	${"locations".$_location_child_level} = "";
				} else $stop_search_locations = true;
			}
			unset ($_location_father_level);
			unset ($_location_child_level);
			unset ($_location_level);
		}
		// End Locations

		$galleries = db_getFromDBBySQL("gallery", "SELECT gallery_id FROM Gallery_Item WHERE item_id = ".$id." AND item_type = 'classified ' ORDER BY id", "array", false, SELECTED_DOMAIN_ID);
		$gallery_id = $galleries[0]["gallery_id"];

		if (!$gallery_id && $image_id && $thumb_id){
			$gallery = new Gallery($id);
			$aux = array("account_id"=>0,"title"=>$title,"entered"=>"NOW()","updated"=>"now()");
			$gallery->makeFromRow($aux);
			$gallery->save();
			$classified->setGalleries($gallery->getNumber("id"));
			$gallery_id = $gallery->getNumber("id");
            $image_id = $image_id ? $image_id : 'NULL';
			$sql = "INSERT INTO Gallery_Image (gallery_id,image_id,thumb_id,image_default) VALUES ($gallery_id,".$image_id.",".$thumb_id.",'y')";

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$dbObj->query($sql);
		}

	} else {

		$classified = new Classified($id);
		$classified->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

		// Location defines begin for add classified
		$stop_search_locations = false;
		//if there is at least one non default location
		if ($_non_default_locations) {
			foreach($_non_default_locations as $_location_level) {
				if ($_POST["location_".$_location_level])
					${"location_".$_location_level} = $_POST["location_".$_location_level];
				else
					$stop_search_locations = true;
				system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
				if (${'location_'.$_location_level} && $_location_child_level) {
					if (!$stop_search_locations) {
						$objLocationLabel = "Location".$_location_child_level;
						${"Location".$_location_child_level} = new $objLocationLabel;
						${"Location".$_location_child_level}->SetString("location_".$_location_level, ${"location_".$_location_level});
						${"locations".$_location_child_level} = ${"Location".$_location_child_level}->retrieveLocationByLocation($_location_level);
					} else 	${"locations".$_location_child_level} = "";
				} else $stop_search_locations = true;
			}
			unset ($_location_father_level);
			unset ($_location_child_level);
			unset ($_location_level);
		}
		// End Locations
	}
    unset($_GET["classified"]);
    if ($_GET["title"]) $_GET["title"] = htmlspecialchars($_GET["title"]);
	extract($_POST);
	extract($_GET);

    // Level
	$levelObj = new ClassifiedLevel(true);
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
		$level = $levelObj->getDefaultLevel();
	}

    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Classified", $level);

    //Gallery and main image
    $levelMaxImages = $levelObj->getImages($level);
    $onlyMainImage = false;
    $hasMainImage = false;
    if (is_array($array_fields) && in_array("main_image", $array_fields) && $levelMaxImages == 0){ //level with only one main image, no gallery
       $onlyMainImage = true;
    }

    if (is_array($array_fields) && in_array("main_image", $array_fields)) {
        $hasMainImage = true;
    }

    $hasImage = false;
    if ($onlyMainImage) {
        $sess_id = $gallery_hash;
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "SELECT image_id FROM Gallery_Temp WHERE sess_id = '$sess_id'";
        $result = $dbObj->query($sql);

        if ($row = mysql_fetch_assoc($result)) {
            $hasImage = true;
        }

    } else {
        $hasImage = true;
    }

    if (!$gallery_id) {
        $gallery_id = $classified->getGalleries();
        $gallery_id = $gallery_id[0];
    }

    //Categories
	$categories = "";
    $selectizeCategs = array();
    $selectizeCategsIndex = 0;
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($_POST["cat_1_id"]) {
			$return_categories_array[] = $_POST["cat_1_id"];
			foreach ($return_categories_array as $each_category) {
				$categories[] = new ClassifiedCategory($each_category);
			}
		}
	} else {
		if (!$categories) if ($classified) $categories = $classified->getCategories();
	}

	if ($categories) {
		for ($i=0; $i<count($categories); $i++) {
			$arr_category[$i]["name"] = $categories[$i]->getString("title");
			$arr_category[$i]["value"] = $categories[$i]->getNumber("id");
			$arr_return_categories[] = $categories[$i]->getNumber("id");
		}
		if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
		array_multisort($arr_category);
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
		if ($arr_category) foreach ($arr_category as $each_category) {
			$feedDropDown .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
			$feedAjaxCategory[] = $each_category["value"];
            $selectizeCategs[$selectizeCategsIndex]["value"] = $each_category["value"];
            $selectizeCategs[$selectizeCategsIndex]["name"] = $each_category["name"];
            $selectizeCategsIndex++;
		}
		$feedDropDown .= "</select>";
	} else {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			if ($return_categories_array) {
				foreach ($return_categories_array as $each_category) {
					$categories[] = new ClassifiedCategory($each_category);
				}
			}
		}
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' ".($highlight == "additional" ? "class=\"highlight\"" : "")." style=\"width:500px\">";
		if ($categories) {
			foreach ($categories as $category) {
				$name = $category->getString("title");
				$feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
				$feedAjaxCategory[] = $category->getNumber("id");
                $selectizeCategs[$selectizeCategsIndex]["value"] = $category->getNumber("id");
                $selectizeCategs[$selectizeCategsIndex]["name"] = $name;
                $selectizeCategsIndex++;
			}
		}
		$feedDropDown .= "</select>";
	}

	$video_snippet = str_replace( "\"", "'", $video_snippet );

	//Keywords
    unset($arr_keywords);
    if ($_POST["keywords"]) {
        $arr_keywords = explode(" || ", $_POST["keywords"]);
        $keywords = implode($keywordSep, $arr_keywords);
    } elseif ($classified->getString("keywords")) {
        $arr_keywords = explode(" || ", $classified->getString("keywords"));
        $keywords = implode($keywordSep, $arr_keywords);
    }

    //Map Control
    $loadMap = false;
    $mapObj = new GoogleSettings(SELECTED_DOMAIN_ID);
    if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->mapsStatus == "on") {
        $loadMap = true;
        $formLoadMap = "document.classified";

        $hasValidCoord = false;

        if ($latitude && $longitude && is_numeric($latitude) && is_numeric($longitude)) {
            $hasValidCoord = true;
        }

        if (!$id || $hasValidCoord) {
            $_COOKIE['showMapForm'] = 0;
        }
    }

    // Status Drop Down
    $statusObj = new ItemStatus();
    unset($arrayValue);
    unset($arrayName);
    $arrayValue = $statusObj->getValues();
    $arrayName = $statusObj->getNames();
    unset($arrayValueDD);
    unset($arrayNameDD);
    for ($i = 0; $i < count($arrayValue); $i++) {
        if ($status == "E" || $arrayValue[$i] != "E") {
            $arrayValueDD[] = $arrayValue[$i];
            $arrayNameDD[] = $arrayName[$i];
        }
    }
    $statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, ($status ? $status : "A"), "", "class=\"form-control status-select\"", "");

    //Auxiliary array to prepare the tutorail
    $arrayTutorial = array();
    $counterTutorial = 0;

	$imageUploader = new NewImageUploader("classified", $gallery_hash, $gallery_id, $levelMaxImages, SELECTED_DOMAIN_ID, true, true);
	$imageUploader->registerJavaScript();

// classified options
if (sess_isSitemgrLogged()) {
    $listings = Listing::getListingBySitemgrRulesUsingClassified($classified);
} else {
    $listings = Listing::getListingByUser(sess_getAccountIdFromSession());
}
