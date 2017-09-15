<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/index.php
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $import_actions) {
        
        $import = new ImportLog($id);
        
        if ($import_actions == "stop") {
            
            if ($import->getString("status") != "R" || $import->getString("action") == "NR") {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/index.php?import_type=".$import_type);
                exit;
            }
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $import->setString("status", "W");
            $import->setString("type", $import_type);
            $import->save();

            if ($import_type == "listing"){
                $tableCron = "Control_Import_Listing";
            } elseif ($import_type == "event"){
                $tableCron = "Control_Import_Event";
            } else {
                $tableCron = "Control_Import_Listing";
            }

            $sqlLog = "SELECT COUNT(id) AS total FROM `ImportLog` WHERE `status` = 'P' AND type = '".$import_type."'";
            $resLog = $db->Query($sqlLog);
            $rowLog = mysql_fetch_assoc($resLog);
            if ($rowLog["total"] > 0) {
                $sqlCron = "UPDATE `$tableCron` SET `scheduled` = 'Y', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
            } else {
                $sqlCron = "UPDATE `$tableCron` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
            }
            $dbMain->Query($sqlCron);

            $import->setHistory("LANG_SITEMGR_IMPORT_PROCESSWATINGTOSTOP");
            
        } elseif ($import_actions == "delete") {
            
            if ($import->getString("status") == "R" || $import->getString("action") == "NR" || $import->getString("action") == "C") {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/import/importlog.php?import_type=".$import_type);
                exit;
            }
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $import = new ImportLog($id);
            $import->delete();

            if ($import_type == "listing"){
                $tableTemp = "ImportTemporary";
                $tableCron = "Control_Import_Listing";
            } elseif ($import_type == "event"){
                $tableTemp = "ImportTemporary_Event";
                $tableCron = "Control_Import_Event";
            } else {
                $tableTemp = "ImportTemporary";
                $tableCron = "Control_Import_Listing";
            }

            $sqlTemporary = "DELETE FROM $tableTemp WHERE import_log_id = ".$id;
            $db->Query($sqlTemporary);

            $sqlLog = "SELECT COUNT(id) AS total FROM `ImportLog` WHERE `status` = 'P' AND type = '".$import_type."'";
            $resLog = $db->Query($sqlLog);
            $rowLog = mysql_fetch_assoc($resLog);
            if ($rowLog["total"] > 0) {
                $sqlCron = "UPDATE `$tableCron` SET `scheduled` = 'Y', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
            } else {
                $sqlCron = "UPDATE `$tableCron` SET `scheduled` = 'N', `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID;
            }
            $dbMain->Query($sqlCron);

        } elseif ($import_actions == "rollback") {
            
            if ((($import->getString("status") != "F") && ($import->getString("status") != "S")) || ($import->getString("action") == "NR")) {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/index.php?import_type=".$import_type);
                exit;
            }
            
			$import->setString("action", "NR");
			$import->setString("type", $import_type);
			$import->save();
            
        }
        
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/index.php?import_type=".$import_type);
        exit;
    }    
    
	if ($_GET["import_type"] == "event") {
		include(INCLUDES_DIR."/code/import_event.php");
		$includeFile = "import_event.php";
		$importType = "event"; 
	} else {
		include(INCLUDES_DIR."/code/import.php");
		$includeFile = "import.php";
		$importType = "listing"; 
	}
    
    if ($_GET["type"]) {
        $importObj = new ImportLog($_GET["log_id"]);
        $uploadname = $importObj->getString("filename");
        if (!$uploadname) $_GET["type"] = "0";
    }
    
    $import = new ImportLog();
	$importsListing = $import->getImports("listing");
	$importsEvent = $import->getImports("event");
    
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

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_DATATOOL);?></h1>
            <p><?=system_showText(LANG_SITEMGR_DATACONTENT_TIP_1);?></p>
            <p><?=system_showText(LANG_SITEMGR_DATACONTENT_TIP_2);?></p>
        </section>

        <div class="tab-options">
                <ul role="tablist" class="row nav nav-tabs">
                    <li class="active"><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/index.php"?>"><?=system_showText(LANG_SITEMGR_IMPORT_TOOL);?></a></li>
                    <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/export.php"?>"><?=system_showText(LANG_SITEMGR_EXPORT_TOOL);?></a></li>
                    <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/settings.php"?>"><?=system_showText(LANG_SITEMGR_LABEL_SETTINGS);?></a></li>
                </ul>

                <div class="row tab-content">

                    <div class="col-xs-12">     
                    <section class="tab-pane active">

                        <legend><?=system_showText(LANG_SITEMGR_IMPORT_NEW);?></legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="list-group list-group-options">
                                    <a class="list-group-item btn-icon" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/import.php?module=listing"?>"><i class="icon-incoming4"></i> <?=system_showText(LANG_SITEMGR_NAVBAR_IMPORTLISTINGS);?></a>
                                    <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                                      
                                        <a class="list-group-item btn-icon" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/import.php?module=event"?>"><i class="icon-calendar47"></i> <?=system_showText(LANG_SITEMGR_NAVBAR_IMPORTEVENTS);?></a>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                       
                        
                        <hr>
                        
                        <? if ($_GET["type"] == "1") { ?>
                            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_IMPORT_SUCCESSUPLOADED1)?> "<?=$uploadname?>" <?=system_showText(LANG_SITEMGR_IMPORT_SUCCESSUPLOADED2)?></p>
                        <? } else if ($_GET["type"] == "2") { ?>
                            <p class="alert alert-success"><?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED1)?> "<?=$uploadname?>" <?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED2)?> <?=IMPORT_FOLDER_RELATIVE_PATH?> <?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED3)?></p>
                        <? }
                        
                        if ($importsListing) {
                            $imports = $importsListing;
                            $labelTable = system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);
                            include(INCLUDES_DIR."/tables/table-import.php");
                        }
                        
                        if ($importsEvent) {
                            $imports = $importsEvent;
                            $labelTable = system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);
                            include(INCLUDES_DIR."/tables/table-import.php");
                        }
                        ?>  

                    </section>

                    </div>
                </div>
        </div>

    </main>

    <div id="importactions" style="display:none">
        
        <form name="importactions" id="importactions" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
            <input type="hidden" name="import_actions" id="import-actions" value="">
            <input type="hidden" name="id" id="import-id" value="">
            <input type="hidden" name="import_type" id="import-type" value="">
            <input type="hidden" id="msg-delete" value="<?=system_showText(LANG_SITEMGR_IMPORT_LOG_DELETEQUESTION)?>">
            <input type="hidden" id="msg-rollback" value="<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACKQUESTION)?>">
            <input type="hidden" id="msg-stop" value="<?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORT_QUESTION)?>">
        </form>
                
    </div>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/import.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>