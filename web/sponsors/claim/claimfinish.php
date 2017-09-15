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
	# * FILE: /sponsors/claim/claimfinish.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/claim";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }
	if (!$claimlistingid) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	if ($listingObject->getNumber("account_id") != $acctId) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'e' ORDER BY date_time DESC LIMIT 1";
	$resultClaim = $dbObjClaim->query($sqlClaim);
	if ($rowClaim = mysql_fetch_assoc($resultClaim)) $claimID = $rowClaim["id"];
	if (!$claimID) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	$claimObject = new Claim($claimID);
	if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$claimObject->setString( "step", "-" );
    $claimObject->setString( "status", "complete" );
    $claimObject->save();

    $domain = new Domain( SELECTED_DOMAIN_ID );

    setting_get( "claim_approve", $claim_approve );

    if ( !$claim_approve )
    {
        $claimObject->setString( "status", "approved" );
        $claimObject->save();
        setting_get( "claim_approveemail", $claim_approveemail );

        setting_get( "listing_approve_updated", $listing_approve_updated );
        if (!$listingObject->needToCheckOut() && !$listing_approve_updated)
        {
            $listingObject->setString( "status", "A" );
            $listingObject->save();
        }

        if ( $claim_approveemail )
        {
            $contact = new Contact( $claimObject->getNumber( "account_id" ) );

            if ( $emailNotificationObj = system_checkEmail( SYSTEM_CLAIM_AUTOMATICALLY_APPROVED ) )
            {
                $subject = $emailNotificationObj->getString( "subject" );
                $subject = system_replaceEmailVariables( $subject, $listingObject->getNumber( 'id' ), 'listing' );
                $subject = html_entity_decode( $subject );

                $body = $emailNotificationObj->getString( "body" );
                $body = system_replaceEmailVariables( $body, $listingObject->getNumber( 'id' ), 'listing' );
                $body = str_replace( "DEFAULT_URL", DEFAULT_URL, $body );
                $body = str_replace( $_SERVER["HTTP_HOST"], $domain->getstring( "url" ), $body );
                $body = html_entity_decode( $body );

                Mailer::mail( $contact->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
            }
        }
    }

    header( "Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/" );
    exit;
