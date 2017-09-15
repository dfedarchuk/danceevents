<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/lists/list-badges.php
	# ----------------------------------------------------------------------------------------------------

    $nextBadgeAvailable = 0;
    for ($i = 0; $i < $default_max_choice; $i++) {
        
        $imageObj = new Image($default_images[$i]);
        if ($imageObj->imageExists()) { ?>

            <div class="col-md-2 col-xs-6">

                <div class="thumbnail" role="tablist">
                    <div class="caption">
                        <br>
                        <img src="<?=$imageObj->getPath();?>" alt="<?=$default_name[$i];?>" height="50">
                        <h5 class="overflow"><?=$default_name[$i];?></h5>
                        <a class="btn btn-primary btn-xs" data-toggle="tab" href="#form-badge<?=$i;?>" onclick="scrollPage('.tab-content'); $('#last_badge_changed').attr('value', <?=$i?>);"><?=(system_showText(LANG_SITEMGR_EDIT))?></a>
                        <button type="button" class="btn btn-warning btn-xs" onclick="deleteBadge(<?=$default_editor_id[$i]?>, '<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DELETEQUESTION)?>');"><?=system_showText(LANG_LABEL_REMOVE);?></button>
                    </div>
                </div>

            </div>
            
        <? } else {
            if (!$nextBadgeAvailable) {
                $nextBadgeAvailable = $i;
            }
        }

    } ?>

    <div class="col-md-2 col-xs-6 <?=($nextBadgeAvailable ? "" : "hidden")?>">
        <a class="thumbnail add-new" role="tab" data-toggle="tab" href="#form-badge<?=$nextBadgeAvailable;?>" onclick="$('#last_badge_changed').attr('value', <?=$nextBadgeAvailable?>);">
            <i class="icon-cross8"></i>
            <div class="caption">
                <h6><?=system_showText(LANG_SITEMGR_ADD_BADGE);?></h6>
            </div>
        </a>
    </div>