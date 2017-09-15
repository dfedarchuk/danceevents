<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/lists/list-accounts.php
	# ----------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_account[$message])) {
        echo "<p class=\"alert alert-success\">".$msg_account[$message]."</p>";
    }
?>

    <section>

        <ul class="list-content-item list no-bulk">

         <?
            $status = new ItemStatus();
            $cont = 0;
            foreach($smaccounts as $smaccount) {
                $cont++;
                $id = $smaccount->getNumber("id");
                
                //Prepare info to preview
                $previewAccount[$cont]["id"] = $id;
                $previewAccount[$cont]["name"] = $smaccount->getString("name");
                $previewAccount[$cont]["email"] = $smaccount->getString("email");
                $previewAccount[$cont]["username"] = $smaccount->getString("username");
                $previewAccount[$cont]["created"] = format_date($smaccount->getNumber("entered"), DEFAULT_DATE_FORMAT)." - ".format_getTimeString($smaccount->getNumber("entered"));
                $previewAccount[$cont]["updated"] = format_date($smaccount->getNumber("updated"), DEFAULT_DATE_FORMAT)." - ".format_getTimeString($smaccount->getNumber("updated"));
                $previewAccount[$cont]["phone"] = $smaccount->getString("phone");
                ?>

                <li class="content-item" tabindex="" data-id="<?=$smaccount->getNumber("id")?>">
                    <div class="status text-hide"><?=$status->getStatusWithStyle($smaccount->getString("active") == "n" ? "P" : "A");?></div>
                    <div class="item">
                        <h3 class="item-title"><?=$smaccount->getString("name");?></h3>
                        <p><?=$smaccount->getString("username");?></p>
                        <p>
                            <?(($smaccount->getString("entered") != "0000-00-00 00:00:00") ? $created_field = (format_date($smaccount->getString("entered"), DEFAULT_DATE_FORMAT, "datetime"))." - ".format_getTimeString($smaccount->getString("entered")) : $created_field = "---")?>
                            <?=system_showText(LANG_SITEMGR_LABEL_CREATED)?>: <?=$created_field?>
                        </p>
                    </div>
                </li>
         <? } ?>

        </ul>

    </section>