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
	# * FILE: /includes/forms/form-support-importevent.php
	# ----------------------------------------------------------------------------------------------------

?>
    <table class="table table-bordered">
        <tr>
            <th >Cron</th>
            <th >Last Run Date</th>
            <th >Scheduled</th>
            <th >Running</th>
            <th >Last Import ID Done</th>
        </tr>
        <tr>
            <td>
                Import
            </td>
            <td>
                <?
                if ($import_last_run_date_event != "0000-00-00 00:00:00") {
                    echo format_date($import_last_run_date_event, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($import_last_run_date_event);
                } else {
                    echo "0000-00-00 00:00:00";
                }
                ?>
            </td>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=import_event&scheduled=<?=$import_scheduled_event?>"  title="<?=($import_scheduled_event == 'Y' ? "Scheduled" : "Not Scheduled")?>" ><i class="<?=$import_scheduled_event == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>"></i></a>
            </td>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=import_event&running=<?=$import_running_event?>" title="<?=($import_running_event == 'Y' ? "Running" : "Not Running")?>" ><i class="<?=$import_running_event == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>"></i></a>
            </td>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/datacenter/index.php?import_type=event&log_id=<?=$import_last_importlog_event?>"><?=$import_last_importlog_event;?></a>
            </td>
        </tr>
        <tr>
            <td>
                Prepare Import
            </td>
            <td>
                <?
                if ($prepareImport_last_run_date_event != "0000-00-00 00:00:00") {
                    echo format_date($prepareImport_last_run_date_event, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($prepareImport_last_run_date_event);
                } else {
                    echo "0000-00-00 00:00:00";
                }
                ?>
            </td>
            <td>
                Automatic
            </td>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=prepare_event&running=<?=$prepareImport_running_event?>" title="<?=($prepareImport_running_event == 'Y' ? "Running" : "Not Running")?>"><i class="<?=$prepareImport_running_event == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>" ></i></a>
            </td>
            <td>
                ---
            </td>
        </tr>
        <tr>
            <td>
                Roll Back Import
            </td>
            <td>
                <?
                if ($rollbackImport_last_run_date_event != "0000-00-00 00:00:00") {
                    echo format_date($rollbackImport_last_run_date_event, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($rollbackImport_last_run_date_event);
                } else {
                    echo "0000-00-00 00:00:00";
                }
                ?>
            </td>
            <td>
                Automatic
            </td>
            <td>
                <a title="<?=($rollbackImport_running_event == 'Y' ? "Running" : "Not Running")?>" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=rollback_event&running=<?=$rollbackImport_running_event?>"><i class="<?=$rollbackImport_running_event == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>" ></i></a>
            </td>
            <td>
                ---
            </td>
        </tr>
    </table>

    <h3>Import Log - Event</h3>

    <? if (is_array($importsEvent) && $importsEvent[0]) { ?>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Date/Time</th>
                <th>Filename</th>
                <th>Status</th>
                <th>Action</th>
                <th>&nbsp;</th>
            </tr>
            <? foreach ($importsEvent as $import) {
                    include (INCLUDES_DIR."/tables/table_import_support.php");
                }
            ?>
        </table>
    <? } else { ?>
        <p class="alert alert-warning">No records found.</p>
    <? } ?>
