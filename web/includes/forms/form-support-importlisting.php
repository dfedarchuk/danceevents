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
	# * FILE: /includes/forms/form-support-importlisting.php
	# ----------------------------------------------------------------------------------------------------

?>
    <table class="table table-bordered">
        <tr>
            <th>Cron</th>
            <th>Last Run Date</th>
            <th>Scheduled</th>
            <th>Running</th>
            <th>Last Import ID Done</th>
        </tr>
        <tr>
            <td>
                Import
            </td>
            <td>
                <?
                if ($import_last_run_date != "0000-00-00 00:00:00") {
                    echo format_date($import_last_run_date, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($import_last_run_date);
                } else {
                    echo "0000-00-00 00:00:00";
                }
                ?>
            </td>
            <td>
                <a title="<?=($import_scheduled == 'Y' ? "Scheduled" : "Not Scheduled")?>"  href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=import&scheduled=<?=$import_scheduled?>"><i class="<?=$import_scheduled == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>"></i></a>
            </td>
            <td>
                <a title="<?=($import_running == 'Y' ? "Running" : "Not Running")?>"  href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=import&running=<?=$import_running?>"><i class="<?=$import_running == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>" ></i></a>
            </td>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/datacenter/index.php?log_id=<?=$import_last_importlog?>"><?=$import_last_importlog;?></a>
            </td>
        </tr>
        <tr>
            <td>
                Prepare Import
            </td>
            <td>
                <?
                if ($prepareImport_last_run_date != "0000-00-00 00:00:00") {
                    echo format_date($prepareImport_last_run_date, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($prepareImport_last_run_date);
                } else {
                    echo "0000-00-00 00:00:00";
                }
                ?>
            </td>
            <td>
                Automatic
            </td>
            <td>
                <a title="<?=($import_running == 'Y' ? "Running" : "Not Running")?>"  href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=prepare&running=<?=$prepareImport_running?>"><i class="<?=$prepareImport_running == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>" ></i></a>
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
                if ($rollbackImport_last_run_date != "0000-00-00 00:00:00") {
                    echo format_date($rollbackImport_last_run_date, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($rollbackImport_last_run_date);
                } else {
                    echo "0000-00-00 00:00:00";
                }
                ?>
            </td>
            <td>
                Automatic
            </td>
            <td>
                <a title="<?=($rollbackImport_running == 'Y' ? "Running" : "Not Running")?>" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/import.php?cron=rollback&running=<?=$rollbackImport_running?>"><i class="<?=$rollbackImport_running == 'Y' ? 'icon-ion-ios7-checkmark-outline' : 'icon-ion-ios7-close-outline text-warning'?>"></i></a>
            </td>
            <td>
                ---
            </td>
        </tr>
    </table>


    <h3>Import Log - Listing</h3>

    <? if (is_array($importsListing) && $importsListing[0]) { ?>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Date/Time</th>
                <th>Filename</th>
                <th>Status</th>
                <th>Action</th>
                <th>&nbsp;</th>
            </tr>
            <? foreach ($importsListing as $import) {
                    include (INCLUDES_DIR."/tables/table_import_support.php");
                }
            ?>
        </table>
    
    <? } else { ?>
        <p class="alert alert-warning">No records found.</p>
    <? } ?>