<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-packageitems.php
	# ----------------------------------------------------------------------------------------------------

    $package = new Package($id);
    $packagePaymentItems = $items;
    $packagePaymentPrices = $items_price;

    $packagePaymentItems = explode("\n", $packagePaymentItems);
    $packagePaymentPrices = explode("\n", $packagePaymentPrices);

    $str_price = "";
    foreach ($packagePaymentPrices as $price) {
        if ($price) $str_price .= CURRENCY_SYMBOL." ".format_money($price)."<br />";
    }

?>
    <div class="modal fade" id="modal-package-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="modal-package" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=$package->getString("title");?></h4>
                </div>
                <div class="modal-body">
                    <h3><?=string_ucwords(system_showText(LANG_PACKAGE_SING))?> <?=system_showText(LANG_LABEL_ITEMS)?></h3>

                    <table class="table">
                        <tr>
                            <th><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
                            <th style="width: 70px;"><?=system_showText(LANG_LABEL_PRICE)?></th>
                        </tr>
                        <?
                        if ($packagePaymentItems && $packagePaymentPrices) {
                            foreach ($packagePaymentItems as $key => $each_item) {
                                ?>
                                <tr>
                                    <td><?=$each_item?></td>
                                    <? if ($key != 0) { ?>
                                        <td><?=$str_price?></td>
                                    <? } else { ?>
                                        <td>&nbsp;</td>
                                    <? } ?>
                                </tr>
                                <?
                            }
                        }
                        ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=system_showText(LANG_CLOSE)?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
