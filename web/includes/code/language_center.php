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
# * FILE: /includes/code/language_center.php
# ----------------------------------------------------------------------------------------------------

if ($actionFrom == "changeLang") {

    if (isset($active) && $id) {
        $langObj = new Lang($id);
        $langObj->changeDefaultLang();
        $langObj->writeLanguageFile();

        $domainDatabase = DatabaseHandler::getDomainConnection();

        /* Counts how much stuff will be synchronized. If it's too much, we won't synchronize anything */
        $rebuildElastic = ($result = $domainDatabase->query("SELECT (SELECT COUNT(id) FROM `Article`) + (SELECT COUNT(id) FROM `Post`) + (SELECT COUNT(id) FROM `Classified`) + (SELECT COUNT(id) FROM `Promotion`) + (SELECT COUNT(id) FROM `Event`) + (SELECT COUNT(id) FROM `Listing`) + (SELECT COUNT(id) FROM `ArticleCategory`) + (SELECT COUNT(id) FROM `BlogCategory`) + (SELECT COUNT(id) FROM `ClassifiedCategory`) + (SELECT COUNT(id) FROM `EventCategory`) + (SELECT COUNT(id) FROM `ListingCategory`) AS 'count'")
            and $response = $result->fetchObject()
            and $response->count < 10000);

        // Saves yaml
        $domain = new Domain(SELECTED_DOMAIN_ID);
        $symfony = new Symfony('domain.yml');
        $lang = [
            'rebuildElastic'          => (DEMO_LIVE_MODE ? false : $rebuildElastic),
            $domain->getString('url') => [
                'locale' => ($id == "ge_ge" ? "de_de" : $id),
            ],
        ];
        $symfony->save('multi_domain', $lang);


        $url_redirect .= "?message=2";
        header("Location: $url_redirect");
        exit;
    } elseif (isset($activeAdmin) && $id) {
        if (!setting_set("sitemgr_language", $id)) {
            if (!setting_new("sitemgr_language", $id)) {
                $error = true;
            }
        }

        $url_redirect .= "?message_admin=2";
        header("Location: $url_redirect");
        exit;
    }

}

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
$allLanguages = unserialize(LANGUAGE_INFORMATION);

if ($actionFrom == "changeLang") {

    setting_get("sitemgr_language", $sitemgr_language);
    $flagFolder = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/lang/flags";

}
