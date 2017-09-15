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
	# * FILE: /functions/payment_funct.php
	# ----------------------------------------------------------------------------------------------------

	function payment_getPricing($item, $level, $levelValue, $separator = "/") {
        $pricingMonthly = $level->getPrice($levelValue);

        if ($item == "banner") {
            $pricingYearly = $level->getPrice($levelValue, BANNER_EXPIRATION_RENEWAL_DATE, "yearly");
        } else {
            $pricingYearly = $level->getPrice($levelValue, "yearly");
        }
        
        $pricingInfo["monthly"] = $pricingMonthly;
        $pricingInfo["yearly"] = $pricingYearly;
        if ($pricingMonthly > 0 || $pricingYearly > 0) {
            $pricingInfo["main_price"] = ($pricingMonthly > 0 ? $pricingMonthly : $pricingYearly);
            $pricingInfo["renewal_period"] = ($pricingMonthly > 0 && $pricingYearly <= 0 ? "monthly" : "yearly");
            $pricingInfo["renewal_label"] = " ".$separator." ".($pricingMonthly > 0 && $pricingYearly > 0 ? system_showText(LANG_MONTH) : ($pricingMonthly > 0 ? system_showText(LANG_MONTH) : ($pricingYearly > 0 ? system_showText(LANG_YEAR) : "")));
            $pricingInfo["renewal_sub"] = ($pricingMonthly > 0 && $pricingYearly > 0 ? system_showText(LANG_OR)." ".CURRENCY_SYMBOL.$pricingYearly." ".$separator." ".LANG_YEAR : "");
        } else {
            $pricingInfo["main_price"] = system_showText(LANG_FREE);
            $pricingInfo["renewal_label"] = "";
            $pricingInfo["renewal_sub"] = "";
        }

        return $pricingInfo;
    }
	
	function payment_writeSettingPaymentFile($array_PaymentSetting) {
			
		$filePath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/payment/payment.inc.php';
		
		if (!$file = fopen($filePath, 'w+')) {
			return false;
		}
		
		$buffer = "<?php".PHP_EOL;
		
		$buffer .= "\$payment_paypalStatus = \"".$array_PaymentSetting['payment_paypalStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_paypalapiStatus = \"".$array_PaymentSetting['payment_paypalapiStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_payflowStatus = \"".$array_PaymentSetting['payment_payflowStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_twocheckoutStatus = \"".$array_PaymentSetting['payment_twocheckoutStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_worldpayStatus = \"".$array_PaymentSetting['payment_worldpayStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_authorizeStatus = \"".$array_PaymentSetting['payment_authorizeStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_pagseguroStatus = \"".$array_PaymentSetting['payment_pagseguroStatus']."\";".PHP_EOL;
        $buffer .= "\$payment_stripeStatus = \"".$array_PaymentSetting['payment_stripeStatus']."\";".PHP_EOL.PHP_EOL;
        $buffer .= "\$payment_recurring = \"".$array_PaymentSetting['payment_recurring']."\";".PHP_EOL;
		$buffer .= "# ****************************************************************************************************".PHP_EOL;
		$buffer .= "# CUSTOMIZATIONS".PHP_EOL;
		$buffer .= "# NOTE: The \$payment_currency in this file is only for the domain ".SELECTED_DOMAIN_ID."".PHP_EOL;
		$buffer .= "# Any changes will require an update in the table \"Setting_Payment\"".PHP_EOL;
		$buffer .= "# to set the property \"PAYMENT_CURRENCY\" with the value bellow on the domain ".SELECTED_DOMAIN_ID." database.".PHP_EOL;
		$buffer .= "# ****************************************************************************************************".PHP_EOL;
		$buffer .= "\$payment_currency = \"".$array_PaymentSetting['payment_currency']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "\$currency_symbol = \"".$array_PaymentSetting['currency_symbol']."\";".PHP_EOL;
		$buffer .= "\$invoice_payment = \"".$array_PaymentSetting['invoice_payment']."\";".PHP_EOL;
		$buffer .= "\$manual_payment = \"".$array_PaymentSetting['manual_payment']."\";".PHP_EOL;
		
		$return_payment = fwrite($file, $buffer, strlen($buffer));
		
		fclose($file);
		
		return $return_payment;
	
	}

	function payment_calculateTax ($price, $tax, $formatValue = true, $amount = true) {
		if ($amount) {
			$value = ($price * (1 + $tax / 100));
			if ($formatValue) return format_money($value);
			else return $value;
		} else {
			$value = (($price * (1 + $tax / 100)) - $price);
			if ($formatValue) return format_money($value);
			else return $value;
		}
	}

	function payment_taxToPercentage ($tax_value, $total_value) {
        if ($total_value > 0) {
            $value = (($tax_value * 100) / $total_value);
            return $value;
        } else {
            return 0;
        }
	}
    
    function payment_receiveInvoice($invoiceObj){

        /*
         * Update invoice payment date
         */
        $invoiceObj->setString("payment_date", date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s"));
        $invoiceObj->Save(true);

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

        /*
         * Get items paid by the invoice to renew them
         */
        $itemStatus = new ItemStatus();
        $modules = ["listing", "event", "classified", "article", "banner"];

        foreach ($modules as $module) {

            $sql = "SELECT {$module}_id, renewal_period FROM Invoice_".ucfirst($module)." WHERE invoice_id = ".$invoiceObj->getString("id");
            $r = $db->query($sql);

            if (mysql_num_rows($r) > 0) {

                while ($row = mysql_fetch_assoc($r)) {

                    $itemClass = ucfirst($module);
                    $renewal_period = strtoupper(substr($row["renewal_period"], 0, 1));
                    setting_get("{$module}_approve_paid", $item_approve_paid);
                    $itemObj = new $itemClass($row["{$module}_id"]);

                    if ($module == "banner" && $itemObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) {

                        if ($item_approve_paid) {
                            $sql = "UPDATE Banner set impressions = impressions + " . $itemObj->getNumber("unpaid_impressions") . ", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = " . $itemObj->getNumber("id");
                        } else {
                            $sql = "UPDATE Banner set impressions = impressions + " . $itemObj->getNumber("unpaid_impressions") . ", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = " . $itemObj->getNumber("id");
                        }
                        $db->query($sql);

                    } else {

                        $sql = "UPDATE Invoice_" . ucfirst($module) . " SET renewal_date = '" . $itemObj->getNextRenewalDate(1, $renewal_period) . "' WHERE invoice_id = " . $invoiceObj->getString("id") . " AND {$module}_id = " . $itemObj->getString("id");
                        $db->query($sql);

                        $itemObj->setString("renewal_date", $itemObj->getNextRenewalDate(1, $renewal_period));

                        if ($item_approve_paid) {
                            $itemObj->setString("status", $itemStatus->getDefaultStatus());
                        } else {
                            $itemObj->setString("status", "A");
                        }

                        $itemObj->Save();
                    }
                }
            }

        }

        $sql = "SELECT custom_invoice_id, tax FROM Invoice_CustomInvoice WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while ($row = mysql_fetch_assoc($r)) {
            $custominvoice_ids[] = $row["custom_invoice_id"];
            $custominvoice_tax[] = $row["tax"];
        }

        if ($custominvoice_ids) {
            $k = 0;
            foreach ($custominvoice_ids as $each_custominvoice_id) $customInvoices[] = new CustomInvoice($each_custominvoice_id);

            if ($customInvoices) foreach ($customInvoices as $customInvoice) {

                $customInvoice->setString("paid", "y");

                $taxT = $custominvoice_tax[$k];
                $tax = payment_calculateTax($customInvoice->getNumber("subtotal"),$taxT,true,false);
                $k++;

                $customInvoice->setNumber("tax", $taxT);
                $customInvoice->setNumber("amount", $customInvoice->getNumber("subtotal") + $tax);
                $customInvoice->Save();
            }
        }

        $sql = "SELECT package_id, renewal_period FROM Invoice_Package WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while ($row = mysql_fetch_assoc($r)) {
            $package_id = $row["package_id"];
            $renewal_period = strtoupper(substr($row["renewal_period"], 0, 1));
        }

        if ($package_id) {

            $sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".SELECTED_DOMAIN_ID." AND package_id = ".$package_id." AND account_id = ".$invoiceObj->getString("account_id");
            $r = $dbMain->query($sql);
            $i = 0;
            while ($row = mysql_fetch_assoc($r)) {
                $itemsInfo[$i]["module_id"] = $row["module_id"];
                $itemsInfo[$i]["module"] = $row["module"];
                $itemsInfo[$i]["domain_id"] = $row["domain_id"];
                $i++;
            }

            foreach ($itemsInfo as $item) {
                if ($item["module"] != "custom_package") {
                    $className = ucfirst($item["module"]);
                    $item_id = $item["module_id"];
                    $domain_idItem = $item["domain_id"];

                    $itemObj = new $className($item_id);

                    $itemStatus = new ItemStatus();

                    setting_get($item["module"]."_approve_paid", $item_approve_paid);

                    if ($item_approve_paid) {
                        $stritemStatus = $itemStatus->getDefaultStatus();
                    } else {
                        $stritemStatus = "A";
                    }

                    $sql = "UPDATE $className SET status = ".db_formatString($stritemStatus).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate(1, $renewal_period))." WHERE id = ".$item_id;
                    $dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
                    $dbItem->query($sql);
                }

            }

        }
    }