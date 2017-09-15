<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_discountcode.php
	# ----------------------------------------------------------------------------------------------------

?>   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    <?=system_showText(LANG_SITEMGR_LABEL_CODE)?>
                </th>
                <th>
                    <?=system_showText(LANG_SITEMGR_LABEL_REPEAT)?>
                </th>
                <th>
                    <?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION)?>
                </th>
                <th>
                    <?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?>
                </th>
                <th>
                    <?=system_showText(LANG_SITEMGR_STATUS)?>
                </th>
                <th class="text-center">
                    <?=system_showText(LANG_LABEL_OPTIONS)?>
                </th>
            </tr>
        </thead>
        <?
        if (is_array($discount_codes)) foreach ($discount_codes as $each_discount_code) {
            $id = $each_discount_code->getNumber("id");
            $discountCodeStatusObj = new DiscountCodeStatus(); ?>

            <tr>
                <td>
                    <a href="<?=$url_base?>/promote/promotions/discountcode.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>">
                        <b><?=$each_discount_code->getString("id")?></b>
                    </a>
                </td>
                
                <td>
                    <?=system_showText(@constant('LANG_SITEMGR_'.string_strtoupper($each_discount_code->getString("recurring"))));?>
                </td>
                
                <td>
                    <?=format_date($each_discount_code->getString("expire_date"));?>
                </td>
                
                <td>
                    <?=(($each_discount_code->getString("type")=="monetary value") ? CURRENCY_SYMBOL : "")?><?=trim(string_ucwords($each_discount_code->getString("amount")));?><?=(($each_discount_code->getString("type")=="percentage") ? "%" : "")?>
                </td>
                
                <td>
                    <? $discountCodeStatusObj = new DiscountCodeStatus();?>
                    <?=$discountCodeStatusObj->getStatusWithStyle($each_discount_code->getString("status"))?>
                </td>
                
                <td nowrap class=" text-center main-options">
                    <a class="btn btn-primary btn-xs"href="<?=$url_base?>/promote/promotions/discountcode.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>">
                        <?=system_showText(LANG_SITEMGR_EDIT)?>
                    </a>
                    <a class="btn btn-warning btn-xs" href="#" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val('<?=$id?>'); $('#item-type').val('discount');">
                        <?=system_showText(LANG_SITEMGR_DELETE)?>
                    </a>
                </td>
            </tr>
        <? } ?>
    </table>