<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/arcamailerexport.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MAIL_APP_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
    
    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/mailapplist.php");
    
    // Page Browsing /////////////////////////////////////////
	$pageObj  = new pageBrowsing("MailAppList", $screen, false, "date DESC, title", "title", $letter, false);
	$mailappLists = $pageObj->retrievePage();
	
	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/arcamailerexport.php";

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
                <h1><?=system_showText(LANG_SITEMGR_MAILAPP_EXPORTER);?></h1>
                <?
                //Success Message
                if (is_numeric($message) && isset($msg_mailapplist[$message])) {
                    echo "<p class=\"alert alert-success\">".$msg_mailapplist[$message]."</p>";
                } elseif (is_numeric($emessage) && isset($msg_mailapplist[$emessage])) {
                    echo "<p class=\"alert alert-warning\">".$msg_mailapplist[$emessage]."</p>";
                }
                ?>
        </section>

        <section class="section-form">
            <div id="delete_maillist" style="display:none">
                <form name="MailList_post" id="MailList_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                    <input type="hidden" id="hiddenValue" name="hiddenValue">
                </form>
            </div>

            <div class="col-sm-12">

                <? if ($mailappLists) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?=system_showText(LANG_SITEMGR_MAILAPP_MANAGE);?>
                    </div>
                    <div class="table-responsive">
                        <? include(INCLUDES_DIR."/tables/table_mailapplist.php"); ?>
                    </div>
                </div>
                <? }
                
                include(INCLUDES_DIR."/forms/form_mailapplist.php"); ?>

            </div>

        </section>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/mailapplist.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>