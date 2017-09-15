<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/reports/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
	permission_hasSMPerm();

	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    $chartColors     = array();
    $chartColors[1]  = "336699";
    $chartColors[2]  = "6699CC";
    $chartColors[3]  = "339933";
    $chartColors[4]  = "00CC00";
    $chartColors[5]  = "CC3300";
    $chartColors[6]  = "FF6600";
    $chartColors[7]  = "FF9933";
    $chartColors[8]  = "CC9966";
    $chartColors[9]  = "999999";
    $chartColors[10] = "996699";
    $chartColors[11] = "9999FF";
    $chartColors[12] = "339999";
    $chartColors[13] = "A5A469";
    $chartColors[14] = "000000";
    $chartColors[15] = "666666";

    $modules[] = "h";
    $modules[] = "l";
    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") $modules[] = "d";
    if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") $modules[] = "e";
    if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") $modules[] = "c";
    if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") $modules[] = "a";
    if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") $modules[] = "p";

    $url   = DEFAULT_URL.'/'.SITEMGR_ALIAS.'/activity/reports/index.php';
    // Query string
    $qs    = $_SERVER['QUERY_STRING'];
    while ($start = string_strpos($qs, "&module=")) {
        $end   = string_strpos($qs, '&', $start+1);
        $end   = $end === false ? string_strlen($qs) : $end;
        $qs = string_substr($qs, 0, $start).string_substr($qs, $end, 999);
    }
    $url .= '?'.$qs.($qs ? '&' : '').'module=';

    # ----------------------------------------------------------------------------------------------------
    # GET DATABASE
    # ----------------------------------------------------------------------------------------------------
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $sql = "SELECT DISTINCT YEAR(`day`) AS `year` FROM `Report_Statistic_Daily` ORDER BY `year` DESC";
    $result = $db->query($sql);
    $years = array();
    if ($result) {
        while ($row = mysql_fetch_array($result)) {
            $years[] = $row['year'];
        }
    }
    if (!$_GET['month']) {
        $date = date('n');
    } else {
        $date = $_GET['month'];
    }

    # ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

    # ----------------------------------------------------------------------------------------------------
	# SIDEBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-activity.php");

