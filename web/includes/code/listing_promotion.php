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
    # * FILE: /includes/code/listing_promotion.php
    # ----------------------------------------------------------------------------------------------------

    $errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";
    $level = new ListingLevel();

    if ($id) {
        $listing = new Listing($id);
        if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
            header("Location: ".$errorPage);
            exit;
        }
        if ((sess_getAccountIdFromSession() != $listing->getNumber("account_id")) && (!string_strpos($url_base, "/".SITEMGR_ALIAS.""))) {
            header("Location: ".$errorPage);
            exit;
        }
        $listingHasPromotion = $level->getDeals($listing->getNumber("level"));
        if ((!$listingHasPromotion) || ($listingHasPromotion < 1)) {
            header("Location: ".$errorPage);
            exit;
        }
        $account_id = $listing->getNumber("account_id");

        # ----------------------------------------------------------------------------------------------------
        # Existing Deals(Promotions) AVAILABLE TO THE LISTING ($account_promotions)
        # ----------------------------------------------------------------------------------------------------
        $promotion = new Promotion();

        $dealsListingAvailable = [];
        $dealsListingAvailableRow = $promotion->getAllDealsAvailable($account_id, 'sitemgr');

        while ( $row = mysql_fetch_assoc( $dealsListingAvailableRow ) )
        {
            $dealsListingAvailable[] = [
                "id"    => $row["id"],
                "name" => $row["name"]
            ];
        }

        # ----------------------------------------------------------------------------------------------------
        # GET DEALS(PROMOTIONS) LINKED TO THE LISTING
        # ----------------------------------------------------------------------------------------------------

        $promotion = new Promotion();
        $linkedDealsToListing =[];
        $linkedDeals = $promotion->getPromotionsOfListing($listing->getNumber("id"));

        while ($row = mysql_fetch_assoc( $linkedDeals ) )
        {
            $initialLinkedDealsToListing[] = $row['id'];

            $linkedDealsToListing[]=[
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }

        # ----------------------------------------------------------------------------------------------------
        # Preparing for javascript selectize plugin
        # ----------------------------------------------------------------------------------------------------
        $allDealsAvailable = array_merge($dealsListingAvailable, $linkedDealsToListing);
        $allDealsAvailable = $allDealsAvailable ? json_encode($allDealsAvailable) : null;

        $initialLinkedDealsToListing = json_encode($initialLinkedDealsToListing);

    } else {
        header("Location: ".$errorPage);
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if ($_POST["promotion_id"] >= 0) {
            $listingObj = new Listing();
            $levelDealObj = $listingObj->getLevel($_POST["id"]);

            $levelObj = new ListingLevel();
            $limit = $levelObj->getDeals($levelDealObj);

            $deals_id = $_POST['selectedDeals']? explode(',', ($_POST['selectedDeals'])) : null;
            if (count($deals_id) > $limit) {
                $message = 14;
                header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
                exit;
            }

            if(!empty($_POST["id"])){
                $listing_id = (int)$_POST["id"];

                //unlink Promotions to listing that aren't in $deals_id
                $promotion->unLinkPromotionListing($deals_id,$listing_id);

                //Link Promotion to Listing
                if($deals_id){
                    foreach($deals_id as $insert_deal){
                        $promotionObj = new Promotion((int)$insert_deal);
                        $promotionObj->updateListingPromotionEntry((int)$insert_deal, (int)$listing_id);
                    }
                }

                $message = 6;

                header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
                exit;

            }
        }
    }

    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------
    $listing->extract();

    /**
     * Get promotion information 
     */
    if($promotion_id){
        unset($promotionObj);
        $promotionObj = new Promotion($promotion_id);
        $promotion_name = $promotionObj->getString("name");
    }

?>