<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/reports/statisticreportrefresh.php
	# ----------------------------------------------------------------------------------------------------
	
	if (!$_GET['refresh']) {

		////////////////////////////////////////////////////////////////////////////////////////////////////
		ini_set("html_errors", FALSE);
		////////////////////////////////////////////////////////////////////////////////////////////////////

		////////////////////////////////////////////////////////////////////////////////////////////////////
		$path = "";
		$full_name = "";
		$file_name = "";
		$full_name = $_SERVER["SCRIPT_FILENAME"];
		if (string_strlen($full_name) > 0) {
			$file_pos = string_strpos($full_name, "/cron/");
			if ($file_pos !== false) {
				$file_name = string_substr($full_name, $file_pos);
			}
			$path = string_substr($full_name, 0, (string_strlen($file_name)*(-1)));
		}
		if (string_strlen($path) == 0) $path = "..";
		define("EDIRECTORY_ROOT", $path);
		define("BIN_PATH", EDIRECTORY_ROOT."/bin");
		////////////////////////////////////////////////////////////////////////////////////////////////////

		////////////////////////////////////////////////////////////////////////////////////////////////////
		include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");
		////////////////////////////////////////////////////////////////////////////////////////////////////

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$dbMain = db_getDBObject(DEFAULT_DB, true);
	if (defined("SELECTED_DOMAIN_ID")) {
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
	} else {
		$dbObj = db_getDBObject();
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	# --------------------------------------------------------------------------------------------------
	# getting the start date and time
	# --------------------------------------------------------------------------------------------------
	$cron_startdate = date('Y-m-d H:i:s');

	# --------------------------------------------------------------------------------------------------
	# top Keywords
	# --------------------------------------------------------------------------------------------------
	$sql = "SELECT DATE(search_date) AS day, keyword, module, count(keyword) as quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND keyword <> '' GROUP BY keyword, module ORDER BY search_date ASC, module ASC, quantity DESC, keyword ASC";
	$result = $dbObj->query($sql);

	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+".db_formatNumber($row['quantity']).") WHERE `day` = ".db_formatString($row['day'])." AND `module` = ".db_formatString($row['module'])." AND `key` = 'keywords' AND `value` = ".db_formatString($row['keyword'])." LIMIT 1";
		unset($resultUp);
		$resultUp = $dbObj->query($sql);
		if (!mysql_affected_rows($dbObj->link_id)) {
			$sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'keywords',".db_formatString($row['keyword']).",".db_formatNumber($row['quantity']).")";
			$dbObj->query($sql);
		}
	}


	# --------------------------------------------------------------------------------------------------
	# top Where
	# --------------------------------------------------------------------------------------------------
	$sql = "SELECT DATE(search_date) AS day, search_where, module, count(search_where) as quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND search_where <> '' GROUP BY search_where, module ORDER BY search_date ASC, module ASC, quantity DESC, search_where ASC";
	$result = $dbObj->query($sql);

	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+".db_formatNumber($row['quantity']).") WHERE `day` = ".db_formatString($row['day'])." AND `module` = ".db_formatString($row['module'])." AND `key` = 'where' AND `value` = ".db_formatString($row['search_where'])." LIMIT 1";
		unset($resultUp);
		$resultUp = $dbObj->query($sql);
		if (!mysql_affected_rows($dbObj->link_id)) {
			$sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'where',".db_formatString($row['search_where']).", ".db_formatNumber($row['quantity']).")";
			$dbObj->query($sql);
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# top Category
	# ----------------------------------------------------------------------------------------------------
	$sql = "SELECT DATE(search_date) AS day, category_id, module, count(category_id) as quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND category_id > 0 GROUP BY category_id, module ORDER BY search_date ASC, category_id ASC, module ASC";
	$result = $dbObj->query($sql);

	$listingCategory    = new ListingCategory();
	$eventCategory      = new EventCategory();
	$classifiedCategory = new ClassifiedCategory();
	$articleCategory	= new ArticleCategory();
	$blogCategory		= new BlogCategory();

	while ($row = mysql_fetch_assoc($result)) {

		if($row['module'] == 'l') {
			$listingCategory->setNumber('id', $row['category_id']);
			$categoriesArray = $listingCategory->getFullPath();
		}

		if($row['module'] == 'e') {
			$eventCategory->setNumber('id', $row['category_id']);
			$categoriesArray = $eventCategory->getFullPath();
		}

		if($row['module'] == 'c') {
			$classifiedCategory->setNumber('id', $row['category_id']);
			$categoriesArray = $classifiedCategory->getFullPath();
		}

		if($row['module'] == 'a') {
			$articleCategory->setNumber('id', $row['category_id']);
			$categoriesArray = $articleCategory->getFullPath();
		}

		if($row['module'] == 'p') {
			$blogCategory->setNumber('id', $row['category_id']);
			$categoriesArray = $blogCategory->getFullPath();
		}
        
        if($row['module'] == 'd') {
			$listingCategory->setNumber('id', $row['category_id']);
			$categoriesArray = $listingCategory->getFullPath();
		}

		$categoryPath = array();
		if (is_array($categoriesArray)) foreach($categoriesArray as $eachCategory) {
			$categoryPath[] = $eachCategory['title'];
		}
		$categoryTitle = implode(" >> ", $categoryPath);

		if (string_strlen(trim($categoryTitle))) {
			$sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+".db_formatNumber($row['quantity']).") WHERE `day` = ".db_formatString($row['day'])." AND `module` = ".db_formatString($row['module'])." AND `key` = 'categories' AND `value` = ".db_formatString($categoryTitle)." LIMIT 1";
			$results = $dbObj->query($sql);
			if (!mysql_affected_rows($dbObj->link_id)) {
				$sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'categories',".db_formatString($categoryTitle).", ".db_formatNumber($row['quantity']).")";
				$dbObj->query($sql);
			}
		}

	}

	unset($listingCategory);
	unset($eventCategory);
	unset($classifiedCategory);
	unset($articleCategory);

	# ----------------------------------------------------------------------------------------------------
	# top Locations
	# ----------------------------------------------------------------------------------------------------
	
	$_locations = explode(",", EDIR_LOCATIONS);
	
	$location_coluns_array="";
	foreach ($_locations as $_location_level) {
		$objLocationLabel = "Location".$_location_level;
		${"Location".$_location_level} = new $objLocationLabel;
		$location_coluns_array[]="location_".$_location_level;	
	}
	$location_coluns = implode(", ", $location_coluns_array);
	
	$sql = "SELECT DATE(search_date) AS day, ".$location_coluns.", module, count(".$location_coluns_array[0].") as quantity FROM Report_Statistic WHERE `search_date` <= NOW() AND ".$location_coluns_array[0]." > 0 GROUP BY ".$location_coluns.", module ORDER BY search_date ASC";

	$results = $dbObj->query($sql);

	while ($row = mysql_fetch_assoc($results)) {

		$locationPath = array();

		foreach ($_locations as $_location_level) {			
			if($row['location_'.$_location_level] > 0) {
				${"Location".$_location_level}->setNumber('id', $row['location_'.$_location_level]);
				$getLocation = ${"Location".$_location_level}->retrieveLocationById();
				$locationPath[] = $getLocation['name'];				
			}
		}

		if ( !in_array(null, $locationPath, true) ) { 

			$location = implode(" >> ", $locationPath);
			
			if (string_strlen(trim($location))) {
				$sql = "UPDATE Report_Statistic_Daily SET `quantity`=(`quantity`+".db_formatNumber($row['quantity']).") WHERE `day` = ".db_formatString($row['day'])." AND `module` = ".db_formatString($row['module'])." AND `key` = 'locations' AND `value` = ".db_formatString($location)." LIMIT 1";
				$result = $dbObj->query($sql);
				if (!mysql_affected_rows($dbObj->link_id)) {
					$sql = "INSERT INTO Report_Statistic_Daily (`day`, `module`, `key`, `value`, `quantity`) VALUES (".db_formatString($row['day']).",".db_formatString($row['module']).",'locations',".db_formatString($location).", ".db_formatNumber($row['quantity']).")";
					$dbObj->query($sql);
				}
			}
		}
	}

	foreach ($_locations as $_location_level)
		unset (${"Location".$_location_level});

	# ----------------------------------------------------------------------------------------------------
	# clear old data
	# ----------------------------------------------------------------------------------------------------
	$sql = "DELETE FROM `Report_Statistic` WHERE `search_date` <= NOW()";
	$dbObj->query($sql);

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	if (!$_GET['refresh']) print "Process Statistic - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n"; else print date("Y-m-d H:i:s")." - ".round($time, 2);
	if (!setting_set("last_datetime_statisticreport", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_statisticreport", date("Y-m-d H:i:s"))) {
			print "last_datetime_statisticreport error - ".date("Y-m-d H:i:s")."\n";
		}
	}
//	$dbObj->close();
	unset($dbObj);
	////////////////////////////////////////////////////////////////////////////////////////////////////
