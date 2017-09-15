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
    # * FILE: /includes/code/contactus.php
    # ----------------------------------------------------------------------------------------------------

    //Links to twitter, facebook and linkedin
    setting_get("twitter_account", $setting_twitter_link);
    setting_get("setting_facebook_link", $setting_facebook_link);
    setting_get("setting_linkedin_link", $setting_linkedin_link);
    setting_get("setting_instagram_link", $setting_instagram_link);
    setting_get("setting_googleplus_link", $setting_googleplus_link);
    setting_get("setting_pinterest_link", $setting_pinterest_link);

    //Contact Us info
    setting_get("contact_address", $contact_address);
    setting_get("contact_zipcode", $contact_zipcode);
    setting_get("contact_country", $contact_country);
    setting_get("contact_state", $contact_state);
    setting_get("contact_city", $contact_city);
    setting_get("contact_phone", $contact_phone);

    $contactInfo = array();
    $locInfo = array();
    $contactInfoStr = "";

    if ($contact_address || $contact_zipcode || $contact_country || $contact_state || $contact_city || $contact_phone) {
        if ($contact_phone) {
            $contactInfo[] = system_showText(LANG_LABEL_PHONE).": ".$contact_phone;
        }
        if ($contact_address) {
            $contactInfo[] = system_showText(LANG_LABEL_ADDRESS).": ".$contact_address;
        }
        if ($contact_city) {
            $locInfo[] = $contact_city;
        }
        if ($contact_state) {
            $locInfo[] = $contact_state;
        }
        if ($contact_country) {
            $locInfo[] = $contact_country;
        }
        if ($contact_zipcode) {
            $locInfo[] = $contact_zipcode;
        }
        if (count($locInfo)) {
            $contactInfo[] = implode(", ", $locInfo);
        }

        if (count($contactInfo)) {
            $contactInfoStr = implode("<br />", $contactInfo)."<br />";
        }
    }