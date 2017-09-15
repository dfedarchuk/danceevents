<?php

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
	# * FILE: /functions/system_funct.php
	# ----------------------------------------------------------------------------------------------------

	function system_showPre($array, $label="") {
		echo "<pre>$label: ";
		var_dump($array);
		echo "</pre>";
	}

    function system_generateFriendlyURL($string) {

        include(EDIRECTORY_ROOT."/conf/specialChars.inc.php");

        $string_friendly_url = preg_replace("/[^".FRIENDLYURL_VALIDCHARS."]/", FRIENDLYURL_SEPARATOR, str_replace($chars_Accent, $chars_no_Accent, $string));
        $string_friendly_url = string_strtolower(preg_replace("/[\\".FRIENDLYURL_SEPARATOR."]{2,}/", FRIENDLYURL_SEPARATOR, $string_friendly_url));

        return $string_friendly_url;

    }

	function system_generatePassword($numeric = false) {
        if ($numeric) {
            $string = "1234567890";
            $len = 5;
        } else {
            $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $len = 8;
        }
		srand((double)microtime()*1000000);
		for ($i=0; $i < $len; $i++) {
			$num   = rand() % string_strlen($string);
			$tmp   = string_substr($string, $num, 1);
			$pass .= $tmp;
		}
		return $pass;
	}

	function system_generateFileName() {
		$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		srand((double)microtime()*1000000);
		for ($i=0; $i < 20; $i++) {
			$num = rand() % string_strlen($string);
			$tmp = string_substr($string, $num, 1);
			$name .= $tmp;
		}
		return $name;
	}

    /**
     * Used in Site Manager Account Management page when the site manager changes an account email
     * Used in Sponsors and Front profile edition page when the user updates his own account email
     *
     * Sends a message to the user's updated email with information about his recent account updates
     *
     * @param int $id
     * @param string $emailTO
     * @param string $username
     * @param string $password
     * @param string $name
     */
   function system_sendPassword( $id, $emailTO, $username, $password, $name, $linkActivation )
    {
        if ( $emailNotificationObj = system_checkEmail( $id ) )
        {
            if ( !$password )
            {
                $password = system_showText( LANG_PASSWORD_NOT_CHANGED );
            }

            $sitemgr_email  = null;
            setting_get( "sitemgr_email", $sitemgr_email );
            $sitemgr_email = preg_replace("/,(.*)/", "", $sitemgr_email);

            $subject = $emailNotificationObj->getString( "subject" );
            $body    = $emailNotificationObj->getString( "body" );

            $subject = str_replace( "ACCOUNT_NAME", $name, $subject );
            $subject = str_replace( "ACCOUNT_USERNAME", $username, $subject );
            $subject = str_replace( "ACCOUNT_PASSWORD", $password, $subject );
            $subject = str_replace( "DEFAULT_URL", DEFAULT_URL, $subject );
            $subject = str_replace( "SITEMGR_EMAIL", $sitemgr_email, $subject );
            $subject = str_replace( "EDIRECTORY_TITLE", EDIRECTORY_TITLE, $subject );

            $body = str_replace( "ACCOUNT_NAME", $name, $body );
            $body = str_replace( "ACCOUNT_USERNAME", $username, $body );
            $body = str_replace( "ACCOUNT_PASSWORD", $password, $body );
            $body = str_replace( "DEFAULT_URL", DEFAULT_URL, $body );
            $body = str_replace( "MEMBERS_URL", MEMBERS_ALIAS, $body );
            $body = str_replace( "SITEMGR_EMAIL", $sitemgr_email, $body );
            $body = str_replace( "EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body );
			$body = str_replace( "LOGO", system_getHeaderLogo(false),$body);
            $body = str_replace( "LINK_ACTIVATE_ACCOUNT", $linkActivation, $body);

            $body    = html_entity_decode( $body );
            $subject = html_entity_decode( $subject );

            Mailer::mail( $emailTO, $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
        }
    }

    /**
	* Verify if email is Enabled or Disabled
	********************************************************************/
	function system_checkEmail($id) {
		$email = new EmailNotification($id);
		if ($email->getString("deactivate")) {
			return false;
		} else {
			return $email;
		}
	}

	/**
	* Replace the variables in the email body
	********************************************************************/
	function system_replaceEmailVariables($body, $id, $item="listing", $redeem_code = "", $userName = "") {

		switch ($item) {
			case 'banner': $obj = new Banner($id); break;
			case 'classified': $obj = new Classified($id); break;
			case 'article': $obj = new Article($id); break;
			case 'event': $obj = new Event($id); break;
			case 'listing': $obj = new Listing($id); break;
			case 'promotion': $obj = new Promotion($id); break;
			case 'account': $acc = new Account($id);
            case 'post': $obj = new Post($id);
		}

    if (!isset($acc)) {
        $acc = new Account($obj->getNumber('account_id'));
    }
		$acc_cont = new Contact($acc->getNumber('id'));

		setting_get("sitemgr_email", $sitemgr_email);
		$sitemgr_emails = explode(",", $sitemgr_email);

    if ($sitemgr_emails[0]) {
        $sitemgr_email = $sitemgr_emails[0];
    }

		$body = str_replace("ACCOUNT_NAME", ($userName ? $userName : $acc_cont->getString('first_name').' '.$acc_cont->getString('last_name')),$body);
		$body = str_replace("ACCOUNT_USERNAME",$acc->getString('username'),$body);
		$body = str_replace("ACCOUNT_PASSWORD",$acc->getString('username'),$body);

		$itemLink = "";

		switch ($item) {
			case 'banner':
            $body = str_replace(["ITEM_TITLE", "BANNER_TITLE"], $obj->getString('caption'), $body);
				$itemLink = DEFAULT_URL."/".MEMBERS_ALIAS."/banner/banner.php?id=".$obj->getNumber("id");
			break;
			case 'classified':
                $levelObj = new ClassifiedLevel();
                $detailLink = "".CLASSIFIED_DEFAULT_URL."/".$obj->getString("friendly_url").".html";
            $body = str_replace(["ITEM_TITLE", "CLASSIFIED_TITLE"], $obj->getString('title'), $body);
				$itemLink = DEFAULT_URL."/".MEMBERS_ALIAS."/classified/classified.php?id=".$obj->getNumber("id");
			break;
			case 'article':
				$detailLink = "".ARTICLE_DEFAULT_URL."/".$obj->getString("friendly_url").".html";
            $body = str_replace(["ITEM_TITLE", "ARTICLE_TITLE"], $obj->getString('title'), $body);
				$itemLink = DEFAULT_URL."/".MEMBERS_ALIAS."/article/article.php?id=".$obj->getNumber("id");
			break;
			case 'event':
                $levelObj = new EventLevel();
                $detailLink = "".EVENT_DEFAULT_URL."/".$obj->getString("friendly_url").".html";
            $body = str_replace(["ITEM_TITLE", "EVENT_TITLE"], $obj->getString('title'), $body);
				$itemLink = DEFAULT_URL."/".MEMBERS_ALIAS."/event/event.php?id=".$obj->getNumber("id");
			break;
			case 'listing':
                $levelObj = new ListingLevel();
                $detailLink = "".LISTING_DEFAULT_URL."/".$obj->getString("friendly_url").".html";
            $body = str_replace(["ITEM_TITLE", "LISTING_TITLE"], $obj->getString('title'), $body);
				$itemLink = DEFAULT_URL."/".MEMBERS_ALIAS."/listing/listing.php?id=".$obj->getNumber("id");
			break;
			case 'promotion':
				$detailLink = "".PROMOTION_DEFAULT_URL."/".$obj->getString("friendly_url").".html";
            $body = str_replace(["ITEM_TITLE"], $obj->getString('name'), $body);
				$itemLink = DEFAULT_URL."/".MEMBERS_ALIAS."/deal/deal.php?id=".$obj->getNumber("id");
			break;
            case 'post':
				$detailLink = "".BLOG_DEFAULT_URL."/".$obj->getString("friendly_url").".html";
            $body = str_replace(["ITEM_TITLE", "BLOG_TITLE"], $obj->getString('title'), $body);
            break;
		}

    if (isset($detailLink)) {
        $body = str_replace("ITEM_URL", $detailLink, $body);
    }
    if (isset($itemLink)) {
        $body = str_replace("ITEM_LINK", $itemLink, $body);
    }

		$body = str_replace("ITEM_TYPE", $item, $body);

		$body = str_replace("REDEEM_CODE", $redeem_code, $body);

		$body = str_replace("ARTICLE_DEFAULT_URL",ARTICLE_DEFAULT_URL,$body);
		$body = str_replace("CLASSIFIED_DEFAULT_URL",CLASSIFIED_DEFAULT_URL,$body);
		$body = str_replace("EVENT_DEFAULT_URL",EVENT_DEFAULT_URL,$body);
		$body = str_replace("LISTING_DEFAULT_URL",LISTING_DEFAULT_URL,$body);

		$body = str_replace("EDIRECTORY_TITLE",EDIRECTORY_TITLE,$body);
		$body = str_replace("SITEMGR_EMAIL",$sitemgr_email,$body);
		$body = str_replace("DEFAULT_URL",DEFAULT_URL,$body);
		$body = str_replace("MEMBERS_URL",MEMBERS_ALIAS,$body);
		$body = str_replace("LOGO", system_getHeaderLogo(false),$body);

		return $body;

	}

    /**
     * <Lucas Trentim (2015)>
     * @todo : This function could use a little extinction...
     */
    function system_notifySitemgr( $sitemgr_notif_emails, $emailSubject, $emailContent, $addHTML = true, $attachPath = "", $attachName = "", $sendAll = true, $sitemgr_extra_notif_emails = "", $from = "", $reply = "" )
    {
        if ( $addHTML )
        {
            $emailContent = "
                    <html>
                        <head>
                            <style>
                                .email_style_settings{
                                    font-size:12px;
                                    font-family:Verdana, Arial, Sans-Serif;
                                    color:#000;
                                }
                            </style>
                        </head>
                        <body>
                            <div class=\"email_style_settings\">
                            $emailContent
                            </div>
                        </body>
                    </html>";
        }

        $sitemgr_send_email = null;
        setting_get( "sitemgr_send_email", $sitemgr_send_email );

        if ( $sitemgr_send_email == "on" && $sendAll )
        {
            Mailer::mailSiteManager( $emailSubject, $emailContent, true, $reply, null, $attachPath, $attachName );
        }

        empty( $sitemgr_notif_emails ) or Mailer::mail( $sitemgr_notif_emails, $emailSubject, $emailContent, true, null, null, $reply, null, $attachPath, $attachName );
        empty( $sitemgr_extra_notif_emails ) or Mailer::mail( $sitemgr_extra_notif_emails, $emailSubject, $emailContent, true, null, null, $reply, null, $attachPath, $attachName );
    }

    function endKey($array){
		end($array);
		return key($array);
	}

    function system_generateAccountDropdown(&$auxSelectize = "") {

        $dbObj = db_getDBObject(DEFAULT_DB, true);

        $sql = "SELECT
						Account.`id`,
                        Contact.`first_name`,
                        Contact.`last_name`,
                        Contact.`email`
					FROM `Account` AS Account
                        LEFT OUTER JOIN `Contact` AS Contact ON (Account.`id` = Contact.`account_id`)
					WHERE Account.`is_sponsor` = 'y'
					ORDER BY
						Contact.`first_name`";
         $result = $dbObj->query($sql);

        $arrayNameAcc[] = system_showText(LANG_SITEMGR_NOOWNER);
        $arrayValueAcc[] = "no_owner";
        $auxSelectize[0]["id"] = 0;
        $auxSelectize[0]["name"] = system_showText(LANG_SITEMGR_NOOWNER);
        $auxSelectize[0]["email"] = "";
        $countAcc = 1;

        while ($row = mysql_fetch_assoc($result)) {
            $arrayNameAcc[] = $row["first_name"]." ".$row["last_name"]." (".$row["email"].")";
            $arrayValueAcc[] = $row["id"];
            $auxSelectize[$countAcc]["id"] = $row["id"];
            $auxSelectize[$countAcc]["name"] = $row["first_name"]." ".$row["last_name"];
            $auxSelectize[$countAcc]["email"] = $row["email"];
            $countAcc++;
        }
    }

	function getTreePath($catID, $section) {
		$strRet = "";
		$dbObj = db_getDBObject();
    if ($section == "listing") {
        $sql = "SELECT category_id FROM ListingCategory WHERE id = ".$catID."";
    } else {
        $sql = "SELECT category_id FROM ".string_ucwords($section)."Category WHERE id = ".$catID."";
    }
		$result = $dbObj->query($sql);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$strRet .= getTreePath($row["category_id"], $section);
			}
		}
    if ($catID) {
        $strRet .= ",".$catID;
    }

		return $strRet;
	}

    function system_retrieveAllCategoriesXML($table = "ListingCategory", $featured = "", $category_id = null, $fields = false, $page = false, $limit = MAX_SHOW_ALL_CATEGORIES) {

        $sql_category_id = "category_id = ".db_formatNUmber($category_id);
        if (is_null($category_id) || $category_id <= 0) {
            $sql_category_id = "category_id IS NULL";
        }
        $sql = "SELECT ".($fields ? implode(",", $fields) : "*")." FROM $table WHERE ".$sql_category_id;

        if ($featured == "on"){
            $sql .= " AND featured = 'y'";
        }

        $sql .= " AND enabled = 'y' ORDER BY title ";

        if ($page) {
            $sql .= "LIMIT ".(($page - 1) * MAX_CATEGORY_PER_PAGE).",".MAX_CATEGORY_PER_PAGE;
        } else {
            $sql .= "LIMIT ".$limit;
        }

        return system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
    }

	function system_getHeaderLogo($inline = true) {
		$headerlogo = "";

		if (file_exists(EDIRECTORY_ROOT.IMAGE_HEADER_PATH)) {
            if ($inline) {
                $headerlogo = "style=\"background-image: url('".DEFAULT_URL.IMAGE_HEADER_PATH."')\"";
            } else {
                $headerlogo = DEFAULT_URL.IMAGE_HEADER_PATH;
            }
		} elseif (!$inline) {
            $headerlogo = DEFAULT_URL."/assets/images/img_logo.png";
        }
		return $headerlogo;
	}

	function system_getHeaderLogoSitemgr() {
		$headerlogo = "";

		if (file_exists(EDIRECTORY_ROOT.IMAGE_HEADER_PATH)) {
			$headerlogo = DEFAULT_URL.IMAGE_HEADER_PATH;
		} else {
            $headerlogo = DEFAULT_URL."/assets/images/img_logo.png";
        }
		return $headerlogo;
	}

	function system_getNoImageStyle($cssfile = false, $getFile = false) {
		$noimagestyle = "";

        if ($getFile) {
            if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT)) {
                return DEFAULT_URL.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT;
            } else {
                return DEFAULT_URL."/assets/images/img_logo.png";
            }
        } else {
            if ($cssfile) {
                if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT)) {
                    $noimagestyle = "<link href=\"".DEFAULT_URL.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT."\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />";
                }
            } else {
                if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT)) {
                    $noimagestyle = "background-image: url('".DEFAULT_URL.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT."')";
                } else {
                    $noimagestyle = "background: #FFF url('".DEFAULT_URL."/assets/images/img_logo.png') 45% 50% no-repeat;";
                }
            }
            return $noimagestyle;
        }
	}

    function system_getFavicon(){
        $favicon = "";

    /*setting_get("last_favicon_id", $last_favicon_id);

        if (!$last_favicon_id){
            setting_new("last_favicon_id", "1");
            $last_favicon_id = "1";
        }*/
    $favIconFile = glob(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_*");

    if (file_exists($favIconFile[0])) {
        $favicon = "<link rel=\"Shortcut icon\" href=\"".(str_replace(EDIRECTORY_ROOT, DEFAULT_URL,
                $favIconFile[0]))."\" type=\"image/x-icon\"/>";
        }

        return $favicon;
    }

	// ARRAY TO NAME-VALUE PAIRS
	function system_array2nvp($array, $separator = "&") {
		foreach ($array as $name=>$value) {
			$arrayNVP[] = $name."=".$value;
		}
		$nvpString = implode($separator, $arrayNVP);
		return $nvpString;
	}

	function system_getVideoSnippetCode($video_snippet, $video_snippet_width, $video_snippet_height, $forceResize = true) {

		$video_resize = false;

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		while (($pos = string_strpos($suffix_video_snippet, "width")) !== false) {

			$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
			$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			if (($pos = string_strpos($suffix_video_snippet, ">")) !== false) {

				$lookingfornumber = $suffix_video_snippet;
				while (!is_numeric($lookingfornumber[0])) {
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				$widthnumber = "";
				while (is_numeric($lookingfornumber[0])) {
					$widthnumber .= $lookingfornumber[0];
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				if ($widthnumber > $video_snippet_width || $forceResize) {
					$video_resize = true;
				}

				$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
				$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			}

		}

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		while (($pos = string_strpos($suffix_video_snippet, "height")) !== false) {

			$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
			$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			if (($pos = string_strpos($suffix_video_snippet, ">")) !== false) {

				$lookingfornumber = $suffix_video_snippet;
				while (!is_numeric($lookingfornumber[0])) {
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				$heightnumber = "";
				while (is_numeric($lookingfornumber[0])) {
					$heightnumber .= $lookingfornumber[0];
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				if ($heightnumber > $video_snippet_height || $forceResize) {
					$video_resize = true;
				}

				$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
				$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			}

		}

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		if ($video_resize) {
			while ((($pos = string_strpos($suffix_video_snippet, "width")) !== false) || (($pos = string_strpos($suffix_video_snippet, "height")) !== false)) {
				$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
				$prefix_video_snippet .= " style=\"width: ".$video_snippet_width."px; height: ".$video_snippet_height."px;\" ";
				$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);
				if (($pos = string_strpos($suffix_video_snippet, ">")) !== false) {
					$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
					$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);
				}
			}
		}

		$video_snippet_code = $prefix_video_snippet.$suffix_video_snippet;

        if (string_strpos($video_snippet_code, "<iframe") !== false && string_strpos($video_snippet_code, "wmode") === false){ //new Youtube code (iframe) - need to insert "wmode" parameter, otherwise all popups will shown under the video

            $prefix_video_snippet = "";
            $suffix_video_snippet = $video_snippet_code;
            $video_url = "";

            // The Regular Expression filter to find the video URL
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

            // The Text you want to filter for urls
            $text = $suffix_video_snippet;

            // Check if there is a url in the text
            if(preg_match($reg_exUrl, $text, $url)) {
                $video_url = str_replace("'", "", $url[0]);
                $video_url = str_replace("\"", "", $video_url);
                $pos = string_strpos($suffix_video_snippet, $video_url);
                $prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
                $suffix_video_snippet = string_substr($suffix_video_snippet, $pos+string_strlen($video_url));

                if (string_strpos($video_url, "?") !== false){
                    $video_snippet_code = $prefix_video_snippet.$video_url."&wmode=transparent".$suffix_video_snippet;
                } else {
                    $video_snippet_code = $prefix_video_snippet.$video_url."?wmode=transparent".$suffix_video_snippet;
                }
            }

        } elseif (string_strpos($video_snippet_code, "<object") !== false && string_strpos($video_snippet_code, "wmode=") === false){ //old Youtube code (object) - need to insert "wmode" parameter, otherwise all popups will shown under the video
            $video_snippet_code = str_replace("<embed ", "<embed wmode='transparent' ", $video_snippet_code);
        }

		return $video_snippet_code;

	}

	function system_getURLSearchParams($array, $includeOrderBy = true) {
		$url_search_params = "";
    $array_search_params = [];
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "search_");

					if ((($pos !== false) && ($pos == 0)) || ($name == "order_by" && $includeOrderBy)) {
                                            if ($value) {
                                                    $array_search_params[] = $name."=".urlencode($value);
                                            }
					}
				}
			}
		}
		if ($array_search_params) {
			if (count($array_search_params) > 0) {
				$url_search_params = implode("&", $array_search_params);
			}
		}
		return $url_search_params;
	}

    function system_getManageOrderBy($order, $table, $item_scalability, &$orderFields, $search = false){

        $orderBy = "";

        //Select fields
        if (!$orderFields) {
            $orderFields = "*";
        }

        //Ordination options
        $auxOrder = explode("_", $order);
        $order = $auxOrder[0]; //order option
        $option = $auxOrder[1]; //asc or desc

        $titleField = "";
        $levelField = "";

        //Modules exceptions
        if ($table == "Banner") {
            $titleField = "caption";
            $levelField = "level";
            if ($order == "level") { //Subquery to ready banner type as it's displayName instead of it's number
                $orderFields .= ", (SELECT displayName FROM BannerLevel WHERE BannerLevel.value = Banner.type) AS level";
            }
        } elseif ($table == "Promotion") {
            $titleField = "name";
            $levelField = ""; //Promotion doesn't have level
        }  elseif ($table == "Blog") {
            $titleField = "title";
            $levelField = ""; //Blog doesn't have level
        } else {
            $titleField = "title";
            $levelField = "level";
        }

        //Order by
        if ($order) {
            if ($order == $titleField) { //order by title
                $orderBy = $titleField.($option == "asc" || $option == "desc" ? " ".$option : "");

            } elseif ($order == $levelField) { //order by level

                if ($table != "Banner") { //level numbers are inverted (level 10, Diamond, is higher than level 30, Gold) for all modules but Banners, so we need to invert the order so the ordination make sense
                    if ($option == "asc") {
                        $option = "desc";
                    } elseif ($option == "desc") {
                        $option = "asc";
                    }
                }

                $orderBy = $levelField.($option == "asc" || $option == "desc" ? " ".$option : "");

            } elseif ($order == "account" && $table != "Blog") { //order by account
                $orderBy = "account_name".($option == "asc" || $option == "desc" ? " ".$option : "");

                //Subquery to get the username according to the account_id. Order by account_id wouldn't make sense.
                $orderFields .= ", IF (account_id > 0 , (SELECT username FROM AccountProfileContact WHERE AccountProfileContact.account_id = $table.account_id), '') AS account_name";

            } elseif ($order == "status" && $table != "Promotion") { //order by status
                $orderBy = "status".($option == "asc" || $option == "desc" ? " ".$option : "");

            } elseif ($order == "renewal" && $table != "Promotion" && $table != "Blog") { //order by renewal date
                $orderBy = "renewal_date".($option == "asc" || $option == "desc" ? " ".$option : "");

            } elseif ($order == "impressions" && $table == "Banner") { //order by banner impressions
                $orderBy = "impressions".($option == "asc" || $option == "desc" ? " ".$option : "");

            } elseif ($order == "startdate"  && $table == "Event") { //order by event start date
                $orderBy = "start_date".($option == "asc" || $option == "desc" ? " ".$option : "");
            }
        }

        //default ordination concatenated after order selected
        if ($search || string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS."/") !== false) {
            //Modules search and Members Area
        $extraOrder = [];
            $extraOrderStr = "";

            if ($table != "Promotion" && $table != "Blog" && $order != $levelField) {
                $extraOrder[] = ($table == "Banner" ? "type" : "level DESC");
            }

            if ($order != $titleField) {
                $extraOrder[] = $titleField;
            }

            if ($table != "Promotion" && $table != "Blog" && $order != "renewal") {
                $extraOrder[] = "renewal_date";
            }

            if ($extraOrder[0]) {
                $extraOrderStr = implode(", ", $extraOrder);
                $orderBy .= ($orderBy ? ", " : "").$extraOrderStr;
            }

        } elseif ($item_scalability != "on") {
            //Modules index - Sitemgr area
            $orderBy .= ($orderBy ? ", " : "");
            $orderBy .= "updated DESC".($order != $titleField ? ", $titleField" : "");
        }

        return $orderBy;

    }

	function system_getFormInputSearchParams($array) {
		$url_search_params = "";
    $array_search_params = [];
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "search_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							$array_search_params[] = "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" />";
						}
					}
				}
			}
		}
		if ($array_search_params) {
			if (count($array_search_params) > 0) {
				$url_search_params = implode("\n", $array_search_params);
			}
		}
		return $url_search_params;
	}

	function system_getFormInputHiddenParams($array, $except = "") {
		$exceptArray = explode(",", $except);
		$url_hidden_params = "";
    $array_hidden_params = [];
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					if ($value && (!in_array($name, $exceptArray))) {
						$array_hidden_params[] = "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" />";
					}

				}
			}
		}
		if ($array_hidden_params) {
			if (count($array_hidden_params) > 0) {
				$url_hidden_params = implode("\n", $array_hidden_params);
			}
		}
		return $url_hidden_params;
	}

	function system_denyInjections($var, $text = false) {

		$var = strip_tags($var);
		$var_aux = urlencode($var);
        if ($text) {
            $var = htmlspecialchars_decode($var);
            $var = nl2br($var);
		} elseif ((string_strpos($var_aux, "%0") !== false) || (string_strpos($var_aux, "%1") !== false)){
            $var = "";
		}

		return $var;
	}

	function system_highlightFirstWord($word, $amount=1) {
		if ($amount <= 1) {
			if (($pos = string_strpos($word, " ")) !== false) {
				return "<span>".string_substr($word, 0, $pos)."</span>".string_substr($word, $pos);
			} else {
				return $word;
			}
		} else {
			$words = explode(" ", $word);
			if (count($words) >= 2) {
				if ($amount <= count($words)) {
					$words[$amount-1] = $words[$amount-1]."</span>";
				} else {
					$words[count($words)-1] = $words[count($words)-1]."</span>";
				}
				return "<span>".implode(" ", $words);
			} else {
				return $word;
			}
		}
	}

	function system_highlightLastWord($word, $amount=1) {
		if ($amount <= 1) {
			if (($pos = string_strrpos($word, " ")) !== false) {
				return string_substr($word, 0, $pos+1)."<span>".string_substr($word, $pos+1)."</span>";
			} else {
				return $word;
			}
		} else {
			$words = explode(" ", $word);
			if (count($words) >= 2) {
				if ($amount <= count($words)) {
					$words[count($words)-$amount] = "<span>".$words[count($words)-$amount];
				} else {
					$words[0] = "<span>".$words[0];
				}
				return implode(" ", $words)."</span>";
			} else {
				return $word;
			}
		}
	}

	function system_highlightWords($word) {
		return "<span>".$word."</span>";
	}

	function system_showText($text) {
		return $text;
	}

	function system_showDate($format_str, $time=false) {
    if (!string_strlen(trim($format_str))) {
        return false;
    }
    if (!$time) {
        $time = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'));
    }
    $allow_datechars = [
        'd',
        'D',
        'j',
        'l',
        'N',
        'S',
        'w',
        'z',
        'W',
        'F',
        'm',
        'M',
        'n',
        't',
        'L',
        'o',
        'Y',
        'y',
        'a',
        'A',
        'B',
        'g',
        'G',
        'h',
        'H',
        'i',
        's',
        'u',
        'e',
        'I',
        'O',
        'P',
        'T',
        'Z',
        'c',
        'r',
        'U',
        '\\',
    ];
		$month_names = explode(",", LANG_DATE_MONTHS);
		$weekday_names = explode(",", LANG_DATE_WEEKDAYS);
		$aux_format_str = $format_str;
		$buffer = "";
		for ($i=0; $i<string_strlen($aux_format_str); $i++) {
			if (in_array($aux_format_str[$i], $allow_datechars)) {
				//d -> Day of the month, 2 digits with leading zeros.
				if ($aux_format_str[$i] == "d") { $buffer .= date("d", $time); }
				//D -> A textual representation of a day, three letters.
				if ($aux_format_str[$i] == "D") { $buffer .= string_substr($weekday_names[date("j", $time)-1], 0, 3); }
				//j -> Day of the month without leading zeros.
				if ($aux_format_str[$i] == "j") { $buffer .= date("j", $time); }
				//l -> A full textual representation of the day of the week.
				if ($aux_format_str[$i] == "l") { $buffer .= $weekday_names[date("j", $time)-1]; }
				//N -> ISO-8601 numeric representation of the day of the week.
				if ($aux_format_str[$i] == "N") { $buffer .= date("N", $time); }
				//S -> English ordinal suffix for the day of the month, 2 characters.
				if ($aux_format_str[$i] == "S") { $buffer .= date("S", $time); }
				//w -> Numeric representation of the day of the week.
				if ($aux_format_str[$i] == "w") { $buffer .= date("w", $time); }
				//z -> The day of the year (starting from 0).
				if ($aux_format_str[$i] == "z") { $buffer .= date("z", $time); }
				//W -> ISO-8601 week number of year, weeks starting on Monday.
				if ($aux_format_str[$i] == "W") { $buffer .= date("W", $time); }
				//F -> A full textual representation of a month, such as January or March.
				if ($aux_format_str[$i] == "F") { $buffer .= string_ucwords($month_names[date("n", $time)-1]); }
				//m -> Numeric representation of a month, with leading zeros.
				if ($aux_format_str[$i] == "m") { $buffer .= date("m", $time); }
				//M -> A short textual representation of a month, three letters.
				if ($aux_format_str[$i] == "M") { $buffer .= date("M", $time); }
				//n -> Numeric representation of a month, without leading zeros.
				if ($aux_format_str[$i] == "n") { $buffer .= date("n", $time); }
				//t -> Number of days in the given month.
				if ($aux_format_str[$i] == "t") { $buffer .= date("t", $time); }
				//L -> Whether it's a leap year.
				if ($aux_format_str[$i] == "L") { $buffer .= date("L", $time); }
				//o -> ISO-8601 year number. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead.
				if ($aux_format_str[$i] == "o") { $buffer .= date("o", $time); }
				//Y -> A full numeric representation of a year, 4 digits.
				if ($aux_format_str[$i] == "Y") { $buffer .= date("Y", $time); }
				//y -> A two digit representation of a year.
				if ($aux_format_str[$i] == "y") { $buffer .= date("y", $time); }
				//a -> Lowercase Ante meridiem and Post meridiem.
				if ($aux_format_str[$i] == "a") { $buffer .= date("a", $time); }
				//A -> Uppercase Ante meridiem and Post meridiem.
				if ($aux_format_str[$i] == "A") { $buffer .= date("A", $time); }
				//B -> Swatch Internet time.
				if ($aux_format_str[$i] == "B") { $buffer .= date("B", $time); }
				//g -> 12-hour format of an hour without leading zeros.
				if ($aux_format_str[$i] == "g") { $buffer .= date("g", $time); }
				//G -> 24-hour format of an hour without leading zeros.
				if ($aux_format_str[$i] == "G") { $buffer .= date("G", $time); }
				//h -> 12-hour format of an hour with leading zeros.
				if ($aux_format_str[$i] == "h") { $buffer .= date("h", $time); }
				//H -> 24-hour format of an hour with leading zeros.
				if ($aux_format_str[$i] == "H") { $buffer .= date("H", $time); }
				//i -> Minutes with leading zeros.
				if ($aux_format_str[$i] == "i") { $buffer .= date("i", $time); }
				//s -> Seconds, with leading zeros.
				if ($aux_format_str[$i] == "s") { $buffer .= date("s", $time); }
				//u -> Microseconds.
				if ($aux_format_str[$i] == "u") { $buffer .= date("u", $time); }
				//e -> Timezone identifier.
				if ($aux_format_str[$i] == "e") { $buffer .= date("e", $time); }
				//I -> Whether or not the date is in daylight saving time.
				if ($aux_format_str[$i] == "I") { $buffer .= date("I", $time); }
				//O -> Difference to Greenwich time (GMT) in hours.
				if ($aux_format_str[$i] == "O") { $buffer .= date("O", $time); }
				//P -> Difference to Greenwich time (GMT) with colon between hours and minutes.
				if ($aux_format_str[$i] == "P") { $buffer .= date("P", $time); }
				//T -> Timezone abbreviation.
				if ($aux_format_str[$i] == "T") { $buffer .= date("T", $time); }
				//Z -> Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive.
				if ($aux_format_str[$i] == "Z") { $buffer .= date("Z", $time); }
				//c -> ISO 8601 date.
				if ($aux_format_str[$i] == "c") { $buffer .= date("c", $time); }
				//r -> RFC 2822 formatted date.
				if ($aux_format_str[$i] == "r") { $buffer .= date("r", $time); }
				//U -> Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT).
				if ($aux_format_str[$i] == "U") { $buffer .= date("U", $time); }
				//\ -> escape.
				if ($aux_format_str[$i] == "\\") {
					$i++;
					$buffer .= $aux_format_str[$i];
				}
			} else {
				$buffer .= $aux_format_str[$i];
			}
		}
		return $buffer;
	}

    function system_accentOff($str) {

    $accents = [
                        "A" => "/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/",
                        "a" => "/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/",
                        "C" => "/&Ccedil;/",
                        "c" => "/&ccedil;/",
                        "E" => "/&Egrave;|&Eacute;|&Ecirc;|&Euml;/",
                        "e" => "/&egrave;|&eacute;|&ecirc;|&euml;/",
                        "I" => "/&Igrave;|&Iacute;|&Icirc;|&Iuml;/",
                        "i" => "/&igrave;|&iacute;|&icirc;|&iuml;/",
                        "N" => "/&Ntilde;/",
                        "n" => "/&ntilde;/",
                        "O" => "/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/",
                        "o" => "/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/",
                        "U" => "/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/",
                        "u" => "/&ugrave;|&uacute;|&ucirc;|&uuml;/",
                        "Y" => "/&Yacute;/",
                        "y" => "/&yacute;|&yuml;/",
                        "a." => "/&ordf;/",
        "o." => "/&ordm;/",
    ];

        return preg_replace(array_values($accents), array_keys($accents), string_htmlentities($str));
    }

	function system_showAccountUserName($username, $listAccount = false, $email = "") {
		if (($pos = string_strpos($username, "::")) !== false) {
			if ($listAccount && $email) {
				return $email;
			} else {
				$username = string_substr($username, $pos + 2);
			}
		}
		return $username;
	}

    function system_showAccountMessage($username) {
		if (($pos = string_strpos($username, "::")) !== false) {
			$auxUsername = explode("::", $username);
            $message = system_showText(LANG_SITEMGR_FOREIGN_ACC1)." ".ucfirst($auxUsername[0]).". ".system_showText(LANG_SITEMGR_FOREIGN_ACC2);
            return $message;
		} else {
            return false;
        }
	}

	function system_registerForeignAccount($authArray, $accountType, $attach_account = false, $email_notification = SYSTEM_NEW_PROFILE) {

		unset($foreignAccount);

    if (!$authArray) {
        return false;
    }
    if (!is_array($authArray)) {
        return false;
    }
    if (!$accountType) {
        return false;
    }

		unset($auth);

		if ($accountType == "facebook") {
			$thisusername = $authArray["first_name"].$authArray["last_name"];
			$thisusername = preg_replace('/[^0-9a-zA-Z]/i', '', $thisusername);
			$thisusername = string_strtolower($thisusername);
			$foreignAccount["facebook_username"] = $accountType."::".$thisusername."_".$authArray["uid"];

			if (!$attach_account){
				$foreignAccount["username"] = $accountType."::".$thisusername."_".$authArray["uid"];
				$foreignAccount["first_name"] = $authArray["first_name"];
				$foreignAccount["last_name"] = $authArray["last_name"];
			} else{
				/*
				 * Get account_id to update
				 */
				unset($accountObj);
				$accountObj = new Account($authArray["account_id"]);
				$foreignAccount["username"] = $accountObj->getNumber("username");

				/*
				 * Prepare $foreignAccount with edirectory information
				 */
				foreach ($accountObj as $key => $value) {
					$foreignAccount[$key] = $value;
				}

				unset($contactObj);
				$foreignAccount["facebook_username"] = $accountType."::".$thisusername."_".$authArray["uid"];

				$facebookUID = $authArray["uid"];

				$contactObj = new Contact($accountObj->getNumber("id"));
				foreach ($contactObj as $key => $value) {
					$foreignAccount[$key] = $value;
				}

				/*
				 * Check if needs do update on eDirectory account
				 */
				if($authArray["facebook_action"] == "facebook_import"){
					$foreignAccount["first_name"] = $authArray["first_name"];
					$foreignAccount["last_name"] = $authArray["last_name"];
				}

				$auxFirstName = $authArray["first_name"];
				$auxLastName = $authArray["last_name"];
			}

			foreach($authArray as $key=>$value) {
				$auth[] = $key."=".$value;
			}
		} elseif ($accountType == "google") {
			$foreignAccount["username"] = $accountType."::".$authArray["email"];
			$foreignAccount["first_name"] = $authArray["first_name"];
			$foreignAccount["last_name"] = $authArray["last_name"];
			foreach($authArray as $key=>$value) {
				$auth[] = $key."=".$value;
			}
		}

		$foreignAccount["foreignaccount"] = "y";

		if ($accountType == "facebook"){
			$sql = "SELECT account_id FROM Profile WHERE facebook_uid = ".$authArray["uid"];

			$db = db_getDBObject(DEFAULT_DB, true);
			$result = $db->query($sql);

			if (mysql_num_rows($result)>0){
				$account = db_getFromDB("account", "facebook_username", db_formatString($foreignAccount["username"]));
			} else {
				$account = db_getFromDB("account", "username", db_formatString($foreignAccount["username"]));
			}

		} else {
			$account = db_getFromDB("account", "username", db_formatString($foreignAccount["username"]));
		}

		if (!($account->getNumber("id"))) {

			$info = image_getImageSizeByURL($authArray["picture"]);

			image_getNewDimension(100, 100, $info[0], $info[1], $newWidth, $newHeight);

            $foreignAccount["active"] = "y";

			$account = new Account($foreignAccount);

			$account->save();

			$contact = new Contact($foreignAccount);
			$contact->setNumber("account_id", $account->getNumber("id"));
			if ($authArray["email"]) {
				$contact->setString("email", $authArray["email"]);
            }

			$contact->save();

			$profile = new Profile();

			####################################################################################################
			####################################################################################################
			####################################################################################################
			# E-mail notify
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = explode(",",$sitemgr_email);
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = explode(",",$sitemgr_account_email);
			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ( $emailNotificationObj   = system_checkEmail( $email_notification ) )
            {
                if ( $accountType == "facebook" )
                {
                    $login_info = string_ucwords( system_showText( LANG_LABEL_FACEBOOK_ACCT ) ).": ".$contact->getString( "email" );
            } else {
                if ($accountType == "google") {
                    $login_info = string_ucwords( system_showText( LANG_LABEL_GOOGLE_ACCT ) ).": ".$contact->getString( "email" );
                }
            }

                $subject = $emailNotificationObj->getString( "subject" );
                $subject = system_replaceEmailVariables( $subject, $account->getNumber( "id" ), 'account' );
                $subject = html_entity_decode( $subject );

                $body = $emailNotificationObj->getString( "body" );
                $body = str_replace( "ACCOUNT_LOGIN_INFORMATION", $login_info, $body );
                $body = str_replace( "LINK_ACTIVATE_ACCOUNT", "[".system_showText( LANG_LABEL_PROFILE_ACTIVATED )."]", $body );
                $body = system_replaceEmailVariables( $body, $account->getNumber( "id" ), 'account' );
                $body = html_entity_decode( $body );

                Mailer::mail( $contact->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
            }
            ////////////////////////////////////////////////////////////////////////////////////////////////////
			// site manager warning message /////////////////////////////////////
            $accountViewLink = $account->getString("is_sponsor") == "y" ? "sponsor/sponsor" : "visitor/visitor";
            $emailSubject = system_showText(LANG_NOTIFY_NEWACCOUNT);
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />".system_showText(LANG_NOTIFY_NEWACCOUNT_1)." ".EDIRECTORY_TITLE.".<br />".system_showText(LANG_NOTIFY_NEWACCOUNT_2)."<br /><br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_USERNAME).": </b>".system_showAccountUserName($account->getString("username"))."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_FIRST_NAME).": </b>".$contact->getString("first_name")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_LAST_NAME).": </b>".$contact->getString("last_name")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_COMPANY).": </b>".$contact->getString("company")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_ADDRESS).": </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_CITY).": </b>".$contact->getString("city")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_STATE).": </b>".$contact->getString("state")."<br />";
            $sitemgr_msg .= "<b>".string_ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_PHONE).": </b>".$contact->getString("phone")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_FAX).": </b>".$contact->getString("fax")."<br />";
            $sitemgr_msg .= "<b>".system_showText(LANG_LABEL_URL).": </b>".$contact->getString("url")."<br />";
            $sitemgr_msg .="<br /><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/$accountViewLink.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/account/$accountViewLink.php?id=".$account->getNumber("id")."</a><br /><br />";
            $sitemgr_msg .= EDIRECTORY_TITLE;

            system_notifySitemgr($sitemgr_account_emails, $emailSubject, $sitemgr_msg);
			////////////////////////////////////////////////////////////////////
			####################################################################################################
			####################################################################################################
			####################################################################################################

		} else {
			$contact = new Contact($account->getNumber("id"));
			$profile = new Profile($account->getNumber("id"));

			if ($profile->getNumber("account_id") && $attach_account) {
				$foreignAccount["id"] = $account->getNumber("id");
				$info = image_getImageSizeByURL($authArray["picture"]);
				image_getNewDimension(100, 100, $info[0], $info[1], $newWidth, $newHeight);
				$account = new Account($foreignAccount);
				$account->save();
				$contact = new Contact($foreignAccount);
				$contact->setNumber("account_id", $account->getNumber("id"));
				$contact->save();
			}
		}

		/*
		 * Update Account and Contact tables
		 */

		$profile->setNumber("account_id", $account->getNumber("id"));
		$profile->setString("facebook_uid", $authArray["uid"]);
		if (!$attach_account || ($attach_account && $authArray["facebook_action"] == "facebook_import")){
			$profile->setString("nickname", $authArray["nickname"] ? $authArray["nickname"] : $contact->getString("first_name")." ".$contact->getString("last_name"));
			$profile->setString("personal_message", $authArray["personal_message"]);
            $profile->setString("facebook_image", $authArray["picture"]);
			$profile->setString("location", $authArray["location"]);
		}
		$profile->Save();

		$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
		$accDomain->Save();
		$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profile);

		if ($account->getNumber("id")) {
			if ($account_type == "facebook"){
				sess_registerAccountInSession($account->getString("facebook_username"), true);
			} else {
				sess_registerAccountInSession($account->getString("username"));
			}
			return true;
		}

		return false;

	}

