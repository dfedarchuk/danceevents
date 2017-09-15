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
	# * FILE: /functions/report_funct.php
	# ----------------------------------------------------------------------------------------------------
    /**
     * <Lucas Trentim (2015)>
     * @todo This seems to be used a LOT. But maybe it should be a static method of the specific Report class? No? okay... :(
     */
	function report_newRecord($item_name, $item_id, $report_type, $lote = false) {

        $robotsObj = new RobotsFilter();
        if ($robotsObj->getAccess($_SERVER["REMOTE_ADDR"])) {
			$dbObj = db_getDBObject();
			if ($lote){
				$array_ids = explode(",", $item_id);
				$str_update = "";
				foreach($array_ids as $item_id){
					$str_update .= "(".db_formatNumber($item_id).", ".db_formatNumber($report_type).", 1, NOW()),";
				}

				$str_update = string_substr($str_update, 0, -1);

				$sql = "INSERT INTO Report_".string_ucwords($item_name)." (".$item_name."_id, report_type, report_amount, date) VALUES $str_update ON DUPLICATE KEY UPDATE report_amount = report_amount + 1;";
				$dbObj->query($sql);


			} else {

				$sql = "UPDATE Report_".string_ucwords($item_name)." SET report_amount = report_amount + 1 WHERE ".$item_name."_id = ".db_formatNumber($item_id)." AND report_type = ".db_formatNumber($report_type)." AND DATE_FORMAT(date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')";
				$dbObj->query($sql);
				if (!mysql_affected_rows($dbObj->link_id)) {
					$sql = "INSERT INTO Report_".string_ucwords($item_name)." (".$item_name."_id, report_type, report_amount, date) VALUES (".db_formatNumber($item_id).", ".db_formatNumber($report_type).", 1, NOW())";
					$dbObj->query($sql);
				}
			}
        } else return false;
	}

    # ----------------------------------------------------------------------------------------------------
    # PERIOD REPORT
    # ----------------------------------------------------------------------------------------------------
    /**
     * <Lucas Trentim (2015)>
     * @todo This seems to be unused. So... Remove it maybe?
     */
    function reportPeriod($data = array()) {
        $keys = array_keys($data);
        list($year2, $month2) = explode('-', $keys[0]);
        list($year1, $month1) = explode('-', $keys[count($keys)-1]);
        return "<strong>" . system_showText(LANG_LABEL_FROM) . "</strong> " . system_showDate('F', mktime(0, 0, 0, $month1, 1, $year1)) . " / " . $year1 . " <strong> " .  system_showText(LANG_LABEL_DATE_TO) . " </strong> " .  system_showDate('F', mktime(0, 0, 0, $month2, 1, $year2)) . " / " . $year2;
    }

	# ----------------------------------------------------------------------------------------------------
	# LISTING REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveListingReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

		if ($idIn){

			/* empty */
			$period = date('Y') . '-' . date('n');
			$data[$period]['summary']		= 0;
			$data[$period]['detail']		= 0;
			$data[$period]['click']			= 0;
			$data[$period]['email']			= 0;
			$data[$period]['phone']			= 0;
			$data[$period]['fax']			= 0;
			$data[$period]['sms']			= 0;
			$data[$period]['click_call']	= 0;

			/* today */
			$sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Listing` WHERE `listing_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_array($result)) {
				if($row['report_type'] == 1) $data[$row['period']]['summary']		 += $row['amount'];
				if($row['report_type'] == 2) $data[$row['period']]['detail']		 += $row['amount'];
				if($row['report_type'] == 3) $data[$row['period']]['click']			 += $row['amount'];
				if($row['report_type'] == 4) $data[$row['period']]['email']			 += $row['amount'];
				if($row['report_type'] == 5) $data[$row['period']]['phone']			 += $row['amount'];
				if($row['report_type'] == 6) $data[$row['period']]['fax']			 += $row['amount'];
				if($row['report_type'] == 7) $data[$row['period']]['sms']			 += $row['amount'];
				if($row['report_type'] == 8) $data[$row['period']]['click_call']	 += $row['amount'];
			}

			/* daily */
			$sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail, SUM(click_thru) AS click, SUM(email_sent) AS email, SUM(phone_view) AS phone, SUM(fax_view) AS fax, SUM(send_phone) AS sms, SUM(click_call) AS click_call FROM Report_Listing_Daily WHERE listing_id = " . db_formatNumber($idIn) . " GROUP BY period";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_array($result)) {
				$data[$row['period']]['summary']		+= $row['summary'];
				$data[$row['period']]['detail']			+= $row['detail'];
				$data[$row['period']]['click']			+= $row['click'];
				$data[$row['period']]['email']			+= $row['email'];
				$data[$row['period']]['phone']			+= $row['phone'];
				$data[$row['period']]['fax']			+= $row['fax'];
				$data[$row['period']]['sms']			+= $row['sms'];
				$data[$row['period']]['click_call']		+= $row['click_call'];
			}

			/* monthly */
			$sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail, SUM(click_thru) AS click, SUM(email_sent) AS email, SUM(phone_view) AS phone, SUM(fax_view) AS fax, SUM(send_phone) AS sms, SUM(click_call) AS click_call FROM Report_Listing_Monthly WHERE listing_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_array($result)) {
				$data[$row['period']]['summary']		= $row['summary'];
				$data[$row['period']]['detail']			= $row['detail'];
				$data[$row['period']]['click']			= $row['click'];
				$data[$row['period']]['email']			= $row['email'];
				$data[$row['period']]['phone']			= $row['phone'];
				$data[$row['period']]['fax']			= $row['fax'];
				$data[$row['period']]['sms']			= $row['sms'];
				$data[$row['period']]['click_call']		= $row['click_call'];
			}
			return $data;

		} else {

			$lastMonth = date("Y")."-".(date("m")-1);

			$data[$lastMonth]['summary'] = 0;
			$data[$lastMonth]['detail'] = 0;
			$data[$lastMonth]['click'] = 0;
			$data[$lastMonth]['email'] = 0;
			$data[$lastMonth]['phone'] = 0;
			$data[$lastMonth]['fax'] = 0;
			$data[$lastMonth]['sms'] = 0;
			$data[$lastMonth]['click_call'] = 0;

			return $data;
		}
    }

    # ----------------------------------------------------------------------------------------------------
	# PROMOTION REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrievePromotionReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Promotion` WHERE `promotion_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Promotion_Daily WHERE promotion_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Promotion_Monthly WHERE promotion_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# EVENT REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveEventReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Event` WHERE `event_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Event_Daily WHERE event_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Event_Monthly WHERE event_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# BANNER REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveBannerReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['view'] = 0;
        $data[$period]['click_thru']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Banner` WHERE `banner_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 2) $data[$row['period']]['view']        += $row['amount'];
            if($row['report_type'] == 1) $data[$row['period']]['click_thru']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(view) AS view, SUM(click_thru) AS click_thru FROM Report_Banner_Daily WHERE banner_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['view']        += $row['view'];
            $data[$row['period']]['click_thru']  += $row['click_thru'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(view) AS view, SUM(click_thru) AS click_thru FROM Report_Banner_Monthly WHERE banner_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['view'] = $row['view'];
            $data[$row['period']]['click_thru']  = $row['click_thru'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# CLASSIFIED REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveClassifiedReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Classified` WHERE `classified_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Classified_Daily WHERE classified_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Classified_Monthly WHERE classified_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# ARTICLE REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveArticleReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Article` WHERE `article_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Article_Daily WHERE article_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Article_Monthly WHERE article_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

    # ----------------------------------------------------------------------------------------------------
	# POST REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrievePostReport($idIn = 0) {
        $db = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Post` WHERE `post_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Post_Daily WHERE post_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Post_Monthly WHERE post_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

	function report_PrepareListingStatsReviewToEmail($reports, $item_id, $item_type, $default_url = DEFAULT_URL){

        unset($body_email);

		if (is_array($reports)) {

            $addHeader = true;
            $closeHeader = false;

            foreach ($reports as $key => $report) {

                list($year, $month) = explode('-', $key);

                if ($month == (date("m")-1)) {

                    if ($addHeader) {
                        $body_email = "
                            <table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
                                <tr>
                                    <td width=\"125\">
                                        <b>".system_showText(LANG_LABEL_DATE)."</b>
                                    </td>
                                    <td width=\"90\">
                                        <b>".system_showText(LANG_LABEL_SUMMARY)."</b>
                                    </td>
                                    <td width=\"90\">
                                        <b>".system_showText(LANG_LABEL_DETAIL)."</b>
                                    </td>
                                    <td width=\"90\">
                                        <b>".system_showText(LANG_LABEL_CLICKTHRU)."</b>
                                    </td>
                                    <td width=\"90\">
                                        <b>".system_showText(LANG_LABEL_EMAIL)."</b>
                                    </td>
                                    ";
                                    if (REPORT_PHONE_FAX) {
                                        $body_email .= "
                                    <td width=\"90\">
                                        <b>" . system_showText(LANG_LABEL_PHONE) . "</b>
                                    </td>
                                    <td width=\"50\">
                                        <b>" . system_showText(LANG_LABEL_FAX) . "</b>
                                    </td>";
                                    }
                                    if (TWILIO_APP_ENABLED == "on"){
                                        if (TWILIO_APP_ENABLED_SMS == "on"){
                                            $body_email .= "
                                                <td width=\"115\">
                                                    <b>".system_showText(LANG_LABEL_SENDPHONE)."</b>
                                                </td>";
                                        }
                                        if (TWILIO_APP_ENABLED_CALL == "on"){
                                            $body_email .= "
                                                <td width=\"118\">
                                                    <b>".system_showText(LANG_LABEL_CLICKTOCALL)."</b>
                                                </td>";
                                        }
                                    }
                                    $body_email .= "
                                </tr>";

                        $addHeader = false;
                        $closeHeader = true;
                    }

                    $body_email .= "
                    <tr>
                        <td>".system_showDate('F', mktime(0, 0, 0, $month, 1, $year))." / ".$year."</td>
                        <td>".(($report['summary']) ? $report['summary'] : 0)."</td>
                        <td>".(($report['detail']) ? $report['detail'] : 0)."</td>
                        <td>".(($report['click']) ? $report['click'] : 0)."</td>
                        <td>".(($report['email']) ? $report['email'] : 0)."</td>";
                        if (REPORT_PHONE_FAX) {
                            $body_email .= "
                        <td>" . (($report['phone']) ? $report['phone'] : 0) . "</td>
                        <td>" . (($report['fax']) ? $report['fax'] : 0) . "</td>";
                        }
                        if (TWILIO_APP_ENABLED == "on") {
                            if (TWILIO_APP_ENABLED_SMS == "on"){
                                $body_email .= "
                                <td>".(($report['sms']) ? $report['sms'] : 0)."</td>";
                            }
                            if (TWILIO_APP_ENABLED_CALL == "on"){
                                $body_email .= "
                                <td>".(($report['click_call']) ? $report['click_call'] : 0)."</td>";
                            }
                        }
                    $body_email .= "
                    </tr>";
                }
            }

            if ($closeHeader) {
                $body_email .= "</table>";
            }

        }

        if ($item_id) {

            /*
            * Prepare Reviews / Working just for Listing
            */
            unset($array_general_review);
            $array_general_review = array();

            $listingObj = new Listing($item_id);
            $rate_avg = htmlspecialchars($listingObj->getString("avg_review"));
            $rate_avg = (isset($rate_avg) && $rate_avg != 0) ? round($rate_avg, 2) : system_showText(LANG_NA);

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $year = date("Y");
            $lastmonth = date("m")-1;
            $startDate = $year."-".$lastmonth."-01 00:00:00";
            $sql = "SELECT * FROM Review WHERE item_type = '$item_type' AND item_id = ".htmlspecialchars($item_id)." AND review IS NOT NULL AND review != '' AND approved=1 AND added >= '$startDate' AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 30 DAY), '%Y%m%d') <= added AND added <= NOW()";

            $r = $db->query($sql);
            $review_amount = mysql_num_rows($r);

            unset($rate_stars);
            for ($x=0 ; $x < 5 ;$x++) {
                if (round($rate_avg) > $x){
                    $rate_stars .= "<img src='".$default_url."/assets/images/structure/review-star.png' alt='Star On' />";
                }else{
                    $rate_stars .= "<img src='".$default_url."/assets/images/structure/review-star-o.png' alt='Star Off' />";
                }
            }

            $i=0;
            while($row = mysql_fetch_assoc($r)){

                if ($row["rating"]) {
                    unset($rate_stars);
                    for ($x=0 ; $x < 5 ;$x++) {
                        if ($row["rating"] > $x){
                            $rate_stars .= "<img src=\"".$default_url."/assets/images/structure/review-star.png\" alt=\"Star On\" align=\"bottom\" />";
                        }else{
                            $rate_stars .= "<img src=\"".$default_url."/assets/images/structure/review-star-o.png\" alt=\"Star Off\" align=\"bottom\" />";
                        }
                    }
                    $array_general_review[$i]["rate_starts"]	= $rate_stars;
                    $array_general_review[$i]["review_title"]	= $row["review_title"];
                    $array_general_review[$i]["reviewer_name"]	= $row["reviewer_name"];
                    $array_general_review[$i]["reviewer_email"]	= $row["reviewer_email"];
                    $array_general_review[$i]["review"]			= $row["review"];
                    $array_general_review[$i]["added"]			= $row["added"];
                    $i++;
                }

            }

            if(count($array_general_review) > 0){

                $body_email .= "<br /><br />
                                <table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
                                    <tr>
                                        <td>
                                            <b>".system_showText(LANG_REVIEWS_MONTH)."</b>
                                        </td>
                                    </tr>";
                for($i=0;$i<count($array_general_review);$i++){
                    $body_email .= "<tr><td>&nbsp;</td></tr>";
                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["rate_starts"]."</td></tr>";
                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["review_title"]."</td></tr>";
                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["reviewer_name"]." - ".format_date($array_general_review[$i]["added"])."</td></tr>";
                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["review"]."</td></tr>";

                }
                $body_email .= "</table>";


            }
        } else {

            unset($array_general_review);
            $array_general_review = array();

            $rate_avg = 4;
            $review_amount = 1;
            $rating = 4;

            unset($rate_stars);
            for ($x=0 ; $x < 5 ;$x++) {
                if (round($rate_avg) > $x){
                    $rate_stars .= "<img src='".$default_url."/assets/images/structure/review-star.png' alt='Star On' />";
                }else{
                    $rate_stars .= "<img src='".$default_url."/assets/images/structure/review-star-o.png' alt='Star Off' />";
                }
            }
            $i = 0;
            while($i < $review_amount){

                unset($rate_stars);
                for ($x=0 ; $x < 5 ;$x++) {
                    if ($rating > $x){
                        $rate_stars .= "<img src=\"".$default_url."/assets/images/structure/review-star.png\" alt=\"Star On\" align=\"bottom\" />";
                    }else{
                        $rate_stars .= "<img src=\"".$default_url."/assets/images/structure/review-star-o.png\" alt=\"Star Off\" align=\"bottom\" />";
                    }
                }
                $lastMonth1 = (date("m")-1)."-".date("d")."-".date("Y");
                $lastMonth2 = date("d")."-".(date("m")-1)."-".date("Y");
                $array_general_review[$i]["rate_starts"]	= $rate_stars;
                $array_general_review[$i]["review_title"]	= LANG_LABEL_ADVERTISE_REVIEW_TITLE;
                $array_general_review[$i]["reviewer_name"]	= LANG_LABEL_ADVERTISE_VISITOR;
                $array_general_review[$i]["reviewer_email"]	= LANG_LABEL_ADVERTISE_ITEM_EMAIL;
                $array_general_review[$i]["review"]			= "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.";
                $array_general_review[$i]["added"]			= str_replace("-", "/", (DEFAULT_DATE_FORMAT == "m/d/Y" ? $lastMonth1 : $lastMonth2));
                $i++;
            }

            if(count($array_general_review) > 0){

                $body_email .= "<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
                                    <tr>
                                        <td width=\"125\">
                                            <b>".system_showText(LANG_REVIEWS_MONTH)."</b>
                                        </td>
                                    </tr>";
                for($i=0;$i<count($array_general_review);$i++){

                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["rate_starts"]."</td></tr>";
                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["review_title"]."</td></tr>";
                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["reviewer_name"]." - ".$array_general_review[$i]["added"]."</td></tr>";
                    $body_email .= "<tr><td nowrap>".$array_general_review[$i]["review"]."</td></tr>";

                }
                $body_email .= "</table>";

            }
        }

        return $body_email;
	}