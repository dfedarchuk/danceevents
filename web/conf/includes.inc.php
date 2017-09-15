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
	# * FILE: /conf/includes.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE STRING FUNCTIONS TO BE USED IN ALL OTHER FILES
	# ----------------------------------------------------------------------------------------------------
	include_once(EDIRECTORY_ROOT."/functions/string_funct.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GLOBAL CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/theme.inc.php");
	include(EDIRECTORY_ROOT."/conf/".EDIR_THEME."_scheme.inc.php");
	include(EDIRECTORY_ROOT."/conf/default_themecolors.inc.php");
	include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/scalability.inc.php");
	include(EDIRECTORY_ROOT."/conf/constants.inc.php");
	include(EDIRECTORY_ROOT."/conf/bin.inc.php");
	//Include the SSL Conf file from the domain URL not from the SELECTED_DOMAIN_ID
	include(EDIRECTORY_ROOT."/custom/domain/domain.inc.php");
	if (!$_inCron && $_SERVER["HTTP_HOST"]) $_domain_id = $domainInfo[str_replace("www.","",$_SERVER["HTTP_HOST"])];
	else $_domain_id = SELECTED_DOMAIN_ID;
	include(EDIRECTORY_ROOT."/custom/domain_".$_domain_id."/conf/ssl.inc.php");
	unset($_domain_id, $domainInfo);
	include(EDIRECTORY_ROOT."/conf/payment.inc.php");
	include(EDIRECTORY_ROOT."/conf/google.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GLOBAL CLASSES
	# ----------------------------------------------------------------------------------------------------
	include_once(CLASSES_DIR."/class_EDirMailer.php");
	include_once(CLASSES_DIR."/phpmailer/class.phpmailer.php");
	include_once(CLASSES_DIR."/phpmailer/class.smtp.php");
	include_once(CLASSES_DIR."/phpmailer/class.pop3.php");
	include_once(CLASSES_DIR."/openid/AuthOpenID.php");
	include_once(CLASSES_DIR."/openid/LightOpenID.php");
    include_once(CLASSES_DIR."/PagSeguroLibrary/PagSeguroLibrary.php");
	include_once(CLASSES_DIR."/class_Mysql.php");
	include_once(CLASSES_DIR."/class_Handle.php");
	include_once(CLASSES_DIR."/class_Account.php");
	include_once(CLASSES_DIR."/class_Account_Activation.php");
	include_once(CLASSES_DIR."/class_Account_Domain.php");
	include_once(CLASSES_DIR."/class_AccountProfileContact.php");
	include_once(CLASSES_DIR."/class_SMAccount.php");
	include_once(CLASSES_DIR."/class_Contact.php");
	include_once(CLASSES_DIR."/class_Setting.php");
	include_once(CLASSES_DIR."/class_SettingSocialNetwork.php");
	include_once(CLASSES_DIR."/class_CustomText.php");
	include_once(CLASSES_DIR."/class_GoogleSettings.php");
	include_once(CLASSES_DIR."/class_Image.php");
	include_once(CLASSES_DIR."/class_ImageResizer.php");
	include_once(CLASSES_DIR."/class_Lang.php");
	include_once(CLASSES_DIR."/class_LocationManager.php");
	include_once(CLASSES_DIR."/class_Location1.php");
	include_once(CLASSES_DIR."/class_Location2.php");
	include_once(CLASSES_DIR."/class_Location3.php");
	include_once(CLASSES_DIR."/class_Location4.php");
	include_once(CLASSES_DIR."/class_Location5.php");
	include_once(CLASSES_DIR."/class_DiscountCodeStatus.php");
	include_once(CLASSES_DIR."/class_DiscountCode.php");
	include_once(CLASSES_DIR."/class_PaymentLog.php");
	include_once(CLASSES_DIR."/class_PaymentListingLog.php");
	include_once(CLASSES_DIR."/class_PaymentEventLog.php");
	include_once(CLASSES_DIR."/class_PaymentBannerLog.php");
	include_once(CLASSES_DIR."/class_PaymentClassifiedLog.php");
	include_once(CLASSES_DIR."/class_PaymentArticleLog.php");
	include_once(CLASSES_DIR."/class_PaymentCustomInvoiceLog.php");
	include_once(CLASSES_DIR."/class_PaymentPackageLog.php");
	include_once(CLASSES_DIR."/class_InvoiceStatus.php");
	include_once(CLASSES_DIR."/class_Invoice.php");
	include_once(CLASSES_DIR."/class_InvoiceListing.php");
	include_once(CLASSES_DIR."/class_InvoiceEvent.php");
	include_once(CLASSES_DIR."/class_InvoiceBanner.php");
	include_once(CLASSES_DIR."/class_InvoiceClassified.php");
	include_once(CLASSES_DIR."/class_InvoiceArticle.php");
	include_once(CLASSES_DIR."/class_InvoiceCustomInvoice.php");
	include_once(CLASSES_DIR."/class_InvoicePackage.php");
	include_once(CLASSES_DIR."/class_EmailNotification.php");
	include_once(CLASSES_DIR."/class_ForgotPassword.php");
	include_once(CLASSES_DIR."/class_PageBrowsing.php");
	include_once(CLASSES_DIR."/class_ImportStatus.php");
	include_once(CLASSES_DIR."/class_ImportLog.php");
	include_once(CLASSES_DIR."/class_Export.php");
	include_once(CLASSES_DIR."/class_ItemStatus.php");
	include_once(CLASSES_DIR."/class_Gallery.php");
	include_once(CLASSES_DIR."/class_Listing.php");
	include_once(CLASSES_DIR."/class_ListingLevel.php");
	include_once(CLASSES_DIR."/class_ListingCategory.php");
	include_once(CLASSES_DIR."/class_Promotion.php");
	include_once(CLASSES_DIR."/class_ListingTemplate.php");
	include_once(CLASSES_DIR."/class_Review.php");
	include_once(CLASSES_DIR."/class_Claim.php");
	include_once(CLASSES_DIR."/class_ListingChoice.php");
	include_once(CLASSES_DIR."/class_EditorChoice.php");
	include_once(CLASSES_DIR."/class_Event.php");
	include_once(CLASSES_DIR."/class_EventLevel.php");
	include_once(CLASSES_DIR."/class_EventCategory.php");
	include_once(CLASSES_DIR."/class_Banner.php");
	include_once(CLASSES_DIR."/class_BannerLevel.php");
	include_once(CLASSES_DIR."/class_Classified.php");
	include_once(CLASSES_DIR."/class_ClassifiedLevel.php");
	include_once(CLASSES_DIR."/class_ClassifiedCategory.php");
	include_once(CLASSES_DIR."/class_Article.php");
	include_once(CLASSES_DIR."/class_ArticleLevel.php");
	include_once(CLASSES_DIR."/class_ArticleCategory.php");
	include_once(CLASSES_DIR."/class_CustomInvoice.php");
	include_once(CLASSES_DIR."/class_ThumbGenerator.php");
	include_once(CLASSES_DIR."/class_XLSGenerator.php");
	include_once(CLASSES_DIR."/class_ZipGenerator.php");
	include_once(CLASSES_DIR."/class_FormValidator.php");
	include_once(CLASSES_DIR."/class_UploadFiles.php");
	include_once(CLASSES_DIR."/class_RSSWriter.php");
	include_once(CLASSES_DIR."/class_ZipFile.php");
	include_once(CLASSES_DIR."/class_Inflector.php");
	include_once(CLASSES_DIR."/class_GoogleMap.php");
	include_once(CLASSES_DIR."/class_SearchMetaTag.php");
	include_once(CLASSES_DIR."/class_RobotsFilter.php");
	include_once(CLASSES_DIR."/class_FAQ.php");
	include_once(CLASSES_DIR."/class_json.php");
	include_once(CLASSES_DIR."/class_Profile.php");
	include_once(CLASSES_DIR."/class_Quicklist.php");
	include_once(CLASSES_DIR."/class_Listing_Category.php");
	include_once(CLASSES_DIR."/class_Domain.php");
	include_once(CLASSES_DIR."/class_Post.php");
	include_once(CLASSES_DIR."/class_BlogCategory.php");
    include_once(CLASSES_DIR."/class_Blog_Category.php");
	include_once(CLASSES_DIR."/class_Comments.php");
	include_once(CLASSES_DIR."/class_ConnectionPool.php");
	include_once(CLASSES_DIR."/class_Package.php");
	include_once(CLASSES_DIR."/class_PackageItems.php");
	include_once(CLASSES_DIR."/class_PackageModules.php");
	include_once(CLASSES_DIR."/class_Zip.php");
	include_once(CLASSES_DIR."/class_Slider.php");
	include_once(CLASSES_DIR."/class_pagination.php");
	include_once(CLASSES_DIR."/class_Navigation.php");
	include_once(CLASSES_DIR."/class_MailAppList.php");
	include_once(CLASSES_DIR."/class_Lead.php");
	include_once(CLASSES_DIR."/class_Timeline.php");

	# ----------------------------------------------------------------------------------------------------
	# CLASS AUTOLOADER
	# ----------------------------------------------------------------------------------------------------
	include_once(CLASSES_DIR."/autoload.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GLOBAL FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	include_once(FUNCTIONS_DIR."/db_funct.php");
	include_once(FUNCTIONS_DIR."/crypt_funct.php");
	include_once(FUNCTIONS_DIR."/reg_funct.php");
	include_once(FUNCTIONS_DIR."/format_funct.php");
	include_once(FUNCTIONS_DIR."/html_funct.php");
	include_once(FUNCTIONS_DIR."/image_funct.php");
	include_once(FUNCTIONS_DIR."/import_funct.php");
	include_once(FUNCTIONS_DIR."/language_funct.php");
	include_once(FUNCTIONS_DIR."/mobile_funct.php");
	include_once(FUNCTIONS_DIR."/payment_funct.php");
	include_once(FUNCTIONS_DIR."/report_funct.php");
	include_once(FUNCTIONS_DIR."/sess_funct.php");
	include_once(FUNCTIONS_DIR."/setting_funct.php");
	include_once(FUNCTIONS_DIR."/customtext_funct.php");
	include_once(FUNCTIONS_DIR."/system_funct.php");
	include_once(FUNCTIONS_DIR."/template_funct.php");
	include_once(FUNCTIONS_DIR."/validate_funct.php");
	include_once(FUNCTIONS_DIR."/permission_funct.php");
	include_once(FUNCTIONS_DIR."/maintenance_funct.php");
	include_once(FUNCTIONS_DIR."/socialnetwork_funct.php");
	include_once(FUNCTIONS_DIR."/blog_funct.php");
	include_once(FUNCTIONS_DIR."/export_funct.php");
    include_once(FUNCTIONS_DIR."/domain_funct.php");
    include_once(FUNCTIONS_DIR."/geo_funct.php");
    include_once(FUNCTIONS_DIR."/package_funct.php");
    include_once(FUNCTIONS_DIR."/twilio_funct.php");
	include_once(FUNCTIONS_DIR."/colorscheme_funct.php");
	include_once(FUNCTIONS_DIR."/todo_funct.php");
	include_once(FUNCTIONS_DIR."/front_funct.php");
	include_once(FUNCTIONS_DIR."/arcamailer_funct.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE SETUP
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/language.inc.php");
	include(EDIRECTORY_ROOT."/conf/location.inc.php");
	include(EDIRECTORY_ROOT."/conf/accountpermission.inc.php");
	include(EDIRECTORY_ROOT."/conf/facebook.inc.php");
	include(EDIRECTORY_ROOT."/conf/twilio.inc.php");
	if (!$_inCron) {
		include(EDIRECTORY_ROOT."/conf/modules.inc.php");
    }

    # ----------------------------------------------------------------------------------------------------
    # INCLUDE MESSAGES
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/messages.php");

    # ----------------------------------------------------------------------------------------------------
    # INCLUDE AUTOLOAD COMPOSER
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/../vendor/autoload.php");
    include(CLASSES_DIR."/class_Symfony.php");
?>
