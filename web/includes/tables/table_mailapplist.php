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
	# * FILE: /includes/tables/table_mailapplist.php
	# ----------------------------------------------------------------------------------------------------

?>
       
    <table class="table table-bordered table-itemlist">

        <tr>
            <th>
                <span><?=system_showText(LANG_LABEL_TITLE);?></span>
            </th>

            <th>
                <span><?=system_showText(LANG_SITEMGR_DATECREATED);?></span>
            </th>

            <th>
                <span><?=system_showText(LANG_LABEL_STATUS);?></span>
            </th>
            
            <th>
                <span><?=system_showText(LANG_SITEMGR_MAILAPP_PROGRESS);?></span>
            </th>

            <th class="text-center">
                <?=system_showText(LANG_LABEL_OPTIONS)?>
            </th>
        </tr>

        <?
        $runAjax = false;
        if ($mailappLists) {
            
            $statusObj = new ImportStatus();
            
            foreach ($mailappLists as $mailappList) { 
                $id = $mailappList->getNumber("id"); 
                $status = $mailappList->getString("status");
                $filePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files/".$mailappList->getString("filename");
                
                if ($status == "F" && file_exists($filePath)) {
                    $onclick_download = "linkRedirect('arcamailerexport.php?action=downFile&id=$id');";
                    $cursor_download = "pointer;";
                    $class_download = "btn btn-primary btn-sm";
                } else {
                    $onclick_download = "javascript: void(0);";
                    $cursor_download = "default;";
                    $class_download = "btn btn-default btn-sm";
                }
                
                if ($status != "R") {
                    $onclick_delete = "deleteList($id);";
                    $cursor_delete = "pointer;";
                    $class_delete = "btn btn-warning btn-sm";
                } else {
                    $onclick_delete = "javascript: void(0);";
                    $cursor_delete = "default;";
                    $class_delete = "btn btn-default btn-sm";
                }
                
                if ($status != "F") {
                    $runAjax = true;
                }
                ?>
                <tr>
                    <td><?=$mailappList->getString("title", true, 40);?></td>
                    
                    <td>
                        <span title="<?=format_date($mailappList->getString("date"))?>" style="cursor:default">
                            <?=format_date($mailappList->getString("date"));?>
                        </span>
                    </td>
                    
                    <td id="tdprogress_<?=$id?>">
                        <?
                        echo $statusObj->getStatusWithStyle(($status == "P" ? "Q" : $status), $id);
                        if ($status == "E") {
                            echo system_showText(LANG_SITEMGR_MAILAPP_ERROR);
                        }
                        ?>
                    </td>
                    
                    <td>
                        <span id="<?="progress_".$id?>"><?=$mailappList->getNumber("progress");?>%</span>
                    </td>
                    
                    <td nowrap class="main-options text-center">                   
                        <a href="javascript:void(0);" class="<?=$class_download?>" id="img_download_<?=$id?>" onclick="<?=$onclick_download?>" style="cursor: <?=$cursor_download?>" /><?=system_showText(LANG_LABEL_DOWNLOAD);?></a>
                        <a href="javascript:void(0);" class="<?=$class_delete?>" id="img_delete_<?=$id?>" onclick="<?=$onclick_delete?>" style="cursor: <?=$cursor_delete?>" /><?=system_showText(LANG_LABEL_DELETE);?></a>
                    </td>
                </tr>

                <?
            }
        } 
        ?>
        
    </table>