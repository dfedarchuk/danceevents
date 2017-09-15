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
	# * FILE: /conf/modules.inc.php
	# ----------------------------------------------------------------------------------------------------

	############################################################################
	#	ARTICLE
	############################################################################
    if (!defined("CUSTOM_ARTICLE_FEATURE")){
        // GET VALUE FROM `Setting`
        setting_get("custom_article_feature",					$custom_article_feature);
        // DEFINE CONSTANT VALUE
        define("CUSTOM_ARTICLE_FEATURE",						$custom_article_feature);
        define("FORCE_DISABLE_ARTICLE_FEATURE", "off");
    }

	############################################################################
	#	BANNER
	############################################################################
    if (!defined("CUSTOM_BANNER_FEATURE")){
        // GET VALUE FROM `Setting`
        setting_get("custom_banner_feature",					$custom_banner_feature);
        // DEFINE CONSTANT VALUE
        define("CUSTOM_BANNER_FEATURE",							$custom_banner_feature);
    }
    
	############################################################################
	#	BLOG
	############################################################################
    if (!defined("CUSTOM_BLOG_FEATURE")){
        // GET VALUE FROM `Setting`
        setting_get("custom_blog_feature",						$custom_blog_feature);
        // DEFINE CONSTANT VALUE
        define("CUSTOM_BLOG_FEATURE",							$custom_blog_feature);
    }

	############################################################################
	#	CLASSIFIED
	############################################################################
    if (!defined("CUSTOM_CLASSIFIED_FEATURE")){
        // GET VALUE FROM `Setting`
        setting_get("custom_classified_feature",				$custom_classified_feature);
        // DEFINE CONSTANT VALUE
        define("CUSTOM_CLASSIFIED_FEATURE",						$custom_classified_feature);
        define("FORCE_DISABLE_CLASSIFIED_FEATURE", "off");
    }
    
	############################################################################
	#	EVENT
	############################################################################
    if (!defined("CUSTOM_EVENT_FEATURE")){
        // GET VALUE FROM `Setting`
        setting_get("custom_event_feature",						$custom_event_feature);
        // DEFINE CONSTANT VALUE
        define("CUSTOM_EVENT_FEATURE",							$custom_event_feature);
        define("FORCE_DISABLE_EVENT_FEATURE", "off");
    }

	############################################################################
	#	PROMOTION
	############################################################################
    if (!defined("CUSTOM_PROMOTION_FEATURE")){
        // GET VALUE FROM `Setting`
        setting_get("custom_promotion_feature",					$custom_promotion_feature);
        // DEFINE CONSTANT VALUE
        define("CUSTOM_PROMOTION_FEATURE",						$custom_promotion_feature);
        define("FORCE_DISABLE_PROMOTION_FEATURE", "off");
    }

	############################################################################
	#	HAS PROMOTION
	############################################################################
	setting_get("custom_has_promotion",					$custom_has_promotion);
	define("CUSTOM_HAS_PROMOTION",						$custom_has_promotion);	
?>