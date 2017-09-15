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
	# * FILE: /includes/tables/table_import_support.php
	# ----------------------------------------------------------------------------------------------------

?>

<tr>
	<td>
		<?=$import->getNumber("id");?>
	</td>
	<td>
		<?=format_date($import->getString("date"))?>&nbsp; - <?=format_getTimeString($import->getNumber("time"))?>
	</td>
	<td>
		<fieldset title="<?=$import->getString("filename");?>">
			<?=$import->getString("filename", true, 23);?>
		</fieldset>
	</td>
	<td>
        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/importsettings.php?id=".$import->getNumber("id")?>">
            <?
            $status = new ImportStatus();
            if ($import->getString("status") == "R") echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))." - ".$import->getString("progress");
            else if ($import->getString("action") == "NR") echo $status->getStatusWithStyle("WR", $import->getNumber("id"));
            else if ($import->getString("status") == "P" && $import->getString("action") == "RI") echo $status->getStatusWithStyle("Q", $import->getNumber("id"));
            else if ($import->getString("status") == "P" && $import->getString("action") == "NC") echo $status->getStatusWithStyle("Q2", $import->getNumber("id"));
            else if ($import->getString("status") == "P" && $import->getString("action") == "C") echo $status->getStatusWithStyle("U", $import->getNumber("id"));
            else if ($import->getString("status") == "P" && $import->getString("action") == "NA") echo $status->getStatusWithStyle("PA", $import->getNumber("id"));
            else echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"));
            echo " (".$import->getString("status").")";
            ?>
        </a>
	</td>
    <td>
        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/support/importsettings.php?id=".$import->getNumber("id")?>">
            <?
            if ($import->getString("action") == "RI") echo "<span class=\"status-stopped\">Ready to import</span>";
            elseif ($import->getString("action") == "NC") echo "<span class=\"status-pending\">Need to Convert</span>";
            elseif ($import->getString("action") == "NA") echo "<span class=\"status-pending\">Need to Aprove</span>";
            elseif ($import->getString("action") == "D") echo "<span class=\"status-finished\">Done</span>";
            elseif ($import->getString("action") == "C") echo "<span class=\"status-running\">Converting...</span>";
            elseif ($import->getString("action") == "NR") echo "<span class=\"status-wait\">Need to Rollback</span>";
            echo " (".$import->getString("action").")";
            ?>
        </a>
    </td>
    <td>
        <i style="cursor:pointer" class="icon-ion-ios7-help-outline" title="<?=import_getLogTip($import->getString("status"), $import->getString("action"));?>"></i>
    </td>
	
</tr>