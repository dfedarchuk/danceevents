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
# * FILE: /custom/domain_1/conf/constants.inc.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# FLAGS - on/off
# ----------------------------------------------------------------------------------------------------
# ****************************************************************************************************
# MODULES
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
define("EVENT_FEATURE", "on");
define("BANNER_FEATURE", "on");
define("CLASSIFIED_FEATURE", "on");
define("ARTICLE_FEATURE", "on");
define("PROMOTION_FEATURE", "on");
define("BLOG_FEATURE", "on");
define("ZIPCODE_PROXIMITY", "on");
# ****************************************************************************************************
# FEATURES
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
define("CUSTOM_INVOICE_FEATURE", "on");
define("CLAIM_FEATURE", "on");
define("LISTINGTEMPLATE_FEATURE", "on");
define("MOBILE_FEATURE", "on");
define("MULTILANGUAGE_FEATURE", "on");
define("MAINTENANCE_FEATURE", "on");
define("API_FEATURE", "off");
# ****************************************************************************************************
# EXTRA FEATURES
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
define("SITEMAP_FEATURE", "on");
# ****************************************************************************************************
# CUSTOMIZATIONS
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# ****************************************************************************************************
define("BRANDED_PRINT", "on");
# ****************************************************************************************************
# PAYMENT SYSTEM FEATURE
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
define("PAYMENTSYSTEM_FEATURE", "on");
# ----------------------------------------------------------------------------------------------------
# EDIRECTORY TITLE
# ----------------------------------------------------------------------------------------------------
define("EDIRECTORY_TITLE", "Demodirectory");
# ----------------------------------------------------------------------------------------------------
# DATE/TIME SETTINGS
# ----------------------------------------------------------------------------------------------------
define("DEFAULT_DATE_FORMAT", "m/d/Y");
define("CLOCK_TYPE", "12");
# ----------------------------------------------------------------------------------------------------
# GALLERY IMAGES
#  - You can force all jpg images to be saved as png for better quality by turning on the constant FORCE_SAVE_JPG_AS_PNG.
# ----------------------------------------------------------------------------------------------------
define("FORCE_SAVE_JPG_AS_PNG", "off");
# ----------------------------------------------------------------------------------------------------
# RESIZE IMAGES AFTER UPGRADE
#  on (DEFAULT) - all images will be stretched to fit the new dimensions
#  off - all images will keep the same size, but the layout can be affected
# ----------------------------------------------------------------------------------------------------
define("RESIZE_IMAGES_UPGRADE", "on");
# ----------------------------------------------------------------------------------------------------
# SITEMAP LINKS
#  - Turn on to add "www" to sitemap links.
# ----------------------------------------------------------------------------------------------------
define("SITEMAP_ADD_WWW", "off");
# ----------------------------------------------------------------------------------------------------
# MODULES ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_LISTING_MODULE", "listing");
define("ALIAS_PROMOTION_MODULE", "deal");
define("ALIAS_EVENT_MODULE", "event");
define("ALIAS_ARTICLE_MODULE", "article");
define("ALIAS_CLASSIFIED_MODULE", "classified");
define("ALIAS_BLOG_MODULE", "blog");
# ----------------------------------------------------------------------------------------------------
# CLAIM ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_CLAIM_URL_DIVISOR", "claim");
# ----------------------------------------------------------------------------------------------------
# REVIEWS ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_REVIEW_URL_DIVISOR", "review");
# ----------------------------------------------------------------------------------------------------
# CHECKINS ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_CHECKIN_URL_DIVISOR", "checkin");
# ----------------------------------------------------------------------------------------------------
# ALL CATEGORIES PAGE ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR", "categories");
define("ALIAS_EVENT_ALLCATEGORIES_URL_DIVISOR", "categories");
define("ALIAS_ARTICLE_ALLCATEGORIES_URL_DIVISOR", "categories");
define("ALIAS_CLASSIFIED_ALLCATEGORIES_URL_DIVISOR", "categories");
define("ALIAS_PROMOTION_ALLCATEGORIES_URL_DIVISOR", "categories");
define("ALIAS_BLOG_ALLCATEGORIES_URL_DIVISOR", "categories");
# ----------------------------------------------------------------------------------------------------
# ALL LOCATIONS PAGE ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_ALLLOCATIONS_URL_DIVISOR", "locations");
# ----------------------------------------------------------------------------------------------------
# ADVERTISE ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_ADVERTISE_URL_DIVISOR", "advertise");
# ----------------------------------------------------------------------------------------------------
# CONTACTUS ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_CONTACTUS_URL_DIVISOR", "contactus");
# ----------------------------------------------------------------------------------------------------
# FAQ ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_FAQ_URL_DIVISOR", "faq");
# ----------------------------------------------------------------------------------------------------
# SITEMAP ALIAS
# ----------------------------------------------------------------------------------------------------
define("ALIAS_SITEMAP_URL_DIVISOR", "sitemap");
# ----------------------------------------------------------------------------------------------------
# GENERAL CONTACT PAGE (LEADS)
# ----------------------------------------------------------------------------------------------------
define("ALIAS_LEAD_URL_DIVISOR", "enquire");
# ----------------------------------------------------------------------------------------------------
# TERMS OF USE
# ----------------------------------------------------------------------------------------------------
define("ALIAS_TERMS_URL_DIVISOR", "terms");
# ----------------------------------------------------------------------------------------------------
# PRIVACY POLICE
# ----------------------------------------------------------------------------------------------------
define("ALIAS_PRIVACY_URL_DIVISOR", "privacy");
# ----------------------------------------------------------------------------------------------------
# MODULES URLS
# ----------------------------------------------------------------------------------------------------
define("LISTING_FEATURE_NAME", "listing");
define("LISTING_FEATURE_NAME_PLURAL", LISTING_FEATURE_NAME."s");
define("LISTING_DEFAULT_URL", DEFAULT_URL."/".ALIAS_LISTING_MODULE);

define("PROMOTION_FEATURE_NAME", "deal");
define("PROMOTION_FEATURE_NAME_PLURAL", PROMOTION_FEATURE_NAME."s");
define("PROMOTION_DEFAULT_URL", DEFAULT_URL."/".ALIAS_PROMOTION_MODULE);

define("EVENT_FEATURE_NAME", "event");
define("EVENT_FEATURE_NAME_PLURAL", EVENT_FEATURE_NAME."s");
define("EVENT_DEFAULT_URL", DEFAULT_URL."/".ALIAS_EVENT_MODULE);

define("CLASSIFIED_FEATURE_NAME", "classified");
define("CLASSIFIED_FEATURE_NAME_PLURAL", CLASSIFIED_FEATURE_NAME."s");
define("CLASSIFIED_DEFAULT_URL", DEFAULT_URL."/".ALIAS_CLASSIFIED_MODULE);

define("ARTICLE_FEATURE_NAME", "article");
define("ARTICLE_FEATURE_NAME_PLURAL", ARTICLE_FEATURE_NAME."s");
define("ARTICLE_DEFAULT_URL", DEFAULT_URL."/".ALIAS_ARTICLE_MODULE);

define("BLOG_FEATURE_NAME", "blog");
define("BLOG_FEATURE_NAME_PLURAL", BLOG_FEATURE_NAME."");
define("BLOG_DEFAULT_URL", DEFAULT_URL."/".ALIAS_BLOG_MODULE);

define("BANNER_FEATURE_NAME", "banner");
define("BANNER_FEATURE_NAME_PLURAL", BANNER_FEATURE_NAME."s");
?>
