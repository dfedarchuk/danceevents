<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table-import.php
	# ----------------------------------------------------------------------------------------------------
?> 

    <div class="panel panel-default">
        <div class="panel-heading"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG)?> - <?=$labelTable?></div>
        <div class="table-responsive content-table">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_IMPORT_FILENAME)?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_IMPORT_TOTALLINES)?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_IMPORT_ERRORLINES)?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_IMPORT_ADDEDLINES)?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_STATUS)?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_OPTIONS)?></th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($imports as $import) { ?>
                <tr>
                    <td>
                        <div id="img_<?=$import->getNumber("id");?>">
                            <img style="cursor: pointer;" src="<?=DEFAULT_URL?>/assets/images/structure/<?=($log_id == $import->getNumber("id") ? "img_close.gif" : "img_open.gif")?>" onclick="<?=($log_id == $import->getNumber("id") ? "JS_closeDetail" : "JS_openDetail")?>('<?=$import->getNumber("id");?>');">
                        </div>
                    </td>                    
                    
                    <td>
                        <?=format_date($import->getString("date"))?>&nbsp; - <?=format_getTimeString($import->getNumber("time"))?>
                    </td>
                    
                    <td title="<?=$import->getString("filename");?>">
                        <?=$import->getString("filename", true, 23);?>
                    </td>
                    
                    <td id="total_lines_<?=(int)$import->getNumber("id")?>">
                        <?=(int)$import->getNumber("totallines")?>
                    </td>
                    
                    <td id="error_lines_<?=(int)$import->getNumber("id")?>">
                        <?=(int)$import->getNumber("errorlines")?>
                    </td>
                    
                    <td id="progress_added_<?=(int)$import->getNumber("id")?>">
                        <?=(int)$import->getNumber("linesadded")?>
                    </td>
        
                    <td id="tdprogress_<?=$import->getNumber("id")?>">
                        <?
                        $status = new ImportStatus();
                        if ($import->getString("status") == "R") echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"> - <span id=\"progress_".$import->getNumber("id")."\">".$import->getString("progress")."</span></span>";
                        else if ($import->getString("action") == "NR") echo $status->getStatusWithStyle("WR", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
                        else if ($import->getString("status") == "P" && $import->getString("action") == "RI") echo $status->getStatusWithStyle("Q", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
                        else if ($import->getString("status") == "P" && $import->getString("action") == "NC") echo $status->getStatusWithStyle("Q2", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
                        else if ($import->getString("status") == "P" && $import->getString("action") == "C") echo $status->getStatusWithStyle("U", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
                        else if ($import->getString("status") == "P" && $import->getString("action") == "NA") echo $status->getStatusWithStyle("PA", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
                        else echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
                        ?>
                    </td>
                    
                    <td nowrap>
                        <? if ((($import->getString("status") == "F") || ($import->getString("status") == "S")) && ($import->getString("action") != "NR")) {
                            $rollback_available = 1;
                            $cursor_rollback = "pointer;";
                            $class = "btn btn-primary btn-sm";
                        } else {
                            $rollback_available = 0;
                            $cursor_rollback = "default;";
                            $class = "btn btn-default btn-sm";
                        }
                        ?>
                        <a href="javascript:void(0);" data-rollback="<?=$rollback_available?>" class="<?=$class?>" id="span_rollback_<?=$import->getNumber("id")?>" onclick="updateImport('rollback', <?=$import->getNumber("id")?>, '<?=$import->getString("type")?>');" style="cursor:<?=$cursor_rollback?>">
                            <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK)?>
                        </a>
                        
                        <? if ($import->getString("status") == "R") {
                            $stop_available = 1;
                            $cursor_off = "pointer;";
                            $class = "btn btn-info btn-sm";
                        } else {
                            $stop_available = 0;
                            $cursor_off = "default;";
                            $class = "btn btn-default btn-sm";
                        } ?>
                        
                        <a href="javascript:void(0);" data-stop="<?=$stop_available?>" class="<?=$class?>" id="span_stop_<?=$import->getNumber("id")?>" onclick="updateImport('stop', <?=$import->getNumber("id")?>, '<?=$import->getString("type")?>');" style="cursor: <?=$cursor_off?>">
                            <?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORT)?>
                        </a>
                        
                        <? if (($import->getString("status") != "R") && ($import->getString("status") != "W") && ($import->getString("action") != "NR") && ($import->getString("action") != "C")) {
                            $delete_available = 1;
                            $cursor_del = "pointer;";
                            $class = "btn btn-warning btn-sm";
                        } else {
                            $delete_available = 0;
                            $cursor_del = "default;";
                            $class = "btn btn-default btn-sm";
                        } ?>
                        
                        <a href="javascript:void(0);" data-delete="<?=$delete_available?>" class="<?=$class?>" id="span_delete_<?=$import->getNumber("id")?>" onclick="updateImport('delete', <?=$import->getNumber("id")?>, '<?=$import->getString("type")?>');" style="cursor: <?=$cursor_del?>">
                            <?=system_showText(LANG_SITEMGR_IMPORT_DELETELOG)?>
                        </a>                      
                        
                    </td>

                </tr>
                <tr id="log_<?=$import->getNumber("id");?>" <? if ($log_id != $import->getNumber("id")) echo "style=\"display:none;\"";?> >
                    <td colspan="5">
                        <?
                        echo import_getHistory($import->getString("history"));
                        ?>
                    </td>
                    <td colspan="3" align="center" id="message_progress_<?=$import->getNumber("id")?>">&nbsp;</td>
                </tr>
                <? } ?>
            </tbody>
        </table>
        </div>
    </div>