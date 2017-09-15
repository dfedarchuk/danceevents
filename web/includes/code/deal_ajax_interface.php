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
	# * FILE: /includes/code/deal_ajax_interface.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();

    header( "Content-Type: ".($_GET["sitemgr"] ? "application/json;" : "text/html;")." charset=".EDIR_CHARSET, TRUE );
    header( "Accept-Encoding: gzip, deflate" );
    header( "Expires: Sat, 01 Jan 2000 00:00:00 GMT" );
    header( "Cache-Control: no-store, no-cache, must-revalidate" );
    header( "Cache-Control: post-check=0, pre-check", FALSE );
    header( "Pragma: no-cache" );

    $response = null;

    switch ( $_POST['action'] )
    {
        case "getAllListings":
            $accountId = (int)$_POST['accountId'];
            $listingId = (int)$_POST['listingId'];

            $dealId = (int)$_POST['dealid'];
            if ($dealId) {
                $promotion = new Promotion($dealId);
                $listingByDealId = $promotion->getNumber("listing_id");
            } else {
                $listingByDealId = null;
            }

            $dbMain = db_getDBObject( DEFAULT_DB, true );
            $dbObj  = db_getDBObjectByDomainID( SELECTED_DOMAIN_ID, $dbMain );

            /**
             * Get level with promotion
             */
            $levelObj = new ListingLevel();
            $levels   = $levelObj->getValues();
            foreach ( $levels as $level )
            {
                if ( $levelObj->getDeals( $level ) > 0)
                {
                    $dealLevels[] = $level;
                }
            }

            $accountSegment = "AND (ISNULL(account_id) OR account_id = 0)";
            if ($accountId > 0){
                $accountSegment = " AND account_id = ". $accountId;
            }

            $dealLevels = implode( ",", $dealLevels );

            $sql = "SELECT id, title, status,account_id, `level`
                    FROM Listing
                    WHERE (
                        level IN ({$dealLevels}) {$accountSegment}               
                    )
                    ORDER BY `title`
                    LIMIT 1000";

            $result = $dbObj->query( $sql );

            $listLevelObj = new ListingLevel();
            $listObj = new Listing();

            while ( $rowListings = mysql_fetch_assoc( $result ) )
            {

                $countDeal = $listObj->countDeals($rowListings["id"]);

                $limitDeal = $listLevelObj->getDeals($rowListings["level"]);

                if ($rowListings["id"] == $listingByDealId || $limitDeal > $countDeal) {
                    $response[] = array(
                        "label" => $rowListings["title"],
                        "id" => $rowListings["id"],
                    );
                }
            }
            break;
    }

    echo json_encode( $response );