function system_addCKEditor($name, $content, $rows = 10, $cols = 80, $lang = 'en', $style = '', $load = true, $script = true, $fullPage = false)
{
    $htmlCode = '';

    if ($script) {
        $htmlCode .= "<script src=\"//cdn.ckeditor.com/4.6.0/standard-all/ckeditor.js\"></script>\n";
    }

    /* Adds Textarea */
    $htmlCode .= "<textarea id=\"$name\" name=\"$name\" rows=\"$rows\" cols=\"$cols\" style=\"$style\">$content</textarea>\n";

    $confFullPage = "";
    if ($fullPage) {
        $confFullPage = "fullPage: true,";
    }

    if ($load) {
        $scriptCode = <<<JS
        CKEDITOR.replace('$name', {
            $confFullPage
            language: '$lang',
            customConfig: '/assets/js/lib/ckeditor/base.config.js'
            });
JS;

        $htmlCode .= "<script type=\"text/javascript\">$scriptCode</script>\n";
    }

    echo $htmlCode;
	}

	function system_getLastWeek(){

		$week = date('W');
		$year = date('Y');

		$lastweek = $week-1;

		if ($lastweek==0){
			$week = 52;
			$year--;
		}

		$lastweek = sprintf("%02d", $lastweek);
		for ($i=1; $i <= 7; $i++){
			$arrdays[] = strtotime("$year". "W$lastweek"."$i");
		}
		return $arrdays;

	}

	function system_getRevenue($all = false) {
		//$one_year_ago = date("Y-m-d H:i:s", strtotime("-1 years"));
		$one_month_ago = date("Y-m-d H:i:s", strtotime("-1 months"));
		$one_week_ago = date("Y-m-d H:i:s", strtotime("-1 weeks"));

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbObj);

		/*
		 * Calculate last year revenue
		 */

