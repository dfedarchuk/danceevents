<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/google/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	if (GOOGLE_MAPS_ENABLED != "on" && GOOGLE_ADS_ENABLED != "on" && GOOGLE_ANALYTICS_ENABLED != "on" && GOOGLE_TAGMANAGER_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_POST);
	extract($_GET);

    $googleSettings = new GoogleSettings();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $message = null;

        switch( $gtype )
        {
            case "maps" :
                $google_maps_key = trim($google_maps_key);
                if( $google_maps_status and empty( $google_maps_key ) )
                {
                    MessageHandler::registerError( system_showText(LANG_SITEMGR_GOOGLEMAPS_ERROR_KEY) );
                }

                if ( !MessageHandler::haveErrors() )
                {
                    $googleSettings->mapsKey = $google_maps_key;
                    $googleSettings->mapsStatus = ($google_maps_status ? "on" : "off");

                    $message = system_showText(LANG_SITEMGR_GOOGLEMAPS_SETTINGSSUCCESSCHANGED);
                }

                break;
            case "ads" :
                $advertTypeFlags = 0;
                $google_ad_type_text  and $advertTypeFlags += 1;
                $google_ad_type_image and $advertTypeFlags += 2;

                $googleSettings->adClient = $google_ad_client;
                $googleSettings->adType   = $advertTypeFlags;
                $googleSettings->adStatus = ($google_ad_status ? "on" : "off");

                $message = system_showText(LANG_SITEMGR_GOOGLEADS_SETTINGSSUCCESSCHANGED);
                break;
            case "analytics" :
                $googleSettings->analyticsAccount     = $google_analytics_account;
                $googleSettings->analyticsFront       = ( $google_analytics_front ? "on" : "off"   );
                $googleSettings->analyticsMembers     = ( $google_analytics_members ? "on" : "off" );
                $googleSettings->analyticsSiteManager = ( $google_analytics_sitemgr ? "on" : "off" );

                $message = system_showText( LANG_SITEMGR_GOOGLEANALYTICS_SETTINGSSUCCESSCHANGED );
                break;
            case "tag" :
                $googleSettings->tagClient = $google_tag_client;
                $googleSettings->tagStatus = ($google_tag_status ? "on" : "off");

                $message = system_showText(LANG_SITEMGR_GOOGLETAG_SETTINGSSUCCESSCHANGED);

                break;
            case "verification" :
                include(INCLUDES_DIR."/code/google_verification.php");
                $message = system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGSUCCESS);
                break;
            case "recaptcha" :

                if( !empty( $google_recaptcha_status ) )
                {
                    if( empty( $google_recaptcha_sitekey ) )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_GOOGLERECAPTCHA_ERROR_SITEKEY) );
                    }

                    if( empty( $google_recaptcha_secretkey ) )
                    {
                        MessageHandler::registerError( system_showText(LANG_SITEMGR_GOOGLERECAPTCHA_ERROR_SECRETKEY) );
                    }
                }

                if( !MessageHandler::haveErrors() )
                {
                    $googleSettings->recaptchaSiteKey   = $google_recaptcha_sitekey;
                    $googleSettings->recaptchaSecretKey = $google_recaptcha_secretkey;
                    $googleSettings->recaptchaStatus    = ($google_recaptcha_status ? "on" : "off");

                    $message = system_showText(LANG_SITEMGR_GOOGLERECAPTCHA_SETTINGSSUCCESSCHANGED);
                }
                break;
        }

        if( !MessageHandler::haveErrors() )
        {
            if( $googleSettings->Save() )
            {
                MessageHandler::registerSuccess( $message );
            }
            else
            {
                MessageHandler::registerError( system_showText( LANG_SITEMGR_GOOGLE_ERROR ) );
            }
        }

	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------
	//Ads
	$google_ad_client  = $googleSettings->adClient;
