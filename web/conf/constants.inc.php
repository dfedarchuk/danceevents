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
	# * FILE: /conf/constants.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php")) {
		include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php");
	} else {
		die("Constants file not found for this domain. Please contact support.");
	}

	if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork/socialnetwork.inc.php")) {
		include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork/socialnetwork.inc.php");
	} else {
		define("SOCIALNETWORK_FEATURE", "on");
	}

	# ****************************************************************************************************
	# PASSWORD ENCRYPTION (DEFAULT ON)
	# ****************************************************************************************************
	define("PASSWORD_ENCRYPTION", "on");
    # ****************************************************************************************************
	# GOOGLE MAPS KEY FOR DEMODIRECTORY.COM
	# ****************************************************************************************************
    define("GOOGLE_MAPS_APP_DEMO", "AIzaSyDM5pcvIu56ezCjKvI8VC0hR3BlduzBXYA");
    define("GOOGLE_GEOLOCATION_APP_DEMO", "");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY VERSION
	# NOTE: Do not alter this area of the code manually.
	# Any changes will require eDirectory to be activated again.
	# ----------------------------------------------------------------------------------------------------
	define("VERSION", "v.11.2.10");

	# ----------------------------------------------------------------------------------------------------
	# ITEM CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_FEATURE_FOLDER",		"listing");
	define("PROMOTION_FEATURE_FOLDER",		"deal");
	define("EVENT_FEATURE_FOLDER",			"event");
	define("CLASSIFIED_FEATURE_FOLDER",		"classified");
	define("ARTICLE_FEATURE_FOLDER",		"article");
	define("BLOG_FEATURE_FOLDER",			"blog");
	define("BANNER_FEATURE_FOLDER",			"banner");

    # ----------------------------------------------------------------------------------------------------
	# PROFILE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SOCIALNETWORK_FEATURE_NAME",	"profile");
	define("SOCIALNETWORK_ROOT",			EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME);
	define("SOCIALNETWORK_URL",				DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME);

    # ----------------------------------------------------------------------------------------------------
	# TIMELINE ITEM PER PAGE
	# ----------------------------------------------------------------------------------------------------
	define("TIMELINE_RESULTS_PER_PAGE", 3);

	# ----------------------------------------------------------------------------------------------------
	# PACKAGE SETTINGS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_PACKAGE_DOMAIN", 1);

	# ----------------------------------------------------------------------------------------------------
	# DISCOUNT CODE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("DISCOUNTCODE_LABEL", "promotional code"); // layout works for: "discount code" and "promotional code" (available to any label)

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("ZIPCODE_US", "on"); // on/off
	define("ZIPCODE_CA", "off"); // on/off
	define("ZIPCODE_UK", "off"); // on/off
	define("ZIPCODE_AU", "off"); // on/off

	# ----------------------------------------------------------------------------------------------------
	# FRIENDLY URL CONSTANTS
	# IMPORTANT - PAY ATTENTION
	# Any changes here need to be done in all .htaccess (modrewrite)
	# ----------------------------------------------------------------------------------------------------
	define("FRIENDLYURL_SEPARATOR",         "-");
	define("FRIENDLYURL_VALIDCHARS",        "a-zA-Z0-9");
	define("FRIENDLYURL_REGULAREXPRESSION", "/^[".FRIENDLYURL_VALIDCHARS.FRIENDLYURL_SEPARATOR."]{1,}/");

	# ----------------------------------------------------------------------------------------------------
	# DIRECTORY PATH DEFINITIONS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_EDIRECTORY_ROOT",   EDIRECTORY_ROOT."/".MEMBERS_ALIAS);
	define("SM_EDIRECTORY_ROOT",        EDIRECTORY_ROOT."/".SITEMGR_ALIAS);

	# ----------------------------------------------------------------------------------------------------
	# SITE MANAGER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SM_LOGIN_PAGE",     DEFAULT_URL."/".SITEMGR_ALIAS."/login.php");
	define("SM_LOGOUT_PAGE",    DEFAULT_URL."/".SITEMGR_ALIAS."/logout.php");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_LOGIN_PAGE",    DEFAULT_URL."/".MEMBERS_ALIAS."/login.php");
	define("MEMBERS_LOGOUT_PAGE",   DEFAULT_URL."/".MEMBERS_ALIAS."/logout.php");

	# ----------------------------------------------------------------------------------------------------
	# UPLOAD CONSTANTS
	# ----------------------------------------------------------------------------------------------------.
	define("UPLOAD_MAX_SIZE",               "1.5"); //in MB
	define("BANNER_UPLOAD_MAX_SIZE",        "400"); //in KB
	define("BANNER_UPLOAD_MAX_SIZE_INBYTE", "409600"); //in BYTES
	define("SLIDER_UPLOAD_MAX_SIZE_INBYTE", "409600"); //in BYTES

	# ----------------------------------------------------------------------------------------------------
	# IMAGE FOLDER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("IMAGE_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/image_files");
	define("IMAGE_DIR",             EDIRECTORY_ROOT.IMAGE_RELATIVE_PATH);
	define("IMAGE_URL",             DEFAULT_URL.IMAGE_RELATIVE_PATH);

	define("PROFILE_IMAGE_RELATIVE_PATH",   "/custom/profile");
	define("PROFILE_IMAGE_DIR",             EDIRECTORY_ROOT.PROFILE_IMAGE_RELATIVE_PATH);
	define("PROFILE_IMAGE_URL",             DEFAULT_URL.PROFILE_IMAGE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# EXTRA FILES CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("EXTRAFILE_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/extra_files");
	define("EXTRAFILE_DIR",             EDIRECTORY_ROOT.EXTRAFILE_RELATIVE_PATH);
	define("EXTRAFILE_URL",             DEFAULT_URL.EXTRAFILE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("CLASSES_DIR",   EDIRECTORY_ROOT."/classes");
	define("INCLUDES_DIR",  EDIRECTORY_ROOT."/includes");
	define("FUNCTIONS_DIR", EDIRECTORY_ROOT."/functions");

	# ----------------------------------------------------------------------------------------------------
	# EXPIRE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("DEFAULT_LISTING_DAYS_TO_EXPIRE",    60);
	define("DEFAULT_EVENT_DAYS_TO_EXPIRE",      60);
	define("DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE", 10);
	define("DEFAULT_ARTICLE_DAYS_TO_EXPIRE",    60);

	# ----------------------------------------------------------------------------------------------------
	# KEYWORD CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_KEYWORDS", 10);

    # ----------------------------------------------------------------------------------------------------
	# THEME CONFIGURATION
	# ----------------------------------------------------------------------------------------------------

	# LISTING
	define("IMAGE_LISTING_FULL_WIDTH",          1024); //detail
	define("IMAGE_LISTING_FULL_HEIGHT",         768); //detail
	define("IMAGE_LISTING_THUMB_WIDTH",         400); //summary
	define("IMAGE_LISTING_THUMB_HEIGHT",        300); //summary
	# PROMOTION
	define("IMAGE_PROMOTION_FULL_WIDTH",        1024); //detail
	define("IMAGE_PROMOTION_FULL_HEIGHT",       768); //detail
	define("IMAGE_PROMOTION_THUMB_WIDTH",       400); //summary
	define("IMAGE_PROMOTION_THUMB_HEIGHT",      300); //summary
	# EVENT
	define("IMAGE_EVENT_FULL_WIDTH",            1024); //detail
	define("IMAGE_EVENT_FULL_HEIGHT",           768); //detail
	define("IMAGE_EVENT_THUMB_WIDTH",           400); //summary
	define("IMAGE_EVENT_THUMB_HEIGHT",          300); //summary
	# CLASSIFIED
	define("IMAGE_CLASSIFIED_FULL_WIDTH",       1024); //detail
	define("IMAGE_CLASSIFIED_FULL_HEIGHT",      768); //detail
	define("IMAGE_CLASSIFIED_THUMB_WIDTH",      400); //summary
	define("IMAGE_CLASSIFIED_THUMB_HEIGHT",     300); //summary
	# ARTICLE
	define("IMAGE_ARTICLE_FULL_WIDTH",          1024); //detail
	define("IMAGE_ARTICLE_FULL_HEIGHT",         768); //detail
	define("IMAGE_ARTICLE_THUMB_WIDTH",         400); //summary
	define("IMAGE_ARTICLE_THUMB_HEIGHT",        300); //summary
	# BLOG
	define("IMAGE_BLOG_FULL_WIDTH",             1024); //detail
	define("IMAGE_BLOG_FULL_HEIGHT",            768); //detail
	define("IMAGE_BLOG_THUMB_WIDTH",            400); //summary
	define("IMAGE_BLOG_THUMB_HEIGHT",           300); //summary
	# DESIGNATION
	define("IMAGE_DESIGNATION_WIDTH",           50); //badges
	define("IMAGE_DESIGNATION_HEIGHT",          50); //badges
	# HEADER
	define("IMAGE_HEADER_WIDTH",                180); //header
	define("IMAGE_HEADER_HEIGHT",               90); //header
	# PROFILE
	define("PROFILE_IMAGE_WIDTH",               130); //front pages
	define("PROFILE_IMAGE_HEIGHT",              130); //front pages
	define("PROFILE_MEMBERS_IMAGE_WIDTH",       130); //sponsors/profile pages
	define("PROFILE_MEMBERS_IMAGE_HEIGHT",      130); //sponsors/profile pages
	# PACKAGE
	define("IMAGE_PACKAGE_FULL_WIDTH",          260); //package
	define("IMAGE_PACKAGE_FULL_HEIGHT",         260); //package
	define("IMAGE_PACKAGE_THUMB_WIDTH",         200); //package
	define("IMAGE_PACKAGE_THUMB_HEIGHT",        150); //package
	# SLIDER
	define("IMAGE_SLIDER_WIDTH",                1920); //slider
	define("IMAGE_SLIDER_HEIGHT",               1080); //slider
	# SLIDER MOBILE
	define("IMAGE_MOBILE_SLIDER_WIDTH",         640); //mobile slider
	define("IMAGE_MOBILE_SLIDER_HEIGHT",        480); //mobile slider
	# BACKGROUND IMAGE
	define("IMAGE_THEME_BACKGROUND_W",          1920);
	define("IMAGE_THEME_BACKGROUND_H",          580);
	# CATEGORY
	define("IMAGE_CATEGORY_FULL_WIDTH",         640); //category
	define("IMAGE_CATEGORY_FULL_HEIGHT",        480); //category
	define("IMAGE_CATEGORY_THUMB_WIDTH",        400); //category (form category)
	define("IMAGE_CATEGORY_THUMB_HEIGHT",       300); //category (form category)
	# COVER IMAGE
	define("COVER_IMAGE_WIDTH",                 1920);
	define("COVER_IMAGE_HEIGHT",                480);

	# ----------------------------------------------------------------------------------------------------
	# GENERAL SETTINGS
	# ----------------------------------------------------------------------------------------------------
	# SLIDER AVAILABLE FOR SLIDER
	define("TOTAL_SLIDER_ITEMS", 5);

	# MODULES CONFIGURATION
	define("CUSTOM_LISTINGTEMPLATE_FEATURE", "on");

	/*
	 * Navigation configuration
	 */
	unset($array_navigation);
	$array_navigation["header"][] = array("name" => LANG_MENU_HOME, "url" => "DEFAULT_URL");
	$array_navigation["footer"][] = array("name" => LANG_MENU_HOME, "url" => "DEFAULT_URL");

	$array_navigation["header"][] = array("name" => LANG_MENU_LISTING, "url" => "LISTING_DEFAULT_URL");
	$array_navigation["footer"][] = array("name" => LANG_MENU_LISTING, "url" => "LISTING_DEFAULT_URL");

	$array_navigation["header"][] = array("name" => LANG_MENU_EVENT, "url" => "EVENT_DEFAULT_URL", "module" => "EVENT_FEATURE");
	$array_navigation["footer"][] = array("name" => LANG_MENU_EVENT, "url" => "EVENT_DEFAULT_URL", "module" => "EVENT_FEATURE");

	$array_navigation["header"][] = array("name" => LANG_MENU_CLASSIFIED, "url" => "CLASSIFIED_DEFAULT_URL", "module" => "CLASSIFIED_FEATURE");
	$array_navigation["footer"][] = array("name" => LANG_MENU_CLASSIFIED, "url" => "CLASSIFIED_DEFAULT_URL", "module" => "CLASSIFIED_FEATURE");

	$array_navigation["header"][] = array("name" => LANG_MENU_ARTICLE, "url" => "ARTICLE_DEFAULT_URL", "module" => "ARTICLE_FEATURE");
	$array_navigation["footer"][] = array("name" => LANG_MENU_ARTICLE, "url" => "ARTICLE_DEFAULT_URL", "module" => "ARTICLE_FEATURE");

	$array_navigation["header"][] = array("name" => LANG_MENU_PROMOTION, "url" => "PROMOTION_DEFAULT_URL", "module" => "PROMOTION_FEATURE");
	$array_navigation["footer"][] = array("name" => LANG_MENU_PROMOTION, "url" => "PROMOTION_DEFAULT_URL", "module" => "PROMOTION_FEATURE");

	$array_navigation["header"][] = array("name" => LANG_MENU_BLOG, "url" => "BLOG_DEFAULT_URL", "module" => "BLOG_FEATURE");
	$array_navigation["footer"][] = array("name" => LANG_MENU_BLOG, "url" => "BLOG_DEFAULT_URL", "module" => "BLOG_FEATURE");

	$array_navigation["header"][] = array("name" => LANG_MENU_ADVERTISE, "url" => "ALIAS_ADVERTISE_URL_DIVISOR");
	$array_navigation["footer"][] = array("name" => LANG_MENU_ADVERTISE, "url" => "ALIAS_ADVERTISE_URL_DIVISOR");

	$array_navigation["header"][] = array("name" => LANG_MENU_CONTACT, "url" => "ALIAS_CONTACTUS_URL_DIVISOR");
	$array_navigation["footer"][] = array("name" => LANG_MENU_CONTACT, "url" => "ALIAS_CONTACTUS_URL_DIVISOR");

	$array_navigation["footer"][] = array("name" => LANG_MENU_FAQ, "url" => "ALIAS_FAQ_URL_DIVISOR");
	$array_navigation["footer"][] = array("name" => LANG_MENU_SITEMAP, "url" => "ALIAS_SITEMAP_URL_DIVISOR");
	$array_navigation["footer"][] = array("name" => LANG_TERMS_USE, "url" => "ALIAS_TERMS_URL_DIVISOR");
	$array_navigation["footer"][] = array("name" => LANG_PRIVACY_POLICY, "url" => "ALIAS_PRIVACY_URL_DIVISOR");

	define("THEME_NAVIGATION_MENU", serialize($array_navigation));

	/*
	 * Site Content Configuration
	 */

	//content not available according to column "type"
	$arrayBlockedContent = array();

	define("SITECONTENT_BLOCKED", serialize($arrayBlockedContent));
	unset($arrayBlockedContent);

	//content available only for SEO purposes
	$arraySEOContent = array();

	define("SITECONTENT_FORSEO", serialize($arraySEOContent));
	unset($arraySEOContent);


	# ----------------------------------------------------------------------------------------------------
	# CATEGORY CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	//Levels per category (all modules except for listings)
	define("CATEGORY_LEVEL_AMOUNT",             5); // Limited to 5
	//Levels per category (listings)
	define("LISTING_CATEGORY_LEVEL_AMOUNT",     5); // Unlimited

	//Total categories per item (all modules except for listings)
    define("MAX_CATEGORY_ALLOWED",              5); // Limited to 5
	//Total categories per item (listings)
    define("LISTING_MAX_CATEGORY_ALLOWED",      20); // Unlimited

    define("MAX_SHOW_ALL_CATEGORIES",           1000); // Max of categories to show
    define("FEATUREDCATEGORY_LEVEL_AMOUNT",     CATEGORY_LEVEL_AMOUNT > LISTING_CATEGORY_LEVEL_AMOUNT ? CATEGORY_LEVEL_AMOUNT: LISTING_CATEGORY_LEVEL_AMOUNT); // Max Levels (All modules)

	# RESIZE IMAGES AFTER UPGRADE
	# on (DEFAULT) - all images will be stretched to fit the new dimensions
	# off - all images will keep the same size, but the layout can be affected
	if (!defined("RESIZE_IMAGES_UPGRADE")) {
        define("RESIZE_IMAGES_UPGRADE", "on");
    }

	# TURN ON THIS CONSTANT FOR UPGRADED PROJECTS. IT WILL FIX THE BADGES IMAGES
	define("IS_UPGRADE", "off");

	if (strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."") === false) {
		define("IMAGE_HEADER_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo.png");
	} else {
		define("IMAGE_HEADER_PATH", "/custom/domain_".URL_DOMAIN_ID."/content_files/img_logo.png");
	}

	# ----------------------------------------------------------------------------------------------------
	# NOIMAGE
	# ----------------------------------------------------------------------------------------------------
	define("NOIMAGE_PATH",      "/custom/domain_".SELECTED_DOMAIN_ID."/content_files");
	define("NOIMAGE_NAME",      "noimage");
	define("NOIMAGE_IMGEXT",    "gif");
	define("NOIMAGE_CSSEXT",    "css");

    # ----------------------------------------------------------------------------------------------------
	# BACKGROUND IMAGE
	# ----------------------------------------------------------------------------------------------------
	define("BKIMAGE_PATH",      "/custom/domain_".SELECTED_DOMAIN_ID."/content_files");
	define("BKIMAGE_NAME",      "background_image");
	define("BKIMAGE_EXT",    "jpg");

    # ----------------------------------------------------------------------------------------------------
	# HTML EDITOR - HEADER AND FOOTER FILES
	# ----------------------------------------------------------------------------------------------------
    define("HTMLEDITOR_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/editor");
	define("HTMLEDITOR_FOLDER",                 EDIRECTORY_ROOT.HTMLEDITOR_FOLDER_RELATIVE_PATH);
	define("HTMLEDITOR_URL",                    DEFAULT_URL.HTMLEDITOR_FOLDER_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# REPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_REPORT_SUMMARY_VIEW",       1);
	define("LISTING_REPORT_DETAIL_VIEW",        2);
	define("LISTING_REPORT_CLICK_THRU",         3);
	define("LISTING_REPORT_EMAIL_SENT",         4);
	define("LISTING_REPORT_PHONE_VIEW",         5);
	define("LISTING_REPORT_FAX_VIEW",           6);
	define("LISTING_REPORT_SMS",                7);
	define("LISTING_REPORT_CLICKTOCALL",        8);
	define("PROMOTION_REPORT_SUMMARY_VIEW",     1);
    define("PROMOTION_REPORT_DETAIL_VIEW",      2);
	define("BANNER_REPORT_CLICK_THRU",          1);
	define("BANNER_REPORT_VIEW",                2);
	define("ARTICLE_REPORT_SUMMARY_VIEW",       1);
	define("ARTICLE_REPORT_DETAIL_VIEW",        2);
	define("EVENT_REPORT_SUMMARY_VIEW",         1);
	define("EVENT_REPORT_DETAIL_VIEW",          2);
	define("CLASSIFIED_REPORT_SUMMARY_VIEW",    1);
	define("CLASSIFIED_REPORT_DETAIL_VIEW",     2);
	define("POST_REPORT_SUMMARY_VIEW",          1);
	define("POST_REPORT_DETAIL_VIEW",			2);
	define("REPORT_DAYS_SHOW",                  20);
	define("REPORT_PHONE_FAX", 					false);

	# ----------------------------------------------------------------------------------------------------
	# BANNER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BANNER_EXPIRATION_IMPRESSION",   1);
	define("BANNER_EXPIRATION_RENEWAL_DATE", 2);

	# ----------------------------------------------------------------------------------------------------
	# USER ATRIBUTES
	# ----------------------------------------------------------------------------------------------------
	define("USERNAME_MAX_LEN", 80); // don't forget to verify the field in DB
	define("USERNAME_MIN_LEN",  4);
	define("PASSWORD_MAX_LEN", 50); // don't forget to verify the field in DB
	define("PASSWORD_MIN_LEN",  4);

	# ----------------------------------------------------------------------------------------------------
	# EMAIL NOTIFICATIONS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("RENEWAL_30",                            1);
	define("RENEWAL_15",                            2);
	define("RENEWAL_7",                             3);
	define("RENEWAL_1",                             4);
	define("SYSTEM_SPONSOR_ACCOUNT_CREATE",         5);
	define("SYSTEM_SPONSOR_ACCOUNT_UPDATE",         6);
	define("SYSTEM_VISITOR_ACCOUNT_CREATE",         7);
	define("SYSTEM_VISITOR_ACCOUNT_UPDATE",         8);
	define("SYSTEM_FORGOTTEN_PASS",                 9);
	define("SYSTEM_NEW_LISTING",                    10);
	define("SYSTEM_NEW_EVENT",                      11);
	define("SYSTEM_NEW_BANNER",                     12);
	define("SYSTEM_NEW_CLASSIFIED",                 13);
	define("SYSTEM_NEW_ARTICLE",                    14);
	define("SYSTEM_NEW_CUSTOMINVOICE",              15);
	define("SYSTEM_ACTIVE_LISTING",                 16);
	define("SYSTEM_ACTIVE_EVENT",                   17);
	define("SYSTEM_ACTIVE_BANNER",                  18);
	define("SYSTEM_ACTIVE_CLASSIFIED",              19);
	define("SYSTEM_ACTIVE_ARTICLE",                 20);
	define("SYSTEM_LISTING_SIGNUP",                 22);
	define("SYSTEM_EVENT_SIGNUP",                   23);
	define("SYSTEM_BANNER_SIGNUP",                  24);
	define("SYSTEM_CLASSIFIED_SIGNUP",              25);
	define("SYSTEM_ARTICLE_SIGNUP",                 26);
	define("SYSTEM_CLAIM_SIGNUP",                   27);
	define("SYSTEM_CLAIM_AUTOMATICALLY_APPROVED",   28);
	define("SYSTEM_CLAIM_APPROVED",                 29);
	define("SYSTEM_CLAIM_DENIED",                   30);
	define("SYSTEM_APPROVE_REPLY",                  31);
	define("SYSTEM_APPROVE_REVIEW",                 32);
	define("SYSTEM_NEW_REVIEW",                     33);
	define("SYSTEM_INVOICE_NOTIFICATION",           34);
	define("SYSTEM_NEW_PROFILE",					35);
	define("SYSTEM_EMAIL_TRAFFIC",					36);
    define("SYSTEM_NEW_DEAL",                       37);
    define("SYSTEM_DEAL_DONE",                      38);
    define("SYSTEM_ACTIVATE_ACCOUNT",               39);
    define("SYSTEM_NEW_LEAD",                       40);

    define("SYSTEM_LASTEMAIL_ID",                   40);

	# ----------------------------------------------------------------------------------------------------
	# EXPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_LIMIT",             10000);
	define("ACCOUNT_LIMIT",             10000);
	define("CLASSIFIED_LIMIT",          10000);
	define("EVENT_LIMIT",               10000);
	define("ARTICLE_LIMIT",             10000);
	define("BANNER_LIMIT",              10000);
	define("INVOICE_LIMIT",             10000);
	define("PAYMENT_LIMIT",             10000);
	define("DEFAULT_EXPORT_EXTENSION",  "xls");
	define("DEFAULT_EXPORT_ZIPPED",     "y");

	# ----------------------------------------------------------------------------------------------------
	# CUSTOM INVOICE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("CUSTOM_INVOICE_ITEMS_NUMBER", 10);

	# ----------------------------------------------------------------------------------------------------
	# MOBILE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
    define("IMAGE_SCREEN_IOS_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_screen_ios.png");
    define("IMAGE_SCREEN_ANDROID_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_screen_android.png");
    define("MOBILE_SCREEN_WIDTH", "60");
    define("MOBILE_SCREEN_HEIGHT", "60");
    define("MOBILE_ADVERT_WIDTH", "290");
    define("MOBILE_ADVERT_HEIGHT", "50");
    //demodirectory.com configuration
    include(EDIRECTORY_ROOT."/conf/smartbanner.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT FOLDER
	# ----------------------------------------------------------------------------------------------------
	define("IMPORT_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/import_files");
	define("IMPORT_FOLDER",                 EDIRECTORY_ROOT.IMPORT_FOLDER_RELATIVE_PATH);
	define("IMPORT_URL",                    DEFAULT_URL.IMPORT_FOLDER_RELATIVE_PATH);

    # ----------------------------------------------------------------------------------------------------
	# EXPORT FOLDER
	# ----------------------------------------------------------------------------------------------------
	define("EXPORT_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/export_files");
	define("EXPORT_FOLDER",                 EDIRECTORY_ROOT.EXPORT_FOLDER_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# IMPORT SETTINGS
	# ----------------------------------------------------------------------------------------------------
    $serverMax = ini_get("upload_max_filesize");
    $l = substr($serverMax, -1);
    if ($l == "M") {
        $serverMax = str_replace("M", "", $serverMax);
    } else {
       $serverMax = 5;
    }
	define("MAX_MB_FILE_SIZE_ALLOWED",      ($serverMax < 5 ? $serverMax : 5));
	define("MAX_MB_FILE_SIZE_ALLOWED_FTP",  100);
	unset($serverMax);
	unset($l);

	# ----------------------------------------------------------------------------------------------------
	# GOOGLE SETTINGS CONSTANTS
    # TODO check if these constants are being used somewhere
	# ----------------------------------------------------------------------------------------------------
	define("GOOGLE_ADS_SETTING",                1);
	define("GOOGLE_MAPS_STATUS",                2);
	define("GOOGLE_MAPS_SETTING",               3);
	define("GOOGLE_ANALYTICS_SETTING",          4);
	define("GOOGLE_ANALYTICS_FRONT_SETTING",    5);
	define("GOOGLE_ANALYTICS_MEMBERS_SETTING",  6);
	define("GOOGLE_ANALYTICS_SITEMGR_SETTING",  7);
	define("GOOGLE_ADS_CHANNEL_SETTING",        8);
	define("GOOGLE_ADS_STATUS",                 9);
	define("GOOGLE_ADS_TYPE",                   10);
	define("GOOGLE_TAG_STATUS",                 11);
	define("GOOGLE_TAG_SETTING",                12);
	define("GOOGLE_RECAPTCHA_STATUS",           13);
	define("GOOGLE_RECAPTCHA_SETTING",          14);

	# ----------------------------------------------------------------------------------------------------
	# LOCATION CONSTANTS
	# ----------------------------------------------------------------------------------------------------
    define("LOCATION1_LABEL",   "country");
    define("LOCATION2_LABEL",   "region");
    define("LOCATION3_LABEL",   "state");
    define("LOCATION4_LABEL",   "city");
    define("LOCATION5_LABEL",   "neighborhood");

	# ----------------------------------------------------------------------------------------------------
	# AUTOCOMPLETE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("AUTOCOMPLETE_MAXITENS",     25);

	# ----------------------------------------------------------------------------------------------------
	# URL PROTOCOL
	# ----------------------------------------------------------------------------------------------------
	define("URL_PROTOCOL", "http,https,ftp");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY CHARSET
	# ----------------------------------------------------------------------------------------------------
	define("EDIR_CHARSET", "UTF-8");

	# ----------------------------------------------------------------------------------------------------
	# SITEMAP CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SITEMAP_MAXURL",                "1000");
	define("SITEMAP_HASLISTINGLOCATION",    "y");
	define("SITEMAP_HASLISTINGCATEGORY",    "y");
	define("SITEMAP_HASLISTINGDETAIL",      "y");
	define("SITEMAP_HASPROMOTIONLOCATION",  "y");
	define("SITEMAP_HASPROMOTIONCATEGORY",  "y");
    define("SITEMAP_HASPROMOTIONDETAIL",    "y");
	define("SITEMAP_HASEVENTLOCATION",      "y");
	define("SITEMAP_HASEVENTCATEGORY",      "y");
	define("SITEMAP_HASEVENTDETAIL",        "y");
	define("SITEMAP_HASCLASSIFIEDLOCATION", "y");
	define("SITEMAP_HASCLASSIFIEDCATEGORY", "y");
	define("SITEMAP_HASCLASSIFIEDDETAIL",   "y");
	define("SITEMAP_HASARTICLECATEGORY",    "y");
	define("SITEMAP_HASARTICLEDETAIL",      "y");
	define("SITEMAP_HASARTICLENEWS",        "y");
	define("SITEMAP_HASBLOGCATEGORY",       "y");
	define("SITEMAP_HASBLOGDETAIL",         "y");
	define("SITEMAP_HASCONTENT",            "y");

	# ----------------------------------------------------------------------------------------------------
	# FAIL LOGIN
	# ----------------------------------------------------------------------------------------------------
	define("FAILLOGIN_MAXFAIL",     "4"); // FAILLOGIN_MAXFAIL + 1 = block account
	define("FAILLOGIN_TIMEBLOCK",   "60"); // minutes

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR / MEMBERS SEARCH
	# ----------------------------------------------------------------------------------------------------
	define("RESULTS_PER_PAGE", 50);

	# ----------------------------------------------------------------------------------------------------
	# CUSTOM FOLDER PERMISSION
	# ----------------------------------------------------------------------------------------------------
	define("PERMISSION_CUSTOM_FOLDER", "0755");

	# ----------------------------------------------------------------------------------------------------
	# Settings to Twilio
	# ----------------------------------------------------------------------------------------------------
	define("TWILIO_API_VERSION",    "2010-04-01");

	# ----------------------------------------------------------------------------------------------------
	# Scalability info - suggestions to turn on the module scalability when the total items is higher than the following numbers
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_SCALABILITY_NUMBER",            100000);
	define("PROMOTION_SCALABILITY_NUMBER",          50000);
	define("EVENT_SCALABILITY_NUMBER",              100000);
	define("BANNER_SCALABILITY_NUMBER",             50000);
	define("CLASSIFIED_SCALABILITY_NUMBER",         100000);
	define("ARTICLE_SCALABILITY_NUMBER",            100000);
	define("BLOG_SCALABILITY_NUMBER",               100000);
	define("LISTINGCATEGORY_SCALABILITY_NUMBER",    20);
	define("EVENTCATEGORY_SCALABILITY_NUMBER",      20);
	define("CLASSIFIEDCATEGORY_SCALABILITY_NUMBER", 20);
	define("ARTICLECATEGORY_SCALABILITY_NUMBER",    20);
	define("BLOGCATEGORY_SCALABILITY_NUMBER",       20);

    # ----------------------------------------------------------------------------------------------------
    # EDIRECTORY API
    # ----------------------------------------------------------------------------------------------------
    define("API_USE_JSON", false);

    # ----------------------------------------------------------------------------------------------------
    # MAILAPP
    # ----------------------------------------------------------------------------------------------------
    define("MAIL_APP_FEATURE", "on");
    define("MAILAPP_LIVE_URL", "http://www.arcamailer.com/");

    # ----------------------------------------------------------------------------------------------------
    # ARCALOGIN USERNAME
    # ----------------------------------------------------------------------------------------------------
    define("ARCALOGIN_USERNAME", "arcalogin@arcasolutions.com");

    # ----------------------------------------------------------------------------------------------------
    # APP BUILDER
    # ----------------------------------------------------------------------------------------------------
    /*
     * Navigation configuration
     */
    unset($array_tabbar);
	$array_tabbar["tabbar"][] = array("name" => LANG_MENU_HOME, "url" => "home");
	$array_tabbar["tabbar"][] = array("name" => LANG_MENU_LISTING, "url" => "listings");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_EVENT, "url" => "events", "module" => "EVENT_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_CLASSIFIED, "url" => "classifieds", "module" => "CLASSIFIED_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_ARTICLE, "url" => "articles", "module" => "ARTICLE_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_PROMOTION, "url" => "deals", "module" => "PROMOTION_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_BLOG, "url" => "blog", "module" => "BLOG_FEATURE");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_FAVORITES, "url" => "favorites");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_MYDEALS, "url" => "mydeals");
	$array_tabbar["tabbar"][] = array("name" => LANG_MENU_MYREVIEWS, "url" => "myreviews");
    $array_tabbar["tabbar"][] = array("name" => LANG_MENU_ABOUT, "url" => "about");

    define("APPBUILDER_MENU", serialize($array_tabbar));

    # ABOUT / LOGO IMAGE
    define("IMAGE_ABOUT_WIDTH", 400);
    define("IMAGE_ABOUT_HEIGHT", 150);

    # ----------------------------------------------------------------------------------------------------
	# IMAGES PATH
	# ----------------------------------------------------------------------------------------------------
	define("IMAGE_APPBUILDER_PATH", "/custom/domain_".SELECTED_DOMAIN_ID."/content_files");
