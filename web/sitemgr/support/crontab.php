<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/support/crontab.php
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

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

    $crons_manager = array();
    $crons_manager[] = "rollback_import.php";
    $crons_manager[] = "rollback_import_events.php";
    $crons_manager[] = "export_listings.php";
    $crons_manager[] = "export_events.php";
    $crons_manager[] = "export_mailapp.php";
    $crons_manager[] = "daily_maintenance.php";
    $crons_manager[] = "email_traffic.php";
    $crons_manager[] = "renewal_reminder.php";
    $crons_manager[] = "report_rollup.php";
    $crons_manager[] = "sitemap.php";
    $crons_manager[] = "statisticreport.php";

    $cronTabText = "0,20,40 * * * * php -f ".EDIRECTORY_ROOT."/cron/email_traffic.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
0,20,40 * * * * php -f ".EDIRECTORY_ROOT."/cron/renewal_reminder.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
0 */3 * * * php -f ".EDIRECTORY_ROOT."/cron/daily_maintenance.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
5 0 * * * php -f ".EDIRECTORY_ROOT."/cron/report_rollup.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
5 0 * * * php -f ".EDIRECTORY_ROOT."/cron/statisticreport.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
0 20 * * * php -f ".EDIRECTORY_ROOT."/cron/sitemap.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/export_listings.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/export_events.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/export_mailapp.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/import.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/import_events.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/10 * * * * php -f ".EDIRECTORY_ROOT."/cron/prepare_import.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/10 * * * * php -f ".EDIRECTORY_ROOT."/cron/prepare_import_events.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/10 * * * * php -f ".EDIRECTORY_ROOT."/cron/rollback_import.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/10 * * * * php -f ".EDIRECTORY_ROOT."/cron/rollback_import_events.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log";

    $cronTabText2 = "*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/cron_manager.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/import.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/5 * * * * php -f ".EDIRECTORY_ROOT."/cron/import_events.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/10 * * * * php -f ".EDIRECTORY_ROOT."/cron/prepare_import.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log
*/10 * * * * php -f ".EDIRECTORY_ROOT."/cron/prepare_import_events.php 1>&2 >> ".EDIRECTORY_ROOT."/cron/cron.log";

	# ----------------------------------------------------------------------------------------------------
	# AUXILIARY FUNCTIONS
	# ----------------------------------------------------------------------------------------------------

    function resetFlags()
    {
        $dbMain = db_getDBObject( DEFAULT_DB, true );
        $result = true;

        $sql = array(
            "UPDATE Control_Cron SET running = 'N', last_run_date = '0000-00-00 00:00:00'",
            "UPDATE Control_Export_Event   SET scheduled = 'N', running_cron = 'N', finished = 'Y'",
            "UPDATE Control_Export_Listing SET scheduled = 'N', running_cron = 'N', finished = 'Y'",
            "UPDATE Control_Export_MailApp SET scheduled = 'N', running = 'N'",
            "UPDATE Control_Import_Event   SET scheduled = 'N', running = 'N'",
            "UPDATE Control_Import_Listing SET scheduled = 'N', running = 'N'",
            "UPDATE Setting SET value = 'N' WHERE name = 'running_cron_manager'"
        );

        foreach ($sql as $query)
        {
            $result = ( $dbMain->query( $query ) && $result );
        }

        return $result ? "1" : "0";
    }

    # ----------------------------------------------------------------------------------------------------
	# ACTION
	# ----------------------------------------------------------------------------------------------------

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        switch( $_POST['action'] )
        {
            case "resetflags":
                echo resetFlags();
                exit;
        }
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

        if ($errorMessage) { ?>
            <p class="alert alert-warning"><?=$errorMessage?></p>
        <? } elseif ($_GET["message"] == "ok") { ?>
            <p class="alert alert-success">Settings changed!</p>
        <? } ?>

        <section class="heading">
            <h1>Crontab</h1>
            <p>
                Please, be aware that <i>cron_manager.php</i> runs others crons indicated below. If you schedule cron_manager, <strong>DO NOT SCHEDULE</strong> any other cron that cron_manager runs.<br />
                If you need to schedule any cron separately and still keep cron_manager scheduled, go to the file cron/cron_manager.php and comment the line that corresponds to the cron you want to run separately.
            </p>
        </section>

        <section class="row section-form">
            <h3>Cron History</h3>
            <div class="col-lg-10 col-lg-offset-1">
                <? include(INCLUDES_DIR."/code/cronjobreport.php"); ?>
            </div>
        </section>

        <section class="row section-form">
            <div class="form-group col-lg-6">
                <h3>Crontab <strong>without cron manager</strong></h3>
                <textarea class="form-control" name="text" id="textarea" rows="8"><?=htmlspecialchars($cronTabText)?></textarea>
            </div>

            <div class="form-group col-lg-6">
                <h3>Crontab <strong>with cron manager</strong></h3>
                <textarea class="form-control" name="text" id="textarea" rows="8"><?=htmlspecialchars($cronTabText2)?></textarea>
            </div>
        </section>
        <section class="row section-form">
            <div class="col-sm-12">
                <h4>Cron Manager includes:</h4>
                <? foreach ($crons_manager as $cron) { ?>
                    <p>&#8226; <?=$cron?></p>
                <? } ?>
            </div>
        </section>
        <section class="row section-form">
            <div class="col-sm-12">
                <h4>Reset Cron Flags:</h4>
                <p>This will reset the current cron status flags to its default values. Use this when you notice a flag
                    is out of sync with it's corresponding cron</p>
                <div id="reset_message_box"></div>
                <button class="btn btn-danger btn-large" type="button" id="reset_flags_button">Reset All Flags</button>
                <?php/*<button class="btn btn-primary btn-large" type="button" id="launch_manager_button">Launch Cron Manager</button>*/?>
            </div>
        </section>


    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/support.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
