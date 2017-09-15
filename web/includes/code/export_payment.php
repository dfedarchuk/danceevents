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
	# * FILE: /includes/code/export_payment.php
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
	}
?>