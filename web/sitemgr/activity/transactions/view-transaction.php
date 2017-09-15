<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/transactions/view-transaction.php
	# ----------------------------------------------------------------------------------------------------

    if (is_array($previewTransaction)) {
        foreach ($previewTransaction as $prevTransaction) { ?>
            
        <section class="view-content-info" id="view-content-info-<?=$prevTransaction["id"]?>" style="display:none">

            <div class="control-view">
                <div class="btn-toolbar pull-left">
                    <div class="btn-group btn-group-sm ">
                        <a class="btn btn-icon btn-danger" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$prevTransaction["id"]?>)" title="<?=system_showText(LANG_LABEL_DELETE);?>"><i class="icon-waste2"></i> <?=system_showText(LANG_LABEL_DELETE);?></a>
                    </div>
                </div>
                <button type="button" class="close close-view" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="view-item" id="item-info-ajax-<?=$prevTransaction["id"]?>" data-ajax-url="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/transactions/view-transaction-detail.php"?>">
                <div class="text-center">
                    <img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/loading-32.gif" title="<?=LANG_DEAL_PLEASEWAITLOADING?>">
                </div>
            </div>

        </section>

        <? }
    }
?>