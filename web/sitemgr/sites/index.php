<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/sites/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/sites";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

	extract($_GET);
	extract($_POST);
    
    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if (sess_getSMIdFromSession() || $id == SELECTED_DOMAIN_ID || DEMO_LIVE_MODE) {
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/domain");
            exit;
        }
        
		$domain = new Domain($id);
        $domain->Delete();

        // Remove domain yaml file
        $symfony = new Symfony('domain.yml');
        $symfony->remove('multi_domain', $domain->getString('url'));

        $message = 1;
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/sites/index.php?message=".$message);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUPORT EMAIL
	# ----------------------------------------------------------------------------------------------------
	if (is_numeric($_GET["domain_id"]) && $_GET["domain_id"] > 0) {

		setting_get("sitemgr_email",$sitemgr_email);
		$support_email = EDIR_SUPPORT_EMAIL;

		$domainObj = new Domain($_GET["domain_id"]);

		if ( $domainObj->getNumber( "id" ) != 0 && $domainObj->getString( "status" ) == "P" )
        {
			$domainObj->ActiveDomain();
			unset($domainObj);
		}
	}

	// Page Browsing /////////////////////////////////////////
    $whereLiveMode = "";
    if (DEMO_LIVE_MODE && strpos($_SERVER["SERVER_NAME"], "demodirectory.com.br") === false) {
        $whereLiveMode = "AND id not IN (3, 7, 8)";
    }
	unset($pageObj);
	$pageObj  = new pageBrowsing("Domain", $screen, false, "name", "name", $letter, "status='A' $whereLiveMode", "*", false, false, true);
	$domains = $pageObj->retrievePage();
    
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-domains.php");

?>
    <main class="wrapper-dashboard togglesidebar container-fluid" id="view-content-list">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?> 

		<section class="heading">
			<h1><?=system_showText(LANG_SITEMGR_MANAGE_SITES);?></h1>
			<p><?=system_showText(LANG_SITEMGR_DOMAIN_TIP);?></p>
		</section>
        <section class="row form-thumbnails">
        	<div class="row list">
        		<? include(INCLUDES_DIR."/lists/list-domains.php"); ?>
        	</div>
        </section>
        
    </main>

<?
    include(INCLUDES_DIR."/modals/modal-delete.php");
    
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>