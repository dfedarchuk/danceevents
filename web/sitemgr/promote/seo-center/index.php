<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/promote/seo-center/index.php
	# ----------------------------------------------------------------------------------------------------
    
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();

    if( $_SERVER['REQUEST_METHOD'] == "POST" )
    {
        // Google Code
        include(INCLUDES_DIR."/code/google_verification.php");

        // Live Code
        $searchMetaObj = new SearchMetaTag( 'live' );

        if ( $_POST["live_tag"] )
        {
            if ( validate_form( "search_metatag", $_POST, $error ) )
            {
                $metatagaux = $_POST["live_tag"];
                $metatagaux = str_replace( "<META ", "<meta ", $metatagaux );
                $metatagaux = str_replace( " NAME=", " name=", $metatagaux );
                $metatagaux = str_replace( " CONTENT=", " content=", $metatagaux );
                if ( string_strpos( $metatagaux, "/>" ) === false )
                {
                    $metatagaux = str_replace( ">", " />", $metatagaux );
                }
                $_POST["live_tag"] = $metatagaux;

                if ( $searchMetaObj->isSetField() )
                {
                    $searchMetaObj->setString( 'value', $_POST["live_tag"] );
                    $searchMetaObj->Save();
                }
                else
                {
                    $searchMetaObj->setString( 'name', 'live' );
                    $searchMetaObj->setString( 'value', $_POST["live_tag"] );
                    $searchMetaObj->Save( false );
                }

                MessageHandler::registerSuccess( array( "SeoSettSucc" => system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGSUCCESS) ));
            }
        }
        else
        {
            $searchMetaObj->Delete();
        }

        MessageHandler::registerError( $error );
        MessageHandler::render();
        exit();
    }

    # ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
    
    # ----------------------------------------------------------------------------------------------------
	# SIDEBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-promote.php");
    
    $_locations = explode(",", EDIR_LOCATIONS);
    $firsLevel = $_locations[0];

    # ----------------------------------------------------------------------------------------------------
    # DEFINES
    # ----------------------------------------------------------------------------------------------------
    $searchMetaObj_google = new SearchMetaTag('google');
    $googleTag = html_entity_decode($searchMetaObj_google->getString('value'));
    $searchMetaObj_live = new SearchMetaTag('live');
    $liveTag = html_entity_decode($searchMetaObj_live->getString('value'));
