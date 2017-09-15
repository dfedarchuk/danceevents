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
	# * FILE: /classes/class_claim.php
	# ----------------------------------------------------------------------------------------------------

	class Claim extends Handle {

		var $id;
		var $account_id;
		var $username;
		var $listing_id;
		var $listing_title;
		var $date_time;
		var $step;
		var $status;
		var $old_location_1;
		var $new_location_1;
		var $old_location_2;
		var $new_location_2;
		var $old_location_3;
		var $new_location_3;
		var $old_location_4;
		var $new_location_4;
		var $old_location_5;
		var $new_location_5;
		var $old_title;
		var $new_title;
		var $old_friendly_url;
		var $new_friendly_url;
		var $old_email;
		var $new_email;
		var $old_url;
		var $new_url;
		var $old_phone;
		var $new_phone;
		var $old_fax;
		var $new_fax;
		var $old_address;
		var $new_address;
		var $old_address2;
		var $new_address2;
		var $old_zip_code;
		var $new_zip_code;
		var $old_level;
		var $new_level;
		var $old_listingtemplate_id;
		var $new_listingtemplate_id;

		function Claim($var="") {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Claim WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->id						= ($row["id"])						? $row["id"]						: ($this->id						? $this->id						: 0);
			$this->account_id				= ($row["account_id"])				? $row["account_id"]				: ($this->account_id				? $this->account_id				: 0);
			$this->username					= ($row["username"])				? $row["username"]					: ($this->username					? $this->username				: "");
			$this->listing_id				= ($row["listing_id"])				? $row["listing_id"]				: ($this->listing_id				? $this->listing_id				: 0);
			$this->listing_title			= ($row["listing_title"])			? $row["listing_title"]				: ($this->listing_title				? $this->listing_title			: "");
			$this->date_time				= ($row["date_time"])				? $row["date_time"]					: "";
			$this->step						= ($row["step"])					? $row["step"]						: "";
			$this->status					= ($row["status"])					? $row["status"]					: "";
			$this->old_location_1			= ($row["old_location_1"])			? $row["old_location_1"]			: ($this->old_location_1			? $this->old_location_1			: 0);
			$this->new_location_1			= ($row["new_location_1"])			? $row["new_location_1"]			: 0;
			$this->old_location_2			= ($row["old_location_2"])			? $row["old_location_2"]			: ($this->old_location_2			? $this->old_location_2			: 0);
			$this->new_location_2			= ($row["new_location_2"])			? $row["new_location_2"]			: 0;
			$this->old_location_3			= ($row["old_location_3"])			? $row["old_location_3"]			: ($this->old_location_3			? $this->old_location_3			: 0);
			$this->new_location_3			= ($row["new_location_3"])			? $row["new_location_3"]			: 0;
			$this->old_location_4			= ($row["old_location_4"])			? $row["old_location_4"]			: ($this->old_location_4			? $this->old_location_4			: 0);
			$this->new_location_4			= ($row["new_location_4"])			? $row["new_location_4"]			: 0;
			$this->old_location_5			= ($row["old_location_5"])			? $row["old_location_5"]			: ($this->old_location_5			? $this->old_location_5			: 0);
			$this->new_location_5			= ($row["new_location_5"])			? $row["new_location_5"]			: 0;
			$this->old_title				= ($row["old_title"])				? $row["old_title"]					: ($this->old_title					? $this->old_title				: "");
			$this->new_title				= ($row["new_title"])				? $row["new_title"]					: "";
			$this->old_friendly_url			= ($row["old_friendly_url"])		? $row["old_friendly_url"]			: ($this->old_friendly_url			? $this->old_friendly_url		: "");
			$this->new_friendly_url			= ($row["new_friendly_url"])		? $row["new_friendly_url"]			: "";
			$this->old_email				= ($row["old_email"])				? $row["old_email"]					: ($this->old_email					? $this->old_email				: "");
			$this->new_email				= ($row["new_email"])				? $row["new_email"]					: "";
			$this->old_url					= ($row["old_url"])					? $row["old_url"]					: ($this->old_url					? $this->old_url				: "");
			$this->new_url					= ($row["new_url"])					? $row["new_url"]					: "";
			$this->old_phone				= ($row["old_phone"])				? $row["old_phone"]					: ($this->old_phone					? $this->old_phone				: "");
			$this->new_phone				= ($row["new_phone"])				? $row["new_phone"]					: "";
			$this->old_fax					= ($row["old_fax"])					? $row["old_fax"]					: ($this->old_fax					? $this->old_fax				: "");
			$this->new_fax					= ($row["new_fax"])					? $row["new_fax"]					: "";
			$this->old_address				= ($row["old_address"])				? $row["old_address"]				: ($this->old_address				? $this->old_address			: "");
			$this->new_address				= ($row["new_address"])				? $row["new_address"]				: "";
			$this->old_address2				= ($row["old_address2"])			? $row["old_address2"]				: ($this->old_address2				? $this->old_address2			: "");
			$this->new_address2				= ($row["new_address2"])			? $row["new_address2"]				: "";
			$this->old_zip_code				= ($row["old_zip_code"])			? $row["old_zip_code"]				: ($this->old_zip_code				? $this->old_zip_code			: "");
			$this->new_zip_code				= ($row["new_zip_code"])			? $row["new_zip_code"]				: "";
			$this->old_level				= ($row["old_level"])				? $row["old_level"]					: ($this->old_level					? $this->old_level				: 0);
			$this->new_level				= ($row["new_level"])				? $row["new_level"]					: 0;
			$this->old_listingtemplate_id	= ($row["old_listingtemplate_id"])	? $row["old_listingtemplate_id"]	: ($this->old_listingtemplate_id	? $this->old_listingtemplate_id	: 0);
			$this->new_listingtemplate_id	= ($row["new_listingtemplate_id"])	? $row["new_listingtemplate_id"]	: 0;

		}

		function Save() {

			$this->prepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);

			if ($this->id) {

				$sql = "UPDATE Claim SET"
					. " account_id             = $this->account_id,"
					. " username               = $this->username,"
					. " listing_id             = $this->listing_id,"
					. " listing_title          = $this->listing_title,"
					. " old_location_1         = $this->old_location_1,"
					. " new_location_1         = $this->new_location_1,"
					. " old_location_2         = $this->old_location_2,"
					. " new_location_2         = $this->new_location_2,"
					. " old_location_3         = $this->old_location_3,"
					. " new_location_3         = $this->new_location_3,"
					. " old_location_4         = $this->old_location_4,"
					. " new_location_4         = $this->new_location_4,"
					. " old_location_5         = $this->old_location_5,"
					. " new_location_5         = $this->new_location_5,"
					. " old_title              = $this->old_title,"
					. " new_title              = $this->new_title,"
					. " old_friendly_url       = $this->old_friendly_url,"
					. " new_friendly_url       = $this->new_friendly_url,"
					. " old_email              = $this->old_email,"
					. " new_email              = $this->new_email,"
					. " old_url                = $this->old_url,"
					. " new_url                = $this->new_url,"
					. " old_phone              = $this->old_phone,"
					. " new_phone              = $this->new_phone,"
					. " old_fax                = $this->old_fax,"
					. " new_fax                = $this->new_fax,"
					. " old_address            = $this->old_address,"
					. " new_address            = $this->new_address,"
					. " old_address2           = $this->old_address2,"
					. " new_address2           = $this->new_address2,"
					. " old_zip_code           = $this->old_zip_code,"
					. " new_zip_code           = $this->new_zip_code,"
					. " old_level              = $this->old_level,"
					. " new_level              = $this->new_level,"
					. " old_listingtemplate_id = $this->old_listingtemplate_id,"
					. " new_listingtemplate_id = $this->new_listingtemplate_id,"
					. " step                   = $this->step,"
					. " status                 = $this->status"
					. " WHERE id               = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Claim"
					. " (account_id,"
					. " username,"
					. " listing_id,"
					. " listing_title,"
					. " date_time,"
					. " old_location_1,"
					. " new_location_1,"
					. " old_location_2,"
					. " new_location_2,"
					. " old_location_3,"
					. " new_location_3,"
					. " old_location_4,"
					. " new_location_4,"
					. " old_location_5,"
					. " new_location_5,"
					. " old_title,"
					. " new_title,"
					. " old_friendly_url,"
					. " new_friendly_url,"
					. " old_email,"
					. " new_email,"
					. " old_url,"
					. " new_url,"
					. " old_phone,"
					. " new_phone,"
					. " old_fax,"
					. " new_fax,"
					. " old_address,"
					. " new_address,"
					. " old_address2,"
					. " new_address2,"
					. " old_zip_code,"
					. " new_zip_code,"
					. " old_level,"
					. " new_level,"
					. " old_listingtemplate_id,"
					. " new_listingtemplate_id,"
					. " step,"
					. " status)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->username,"
					. " $this->listing_id,"
					. " $this->listing_title,"
					. " NOW(),"
					. " $this->old_location_1,"
					. " $this->new_location_1,"
					. " $this->old_location_2,"
					. " $this->new_location_2,"
					. " $this->old_location_3,"
					. " $this->new_location_3,"
					. " $this->old_location_4,"
					. " $this->new_location_4,"
					. " $this->old_location_5,"
					. " $this->new_location_5,"
					. " $this->old_title,"
					. " $this->new_title,"
					. " $this->old_friendly_url,"
					. " $this->new_friendly_url,"
					. " $this->old_email,"
					. " $this->new_email,"
					. " $this->old_url,"
					. " $this->new_url,"
					. " $this->old_phone,"
					. " $this->new_phone,"
					. " $this->old_fax,"
					. " $this->new_fax,"
					. " $this->old_address,"
					. " $this->new_address,"
					. " $this->old_address2,"
					. " $this->new_address2,"
					. " $this->old_zip_code,"
					. " $this->new_zip_code,"
					. " $this->old_level,"
					. " $this->new_level,"
					. " $this->old_listingtemplate_id,"
					. " $this->new_listingtemplate_id,"
					. " $this->step,"
					. " $this->status)";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);
                
                $rowTimeline = array();
                $rowTimeline["item_type"] = "claim";
                $rowTimeline["action"] = "new";
                $rowTimeline["item_id"] = $this->id;
                $timelineObj = new Timeline($rowTimeline);
                $timelineObj->save();

			}

			$this->prepareToUse();

		}

		function Delete() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$sql = "DELETE FROM Claim WHERE id = $this->id";
			$dbObj->query($sql);
            
            ### Timeline
            $sql = "DELETE FROM Timeline WHERE item_type = 'claim' AND item_id = $this->id";
            $dbObj->query($sql);
		}

		function canApprove() {
			
			$array_date=explode("-",$this->date_time);
			$array_day=explode(" ",$array_date[2]);
			$dtini = mktime(0,0,0,$array_date[1],$array_day[0],$array_date[0]); // inicial day
			$dtend = mktime(0,0,0,date("m"),date("d"),date("Y")); // now

			$days = (-$dtini + $dtend) / (60*60*24);

			if (($this->status == "complete") && ($this->account_id) && ($this->listing_id)) return true;
			elseif (($this->status == "progress") && ($days>5)) return true;
			else return false;
		}

		function canDeny() {
			if ((($this->status == "progress") || ($this->status == "incomplete") || ($this->status == "complete")) && ($this->account_id) && ($this->listing_id)) return true;
			elseif (($this->status == "progress") && ($days>5)) return true;
			else false;
		}

	}

?>
