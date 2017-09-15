<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /sponsors/claim/getlisting.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	$resetDomainSession = true;
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$accountObject = new Account($acctId);
	$contactObject = new Contact($acctId);
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/claim";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }
	if (!$claimlistingid) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	if (is_numeric($listingObject->getNumber("account_id"))) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	if ($listingObject->getString("claim_disable") != "n") {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$status = new ItemStatus();

	$listingObject->setNumber("account_id", $acctId);
    if ($listingObject->countDeals($claimlistingid) > 0){
      $listingObject->removePromotionLinks();
    }
	$listingObject->setDate("renewal_date", "00/00/0000");
	$listingObject->setString("status", $status->getDefaultStatus());

	$listingObject->save();

	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "UPDATE Claim SET status = 'incomplete' WHERE account_id = '".$accountObject->getNumber("id")."' AND listing_id = '".$listingObject->getNumber("id")."' AND status = 'progress'";
	$dbObjClaim->query($sqlClaim);

	$claimObject = new Claim();

	$claimObject->setNumber("account_id", $accountObject->getNumber("id"));
	$claimObject->setString("username", $accountObject->getString("username"));
	$claimObject->setNumber("listing_id", $listingObject->getNumber("id"));
	$claimObject->setString("listing_title", $listingObject->getString("title", false));
	$claimObject->setString("step", "a");
	$claimObject->setString("status", "progress");

	$claimObject->setString("old_location_1", $listingObject->getNumber("location_1"));
	$claimObject->setString("new_location_1", $listingObject->getNumber("location_1"));
	$claimObject->setString("old_location_2", $listingObject->getNumber("location_2"));
	$claimObject->setString("new_location_2", $listingObject->getNumber("location_2"));
	$claimObject->setString("old_location_3", $listingObject->getNumber("location_3"));
	$claimObject->setString("new_location_3", $listingObject->getNumber("location_3"));
	$claimObject->setString("old_location_4", $listingObject->getNumber("location_4"));
	$claimObject->setString("new_location_4", $listingObject->getNumber("location_4"));
	$claimObject->setString("old_location_5", $listingObject->getNumber("location_5"));
	$claimObject->setString("new_location_5", $listingObject->getNumber("location_5"));
	$claimObject->setString("old_title", $listingObject->getString("title", false));
	$claimObject->setString("new_title", $listingObject->getString("title", false));
	$claimObject->setString("old_friendly_url", $listingObject->getString("friendly_url", false));
	$claimObject->setString("new_friendly_url", $listingObject->getString("friendly_url", false));
	$claimObject->setString("old_email", $listingObject->getString("email", false));
	$claimObject->setString("new_email", $listingObject->getString("email", false));
	$claimObject->setString("old_url", $listingObject->getString("url", false));
	$claimObject->setString("new_url", $listingObject->getString("url", false));
	$claimObject->setString("old_phone", $listingObject->getString("phone", false));
	$claimObject->setString("new_phone", $listingObject->getString("phone", false));
	$claimObject->setString("old_fax", $listingObject->getString("fax", false));
	$claimObject->setString("new_fax", $listingObject->getString("fax", false));
	$claimObject->setString("old_address", $listingObject->getString("address", false));
	$claimObject->setString("new_address", $listingObject->getString("address", false));
	$claimObject->setString("old_address2", $listingObject->getString("address2", false));
	$claimObject->setString("new_address2", $listingObject->getString("address2", false));
	$claimObject->setString("old_zip_code", $listingObject->getString("zip_code", false));
	$claimObject->setString("new_zip_code", $listingObject->getString("zip_code", false));
	$claimObject->setString("old_level", $listingObject->getNumber("level"));
	$claimObject->setString("new_level", $listingObject->getNumber("level"));
	$claimObject->setString("old_listingtemplate_id", $listingObject->getNumber("listingtemplate_id"));
	$claimObject->setString("new_listingtemplate_id", $listingObject->getNumber("listingtemplate_id"));

	$claimObject->save();

	/**************************************************************************************************/
	/*                                                                                                */
	/* E-mail notify                                                                                  */
	/*                                                                                                */
	/**************************************************************************************************/
	setting_get("sitemgr_claim_email", $sitemgr_claim_email);
	$sitemgr_claim_emails = explode(",", $sitemgr_claim_email);

	// site manager warning message /////////////////////////////////////
    $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_NEWCLAIM);
    $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br><br>".system_showText(LANG_NOTIFY_NEWCLAIM_1)."<br><br>
    ".system_showText(LANG_NOTIFY_NEWCLAIM_2).":<br><br>
    <strong>".system_showText(LANG_NOTIFY_NEWCLAIM_3).": </strong>".$claimObject->getNumber("id")."<br>
    <a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/claim/index.php?search_id=".$claimObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/claim/index.php?search_id=".$claimObject->getNumber("id")."</a><br><br>
    ".system_showText(LANG_NOTIFY_NEWCLAIM_4).":<br>
    <strong>".string_ucwords(LISTING_FEATURE_NAME).": </strong>".$listingObject->getString("title")."<br>
    <a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/listing.php?id=".$listingObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/listing.php?id=".$listingObject->getNumber("id")."</a><br><br>
    ".system_showText(LANG_NOTIFY_NEWCLAIM_5).":<br>
    <strong>".system_showText(LANG_LABEL_ACCOUNT).": </strong>".system_showAccountUserName($accountObject->getString("username"))."<br>
    <a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?id=".$accountObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/account/sponsor/sponsor.php?id=".$accountObject->getNumber("id")."</a><br><br>
    ".system_showText(LANG_NOTIFY_NEWCLAIM_6).":<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_USERNAME2).": </strong>".$accountObject->getString("username")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_FIRST_NAME).": </strong>".$contactObject->getString("first_name")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_LAST_NAME).": </strong>".$contactObject->getString("last_name")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_COMPANY).": </strong>".$contactObject->getString("company")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_ADDRESS).": </strong>".$contactObject->getString("address")." ".$contactObject->getString("address2")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_CITY).": </strong>".$contactObject->getString("city")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_STATE).": </strong>".$contactObject->getString("state")."<br>";
    $sitemgr_msg .= "<strong>".ucfirst(system_showText(ZIPCODE_LABEL)).": </strong>".$contactObject->getString("zip")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_COUNTRY).": </strong>".$contactObject->getString("country")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_PHONE).": </strong>".$contactObject->getString("phone")."<br>";
    $sitemgr_msg .= "<strong>".system_showText(LANG_LABEL_EMAIL).": </strong>".$contactObject->getString("email")."<br>";

    system_notifySitemgr($sitemgr_claim_emails, $emailSubject, $sitemgr_msg);

	////////////////////////////////////////////////////////////////////////////////////////////////////

	header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/claim/listinglevel.php?claimlistingid=".$claimlistingid);
	exit;
