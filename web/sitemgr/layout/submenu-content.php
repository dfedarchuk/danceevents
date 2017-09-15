<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/layout/submenu-content.php
	# ----------------------------------------------------------------------------------------------------

    $subMenuManage = true;
    $bulkUpdateOption = true;
    $labelAddMultItem = null;
    if (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER."/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/listinglevel.php";
        $labelAddItem = system_showText(LANG_MENU_ADDLISTING);
        $linkClaim = true;
        $manageSearch = true;
        $moduleFolder = LISTING_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_LISTING_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER."/categories/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/categories/category.php".($_GET["category_id"] ? "?category_id=".$_GET["category_id"] : "");
        $labelAddItem = system_showText(LANG_SITEMGR_LANG_SITEMGR_ADDCATEGORY);
        $labelAddMultItem = system_showText(LANG_SITEMGR_ADD_MULT_CATEGORY);
        $linkClaim = true;
        $manageSearch = false;
        $moduleFolder = LISTING_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_LISTING_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER."/claim/index.php") !== false) {
        $linkAddItem = false;
        $labelAddItem = false;
        $linkClaim = true;
        $manageSearch = true;
        $bulkUpdateOption = false;
        $moduleFolder = LISTING_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_LISTING_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER."/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".ARTICLE_FEATURE_FOLDER."/article.php";
        $labelAddItem = system_showText(LANG_MENU_ADDARTICLE);
        $manageSearch = true;
        $moduleFolder = ARTICLE_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_ARTICLE_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER."/categories/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".ARTICLE_FEATURE_FOLDER."/categories/category.php".($_GET["category_id"] ? "?category_id=".$_GET["category_id"] : "");
        $labelAddItem = system_showText(LANG_SITEMGR_LANG_SITEMGR_ADDCATEGORY);
        $labelAddMultItem = system_showText(LANG_SITEMGR_ADD_MULT_CATEGORY);
        $manageSearch = false;
        $moduleFolder = ARTICLE_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_ARTICLE_PLURAL;
    }  elseif (string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER."/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".CLASSIFIED_FEATURE_FOLDER."/classifiedlevel.php";
        $labelAddItem = system_showText(LANG_MENU_ADDCLASSIFIED);
        $manageSearch = true;
        $moduleFolder = CLASSIFIED_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_CLASSIFIED_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER."/categories/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".CLASSIFIED_FEATURE_FOLDER."/categories/category.php".($_GET["category_id"] ? "?category_id=".$_GET["category_id"] : "");
        $labelAddItem = system_showText(LANG_SITEMGR_LANG_SITEMGR_ADDCATEGORY);
        $labelAddMultItem = system_showText(LANG_SITEMGR_ADD_MULT_CATEGORY);
        $manageSearch = false;
        $moduleFolder = CLASSIFIED_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_CLASSIFIED_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER."/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/eventlevel.php";
        $labelAddItem = system_showText(LANG_MENU_ADDEVENT);
        $manageSearch = true;
        $moduleFolder = EVENT_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_EVENT_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER."/categories/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/categories/category.php".($_GET["category_id"] ? "?category_id=".$_GET["category_id"] : "");
        $labelAddItem = system_showText(LANG_SITEMGR_LANG_SITEMGR_ADDCATEGORY);
        $labelAddMultItem = system_showText(LANG_SITEMGR_ADD_MULT_CATEGORY);
        $manageSearch = false;
        $moduleFolder = EVENT_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_EVENT_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER."/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BLOG_FEATURE_FOLDER."/blog.php";
        $labelAddItem = system_showText(LANG_MENU_ADDPOST);
        $manageSearch = true;
        $moduleFolder = BLOG_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_POST_BLOG_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER."/categories/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BLOG_FEATURE_FOLDER."/categories/category.php".($_GET["category_id"] ? "?category_id=".$_GET["category_id"] : "");
        $labelAddItem = system_showText(LANG_SITEMGR_LANG_SITEMGR_ADDCATEGORY);
        $labelAddMultItem = system_showText(LANG_SITEMGR_ADD_MULT_CATEGORY);
        $manageSearch = false;
        $moduleFolder = BLOG_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_POST_BLOG_PLURAL;
    } elseif (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER."/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".PROMOTION_FEATURE_FOLDER."/deal.php";
        $labelAddItem = system_showText(LANG_MENU_ADDPROMOTION);
        $manageSearch = true;
        $moduleFolder = PROMOTION_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_PROMOTION_PLURAL;
        $subMenuManage = false;
    } elseif (string_strpos($_SERVER["PHP_SELF"], BANNER_FEATURE_FOLDER."/index.php") !== false) {
        $linkAddItem = DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BANNER_FEATURE_FOLDER."/banner.php";
        $labelAddItem = system_showText(LANG_MENU_ADDBANNER);
        $manageSearch = true;
        $moduleFolder = BANNER_FEATURE_FOLDER;
        $labelManage = LANG_SITEMGR_BANNER_PLURAL;
        $subMenuManage = false;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "reviews-comments/index.php") !== false) {
        $linkAddItem = false;
        $labelAddItem = false;
        $manageSearch = true;
        $moduleFolder = "reviews-comments";
        $subMenuManage = true;

    } elseif (string_strpos($_SERVER["PHP_SELF"], "terms/index.php") !== false) {
        $linkAddItem = false;
        $labelAddItem = false;
        $manageSearch = true;
        $moduleFolder = "geography/terms";
        $subMenuManage = false;

    }
