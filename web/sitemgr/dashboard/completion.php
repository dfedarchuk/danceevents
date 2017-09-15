<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/dashboard/completion.php
	# ----------------------------------------------------------------------------------------------------

    if ($FirstStartDashboard) {

        $looseJS = "var tour = new Tour({
                                        container: 'html',
                                        storage: false,
                                        steps: [
                                        {
                                            element: '#navBrand',
                                            title: '".system_showText(LANG_SITEMGR_DASHTOUR_1_TITLE)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_1_TIP)."',
                                            placement: 'right'
                                        },
                                        {
                                            element: '#navUserSites',
                                            title: '".system_showText(LANG_SITEMGR_NAVBAR_DOMAIN_PLURAL)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_2_TIP)."',
                                            placement: 'bottom'
                                        },
                                        {
                                            element: '#navUserAccounts',
                                            title: '".system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_3_TIP)."',
                                            placement: 'bottom'
                                        },
                                        {
                                            element: '#navUserFaq',
                                            title: '".system_showText(LANG_SITEMGR_SUPPORT)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_4_TIP)."',
                                            placement: 'bottom'
                                        },
                                        {
                                            element: '#navDashboard',
                                            title: '".system_showText(LANG_SITEMGR_DASHBOARD)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_5_TIP)."',
                                            placement: 'right'
                                        },
                                        {
                                            element: '#navContent',
                                            title: '".system_showText(LANG_SITEMGR_CONTENT_MANAGER)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_6_TIP)."',
                                            placement: 'right'
                                        },
                                        {
                                            element: '#navActivity',
                                            title: '".system_showText(LANG_SITEMGR_ACTIVITY)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_7_TIP)."',
                                            placement: 'right'
                                        },
                                        {
                                            element: '#navPromote',
                                            title: '".system_showText(LANG_SITEMGR_PROMOTE)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_8_TIP)."',
                                            placement: 'right'
                                        },
                                        {
                                            element: '#navDesign',
                                            title: '".system_showText(LANG_SITEMGR_DESIGN_CUSTOM)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_9_TIP)."',
                                            placement: 'right'
                                        },
                                        {
                                            element: '#navConfig',
                                            title: '".system_showText(LANG_SITEMGR_CONFIG)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_10_TIP)."',
                                            placement: 'right'
                                        },
                                        {
                                            element: '#navAppbuilder',
                                            title: '".system_showText(LANG_SITEMGR_MOBILE_APPS)."',
                                            content: '".system_showText(LANG_SITEMGR_DASHTOUR_11_TIP)."',
                                            placement: 'right',
                                            next: -1
                                        }
                                        ]
                                        });

                                        $('#start-tour').click( function() {
                                            if (!$('#navUser').hasClass('show')) {
                                                $('#navUser').toggleClass('show');
                                                $('.navbar-nav').toggleClass('show');
                                            }
                                            tour.restart();
                                            tour.start();
                                        });";

        JavaScriptHandler::registerOnReady($looseJS);

?>

    <section id="welcome">
        <div class="jumbotron">
            <h1><?=system_showText(LANG_SITEMGR_DASH_WELCOME)?></h1>
            <p><?=system_showText(LANG_SITEMGR_DASH_WELCOME_TIP)?></p>
            <button type="button" id="start-tour" class="btn btn-primary btn-lg hidden-xs"><small class="icon-small31"></small> <?=system_showText(LANG_SITEMGR_DASH_START_TOUR);?></button>

            <hr>

            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h2><?=system_showText(LANG_SITEMGR_DASH_START1)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_DASH_START1_TIP)?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/page-editor/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_DASH_START1_TIP2)?></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h2><?=system_showText(LANG_SITEMGR_DASH_START2)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_DASH_START2_TIP)?></p>
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/promote/helpme/"?>" class="btn btn-info"><?=system_showText(LANG_SITEMGR_DASH_START2_TIP2)?></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h2><?=system_showText(LANG_SITEMGR_DASH_START3)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_DASH_START3_TIP)?></p>
                    <a href="http://support.edirectory.com/" target="_blank" class="btn btn-info"><?=system_showText(LANG_SITEMGR_FREQUENTLYASKEDQUESTIONS);?></a>
                </div>
            </div>

            <? if (is_array($arrayCompletion) && count($arrayCompletion)) { ?>

            <hr>

            <div class="row">
                <div class="dashincomplete col-xs-12">
                    <h2><?=system_showText(LANG_SITEMGR_DASH_COMPLETION);?></h2>
                    <p><?=system_showText(LANG_SITEMGR_TODO_WELCOME_TIP);?></p>
                    <p><?=system_showText(LANG_SITEMGR_TODO_WELCOME_TIP2);?></p>
                </div>
                <div class="col-xs-12 dashcomplete hidden">
                    <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_DASH_DONE);?> <?=system_showText(LANG_SITEMGR_DASH_DONE2);?></p>
                </div>
            </div>

            <div class="row completion-panel dashincomplete">
                <? foreach ($arrayCompletion as $completion) { ?>
                <div class="col-sm-6 col-lg-3 clearfix">
                    <div id="step_<?=$completion["option"]?>" class="completion-tip <?=$completion["div_class"]?>">
                        <span id="span_<?=$completion["option"]?>" class="tipcomplete" title="<?=$completion["check_tip"]?>" data-auxtip="<?=system_showText(LANG_SITEMGR_DASH_STEPSDONE)?>" data-placement="bottom" onclick="updateDashboard('<?=$completion["option"]?>')"><i id="icon_<?=$completion["option"]?>" class="<?=$completion["icon_class"]?>"></i></span>
                        <a href="<?=$completion["link"]?>">
                            <div class="pull-right">
                                <strong><?=$completion["title"]?></strong>
                                <p><?=$completion["tip"]?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <? } ?>
            </div>

            <? } ?>

        </div>
    </section>

    <? } elseif (is_array($arrayCompletion) && count($arrayCompletion)) { ?>

    <section id="completion">
        <div class="panel panel-dashboard dashincomplete">
            <div class="panel-heading">
                <h1><?=system_showText(LANG_SITEMGR_DASH_COMPLETION);?></h1>
                <p><?=system_showText(LANG_SITEMGR_TODO_WELCOME_TIP);?></p>
                <p><?=system_showText(LANG_SITEMGR_TODO_WELCOME_TIP2);?></p>
            </div>
            <div class="panel-body completion-panel">

                <? foreach ($arrayCompletion as $completion) { ?>
                <div class="col-sm-6 col-lg-3 clearfix">
                    <div id="step_<?=$completion["option"]?>" class="completion-tip <?=$completion["div_class"]?>">
                        <span id="span_<?=$completion["option"]?>" class="tipcomplete" title="<?=$completion["check_tip"]?>" data-auxtip="<?=system_showText(LANG_SITEMGR_DASH_STEPSDONE)?>" data-placement="bottom" onclick="updateDashboard('<?=$completion["option"]?>')"><i id="icon_<?=$completion["option"]?>" class="<?=$completion["icon_class"]?>"></i></span>
                        <a href="<?=$completion["link"]?>">
                            <div class="pull-right">
                                <strong><?=$completion["title"]?></strong>
                                <p><?=$completion["tip"]?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <? } ?>

            </div>
        </div>

        <div class="col-xs-12 dashcomplete hidden">
            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_DASH_DONE);?></p>
        </div>

    </section>

    <? } ?>
