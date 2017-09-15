<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/blog/blog.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();

    $url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BLOG_FEATURE_FOLDER;
    $url_base 	  = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
    $sitemgr 	  = 1;

    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/blog.php");

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-content.php");

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <form role="form" name="blog" id="blog" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>">
            <input type="hidden" name="id" id="id" value="<?=$id?>">
            <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
            <input type="hidden" name="letter" value="<?=$letter?>">
            <input type="hidden" name="screen" value="<?=$screen?>">

            <section class="row heading">

	           	<div class="container">
                    <? include(SM_EDIRECTORY_ROOT."/layout/back-navigation.php"); ?>
                    <div class="col-sm-8">
                         <? if ($id) { ?>
                        <h1><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))." ".system_showText(LANG_BLOG)?> <i><?=$post->getString("title")?></i></h1>
                        <? } else { ?>
                        <h1><?=string_ucwords(system_showText(LANG_SITEMGR_ADD))." ".system_showText(LANG_BLOG)?></h1>
                        <? } ?>
                    </div>
                    <div class="col-sm-4 text-right">
                        <br><br>
                        <a href="javascript:void(0);" data-tour class="text-info tutorial-text hidden-xs hidden-sm"><?=system_showText(LANG_LABEL_TUTORIAL);?> <i class="icon-help8"></i></a>
                    </div>

                    <? if ($message_blog) { ?>
                    <div class="col-sm-12 alert alert-warning" role="alert">
                        <p><?=$message_blog;?></p>
                    </div>
                    <? } ?>
                </div>

            </section>

			<section class="row tab-options">

                <div class="container">
                    <div class="pull-right top-actions">
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BLOG_FEATURE_FOLDER."/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?>  </span>
                        <button type="button" name="submit_button" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="container">
                            <? include(INCLUDES_DIR."/forms/form-blog.php"); ?>
                        </div>
                    </div>
                </div>

            </section>

            <section class="row footer-action">

           		<div class="container">
	           		<div class="col-xs-12 text-right">
		           		<a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BLOG_FEATURE_FOLDER."/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                        <span class="separator"> <?=system_showText(LANG_OR)?> </span>
                        <button type="button" name="submit_button" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
					</div>
				</div>

            </section>

        </form>

        <aside class="tutorial-tour">
            <h1><?=system_showText(LANG_LABEL_TUTORIAL_FIELDS);?></h1>
            <div class="nano">
                <ul class="list-unstyled nano-content">
                    <? foreach ($arrayTutorial as $key => $title) { ?>
                    <li><span class="tour-step <?=(!$key ? "active" : "")?>" data-step="<?=$key?>" ><i class="icon-chevron15"></i> <?=$title["field"]?></span></li>
                    <? } ?>
                    <li><span class="tour-step-end"><?=system_showText(LANG_LABEL_TUTORIAL_END)?></span></li>
                </ul>
            </div>
        </aside>

    </main>

    <? include(INCLUDES_DIR."/modals/modal-categoryselect.php"); ?>
    <? include(INCLUDES_DIR."/modals/modal-crop.php"); ?>


<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