//    $google_ad_channel = $googleSettingObj_Channel->getString( "value" );
    $google_ad_status  = $googleSettings->adStatus;
    $google_ad_type    = $googleSettings->adType;

    //Analytics
	$google_analytics_account = $googleSettings->analyticsAccount;
    $google_analytics_front   = $googleSettings->analyticsFront;
    $google_analytics_members = $googleSettings->analyticsMembers;
    $google_analytics_sitemgr = $googleSettings->analyticsSiteManager;

    //Maps
    $google_maps_status = $googleSettings->mapsStatus;
    $google_maps_key    = $googleSettings->mapsKey;

    //Tag
	$google_tag_status = $googleSettings->tagStatus;
	$google_tag_client = $googleSettings->tagClient;

    //reCAPTCHA
	$google_recaptcha_status    = $googleSettings->recaptchaStatus;
    $google_recaptcha_sitekey   = $googleSettings->recaptchaSiteKey;
    $google_recaptcha_secretkey = $googleSettings->recaptchaSecretKey;

    //Verification
    $searchMetaObj_google = new SearchMetaTag('google');
    $googleTag = html_entity_decode($searchMetaObj_google->getString('value'));

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-configuration.php");

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS))?></h1>
            <p><?=system_showText(LANG_SITEMGR_GOOGLEPREFS_TIP_1);?></p>
        </section>

            <?php MessageHandler::render(); ?>

        <div class="tab-options">

            <ul class="row nav nav-tabs" role="tablist">
                <li class="<?=($gtype == "maps" || !$_POST ? "active" : "")?>"><a href="#maps" role="tab" data-toggle="tab">Google Maps</a></li>
                <li class="<?=($gtype == "ads"             ? "active" : "")?>"><a href="#ads" role="tab" data-toggle="tab">Google Ads</a></li>
                <li class="<?=($gtype == "analytics"       ? "active" : "")?>"><a href="#analytics" role="tab" data-toggle="tab">Google Analytics</a></li>
                <li class="<?=($gtype == "tag"             ? "active" : "")?>"><a href="#tags" role="tab" data-toggle="tab">Google Tag Manager</a></li>
                <li class="<?=($gtype == "verification"    ? "active" : "")?>"><a href="#verification" role="tab" data-toggle="tab">Google Search Console</a></li>
                <li class="<?=($gtype == "recaptcha"       ? "active" : "")?>"><a href="#recaptcha" role="tab" data-toggle="tab">Google reCAPTCHA</a></li>
            </ul>

            <div class="row tab-content">
                <section id="maps" class="tab-pane <?=($gtype == "maps" || !$_POST ? "active" : "")?>">
                    <form name="googlemaps" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="gtype" value="maps" />
                        <? include(INCLUDES_DIR."/forms/form-google-maps.php"); ?>
                    </form>
                </section>

                <section id="ads" class="tab-pane <?=($gtype == "ads" ? "active" : "")?>">
                    <form name="googleads" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="gtype" value="ads" />
                        <? include(INCLUDES_DIR."/forms/form-google-ads.php"); ?>
                    </form>
                </section>

                <section id="analytics" class="tab-pane <?=($gtype == "analytics" ? "active" : "")?>">
                    <form name="googleanalytics" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="gtype" value="analytics" />
                        <? include(INCLUDES_DIR."/forms/form-google-analytics.php"); ?>
                    </form>
                </section>

                <section id="tags" class="tab-pane <?=($gtype == "tag" ? "active" : "")?>">
                    <form name="googletag" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="gtype" value="tag" />
                        <? include(INCLUDES_DIR."/forms/form-google-tags.php"); ?>
                    </form>
                </section>

                <section id="verification" class="tab-pane <?=($gtype == "verification" ? "active" : "")?>">
                    <form name="googleverification" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="gtype" value="verification" />
                        <? include(INCLUDES_DIR."/forms/form-google-verification.php"); ?>
                    </form>
                </section>

                <section id="recaptcha" class="tab-pane <?=($gtype == "recaptcha" ? "active" : "")?>">
                    <form name="googlerecaptcha" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="gtype" value="recaptcha" />
                        <? include(INCLUDES_DIR."/forms/form-google-recaptcha.php"); ?>
                    </form>
                </section>
            </div>

        </div>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
