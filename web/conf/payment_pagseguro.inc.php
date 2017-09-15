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
    # * FILE: /conf/payment_pagseguro.inc.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # PAGSEGURO CONSTANTS
    # ----------------------------------------------------------------------------------------------------
    if (PAGSEGUROPAYMENT_FEATURE == "on") {
        $dbObjPayment = db_getDBObject();

        $pagseguro_email = "";
        $pagseguro_token = "";
        $sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAGSEGURO_%'";
        $result = $dbObjPayment->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            if ($row["name"] == "PAGSEGURO_EMAIL") $pagseguro_email = crypt_decrypt($row["value"]);
            if ($row["name"] == "PAGSEGURO_TOKEN") $pagseguro_token = crypt_decrypt($row["value"]);
        }
        define(PAGSEGURO_EMAIL, $pagseguro_email);
        define(PAGSEGURO_TOKEN, $pagseguro_token);
        
        define(PAGSEGURO_CURRENCY, PAYMENT_CURRENCY);
        unset($dbObjPayment);
    }

?>