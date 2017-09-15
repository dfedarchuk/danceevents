<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/mobile/promote-apps/index.php
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

    extract($_POST);
    extract($_GET);

    # ----------------------------------------------------------------------------------------------------
	# SUBIMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !DEMO_LIVE_MODE) {

        $crop = false;
        if ($submit_ios) {
            $type = "ios";
        } elseif ($submit_android) {
            $type = "android";
        } else {
            $crop = true;
        }

        if (validate_form("mobile_screen", $_POST, ${"error_".$type}) && !$crop) {

            $array_promote = array();

            //image upload
            if ($type == "android" && $_FILES['image_android']['name'] && $_FILES['image_android']['tmp_name'] && !$_FILES['image_android']['error']) {
                $filename = EDIRECTORY_ROOT.IMAGE_SCREEN_ANDROID_PATH;
                $image_upload = image_uploadForMobile($filename, $_FILES['image_android']['tmp_name'], false);

                $array_promote['android.screen.image.path'] = IMAGE_SCREEN_ANDROID_PATH;
            }

            if (!setting_set("app_storelink_".$type, ${"storelink_".$type})) {
				if(!setting_new("app_storelink_".$type, ${"storelink_".$type})) {
					$error = true;
				}
			}

            if ($type == "android") {
                if (!setting_set("app_popuptitle_".$type, ${"popuptitle_".$type})) {
                    if(!setting_new("app_popuptitle_".$type, ${"popuptitle_".$type})) {
                        $error = true;
                    }
                }

                if (!setting_set("app_tagline_".$type, ${"tagline_".$type})) {
                    if(!setting_new("app_tagline_".$type, ${"tagline_".$type})) {
                        $error = true;
                    }
                }

                if (!setting_set("app_price_".$type, ${"price_".$type})) {
                    if(!setting_new("app_price_".$type, ${"price_".$type})) {
                        $error = true;
                    }
                }
            }

            if (!setting_set("app_status_".$type, ${"status_".$type})) {
				if(!setting_new("app_status_".$type, ${"status_".$type})) {
					$error = true;
				}
			}

            // adds smart banners info
            // @todo image cte android
            $domain = new Domain(SELECTED_DOMAIN_ID);
            $classSymfonyYml = new Symfony('domains/'.$domain->getString('url').'.configs.yml');
            $classSymfonyYml->save('Configs', array('parameters' => $array_promote));

            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/promote-apps/index.php?success_$type=1");
            exit;

        }

    }

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] != "POST") {

        if (DEMO_LIVE_MODE) {
            $storelink_ios = DEMO_MOBILE_APPURL_IOS;
            $storelink_android = DEMO_MOBILE_APPURL_ANDROID;
            $popuptitle_ios = system_showText(LANG_MOBILE_APP);
            $popuptitle_android = system_showText(LANG_MOBILE_APP);
            $tagline_ios = system_showText(LANG_MOBILE_GRAB_APP_IPHONE);
            $tagline_android = system_showText(LANG_MOBILE_GRAB_APP_ANDROID);
            $price_ios = LANG_FREE;
            $price_android = LANG_FREE;
            $status_ios = "A";
            $status_android = "A";
        } else {
            setting_get("app_storelink_ios", $storelink_ios);
            setting_get("app_storelink_android", $storelink_android);
            setting_get("app_popuptitle_ios", $popuptitle_ios);
            setting_get("app_popuptitle_android", $popuptitle_android);
            setting_get("app_tagline_ios", $tagline_ios);
            setting_get("app_tagline_android", $tagline_android);
            setting_get("app_status_ios", $status_ios);
            setting_get("app_status_android", $status_android);
            setting_get("app_price_ios", $price_ios);
            setting_get("app_price_android", $price_android);
        }
    } else {
        if ($type == "ios") {
            $auxType = "android";
        } else {
            $auxType = "ios";
        }

        setting_get("app_storelink_".$auxType, ${"storelink_".$auxType});
        setting_get("app_popuptitle_".$auxType, ${"popuptitle_".$auxType});
        setting_get("app_tagline_".$auxType, ${"tagline_".$auxType});
        setting_get("app_status_".$auxType, ${"status_".$auxType});
    }

    // Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E" && $arrayValue[$i] != "P") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown_ios = html_selectBox("status_ios", $arrayNameDD, $arrayValueDD, $status_ios, "", "", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");
	$statusDropDown_android = html_selectBox("status_android", $arrayNameDD, $arrayValueDD, $status_android, "", "", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

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
            <h1><?=system_showText(LANG_SITEMGR_MOBILE_SCREEN)?></h1>
            <p><?=system_showText(LANG_SITEMGR_MOBILE_TIP);?></p>
        </section>

        <section class="row section-form">

            <form name="splashScreen" id="splashScreen" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="submit_ios" id="submit_ios" value="" />
                <input type="hidden" name="submit_android" id="submit_android" value="" />

                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-form">
                        <div class="panel-heading">
                            <?=system_showText(LANG_SITEMGR_MOBILE_SCREEN_IOS)?>
                            <small class="help-block"><?=system_showText(LANG_SITEMGR_MOBILE_SCREEN_TIP)?></small>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <? if ($error_ios) { ?>
                                    <p class="alert alert-warning"><?=$error_ios?></p>
                                <? } elseif ($success_ios) { ?>
                                    <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MOBILE_SUCCESS);?></p>
                                <? } ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="iosID"><?=system_showText(LANG_SITEMGR_MOBILE_STORELINK)?></label>
                                        <input id="iosID" class="form-control" type="text" name="storelink_ios" value="<?=$storelink_ios?>" placeholder="App Store (Ex: 5466325236)">
                                    </div>
                                    <div class="col-sm-6">
                                        <label><?=system_showText(LANG_LABEL_STATUS)?></label>
                                        <div class="selectize">
                                            <?=$statusDropDown_ios?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "JS_submit('ios');"?>"><?=system_showText(LANG_SITEMGR_SAVE);?></button>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="panel panel-form">
                        <div class="panel-heading"><?=system_showText(LANG_SITEMGR_MOBILE_SCREEN_ANDROID)?></div>

                        <div class="panel-body">

                            <? if ($error_android) { ?>
                                <p class="alert alert-warning"><?=$error_android?></p>
                            <? } elseif ($success_android) { ?>
                                <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_MOBILE_SUCCESS);?></p>
                            <? } ?>

                            <div class="form-group">
                                <label><?=system_showText(LANG_SITEMGR_MOBILE_PHONEIMAGE)?> <small class="text-muted">(<?=MOBILE_SCREEN_WIDTH?> x <?=MOBILE_SCREEN_HEIGHT?>)</small></label>
                                <input type="file" name="image_android" size="50" class="file-withinput">
                            </div>

                            <div class="form-group">
                                <label><?=system_showText(LANG_SITEMGR_MOBILE_STORELINK)?></label>
                                <input class="form-control" type="text" name="storelink_android" value="<?=$storelink_android?>" placeholder="Google Play (Ex: com.myAccount.myApp)">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label><?=system_showText(LANG_SITEMGR_MOBILE_POPTITLE)?></label>
                                    <input  class="form-control" type="text" name="popuptitle_android" maxlength="30" value="<?=htmlspecialchars($popuptitle_android);?>" />
                                </div>
                                <div class="col-sm-6">
                                    <label><?=system_showText(LANG_LABEL_PRICE)?></label>
                                    <input class="form-control" type="text" name="price_android" maxlength="10" value="<?=htmlspecialchars($price_android);?>" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label><?=system_showText(LANG_SITEMGR_MOBILE_TAGLINE)?></label>
                                    <input class="form-control" type="text" name="tagline_android" maxlength="50" value="<?=htmlspecialchars($tagline_android);?>" />
                                </div>

                                <div class="col-sm-6">
                                    <label><?=system_showText(LANG_LABEL_STATUS)?></label>
                                    <div class="selectize">
                                        <?=$statusDropDown_android?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage(true, false);" : "JS_submit('android');"?>"><?=system_showText(LANG_SITEMGR_SAVE);?></button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>

        </section>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/mobile.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
