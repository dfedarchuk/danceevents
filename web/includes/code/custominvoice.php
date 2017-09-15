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
    # * FILE: /includes/code/custominvoice.php
    # ----------------------------------------------------------------------------------------------------

    
    $_POST = format_magicQuotes( $_POST );
    $_GET  = format_magicQuotes( $_GET );
    extract( $_POST );
    extract( $_GET );
    
    if ( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if ( !empty( $item_price ) )
        {
            $subtotal = 0;

            // formating money
            foreach ( $item_price as $each_item_price )
            {
                $item_prices[] = (!empty( $each_item_price )) ? format_money( $each_item_price ) : "";
                $subtotal += $each_item_price;
            }
            $_POST["subtotal"] = $subtotal;
            $_POST["tax"]      = 0;
            $_POST["amount"]   = $subtotal;
        }

        if ( validate_form( "custominvoice", $_POST, $error ) )
        {
            $customInvoiceObj = new CustomInvoice( $id );

            if ( !$customInvoiceObj->GetString( "id" ) || $customInvoiceObj->GetString( "id" ) == 0 )
            {
                $message = 0;
            }
            else
            {
                $message = 1;
            }

            $_POST["completed"] = "y";

            $customInvoiceObj->makeFromRow( $_POST );

            $customInvoiceObj->Save();

            $customInvoiceObj->setItems( $item_desc, $item_prices );

            header( "Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/send.php?id={$customInvoiceObj->id}" );
            exit;
        }
        else
        {
            MessageHandler::registerError( $error );
        }

    }

    #############################################################################################################################
    # FORM DEFINES
    #############################################################################################################################

    $customInvoice = null;

    if ( $id )
    {
        $customInvoice = new CustomInvoice( $id );
        $customInvoice->extract();

        if ( $customInvoice->getString( "paid" ) == "y" )
        {
            header( "Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/" );
            exit;
        }

        /* descriptions and prices */
        $customInvoiceItems = $customInvoice->getItems();

        if ( $_SERVER["REQUEST_METHOD"] != "POST" )
        {
            if ( $customInvoiceItems )
            {
                $customInvoiceItems = format_magicQuotes( $customInvoiceItems );
                foreach ( $customInvoiceItems as $each_custominvoice_item )
                {
                    $item_desc[]  = $each_custominvoice_item["description"];
                    $item_price[] = $each_custominvoice_item["price"];
                }
            }
        }
    }

    //accounts
    $acct_search_table_title   = system_showText( LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT );
    $acct_search_field_name    = "account_id";
    $acct_search_field_value   = $account_id;
    $acct_search_required_mark = true;
    $acct_search_form_width    = "95%";