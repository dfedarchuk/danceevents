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
	# * FILE: /functions/db_funct.php
	# ----------------------------------------------------------------------------------------------------
	function db_ArrayDomainInfo(){
		if (defined("DOMAIN_INFORMATION")) return false;
		/*
		 * Get all information of Domains
		 */
		$db = db_getDBObject(DEFAULT_DB,true);
		$sql = "SELECT smaccount_id,
					   name,
					   database_host,
					   database_port,
					   database_username,
					   database_password,
					   database_name,
					   url,
					   status,
					   activation_status,
					   created,
					   event_feature,
					   banner_feature,
					   classified_feature,
					   article_feature,
					   id
				   FROM Domain";
		$result = $db->query($sql);
		if(mysql_num_rows($result)){

			/*
			 * Create constant with information of domains
			 */
			$array_domains = array();
			while($row = mysql_fetch_assoc($result)){
				/*
				 * Index with URL
				 */
				$array_domains[$row["url"]]["name"]						= $row["name"];
				$array_domains[$row["url"]]["smaccount_id"]				= $row["smaccount_id"];
				$array_domains[$row["url"]]["database_host"]			= $row["database_host"];
				$array_domains[$row["url"]]["database_port"]			= $row["database_port"];
				$array_domains[$row["url"]]["database_username"]		= $row["database_username"];
				$array_domains[$row["url"]]["database_password"]		= $row["database_password"];
				$array_domains[$row["url"]]["database_name"]			= $row["database_name"];
				$array_domains[$row["url"]]["url"]						= $row["url"];
				$array_domains[$row["url"]]["status"]					= $row["status"];
				$array_domains[$row["url"]]["activation_status"]		= $row["activation_status"];
				$array_domains[$row["url"]]["created"]					= $row["created"];
				$array_domains[$row["url"]]["event_feature"]			= $row["event_feature"];
				$array_domains[$row["url"]]["banner_feature"]			= $row["banner_feature"];
				$array_domains[$row["url"]]["classified_feature"]		= $row["classified_feature"];
				$array_domains[$row["url"]]["article_feature"]			= $row["article_feature"];
				$array_domains[$row["url"]]["id"]						= $row["id"];

				/*
				 * Index with ID
				 */
				$array_domains[$row["id"]]["name"]						= $row["name"];
				$array_domains[$row["id"]]["smaccount_id"]				= $row["smaccount_id"];
				$array_domains[$row["id"]]["database_host"]				= $row["database_host"];
				$array_domains[$row["id"]]["database_port"]				= $row["database_port"];
				$array_domains[$row["id"]]["database_username"]			= $row["database_username"];
				$array_domains[$row["id"]]["database_password"]			= $row["database_password"];
				$array_domains[$row["id"]]["database_name"]				= $row["database_name"];
				$array_domains[$row["id"]]["url"]						= $row["url"];
				$array_domains[$row["id"]]["status"]					= $row["status"];
				$array_domains[$row["id"]]["activation_status"]			= $row["activation_status"];
				$array_domains[$row["id"]]["created"]					= $row["created"];
				$array_domains[$row["id"]]["event_feature"]				= $row["event_feature"];
				$array_domains[$row["id"]]["banner_feature"]			= $row["banner_feature"];
				$array_domains[$row["id"]]["classified_feature"]		= $row["classified_feature"];
				$array_domains[$row["id"]]["article_feature"]			= $row["article_feature"];
				$array_domains[$row["id"]]["id"]						= $row["id"];

			}

			define("DOMAIN_INFORMATION", serialize($array_domains));

		}


	}


	function db_getDomainInformation($index){

		if(!defined('DOMAIN_INFORMATION')){
			db_ArrayDomainInfo();
		}

		$aux_domain_information = unserialize(DOMAIN_INFORMATION);
		$array_domain_information = $aux_domain_information[$index];

		if(is_array($array_domain_information)){
			return $array_domain_information;
		}else{
			return false;
		}

	}


	function db_getDBObject($name = DEFAULT_DB, $force_main = false) {
		/*
		 * Connect with main DB
		 */
		static $dbObj_main;
		$dbObj_main = new mysql($name);

		/*
		 * Get information of connection of domain
		 */
		if(!$force_main){
			unset($main_connection);


			/*
			 * Check if exists information on constant
			 */
			$array_domains = db_getDomainInformation(str_replace("www.","",$_SERVER["HTTP_HOST"]));
			if(is_array($array_domains) && $array_domains["status"] == "A"){

				if(!defined('SECOND_DB')){
					define("SECOND_DB","DOMAINDB");
					define("_DOMAINDB_HOST",$array_domains["database_host"].($array_domains["database_port"] ? ":".$array_domains["database_port"]: ""));
					define("_DOMAINDB_USER",$array_domains["database_username"]);
					define("_DOMAINDB_PASS",$array_domains["database_password"]);
					define("_DOMAINDB_NAME",$array_domains["database_name"]);
					define("_DOMAINDB_EMAIL", EDIR_ADMIN_EMAIL);
					if (DEMO_DEV_MODE || !$_SERVER["HTTP_HOST"]) {
						define("_DOMAINDB_DEBUG", "display");
					} else {
						define("_DOMAINDB_DEBUG", "hide");
					}
				}
				$dbObj = new mysql(SECOND_DB);

			}else{

				$sql = "SELECT database_host, database_port, database_username, database_password, database_name FROM Domain WHERE url = '".str_replace("www.","",$_SERVER["HTTP_HOST"])."' AND `status` = 'A'";
				$result = $dbObj_main->query($sql);
				if(mysql_num_rows($result)){
					$array_domains = mysql_fetch_assoc($result);

					if(!defined('SECOND_DB')){
						define("SECOND_DB","DOMAINDB");
						define("_DOMAINDB_HOST",$array_domains["database_host"].($array_domains["database_port"]? ":".$array_domains["database_port"]: ""));
						define("_DOMAINDB_USER",$array_domains["database_username"]);
						define("_DOMAINDB_PASS",$array_domains["database_password"]);
						define("_DOMAINDB_NAME",$array_domains["database_name"]);
						define("_DOMAINDB_EMAIL", EDIR_ADMIN_EMAIL);
						if (DEMO_DEV_MODE || !$_SERVER["HTTP_HOST"]) {
							define("_DOMAINDB_DEBUG", "display");
						} else {
							define("_DOMAINDB_DEBUG", "hide");
						}
					}
					$dbObj = new mysql(SECOND_DB);

				}else{
					$dbObj = $dbObj_main;
				}
			}
		}else{
			$dbObj = $dbObj_main;
		}
		return $dbObj;

	}

	/*
	* Check if a given string needs addslashes. Should be used before database operation.
	**************************************************************************************/
	function db_stringNeedsAddslashes($str) {
		if (($qp = string_strpos($str,"'")) !== false || ($qp = string_strpos($str,"\"")) !== false) {
		if ($str[$qp-1] != "\\")
			return true;
		else
			return db_stringNeedsAddslashes(string_substr($str,$qp+1,string_strlen($str)));
		}
		return false;
	}

	function db_formatString($string, $default = "", $import = false, $simpleQuotes = true) {
        if ($import){
            if (!$string){
               $string = "'".$string."'";
            } elseif (is_string($string)) {
                if ((string_strpos($string,"\'") !== false) || (string_strpos($string,"\\") !== false) || (string_strpos($string,"\\\"") !== false) || !get_magic_quotes_gpc()){
                    $string = stripslashes($string);
                }
                $string  = addslashes($string);
                $string = "'".$string."'";
            } elseif (is_numeric($string)) {
                return $string;
            } else {
                $string = "'".$string."'";
            }
            return $string;

        } else {

            if (empty($string) && $string != "0") {
                $string = $default;
            }
            if (($string[0]=="'" && $string[string_strlen($string)-1]=="'") || ($string[0]=='"' && $string[string_strlen($string)-1]=='"')) {
                $string = string_substr($string, 1, string_strlen($string)-2);
            }
            if (db_stringNeedsAddslashes($string)) {
                $string = addslashes($string);
            }
            if ($simpleQuotes){
                return "'".$string."'";
            } else {
                return $string;
            }
        }

	}

	function db_formatNumber($number, $default = 0) {
		if (is_numeric($number)) return $number;
		else return $default;
	}

	function db_formatBoolean($bool) {
		if($bool) return 1;
		else return 0;
	}

	function db_formatDate($date, $default = "0000-00-00") {
		$aux = explode("/", $date);
		if (count($aux) == 3) {
			if (DEFAULT_DATE_FORMAT == "m/d/Y") {
				$date = $aux[2]."-".$aux[0]."-".$aux[1];
			} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
				$date = $aux[2]."-".$aux[1]."-".$aux[0];
			}
		}
		$aux = explode("-", $date);
		if (count($aux) == 3) {
			if (DEFAULT_DATE_FORMAT == "m/d/Y") {
				$dateaux = $aux[1]."/".$aux[2]."/".$aux[0];
			} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
				$dateaux = $aux[2]."/".$aux[1]."/".$aux[0];
			}
			if (validate_date($dateaux)) {
				return "'".$date."'";
			}
		}
		return "'".$default."'";
	}


	function db_getFromDBXML($table,$by_key="",$by_value = null,$number=1,$orderby="",$fields, $sql=false, $domain_id = SELECTED_DOMAIN_ID){

		if(is_array($fields)){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID($domain_id, $dbMain);

			if(!$sql){

				$sql = "SELECT ".implode(',',$fields)." FROM ".$table." ";
				//Verify if the variables are not null or empty
				if (isset($by_key) && isset($by_key)) {
					//If both are array
					if (is_array($by_key) && is_array($by_value)) {
						//If the count of fields match and the first node of both is valid
						if (count($by_key) == count($by_value) && isset($by_key[0]) && isset($by_value[0])) {
							for($i=0; $i<count($by_key); $i++) {
								$where[] .= "$by_key[$i] = $by_value[$i]";
							}
						}
					//If both are not array
					} else if (!is_array($by_key) && !is_array($by_value) && string_strlen($by_key)) {
						$where[] = is_null($by_value) ? "{$by_key} IS NULL" : "$by_key = $by_value";
					}
				}

				if ($where) $sWhere = implode(" AND ", $where);

				if ($sWhere) $sql .= "WHERE $sWhere ";

				if ($orderby) $sql .= "ORDER BY $orderby ";

				if (is_numeric($number)) $sql .= "LIMIT $number ";


			}

			$r = $db->query($sql);

			if(mysql_num_rows($r) > 0){

				$string_XML = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
				$string_XML .= "<".$table.">";
				while($row = mysql_fetch_assoc($r)){
					$string_XML .= "<item>";
					for($i=0;$i<count($fields);$i++){
						$string_XML .= "<".$fields[$i].">".format_getString($row[$fields[$i]])."</".$fields[$i].">";
					}
					$string_XML .= "</item>";
				}
				$string_XML .= "</".$table.">";
				return $string_XML;
			}else{
				return false;
			}
		}else{
			return false;
		}


	}

	function db_getFromDB($table, $by_key="", $by_value=null, $number=1, $orderby="", $return="object", $domain_id = false, $package = false, $fields = "*", $where = "", $debug = false) {

		switch ($table) {
			case 'account'				: $obj = "Account";					break;
			case 'smaccount'			: $obj = "SMAccount";				break;
			case 'contact'				: $obj = "Contact";					break;
			case 'listing'				: $obj = "Listing";					break;
			case 'gallery'				: $obj = "Gallery";					break;
			case 'promotion'			: $obj = "Promotion";				break;
			case 'listingcategory'		: $obj = "ListingCategory";			break;
			case 'classifiedcategory'	: $obj = "ClassifiedCategory";		break;
			case 'classified'			: $obj = "Classified";				break;
			case 'articlecategory'		: $obj = "ArticleCategory";			break;
			case 'article'				: $obj = "Article";					break;
			case 'eventcategory'		: $obj = "EventCategory";			break;
			case 'event'				: $obj = "Event";					break;
			case 'banner'				: $obj = "Banner";					break;
			case 'invoice'				: $obj = "Invoice";					break;
			case 'editor_choice'		: $obj = "Editor_Choice";			break;
			case 'listing_choice'		: $obj = "Listing_Choice";			break;
			case 'payment_log'			: $obj = "Payment_Log";				break;
			case 'custominvoice'		: $obj = "CustomInvoice";			break;
			case 'listingtemplate'		: $obj = "ListingTemplate";			break;
			case 'location1'			: $obj = "Location_1";				break;
			case 'location2'			: $obj = "Location_2";				break;
			case 'location3'			: $obj = "Location_3";				break;
			case 'location4'			: $obj = "Location_4";				break;
			case 'location5'			: $obj = "Location_5";				break;
			case 'settinglocation'      : $obj = "Setting_Location";		break;
            case 'blogcategory'			: $obj = "BlogCategory";			break;
			case 'post'					: $obj = "Post";        			break;
			case 'blog'					: $obj = "Post";        			break;

		}

		if ($domain_id){
			$dbMain = db_getDBObject(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID($domain_id,$dbMain);
		} else{
			/*
			 * Force connection with main DB
			 */
			$db = db_checkTableMainDomain($table);
		}

		$sql = "SELECT $fields FROM $obj ";
		//Verify if the variables are not null or empty
		if (isset($by_key) && (isset($by_value) || is_null($by_value))) {
			//If both are array
			if (is_array($by_key) && is_array($by_value)) {
				//If the count of fields match and the first node of both is valid
				if (count($by_key) == count($by_value) && isset($by_key[0]) && isset($by_value[0])) {
					for($i=0; $i<count($by_key); $i++) {
						$where[] .= "$by_key[$i] = $by_value[$i]";
					}
				}
				//If both are not array
			} else if (!is_array($by_key) && !is_array($by_value) && string_strlen($by_key) && string_strlen($by_value)) {
				$sql_null = "$by_key = $by_value";
				if (is_null($by_value)) {
					$sql_null = "$by_key IS NULL";
				}
				$where[] = $sql_null;
			}
		}

		if (is_array($where) && $where[0]) $sWhere = implode(" AND ", $where);
		else $sWhere = $where;

		if ($sWhere) $sql .= "WHERE $sWhere ";

		if ($package) $sql .= "AND package_id =0 ";

		if ($orderby) $sql .= "ORDER BY $orderby ";

		if (is_numeric($number)) $sql .= "LIMIT $number ";

		$r = $db->query($sql);

		if ($debug) {
			echo $sql; exit;
		}

		if ($number == 1) {
			$row = mysql_fetch_array($r);
			if ($return == "array") $res = $row;
			else if ($return == "object") {
				if ($obj == "Gallery") $res = new $obj($row["id"]);
				else {
					$obj = str_replace("_", "", $obj);
					$res = new $obj($row);
				}
			}
		} else {
			$res = Array();
			while ($row = mysql_fetch_array($r)) {
				if ($return == "array") $res[] = $row;
				else if ($return == "object") {
					if ($obj == "Gallery") $res[] = new $obj($row["id"]);
					else {
						$obj = str_replace("_", "", str_replace("MM_", "", $obj));
						$res[] = new $obj($row);
					}
				}
			}
		}

		return $res;

	}

	function db_getFromDBBySQL($table, $sql, $return = "object", $forceDB = false, $domain_id = 0) {

		switch ($table) {
			case 'account'				: $obj = "Account";				break;
			case 'smaccount'			: $obj = "SMAccount";			break;
			case 'contact'				: $obj = "Contact";				break;
			case 'listing'				: $obj = "Listing";				break;
			case 'gallery'				: $obj = "Gallery";				break;
			case 'promotion'			: $obj = "Promotion";			break;
			case 'listingcategory'		: $obj = "ListingCategory";		break;
			case 'classifiedcategory'	: $obj = "ClassifiedCategory";	break;
			case 'classified'			: $obj = "Classified";			break;
			case 'articlecategory'		: $obj = "ArticleCategory";		break;
			case 'article'				: $obj = "Article";				break;
			case 'eventcategory'		: $obj = "EventCategory";		break;
			case 'event'				: $obj = "Event";				break;
			case 'banner'				: $obj = "Banner";				break;
			case 'image'				: $obj = "Image";				break;
			case 'invoice'				: $obj = "Invoice";				break;
			case 'custominvoice'		: $obj = "CustomInvoice";		break;
			case 'listingtemplate'		: $obj = "ListingTemplate";		break;
			case 'location1'			: $obj = "Location_1";			break;
			case 'location2'			: $obj = "Location_2";			break;
			case 'location3'			: $obj = "Location_3";			break;
			case 'location4'			: $obj = "Location_4";			break;
			case 'location5'			: $obj = "Location_5";			break;
			case 'comment'				: $obj = "Comments";			break;
            case 'post'					: $obj = "Post";				break;
            case 'cron_log'             : $obj = "Cron_Log";			break;
			default						: $obj = $table;				break;
		}

		$dbObjAux = db_getDBObject(DEFAULT_DB,true);

		if ($domain_id){
			$dbMain = db_getDBObject(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID($domain_id,$dbMain);
		} else{
			/*
			 * Force connection with main DB
			 */
			$db = db_checkTableMainDomain($table);
		}

        if($return == "array"){
            $r = $db->unbuffered_query($sql);
        }else{
            $r = $db->query($sql);
        }


		$res = Array();

		if ($r){
            while ($row = mysql_fetch_array($r)) {
                if ($return == "array"){
                    $res[] = $row;
                }else {
                    if ($obj == "Gallery"){
                        $res[] = new $obj($row["id"]);
                    }else{
                        $res[] = new $obj($row);
                    }
                }
            }
        }

		return $res;

	}

	/*
	 * getLocationString(format)
	 * @tableObject = instance of a table object wich contains location id fields like location_id and so on
	 * @format:
	 * 1 - country      (will use location_1 for location_country)
	 * 2 - region       (will use location_2 for location_region)
	 * 3 - state        (will use location_3 for location_state)
	 * 4 - city         (will use location_4 for location_city)
	 * 5 - neighborhood (will use location_5 for location_neighborhood)
	 * z - zip_code     (caution - only for tables with zip_code field)
	 * A - address      (caution - the same as zip_code)
	 * other chars will be parsed as literals
	 * to use characters above as literals, escape them
	 * $autoFormat:
	 * used to not include literal chars if the return string is still empty or contains only spaces.
	*/
	function db_getLocationString($tableObject, $format, $autoFormat = true, $lineBreak = true) {
        $format = str_replace("3, z, 1", "3 z 1", $format);
		$length = string_strlen($format); /* optmization: skip "for loop" to always avail string_strlen*/
		$locationString = "";
		$spaces = 0;
		for($i = 0; $i < $length; $i++){
			$char = string_substr($format, $i, 1);
			$obj = 0;
			switch($char){
				case "\\":
					$char = string_substr($format, ++$i, 1);
					$locationString .= htmlspecialchars($char);
					break;
				case "1":
					$obj = "Location1";
					$obj_id = $tableObject->location_1;
					break;
				case "2":
					$obj = "Location2";
					$obj_id = $tableObject->location_2;
					break;
				case "3":
					$obj = "Location3";
					$obj_id = $tableObject->location_3;
					break;
				case "4":
					$obj = "Location4";
					$obj_id = $tableObject->location_4;
					break;
				case "5":
					$obj = "Location5";
					$obj_id = $tableObject->location_5;
					break;
				case "z":
					$locationString .= trim($tableObject->zip_code);
					break;
				case "A":
					$locationString .= trim($tableObject->address);
					break;
                case "B":
					$locationString .= trim($tableObject->address2);
					break;
                case "C":
					$locationString .= trim($tableObject->location);
					break;
				default:
					if ($autoFormat) {
						if (string_strlen($locationString) - $spaces > 0) {
							$locationString .= htmlspecialchars($char);
                        }
					} else {
						$locationString .= htmlspecialchars($char);
					}
			}
			if ($obj) {
				$locationManager =& $tableObject->getLocationManager();
				if ($locationManager) {
					$locationObject = $locationManager->getLocationObject($obj, $obj_id);
				} else {
					$locationObject = new $obj($obj_id);
				}
                $lineBreakStr = (string_strpos($_SERVER["PHP_SELF"], "api") != false ? "\n" : "<br />");

				$locationString .= ($obj == "Location1" && $lineBreak && $locationObject->name ? $lineBreakStr : "").$locationObject->name;
			}
			if ($char === " ") $spaces++;
		}
        $locationString = str_replace(", ,", ", ", $locationString);
        $locationString = str_replace(" , ", " ", $locationString);
        $locationString = trim($locationString);
        $lastchar = string_substr($locationString, -1);
        if ($lastchar == ",") {
            $locationString = string_substr($locationString, 0, -1);
        }
		return $locationString;
	}


	function db_loadCategoriesDropdown($table, $fields, $id = null, $level, $optimization, $domain_id = SELECTED_DOMAIN_ID, &$str_values = "", $orderby = "") {
		$nameArray  = array();
		$valueArray = array();
		$resultArray = array();

		$subcategories = db_getFromDBXML($table, "category_id", $id, MAX_SHOW_ALL_CATEGORIES, $orderby, $fields, false, $domain_id);
		$xml_subcategories = simplexml_load_string($subcategories);
		if ($subcategories) {
			if(count($xml_subcategories->item) > 0) {
				$marker = " ";
                if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS) === false) {
                    for ($y=1; $y<$level; $y++) {
                        $marker .= "&raquo;";
                    }
                    $marker .= " ";
                }

				for($j=0;$j<count($xml_subcategories->item);$j++){
					$subcategory = array();
					foreach($xml_subcategories->item[$j]->children() as $key => $value) {
						$subcategory[$key] = $value;
					}
					if (count($subcategory > 0)) {

						if ($level == 1 && $optimization != "on" && string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS) === false) {
							$valueArray[] = "";
							$nameArray[]  = "--------------------------------------------------";

						}

						$valueArray[] = $subcategory["id"];
                        $nameArray[] = $marker.$subcategory["title"];

						$subLevel = $level + 1;

                        if ($table == "ListingCategory") {
                            $maxLevelCat = LISTING_CATEGORY_LEVEL_AMOUNT;
                        } else {
                            $maxLevelCat = CATEGORY_LEVEL_AMOUNT;
                        }

						if ($subLevel <= $maxLevelCat && $optimization != "on") {

							$resultArray = db_loadCategoriesDropdown($table, $fields, $subcategory["id"], $subLevel, $optimization, $domain_id, $str_values, $orderby);
							$valueArray = array_merge($valueArray, $resultArray["values"]);
							$nameArray = array_merge($nameArray, $resultArray["names"]);
						}
					}
				}
			}
		} else {
			$str_values .= $id.",";
		}

		$resultArray["values"] = $valueArray;
		$resultArray["names"] = $nameArray;
		return $resultArray;
	}


	function db_getDBObjectByDomainID($domain_id, $dbObj_main, $url = false) {

		/*
		 * Connect with main DB
		 */

		if($dbObj_main && ($domain_id || $url)){



			$array_domains = db_getDomainInformation($url ? str_replace("www.","",$_SERVER["HTTP_HOST"]) : $domain_id);
			if(is_array($array_domains) && ($array_domains["status"] == "A" || $array_domains["status"] == "P")){

				if(!defined('SM_SECOND_DB_'.$domain_id)){
					define("SM_SECOND_DB_".$domain_id,"SM_DOMAINDB_".$domain_id);
					define("_SM_DOMAINDB_".$domain_id."_HOST",$array_domains["database_host"].($array_domains["database_port"]? ":".$array_domains["database_port"]: ""));
					define("_SM_DOMAINDB_".$domain_id."_USER",$array_domains["database_username"]);
					define("_SM_DOMAINDB_".$domain_id."_PASS",$array_domains["database_password"]);
					define("_SM_DOMAINDB_".$domain_id."_NAME",$array_domains["database_name"]);
					define("_SM_DOMAINDB_".$domain_id."_EMAIL", EDIR_ADMIN_EMAIL);
					if (DEMO_DEV_MODE || !$_SERVER["HTTP_HOST"]) {
						define("_SM_DOMAINDB_".$domain_id."_DEBUG", "display");
					} else {
						define("_SM_DOMAINDB_".$domain_id."_DEBUG", "hide");
					}
				}
				$dbObj = new mysql(constant("SM_SECOND_DB_".$domain_id));
				return $dbObj;

			}else{

				/*
				 * Force DB Main
				 */
				$dbObj_main = db_getDBObject(DEFAULT_DB, true);

				if($url){
					$sql = "SELECT database_host, database_port, database_username, database_password, database_name FROM Domain WHERE url = '".str_replace("www.", "", $url)."' AND (`status` = 'A' OR `status` = 'P')";
				}else{
					$sql = "SELECT database_host, database_port, database_username, database_password, database_name FROM Domain WHERE id = ".$domain_id." AND (`status` = 'A' OR `status` = 'P')";
				}

				$result = $dbObj_main->query($sql);
				if(mysql_num_rows($result)){
					$array_domains = mysql_fetch_assoc($result);

					if(!defined('SM_SECOND_DB_'.$domain_id)){
						define("SM_SECOND_DB_".$domain_id,"SM_DOMAINDB_".$domain_id);
						define("_SM_DOMAINDB_".$domain_id."_HOST",$array_domains["database_host"].($array_domains["database_port"]? ":".$array_domains["database_port"]: ""));
						define("_SM_DOMAINDB_".$domain_id."_USER",$array_domains["database_username"]);
						define("_SM_DOMAINDB_".$domain_id."_PASS",$array_domains["database_password"]);
						define("_SM_DOMAINDB_".$domain_id."_NAME",$array_domains["database_name"]);
						define("_SM_DOMAINDB_".$domain_id."_EMAIL", EDIR_ADMIN_EMAIL);
						if (DEMO_DEV_MODE || !$_SERVER["HTTP_HOST"]) {
							define("_SM_DOMAINDB_".$domain_id."_DEBUG", "display");
						} else {
							define("_SM_DOMAINDB_".$domain_id."_DEBUG", "hide");
						}
					}
					$dbObj = new mysql(constant("SM_SECOND_DB_".$domain_id));
					return $dbObj;
				}else{
					echo "Domain unavailable! Please contact the administrator.";
					exit;
				}

			}

		}else{
			return false;
		}

	}

	function db_getFields($db,$table,$use_domain=false){
		$sql = "desc ".$table;
		$result = $db->query($sql);
		if(mysql_num_rows($result)){
			unset($array_fields);
			while($row = mysql_fetch_assoc($result)){
				if($use_domain){
					$array_fields[] = $row["Field"];
				}elseif($row["Field"] != "domain_id"){
					$array_fields[] = $row["Field"];
				}
			}
			return $array_fields;
		}else{
			return false;
		}
	}


	function db_checkTableMainDomain($table){
		/*
		 * Force connection with main DB
		 */
		$array_tables_main_table[] = "account";
		$array_tables_main_table[] = "smaccount";
		$array_tables_main_table[] = "contact";
		$array_tables_main_table[] = "profile";
		$array_tables_main_table[] = "location1";
		$array_tables_main_table[] = "location2";
		$array_tables_main_table[] = "location3";
		$array_tables_main_table[] = "location4";
		$array_tables_main_table[] = "location5";
		$array_tables_main_table[] = "cron_log";
		if(in_array($table, $array_tables_main_table)){
			$db = db_getDBObject(DEFAULT_DB,true);
		}else{
			$db = db_getDBObject();
		}
		return $db;
	}
?>
