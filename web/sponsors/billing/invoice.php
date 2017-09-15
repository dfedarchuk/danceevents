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
	# * FILE: /sponsors/billing/invoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/billing";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# * CODE
	# ----------------------------------------------------------------------------------------------------  
	$error = false;
	if ($id) {
		$invoiceObj = new Invoice($id);
		if ((!$invoiceObj->getNumber("id")) || ($invoiceObj->getNumber("id") <= 0)) $error = true;
		if (sess_getAccountIdFromSession() != $invoiceObj->getNumber("account_id")) $error = true;
	} else {
		$error = true;
	}

	if (!$error) {

		// Invoice info
		if ($invoiceObj->getString("status") == "N") $invoiceObj->setString("status","P");
		$invoiceObj->Save();

		// Account info
		$contactObj = new Contact($invoiceObj->getString("account_id"));

		// Listing info
		$db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
		$sql = "SELECT * FROM Invoice_Listing WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$listingObj = new Listing($row["listing_id"]);
			$arr_invoice_listing[$i] = $row;
			$arr_invoice_listing[$i]["renewal_date"] = format_date($row["renewal_date"]);

			if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
				if ($listingObj->getNumber("listingtemplate_id")) {
					$listingTemplateObj = new ListingTemplate($listingObj->getNumber("listingtemplate_id"));
					$arr_invoice_listing[$i]["listingtemplate"] = $listingTemplateObj->getString("title");
				}
			}

			$arr_invoice_listing[$i++]["listing_title"] = $row["listing_title"];
			unset($listingObj);
		}

		// Event info
		$sql = "SELECT * FROM Invoice_Event WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$eventObj = new Event($row["event_id"]);
			$arr_invoice_event[$i] = $row;
			$arr_invoice_event[$i]["renewal_date"] = format_date($row["renewal_date"]);
			$arr_invoice_event[$i++]["event_title"] = $row["event_title"];
			unset($eventObj);
		}

		// Banner info
		$sql = "SELECT * FROM Invoice_Banner WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$bannerObj = new Banner($row["banner_id"]);
			$arr_invoice_banner[$i] = $row;
			$arr_invoice_banner[$i]["renewal_date"] = format_date($row["renewal_date"], DEFAULT_DATE_FORMAT, "date");
			$arr_invoice_banner[$i]["impressions"] = $row["impressions"];
			$arr_invoice_banner[$i++]["banner_caption"] = $row["banner_caption"];
			unset($bannerObj);
		}

		// Classified info
		$sql = "SELECT * FROM Invoice_Classified WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$classifiedObj = new Classified($row["classified_id"]);
			$arr_invoice_classified[$i] = $row;
			$arr_invoice_classified[$i]["renewal_date"] = format_date($row["renewal_date"]);
			$arr_invoice_classified[$i++]["classified_title"] = $row["classified_title"];
			unset($classifiedObj);
		}

		// Article info
		$sql = "SELECT * FROM Invoice_Article WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$articleObj = new Article($row["article_id"]);
			$arr_invoice_article[$i] = $row;
			$arr_invoice_article[$i]["renewal_date"] = format_date($row["renewal_date"]);
			$arr_invoice_article[$i++]["article_title"] = $row["article_title"];
			unset($articleObj);
		}

		// Custom Invoice Item
		$sql = "SELECT * FROM Invoice_CustomInvoice WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$arr_invoice_custominvoice[$i] = $row;
			$i++;
		}

		// Pacakge Item
		$sql = "SELECT * FROM Invoice_Package WHERE invoice_id = '{$_GET["id"]}'";
		$rs = $dbObj->query($sql);

		$i=0;
		while($row = mysql_fetch_assoc($rs)){
			$arr_invoice_package[$i] = $row;
			$i++;
		}

		include(INCLUDES_DIR."/views/view_invoice.php");

	} else {
		?>
		<html>
			<head>
				<title><?=system_showText(LANG_LABEL_ERROR)?></title>
			</head>
			<body>
				<?=system_showText(LANG_MSG_ACCESS_NOT_ALLOWED)?>
			</body>
		</html>
		<?
	}