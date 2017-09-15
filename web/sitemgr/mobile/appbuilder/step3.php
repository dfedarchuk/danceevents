<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/mobile/appbuilder/step3.php
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
    extract($_POST);
    extract($_GET);

    $modules[] = "listing";
    $arrayModulesColors["listing"] = "be8885";

    if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
        $modules[] = "event";
        $arrayModulesColors["event"] = "e88f30";
    }
    if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
        $modules[] = "classified";
        $arrayModulesColors["classified"] = "278c90";
    }
    if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
        $modules[] = "article";
        $arrayModulesColors["article"] = "bc6baa";
    }
    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
        $modules[] = "promotion";
        $arrayModulesColors["promotion"] = "867fb6";
    }
    if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") {
        $modules[] = "post";
        $arrayModulesColors["post"] = "5e96c6";
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
        if ($color_scheme == "custom") {
            $color_scheme = $colorApp1."-".$colorApp2;
            
            if (!setting_set("appbuilder_colorscheme_custom", $color_scheme)) {
                if (!setting_new("appbuilder_colorscheme_custom", $color_scheme)) {
                    $error = true;
                }
            }
        }
        
        if (!setting_set("appbuilder_colorscheme", $color_scheme)) {
            if (!setting_new("appbuilder_colorscheme", $color_scheme)) {
                $error = true;
            }
        }

        foreach ($modules as $module) {
            if (!setting_set("appbuilder_colorscheme_".$module, ${"color_scheme_".$module})) {
                if (!setting_new("appbuilder_colorscheme_".$module, ${"color_scheme_".$module})) {
                    $error = true;
                }
            }
        }

        if ( $next == "yes")
        {
            /* User has done step 3 successfully */
            setting_set("appbuilder_step_3", "done") or setting_new("appbuilder_step_3", "done");
        }

        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/".($next == "yes" ? "appbuilder/previewapp.php" : "step3.php?success=1"));
        exit;
    }
    
    extract($_POST);
    extract($_GET);
    
    //Theme colors
    if (!DEMO_LIVE_MODE) {
        $arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
    } else {
        $arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
        $arrayCurValues = $arrayDefault[EDIR_THEME];
    }

