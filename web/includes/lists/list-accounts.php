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
            foreach ($accounts as $account) {
                $cont++;
                $id = $account->getNumber("id");
                $contactObj = new Contact($id);
                
                //Prepare info to preview
                $previewAccount[$cont]["id"] = $id;
                $previewAccount[$cont]["name"] = $contactObj->getString("first_name")." ".$contactObj->getString("last_name");
                $previewAccount[$cont]["username"] = $account->getString("username");
                $previewAccount[$cont]["email"] = $contactObj->getString("email");
                $previewAccount[$cont]["updated"] = format_date($account->getNumber("updated"), DEFAULT_DATE_FORMAT)." - ".format_getTimeString($account->getNumber("updated"));
                $previewAccount[$cont]["created"] = format_date($account->getNumber("entered"), DEFAULT_DATE_FORMAT)." - ".format_getTimeString($account->getNumber("entered"));
                $previewAccount[$cont]["company"] = $contactObj->getString("company");
                $previewAccount[$cont]["address"] = $contactObj->getString("address");
                if ($contactObj->getString("address2")) {
                    $previewAccount[$cont]["address"] .= ($previewAccount[$cont]["address"] ? ", " : "").$contactObj->getString("address2");
                }
                if ($contactObj->getString("city")) {
                    $previewAccount[$cont]["address"] .= ($previewAccount[$cont]["address"] ? "<br>" : "").$contactObj->getString("city");
                }
                if ($contactObj->getString("state")) {
                    $previewAccount[$cont]["address"] .= ($previewAccount[$cont]["address"] ? "," : "").$contactObj->getString("state");
                }
                if ($contactObj->getString("zip")) {
                    $previewAccount[$cont]["address"] .= ($previewAccount[$cont]["address"] ? " " : "").$contactObj->getString("zip");
                }
                if ($contactObj->getString("country")) {
                    $previewAccount[$cont]["address"] .= ($previewAccount[$cont]["address"] ? "<br>" : "").$contactObj->getString("country");
                }
                $previewAccount[$cont]["phone"] = $contactObj->getString("phone");
                $previewAccount[$cont]["fax"] = $contactObj->getString("fax");
                $previewAccount[$cont]["url"] = $contactObj->getString("url");
                $previewAccount[$cont]["active"] = $account->getString("active");
                $previewAccount[$cont]["profile"] = $account->getString("has_profile");
                $previewAccount[$cont]["sponsor"] = $account->getString("is_sponsor");
                ?>

                <li class="content-item" tabindex="" data-id="<?=$account->getNumber("id")?>">
                    <div class="status text-hide"><?=$status->getStatusWithStyle($account->getString("active") == "n" ? "P" : "A");?></div>
                    <div class="item">
                        <h3 class="item-title"><?=$contactObj->getString("first_name")." ".$contactObj->getString("last_name");?></h3>
                        <p><?=system_showAccountUserName($account->getString("username"), true, $contactObj->getString("email"));?></p>
                        <p>
                            <a href="javascript:void(0);" onclick="accountLogin(<?=($account->getString("is_sponsor") == 'n' ? "'edit_profile'" : "''")?>, '<?=$account->getString("username")?>');">
                                <?=system_showText(LANG_SITEMGR_LOGIN)?> <?=system_showText(LANG_SITEMGR_INTOTHISACCOUNT)?>
                            </a>
                            <span class="pull-right">
                                <?=system_showText(LANG_SITEMGR_LASTLOGIN)?>: 
                                <?
                                if ($account->getNumber("lastlogin") != 0) {
                                    $lastLogin_field = format_date($account->getNumber("lastlogin"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($account->getNumber("lastlogin"));
                                } else {
                                    $lastLogin_field = system_showText(LANG_SITEMGR_ACCOUNT_NEWACCOUNT);
                                }
                                ?>
                                <span class="text-muted"><?=$lastLogin_field;?></span>
                            </span>
                        </p>
                    </div>
                </li>
        <? } ?>

        </ul>

    </section>