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
	# * FILE: /includes/tables/table_listing_reports.php
	# ----------------------------------------------------------------------------------------------------
	
    # ----------------------------------------------------------------------------------------------------
    # * HEADER
    # ----------------------------------------------------------------------------------------------------
?>
<style type="text/css">
    .dataTR     { background-color: #FFF; cursor: pointer; }
    .dataOver   { background-color: #EEE; cursor: pointer; }
    .dataActive { background-color: #CCC; cursor: pointer; }
</style>

<?
    # ----------------------------------------------------------------------------------------------------
    # * HEADER
    # ----------------------------------------------------------------------------------------------------
?>

    <table class="table table-bordered">

<?
    # ----------------------------------------------------------------------------------------------------
    # * CHART
    # ----------------------------------------------------------------------------------------------------
?>
        <tr>
            <td colspan="<?=TWILIO_APP_ENABLED == "on" ? (TWILIO_APP_ENABLED_CALL == "on" && TWILIO_APP_ENABLED_SMS == "on" ? "9" : "8") : "7"?>">
                <div id="reportChart" style="widht:700px; height:200px; background: #FFF url(<?=DEFAULT_URL?>/assets/images/structure/img_loading.gif) 50% 50% no-repeat;">&nbsp;</div>
            </td>
        </tr>

<?
    # ----------------------------------------------------------------------------------------------------
    # * LISTING 
    # ----------------------------------------------------------------------------------------------------
?>
	    <tr>
		    <th class="table-report" colspan="<?=TWILIO_APP_ENABLED == "on" ? (TWILIO_APP_ENABLED_CALL == "on" && TWILIO_APP_ENABLED_SMS == "on" ? "9" : "8") : "7"?>">
                <?
                if ($listing->getNumber("account_id")) {
                    $account = db_getFromDB("account", "id", db_formatNumber($listing->getNumber("account_id")));
                    $username = $account->getString("username", true, 35);
                    echo system_showText(LANG_LABEL_ACCOUNT), ": <span title = ".$account->getString("username").">", system_showAccountUserName($username), "</span><br />";
                } else {
                    echo system_showText(LANG_LABEL_ACCOUNT), ":<span> " . system_showText(LANG_SITEMGR_NOOWNER) . "</span><br />";
                }
                ?>
			    <?=system_showText(LANG_LABEL_NAME)?>: <span title="<?=$listing->getString("title", true)?>"><?=$listing->getString("title", true, 35);?></span>
			    <br />
			    <?=system_showText(LANG_LABEL_LEVEL)?>: <?=$levelName?>
			    <br />
			    <?=system_showText(LANG_LABEL_STATUS)?>: <?=$statusName?>
			    <span><?=$owner?></span>
		    </th>
	    </tr>

<?
    # ----------------------------------------------------------------------------------------------------
    # * REPORT DATA
    # ----------------------------------------------------------------------------------------------------
?>
	    <tr>
		    <td width="125">
			    <b><?=system_showText(LANG_LABEL_DATE)?></b>
		    </td>
		    <td width="90">
			    <b style="color: #CE9C52;"><?=system_showText(LANG_LABEL_SUMMARY)?></b>
		    </td>
		    <td width="90">
			    <b style="color: #D3CD83;"><?=system_showText(LANG_LABEL_DETAIL)?></b>
		    </td>
		    <td width="90">
			    <b style="color: #FA5353;"><?=system_showText(LANG_LABEL_CLICKTHRU)?></b>
		    </td>
		    <td width="90">
			    <b style="color: #527BCE;"><?=system_showText(LANG_LABEL_EMAIL)?></b>
		    </td>
            <? if (REPORT_PHONE_FAX) { ?>
		    <td width="90">
			    <b style="color: #52C6CE;"><?=system_showText(LANG_LABEL_PHONE)?></b>
		    </td>
		    <td width="50">
			    <b style="color: #00886D;"><?=system_showText(LANG_LABEL_FAX)?></b>
		    </td>
            <? } ?>
			<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_SMS == "on") { ?>
			<td width="115">
			    <b style="color: #336699;"><?=system_showText(LANG_LABEL_SENDPHONE)?></b>
		    </td>
			<? } ?>
			<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on"){?>
			<td width="124">
			    <b style="color: #CC3300;">
					<span style="bottom:2px;position:relative;"><?=system_showText(LANG_LABEL_CLICKTOCALL)?></span>
					<a data-toggle="modal" data-target="#modal-twilio" href="javascript:void(0);" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING)?>" >
                        <?=system_showText(LANG_LABEL_VIEW)?>
					</a>	
				</b>
		    </td>
			<? } ?>
	    </tr>

        <?
            $idx = 0;
            foreach($reports AS $key => $report) {
                $idx++;
                list($year, $month) = explode('-', $key);
        ?>
                <tr id="dataTR<?=$idx;?>" class="<?=(($idx == 1) ? 'dataActive' : 'dataTR');?>" onmouseover="dataTRMouseOver(<?=$idx;?>)" onmouseout="dataTRMouseOut(<?=$idx;?>)" onclick="javascript:deactivateAll();changeChart(<?=($idx) ? $idx : 0;?>,<?=($report['summary'])? $report['summary'] : 0;?>,<?=($report['detail']) ? $report['detail'] : 0;?>,<?=($report['click']) ? $report['click'] : 0;?>,<?=($report['email']) ? $report['email'] : 0;?>,<?=($report['phone']) ? $report['phone'] : 0;?>,<?=($report['fax']) ? $report['fax'] : 0;?>,<?=($report['sms']) ? $report['sms'] : 0;?>,<?=($report['click_call']) ? $report['click_call'] : 0;?>);">
                    <td><?=system_showDate('F', mktime(0, 0, 0, $month, 1, $year));?> / <?=$year;?></td>
                    <td><?=($report['summary']) ? $report['summary'] : 0;?></td>
                    <td><?=($report['detail']) ? $report['detail'] : 0;?></td>
                    <td><?=($report['click']) ? $report['click'] : 0;?></td>
                    <td><?=($report['email']) ? $report['email'] : 0;?></td>
                    <? if (REPORT_PHONE_FAX) { ?>
                    <td><?=($report['phone']) ? $report['phone'] : 0;?></td>
                    <td><?=($report['fax']) ? $report['fax'] : 0;?></td>
                    <? } ?>
					<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_SMS == "on"){?>
                    <td><?=($report['sms']) ? $report['sms'] : 0;?></td>
					<? } ?>
					<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on"){?>
                    <td><?=($report['click_call']) ? $report['click_call'] : 0;?></td>
					<? } ?>
                </tr>
        <? } ?>

    </table>