//    $arrayColorsApp[] = $arrayCurValues[EDIR_SCHEME]["color1"]."-".$arrayCurValues[EDIR_SCHEME]["color2"];
//    $arrayColorsApp[0] .= "-".system_showText(LANG_SITEMGR_BUILDER_DIRCOLORS);
    $arrayColorsApp[] = "4698db-89b1d2-Default";
    $arrayColorsApp[] = "4f3d5a-e19ab2-Candy";
    $arrayColorsApp[] = "5dc0b2-efd180-Garden";
    $arrayColorsApp[] = "3b396a-ed5c56-Light Night";
    $arrayColorsApp[] = "607d8b-03a9f4-Tech";

    setting_get("appbuilder_colorscheme", $appbuilder_colorscheme);
    setting_get("appbuilder_colorscheme_custom", $appbuilder_colorscheme_custom);

    foreach ($modules as $module) {
        setting_get("appbuilder_colorscheme_".$module, ${"color_scheme_".$module});
        if (!${"color_scheme_".$module}) {
            ${"color_scheme_".$module} = $arrayModulesColors[$module];
        }
    }

    if (!$appbuilder_colorscheme) {
//        $appbuilder_colorscheme = $arrayCurValues[EDIR_SCHEME]["color1"]."-".$arrayCurValues[EDIR_SCHEME]["color2"];
        $appbuilder_colorscheme = "4698db-89b1d2";
    }

    if ($appbuilder_colorscheme_custom) {
        $colorCustom = explode("-", $appbuilder_colorscheme_custom);
    } else {
        $colorCustom = explode("-", $arrayCurValues[EDIR_SCHEME]["color1"]."-".$arrayCurValues[EDIR_SCHEME]["color2"]);
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
                <p><?=system_showText(LANG_SITEMGR_BUILDER_COLORS);?></p>
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
                    
                    <h4><?=system_showText(LANG_SITEMGR_BUILDER_COLORS_1)?></h4>
                    <p><?=system_showText(LANG_SITEMGR_BUILDER_COLORS_3)?></p>
                    <p class="alert-tip"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_10_TIP)?></p>

                    <? if ($success) { ?>
                        <p id="successMessage" class="alert alert-success"><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGSSUCCESSUPDATED));?></p>
                    <? } ?>

                    <form id="step3" name="step3" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                        <input type="hidden" name="color_option" id="color_option" value="<?=$appbuilder_coloroption?>" />
                        <input type="hidden" name="next" id="next" value="no" />

                        <div class="row">

                            <? 
                            $count = 0;
                            $countTotal = 0;
                            foreach ($arrayColorsApp as $color) {

                                $count++;
                                $countTotal++;
                                $auxColor = explode("-", $color);

                                if ($count == 1) { ?>

                                    <div class="col-sm-4">

                                <? } ?>

                                <label class="colorscheme">
                                    <input type="radio" name="color_scheme" <?=($appbuilder_colorscheme == $auxColor[0]."-".$auxColor[1] ? "checked=\"checked\"" : "")?> value="<?=$auxColor[0]."-".$auxColor[1];?>" />
                                    <b style="background-color:#<?=$auxColor[0];?>"></b>
                                    <b style="background-color:#<?=$auxColor[1];?>"></b>
                                    <b class="colorname"><?=$auxColor[2];?></b>
                                </label>

                                <? if ($countTotal == count($arrayColorsApp)) { ?>
                                    <label class="colorscheme">
                                        <input type="radio" name="color_scheme" <?=($appbuilder_colorscheme == $appbuilder_colorscheme_custom ? "checked=\"checked\"" : "")?> value="custom" />
                                        <b class="color-box" data-id="colorApp1" style="background-color:#<?=$colorCustom[0];?>"><span></span></b>
                                        <input type="hidden" id="colorApp1" name="colorApp1" value="<?=$colorCustom[0];?>"/>
                                        <b class="color-box" data-id="colorApp2" style="background-color:#<?=$colorCustom[1];?>"><span></span></b>
                                        <input type="hidden" id="colorApp2" name="colorApp2" value="<?=$colorCustom[1];?>"/>
                                        <b class="colorname"><?=system_showText(LANG_SITEMGR_CUSTOM_COLOR);?></b>
                                    </label>
                                <? } ?>

                                <? if ($count == 2 || $countTotal == count($arrayColorsApp)) { $count = 0; ?>
                                    </div>
                                <? } ?>

                            <? } ?>

                        </div>

                        <hr>

                        <p><?=system_showText(LANG_SITEMGR_BUILDER_COLORS_4)?></p>

                        <div class="row">

                            <?
                            $count = 0;
                            $countTotal = 0;
                            foreach ($modules as $module) { ?>
                                <div class="col-sm-4">
                                    <label class="colorscheme">
                                        <b class="color-box" data-id="colorApp<?=$module?>" style="margin-left:23px; background-color:#<?=${"color_scheme_".$module};?>"><span></span></b>
                                        <input type="hidden" id="colorApp<?=$module?>" name="color_scheme_<?=$module?>" value="<?=${"color_scheme_".$module};?>"/>
                                        <b class="colorname"><?=constant("LANG_".strtoupper(($module == "post" ? "blog" : $module))."_FEATURE_NAME");?></b>
                                    </label>
                                </div>
                            <? } ?>

                        </div>

                        <div class="row action">
                            <button type="button" class="btn btn-success" onclick="JS_submit(true);"><?=system_showText(LANG_SITEMGR_SAVENEXT)?></button>
                        </div>

                    </form>
                        
                </section>                
                
		    </div>
            
        </section>
        
    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/appbuilder.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>