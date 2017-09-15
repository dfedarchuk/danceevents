<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/norecords.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER."/categories") !== false) {
        $msgNoRec = str_replace("[link]", DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/categories/category.php", LANG_SITEMGR_NOREC_FOUND_CATEG);
    } elseif (string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER."/categories") !== false) {
        $msgNoRec = str_replace("[link]", DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/categories/category.php", LANG_SITEMGR_NOREC_FOUND_CATEG);
    } elseif (string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER."/categories") !== false) {
        $msgNoRec = str_replace("[link]", DEFAULT_URL."/".SITEMGR_ALIAS."/content/".ARTICLE_FEATURE_FOLDER."/categories/category.php", LANG_SITEMGR_NOREC_FOUND_CATEG);
    } elseif (string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER."/categories") !== false) {
        $msgNoRec = str_replace("[link]", DEFAULT_URL."/".SITEMGR_ALIAS."/content/".CLASSIFIED_FEATURE_FOLDER."/categories/category.php", LANG_SITEMGR_NOREC_FOUND_CATEG);
    } elseif (string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER."/categories") !== false) {
        $msgNoRec = str_replace("[link]", DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BLOG_FEATURE_FOLDER."/categories/category.php", LANG_SITEMGR_NOREC_FOUND_CATEG);
    } else {
        $msgNoRec = LANG_SITEMGR_NOREC_FOUND;
    }
?>

    <section class="heading">

        <h1><?=system_showText(LANG_SITEMGR_NOREC_WAIT);?></h1>
        <h2><?=system_showText($msgNoRec);?></h2>
        
        <hr>
        <p><?=str_replace("[a]", "<a href=\"http://support.edirectory.com\" class=\"text-warning\" target=\"_blank\">", str_replace("[/a]", "</a>", system_showText(LANG_SITEMGR_NOREC_SUPPORT)));?></p>

    </section>

    <?
    $looseJS = "$('#check-all').addClass('hidden');";
    JavaScriptHandler::registerOnReady($looseJS);
    ?>
