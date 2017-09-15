<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table-export.php
	# ----------------------------------------------------------------------------------------------------

    if ($message) { ?>
        <p id="msgDelete" class="alert alert-<?=$messageStyle;?>"><?=$message;?></p>
    <? } ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?=system_showText(LANG_SITEMGR_EXPORT_DOWNLOAD)?>
        </div>
        
        <? if ($exportFiles) { ?>
        <div class="table-responsive content-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th nowrap><?=system_showText(LANG_SITEMGR_LABEL_FILENAME);?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_IMPORT_FILESIZE);?></th>
                    <th nowrap><?=system_showText(LANG_SITEMGR_DATECREATED);?></th>
                    <th nowrap><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($exportFiles as $k => $fInfo) { ?>
                    <? if ($fInfo["file_name"] && $fInfo["file_size"] && $fInfo["file_time"]) { ?>

                    <tr>

                        <td>
                            <?=$fInfo["file_display_name"];?>
                        </td>

                        <td>
                            <?=$fInfo["file_size"];?>
                        </td>

                        <td>
                            <?=$fInfo["file_time"];?>
                        </td>

                        <td>
                            <a class="btn btn-primary btn-sm" href="<?=$url_redirect?>?action=downFile&file=<?=$fInfo["file_name"]?>&displayName=<?=$fInfo["file_display_name"];?>">
                                <?=system_showText(LANG_LABEL_DOWNLOAD);?>
                            </a>
                            <a class="btn btn-warning btn-sm" href="javascript:void(0);" onclick="deleteFile('<?=$fInfo["file_name"]?>');">
                                <?=system_showText(LANG_LABEL_DELETE)?>
                            </a>
                        </td>

                    </tr>
                    <? } ?>
                <? } ?>
            </tbody>
        </table>
        </div>
        <? } ?>
    </div>