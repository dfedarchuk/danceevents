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
	# * FILE: /sponsors/listing/navbar.php
	# ----------------------------------------------------------------------------------------------------

    $listObj = new Listing($id);
    $levelList = new ListingLevel(true);

    $listingHasClickToCall = $levelList->getHasCall($listObj->getNumber("level"));

    if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on"  && $listingHasClickToCall == "y") {
?>

    <nav>
        <ul class="nav nav-tabs nav-justified">
            <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listing") !== false) ? "class=\"active\"" : "") ?>>
                <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER?>/listing.php?id=<?=$id?>"><?=system_showText(LANG_LISTING_INFORMATION)?></a>
            </li>

            <? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on"  && $listingHasClickToCall == "y") { ?>
                <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/clicktocall") !== false) ? "class=\"active\"" : "") ?> >
                    <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER?>/clicktocall.php?id=<?=$id?>"><?=system_showText(LANG_LABEL_ACTIVATECLICKCALL)?></a>
                </li>
            <? } ?>
        </ul>
    </nav>

<? } ?>
