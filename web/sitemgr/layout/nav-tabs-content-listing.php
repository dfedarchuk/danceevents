<?php
    /**
    * # Admin Panel for eDirectory
    * @copyright Copyright 2015 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/nav-tabs-content-listing.php
	# ----------------------------------------------------------------------------------------------------

    $matches = null;
    preg_match( "/(\w*)(?=\.php)/", $_SERVER['PHP_SELF'], $matches );

    empty( $matches ) or $activeTab[ array_pop( $matches ) ] = 'class="active"';
?>

    <? if ($id) { ?>
        <ul class="nav nav-tabs pull-left" role="tablist">
            <li <?= $activeTab['listing']; ?>>
                <a href="<?=$url_redirect?>/listing.php?id=<?=$id?>" role="tab"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EDITINFORMATION);?></a>
            </li>

            <? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on" && $levelObj->getHasCall($listing->getNumber("level")) == "y") { ?>
            <li <?= $activeTab['clicktocall']; ?>>
                <a href="<?=$url_redirect?>/clicktocall.php?id=<?=$id?>" role="tab"><?=system_showText(LANG_LABEL_CLICKTOCALL);?></a>
            </li>
            <? } ?>

            <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" && ($levelObj->getDeals($listing->getNumber("level")) > 0) ){ ?>
            <li <?= $activeTab['deal']; ?>>
                <a href="<?=$url_redirect?>/deal.php?id=<?=$id?>" role="tab"><?=system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL);?></a>
            </li>
            <? } ?>
            <?php
            if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on"
                && $levelObj->getClassifiedQuantityAssociation($listing->getNumber("level")) > 0) {
                printf('<li %s><a href="%s/classified.php?id=%d" role="tab">%s</a></li>',
                    $activeTab['classified'],
                    $url_redirect,
                    $id,
                    ucfirst(system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL))
                );
            }
            ?>
        </ul>
    <? } ?>