<?
    # ----------------------------------------------------------------------------------------------------
    # * SCRIPT
    # ----------------------------------------------------------------------------------------------------
	$auxScriptValue = "";
	$auxScriptLabel = "";
	$auxScriptColor = "";

    if (REPORT_PHONE_FAX) {
        $auxScriptValue = "\"|\"+value5+\"|\"+value6+";
        $auxScriptLabel = "\"|\"+label5+\"|\"+label6+";
        $auxScriptColor = ",52c6ce,00886d";
    }
	if (TWILIO_APP_ENABLED == "on") {
		
		if (TWILIO_APP_ENABLED_SMS == "on" && TWILIO_APP_ENABLED_CALL == "on"){
			$auxScriptValue .= "\"|\"+value7+\"|\"+value8+";
			$auxScriptLabel .= "\"|\"+label7+\"|\"+label8+";
			$auxScriptColor .= ",336699,CC3300";
		} elseif (TWILIO_APP_ENABLED_SMS == "on") {
			$auxScriptValue .= "\"|\"+value7+";
			$auxScriptLabel .= "\"|\"+label7+";
			$auxScriptColor .= ",336699";
		} elseif(TWILIO_APP_ENABLED_CALL == "on"){
			$auxScriptValue .= "\"|\"+value8+";
			$auxScriptLabel .= "\"|\"+label8+";
			$auxScriptColor .= ",CC3300";
		}
	}
?>
    <script type="text/javascript">
        function changeChart(idx, value1, value2, value3, value4, value5, value6, value7, value8) {
            var label1 = '<?=system_showText(system_showText(LANG_LABEL_SUMMARY));?>: ' + value1;
            var label2 = '<?=system_showText(system_showText(LANG_LABEL_DETAIL));?>: ' + value2;
            var label3 = '<?=system_showText(system_showText(LANG_LABEL_CLICKTHRU));?>: ' + value3;
            var label4 = '<?=system_showText(system_showText(LANG_LABEL_EMAIL));?>: ' + value4;
            <? if (REPORT_PHONE_FAX) { ?>
            var label5 = '<?=system_showText(system_showText(LANG_LABEL_PHONE));?>: ' + value5;
            var label6 = '<?=system_showText(system_showText(LANG_LABEL_FAX));?>: ' + value6;
            <? } ?>
            var label7 = '<?=system_showText(system_showText(LANG_LABEL_SENDPHONE));?>: ' + value7;
            var label8 = '<?=system_showText(system_showText(LANG_LABEL_CLICKTOCALL));?>: ' + value8;
            
            var total = value1 + value2 + value3 + value4 + value5 + value6 + value7 + value8;
            value1 = ((value1 * 100) / total);
            value2 = ((value2 * 100) / total);
            value3 = ((value3 * 100) / total);
            value4 = ((value4 * 100) / total);
            value5 = ((value5 * 100) / total);
            value6 = ((value6 * 100) / total);
            value7 = ((value7 * 100) / total);
            value8 = ((value8 * 100) / total);
            
            document.getElementById('dataTR'+idx).className = "dataActive";
            document.getElementById("reportChart").innerHTML = "<img src='https://chart.googleapis.com/chart?chs=630x200&amp;chf=bg,s,ffffff|c,s,ffffff&amp;chxt=x,y&amp;chxl=1:||0:|||&amp;cht=bhg&amp;chd=t:"+value1+"|"+value2+"|"+value3+"|"+value4+<?=$auxScriptValue?>"&amp;chdl="+label1+"|"+label2+"|"+label3+"|"+label4+<?=$auxScriptLabel?>"&amp;chco=ce9c52,d3cd83,fa5353,527bce<?=$auxScriptColor?>&amp;chbh=<?=(TWILIO_APP_ENABLED == "on" ? "15" : "25")?>' alt='Report Chart'/>";
        }

        function dataTRMouseOver(idx) {
            if(document.getElementById('dataTR'+idx).className != 'dataActive')
                document.getElementById('dataTR'+idx).className = 'dataOver';
        }

        function dataTRMouseOut(idx) {
            if(document.getElementById('dataTR'+idx).className != 'dataActive')
                document.getElementById('dataTR'+idx).className = 'dataTR';
        }
        
        function deactivateAll() {
            <? for($x=1; $x<=$idx; $x++) { ?>
                document.getElementById('dataTR<?=$x?>').className = "dataTR";
            <? } ?>
        }
        
        document.getElementById('dataTR1').onclick();
        
    </script>