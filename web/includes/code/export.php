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
	# * FILE: /includes/code/export.php
	# ----------------------------------------------------------------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["export_payment"]) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			list($start_month, $start_day, $start_year) = explode("/", $_POST["date_start"]);
			list($end_month, $end_day, $end_year) = explode("/", $_POST["date_end"]);
		} else {
			list($start_day, $start_month, $start_year) = explode("/", $_POST["date_start"]);
			list($end_day, $end_month, $end_year) = explode("/", $_POST["date_end"]);
		}

        if(
			!is_numeric($start_month) ||
			!is_numeric($start_day) ||
			!is_numeric($start_year)
		) {
			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);
		} elseif(
			!is_numeric($end_month) ||
			!is_numeric($end_day) ||
			!is_numeric($end_year)
		){

			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);

        } elseif (
                    ( $start_year == $end_year && $start_month == $end_month && $start_day > $end_day ) ||
                    ( $start_year == $end_year && $start_month > $end_month ) ||
                    ( $start_year > $end_year )
                 ) {
                     $message_export_payment = system_showText(LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);

        } elseif(!checkdate($start_month, $start_day, $start_year)) {

			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);

		} elseif(!checkdate($end_month, $end_day, $end_year)){

			$message_export_payment = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE)." ".system_showText(LANG_SITEMGR_MSGERROR_PLEASETRYAGAIN);

		} elseif ($_POST["type"] == "invoice" || $_POST["type"] == "payment") {

				$start_date				= $start_year.$start_month.$start_day;
				$end_date				= $end_year.$end_month.$end_day;
				$csv_delimiter			= ($_POST["delimiter"] == "semicolon") ? ";" : ",";
				$foreign_tables			= array("Listing", "Event", "Article", "Banner", "Classified", "CustomInvoice");
				$foreign_fields			= array("listing_id","listing_title", "event_id","event_title", "article_id","article_title", "banner_id","banner_caption", "classified_id","classified_title", "custom_invoice_id");

			if($_POST["type"] == "payment"){
				$primary_table				= "Payment_Log";
				$primary_table_condition	= "WHERE '$start_date' <= DATE(transaction_datetime) AND DATE(transaction_datetime) <= '$end_date' AND hidden = 'n' ";
				$filename					= "payment_log.csv";
				$prefix_foreign_table		= "Payment_";
				$sufix_foreign_table		= "_Log";
				$foreign_key				= "payment_log_id";
				$date_field					= "transaction_datetime";
			}

			if($_POST["type"] == "invoice"){
				$primary_table				= "Invoice";
				$primary_table_condition	= "WHERE status != 'N' AND '$start_date' <= DATE(date) AND DATE(date) <= '$end_date'";
				$prefix_foreign_table		= "Invoice_";
				$sufix_foreign_table		= "";
				$filename					= "invoice_log.csv";
				$foreign_key				= "invoice_id";
			}

			if($_POST["account_id"]) $primary_table_condition .= " AND account_id=".$_POST["account_id"];

			$sql = "SELECT * FROM $primary_table $primary_table_condition";

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$r = $db->query($sql);
			$total_records = mysql_num_rows($r);
			$message_export_payment = "";
			if($total_records > PAYMENT_LIMIT) {
				$message_export_payment = system_showText(LANG_SITEMGR_EXPORT_MSGERROR_MAXIMUMRECORDS);
			} elseif( $total_records > 0 ) {
				$i=0;
				$max_label_len=0;
				// Retrieving records from Payment_Log
				while($row = mysql_fetch_assoc($r)){

					$y=0;
					foreach($row as $key => $value){

						if($i == 0 && $key!="return_fields") { $payment_label_arr[] = "\"".addslashes($key)."\""; }
						if (string_substr($value,0,1)== '"') $value = " ".$value;
						if (string_strpos($key, "date") !== false)
							$payment_value_arr[$i][$y] = " ".format_date($value);
						elseif($key!="return_fields")
							$payment_value_arr[$i][$y] = " ".$value;

						if($key == "transaction_subtotal")
							$subtotal = $value;

						if($key == "transaction_tax"){
							$payment_value_arr[$i][$y] =  " ".payment_calculateTax($subtotal, $value, true, false);
						}

						if($key == "subtotal_amount")
							$subtotal = $value;

						if($key == "tax_amount")
							$payment_value_arr[$i][$y] =  payment_calculateTax($subtotal, $value,true,false);

						if($key == "id") $id_transaction = $value;
						$y++;
					}

					if($i == 0) $payment_label_csv_content = implode($csv_delimiter, $payment_label_arr);
					$payment_value_csv_content_aux = implode($csv_delimiter, $payment_value_arr[$i]);
					$payment_value_csv_content_aux .= $csv_delimiter;
					foreach ($foreign_tables as $table_log) {
						$sql2 = "SELECT * FROM ".$prefix_foreign_table.$table_log.$sufix_foreign_table." WHERE $foreign_key = $id_transaction";
						$dbMain = db_getDBObject(DEFAULT_DB, true);
						$db2 = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
						$r2 = $db2->query($sql2);
						if($table_log == "Listing") $levelObj = new ListingLevel();
						if($table_log == "Event") $levelObj = new EventLevel();
						if($table_log == "Article") $levelObj = new ArticleLevel();
						if($table_log == "Banner") $levelObj = new BannerLevel();
						if($table_log == "Classified") {
							$levelObj = new ClassifiedLevel();
							$table_log = "Classified";
						}

						while($row2 = mysql_fetch_assoc($r2)) {
							unset($payment_item_value_arr);
							$payment_item_value_arr = array();
							foreach($row2 as $key2 => $value2){
								$exclude_fields = array("items", "items_price", "level", $foreign_key, "subtotal", "tax");
								if($value2 && !in_array($key2, $exclude_fields)) {
									switch ($key2) {
										case "title":
											$payment_item_value_arr[] = "Title: ".$value2;
										case "discount_id":
											$payment_item_value_arr[] = "Discount Code: ".$value2;
											break;
										case "level_label":
											$payment_item_value_arr[] = "Level: ".$value2;
											break;
										case "renewal_date":
											if (format_date($value2)) {
												$payment_item_value_arr[] = "Renewal Date: ".format_date($value2);
											}
											break;
										case "date":
											if (format_date($value2)) {
												$payment_item_value_arr[] = "Date: ".format_date($value2);
											}
											break;
										case "impressions":
											$payment_item_value_arr[] = "Impressions: ".$value2;
											break;
										case "categories":
											$payment_item_value_arr[] = "Categories: ".$value2;
											break;
										case "extra_categories":
											$payment_item_value_arr[] = "Extra Categories: ".$value2;
											break;
										case "listingtemplate_title":
											$payment_item_value_arr[] = "Type: ".$value2;
											break;
										case "amount":
											if ($table_log == "CustomInvoice") $value2 = $row2["subtotal"];
											$payment_item_value_arr[] = "Amount: ".$value2;
											break;
										default:
											$payment_item_value_arr[] = $value2;
											break;
									}
								}
							}
							$payment_value_csv_content_aux .= trim($table_log)." ".implode(" - ", $payment_item_value_arr) . " | ";
						}

					}
					$payment_value_csv_content_aux = string_substr($payment_value_csv_content_aux,0,-2);
					$payment_value_csv_content .= $payment_value_csv_content_aux."\r\n";
					$i++;
				}

				$payment_csv_content = $payment_label_csv_content.$csv_delimiter."items".$csv_delimiter."\r\n";
				$payment_csv_content .= $payment_value_csv_content;

				if($payment_csv_content) {
					header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT\r\n" );
					header ( "Last-modified: " . gmdate("D,d M Y H:i:s") . " GMT\r\n" );
					header ( "Cache-control: private\r\n" );
					header ( "Content-type: application/csv\r\n" );
					header ( "Content-disposition: attachment; filename=\"$filename\"\r\n" );
					header ( "Pragma: public\r\n" );
					echo $payment_csv_content;
					exit;
				} else {
					$message_export_payment = system_showText(LANG_SITEMGR_EXPORT_PAYMENT_NORECORD);
				}

			} else {

				$message_export_payment = system_showText(LANG_SITEMGR_EXPORT_PAYMENT_NORECORD);

			}
		}
	} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["loadlocations"]) {

		//LOCATION PROCESS
		$_locations = explode(",", EDIR_LOCATIONS);
		$_location_level = $_locations[0];

		$objLocationLabel = "Location".$_location_level;
		${"Location".$_location_level} = new $objLocationLabel;

		${"locations".$_location_level} = ${"Location".$_location_level}->retrieveAllLocation();

		function build_location_tree($_locations, $_location_level, $_location_father_level_id, &$valueArray, &$nameArray) {
			system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level, $valueArray, $nameArray);
			$objLocationLabel = "Location".$_location_level;
			${"Location".$_location_level} = new $objLocationLabel;
			${"Location".$_location_level}->SetString("location_".$_location_father_level, $_location_father_level_id);
			${"locations".$_location_level} = ${"Location".$_location_level}->retrieveLocationByLocation($_location_father_level);
			if (${"locations".$_location_level}) {
				foreach (${"locations".$_location_level} as $each_location) {
					$numSpaces = array_search($_location_level, $_locations);
					$strSpaces = "";
					if ($numSpaces)
						for ($j=0; $j<=$numSpaces; $j++)
							$strSpaces .= "&nbsp;&nbsp;.&nbsp;";

					$valueArray[] = "location_".$_location_level.":{$each_location["id"]}";
					$nameArray[] = $strSpaces.$each_location["name"];
					if ($_location_child_level)
						build_location_tree ($_locations, $_location_child_level, $each_location['id'], $valueArray, $nameArray);
				}
			}
		}

		if (${"locations".$_location_level}) {
			foreach (${"locations".$_location_level} as $each_location) {
				$valueArray[] = "";
				$nameArray[] = "---------------------------";
				$valueArray[] = "location_".$_location_level.":{$each_location["id"]}";
				$nameArray[] = "&nbsp;".$each_location["name"];

				system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level, $valueArray, $nameArray);
				if ($_location_child_level)
					build_location_tree ($_locations, $_location_child_level, $each_location['id'], $valueArray, $nameArray);
			}
		}

		$locationDropDown = html_selectBox("location", $nameArray, $valueArray, $location, "", "class='input-dd-form-emailgenerate'", system_showText(LANG_LABEL_SELECT_LOCATION));
		unset($valueArray);
		unset($nameArray);
		echo $locationDropDown;
		exit;

	} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
		extract($_POST);

        if ($ajax_action){ //charset fix
            header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
            header("Accept-Encoding: gzip, deflate");
            header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check", FALSE);
            header("Pragma: no-cache");
        }

		if ($ajax_action == "generate_data") {
			$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
			if (!is_dir($exportFilePath)) {
				echo "error";
				exit;
			}

			if (defined(string_strtoupper($item_type)."_LIMIT")) {
				$_POST["item_limit"] = constant(string_strtoupper($item_type)."_LIMIT");
			} else {
				$_POST["item_limit"] = 10000;
			}

			if ($_POST["item_type"] == "Listing") {
				$_POST["fields_excluded"] = "image_id, thumb_id, discount_id, video_snippet, custom_checkbox0, custom_checkbox1, custom_checkbox2, custom_checkbox3, custom_checkbox4, custom_checkbox5, custom_checkbox6, custom_checkbox7, custom_checkbox8, custom_checkbox9, custom_dropdown0, custom_dropdown1, custom_dropdown2, custom_dropdown3, custom_dropdown4, custom_dropdown5, custom_dropdown6, custom_dropdown7, custom_dropdown8, custom_dropdown9, custom_text0, custom_text1, custom_text2, custom_text3, custom_text4, custom_text5, custom_text6, custom_text7, custom_text8, custom_text9, custom_short_desc0, custom_short_desc1, custom_short_desc2, custom_short_desc3, custom_short_desc4, custom_short_desc5, custom_short_desc6, custom_short_desc7, custom_short_desc8, custom_short_desc9, custom_long_desc0, custom_long_desc1, custom_long_desc2, custom_long_desc3, custom_long_desc4, custom_long_desc5, custom_long_desc6, custom_long_desc7, custom_long_desc8, custom_long_desc9, listingtemplate_id, importID";
			} else if ($_POST["item_type"] == "Account") {
				$_POST["fields_excluded"] = "account_id, updated, entered, password, importID, complementary_info";
			} else if ($_POST["item_type"] == "Banner") {
				$_POST["fields_excluded"] = "image_id, discount_id, target_window, expiration_setting";
			} else if ($_POST["item_type"] == "Event" || $_POST["item_type"] == "Classified" || $_POST["item_type"] == "Article") {
				$_POST["fields_excluded"] = "discount_id, image_id, thumb_id";
			} else {
				$_POST["fields_excluded"] = "";
			}

			$_POST["export_from"] = "browser";

			$exportObj = new Export($_POST);
			echo $exportObj->execute();
		} else if ($ajax_action == "schedule_export") {
			$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
			if (!is_dir($exportFilePath)) {
				echo 2;
				exit;
			}

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			$sqlExport = "SELECT finished FROM Control_Export_Listing WHERE type = 'csv - data' AND domain_id = $domain_id";

			$resExport = $dbMain->query($sqlExport);
			$rowExport = mysql_fetch_assoc($resExport);
			if($rowExport["finished"] == "Y"){
				$sqlUpdate =	"UPDATE Control_Export_Listing SET
									last_run_date = NOW(),
									scheduled = 'Y',
									running_cron = 'N',
									finished = 'N',
									filename = '$file_name',
									total_listing_exported = 0,
									last_listing_id = 0
								WHERE type = 'csv - data' AND domain_id = $domain_id";
				$dbMain->query($sqlUpdate);

				if ($dbMain->mysql_error) $return = 2;
				else if (mysql_affected_rows($dbMain->link_id)) $return = 0;
			} else {
				$return = 1;
			}
			echo $return;
		} else if ($ajax_action == "check_progress") {
			$fileName = "export_".str_replace(".zip", "", $file_name).".progress";
			$filePath = EDIRECTORY_ROOT."/custom/domain_$domain_id/export_files/$fileName";
			if (file_exists($filePath)) {
				if (!$handle = fopen($filePath, "r")) {
					$return = "error";
				} else {
					$progress = fgets($handle);
					if (!fclose($handle)) {
						$return = "error";
					} else {
						$last_progress = str_replace("%", "", $last_progress);
						if ($progress < $last_progress) $progress = $last_progress;
						$return = "progress - ".$progress;

					}
				}
			} else {
				$return = "waiting";
			}
			echo $return;
		}
		exit;
	} else if (isset($_GET["download"]) && $_GET["download"]) {
		$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
		$fileName = $exportFilePath."/".$_GET["download"];

		$zipObj = new Zip();
		if ($_GET["action"] != "cron") $_GET["action"] = false;
		if ($zipObj->loadZipFromFile($fileName, $_GET["action"])) {
			$zipObj->sendZip($_GET["download"]);
		}
		exit;
	}

	$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
	$errorExportFolder = false;
	if (!is_dir($exportFilePath)) $errorExportFolder = true;

	/**
	 * Form Defines
	 * Category and Locations DropDown
	 */

	//CATEGORY PROCESS

	$fields = "`id`, `title`";
	$categories = db_getFromDB("listingcategory", "category_id", null, "all", "title", "object", SELECTED_DOMAIN_ID, false, $fields);
	if ($categories) {
		foreach ($categories as $category) {
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
			$valueArray[] = $category->getNumber("id");
			$nameArray[] = $category->getString("title");
			$subcategories = db_getFromDB("listingcategory", "category_id", $category->getNumber("id"), "all", "title", "object", SELECTED_DOMAIN_ID, false, $fields);
			if ($subcategories) {
				foreach ($subcategories as $subcategory) {
					$valueArray[] = $subcategory->getNumber("id");
					$nameArray[] = "&nbsp;&nbsp;&nbsp;".$subcategory->getString("title");
				}
			}
		}
	}
	$valueArray[] = "";
	$nameArray[] = "---------------------------";
	$categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "", "class='input-dd-form-emailgenerate'", system_showText(LANG_LABEL_SELECT_CATEGORY));
	unset($valueArray);
	unset($nameArray);

	/**
	 * Scheduled Listing Export
	 */
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$sqlExport = "SELECT finished, filename FROM Control_Export_Listing WHERE domain_id = ".SELECTED_DOMAIN_ID." AND type= 'csv - data'";
	$resExport = $dbMain->query($sqlExport);
	if(mysql_num_rows($resExport)){
		$export = mysql_fetch_assoc($resExport);
	}

	if($export["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on"){
		$exportFile = $export["filename"];
	}else{
		$exportFile = md5(uniqid(rand(), true)).".zip";
		if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
			$exportedFileName = $export["filename"];
			$exportedFilePath = $exportFilePath."/".$exportedFileName;
			if (!$exportedFileName || !file_exists($exportedFilePath)) {
				$exportedFileName = "";
				$exportedFilePath = "";
			}
		}
	}

	/*
	 * Check if export is running - Listing
	 */
	$sql = "SELECT finished, filename FROM Control_Export_Listing WHERE domain_id = ".SELECTED_DOMAIN_ID." AND type= 'csv'";
	$result = $dbMain->query($sql);
	if (mysql_num_rows($result)) {
		$aux_export_running = mysql_fetch_assoc($result);
		$aux_download_file_name = $aux_export_running["filename"];
	}
	if ($aux_export_running["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on") {
		$exportFileListing = $aux_export_running["filename"];
	} else {
        $exportFileListing = "export_Listing_".md5(uniqid(rand(), true)).".csv";
		if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
			$old_export_file = $aux_export_running["filename"];
		}
	}

    /*
	 * Check if export is running - Event
	 */
    $sql = "SELECT finished, filename FROM Control_Export_Event WHERE domain_id = ".SELECTED_DOMAIN_ID." AND type= 'csv'";
	$result = $dbMain->query($sql);
	if (mysql_num_rows($result)) {
		$aux_export_runningEvent = mysql_fetch_assoc($result);
		$aux_download_file_nameEvent = $aux_export_runningEvent["filename"];
	}
	if ($aux_export_runningEvent["finished"] == "N" && EVENT_SCALABILITY_OPTIMIZATION == "on") {
		$exportFileEvent = $aux_export_runningEvent["filename"];
	} else {
        $exportFileEvent = "export_Event_".md5(uniqid(rand(), true)).".csv";
		if (EVENT_SCALABILITY_OPTIMIZATION == "on") {
			$old_export_fileEvent = $aux_export_runningEvent["filename"];
		}
	}

    /*
     * Download exported files
     */
    $url_redirect = DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/export.php";

    extract($_GET);
    extract($_POST);

    if ($action == "downFile" && $file && $displayName) {
        $filePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/import_files/".$file;
        if (file_exists($filePath)) {
            system_downloadFile($filePath, $displayName, "csv");
        } else {
            $messageStyle = "warning";
            $message = system_showText(LANG_SITEMGR_EXPORT_DOWNLOAD_ERROR);
        }
    } elseif ($action == "deleteFile" && $file) {
        $filePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/import_files/".$file;
        if (@unlink($filePath)) {
            header("Location: ".$url_redirect."?message=1");
            exit;
        } else {
            $messageStyle = "warning";
            $message = system_showText(LANG_SITEMGR_EXPORT_DELETE_ERROR);
        }
    }

    //Success Message
    if ($message == 1) {
        $messageStyle = "success";
        $message = system_showText(LANG_SITEMGR_EXPORT_DELETED);
    }

	$exportFiles = export_getFileList();

    //Export payment
    $type_invoice = "";
	$type_online = "checked";
	if ($_GET["type"]) {
		if ($_GET["type"] == "invoice") {
			$type_invoice = "checked";
			$type_online = "";
		} elseif ($_GET["type"] == "online") {
			$type_online = "checked";
			$type_invoice = "";
		}
	}
?>
