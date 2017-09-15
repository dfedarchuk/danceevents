<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/lists/list-terms.php
# ----------------------------------------------------------------------------------------------------

 //Success and Error Messages
if (is_numeric($error_message)) {
    echo "<p class=\"alert alert-warning\">".$msg_bulkupdate[$error_message]."</p>";
} elseif ($error_msg) {
    echo "<p class=\"alert alert-warning\">".$error_msg."</p>";
} elseif ($msg == "success") {
    echo "<p class=\"alert alert-success\">".system_showText(LANG_MSG_NEARBYSEARCH_SUCCESSFULLY_UPDATE)."</p>";
} elseif ($msg == "successdel") {
    echo "<p class=\"alert alert-success\">".system_showText(LANG_MSG_NEARBYSEARCH_SUCCESSFULLY_DELETE)."</p>";
}
unset($msg); ?>

<section>
    <form name="item_list" role="form">
        <ul class="list-content-item list">
            <?php if ($nearbyTerms) {
                $cont = 0;
                foreach ($nearbyTerms as $term) {
                    $cont++;
                    $previewTerm[$cont]["id"] = $term->getNumber("id");
                    $previewTerm[$cont]["token"] = $term->getString("token");
                    $previewTerm[$cont]["radius"] = $term->getNumber("radius");
                    $previewTerm[$cont]["latitude"] = $term->getNumber("latitude");
                    $previewTerm[$cont]["longitude"] = $term->getNumber("longitude");
                ?>
                <li class="content-item" data-id="<?= $term->getNumber("id")?>" onclick="loadTermsMap(<?= $term->getNumber("id")?>)">
                    <div class="check-bulk">
                        <input type="checkbox" id="<?=$manageModule?>_id<?=$cont?>" name="item_check[]" value="<?=$term->getNumber("id")?>" onclick="bulkSelect('<?=$manageModule?>');"/>
                    </div>

                    <div class="item">
                        <h3 class="item-title"><?= $term->getString("token") ?></h3>
                    </div>
                </li>
            <? }
            } ?>
        </ul>
    </form>
</section>
