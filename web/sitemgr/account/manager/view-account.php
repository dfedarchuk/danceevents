<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/account/manager/view-account.php
	# ----------------------------------------------------------------------------------------------------

    if (is_array($previewAccount)) {
        foreach ($previewAccount as $prevAccount) { ?>

        <section class="view-content-info" id="view-content-info-<?=$prevAccount["id"]?>" style="display:none">

            <div class="control-view">
               <div class="btn-toolbar pull-left">
                    <div class="btn-group btn-group-sm ">       
                        <a class="btn btn-icon btn-info" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/manager.php?id={$prevAccount["id"]}&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")?>" title="<?=system_showText(LANG_LABEL_EDIT)?>"><i class="icon-pencil23"></i> <?=system_showText(LANG_LABEL_EDIT)?></a>
                   
                        <? if ($prevAccount["id"] != $_SESSION[SESS_SM_ID]) { ?>
                       
                            <a class="btn btn-icon btn-danger" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$prevAccount["id"]?>)" title="<?=system_showText(LANG_LABEL_DELETE);?>"><i class="icon-waste2"></i> <?=system_showText(LANG_LABEL_DELETE);?></a>
                        
                        <? } ?>
                    </div>
                </div>
                <button type="button" class="close close-view" aria-hidden="true">&times;</button>
            </div>

            <div class="view-item">
                <h1><?=$prevAccount["name"]?></h1>
                <p><?=$prevAccount["email"]?></p>

                <? if ($prevAccount["phone"]) { ?>
                <h5><?=system_showText(LANG_SITEMGR_LABEL_PHONE)?></h5>
                <p><?=$prevAccount["phone"]?></p>
                <? } ?>
                
                <h5><?=system_showText(LANG_SITEMGR_DATECREATED)?></h5>
                <p><?=$prevAccount["created"]?></p>
                
                <h5><?=system_showText(LANG_SITEMGR_LASTUPDATED)?></h5>
                <p><?=$prevAccount["updated"]?></p>
            </div>
            
        </section>

<?      }
    }
?>