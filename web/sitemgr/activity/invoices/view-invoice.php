<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/invoices/view-invoice.php
	# ----------------------------------------------------------------------------------------------------

    if (is_array($previewInvoice)) {
        foreach ($previewInvoice as $prevInvoice) { ?>
            
        <section class="view-content-info" id="view-content-info-<?=$prevInvoice["id"]?>" style="display:none">

            <div class="control-view">
                <div class="btn-toolbar pull-left">
                    <div class="btn-group btn-group-sm">
                        <? if ($prevInvoice["status"] == "P") { ?>
                        <a class="btn btn-icon btn-info" data-toggle="modal" data-target="#modal-settings" href="#" onclick="$('#setting-id').val(<?=$prevInvoice["id"]?>)" title="<?=system_showText(LANG_SITEMGR_CHANGESTATUS);?>"><i class="icon-flag25"></i> <?=system_showText(LANG_SITEMGR_CHANGESTATUS);?></a>
                        <? } ?>
                        <a class="btn btn-icon btn-danger" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$prevInvoice["id"]?>)" title="<?=system_showText(LANG_LABEL_DELETE);?>"><i class="icon-waste2"></i> <?=system_showText(LANG_LABEL_DELETE);?></a>
                    </div>
                </div>
                <button type="button" class="close close-view" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="view-item" id="item-info-ajax-<?=$prevInvoice["id"]?>" data-ajax-url="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/invoices/view-invoice-detail.php"?>">
                <div class="text-center">
                    <img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/loading-32.gif" title="<?=LANG_DEAL_PLEASEWAITLOADING?>">
                </div>
            </div>

        </section>

        <? }
    }
?>