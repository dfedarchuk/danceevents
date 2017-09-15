<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/support/cronlog.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# THIS PAGE IS ONLY USED BY THE SUPPORT
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	if (!sess_getSMIdFromSession()){
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
        exit;
	} else {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT username FROM SMAccount WHERE id = ".sess_getSMIdFromSession();
		$row = mysql_fetch_assoc($dbMain->query($sql));
		if ($row["username"] != ARCALOGIN_USERNAME){
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
            exit;
		} 
	}
    
    $url_redirect = DEFAULT_URL."/".SITEMGR_ALIAS."/support/cronlog.php";
    extract($_GET);
    extract($_POST);
    
    if ($_GET["orderby"] == "domain") {
        $orderByClause = "domain_id";
    } elseif ($_GET["orderby"] == "cron"){
        $orderByClause = "cron";
    } elseif ($_GET["orderby"] == "date"){
        $orderByClause = "date DESC";
    } elseif ($_GET["orderby"] == "finished"){
        $orderByClause = "finished";
    } elseif ($_GET["orderby"] == "time"){
        $orderByClause = "time";
    } else {
        $orderByClause = "date";
    }

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    $crons = array();
    $crons[] = "prepare_import";
    $crons[] = "prepare_import_events";
    $crons[] = "import";
    $crons[] = "import_events";
    $crons[] = "rollback_import";
    $crons[] = "rollback_import_events";
    $crons[] = "export_listings";
    $crons[] = "export_events";
    $crons[] = "export_mailapp";
    $crons[] = "daily_maintenance";
    $crons[] = "email_traffic";
    $crons[] = "location_update";
    $crons[] = "renewal_reminder";
    $crons[] = "report_rollup";
    $crons[] = "sitemap";
    $crons[] = "statisticreport";
    $crons[] = "count_locations";
    
    foreach($crons as $cron) {
        ${"cronLogs_".$cron} = db_getFromDBBySQL("cron_log", "SELECT id, domain_id, cron, date, history, finished, CAST(time AS DECIMAL(10,2)) AS time FROM Cron_Log WHERE cron = '$cron' ORDER BY $orderByClause", "array");
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
    include(SM_EDIRECTORY_ROOT."/layout/sidebar-support.php");

?>

    <main class="wrapper-dashboard togglesidebar container-fluid">
       
        <?
        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1>Cron Log</h1>
        </section>

        <section class="row">
            <div class="col-sm-9">
                <? foreach($crons as $cron) { ?>
                    <section class="panel panel-default">
                        
                        <div class="panel-heading"><?=$cron?></div>

                        <? if (!ENABLE_CRON_LOG) { ?>
                        <div class="panel-body">
                            <p class="alert alert-warning">Cron Log is disabled!</p>
                        </div>
                        <? } ?>                     

                        <? if (is_array(${"cronLogs_".$cron}) && ${"cronLogs_".$cron}[0]) { ?>
                            <table class="table">

                                <tr>
                                    <th><a  href="<?=$url_redirect."?orderby=domain"?>">Domain ID</a></th>
                                    <th><a  href="<?=$url_redirect."?orderby=date"?>">Date</a></th>
                                    <th><a  href="<?=$url_redirect."?orderby=finished"?>">Finished</a></th>
                                    <th><a  href="<?=$url_redirect."?orderby=time"?>">Time</a></th>
                                    <th>History</th>
                                </tr>

                                <? foreach (${"cronLogs_".$cron} as $log) { ?>

                                <tr>
                                    <td><?=$log["domain_id"]?></td>
                                    <td><?=$log["date"]?></td>
                                    <td><?=$log["finished"]?></td>
                                    <td><?=$log["time"]?> s</td>
                                    <td class="main-options"><a id="cronlog" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/cronlog_history.php?id=".$log["id"]?>">View History</a></td>
                                </tr>

                                <? } ?>

                            </table>
                        <? } else { ?>
                            <div class="panel-body">
                                <p class="text-warning">No logs found.</p>
                            </div>
                        <? } ?>

                    </section>

                <? } ?>

                <br>
                
            </div>
            
        </section>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>