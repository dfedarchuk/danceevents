<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/listing/twilio_report.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
    include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);

    # ----------------------------------------------------------------------------------------------------
    # OBJECTS
    # ----------------------------------------------------------------------------------------------------
	if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") {
		if (($item_id && $item_type) && ($item_type == "listing")) {
			$listing = new Listing($item_id);
		} else {
			exit;
		}
	} else {
		exit;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

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
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
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
                </thead>
                <tbody>
                <? for($i = 0; $i < count($array_twilio_report); $i++) {

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
                </tbody>
            </table>
        </div>
	<? } else { ?>
		<p class="alert alert-info"><?=system_showText(LANG_CLICKTOCALL_REPORT_NORECORD)?></p>
	<? } ?>