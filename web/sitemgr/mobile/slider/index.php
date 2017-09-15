<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/mobile/slider/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["ajax"]) && isset($_POST["domain_id"])) {
        define("SELECTED_DOMAIN_ID", $_POST["domain_id"]);
    }
    include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$mobile = true;
    $slideAreas = ["app_home", "app_listing"];
    include(INCLUDES_DIR."/code/slider.php");

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

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <div class="container-fluid app_home">
                <h1><?=system_showText(LANG_SITEMGR_MOBILE_SLIDER_MSG_CONTENT)?></h1>
                <p><?=str_replace("[totalSlides]", TOTAL_SLIDER_ITEMS, system_showText(LANG_SITEMGR_MOBILE_SLIDER_EXPLAIN_LINE_1));?></p>

                <? if ($message) { ?>
                    <p class="alert alert-<?=($error ? "warning" : "success")?>"><?=$message?></p>
                <? } ?>

                <div class="row">
                    <div class="col-sm-12">
                        <h2><?=system_showText(LANG_SITEMGR_SLIDER_HOMESCREEN)?></h2>
                        <p><?=system_showText(LANG_SITEMGR_SLIDER_HOMESCREEN_TIP)?></p>
                    </div>
                </div>
            </div>

        </section>

        <? foreach ($slideAreas as $slideArea) { ?>
        
        <section class="form-thumbnails slider-thumbnails">
     		<div class="row" role="tablist">
                <?
                $nextSlideAvailable = 0;

                for ($slider_number = 1; $slider_number <= TOTAL_SLIDER_ITEMS; $slider_number++) {
                    if (${"array_slider".$slideArea}[$slider_number]["image_id"]) { ?>

                    <div class="col-md-2 col-xs-6" data-area="<?=$slideArea?>" data-id="<?=${"array_slider".$slideArea}[$slider_number]['id']?>">
                        <div class="thumbnail list-sortable" role="tab">
                            <?
                            $imageObj = new Image(${"array_slider".$slideArea}[$slider_number]["image_id"]);
                            if ($imageObj->imageExists()) {
                                echo $imageObj->getTag(false, 0, 0, ${"array_slider".$slideArea}[$slider_number]["title"]);
                            }
                            ?>

                            <div class="caption">
                                <h6><?=${"array_slider".$slideArea}[$slider_number]["title"]?></h6>
                                <i class="drag drag-slide pull-left"></i>
                                <div class="pull-right">
                                    <a class="btn btn-primary btn-xs" data-toggle="tab" onclick="scrollPage('.tab-content<?=$slideArea?>'); selectSlide(<?=$slider_number;?>, '<?=$slideArea?>');" href="#slider<?=$slider_number;?><?=$slideArea?>"><?=system_showText(LANG_LABEL_EDIT)?></a>
                                    <button type="button" class="btn btn-warning btn-xs" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "deleteSlider($slider_number, '$slideArea');"?>"><?=system_showText(LANG_SITEMGR_REMOVE)?></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                <? } else {
                        if (!$nextSlideAvailable) {
                            $nextSlideAvailable = $slider_number;
                        }
                    }

                } ?>

                <div class="col-md-2 col-xs-6 <?=($nextSlideAvailable ? "" : "hidden")?>">
                    <a class="thumbnail add-new" data-toggle="tab" onclick="scrollPage('.tab-content<?=$slideArea?>'); selectSlide(<?=$nextSlideAvailable;?>, '<?=$slideArea?>');" href="#slider<?=$nextSlideAvailable;?><?=$slideArea?>" role="tab">
                        <i class="image-placeholder icon-cross8"></i>
                        <div class="caption">
                            <h6><?=system_showText(LANG_SITEMGR_SLIDER_ADD);?></h6>
                        </div>
                    </a>
                </div>
   			</div>
   		</section>

        <form name="slider<?=$slideArea?>" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="number_of_items" value="<?=TOTAL_SLIDER_ITEMS?>">
            <input type="hidden" name="settings" value="settings">
            <input type="hidden" name="submit_button" id="submit_button<?=$slideArea?>">
            <input type="hidden" name="last_slide_changed" id="last_slide_changed<?=$slideArea?>" value="">
            <input type="hidden" name="area" value="<?=$slideArea?>">

            <section class="tab-content tab-content<?=$slideArea?>">

                <? for ($slider_number = 1; $slider_number <= TOTAL_SLIDER_ITEMS; $slider_number++) { ?>

                <section class="row tab-pane section-form <?=($_POST && $last_slide_changed == $slider_number && $_POST["area"] == $slideArea ? "active" : "")?>" id="slider<?=$slider_number?><?=$slideArea?>">
                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <div class="col-sm-12">
                                <fieldset>
                                    <legend><?=system_showText(LANG_SITEMGR_SLIDER_EDIT);?></legend>
                                </fieldset>
                            </div>

                            <? include(INCLUDES_DIR."/forms/form-slider-mobile.php"); ?>
                        </div>
                    </div>

                </section>

                <? } ?>
            </section>

        </form>

        <? if ($slideArea == "app_home") { ?>

        <section class="heading">
            <div class="container-fluid app_listing">
                <div class="row">
                    <div class="col-sm-12">
                        <h2><?=system_showText(LANG_SITEMGR_SLIDER_LISTINGHOMESCREEN)?></h2>
                        <p><?=system_showText(LANG_SITEMGR_SLIDER_LISTINGHOMESCREEN_TIP)?></p>
                    </div>
                </div>
            </div>
        </section>

        <? } ?>

        <form name="delete_slider<?=$slideArea?>" id="delete_slider<?=$slideArea?>" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
            <input type="hidden" name="slider_id" id="delete_slider_id<?=$slideArea?>">
            <input type="hidden" name="delete" value="delete<?=$slideArea?>">
        </form>

        <? } ?>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/slider.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");