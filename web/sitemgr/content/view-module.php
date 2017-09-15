<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/view-module.php
	# ----------------------------------------------------------------------------------------------------

    if (is_array($previewModule)) {
        foreach ($previewModule as $prevModule) { ?>

        <section class="view-content-info" id="view-content-info-<?=$prevModule["id"]?>" style="display:none">

            <div class="control-view">
                <div class="btn-toolbar pull-left">
                    <div class="btn-group btn-group-sm ">
                        <? if ($manageModule == "review") { ?>
                            <? if ($prevModule["approved"] == 0 || (string_strlen(trim($prevModule["response"])) > 0 && $prevModule["responseapproved"] == 0)) { ?>
                                <a class="btn btn-icon btn-info" href='javascript:void(0);' onclick='showStatusField(<?=$prevModule['id'];?>);'>
                                    <?=string_ucwords(system_showText(LANG_SITEMGR_APPROVE))?>
                                </a>
                            <? } ?>
                            <a class="btn btn-icon btn-danger" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$prevModule['id'];?>); $('#item-id').val(<?=$prevModule["item_id"];?>); $('#item-type').val('<?=$prevModule["item_type"];?>')">
                                <?=system_showText(LANG_LABEL_DELETE);?>
                            </a>
                        <? } else { ?>
                            <a class="btn btn-icon btn-info" href="<?=$url_redirect?>/<?=($manageModule == "promotion" ? "deal" : $manageModule)?>.php?id=<?=$prevModule["id"]?>&amp;screen=<?=$screen?>&amp;letter=<?=$letter?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_LABEL_EDIT);?>"><i class="icon-edit38"></i> <span class="hidden-xs"><?=system_showText(LANG_LABEL_EDIT);?></span></a>
                            <? if ($manageModule != "promotion") { ?>
                            <a class="btn btn-icon btn-info" data-toggle="modal" data-target="#modal-settings" href="#" onclick="$('#setting-id').val(<?=$prevModule["id"]?>)" title="<?=system_showText(LANG_SITEMGR_CHANGESTATUS);?>"><i class="icon-flag25"></i> <span class="hidden-xs"><?=system_showText(LANG_SITEMGR_CHANGESTATUS);?></span></a>
                            <? } ?>
                            <a class="btn btn-icon btn-danger" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$prevModule["id"]?>)" title="<?=system_showText(LANG_LABEL_DELETE);?>"><i class="icon-waste2"></i> <span class="hidden-xs"><?=system_showText(LANG_LABEL_DELETE);?></span></a>
                        <? } ?>
                    </div>
                </div>
                <button type="button" class="close close-view" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="view-item">

                <div class="row">
                    <? if ($manageModule != "review") { ?>
                        <div class="pull-right text-center main-image col-sm-6 col-xs-12">
                            <? if ($prevModule["thumb"]) { ?>
                                <img class="img-thumbnail" src="<?=$prevModule["thumb"]?>" alt="Image1">
                            <? } ?>

                            <? if ((!in_array($manageModule, ["banner", "promotion", "review"])) || ($manageModule == 'promotion' && $prevModule['listing_id'] !== 0)) { ?>
                                <p><a class="btn btn-icon btn-sm btn-primary" href="<?=$prevModule["preview_url"]?>" title="<?=system_showText(LANG_LABEL_VIEW_LIVE);?>" target="_blank"><i class="icon-ion-ios7-world-outline"></i> <?=system_showText(LANG_LABEL_VIEW_LIVE);?></a></p>
                            <? } ?>
                        </div>
                    <? } ?>

                    <div class="col-xs-12 col-sm-6">
                        <h1><?=$prevModule["title"]?></h1>

                        <? if ($prevModule["account"]) { ?>
                            <p><?=system_showText(LANG_LABEL_ACCOUNT);?>:
                                <a href="<?=$url_base?>/account/sponsor/sponsor.php?id=<?=$prevModule["account_id"]?>" class="text-info"><?=$prevModule["account"];?></a></p>
                        <? } else { ?>
                            <p><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER);?></p>
                        <? } ?>
                        <p><?=system_showText(LANG_SITEMGR_DATECREATED)?>: <?=$prevModule["created"]?></p>
                        <? if ($manageModule != "review") { ?>
                            <p><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>: <?=$prevModule["updated"]?></p>
                        <? } ?>
                    </div>
                    <div class="col-xs-12">
                        <?= $manageModule == 'promotion' && $prevModule['listing_id'] == 0 ? "<b><i>".system_showText(LANG_SITEMGR_PROMOTION_LISTING_REQUIRED)."</i></b>" : '' ?>

                        <? if ($manageModule == "event") { ?>
                            <h5><?=system_showText(LANG_EVENT_WHEN)?></h5>
                            <div>
                                <p><?=$prevModule["date"]?></p>
                            </div>
                        <? } ?>

                        <? if ($prevModule["summary"]) { ?>
                            <h5><?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?></h5>
                            <div>
                                <p><?=$prevModule["summary"]?></p>
                            </div>
                        <? } ?>

                        <? if ($prevModule["address"]) { ?>
                            <h5><?=system_showText(LANG_LABEL_ADDRESS);?></h5>
                            <address><?=$prevModule["address"]?></address>
                        <? } ?>

                        <? if ($prevModule["phone"]) { ?>
                            <h5><?=system_showText(LANG_LABEL_PHONE);?></h5>
                            <p><?=$prevModule["phone"]?></p>
                        <? } ?>

                    </div>
                </div>

                <? if ($manageModule == "review") { ?>
                    <? include(INCLUDES_DIR."/forms/form_review_sitemgr.php"); ?>
                <? } else { ?>
                    <div class="row view-item-summary">

                    <? if ($prevModule["reviews"]) { ?>
                        <div class="col-sm-3 col-xs-12">
                            <a href="<?=$url_base."/activity/reviews-comments/index.php?item_type=$manageModule&item_id=".$prevModule["id"]?>">
                                <i class="icon-ion-ios7-star-outline"></i>
                                <?=system_showText(LANG_REVIEW_PLURAL);?>
                            </a>
                        </div>
                    <? } ?>

                    <? if ($manageModule == "listing" || $manageModule == "event" || $manageModule == "classified") { ?>
                        <div class="col-sm-3 col-xs-12">
                            <a href="<?=$url_base."/activity/leads/index.php?item_type=$manageModule&item_id=".$prevModule["id"]?>">
                                <i class="icon-ion-ios7-email-outline"></i>
                                <?=system_showText(LANG_LABEL_LEADS)?>
                            </a>
                        </div>
                    <? } ?>

                    <? if ($manageModule == "listing" || $manageModule == "article" || $manageModule == "promotion" || $manageModule == "blog") { ?>
                        <div class="col-sm-3 col-xs-12">
                            <a href="<?=$url_redirect?>/facebook.php?id=<?=$prevModule["id"]?>">
                                <i class="icon-ion-ios7-people-outline"></i>
                                <?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?>
                            </a>
                        </div>
                    <? } ?>

                    <div class="col-sm-3 col-xs-12">
                        <a href="<?=$url_redirect?>/report.php?id=<?=$prevModule["id"]?>">
                            <i class="icon-line31"></i>
                            <?=system_showText(LANG_TRAFFIC_REPORTS);?>
                        </a>
                    </div>

                    <? if ($prevModule["transation"]) { ?>
                    <div class="col-sm-3 col-xs-12">
                        <a href="<?=$prevModule["transation"]?>">
                            <i class="icon-briefcase30"></i>
                            <?=system_showText(LANG_SITEMGR_TRANSACTIONS);?>
                        </a>
                    </div>
                    <? } ?>

                </div>
                <? } ?>

            </div>

        </section>

        <? }
    }
?>
