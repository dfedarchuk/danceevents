<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/review-comments/review/status.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    extract($_GET);
    extract($_POST);
	$domain = new Domain(SELECTED_DOMAIN_ID);

    $reviewObj = new Review( $idReview );

    $message = $reviewObj->ApproveReviewAndReply();

    $response .= "?message=".$message."&item_type=$item_type&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen";
    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/reviews-comments/index.php".$response);
    exit;
