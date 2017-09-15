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
	# * FILE: /includes/code/invoice.php
	# ----------------------------------------------------------------------------------------------------

	/**
	*
	* Retrieving payment logs
	*
	***************************************************************/
	
	if (isset($invoiceObj)) 		unset($invoiceObj);
	if (isset($invoice_listing)) 	unset($invoice_listing);
	if (isset($invoice_event)) 	 	unset($invoice_event);
	if (isset($invoice_banner))  	unset($invoice_banner);
	if (isset($invoice_article)) 	unset($invoice_article);
	if (isset($invoice_classified)) unset($invoice_classified);
	if (isset($invoice_custominvoice)) { unset($invoice_custominvoice); }
	if (isset($invoice_package))	   { unset($invoice_package); }

	if($id = $_GET["id"]){

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT * FROM Invoice WHERE id = '$id' AND status != 'N' AND hidden = 'n' ";
		if($acctId) $sql .= "AND account_id = '$acctId'";
		$r = $db->query($sql);
		if(mysql_num_rows($r) > 0) $invoiceObj = new Invoice($id);

		if($invoiceObj){

			$invoiceStatusObj   = new InvoiceStatus();
			$listingLevelObj    = new ListingLevel();
			$eventLevelObj      = new EventLevel();
			$bannerLevelObj     = new BannerLevel();
			$classifiedLevelObj = new ClassifiedLevel();
			$articleLevelObj    = new ArticleLevel();

			$invoice["id"]           = $id;
			$invoice["username"]     = $invoiceObj->getString("username");
			$invoice["account_id"]   = $invoiceObj->getString("account_id");
			$invoice["ip"]           = $invoiceObj->getString("ip");
			$invoice["date"]         = format_date($invoiceObj->getString("date"),DEFAULT_DATE_FORMAT." H:i:s","datetime");
			$invoice["status"]       = $invoiceStatusObj->getStatus($invoiceObj->getString("status"));
			$invoice["subtotal"]     = $invoiceObj->getString("subtotal_amount");
			$invoice["tax"]			 = payment_calculateTax($invoice["subtotal"],$invoiceObj->getString("tax_amount"),true,false); 
			$invoice["amount"]       = $invoiceObj->getString("amount");
			$invoice["currency"]     = $invoiceObj->getString("currency");
			$invoice["expire_date"]  = format_date($invoiceObj->getString("expire_date"),DEFAULT_DATE_FORMAT,"date");
			$invoice["payment_date"] = format_date($invoiceObj->getString("payment_date"),DEFAULT_DATE_FORMAT." H:i:s","datetime");

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql ="SELECT * FROM Invoice_Listing WHERE invoice_id = '$id'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$listingObj = new Listing($row["listing_id"]);

				$invoice_listing[$i]["invoice_id"]       = $invoiceObj->getString("id");
				$invoice_listing[$i]["listing_id"]       = $row["listing_id"];
				$invoice_listing[$i]["listing_title"]    = $row["listing_title"];
				$invoice_listing[$i]["discount_id"]      = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA);
                $invoice_listing[$i]["level"]            = $row["level"];
				$invoice_listing[$i]["level_label"]      = $row["level_label"];
				$invoice_listing[$i]["renewal_date"]     = (format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date")) ? format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date") : system_showText(LANG_NA);
				$invoice_listing[$i]["categories"]       = $row["categories"];
				$invoice_listing[$i]["extra_categories"] = $row["extra_categories"];
				$invoice_listing[$i]["listingtemplate"]  = $row["listingtemplate_title"];
				$invoice_listing[$i]["amount"]           = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Invoice_Event WHERE invoice_id = '$id'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$eventObj = new Event($row["event_id"]);

				$invoice_event[$i]["invoice_id"]   = $invoiceObj->getString("id");
				$invoice_event[$i]["event_id"]     = $row["event_id"];
				$invoice_event[$i]["event_title"]  = $row["event_title"];
				$invoice_event[$i]["discount_id"]  = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA);
                $invoice_event[$i]["level"]        = $row["level"];
				$invoice_event[$i]["level_label"]  = $row["level_label"];
				$invoice_event[$i]["renewal_date"] = (format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date")) ? format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date") : system_showText(LANG_NA);
				$invoice_event[$i]["amount"]       = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Invoice_Banner WHERE invoice_id = '$id'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$bannerObj = new Banner($row["banner_id"]);

				$invoice_banner[$i]["invoice_id"]     = $invoiceObj->getString("id");
				$invoice_banner[$i]["banner_id"]      = $row["banner_id"];
				$invoice_banner[$i]["banner_caption"] = $row["banner_caption"];
				$invoice_banner[$i]["discount_id"]    = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA);
                $invoice_banner[$i]["level"]          = $row["level"];
				$invoice_banner[$i]["level_label"]    = $row["level_label"];
				$invoice_banner[$i]["renewal_date"]   = (format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date")) ? format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date") : (($row["impressions"]) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_NA)));
				$invoice_banner[$i]["impressions"]    = ($row["impressions"]) ? $row["impressions"] : system_showText(LANG_LABEL_UNLIMITED);
				$invoice_banner[$i]["amount"]         = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Invoice_Classified WHERE invoice_id = '$id'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$classifiedObj = new Classified($row["classified_id"]);

				$invoice_classified[$i]["invoice_id"]       = $invoiceObj->getString("id");
				$invoice_classified[$i]["classified_id"]    = $row["classified_id"];
				$invoice_classified[$i]["classified_title"] = $row["classified_title"];
				$invoice_classified[$i]["discount_id"]      = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA);
                $invoice_classified[$i]["level"]            = $row["level"];
				$invoice_classified[$i]["level_label"]      = $row["level_label"];
				$invoice_classified[$i]["renewal_date"]     = (format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"datetime")) ? format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"datetime") : system_showText(LANG_NA);
				$invoice_classified[$i]["amount"]           = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Invoice_Article WHERE invoice_id = '$id'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$articleObj = new Article($row["article_id"]);

				$invoice_article[$i]["invoice_id"]    = $invoiceObj->getString("id");
				$invoice_article[$i]["article_id"]    = $row["article_id"];
				$invoice_article[$i]["article_title"] = $row["article_title"];
				$invoice_article[$i]["discount_id"]   = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA);
                $invoice_article[$i]["level"]         = $row["level"];
				$invoice_article[$i]["level_label"]   = $row["level_label"];
				$invoice_article[$i]["renewal_date"]  = (format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date")) ? format_date($row["renewal_date"],DEFAULT_DATE_FORMAT,"date") : system_showText(LANG_NA);
				$invoice_article[$i]["amount"]        = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Invoice_CustomInvoice WHERE invoice_id = '$id'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){
				
				$invoice_custominvoice[$i]["invoice_id"]        = $invoiceObj->getString("id");
				$invoice_custominvoice[$i]["custom_invoice_id"] = $row["custom_invoice_id"];
				$invoice_custominvoice[$i]["title"]             = $row["title"];
				$invoice_custominvoice[$i]["date"]              = $row["date"];
				$invoice_custominvoice[$i]["items"]             = $row["items"];
				$invoice_custominvoice[$i]["items_price"]       = $row["items_price"];
				$invoice_custominvoice[$i]["subtotal"]          = $row["subtotal"];
				$invoice_custominvoice[$i]["amount"]            = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Invoice_Package WHERE invoice_id = '$id'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$invoice_package[$i]["invoice_id"]        = $invoiceObj->getString("id");
				$invoice_package[$i]["package_id"]		  = $row["package_id"];
				$invoice_package[$i]["package_title"]     = $row["package_title"];
				$invoice_package[$i]["items"]             = $row["items"];
				$invoice_package[$i]["items_price"]       = $row["items_price"];
				$invoice_package[$i]["subtotal"]          = $row["subtotal"];
				$invoice_package[$i]["amount"]            = $row["amount"];

				$i++;

			}

		}

	}

?>
