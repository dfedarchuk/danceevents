<?php

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
    # * FILE: /ordercalculateprice.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("./conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------

    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", FALSE);
    header("Pragma: no-cache");

    $return = 0;

    $item = $_GET["item"];
    $itemID = $_GET["item_id"];

    if ($item) {

        switch ($item) {
            case "listing":
                $itemObj = new Listing();
                break;
            case "event":
                $itemObj = new Event();
                break;
            case "banner":
                $itemObj = new Banner();
                break;
            case "classified":
                $itemObj = new Classified();
                break;
            case "article":
                $itemObj = new Article();
                break;
        }

        if ($itemObj) {

            if ($item == "banner") {
                $_SESSION["fb_{$item}_level_{$itemID}"]					= $_GET["type"];
                $_SESSION["fb_{$item}_expiration_setting_{$itemID}"]	= $_GET["expiration_setting"];
                $_SESSION["fb_{$item}_unpaid_impressions_{$itemID}"]	= $_GET["unpaid_impressions"];
                $_SESSION["fb_{$item}_caption_{$itemID}"]               = $_GET["caption"];

                $_SESSION["go_{$item}_level_{$itemID}"]					= $_GET["type"];
                $_SESSION["go_{$item}_expiration_setting_{$itemID}"]	= $_GET["expiration_setting"];
                $_SESSION["go_{$item}_unpaid_impressions_{$itemID}"]	= $_GET["unpaid_impressions"];
                $_SESSION["go_{$item}_caption_{$itemID}"]               = $_GET["caption"];

                $itemObj->setString("type", $_GET["type"]);
                $itemObj->setString("expiration_setting", $_GET["expiration_setting"]);
                $itemObj->setString("unpaid_impressions", $_GET["unpaid_impressions"]);
            } else {
                $_SESSION["fb_{$item}_level_{$itemID}"]					= $_GET["level"];
                $_SESSION["fb_{$item}_title_{$itemID}"]					= $_GET["title"];
                $_SESSION["fb_{$item}_package_id_{$itemID}"]            = $_GET["package_id"];

                $_SESSION["go_{$item}_level_{$itemID}"]					= $_GET["level"];
                $_SESSION["go_{$item}_title_{$itemID}"]					= $_GET["title"];
                $_SESSION["go_{$item}_package_id_{$itemID}"]            = $_GET["package_id"];

                $itemObj->setString("level", $_GET["level"]);
            }

            if ($item == "listing") {
                if (strpos($_GET["categories"], "x") === false) {
    //					if ($_GET["categories"] <= MAX_CATEGORY_ALLOWED) {
                    $itemObj->setString("categories",$_GET["categories"]);
    //					}
                }

                $_SESSION["fb_{$item}_template_id_{$itemID}"]			= $_GET["listingtemplate_id"];
                $_SESSION["fb_{$item}_return_categories_{$itemID}"]		= $_GET["return_categories"];

                $_SESSION["go_{$item}_template_id_{$itemID}"]			= $_GET["listingtemplate_id"];
                $_SESSION["go_{$item}_return_categories_{$itemID}"]		= $_GET["return_categories"];

                $itemObj->setString("listingtemplate_id", $_GET["listingtemplate_id"]);

            } elseif ($item == "event") {

                $_SESSION["fb_{$item}_start_date_{$itemID}"]            = $_GET["start_date"];
                $_SESSION["fb_{$item}_end_date_{$itemID}"]              = $_GET["end_date"];

                $_SESSION["go_{$item}_start_date_{$itemID}"]			= $_GET["start_date"];
                $_SESSION["go_{$item}_end_date_{$itemID}"]              = $_GET["end_date"];

            }

            $_SESSION["fb_{$item}_discount_id_{$itemID}"]			= $_GET["discount_id"];
            $_SESSION["go_{$item}_discount_id_{$itemID}"]			= $_GET["discount_id"];

            $itemObj->setString("discount_id", $_GET["discount_id"]);

            setting_get("payment_tax_status", $payment_tax_status);
            setting_get("payment_tax_value", $payment_tax_value);

            if ($payment_tax_status == "on") {
                $return = format_money($itemObj->getPrice($_GET["renewal_period"]));
                $subtotal = $return * 100;
                $tax = payment_calculateTax($return, $payment_tax_value, true, false) * 100;
                $total = payment_calculateTax($return, $payment_tax_value, true) * 100;

                if ($subtotal < 1) $subtotal = "0";
                elseif ($subtotal < 10) $subtotal = "00".$subtotal;
                elseif ($subtotal < 100) $subtotal = "0".$subtotal;

                if ($tax < 1) $tax = "0";
                elseif ($tax < 10) $tax = "00".$tax;
                elseif ($tax < 100) $tax = "0".$tax;


                if ($total < 1) $total = "0";
                elseif ($total < 10) $total = "00".$total;
                elseif ($total < 100) $total = "0".$total;

                $return = $subtotal."|".$tax."|".$total;
            } else {
                $return = format_money($itemObj->getPrice($_GET["renewal_period"])) * 100;
                if ($return < 1) $return = "0";
                elseif ($return < 10) $return = "00".$return;
                elseif ($return < 100) $return = "0".$return;
            }

            $_SESSION["order_renewal_period"]	= $_GET["renewal_period"];

        }

    }

    echo $return;