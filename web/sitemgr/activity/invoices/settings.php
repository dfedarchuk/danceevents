<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/invoices/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	if (isset($_GET["domain_id"])) define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
	if (isset($_POST["domain_id"])) define("SELECTED_DOMAIN_ID", $_POST["domain_id"]);
    include("../../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();
    
    extract($_GET);
    extract($_POST);
    
    if ($id) {
		$invoiceObj = new Invoice($id);
        if (!$invoiceObj->getNumber("id") || $invoiceObj->getString("status") == "R") {
            echo "error";
            exit;
        }
	} else {
		echo "error";
        exit;
	}
    
    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (validate_form("invoicesettings", $_POST, $message_invoicesettings)) {

			if ($status) {
				$invoiceObj->setString("status", $status);
				$invoiceObj->Save();
			}

			if ($status == "R") {
                payment_receiveInvoice($invoiceObj);
			}

			echo 1;
            exit;

		} else {
            echo $message_invoicesettings;
            exit;
        }

	}
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$invoiceStatusObj = new InvoiceStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $invoiceStatusObj->getValues();
	$arrayName = $invoiceStatusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $invoiceObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");
    
    include(INCLUDES_DIR."/forms/form-invoicesettings.php");
    
?>
    