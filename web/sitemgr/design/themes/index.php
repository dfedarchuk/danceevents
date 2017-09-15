<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/design/themes/index.php
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

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/layout_editor.php");

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-design.php");

?>

    <main class="wrapper togglesidebar container-fluid wysiwyg">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_MENU_THEMES)?></h1>
            <p><?=system_showText(LANG_SITEMGR_MENU_THEMES_TIP);?></p>
        </section>

        <section class="form-thumbnails">

            <form name="theme" id="theme" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>">
                <input type="hidden" name="scheme" id="scheme" value="<?=EDIR_SCHEME?>">
                <input type="hidden" name="select_theme" id="select_theme" value="<?=EDIR_THEME?>">
                <input type="hidden" name="import_categories" id="import_categories" value="">
                <input type="hidden" name="submitAction" value="changetheme">

                <div class="row">

                    <div id="loading_theme" class="alert alert-loading alert-loading-fullscreen hidden" >
                        <img class="alert-img-center" src="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/assets/img/loading-128.gif">
                    </div>

                    <? foreach ($availableThemes as $avTheme) { ?>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="select-theme thumbnail <?=($avTheme["value"] == ($selected_themesuccess ? $selected_themesuccess : $edir_theme) ? "active in-use" : "")?>">
                            <div class="caption">
                                <h4><?=$avTheme["name"];?></h4>

                                <img src="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/assets/img/themes/".$avTheme["value"].".png";?>" alt="<?=$avTheme["name"];?>">
                                <br><br>
                                <p class="text-center">
                                    <? if ($avTheme["value"] == ($selected_themesuccess ? $selected_themesuccess : $edir_theme)) { ?>
                                    <a href="javascript:void(0);" class="active btn btn-primary"><?=system_showText(LANG_SITEMGR_INUSE)?></a>
                                    <? } else { ?>
                                        <a href="javascript:void(0);" class="btn btn-default" onclick="JS_submit(false, true, '<?=$avTheme["value"]?>');"><?=system_showText(LANG_SITEMGR_USETHIS)?></a>
                                    <? } ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <? } ?>

                </div>

            </form>

        </section>

    </main>

<?php
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/design.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
