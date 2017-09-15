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
	# * FILE: /includes/code/smartbanner.php
	# ----------------------------------------------------------------------------------------------------

    $isMobile = mobile_isMobile();

    if ($isMobile == "y") {
        $auxDevice = mobile_splashScreen();
        if ($auxDevice == "iphone" || $auxDevice == "android") {

            if ($auxDevice == "iphone") {
                $type = "ios";
                $defaultImg = DEFAULT_URL."/mobile/layout/fancybox/imgs/default-apple.png";
            } elseif ($auxDevice == "android") {
                $type = "android";
                $defaultImg = DEFAULT_URL."/mobile/layout/fancybox/imgs/default-android.png";
            }

            if (DEMO_LIVE_MODE) {
                $appID = @constant("DEMO_MOBILE_APPURL_".strtoupper($type)); //APP ID
                $popuptitle = "eDirectory"; //APP TITLE
                $price = LANG_FREE; //APP PRICE
                $tagline = system_showText(@constant("LANG_MOBILE_GRAB_APP_".strtoupper($auxDevice))); //APP PRICE DESCRIPTION
                $status = "A"; //Smart Banner status
                $imgURL = $defaultImg; //App icon
            } else {
                setting_get("app_storelink_".$type, $appID); //APP ID
                setting_get("app_popuptitle_".$type, $popuptitle); //APP TITLE
                setting_get("app_price_".$type, $price); //APP PRICE
                setting_get("app_tagline_".$type, $tagline); //APP PRICE DESCRIPTION
                setting_get("app_status_".$type, $status); //Smart Banner status
                $imgURL = DEFAULT_URL.@constant("IMAGE_SCREEN_".strtoupper($type)."_PATH"); //App icon
            }

            if ($status == "A" && $appID && (($popuptitle && $type == "android") || ($type == "ios"))) {

                if ($scriptFunct) {

                    system_scriptColectorCSS("/scripts/jquery/smartbanner/jquery.smartbanner.css", false, false);
                    system_scriptColector("/scripts/jquery/smartbanner/jquery.smartbanner.js", false, false, false);

                    //for Android, smart banner needs the js plugin settings below plus the meta tag for type
                    //for iPhone, just the meta tag with the app id is enough, otherwise the plugin will show two banners (the one built from the meta plus the one built from the js
                    if ($type == "android") {

                        $smartBanner = "
                            $.smartbanner({
                                title: '".addslashes($popuptitle)."', // What the title of the app should be in the banner (defaults to <title>)
                                author: '', // What the author of the app should be in the banner (defaults to <meta name=\"author\"> or hostname)
                                price: '".addslashes($price)."', // Price of the app
                                appStoreLanguage: 'us', // Language code for App Store
                                inAppStore: '".addslashes($tagline)."', // Text of price for iOS
                                inGooglePlay: '".addslashes($tagline)."', // Text of price for Android
                                icon: '$imgURL', // The URL of the icon (defaults to <link>)
                                iconGloss: null, // Force gloss effect for iOS even for precomposed (true or false)
                                button: '".system_showText(LANG_LABEL_VIEW)."', // Text on the install button
                                scale: 'auto', // Scale based on viewport size (set to 1 to disable)
                                speedIn: 300, // Show animation speed of the banner
                                speedOut: 400, // Close animation speed of the banner
                                daysHidden: 7, // Duration to hide the banner after being closed (0 = always show banner)
                                daysReminder: 7, // Duration to hide the banner after \"VIEW\" is clicked (0 = always show banner)
                                force: '$type' // Choose 'ios' or 'android'. Don't do a browser check, just always show this banner
                            });";

                        $js_fileLoader = system_scriptColectorOnReady($smartBanner, $js_fileLoader, true);

                    }

                } elseif ($metatagHead) {
                    echo "<meta name=\"".($type == "ios" ? "apple-itunes" : "google-play")."-app\" content=\"app-id=$appID\" />";
                    if ($isMobileVersion) {
                        $addSmartBannerJs = true;
                    }
                }
            }
        }
    }