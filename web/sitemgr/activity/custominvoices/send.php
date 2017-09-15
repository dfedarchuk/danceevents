<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/activity/custominvoices/send.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
    
     # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (PAYMENT_FEATURE != "on" || ( (CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") ) || CUSTOM_INVOICE_FEATURE != "on" )
    {
        header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
        exit;
    }
    
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();
    
    $url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;
    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include(INCLUDES_DIR."/code/custominvoice-send.php");
    
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-activity.php");
?> 

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <form role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
            <section class="row heading">
	           	<div class="container">
                    <div class="col-sm-8">
                        <h1><?=system_showText(LANG_SITEMGR_SEND)?> <?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?></h1>
                    </div>
                </div>
            </section>
			
			<section class="row tab-options">
                <div class="container">                   
                    <div class="pull-right top-actions">
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices/"?>" class="btn btn-default"><?=system_showText(LANG_CANCEL)?></a>
                        <button type="submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SEND);?></button>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="container">
                            <?php
                                include(INCLUDES_DIR."/forms/form-custominvoice-send.php");
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="row footer-action">
           		<div class="container">
	           		<div class="col-xs-12 text-right">
		           		<a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/activity/custominvoices"?>" class="btn btn-default"><?=system_showText(LANG_CANCEL)?></a>
                        <button type="submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SEND);?></button>
					</div>
				</div>
            </section>
        </form>
    </main>
<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");