//		$sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status in ('Completed', 'Approved', 'Aprovado', 'Accepted', 'Success', 'SIMPLEPAYSUCCESS', 'Y') AND transaction_datetime > '".$one_year_ago."'";
//		$result = $dbObjSecond->query($sql);
//		if (mysql_num_rows($result) > 0) {
//			$row = mysql_fetch_assoc($result);
//			$total_payment_year = $row['total'];
//		}
//		$sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R' AND payment_date > '".$one_year_ago."'";
//		$result = $dbObjSecond->query($sql);
//		if (mysql_num_rows($result) > 0) {
//			$row = mysql_fetch_assoc($result);
//			$total_invoice_year = $row['total'];
//		}
//		$total_year = $total_payment_year + $total_invoice_year;

		/*
		 * Calculate last month revenue
		 */

        if (!$all) {
        $sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status IN ('Completed', 'Approved', 'Aprovado', 'Accepted', 'Success', 'Available', 'Paid', 'Y') AND transaction_datetime > '".$one_month_ago."' AND hidden = 'n'";
            $result = $dbObjSecond->query($sql);
            if (mysql_num_rows($result) > 0) {
                $row = mysql_fetch_assoc($result);
                $total_payment_month = $row['total'];
            }
            $sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R' AND payment_date > '".$one_month_ago."'";
            $result = $dbObjSecond->query($sql);
            if (mysql_num_rows($result) > 0) {
                $row = mysql_fetch_assoc($result);
                $total_invoice_month = $row['total'];
            }
            $total_month = $total_payment_month + $total_invoice_month;

            /*
            * Calculate last week revenue
            */

        $sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status IN ('Completed', 'Approved', 'Aprovado', 'Accepted', 'Success', 'Available', 'Paid', 'Y') AND transaction_datetime > '".$one_week_ago."' AND hidden = 'n'";
            $result = $dbObjSecond->query($sql);
            if (mysql_num_rows($result) > 0) {
                $row = mysql_fetch_assoc($result);
                $total_payment_week = $row['total'];
            }
            $sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R' AND payment_date > '".$one_week_ago."'";
            $result = $dbObjSecond->query($sql);
            if (mysql_num_rows($result) > 0) {
                $row = mysql_fetch_assoc($result);
                $total_invoice_week = $row['total'];
            }
            $total_week = $total_payment_week + $total_invoice_week;
        }

        /*
		 * Calculate total revenue
		 */

    $sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status IN ('Completed', 'Approved', 'Aprovado', 'Accepted', 'Success', 'Available', 'Paid', 'Y') AND hidden = 'n'";
		$result = $dbObjSecond->query($sql);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$total_payment_all = $row['total'];
		}
		$sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R'";
		$result = $dbObjSecond->query($sql);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$total_invoice_all = $row['total'];
		}
		$total_all = $total_payment_all + $total_invoice_all;

		//$array_revenue["year"] = format_money($total_year);
		$array_revenue["month"] = format_money($total_month);
		$array_revenue["week"] = format_money($total_week);
		$array_revenue["total"] = format_money($total_all);

		return $array_revenue;
    }

	function system_changeFeaturedAtribute($table, $ids, $featured="y") {
		if (isset($table) && isset($ids)) {
			$sql = "UPDATE ".$table." SET featured = '".$featured."' WHERE id IN (".$ids.")";
			$dbMain = db_getDBObject(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbMain);
			$db->query($sql);
		}
	}

	function system_changeAtributeById($table, $atribute, $ids, $value = '', $domain_id = 1) {
		if (isset($table) && isset($ids) && isset($atribute)) {
			$sql = "UPDATE ".$table." SET ".$atribute." = '".$value."' WHERE id IN (".$ids.")";
			$dbMain = db_getDBObJect(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID($domain_id,$dbMain);
			$db->query($sql);
		}
	}

	function system_retrieveLocationRelationship ($_locations, $_location_level, &$_location_father_level, &$_location_child_level) {
		$location_key = array_search ($_location_level, $_locations);
		if ($location_key!==false) {
        if ($location_key == 0) {
            $_location_father_level = false;
        } else {
            $_location_father_level = $_locations[$location_key - 1];
        }
        if ($location_key == (count($_locations) - 1)) {
            $_location_child_level = false;
        } else {
            $_location_child_level = $_locations[$location_key + 1];
        }
		}
	}

	function system_buildLocationNodeParams($array, $limit_level=false, &$retrieveLastLocationName=false) {
		$_link_params = false;
		if ($array) {
			if (count($array) > 0) {
				ksort($array);
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "location_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
                        if (!$limit_level) {
								$_link_params .= $name."=".$value."&";
                        } else {
								$current_level = string_substr($name, -1);
								if ($current_level<$limit_level) {
									$_link_params .= $name."=".$value."&";
									if ($retrieveLastLocationName) {
										$_locations = explode(",", EDIR_LOCATIONS);
										system_retrieveLocationRelationship ($_locations, $current_level, $_location_father_level, $_location_child_level);
										//if ($_location_child_level==$limit_level) {
											$locationInfo = db_getFromDB('location'.$current_level, 'id', $value, 1, '', 'array');
											$retrieveLastLocationName = $locationInfo['name'];
										//}
									}
								}
							}
						}
					}
				}
				$_link_params = string_substr($_link_params, 0, -1);
			}
		}
		return $_link_params;
	}

	function system_buildLocationBreadCrumb($_locations, $array, $limit_level, $redirect = "index.php", $extraInfo=false) {
		// showing link to location root
		if ($limit_level != $_locations[0]) {
			?><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/configuration/geography/locations/location_<?=$_locations[0]?>/index.php"><?
		}
		echo system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS);
		if ($limit_level != $_locations[0]) {
			?></a> &raquo;<?
		}
		$_link_params = false;

		// filling the gaps of the url path ///////////////
		if ((is_array($array)) and (count($array) > 0)) {
			$aux_max_level = 1;
			foreach ($array as $name=>$value) {
				$pos = string_strpos($name, "location_");
				if ($pos !== false) {
					$current_level = string_substr($name, -1);
                if (($current_level > $aux_max_level) and (in_array($current_level, $_locations))) {
						$aux_max_level = $current_level;
				}
			}
        }

			if ($array["location_".$aux_max_level] > 0) {
				$aux_location_path = db_getFromDB("location".($aux_max_level), "id", $array["location_".$aux_max_level], 1, "", "array");

                if($aux_location_path){
                    foreach ($aux_location_path as $name=>$value) {
                        $pos = string_strpos($name, "location_");
                        if (($pos !== false) and ($value>0)) {
                        if (in_array(string_substr($name, -1), $_locations)) {
                                $array[$name] = $value;
                        }
                    }
                }
			}
        }

			// calculating the real limit level _ according to the path available
			$aux_location_father_level = false;
			$aux_location_child_level = false;
			system_retrieveLocationRelationship ($_locations, $aux_max_level, $aux_location_father_level, $aux_location_child_level);
			$limit_level = $aux_location_child_level;

			ksort($array);
		}
		///////////////////////////////////////////////////

    $aux_array_breadcrumb = [];
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "location_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							$current_level = string_substr($name, -1);
							system_retrieveLocationRelationship ($_locations, $current_level, $_location_father_level, $_location_child_level);
							if ($_location_father_level) {
								$locationName = true;
								$nodeParams = system_buildLocationNodeParams($array, $current_level, $locationName);
                            if ($locationName === true) {
									$aux_array_breadcrumb[] = LANG_NA."&raquo;";
                            } else {
									$aux_array_breadcrumb[] = "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/locations/location_".$current_level."/".$redirect."?".$nodeParams."\">".$locationName."</a>&raquo;";
							}
                        }
							if ($_location_child_level == $limit_level) {
								$locationInfo = db_getFromDB('location'.$current_level, 'id', $value, 1, '', 'array');
								$aux_array_breadcrumb[] = $locationInfo['name'];
							}
						}
						else {
							$aux_array_breadcrumb[] = LANG_NA;
						}
					}
				}
			}
		}
    if (count($aux_array_breadcrumb) > 0) {
			echo implode('&nbsp;', $aux_array_breadcrumb);
    }

		return $_link_params;
	}

	function system_retrieveLocationLinkBackLevel($locationLevel, $locationSession, $_location_node_params, $operation) {
		$url = "".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/locations/location_".$locationLevel."/";
    if ($locationSession == "manage") {
        $url .= "index.php";
    } else {
        if ($locationSession == "add") {
            $url .= "location_".$locationLevel.".php";
        } else {
            if ($locationSession == "featured") {
                $url .= "featured.php";
            }
        }
    }
		$url .= ($_location_node_params?"?".$_location_node_params:"");
    if ($_location_node_params && $operation) {
			$url .= "&";
    } elseif (!$_location_node_params && $operation) {
			$url .= "?";
    }

		return $url;
	}

	function system_retrieveLocationsInfo (&$nonDefaultLocInfo, &$defaultLocInfo) {

		$defaultLoc      = explode(",", EDIR_DEFAULT_LOCATIONS);
		$defaultLocIds   = explode(",", EDIR_DEFAULT_LOCATIONIDS);
		$defaultLocNames = explode(",", EDIR_DEFAULT_LOCATIONNAMES);
		$defaultLocShow  = explode(",", EDIR_DEFAULT_LOCATIONSHOW);
		$locations       = explode(",", EDIR_LOCATIONS);

		//retrieve all non default location
		$locations = array_diff($locations, $defaultLoc);

		$nonDefaultLocInfo = "";
    foreach ($locations as $location) {
			$nonDefaultLocInfo[] = $location;
    }

		//retrieve arrays with default locations info
		$i=0;
		$defaultLocInfo = "";
		foreach ($defaultLoc as $location) {
			$defaultLocInfo[$i]['type'] = $location;
			$defaultLocInfo[$i]['id']   = $defaultLocIds[$i];
			$defaultLocInfo[$i]['name'] = $defaultLocNames[$i];
			$defaultLocInfo[$i]['show'] = $defaultLocShow[$i];
			$i++;
		}
	}

	function system_retrieveLocationsToShow($type="string") {
		$locations = explode(",", EDIR_LOCATIONS);
		if (EDIR_DEFAULT_LOCATIONS) {
			$defaultLocShow = explode(",", EDIR_DEFAULT_LOCATIONSHOW);
        for ($i = 0; $i < count($defaultLocShow); $i++) {
            if ($defaultLocShow[$i] == 'n') {
					unset ($locations[$i]);
		}
        }
    }
		if ($type=="string") {
			$locations = array_reverse ($locations);
			$return = implode(", ", $locations);
		} elseif ($type=="array") {
			$return = $locations;
		}
		return $return;
	}

    function system_formatLocation($locationsParam) {
        /*
         * Location default format:
         * Street
         * City, State Zipcode
         * Country
         */
        if (string_strpos($locationsParam, "1") !== false) {
            $arrLoc = explode(", ", $locationsParam);

            $zipKey = array_search("z", $arrLoc);
            $countryKey = array_search("1", $arrLoc);
            if ($zipKey !== false && $countryKey !== false) {
                $auxZip = $arrLoc[$zipKey];
                $arrLoc[$zipKey] = $arrLoc[$countryKey];
                $arrLoc[$countryKey] = $auxZip;
                $locationsParam = implode(", ", $arrLoc);
            }
        }

        return $locationsParam;
    }

    function system_getLocationStringPreview($item, $preview = true) {

        if (is_object($item)) {
            $zipCode = $item->getString("zip_code");
        } else {
            $zipCode = $item["zip_code"];
        }

        $locationsToshow = system_retrieveLocationsToShow();
        $locationsParam = system_formatLocation($locationsToshow.", z");
        $locationArray = explode(", ", $locationsParam);
        $countLoc = count($locationArray);
        $x = 0;

		$locationStr = "";
		foreach ($locationArray as $locationToShow) {

            unset($locationInfo);
            if ($preview) {
                if ($locationToShow == "z") {
                    $locationInfo = $zipCode;
                } else {
                    $locationInfo = system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM")));
                }
            } else {

                if ($locationToShow == "z") {
                    $aux_field_name = "zip_code";
                } else {
                    $aux_field_name = "location_".$locationToShow."_title";
                }
                if (strlen($item[$aux_field_name]) > 0) {
                    $locationInfo = $item[$aux_field_name];
                }
            }

            if ($locationInfo) {
                $locationStr .= ($locationToShow == "1" ? "<br />" : "").$locationInfo;
            }
            $x++;
            if ($x < $countLoc && $locationToShow != "z" && $locationInfo) {
                $locationStr .= ($locationToShow == "3" && $locationArray[$x] == "z" ? " " : ", ");
            }
		}
        return $locationStr;

    }

	function system_retrieveLastDefaultLevel(&$last_default_level, &$last_default_id) {
		$last_default_level = false;
		$last_default_id = false;
		if (EDIR_DEFAULT_LOCATIONS) {
			$defaultLoc      = explode(",", EDIR_DEFAULT_LOCATIONS);
			$defaultLocIds   = explode(",", EDIR_DEFAULT_LOCATIONIDS);
			$last_default_level = array_pop($defaultLoc);
			$last_default_id = array_pop($defaultLocIds);
		}
	}

	function system_retrieveNonActivableLocations($domain_id = false) {
		$return = "";
		$dbMain = db_getDBObJect(DEFAULT_DB,true);
		$db = db_getDBObjectByDomainID($domain_id,$dbMain);
		$locations = explode(",", EDIR_LOCATIONS);
        $non_used_locations = [1, 2, 3, 4, 5];
		$non_used_locations = array_diff($non_used_locations, $locations);
		$last_actived_location = array_pop($locations);
        $locations_to_check = [];
        foreach ($non_used_locations as $each_non_used_locations) {
            if ($each_non_used_locations < $last_actived_location) {
                    array_push($locations_to_check, $each_non_used_locations);
            }
        }

		if ($locations_to_check) {
			foreach ($locations_to_check as $each_location_to_check) {
				$found=false;
				$sql = "SELECT count(id) AS total FROM Listing WHERE location_".$each_location_to_check." = 0 ";
				$r = $db->query($sql);
				$row=mysql_fetch_assoc($r);
            if ($row['total']) {
					$return[] = $each_location_to_check;
            } else {
					$sql = "SELECT count(id) AS total FROM Classified WHERE location_".$each_location_to_check." = 0 ";
					$r = $db->query($sql);
					$row=mysql_fetch_assoc($r);
                if ($row['total']) {
						$return[] = $each_location_to_check;
                } else {
						$sql = "SELECT count(id) AS total FROM Event WHERE location_".$each_location_to_check." = 0 ";
						$r = $db->query($sql);
						$row=mysql_fetch_assoc($r);
                    if ($row['total']) {
							$return[] = $each_location_to_check;
					}
				}
			}
		}
    }
    if ($return) {
			$return = implode (",", $return);
    }

		return $return;
	}

	function system_getURLLocationParams($array) {
		$url_params = "";
    $array_params = [];
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = (string_strpos($name, "location_")!==false);
					if ($pos !== false) {
						if ($value) {
							$array_params[] = $name."=".$value;
						}
					}
				}
			}
		}
		if ($array_params) {
			if (count($array_params) > 0) {
				$url_params = implode("&", $array_params);
			}
		}
		return $url_params;
	}

    /*
     * Return an array with listing levels which have certain information enabled, like review, click to call and sms.
     */
    function system_retrieveLevelsWithInfoEnabled($info) {

		$array_call_levels = system_getListingLevelInformation($info);

		unset($return);
		foreach ($array_call_levels as $key => $value) {
			if ($value == "y") {
				$return[] = $key;
			}
		}

		if (is_array($return)) {
			return $return;
		} else {
			return false;
		}

    }

	function system_getLastDay($month = '', $year = '') {
	   if (empty($month)) {
	      $month = date('m');
	   }
	   if (empty($year)) {
	      $year = date('Y');
	   }
	   $result = strtotime("{$year}-{$month}-01");
	   $result = strtotime('-1 second', strtotime('+1 month', $result));
	   return date('Y-m-d', $result);
	}

	function system_showTruncatedText($text, $length, $extraChar = "...", $isClass = false) {
		unset($return);
		unset($tLen);
		unset($ecLen);
		$text = html_entity_decode($text);
		$tLen = string_strlen($text);
		if ($tLen > $length) {
			$ecLen = string_strlen($extraChar);
			$return = string_substr($text, 0, ($length - $ecLen)).$extraChar;
		} else {
			$return = $text;
		}
		return !$isClass? htmlspecialchars($return): $return;
	}

	/**
	 * <code
	 *		//Get the Time Stamp from a date and time
	 *		system_getTimeStamp($date, $time);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getTimeStamp
	 * @access Public
	 * @param date $date
	 * @param time $time
	 * @return timestamp $timestamp
	 */
	function system_getTimeStamp($date, $time = false) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			/*
			 * Explode the date into $month, $day and $year variables
			 */
			list ($month, $day, $year)= explode("/", $date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
			/*
			 * Explode the date into $day, $month and $year variables
			 */
			list ($day, $month, $year)= explode("/", $date);
		}

		if ($time) {
			/*
			 * Explode the time into $hour, $minute and $second variables
			 */
			list($hour, $minute, $second) = explode(":", $time);
		} else {
			/*
			 * Create the $hour, $minute and $second variables with 0
			 */
			$hour = 0;
			$minute = 0;
			$second = 0;
		}
		/*
		 * Create the Time Stamp from Date and Time
		 */
		$timestamp = mktime((int)$hour, (int)$minute, (int)$second, (int)$month, (int)$day, (int)$year);
		return $timestamp;
	}

	/**
	 * <code>
	 *		//Get the number of days of a determined month
	 *		system_getMonthNumDays($date);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getMonthNumDays
	 * @access Public
	 * @param date $date
	 * @return integer $daysInMonth
	 */
	function system_getMonthNumDays($date) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			/*
			 * Explode the date into $month, $day and $year variables
			 */
			list ($month, $day, $year)= explode("/", $date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
			/*
			 * Explode the date into $day, $month and $year variables
			 */
			list ($day, $month, $year)= explode("/", $date);
		}

		/*
		 * Using date funciton with "t" param to return the number of days in a month
		 */
		$daysInMonth = date("t", mktime(0, 0, 0, (int)$month, 1, (int)$year));
		return $daysInMonth;
	}

	/**
	 * <code>
	 *		//Get the difference in days beteween two dates
	 *		system_getDiffDays($timestamp_start, $timestamp_end);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getDiffDays
	 * @access Public
	 * @param timestamp $timestamp_start
	 * @param timestamp $timestamp_end
	 * @return integer $numberOfDays
	 */
	function system_getDiffDays($timestamp_start, $timestamp_end) {
		/*
		 * Calculing the $diffdays with ($timestamp_start - $timestamp_end) / (60*60+24)
		 * $timestamp_start = Timestamp generated from start date
		 * $timestamp_end = Timestamp generated from end date
		 * (60*60*24) = Calculated Timestamp from a day
		 */
		$diffdays = ($timestamp_start - $timestamp_end) / (60*60*24);

		/*
		 * Get the absolute value from $diffdays
		 */
		$diffdays = abs($diffdays);

		/*
		 * Round the $diffdays
		 */
		$numberOfDays = floor($diffdays);
		return $numberOfDays;
	}

	/**
	 * <code>
	 *		//Get the week number from a date
	 *		system_getNumberWeek($date);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getNumberWeek
	 * @access Public
	 * @param date $date
	 * @return integer $weekNumber
	 */
	function system_getNumberWeek($date) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			/*
			 * Explode the date into $month, $day and $year variables
			 */
			list ($month, $day, $year)= explode("/", $date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y"){
			/*
			 * Explode the date into $day, $month and $year variables
			 */
			list ($day, $month, $year)= explode("/", $date);
		}

		/*
		 * Create the Time Stamp from Date
		 */
		$timestamp = mktime(0, 0, 0, (int)$month, (int)$day, (int)$year);

		/*
		 * Using date funciton with "W" param to return the week number of a timestamp
		 */
		$number = date("W", $timestamp);

		/*
		 * To fix a possible php bug
		 */
		if ($month == 1) {
			/*
			 * if month == 1 (January) and week number > 4, need to force the week number to be 0
			 */
        if ($number > 4) {
            $number = 0;
        }
    } else {
        if ($month == 12) {
			/*
			 * if month == 12 (December) and week number < 4, need to force the week number to be the last week number of the year
			 */
			if ($number < 4) {
				$timestamp = mktime(0, 0, 0, (int)$month, (int)$day-7, (int)$year);
				$number = date("W", $timestamp) + 1;
			}
		}
    }

		$weekNumber = $number + 1;
		return $weekNumber;
	}

	function system_checkDay($days) {

		$daysweek = explode(",",$days);
		$weekday_names = explode(",", LANG_DATE_WEEKDAYS);
		$weekend = false;
		$businessday = false;

		if ((count($daysweek) == 2) && ($daysweek[0] == "1" && $daysweek[1] == "7")) { //weekends
			return LANG_EVERY2." ".ucfirst(LANG_EVENT_WEEKEND);
		} elseif ((count($daysweek) == 5) && ($daysweek[0] == "2" && $daysweek[1] == "3" && $daysweek[2] == "4" && $daysweek[3] == "5" && $daysweek[4] == "6")) { //business days
			$str_date = system_showText(LANG_EVENT_BUSINESSDAY);
			return $str_date;
		} elseif (count($daysweek) == 7) { //every day
			return LANG_EVERY2." ".LANG_DAY;
		} else { //other cases
			$str_date = "";
			for ($i = 0; $i < count($daysweek); $i++) {
				$str_date .= ucfirst($weekday_names[$daysweek[$i]-1]);
				if ($daysweek[$i+2]) {
					$str_date .=", ";
				} else {
					$str_date .=" ".LANG_AND." ";
				}
			}
			$len = string_strlen(LANG_AND);
			$str_date = string_substr($str_date,0,-1-$len);

			return LANG_EVERY." ".$str_date;
		}
	}

    function system_getOrdinalLabel($number) {

        $str = $number;

        if ($number == 1 || $number == 21 || $number == 31) {
            $str .= "st";
        } elseif ($number == 2 || $number == 22) {
            $str .= "nd";
        } elseif ($number == 3 || $number == 23) {
            $str .= "rd";
        } else {
            $str .= "th";
        }

        return $str;

    }

	function system_getRecurringWeeks($weekdays) {

		$array_weekdays = explode(",",$weekdays);
		$aux = 0;

		if (count($array_weekdays) == 0) {
			$aux = $array_weekdays[0];
        if ($aux == 1) {
            $str = system_showText(LANG_FIRST_2);
        } elseif ($aux == 2) {
            $str = system_showText(LANG_SECOND_2);
        } elseif ($aux == 3) {
            $str = system_showText(LANG_THIRD_2);
        } elseif ($aux == 4) {
            $str = system_showText(LANG_FOURTH_2);
        } elseif ($aux == 5) {
            $str = system_showText(LANG_LAST);
        }

			return $str;
		} else {
			$str_date = "";
			$weekday_names = explode(",", LANG_DATE_WEEKDAYS);

			if (count($array_weekdays) == 5) {
				return false;
			} else {

                for ($i = 0; $i < count($array_weekdays); $i++) {
                    $aux = $array_weekdays[$i];
                if ($aux == 1) {
                    $str = system_showText(LANG_FIRST_2);
                } elseif ($aux == 2) {
                    $str = system_showText(LANG_SECOND_2);
                } elseif ($aux == 3) {
                    $str = system_showText(LANG_THIRD_2);
                } elseif ($aux == 4) {
                    $str = system_showText(LANG_FOURTH_2);
                } elseif ($aux == 5) {
                    $str = system_showText(LANG_LAST);
                }
                    $str_date .= $str;

                    if ($array_weekdays[$i+2]) {
                        $str_date .= ", ";
                    } else {
                        $str_date .= " ".LANG_AND." ";
                    }
                }
                $len = string_strlen(LANG_AND);
                $str_date = string_substr($str_date, 0, -1 - $len);

                return $str_date;
			}
		}

	}

	/**
	 * Return the permission from a determined file or folder
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_checkPerm()
	 * @param varchar $src
     * @return integer $permission
     */
	function system_checkPerm ($src) {
		$permission = string_substr(decoct(fileperms($src)), 1);
		return $permission;
	}

 	/**
	 * Parse XML file to array
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name objectsIntoArray()
	 * @param array $arrObjData
	 * @param array $arrSkipIndices
     * @return array
     */
