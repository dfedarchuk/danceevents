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
    # * FILE: /includes/code/custominvoice-send.php
    # ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);

    if (!$id)
    {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/");
		exit;
	}

    if ( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        $customInvoice = new CustomInvoice( $id );

        if ( $customInvoice->getString( "paid" ) == "y" )
        {
            header( "Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/" );
            exit;
        }

        if ( validate_form( 'custominvoicesend', $_POST, $error_msg ) )
        {
            /* updating status */
            $sent_date = $customInvoice->getString( "sent_date" ).($customInvoice->getString( "sent_date" )) ? "\n" : "".date( "Y-m-d" );

            $customInvoice->setString( "sent", "y" );
            $customInvoice->setString( "sent_date", $sent_date );
            $customInvoice->Save();

            $emailNotification = new EmailNotification( SYSTEM_NEW_CUSTOMINVOICE );
            $domain = new Domain( SELECTED_DOMAIN_ID );

            $subject = stripslashes( $subject );
            $body    = stripslashes( $body_message );
            $body    = str_replace( $_SERVER["HTTP_HOST"], $domain->getstring( "url" ), $body );

            if ( Mailer::mail($to, $subject, $body, $emailNotification->getString( "content_type" ), $cc, $bcc ) )
            {
                $error   = false;
                $message = 2;
            }
            else
            {
                $message = urlencode( system_showText(LANG_CONTACTMSGFAILED) );
            }

		    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/index.php?message=$message&error=$error&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;
        }
        else
        {
            MessageHandler::registerError( $error_msg );
        }
    }

    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------
    setting_get( "sitemgr_email", $sitemgr_email );
    setting_get( "payment_tax_status", $payment_tax_status );
    customtext_get( "payment_tax_label", $payment_tax_label );

    $sitemgr_emails = explode( ",", $sitemgr_email );
    $sitemgr_emails[0] and $sitemgr_email = $sitemgr_emails[0];

    $customInvoice = new CustomInvoice( $id );

    $account = new Account( $customInvoice->getNumber( "account_id" ) );
    $contact = db_getFromDB( "contact", "account_id", $account->getNumber( "id" ) );

    $emailNotification = new EmailNotification( SYSTEM_NEW_CUSTOMINVOICE );
    $domain = new Domain( SELECTED_DOMAIN_ID );

    $body = $emailNotification->getString( "body" );
    $body = str_replace( "EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body );
    $body = str_replace( "DEFAULT_URL", DEFAULT_URL, $body );
    $body = str_replace( "MEMBERS_URL", MEMBERS_ALIAS, $body );
    $body = str_replace( "ACCOUNT_NAME", $contact->getString( "first_name" )." ".$contact->getString( "last_name" ), $body );
    $body = str_replace( "ACCOUNT_USERNAME", $account->getString( "username" ), $body );
    $body = str_replace( "SITEMGR_EMAIL", $sitemgr_email, $body );
    $body = str_replace( "CUSTOM_INVOICE_AMOUNT", CURRENCY_SYMBOL."".$customInvoice->getPrice(), $body );
    $body = str_replace( "CUSTOM_INVOICE_TAX", ($payment_tax_status ? "+ ".$payment_tax_label : "" ), $body );
    $body = str_replace( $_SERVER["HTTP_HOST"], $domain->getstring( "url" ), $body );

    $subject = str_replace( "EDIRECTORY_TITLE", EDIRECTORY_TITLE, $emailNotification->getString( "subject" ) );