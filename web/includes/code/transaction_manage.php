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
	# * FILE: /includes/code/transacton_manage.php
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        /*
        * Need to check if $bulkSubmit is equal to "Submit" or LANG_SITEMGR_SUBMIT to fix an IE7 bug
        */
        if ($hiddenValue == "Submit" || $bulkSubmit == "Submit" || $bulkSubmit == LANG_SITEMGR_SUBMIT) { //Bulk update

            if (string_strpos($_SERVER["PHP_SELF"], "transactions")) {
                $typeName = "PaymentLog";
                $page = "transactions";
                $fieldName = "transaction";
            } elseif (string_strpos($_SERVER["PHP_SELF"], "custominvoices")) {
                $typeName = "CustomInvoice";
                $page = "custominvoices";
                $fieldName = "custominvoice";
            } elseif (string_strpos($_SERVER["PHP_SELF"], "invoices")) {
                $typeName = "Invoice";
                $page = "invoices";
                $fieldName = "invoice";
            }

            $ids = $_POST[string_strtolower($fieldName)."_id"];
            $error_message = "";

            if ($ids) {
                if ($delete_all == "on") {
                    foreach ($ids as $id) {
                        $itemObj = new $typeName($id);
                        $itemObj->delete();
                    }
                    $success_delete = true;
                } else {
                    $error_message = 1;
                }
                
                if ($error_message) {
                    unset($msg);
                    unset($message);
                } else {
                    if ($success_delete) {
                        $msgURL = "successdel";
                    } else {
                        $msgURL = "success";
                    }
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/$page/index.php?msg=$msgURL&letter=$letter&screen=$screen");
                    exit;
                }
                
            } else {
                if ($delete_all) {
                    $error_message = 2;
                } else {
                    $error_message = 4;
                }
            }
		
            
        } elseif ($action == "delete" && $id) { //Delete
            if (string_strpos($_SERVER["PHP_SELF"], "transactions")) {
                $itemObj = new PaymentLog($id);
            } elseif (string_strpos($_SERVER["PHP_SELF"], "/invoices")) {
                $itemObj = new Invoice($id);
            } elseif (string_strpos($_SERVER["PHP_SELF"], "custominvoices")) {
                $itemObj = new CustomInvoice($id);
            }
            $itemObj->delete();
            
            header("Location: $url_redirect/index.php?msg=1&screen=$screen".($url_search_params ? "&$url_search_params" : ""));
            exit;
        }
    } else {
        
        unset($sql_where);
        
        //Search transactions
        if (string_strpos($_SERVER["PHP_SELF"], "transactions")) {
        
            //Search
            if ($search_id)           $sql_where[] = " transaction_id = ".db_formatString($search_id)." ";

            if ($search_account_id)   $sql_where[] = " account_id = $search_account_id ";

            // Payment System ////////////
            if (isset($search_system) && string_strlen(trim($search_system)) > 2) {
                $sql_where[] = " system_type  LIKE ".db_formatString($search_system);
            }

            // Ammount Range ////////////
            if (isset($search_amount_range1) && $search_amount_range1 != "" &&
                isset($search_amount_range2) && $search_amount_range2 != "") {
                if (doubleval($search_amount_range2) < doubleval($search_amount_range1)) {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_AMOUNTRANGE);
                }
            }

            if (isset($search_amount_range1) && $search_amount_range1 != "") {
                $search_amount_range1 = doubleval($search_amount_range1);
                if (is_double($search_amount_range1)) {
                    $sql_where[] = " transaction_amount  >= ".doubleval($search_amount_range1);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTAMOUNT);
                    $sql_where[] = " false ";
                }
            }

            if (isset($search_amount_range2) && $search_amount_range2 != "") {
                $search_amount_range2 = doubleval($search_amount_range2);
                if (is_double($search_amount_range2)) {
                    $sql_where[] = " transaction_amount  <= ".doubleval($search_amount_range2);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDAMOUNT);
                    $sql_where[]   = " false ";
                }
            }

            // Date Range ////////////
            if ((isset($search_date_range1) && $search_date_range1 != "") && (isset($search_date_range2) && $search_date_range2 != "")) {
                if (validate_date($search_date_range1) && validate_date($search_date_range2)) {
                    if (!validate_date_interval($search_date_range1, $search_date_range2) && ($search_date_range1 != $search_date_range2)) {
                        $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
                        $sql_where[]   = " false ";
                    }
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
                    $sql_where[]   = " false ";
                }
            }

            if (isset($search_date_range1) && $search_date_range1 != "") {
                if (validate_date($search_date_range1)) {
                    $sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') >= ".db_formatDate($search_date_range1);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
                    $sql_where[] = " false ";
                }
            }

            if (isset($search_date_range2) && $search_date_range2 != "") {
                if (validate_date($search_date_range2)) {
                    $sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') <= ".db_formatDate($search_date_range2);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
                    $sql_where[] = " false ";
                }
            }

            if ((isset($search_date_range1) && $search_date_range1 != "") || (isset($search_date_range2) && $search_date_range2 != "")) {
                $sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') != '0000-00-00' ";
            }

            if ($search_discount_code) {

                $arrayDiscount_id = array();
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

                //Payment_Article_Log
                $query = "SELECT payment_log_id FROM Payment_Article_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['payment_log_id']);
                }

                //Payment_Banner_Log
                $query = "SELECT payment_log_id FROM Payment_Banner_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['payment_log_id']);
                }

                //Payment_Classified_Log
                $query = "SELECT payment_log_id FROM Payment_Classified_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['payment_log_id']);
                }

                //Payment_Event_Log
                $query = "SELECT payment_log_id FROM Payment_Event_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['payment_log_id']);
                }

                //Payment_Listing_Log
                $query = "SELECT payment_log_id FROM Payment_Listing_Log WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['payment_log_id']);
                }

                if ($arrayDiscount_id) {
                    $sql_where[] = " id IN(".implode(", ", $arrayDiscount_id).") ";
                } else {
                    $sql_where[] = " id = ".db_formatString($search_discount_code);
                }

            }

            $sql_where[] = " hidden = 'n' ";

            if ($sql_where)  $where = " ".implode(" AND ", $sql_where)." ";
        
        //Search invoices
        } elseif (string_strpos($_SERVER["PHP_SELF"], "/invoices")) {
            
            if ($search_id)                       $sql_where[] = " id = ".db_formatString($search_id)." ";
            if ($search_account_id)               $sql_where[] = " account_id = $search_account_id ";
            if ($search_status)                   $sql_where[] = " status = '$search_status' ";

            // Ammount Range ////////////

            if (isset($search_amount_range1) && $search_amount_range1 != "" &&
                isset($search_amount_range2) && $search_amount_range2 != "") {
                if (doubleval($search_amount_range2) < doubleval($search_amount_range1)) {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_AMOUNTRANGE);
                }
            }

            if (isset($search_amount_range1) && $search_amount_range1 != "") {
                $search_amount_range1 = doubleval($search_amount_range1);
                if (is_double($search_amount_range1)) {
                    $sql_where[] = " amount  >= ".doubleval($search_amount_range1);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTAMOUNT);
                    $sql_where[] = " false ";
                }
            }

            if (isset($search_amount_range2) && $search_amount_range2 != "") {
                $search_amount_range2 = doubleval($search_amount_range2);
                if (is_double($search_amount_range2)) {
                    $sql_where[] = " amount  <= ".doubleval($search_amount_range2);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDAMOUNT);
                    $sql_where[]   = " false ";
                }
            }

            // Date Range ////////////

            if (isset($search_date_range1) && $search_date_range1 != "") {
                if (validate_date($search_date_range1)) {
                    $sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') >= ".db_formatDate($search_date_range1);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
                    $sql_where[] = " false ";
                }
            }

            if (isset($search_date_range2) && $search_date_range2 != "") {
                if (validate_date($search_date_range2)) {
                    $sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') <= ".db_formatDate($search_date_range2);
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
                    $sql_where[] = " false ";
                }
            }

            if ((isset($search_date_range1) && $search_date_range1 != "") && (isset($search_date_range2) && $search_date_range2 != "")) {
                if (validate_date($search_date_range1) && validate_date($search_date_range2)) {
                    if (!validate_date_interval($search_date_range1, $search_date_range2) && ($search_date_range1 != $search_date_range2)) {
                        $error_message = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
                        $sql_where[]   = " false ";
                    }
                } else {
                    $error_message = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
                    $sql_where[]   = " false ";
                }
            }

            if ((isset($search_date_range1) && $search_date_range1 != "") || (isset($search_date_range2) && $search_date_range2 != "")) {
                $sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') != '0000-00-00' ";
            }

            // Expiration Date
            if (isset($search_expiration_date) && $search_expiration_date != "") {
                if (validate_isFutureDate($search_expiration_date)) {
                    if ($search_opt_expiration_date == 1) {
                        $sql_where[] = " DATE(expire_date) = ".db_formatDate($search_expiration_date);
                    } else if ($search_opt_expiration_date == 2) {
                        $sql_where[] = " (DATE(expire_date) >= NOW() AND TO_DAYS(DATE(expire_date)) <= TO_DAYS(".db_formatDate($search_expiration_date)."))";
                    }
                } else {
                    $error_message = system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATE_INFUTURE);
                    $sql_where[] = " false ";
                }
            }

            if ($search_discount_code) {

                $arrayDiscount_id = array();
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

                //Invoice_Article
                $query = "SELECT invoice_id FROM Invoice_Article WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['invoice_id']);
                }

                //Invoice_Banner
                $query = "SELECT invoice_id FROM Invoice_Banner WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['invoice_id']);
                }

                //Invoice_Classified
                $query = "SELECT invoice_id FROM Invoice_Classified WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['invoice_id']);
                }

                //Invoice_Event
                $query = "SELECT invoice_id FROM Invoice_Event WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['invoice_id']);
                }

                //Invoice_Listing
                $query = "SELECT invoice_id FROM Invoice_Listing WHERE discount_id = ".db_formatString($search_discount_code).";";
                $result = $db->query($query);
                while($row = mysql_fetch_assoc($result)) {
                    array_push($arrayDiscount_id, $row['invoice_id']);
                }

                if ($arrayDiscount_id) {
                    $sql_where[] = " id IN(".implode(", ", $arrayDiscount_id).") ";
                } else { 
                    $sql_where[] = " id = ".db_formatString($search_discount_code);
                }

            }

            $sql_where[] = " hidden = 'n' ";
            if (is_object($invoiceStatusObj) && $invoiceStatusObj->getDefault()) {
                $sql_where[] = " status != '".$invoiceStatusObj->getDefault()."' ";
            }
            if ($sql_where) {
                $where = " ".implode(" AND ", $sql_where)." ";
            }
            
        } elseif (string_strpos($_SERVER["PHP_SELF"], "custominvoices")) {
            
            if ($search_id) {
                $sql_where[] = " id = ".db_formatString($search_id)." ";
            }
            
            if ($search_account_id) {
                $sql_where[] = " account_id = $search_account_id ";
            }
            if ($search_status) {
                if ($search_status == "paid") {
                    $sql_where[] = " paid = 'y' ";
                } elseif ($search_status == "sent") {
                    $sql_where[] = " sent = 'y' ";
                    $sql_where[] = " paid != 'y' ";
                } elseif($search_status == "pending") {
                    $sql_where[] = " paid != 'y' ";
                    $sql_where[] = " sent != 'y' ";
                }
            }
            
            if (!$search_date_from && $search_date_to) {
                if (validate_date($search_date_to)) {
                    $sql_where[] = " (date <= (".db_formatDate($search_date_to)."))";
                } else {
                    $error = true;
                    $message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
                }
            }

            if ($search_date_from && !$search_date_to) {
                if (validate_date($search_date_from)) {
                    $sql_where[] = " (date >= (".db_formatDate($search_date_from)."))";
                } else {
                    $error = true;
                    $message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
                }
            }

            if ($search_date_from && $search_date_to) {
                if (validate_date($search_date_from) && validate_date($search_date_to)) {
                    //formating dates
                    $search_from = db_formatDate($search_date_from);
                    $search_to = db_formatDate($search_date_to);
                    $sql_where[] = " SUBSTRING(date,1,10) BETWEEN $search_from AND $search_to ";
                } else {
                    $error = true;
                    $message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
                }
            }
            
            if ($search_title) {
                $sql_where[] = " title LIKE '%".addslashes($search_title)."%' ";
            }

            if ($sql_where) {
                $where .= " ".implode(" AND ", $sql_where)." ";
            }
            
        }
    }

?>