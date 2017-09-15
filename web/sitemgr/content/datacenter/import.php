<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/import.php
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

	extract($_GET);
	extract($_POST);

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    if (!$step) {
        $step = 3; //start new import
    }

    if ($module != "listing" && $module != "event") { //define listing as default module to start a new import
        $module = "listing";
    }

    if ($module == "listing") {
        $levelObj = new ListingLevel();
    } elseif ($module == "event") {
        $levelObj = new EventLevel();
    }

    if ($step >= 4) { //include code for import process

        if ($module == "event") {
            include(INCLUDES_DIR."/code/import_event.php");
            $includeFile = "import_event.php"; //ajax request
        } else {
            include(INCLUDES_DIR."/code/import.php");
            $includeFile = "import.php"; //ajax request
        }

    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && $step == 4) {

        if (!$messageErrorUpload && $prev_step == 4) { //submit after Step 4, go to Step 5.
            $step = 5;
        }

    }

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------
	//Tabs controler
	unset($array_edir_import);
	unset($array_edir_importModule);
	unset($import_numbers);
	$num_import = 1;

    if ($step > 1 && !$_GET["step"]) { //Show only one tab (current module)

        $array_edir_import[] = @constant("LANG_".string_strtoupper($module)."_FEATURE_NAME_PLURAL");
        $array_edir_importModule[] = $module;
        $import_numbers[] = "0";
        $onclick = false;

    } else { //Show all available modules to import

        $onclick = true;
        $array_edir_import[] = LANG_LISTING_FEATURE_NAME_PLURAL;
        $array_edir_importModule[] = "listing";
        if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
            $array_edir_import[] = LANG_EVENT_FEATURE_NAME_PLURAL;
            $array_edir_importModule[] = "event";
            $num_import++;
        }
        $import_numbers[] = "0";
        if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
            $import_numbers[] = "1";
        }

    }

    if ($step == 3) { //get Default import settings

        if ($update_settings != "yes") {

            if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_sameaccount) {

                if ($_POST["import_sameaccount_".$module]) ${"import_sameaccount_".$module} = "checked";
                if ($_POST["import_from_export_".$module]) ${"import_from_export_".$module} = "checked";
                if ($_POST["import_enable_active_".$module]) ${"import_enable_active_".$module} = "checked";
                if ($_POST["import_update_items_".$module]) ${"import_update_items_".$module} = "checked";
                if ($_POST["import_update_friendlyurl_".$module]) ${"import_update_friendlyurl_".$module} = "checked";
                if ($_POST["import_featured_categs_".$module]) ${"import_featured_categs_".$module} = "checked";

            } else {
                //Listing
                setting_get("import_sameaccount", $import_sameaccount_listing);
                if ($import_sameaccount_listing) $import_sameaccount_listing = "checked";

                setting_get("import_account_id", $account_id_listing);

                setting_get("import_from_export", $import_from_export_listing);
                if ($import_from_export_listing) $import_from_export_listing = "checked";

                setting_get("import_enable_listing_active", $import_enable_active_listing);
                if ($import_enable_active_listing) $import_enable_active_listing = "checked";

                setting_get("import_defaultlevel", $import_defaultlevel_listing);

                setting_get("import_update_listings", $import_update_items_listing);
                if ($import_update_items_listing) $import_update_items_listing = "checked";

                setting_get("import_update_friendlyurl", $import_update_friendlyurl_listing);
                if ($import_update_friendlyurl_listing) $import_update_friendlyurl_listing = "checked";

                setting_get("import_featured_categs", $import_featured_categs_listing);
                if ($import_featured_categs_listing) $import_featured_categs_listing = "checked";

                //Event
                setting_get("import_sameaccount_event", $import_sameaccount_event);
                if ($import_sameaccount_event) $import_sameaccount_event = "checked";

                setting_get("import_account_id_event",  $account_id_event);

                setting_get("import_from_export_event", $import_from_export_event);
                if ($import_from_export_event) $import_from_export_event = "checked";

                setting_get("import_enable_event_active", $import_enable_active_event);
                if ($import_enable_active_event) $import_enable_active_event = "checked";

                setting_get("import_defaultlevel_event", $import_defaultlevel_event);

                setting_get("import_update_events", $import_update_items_event);
                if ($import_update_items_event) $import_update_items_event = "checked";

                setting_get("import_update_friendlyurl_event", $import_update_friendlyurl_event);
                if ($import_update_friendlyurl_event) $import_update_friendlyurl_event = "checked";

                setting_get("import_featured_categs_event", $import_featured_categs_event);
                if ($import_featured_categs_event) $import_featured_categs_event = "checked";
            }
        } else {

            //Listing
            if ($import_sameaccount_listing) $import_sameaccount_listing = "checked";
            if ($import_from_export_listing) $import_from_export_listing = "checked";
            if ($import_enable_active_listing) $import_enable_active_listing = "checked";
            if ($import_update_items_listing) $import_update_items_listing = "checked";
            if ($import_update_friendlyurl_listing) $import_update_friendlyurl_listing = "checked";
            if ($import_featured_categs_listing) $import_featured_categs_listing = "checked";

            //Event
            if ($import_sameaccount_event) $import_sameaccount_event = "checked";
            if ($import_from_export_event) $import_from_export_event = "checked";
            if ($import_enable_active_event) $import_enable_active_event = "checked";
            if ($import_update_items_event) $import_update_items_event = "checked";
            if ($import_update_friendlyurl_event) $import_update_friendlyurl_event = "checked";
            if ($import_featured_categs_event) $import_featured_categs_event = "checked";

        }
    }

    setting_get("import_update_listings", $import_update);

    if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on"){
        setting_get("import_update_events", $import_update_event);
    }

    if ($module == "event") {
        setting_get("import_update_events", $import_update);
    } else {
        setting_get("import_update_listings", $import_update);
    }

    $message = "";

    if (function_exists("mb_detect_encoding") && function_exists("mb_convert_encoding")) {
        $message = system_showText(LANG_SITEMGR_MSG_IMPORT_CONVERT_UTF8_2);
    } else {
        $message = system_showText(LANG_SITEMGR_MSG_IMPORT_CHECK_UTF8);
    }

    if ($import_update) {
        $message = $message." ".system_showText(LANG_SITEMGR_MSG_IMPORT_UPDATE_ITENS2);
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-content.php");

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="row heading">
            <div class="container">
                <h1><?=system_showText(@constant("LANG_SITEMGR_NAVBAR_IMPORT".strtoupper($module)."S"))?></h1>
                <p><?=system_showText(LANG_SITEMGR_DOWNLOAD_TEMPLATE);?> <a href="importsample.php?type=<?=$module?>"><?=system_showText(LANG_SITEMGR_DOWNLOAD_TEMPLATE2);?></a>
                    <span class="pull-right"><a href="http://support.edirectory.com/customer/portal/articles/search?q=import&b_id=7909" target="_blank" class="text-info tutorial-text"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_3)?> <i class="icon-help8"> </i></a></span>
                </p>
            </div>
        </section>

        <section class="row section-form">
            <div class="container">

                <div class="col-sm-12">

                    <? if ($step < 4) { ?>

                    <form name="import_steps" id="import_steps" role="form" class="import_steps_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                        <input type="hidden" id="step" name="step" value="<?=$step+1?>">
                        <input type="hidden" id="prev_step" name="prev_step" value="<?=$step?>">
                        <input type="hidden" id="module" name="module" value="<?=$module?>">
                        <input type="hidden" name="update_settings" value="<?=$update_settings?>">

                        <div class="panel panel-default">
                            <div class="panel-heading"><?=system_showText(LANG_SITEMGR_STEP3_TIP1)?></div>

                            <div class="panel-body form-horizontal">
                                <? if ($error_sameaccount) { ?>
                                    <p class="alert alert-warning"><?=$errorMsg?></p>
                                <? } ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="import_from_export_<?=$module?>" name="import_from_export_<?=$module?>" value="1" <?=${"import_from_export_".$module}?>><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?>
                                             </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="import_enable_active_<?=$module?>" name="import_enable_active_<?=$module?>" value="1" <?=${"import_enable_active_".$module}?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE)?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="import_featured_categs_<?=$module?>" name="import_featured_categs_<?=$module?>" value="1" <?=${"import_featured_categs_".$module}?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FEATURED_CATEGS)?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="import_update_items_<?=$module?>" name="import_update_items_<?=$module?>" value="1" <?=${"import_update_items_".$module}?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_UPDATE)?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="import_update_friendlyurl_<?=$module?>" name="import_update_friendlyurl_<?=$module?>" value="1" <?=${"import_update_friendlyurl_".$module}?>><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FRIENDLYURL)?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="import_sameaccount" name="import_sameaccount_<?=$module?>" value="1" <?=${"import_sameaccount_".$module}?> onclick="JS_ShowHideAccount();"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT)?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="import_account_id" <?=(${"import_sameaccount_".$module} != "checked") ? "style=\"display:none;\"" : ""?>>
                                    <label class="col-sm-5 control-label"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT)?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control mail-select" style="width: 200px;" name="account_id_<?=$module?>" id="account_id_<?=$module?>" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?=${"account_id_".$module}?>">
                                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_DEFAULTLEVEL)?></label>
                                    <div class="col-sm-7">
                                        <div class="selectize">
                                            <select name="import_defaultlevel_<?=$module?>" style="width: 200px;">
                                                <?
                                                $levelvalues = $levelObj->getLevelValues();
                                                foreach ($levelvalues as $levelvalue) {
                                                    if (${"import_defaultlevel_".$module} == $levelvalue) {
                                                        $selected = " selected=\"selected\"";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "<option value=\"".$levelvalue."\" $selected>".$levelObj->showLevel($levelvalue)."</option> ";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer pager">
                                <button type="submit" name="submit_button" value="Submit" class="btn btn-primary next"><?=system_showText(LANG_SITEMGR_NEXT);?> &rarr;</button>
                            </div>
                        </div>

                    </form>

                    <? } elseif ($step >= 4) { ?>


                    <ul class="nav nav-tabs panel-tabs" role="tablist">
                        <? if ($step == 4 || ($step == 5 && $type == "upload")) { ?>
                            <li id="tab_upload" <?=($type == "upload" || !$type? "class=\"active\"": "");?>>
                                <a href="javascript:void(0);" <?=($step == 4 ? "onclick=\"changeFileForm('upload', false, false);\"" : "style=\"cursor: default;\"")?>><?=system_showText(LANG_SITEMGR_UPLOAD_FILE);?></a>
                            </li>
                        <? } ?>

                        <? if ($step == 4 || ($step == 5 && $type == "select")) { ?>
                        <li id="tab_select" <?=($type == "select"? "class=\"active\"": "");?>>
                            <a href="javascript:void(0);" <?=($step == 4 ? "onclick=\"changeFileForm('select', '$file_name', false);\"" : "style=\"cursor: default;\"")?>><?=system_showText(LANG_SITEMGR_SELECT_FILE);?></a>
                        </li>
                        <? } ?>
                    </ul>
                    <div class="panel panel-default">
                            <form id="importInfo" name="importInfo" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" id="step" name="step" value="<?=$step?>">
                            <input type="hidden" id="prev_step" name="prev_step" value="4">
                            <input type="hidden" id="module" name="module" value="<?=$module?>">

                            <input type="hidden" name="import_from_export_<?=$module?>" value="<?=${"import_from_export_".$module}?>">
                            <input type="hidden" name="import_enable_active_<?=$module?>" value="<?=${"import_enable_active_".$module}?>">
                            <input type="hidden" name="import_update_items_<?=$module?>" value="<?=${"import_update_items_".$module}?>">
                            <input type="hidden" name="import_update_friendlyurl_<?=$module?>" value="<?=${"import_update_friendlyurl_".$module}?>">
                            <input type="hidden" name="import_featured_categs_<?=$module?>" value="<?=${"import_featured_categs_".$module}?>">
                            <input type="hidden" name="import_defaultlevel_<?=$module?>" value="<?=${"import_defaultlevel_".$module}?>">
                            <input type="hidden" name="import_sameaccount_<?=$module?>" value="<?=${"import_sameaccount_".$module}?>">
                            <input type="hidden" name="account_id_<?=$module?>" value="<?=${"account_id_".$module}?>">

                            <input type="hidden" id="type" name="type" value="<?=$type? $type: "upload"?>">
                            <input type="hidden" id="ftp_type" name="ftp_type" value="correct">

                            <? if ($messageErrorUpload) { ?>
                            <p class="alert alert-warning"><?=$messageErrorUpload;?></p>
                            <? } ?>
                            <p id="separator_message_id" class="alert alert-warning" style="display: none"><?=LANG_SITEMGR_IMPORT_INVALID_SEPARATOR?></p>
                            <p id="max_mb_message" class="alert alert-warning" style="display: none"><?=system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS)." ".MAX_MB_FILE_SIZE_ALLOWED_FTP."MB.";?></p>

                            <? if ($step == 4) { ?>
                                <div id="uploadFile">
                                    <div class="panel-body">
                                        <p><?=$message;?></p>
                                        <p><b><?=system_showText(LANG_SITEMGR_FILES_CSV);?></b></p>
                                        <p class="import-allow"><?=system_showText(LANG_SITEMGR_IMPORT_MAXFILESIZE_ALLOWED)?> <?=MAX_MB_FILE_SIZE_ALLOWED;?> MB.</p>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="file" class="importFile file-withinput" name="importFile" onchange="uploadFile('upload');" size="64" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>

                            <div id="selectFile" style="display: none;">
                                <div class="panel-body">
                                    <? if ($step == 4) { ?>

                                        <p id="msgFilePath" style="<?=$file_name ? "display: none;": "";?>"><?=system_showText(LANG_SITEMGR_IMPORT_YOUCANUPLOADAT)?> /custom/domain_<?=SELECTED_DOMAIN_ID?>/import_files</p>

                                        <p><?=$message;?></p>

                                        <p><b><?=system_showText(LANG_SITEMGR_FILES_CSV);?></b> <?=system_showText(LANG_SITEMGR_IMPORT_MAXFILESIZE_ALLOWED)?> <?=MAX_MB_FILE_SIZE_ALLOWED_FTP?>mb</p>

                                        <p id="msgFileList" style="<?=$file_name && !$messageErrorUpload? "display: none;": "";?>"><strong><?=system_showText(LANG_SITEMGR_IMPORT_USEFORMTHEFORMBELOW);?></strong></p>
                                    <? } else { ?>
                                        <p><?=system_showText(LANG_SITEMGR_FILES_PREVIEW);?></p>
                                    <? } ?>
                                </div>
                                <div class="" style="<?=$file_name? "display: none;": "";?>">

                                    <table class="table" style="<?=$file_name? "display: none;": "";?>">
                                        <thead>
                                            <tr>
                                                <th width="30px">&nbsp;</th>
                                                <th><?=system_showText(LANG_SITEMGR_IMPORT_FILENAME);?></th>
                                                <th width="95px" ><?=system_showText(LANG_SITEMGR_IMPORT_FILESIZE);?></th>
                                                <th width="186px"><?=system_showText(LANG_SITEMGR_IMPORT_UPDATEDDATE);?></th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <div id="fileList" class="table-responsive content-table" style="<?=$file_name && !$messageErrorUpload? "display: none;": "";?>">
                                        <?=import_renderFileList($fileInfo);?>
                                    </div>

                                    <div id="dvButtons" style="<?=$file_name && !$messageErrorUpload? "display: none;": "";?>">
                                        <div class="panel-body">
                                            <p><a href="javascript:void(0);" class="pull-left" onclick="reloadFileList(false);" ><?=system_showText(LANG_SITEMGR_IMPORT_FILELIST_RELOAD);?></a></p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div id="selectFile2" style="display: none;">
                                <div class="panel-body">
                                    <div class="col-sm-6">
                                        <input type="text" id="file_name" name="file_name" class="form-control" value="<?=!$messageErrorUpload? $file_name: "";?>" readonly="readyonly">
                                    </div>
                                </div>
                            </div>
                            </form>

                            <div id="pageLoad" style="display: none;">
                                <div class="text-center">
                                    <img src="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>
                                    <p class="import-loading"><?=system_showText(LANG_SITEMGR_WAITLOADING);?></p>
                                </div>
                            </div>

                            <div id="wait_loading_file" style="display: none">
                                <div class="text-center">
                                    <img src="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>
                                    <p class="import-loading"><?=system_showText(LANG_SITEMGR_IMPORT_PROCESSING);?></p>
                                </div>
                            </div>

                            <form id="importOptions" name="importOptions" target="_parent" action="<?=DEFAULT_URL."/".SITEMGR_ALIAS;?>/content/datacenter/index.php?import_type=<?=$module?>" method="post">
                            <input type="hidden" name="type" value="options"/>
                            <input type="hidden" name="upload_name" value="<?=$upload_name;?>"/>
                            <input type="hidden" name="file_name" value="<?=$file_name;?>"/>
                            <input type="hidden" name="ftp_type" value="<?=$ftp_type;?>"/>

                            <input type="hidden" id="module" name="module" value="<?=$module?>" />
                            <input type="hidden" name="import_from_export_<?=$module?>" value="<?=${"import_from_export_".$module}?>" />
                            <input type="hidden" name="import_enable_active_<?=$module?>" value="<?=${"import_enable_active_".$module}?>" />
                            <input type="hidden" name="import_update_items_<?=$module?>" value="<?=${"import_update_items_".$module}?>" />
                            <input type="hidden" name="import_update_friendlyurl_<?=$module?>" value="<?=${"import_update_friendlyurl_".$module}?>" />
                            <input type="hidden" name="import_featured_categs_<?=$module?>" value="<?=${"import_featured_categs_".$module}?>" />
                            <input type="hidden" name="import_defaultlevel_<?=$module?>" value="<?=${"import_defaultlevel_".$module}?>" />
                            <input type="hidden" name="import_sameaccount_<?=$module?>" value="<?=${"import_sameaccount_".$module}?>" />
                            <input type="hidden" name="account_id_<?=$module?>" value="<?=${"account_id_".$module}?>" />

                            <div id="tableCSV" style="<?=$urlFileName? "" : "display: none;"; ?>">
                                <div class="panel-body">
                                    <p>
                                        <?=system_showText(constant("LANG_SITEMGR_PREVIEW_".string_strtoupper($module)))." ".system_showText(LANG_SITEMGR_IMPORT_SHOWING_PREVIEWLINES);?>
                                        <span><?=system_showText(LANG_SITEMGR_IMPORT_PREVIEW_MESSAGE);?></span>
                                    </p>
                                </div>
                                 <div id="csvPreview" class="content-table">
                                    <div class="text-center">
                                        <img src="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>
                                        <p class="import-loading"><?=system_showText(LANG_SITEMGR_WAITLOADING);?></p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="csvOption" value="<?=$csvDelimiter?>" />

                            <div class="panel-footer pager">
                                <? if ($step == 4) { ?>
                                    <button type="button" name="submit_button" id="btnPreview" class="btn btn-primary next" disabled="disabled" value="Submit" onclick="JS_submitPreview();"><?=system_showText(LANG_SITEMGR_PREVIEW)?> &rarr;</button>
                                <? } else { ?>
                                    <button type="submit" id="btnISubmit" value="Submit" onclick="changeDisplayForm();" class="btn btn-primary next <?=$urlFileName || $ftp_type == "schedule_cron"? "" : "input-button-form-disabled";?>" <?=$urlFileName || $ftp_type == "schedule_cron"? "" : "disabled=\"disabled\" style=\"display:none;\"";?>><?=$ftp_type == "schedule_cron"? system_showText(LANG_SITEMGR_SUBMIT): system_showText(LANG_SITEMGR_IMPORT_SUBMIT);?> &rarr;</button>
                                <? } ?>
                            </div>
                        </form>
                    </div>

                    <? } ?>


                </div>

                <div class="col-sm-12">
                    <? if ($step <= 4) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?=system_showText(LANG_SITEMGR_STEP3_TIP2);?></div>
                        <div class="panel-body">
                            <dl>
                                <dt><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?></dt>
                                <dd><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT_TIP)?></dd>
                                <br>
                                <dt><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE)?></dt>
                                <dd><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE_TIP)?></dd>
                                <br>
                                <dt><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_UPDATE)?></dt>
                                <dd><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_UPDATE_TIP)?></dd>
                                <br>
                                <dt><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FRIENDLYURL)?></dt>
                                <dd><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_FRIENDLYURL_TIP)?></dd>
                                <br>
                                <dt><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT)?></dt>
                                <dd><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT_TIP)?></dd>
                            </dl>
                        </div>
                    </div>
                    <? } else { ?>
                      <div class="panel panel-default">
                        <div class="panel-heading"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_1);?></div>
                        <div class="panel-body small">
                            <p><?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT2)?></p>
                            <p><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_4)?></p>
                            <p><?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT4." (/ | * . ; _ :).")?></p>
                            <p><?=$message?></p>
                            <p><?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT1_2)?></p>
                            <p><?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT1_3)?></p>
                        </div>
                    </div>
                    <? } ?>
                </div>

            </div>
        </section>
    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/import.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
