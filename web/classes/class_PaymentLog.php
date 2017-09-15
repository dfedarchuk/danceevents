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
	# * FILE: /classes/class_PaymentLog.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$paymentLogObj = new PaymentLog($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name PaymentLog
	 * @access Public
	 */

	class PaymentLog extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $account_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $username;
		/**
		 * @var string
		 * @access Private
		 */
		var $ip;
		/**
		 * @var string
		 * @access Private
		 */
		var $transaction_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $transaction_status;
		/**
		 * @var date
		 * @access Private
		 */
		var $transaction_datetime;
		/**
		 * @var integer
		 * @access Private
		 */
		var $transaction_tax;
		/**
		 * @var real
		 * @access Private
		 */
		var $transaction_subtotal;
		/**
		 * @var real
		 * @access Private
		 */
		var $transaction_amount;
		/**
		 * @var string
		 * @access Private
		 */
		var $transaction_currency;
		/**
		 * @var string
		 * @access Private
		 */
		var $system_type;
		/**
		 * @var char
		 * @access Private
		 */
		var $recurring;
		/**
		 * @var string
		 * @access Private
		 */
		var $notes;
		/**
		 * @var string
		 * @access Private
		 */
		var $return_fields;

		/**
		 * <code>
		 *		$paymentLogObj = new PaymentLog($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name PaymentLog
		 * @access Public
		 * @param integer $var
		 */
		function PaymentLog($var="", $domain_id = false) {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
					$this->domain_id = $domain_id;
				} else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Payment_Log WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));

				$this->old_account_id = $row["account_id"];

				$this->makeFromRow($row);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}
		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row="") {

			$this->id					= ($row["id"])						? $row["id"]					: ($this->id					? $this->id						: 0);
			$this->account_id			= ($row["account_id"])				? $row["account_id"]			: ($this->account_id			? $this->account_id				: 0);
			$this->username				= ($row["username"])				? $row["username"]				: ($this->username				? $this->username				: "");
			$this->ip					= ($row["ip"])						? $row["ip"]					: ($this->ip					? $this->ip						: "");
			$this->transaction_id		= ($row["transaction_id"])			? $row["transaction_id"]		: ($this->transaction_id		? $this->transaction_id			: "");
			$this->transaction_status	= ($row["transaction_status"])		? $row["transaction_status"]	: ($this->transaction_status	? $this->transaction_status		: "");
			$this->transaction_datetime	= ($row["transaction_datetime"])	? $row["transaction_datetime"]	: ($this->transaction_datetime	? $this->transaction_datetime	: "");
			$this->transaction_tax		= ($row["transaction_tax"])			? $row["transaction_tax"]		: ($this->transaction_tax		? $this->transaction_tax		: 0);
			$this->transaction_subtotal	= ($row["transaction_subtotal"])	? $row["transaction_subtotal"]	: ($this->transaction_subtotal	? $this->transaction_subtotal	: 0);
			$this->transaction_amount	= ($row["transaction_amount"])		? $row["transaction_amount"]	: ($this->transaction_amount	? $this->transaction_amount		: 0);
			$this->transaction_currency	= ($row["transaction_currency"])	? $row["transaction_currency"]	: ($this->transaction_currency	? $this->transaction_currency	: "");
			$this->system_type			= ($row["system_type"])				? $row["system_type"]			: ($this->system_type			? $this->system_type			: "");
			$this->recurring			= ($row["recurring"])				? $row["recurring"]				: ($this->recurring				? $this->recurring				: "");
			$this->notes				= ($row["notes"])					? $row["notes"]					: ($this->notes					? $this->notes					: "");
			$this->return_fields		= ($row["return_fields"])			? $row["return_fields"]			: ($this->return_fields			? $this->return_fields			: "");

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$paymentLogObj->Save();
		 * <br /><br />
		 *		//Using this in PaymentLog() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save($domain_id = false) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id){
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else if ($this->domain_id) {
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			$this->PrepareToSave();

			$aux_old_account = str_replace("'", "", $this->old_account_id);
			$aux_account = str_replace("'", "", $this->account_id);

			unset($dbMain);

			if ($this->id) {

				$sql = "UPDATE Payment_Log SET"
					. " account_id           = $this->account_id,"
					. " username             = $this->username,"
					. " ip                   = $this->ip,"
					. " transaction_id       = $this->transaction_id,"
					. " transaction_status   = $this->transaction_status,"
					. " transaction_datetime = $this->transaction_datetime,"
					. " transaction_tax		 = $this->transaction_tax,"
					. " transaction_subtotal = $this->transaction_subtotal,"
					. " transaction_amount   = $this->transaction_amount,"
					. " transaction_currency = $this->transaction_currency,"
					. " system_type          = $this->system_type,"
					. " recurring            = $this->recurring,"
					. " notes                = $this->notes,"
					. " return_fields        = $this->return_fields"
					. " WHERE id = $this->id";

				$dbObj->query($sql);

				if ($aux_old_account != $aux_account && $aux_account != 0) {
					$accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($aux_account, $this);
				}

			} else {

				$sql = "INSERT INTO Payment_Log"
					. " ("
					. " account_id,"
					. " username,"
					. " ip,"
					. " transaction_id,"
					. " transaction_status,"
					. " transaction_datetime,"
					. " transaction_tax,"
					. " transaction_subtotal,"
					. " transaction_amount,"
					. " transaction_currency,"
					. " system_type,"
					. " recurring,"
					. " notes,"
					. " return_fields"
					. " )"
					. " VALUES"
					. " ("
					. " $this->account_id,"
					. " $this->username,"
					. " $this->ip,"
					. " $this->transaction_id,"
					. " $this->transaction_status,"
					. " $this->transaction_datetime,"
					. " $this->transaction_tax,"
					. " $this->transaction_subtotal,"
					. " $this->transaction_amount,"
					. " $this->transaction_currency,"
					. " $this->system_type,"
					. " $this->recurring,"
					. " $this->notes,"
					. " $this->return_fields"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

                $rowTimeline = array();
                $rowTimeline["item_type"] = "transaction";
                $rowTimeline["action"] = "new";
                $rowTimeline["item_id"] = $this->id;
                $timelineObj = new Timeline($rowTimeline);
                $timelineObj->save();

				if ($domain_id){
					$dashboard_domain_id = $domain_id;
				} else {
					$dashboard_domain_id = SELECTED_DOMAIN_ID;
				}

				if ($aux_account != 0) {
					$accDomain = new Account_Domain($aux_account, defined("SELECTED_DOMAIN_ID") ? SELECTED_DOMAIN_ID : $domain_id);
					$accDomain->Save();
					$accDomain->saveOnDomain($aux_account, $this);
				}

			}

			$this->PrepareToUse();

		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$paymentLogObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
		function Delete(){
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $sql = "UPDATE Payment_Log SET hidden = 'y' WHERE id = ".$this->id;
            $dbObj->query($sql);

            ### Timeline
            $sql = "DELETE FROM Timeline WHERE item_type = 'transaction' AND item_id = $this->id";
            $dbObj->query($sql);
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$paymentLogObj->sendNotification();
		 * <br /><br />
		 *		//Using this in PaymentLog() class.
		 *		$this->sendNotification();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getTimeString
		 * @access Public
		 */
		function sendNotification($domain_id = false, $package_id = false) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id){
				$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				$domain = new Domain($domain_id);
			} else if ($this->domain_id){
				$db = db_getDBObjectByDomainID($this->domain_id, $dbMain);
				$domain = new Domain($this->domain_id);
			} else	if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$domain = new Domain(SELECTED_DOMAIN_ID);
			} else {
				$db = db_getDBObject();
			}
			unset($dbMain);

			$domain_url = DEFAULT_URL;
			if ($domain_id || $this->domain_id){
				$domain_url = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $domain_url);
            }

			$sitemgrmsgstatus = $this->transaction_status;

			$header_sitemgr_msg = "
				<html>
					<head>
						<style>
							.BODY,DIV,TABLE,TD {
								font-size: 11px;
								font-family: Verdana, Arial, Sans-Serif;
								color: #000;
							}
							.TABLE,TD {
								border: 1px #2967A3 solid;
							}
						</style>
					</head>\n
					<body>
						<div>
							".system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />"."
							<br />\n<br />\n
							".system_showText(LANG_NOTIFY_TRANSACTION_1)."
							<br />\n<br />\n
				";

			$body_sitemgr_msg = "";
			$body_sitemgr_msg .= "
							<b style=\"color:#2967A3\">".system_showText(LANG_NOTIFY_TRANSACTION_2)."</b>
							<br />\n<br />\n
							<b>".system_ShowText(LANG_LABEL_STATUS).":</b> <b style=\"color:#003365\">".$sitemgrmsgstatus."</b>
							<br />\n
							<b>".system_ShowText(LANG_LABEL_ACCOUNT).":</b> ".system_showAccountUserName($this->username)."
							<br />\n
							<b>".system_ShowText(LANG_LABEL_TRANSACTION_ID).":</b> ".$this->transaction_id."
							<br />\n
							<b>".system_ShowText(LANG_NOTIFY_TRANSACTION_3).":</b> ".format_date($this->transaction_datetime, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($this->transaction_datetime)."
							<br />\n
							<b>IP:</b> ".$this->ip."
							<br />\n
							<b>".system_ShowText(LANG_SUBTOTALAMOUNT).":</b> ".$this->transaction_subtotal." (".$this->transaction_currency.")
							<br />\n
							<b>".system_ShowText(LANG_TAXAMOUNT).":</b> ".payment_calculateTax($this->transaction_subtotal,$this->transaction_tax,true,false)." (".$this->transaction_currency.")
							<br />\n
							<b>".system_ShowText(LANG_TOTALPRICEAMOUNT).":</b> ".$this->transaction_amount." (".$this->transaction_currency.")
							<br />\n
							<b>".system_ShowText(LANG_NOTIFY_TRANSACTION_4).":</b> ".ucfirst($this->system_type)."
				";
			if ($this->recurring == "y") {
				$body_sitemgr_msg .= "
							<em>".system_ShowText(LANG_NOTIFY_TRANSACTION_5)."</em>
					";
			}
			$body_sitemgr_msg .= "
							<br />\n
				";

			$sql ="SELECT * FROM Payment_Listing_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $listings[] = $row;

			if (!empty($listings[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".string_ucwords(LISTING_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>".system_showText(LANG_LABEL_TITLE)."</b></td>
									<td><b>".system_showText(LANG_LABEL_EXTRA_CATEGORY)."</b></td>
									<td><b>".system_showText(LANG_LABEL_LEVEL)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_RENEWAL_DATE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_AMOUNT)." (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$listingLevelObj = new ListingLevel();

				foreach ($listings as $each_listing) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_listing["listing_title"]."".($each_listing["listingtemplate_title"]?"<br>(".$each_listing["listingtemplate_title"].")":"")."</td>
									<td>".$each_listing["extra_categories"]."</td>
									<td>".string_ucwords($listingLevelObj->getLevel($each_listing["level"]))."</td>
									<td>".(($each_listing["discount_id"]) ? $each_listing["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_listing["renewal_date"], DEFAULT_DATE_FORMAT, "date"))."</td>
									<td>".$each_listing["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/listing.php?id=".$each_listing["listing_id"]."\" target=\"_blank\">".string_ucwords(LISTING_FEATURE_NAME).": ".$each_listing["listing_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Event_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $events[] = $row;

			if (!empty($events[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".string_ucwords(EVENT_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>".system_showText(LANG_LABEL_TITLE)."</b></td>
									<td><b>".system_showText(LANG_LABEL_LEVEL)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_RENEWAL_DATE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_AMOUNT)." (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$eventLevelObj = new EventLevel();

				foreach ($events as $each_event) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_event["event_title"]."</td>
									<td>".string_ucwords($eventLevelObj->getLevel($each_event["level"]))."</td>
									<td>".(($each_event["discount_id"]) ? $each_event["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_event["renewal_date"], DEFAULT_DATE_FORMAT, "date"))."</td>
									<td>".$each_event["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/event.php?id=".$each_event["event_id"]."\" target=\"_blank\">".string_ucwords(EVENT_FEATURE_NAME).": ".$each_event["event_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Banner_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $banners[] = $row;

			if (!empty($banners[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".string_ucwords(BANNER_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>".system_showText(LANG_LABEL_CAPTION)."</b></td>
									<td><b>".system_showText(LANG_IMPRESSIONS)."</b></td>
									<td><b>".system_showText(LANG_LABEL_LEVEL)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_RENEWAL_DATE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_AMOUNT)." (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$bannerLevelObj = new BannerLevel();

				foreach ($banners as $each_banner) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_banner["banner_caption"]."</td>
									<td>".(($each_banner["impressions"]) ? ($each_banner["impressions"]) : ("Unlimited"))."</td>
									<td>".string_ucwords($bannerLevelObj->getLevel($each_banner["level"]))."</td>
									<td>".(($each_banner["discount_id"]) ? $each_banner["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(($each_banner["renewal_date"] != "0000-00-00") ? format_date($each_banner["renewal_date"], DEFAULT_DATE_FORMAT, "date") : "Unlimited")."</td>
									<td>".$each_banner["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".BANNER_FEATURE_FOLDER."/banner.php?id=".$each_banner["banner_id"]."\" target=\"_blank\">".string_ucwords(BANNER_FEATURE_NAME).": ".$each_banner["banner_caption"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Classified_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $classifieds[] = $row;

			if (!empty($classifieds[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".string_ucwords(CLASSIFIED_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>".system_showText(LANG_LABEL_TITLE)."</b></td>
									<td><b>".system_showText(LANG_LABEL_LEVEL)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_RENEWAL_DATE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_AMOUNT)." (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$classifiedLevelObj = new ClassifiedLevel();

				foreach ($classifieds as $each_classified) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_classified["classified_title"]."</td>
									<td>".string_ucwords($classifiedLevelObj->getLevel($each_classified["level"]))."</td>
									<td>".(($each_classified["discount_id"]) ? $each_classified["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_classified["renewal_date"], DEFAULT_DATE_FORMAT, "datetime"))."</td>
									<td>".$each_classified["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$each_classified["classified_id"]."\" target=\"_blank\">".string_ucwords(CLASSIFIED_FEATURE_NAME).": ".$each_classified["classified_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Article_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $articles[] = $row;

			if (!empty($articles[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".string_ucwords(ARTICLE_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>".system_showText(LANG_LABEL_TITLE)."</b></td>
									<td><b>".system_showText(LANG_LABEL_LEVEL)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_RENEWAL_DATE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_AMOUNT)." (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$articleLevelObj = new ArticleLevel();

				foreach ($articles as $each_article) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_article["article_title"]."</td>
									<td>".string_ucwords($articleLevelObj->getLevel($each_article["level"]))."</td>
									<td>".(($each_article["discount_id"]) ? $each_article["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_article["renewal_date"], DEFAULT_DATE_FORMAT, "date"))."</td>
									<td>".$each_article["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$each_article["article_id"]."\" target=\"_blank\">".string_ucwords(ARTICLE_FEATURE_NAME).": ".$each_article["article_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_CustomInvoice_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $custominvoices[] = $row;

			if (!empty($custominvoices[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">Custom Invoice(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>".system_showText(LANG_LABEL_TITLE)."</b></td>
									<td><b>".system_showText(LANG_LABEL_ITEMS)."</b></td>
									<td><b>".system_showText(LANG_LABEL_DATE)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_AMOUNT)." (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				foreach ($custominvoices as $each_custominvoice) {

					$custom_invoice_items = explode("\n", $each_custominvoice["items"]);
					$custom_invoice_prices = explode("\n", $each_custominvoice["items_price"]);
					if ($custom_invoice_items) {
						for ($i=0; $i<count($custom_invoice_items); $i++) {
							$custom_invoice_desc[] = $custom_invoice_items[$i]." - ".$custom_invoice_prices[$i];
						}
					}
					$customInvoiceItems = ($custom_invoice_desc) ? implode("<br />\n", $custom_invoice_desc) : "";

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_custominvoice["title"]."</td>
									<td>".$customInvoiceItems."</td>
									<td>".format_date($each_custominvoice["date"])."</td>
									<td>".$each_custominvoice["amount"]."</td>
								</tr>\n
						";

					unset($custom_invoice_items, $custom_invoice_prices, $custom_invoice_desc, $customInvoiceItems);

					$sitemgr_link[] = "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/activity/custominvoices/index.php?search_id=".$each_custominvoice["custom_invoice_id"]."\" target=\"_blank\">Custom Invoice: ".$each_custominvoice["title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

            $sql ="SELECT * FROM Payment_Package_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $packages[] = $row;

			if (!empty($packages[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">Package Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>".system_showText(LANG_LABEL_TITLE)."</b></td>
									<td><b>".system_showText(LANG_LABEL_ITEMS)."</b></td>
									<td><b>".string_ucwords(LANG_LABEL_AMOUNT)." (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				foreach ($packages as $each_package) {

					$package_items = explode("\n", $each_package["items"]);
					$package_prices = explode("\n", $each_package["items_price"]);
					if ($package_items) {
						for ($i=0; $i<count($package_items); $i++) {
							$package_desc[] = $package_items[$i];
						}
					}
					$packageItems = ($package_desc) ? implode("<br />\n", $package_desc) : "";

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_package["package_title"]."</td>
									<td>".$packageItems."</td>
									<td>".$each_package["amount"]."</td>
								</tr>\n
						";

					unset($package_items, $package_prices, $package_desc, $packageItems);

					$sitemgr_link[] = "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/promote/promotions/package.php?id=".$each_package["package_id"]."\" target=\"_blank\">Package: ".$each_package["package_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$footer_sitemgr_msg = "
							<br />\n<br />\n
							".system_showText(LANG_NOTIFY_TRANSACTION_6)."
							<br />\n
				";

			if ($sitemgr_link) foreach ($sitemgr_link as $sitemgrLink) $footer_sitemgr_msg .= $sitemgrLink."\n";

			$footer_sitemgr_msg .= "
							<br />\n<br />\n
							".EDIRECTORY_TITLE."
						</div>
					</body>
				</html>
				";

			$sitemgr_msg = $header_sitemgr_msg.$body_sitemgr_msg.$footer_sitemgr_msg;

			setting_get("sitemgr_payment_email",$sitemgr_payment_email);
			$sitemgr_payment_emails = explode(",",$sitemgr_payment_email);

			$error = false;
            $emailSubject = system_showText(LANG_NOTIFY_TRANSACTION)." - ".$this->transaction_id;
            if ($this->transaction_id) {
                system_notifySitemgr($sitemgr_payment_emails, $emailSubject, $sitemgr_msg, false);
            }

		}
	}

?>
