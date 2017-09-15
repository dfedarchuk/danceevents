<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/mobile/appbuilder/previewapp.php
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

    setting_get("appbuilder_previewpassword", $appbuilder_previewpassword);

    if (!$appbuilder_previewpassword) {
        $appbuilder_previewpassword = system_generatePassword(true);
        if (!setting_set("appbuilder_previewpassword", $appbuilder_previewpassword)) {
            setting_new("appbuilder_previewpassword", $appbuilder_previewpassword);
        }
    }

    $symfonyCore = new SymfonyCore();
    $domain = new Domain(SELECTED_DOMAIN_ID);
    $tokens = $symfonyCore::getContainer()->getParameter("api_pin");

    if (strlen($tokens[$domain->getString('url')]) == 0) {
        // Saves symfony configs
        $symfony = new Symfony('domain.yml');
        $symfony->save('api_pin', [$domain->getString('url') => $appbuilder_previewpassword,]);
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
    include(SM_EDIRECTORY_ROOT."/layout/sidebar-mobile.php");


?>

    <main class="wrapper togglesidebar container-fluid">

        <section class="row heading">
            <div class="container">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER);?></h1>
                <p><?=system_showText(LANG_SITEMGR_PREVIEW_USING_OUR_APP);?></p>
            </div>
        </section>

        <section class="row appbuilder">
            <div class="appbuilder-container">

                <?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

                /*  Navbar  */
                include("navbar.php");
                ?>

                <section class="container">

                    <h4><?=system_showText(LANG_SITEMGR_DOWNLOAD_TO_PREVIEW_THE_APP)?></h4>
                    <p><?=system_showText(LANG_SITEMGR_PREVIEW_TIP)?></p>
                    <p class="alert-tip"><?=system_showText(LANG_SITEMGR_PREVIEW_TIP2)?></p>

                    <div class="previewscreen">
                        <img src="<?=(DEFAULT_URL."/".SITEMGR_ALIAS."/assets/img/appbuilder/iPhone-5.png")?>" alt="iPhone5" />

                        <div class="right">
                            <div class="logo-edir">
                                <i class="iab-edirectory"></i>
                                <span>eDirectory App Previewer</span>
                            </div>
                            <a href="http://appbuilder.edirectory.com/previewapp.php?android" target="_blank" class="btn btn-default"><?=system_showText(LANG_SITEMGR_DOWNLOAD_ANDROID)?></a>
                            <br />
                            <a href="http://appbuilder.edirectory.com/previewapp.php?ios" target="_blank" class="btn btn-default"><?=system_showText(LANG_SITEMGR_DOWNLOAD_IOS)?></a>
                        </div>
                    </div>

                    <div class="well-border">
                        <h4><?=system_showText(LANG_SITEMGR_PREVIEW_DETAILS)?></h4>
                        <p><?=system_showText(LANG_SITEMGR_PREVIEW_DETAILS_MESSAGE)?></p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th><?=system_showText(LANG_SITEMGR_DOMAIN_SING)?></th>
                                    <td><?=DEFAULT_URL;?></td>
                                </tr>
                                <tr>
                                    <th>PIN</th>
                                    <td><?=$appbuilder_previewpassword;?></td>
                                </tr>
                            </tbody>
                        </table>
                        <p><b><?=system_showText(LANG_SITEMGR_PREVIEW_PROTOCOL)?></b></p>
                    </div>

                    <div class="action">
                        <button type="button" class="btn btn-success" onclick="window.location.href = '<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/finalstep.php"?>'"><?=system_showText(LANG_SITEMGR_NEXT)?></button>
                    </div>

                </section>

            </div>

        </section>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
