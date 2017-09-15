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
	# * FILE: /includes/tables/table_twilio_reports.php
	# ----------------------------------------------------------------------------------------------------
	
	if ($listing) {
		
		if ($listing->clicktocall_number) {
			$response = twilio_CallerReport($listing->clicktocall_number);

			$array_twilio_report = array();
			$i = 0;
            if (is_array($response->ResponseXml->Calls->Call)) {
                foreach ($response->ResponseXml->Calls->Call as $each_call) {

                    if ($each_call->Direction == "outbound-api") {
                        $array_twilio_report[$i]["ToFormatted"] = $each_call->ToFormatted;
                        $array_twilio_report[$i]["StartTime"] = $each_call->StartTime;
                        $array_twilio_report[$i]["EndTime"] = $each_call->EndTime;
                        $array_twilio_report[$i]["Duration"] = $each_call->Duration;
                        $i++;
                    }
                }
            }
		}
	}
	
	if (count($array_twilio_report)) { ?>
		<table class="table-itemlist">
			<tr>
				<th>
					<?=system_showText(LANG_CLICKTOCALL_REPORT_FROM)?>
				</th>
				<th>
					<?=system_showText(LANG_CLICKTOCALL_REPORT_START_TIME)?>
				</th>
				<th>
					<?=system_showText(LANG_CLICKTOCALL_REPORT_END_TIME)?>
				</th>
				<th>
					<?=system_showText(LANG_CLICKTOCALL_REPORT_DURATION)?>
				</th>
			</tr>
			<? for($i=0;$i<count($array_twilio_report);$i++){
				
				$dateStart = date_create($array_twilio_report[$i]["StartTime"]);
				$dateEnd = date_create($array_twilio_report[$i]["EndTime"]);
				
				$auxStartTime = date_format($dateStart, 'Y-m-d H:i:s');
				$auxEndTime = date_format($dateEnd, 'Y-m-d H:i:s');

				$StartTime = format_date($auxStartTime, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($auxStartTime);
				$EndTime = format_date($auxEndTime, DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($auxStartTime);
				
				?>
				<tr>		
					<td><?=$array_twilio_report[$i]["ToFormatted"]?></td>
					<td><?=$StartTime?></td>
					<td><?=$EndTime?></td>
					<td><?=$array_twilio_report[$i]["Duration"]?></td>
				</tr>
			<? } ?>
		</table>
	<? } else { ?>
		<p class="informationMessage"><?=system_showText(LANG_CLICKTOCALL_REPORT_NORECORD)?></p>
	<? } ?>