?>
    <div class="content-control" id="search-all">

        <div class="row">
            <? if ($manageSearch) { ?>
            <form class="form-inline" role="search" action="<?=system_getFormAction($_SERVER["PHP_SELF"]);?>" method="get">
                <div class="col-md-4 col-sm-8 col-xs-6 control-search">
                    <div class="control-searchbar">
                        <? if ($bulkUpdateOption) { ?>
                            <div class="bulk-check-all">
                                <label class="sr-only">Check all</label>
                                <input type="checkbox" id="check-all">
                            </div>
                        <? } ?>
                        <? if ($moduleFolder != "reviews-comments") { ?>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control search hidden-xs" name="search_title" value="<?=$search_title;?>" onblur="populateField(this.value, 'search_title');" placeholder="<?=system_showText(LANG_LABEL_SEARCHKEYWORD);?>">
                                    <div class="input-group-btn">
                                        <!-- Button and dropdown menu -->
                                        <button class="btn btn-default hidden-xs" onclick="$('#search').submit();"><?=system_showText(LANG_SITEMGR_SEARCH);?></button>
                                        <? if ($moduleFolder != "geography/terms") { ?>
                                        <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="modal" data-target="#modal-search" >
                                            <span class="hidden-xs caret"></span>
                                            <i class="visible-xs icon-ion-ios7-search"></i>
                                        </button>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </form>
            <? } ?>

            <? if ($moduleFolder != "geography/terms") { ?>

            <div class="<?=($manageSearch !== false ? "col-md-5" : "col-md-4") ?> col-sm-4 col-xs-6 <?=($manageSearch !== false ? "" : "col-md-offset-4") ?> control-responsive">

                <span class="btn btn-info btn-responsive" data-toggle="dropdown" title="Groups"><i class="icon-ion-ios7-folder-outline"></i></span>

                <? if ($subMenuManage) { ?>
                <div class="dropdown-menu control-folders">
                    <div class="btn-group btn-group-sm">
                        <? if ($moduleFolder == "reviews-comments") { ?>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/".$moduleFolder."/index.php"?>" class="btn btn-info <?=(string_strpos($_SERVER["REQUEST_URI"], "item_type=listing") === false && string_strpos($_SERVER["REQUEST_URI"], "item_type=article") === false ? "active" : "")?>"><?=string_ucwords(system_showText(LANG_SITEMGR_ALL));?></a>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/".$moduleFolder."/index.php?item_type=listing"?>" class="btn btn-info <?=(string_strpos($_SERVER["REQUEST_URI"], "item_type=listing") !== false ? "active" : "")?>"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING_SING));?></a>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/".$moduleFolder."/index.php?item_type=article"?>" class="btn btn-info <?=(string_strpos($_SERVER["REQUEST_URI"], "item_type=article") !== false ? "active" : "")?>"><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_SING));?></a>
                        <? } else { ?>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".$moduleFolder."/"?>" class="btn btn-info <?=(string_strpos($_SERVER["PHP_SELF"], $moduleFolder."/index.php") !== false ? "active" : "")?>"><?=string_ucwords(system_showText($labelManage))?></a>
                            <? if ($linkClaim) { ?>
                                <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".$moduleFolder."/claim/"?>" class="btn btn-info <?=(string_strpos($_SERVER["PHP_SELF"], $moduleFolder."/claim/index.php") !== false ? "active" : "")?>"><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_CLAIMEDLISTINGS))?></a>
                            <? } ?>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".$moduleFolder."/categories/"?>" class="btn btn-info <?=(string_strpos($_SERVER["PHP_SELF"], $moduleFolder."/categories/index.php") !== false ? "active" : "")?>"><?=system_showText(LANG_SITEMGR_MENU_MANAGECATEGORIES)?></a>
                        <? } ?>
                    </div>
                </div>
                <? } ?>

                <? if ($labelAddItem) { ?>
                <a class="btn btn-primary btn-responsive" title="<?=$labelAddItem;?>" href="<?=$linkAddItem?>"><i class="icon-cross8"></i></a>
                <? } ?>

            </div>
            <? } ?>

            <? if ($labelAddItem || $labelAddMultItem) { ?>
            <div class="<?=($manageSearch !== false ? "col-md-3" : "col-md-4") ?> col-sm-12 control-add">
                <div class="control-bar">
                    <? if ($labelAddMultItem) { ?>
                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-mult-categories" id="add-mult-categories"><i class="icon-cross8"></i> <?=$labelAddMultItem;?></a>
                    <? } ?>
                    <a class="btn btn-sm btn-primary" href="<?=$linkAddItem?>"><i class="icon-cross8"></i> <?=$labelAddItem;?></a>
                </div>
            </div>
            <? } ?>

        </div>

    </div>
