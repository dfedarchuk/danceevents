<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/custominvoices/view-custominvoice.php
	# ----------------------------------------------------------------------------------------------------

    if (is_array($previewCustomInvoice)) {
        foreach ($previewCustomInvoice as $prevCustomInvoice) { ?>
            
        <section class="view-content-info" id="view-content-info-<?=$prevCustomInvoice["id"]?>" style="display:none">

            <div class="control-view">
                <div class="btn-toolbar pull-left">
                    <div class="btn-group btn-group-sm">
                        <? if ($prevCustomInvoice["paid"] != "y") { ?>
                        <a class="btn btn-icon btn-info" href="<?=$url_redirect?>/custominvoice.php?id=<?=$prevCustomInvoice["id"]?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" title="<?=system_showText(LANG_LABEL_EDIT);?>"><i class="icon-edit38"></i> <span class="hidden-xs"><?=system_showText(LANG_LABEL_EDIT);?></span></a>
                        <a class="btn btn-icon btn-info" href="<?=$url_redirect?>/send.php?id=<?=$prevCustomInvoice["id"]?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" title="<?=system_showText(LANG_SITEMGR_SEND);?>"><i class="icon-ion-ios7-paperplane-outline"></i> <?=system_showText(LANG_SITEMGR_SEND);?></a>
                        <? } ?>
                        <a class="btn btn-icon btn-danger" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$prevCustomInvoice["id"]?>)" title="<?=system_showText(LANG_LABEL_DELETE);?>"><i class="icon-waste2"></i> <?=system_showText(LANG_LABEL_DELETE);?></a>
                    </div>
                </div>
                <button type="button" class="close close-view" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="view-item">
                <div id="item-info-ajax-<?=$prevCustomInvoice["id"]?>" data-ajax-url="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/view-custominvoice-detail.php"?>">
                   
                    <div class="text-center">
                        <img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/loading-32.gif" title="<?=LANG_DEAL_PLEASEWAITLOADING?>">
                    </div>
                    
                </div>
                
                <? if ($prevCustomInvoice["transation"]) { ?>
                <div class="row view-item-summary">
                    <div class="col-sm-3 col-xs-12">
                        <i class="icon-line31"></i>
                        <a href="<?=$prevCustomInvoice["transation"]?>">
                            <?=system_showText(LANG_SITEMGR_TRANSACTIONS);?>
                        </a>
                    </div>
                </div>
                <? } ?>

            </div>

        </section>

        <? }
    }
?>