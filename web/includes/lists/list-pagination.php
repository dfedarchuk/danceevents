<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/lists/list-pagination.php
	# ----------------------------------------------------------------------------------------------------

    $array_pages_code = system_preparePagination($paging_url, $url_search_params, $pageObj, ($_GET["letter"] ? $_GET["letter"] : $_POST["letter"]), $screen, RESULTS_PER_PAGE, true);
    $showing_total = ($screen ? RESULTS_PER_PAGE * ($screen - 1) : 1);
    $showing_from = ($screen ? RESULTS_PER_PAGE * $screen : ($pageObj->getString("record_amount") > RESULTS_PER_PAGE ? RESULTS_PER_PAGE : $pageObj->getString("record_amount")));

?>

    <div class="col-md-6 col-sm-6 col-xs-12">

    <?
        if ((is_object($status) && string_strpos($_SERVER["PHP_SELF"], "/account/") === false) || $manageModule == "review") {
            if (isset($status)){
                $statusValues = $status->getValues();
                $statusNames = $status->getNames();
            }
            $searchLevelStr = "search_level";

            switch ($manageModule){
                case "banner" :
                    $searchLevelStr = "search_type";
                    break;
                case "blog":
                    $statusNames = [
                        system_showText(LANG_LABEL_ACTIVE),
                        system_showText(LANG_LABEL_SUSPENDED),
                        system_showText(LANG_LABEL_PENDING)
                    ];
                    $statusValues = ["A", "S", "P"];
                    break;
                case "review":
                    $statusNames = [
                        system_showText(LANG_LABEL_APPROVED),
                        system_showText(LANG_LABEL_PENDING)
                    ];
                    $statusValues = [1, 0];
                    $searchLevelStr = "item_type";
                    break;
            }
            $url_search_paramsOrder = system_getURLSearchParams((($_POST)?($_POST):($_GET)), false);

    ?>

        <div class="btn-group btn-group-xs">
            <? if (!in_array($manageModule, ["review", "nearbySearch"])) { ?>
                <div class="btn-group btn-group-xs dropup group-ordering " id="paginationSorting">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="label-dropup"><?=system_showText(LANG_PAGING_ORDERBYPAGE);?></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" data-group="#paginationSorting">
                        <li class="option-dropup" onclick="window.location = '<?=$paging_url."?".$url_search_paramsOrder?>'"><span><?=system_showText(LANG_PAGING_ORDERBYPAGE_LASTUPDATE);?></span></li>
                        <li class="option-dropup" onclick="window.location = '<?=$paging_url."?".$url_search_paramsOrder."&amp;order_by=".($manageModule == "promotion" ? "name" : ($manageModule == "banner" ? "caption" : "title"))."_asc"?>'"><span><?=system_showText(LANG_LABEL_TITLE);?></span></li>
                        <? if ($manageModule != "promotion") { ?>
                            <? if ($manageModule != "article" && $manageModule != "blog") { ?>
                                <li class="option-dropup" onclick="window.location = '<?=$paging_url."?".$url_search_paramsOrder."&amp;order_by=level_desc"?>'"><span><?=system_showText(LANG_LABEL_LEVEL);?></span></li>
                            <? } ?>
                            <li class="option-dropup" onclick="window.location = '<?=$paging_url."?".$url_search_paramsOrder."&amp;order_by=status_asc"?>'"><span><?=system_showText(LANG_LABEL_STATUS);?></span></li>
                        <? } ?>
                    </ul>
                </div>
            <? } ?>

            <? if (!in_array($manageModule, ["promotion", "nearbySearch"])) { ?>
                <div class="btn-group btn-group-xs dropup group-ordering" id="paginationDisplaying">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="label-dropup"><?=system_showtext(LANG_LABEL_FILTERBY)?></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" data-group="#paginationDisplaying">
                        <? if ($manageModule != "article" && $manageModule != "blog") { ?>
                            <? if (is_array($activeLevels) && count($activeLevels)) foreach ($activeLevels as $actLevel) { ?>
                                <li class="option-dropup" onclick="window.location = '<?=$paging_url."?".str_replace("$searchLevelStr={$_GET["$searchLevelStr"]}", "", $url_search_params)."&amp;$searchLevelStr=$actLevel"?>'"><span><?=ucfirst($level->getName($actLevel))?></span></li>
                            <? } ?>
                            <li class="divider"></li>
                        <? } ?>
                        <? foreach ($statusValues as $k => $value) { ?>
                            <li class="option-dropup" onclick="window.location = '<?=$paging_url."?".str_replace("search_status={$_GET["search_status"]}", "", $url_search_params)."&amp;search_status=$value"?>'"><span><?=$statusNames[$k]?></span></li>
                        <? } ?>
                    </ul>
                </div>
            <? } ?>

        </div>

    <? } else {
        echo "&nbsp;";
    } ?>

    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="pull-right">

            <span class="pagination-results">
                <?=system_showText(LANG_PAGING_SHOWING);?> <b><?=($showing_total ? $showing_total : 1)?> - <?=($showing_from)?></b> <?=system_showText(LANG_PAGING_PAGEOF)?> <span><?=$pageObj->getString("record_amount")?></span> <?=(intval($pageObj->getString("record_amount")) == 1 ? system_showText(LANG_PAGING_RECORD) : system_showText(LANG_PAGING_RECORD_PLURAL))?>
            </span>

            <? if ($array_pages_code["previous"] || $array_pages_code["first"] || $array_pages_code["pages"] || $array_pages_code["last"] || $array_pages_code["next"]) { ?>

                <ul class="pagination pagination-sm">
                    <?=($array_pages_code["previous"] ? $array_pages_code["previous"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&laquo;</a></li>");?>
                    <?=$array_pages_code["first"];?>
                    <?=$array_pages_code["pages"];?>
                    <?=$array_pages_code["last"];?>
                    <?=($array_pages_code["next"] ? $array_pages_code["next"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&raquo;</a></li>");?>
                </ul>

            <? } ?>

        </div>
    </div>
