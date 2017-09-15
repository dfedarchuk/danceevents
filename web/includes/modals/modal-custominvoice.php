<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-custominvoice.php
	# ----------------------------------------------------------------------------------------------------

    $customInvoice = new CustomInvoice($id);
    $customInvoiceItems = $customInvoice->getItems();
?>
    <div class="modal fade" id="modal-custominvoice-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="modal-custominvoice" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=$customInvoice->getString("title");?></h4>
                </div>
                <div class="modal-body">
                    <? if ($customInvoiceItems) { ?>

                        <h3><?=system_showText(LANG_LABEL_CUSTOM_INVOICE_ITEMS)?></h3>

                        <table class="table">
                            <tr>
                                <th><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
                                <th style="width: 70px;"><?=system_showText(LANG_LABEL_PRICE)?></th>
                            </tr>
                            <? foreach ($customInvoiceItems as $each_custominvoice_item) { ?>
                                <tr>
                                    <td><?=$each_custominvoice_item["description"]?></td>
                                    <td><?=CURRENCY_SYMBOL." ".format_money($each_custominvoice_item["price"])?></td>
                                </tr>
                            <? }?>
                        </table>

                    <? } else { ?>
                        <p class="alert alert-warning"><?=system_showText(LANG_MSG_NO_ITEMS_FOUND)?></p>
                    <? } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=system_showText(LANG_CLOSE)?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->