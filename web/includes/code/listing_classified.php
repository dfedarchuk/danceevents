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
# * FILE: /includes/code/listing_classified.php
# ----------------------------------------------------------------------------------------------------

$errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";
$level = new ListingLevel();

$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

if ($id) {
    $listing = new Listing($id);
    if (
        ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0))
        || ((sess_getAccountIdFromSession() != $listing->getNumber("account_id")) && (!string_strpos($url_base, "/".SITEMGR_ALIAS."")))
    ) {
        header("Location: ".$errorPage);
        exit;
    }
    $listingClassifiedAssociation = $level->getClassifiedQuantityAssociation($listing->getNumber("level"));
    if ((!$listingClassifiedAssociation) || (is_int($listingClassifiedAssociation))) {
        header("Location: ".$errorPage);
        exit;
    }
    $account_id = $listing->getNumber("account_id");
} else {
    header("Location: ".$errorPage);
    exit;
}

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------
$message_listingclassified = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    /* Saves classifieds linked */
    if (is_array($_POST['classifieds_id'])) { /* It allows disassociation */
        $classifieds = filter_var_array($_POST['classifieds_id'], FILTER_SANITIZE_NUMBER_INT);
    }

    // it is not a valid post
    $message_listingclassified = system_showText(LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY);

    if (count($classifieds) <= $listingClassifiedAssociation) {
        try {
            $listing->savesAssociationClassifieds($classifieds);
            $message = system_showText(LANG_SITEMGR_ASSOCIATION_SUCCESSFULLY_SAVE);

            header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;
        } catch (\Exception $e) {
            // get error message
            $message_listingclassified = $e->getMessage();
        }
    }
}

// classified options
if (sess_isSitemgrLogged()) {
    $classifieds = Classified::getClassifiedsBySitemgrRulesUsingListing($listing);
} else {
    $classifieds = Classified::getClassifiedsByUser(sess_getAccountIdFromSession());
}

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
$listing->extract();

$levelObj = new ListingLevel($listing->getNumber("level"));
