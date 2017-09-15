<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/lists/list-claim.php
	# ----------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_claim[$message])) { ?>
        <p class="alert alert-success"><?=$msg_claim[$message]?></p>
    <? } ?>

    <section id="list-claim">

        <ul class="list-content-item list no-bulk">

        <? 
        $cont = 0;
        $level = new ListingLevel(true);
        foreach($claims as $claim) {
            $cont++;
            
            $previewClaim[$cont]["id"] = $claim->getNumber("id");
            if ($claim->getNumber("account_id")) {
                $previewClaim[$cont]["account_id"] = $claim->getNumber("account_id");
            }
            $previewClaim[$cont]["username"] = $claim->getString("username");
            if ($claim->getNumber("listing_id")) {
                $previewClaim[$cont]["listing_id"] = $claim->getNumber("listing_id");
                
				$listing = new Listing($claim->getNumber("listing_id"));
                $listingHasDetail = $level->getDetail($listing->getNumber("level"));
                $previewClaim[$cont]["preview_url"] = $listing->getFriendlyURL(false, LISTING_DEFAULT_URL);
            }
            $previewClaim[$cont]["listing_title"] = $claim->getString("listing_title");
            $previewClaim[$cont]["old_title"] = $claim->getString("old_title");
            $previewClaim[$cont]["new_title"] = $claim->getString("new_title");
            $previewClaim[$cont]["old_friendly_url"] = $claim->getString("old_friendly_url");
            $previewClaim[$cont]["new_friendly_url"] = $claim->getString("new_friendly_url");
            $previewClaim[$cont]["old_email"] = $claim->getString("old_email");
            $previewClaim[$cont]["new_email"] = $claim->getString("new_email");
            $previewClaim[$cont]["old_url"] = $claim->getString("old_url");
            $previewClaim[$cont]["new_url"] = $claim->getString("new_url");
            $previewClaim[$cont]["old_phone"] = $claim->getString("old_phone");
            $previewClaim[$cont]["new_phone"] = $claim->getString("new_phone");
            $previewClaim[$cont]["old_fax"] = $claim->getString("old_fax");
            $previewClaim[$cont]["new_fax"] = $claim->getString("new_fax");
            $previewClaim[$cont]["old_address"] = $claim->getString("old_address");
            $previewClaim[$cont]["new_address"] = $claim->getString("new_address");
            $previewClaim[$cont]["old_address2"] = $claim->getString("old_address2");
            $previewClaim[$cont]["new_address2"] = $claim->getString("new_address2");

            $_locations = explode(",", EDIR_LOCATIONS);
            foreach ($_locations as $_location_level) {
                $previewClaim[$cont]["old_location_".$_location_level] = $claim->getString("old_location_".$_location_level);
                $previewClaim[$cont]["new_location_".$_location_level] = $claim->getString("new_location_".$_location_level);
            }
            
            $previewClaim[$cont]["old_zipcode"] = $claim->getString("old_zip_code");
            $previewClaim[$cont]["new_zipcode"] = $claim->getString("new_zip_code");
            
            $oldlistingtemplate = new ListingTemplate($claim->getString("old_listingtemplate_id"));
            $newlistingtemplate = new ListingTemplate($claim->getString("new_listingtemplate_id"));
            
            $previewClaim[$cont]["old_listingtemplate"] = $oldlistingtemplate->getString("title");
            $previewClaim[$cont]["new_listingtemplate"] = $newlistingtemplate->getString("title");
            
            $previewClaim[$cont]["old_level"] = $level->showLevel($claim->getString("old_level"));;
            $previewClaim[$cont]["new_level"] = $level->showLevel($claim->getString("new_level"));;
            
            $previewClaim[$cont]["canApprove"] = $claim->canApprove();
            $previewClaim[$cont]["canDeny"] = $claim->canDeny();

            ?>

            <li class="content-item" data-id="<?=$claim->getNumber("id")?>">
                <div class="status"><span class="status-<?=($claim->getString("status") == "approved" ? "active" : ($claim->getString("status") == "denied" ? "pending" : "suspended"))?>"></span></div>
                <div class="item">
                    <h3 class="item-title">
                        <?
                        if ($claim->getString("old_title") == $claim->getString("new_title")) {
                            echo $claim->getString("listing_title");
                        } else {
                            echo $claim->getString("new_title")." (".$claim->getString("old_title").")";
                        }
                        ?>
                    </h3>

                    <p>
                        <span class="item-author">
                            <?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>: <?=system_showAccountUserName($claim->getString("username"));?>
                        </span>
                    </p>
                    <p>
                        <span class="pull-left"><?=system_showText(LANG_LABEL_DATE)?>: <?=format_date($claim->getString("date_time"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($claim->getNumber("date_time"));?></span>
                        <span class="pull-right">
                            <span class="status-<?=($claim->getString("status") == "approved" ? "active" : ($claim->getString("status") == "denied" ? "pending" : "suspended"))?>">
                                <?=@system_showText(constant("LANG_SITEMGR_CLAIM_STATUS_".string_strtoupper($claim->getString("status"))))?>
                            </span>
                        </span>
                    </p>
                </div>
            </li>

        <? } ?>

        </ul>

    </section>