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
	# * FILE: /functions/format_funct.php
	# ----------------------------------------------------------------------------------------------------

	function format_dateFromDB($datetime, $format) {
		return date($format, mktime((int)string_substr($datetime, 11, 2), (int)string_substr($datetime, 14, 2), (int)string_substr($datetime, 17, 2), (int)string_substr($datetime, 5, 2), (int)string_substr($datetime, 8, 2), (int)string_substr($datetime, 0, 4)));
	}

	function format_printDateStandard() {
		$arrayAux = explode("/", DEFAULT_DATE_FORMAT);
		if (($arrayAux[0] == "m") && ($arrayAux[1] == "d") && ($arrayAux[2] == "Y")) {
			return system_showText(LANG_LETTER_MONTH).system_showText(LANG_LETTER_MONTH)."/".system_showText(LANG_LETTER_DAY).system_showText(LANG_LETTER_DAY)."/".system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR);
		} elseif (($arrayAux[0] == "d") && ($arrayAux[1] == "m") && ($arrayAux[2] == "Y")) {
			return system_showText(LANG_LETTER_DAY).system_showText(LANG_LETTER_DAY)."/".system_showText(LANG_LETTER_MONTH).system_showText(LANG_LETTER_MONTH)."/".system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR);;
		} else {
			return "xx/xx/xxxx";
		}
	}

	//***************************************************
	// format date from mysql data types
	// This "if" added to fix error of "mktime" on PHP 5.x:
	// if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
	function format_date($value = false, $format = DEFAULT_DATE_FORMAT, $field_type = "date", $pm = false) {
		if (!$value) return false;
		switch ($field_type) {
			case "date":
				list($year,$month,$day) = explode("-",$value);
				if ($month>0 || $day>0 || $year>0) $ts_date = mktime(0,0,0,(int)$month,(int)$day,(int)$year);
				if ($ts_date <= 0) return false;
				return date("$format",$ts_date);
			break;
			case "datetime":
				$date_time = explode(" ",$value);
				list($year,$month,$day) = explode("-",$date_time[0]);
				list($hour,$minute,$second) = explode(":",$date_time[1]);
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					$ts_date = mktime((int)$hour,(int)$minute,(int)$second,(int)$month,(int)$day,(int)$year);
				if ($ts_date <= 0) return false;
				return date("$format",$ts_date);
			break;
			case "set_event_datetime":
				$date_time = explode(" ",$value);
				list($month,$day,$year) = explode("/",$date_time[0]);
				list($hour,$minute,$second) = explode(":",$date_time[1]);
				if ($pm and $hour and $hour < 12) $hour = $hour + 12;
				if (!$pm and $hour and $hour == 12) $hour = $hour - 12;
				$hour = $hour ? $hour : "00";
				$minute = $minute ? $minute : "00";
				$second = $second ? $second : "00";
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					$ts_date = mktime((int)$hour,(int)$minute,(int)$second,(int)$month,(int)$day,(int)$year);
				if ($ts_date <= 0) return false;
				return date("$format",$ts_date);
			break;
			case "get_event_datetime":
				$year = string_substr($value,0,4);
				$month = string_substr($value,5,2);
				$day = string_substr($value,8,2);
				$hour = string_substr($value,11,2);
				$minute = string_substr($value,14,2);
				$second = "00";
				if ($hour >= 12) $data["am_pm"] = "pm";
				elseif ($hour < 12) $data["am_pm"] = "am";
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					$ts_date = mktime((int)$hour,(int)$minute,(int)$second,(int)$month,(int)$day,(int)$year);
				$data["date"] = date("$format",$ts_date);
				$data["time"] = date("h:i",$ts_date);
				return $data;
			break;
			case "timestamp":
				return date("$format",$value);
			break;
            case "gettimestamp":
				$date_time = explode(" ",$value);
				list($year,$month,$day) = explode("-",$date_time[0]);
				list($hour,$minute,$second) = explode(":",$date_time[1]);
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					$ts_date = mktime((int)$hour,(int)$minute,(int)$second,(int)$month,(int)$day,(int)$year);
				if ($ts_date <= 0) return false;
				return $ts_date;
			break;
			case "dbtimestamp":
				$hour	= string_substr($value, 8, 2);
				$minute	= string_substr($value, 10, 2);
				$second	= string_substr($value, 12, 2);
				$month	= string_substr($value, 4, 2);
				$day	= string_substr($value, 6, 2);
				$year	= string_substr($value, 0, 4);
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					return date($format, mktime((int)string_substr($value, 8, 2), (int)string_substr($value, 10, 2), (int)string_substr($value, 12, 2), (int)string_substr($value, 4, 2), (int)string_substr($value, 6, 2), (int)string_substr($value, 0, 4)));
				else
					return false;
			break;
			case "datetocompare" :
				return string_substr($value,6,4).string_substr($value,0,2).string_substr($value,3,2);
			break;
            case "datestring" :
                $date_time = explode(" ", $value);
				list($year, $month, $day) = explode("-", $date_time[0]);
				list($hour, $minute, $second) = explode(":", $date_time[1]);
				if ($hour > 0 || $minute > 0 || $second > 0 || $month > 0 || $day > 0 || $year > 0) {
					$ts_date = mktime((int)$hour, (int)$minute, (int)$second, (int)$month, (int)$day, (int)$year);
                }
				if ($ts_date <= 0) return false;

                $isSitemgrLang = false;
                if ((strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."") !== false)) {
                    $isSitemgrLang = true;
                    setting_get("sitemgr_language", $sitemgr_language_aux);
                }

                $thisYear = date("Y");

                if ((EDIR_LANGUAGE == "en_us" && !$isSitemgrLang) || ($isSitemgrLang && $sitemgr_language_aux == "en_us")) {
                    return date("M", $ts_date)." ".date("j", $ts_date).date("S", $ts_date).($year > $thisYear ? ", ".$year : "");
                } else {
                    return date("$format", $ts_date);
                }

            break;
		}
	}

	// format money from numeric values
	function format_money ($value, $decimal = true) {
		$value = number_format($value, 2, ".", ",");
		$value = str_replace(",","",$value);
		if (!is_numeric($value)) return "0.00";
		$aux = explode(".",$value);
		$cents = (count($aux) > 1)    ? array_pop($aux)   : "";
		$cents = (string_strlen($cents) > 2) ? string_substr($cents,0,2): $cents;
		$cents = str_pad($cents,2,"0",STR_PAD_RIGHT);
		$value = implode("",$aux);
		$formated_money = ($decimal) ? $value.".".$cents : $value ;
		return $formated_money;
	}

	/* replace to work under arrays */
	function format_magicQuotes($aList, $aIsTopLevel = true) {
		$gpcList = array();
		$isMagic = get_magic_quotes_gpc();
		foreach ($aList as $key => $value) {
			$decodedKey = ($isMagic && !$aIsTopLevel) ? stripslashes($key) : $key;
			if (is_array($value)) {
				$decodedValue = format_magicQuotes($value, false);
			} else {
				$decodedValue = ($isMagic) ? stripslashes($value) : $value;
			}
			if (string_strpos($decodedValue, "\"") !== false) $decodedValue = str_replace("\"", "&quot;", $decodedValue);
			$gpcList[$decodedKey] = $decodedValue;
		}
		return $gpcList;
	}


	/*
	 * Function to format string like getString()
	 */
	function format_getString($value,$special_chars=true){
		if (!is_string($value)){
			return $value;
		}
		$value = ($special_chars) ? htmlspecialchars($value) : $value ;
		return $value;
	}

	/*
	 * Function to format time string
	 */
	function format_getTimeString($value) {
		if (!$value) return;
		$startTimeStr = explode(":", $value);
		if (CLOCK_TYPE == '24') {
			$time_format = "H:i";
		} elseif (CLOCK_TYPE == '12') {
			$time_format = "h:i a";
		}
		$str_time = new DateTime($startTimeStr[0].':'.$startTimeStr[1]);
		$str_time->setTimezone(new DateTimeZone(date("e")));

		return $str_time->format($time_format);
	}

    function format_addApostWords($string){
        if (!$string)return false;
        $stringARR=explode(" ",$string);
        foreach ($stringARR as $word){

            if (stripos($word,"'s"))
                $newword=str_replace("'s", "", $word);

            if (stripos($word,"s'"))
                $newword=str_replace("s'", "", $word);

            if ($newword)
                $newStringArr[]=$newword;

            unset($newword);
        }
        if (is_array($newStringArr)){
            $newStringArr=array_unique($newStringArr);
            return (implode(' ',$newStringArr));
        } else return false;
    }
?>
