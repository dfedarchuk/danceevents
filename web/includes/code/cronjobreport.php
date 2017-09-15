<?
	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /includes/code/cronjobreport.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	setting_get("last_datetime_dailymaintenance", $last_datetime_dailymaintenance);
	setting_get("last_datetime_listingtraffic", $last_datetime_listingtraffic);
	setting_get("last_datetime_import", $last_datetime_import);
	setting_get("last_datetime_prepare_import", $last_datetime_prepare_import);
	setting_get("last_datetime_rollback_import", $last_datetime_rollback_import);
	setting_get("last_datetime_import_events", $last_datetime_import_events);
	setting_get("last_datetime_prepare_import_events", $last_datetime_prepare_import_events);
	setting_get("last_datetime_rollback_import_events", $last_datetime_rollback_import_events);
	setting_get("last_datetime_renewalreminder", $last_datetime_renewalreminder);
	setting_get("last_datetime_reportrollup", $last_datetime_reportrollup);
	setting_get("last_datetime_sitemap", $last_datetime_sitemap);
	setting_get("last_datetime_statisticreport", $last_datetime_statisticreport);
	setting_get("last_datetime_location_update", $last_datetime_location_update);

    $last_datetime_dailymaintenance       or $last_datetime_dailymaintenance       = "Never";
    $last_datetime_listingtraffic         or $last_datetime_listingtraffic         = "Never";
    $last_datetime_import                 or $last_datetime_import                 = "Never";
    $last_datetime_prepare_import         or $last_datetime_prepare_import         = "Never";
    $last_datetime_rollback_import        or $last_datetime_rollback_import        = "Never";
    $last_datetime_import_events          or $last_datetime_import_events          = "Never";
    $last_datetime_prepare_import_events  or $last_datetime_prepare_import_events  = "Never";
    $last_datetime_rollback_import_events or $last_datetime_rollback_import_events = "Never";
    $last_datetime_renewalreminder        or $last_datetime_renewalreminder        = "Never";
    $last_datetime_reportrollup           or $last_datetime_reportrollup           = "Never";
    $last_datetime_sitemap                or $last_datetime_sitemap                = "Never";
    $last_datetime_statisticreport        or $last_datetime_statisticreport        = "Never";
    $last_datetime_location_update        or $last_datetime_location_update        = "Never";
	?>

	<table id="cronTable" class="table table-striped table-hover">
        <thead>
			<th> Task </th>
			<th> Period </th>
			<th> Last Run </th>
        </thead>
        <tbody>
            <tr>
                <td>Daily Maintenance</td>
                <td>Daily</td>
                <td><?=$last_datetime_dailymaintenance?></td>
            </tr>
            <tr>
                <td>Import - Listings</td>
                <td>Automatic</td>
                <td><?=$last_datetime_import?></td>
            </tr>
            <tr>
                <td>Prepare Import - Listings</td>
                <td>Automatic</td>
                <td><?=$last_datetime_prepare_import?></td>
            </tr>
            <tr>
                <td>RollBack Import - Listings</td>
                <td>Automatic</td>
                <td><?=$last_datetime_rollback_import?></td>
            </tr>
            <tr>
                <td>Import - Events</td>
                <td>Automatic</td>
                <td><?=$last_datetime_import_events?></td>
            </tr>
            <tr>
                <td>Prepare Import - Events</td>
                <td>Automatic</td>
                <td><?=$last_datetime_prepare_import_events?></td>
            </tr>
            <tr>
                <td>RollBack Import - Events</td>
                <td>Automatic</td>
                <td><?=$last_datetime_rollback_import_events?></td>
            </tr>
            <tr>
                <td>Renewal Reminder</td>
                <td>Every 20 Minutes</td>
                <td><?=$last_datetime_renewalreminder?></td>
            </tr>
            <tr>
                <td>E-mail Traffic Reports</td>
                <td>Every 20 Minutes</td>
                <td><?=$last_datetime_listingtraffic?></td>
            </tr>
            <tr>
                <td>Report Rollup</td>
                <td>Daily</td>
                <td><?=$last_datetime_reportrollup?></td>
            </tr>
            <tr>
                <td>Sitemap</td>
                <td>Daily</td>
                <td><?=$last_datetime_sitemap?></td>
            </tr>
            <tr>
                <td>Statistic Report</td>
                <td>Daily</td>
                <td><?=$last_datetime_statisticreport?></td>
            </tr>
            <tr>
                <td>Location Update</td>
                <td>Automatic</td>
                <td><?=$last_datetime_location_update?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"> <strong> Current system time :</strong></td>
                <td> <?= date("Y-m-d H:i:s") ?></td>
            </tr>
        </tfoot>
	</table>
