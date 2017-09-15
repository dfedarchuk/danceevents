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
	# * FILE: /includes/tables/table_paging.php
	# ----------------------------------------------------------------------------------------------------

    $array_pages_code = system_preparePagination($paging_url, $url_search_params, $pageObj, ($_GET["letter"] ? $_GET["letter"] : $_POST["letter"]), $screen, RESULTS_PER_PAGE, true);

    if (!$bottomPagination) { ?>

    <div class="top-pagination">

        <? if ($letters_menu) { ?>
            <div class="pagination-char">
                <?=$letters_menu?>
            </div>
        <? } ?>

        <div class="pagination-results">
            <?=(intval($pageObj->getString("record_amount")) == 1 ? system_showText(LANG_PAGING_FOUND) : system_showText(LANG_PAGING_FOUND_PLURAL))?> <strong><?=$pageObj->getString("record_amount")?></strong> <?=(intval($pageObj->getString("record_amount")) == 1 ? system_showText(LANG_PAGING_RECORD) : system_showText(LANG_PAGING_RECORD_PLURAL))?>
        </div>

    </div>

    <? }

    if ($bottomPagination && $array_pages_code["total"] > RESULTS_PER_PAGE) {

        if ($array_pages_code["previous"] || $array_pages_code["first"] || $array_pages_code["pages"] || $array_pages_code["last"] || $array_pages_code["next"]) { ?>

        <nav>
            <ul class="pagination">
                <?=($array_pages_code["previous"] ? $array_pages_code["previous"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&laquo;</a></li>");?>
                <?=$array_pages_code["first"];?>
                <?=$array_pages_code["pages"];?>
                <?=$array_pages_code["last"];?>
                <?=($array_pages_code["next"] ? $array_pages_code["next"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&raquo;</a></li>");?>
            </ul>
        </nav>

        <? }
    }
?>