?> 

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading row">
            <h1><?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?></h1>
            <p><?=system_showText(LANG_SITEMGR_SEOCENTER_TITLE)?></p>
        </section>

        <section class="well well-intro">
            
            <div class="row">
                <div class="col-sm-1 col-xs-3 text-center"><i class="icon-uniE604"></i></div>
                <div class="col-sm-11 col-xs-9">
                    <h2><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY)?></h2>
                    <p><?=system_showText(LANG_SITEMGR_SEOCENTER_1);?></p>
                    <a class="btn btn-info" data-toggle="modal" data-target="#modal-settings-SEO"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SEARCHVERIFYCTION);?></a>
                </div>
            </div>
		
            <div class="row">
                <? if (SITEMAP_FEATURE == "on") { ?>
                    <div class="col-sm-1 col-xs-3 text-center"><i class="icon-ion-ios7-bookmarks-outline"></i></div>
                    <div class="col-sm-5 col-xs-9">
                        <h2><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP)?></h2>
                        <?
                            $domainObj = new Domain(SELECTED_DOMAIN_ID);
                            $sitemapUrl = "http://".$domainObj->getString("url").EDIRECTORY_FOLDER;
                        ?>
                        <p><?=system_showText(LANG_SITEMGR_SEOCENTER_2)?></p>
                        <a class="btn btn-info" href="<?=$sitemapUrl;?>/custom/domain_<?=SELECTED_DOMAIN_ID?>/sitemap/index.xml" target="_blank"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SITEMAPXML);?></a>
                    </div>
                <? } ?>
                    
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_DESIGN)) { ?>
                    <div class="col-sm-1 col-xs-3 text-center"><i class="icon-ion-ios7-paper-outline"></i></div>
                    <div class="col-sm-5 col-xs-9">
                        <h2><?=system_showText(LANG_SITEMGR_SEOCENTER_HOMEPAGEOPTIMIZATION)?></h2>
                        <p><?=system_showText(LANG_SITEMGR_SEOCENTER_3)?></p>
                        <a class="btn btn-info" href="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/design/page-editor/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SITECONTENTSECTION)?></a>
                    </div>
                <? } ?>

                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONTENT)) { ?>
                    <div class="col-sm-1 col-xs-3 text-center"><i class="icon-ion-ios7-folder-outline"></i></div>
                    <div class="col-sm-5 col-xs-9">
                        <h2><?=system_showText(LANG_SITEMGR_SEOCENTER_CATEGORYINFORMATION)?></h2>
                        <p><?=system_showText(LANG_SITEMGR_SEOCENTER_4)?></p>
                        <a class="btn btn-info" href="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/content/listing/categories/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_CATEGORIESSECTION)?></a>
                    </div>
                <? } ?>
                    
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONFIG)) { ?>
                    <div class="col-sm-1 col-xs-3 text-center"><i class="icon-locator1"></i></div>
                    <div class="col-sm-5 col-xs-9">
                        <h2><?=system_showText(LANG_SITEMGR_SEOCENTER_LOCATIONINFORMATION)?></h2>
                        <p><?=system_showText(LANG_SITEMGR_SEOCENTER_5)?></p>
                        <a class="btn btn-info" href="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/configuration/geography/locations/location_<?=$firsLevel?>/index.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_LOCATIONSSECTION)?></a>
                    </div>
                <? } ?>
            </div>

            <hr>
            <div class="row">
                <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CONTENT)) { ?>
                    <div class="col-sm-1 col-xs-3 text-center"><i class="icon-document50"></i></div>
                    <div class="col-sm-11 col-xs-9">
                        <h2><?=system_showText(LANG_SITEMGR_SEOCENTER_ITEMOPTIMIZATION)?></h2>
                        <p><?=system_showText(LANG_SITEMGR_SEOCENTER_6)?></p>
                        <div class="row">

                                <div class="text-center col-sm-4">
                                    <p><i class="icon-book82"></i> </p>
                                    <a class="btn btn-info" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=LISTING_FEATURE_FOLDER;?>/"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))?></a>
                                </div>

                                <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on"){ ?>
                                    <div class="text-center col-sm-4">
                                        <p><i class="icon-ion-ios7-pricetags-outline"></i> </p>
                                        <a class="btn btn-info" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=PROMOTION_FEATURE_FOLDER?>/"><?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION)?></a>
                                    </div>
                                <? } ?>

                            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                                <div class="text-center col-sm-4">
                                    <p><i class="icon-calendar48"></i> </p>
                                    <a class="btn btn-info" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=EVENT_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?></a>
                                </div>
                            <? } ?>
                            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                                <div class="text-center col-sm-4">
                                    <p><i class="icon-percentage6"></i> </p>
                                    <a class="btn btn-info" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=CLASSIFIED_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED)?></a>
                                </div>
                            <? } ?>
                            <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                                <div class="text-center col-sm-4">
                                     <p><i class="icon-document50"></i> </p>
                                    <a class="btn btn-info" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=ARTICLE_FEATURE_FOLDER;?>/"><?=system_showText(LANG_SITEMGR_NAVBAR_ARTICLE)?></a>
                                </div>
                            <? } ?>
                            <? if (BLOG_FEATURE == "on") { ?>
                                <div class="text-center col-sm-4">
                                    <p><i class="icon-edit38"></i> </p>
                                    <a class="btn btn-info" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=BLOG_FEATURE_FOLDER;?>/"><?=ucwords(system_showText(LANG_SITEMGR_BLOG))?></a>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                <? } ?>
            </div>
		
        </section>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# MODAL
	# ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/modals/modal-settings-SEO.php");

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");