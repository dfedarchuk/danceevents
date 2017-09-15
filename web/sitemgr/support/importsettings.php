<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/support/importsettings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# THIS PAGE IS ONLY USED BY THE SUPPORT TEAM TO SET THE CONTROL CRON TABLES WITH DFAULT VALUES
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	if (!sess_getSMIdFromSession()){
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
        exit;
	} else {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT username FROM SMAccount WHERE id = ".sess_getSMIdFromSession();
		$row = mysql_fetch_assoc($dbMain->query($sql));
		if ($row["username"] != ARCALOGIN_USERNAME){
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
            exit;
		} 
	}
    
    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
    
    $url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/support/import.php";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."/support/import.php";

    if ($id) {
		$importObj = new ImportLog($id);
	} else {
		header("Location: ".$url_redirect);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if (validate_form("importsettings", $_POST, $message_importsettings)) {
            $importObj->setString("status", $status);
            $importObj->setString("action", $action);
            $importObj->Save();
            
            $message = 1;
			header("Location: ".$url_redirect."?message=".$message);
			exit;
        }
    }
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    $arrayNameDDStatus = array();
    $arrayNameDDAction = array();
    $arrayValueDDStatus = array();
    $arrayValueDDAction = array();

    $arrayNameDDStatus[] = "Pending (P)";
    $arrayValueDDStatus[] = "P";
    $arrayNameDDStatus[] = "Finished (F)";
    $arrayValueDDStatus[] = "F";
    $arrayNameDDStatus[] = "Cancelled (C)";
    $arrayValueDDStatus[] = "C";
    $arrayNameDDStatus[] = "Deleted (D)";
    $arrayValueDDStatus[] = "D";
    $arrayNameDDStatus[] = "Waiting (W)";
    $arrayValueDDStatus[] = "W";
    $arrayNameDDStatus[] = "Error (E)";
    $arrayValueDDStatus[] = "E";
    $arrayNameDDStatus[] = "Running (R)";
    $arrayValueDDStatus[] = "R";
    $arrayNameDDStatus[] = "Stopped (S)";
    $arrayValueDDStatus[] = "S";

    $arrayNameDDAction[] = "Ready to Import (RI)";
    $arrayValueDDAction[] = "RI";
    $arrayNameDDAction[] = "Need to Convert (NC)";
    $arrayValueDDAction[] = "NC";
    $arrayNameDDAction[] = "Need to Approve (NA)";
    $arrayValueDDAction[] = "NA";
    $arrayNameDDAction[] = "Done (D)";
    $arrayValueDDAction[] = "D";
    $arrayNameDDAction[] = "Converting (C)";
    $arrayValueDDAction[] = "C";
    $arrayNameDDAction[] = "Need to Rollback (NR)";
    $arrayValueDDAction[] = "NR";
    
    $statusDropDownStatus = html_selectBox("status", $arrayNameDDStatus, $arrayValueDDStatus, $importObj->getString("status"), "", "class='input-dd-form-settings'", "-- All Status --");
    $statusDropDownAction = html_selectBox("action", $arrayNameDDAction, $arrayValueDDAction, $importObj->getString("action"), "", "class='input-dd-form-settings'", "-- All Status --");

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
    include(SM_EDIRECTORY_ROOT."/layout/sidebar-support.php");

?>
    
    <main class="wrapper-dashboard togglesidebar container-fluid">

        <?
        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <form name="import_setting" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
         
            <section class="heading">

                <h1>Change ImportLog Status</h1>
              
                <? if ($errorMessage) { ?>
                      <p class="alert alert-warning"><?=$errorMessage?></p>
                <? } elseif ($_GET["message"] == "ok") { ?>
                      <p class="alert alert-success">Settings changed!</p>
                <? } ?>

            </section>

            <section class="row section-form">

                <input type="hidden" name="id" value="<?=$id?>" />
                <?include(INCLUDES_DIR."/forms/form-importsettings.php");?>
                <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

            </section>

            <section class="row footer-action">
                <div class="col-xs-12 text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </section>
        
        </form>
         
        <form id="formimportsettingscancel" action="<?=$url_redirect?>" method="post">
        </form>
    			
    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>