function objectsIntoArray($arrObjData, $arrSkipIndices = [])
{
    $arrData = [];

    	// if input is object, convert into array
    	if (is_object($arrObjData)) {
    	    $arrObjData = get_object_vars($arrObjData);
    	}

    	if (is_array($arrObjData)) {
      	  foreach ($arrObjData as $index => $value) {
         	   if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
         	   }
           	 if (in_array($index, $arrSkipIndices)) {
           	     continue;
           	 }
           	 $arrData[$index] = $value;
        	}
   	 	}
   	 	return $arrData;
	}

    function system_findTranslationFor($word, $language = EDIR_LANGUAGE, $languageFile = ""){
		if (!$language || !$word) {
			return false;
		}

        if (!$languageFile) {
            $languageFile = EDIRECTORY_ROOT."/lang/$language".".php";
        }

		if (file_exists($languageFile)){
			$fp = fopen($languageFile, 'r');
			if ($fp && filesize($languageFile)){
				$phptext = file_get_contents($languageFile);
				$startPos = string_strpos($phptext,$word."\",");

				$text1 = string_substr($phptext,$startPos,string_strlen($phptext));
                $text2 = string_substr($text1,0,string_strpos($text1,");"));
				$text2ARR = explode('",',$text2);

                $return_str = trim($text2ARR[1]);
                $return_str = string_substr($return_str, 1);
                $return_str = string_substr($return_str, 0, -1);
				return $return_str;
			} else{
				return false;
			}
		} else {
			return false;
		}

	}

    function is_ie($ie6=false, &$version = false){
        if ($ie6){
            if(preg_match('/(?i)msie [6]/',strtolower($_SERVER['HTTP_USER_AGENT'])) ) {
				$version = 6;
                return true;
			} else {
				return false;
			}
        } else {
            if(preg_match('/(?i)msie [7]/',strtolower($_SERVER['HTTP_USER_AGENT'])) ) {
				$version = 7;
                return true;
        } else {
            if (preg_match('/(?i)msie [8]/', strtolower($_SERVER['HTTP_USER_AGENT']))) {
				$version = 8;
                return true;
            } else {
                if (preg_match('/(?i)msie [9]/', strtolower($_SERVER['HTTP_USER_AGENT']))) {
				$version = 9;
                return true;
			} else {
				return false;
			}
        }
    }
    }
}

	/**
	 * Fill up an Array of Javascript functions and throw it up on document.ready - jquery
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param string $file
     * @param array $arrayWJavascripts
     * @param boolean $optimzeit
     * @return array
     */
    function system_scriptColectorOnReady($content,$arrayWJavascripts=false,$optimzeit=true){
        if (!$optimzeit){
			?>
			<script type="text/javascript" ><?=$content?></script>
			<?
			$arrayWJavascripts['log'][] = "scriptColectorOnReady: Not optimized content";
		}else{
			$arrayWJavascripts['log'][] = "scriptColectorOnReady: Optimized content";
			$arrayWJavascripts['contentOnReady'][] = $content;
			return $arrayWJavascripts;
		}

    }

     /**
	 * javascript includes
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param string $file
     * @param array $arrayWJavascripts
     * @return array
     */
    function system_scriptColectorExternal($file,$arrayWJavascripts=false){
		if (!$arrayWJavascripts){
        $arrayWJavascripts = [];
		}
		$arrayWJavascripts['external'][] = $file;
		$arrayWJavascripts['log'][] = "scriptColectorExternal: Wrote file $file";
		return $arrayWJavascripts;
    }



    /**
	 * Fill up an Array of Javascript file names and minimize at the end
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param string $file
     * @param array $arrayWJavascripts
     * @param string $internalFunction
     * @param boolean $optimzeit
     * @param boolean $external
     * @return array
     */
    function system_scriptColector($file, $arrayWJavascripts = false, $internalFunction = false, $optimzeit = true, $external = false){

		if (!$optimzeit && $external) {
			$filename = $file;
		} else {
			$filename = DEFAULT_URL.$file;
		}

		if (!$optimzeit){
			?>
			<script src="<?=$filename;?>" type="text/javascript"><?=$internalFunction?></script>
			<?
			 $arrayWJavascripts['log'][] = "scriptColector: Not optimized $file ".($internalFunction?" with internal functions":'');
		} else {
        if (!$arrayWJavascripts) {
            $arrayWJavascripts = [];
        }

			$filename = EDIRECTORY_ROOT.$file;
			if (file_exists($filename)){
				$filesize = filesize($filename);
				$filemodification = date("dYHis", filemtime($filename));
				$arrayWJavascripts['name'][] = $file;
				$arrayWJavascripts['id'][] = $filemodification;
				$arrayWJavascripts['internalFunction'][] = $internalFunction;

        } else {
            echo "error reading: $filename";
        }

			return $arrayWJavascripts;
		}
	}

    function system_returnPageByURL() {

        if ($_SERVER['SCRIPT_NAME'] != EDIRECTORY_FOLDER."/index.php") { //physical pages (not built by modrewrite)
            return $_SERVER['SCRIPT_NAME'];
        } else {
            if (ACTUAL_MODULE_FOLDER == "" && !defined("ACTUAL_PAGE_NAME")) { //Home Page
                return EDIRECTORY_FOLDER."/index.php";
            } else { //Modules pages
                if (defined("ACTUAL_PAGE_NAME")) {
                    return ACTUAL_PAGE_NAME;
                } else {
                    return $_SERVER['SCRIPT_NAME'];
                }
            }
        }

    }

	 /**
	 * Write all javascript files on array after minimize it, creating a unique js file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param array $jsArray
	 * @param boolean $skipOptimzation
	 */
	function system_renderJavascripts($jsArray,$skipOptimzation=false) {

		if ($skipOptimzation){
			$counter = 0;
			foreach ($jsArray['name'] as $script){
				?> <script type="text/javascript" src="<?=DEFAULT_URL?><?=$script?>"><?=$jsArray['internalFunction'][$counter++]?></script><?
			}
			$jsArray['log'][] = "renderJavascripts: skipping optimization if $script ";

			if (is_array($jsArray['contentOnReady'])){
				?>
				<script type="text/javascript">
					$(document).ready(function() {
						<?
						foreach ($jsArray['contentOnReady'] as $content){
							echo $content;
						}
						?>
					 });
				</script>
				<?
				$jsArray['log'][] = "renderJavascripts: Wrote contentOnReady ";
			}
		} else {

			$relativePath = DEFAULT_URL.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';
			$physicalPath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';

        if (!is_dir($physicalPath)) {
            mkdir($physicalPath);
        }

			// check if file exists
			$fileNameId = 0;
        if ($jsArray['id']) {
            foreach ($jsArray['id'] as $id) {
					$fileNameId += (int)$id;
            }
        }

			$currentFileName = system_returnPageByURL();
			$currentFileName = str_replace('/','',$currentFileName);
			$currentFileName = str_replace('.','',$currentFileName);
			$fileNameId = $currentFileName.'_'.$fileNameId;

			$fileNametoInclude = $relativePath.'/min_'.$fileNameId.'.js';
			$fileNameId = $physicalPath.'/min_'.$fileNameId.'.js';

			if (file_exists($fileNameId) && (int)filesize($fileNameId)>0){
				// just add as normal javascript
				$jsArray['log'][] = "renderJavascripts: Has already optimized JS [$fileNametoInclude] ";
			}else{
				// build the file
				include_once(CLASSES_DIR."/class_miniJS.php");

				//remove any other minified
            foreach (glob($physicalPath."/min_$currentFileName*.js") as $deleteFilename) {
				   @unlink($deleteFilename);
            }

				$handle = fopen($fileNameId, 'w+');
            if ($jsArray['name']) {
                foreach ($jsArray['name'] as $jsFile) {
					fwrite($handle, "\n\n/* File: ".$jsFile." */\n");
                    fwrite($handle, JSMin::minify(file_get_contents(EDIRECTORY_ROOT.$jsFile)));
                }
            }

				 fclose($handle);

				 $jsArray['log'][] = "renderJavascripts: Built new optimzed JS [$jsFile]  ";
			}
			?>

			<script type="text/javascript" src="<?=$fileNametoInclude?>"></script>
			<?
			if(is_array($jsArray['internalFunction']) && $jsArray['internalFunction'][0]!='') { ?>
				<script type="text/javascript">
					<?
						$counter = 0;
						foreach ($jsArray['internalFunction'] as $internalScript){
							?><?=$internalScript?><?
						}
						$jsArray['log'][] = "renderJavascripts: Wrote internal functions";
					?>
				</script><?
			}

			if (is_array($jsArray['contentOnReady'])){
				include_once(CLASSES_DIR."/class_miniJS.php");

				$Fullcontent = "";
            foreach ($jsArray['contentOnReady'] as $content) {
					$Fullcontent .= $content;
            }

				if ($Fullcontent){
				?>

				<script type="text/javascript">
					//<![CDATA[
					$ = jQuery.noConflict();
					$(document).ready(function() {
						<?=JSMin::minify($Fullcontent); ?>
					});
					//]]>
				</script>

				<?
				}
				$jsArray['log'][] = "renderJavascripts: Minified content on ready";
			}

		}

		if (is_array($jsArray['external'])) {

			foreach ($jsArray['external'] as $file){
				?>  <script type="text/javascript" src="<?=$file?>"></script>  <?
			}
			$jsArray['log'][] = "renderJavascripts: Wrote external files";
		}

		if (SCRIPTCOLLECTOR_DEBUG=='on'){
			if (is_array($jsArray['log'])){
				echo implode("<br/>",$jsArray['log']);
			}
		}
	}

     /**
	 * Fill up an Array of CSS file names and minimize at the begginig
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColectorCSS()
	 * @param string $file
     * @param array $arrayWCSS
     * @param boolean $optimzeit
     * @return array
     */
    function system_scriptColectorCSS($file,$arrayWCSS=false,$optimzeit=true){

		if (!$optimzeit){
			?>
			<link type="text/css" href="<?=DEFAULT_URL?><?=$file?>" rel="stylesheet" />
			<?
		}else{
        if (!$arrayWCSS) {
            $arrayWCSS = [];
        }

			$filename = EDIRECTORY_ROOT.$file;
			if (file_exists($filename)){
				$filesize = filesize($filename);
				$filemodification = date ("dYHis", filemtime($filename));
				$arrayWCSS['name'][] = $file;
				$arrayWCSS['id'][] = $filemodification;

        } else {
            echo "error reading: $filename";
        }

			return $arrayWCSS;
		}
	}

	 /**
	 * Write all CSS files on array
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name renderCSSs()
	 * @param array $jsArray
	 * @param boolean $skipOptimzation
	 */
	function system_renderCSSs($cssArray,$skipOptimzation=false){
		if ($skipOptimzation){
			$counter = 0;
			foreach ($cssArray['name'] as $file){
				?> <link type="text/css" href="<?=DEFAULT_URL?><?=$file?>" rel="stylesheet" /><?
			}
		} else {

			$relativePath = DEFAULT_URL.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';
			$physicalPath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';

        if (!is_dir($physicalPath)) {
            mkdir($physicalPath);
        }

			// check if file exists
			$fileNameId = 0;
        if ($cssArray['id']) {
            foreach ($cssArray['id'] as $id) {
					$fileNameId += (int)$id;
            }
        }

			$currentFileName = system_returnPageByURL();
			$currentFileName = str_replace('/','',$currentFileName);
			$currentFileName = str_replace('.','',$currentFileName);
			$fileNameId=$currentFileName.'_'.$fileNameId;

			$fileNametoInclude = $relativePath.'/min_'.$fileNameId.'.css';
			$fileNameId = $physicalPath.'/min_'.$fileNameId.'.css';

			if (file_exists($fileNameId) && (int)filesize($fileNameId)>0){
				// just add as normal css
			}else{
				// build the file
				include_once(CLASSES_DIR."/class_miniJS.php");

				//remove any other minified
				$deleteFiles = glob($physicalPath."/min_$currentFileName*.css");
				if (is_array($deleteFiles) && $deleteFiles[0]) {
                foreach ($deleteFiles as $deleteFilename) {
					   @unlink($deleteFilename);
				}
            }


				$handle = fopen($fileNameId, 'w+');
            if ($cssArray['name']) {
                foreach ($cssArray['name'] as $cssFile) {
					fwrite($handle, JSMin::minify(file_get_contents(EDIRECTORY_ROOT.$cssFile)));
                }
            }

				 fclose($handle);
			}
			?>
			<link type="text/css" href="<?=$fileNametoInclude?>" rel="stylesheet" />
			<?
		}
	}

	 /**
	 * Generate a xml content from a sql command.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.1.00
	 * @name system_generateXML()
	 * @param string $section "categories"
	 * @param string $sql ""
	 * @param integer $domain_id false
	 * @param string(xml) $xml_content
	 */
	function system_generateXML($section = "categories", $sql = "", $domain_id = false) {
		if (!$section || !$sql){
            return false;
        }

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		if ($domain_id) {
            $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
		} else {
            $dbObj = db_getDBObject();
		}
		unset($dbMain);

		$result = $dbObj->unbuffered_query($sql);

		if($result){
            unset($xml_content);
            $xml_content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml_content .= "<$section>";
            $hasCateg = false;
            while($row = mysql_fetch_assoc($result)){
                $xml_content .="<info>";
                $hasCateg = true;
                foreach ($row as $key => $value) {
                    if (is_string($value)){
                        $xml_content .="<$key>".format_getString($value)."</$key>";
                } else {
                    if (is_numeric($value)) {
                        $xml_content .="<$key>".$value."</$key>";
                    }
                }
            }

                $xml_content .="</info>";
            }

            $xml_content .="</$section>";
        if (!$hasCateg) {
            return false;
        }

            return $xml_content;
		} else {
            return false;
		}
	}

	function system_getFormAction($action) {
		return $action;
	}

	function system_renameGalleryImages($image_id = 0, $thumb_id = 0, $account_id = 0, $galleryIDC = 0, $renameGallery = true){
		if ($image_id){

			$imageChange = new Image($image_id);
			if ($imageChange->imageExists()) {
				$oldPrefix = $imageChange->getString("prefix");
				$newPrefix = $account_id ? $account_id."_" : "sitemgr_";
				$img_type = string_strtolower($imageChange->getString("type"));
				$imageChange->setString("prefix",$newPrefix);
				$imageChange->Save();

				$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
				$imageOld = $dir."/".$oldPrefix."photo_".$image_id.".".$img_type;
				$imageNew = $dir."/".$newPrefix."photo_".$image_id.".".$img_type;
				rename($imageOld, $imageNew);
			}
		}

		if ($thumb_id){

			$thumbChange = new Image($thumb_id);
			if ($thumbChange->imageExists()) {
				$oldPrefix = $thumbChange->getString("prefix");
				$newPrefix = $account_id ? $account_id."_" : "sitemgr_";
				$img_type = string_strtolower($thumbChange->getString("type"));
				$thumbChange->setString("prefix",$newPrefix);
				$thumbChange->Save();

				$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
				$imageOld = $dir."/".$oldPrefix."photo_".$thumb_id.".".$img_type;
				$imageNew = $dir."/".$newPrefix."photo_".$thumb_id.".".$img_type;
				rename($imageOld, $imageNew);
			}
		}

		if ($galleryIDC && $renameGallery) {
			$galleryC = new Gallery($galleryIDC);

			if (count($galleryC->image) > 0) {
				for ($i=0; $i<count($galleryC->image); $i++) {
					$thumbObjC = new Image($galleryC->image[$i]["thumb_id"]);
					$imageObjC = new Image($galleryC->image[$i]["image_id"]);

					$thumb_idT = $galleryC->image[$i]["thumb_id"];
					$image_idT = $galleryC->image[$i]["image_id"];
					if ($thumbObjC->imageExists()) {
						$oldPrefix = $thumbObjC->getString("prefix");
						$newPrefix = $account_id ? $account_id."_" : "sitemgr_";
						$img_type = string_strtolower($thumbObjC->getString("type"));
						$thumbObjC->setString("prefix",$newPrefix);
						$thumbObjC->Save();

						$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
						$imageOld = $dir."/".$oldPrefix."photo_".$thumb_idT.".".$img_type;
						$imageNew = $dir."/".$newPrefix."photo_".$thumb_idT.".".$img_type;

						rename($imageOld, $imageNew);
					}
					if ($imageObjC->imageExists()) {
						$oldPrefix = $imageObjC->getString("prefix");
						$newPrefix = $_POST["account_id"] ? $_POST["account_id"]."_" : "sitemgr_";
						$img_type = string_strtolower($imageObjC->getString("type"));
						$imageObjC->setString("prefix",$newPrefix);
						$imageObjC->Save();

						$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
						$imageOld = $dir."/".$oldPrefix."photo_".$image_idT.".".$img_type;
						$imageNew = $dir."/".$newPrefix."photo_".$image_idT.".".$img_type;

						rename($imageOld, $imageNew);
					}
				}
			}
		}
	}

	function system_addItemGallery($gallery_hash, $title = "", &$galleryIDC, &$image_id, &$thumb_id, $blog = false){

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sess_id = $gallery_hash;

		if (!$blog) {

			$gallery = new Gallery($galleryIDC);
			if (!$galleryIDC) {
            $aux = ["account_id" => 0, "title" => $title, "entered" => "NOW()", "updated" => "now()"];
				$gallery->makeFromRow($aux);
				$gallery->save();
                $galleryIDC = $gallery->id;
			}

			$sql = "SELECT
						image_id,
						image_caption,
						thumb_id,
						thumb_caption,
						image_default
					FROM Gallery_Temp
					WHERE sess_id = '$sess_id'";
			$r = $dbObj->query($sql);
			while ($aux = mysql_fetch_array($r)) {

				if ($aux["image_default"] == "y"){
					$image_id = $aux["image_id"];
					$thumb_id = $aux["thumb_id"];
				}
				$row["image_id"] = $aux["image_id"];
				$row['image_caption'] = $aux["image_caption"];
				$row['thumb_id'] = $aux["thumb_id"];
				$row['thumb_caption'] = $aux["thumb_caption"];
				$row['image_default'] = $aux["image_default"];
				$row['order'] = 0;
				$gallery->AddImage($row);
				$gallery->save();
				$galleryIDC = $gallery->id;
			}
			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";
			$dbObj->query($sql);
		} else {
			$sql = "SELECT
							image_id,
							image_caption,
							thumb_id,
							thumb_caption,
							image_default
						FROM Gallery_Temp
						WHERE sess_id = '$sess_id'";
			$r = $dbObj->query($sql);
			while ($aux = mysql_fetch_array($r)) {
				$image_id = $aux["image_id"];
				$thumb_id = $aux["thumb_id"];
				$_POST["image_caption"] = $aux["image_caption"];
				$_POST["thumb_caption"] = $aux["thumb_caption"];
			}

			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";

			$dbObj->query($sql);
		}
	}

	/**
	 *	Function to prepare letters to pagination
	 * 	@desc Function to prepare letters do pagination
	 *	@author Rodrigo Apetito	- Arca Solutions
	 * 	@param object pageObj
	 * 	@param array searchReturn
	 * 	@param string paging_url
	 * 	@param string url_search_params
	 * 	@param string letter
	 * 	@filesource /functions/system_funct.php
 	 * 	@since July, 15, 2011
	 *	@return string with letters and links
	 */
	function system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, $fieldOnTable, $blog_module = false, $promotion_module = false, $listingForceJoin = false, $scalability = "off"){

		$letters = $pageObj->getString("letters");
    $module_letters = [];
    $module_not_letters = [];
    $aux_letters = [];
		$aux_letters = implode("','",$letters);
		$aux_letters = str_replace("#',", "", $aux_letters);
		$aux_letters .= "'";

		$scalability = "on";

		if ($scalability == "off") {

			$db = db_getDBObject();
			$sql = "SELECT SUBSTRING(".$fieldOnTable.",1,1) AS letter_field FROM ".$searchReturn["from_tables"].($searchReturn["where_clause"] ? " WHERE ".$searchReturn["where_clause"] : "")."  GROUP BY letter_field HAVING UPPER(letter_field) IN ($aux_letters)";
			$r = $db->query($sql);
			while($row = mysql_fetch_assoc($r)){
				$module_letters[] = $row["letter_field"];
			}
		} else {
			$module_letters = $letters;
		}

		if ($promotion_module) {
			$auxID = "Promotion.id";
			$auxfieldOnTable = "Promotion.name";
		} else {
			if ($listingForceJoin == "on") {
            $auxID = "Listing.`id`";
			} else {
				$auxID = "`id`";
			}

			$auxfieldOnTable = $fieldOnTable;
		}

		if ($scalability == "off") {
            $sql = "SELECT $auxID FROM ".$searchReturn["from_tables"].($searchReturn["where_clause"] ? " WHERE ".$searchReturn["where_clause"]." AND $fieldOnTable REGEXP '^[^a-zA-Z].*$'" : " WHERE $auxfieldOnTable REGEXP '^[^a-zA-Z].*$'");
            $r = $db->query($sql);
			if (mysql_num_rows($r)) {
				$specialChar = true;
			} else {
				$specialChar = false;
			}
		} else {
			$specialChar = true;
		}

		unset($letters_menu);
		foreach ($letters as $each_letter) {
			$letters_menu .= "<li>";
			if ($_GET["url_full"] || $blog_module) {
				if($each_letter != "#"){
					if ( (in_array(strtoupper($each_letter), $module_letters)) || (in_array($each_letter, $module_letters)) ){
						$letters_menu .= "<a href=\"$paging_url".(($url_search_params) ? "$url_search_params" : "")."/letter/".$each_letter."\" ".(($each_letter == $letter) ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else{
						$letters_menu .= "<span>".strtoupper($each_letter)."</span>";
					}
				} else{
					if ($specialChar){
						$letters_menu .= "<a href=\"$paging_url".(($url_search_params) ? "$url_search_params" : "")."/letter/no\" ".(($letter == "no") ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else{
						$letters_menu .="<span>#</span>";
					}
				}

			}else{
				if ($each_letter == "#") {
					if ($specialChar){
						$letters_menu .= "<a href=\"$paging_url?letter=no".(($url_search_params) ? "&amp;$url_search_params" : "")."\" ".(($letter == "no") ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else {
						$letters_menu .= "<span>#</span>";
					}
				} else {
					if ( (in_array(strtoupper($each_letter), $module_letters)) || (in_array($each_letter, $module_letters)) ){
						$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter.(($url_search_params) ? "&amp;$url_search_params" : "")."\" ".(($each_letter == $letter) ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else {
						$letters_menu .= "<span>".strtoupper($each_letter)."</span>";
					}
				}
			}
			$letters_menu .="</li>";
		}
		return $letters_menu;
	}


	/**
	 *	Function to prepare to pagination
	 * 	@desc Function to prepare pagination
	 *	@author Rodrigo Apetito	- Arca Solutions
	 * 	@param string paging_url
	 * 	@param string url_search_params
	 * 	@param string letter
	 * 	@param Object pageObj
	 * 	@filesource /functions/system_funct.php
 	 * 	@since July, 15, 2011
	 *	@return array with content to pagination
	 */
	function system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, $screen, $aux_items_per_page, $adv_search = false, $jsFunct = "") {
		if ($adv_search) {
            $delimiter = (string_strpos($paging_url, "?") !== false) ? "&amp;" : "?";
			$aux_page_url = $paging_url.$delimiter.$url_search_params;
		} else {
			$aux_page_url = $paging_url.$url_search_params;
		}

		if ($letter) {
			if ($adv_search){
				$aux_page_url .= "&amp;letter=".$letter;
			} else {
				if (substr($aux_page_url,strlen($aux_page_url)-1) != "/") {
					$aux_page_url .= "/letter/".$letter;
				} else {
					$aux_page_url .= "letter/".$letter;
				}
			}
		}

		if ($adv_search) {
            if (substr($aux_page_url, -1) == "?") {
               $aux_page_url .= "screen=";
            } else {
                $aux_page_url .= "&amp;screen=";
            }
		} else {
			if (substr($aux_page_url,strlen($aux_page_url)-1) != "/") {
				$aux_page_url .= "/page/";
			} else {
				$aux_page_url .= "page/";
			}
		}

		$array_pages_code = $pageObj->getPagination($screen, $aux_items_per_page, $aux_page_url, false, $jsFunct);

		return $array_pages_code;
	}

	function system_CallUrlByCURL($url,$referer,$parameters,$post_method = true){

        $agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)";

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_NOPROGRESS, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

        if($post_method){

        	curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);

        }

        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close ($ch);

		return $response;

	}

	function system_hex2rgb($color) {

		$red	= string_substr($color, 0, 2);
		$green	= string_substr($color, 2, 2);
		$blue	= string_substr($color, 4, 2);

		/*
		 * Hexadecimal
		 */
		$red_hex = hexdec($red);
		$green_hex = hexdec($green);
		$blue_hex = hexdec($blue);

    return [
		"red"=> $red_hex,
		"green"=> $green_hex,
        "blue"  => $blue_hex,
    ];
	}

	function system_ListingLevel_Constant(){

		if(defined('LISTING_LEVEL_INFORMATION')){
			return false;
		}

		unset($listingLevelObj, $array_listing_level);

		$listingLevelObj = new ListingLevel();
		$array_listing_level = $listingLevelObj->convertTableToArray();

		if(is_array($array_listing_level)){
			define("LISTING_LEVEL_INFORMATION", serialize($array_listing_level));
		}

	}

	/*
	 * Function to get information about levels
	 */
	function system_getListingLevelInformation($index){

		if (!defined('LISTING_LEVEL_INFORMATION')) {
			system_ListingLevel_Constant();
		}

		$aux_listinglevel_information = unserialize(LISTING_LEVEL_INFORMATION);
		$array_listinglevel_information = $aux_listinglevel_information[$index];

		if (is_array($array_listinglevel_information)) {
			return $array_listinglevel_information;
		} else {
			return false;
		}

	}

    function system_downloadFile($filePath, $name, $ext){

        $fileName = EXTRAFILE_DIR."/$name.zip";
		@unlink($fileName);
		$zipObj = new Zip();
		$zipObj->setZipFile($fileName);
        if (is_array($filePath)) {
            foreach($filePath as $file) {
                $fileContent = file_get_contents($file["file"]);
				$zipObj->addFile($fileContent, $file["name"]);
            }
        } else {
            $fileContent = file_get_contents($filePath);
            $zipObj->addFile($fileContent, $name.".".$ext);
        }
        $zipObj->finalize();
        $zipObj->sendZip($name.'.zip');
		exit;
    }

    /**
     * Get fields to prepare form to module
     * @param string $module
     * @return array $array_fields
     */
    function system_getFormFields($module, $level = "", $field = "") {

        if (EDIR_THEME) {
            $theme = EDIR_THEME;
        } else {
            $theme = "default";
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

        /**
         * Get fields
         */
        if (is_string($module) && is_string($theme) && (is_numeric($level) || $field)) {

            if ($field) {
                $fieldName = "level";
                $sql = "SELECT $fieldName FROM ".ucfirst($module)."Level_Field WHERE field = ".db_formatString($field);
            } else {
                $fieldName = "field";
                $sql = "SELECT $fieldName FROM ".ucfirst($module)."Level_Field WHERE level = ".$level;
            }
            $result = $db->unbuffered_query($sql);
            if ($result) {
                unset($array_fields);
                while($row = mysql_fetch_assoc($result)){
                    $array_fields[] = $row[$fieldName];
                }
                return $array_fields;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function system_updateFormFields($array, $table) {

        extract($array);

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

        //available fields
    $avFields = [];
        $avFields[] = "email";
        $avFields[] = "url";
        $avFields[] = "phone";
        $avFields[] = "fax";
        $avFields[] = "video";
        $avFields[] = "attachment_file";
        $avFields[] = "summary_description";
        $avFields[] = "long_description";
        $avFields[] = "hours_of_work";
        $avFields[] = "badges";
        $avFields[] = "contact_name";
        $avFields[] = "time";
        $avFields[] = "contact_phone";
        $avFields[] = "contact_email";
        $avFields[] = "price";
        $avFields[] = "locations";
        $avFields[] = "main_image";
        $avFields[] = "fbpage";
        $avFields[] = "social_network";
        $avFields[] = "features";

        foreach ($avFields as $avField) {

            if ($avField == "time") { //event time includes start_time and end_time, let's split it
                $sql = "DELETE FROM ".$table."Level_Field WHERE (field = 'start_time' OR field = 'end_time')";
            } else {
                $sql = "DELETE FROM ".$table."Level_Field WHERE field = '$avField'";
            }
            $dbObj->query($sql);


            $sql = "";
            if (is_array(${"itemLevel_".$avField})) {

                $sql = "INSERT INTO ".$table."Level_Field (level, field) VALUES ";
            $sqlArray = [];

                foreach (${"itemLevel_".$avField} as $key => $value) {
                    if ($avField == "time") { //event time includes start_time and end_time, let's split it
                        $sqlArray[] = "($key, 'start_time')";
                        $sqlArray[] = "($key, 'end_time')";
                    } else {
                        $sqlArray[] = "($key, '$avField')";
                    }
                }

                $sql .= implode(", ", $sqlArray);
                $dbObj->query($sql);
            }
        }

    }

    function system_getLevelDetail($table){

    $arrayLevels = [];
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "SELECT value FROM $table WHERE featured = 'y' AND active = 'y' ORDER BY value";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result) > 0){
            while ($row = mysql_fetch_assoc($result)){
              $arrayLevels[] = $row["value"];
            }
            return $arrayLevels;
        } else {
            return $arrayLevels;
        }
    }

    function system_sidebarInfo(&$label, &$extraFields){

        $extraFields = false;
        if (ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER){
            $extraFields = true;
            $label = system_showText(LANG_BROWSELISTINGS);
        } elseif (ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER){
            $label = system_showText(LANG_BROWSEEVENTS);
        } elseif (ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER){
            $label = system_showText(LANG_BROWSECLASSIFIEDS);
        } elseif (ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER){
            $label = system_showText(LANG_BROWSEARTICLES);
        } elseif (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER){
            $label = system_showText(LANG_BROWSEPROMOTIONS);
        } elseif (ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER){
            $label = system_showText(LANG_BROWSEPOSTS);
        } else {
            $extraFields = true;
            $label = system_showText(LANG_BROWSELISTINGS);
        }
    }

    function system_getDropdownValues($template_id, $field, $block = 5, $inc = false){
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $fields = [];
    $dropdownValues = [];

        $themeSummaryFields = unserialize(TEMPLATE_SUMMARY_FIELDS);

        $sql = "SELECT min(CAST($field AS SIGNED INTEGER)) min_value, max(CAST($field AS SIGNED INTEGER)) max_value FROM Listing WHERE listingtemplate_id = $template_id AND $field > 0";

        $row = mysql_fetch_assoc($dbObj->query($sql));
        $interval = $row["max_value"] - $row["min_value"];
        if ($interval > 0){
            $sumBlock = round($interval/$block);
            if ($row["min_value"] > 0){
                if ($inc){
                    $fields[] = $row["min_value"]+1;
                } else {
                    $fields[] = $row["min_value"];
                }
            }
            for ($i = 1; $i < $block; $i++){
                if ($inc){
                    $fields[] = ($row["min_value"]+1) + $i*$sumBlock;
                } else {
                    $fields[] = $row["min_value"] + $i*$sumBlock;
                }
            }
            if ($row["max_value"] > 0){
                if ($inc){
                    $fields[] = $row["max_value"]+1;
                } else {
                    $fields[] = $row["max_value"];
                }
            }
        } elseif ($row["max_value"] == $row["min_value"]){
            if ($inc){
                $fields[] = $row["max_value"]+1;
            } else {
                $fields[] = ($row["max_value"] ? $row["max_value"] : 0);
            }
        }

        if (count($fields) > 0) {
            $dropdownValues[0][0] = "--------------";
            $dropdownValues[0][1] = "";
            for($i = 1; $i <= count($fields); $i++){
                if ($field == $themeSummaryFields["price_field"]){
                    $dropdownValues[$i][0] = CURRENCY_SYMBOL.format_money($fields[$i-1]);
                } elseif($field == $themeSummaryFields["squarefeet_field"]) {
                    $dropdownValues[$i][0] = $fields[$i-1];
                } elseif($field == $themeSummaryFields["acre_field"]) {
                    $dropdownValues[$i][0] = $fields[$i-1];
                } else {
                    $dropdownValues[$i][0] = $fields[$i-1];
                }
                $dropdownValues[$i][1] = $fields[$i-1];
            }
        }

        return $dropdownValues;

    }

    function system_CreateZipFile($filePath, $name, $ext, $path){

        $fileName = $path."/$name.zip";
		@unlink($fileName);
		$zipObj = new Zip();
		$zipObj->setZipFile($fileName);
        $fileContent = file_get_contents($filePath);
        $zipObj->addFile($fileContent, $name.".".$ext);
        $zipObj->finalize();
		return true;
    }

    function system_generateEdirLog($file_name, $message){

        if (ENABLE_LOG && LOG_SIZE_ROTATE && LOG_PATH) {

            /**
             *  File Rotate
             */
            $aux_file_name = LOG_PATH."/domain_".SELECTED_DOMAIN_ID."_".$file_name;
            if (file_exists($aux_file_name)) {

                $aux_filesize = filesize($aux_file_name);
                if (round($aux_filesize / 1048576, 2) >= LOG_SIZE_ROTATE ) {

                    /**
                     * Zip file
                     */
                    $zipObj = new Zip();
                    system_CreateZipFile($aux_file_name, $file_name."_".date("Y")."-".date("M")."-".date("d")."-".date("H").":".date("i").":".date("s"), "zip", LOG_PATH);
                    $log_file = fopen($aux_file_name, 'w+');

                } else {
                    $log_file = fopen($aux_file_name, 'a+');
                }

            } else {
                $log_file = fopen($aux_file_name, 'a+');
            }

            if ($log_file) {

                fwrite($log_file, "Date: ".date("Y")."-".date("M")."-".date("d")." - ".date("H").":".date("i").":".date("s")." - ".$message."\n");
                fclose($log_file);

            }
        }
    }

    function system_writeConstantsFile($filePath, $domain_id, $values) {

        if ($fileConst = fopen($filePath, "w+")) {
            $buffer = "";
            $buffer .= "<?".PHP_EOL;;
            $buffer .= "/*==================================================================*\\".PHP_EOL;
            $buffer .= "######################################################################".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# This file may not be redistributed in whole or part.               #".PHP_EOL;
            $buffer .= "# eDirectory is licensed on a per-domain basis.                      #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# http://www.edirectory.com | http://www.edirectory.com/license.html #".PHP_EOL;
            $buffer .= "######################################################################".PHP_EOL;
            $buffer .= "\*==================================================================*/".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# * FILE: /custom/domain_$domain_id/conf/constants.inc.php".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# FLAGS - on/off".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "# MODULES".PHP_EOL;
            $buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
            $buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
            $buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "define(\"EVENT_FEATURE\", \"".($values["event_feature"] ? $values["event_feature"] : EVENT_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"BANNER_FEATURE\", \"".($values["banner_feature"] ? $values["banner_feature"] : BANNER_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"CLASSIFIED_FEATURE\", \"".($values["classified_feature"] ? $values["classified_feature"] : CLASSIFIED_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"ARTICLE_FEATURE\", \"".($values["article_feature"] ? $values["article_feature"] : ARTICLE_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"PROMOTION_FEATURE\", \"".($values["promotion_feature"] ? $values["promotion_feature"] : PROMOTION_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"BLOG_FEATURE\", \"".($values["blog_feature"] ? $values["blog_feature"] : BLOG_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"ZIPCODE_PROXIMITY\", \"".($values["zipproximity_feature"] ? $values["zipproximity_feature"] : ZIPCODE_PROXIMITY)."\");".PHP_EOL;

            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "# FEATURES".PHP_EOL;
            $buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
            $buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
            $buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "define(\"CUSTOM_INVOICE_FEATURE\", \"".($values["custominvoice_feature"] ? $values["custominvoice_feature"] : CUSTOM_INVOICE_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"CLAIM_FEATURE\", \"".($values["claim_feature"] ? $values["claim_feature"] : CLAIM_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"LISTINGTEMPLATE_FEATURE\", \"".($values["listingtemplate_feature"] ? $values["listingtemplate_feature"] : LISTINGTEMPLATE_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"MOBILE_FEATURE\", \"".($values["mobile_feature"] ? $values["mobile_feature"] : MOBILE_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"MULTILANGUAGE_FEATURE\", \"".($values["multilanguage_feature"] ? $values["multilanguage_feature"] : MULTILANGUAGE_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"MAINTENANCE_FEATURE\", \"".($values["maintenance_feature"] ? $values["maintenance_feature"] : MAINTENANCE_FEATURE)."\");".PHP_EOL;
            $buffer .= "define(\"API_FEATURE\", \"".($values["api_feature"] ? $values["api_feature"] : defined(API_FEATURE) ? API_FEATURE : "on")."\");".PHP_EOL;

            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "# EXTRA FEATURES".PHP_EOL;
            $buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
            $buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
            $buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "define(\"SITEMAP_FEATURE\", \"".($values["sitemap_feature"] ? $values["sitemap_feature"] : SITEMAP_FEATURE)."\");".PHP_EOL;

            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "# CUSTOMIZATIONS".PHP_EOL;
            $buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
            $buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "define(\"BRANDED_PRINT\", \"".($values["branded_print"] ? $values["branded_print"] : BRANDED_PRINT)."\");".PHP_EOL;

            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "# PAYMENT SYSTEM FEATURE".PHP_EOL;
            $buffer .= "# NOTE: Do not alter this area of the code manually.".PHP_EOL;
            $buffer .= "# Any changes will require eDirectory to be activated again.".PHP_EOL;
            $buffer .= "# P.S.: you can turn off it any time.".PHP_EOL;
            $buffer .= "# ****************************************************************************************************".PHP_EOL;
            $buffer .= "define(\"PAYMENTSYSTEM_FEATURE\", \"".($values["paymentsystem_feature"] ? $values["paymentsystem_feature"] : PAYMENTSYSTEM_FEATURE)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# EDIRECTORY TITLE".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"EDIRECTORY_TITLE\", \"".($values["name"] ? $values["name"] : EDIRECTORY_TITLE)."\");".PHP_EOL;

			$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
			$buffer .= "# DATE/TIME SETTINGS".PHP_EOL;
			$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
			$buffer .= "define(\"DEFAULT_DATE_FORMAT\", \"".($values["date_format"] ? $values["date_format"] : DEFAULT_DATE_FORMAT)."\");".PHP_EOL;
			$buffer .= "define(\"CLOCK_TYPE\", \"".($values["clock_type"] ? $values["clock_type"] : CLOCK_TYPE)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# GALLERY IMAGES".PHP_EOL;
            $buffer .= "#  - You can force all jpg images to be saved as png for better quality by turning on the constant FORCE_SAVE_JPG_AS_PNG.".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"FORCE_SAVE_JPG_AS_PNG\", \"".($values["jpg_as_png"] ? $values["jpg_as_png"] : FORCE_SAVE_JPG_AS_PNG)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# RESIZE IMAGES AFTER UPGRADE".PHP_EOL;
            $buffer .= "#  on (DEFAULT) - all images will be stretched to fit the new dimensions".PHP_EOL;
            $buffer .= "#  off - all images will keep the same size, but the layout can be affected".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"RESIZE_IMAGES_UPGRADE\", \"".($values["resize_images"] ? $values["resize_images"] : RESIZE_IMAGES_UPGRADE)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# SITEMAP LINKS".PHP_EOL;
            $buffer .= "#  - Turn on to add \"www\" to sitemap links.".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"SITEMAP_ADD_WWW\", \"".($values["sitemap_www"] ? $values["sitemap_www"] : SITEMAP_ADD_WWW)."\");".PHP_EOL;
            $buffer .= "#  - Turn on to force https to sitemap links.".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"SITEMAP_FORCEHTTPS\", \"".($values["sitemap_forcehttps"] ? $values["sitemap_forcehttps"] : SITEMAP_FORCEHTTPS)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# MODULES ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_LISTING_MODULE\", \"".($values["alias_listing_module"] ? $values["alias_listing_module"] : ALIAS_LISTING_MODULE)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_PROMOTION_MODULE\", \"".($values["alias_promotion_module"] ? $values["alias_promotion_module"] : ALIAS_PROMOTION_MODULE)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_EVENT_MODULE\", \"".($values["alias_event_module"] ? $values["alias_event_module"] : ALIAS_EVENT_MODULE)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_ARTICLE_MODULE\", \"".($values["alias_article_module"] ? $values["alias_article_module"] : ALIAS_ARTICLE_MODULE)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_CLASSIFIED_MODULE\", \"".($values["alias_classified_module"] ? $values["alias_classified_module"] : ALIAS_CLASSIFIED_MODULE)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_BLOG_MODULE\", \"".($values["alias_blog_module"] ? $values["alias_blog_module"] : ALIAS_BLOG_MODULE)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# CLAIM ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_CLAIM_URL_DIVISOR\", \"".($values["alias_claim_url_divisor"] ? $values["alias_claim_url_divisor"] : ALIAS_CLAIM_URL_DIVISOR)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# REVIEWS ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_REVIEW_URL_DIVISOR\", \"".($values["alias_review_url_divisor"] ? $values["alias_review_url_divisor"] : ALIAS_REVIEW_URL_DIVISOR)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# ALL CATEGORIES PAGE ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR\", \"".($values["alias_listing_allcategories_url_divisor"] ? $values["alias_listing_allcategories_url_divisor"] : ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_EVENT_ALLCATEGORIES_URL_DIVISOR\", \"".($values["alias_event_allcategories_url_divisor"] ? $values["alias_event_allcategories_url_divisor"] : ALIAS_EVENT_ALLCATEGORIES_URL_DIVISOR)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_ARTICLE_ALLCATEGORIES_URL_DIVISOR\", \"".($values["alias_article_allcategories_url_divisor"] ? $values["alias_article_allcategories_url_divisor"] : ALIAS_ARTICLE_ALLCATEGORIES_URL_DIVISOR)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_CLASSIFIED_ALLCATEGORIES_URL_DIVISOR\", \"".($values["alias_classified_allcategories_url_divisor"] ? $values["alias_classified_allcategories_url_divisor"] : ALIAS_CLASSIFIED_ALLCATEGORIES_URL_DIVISOR)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_PROMOTION_ALLCATEGORIES_URL_DIVISOR\", \"".($values["alias_promotion_allcategories_url_divisor"] ? $values["alias_promotion_allcategories_url_divisor"] : ALIAS_PROMOTION_ALLCATEGORIES_URL_DIVISOR)."\");".PHP_EOL;
            $buffer .= "define(\"ALIAS_BLOG_ALLCATEGORIES_URL_DIVISOR\", \"".($values["alias_blog_allcategories_url_divisor"] ? $values["alias_blog_allcategories_url_divisor"] : ALIAS_BLOG_ALLCATEGORIES_URL_DIVISOR)."\");".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# ALL LOCATIONS PAGE ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_ALLLOCATIONS_URL_DIVISOR\", \"".($values["alias_alllocations_url_divisor"] ? $values["alias_alllocations_url_divisor"] : ALIAS_ALLLOCATIONS_URL_DIVISOR)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# ADVERTISE ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_ADVERTISE_URL_DIVISOR\", \"".($values["alias_advertise_url_divisor"] ? $values["alias_advertise_url_divisor"] : ALIAS_ADVERTISE_URL_DIVISOR)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# CONTACTUS ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_CONTACTUS_URL_DIVISOR\", \"".($values["alias_contactus_url_divisor"] ? $values["alias_contactus_url_divisor"] : ALIAS_CONTACTUS_URL_DIVISOR)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# FAQ ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_FAQ_URL_DIVISOR\", \"".($values["alias_faq_url_divisor"] ? $values["alias_faq_url_divisor"] : ALIAS_FAQ_URL_DIVISOR)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# SITEMAP ALIAS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"ALIAS_SITEMAP_URL_DIVISOR\", \"".($values["alias_sitemap_url_divisor"] ? $values["alias_sitemap_url_divisor"] : ALIAS_SITEMAP_URL_DIVISOR)."\");".PHP_EOL;

			$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
			$buffer .= "# TERMS OF USE".PHP_EOL;
			$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
			$buffer .= "define(\"ALIAS_TERMS_URL_DIVISOR\", \"".($values["alias_terms_url_divisor"] ? $values["alias_terms_url_divisor"] : ALIAS_TERMS_URL_DIVISOR)."\");".PHP_EOL;

			$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
			$buffer .= "# PRIVACY POLICE".PHP_EOL;
			$buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
			$buffer .= "define(\"ALIAS_PRIVACY_URL_DIVISOR\", \"".($values["alias_privacy_url_divisor"] ? $values["alias_privacy_url_divisor"] : ALIAS_PRIVACY_URL_DIVISOR)."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# MODULES URLS".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "define(\"LISTING_FEATURE_NAME\", \"".LISTING_FEATURE_NAME."\");".PHP_EOL;
            $buffer .= "define(\"LISTING_FEATURE_NAME_PLURAL\", LISTING_FEATURE_NAME.\"s\");".PHP_EOL;
            $buffer .= "define(\"LISTING_DEFAULT_URL\", DEFAULT_URL.\"/\".ALIAS_LISTING_MODULE);".PHP_EOL.PHP_EOL;

            $buffer .= "define(\"PROMOTION_FEATURE_NAME\", \"".PROMOTION_FEATURE_NAME."\");".PHP_EOL;
            $buffer .= "define(\"PROMOTION_FEATURE_NAME_PLURAL\", PROMOTION_FEATURE_NAME.\"s\");".PHP_EOL;
            $buffer .= "define(\"PROMOTION_DEFAULT_URL\", DEFAULT_URL.\"/\".ALIAS_PROMOTION_MODULE);".PHP_EOL.PHP_EOL;

            $buffer .= "define(\"EVENT_FEATURE_NAME\", \"".EVENT_FEATURE_NAME."\");".PHP_EOL;
            $buffer .= "define(\"EVENT_FEATURE_NAME_PLURAL\", EVENT_FEATURE_NAME.\"s\");".PHP_EOL;
            $buffer .= "define(\"EVENT_DEFAULT_URL\", DEFAULT_URL.\"/\".ALIAS_EVENT_MODULE);".PHP_EOL.PHP_EOL;

            $buffer .= "define(\"CLASSIFIED_FEATURE_NAME\", \"".CLASSIFIED_FEATURE_NAME."\");".PHP_EOL;
            $buffer .= "define(\"CLASSIFIED_FEATURE_NAME_PLURAL\", CLASSIFIED_FEATURE_NAME.\"s\");".PHP_EOL;
            $buffer .= "define(\"CLASSIFIED_DEFAULT_URL\", DEFAULT_URL.\"/\".ALIAS_CLASSIFIED_MODULE);".PHP_EOL.PHP_EOL;

            $buffer .= "define(\"ARTICLE_FEATURE_NAME\", \"".ARTICLE_FEATURE_NAME."\");".PHP_EOL;
            $buffer .= "define(\"ARTICLE_FEATURE_NAME_PLURAL\", ARTICLE_FEATURE_NAME.\"s\");".PHP_EOL;
            $buffer .= "define(\"ARTICLE_DEFAULT_URL\", DEFAULT_URL.\"/\".ALIAS_ARTICLE_MODULE);".PHP_EOL.PHP_EOL;

            $buffer .= "define(\"BLOG_FEATURE_NAME\", \"".BLOG_FEATURE_NAME."\");".PHP_EOL;
            $buffer .= "define(\"BLOG_FEATURE_NAME_PLURAL\", BLOG_FEATURE_NAME.\"\");".PHP_EOL;
            $buffer .= "define(\"BLOG_DEFAULT_URL\", DEFAULT_URL.\"/\".ALIAS_BLOG_MODULE);".PHP_EOL.PHP_EOL;

            $buffer .= "define(\"BANNER_FEATURE_NAME\", \"".BANNER_FEATURE_NAME."\");".PHP_EOL;
            $buffer .= "define(\"BANNER_FEATURE_NAME_PLURAL\", BANNER_FEATURE_NAME.\"s\");".PHP_EOL;

            $buffer .= "?>".PHP_EOL;

            fwrite($fileConst, $buffer, strlen($buffer));
            fclose($fileConst);
            return true;
        } else {
            return false;
        }
    }

    function system_writeScalabilityFile($filePath, $domain_id, $values) {

        if ($fileScal = fopen($filePath, "w+")) {
            $buffer = "";
            $buffer .= "<?".PHP_EOL;
            $buffer .= "/*==================================================================*\\".PHP_EOL;
            $buffer .= "######################################################################".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# This file may not be redistributed in whole or part.               #".PHP_EOL;
            $buffer .= "# eDirectory is licensed on a per-domain basis.                      #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #".PHP_EOL;
            $buffer .= "#                                                                    #".PHP_EOL;
            $buffer .= "# http://www.edirectory.com | http://www.edirectory.com/license.html #".PHP_EOL;
            $buffer .= "######################################################################".PHP_EOL;
            $buffer .= "\*==================================================================*/".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# * FILE: /custom/domain_$domain_id/conf/scalability.inc.php".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# FLAGS - on/off".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 100.000 listings and/or more than 50.000 listings on the highest level".PHP_EOL;
            $buffer .= "define(\"LISTING_SCALABILITY_OPTIMIZATION\", \"".$values["listing_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 50.000 promotions".PHP_EOL;
            $buffer .= "define(\"PROMOTION_SCALABILITY_OPTIMIZATION\", \"".$values["promotion_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 100.000 events and/or more than 50.000 events on the highest level".PHP_EOL;
            $buffer .= "define(\"EVENT_SCALABILITY_OPTIMIZATION\", \"".$values["event_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 50.000 banners".PHP_EOL;
            $buffer .= "define(\"BANNER_SCALABILITY_OPTIMIZATION\", \"".$values["banner_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 100.000 classifieds and/or more than 50.000 classifieds on the highest level".PHP_EOL;
            $buffer .= "define(\"CLASSIFIED_SCALABILITY_OPTIMIZATION\", \"".$values["classified_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 100.000 articles and/or more than 50.000 articles on the highest level".PHP_EOL;
            $buffer .= "define(\"ARTICLE_SCALABILITY_OPTIMIZATION\", \"".$values["article_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 100.000 posts".PHP_EOL;
            $buffer .= "define(\"BLOG_SCALABILITY_OPTIMIZATION\", \"".$values["blog_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 20 main listing categories".PHP_EOL;
            $buffer .= "define(\"LISTINGCATEGORY_SCALABILITY_OPTIMIZATION\", \"".$values["listingcateg_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 20 main event categories".PHP_EOL;
            $buffer .= "define(\"EVENTCATEGORY_SCALABILITY_OPTIMIZATION\", \"".$values["eventcateg_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 20 main classified categories".PHP_EOL;
            $buffer .= "define(\"CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION\", \"".$values["classifiedcateg_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 20 main article categories".PHP_EOL;
            $buffer .= "define(\"ARTICLECATEGORY_SCALABILITY_OPTIMIZATION\", \"".$values["articlecateg_scalability"]."\");".PHP_EOL;

            $buffer .= "// suggestion: turn on if edirectory has more than 20 main blog categories".PHP_EOL;
            $buffer .= "define(\"BLOGCATEGORY_SCALABILITY_OPTIMIZATION\", \"".$values["blogcateg_scalability"]."\");".PHP_EOL;

            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "# AUTOMATIC FEATURES".PHP_EOL;
            $buffer .= "# ----------------------------------------------------------------------------------------------------".PHP_EOL;
            $buffer .= "// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)".PHP_EOL;
            $buffer .= "if ((LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == \"on\") || (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == \"on\") || (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == \"on\") || (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == \"on\") || (BLOGCATEGORY_SCALABILITY_OPTIMIZATION == \"on\")) {".PHP_EOL;
            $buffer .= "	define(\"CATEGORY_SCALABILITY_OPTIMIZATION\", \"on\");".PHP_EOL;
            $buffer .= "} else {".PHP_EOL;
            $buffer .= "	define(\"CATEGORY_SCALABILITY_OPTIMIZATION\", \"off\");".PHP_EOL;
            $buffer .= "}".PHP_EOL;
            $buffer .= "// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)".PHP_EOL;
            $buffer .= "?>".PHP_EOL;

            fwrite($fileScal, $buffer, strlen($buffer));
            fclose($fileScal);
            return true;
        } else {
            return false;
        }

    }

    function system_getItemAddressString($item = "Listing", $item_id) {
        $itemObj = new $item($item_id);
        $locationsToshow = system_retrieveLocationsToShow();
        $item_location = "";
        $locationsParam = system_formatLocation($locationsToshow.", z");
        $item_location = $itemObj->getLocationString($locationsParam, true);

    $locationArray = [];
        if ($itemObj->getString("address")) {
            $locationArray[] = $itemObj->getString("address");
        }
        if ($itemObj->getString("address2")) {
            $locationArray[] = $itemObj->getString("address2");
        }
        if ($item_location) {
            $locationArray[] = $item_location;
        }
        if (is_array($locationArray)) {
            $item_location = implode(", ", $locationArray);
        } else {
            $item_location = "";
        }

        return $item_location;
    }

    function system_getImageFromGallery($module, $id){

    $availableModules = [];
        $availableModules[] = "listing";
        $availableModules[] = "event";
        $availableModules[] = "classified";
        $availableModules[] = "article";

        if (in_array($module, $availableModules)) {

            $moduleStr = ucfirst($module);
            $moduleObj = new $moduleStr($id);
            $galleries = $moduleObj->getGalleries();
            if (is_array($galleries)) {

                $galleryObj = new Gallery();

                for ($i = 0; $i < count($galleries); $i++) {

                    unset($images);
                    $images = $galleryObj->getAllImages($galleries[$i]);

                    if (is_array($images)) {
                        for ($j = 0; $j < count($images); $j++) {

                            unset($imageObj);
                            $imageObj = new Image($images[$j]["image_id"]);
                            if ($imageObj->imageExists()) {
                                return $imageObj->getPath();
                            }
                        }
                    }
                }
            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    function system_getUserActivities($type, $accId) {

    $activities = [];

        if ($type == "favorites") {

            $hasItens = false;
            $quicklistObj = new Quicklist();
            $idsA = $quicklistObj->getQuicklist("article", $accId);
            $idsC = $quicklistObj->getQuicklist("classified", $accId);
            $idsE = $quicklistObj->getQuicklist("event", $accId);
            $ids = $quicklistObj->getQuicklist("listing", $accId);

            //Listing
            if ($ids) {
                $hasItens = true;
                $sql = "SELECT id FROM Listing WHERE id IN (".$ids.") AND status = 'A' ORDER BY level, title";
                $listings = db_getFromDBBySQL("listing", $sql, "array");
            }

            //Classified
            if ($idsC && CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
                $hasItens = true;
                $sql = "SELECT id FROM Classified WHERE id IN (".$idsC.") AND status = 'A' ORDER BY level, title";
                $classifieds = db_getFromDBBySQL("classified", $sql, "array");
            }

            //Event
            if ($idsE && EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
                $hasItens = true;
                $sql = "SELECT id FROM Event WHERE id IN (".$idsE.") AND status = 'A' ORDER BY level, title";
                $events = db_getFromDBBySQL("event", $sql, "array");
            }

            //Article
            if ($idsA && ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
                $hasItens = true;
                $sql = "SELECT id FROM Article WHERE id IN (".$idsA.") AND status = 'A' ORDER BY level";
                $articles = db_getFromDBBySQL("article", $sql, "array");
            }

            if ($hasItens) {
            $activities = [
                "listing"    => $listings,
                "event"      => $events,
                "classified" => $classifieds,
                "article"    => $articles,
            ];
            }

        } else {
            return false;
        }

        return $activities;

    }

    function system_getLikeDislikeButton($like_ips, $dislike_ips, $id, $like, $dislike, $divName = "ratings_", $user = true) {

        //LIKE & DISLIKE
        $likeStr = "";

        $iconLikeClass = "icon-thumbs-up";
        $iconDislikeClass = "icon-thumbs-down";

        $arrayIP = explode(",", $like_ips);
        $arrayIP2 = explode(",", $dislike_ips);

        if ($like_ips && in_array("||".$_SERVER["REMOTE_ADDR"]."||", $arrayIP)) {
            $buttonLikeClass = "active";
        } else {
            $buttonLikeClass = "";
        }

        if ($dislike_ips && in_array("||".$_SERVER["REMOTE_ADDR"]."||", $arrayIP2)) {
            $buttonDislikeClass = "active";
        } else {
            $buttonDislikeClass = "";
        }

        $totalLikes = $like - $dislike;


        $likeStr .= "
                    <button class=\"btn $buttonLikeClass\" ".($user ? "onclick=\"rateReview($id, 'like', '$divName')\"" : "style=\"cursor:default;\"")."><i class=\"$iconLikeClass\"></i></button>
                    <button class=\"btn $buttonDislikeClass\" ".($user ? "onclick=\"rateReview($id, 'dislike', '$divName')\"" : "style=\"cursor:default;\"")."><i class=\"$iconDislikeClass\"></i></button>
                    <span class=\"number\">".($totalLikes > 0 ? "+ " : ($totalLikes == 0 ? " " : ""))."$totalLikes</span>
                    ";

        return $likeStr;

    }

    function system_showListingPrice($price) {
        setting_get("listing_price_{$price}_from", ${"listing_price_".$price."_from"});
        setting_get("listing_price_{$price}_to", ${"listing_price_".$price."_to"});

        $labelPrice = ${"listing_price_".$price."_from"};
        if (${"listing_price_".$price."_to"}) {
            $labelPrice .= " - ".${"listing_price_".$price."_to"};
        } else {
            $labelPrice .= " +";
        }
        return $labelPrice;

    }

    function system_buildCategoriesFilter($categories, $arrayTotal, $get_categories, $filterLinkCategories, $postCategs, $subCateg = false, $category_id = 0, $module = "", $app = false, $arrayGet = "") {

    $filterApp = [];

        if ($module == LISTING_FEATURE_FOLDER) {

            $maxCategory = LISTING_CATEGORY_LEVEL_AMOUNT;
            $mobuleTable = "ListingCategory";

            $catObj = new ListingCategory();
        $categoriesXml = $catObj->getAllCategoriesHierarchyXML(null, $category_id, implode(",", $categories));

        } elseif ($module == PROMOTION_FEATURE_FOLDER) {

            $maxCategory = LISTING_CATEGORY_LEVEL_AMOUNT;
            $mobuleTable = "ListingCategory";

            $catObj = new ListingCategory();
        $categoriesXml = $catObj->getAllCategoriesHierarchyXML(null, $category_id, implode(",", $categories));

        } elseif ($module == EVENT_FEATURE_FOLDER || $module == CLASSIFIED_FEATURE_FOLDER || $module == ARTICLE_FEATURE_FOLDER) {

            $dbObj = db_getDBObject();
            $maxCategory = CATEGORY_LEVEL_AMOUNT;

            if ($module == EVENT_FEATURE_FOLDER) {
                $mobuleTable = "EventCategory";
            } elseif ($module == CLASSIFIED_FEATURE_FOLDER) {
                $mobuleTable = "ClassifiedCategory";
            } elseif ($module == ARTICLE_FEATURE_FOLDER) {
                $mobuleTable = "ArticleCategory";
            }

            $getSubCat = true;

            $sql_categories = "SELECT id, title FROM $mobuleTable WHERE category_id = ".(db_formatNumber($category_id))." AND id IN (".implode(",", $categories).") AND title <> '' AND enabled = 'y' ORDER BY title";
            $categoriesXml = system_generateXML("categories", $sql_categories, SELECTED_DOMAIN_ID);

        }

        if ($categoriesXml) {

            if (is_array($postCategs) && !$subCateg) {
                $return .= "<li id=\"postCats\" style=\"display:none;\">";

                foreach ($postCategs as $key => $value) {
                    if ($key != "screen" && $key != "letter" && $key != "filter_item" && $key != "search_lock") {
                        $return .= "\n<input type=\"hidden\" name=\"$key\" value=\"".htmlspecialchars($value)."\" />";
                    }
                }
                if ($get_categories) {
                    $return .= "<input type=\"hidden\" name=\"categories\" value=\"".htmlspecialchars($get_categories)."\" />";
                }

                $return .= "</li>";
            }

        $categsArray = [];
            if ($get_categories) {
                $categsArray = explode("-", $get_categories);
            }

            $xml_categories = simplexml_load_string($categoriesXml);

            if (count($xml_categories->info) > 0) {

                for ($i = 0; $i < count($xml_categories->info); $i++) {

                    unset($categoriesXml);
                    foreach ($xml_categories->info[$i]->children() as $key => $value) {
                        $categoriesXml[$key] = $value;
                    }

                    if ($categoriesXml) {

                        if ($getSubCat) {
                            $addSubCat = false;
                            $sql = "SELECT id FROM $mobuleTable WHERE category_id =".$categoriesXml["id"]." AND title <> '' AND enabled = 'y'";
                            $result = $dbObj->query($sql);
                            if (mysql_num_rows($result) > 0) {
                                $addSubCat = true;
                            }
                        }

                        $thisLink = system_prepareFilterUrl($arrayGet, $filterLinkCategories, "categories", (float)$categoriesXml["id"]);

                        if ((($categoriesXml["children"] > 0) && (($categoriesXml["level"] + 1) < $maxCategory)) || $addSubCat) {

                            if ($app) {

                                $filterApp[$i]["children"] = true;
                                $filterApp[$i]["value"] = (float)$categoriesXml["id"];
                                $filterApp[$i]["label"] = (string)$categoriesXml["title"];

                            } else {

                                $return .= "<li ".(in_array($categoriesXml["id"], $categsArray) ? "class=\"active\"" : "").">

                                    <a href=\"javascript:void(0);\" onclick=\"filter_loadCategory('{$module}_', '{$mobuleTable}', ".$categoriesXml["id"].", '$module');\" class=\"icon-caret-right\" id=\"{$module}_opencategorytree_id_".$categoriesXml["id"]."\"></a>
                                    <a href=\"javascript:void(0);\" onclick=\"filter_closeCategory('{$module}_', ".$categoriesXml["id"].");\" class=\"icon-caret-down\" id=\"{$module}_closecategorytree_id_".$categoriesXml["id"]."\" style=\"display: none;\"></a>

                                    <a class=\"filter-listitem\" rel=\"nofollow\" href=\"".$thisLink."\">".$categoriesXml["title"]."</a>

                                                \n

                                                <ul class=\"child\" id=\"{$module}_categorytree_id_".$categoriesXml["id"]."\" style=\"display: none;\"><li>&nbsp;</li></ul>

                                                \n
                                            </li>\n";
                            }

                        } else {

                            if ($app) {

                                $filterApp[$i]["children"] = false;
                                $filterApp[$i]["value"] = (float)$categoriesXml["id"];
                                $filterApp[$i]["label"] = (string)$categoriesXml["title"];

                            } else {

                                $return .= "<li ".(in_array($categoriesXml["id"], $categsArray) ? "class=\"active\"" : "").">
                                                <a class=\"filter-listitem\" rel=\"nofollow\" href=\"".$thisLink."\">".$categoriesXml["title"]."</a>
                                            </li>";

                            }
                        }
                    }
                }
            }
        } else {
            $return = "<li>".system_showText(LANG_CATEGORY_NOTFOUND)."</li>";
        }
        if ($app) {
            return $filterApp;
        } else {
            return $return;
        }
    }

    function system_loadFiltersStr($module = "") {

        //Load Categories
        $strOpen = "";
        $categories = $_GET["categories"];

        if (!$categories && $_GET["category_id"]) {
            $categories = $_GET["category_id"];
        }

        if ($categories) {

            if ($module == LISTING_FEATURE_FOLDER || $module == PROMOTION_FEATURE_FOLDER) {
                $tableName = "ListingCategory";
            } elseif ($module == EVENT_FEATURE_FOLDER) {
                $tableName = "EventCategory";
            } elseif ($module == CLASSIFIED_FEATURE_FOLDER) {
                $tableName = "ClassifiedCategory";
            } elseif ($module == ARTICLE_FEATURE_FOLDER) {
                $tableName = "ArticleCategory";
            }

            $categs = explode("-", $categories);
        $arrayOpen = [];
            foreach ($categs as $categ) {

                if ($tableName == "ListingCategory") {

                    $catObj = new ListingCategory();
                    $catHier = $catObj->getHierarchy($categ, true, false);
                    $categories = explode(",", $catHier);
                    foreach ($categories as $cat) {
                        if ($cat != $categ && !in_array($cat, $arrayOpen)) {
                            $arrayOpen[] = $cat;
                            $strOpen .= "filter_openCateg('{$module}_', '$tableName', $cat, '$module');\n";
                        }
                    }

                } else {

                    $catObj = new $tableName($categ);
                    $catHier = $catObj->getFullPath();

                    if (is_array($catHier)) {

                        foreach ($catHier as $cat) {
                            if ($cat["id"] != $categ) {
                                $strOpen .= "filter_openCateg('{$module}_', '$tableName', ".$cat["id"].", '$module');\n";
                            }
                        }

                    }

                }
            }
        }

        return $strOpen;
    }

    function system_prepareFilterUrl($array, $filterLink, $filter_type, $item_id) {

        if (isset($array[$filter_type])) {
            $auxStr = $filter_type."=".$array[$filter_type];

            $arrayInfo = explode("-", $array[$filter_type]);
        $newInfo = [];

            foreach ($arrayInfo as $info) {

                if ($info != $item_id) {
                    $newInfo[] = $info;
                }

            }
            if (!in_array($item_id, $arrayInfo)) {
                $newInfo[] = $item_id;
            }

            $newStr = "";
            if (count($newInfo)) {
                $newStr = $filter_type."=".implode("-", $newInfo);
            }

            $thisLink = str_replace($auxStr, $newStr, $filterLink);
        } else {
            $thisLink = $filterLink."&amp;".$filter_type."=".$item_id;
        }

        return $thisLink;

    }

    function system_prepareRichSnippet($type = "address", $item = "") {

        if ($type == "address") {
        $snippet = [];
            if ($item->getNumber("location_1")) {
                $location1 = new Location1($item->getNumber("location_1"));
                $snippet["addressCountry"] = $location1->getString("abbreviation");
            }
            if ($item->getNumber("location_3")) {
                $location3 = new Location3($item->getNumber("location_3"));
                $snippet["addressRegion"] = $location3->getString("abbreviation");
            }
            if ($item->getNumber("location_4")) {
                $location4 = new Location4($item->getNumber("location_4"));
                $snippet["addressLocality"] = $location4->getString("name");
            }
            if ($item->getNumber("zip_code")) {
                $snippet["postalCode"] = $item->getString("zip_code");
            }
            return $snippet;
        }

        return false;
    }

    function system_gamefyItems($item_type, $itemObj) {

        /*
         * Sponsor dashboard offers a gamification structure to engage sponsors to complete their items.
         * It's divided in three areas:
         * - Description: main information, such as summary and long description, email, phone, location information, etc.
         * - Media: images and video
         * - Additional: extra information, such as additional file, features, facebook page, fax, URL, etc.
         */

        //This array stores all available fields according to the item's level
        if ($item_type != "article" && $item_type != "promotion") {
            $array_fields = system_getFormFields(ucfirst($item_type), $itemObj->getNumber("level"));
        }

        //This array stores all fields that belong to the group "Description"
    $arrayDescription = [];

        //This array stores all fields that belong to the group "Additional"
    $arrayAdditional = [];

        //This array stores all fields that belong to the group "Media"
    $arrayMedia = [];

        //This array stores all fields FILLED on the item that belong to the group "Description"
    $descriptionFilled = [];

        //This array stores all fields FILLED on the item that belong to the group "Additional"
    $additionalFilled = [];

        //This array stores all fields FILLED on the item that belong to the group "Media"
    $mediaFilled = [];

        //Auxiliary variable to check if there are locations enabled. Will be used later to fill in $arrayDescription
        $_non_default_locations = "";
        $_default_locations_info = "";
        if (EDIR_DEFAULT_LOCATIONS) {
            system_retrieveLocationsInfo($_non_default_locations, $_default_locations_info);
        } else {
            $_non_default_locations = explode(",", EDIR_LOCATIONS);
        }

        //The code below will fill in arrays $arrayDescription, $arrayAdditional and $arrayMedia according to the fields available for each level.
        if (is_array($array_fields)) {

            if (in_array("summary_description", $array_fields)) {
                $arrayDescription[] = ($item_type == "classified" ? "summarydesc" : "description");
            }

            if (in_array("long_description", $array_fields)) {
                $arrayDescription[] = ($item_type == "classified" ? "detaildesc" : "long_description");
            }

            if (in_array("email", $array_fields)) {
                $arrayDescription[] = "email";
            }

            if (in_array("phone", $array_fields)) {
                $arrayDescription[] = "phone";
            }

            if (in_array("locations", $array_fields)) {
                $arrayDescription[] = "locations";
            }

            if (in_array("contact_name", $array_fields)) {
                $arrayDescription[] = ($item_type == "classified" ? "contactname" : "contact_name");
            }

            if (in_array("contact_phone", $array_fields)) {
                $arrayDescription[] = "phone";
            }

            if (in_array("contact_email", $array_fields)) {
                $arrayAdditional[] = "email";
            }

            if (in_array("price", $array_fields)) {
                if ($item_type == "classified") {
                    $arrayDescription[] = "classified_price";
                } else {
                    $arrayAdditional[] = "price";
                }
            }

            if (in_array("fbpage", $array_fields)) {
                $arrayAdditional[] = "facebook_page";
            }

            if (in_array("hours_of_work", $array_fields)) {
                $arrayAdditional[] = "hours_work";
            }

            if (in_array("attachment_file", $array_fields)) {
                $arrayAdditional[] = "attachment_file";
            }

            if (in_array("features", $array_fields)) {
                $arrayAdditional[] = "features";
            }

            if (in_array("fax", $array_fields)) {
                $arrayAdditional[] = "fax";
            }

            if (in_array("url", $array_fields)) {
                $arrayAdditional[] = "url";
            }

            if (in_array("start_time", $array_fields)) {
                $arrayAdditional[] = "start_time";
            }

            if (in_array("end_time", $array_fields)) {
                $arrayAdditional[] = "end_time";
            }

            if (in_array("video", $array_fields)) {
                $arrayMedia[] = "video_snippet";
            }

            if (in_array("main_image", $array_fields)) {
                $arrayMedia[] = "image";
            }

        }

        //The code below will fill in arrays $arrayDescription, $arrayAdditional and $arrayMedia with others fields, regardless of the level.

        if ($item_type != "promotion") {
            $arrayDescription[] = "title";
        } else {
            $arrayDescription[] = "name";
        }

        if ($item_type != "article" && $item_type != "promotion") {
            $arrayDescription[] = "address";
            $arrayDescription[] = "zip_code";
            if ($_non_default_locations) {
                $arrayDescription[] = "location_info";
            }
            if ($item_type == "event") {
                $arrayDescription[] = "location";
            }
        } elseif ($item_type == "article") {
            $arrayDescription[] = "content";
            $arrayDescription[] = "author";
            $arrayAdditional[] = "author_url";
            $arrayMedia[] = "image";
        } elseif ($item_type == "promotion") {
            $arrayDescription[] = "description";
            $arrayDescription[] = "long_description";
            $arrayDescription[] = "conditions";
            $arrayMedia[] = "image";
        }
        $arrayAdditional[] = "keywords";

        if ($item_type != "listing" && $item_type != "promotion") {
            $arrayAdditional[] = "category";
        }

        //The code below checks the information already saved on the item to fill in arrays $descriptionFilled
        foreach ($arrayDescription as $desc) {

            if ($desc == "location_info") {
                if (
                    $itemObj->getString("location_1") ||
                    $itemObj->getString("location_2") ||
                    $itemObj->getString("location_3") ||
                    $itemObj->getString("location_4") ||
                    $itemObj->getString("location_5")
                    ) {
                    $descriptionFilled[] = $desc;
                }
            } elseif ($desc == "classified_price") {
                if ($itemObj->getString($desc) != "NULL") {
                    $descriptionFilled[] = $desc;
                }
            } else {
                if ($itemObj->getString($desc)) {
                    $descriptionFilled[] = $desc;
                }
            }

        }

        //The code below checks the information already saved on the item to fill in arrays $additionalFilled
        foreach ($arrayAdditional as $addit) {

            if ($addit == "category") {
                $categories = $itemObj->getCategories();
                if ($categories) {
                    $additionalFilled[] = $addit;
                }
            } elseif ($addit == "start_time" || $addit == "end_time") {
                if ($itemObj->getString($addit) != "00:00:00") {
                    $additionalFilled[] = $addit;
                }
            } elseif ($itemObj->getString($addit)) {
                $additionalFilled[] = $addit;
            }

        }

        //The code below checks the information already saved on the item to fill in arrays $mediaFilled
        foreach ($arrayMedia as $media) {

            if ($media == "image") {

                if ($item_type == "promotion") {

                    if ($itemObj->getNumber("image_id")) {
                        $mediaFilled[] = $media;
                    }

                } else {

                    $galleries = $itemObj->getGalleries();

                    if (is_array($galleries) && count($galleries) > 0) {

                        foreach ($galleries as $each_gallery) {

                            $galleryObj = new Gallery($each_gallery, SELECTED_DOMAIN_ID, true);

                            if ($galleryObj->getNumber("id") && $galleryObj->image && count($galleryObj->image) > 0) {
                                $mediaFilled[] = $media;
                                break;
                            }

                        }

                    }

                }


            } else {
                if ($itemObj->getString($media)) {
                    $mediaFilled[] = $media;
                }
            }

        }

        //Total fields available for the level
        $totalFields = count($arrayDescription) + count($arrayAdditional) + count($arrayMedia);
        //Total fields filled in for the item
        $totalFieldsFilled = count($descriptionFilled) + count($additionalFilled) + count($mediaFilled);

        //Main percentage
        if ($totalFields) {
            $percentageTotal = ($totalFieldsFilled * 100) / $totalFields;
        }

        //Percentage for group "Description"
        if (count($arrayDescription)) {
            $percentageDescription = (count($descriptionFilled) * 100) / count($arrayDescription);
        }

        //Percentage for group "Media"
        if (count($arrayMedia)) {
            $percentageMedia = (count($mediaFilled) * 100) / count($arrayMedia);
        }

        //Percentage for group "Additional"
        if (count($arrayAdditional)) {
            $percentageAdditional = (count($additionalFilled) * 100) / count($arrayAdditional);
        }

        $arrayReturn["total"] = ceil($percentageTotal);
        $arrayReturn["desc"] = isset($percentageDescription) ? ceil($percentageDescription) : false;
        $arrayReturn["media"] = isset($percentageMedia) ? ceil($percentageMedia) : false;
        $arrayReturn["additional"] = isset ($percentageAdditional) ? ceil($percentageAdditional) : false;

        if ($arrayReturn["desc"] < 100) {
            $arrayReturn["highlight"] = "desc";
        } elseif ($arrayReturn["media"] < 100) {
            $arrayReturn["highlight"] = "media";
        } elseif ($arrayReturn["additional"] < 100) {
            $arrayReturn["highlight"] = "additional";
        }

        return $arrayReturn;

    }

    function system_getHeaderLang() {
        if (string_strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS."/") !== false) {
            setting_get("sitemgr_language", $sitemgrLang);
            $headerLang = explode("_", $sitemgrLang);
        } else {
            $headerLang = explode("_", EDIR_LANGUAGE);
        }

        if ($headerLang[0] == "ge") {
            return "de";
        } else {
            return $headerLang[0];
        }
    }

    function system_getVideoURL($iframe) {
        // The Regular Expression filter to find the video URL
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

        // Check if there is a url in the text
        if (preg_match($reg_exUrl, $iframe, $url)) {
            $video_url = str_replace("'", "", $url[0]);
            $video_url = str_replace("\"", "", $video_url);
            $video_url = explode("&", $video_url);
            return $video_url[0];
        }
    }

    function system_fieldsGuide(&$arrayTutorial, &$counterTutorial, $field, $id) {
        switch ($id) {
            case "tour-contact":    $placement = "top";
                                    break;
            case "tour-additional": $placement = "top";
                                    break;
            case "tour-images":     $placement = "top";
                                    break;
            case "tour-image":     $placement = "left";
                                    break;
            case "tour-video":      $placement = "left";
                                    break;
            case "tour-file":       $placement = "left";
                                    break;
            case "tour-badges":     $placement = "left";
                                    break;
            default:                $placement = "right";
                                    break;
        }
        $arrayTutorial[$counterTutorial]["id"] = $id;
        $arrayTutorial[$counterTutorial]["field"] = $field;
        $arrayTutorial[$counterTutorial]["content"] = system_showText(constant("LANG_LABEL_TUTORIAL_".string_strtoupper($id)));
        $arrayTutorial[$counterTutorial]["placement"] = $placement;
        $counterTutorial++;
    }

	function system_showListingTypeDropdown(&$listingtemplate_id) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT id FROM ListingTemplate WHERE status = 'enabled' AND editable ='y'";
		$result = $dbObj->query($sql);
		if (mysql_num_rows($result) > 0) {
			return true;
		} else {
			$sql = "SELECT id FROM ListingTemplate WHERE status = 'enabled' AND editable ='n' LIMIT 1";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			$listingtemplate_id = $row["id"];
		}
		return false;

	}

    function system_getSQLFullTextSearch($searchfor, $fields, $order_by_fieldname, &$order_by_score, $force_specific_search="", &$order_by_score2, $order_by_fieldname2 = "") {

        $order_by_score = "";
        $order_by_score2 = "";
        unset($sql_aux);
        unset($searchfor_aux);
        unset($searchfor_array);
        if (($force_specific_search != "exactmatch") && ($force_specific_search != "anyword") && ($force_specific_search != "allwords")) {
            $force_specific_search = "";
        }
        if (!$force_specific_search) {
            setting_get("default_search_option", $force_specific_search);
        }
        if (!$force_specific_search) {
            $force_specific_search = "exactmatch";
        }

        $searchfor = trim($searchfor);

        $words_array = explode(" ", $searchfor);

        /*
         * Remove wrong spaces
         */
        unset($aux_words_array);
        for ($i = 0; $i < count($words_array); $i++) {
            if (strlen($words_array[$i]) > 0) {
                $aux_words_array[] = trim($words_array[$i]);
            }
        }

        if (count($aux_words_array) > 0) {
            unset($words_array);
            $words_array = $aux_words_array;
            $searchfor = implode(" ",$words_array);
        }

        $thesaurus = false;
        if (count($words_array) == 2) {
            $thesaurus = str_replace(" ", "", $searchfor);
        }

        $force_text_search = false;
        if (count($words_array) >= 2) {
            foreach ($words_array as $each_word) {
                if (string_strlen($each_word) <= 3) {
                    $force_text_search = true;
                    break;
                }
            }
        }

        $force_like = false;
        if (LISTING_SCALABILITY_OPTIMIZATION != "on") {
            foreach ($words_array as $each_searchfor) {
                if (string_strlen(Inflector::singularize($each_searchfor)) < (int)FT_MIN_WORD_LEN) {
                    $force_like = true;
                    break;
                }
            }
        }

        $auxWordsArray = explode("-", $searchfor);
        if (is_array($auxWordsArray) && $auxWordsArray[0]) {
            foreach ($auxWordsArray as $auxWord) {
                if (string_strlen(Inflector::singularize($auxWord)) < (int)FT_MIN_WORD_LEN) {
                    $force_like = true;
                    break;
                }
            }
        }

        if ($force_specific_search == "exactmatch") {

            $searchfor = db_formatString($searchfor);
            $searchfor = string_substr($searchfor, 1, string_strlen($searchfor)-2);

            if (string_strlen($searchfor) < (int)FT_MIN_WORD_LEN) {
                if ($searchfor == "'") $searchfor = "\'";
                foreach ($fields as $field) {
                    $sql_aux[] = "(".$field." = '$searchfor' OR ".$field." LIKE '$searchfor %' OR ".$field." LIKE '% $searchfor' OR ".$field." LIKE '% $searchfor %')";
                }

                return "(".(implode(" OR ", $sql_aux)).")";
            } else {
                foreach ($words_array as $each_searchfor) {
                    $searchfor_array[] = $each_searchfor;
                }

                $searchfor_array = array_unique($searchfor_array);
                $formated_searchfor = implode(" ", $searchfor_array);

                if (SEARCH_FORCE_BOOLEANMODE == "on") {
                    $auxFields = implode(", ", $fields);
                    if (string_strpos($auxFields, "Promotion") !== false) {
                        $auxFields = str_replace("fulltextsearch_keyword", "name", $auxFields);
                    } else {
                        $auxFields = str_replace("fulltextsearch_keyword", "title", $auxFields);
                    }
                    $order_by_score = "MATCH (".$auxFields.") AGAINST ('\"".addslashes($formated_searchfor)."\"' IN BOOLEAN MODE) as ".$order_by_fieldname;
                    $order_by_score2 = "MATCH (".implode(", ", $fields).") AGAINST ('\"".addslashes($formated_searchfor)."\"') as ".$order_by_fieldname2;
                } else {
                    $order_by_score = "MATCH (".implode(", ", $fields).") AGAINST ('\"".addslashes($formated_searchfor)."\"') as ".$order_by_fieldname;
                }

                return "MATCH (".implode(", ", $fields).") AGAINST ('\"".addslashes($formated_searchfor)."\"' IN BOOLEAN MODE)";
            }

        } elseif ((string_strlen($searchfor) < (int)FT_MIN_WORD_LEN || $force_like) && ($force_specific_search == "anyword" || !$force_specific_search)) {

            unset($searchfor_aux_array);
            foreach ($words_array as $each_searchfor) {
                $searchfor_aux = $each_searchfor;
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                $searchfor_array[] = $searchfor_aux;
            }

            unset($searchfor_aux_array);
            foreach ($words_array as $each_searchfor) {
                $searchfor_aux = Inflector::singularize($each_searchfor);
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                $searchfor_array[] = $searchfor_aux;
            }

            unset($searchfor_aux_array);
            foreach ($words_array as $each_searchfor) {
                $searchfor_aux = Inflector::pluralize($each_searchfor);
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                $searchfor_array[] = $searchfor_aux;
            }

            if ($thesaurus) {
                $searchfor_aux = $thesaurus;
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                $searchfor_array[] = $searchfor_aux;
            }

            $searchfor_array = array_unique($searchfor_array);

            $keyCheck = array_search("'",$searchfor_array);
            if ($keyCheck !== false) {
                $searchfor_array[$keyCheck] = "\'";
            }

            foreach ($searchfor_array as $each_searchfor) {
                foreach ($fields as $field) {
                    $sql_aux[] = $field." = '$each_searchfor'";
                    $sql_aux[] = $field." LIKE '$each_searchfor %'";
                    $sql_aux[] = $field." LIKE '% $each_searchfor'";
                    $sql_aux[] = $field." LIKE '% $each_searchfor %'";
                }
            }

            return "(".(implode(" OR ", $sql_aux)).")";

        } elseif ($force_specific_search == "anyword" || !$force_specific_search) {

            unset($searchfor_aux_array);
            foreach ($words_array as $each_searchfor) {
                $searchfor_aux_array[] = $each_searchfor;
            }
            $searchfor_aux = implode(" ", $searchfor_aux_array);

            $searchfor_aux_booleanMode = $searchfor_aux;

            $searchfor_aux = db_formatString($searchfor_aux);
            $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux) - 2);
            $searchfor_array[] = $searchfor_aux;

            unset($searchfor_aux_array);
            foreach ($words_array as $each_searchfor) {
                $searchfor_aux_array[] = Inflector::singularize($each_searchfor);
            }
            $searchfor_aux = implode(" ", $searchfor_aux_array);
            $searchfor_aux = db_formatString($searchfor_aux);
            $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux) - 2);
            $searchfor_array[] = $searchfor_aux;

            unset($searchfor_aux_array);
            foreach ($words_array as $each_searchfor) {
                $searchfor_aux_array[] = Inflector::pluralize($each_searchfor);
            }
            $searchfor_aux = implode(" ", $searchfor_aux_array);
            $searchfor_aux = db_formatString($searchfor_aux);
            $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux) - 2);
            $searchfor_array[] = $searchfor_aux;

            if ($thesaurus) {
                $searchfor_aux = $thesaurus;
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux) - 2);
                $searchfor_array[] = $searchfor_aux;
            }

            $searchfor_array = array_unique($searchfor_array);

            foreach ($searchfor_array as $each_searchfor) {
                $sql_aux[] = $each_searchfor;
            }

            $searchfor_array = array_unique($sql_aux);

            $formated_searchfor = db_formatString(implode(" ", $searchfor_array));
            if (SEARCH_FORCE_BOOLEANMODE == "on") {
                $auxFields = implode(", ", $fields);
                if (string_strpos($auxFields, "Promotion") !== false) {
                    $auxFields = str_replace("fulltextsearch_keyword", "name", $auxFields);
                } else {
                    $auxFields = str_replace("fulltextsearch_keyword", "title", $auxFields);
                }
                $order_by_score = "MATCH (".$auxFields.") AGAINST ('\"".addslashes($searchfor_aux_booleanMode)."\"' IN BOOLEAN MODE) as ".$order_by_fieldname;
                $order_by_score2 = "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor.") as ".$order_by_fieldname2;
            } else {
                $order_by_score = "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor.") as ".$order_by_fieldname;
            }

            return "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor." IN BOOLEAN MODE)";

        } elseif (($force_specific_search == "allwords")) {

            if ((string_strlen($searchfor) < (int)FT_MIN_WORD_LEN) || ($force_text_search) || $force_like) {

                foreach ($words_array as $each_searchfor) {
                    $searchfor_aux = $each_searchfor;
                    $searchfor_aux = db_formatString($searchfor_aux);
                    $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                    $searchfor_words[] = $searchfor_aux;
                }

                foreach ($words_array as $each_searchfor) {
                    $searchfor_aux = Inflector::singularize($each_searchfor);
                    $searchfor_aux = db_formatString($searchfor_aux);
                    $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                    $searchfor_singular[] = $searchfor_aux;
                }

                foreach ($words_array as $each_searchfor) {
                    $searchfor_aux = Inflector::pluralize($each_searchfor);
                    $searchfor_aux = db_formatString($searchfor_aux);
                    $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                    $searchfor_plural[] = $searchfor_aux;
                }

                unset($searchfor_aux_array);
                $searchfor_aux_array[] = implode(" ", $searchfor_words);
                $searchfor_aux_array[] = implode(" ", $searchfor_singular);
                $searchfor_aux_array[] = implode(" ", $searchfor_plural);

                $searchfor_aux_array = array_unique($searchfor_aux_array);

                foreach ($searchfor_aux_array as $searchword) {
                    $searchfor_array = array_merge((array)$searchfor_array, explode(" ", $searchword));
                }

                $keyCheck = array_search("'",$searchfor_array);
                if ($keyCheck !== false) {
                    $searchfor_array[$keyCheck] = "\'";
                }
                $count = count($words_array);

                foreach ($fields as $field) {
                    unset($sqlaux);
                    $i = 1;
                    $j = 0;
                    foreach ($searchfor_array as $each_searchfor) {
                        $sqlaux[$j][] = "(".$field." = '$each_searchfor' OR ".$field." LIKE '$each_searchfor %' OR ".$field." LIKE '% $each_searchfor' OR ".$field." LIKE '% $each_searchfor %')";

                        if ($i >= $count) {
                            $j++;
                            $i = 1;
                        } else {
                            $i++;
                        }
                    }

                    foreach ($sqlaux as $sql) {
                        $sql_aux[] = "(".(implode(" AND ", $sql)).")";
                    }
                }

                return "(".(implode(" OR ", $sql_aux)).")";

            } else {

                unset($searchfor_aux_array);
                foreach ($words_array as $each_searchfor) {
                    $searchfor_aux_array[] = "+".$each_searchfor;
                }
                $searchfor_aux = implode(" ", $searchfor_aux_array);
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                $searchfor_array[] = "(".$searchfor_aux.")";

                unset($searchfor_aux_array);
                foreach ($words_array as $each_searchfor) {
                    $searchfor_aux_array[] = "+".Inflector::singularize($each_searchfor);
                }
                $searchfor_aux = implode(" ", $searchfor_aux_array);
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                $searchfor_array[] = "(".$searchfor_aux.")";

                unset($searchfor_aux_array);
                foreach ($words_array as $each_searchfor) {
                    $searchfor_aux_array[] = "+".Inflector::pluralize($each_searchfor);
                }
                $searchfor_aux = implode(" ", $searchfor_aux_array);
                $searchfor_aux = db_formatString($searchfor_aux);
                $searchfor_aux = string_substr($searchfor_aux, 1, string_strlen($searchfor_aux)-2);
                $searchfor_array[] = "(".$searchfor_aux.")";

                $searchfor_array = array_unique($searchfor_array);

                $formated_searchfor_aux = implode(" ", $searchfor_array);

                $formated_searchfor = db_formatString(implode(" ", $searchfor_array));

                if (SEARCH_FORCE_BOOLEANMODE == "on") {
                    $auxFields = implode(", ", $fields);
                    if (string_strpos($auxFields, "Promotion") !== false) {
                        $auxFields = str_replace("fulltextsearch_keyword", "name", $auxFields);
                    } else {
                        $auxFields = str_replace("fulltextsearch_keyword", "title", $auxFields);
                    }
                    $order_by_score = "MATCH (".$auxFields.") AGAINST ('\"".addslashes($formated_searchfor_aux)."\"' IN BOOLEAN MODE) as ".$order_by_fieldname;
                    $order_by_score2 = "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor.") as ".$order_by_fieldname2;
                } else {
                    $order_by_score = "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor.") as ".$order_by_fieldname;
                }

                return "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor." IN BOOLEAN MODE)";

            }
        }

        return "";
    }

    function system_getUserImage($accID) {
        $accountObj = new Account($accID);
        $profileObj = new Profile($accID);
        if ($accountObj->getString("has_profile") == "y") {
            $imgObj = new Image($profileObj->getNumber("image_id"), true);
            if ($imgObj->imageExists()) {
                return $imgObj->getPath();
                //No image
            } else {
                if ($profileObj->getString("facebook_image")) {
                    return $profileObj->getString("facebook_image");
                } else {
                    if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS) !== false) {
                        return DEFAULT_URL."/".SITEMGR_ALIAS."/assets/img/profile-thumb.png";
                    } else {
                        return DEFAULT_URL."/assets/images/structure/icon-user-thumb.gif";
                    }
                }
            }
            //No image
        } else {
            if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS) !== false) {
                return DEFAULT_URL."/".SITEMGR_ALIAS."/assets/img/profile-thumb.png";
            } else {
                return DEFAULT_URL."/assets/images/structure/icon-user-thumb.gif";
            }
        }
    }

    function system_getAccountActivationLink($accoundID) {
        $row["account_id"] = $accoundID;
        $row["unique_key"] = md5(uniqid(rand(), true));
        $row["entered"]    = date("Y-m-d");

        $acc_activationObj = new Account_Activation($row);
        $acc_activationObj->save();

        $linkActivation = DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?activation_key=".$row["unique_key"];

        return $linkActivation;
    }
