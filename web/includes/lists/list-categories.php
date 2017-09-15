<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/lists/list-categories.php
    # ----------------------------------------------------------------------------------------------------

    if ($table_category == "ListingCategory") {
        $maxLevelCat = LISTING_CATEGORY_LEVEL_AMOUNT;
    } else {
        $maxLevelCat = CATEGORY_LEVEL_AMOUNT;
    }

    if (is_numeric($message) && isset($msg_category[$message])) { ?>
        <p class="alert alert-success"><?=$msg_category[$message]?></p>
    <? }

    if (is_numeric($langmessage) && isset($msg_category[$langmessage])) {
        if (is_numeric($featmessage)) { ?>
            <p class="alert alert-info"><?=$msg_category[$langmessage]."<br />".$msg_category[$featmessage]?></p>
        <? } else { ?>
            <p class="alert alert-info"><?=$msg_category[$langmessage]?></p>
        <? }
    } else if (is_numeric($featmessage))  { ?>
        <p class="alert alert-info"><?=$msg_category[$featmessage]?></p>
    <? } ?>

    <section>

        <ul class="list-content-item no-bulk tree">

            <?
            $path_count = 1;
            if ($category_id) { ?>
                <li class="breadcrumb">
                <? $categoryObj = new $table_category($category_id);
                $path_elem_array = $categoryObj->getFullPath();
                if ($path_elem_array) {
                    foreach ($path_elem_array as $each_category) { ?>
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".$moduleFolder."/categories/"?>"><?=system_showText(LANG_SITEMGR_MENU_MANAGECATEGORIES)?></a>
                        <?
                        if ($category_id == $each_category["id"]) {
                            echo "&raquo; ".$each_category["title"];
                        } else {
                            echo " <a href=\"".$url_redirect."/index.php?category_id=".$each_category["id"]."&screen=".$screen."&letter=".$letter.(($url_search_params) ? "&$url_search_params" : "")."\">&raquo; ".$each_category["title"]."</a>";
                        }
                        $path_count++;
                    }
                } ?>
                </li>
            <? }

            foreach ($categories as $category) {
                $categoryObj = new $table_category($category);
                $id = $categoryObj->getNumber("id");
                $subcategories = db_getFromDB(strtolower($table_category), "category_id", $id, "all", "title", "object", SELECTED_DOMAIN_ID, false, "id, `title`");
            ?>

            <li class="content-item-noview">

                <div class="tree-content">
                    <? if (count($subcategories) > 0) { ?>
                    <div class="tree-control" title="<?=system_showText(LANG_SITEMGR_SUBCATEGORIES);?>" onclick="window.location.href='<?=$url_redirect?>/index.php?category_id=<?=$id?>'">
                        <div class="btn btn-primary" data-toggle="category-tree"><i class="icon-folder56"></i></div>
                    </div>
                    <? } ?>

                    <div class="item">
                        <h3 class="item-title"><?=$categoryObj->getString("title", true, 90); ?></h3>
                        <p>
                            <? if ($categoryObj->getString("enabled") == "y") { ?>
                            <span class="status-active"><?=system_showText(LANG_SITEMGR_ACTIVE);?></span>
                            <? } else { ?>
                            <span class="status-pending"><?=system_showText(LANG_SITEMGR_DISABLED);?></span>
                            <? } ?>
                        </p>
                        <p>

                            <? if ($path_count < $maxLevelCat) { ?>
                            <span>
                                <?=system_showText(LANG_SITEMGR_SUBCATEGORIES)?>:
                                <?=count($subcategories);?>
                            </span>
                            <? } ?>

                            <span class="btn-group btn-group-xs">
                                <a class="btn btn-primary" href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                    <?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?>
                                </a>

                                <? if ($path_count < $maxLevelCat) { ?>
                                <a class="btn btn-primary" href="<?=$url_redirect?>/category.php?category_id=<?=$id?>">
                                    <?=system_showText(LANG_SITEMGR_CATEGORY_ADDSUBCATEGORY)?>
                                </a>
                                <? } ?>

                                <a class="btn btn-primary" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$id?>)">
                                    <?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?>
                                </a>
                            </span>
                        </p>
                    </div>
                </div>

            </li>
        <? } ?>

        </ul>

    </section>