?>

        <main class="wrapper togglesidebar container-fluid">

            <?php
            require(SM_EDIRECTORY_ROOT."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?>

            <section class="heading">
                <h1><?=string_ucwords(system_showText(LANG_SITEMGR_REPORTS))?></h1>
                <p><?=system_showText(LANG_SITEMGR_REPORT_STATISTICREPORT_ALERT);?></p>
            </section>

            <div id="reportRefreshStatus" class="alert alert-info alert-block" style="display:none"></div>

            <section class="row">
                <div class="form-container">

                    <?
                    require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");

                    if (count($years) >= 0) { ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <form name="searchStatistReport" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get" role="form">
                                    <div class="form-horizontal row">
                                        <div class="col-lg-2 col-sm-4">
                                            <p class="control-label"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_SELECTAPERIOD)?>:</p>
                                        </div>

                                        <div class="col-lg-3 col-sm-4">
                                            <div class="form-group row">
                                                <label class="col-sm-4 control-label"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>: </label>
                                                <div class="selectize col-sm-8">
                                                    <select name='month'>
                                                        <option value='1'  <?=($date == 1) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JANUARY)?></option>
                                                        <option value='2'  <?=($date == 2) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_FEBRUARY)?></option>
                                                        <option value='3'  <?=($date == 3) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_MARCH)?></option>
                                                        <option value='4'  <?=($date == 4) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_APRIL)?></option>
                                                        <option value='5'  <?=($date == 5) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_MAY)?></option>
                                                        <option value='6'  <?=($date == 6) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JUNE)?></option>
                                                        <option value='7'  <?=($date == 7) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JULY)?></option>
                                                        <option value='8'  <?=($date == 8) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_AUGUST)?></option>
                                                        <option value='9'  <?=($date == 9) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_SEPTEMBER)?></option>
                                                        <option value='10' <?=($date == 10) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_OCTOBER)?></option>
                                                        <option value='11' <?=($date == 11) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_NOVEMBER)?></option>
                                                        <option value='12' <?=($date == 12) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_DECEMBER)?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-4">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>: </label>
                                                <div class="selectize col-sm-8">
                                                    <select name='year'>
                                                        <? foreach($years as $year) { ?>
                                                            <option value='<?=$year;?>' <?=($_GET['year'] == $year) ? "selected='selected'" : ""; ?>><?=$year;?></option>
                                                        <? } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-sm-6 col-xs-6">
                                            <input type="submit" value="<?=system_showText(LANG_SITEMGR_SEARCH)?>" class="btn btn-primary btn-block" />
                                        </div>

                                        <div class="col-lg-2 col-sm-6 col-xs-6">
                                            <a href="javascript:void(0)" class="btn btn-default btn-icon btn-block" onclick="doRefreshStatus()" title="<?=system_showText(LANG_SITEMGR_REPORT_REFRESHNOW)?>"><i class="icomoon-loop"></i></a>
                                        </div>
                                    </div>
                                </form>
					        <? } else { ?>
					            <p class="text-info"><?=system_showText(LANG_SITEMGR_REPORT_REPORTEMPTYMESSAGE)?></p>
					        <? } ?>
                            </div>

                            <?
                            if (($_GET["year"]) && ($_GET['month']) && is_numeric($_GET["year"]) && is_numeric($_GET['month'])) {
                                $openActiveModule = true;
                                $sql = "SELECT `module`, `key`, `value`, SUM(`quantity`) AS quantity FROM `Report_Statistic_Daily` WHERE YEAR(`day`) = '".$_GET["year"]."' AND MONTH(`day`) = '".$_GET["month"]."' GROUP BY `module`, `key`, `value` ORDER BY `module` ASC, `key` ASC, `quantity` DESC;";
                                $dbMain = db_getDBObject(DEFAULT_DB, true);
                                if (defined("SELECTED_DOMAIN_ID")) {
                                    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                                } else {
                                    $db = db_getDBObject();
                                }
                                $result = $db->query($sql);

                                if ($result) {
                                    $report = array();
                                    $reportTotalKey = array();
                                    $actualModule = "none";
                                    $actualKey = "none";

                                    while ($row = mysql_fetch_array($result)) {
                                        $module     = $row["module"];
                                        $key        = $row["key"];
                                        $value      = $row["value"];
                                        $quantity   = $row["quantity"];

                                        if($actualModule != $module) {
                                            $actualModule = $module;
                                            $report[$actualModule] = array();
                                            $reportTotalKey[$actualModule] = array();
                                        }

                                        if($actualKey != $key) {
                                            $totalKey = 0;
                                            $actualKey = $key;
                                            $report[$actualModule][$actualKey] = array();
                                            $reportTotalKey[$actualModule][$actualKey] = 0;
                                        }

                                        if(count($report[$actualModule][$actualKey]) < 15 ) {
                                            $report[$actualModule][$actualKey][$value]["quantity"] = $quantity;
                                            $reportTotalKey[$actualModule][$actualKey] += $quantity;
                                        }
                                    }
                                }

                                /* TABS */
                                echo "<ul class=\"nav nav-tabs\">";
                                foreach ($modules as $module) {
                                    if($module == 'h') $name = system_showText(LANG_SITEMGR_REPORT_GENERALSEARCHES);
                                    if($module == 'l') $name = system_showText(LANG_SITEMGR_NAVBAR_LISTING);
                                    if($module == 'd') $name = system_showText(LANG_SITEMGR_NAVBAR_PROMOTION);
                                    if($module == 'a') $name = system_showText(LANG_SITEMGR_NAVBAR_ARTICLE);
                                    if($module == 'e') $name = system_showText(LANG_SITEMGR_NAVBAR_EVENT);
                                    if($module == 'c') $name = system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED);
                                    if($module == 'p') $name = system_showText(LANG_MENU_BLOG);
                                    echo "<li id='style_module_".$module."'><a href=\"javascript:void(0);\" onclick=\"javascript:displayReport('module_".$module."');\">".$name."</a></li>";
                                }
                                echo "</ul><br class=\"clear\">";

                                foreach ($modules as $module) { ?>

                                    <div id="module_<?=$module;?>" style='display:none;'>
                                        <div class='responsive-table'>
                                            <table class='table table-reports'>
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">
                                                            <?=system_showText(LANG_SITEMGR_REPORT_STATISTICREPORT)?> :
                                                            <span>
                                                            <?
                                                                if($module == 'h') echo system_showText(LANG_SITEMGR_REPORT_GENERALSEARCHES);
                                                                if($module == 'l') echo string_ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL));
                                                                if($module == 'd') echo string_ucwords(system_showText(LANG_SITEMGR_PROMOTION_PLURAL));
                                                                if($module == 'a') echo string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL));
                                                                if($module == 'e') echo string_ucwords(system_showText(LANG_SITEMGR_EVENT_PLURAL));
                                                                if($module == 'c') echo string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL));
                                                                if($module == 'p') echo string_ucwords(system_showText(LANG_MENU_BLOG));
                                                            ?>
                                                            </span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <? /* keywords */ ?>
                                                    <? if(count($report[$module]['keywords']) > 0) { ?>
                                                        <tr>
                                                            <td>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_REPORT_TOP15KEYWORDS)?></div>
                                                                    <table class="table">
                                                                        <?
                                                                        $idx = 1;
                                                                        $colorList   = array();
                                                                        $percentList = array();
                                                                        $labelList   = array();
                                                                        foreach ($report[$module]['keywords'] as $data => $quantity) {
                                                                            $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['keywords']), 2);
                                                                            echo "<tr><td class='chart-color-", $idx, "'>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                                            $idx++;
                                                                            $colorList[] = $chartColors[$idx - 1];
                                                                            $labelList[]   = $percent . "%";
                                                                            $percentList[] = $percent;
                                                                        }
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <? echo "<img src='https://chart.googleapis.com/chart?chs=350x170&amp;chf=bg,s,ffffff&amp;cht=p&amp;chd=t:", implode(',', $percentList),"&amp;chl=", implode('|', $labelList),"&amp;chco=", implode(',', $colorList), "' alt='".system_showText(LANG_SITEMGR_REPORT_STATISTICCHART)."'/>"; ?>
                                                            </td>
                                                        </tr>
                                                    <? } else { ?>
                                                        <tr>
                                                            <td colspan="2" class="text-right">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_REPORT_TOP15KEYWORDS)?></div>
                                                                    <div class="panel-body">
                                                                        <?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <? } ?>

                                                    <? /* where */ ?>
                                                    <? if(($module != 'a') && ($module != 'p')) { ?>
                                                        <tr>
                                                        <? if(count($report[$module]['where']) > 0) { ?>
                                                            <td>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_REPORT_TOP15WHERE)?></div>
                                                                    <table class="table">
                                                                        <?
                                                                        $idx = 1;
                                                                        $colorList   = array();
                                                                        $percentList = array();
                                                                        $labelList   = array();
                                                                        foreach($report[$module]['where'] as $data => $quantity) {
                                                                            $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['where']), 2);
                                                                            echo "<tr><td class='chart-color-", $idx, "'>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                                            $idx++;
                                                                            $colorList[] = $chartColors[$idx - 1];
                                                                            $labelList[]   = $percent . "%";
                                                                            $percentList[] = $percent;
                                                                        }
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <? echo "<img src='https://chart.googleapis.com/chart?chs=350x170&amp;chf=bg,s,ffffff&amp;cht=p&amp;chd=t:", implode(',', $percentList),"&amp;chl=", implode('|', $labelList),"&amp;chco=", implode(',', $colorList), "' alt='".system_showText(LANG_SITEMGR_REPORT_STATISTICCHART)."'/>"; ?>
                                                            </td>
                                                            <? } else { ?>
                                                            <td>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_REPORT_TOP15WHERE)?></div>
                                                                    <div class="panel-body">
                                                                        <?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <? } ?>
                                                            <td>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_REPORT_TOP15LOCATIONS)?></div>
                                                                    <? if(count($report[$module]['locations']) > 0) { ?>
                                                                        <table class="table">
                                                                            <?
                                                                            foreach($report[$module]['locations'] as $data => $quantity) {
                                                                                $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['locations']), 2);
                                                                                echo "<tr><td>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                                            }
                                                                            ?>
                                                                        </table>
                                                                    <? } else {?>
                                                                        <div class="panel-body"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></div>
                                                                    <? } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <? } ?>

                                                    <? if(($module != 'h')) { ?>
                                                        <tr>
                                                            <td <?=($module != 'a' && $module != 'p') ? " " : "colspan='2'"; ?>>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_REPORT_TOP15CATEGORIES)?></div>

                                                                    <? if (count($report[$module]['categories']) > 0) { ?>
                                                                        <table class="table">
                                                                            <?
                                                                            foreach($report[$module]['categories'] as $data => $quantity) {
                                                                                $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['categories']), 2);
                                                                                echo "<tr><td>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                                            }
                                                                            ?>
                                                                        </table>
                                                                    <? } else { ?>
                                                                        <div class="panel-body"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></div>
                                                                    <? } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <? } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2" class="text-right">
                                                            <?=system_showText(LANG_SITEMGR_REPORT_STATISTICSEARCHREPORTBY)?> <span><a href="https://www.edirectory.com" target="_blank">eDirectory</a></span>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                            <? } ?>

                        <? } ?>

                        </div>
                </div>

            </section>

        </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/reports.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
