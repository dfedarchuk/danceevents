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
	# * FILE: /includes/code/billing.php
	# ----------------------------------------------------------------------------------------------------

	$max_item_sum = 50;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	if ($action == "update_renewal" && $_SERVER["REQUEST_METHOD"] == "POST") {
		$_SESSION["order_renewal_period_{$module}_{$id}"] = $option;
        $_SESSION["order_renewal_period_authorize"] = $option;
		exit;
	}
    /*
     * Fix to normalize variable standard. At this point it should be M or Y, but some places are sending it as monthly or yearly.
     * Sorry.
     */
    if ($_SESSION["order_renewal_period"] && string_strlen($_SESSION["order_renewal_period"] > 1)) {
        $_SESSION["order_renewal_period"] = strtoupper(substr($_SESSION["order_renewal_period"], 0, 1));
    }
	if ($second_step && !$payment_method) {
		$payment_message = system_showText(LANG_MSG_NO_PAYMENT_METHOD_SELECTED);
	} elseif ($payment_method == "stripe" && RECURRING_FEATURE == "on" && is_array($custom_invoice_id) && (is_array($listing_id) || is_array($event_id) || is_array($banner_id) || is_array($classified_id) || is_array($article_id))) {
        /*
         * When recurring is enabled, user can not pay for a listing (or other module), and a custom invoice at the same time, otherwise the item will be charged twice. Actualy they could, but we don't have time to change the code now.
         */
        $payment_message = "Before proceed with your subscription, please submit a separate payment for your outstanding invoices.";

    } else {

		if ($second_step && $ispackage == "true") {

			$packageObj = new Package($package_id);
			$array_package_offers = $packageObj->getPackagesByDomainID();

			$auxitem_name = $array_package_offers[0]["items"][0]["module"];
			$auxpackage_name = $packageObj->getString("title");
			if ($auxitem_name) {
				switch($auxitem_name) {
						 case 'listing': $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
										 $level = new ListingLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										 break;

						 case 'banner': $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
										 $level = new BannerLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										 break;

						 case 'event': $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
										 $level = new EventLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										break;

						case 'classified': $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
											 $level = new ClassifiedLevel();
											 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

											 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

											break;

						case 'article': $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
										 $level = new ArticleLevel();
										 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));

										 $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." - ".$item_levelName." ".system_showText(LANG_ON_SITES);

										 break;

						case 'custom_package': $item_name = $auxpackage_name;
												break;

					}

					$auxdomains_names = "";
					$aux_package_item_price = "";
					foreach ($array_package_offers as $package_offer) {
						foreach ($package_offer['items'] as $package_offer_item) {
							if ($package_offer_item['domain_id']>0) {
								$aux_domain_obj = new Domain($package_offer_item['domain_id']);
								$auxdomains_names .= "&nbsp;&nbsp;&nbsp;-".$aux_domain_obj->getString('name')."<br />";
								$auxlevel_names .= $item_levelName."<br />";
							}

							if ($package_offer_item['price'] == 0) {
								$aux_package_item_price .= CURRENCY_SYMBOL." ".system_showText(LANG_FREE)."<br />";
								$aux_package_total += $package_offer_item['price'];
							} else {
								$aux_package_item_price .= CURRENCY_SYMBOL." ".$package_offer_item['price']."<br />";
								$aux_package_total += $package_offer_item['price'];
							}
						}

						$auxdomains_names = string_substr($auxdomains_names, 0, -4);
						$auxlevel_names = string_substr($auxlevel_names, 0, -4);
						$aux_package_item_price = string_substr($aux_package_item_price, 0, -4);
					}
				$bill_info["package"]["id"] = $package_id;
				$bill_info["package"]["title"] = $auxpackage_name;
				$bill_info["package"]["value"] = $aux_package_total;
			}
		}

		/**
		* Listing bill information
		*******************************************************************************/

		if (!$second_step) {

			$db = db_getDBObject(DEFAULT_DB, true);
			$dbObject = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
			$sql = "SELECT count(id) FROM Listing WHERE account_id = ".sess_getAccountIdFromSession();
			$result = $dbObject->query($sql);
			if ($row = mysql_fetch_array($result)) {
				$total_listing_sum = $row[0];
			}
			unset($dbObject);
			if ($total_listing_sum <= 50) {
				$listings = db_getFromDB("listing", "account_id", sess_getAccountIdFromSession(), "", "title", "array", SELECTED_DOMAIN_ID);
			} else {
				$overlisting_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_LISTING_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
			}
		} else {
			if ($listing_id) {
				for ($i=0; $i < count($listing_id); $i++) {
					$listingObj = new Listing($listing_id[$i]);
					if (!is_valid_discount_code($discountlisting_id[$i], "listing", $listing_id[$i], $payment_message, $error_num)) {
						$payment_message = string_substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_LISTING)." \"<b>".$listingObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountlisting_id)){
						$listingObj->setString("discount_id", $discountlisting_id[$i]);
						$listingObj->Save();
						unset($listingObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($listing_id[$i]), sess_getAccountIdFromSession());
					$listings[] = db_getFromDB("listing", $by_key, $by_value, "1", "title", "array", SELECTED_DOMAIN_ID);
				}
			}
		}

		if ($listings) {

			$levelObj = new ListingLevel();

			foreach ($listings as $each_listing) {

				if ($second_step) {
					$auxListingObj = new Listing($each_listing["id"]);
					$each_listing["renewal_date"] = $auxListingObj->getNextRenewalDate(1, ($_SESSION["order_renewal_period_listing_{$each_listing["id"]}"] == "yearly" ? "Y" : "M"));
					unset($auxListingObj);
				}

				// retrieving categories related with listing
				$dbObject = db_getDBObject(DEFAULT_DB, true);
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObject);

				$category_amount = 0;
				$sql = "SELECT category_id FROM Listing_Category WHERE listing_id = {$each_listing["id"]}";
				$result = $db->query($sql);
				if(mysql_num_rows($result)){
					while($row = mysql_fetch_assoc($result)){
						$category_amount++;
					}

				}

				// setting some of the bill information
				$bill_info["listings"]["{$each_listing["id"]}"]["title"]           = htmlspecialchars($each_listing["title"]);
				$bill_info["listings"]["{$each_listing["id"]}"]["level"]           = $levelObj->getLevel($each_listing["level"]);
				$bill_info["listings"]["{$each_listing["id"]}"]["level_number"]    = $each_listing["level"];
				$bill_info["listings"]["{$each_listing["id"]}"]["logo"]            = ($each_listing["image_id"]) ? 1 : 0;
				$bill_info["listings"]["{$each_listing["id"]}"]["url"]             = ($each_listing["url"]) ? 1 : 0;
				$bill_info["listings"]["{$each_listing["id"]}"]["category_amount"] = ($category_amount) ? $category_amount : 0;
				$bill_info["listings"]["{$each_listing["id"]}"]["renewal_date"]    = $each_listing["renewal_date"];
				$bill_info["listings"]["{$each_listing["id"]}"]["discount_id"]     = $each_listing["discount_id"];
				$bill_info["listings"]["{$each_listing["id"]}"]["status"]          = $each_listing["status"];

				if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
					if ($each_listing["listingtemplate_id"]) {
						$listingTemplateObj = new ListingTemplate($each_listing["listingtemplate_id"]);
						$bill_info["listings"]["{$each_listing["id"]}"]["listingtemplate"] = $listingTemplateObj->getString("title");
					}
				}

				// Need To Check Out
				$thisListing = new Listing($each_listing["id"]);
				if ($thisListing->needToCheckOut()) $bill_info["listings"]["{$each_listing["id"]}"]["needtocheckout"] = "y";
				else $bill_info["listings"]["{$each_listing["id"]}"]["needtocheckout"] = "n";
				unset($thisListing);

				if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($each_listing["level"])) > 0)) {
					$bill_info["listings"]["{$each_listing["id"]}"]["extra_category_amount"] = $category_amount - $levelObj->getFreeCategory($each_listing["level"]);
				} else {
					$bill_info["listings"]["{$each_listing["id"]}"]["extra_category_amount"] = 0;
				}

				// Bill pricing
				$thisListing = new Listing($each_listing["id"]);
				$bill_info["listings"]["{$each_listing["id"]}"]["total_fee"] = $thisListing->getPrice($_SESSION["order_renewal_period_listing_{$each_listing["id"]}"] ? $_SESSION["order_renewal_period_listing_{$each_listing["id"]}"] : $_SESSION["order_renewal_period"]);
				unset($thisListing);

				if ($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["listings"]["{$each_listing["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["listings"]["{$each_listing["id"]}"]["total_fee"];

				// Money format for listing fees
				if($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"])
					$bill_info["listings"]["{$each_listing["id"]}"]["total_fee"] = format_money($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"]);

			}

			// There is no listing been payed.
			if (empty($bill_info["listings"])) unset($bill_info["listings"]);

		}



		/**
		* Event bill information
		*******************************************************************************/

		if (!$second_step) {
			if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
				$db = db_getDBObject(DEFAULT_DB, true);
				$dbObject = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
				$sql = "SELECT count(id) FROM Event WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_event_sum = $row[0];
				}
				unset($dbObject);
				if ($total_event_sum <= 50) {
					$events = db_getFromDB("event", "account_id", sess_getAccountIdFromSession(), "", "title", "array", SELECTED_DOMAIN_ID);
				} else {
					$overevent_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_EVENT_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if ($event_id) {
				for ($i=0; $i < count($event_id); $i++) {
					$eventObj = new Event($event_id[$i]);
					if (!is_valid_discount_code($discountevent_id[$i], "event", $event_id[$i], $payment_message, $error_num)) {
						$payment_message = string_substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_EVENT)." \"<b>".$eventObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountevent_id)){
						$eventObj->setString("discount_id", $discountevent_id[$i]);
						$eventObj->Save();
						unset($eventObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($event_id[$i]), sess_getAccountIdFromSession());
					$events[] = db_getFromDB("event", $by_key, $by_value, "1", "title", "array", SELECTED_DOMAIN_ID);
				}
			}
		}

		if ($events) {

			$eventLevelObj = new EventLevel();

			foreach ($events as $each_event) {

				if ($second_step) {
					$auxEventObj = new Event($each_event["id"]);
					$each_event["renewal_date"] = $auxEventObj->getNextRenewalDate(1, ($_SESSION["order_renewal_period_event_{$each_event["id"]}"] == "yearly" ? "Y" : "M"));
					unset($auxEventObj);
				}

				// setting some of the bill information
				$bill_info["events"]["{$each_event["id"]}"]["title"]        = htmlspecialchars($each_event["title"]);
				$bill_info["events"]["{$each_event["id"]}"]["level"]        = $eventLevelObj->getLevel($each_event["level"]);
				$bill_info["events"]["{$each_event["id"]}"]["level_number"] = $each_event["level"];
				$bill_info["events"]["{$each_event["id"]}"]["renewal_date"] = $each_event["renewal_date"];
				$bill_info["events"]["{$each_event["id"]}"]["discount_id"]  = $each_event["discount_id"];
				$bill_info["events"]["{$each_event["id"]}"]["status"]       = $each_event["status"];

				// Need To Check Out
				$thisEvent = new Event($each_event["id"]);
				if ($thisEvent->needToCheckOut()) $bill_info["events"]["{$each_event["id"]}"]["needtocheckout"] = "y";
				else $bill_info["events"]["{$each_event["id"]}"]["needtocheckout"] = "n";
				unset($thisEvent);

				// Bill pricing
				$thisEvent = new Event($each_event["id"]);
				$bill_info["events"]["{$each_event["id"]}"]["total_fee"] = $thisEvent->getPrice($_SESSION["order_renewal_period_event_{$each_event["id"]}"] ? $_SESSION["order_renewal_period_event_{$each_event["id"]}"] : $_SESSION["order_renewal_period"]);
				unset($thisEvent);

				if ($bill_info["events"]["{$each_event["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["events"]["{$each_event["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["events"]["{$each_event["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["events"]["{$each_event["id"]}"]["total_fee"];

				// Money format for event fees
				if($bill_info["events"]["{$each_event["id"]}"]["total_fee"])
					$bill_info["events"]["{$each_event["id"]}"]["total_fee"] = format_money($bill_info["events"]["{$each_event["id"]}"]["total_fee"]);

			}

			// There is no event been payed.
			if (empty($bill_info["events"])) unset($bill_info["events"]);

		}



		/**
		* Banner bill information
		*******************************************************************************/
		if (!$second_step) {
			if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
				$db = db_getDBObject(DEFAULT_DB, true);
				$dbObject = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
				$sql = "SELECT count(id) FROM Banner WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_banner_sum = $row[0];
				}
				unset($dbObject);
				if ($total_banner_sum <= 50) {
					$sqlBanner = "";
					$sqlBanner .= " SELECT * FROM Banner";
					$sqlBanner .= " WHERE account_id = ".sess_getAccountIdFromSession();
					$sqlBanner .= " AND ((unlimited_impressions = 'n' AND unpaid_impressions > 0) or (unlimited_impressions = 'y'))";
					$sqlBanner .= " ORDER BY caption";
					$banners = db_getFromDBBySQL("banner", $sqlBanner, "array", false, SELECTED_DOMAIN_ID);
				} else {
					$overbanner_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_BANNER_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if ($banner_id) {
				for ($i=0; $i < count($banner_id); $i++) {
					$bannerObj = new Banner($banner_id[$i]);
					if (!is_valid_discount_code($discountbanner_id[$i], "banner", $banner_id[$i], $payment_message, $error_num)) {
						$payment_message = string_substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_BANNER)." \"<b>".$bannerObj->getString("caption")."</b>\"<br />";
					} elseif (is_array($discountbanner_id)){
						$bannerObj->setString("discount_id", $discountbanner_id[$i]);
						$bannerObj->Save();
						unset($bannerObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($banner_id[$i]), sess_getAccountIdFromSession());
					$banners[] = db_getFromDB("banner", $by_key, $by_value, "1", "caption", "array", SELECTED_DOMAIN_ID, false);
				}
			}
		}

		if ($banners) {

			$bannerLevelObj = new BannerLevel();

			foreach ($banners as $each_banner) {

				if($each_banner["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION){

					$each_banner["renewal_date"] = false;

				} elseif ($each_banner["expiration_setting"] == BANNER_EXPIRATION_RENEWAL_DATE){

					if ($second_step) {
						$auxBannerObj = new Banner($each_banner["id"]);
						$each_banner["renewal_date"] = $auxBannerObj->getNextRenewalDate(1, ($_SESSION["order_renewal_period_banner_{$each_banner["id"]}"] == "yearly" ? "Y" : "M"));
						unset($auxBannerObj);
					}

				}

				// setting some of the bill information
				$bill_info["banners"]["{$each_banner["id"]}"]["caption"]            = htmlspecialchars($each_banner["caption"]);
				$bill_info["banners"]["{$each_banner["id"]}"]["level"]              = $bannerLevelObj->getLevel($each_banner["type"]);
				$bill_info["banners"]["{$each_banner["id"]}"]["level_number"]       = $each_banner["type"];
				$bill_info["banners"]["{$each_banner["id"]}"]["expiration_setting"] = $each_banner["expiration_setting"];
				$bill_info["banners"]["{$each_banner["id"]}"]["renewal_date"]       = $each_banner["renewal_date"];
				$bill_info["banners"]["{$each_banner["id"]}"]["discount_id"]        = $each_banner["discount_id"];
				$bill_info["banners"]["{$each_banner["id"]}"]["unpaid_impressions"] = $each_banner["unpaid_impressions"];
				$bill_info["banners"]["{$each_banner["id"]}"]["status"]             = $each_banner["status"];

				// Need To Check Out
				$thisBanner = new Banner($each_banner["id"]);
				if ($thisBanner->needToCheckOut()) $bill_info["banners"]["{$each_banner["id"]}"]["needtocheckout"] = "y";
				else $bill_info["banners"]["{$each_banner["id"]}"]["needtocheckout"] = "n";
				unset($thisBanner);

				// Bill pricing
				$thisBanner = new Banner($each_banner["id"]);
				$bill_info["banners"]["{$each_banner["id"]}"]["total_fee"] = $thisBanner->getPrice($_SESSION["order_renewal_period_banner_{$each_banner["id"]}"] ? $_SESSION["order_renewal_period_banner_{$each_banner["id"]}"] : $_SESSION["order_renewal_period"]);
				unset($thisBanner);

				if ($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["banners"]["{$each_banner["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["banners"]["{$each_banner["id"]}"]["total_fee"];

				// Money format for banner fees
				if($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"])
					$bill_info["banners"]["{$each_banner["id"]}"]["total_fee"] = format_money($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"]);

			}

			// There is no banner been payed.
			if (empty($bill_info["banners"])) unset($bill_info["banners"]);

		}

		/**
		* Classified bill information
		*******************************************************************************/

		if (!$second_step) {
			if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
				$db = db_getDBObject(DEFAULT_DB, true);
				$dbObject = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
				$sql = "SELECT count(id) FROM Classified WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_classified_sum = $row[0];
				}
				unset($dbObject);
				if ($total_classified_sum <= 50) {
					$classifieds = db_getFromDB("classified", "account_id", sess_getAccountIdFromSession(), "", "title", "array", SELECTED_DOMAIN_ID);
				} else {
					$overclassified_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if( $classified_id) {
				for ($i=0; $i < count($classified_id); $i++) {
					$classifiedObj = new Classified($classified_id[$i]);
					if (!is_valid_discount_code($discountclassified_id[$i], "classified", $classified_id[$i], $payment_message, $error_num)) {
						$payment_message = string_substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_CLASSIFIED)." \"<b>".$classifiedObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountclassified_id)){
						$classifiedObj->setString("discount_id", $discountclassified_id[$i]);
						$classifiedObj->Save();
						unset($classifiedObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($classified_id[$i]), sess_getAccountIdFromSession());
					$classifieds[] = db_getFromDB("classified", $by_key, $by_value, "1", "title", "array", SELECTED_DOMAIN_ID);
				}
			}
		}

		if ($classifieds) {

			$classifiedLevelObj = new ClassifiedLevel();

			foreach ($classifieds as $each_classified) {

				if ($second_step) {
					$auxClassifiedObj = new Classified($each_classified["id"]);
					$each_classified["renewal_date"] = $auxClassifiedObj->getNextRenewalDate(1, ($_SESSION["order_renewal_period_classified_{$each_classified["id"]}"] == "yearly" ? "Y" : "M"));
					unset($auxClassifiedObj);
				}

				// setting some of the bill information
				$bill_info["classifieds"]["{$each_classified["id"]}"]["title"]        = htmlspecialchars($each_classified["title"]);
                $bill_info["classifieds"]["{$each_classified["id"]}"]["level"]        = $classifiedLevelObj->getLevel($each_classified["level"]);
				$bill_info["classifieds"]["{$each_classified["id"]}"]["level_number"] = $each_classified["level"];
				$bill_info["classifieds"]["{$each_classified["id"]}"]["renewal_date"] = $each_classified["renewal_date"];
				$bill_info["classifieds"]["{$each_classified["id"]}"]["discount_id"]  = $each_classified["discount_id"];
				$bill_info["classifieds"]["{$each_classified["id"]}"]["status"]       = $each_classified["status"];

				// Need To Check Out
				$thisClassified = new Classified($each_classified["id"]);
				if ($thisClassified->needToCheckOut()) $bill_info["classifieds"]["{$each_classified["id"]}"]["needtocheckout"] = "y";
				else $bill_info["classifieds"]["{$each_classified["id"]}"]["needtocheckout"] = "n";
				unset($thisClassified);

				// Bill pricing
				$thisClassified = new Classified($each_classified["id"]);
				$bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"] = $thisClassified->getPrice($_SESSION["order_renewal_period_classified_{$each_classified["id"]}"] ? $_SESSION["order_renewal_period_classified_{$each_classified["id"]}"] : $_SESSION["order_renewal_period"]);
				unset($thisClassified);

				if ($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["classifieds"]["{$each_classified["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"];

				// Money format for classified fees
				if($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"])
					$bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"] = format_money($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"]);

			}

			// There is no classified been payed.
			if (empty($bill_info["classifieds"])) unset($bill_info["classifieds"]);

		}



		/**
		* Article bill information
		*******************************************************************************/

		if (!$second_step) {
			if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
				$db = db_getDBObject(DEFAULT_DB, true);
				$dbObject = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
				$sql = "SELECT count(id) FROM Article WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_article_sum = $row[0];
				}
				unset($dbObject);
				if ($total_article_sum <= 50) {
					$articles = db_getFromDB("article", "account_id", sess_getAccountIdFromSession(), "", "title", "array", SELECTED_DOMAIN_ID);
				} else {
					$overarticle_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if ($article_id) {
				for ($i=0; $i < count($article_id); $i++) {
					$articleObj = new Article($article_id[$i]);
					if (!is_valid_discount_code($discountarticle_id[$i], "article", $article_id[$i], $payment_message, $error_num)) {
						$payment_message = string_substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_ARTICLE)." \"<b>".$articleObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountarticle_id)){
						$articleObj->setString("discount_id", $discountarticle_id[$i]);
						$articleObj->Save();
						unset($articleObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($article_id[$i]), sess_getAccountIdFromSession());
					$articles[] = db_getFromDB("article", $by_key, $by_value, "1", "title", "array", SELECTED_DOMAIN_ID);
				}
			}
		}

		if ($articles) {

			$articleLevelObj = new ArticleLevel();

			foreach($articles as $each_article){

				if ($second_step) {
					$auxArticleObj = new Article($each_article["id"]);
					$each_article["renewal_date"] = $auxArticleObj->getNextRenewalDate(1, ($_SESSION["order_renewal_period_article_{$each_article["id"]}"] == "yearly" ? "Y" : "M"));
					unset($auxArticleObj);
				}

				// setting some of the bill information
				$bill_info["articles"]["{$each_article["id"]}"]["title"]        = htmlspecialchars($each_article["title"]);
				$bill_info["articles"]["{$each_article["id"]}"]["level"]        = $articleLevelObj->getLevel($each_article["level"]);
				$bill_info["articles"]["{$each_article["id"]}"]["level_number"] = $each_article["level"];
				$bill_info["articles"]["{$each_article["id"]}"]["renewal_date"] = $each_article["renewal_date"];
				$bill_info["articles"]["{$each_article["id"]}"]["discount_id"]  = $each_article["discount_id"];
				$bill_info["articles"]["{$each_article["id"]}"]["status"]       = $each_article["status"];

				// Need To Check Out
				$thisArticle = new Article($each_article["id"]);
				if ($thisArticle->needToCheckOut()) $bill_info["articles"]["{$each_article["id"]}"]["needtocheckout"] = "y";
				else $bill_info["articles"]["{$each_article["id"]}"]["needtocheckout"] = "n";
				unset($thisArticle);

				// Bill pricing
				$thisArticle = new Article($each_article["id"]);
				$bill_info["articles"]["{$each_article["id"]}"]["total_fee"] = $thisArticle->getPrice($_SESSION["order_renewal_period_article_{$each_article["id"]}"] ? $_SESSION["order_renewal_period_article_{$each_article["id"]}"] : $_SESSION["order_renewal_period"]);
				unset($thisArticle);

				if ($bill_info["articles"]["{$each_article["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["articles"]["{$each_article["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["articles"]["{$each_article["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["articles"]["{$each_article["id"]}"]["total_fee"];

				// Money format for article fees
				if($bill_info["articles"]["{$each_article["id"]}"]["total_fee"])
					$bill_info["articles"]["{$each_article["id"]}"]["total_fee"] = format_money($bill_info["articles"]["{$each_article["id"]}"]["total_fee"]);

			}

			// There is no article been payed.
			if (empty($bill_info["articles"])) unset($bill_info["articles"]);

		}



		/**
		* Custom Invoice bill information
		*******************************************************************************/

		if (CUSTOM_INVOICE_FEATURE == "on") {

			if (!$second_step) {

				$by_key = array("account_id", "paid", "sent");
				$by_value = array(sess_getAccountIdFromSession(), "''", "'y'");
				$customInvoices = db_getFromDB("custominvoice", $by_key, $by_value, "", "id DESC", "array", SELECTED_DOMAIN_ID);
			} else {

				if($custom_invoice_id){
					for($i=0; $i < count($custom_invoice_id); $i++){
						$customInvoiceObj = new CustomInvoice($custom_invoice_id[$i]);
						$by_key = array("id", "account_id");
						$by_value = array(db_formatNumber($custom_invoice_id[$i]), sess_getAccountIdFromSession());
						$customInvoices[] = db_getFromDB("custominvoice", $by_key, $by_value, "1", "id DESC", "array", SELECTED_DOMAIN_ID);
					}
				}
			}

			if ($customInvoices) {

				foreach($customInvoices as $each_custom_invoice){
					$customInvoiceObj = new CustomInvoice($each_custom_invoice["id"]);

					// setting some of the bill information
					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["id"]     = $each_custom_invoice["id"];

					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["subtotal"] = $customInvoiceObj->getNumber("subtotal");
					if ($payment_tax_status == "on") $bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["tax"] = $payment_tax_value;
					else $bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["tax"] = 0;

					if ($payment_tax_status == "on") $bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"] = payment_calculateTax($customInvoiceObj->getPrice(), $payment_tax_value, true, true);
					else $bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"] = $customInvoiceObj->getPrice();
					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["title"]  = htmlspecialchars($each_custom_invoice["title"]);
					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["date"]   = $each_custom_invoice["date"];

					// Setting total bill
					if($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"]) {
						$bill_info["total_bill"] += $bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["subtotal"];
					}

					// Money format for custom invoice ammount
					if($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"])
							$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"] = format_money($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"]);

					// There is not custom invoice being payed.
					if(empty($bill_info["custominvoices"])) unset($bill_info["custominvoices"]);

					if ($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"] <= 0) {
						unset($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]);
						continue;
					}

				}

			}
		}
		if ($aux_package_total)
			$bill_info["total_bill"] += $aux_package_total;
		// Money format for total bill
		$bill_info["total_bill"] = format_money($bill_info["total_bill"]);

		////////////////////////////////////////////////////////////////////////

		if ($payment_tax_status == "on") $bill_info["tax_amount"] = $payment_tax_value;
		else $bill_info["tax_amount"] = 0;
		if ($payment_tax_status == "on") $bill_info["amount"] = payment_calculateTax(str_replace(",","",$bill_info["total_bill"]), $payment_tax_value, false);
		else $bill_info["amount"] = str_replace(",","",$bill_info["total_bill"]);

		// INVOICE /////////////////////////////////////////////////////////////
		if ($second_step) {

			if (($payment_method == "invoice") && ($bill_info["total_bill"] > 0)) {

				if (($bill_info["listings"]) || ($bill_info["events"]) || ($bill_info["banners"]) || ($bill_info["classifieds"]) || ($bill_info["articles"]) || ($bill_info["custominvoices"])) {

					$invoiceStatusObj = new InvoiceStatus();
					$accountObj       = new Account($acctId);

					$arr_invoice["account_id"]		= $acctId;
					$arr_invoice["username"]		= $accountObj->getString("username");
					$arr_invoice["ip"]				= $_SERVER["REMOTE_ADDR"];
					$arr_invoice["date"]			= date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
					$arr_invoice["status"]			= $invoiceStatusObj->getDefault();
					// TAX AMOUNT
					if ($payment_tax_status == "on")
						$arr_invoice["tax_amount"]  = $payment_tax_value;
					else
						$arr_invoice["tax_amount"]  = 0;

					// SUBTOTAL AMOUNT
					$arr_invoice["subtotal_amount"] = str_replace(",","",$bill_info["total_bill"]);

					// TOTAL AMOUNT
					if ($payment_tax_status == "on")
						$arr_invoice["amount"]		= payment_calculateTax(str_replace(",","",$bill_info["total_bill"]), $payment_tax_value, false);
					else
						$arr_invoice["amount"]		= str_replace(",","",$bill_info["total_bill"]);

					$arr_invoice["currency"]		= INVOICEPAYMENT_CURRENCY;
					$arr_invoice["expire_date"]		= date("Y-m-d",mktime(0,0,0,date("m")+1,date("d"),date("Y")));

					$invoiceObj = new Invoice($arr_invoice);
					$invoiceObj->Save();

					$bill_info["invoice_number"] = $invoiceObj->getString("id");

					if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {

						$listingObj = new Listing($id);
                        $levelObj = new ListingLevel();

						$db = db_getDBObject(DEFAULT_DB, true);
						$dbObjCat = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);

						$category_amount = 0;

						$sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$listingObj->getString("id")."";
						$result = $dbObjCat->query($sql);
						if(mysql_num_rows($result)){
							while($row = mysql_fetch_assoc($result)){
								$category_amount++;
							}

						}

						$arr_invoice_listing["invoice_id"]    = $invoiceObj->getString("id");
						$arr_invoice_listing["listing_id"]    = $id;
						$arr_invoice_listing["listing_title"] = $listingObj->getString("title", false);
						$arr_invoice_listing["discount_id"]   = $listingObj->getString("discount_id");
                        $arr_invoice_listing["level"]         = $listingObj->getString("level");
						$arr_invoice_listing["level_label"]   = $levelObj->showLevel($listingObj->getString("level"));
						$arr_invoice_listing["renewal_date"]  = $listingObj->getString("renewal_date");
						$arr_invoice_listing["categories"]    = ($category_amount) ? $category_amount : 0;
						$arr_invoice_listing["amount"]        = str_replace(",","",$info["total_fee"]);

						$arr_invoice_listing["extra_categories"] = 0;
						if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
							$arr_invoice_listing["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
						} else {
							$arr_invoice_listing["extra_categories"] = 0;
						}

						$arr_invoice_listing["listingtemplate_title"] = "";
						if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
							if ($listingObj->getString("listingtemplate_id")) {
								$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
								$arr_invoice_listing["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
							}
						}
						$arr_invoice_listing["renewal_period"] = ($_SESSION["order_renewal_period_listing_{$id}"] ? $_SESSION["order_renewal_period_listing_{$id}"] : $_SESSION["order_renewal_period"]);

						$invoiceListingObj = new InvoiceListing($arr_invoice_listing);
						$invoiceListingObj->Save();

						unset($listingObj);
						unset($invoiceListingObj);

					}

					if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {

						$eventObj = new Event($id);
                        $levelObj = new EventLevel(true);

						$arr_invoice_event["invoice_id"]   = $invoiceObj->getString("id");
						$arr_invoice_event["event_id"]     = $id;
						$arr_invoice_event["event_title"]  = $eventObj->getString("title",false);
						$arr_invoice_event["discount_id"]  = $eventObj->getString("discount_id");
                        $arr_invoice_event["level"]        = $eventObj->getString("level");
						$arr_invoice_event["level_label"]  = $levelObj->showLevel($eventObj->getString("level"));
						$arr_invoice_event["renewal_date"] = $eventObj->getString("renewal_date");
						$arr_invoice_event["amount"]       = str_replace(",","",$info["total_fee"]);
						$arr_invoice_event["renewal_period"] = ($_SESSION["order_renewal_period_event_{$id}"] ? $_SESSION["order_renewal_period_event_{$id}"] : $_SESSION["order_renewal_period"]);

						$invoiceEventObj = new InvoiceEvent($arr_invoice_event);
						$invoiceEventObj->Save();

						unset($eventObj);
						unset($invoiceEventObj);

					}

					if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {

						$bannerObj = new Banner($id);
                        $levelObj = new BannerLevel(true);

						$arr_invoice_banner["invoice_id"]     = $invoiceObj->getString("id");
						$arr_invoice_banner["banner_id"]      = $id;
						$arr_invoice_banner["banner_caption"] = $bannerObj->getString("caption",false);
						$arr_invoice_banner["discount_id"]    = $bannerObj->getString("discount_id");
                        $arr_invoice_banner["level"]          = $bannerObj->getString("type");
						$arr_invoice_banner["level_label"]    = $levelObj->showLevel($bannerObj->getString("type"));
						$arr_invoice_banner["renewal_date"]   = $bannerObj->getString("renewal_date");
						$arr_invoice_banner["impressions"]    = $bannerObj->getString("unpaid_impressions");
						$arr_invoice_banner["amount"]         = str_replace(",","",$info["total_fee"]);
						$arr_invoice_banner["renewal_period"] = ($_SESSION["order_renewal_period_banner_{$id}"] ? $_SESSION["order_renewal_period_banner_{$id}"] : $_SESSION["order_renewal_period"]);

						$invoiceBannerObj = new InvoiceBanner($arr_invoice_banner);
						$invoiceBannerObj->Save();

						unset($bannerObj);
						unset($invoiceBannerObj);

					}

					if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {

						$classifiedObj = new Classified($id);
                        $levelObj = new ClassifiedLevel(true);

						$arr_invoice_classified["invoice_id"]       = $invoiceObj->getString("id");
						$arr_invoice_classified["classified_id"]    = $id;
						$arr_invoice_classified["classified_title"] = $classifiedObj->getString("title",false);
						$arr_invoice_classified["discount_id"]      = $classifiedObj->getString("discount_id");
                        $arr_invoice_classified["level"]            = $classifiedObj->getString("level");
						$arr_invoice_classified["level_label"]      = $levelObj->showLevel($classifiedObj->getString("level"));
						$arr_invoice_classified["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$arr_invoice_classified["amount"]           = str_replace(",","",$info["total_fee"]);
						$arr_invoice_classified["renewal_period"] = ($_SESSION["order_renewal_period_classified_{$id}"] ? $_SESSION["order_renewal_period_classified_{$id}"] : $_SESSION["order_renewal_period"]);

						$invoiceClassifiedObj = new InvoiceClassified($arr_invoice_classified);
						$invoiceClassifiedObj->Save();

						unset($classifiedObj);
						unset($invoiceClassifiedObj);

					}

					if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {

						$articleObj = new Article($id);
                        $levelObj = new ArticleLevel(true);

						$arr_invoice_article["invoice_id"]    = $invoiceObj->getString("id");
						$arr_invoice_article["article_id"]    = $id;
						$arr_invoice_article["article_title"] = $articleObj->getString("title",false);
						$arr_invoice_article["discount_id"]   = $articleObj->getString("discount_id");
                        $arr_invoice_article["level"]         = $articleObj->getString("level");
						$arr_invoice_article["level_label"]   = $levelObj->showLevel($articleObj->getString("level"));
						$arr_invoice_article["renewal_date"]  = $articleObj->getString("renewal_date");
						$arr_invoice_article["amount"]        = str_replace(",","",$info["total_fee"]);
						$arr_invoice_article["renewal_period"] = ($_SESSION["order_renewal_period_article_{$id}"] ? $_SESSION["order_renewal_period_article_{$id}"] : $_SESSION["order_renewal_period"]);

						$invoiceArticleObj = new InvoiceArticle($arr_invoice_article);
						$invoiceArticleObj->Save();

						unset($articleObj);
						unset($invoiceArticleObj);

					}

					if ($bill_info["custominvoices"]) foreach ($bill_info["custominvoices"] as $id => $info) {

						$customInvoiceObj = new CustomInvoice($id);

						$arr_invoice_custominvoice["invoice_id"]        = $invoiceObj->getString("id");
						$arr_invoice_custominvoice["custom_invoice_id"] = $id;
						$arr_invoice_custominvoice["title"]             = $customInvoiceObj->getString("title");
						$arr_invoice_custominvoice["date"]              = $customInvoiceObj->getString("date");
						$arr_invoice_custominvoice["items"]             = $customInvoiceObj->getTextItems();
						$arr_invoice_custominvoice["items_price"]       = $customInvoiceObj->getTextPrices();
						$arr_invoice_custominvoice["subtotal"]          = str_replace(",","",$info["subtotal"]);
						$arr_invoice_custominvoice["tax"]				= str_replace(",","",$info["tax"]);
						$arr_invoice_custominvoice["amount"]            = str_replace(",","",$info["amount"]);

						$invoiceCustomInvoiceObj = new InvoiceCustomInvoice($arr_invoice_custominvoice);
						$invoiceCustomInvoiceObj->Save();

						unset($customInvoiceObj);
						unset($invoiceCustomInvoiceObj);

					}

					if ($ispackage == "true" && $auxitem_name) {

						$arr_invoice_packageinvoice["invoice_id"]        = $invoiceObj->getString("id");
						$arr_invoice_packageinvoice["package_id"]		 = $package_id;
						$arr_invoice_packageinvoice["package_title"]     = $packageObj->getString("title");
						$arr_invoice_packageinvoice["items"]             = $item_name." ".$item_levelName."\n".str_replace("-","",$auxdomains_names);
						$arr_invoice_packageinvoice["items_price"]       = str_replace(CURRENCY_SYMBOL." ", "",str_replace("<br />","\n",$aux_package_item_price));
						$arr_invoice_packageinvoice["subtotal"]          = $aux_package_total;
						$arr_invoice_packageinvoice["tax"]				 = $payment_tax_value;
						$arr_invoice_packageinvoice["amount"]            = payment_calculateTax(str_replace(",","",$aux_package_total), $payment_tax_value, false);
						$arr_invoice_packageinvoice["renewal_period"]    = $_SESSION["order_renewal_period"];

						$invoicePackageObj = new InvoicePackage($arr_invoice_packageinvoice);
						$invoicePackageObj->Save();

						unset($packageObj);
						unset($invoicePackageObj);

					}

				}

			}

		}

	}
