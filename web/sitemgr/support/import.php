<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/support/import.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# THIS PAGE IS ONLY USED BY THE SUPPORT TEAM TO SET THE CONTROL CRON TABLES WITH DFAULT VALUES
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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$success = 0;
	if ($_GET["cron"]){
        $event = false;
		if ($_GET["cron"] == "import"){
			if ($_GET["scheduled"] == "N"){
				$sql = "UPDATE Control_Import_Listing SET scheduled = 'Y' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["scheduled"] == "Y"){
				$sql = "UPDATE Control_Import_Listing SET scheduled = 'N' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Import_Listing SET running = 'Y' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Import_Listing SET running = 'N' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		} elseif ($_GET["cron"] == "import_event"){
            $event = true;
			if ($_GET["scheduled"] == "N"){
				$sql = "UPDATE Control_Import_Event SET scheduled = 'Y' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["scheduled"] == "Y"){
				$sql = "UPDATE Control_Import_Event SET scheduled = 'N' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Import_Event SET running = 'Y' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Import_Event SET running = 'N' WHERE domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		}

		if ($_GET["cron"] == "prepare"){
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Cron SET running = 'Y' WHERE type = 'prepare_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Cron SET running = 'N' WHERE type = 'prepare_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		} elseif ($_GET["cron"] == "prepare_event"){
            $event = true;
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Cron SET running = 'Y' WHERE type = 'prepare_import_events' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Cron SET running = 'N' WHERE type = 'prepare_import_events' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
        }
		

		if ($_GET["cron"] == "rollback"){
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Cron SET running = 'Y' WHERE type = 'rollback_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Cron SET running = 'N' WHERE type = 'rollback_import' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		} elseif ($_GET["cron"] == "rollback_event"){
            $event = true;
			if ($_GET["running"] == "N"){
				$sql = "UPDATE Control_Cron SET running = 'Y' WHERE type = 'rollback_import_events' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			} else if ($_GET["running"] == "Y"){
				$sql = "UPDATE Control_Cron SET running = 'N' WHERE type = 'rollback_import_events' AND domain_id = ".SELECTED_DOMAIN_ID;
				$dbMain->query($sql);
			}
		}

		if (!$dbMain->mysql_error) {
            if ($event) {
                $successEvent = 1;
            } else {
                $success = 1;
            }
		} else {
			if ($event) {
                $successEvent = 2;
            } else {
                $success = 2;
            }
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    $import = new ImportLog();
    
	//Listing
    $sql = "SELECT scheduled, running, last_run_date, last_importlog FROM Control_Import_Listing WHERE domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$import_scheduled		= $row["scheduled"];
	$import_running			= $row["running"];
	$import_last_run_date	= $row["last_run_date"];
	$import_last_importlog	= $row["last_importlog"];

	$sql = "SELECT running, last_run_date FROM Control_Cron WHERE type = 'prepare_import' AND domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$prepareImport_running			= $row["running"];
	$prepareImport_last_run_date	= $row["last_run_date"];

	$sql = "SELECT running, last_run_date FROM Control_Cron WHERE type = 'rollback_import' AND domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$rollbackImport_running			= $row["running"];
	$rollbackImport_last_run_date	= $row["last_run_date"];
    
	$importsListing = $import->getImports("listing");
    
    //Event
    $sql = "SELECT scheduled, running, last_run_date, last_importlog FROM Control_Import_Event WHERE domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$import_scheduled_event         = $row["scheduled"];
	$import_running_event			= $row["running"];
	$import_last_run_date_event     = $row["last_run_date"];
	$import_last_importlog_event	= $row["last_importlog"];

	$sql = "SELECT running, last_run_date FROM Control_Cron WHERE type = 'prepare_import_events' AND domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$prepareImport_running_event		= $row["running"];
	$prepareImport_last_run_date_event	= $row["last_run_date"];

	$sql = "SELECT running, last_run_date FROM Control_Cron WHERE type = 'rollback_import_events' AND domain_id = ".SELECTED_DOMAIN_ID;
	$row = mysql_fetch_assoc($dbMain->query($sql));

	$rollbackImport_running_event		= $row["running"];
	$rollbackImport_last_run_date_event	= $row["last_run_date"];
    
    $importsEvent = $import->getImports("event");

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
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
                
        <section class="heading">
            <h1> Config Checker: Import</h1>
            <? if ($_GET["message"] == 1) { ?>
                <p class="alert alert-success">ImportLog successfully updated!</p>
            <? } ?>
        </section>

        <section class="row section-form">

            <div class="col-md-8">
                <h3>Control Cron Tables Status - Listing</h3>
                <? if ($success != 0) { ?>
                    <div id="logMessages">
                        <p class=<?=($success == 1? "alert alert-success" : "alert alert-danger")?>><?=($success == 1 ? "Cron setting successfully changed!" : "Error trying to change the cron setting, please try again.")?></p>
                    </div>
                <? } ?>

                <? include(INCLUDES_DIR."/forms/form-support-importlisting.php"); ?>

                <h3>Control Cron Tables Status - Event</h3>
                <? if ($successEvent != 0) { ?>
                    <div id="logMessages">
                        <p class=<?=($successEvent == 1? "alert alert-success" : "alert alert-danger")?>><?=($successEvent == 1 ? "Cron setting successfully changed!" : "Error trying to change the cron setting, please try again.")?></p>
                    </div>
                <? } ?>
                <? include(INCLUDES_DIR."/forms/form-support-importevent.php"); ?>
            </div>

            <div class="col-md-4 small">
                <div class="panel panel-default">
                    <div class="panel-heading">Description of the field <i>Status</i>:</div>
                    <div class="panel-body">
                        <p>P (Pending): Import process waiting cron import.php or cron prepare_import.php, according to the column action.</p>
                        <p>F (Finished): Import process finished and successfully done.</p>
                        <p>C (Cancelled): Import process cancelled after a roll back.</p>
                        <p>D (Deleted): Import log deleted by sitemgr. Imported items are not removed.</p>
                        <p>W (Waiting): Intermediate status after sitemgr stop an import process.</p>
                        <p>E (Error): Wrong CSV file or error in the sql lote file (check the column mysql_error in ImportLog table).</p>
                        <p>R (Running): Cron import.php is running.</p>
                        <p>S (Stopped): Import process stopped by cron import.php after sitemgr stopped it. This process can not be resumed. Sitemgr will be able only to roll back this import.</p>
                    </div>
                </div>

                <div class="panel panel-default">
                   <div class="panel-heading">Description of the field <i>Action</i>:</div>
                   <div class="panel-body">
                        <p>RI (Ready to Import): Import scheduled and the table ImportTemporary has already been populated. Cron import.php is ready to run.</p>
                        <p>NC (Need to Convert): CSV file with more than 100 thousand lines. The file will be processed by the cron prepare_import.php.</p>
                        <p>NA (Need to Approve): After prepare_import.php has finished the process and the option "Start import automatically" is not checked.</p>
                        <p>D (Done): Import finished (successfully or not, according to the column status)</p>
                        <p>C (Converting): Cron prepare_import.php is running.</p>
                        <p>NR (Need to rollback): Waiting cron job (rollback_import.php) to roll back the import.</p>
                   </div>
                </div>

                <div class="panel panel-default">
                   <div class="panel-heading">Possible combinations between <i>Status</i> and <i>Action</i>:</div>
                   <div class="panel-body">	                  
                        <p>P/RI (In Queue): <?=import_getLogTip("P", "RI");?></p>	                 
                        <p>P/NC (Waiting to prepare import): <?=import_getLogTip("P", "NC");?></p>	                 
                        <p>P/NA (Waiting approval): <?=import_getLogTip("P", "NA");?></p>	                 
                        <p>P/C (Converting .csv): <?=import_getLogTip("P", "C");?></p>	                 
                        <p>F/D (Finished): <?=import_getLogTip("F", "D");?></p>	                 
                        <p>F/NR (Need to Rollback): <?=import_getLogTip("F", "NR");?></p>	                 
                        <p>C/D (Cancelled): <?=import_getLogTip("C", "D");?></p>	                 
                        <p>D/RI (Deleted): <?=import_getLogTip("D", "RI");?></p>	                 
                        <p>D/NC (Deleted): <?=import_getLogTip("D", "NC");?></p>
                        <p>D/NA (Deleted): <?=import_getLogTip("D", "NA");?></p>	                 
                        <p>D/D (Deleted): <?=import_getLogTip("D", "D");?></p>	                 
                        <p>W/RI (Waiting): <?=import_getLogTip("W", "RI");?></p>	                 
                        <p>E/D (Error): <?=import_getLogTip("E", "D");?></p>	                 
                        <p>R/RI (Running): <?=import_getLogTip("R", "RI");?></p>	                 
                        <p>S/D (Stopped): <?=import_getLogTip("S", "D");?></p>	             
                    </div>
                </div>

            </div>

        </section>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>