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
	# * FILE: /functions/mobile_funct.php
	# ----------------------------------------------------------------------------------------------------

	// Detect any Mobile Device
	function mobile_isMobile() {

		$isMobile = "n";

		$httpuseragent[] = "ALCATEL";
		$httpuseragent[] = "AU-MIC,";
		$httpuseragent[] = "AUDIOVOX";
		$httpuseragent[] = "AVANTGO";
		$httpuseragent[] = "BLACKBERRY";
		$httpuseragent[] = "BLAZER";
		$httpuseragent[] = "CLDC-";
		$httpuseragent[] = "DANGER";
		$httpuseragent[] = "EPOC";
		$httpuseragent[] = "ERICSSON";
		$httpuseragent[] = "ERICY";
		$httpuseragent[] = "HANDSPRING";
		$httpuseragent[] = "IEMOBILE";
		$httpuseragent[] = "IPAQ";
		$httpuseragent[] = "J2ME";
		$httpuseragent[] = "KYOCERA";
		$httpuseragent[] = "LG";
		$httpuseragent[] = "MMP";
		$httpuseragent[] = "MIDP";
		$httpuseragent[] = "MIDP-";
		$httpuseragent[] = "MINI";
		$httpuseragent[] = "MOBILE";
		$httpuseragent[] = "MOT";
		$httpuseragent[] = "MOTOROLA";
		$httpuseragent[] = "NETFRONT";
		$httpuseragent[] = "NITRO";
		$httpuseragent[] = "NOKIA";
		$httpuseragent[] = "OPERA MINI";
		$httpuseragent[] = "OPWV";
		$httpuseragent[] = "PALM";
		$httpuseragent[] = "PALMSOURCE";
		$httpuseragent[] = "PANASONIC";
		$httpuseragent[] = "PDA";
		$httpuseragent[] = "PHILIPS";
		$httpuseragent[] = "PHONE";
		$httpuseragent[] = "PLAYSTATION PORTABLE";
		$httpuseragent[] = "POCKET";
		$httpuseragent[] = "POCKETPC";
		$httpuseragent[] = "PORTALMMM";
		$httpuseragent[] = "PSP";
		$httpuseragent[] = "ROVER";
		$httpuseragent[] = "SAMSUNG";
		$httpuseragent[] = "SANYO";
		$httpuseragent[] = "SERIES60";
		$httpuseragent[] = "SHARP";
		$httpuseragent[] = "SIE-";
		$httpuseragent[] = "SMARTPHONE";
		$httpuseragent[] = "SONY";
		$httpuseragent[] = "SONYERICSSON";
		$httpuseragent[] = "SYMBIAN";
		$httpuseragent[] = "UP.BROWSER";
		$httpuseragent[] = "UP.LINK";
		$httpuseragent[] = "VODAFONE";
		$httpuseragent[] = "WAP";
		$httpuseragent[] = "WAP1.";
		$httpuseragent[] = "WAP2.";
		$httpuseragent[] = "WINDOWS CE";

		$browser[] = "ACS-";
		$browser[] = "ALAV";
		$browser[] = "ALCA";
		$browser[] = "AMOI";
		$browser[] = "ASTE";
		$browser[] = "AUDI";
		$browser[] = "AUR ";
		$browser[] = "AVAN";
		$browser[] = "BENQ";
		$browser[] = "BIRD";
		$browser[] = "BLAC";
		$browser[] = "BLAZ";
		$browser[] = "BREW";
		$browser[] = "CELL";
		$browser[] = "CLDC";
		$browser[] = "CMD-";
		$browser[] = "DANG";
		$browser[] = "DOCO";
		$browser[] = "ERIC";
		$browser[] = "FETC";
		$browser[] = "HIPT";
		$browser[] = "INNO";
		$browser[] = "IPAQ";
		$browser[] = "JAVA";
		$browser[] = "JIGS";
		$browser[] = "KDDI";
		$browser[] = "KEJI";
		$browser[] = "LENO";
		$browser[] = "LG-C";
		$browser[] = "LG-D";
		$browser[] = "LG-G";
		$browser[] = "LGE-";
		$browser[] = "MAUI";
		$browser[] = "MAXO";
		$browser[] = "MC21";
		$browser[] = "MIDP";
		$browser[] = "MITS";
		$browser[] = "MMEF";
		$browser[] = "MOBI";
		$browser[] = "MOT-";
		$browser[] = "MOTO";
		$browser[] = "MWBP";
		$browser[] = "MY S";
		$browser[] = "NEC-";
		$browser[] = "NEWT";
		$browser[] = "NOKI";
		$browser[] = "OPWV";
		$browser[] = "PALM";
		$browser[] = "PANA";
		$browser[] = "PANT";
		$browser[] = "PDXG";
		$browser[] = "PHIL";
		$browser[] = "PLAY";
		$browser[] = "PLUC";
		$browser[] = "PORT";
		$browser[] = "PROX";
		$browser[] = "QTEK";
		$browser[] = "QWAP";
		$browser[] = "R380";
		$browser[] = "SAGE";
		$browser[] = "SAMS";
		$browser[] = "SANY";
		$browser[] = "SCH-";
		$browser[] = "SEC-";
		$browser[] = "SEND";
		$browser[] = "SERI";
		$browser[] = "SGH-";
		$browser[] = "SHAR";
		$browser[] = "SIE-";
		$browser[] = "SIEM";
		$browser[] = "SMAL";
		$browser[] = "SMAR";
		$browser[] = "SONY";
		$browser[] = "SPH-";
		$browser[] = "SYMB";
		$browser[] = "T-MO";
		$browser[] = "TELI";
		$browser[] = "TIM-";
		$browser[] = "TOSH";
		$browser[] = "TSM-";
		$browser[] = "UP.B";
		$browser[] = "UPG1";
		$browser[] = "UPSI";
		$browser[] = "VK-V";
		$browser[] = "VODA";
		$browser[] = "W3C ";
		$browser[] = "WAP-";
		$browser[] = "WAPA";
		$browser[] = "WAPI";
		$browser[] = "WAPJ";
		$browser[] = "WAPP";
		$browser[] = "WAPR";
		$browser[] = "WEBC";
		$browser[] = "WINW";
		$browser[] = "XDA ";
		$browser[] = "XDA-";

		$myhttpaccept = string_strtoupper(trim($_SERVER["HTTP_ACCEPT"]));
		$mywapprofile = string_strtoupper(trim($_SERVER["HTTP_X_WAP_PROFILE"]));
		$myhttpprofile = string_strtoupper(trim($_SERVER["HTTP_PROFILE"]));
		$myoperaminiphone = string_strtoupper(trim($_SERVER["HTTP_X_OPERAMINI_PHONE"]));
		$myoperaminifeatures = string_strtoupper(trim($_SERVER["X-OperaMini-Features"]));
		$myoperamini = string_strtoupper(trim($_SERVER["ALL_HTTP"]));
		$myuapixels = string_strtoupper(trim($_SERVER["UA-pixels"]));
		$myhttpuseragent = string_strtoupper(trim($_SERVER["HTTP_USER_AGENT"]));
		$mybrowser = string_strtoupper(string_substr($myhttpuseragent, 0, 4));

		if ((string_strpos($myhttpaccept, "WAP") !== false) || ($mywapprofile != "") || ($myhttpprofile != "") || ($myoperaminiphone != "") || ($myoperaminifeatures != "") || (string_strpos($myoperamini, "OPERAMINI") !== false) || ($myuapixels != "")) {
			$isMobile = "y";
		} else {
			if (in_array($mybrowser, $browser)) {
				$isMobile = "y";
			} else {
				foreach ($httpuseragent as $httpuseragent_aux) {
					if (string_strpos($myhttpuseragent, $httpuseragent_aux) !== false) {
						$isMobile = "y";
					}
				}
			}
		}
		if ((string_strpos($myhttpuseragent, "WINDOWS") !== false) && (string_strpos($myhttpuseragent, "WINDOWS CE") === false)) {
			$isMobile = "n";
		}
		if ((string_strpos($myhttpuseragent, "APPLE") !== false) && (string_strpos($myhttpuseragent, "IPAD") !== false)) {
			$isMobile = "n";
		}


		return $isMobile;

	}

	// Detect Mac (iPhone and/or iPod) Mobile Device
	function mobile_isMacMobile() {

		$isMacMobile = "n";

		$myhttpuseragent = string_strtoupper(trim($_SERVER["HTTP_USER_AGENT"]));

		if ((string_strpos($myhttpuseragent, "MAC") !== false) && ((string_strpos($myhttpuseragent, "PPC") !== false) ||  (string_strpos($myhttpuseragent, "IPHONE") !== false) ||  (string_strpos($myhttpuseragent, "IPOD") !== false) ||  (string_strpos($myhttpuseragent, "IPAD") !== false))) {
			$isMacMobile = "y";
		}

		return $isMacMobile;

	}
    
    // Detect Mobile Device (iPhone/iPod or Android)
    function mobile_splashScreen($getLink = false) {
        
        $device = "";
        $myhttpuseragent = string_strtoupper(trim($_SERVER["HTTP_USER_AGENT"]));
        
        if ((string_strpos($myhttpuseragent, "MAC") !== false) && ((string_strpos($myhttpuseragent, "IPHONE") !== false) ||  (string_strpos($myhttpuseragent, "IPOD") !== false))) {
			$device = "iphone";
            $type = "ios";
        } elseif ((string_strpos($myhttpuseragent, "ANDROID") !== false)) {
            $device = "android";
            $type = "android";
        }
        if (!DEMO_LIVE_MODE && !$getLink) {
            setting_get("app_status_".$type, $status);
            if ($status != "A") unset($device);
        }
        
        return $device;
        
    }
?>
