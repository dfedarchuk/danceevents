<?
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

    /**
     * <Lucas Trentim (2015)>
     * @todo : This code could use some refactoring
     */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /activationEmail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

    header( "Content-Type: text/html; charset=".EDIR_CHARSET, TRUE );
    header( "Accept-Encoding: gzip, deflate" );
    header( "Expires: Sat, 01 Jan 2000 00:00:00 GMT" );
    header( "Cache-Control: no-store, no-cache, must-revalidate" );
    header( "Cache-Control: post-check=0, pre-check", FALSE );
    header( "Pragma: no-cache" );
    
    extract( $_GET );

    //Activation email - error message
    $messageActivation      = system_showText( LANG_LABEL_ACTIVATEEMAIL_SENT_ERROR )."<br />".system_showText( LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT );
    setting_get( "sitemgr_email", $sitemgr_email );
    $sitemgr_emails         = explode( ",", $sitemgr_email );

    setting_get( "sitemgr_support_email", $sitemgr_support_email );
    $sitemgr_support_emails = explode( ",", $sitemgr_support_email );

    if ( $sitemgr_support_emails[0] )
    {
        foreach ( $sitemgr_support_emails as $sitemgr_support_email )
        {
            $messageActivation .= "<br />$sitemgr_support_email";
        }
    }
    elseif ( $sitemgr_emails[0] )
    {
        foreach ( $sitemgr_emails as $sitemgr_email )
        {
            $messageActivation .= "<br />$sitemgr_email";
        }
    }

    if ( $acc_id )
    {

        $account = new Account( $acc_id );
        $contact = new Contact( $acc_id );

        /*****************************************************
         * E-mail notify
         *****************************************************/

        // sending e-mail to user //////////////////////////////////////////////////////////////////////////
        if ( $emailNotificationObj = system_checkEmail( SYSTEM_ACTIVATE_ACCOUNT ) )
        {

            $row["account_id"] = $account->getNumber( "id" );
            $row["unique_key"] = md5( uniqid( rand(), true ) );
            $row["entered"]    = date( "Y-m-d" );

            //Remove old activation entries
            $acc_activationObj = new Account_Activation();
            $acc_activationObj->deletePerAccount( $acc_id );

            //Create new activation
            $acc_activationObj = new Account_Activation( $row );
            $acc_activationObj->save();

            $linkActivation = DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?activation_key=".$row["unique_key"];

            $subject = $emailNotificationObj->getString( "subject" );
            $subject = system_replaceEmailVariables( $subject, $account->getNumber( "id" ), "account" );
            $subject = html_entity_decode( $subject );

            $body = $emailNotificationObj->getString( "body" );
            $body = str_replace( "LINK_ACTIVATE_ACCOUNT", $linkActivation, $body );
            $body = system_replaceEmailVariables( $body, $account->getNumber( "id" ), "account" );
            $body = html_entity_decode( $body );

            if ( Mailer::mail( $contact->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) ) )
            {
                echo "ok";
            }
            else
            {
                echo $messageActivation;
            }
        }
    }
    else
    {
        echo $messageActivation;
    }