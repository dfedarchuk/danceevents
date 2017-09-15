<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/reports.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>
        var moduleActive = <?=($_GET['module'] ? "'".$_GET['module']."'" : "'module_h'")?>;

        function displayReport(module) {

            if (!module) return false;

            <? foreach($modules as $module ) { ?>
                document.getElementById("module_<?=$module;?>").style.display = "none";
                document.getElementById("style_module_<?=$module;?>").className = "";
            <? } ?>

            document.getElementById(module).style.display = "block";
            document.getElementById('style_' + module).className = "active";

            moduleActive = module;
        }

        var blockRefresh = '';

        function doRefreshStatus() {
            dataFormat = '<?=format_date(date("Y-m-d"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString(date("Y-m-d H:i:s"))?>';
            if (!blockRefresh) {
                url = "<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/activity/reports/statisticreport_refresh.php";
                html_animloading = "<img src=\"<?=DEFAULT_URL.'/'.SITEMGR_ALIAS.'/assets/img/loading-64.gif'?>\" border=\"0\" align=\"absmiddle\" />";
                $.get(url, {'refresh':1}, function (data) {
                    secondsFormat = data.substr(data.lastIndexOf(" - "));
                    $('#reportRefreshStatus').html("<p><?=system_showText(LANG_SITEMGR_REPORT_STATSHASBEENUPDATED)?> "+dataFormat+secondsFormat+" <?=system_showText(LANG_SITEMGR_REPORT_SECONDS)?></p>");
                    $('#reportRefreshStatus').fadeIn(2000);
                    window.setTimeout(refreshStatusClose, 3000);
                });
                $('#reportRefreshStatus').html(html_animloading);
                $('#reportRefreshStatus').css('display', 'block');
                blockRefresh = true;
            }
        }

        function refreshStatusClose() {
            $('#reportRefreshStatus').fadeOut(1000, function() {
                url = "<?=$url?>"+moduleActive;
                window.location.href = url;
            });
            blockRefresh = false;
        }
        
        <? if ($openActiveModule) { ?>
            displayReport(moduleActive);
        <? } ?>

    </script>