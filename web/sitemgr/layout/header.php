<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/header.php
	# ----------------------------------------------------------------------------------------------------

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

    setting_get("sitemgr_language", $sitemgr_language);
    customtext_get("header_title", $headertag_title);
    $headertag_title = $headertag_title ? $headertag_title : EDIRECTORY_TITLE;
    $checkIE = is_ie(false, $ieVersion);
    $sitemgr_languageArr = explode("_", $sitemgr_language);

    // Use this code only for development areas
    if (file_exists(EDIRECTORY_ROOT."/custom/tokenless")) {
       $options = array("compress" => true, "relativeUrls" => false);
       include_once(CLASSES_DIR."/less/Less.php");
       $less = new Less_Parser($options);
       $less->parseFile(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/assets/style/adminpanel.less", DEFAULT_URL."/".SITEMGR_ALIAS."/assets/style/less/");
       $css = $less->getCss();
       file_put_contents(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/assets/style/adminpanel.css", $css);
    }

?>

<!DOCTYPE html>
<html class="no-js" lang="<?=system_getHeaderLang();?>">
    <head>
        <title><?=((string_strpos($_SERVER["PHP_SELF"], "registration.php")) ? "" : system_showText(LANG_SITEMGR_HOME_WELCOME). " - ").$headertag_title;?></title>
        <meta name="author" content="Arca Solutions" />
        <meta charset="<?=EDIR_CHARSET;?>" />
        <meta name="ROBOTS" content="noindex, nofollow" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>

        <? if ($facebookScript) { ?>
            <meta property="fb:app_id" content="<?=FACEBOOK_API_ID?>"/>
		<? } ?>

        <?=system_getFavicon();?>

        <!-- Custom styles for this template -->
        <link href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/style/adminpanel.css" rel="stylesheet" type="text/css">
    </head>

    <body <?=(BRANDED_PRINT == "on" ? "class=\"branded\"" : "")?>>
