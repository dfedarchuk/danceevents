<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/design/colors-fonts/index.php
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
            <div class="pull-right">
                <button type="button" name="reset_button" value="Submit" class="btn btn-default btn-lg action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=(DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "JS_submitColors('reset');")?>"><?=system_showText(LANG_SITEMGR_RESET)?></button>
                <button type="button" name="submit_button" value="Submit" class="btn btn-primary btn-lg action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=(DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "JS_submitColors('submit');")?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
            </div>
            <h1><?=system_showText(LANG_SITEMGR_COLORS_FONTS)?></h1>
            <p><?=system_showText(LANG_SITEMGR_COLOR_FONTS_TIP);?></p>
        </section>

        <section>

            <form name="color_scheme" id="color_scheme" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="submitAction" value="changecolors">
                <input type="hidden" name="theme" value="<?=EDIR_THEME?>">
                <input type="hidden" name="scheme" value="<?=EDIR_SCHEME?>">
                <input type="hidden" name="action" id="action" value="submit">
                <input type="hidden" name="aux_action" id="aux_action" value="0">

                <div class="row">
                    <div class="col-md-5">
                        <h4><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_COLORS);?></h4>

                        <? foreach ($table_colors_3 as $table_info) { ?>
                        <div class="row">
                            <div class="col-md-9">
                                <h5>
                                    <?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)))?>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <b class="colorSelector-<?=$table_info?> color-box" data-id="color<?=$table_info?>" style="background-color:#<?=${"color".$table_info}?>"><span></span></b>
                                <input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>">
                            </div>
                        </div>
                        <? } ?>

                        <? foreach ($table_colors_2 as $table_info) { ?>
                        <div class="row">
                            <div class="col-md-9">
                                <h5>
                                    <?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)."COLOR"))?>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <b class="colorSelector-<?=$table_info?> color-box" data-id="color<?=$table_info?>" style="background-color:#<?=${"color".$table_info}?>"><span></span></b>
                                <input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>">
                            </div>
                        </div>
                        <? } ?>

                        <? foreach ($table_colors_1 as $table_info) { ?>
                        <div class="row">
                            <div class="col-md-9">
                                <h5>
                                    <?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)."COLOR"))?>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <b class="colorSelector-<?=$table_info?> color-box" data-id="color<?=$table_info?>" style="background-color:#<?=${"color".$table_info}?>"><span></span></b>
                                <input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>">
                            </div>
                        </div>
                        <? } ?>

                    </div>
                    <div class="col-md-7">
                        <h4><?=system_showText(LANG_SITEMGR_COLOR_FONT);?></h4>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <div class="selectize">
                                    <?=$arrayFont;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>

                <div class="row">
                    <div class="col-md-6">
                        <p class="alert alert-warning" role="alert">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?=system_showText(LANG_SITEMGR_COLOR_OPTIONS_TIP);?>
                        </p>
                    </div>
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
