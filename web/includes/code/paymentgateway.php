<?
    /* ==================================================================*\
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
      \*================================================================== */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/code/paymentgateway.php
    # ----------------------------------------------------------------------------------------------------

    require_once(CLASSES_DIR."/class_StripeInterface.php");

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    extract( $_POST );
    extract( $_GET );

    $dbMain = db_getDBObject( DEFAULT_DB, true );
    $dbObj  = db_getDBObjectByDomainID( SELECTED_DOMAIN_ID, $dbMain );

    /**
     * Loads info from the database table Setting_payment
     * @param string $name The 'name' field to be returned
     * @param mysql $dbObj
     * @return string
     */
    function getPaymentSetting( $name, $dbObj )
    {
        $variable = null;

        $query = "SELECT * FROM Setting_Payment WHERE name LIKE '$name' LIMIT 1";
		$result = $dbObj->query( $query );

        if( $row = mysql_fetch_assoc($result) )
        {
			$variable = $row["value"];
        }

        return $variable;
    }

    /**
     * Executes a query to set an entry in the Setting_Payment table.
     * @param string $name the NAME field to be changed
     * @param string $value the VALUE to be set
     * @return boolean Will return true if the query was successful.
     */
    function setPaymentSetting( $name, $value)
    {
        $dbMain = db_getDBObject( DEFAULT_DB, true );
        $dbObj  = db_getDBObjectByDomainID( SELECTED_DOMAIN_ID, $dbMain );

        $query  = "INSERT INTO Setting_Payment ( name, value ) VALUES ( '$name', '$value' ) ON DUPLICATE KEY UPDATE value ='$value'";
        $return = $dbObj->query( $query );
        return $return;
    }

    /**
     * This function converts data into an older format to allow
     * old functions to work. Yeah, we are looking at YOU, system_updateFormFields()
     * @param array $data an array containing the option's table names as keys and an array with each level associated with their values as value
     * @return array the modified array which will be fed into system_updateFormFields()
     */
    function createItemLevelArray( $data )
    {
        foreach ( $data as $key => $value )
        {
            /* On images we have a special case.
             * If the user sets zero images for a level, the level has no main image and no gallery
             * If the user sets one or more images, one image will be the main image and the rest will
             * be allocated in a gallery
             */
            if( $key == "images" )
            {
                foreach( $value as $level => &$amount )
                {
                    $amount = max( array( $amount, 0 ) );

                    if( $amount > 0 )
                    {
                        $amount--;
                        $data["itemLevel_main_image"][$level] = true;
                    }
                }
            }


            $data["itemLevel_{$key}"] = $value;
            unset( $data[$key] );
        }

        return $data;
    }

    /**
     * Treats and validates all information regarding Payment gateways and perform
     * the necessary database changes. Also makes coffee.
     * @todo This should be moved into a class of its own along with its auxiliary functions, person of the future.
     * @param mysql $dbObj
     */
    function handleGatewayPost( $dbObj )
    {

        $recurring = $_POST['gateway']['recurring'];
        setPaymentSetting( "RECURRING", $recurring ? "on" : "off" );

        $gateway_config = array();
        // creating array to append in gateway file
        $gateway_config += array(
            'recurring' => ($recurring ? "on" : "off")
        );

        foreach ( $_POST['gateway'] as $gateway => $formData )
        {
            switch ( $gateway )
            {
                case "stripe":
                    $enabled   = ( $formData['payment_stripeStatus'] == "on" ? "on" : "off" );
                    $stripe_apikey   = crypt_encrypt( trim( $formData['stripe_apikey'] ) );

                    if ( $enabled == "on" && !$stripe_apikey )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_STRIPE) );
                    }
                    else
                    {
                        setPaymentSetting( "STRIPE_STATUS", $enabled );
                        setPaymentSetting( "STRIPE_APIKEY", $stripe_apikey );

                        if ($enabled == "on") {
                            //Create plans
                            setting_get("stripe_planscreated", $stripe_planscreated);

                            if (!$stripe_planscreated) {
                                $response = StripeInterface::StripeRequest("createplans", $formData['stripe_apikey']);
                            }

                            if (strlen($response)) {
                                MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_STRIPE_PLANS) );
                            }

                            //Create discount codes
                            setting_get("stripe_couponscreated", $stripe_couponscreated);

                            if (!$stripe_couponscreated) {
                                $response = StripeInterface::StripeRequest("createcoupons", $formData['stripe_apikey']);
                            }

                            if (strlen($response)) {
                                MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_STRIPE_COUPONS) );
                            }

                        }
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'stripe.status' => $enabled,
                        'stripe.apikey' => $stripe_apikey
                    );

                    break;
                case "paypal":
                    $enabled   = ( $formData['payment_paypalStatus'] == "on" ? "on" : "off" );
                    $account   = crypt_encrypt( trim( $formData['paypal_account'] ) );

                    if ( $enabled == "on" && !$account )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_PAYPAL) );
                    }
                    else
                    {
                        setPaymentSetting( "PAYPAL_STATUS", $enabled );
                        setPaymentSetting( "PAYPAL_ACCOUNT", $account );
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'paypal.status' => $enabled,
                        'paypal.account' => $account
                    );

                    break;
                case "paypalAPI":
                    $enabled   = ( $formData['payment_paypalapiStatus'] == "on" ? "on" : "off" );
                    $username  = crypt_encrypt( trim( $formData['paypalapi_username'] ) );
                    $password  = crypt_encrypt( trim( $formData['paypalapi_password'] ) );
                    $signature = crypt_encrypt( trim( $formData['paypalapi_signature'] ) );

                    if ( $enabled == "on" && (!$username || !$password || !$signature ) )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_PAYPALAPI) );
                    }
                    else
                    {
                        setPaymentSetting( "PAYPALAPI_STATUS", $enabled );
                        setPaymentSetting( "PAYPALAPI_USERNAME", $username );
                        setPaymentSetting( "PAYPALAPI_PASSWORD", $password );
                        setPaymentSetting( "PAYPALAPI_SIGNATURE", $signature );
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'paypalapi.status' => $enabled,
                        'paypalapi.username' => $username,
                        'paypalapi.password' => $password,
                        'paypalapi.signature' => $signature,
                    );

                    break;
                case "pagseguro":
                    $enabled = ( $formData['payment_pagseguroStatus'] == "on" ? "on" : "off" );
                    $email   = crypt_encrypt( trim( $formData['pagseguro_email'] ) );
                    $token   = crypt_encrypt( trim( $formData['pagseguro_token'] ) );

                    $payment_currency = getPaymentSetting( "PAYMENT_CURRENCY", $dbObj );

                    if ( $enabled == "on" && (!$email || !$token ) )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_PAGSEGURO) );
                    }
                    else if ( $enabled == "on" && $payment_currency != "BRL" )
                    {
                        MessageHandler::registerError( LANG_MSG_CURRENCY_PAGSEGURO );
                    }
                    else
                    {
                        setPaymentSetting( "PAGSEGURO_STATUS", $enabled );
                        setPaymentSetting( "PAGSEGURO_EMAIL", $email );
                        setPaymentSetting( "PAGSEGURO_TOKEN", $token );
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'pagseguro.status' => $enabled,
                        'pagseguro.email' => $email,
                        'pagseguro.token' => $token,
                    );

                    break;
                case "twoCheckout":
                    $enabled = ( $formData['payment_twocheckoutStatus'] == "on" ? "on" : "off" );
                    $login   = crypt_encrypt( trim( $formData['twocheckout_login'] ) );

                    if ( $enabled == "on" && !$login )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_TWOCHECKOUT) );
                    }
                    else
                    {
                        setPaymentSetting( "TWOCHECKOUT_STATUS", $enabled );
                        setPaymentSetting( "TWOCHECKOUT_LOGIN", $login );
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'twocheckout.status' => $enabled,
                        'twocheckout.login' => $login,
                    );

                    break;
                case "authorize":
                    $enabled        = ( $formData['payment_authorizeStatus'] == "on" ? "on" : "off" );
                    $login          = crypt_encrypt( trim( $formData['authorize_login'] ) );
                    $transactionKey = crypt_encrypt( trim( $formData['authorize_txnkey'] ) );

                    if ( $enabled == "on" && (!$login || !$transactionKey ) )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_AUTHORIZE) );
                    }
                    else
                    {
                        setPaymentSetting( "AUTHORIZE_STATUS", $enabled );
                        setPaymentSetting( "AUTHORIZE_LOGIN", $login );
                        setPaymentSetting( "AUTHORIZE_TXNKEY", $transactionKey );
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'authorize.status' => $enabled,
                        'authorize.login' => $login,
                        'authorize.txnkey' => $transactionKey
                    );

                    break;
                case "payflow":
                    $enabled = ( $formData['payment_payflowStatus'] == "on" ? "on" : "off" );
                    $login   = crypt_encrypt( trim( $formData['payflow_login'] ) );
                    $partner = crypt_encrypt( trim( $formData['payflow_partner'] ) );

                    if ( $enabled == "on" && (!$login || !$partner ) )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_PAYFLOW) );
                    }
                    else
                    {
                        setPaymentSetting( "PAYFLOW_STATUS", $enabled );
                        setPaymentSetting( "PAYFLOW_LOGIN", $login );
                        setPaymentSetting( "PAYFLOW_PARTNER", $partner );
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'payflow.status' => $enabled,
                        'payflow.login' => $login,
                        'payflow.partner' => $partner,
                    );

                    break;
                case "worldpay":
                    $enabled   = ( $formData['payment_worldpayStatus'] == "on" ? "on" : "off" );
                    $installID = crypt_encrypt( trim( $formData['worldpay_instid'] ) );

                    if ( $enabled == "on" && !$installID )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_WORLDPAY) );
                    }
                    else
                    {
                        setPaymentSetting( "WORLDPAY_STATUS", $enabled );
                        setPaymentSetting( "WORLDPAY_INSTID", $installID );
                    }

                    // creating array to append in gateway file
                    $gateway_config += array(
                        'worldpay.status' => $enabled,
                        'worldpay.instid' => $installID,
                    );


                    break;
            }
        }

        if ( !MessageHandler::haveErrors() )
        {
            MessageHandler::registerSuccess( system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_SAVED ) );
        }
    }

    /**
     * Creates the config file with database saved values
     * @param type $dbObj
     */
    function createConfigFile( $dbObj )
    {
        $array_PaymentSetting = array(
            'payment_recurring'          => getPaymentSetting('RECURRING', $dbObj),
            'payment_stripeStatus'       => getPaymentSetting('STRIPE_STATUS', $dbObj),
            'payment_paypalStatus'       => getPaymentSetting('PAYPAL_STATUS', $dbObj),
            'payment_paypalapiStatus'    => getPaymentSetting('PAYPALAPI_STATUS', $dbObj),
            'payment_payflowStatus'      => getPaymentSetting('PAYFLOW_STATUS', $dbObj),
            'payment_twocheckoutStatus'  => getPaymentSetting('TWOCHECKOUT_STATUS', $dbObj),
            'payment_worldpayStatus'     => getPaymentSetting('WORLDPAY_STATUS', $dbObj),
            'payment_authorizeStatus'    => getPaymentSetting('AUTHORIZE_STATUS', $dbObj),
            'payment_pagseguroStatus'    => getPaymentSetting('PAGSEGURO_STATUS', $dbObj),
            'payment_currency'           => getPaymentSetting('PAYMENT_CURRENCY', $dbObj),
            'currency_symbol'            => getPaymentSetting('CURRENCY_SYMBOL', $dbObj),
            'invoice_payment'            => getPaymentSetting('INVOICEPAYMENT_FEATURE', $dbObj),
            'manual_payment'             => getPaymentSetting('MANUALPAYMENT_FEATURE', $dbObj)
        );

        payment_writeSettingPaymentFile( $array_PaymentSetting );
    }

    if ( $_SERVER['REQUEST_METHOD'] == "POST" && !DEMO_LIVE_MODE )
    {
        /* The action post is defined by which button the user has clicked. */
        switch ( $_POST['action'] )
        {
            case "gateways":
                handleGatewayPost( $dbObj );
                createConfigFile( $dbObj );
                break;
            case "currencyOptions":
                /* Filters data*/
                $currencySymbol  = mysql_real_escape_string( strip_tags( trim( $_POST['currency_symbol'] ) ) );
                $paymentCurrency = string_strtoupper( $_POST['payment_currency'] );

                $paymentTaxStatus = $_POST['payment_tax_status'] == "on" ? "on" : "off";
                $paymentTaxLabel  = mysql_real_escape_string( strip_tags( trim( $_POST['payment_tax_label'] ) ) );
                /* Replaces , with . and attempts to convert to a float with two decimal positions */
                $paymentTaxValue  = sprintf("%.2f", str_replace( ",", ".", $_POST['payment_tax_value'] ) );

                /* Data filtering*/
                $invoicePayment = $_POST['invoice_payment'] == "on" ? "on" : "off";
                $manualPayment  = $_POST['manual_payment']  == "on" ? "on" : "off";

                /* Error Handling */
                !$currencySymbol and MessageHandler::registerError( LANG_MSG_CURRENCY_SYMBOL_IS_REQUIRED );

                if ( !$paymentCurrency )
                {
                    MessageHandler::registerError( LANG_MSG_PAYMENT_CURRENCY_IS_REQUIRED );
                }
                else
                {
                    $filteredPaymentCurrency = preg_replace( "/[^a-zA-Z]/", "", $paymentCurrency );

                    if ( string_strlen( $filteredPaymentCurrency ) != 3 )
                    {
                        MessageHandler::registerError( LANG_MSG_PAYMENT_CURRENCY_MUST_CONTAIN_THREE_CHARS );
                    }

                    if ( $filteredPaymentCurrency != $paymentCurrency )
                    {
                        MessageHandler::registerError( LANG_MSG_PAYMENT_CURRENCY_MUST_BE_ONLY_LETTERS );
                    }

                    if ( getPaymentSetting('PAGSEGURO_STATUS', $dbObj) == "on" && $paymentCurrency != "BRL" )
                    {
                        MessageHandler::registerError( LANG_MSG_CURRENCY_PAGSEGURO );
                    }

                    $paymentCurrency = $filteredPaymentCurrency;

                    /* Check if Needs to Send to Stripe */
                    $oldPaymentCurrency = getPaymentSetting("PAYMENT_CURRENCY", $dbObj);
                    $currencyNeedsUpdate = false;
                    if ($filteredPaymentCurrency != $oldPaymentCurrency)
                        $currencyNeedsUpdate = true;
                }

                if ( $paymentTaxStatus == "on" )
                {
                    !$paymentTaxLabel and MessageHandler::registerError( LANG_SITEMGR_MSG_MAINLANGUAGE_REQUIRED );

                    if ( !$paymentTaxValue && $paymentTaxValue != 0 )
                    {
                        MessageHandler::registerError( LANG_SITEMGR_MSG_VALUE_REQUIRED );
                    }
                    else
                    {
                        is_numeric( $paymentTaxValue ) or MessageHandler::registerError( LANG_SITEMGR_MSG_VALUE_MUST_BE_NUMERIC );
                        $paymentTaxValue > 0 or MessageHandler::registerError( LANG_SITEMGR_MSG_MIN_VALUE );
                    }
                }

                if ( !MessageHandler::haveErrors() )
                {
                    /* Sets if exists, creates if doesn't */
                    ( setting_get( "payment_tax_status", $unused )   and setting_set( "payment_tax_status", $payment_tax_status ) )  or setting_new( "payment_tax_status", $payment_tax_status );
                    ( setting_get( "payment_tax_value", $unused )    and setting_set( "payment_tax_value", $payment_tax_value )   )  or setting_new( "payment_tax_value", $payment_tax_value );
                    ( customtext_get( "payment_tax_label", $unused ) and customtext_set( "payment_tax_label", $payment_tax_label ) ) or customtext_new( "payment_tax_label", $payment_tax_label );

                    setPaymentSetting('CURRENCY_SYMBOL', $currencySymbol );
                    setPaymentSetting('PAYMENT_CURRENCY', $filteredPaymentCurrency );
                    setPaymentSetting('INVOICEPAYMENT_FEATURE', $invoicePayment );
                    setPaymentSetting('MANUALPAYMENT_FEATURE', $manualPayment );

                    if (RECURRING_FEATURE == "on" && STRIPEPAYMENT_FEATURE == "on" && $currencyNeedsUpdate) {
                        //Update plans on Stripe
                        $stripekey = crypt_decrypt(getPaymentSetting("STRIPE_APIKEY", $dbObj));
                        $response = StripeInterface::StripeRequest("createplans", $stripekey, "", $filteredPaymentCurrency);

                        if (strlen($response)) {
                            MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_STRIPE_PLANS) );
                        } else {
                            $response = StripeInterface::StripeRequest("createcoupons", $stripekey, "", $filteredPaymentCurrency);

                            if (strlen($response)) {
                                MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_STRIPE_COUPONS) );
                            }
                        }
                    }
                }

                if ( !MessageHandler::haveErrors() )
                {
                    MessageHandler::registerSuccess( system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_CURRENCY_SAVED) );
                }

                createConfigFile( $dbObj );
                break;
            case "levels":
                $stripeData = [];
                foreach ( $_POST['level'] as $type => $data )
                {
                    switch( $type )
                    {
                        case "listing" :
                            $levelObj    = new ListingLevel( true );
                            $levelsArray = $levelObj->getLevelValues();
                            $levelOptionData = $_POST['levelOption']['listing'];

                            //We have no deals unless proven otherwise by the following foreach
                            $hasPromotionCheck = false;

                            foreach ( $levelsArray as $levelValue )
                            {
                                /* Check Level Name is empty */
                                if ('' == $data['name'][$levelValue] or is_null($data['name'][$levelValue])) {
                                    MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMES_EMPTY));
                                    break 2;
                                }

                                /* Data filtering*/
                                $name         = string_strtolower( mysql_real_escape_string( $data['name'][$levelValue] ) );
                                $active       = ( empty( $data['active'][$levelValue] ) ? "n" : "y" );
                                $popular      = ( $data['popular'] == $levelValue ? "y" : "n" );
                                $featured     = ( empty( $data['featured'][$levelValue] ) ? "n" : "y" );

                                if( !empty( $levelOptionData['deals'][$levelValue] )  && (int)$levelOptionData['deals'][$levelValue] > 0)
                                {
                                    $hasPromotionCheck = true;
                                }

                                $hasReview    = ( empty( $levelOptionData['has_review'][$levelValue] ) ? "n" : "y" );
                                $hasSMS       = ( empty( $levelOptionData['has_sms'][$levelValue] )    ? "n" : "y" );
                                $hasCall      = ( empty( $levelOptionData['has_call'][$levelValue] )   ? "n" : "y" );
                                $detail       = ( empty( $levelOptionData['detail'][$levelValue] )     ? "n" : "y" );
                                $images       = ( empty( $levelOptionData['images'][$levelValue] ) ? 0 : (int)$levelOptionData['images'][$levelValue] );
                                $classified_quantity_association = filter_var($levelOptionData['classified_quantity_association'][$levelValue], FILTER_SANITIZE_NUMBER_INT);
                                $classified_quantity_association = !$classified_quantity_association ? 0 : $classified_quantity_association;

                                /* Check if Needs to Send to Stripe */
                                $needsUpdate = false;
                                if ($name != string_strtolower($levelObj->getName($levelValue)) || (float) $data['price'][$levelValue] != (float) $levelObj->getPrice($levelValue)
                                    || (float) $data['price_yearly'][$levelValue] != (float) $levelObj->getPrice($levelValue, "yearly") ||
                                    (int) $data['trial'][$levelValue] != (int) $levelObj->getTrial($levelValue)) {
                                    $needsUpdate = true;
                                }

                                /*Saving to DB*/
                                $levelObj->updateValues( $name, $active, "", "", "", "", "", $levelValue, "names", $popular, "");
                                $levelObj->updateValues( "", "", $hasReview, $hasSMS, $hasCall, $detail, $images, $levelValue, "fields", "", $classified_quantity_association);
                                $levelObj->updatePricing( 'price', ( empty( $data['price'][$levelValue] ) ? 0 : (float)$data['price'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'price_yearly', ( empty( $data['price_yearly'][$levelValue] ) ? 0 : (float)$data['price_yearly'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'trial', ( empty( $data['trial'][$levelValue] ) ? 0 : (int)$data['trial'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'category_price', ( empty( $data['category_price'][$levelValue] ) ? 0 : (float)$data['category_price'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'free_category', ( empty( $data['free_category'][$levelValue] ) ? 0 : (int)$data['free_category'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'deals', ( empty( $levelOptionData['deals'][$levelValue] ) ? 0 : (int)$levelOptionData['deals'][$levelValue]), $levelValue );
                                $levelObj->updateFeatured($featured, $levelValue);

                                /* Sets array to Update Stripe Plans, if needed */
                                if ($needsUpdate) {
                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price'][$levelValue], 2)),
                                        "interval" => "month",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_MONTHLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "monthly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];

                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price_yearly'][$levelValue], 2)),
                                        "interval" => "year",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_YEARLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "yearly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];
                                }
                            }

                            // this mimics old form post structure for old functions to work.
                            $createItemLevelArray = createItemLevelArray( $levelOptionData );

                            //Updates values for table ListingLevel_Field
                            system_updateFormFields( $createItemLevelArray, "Listing" );

                            //Updates promotion setting
                            if ( $hasPromotionCheck )
                            {
                                setting_set( "custom_has_promotion", "on" ) or setting_new( "custom_has_promotion", "on" ) or MessageHandler::registerError( LANG_SITEMGR_SETTINGS_LEVELS_ERROR );
                            }
                            else
                            {
                                setting_set( "custom_has_promotion", "" ) or setting_new( "custom_has_promotion", "" ) or MessageHandler::registerError( LANG_SITEMGR_SETTINGS_LEVELS_ERROR );
                            }
                            break;
                        case "event" :
                            $levelObj    = new EventLevel( true );
                            $levelsArray = $levelObj->getLevelValues();
                            $levelOptionData = $_POST['levelOption']['event'];

                            foreach ( $levelsArray as $levelValue )
                            {
                                /* Check Level Name is empty */
                                if ('' == $data['name'][$levelValue] or is_null($data['name'][$levelValue])) {
                                    MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMES_EMPTY));
                                    break 2;
                                }

                                /* Data filtering*/
                                $name         = string_strtolower( mysql_real_escape_string( $data['name'][$levelValue] ) );
                                $active       = ( empty( $data['active'][$levelValue] ) ? "n" : "y" );
                                $popular      = ( $data['popular'] == $levelValue ? "y" : "n" );
                                $featured     = ( empty( $data['featured'][$levelValue] ) ? "n" : "y" );

                                $detail       = ( empty( $levelOptionData['detail'][$levelValue] )     ? "n" : "y" );
                                $images       = ( empty( $levelOptionData['images'][$levelValue] ) ? 0 : (int)$levelOptionData['images'][$levelValue] );

                                /* Check if Needs to Send to Stripe */
                                $needsUpdate = false;
                                if ($name != string_strtolower($levelObj->getName($levelValue)) || (float) $data['price'][$levelValue] != (float) $levelObj->getPrice($levelValue)
                                    || (float) $data['price_yearly'][$levelValue] != (float) $levelObj->getPrice($levelValue, "yearly") ||
                                    (int) $data['trial'][$levelValue] != (int) $levelObj->getTrial($levelValue)) {
                                    $needsUpdate = true;
                                }

                                /*Saving*/
                                $levelObj->updateValues( $name, $active, "", "", $levelValue, "names", $popular );
                                $levelObj->updateValues( "", "", $detail, $images, $levelValue, "fields" );
                                $levelObj->updatePricing( 'price', ( empty( $data['price'][$levelValue] ) ? 0 : (float)$data['price'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'price_yearly', ( empty( $data['price_yearly'][$levelValue] ) ? 0 : (float)$data['price_yearly'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'trial', ( empty( $data['trial'][$levelValue] ) ? 0 : (int)$data['trial'][$levelValue] ), $levelValue);
                                $levelObj->updateFeatured($featured, $levelValue);

                                /* Sets array to Update Stripe Plans, if needed */
                                if ($needsUpdate) {
                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price'][$levelValue], 2)),
                                        "interval" => "month",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_MONTHLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "monthly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];

                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price_yearly'][$levelValue], 2)),
                                        "interval" => "year",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_YEARLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "yearly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];
                                }
                            }

                            if ( isset( $levelOptionData['start_time']) )
                            {
                                $levelOptionData['time'] = $levelOptionData['start_time'];
                                unset( $levelOptionData['start_time'] );
                            }

                            // this mimics old form post structure for old functions to work.
                            $createItemLevelArray = createItemLevelArray( $levelOptionData );

                            //Updates values for table ListingLevel_Field
                            system_updateFormFields( $createItemLevelArray, "Event" );

                            break;
                        case "banner" :
                            $levelObj    = new BannerLevel( true );
                            $levelsArray = $levelObj->getLevelValues();
                            $levelOptionData = $_POST['levelOption']['banner'];

                            foreach ( $levelsArray as $levelValue )
                            {
                                /* Check Level Name is empty */
                                if ('' == $data['name'][$levelValue] or is_null($data['name'][$levelValue])) {
                                    MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMES_EMPTY));
                                    break 2;
                                }

                                $name         = string_strtolower( mysql_real_escape_string( $data['name'][$levelValue] ) );
                                $active       = ( empty( $data['active'][$levelValue] ) ? "n" : "y" );
                                $popular      = ( $data['popular'] == $levelValue ? "y" : "n" );

                                /* Check if Needs to Send to Stripe */
                                $needsUpdate = false;
                                if ($name != string_strtolower($levelObj->getName($levelValue)) || (float) $data['price'][$levelValue] != (float) $levelObj->getPrice($levelValue, BANNER_EXPIRATION_RENEWAL_DATE)
                                    || (float) $data['price_yearly'][$levelValue] != (float) $levelObj->getPrice($levelValue, BANNER_EXPIRATION_RENEWAL_DATE, "yearly") ||
                                    (int) $data['trial'][$levelValue] != (int) $levelObj->getTrial($levelValue)) {
                                    $needsUpdate = true;
                                }

                                $blockImpressions = (int)$data['block_impressions'][$levelValue];
                                $levelObj->updatePricing( 'impression_block', $blockImpressions, $levelValue );
                                $blockPrice       = (float)str_replace( ',', '.', $data['block_price'][$levelValue] );
                                $levelObj->updatePricing( 'impression_price', $blockPrice, $levelValue );

                                $levelObj->updateValues( $name, $active, $levelValue, $popular );
                                $levelObj->updatePricing( 'price', ( empty( $data['price'][$levelValue] ) ? 0 : (float)$data['price'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'price_yearly', ( empty( $data['price_yearly'][$levelValue] ) ? 0 : (float)$data['price_yearly'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'trial', ( empty( $data['trial'][$levelValue] ) ? 0 : (int)$data['trial'][$levelValue] ), $levelValue);

                                /* Sets array to Update Stripe Plans, if needed */
                                if ($needsUpdate) {
                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price'][$levelValue], 2)),
                                        "interval" => "month",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_MONTHLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "monthly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];

                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price_yearly'][$levelValue], 2)),
                                        "interval" => "year",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_YEARLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "yearly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];
                                }
                            }

                            break;
                        case "classified" :
                            $levelObj    = new ClassifiedLevel( true );
                            $levelsArray = $levelObj->getLevelValues();
                            $levelOptionData = $_POST['levelOption']['classified'];

                            foreach ( $levelsArray as $levelValue )
                            {
                                /* Check Level Name is empty */
                                if ('' == $data['name'][$levelValue] or is_null($data['name'][$levelValue])) {
                                    MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMES_EMPTY));
                                    break 2;
                                }

                                $name         = string_strtolower( mysql_real_escape_string( $data['name'][$levelValue] ) );
                                $active       = ( empty( $data['active'][$levelValue] ) ? "n" : "y" );
                                $popular      = ( $data['popular'] == $levelValue ? "y" : "n" );
                                $featured     = ( empty( $data['featured'][$levelValue] ) ? "n" : "y" );

                                $detail       = ( empty( $levelOptionData['detail'][$levelValue] )     ? "n" : "y" );
                                $video        = ( empty( $levelOptionData['video'][$levelValue] )     ? "n" : "y" );
                                $images       = ( empty( $levelOptionData['images'][$levelValue] ) ? 0 : (int)$levelOptionData['images'][$levelValue] );
                                $additional_files = ( empty( $levelOptionData['additional_files'][$levelValue] )     ? "n" : "y" );

                                /* Check if Needs to Send to Stripe */
                                $needsUpdate = false;
                                if ($name != string_strtolower($levelObj->getName($levelValue)) || (float) $data['price'][$levelValue] != (float) $levelObj->getPrice($levelValue)
                                    || (float) $data['price_yearly'][$levelValue] != (float) $levelObj->getPrice($levelValue, "yearly") ||
                                    (int) $data['trial'][$levelValue] != (int) $levelObj->getTrial($levelValue)) {
                                    $needsUpdate = true;
                                }

                                $levelObj->updateValues( $name, $active, "", "", $levelValue, "", "", "names", $popular );
                                $levelObj->updateValues( "", "", $detail, $images, $levelValue, $video, $additional_files, "fields");
                                $levelObj->updatePricing( 'price', ( empty( $data['price'][$levelValue] ) ? 0 : (float)$data['price'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'price_yearly', ( empty( $data['price_yearly'][$levelValue] ) ? 0 : (float)$data['price_yearly'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'trial', ( empty( $data['trial'][$levelValue] ) ? 0 : (int)$data['trial'][$levelValue] ), $levelValue);
                                $levelObj->updateFeatured($featured, $levelValue);

                                /* Sets array to Update Stripe Plans, if needed */
                                if ($needsUpdate) {
                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price'][$levelValue], 2)),
                                        "interval" => "month",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_MONTHLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "monthly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];

                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price_yearly'][$levelValue], 2)),
                                        "interval" => "year",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_YEARLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "yearly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];
                                }
                            }

                            // this mimics old form post structure for old functions to work.
                            $createItemLevelArray = createItemLevelArray( $levelOptionData );

                            //Updates values for table ListingLevel_Field
                            system_updateFormFields( $createItemLevelArray, "Classified" );

                            break;
                        case "article" :
                            $levelObj        = new ArticleLevel( true );
                            $levelsArray     = $levelObj->getLevelValues();
                            $levelOptionData = $_POST['levelOption']['article'];

                            foreach ( $levelsArray as $levelValue )
                            {
                                /* Check Level Name is empty */
                                if ('' == $data['name'][$levelValue] or is_null($data['name'][$levelValue])) {
                                    MessageHandler::registerError(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMES_EMPTY));
                                    break 2;
                                }

                                $name         = string_strtolower( mysql_real_escape_string( $data['name'][$levelValue] ) );
                                $active       = ( empty( $data['active'][$levelValue] ) ? "n" : "y" );

                                /* Check if Needs to Send to Stripe */
                                $needsUpdate = false;
                                if ($name != string_strtolower($levelObj->getName($levelValue)) || (float) $data['price'][$levelValue] != (float) $levelObj->getPrice($levelValue)
                                    || (float) $data['price_yearly'][$levelValue] != (float) $levelObj->getPrice($levelValue, "yearly") ||
                                    (int) $data['trial'][$levelValue] != (int) $levelObj->getTrial($levelValue)) {
                                    $needsUpdate = true;
                                }

                                $levelObj->updateValues( $name, $active, "", $levelValue );
                                $levelObj->updatePricing( 'price', ( empty( $data['price'][$levelValue] ) ? 0 : (float)$data['price'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'price_yearly', ( empty( $data['price_yearly'][$levelValue] ) ? 0 : (float)$data['price_yearly'][$levelValue] ), $levelValue);
                                $levelObj->updatePricing( 'trial', ( empty( $data['trial'][$levelValue] ) ? 0 : (int)$data['trial'][$levelValue] ), $levelValue);

                                /* Sets array to Update Stripe Plans, if needed */
                                if ($needsUpdate) {
                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price'][$levelValue], 2)),
                                        "interval" => "month",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_MONTHLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "monthly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];

                                    $stripeData[] = [
                                        "price" => StripeInterface::normalizePrice(number_format((float)$data['price_yearly'][$levelValue], 2)),
                                        "interval" => "year",
                                        "name" => @constant("LANG_".strtoupper($type)."_FEATURE_NAME")." ".$name." - ".system_showText(LANG_YEARLY),
                                        "currency" => PAYMENT_CURRENCY,
                                        "trial" => (int)$data['trial'][$levelValue],
                                        "id" => "yearly_".$type."_".$levelValue."_".SELECTED_DOMAIN_ID
                                    ];
                                }
                            }

                            break;
                    }
                }

                if (RECURRING_FEATURE == "on" && STRIPEPAYMENT_FEATURE == "on" && $_POST['save-pricing'] == "yes" && !empty($stripeData)) {

                    //Update plans on Stripe
                    $stripekey = crypt_decrypt(getPaymentSetting("STRIPE_APIKEY", $dbObj));
                    $response = StripeInterface::StripeRequest("updateplans", $stripekey, $stripeData);

                }

                MessageHandler::haveErrors() or MessageHandler::registerSuccess( LANG_SITEMGR_SETTINGS_PAYMENTS_LEVELS_SAVED );
                break;
        }

        $_SESSION['PaymentOptions']['type'] = $_POST['action'];

        if( MessageHandler::haveErrors() )
        {
            /* Loads post information into the forms */
            $currency_symbol    = $_POST['currency_symbol'];
            $payment_currency   = $_POST['payment_currency'];
            $payment_tax_status = $_POST['payment_tax_status'];
            $payment_tax_value  = $_POST['payment_tax_value'];
            $payment_tax_label  = $_POST['payment_tax_label'];
            $invoice_payment    = $_POST['invoice_payment'];
            $manual_payment     = $_POST['manual_payment'];
            $gatewayInfo        = $_POST['gateway'];
        }
        else
        {
            /* Since we use the header to reload the page (to clear post data)
             * we need to save the messages in the session for them not to be lost
             * this is basically what this function does */
            MessageHandler::serialize();

            /* This is used on the next page to set which tab will be displayed */
            header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
            exit;
        }
    }
    else
    {
        /* Down here we prepare the "default" data which will be shown for each pane
         * These are the user's current settings, in other words. */

        /* Currency Defaults */
        $currency_symbol  = getPaymentSetting( "CURRENCY_SYMBOL", $dbObj );
        $payment_currency = getPaymentSetting( "PAYMENT_CURRENCY", $dbObj );

        /* Tax Defaults */

        setting_get( "payment_tax_status", $payment_tax_status );
        setting_get( "payment_tax_value", $payment_tax_value );
        customtext_get( "payment_tax_label", $payment_tax_label );

        /* Invoice Defaults */
        $invoice_payment = getPaymentSetting( "INVOICEPAYMENT_FEATURE", $dbObj );
        $manual_payment  = getPaymentSetting( "MANUALPAYMENT_FEATURE", $dbObj );

        /* Payment Gateways Defaults */
        /* Let's make sure it's empty */
        $gatewayInfo = null;

        /* Recurring */
        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'RECURRING'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "RECURRING"        : $gatewayInfo['recurring']           = $row["value"]; break;
            }
        }

        /* Stripe */
        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'STRIPE_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "STRIPE_APIKEY"        : $gatewayInfo['stripe']['stripe_apikey']           = crypt_decrypt( $row["value"] ); break;
                case "STRIPE_STATUS"         : $gatewayInfo['stripe']['payment_stripeStatus']     = $row["value"]; break;
            }
        }

        /* Paypal */
        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPAL_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "PAYPAL_ACCOUNT"        : $gatewayInfo['paypal']['paypal_account']           = crypt_decrypt( $row["value"] ); break;
                case "PAYPAL_STATUS"         : $gatewayInfo['paypal']['payment_paypalStatus']     = $row["value"]; break;
            }
        }

        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPALAPI_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "PAYPALAPI_STATUS"    : $gatewayInfo['paypalAPI']['payment_paypalapiStatus'] = $row["value"]; break;
                case "PAYPALAPI_USERNAME"  : $gatewayInfo['paypalAPI']['paypalapi_username']      = crypt_decrypt( $row["value"] ); break;
                case "PAYPALAPI_PASSWORD"  : $gatewayInfo['paypalAPI']['paypalapi_password']      = crypt_decrypt( $row["value"] ); break;
                case "PAYPALAPI_SIGNATURE" : $gatewayInfo['paypalAPI']['paypalapi_signature']     = crypt_decrypt( $row["value"] ); break;
            }

        }

        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYFLOW_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "PAYFLOW_STATUS"  : $gatewayInfo['payflow']['payment_payflowStatus'] = $row["value"]; break;
                case "PAYFLOW_LOGIN"   : $gatewayInfo['payflow']['payflow_login']         = crypt_decrypt( $row["value"] ); break;
                case "PAYFLOW_PARTNER" : $gatewayInfo['payflow']['payflow_partner']       = crypt_decrypt( $row["value"] ); break;
            }
        }

        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'TWOCHECKOUT_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "TWOCHECKOUT_STATUS" : $gatewayInfo['twoCheckout']['payment_twocheckoutStatus'] = $row["value"]; break;
                case "TWOCHECKOUT_LOGIN"  : $gatewayInfo['twoCheckout']['twocheckout_login']         = crypt_decrypt( $row["value"] ); break;
            }
        }

        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'WORLDPAY_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "WORLDPAY_STATUS" : $gatewayInfo['worldpay']['payment_worldpayStatus'] = $row["value"]; break;
                case "WORLDPAY_INSTID" : $gatewayInfo['worldpay']['worldpay_instid']        = crypt_decrypt( $row["value"] ); break;
            }
        }

        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'AUTHORIZE_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "AUTHORIZE_LOGIN"           : $gatewayInfo['authorize']['authorize_login'] = crypt_decrypt( $row["value"] ); break;
                case "AUTHORIZE_TXNKEY"          : $gatewayInfo['authorize']['authorize_txnkey'] = crypt_decrypt( $row["value"] ); break;
                case "AUTHORIZE_STATUS"          : $gatewayInfo['authorize']['payment_authorizeStatus'] = $row["value"]; break;
            }
        }

        $sql    = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAGSEGURO_%'";
        $result = $dbObj->query( $sql );

        while ( $row = mysql_fetch_assoc( $result ) )
        {
            switch ( $row["name"] )
            {
                case "PAGSEGURO_EMAIL"  : $gatewayInfo['pagseguro']['pagseguro_email']         = crypt_decrypt( $row["value"] ); break;
                case "PAGSEGURO_TOKEN"  : $gatewayInfo['pagseguro']['pagseguro_token']         = crypt_decrypt( $row["value"] ); break;
                case "PAGSEGURO_STATUS" : $gatewayInfo['pagseguro']['payment_pagseguroStatus'] = $row["value"]; break;
            }
        }

    }

    /* Available Modules */
    /* Each module's defaults are loaded separatedly inside includes/forms/form-payment-pricing.php */
    $availableModules["event"]      = array(
        "active" => (EVENT_FEATURE == "on"),
        "name"   => system_showText( LANG_SITEMGR_NAVBAR_EVENT ),
    );
    $availableModules["classified"] = array(
        "active" => (CLASSIFIED_FEATURE == "on"),
        "name"   => system_showText( LANG_SITEMGR_NAVBAR_CLASSIFIED ),
    );
    $availableModules["banner"]     = array(
        "active" => (BANNER_FEATURE == "on"),
        "name"   => system_showText( LANG_SITEMGR_NAVBAR_BANNER ),
    );
    $availableModules["article"]    = array(
        "active" => (ARTICLE_FEATURE == "on"),
        "name"   => system_showText( LANG_SITEMGR_NAVBAR_ARTICLE ),
    );
