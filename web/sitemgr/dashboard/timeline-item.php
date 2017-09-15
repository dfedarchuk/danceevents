<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/dashboard/timeline-item.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="timeline-group-item clearfix">
        <div class="col-md-2 col-sm-12 col-xs-12">
            <div class="date">
                <div class="type type-<?=$item->getString("div_type")?>"><span class="<?=$item->getString("icon_type")?>"></span></div>
                <div class="time">
                    <span><?=format_date($item->getString("datetime"), DEFAULT_DATE_FORMAT, "datetime")?></span>
                    <span><?=format_getTimeString($item->getString("datetime"))?></span>
                </div>
            </div>
        </div>
        <div class="pull-right col-md-10 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body row">							
                    <div class="content <?=($item->getString("item_image") ? "col-md-10 col-sm-10" : "")?> col-xs-12">
                        <div class="user-profile">
                            <? if ($item->getNumber("user_id")) { ?>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/".($item->getString("user_sponsor") == "y" ? "sponsor/sponsor" : "visitor/visitor").".php?id=".$item->getNumber("user_id")?>" target="_blank" title="<?=$item->user_name;?>">
                                <img src="<?=$item->getString("user_image");?>" alt="<?=$item->user_name;?>">
                            </a>
                            <? } else { ?>
                                <img src="<?=$item->getString("user_image");?>" alt="<?=$item->user_name;?>">
                            <? } ?>
                        </div>
                        <p><?=$item->user_name;?></p>
                        <hr>
                        <p>
                            <?=$item->getString("item_description");?>
                            <? if ($item->getString("item_detaillink")) { ?>
                            <a href="<?=$item->getString("item_detaillink")?>" target="_blank"><?=$item->getString("item_detaillabel");?></a>
                            <? } ?>
                            <? if ($item->getString("item_url")) { ?>
                            "<a href="<?=$item->getString("item_url")?>" target="_blank"><?=$item->item_title;?></a>"
                            <? } ?>
                        </p>
                        <? if ($item->getString("item_review")) { ?>
                        <blockquote>
<!--                            <span class="rating text-warning"><i class="ionicons ion-ios7-star"></i><i class="ionicons ion-ios7-star"></i><i class="ionicons ion-ios7-star"></i><i class="ionicons ion-ios7-star"></i> </span>-->
                            <p><?=$item->getString("item_review")?></p>
                        </blockquote>
                        <? } ?>
                    </div>
                    <? if ($item->getString("item_image")) { ?>
                    <div class="content-image col-md-2 col-sm-12 hidden-xs">
                        <img src="<?=$item->getString("item_image")?>" alt="<?=$item->getString("item_title");?>">
                    </div>
                    <? } ?>
                </div>
<!--                <div class="panel-footer">
                    <p>
                        <span class="btn btn-sm btn-primary action-approve">Approve review</span>
                        <span class="btn btn-sm btn-primary action-edit">Edit review</span>
                        <span class="btn btn-sm btn-warning action-deny ">Deny action</span>	
                        <span class="check-success hidden"> <i class="icon-ion-ios7-checkmark-outline"></i> You approved this today</span>		
                    </p>				
                </div>-->
            </div>
        </div>
    </div>