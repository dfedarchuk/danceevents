<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/design/email-editor/index.php
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
		
	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/design/email-editor/index.php";
	
	extract($_GET);
    extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# ENABLE/DISABLE NOTIFICATION
	# ----------------------------------------------------------------------------------------------------	
	if (($deactive == '0') || ($deactive == '1')) {	
        $emailObj = new EmailNotification($id);
        $activation = $emailObj->changeStatus();  
        header("Location: $url_redirect");
        exit;
    }

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$pageObj  = new pageBrowsing("Email_Notification", $screen, false, "id", "id", $letter);
	$emails = $pageObj->retrievePage();
    
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

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_EMAILNOTIF))?></h1>
            <p><?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_TITLEMANAGE)?></p>
            <? if ($message) { ?>
            <p class="alert alert-success"><?=system_showText($message == 1 ? LANG_SITEMGR_EMAILNOTIFICATION_SUCCESSUPDATED : LANG_SITEMGR_EMAILNOTIFICATION_SUCCESSADDED)?></p>
            <? } ?>
        </section>

        <section class="section-form">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <? include(INCLUDES_DIR."/tables/table_notifications.php"); ?>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>