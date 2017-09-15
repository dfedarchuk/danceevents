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
	# * FILE: /functions/validate_funct.php
	# ----------------------------------------------------------------------------------------------------

	//this function is valid for email and username validation
	function validate_email($email) {

		//e-mail injection
		if (preg_match('/^\r/', $email) || preg_match('/^\n/', $email)) {
			return false;
		}

		$regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,20}$/';
		if (preg_match($regex, $email) > 0) {
			return true;
		} else {
			return false;
		}
	}

	function validate_emails($emails) {
		if (string_strpos($emails, ";") !== false) return false;
		$emails = explode(",", $emails);
		foreach ($emails as $email) {
			if (!validate_email($email)) {
				return false;
			}
		}
		return true;
	}

	function validate_date($date) {

		$default_date_format = DEFAULT_DATE_FORMAT;

		$aux = explode("/", $date);

		if (count($aux) == 3 ) {

			if (is_numeric($aux[0]) && is_numeric($aux[1]) && is_numeric($aux[2])) {
				if (trim($default_date_format) == "m/d/Y") {
					$month = $aux[0];
					$day   = $aux[1];
					$year  = $aux[2];
				} elseif (trim($default_date_format) == "d/m/Y") {
					$month = $aux[1];
					$day   = $aux[0];
					$year  = $aux[2];
				}

				if (checkdate((int)$month, (int)$day, (int)$year)) {
					return true;
				}

				return false;

			}

			return false;

		}

		return false;

	}

	function validate_date_deal($start_date, $end_date) {
		$aux_start = explode("/", $start_date);
		$aux_end = explode("/", $end_date);
		if (count($aux_start) == 3 && count($aux_end) == 3) {
			if (is_numeric($aux_start[0]) && is_numeric($aux_start[1]) && is_numeric($aux_start[2]) && is_numeric($aux_end[0]) && is_numeric($aux_end[1]) && is_numeric($aux_end[2])) {

				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$start_month = $aux_start[0];
					$start_day   = $aux_start[1];
					$start_year  = $aux_start[2];

					$end_month = $aux_end[0];
					$end_day   = $aux_end[1];
					$end_year  = $aux_end[2];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$start_month = $aux_start[1];
					$start_day   = $aux_start[0];
					$start_year  = $aux_start[2];

					$end_month = $aux_end[1];
					$end_day   = $aux_end[0];
					$end_year  = $aux_end[2];
				}

				if (!checkdate((int)$start_month, (int)$start_day, (int)$start_year) || !checkdate((int)$end_month, (int)$end_day, (int)$end_year)) {
					return false;
				}

				$dateNow  = mktime(0,0,0, date("m"), date("d"), date("Y"));
				$dateDeal_start = mktime(0,0,0, $start_month, $start_day, $start_year);
				$dateDeal_end = mktime(0,0,0, $end_month, $end_day, $end_year);

				if ($dateDeal_start <= $dateNow && $dateNow <= $dateDeal_end) {
					return true;
				} else {
					return false;
				}
			}
		}
		return false;
	}

	function validate_period_deal($start, $end) {
		$visibility_start = date('H')*60+date('i');
        $visibility_end = date('H')*60+date('i');

		if (($visibility_start >= $start && $visibility_end <= $end) || ($start == 24 && $end == 24)){
			return true;
		} else {
			return false;
		}
	}

    /**
     * Determines if the $date parameter is in the future
     * @param string $date
     * @return boolean
     */
    function validate_isFutureDate( $date )
    {
        $return = false;

		$aux = explode( "/", $date );

        if ( count( $aux ) == 3 )
        {
            if ( is_numeric( $aux[0] ) && is_numeric( $aux[1] ) && is_numeric( $aux[2] ) )
            {
                if ( DEFAULT_DATE_FORMAT == "m/d/Y" )
                {
                    $inputDate = mktime(0, 0, 0, $aux[0], $aux[1], $aux[2]);
                }
                elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" )
                {
                    $inputDate = mktime(0, 0, 0, $aux[1], $aux[0], $aux[2]);
                }

                $return = ( $inputDate  && time() < $inputDate );
            }
        }

        return $return;
    }

	function validate_url($url) {
		$space = string_strpos($url, " ");
		if ($space !== false) {
			return false;
		}
		return true;
	}

	/*
	* @name:   function validate_date_interval
	* @since:  11/26/2004
	* @param:  date $start_date
	* @param:  date $end_date
	* @return: boolean (true/false)
	*
	* This function was made to validate if a begin date is older than a end date.
	* The date delimiter must be a slash.
	* It uses timestamp to compare the dates.
	* The range of valid years includes only 1970 through 2038.
	*/
	function validate_date_interval($start_date,$end_date){

		// no require entry.
		if(!$start_date || !$end_date) return false;

		// separating date into day, month and year.
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			list($end_month,$end_day,$end_year)       = explode("/",$end_date);
			list($start_month,$start_day,$start_year) = explode("/",$start_date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
			list($end_day,$end_month,$end_year)       = explode("/",$end_date);
			list($start_day,$start_month,$start_year) = explode("/",$start_date);
		}

		// entry is not a valid date.
		if(!checkdate($end_month,$end_day,$end_year))		return false;
		if(!checkdate($start_month,$start_day,$start_year))	return false;

		// validating today mktime restrictions
		if($start_year < 1970 || $start_day > 31 || $start_month > 12 || $start_year > 2038) return false;
		if($end_year   < 1970 || $end_day   > 31 || $end_month   > 12 || $end_year   > 2038) return false;

		// converting date to timestamp.
		$tm_end_date   = mktime(0, 0, 0, (int)$end_month, (int)$end_day, (int)$end_year);
		$tm_start_date = mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year);

		// comparing the start and end date to validate the interval.
		if($tm_end_date > $tm_start_date) return true; else return false;

	}

	function is_valid_discount_code($discount_id, $item_type, $item_id, &$message, &$error_num) {

		if (!$discount_id && $discount_id != "0") return true;

		$item_type_name = string_ucwords($item_type);
		$itemObj = new $item_type_name($item_id);

		$discountCodeObj = new DiscountCode($discount_id);
        $auxCode = $discountCodeObj->getString("id");

		if ((strlen($auxCode) <= 0)) {

			$error_num = 1;
			$message .= "&#149;&nbsp;".system_showText(LANG_MSG_INEXISTENT_DISCOUNT_CODE)." \"<b>".string_htmlentities($discount_id)."</b>\".";
			return false;

		} else {

			if ($discountCodeObj->getString("status") != "A") {

				$error_num = 2;
				$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." \"<b>".string_htmlentities($discount_id)."</b>\" ".system_showText(LANG_MSG_IS_NOT_AVAILABLE);
				return false;

			} elseif ($discountCodeObj->getString($item_type) != "on") {

				$error_num = 3;
				$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." \"<b>".string_htmlentities($discount_id)."</b>\" ".system_showText(LANG_MSG_IS_NOT_AVAILABLE_FOR);
				return false;

			} elseif (($discountCodeObj->getString("recurring") == "no") && ($itemObj->getString("id") > 0)) {
				//Duration: Once per item
				$dbObj_main = db_getDBObject(DEFAULT_DB, true);
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj_main);

				$sql = "SELECT * FROM Payment_".$item_type_name."_Log WHERE discount_id = '".$discountCodeObj->getString("id")."' AND ".$item_type."_id = '".$itemObj->getString("id")."' ORDER BY renewal_date DESC LIMIT 1";
				$result = $dbObj->query($sql);

				if (mysql_num_rows($result) >= 1) {

					$error_num = 4;
					$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." <strong>".string_htmlentities($discount_id)."</strong> ".system_showText(LANG_MSG_CANNOT_BE_USED_TWICE);
					return false;

				}

				$sql = "SELECT * FROM Invoice_".$item_type_name." WHERE discount_id = '".$discountCodeObj->getString("id")."' AND ".$item_type."_id = '".$itemObj->getString("id")."' ORDER BY renewal_date DESC LIMIT 1";
				$result = $dbObj->query($sql);

				if (mysql_num_rows($result) >= 1) {

					$error_num = 4;
					$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." <strong>".string_htmlentities($discount_id)."</strong> ".system_showText(LANG_MSG_CANNOT_BE_USED_TWICE);
					return false;

				}

			}

		}

		return true;

	}

	function validate_form($form, $array, &$error, $bannerErrorSize = 0) {

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

		extract($array);

        if ($form == "mailapp") {

            if (!$return_categories_all && $module != "all") {
                $errors[] = "&#149;&nbsp; ".system_showText(LANG_LABEL_CATEGORY_PLURAL)."";
            }

            if (!$title) {
                $errors[] = "&#149;&nbsp; ".system_showText(LANG_LABEL_TITLE)."";
            }

            if ($errors) {
                array_unshift($errors, "<b>".system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."</b>");
            }

        }elseif ($form == "mailapp_signup"){

            if ($actionForm == "newAcc") {

                if ($account_type == "new") {

                    if (!$edir_name) {
                        $errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MSGERROR_NAMEISREQUIRED)."";
                    }

                    if (!$edir_email) {
                        $errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MSGERROR_EMAILISREQUIRED)."";
                    } else {
                        $email = $edir_email;
                    }

                    if (!$edir_country) {
                        $errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MAILAPP_ERRORCOUNTRY)."";
                    }

                    if (!$edir_timezone) {
                        $errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MAILAPP_ERRORTIMEZONE)."";
                    }

                } elseif ($account_type == "existing") {

                    if (!$arcamailer_username) {
                        $errors[] = "&#149;&nbsp; ".system_showText(LANG_MSG_USERNAME_IS_REQUIRED)."";
                    }

                    if (!$arcamailer_password) {
                        $errors[] = "&#149;&nbsp; ".system_showText(LANG_MSG_PASSWORD_IS_REQUIRED)."";
                    }

                }

            } else {

                if (!$edir_list && !$edir_list_id) {
                    $errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MAILAPP_ERRORNEWSLETTER)."";
                }

            }

        }elseif ($form == "mailapp_signup_front") {

            if (!$name || !$email) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_ARCAMAILER_SUBSCRIBEERROR)."";
            }

        }elseif ($form == "navigation"){

            /**
             * Get option fields to validate
             */
            unset($array_options_number);
            $array_options_number = explode(",", $array["order_options"]);

            if (strlen($array_options_number[0])) {

                $arrayLinksTo = array();

                for ($i = 0; $i < count($array_options_number); $i++) {

                    if (!$array["navigation_text_".$array_options_number[$i]]) {
                        $errorArray[] = "&#149;&nbsp; ".system_showText(str_replace("[LINK_NUMBER]", ($i+1), LANG_SITEMGR_NAVIGATION_TEXT_REQUIRED));
                    }

                    if (($array["dropdown_link_to_".$array_options_number[$i]] == "custom") && (!$array["custom_link_".$array_options_number[$i]])) {
                        $errorArray[] = "&#149;&nbsp; ".system_showText(str_replace("[LINK_NUMBER]",($i+1), LANG_SITEMGR_NAVIGATION_LINK_REQUIRED));
                    }

                    if ($array["dropdown_link_to_".$array_options_number[$i]] == "---") {
                        $errorArray[] = "&#149;&nbsp; ".system_showText(str_replace("[LINK_NUMBER]", ($i+1), LANG_SITEMGR_NAVIGATION_LINK_REQUIRED));
                    }

                    if (($array["dropdown_link_to_".$array_options_number[$i]] != "custom") && in_array($array["dropdown_link_to_".$array_options_number[$i]], $arrayLinksTo)) {
                        $errorArray[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_NAVIGATION_REPEATED);
                    }
                    $arrayLinksTo[] = $array["dropdown_link_to_".$array_options_number[$i]];
                }
            } else {
                $errorArray[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_NAVIGATION_EMPTY);
            }

            if (is_array($errorArray) && $errorArray[0]) {
                $errors[] = "<b>".system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."</b><br />".implode("<br />", $errorArray);
            }

        }

        elseif ($form == "slider"){

			$total_slider_items = 0;
			for($i=1;$i<=TOTAL_SLIDER_ITEMS;$i++){
				$aux_field_name_new_image 	= $i."_image";
				$aux_field_name_title 		= $i."_title";
				$aux_field_name_image_id 	= $i."_image_id";
				$aux_field_name_link 		= $i."_link";

				if(($array[$i."_image_id"] > 0) || string_strlen($array[$i."_image"])){

					if(!$array[$i."_title"]){
						/*
						 * Prepare message with fields
						 */
						unset($aux_fields_message);
						if(!$array[$i."_title"]){
							$aux_fields_message[] = system_showText(LANG_SITEMGR_SLIDER_TITLE);
						}

						$errors[] = "&#149;&nbsp; ".system_showText(str_replace("[NUMBER]",$i,LANG_SITEMGR_SLIDER_MESSAGE_ERROR)).": ".implode(", ", $aux_fields_message);
					}
				}
			}

		}

		elseif ($form == "discountcodesettings") {
			if (!$status)                                   $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if (string_strtolower($status) == "e")          $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSCANNOTUSEDTOEXPIRE)."";
			if (!validate_date($expire_date))               $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED1)." \"".format_printDateStandard()."\" ".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED2)."";
			elseif (!validate_isFutureDate($expire_date))	$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONMUSTBEINFUTURE)."";
		}

		elseif ($form == "discountcode") {
			if (!$id && $id != "0")                                     $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CODEISREQUIRED)."";
			elseif (!$id && $id == "0")                                 $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CODEINVALID)."";
            if (!preg_match("/^([0-9a-zA-Z_]{1,10})/", $id) && $id)     $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CODENEEDSTOBEANALPHANUMERIC)."";
			if (!validate_date($expire_date))                           $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED1)." \"".format_printDateStandard()."\" ".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED2)."";
			elseif (!validate_isFutureDate($expire_date))                   $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONMUSTBEINFUTURE)."";
            if (!$type)                                                 $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TYPEISREQUIRED)."";
			if (!$amount || !is_numeric($amount))                       $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMUSTBEANUMERICVALUE)."";
			if ($type == "percentage" && $amount > 100)                 $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTCANNNOTBE100PERCENT)."";
			if ($amount <= 0)                                           $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMUSTBEGREATERTHAN)."";
			if (!$recurring)                                            $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RECURRINGISREQUIRED)."";
		}

		elseif ($form == "contact") {
			if (!$first_name)                       $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FIRST_NAME_IS_REQUIRED);
			if (!$last_name)                        $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_LAST_NAME_IS_REQUIRED);
            if (!$email && $isforeignAcc == "y")    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EMAIL_IS_REQUIRED);
		}

		elseif ($form == "listing") {

			if ((!$signup) && (!$sitemgr)) $elems[] = array('name'=>'account_id', 'label'=>system_showText(LANG_LABEL_ACCOUNT), 'type'=>'text', 'required'=>true, 'cont'=>'digit' );

			if (!$signup) {
				if ($_POST["listingtemplate_id"] && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {

					$listingTemplateObj = new ListingTemplate($_POST["listingtemplate_id"]);
					$templateFields = $listingTemplateObj->getListingTemplateFields("");

					if ($templateFields) {
						foreach ($templateFields as $each_field) {
							if ($each_field["required"]=="y") {
								$elems[] = array('name'=>$each_field["field"], 'label'=>(defined($each_field["label"]) ? constant($each_field["label"]) :$each_field["label"]), 'type'=>'text', 'required'=>true, 'len_max'=>'65535');
							}
						}
					}
				}
			}

			$elems[] = array('name'=>'title',             'label'=>system_showText(LANG_LABEL_NAME_OR_TITLE),       'type'=>'text',   'required'=>true,     'len_max'=>'100'                   );
			$elems[] = array('name'=>'friendly_url',      'label'=>system_showText(LANG_LABEL_PAGE_NAME),           'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'description',       'label'=>system_showText(LANG_LABEL_SUMMARY_DESCRIPTION), 'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/") === false) {
				$elems[] = array('name'=>'return_categories', 'label'=>system_showText(LANG_LABEL_CATEGORY_PLURAL),     'type'=>'text',   'required'=>true,                                        );
			}
			$elems[] = array('name'=>'address',           'label'=>system_showText(LANG_LABEL_STREET_ADDRESS),      'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'url',               'label'=>system_showText(LANG_LABEL_WEB_ADDRESS),         'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'phone',             'label'=>system_showText(LANG_LABEL_PHONE),               'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'fax',               'label'=>system_showText(LANG_LABEL_FAX),                 'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'long_description',  'label'=>system_showText(LANG_LABEL_LONG_DESCRIPTION),    'type'=>'text',   'required'=>false,    'len_max'=>'65535'                 );
			$elems[] = array('name'=>'status',            'label'=>system_showText(LANG_LABEL_STATUS),              'type'=>'text',   'required'=>false,    'len_max'=>'1'                     );
			$elems[] = array('name'=>'level',             'label'=>system_showText(LANG_LABEL_LEVEL),               'type'=>'select', 'required'=>false,    'len_max'=>'2',    'cont'=>'digit' );

			$f = new FormValidator($elems);
			$err = $f->validate($_POST);

			if ($err) {
				$errors[] = "<b>".system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."</b>";
				$valid = $f->getValidElems();
				foreach ($valid as $field_title => $field_array) {
					foreach ($field_array as $field) if (!$field['validation']) $errors[] = "&#149;&nbsp;".$field['label'];
				}
			}

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);

            if(count($return_categories_array) > LISTING_MAX_CATEGORY_ALLOWED) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_CATEGORIES_1)." ".LISTING_MAX_CATEGORY_ALLOWED." ".system_showText(LANG_MSG_MAX_OF_CATEGORIES_2);

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM Listing WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

            if ($latitude){
                if (!is_numeric($latitude) || $latitude < -90 || $latitude > 90){
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_MAP_INVALID_LAT);
                }
            }

            if ($longitude){
               if (!is_numeric($latitude) || $latitude < -90 || $latitude > 90){
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_MAP_INVALID_LON);
                }
            }

            if ($array_keywords) {
                if (count($array_keywords) > MAX_KEYWORDS) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2);
                }
                $kwlarge = false;
                foreach ($array_keywords as $kw) {
                    if (string_strlen($kw) > 50) {
                        $kwlarge = true;
                    }
                }
                if ($kwlarge) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS);
                }
            }


		}

		elseif ($form == "classified") {

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TITLE_IS_REQUIRED);

            if ($latitude){
                if (!is_numeric($latitude) || $latitude < -90 || $latitude > 90){
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_MAP_INVALID_LAT);
                }
            }

            if ($longitude){
               if (!is_numeric($latitude) || $latitude < -90 || $latitude > 90){
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_MAP_INVALID_LON);
                }
            }

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM Classified WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);

			if(count($return_categories_array) > MAX_CATEGORY_ALLOWED) $errors[] = system_showText(LANG_MSG_MAX_OF_CATEGORIES_1)." ".MAX_CATEGORY_ALLOWED." ".system_showText(LANG_MSG_MAX_OF_CATEGORIES_2);

            if ($array_keywords) {
                if (count($array_keywords) > MAX_KEYWORDS) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2);
                }
                $kwlarge = false;
                foreach ($array_keywords as $kw) {
                    if (string_strlen($kw) > 50) {
                        $kwlarge = true;
                    }
                }
                if ($kwlarge) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS);
                }
            }

            /* validation listing association */
            if ($listing_id) {
                // listing level
                $level = new ListingLevel();
                $listing = new Listing((int) $listing_id);

                if (sess_isSitemgrLogged()) {
                    if (!($account_id == 0 || $account_id === $listing->account_id)) {
                        $errors[] = "&#149;&nbsp;".system_showText(
                                LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_SITEMGR_ACCOUNT_DIFFER
                            );
                    }
                } else {
                    if (!($account_id === $listing->account_id)) {
                        $errors[] = "&#149;&nbsp;".system_showText(
                                LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_USER_ACCOUNT_DIFFER
                            );
                    }
                }

                /* listing level link */
                $classifiedsAssociated = Classified::getClassifiedByListing($listing);
                $listingClassifiedAssociation = $level->getClassifiedQuantityAssociation($listing->getNumber("level"));
                if (!(
                    $listingClassifiedAssociation > 0
                    && $listingClassifiedAssociation > count($classifiedsAssociated)
                )) {
                    $errors[] = "&#149;&nbsp;".system_showText(
                            LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY
                        );
                }
            }

		}

		elseif ($form == "article") {

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

            if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TITLE_IS_REQUIRED);

			if ($publication_date && !validate_date($publication_date)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_PUBLICATION_DATE);

			if (!$signup) if (!${'abstract'}) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ABSTRACT_IS_REQUIRED);

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM Article WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);

			if(count($return_categories_array) > MAX_CATEGORY_ALLOWED) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_CATEGORIES_1)." ".MAX_CATEGORY_ALLOWED." ".system_showText(LANG_MSG_MAX_OF_CATEGORIES_2);

            if ($array_keywords) {
                if (count($array_keywords) > MAX_KEYWORDS) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2);
                }
                $kwlarge = false;
                foreach ($array_keywords as $kw) {
                    if (string_strlen($kw) > 50) {
                        $kwlarge = true;
                    }
                }
                if ($kwlarge) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS);
                }
            }

		}

        else if ($form == "blog") {

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TITLE_IS_REQUIRED);
			if (!${"content"}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_CONTENT_IS_REQUIRED);

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM Post WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

            if ($array_keywords) {
                if (count($array_keywords) > MAX_KEYWORDS) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2);
                }
                $kwlarge = false;
                foreach ($array_keywords as $kw) {
                    if (string_strlen($kw) > 50) {
                        $kwlarge = true;
                    }
                }
                if ($kwlarge) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS);
                }
            }

		}

		else if ($form == "listingsettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".string_ucwords(system_showText(LANG_SITEMGR_LISTING))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "eventsettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".string_ucwords(system_showText(LANG_SITEMGR_EVENT))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "classifiedsettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "articlesettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".string_ucwords(system_showText(LANG_SITEMGR_ARTICLE))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

        else if ($form == "postsettings") {

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";

		}

		else if ($form == "bannersettings") {

			if (!$expiration_setting) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONTYPEISREQUIRED)."";

			if ($hasrenewaldate != "no") if ($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE && !$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if ($hasimpressions != "no") if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION && (!$impressions || $impressions ==0)) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_IMPRESSIONSAREREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".string_ucwords(system_showText(LANG_SITEMGR_BANNER))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "banner") {

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

            if (!$type && !$id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TYPE_IS_REQUIRED);

			if (!$expiration_setting) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED);

			if (!$signup) if ($sitemgr) {
				if ($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE && !$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_RENEWAL_DATE_IS_REQUIRED);
			}

			if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION && (!$unpaid_impressions || $unpaid_impressions == 0) && !$id && !string_strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_IMPRESSIONS_ARE_REQUIRED);
			if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION && (!$impressions || $impressions == 0) && !$id && string_strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_IMPRESSIONS_ARE_REQUIRED);

			if (!$caption) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_CAPTION_IS_REQUIRED);

			if ($bannerErrorSize) {
                if ($bannerErrorSize == 2){
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_UPLOAD_MSG_EXCEEDSLIMIT);
                } elseif ($bannerErrorSize == 1) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_INVALID_FILE_TYPE);
                }

			} else {
				if (!$signup && $show_type!=1) {
					if (!$file && $type < 50 && !$id) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FILE_IS_REQUIRED);
					} elseif (!$file && $type < 50 && $id) { // required because of the different type approachs (image banner and text banner)
						$bannerObj = new Banner($id);
						if(!$bannerObj->getNumber("image_id")) { $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FILE_IS_REQUIRED); }
						unset($bannerObj);
					} else if (!$image_id && $type < 50) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FILE_IS_REQUIRED);
					}
				}
			}

			if($show_type==1 && !$signup) {
				if (!$script) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_SCRIPT_CODE_IS_REQUIRED);
			} elseif (!$signup) {
				if (!${"content_line1"} && $type >= 50)	$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DESCRIPTION1_IS_REQUIRED);
				if (!${"content_line2"} && $type >= 50)	$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DESCRIPTION2_IS_REQUIRED);
			}

		}

		else if ($form == "invoicesettings") {
			if ($status == 'E') $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE)." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";
			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
		}

		else if ($form == "adminemail") {

			if ($sitemgr_email) {
				if (!validate_emails($sitemgr_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDGENERALEMAILADDRESS);
				}
			} else {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_GENERALEMAILREQUIRED);
			}

			if ($sitemgr_listing_email) {
				if (!validate_emails($sitemgr_listing_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_LISTING).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			 }

			if ($sitemgr_event_email) {
				if (!validate_emails($sitemgr_event_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_EVENT).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_banner_email) {
				if (!validate_emails($sitemgr_banner_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_BANNER).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_classified_email) {
				if (!validate_emails($sitemgr_classified_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_CLASSIFIED).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_article_email) {
				if (!validate_emails($sitemgr_article_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_ARTICLE).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_account_email) {
				if (!validate_emails($sitemgr_account_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).string_strtolower(system_showText(LANG_SITEMGR_LABEL_ACCOUNT)).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_contactus_email) {
				if (!validate_emails($sitemgr_contactus_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).string_strtolower(system_showText(LANG_SITEMGR_CONTACT)).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_support_email) {
				if (!validate_emails($sitemgr_support_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_SUPPORT).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_payment_email) {
				if (!validate_emails($sitemgr_payment_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_PAYMENT).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_rate_email) {
				if (!validate_emails($sitemgr_rate_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_RATE).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

            if ($sitemgr_claim_email) {
				if (!validate_emails($sitemgr_claim_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CLAIMLISTING).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

            if ($sitemgr_blog_email) {
				if (!validate_emails($sitemgr_blog_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_SETTINGS_EMAIL_BLOG).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

            if ($sitemgr_import_email) {
				if (!validate_emails($sitemgr_import_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_IMPORT).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

            if ($sitemgr_lead_email) {
				if (!validate_emails($sitemgr_lead_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_LABEL_LEADS).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

		}

		else if ($form == "gallery") {
			if (!$name) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_NAME_IS_REQUIRED);
		}

		else if ($form == "category") {

			if (!$title) $errors[] = "&#149;&nbsp;" . system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1) . " " . system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED2) . "";
			if (!$page_title) $errors[] = "&#149;&nbsp;" . system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEISREQUIRED1) . " " . system_showText(LANG_SITEMGR_MSGERROR_LANG_PAGETITLEISREQUIRED2) . "";
			if (!$friendly_url) $errors[] = "&#149;&nbsp;" . system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED1) . " " . system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED2) . "";

			if (!preg_match(FRIENDLYURL_REGULAREXPRESSION, trim($friendly_url))) {
				$errors[] = "&#149;&nbsp;" . system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLCONTAININVALIDCHARS);
			}

			$validateModules = ["ListingCategory", "EventCategory", "ClassifiedCategory", "ArticleCategory", "BlogCategory"];
			$duplicatedFriendly = false;

			if ($friendly_url) {
				foreach ($validateModules as $validateModule) {
					if (!$duplicatedFriendly) {
						$sql = "SELECT friendly_url FROM $validateModule WHERE friendly_url = " . db_formatString(trim($friendly_url)) . "";
						if ($validateModule == $table_category && $id) {
							$sql .= " AND id != $id ";
						}
						$sql .= " LIMIT 1";
						$rs = $dbObj->query($sql);
						if (mysql_num_rows($rs) > 0) {
							$errors[] = "&#149;&nbsp;" . system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
							$duplicatedFriendly = true;
						}
					}
				}

				if (!$duplicatedFriendly) {
					for ($i = 1; $i <=5; $i++) {
						if (!$duplicatedFriendly) {
							$sql = "SELECT friendly_url FROM Location_$i WHERE friendly_url = " . db_formatString(trim($friendly_url)) . " LIMIT 1";
							$rs = $dbMain->query($sql);
							if (mysql_num_rows($rs) > 0) {
								$errors[] = "&#149;&nbsp;" . system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
								$duplicatedFriendly = true;
							}
						}
					}
				}
			}
		}

		else if ($form == "location") {

			$validateModules = ["ListingCategory", "EventCategory", "ClassifiedCategory", "ArticleCategory", "BlogCategory"];
			$duplicatedFriendly = false;

			if ($friendly_url) {
				foreach ($validateModules as $validateModule) {
					if (!$duplicatedFriendly) {
						$sql = "SELECT friendly_url FROM $validateModule WHERE friendly_url = " . db_formatString(trim($friendly_url)) . " LIMIT 1 ";
						$rs = $dbObj->query($sql);
						if (mysql_num_rows($rs) > 0) {
							$errors[] = "&#149;&nbsp;" . system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
							$duplicatedFriendly = true;
						}
					}
				}
			}

		}

		else if ($form == "promotion") {
			if (!$sitemgr) if (!$account_id) $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);
			if (!$name)  $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_HEADLINE_IS_REQUIRED);

            if ($array_keywords) {
                if (count($array_keywords) > MAX_KEYWORDS) {
                    $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2);
                }
                $kwlarge = false;
                foreach ($array_keywords as $kw) {
                    if (string_strlen($kw) > 50) {
                        $kwlarge = true;
                    }
                }
                if ($kwlarge) {
                    $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS);
                }
            }

			$dateTimeError = false;

            /* validation listing association */
            if ($listing_id) {
                // listing level
                $level = new ListingLevel();
                $listing = new Listing((int) $listing_id);

                if (sess_isSitemgrLogged()) {
                    if (!($account_id == 0 || $account_id === $listing->account_id)) {
                        $errors[] = "&#149;&nbsp;".system_showText(
                                LANG_SITEMGR_ERROR_LISTING_PROMOTION_SITEMGR_ACCOUNT_DIFFER
                            );
                    }
                } else {
                    if (!($account_id === $listing->account_id)) {
                        $errors[] = "&#149;&nbsp;".system_showText(
                                LANG_SITEMGR_ERROR_LISTING_PROMOTION_SITEMGR_ACCOUNT_DIFFER
                            );
                    }
                }

            }

			if (!$start_date) {
				$dateTimeError = true;
				$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_START_DATE)." (".system_showText(LANG_LABEL_EMPTY).")";
			} elseif (!validate_date($start_date)) {
				$dateTimeError = true;
				$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_START_DATE)." (".system_showText(LANG_LABEL_INVALID_DATE).": $start_date)";
			}

			if (!$end_date) {
				$dateTimeError = true;
				$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_END_DATE)." (".system_showText(LANG_LABEL_EMPTY).")";
			} elseif (!validate_date($end_date)) {
				$dateTimeError = true;
				$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_END_DATE)." (".system_showText(LANG_LABEL_INVALID_DATE).": $end_date)";
			}
			if ($visibility){

				if ($start_time_hour || $start_time_min) {
					if (!$start_time_hour) {
						$dateTimeError = true;
						$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_START_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
					}
					if (!$start_time_min) {
						$dateTimeError = true;
						$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_START_TIME)." (".system_showText(LANG_LABEL_MINUTE).")";
					}
					if (CLOCK_TYPE == '12' && !$start_time_am_pm) {
						$dateTimeError = true;
						$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_START_TIME)." (AM/PM)";
					}
				} else {
					$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_START_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
					$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_START_TIME)." (".system_showText(LANG_LABEL_MINUTE).")";
				}

				if ($end_time_hour || $end_time_min) {
					if (!$end_time_hour) {
						$dateTimeError = true;
						$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_END_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
					}
					if (!$end_time_min) {
						$dateTimeError = true;
						$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_END_TIME)." (".system_showText(LANG_LABEL_MINUTE).")";
					}
					if (CLOCK_TYPE == '12' && !$end_time_am_pm) {
						$dateTimeError = true;
						$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_END_TIME)." (AM/PM)";
					}
				} else {
					$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_END_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
					$err[] = "&#149;&nbsp;".system_showText(LANG_LABEL_END_TIME)." (".system_showText(LANG_LABEL_MINUTE).")";
				}
			}

			if (!$dateTimeError) {

				$startDateStr = explode("/", $start_date);
				$endDateStr = explode("/", $end_date);

				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[0].$startDateStr[1];
					$endDateStr = $endDateStr[2].$endDateStr[0].$endDateStr[1];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[1].$startDateStr[0];
					$endDateStr = $endDateStr[2].$endDateStr[1].$endDateStr[0];
				}

				if ($startDateStr > $endDateStr) {
					$err[] = "&#149;&nbsp;".system_showText(LANG_MSG_END_DATE_GREATER_THAN_START_DATE);
				} elseif ($endDateStr < date("Ymd")) {
					$err[] = "&#149;&nbsp;".system_showText(LANG_MSG_END_DATE_CANNOT_IN_PAST);
				}	elseif ($startDateStr == $endDateStr && $visibility) {

					$startTimeStr = "";
					if (($start_time_am_pm == "pm") && ($start_time_hour < 12)) $startTimeStr = 12 + $start_time_hour;
					elseif (($start_time_am_pm == "am") && ($start_time_hour == "12")) {
						if ($end_time_am_pm == "pm") $startTimeStr = "00";
						elseif ($end_time_am_pm == "am") $startTimeStr = "24";
					} elseif ( $start_time_hour == "00" ) $startTimeStr = "00";
					else $startTimeStr = $start_time_hour;
					$startTimeStr .= $start_time_min."00";

					$endTimeStr = "";
					if (($end_time_am_pm == "pm") && ($end_time_hour < 12)) $endTimeStr = 12 + $end_time_hour;
					elseif (($end_time_am_pm == "am") && ($end_time_hour == "12")) {
						if ($start_time_am_pm == "pm") $endTimeStr = "00";
						elseif ($start_time_am_pm == "am") $endTimeStr = "24";
					} elseif ( $end_time_hour == "00" ) $endTimeStr = "00";
					else $endTimeStr = $end_time_hour;
					$endTimeStr .= $end_time_min."00";

					if ( ($startTimeStr >= $endTimeStr) ) {
						$err[] = "&#149;&nbsp;".system_showText(LANG_MSG_END_TIME_GREATER_THAN_START_TIME);
					}

				}
			}

			if (!$realvalue || !is_numeric($realvalue))
                $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_VALIDDEAL_REALVALUE);
			if (($deal_type == "monetary value") && (!$dealvalue || !is_numeric($dealvalue)))
                $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_VALIDDEAL_DEALVALUE);
			if (($deal_type == "percentage") && (!is_numeric($dealvalue)))
                $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_VALIDDEAL_DEALVALUE);
			if (($deal_type == "percentage") && ($dealvalue < 0))
                $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_VALIDDEAL_DEALVALUE2);
			if (!$amount || !is_numeric($amount)) $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_VALIDDEAL_AMOUNT);
            if ($realvalue && $dealvalue && ($dealvalue > $realvalue) && is_numeric($realvalue) && is_numeric($dealvalue))
                $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_VALID_MINOR);

			if (!$friendly_url) $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM Promotion WHERE friendly_url = ".db_formatString($friendly_url)."";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if (!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			// explode all error messages to show
			if($err) {
				$errors[] = "<b>".system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."</b>";
				foreach ($err as $label) {
					$errors[] = $label;
				}
			}

		}

		else if ($form == "help") {
			if (!$name)  $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_NAME_IS_REQUIRED);
			if (!$email) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EMAIL_IS_REQUIRED);
			if (!$text)  $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TEXT_IS_REQUIRED);
		}

		elseif ($form == "listingdefaultprice") {

			$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";

			$levelObj = new ListingLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && (!preg_match($money_regex, $priceValue) || $priceValue > "99999.99")) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			foreach ($free_category as $freeCategoryLevel=>$freeCategoryValue) {
				if ($freeCategoryValue && ($freeCategoryValue > LISTING_MAX_CATEGORY_ALLOWED)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($freeCategoryLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_CATEGORIESINCLUDED1)." (".$freeCategoryValue.") ".system_showText(LANG_SITEMGR_MSGERROR_CATEGORIESINCLUDED2)." (".LISTING_MAX_CATEGORY_ALLOWED.").";
				}
			}

			foreach ($category_price as $categoryPriceLevel=>$categoryPriceValue) {
				if ($categoryPriceValue && (!preg_match($money_regex, $categoryPriceValue) || $categoryPriceValue > "99999.99")) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($categoryPriceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_CATEGORYPRICEINCORRECT);
					$flag = true;
				}
			}

			if ($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "eventdefaultprice") {

			$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";

			$levelObj = new EventLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && (!preg_match($money_regex, $priceValue) || $priceValue > "99999.99")) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "bannerdefaultprice") {

			$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";

			$levelObj = new BannerLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && (!preg_match($money_regex, $priceValue) || $priceValue > "99999.99")) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_BANNERPRICEISINCORRECT1);
					$flag = true;
				}
			}

			foreach ($impression_block as $blockLevel=>$blockValue) {
				if ($blockValue <= 0) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($blockLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_IMPRESSIONSMUSTBEMORETHANZERO);
				}
			}

			foreach ($impression_price as $impressionLevel=>$impressionValue) {
				if ($impressionValue && (!preg_match($money_regex, $impressionValue) || $impressionValue > "99999.99")) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($impressionLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_BANNERPRICEISINCORRECT2);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "classifieddefaultprice") {

			$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";

			$levelObj = new ClassifiedLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && (!preg_match($money_regex, $priceValue) || $priceValue > "99999.99")) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "articledefaultprice") {

			$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";

			$levelObj = new ArticleLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && (!preg_match($money_regex, $priceValue) || $priceValue > "99999.99")) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "event") {

			$err = array();

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $err[] = system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

			if (!$title) {
				$err[] = system_showText(LANG_MSG_TITLE_PLEASE_FILL_OUT);
			}

            if ($latitude){
                if (!is_numeric($latitude) || $latitude < -90 || $latitude > 90){
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_MAP_INVALID_LAT);
                }
            }

            if ($longitude){
               if (!is_numeric($latitude) || $latitude < -90 || $latitude > 90){
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_MAP_INVALID_LON);
                }
            }

			if (!$friendly_url) $err[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM Event WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $err[] = "".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $err[] = system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			$dateTimeError = false;

			if (!$start_date) {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_START_DATE)." (".system_showText(LANG_LABEL_EMPTY).")";
			} elseif (!validate_date($start_date)) {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_START_DATE)." (".system_showText(LANG_LABEL_INVALID_DATE).": $start_date)";
			}

			if (!$end_date && $recurring!='Y') {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_END_DATE)." (".system_showText(LANG_LABEL_EMPTY).")";
			} elseif (!validate_date($end_date) && $recurring!='Y') {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_END_DATE)." (".system_showText(LANG_LABEL_INVALID_DATE).": $end_date)";
			}

			if ($start_time_hour || $start_time_min) {
				if (!$start_time_hour) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_START_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
				}
				if (CLOCK_TYPE == '12' && !$start_time_am_pm) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_START_TIME)." (AM/PM)";
				}
			} else {
				$start_time_hour = "12";
				$start_time_min = "00";
				$start_time_am_pm = "am";
			}

			if ($end_time_hour || $end_time_min) {
				if (!$end_time_hour) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_END_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
				}
				if (CLOCK_TYPE == '12' && !$end_time_am_pm) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_END_TIME)." (AM/PM)";
				}
			} else {
				$end_time_hour = "11";
				$end_time_min = "59";
				$end_time_am_pm = "pm";
			}

			if (!$dateTimeError) {

				$startDateStr = explode("/", $start_date);
				$endDateStr = explode("/", $end_date);
				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[0].$startDateStr[1];
					$endDateStr = $endDateStr[2].$endDateStr[0].$endDateStr[1];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[1].$startDateStr[0];
					$endDateStr = $endDateStr[2].$endDateStr[1].$endDateStr[0];
				}
				if ($startDateStr > $endDateStr && $recurring!='Y') {

					$err[] = system_showText(LANG_MSG_END_DATE_GREATER_THAN_START_DATE);

				} elseif ($endDateStr < date("Ymd") && $recurring!='Y') {

					$err[] = system_showText(LANG_MSG_END_DATE_CANNOT_IN_PAST);

				} elseif ($startDateStr == $endDateStr && $recurring!='Y') {

					$startTimeStr = "";
					if (($start_time_am_pm == "pm") && ($start_time_hour < 12)) $startTimeStr = 12 + $start_time_hour;
					elseif (($start_time_am_pm == "am") && ($start_time_hour == "12")) {
						if ($end_time_am_pm == "pm") $startTimeStr = "00";
						elseif ($end_time_am_pm == "am") $startTimeStr = "24";
					} elseif ( $start_time_hour == "00" ) $startTimeStr = "00";
					else $startTimeStr = $start_time_hour;
					$startTimeStr .= $start_time_min."00";

					$endTimeStr = "";
					if (($end_time_am_pm == "pm") && ($end_time_hour < 12)) $endTimeStr = 12 + $end_time_hour;
					elseif (($end_time_am_pm == "am") && ($end_time_hour == "12")) {
						if ($start_time_am_pm == "pm") $endTimeStr = "00";
						elseif ($start_time_am_pm == "am") $endTimeStr = "24";
					} elseif ( $end_time_hour == "00" ) $endTimeStr = "00";
					else $endTimeStr = $end_time_hour;
					$endTimeStr .= $end_time_min."00";

					if ( ($startTimeStr >= $endTimeStr) ) {
						$err[] = system_showText(LANG_MSG_END_TIME_GREATER_THAN_START_TIME);
					}

				}

			}
			if ($recurring == 'Y') {

				if ($eventPeriod=="until"){
					if (!$until_date) {
						$dateTimeError = true;
						$err[] = system_showText(LANG_LABEL_UNTIL_DATE)." (".system_showText(LANG_LABEL_EMPTY).")";
					} elseif (!validate_date($until_date)) {
						$dateTimeError = true;
						$err[] = system_showText(LANG_LABEL_UNTIL_DATE)." (".system_showText(LANG_LABEL_INVALID_DATE).": $until_date)";
					}

					if (!$dateTimeError) {

						$startDateStr = explode("/", $start_date);
						$untilDateStr = explode("/", $until_date);
						if (DEFAULT_DATE_FORMAT == "m/d/Y") {
							$startDateStr = $startDateStr[2].$startDateStr[0].$startDateStr[1];
							$untilDateStr = $untilDateStr[2].$untilDateStr[0].$untilDateStr[1];
						} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
							$startDateStr = $startDateStr[2].$startDateStr[1].$startDateStr[0];
							$untilDateStr = $untilDateStr[2].$untilDateStr[1].$untilDateStr[0];
						}
						if ($startDateStr > $untilDateStr) {

							$err[] = system_showText(LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE);

						} elseif ($untilDateStr < date("Ymd")) {

							$err[] = system_showText(LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST);

						} elseif ($startDateStr == $untilDateStr) {

							$startTimeStr = "";
							if (($start_time_am_pm == "pm") && ($start_time_hour < 12)) $startTimeStr = 12 + $start_time_hour;
							elseif (($start_time_am_pm == "am") && ($start_time_hour == "12")) {
								if ($end_time_am_pm == "pm") $startTimeStr = "00";
								elseif ($end_time_am_pm == "am") $startTimeStr = "24";
							} elseif ( $start_time_hour == "00" ) $startTimeStr = "00";
							else $startTimeStr = $start_time_hour;
							$startTimeStr .= $start_time_min."00";

							$endTimeStr = "";
							if (($end_time_am_pm == "pm") && ($end_time_hour < 12)) $endTimeStr = 12 + $end_time_hour;
							elseif (($end_time_am_pm == "am") && ($end_time_hour == "12")) {
								if ($start_time_am_pm == "pm") $endTimeStr = "00";
								elseif ($start_time_am_pm == "am") $endTimeStr = "24";
							} elseif ( $end_time_hour == "00" ) $endTimeStr = "00";
							else $endTimeStr = $end_time_hour;
							$endTimeStr .= $end_time_min."00";

							if ( ($startTimeStr >= $endTimeStr) ) {
								$err[] = system_showText(LANG_MSG_END_TIME_GREATER_THAN_START_TIME);
							}

						}

					}
				}

				if($period=='weekly'){
					if (!$dayofweek){
						$dateTimeError = true;
						$err[] =system_showText(LANG_EVENT_SELECT_DAYOFWEEK);
					}

					if (!$dateTimeError && $eventPeriod=="until"){
						if (!validate_DayWeek($start_date,$until_date,$dayofweek)){
							$dateTimeError = true;
							$err[] = system_showText(LANG_EVENT_CHECK_DAYOFWEEK);
						}
					}
				}elseif($period=='monthly'){
					if ($precision=='day'){
						if (!$day){
							$dateTimeError = true;
							if (is_numeric($day) && $day==0){
								$err[] =system_showText(LANG_EVENT_TYPE_DAY_BETWEEN);
							} else {
								$err[] =system_showText(LANG_EVENT_TYPE_DAY);
							}
						} else {
							if (!is_numeric($day)){
								$dateTimeError = true;
								$err[] =system_showText(LANG_EVENT_TYPE_DAY_NUMERIC);
							} else {
								if ($day<0 || $day==00){
									$dateTimeError = true;
									$err[] =system_showText(LANG_EVENT_TYPE_DAY_BETWEEN);
								} else if ($day>31){
									$dateTimeError = true;
									$err[] =system_showText(LANG_EVENT_TYPE_DAY_BETWEEN);
								}
							}
						}

						if (!$dateTimeError && $eventPeriod=="until"){
							if (!validate_EveryDay($start_date,$until_date,$day)){
								$dateTimeError = true;
								$err[] = system_showText(LANG_EVENT_CHECK_DAY);
							}
						}
					}else{
						if (!$dayofweek){
							$dateTimeError = true;
							$err[] =system_showText(LANG_EVENT_SELECT_DAYOFWEEK);
						}
						if(!$week){
							$dateTimeError = true;
							$err[] =system_showText(LANG_EVENT_SELECT_WEEK);
						}
						if (!$dateTimeError && $eventPeriod=="until"){
							if (!validate_DayWeek($start_date,$until_date,$dayofweek)){
								$dateTimeError = true;
								$err[] = system_showText(LANG_EVENT_CHECK_DAYOFWEEK);
							}
						}

					}
				} elseif($period=='yearly'){
					if (!$dayofweek && $precision == "weekday") {
                        $err[] =system_showText(LANG_EVENT_SELECT_DAYOFWEEK);
                    }
					if (!$week && $precision == "weekday") {
                        $err[] =system_showText(LANG_EVENT_SELECT_WEEK);
                    }
					if (!$month && $precision == "weekday") {
                        $err[] =system_showText(LANG_EVENT_SELECT_MONTH);
						$dateTimeError = true;
                    }

					if(!$month && $precision == "day"){
						$dateTimeError = true;
						$err[] =system_showText(LANG_EVENT_SELECT_MONTH);
					}
					if (!$day && $precision == "day"){
						$dateTimeError = true;
						if (is_numeric($day) && $day==0){
							$err[] =system_showText(LANG_EVENT_TYPE_DAY_BETWEEN);
						} else {
							$err[] =system_showText(LANG_EVENT_TYPE_DAY);
						}
					} elseif ($precision == "day") {
						if (!is_numeric($day)){
							$dateTimeError = true;
							$err[] =system_showText(LANG_EVENT_TYPE_DAY_NUMERIC);
						} else {
							if ($day<0 || $day==00){
								$dateTimeError = true;
								$err[] =system_showText(LANG_EVENT_TYPE_DAY_BETWEEN);
							} else if ($day>31){
								$dateTimeError = true;
								$err[] =system_showText(LANG_EVENT_TYPE_DAY_BETWEEN);
							}
						}
						if (!$dateTimeError && $eventPeriod=="until"){
							if (!validate_NumberMonth($start_date,$until_date,$month)){
								$dateTimeError = true;
								$err[] = system_showText(LANG_EVENT_CHECK_MONTH);
					}
						}
						if (!$dateTimeError && $eventPeriod=="until"){
							if (!validate_EveryDay($start_date,$until_date,$day)){
						$dateTimeError = true;
								$err[] = system_showText(LANG_EVENT_CHECK_DAY);
					}
						}
					}

					if ($precision == "weekday"){
						if (!$dateTimeError && $eventPeriod=="until"){
							if (!validate_NumberMonth($start_date,$until_date,$month)){
								$dateTimeError = true;
								$err[] = system_showText(LANG_EVENT_CHECK_MONTH);
							}
						}

						if (!$dateTimeError && $eventPeriod=="until"){
							if (!validate_DayWeek($start_date,$until_date,$dayofweek)){
								$dateTimeError = true;
								$err[] = system_showText(LANG_EVENT_CHECK_DAYOFWEEK);
							}
						}

					}

				} elseif(!$period){
					$dateTimeError = true;
					$err[] =system_showText(LANG_EVENT_SELECT_PERIOD);
				}


            }

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);

			if(count($return_categories_array) > MAX_CATEGORY_ALLOWED) $err[] = system_showText(LANG_MSG_MAX_OF_CATEGORIES_1)." ".MAX_CATEGORY_ALLOWED." ".system_showText(LANG_MSG_MAX_OF_CATEGORIES_2);

            // explode all error messages to show
			if($err) {
				$errors[] = "<b>".system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."</b>";
				foreach ($err as $label) {
					$errors[] = "&#149;&nbsp;".$label;
				}
			}

            if ($array_keywords) {
                if (count($array_keywords) > MAX_KEYWORDS) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2);
                }
                $kwlarge = false;
                foreach ($array_keywords as $kw) {
                    if (string_strlen($kw) > 50) {
                        $kwlarge = true;
                    }
                }
                if ($kwlarge) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS);
                }
            }

		} elseif ($form == "custominvoice") {

			$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";
			$item_counter = 1;

			//account validation
			if (!$account_id) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASESELECTANACCOUNT).".";
			}

			//title validation
			if (!$title) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASETYPEATITLE).".";
			}

			if ($title && string_strlen($title) > 100) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_MAXCHARSALLOWEDFOR1)."100".system_showText(LANG_SITEMGR_MSGERROR_MAXCHARSALLOWEDFOR2)." ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1);
			}

			// if item description
			if ($item_desc) {
				foreach ($item_desc as $key => $each_item_desc) {
					// spaces
					$each_item_desc = trim($each_item_desc);
					// if item desc and not item price
					if (!empty($each_item_desc) && empty($item_price[$key])) {
						// default price 0.00
						$item_prices[$key] = format_money("0.00");
					// if item desc and item price
					} elseif (!empty($each_item_desc) && !empty($item_price[$key])) {
						// price validation
						if(!preg_match($money_regex, $item_price[$key])) {
							$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_LABEL_ITEM)." ".$item_counter." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT).".";
						}
					// if price and not description
					} elseif (empty($each_item_desc) && !empty($item_price[$key])) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_LABEL_ITEM)." ".$item_counter." ".system_showText(LANG_SITEMGR_MSGERROR_DESCRIPTIONISEMPTY).".";
					}

					$item_counter++;
				}
			}

			// amount validation
			if ($amount <= 0) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CUSTOMINVOICEAMOUNTCANNOTZERO);
			}

        } elseif ($form == "custominvoicesend") {

            if (!$to || !$from || !$subject || !$body_message) {

                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_CUSTOMINVOICE_ERRORSENT)."<br />";

                if (!$subject) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_CUSTOMINVOICE_ERRORSENT1);
                }

                if (!$body_message) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_CUSTOMINVOICE_ERRORSENT2);
                }

            }


        } elseif ($form == "listinglevelnames") {

            $levelObj = new ListingLevel(true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". ucfirst($levelObj->getName($levelValue)) .": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }

            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        } elseif ($form == "eventlevelnames") {

            $levelObj = new EventLevel(true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". ucfirst($levelObj->getName($levelValue)) . ": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }

            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }


        } elseif ($form == "bannerlevelnames") {

            $levelObj = new BannerLevel(true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". ucfirst($levelObj->getName($levelValue)) . ": ".system_showText(LANG_SITEMGR_MSGERROR_NAMEISREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }

            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        } elseif ($form == "classifiedlevelnames") {

            $levelObj = new ClassifiedLevel(true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". ucfirst($levelObj->getName($levelValue)) . ": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }

            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        } elseif ($form == "articlelevelnames") {

            $levelObj = new ArticleLevel(true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". ucfirst($levelObj->getName($levelValue)) . ": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }

            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        }

        elseif ($form == "search_metatag") {

            if ($google_tag) {
                if ( string_strpos(string_strtolower($google_tag), '<meta') === false || string_strpos(string_strtolower($google_tag), '>') === false) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGERRORGOOGLE);
                }
            }

            if ($yahoo_tag) {
                if ( string_strpos(string_strtolower($yahoo_tag), '<meta') === false || string_strpos(string_strtolower($yahoo_tag), '>') === false) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGERRORYAHOO);
                }
            }

            if ($live_tag) {
                if ( string_strpos(string_strtolower($live_tag), '<meta') === false || string_strpos(string_strtolower($live_tag), '>') === false) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGERRORLIVE);
                }
            }

        }

        elseif ($form == "faq") {
            if (!$faq_question) $errors[] = 1;
            if (!$faq_answer) $errors[] = 2;
        }

		elseif ($form == "domain") {
			$db = db_getDBObject(DEFAULT_DB, true);
			if (!$name){
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DOMAINNAME_IS_REQUIRED);
			} else {
				$name = string_strtolower(db_formatString($name));
				$sql = "SELECT COUNT(0) AS rowcount FROM Domain WHERE name LIKE $name AND `status` = 'A'";
				$result = $db->query($sql);
				if (mysql_num_rows($result) > 0) {
					if ($row = mysql_fetch_assoc($result)) {
						$domain = $row["rowcount"];
					}
				}
				if ($domain){
					$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DOMAINNAME_ALREADY_EXISTS);
				}
			}

			if (!$url){
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DOMAINURL_IS_REQUIRED);
			} else {
				$url = trim(string_strtolower($url));
				if (domain_validateDomainUrl($url)) {
					$url = str_replace("http://", "", $url);
					$url = str_replace("https://", "", $url);
					$url = str_replace("www.", "", $url);
					$url = string_strtolower(db_formatString($url));
					$sql = "SELECT COUNT(0) AS rowcount FROM Domain WHERE url = $url AND `status` = 'A'";
					$result = $db->query($sql);
					if (mysql_num_rows($result) > 0) {
						if ($row = mysql_fetch_assoc($result)) {
							$domain = $row["rowcount"];
						}
					}
					if ($domain){
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DOMAINURL_ALREADY_EXISTS);
					}
				} else {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DOMAINURL_INVALID_CHARS);
				}
			}
        }

		else if ($form == "packagesettings") {

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == "A") {
				if (domain_numberPackages(false,$module,$level) > 0){

					if ($module == "listing"){
						$aux_module_title = system_showText(LANG_LISTING_FEATURE_NAME);
					} else if ($module == "classified"){
						$aux_module_title = system_showText(LANG_CLASSIFIED_FEATURE_NAME);
					} else if ($module == "event"){
						$aux_module_title = system_showText(LANG_EVENT_FEATURE_NAME);
					} else if ($module == "article"){
						$aux_module_title = system_showText(LANG_ARTICLE_FEATURE_NAME);
					}

					if ($module == "article"){
						$aux_message = str_replace("[VAR_MODULE]", string_ucwords($aux_module_title), LANG_SITEMGR_MAX_PACKAGE_DOMAIN2);
					} else {
						$aux_message = str_replace("[VAR_LEVEL]", string_ucwords($level_title), LANG_SITEMGR_MAX_PACKAGE_DOMAIN);
						$aux_message = str_replace("[VAR_MODULE]", string_ucwords($aux_module_title), $aux_message);
					}


					$errors[] = "&#149;&nbsp;".system_showText($aux_message)."";
				}
			}
		}

		else if ($form == "package") {

			if (!$ordered_item) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ORDEROPTIONISREQUIRED)."";
			if (!$offer_item) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_OFFEROPTIONISREQUIRED)."";

			if ($offer_item == "custom_package"){
				if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PACKAGETITLEISREQUIRED)."";
				if (!${"content"}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CONTENTISREQUIRED)."";
			} else {
				if (!$packageItem_domain_id)  {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_DOMAINISREQUIRED)."";
				} else {
					$flag = false;
					$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";

					foreach ($packageItem_domain_id as $packdomain_id){
						if ((${"value_domain_".$packdomain_id} && !preg_match($money_regex, ${"value_domain_".$packdomain_id})) || (!is_numeric(${"value_domain_".$packdomain_id}) && ${"value_domain_".$packdomain_id})){
							$flag = true;
						}
					}
					if($flag) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);
				}
				if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PACKAGETITLEISREQUIRED)."";
			}

			if ($price){
				$flag = false;
				$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";

				if ($price && !preg_match($money_regex, $price)) {
					$flag = true;
				}

				if($flag) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);
			}
		}

        else if ($form == "importsettings") {

			if (!$status) $errors[] = "&#149;&nbsp;Status is required.";
			if (!$action) $errors[] = "&#149;&nbsp;Action is required.";
            if ($action && $status) {
                if (!import_validateStatusCombinations($status, $action)) $errors[] = "&#149;&nbsp;Combination between Status and Action not valid.";
            }

		}

        else if ($form == "mobile_screen") {

            $type = ($submit_ios ? "ios" : ($submit_android ? "android" : ""));

            if ($type == "android") {
                if (!$_FILES["image_".$type]["tmp_name"] && !file_exists(EDIRECTORY_ROOT.@constant("IMAGE_SCREEN_".strtoupper($type)."_PATH"))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MOBILE_ERROR_IMAGE);
            }

            if (!${"storelink_".$type}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MOBILE_ERROR_URL);

            if ($type == "android") {
                if (!${"popuptitle_".$type}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MOBILE_ERROR_POPUP);
            }

            if (!${"status_".$type}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED);

		}

		$error = "";

		if ($email && validate_signupPages($isforeignAcc)) {
			if (!validate_email($email)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS);
			}
		}

		if ($emails) {
			if (!validate_emails($emails)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS);
			}
		}

		if ($url) {
			if (!validate_url($url)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_URL);
			}
		}

		if ($description) {
			if (string_strlen($description) > 255) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS);
		}

		if ($conditions && ($form != "promotion")) {
			if (string_strlen($conditions) > 255) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS);
		} else if ($conditions && ($form == "promotion")) {
			if (string_strlen($conditions) > 1000) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS);
		}

		if ($renewal_date) {
			if (!validate_date($renewal_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_RENEWAL_DATE);
			} elseif (!validate_isFutureDate($renewal_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_RENEWAL_DATE_IN_FUTURE);
			}
		}

		if ($expiration_date) {
			if (!validate_date($expiration_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EXPIRATION_DATE);
			} elseif (!validate_isFutureDate($expiration_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EXPIRATION_DATE_IN_FUTURE);
			}
		}

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_listingtemplate($array, &$error, $validateAll = true) {

		extract($array);

        $count_customcheckbox = 0;
        $count_customdropdown = 0;
        $count_customtext = 0;
        $count_customshortdesc = 0;
        $count_customlongdesc = 0;
        $dbObjCustom = db_getDBObJect();
        $sqlCustom = "DESC Listing";
        $resultCustom = $dbObjCustom->query($sqlCustom);
        while ($rowCustom = mysql_fetch_assoc($resultCustom)) {
            if (string_strpos($rowCustom["Field"], "custom_checkbox") !== false) {
                $count_customcheckbox++;
            } elseif (string_strpos($rowCustom["Field"], "custom_dropdown") !== false) {
                $count_customdropdown++;
            } elseif (string_strpos($rowCustom["Field"], "custom_text") !== false) {
                $count_customtext++;
            } elseif (string_strpos($rowCustom["Field"], "custom_short_desc") !== false) {
                $count_customshortdesc++;
            } elseif (string_strpos($rowCustom["Field"], "custom_long_desc") !== false) {
                $count_customlongdesc++;
            }
        }

        if ($validateAll){
            if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEISREQUIRED);
            if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED);
        }

		$money_regex = "/^([0-9]{1,5})(\.[0-9]{1,2})?/";
		if ($price && !preg_match($money_regex, $price)) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
		}

        $j = 1;
        for ($i=0; $i<$count_customdropdown; $i++) {
            if ($label["custom_dropdown".$i] && !$fieldvalues["custom_dropdown".$i]) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_MISSINGVALUES)." ".$j;
            }
            if (!$label["custom_dropdown".$i] && $fieldvalues["custom_dropdown".$i]) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_MISSINGLABEL)." ".$j;
            }
            $j++;
        }

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_SM_changelogin($array, &$error) {
		extract($array);
		$error = "";
		if ($username) {

			if (!validate_email($username)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_USERNAME);
			}

			if (preg_match('/[^0-9a-zA-Z\@\.\_\-]/i', $username)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SPECIALCHARSNOTALLOWEDFORUSERNAME);
			}
			$smaccount_exists = db_getFromDB('smaccount', 'username', db_formatString($username));
			if ($smaccount_exists->getNumber("id")){
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
			}
		}
		if (string_strlen($password)) {
			$passwordError = validate_password($password);
			if (!empty($passwordError)) {
				$errors[] = $passwordError;
			} elseif (string_strlen($retype_password)) {
				if ($password != $retype_password) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PASSWORDSDONOTMATCH);
				}
			} else {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FIELDRETYPEPASSWORDISREQUIRED);
			}
		} else {
			if (string_strlen($retype_password)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASEENTERAPASSWORD);
			} elseif ($setlogin) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASEENTERAPASSWORD);
			}
		}
		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}
		return true;
	}

	function validate_MEMBERS_account($array, &$error, $currentUserID = 0) {

		extract($array);

		$error = "";

        if ($isforeignAcc != "y" && (string_strpos($_SERVER["PHP_SELF"], "/resetpassword.php") === false)) {
            $usernameError = validate_username($username);
            if ($usernameError) $errors[] = $usernameError;

            $account_exists = db_getFromDB('account', 'username', db_formatString($username));
            if ($currentUserID && $account_exists->getNumber("id") && $currentUserID != $account_exists->getNumber("id")){
                $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_DIFFERENT_USERNAME);
            }

            if ($errors) {
                $error .= implode("<br />", $errors);
            }
        }

		if ((string_strlen($password)) || (string_strlen($retype_password))) {
            $error .= validate_password($password, $retype_password, true);
        }

		if ($error) {
			return false;
		}
		return true;
	}

	function validate_password($password, $retype_password="", $required=false) {

		$error = "";

		if (preg_match("/(\s)/", $password)) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD);

		} elseif (string_strlen($password) > PASSWORD_MAX_LEN) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS)." ".PASSWORD_MAX_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

		} elseif (string_strlen($password) < PASSWORD_MIN_LEN) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

		} elseif ($password == "abc123") {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_ABC123_NOT_ALLOWED);

		} elseif ($retype_password) {

			if ($password != $retype_password) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_PASSWORDS_DO_NOT_MATCH);

			}

		} elseif ($required) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_PASSWORDS_DO_NOT_MATCH);

		}

		return $error;

	}

	function validate_username($username) {

		$error = "";

		if (!$username) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_USERNAME_IS_REQUIRED);

		} elseif ($username) {


			if (!validate_email($username)) {
				$error = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_USERNAME);
			}

			if (preg_match("/(\s)/", $username)) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME);;

			} elseif (preg_match('/[^0-9a-zA-Z\@\.\_\-]/i', $username)) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME);

			} elseif (string_strlen($username) > USERNAME_MAX_LEN) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS)." ".USERNAME_MAX_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

			} elseif (string_strlen($username) < USERNAME_MIN_LEN) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS)." ".USERNAME_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

			}

		}

		return $error;

	}

	function validate_SM_account($array, &$error) {

		extract($array);

		$error = "";

		$usernameError = validate_username($username);
		if (!empty($usernameError)) $errors[] = $usernameError."<br />";

		$account_exists = db_getFromDB('account', 'username', db_formatString($username));
		if ($account_exists->getNumber("id")){
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
		}

		$passwordError = validate_password($password);
		if (!empty($passwordError)) $errors[] = $passwordError;

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_smaccount($array, &$error) {

		extract($array);

		$error = "";

		if (!$id) {
			$usernameError = validate_username($username);
			if (!empty($usernameError)) $errors[] = $usernameError;
		}

		if (!$id) {
			$smaccount_exists = db_getFromDB('smaccount', 'username', db_formatString($username));
			if ($smaccount_exists->getNumber("id")){
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
			} else {
				setting_get("sitemgr_username", $sm_username);
				if ($username == $sm_username) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
				}
			}
		}

		if ((!$id) || ($id && $password)) {
			$passwordError = validate_password($password, $retype_password, true);
			if (!empty($passwordError)) $errors[] = $passwordError;
		}

		if (!$name) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_NAMEISREQUIRED);
		}

		if (!$email) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EMAILISREQUIRED);
		} elseif ($email) {
			if (!validate_email($email)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDEMAILADDRESS);
			}
		}

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_addAccount($array, &$error) {

		extract($array);

		$error = "";

		$usernameError = validate_username($username);
		if ($usernameError) $errors[] = $usernameError;

		$account_exists = db_getFromDB('account', 'username', db_formatString($username));
		if ($account_exists->getNumber("id")){
			$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_DIFFERENT_USERNAME);
		}

		if ($password == '0') {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";
		} else if (!$password) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PASSWORD_IS_REQUIRED);
		} else {
			$pass_error = validate_password($password, $retype_password, true);
			if($pass_error) $errors[] = $pass_error;
		}

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_memberCurrentPassword($array, $account_id, &$error) {
		extract($array);
		$error = "";
		$sql = "SELECT * FROM Account WHERE id = ".db_formatString($account_id)." AND password = ".db_formatString(((string_strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($array["current_password"]) : $array["current_password"]));
		$user = db_getFromDBBySQL("account", $sql);
		if (count($user)) {
			return true;
		} else {
			$error = "&#149;&nbsp;".system_showText(LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT);
			return false;
		}
	}

	function validate_sitemgrCurrentPassword($array, $sm_id, &$error) {
		extract($array);
		$error = "";
		$sql = "SELECT * FROM SMAccount WHERE id = ".db_formatString($sm_id)." AND password = ".db_formatString(md5($array["current_password"]));
		$user = db_getFromDBBySQL("smaccount", $sql);
		if (count($user)) {
			return true;
		} else {
			$error = system_showText(LANG_SITEMGR_MSGERROR_CURRENTPASSWORDINCORRECT);
			return false;
		}
	}

	function validate_demodirectoryDotCom($user_name, &$error) {
		$error = "";
		if (!strcmp($user_name,"demo@demodirectory.com")) {
			$error = "&#149;&nbsp;".system_showText(LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION);
			return false;
		}
		return true;
	}

    function validateActive($var) {
        return (($var == y) ? $var : false);
    }

	/**
	 * <code>
	 *		validate_DayWeek($startdate, $enddate, $weekday);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name validate_DayWeek
	 * @access Public
	 * @param date $startdate
	 * @param date $enddate
	 * @param string $weekday
	 * @return boolean
	 */
	function validate_DayWeek($startdate, $enddate, $weekday){
		$array_weekday = explode(",",$weekday);
		$week_day_names = array(1=>"Sunday", 2=>"Monday", 3=>"Tuesday", 4=>"Wednesday", 5=>"Thursday", 6=>"Friday", 7=>"Saturday");

		/*
		 * Get timestamp from $startdate
		 */
		$sd_timestamp = system_getTimeStamp($startdate);
		/*
		 * Get timestamp from $enddate
		 */
		$ed_timestamp = system_getTimeStamp($enddate);

		/*
		 * Get the difference in days beteween two dates
		 */
		$diffdays = system_getDiffDays($sd_timestamp, $ed_timestamp);

		if ($diffdays < 7) {
			/*
			 * Get week number from $startdate
			 */
			$sd_dayweek = date("l", $sd_timestamp);
			/*
			 * Get week number from $enddate
			 */
			$ed_dayweek = date("l", $ed_timestamp);

			$day_keys = array();
			foreach ($week_day_names as $k=>$week_day_name) {
				if ($week_day_name == $sd_dayweek) {
					$day_keys["start"] = $k;
				}

				if ($week_day_name == $ed_dayweek) {
					$day_keys["end"] = $k;
				}
			}

			foreach ($array_weekday as $weekday) {
				if ($day_keys["start"] > $day_keys["end"]){
					if ($weekday < $day_keys["start"] && $weekday > $day_keys["end"]) {
						return false;
						break;
					}
				} else{
				if ($weekday < $day_keys["start"] || $weekday > $day_keys["end"]) {
					return false;
					break;
				}
			}


			}
			return true;
		} else {
			return true;
		}
	}

	/**
	 * <code>
	 *		validate_EveryDay($startdate, $enddate, $day);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name validate_EveryDay
	 * @access Public
	 * @param date $startdate
	 * @param date $enddate
	 * @param integer $day
	 * @return boolean
	 */
	function validate_EveryDay($startdate, $enddate, $day) {
		/*
		 * Get the timestamp from $startdate
		 */
		$sd_timestamp = system_getTimeStamp($startdate);
		/*
		 * Get the timestamp from $enddate
		 */
		$ed_timestamp = system_getTimeStamp($enddate);

		/*
		 * Get the difference in days beteween two dates
		 */
		$diffdays = system_getDiffDays($sd_timestamp, $ed_timestamp);

		/*
		 * Get the number of days of $startdate
		 */
		$sd_days = system_getMonthNumDays($startdate);

		if ($diffdays >= 31) {
			if ($day > $sd_days) {
				return false;
			} else {
				return true;
			}
		} else {
			if (DEFAULT_DATE_FORMAT == "m/d/Y") {
				list ($sd_month, $sd_day, $sd_year)= explode("/", $startdate);
				list ($ed_month, $ed_day, $ed_year)= explode("/", $enddate);
			} elseif (DEFAULT_DATE_FORMAT == "d/m/Y"){
				list ($sd_day, $sd_month, $sd_year)= explode("/", $startdate);
				list ($ed_day, $ed_month, $ed_year)= explode("/", $enddate);
			}

			if ($sd_month == $ed_month) {
				if ($day >= $sd_day && $day <= $ed_day) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($day > $sd_days) {
					return false;
				} else {
					if ($day >= $sd_day || $day <= $ed_day) {
						return true;
					} else {
						return false;
					}
				}
			}
		}
	}

	/**
	 * <code>
	 *		validate_NumberWeek($startdate, $enddate, $week);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name validate_NumberWeek
	 * @access Public
	 * @param date $startdate
	 * @param date $enddate
	 * @param integer $week
	 * @return boolean
	 */
	function validate_NumberWeek($startdate, $enddate, $week) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			list ($sd_month, $sd_day, $sd_year)= explode("/", $startdate);
			list ($ed_month, $ed_day, $ed_year)= explode("/", $enddate);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y"){
			list ($sd_day, $sd_month, $sd_year)= explode("/", $startdate);
			list ($ed_day, $ed_month, $ed_year)= explode("/", $enddate);
		}

		$week_aux = $week - 1;
		$week_aux2 = $week_aux + 1;

		$nw_sd = system_getNumberWeek($startdate);
		$nw_ed = system_getNumberWeek($enddate);

		if ($sd_month == $ed_month && $sd_year == $ed_year) {
			$first_day = 1;
			$last_day = system_getMonthNumDays($startdate);
			if (DEFAULT_DATE_FORMAT == "m/d/Y") {
				$first_week = system_getNumberWeek($sd_month."/".$first_day."/".$sd_year);
				$last_week = system_getNumberWeek($sd_month."/".$last_day."/".$sd_year);
			} elseif (DEFAULT_DATE_FORMAT == "d/m/Y"){
				$first_week = system_getNumberWeek($first_day."/".$sd_month."/".$sd_year);
				$last_week = system_getNumberWeek($last_day."/".$sd_month."/".$sd_year);
			}

			$monthWeeks = $last_week - $first_week;
			if (($first_week + $week_aux == $nw_sd) && ($nw_sd + ($week_aux - ($nw_sd-$first_week)) <= $last_week)) {
				return true;
			} else {
				return false;
			}
		} else {
			$a1 = ($ed_year - $sd_year)*12;
			$m1 = ($ed_month - $sd_month)+1;
			$m3 = ($m1 + $a1);

			$sd_aux = $sd_month + $sd_year;
			$ed_aux = $ed_month + $ed_year + 12;

			$nYear = false;
			$aux_year = $sd_year;
			for ($i = 0; $i < $m3; $i++) {
				if (!$nYear) {
					$aux_month = $sd_month + $i;
				} else {
					$aux_month = 1 + $i;
					$nYear = false;
					$aux_year += 1;
				}
				if ($aux_month >= 12) {
					$aux_month = 12;
					$nYear = true;
				}

				$aux_date = $aux_month."/"."01/".$aux_year;

				$first_day = 1;
				$last_day = system_getMonthNumDays($aux_date);
				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$first_week = system_getNumberWeek($aux_month."/".$first_day."/".$aux_year);
					$last_week = system_getNumberWeek($aux_month."/".$last_day."/".$aux_year);
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y"){
					$first_week = system_getNumberWeek($first_day."/".$aux_month."/".$aux_year);
					$last_week = system_getNumberWeek($last_day."/".$aux_month."/".$aux_year);
				}

				$monthWeeks = $last_week - $first_week + 1;
				if ($monthWeeks == 4 && $week_aux == 4) $week_aux -= 1;

				if ($ed_month-1 != $sd_month){
					return true;
				} else {
					if (((($first_week + $week_aux) >= $nw_sd) && $i==0) || ((($last_week - ($monthWeeks - $week_aux)) < $nw_ed)) && $i==1) {
						return true;
					} else {
						$error = true;
					}
				}
			}
			if ($error) {
				return false;
			}
		}
	}

	/**
	 * <code>
	 *		validate_NumberMonth($startdate, $enddate, $month);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name validate_NumberMonth
	 * @access Public
	 * @param date $startdate
	 * @param date $enddate
	 * @param integer $month
	 * @return boolean
	 */
	function validate_NumberMonth($startdate, $enddate, $month) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			list ($sd_month, $sd_day, $sd_year)= explode("/", $startdate);
			list ($ed_month, $ed_day, $ed_year)= explode("/", $enddate);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y"){
			list ($sd_day, $sd_month, $sd_year)= explode("/", $startdate);
			list ($ed_day, $ed_month, $ed_year)= explode("/", $enddate);
		}

		if ($sd_year == $ed_year) {
			if ($month >= $sd_month && $month <= $ed_month) {
				return true;
			} else {
				return false;
			}
		} else {
			$a1 = ($ed_year - $sd_year)*12;
			$m1 = ($ed_month - $sd_month)+1;
			$m3 = ($m1 + $a1);

			if ($m3 >= 12) {
				return true;
			} else {
				if (($month >= $sd_month && $month <= 12) || ($month >= 1 && $month <= $ed_month)) {
					return true;
				} else {
					return false;
				}
			}
		}
	}

	/**
	 * <code>
	 *		validate_ImageforTheme($tmp_name, $userfile_type, $userfile_size, $error);
	 * <code>
	 * @copyright Copyright 2011 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 9.1.00
	 * @name validate_ImageforTheme
	 * @access Public
	 * @param file $tmp_name
	 * @param file $userfile_type
	 * @param file $userfile_size
	 * @param string $error
	 * @return boolean
	 */
	function validate_ImageforTheme($tmp_name, $userfile_type, $userfile_size, &$error){

		$maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1)."00000";
		$types = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
		$info = @getimagesize($tmp_name);

		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "PNG") || ($types[$info[2]] == "GIF") ) {
			$error = "";
		}else{
			$error = LANG_SITEMGR_COLOR_INVALID_IMAGE; //invalid image type
		}

		//check if the file size is above the allowed limit
		if ($userfile_size > $maxImageSize) {
			$error = LANG_MSG_IMAGE_FILE_TOO_LARGE." ".LANG_MSG_MAX_FILE_SIZE." ".UPLOAD_MAX_SIZE.". ".LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE;
		}

		if (empty($error)){
			return true;
		} else {
			return false;
		}

	}

    function validate_signupPages($isforeignAcc = false) {
        $page = $_SERVER["PHP_SELF"];
        $pageClaim = $_SERVER["REQUEST_URI"];
        if ($isforeignAcc == "y") {
            return true;
        } elseif (string_strpos($page, MEMBERS_ALIAS."/account/index.php") !== false || string_strpos($page, SITEMGR_ALIAS."/account/account.php") !== false || string_strpos($page, SOCIALNETWORK_FEATURE_NAME."/add.php") !== false || string_strpos($pageClaim, ALIAS_CLAIM_URL_DIVISOR) !== false || string_strpos($page, SOCIALNETWORK_FEATURE_NAME."/edit.php") !== false || string_strpos($page, "order_") !== false) {
            return false;
        } else {
            return true;
        }

    }
?>
