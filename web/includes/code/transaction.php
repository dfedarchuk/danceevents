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
	# * FILE: /includes/code/transacton.php
	# ----------------------------------------------------------------------------------------------------

	/**
	*
	* Retrieving payment logs
	*
	***************************************************************/

	if (isset($transactionObj))                unset($transactionObj);
	if (isset($transaction_listing_log))       unset($transaction_listing_log);
	if (isset($transaction_event_log))         unset($transaction_event_log);
	if (isset($transaction_banner_log))        unset($transaction_banner_log);
	if (isset($transaction_classified_log))    unset($transaction_classified_log);
	if (isset($transaction_article_log))       unset($transaction_article_log);
	if (isset($transaction_custominvoice_log)) unset($transaction_custominvoice_log);
	if (isset($transaction_package_log))       unset($transaction_package_log);

	if ($id = $_GET["id"]){

		if (string_strpos($url_base, "/".MEMBERS_ALIAS."")) {
			$by_key = array("id", "account_id", "hidden");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession(), "'n'");
			$transactionObj = db_getFromDB("payment_log", $by_key, $by_value, 1, "", "object", SELECTED_DOMAIN_ID);
		} else {
            $by_key = array("id", "hidden");
			$by_value = array(db_formatNumber($id), "'n'");
			$transactionObj = db_getFromDB("payment_log", $by_key, $by_value, 1, "", "object", SELECTED_DOMAIN_ID);
		}

		if ($transactionObj) {

			$listingLevelObj    = new ListingLevel();
			$eventLevelObj      = new EventLevel();
			$bannerLevelObj     = new BannerLevel();
			$classifiedLevelObj = new ClassifiedLevel();
			$articleLevelObj    = new ArticleLevel();

			$transaction["id"]                   = $transactionObj->getString("id");
			$transaction["payment_log_id"]       = $transactionObj->getString("id");
			$transaction["account_id"]           = $transactionObj->getString("account_id");
			$transaction["username"]             = $transactionObj->getString("username");
			$transaction["ip"]                   = $transactionObj->getString("ip");
			$transaction["transaction_id"]       = $transactionObj->getString("transaction_id");
			$transaction["transaction_status"]   = $transactionObj->getString("transaction_status");
			$transaction["transaction_datetime"] = format_date($transactionObj->getString("transaction_datetime"), DEFAULT_DATE_FORMAT." H:i:s", "datetime");
			$transaction["transaction_subtotal"] = $transactionObj->getString("transaction_subtotal");
			$transaction["transaction_tax"]      = payment_calculateTax($transactionObj->getString("transaction_subtotal"),$transactionObj->getString("transaction_tax"),true,false);
			$transaction["transaction_amount"]   = $transactionObj->getString("transaction_amount");
			$transaction["transaction_currency"] = $transactionObj->getString("transaction_currency");
			$transaction["system_type"]          = $transactionObj->getString("system_type");
			$transaction["recurring"]            = $transactionObj->getString("recurring");
			$transaction["notes"]                = $transactionObj->getString("notes");

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql ="SELECT * FROM Payment_Listing_Log WHERE payment_log_id = '{$transaction["payment_log_id"]}'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$listingObj = new Listing($row["listing_id"]);

				$transaction_listing_log[$i]["title"]            = $listingObj->getString("title");
				$transaction_listing_log[$i]["listing_id"]       = $row["listing_id"];
				$transaction_listing_log[$i]["listing_title"]    = $row["listing_title"];
				$transaction_listing_log[$i]["discount_id"]      = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA) ;
				$transaction_listing_log[$i]["level"]            = $row["level"];
				$transaction_listing_log[$i]["level_label"]      = $row["level_label"];
				$transaction_listing_log[$i]["renewal_date"]     = $row["renewal_date"];
				$transaction_listing_log[$i]["categories"]       = $row["categories"];
				$transaction_listing_log[$i]["extra_categories"] = $row["extra_categories"];
				$transaction_listing_log[$i]["listingtemplate"]  = $row["listingtemplate_title"];
				$transaction_listing_log[$i]["amount"]           = $row["amount"];

				$i++;

			}
			
			$sql ="SELECT * FROM Payment_Event_Log WHERE payment_log_id = '{$transaction["payment_log_id"]}'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$eventObj = new Event($row["event_id"]);

				$transaction_event_log[$i]["title"]        = $eventObj->getString("title");
				$transaction_event_log[$i]["event_id"]     = $row["event_id"];
				$transaction_event_log[$i]["event_title"]  = $row["event_title"];
				$transaction_event_log[$i]["discount_id"]  = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA) ;
				$transaction_event_log[$i]["level"]        = $row["level"];
				$transaction_event_log[$i]["level_label"]  = $row["level_label"];
				$transaction_event_log[$i]["renewal_date"] = $row["renewal_date"];
				$transaction_event_log[$i]["amount"]       = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Payment_Banner_Log WHERE payment_log_id = '{$transaction["payment_log_id"]}'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$bannerObj = new Banner($row["banner_id"]);

				$transaction_banner_log[$i]["caption"]        = $bannerObj->getString("caption");
				$transaction_banner_log[$i]["banner_id"]      = $row["banner_id"];
				$transaction_banner_log[$i]["banner_caption"] = $row["banner_caption"];
				$transaction_banner_log[$i]["discount_id"]    = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA) ;
                $transaction_banner_log[$i]["level"]          = $row["level"];
				$transaction_banner_log[$i]["level_label"]    = $row["level_label"];
				
				$transaction_banner_log[$i]["renewal_date"]   = $row["renewal_date"];
				$transaction_banner_log[$i]["impressions"]    = $row["impressions"];
				$transaction_banner_log[$i]["amount"]         = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Payment_Classified_Log WHERE payment_log_id = '{$transaction["payment_log_id"]}'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$classifiedObj = new Classified($row["classified_id"]);

				$transaction_classified_log[$i]["title"]            = $classifiedObj->getString("title");
				$transaction_classified_log[$i]["classified_id"]    = $row["classified_id"];
				$transaction_classified_log[$i]["classified_title"] = $row["classified_title"];
				$transaction_classified_log[$i]["discount_id"]      = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA) ;
                $transaction_classified_log[$i]["level"]            = $row["level"];
				$transaction_classified_log[$i]["level_label"]      = $row["level_label"];
				$transaction_classified_log[$i]["renewal_date"]     = $row["renewal_date"];
				$transaction_classified_log[$i]["amount"]           = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Payment_Article_Log WHERE payment_log_id = '{$transaction["payment_log_id"]}'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$articleObj = new Article($row["article_id"]);

				$transaction_article_log[$i]["title"]         = $articleObj->getString("title");
				$transaction_article_log[$i]["article_id"]    = $row["article_id"];
				$transaction_article_log[$i]["article_title"] = $row["article_title"];
				$transaction_article_log[$i]["discount_id"]   = ($row["discount_id"]) ? $row["discount_id"] : system_showText(LANG_NA) ;
                $transaction_article_log[$i]["level"]         = $row["level"];
				$transaction_article_log[$i]["level_label"]   = $row["level_label"];
				$transaction_article_log[$i]["renewal_date"]  = $row["renewal_date"];
				$transaction_article_log[$i]["amount"]        = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Payment_CustomInvoice_Log WHERE payment_log_id = '{$transaction["payment_log_id"]}'";
			
			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$customInvoiceObj = new CustomInvoice($row["custom_invoice_id"]);

				$transaction_custominvoice_log[$i]["custom_invoice_id"] = $row["custom_invoice_id"];
				$transaction_custominvoice_log[$i]["title"]             = $row["title"];
				$transaction_custominvoice_log[$i]["date"]              = $row["date"];
				$transaction_custominvoice_log[$i]["items"]             = $row["items"];
				$transaction_custominvoice_log[$i]["items_price"]       = $row["items_price"];
				$transaction_custominvoice_log[$i]["amount"]            = $row["amount"];

				$i++;

			}

			$sql ="SELECT * FROM Payment_Package_Log WHERE payment_log_id = '{$transaction["payment_log_id"]}'";

			$r = $db->query($sql);
			$i=0;
			while($row = mysql_fetch_assoc($r)){

				$packageObj = new Package($row["package_id"]);

				$transaction_package_log[$i]["package_id"]		  = $row["package_id"];
				$transaction_package_log[$i]["package_title"]     = $row["package_title"];
				$transaction_package_log[$i]["items"]             = $row["items"];
				$transaction_package_log[$i]["items_price"]       = $row["items_price"];
				$transaction_package_log[$i]["amount"]            = $row["amount"];

				$i++;

			}

		}

	}

?>
