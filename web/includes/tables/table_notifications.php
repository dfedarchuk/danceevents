<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table-notification.php
	# ----------------------------------------------------------------------------------------------------
?>

    <table class="table table-bordered">
        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_STATUS)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_LASTUPDATE)?>
            </th>
        </tr>
        <?
        if ($emails) {
            foreach($emails as $email) { 
                $id = $email->getNumber("id"); 
        ?>

            <tr>			

                <td class="table-help">
                    <a href="email.php?id=<?=$id?>">
                        <?=system_showText(@constant("LANG_SITEMGR_EMAILNOTIF_TYPE_".$id))?>
                    </a>
                    <i class="icon-help8" title="<?=system_showText(@constant("LANG_SITEMGR_EMAILNOTIF_DESC_".$id))?>"></i>
                </td>

                <td class="text-center">
                    <a href="<?=$url_redirect?>/index.php?id=<?=$email->getString("id")?>&deactive=<?=$email->getString("deactivate")?>"><img src="<?=DEFAULT_URL?>/assets/images/structure/<?=$email->getString('deactivate') == '0' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($email->getString('deactivate') == '0' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($email->getString('deactivate') == '0' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" /></a>
                </td>

                <td>
                    <?=!$email->getNumber("days") ? system_showText(LANG_SITEMGR_SYSTEMNOTIFICATION) : system_showText(LANG_SITEMGR_RENEWALREMINDER)?>
                </td>

                <td>
                    <?=!$email->getNumber("deactivate") ? system_showText(LANG_SITEMGR_ACTIVE) : system_showText(LANG_SITEMGR_DISABLED) ?>
                </td>

                <td>
                <?
                    if($email->getNumber("updated") == 0) {
                        echo system_showText(LANG_SITEMGR_NOTUPDATED);
                    } else {
                        echo format_date($email->getNumber("updated"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($email->getNumber("updated"));
                    }
                ?>
                </td>
                
            </tr>
        <? 
            }
        } ?>
    </table>
