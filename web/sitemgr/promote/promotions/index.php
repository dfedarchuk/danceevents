<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/promote/promotions/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") {
        header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
        exit;
    }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) {
        header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
        exit;
    }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);
    
    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == "delete") {

        //Promotion
		if ($_POST["id"] && $item_type == "discount") {

            require_once(CLASSES_DIR."/class_StripeInterface.php");
            
			$discountCodeObj = new DiscountCode($_POST["id"]);
			$discountCodeObj->Delete();
            $message = 0;
            $page = "discount";
            
        //Package
		} elseif ($_POST["id"] && $item_type == "package") {

            //Get account to save Log
            unset($aux_SMAccount);

            if (sess_getSMIdFromSession()){
                $smAccountObj = new SMAccount(sess_getSMIdFromSession());
                $aux_SMAccount = $smAccountObj->getString("name")." (".$smAccountObj->getString("username").")";
            } else {
                setting_get("sitemgr_username",$sitemgr_email);
                $aux_SMAccount = "Sitemgr"." (".$sitemgr_email.")";
            }

            $packageObj = new Package($_POST['id']);
            $packageObj->Delete($aux_SMAccount);
            $message = 2;
            $page = "package";
        }

        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/promote/promotions/index.php?page=$page&screen=$screen&letter=$letter&message=".$message);
        exit;

	}
    
    $url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	
	//Discoutn Codes
	$pageObjPromocode = new pageBrowsing("Discount_Code", $screen, false, "id");
	$discount_codes = $pageObjPromocode->retrievePage();

	//Packages
	$pageObjPackages  = new pageBrowsing("Package", $screen, false, "title", "title", $letter, "parent_domain = ".SELECTED_DOMAIN_ID, "*", false, false, true);
	$packages = $pageObjPackages->retrievePage();

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-promote.php");

?> 

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>
    
        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_PROMO_PACK);?></h1>
            <p><?=system_showText(LANG_SITEMGR_PROMOTE_5);?></p>
        </section>

        <div class="tab-options">
            <ul role="tablist" class="row nav nav-tabs">
                <li <?=((!is_numeric($message) || (is_numeric($message) && isset($msg_discountcode[$message]) && $page == "discount")) ? "class=\"active\"" : "");?>><a href="#promocodes" data-toggle="tab" role="tab"><?=system_showText(LANG_LABEL_DISCOUNTCODE)?></a></li>
                <li <?=(((is_numeric($message) && isset($msg_discountcode[$message]) && $page == "package")) ? "class=\"active\"" : "");?>><a href="#packages" data-toggle="tab" role="tab"><?=system_showText(LANG_SITEMGR_PACKAGE_PLURAL)?></a></li>
            </ul>

            <div class="row tab-content">

                <section class="tab-pane <?=((!is_numeric($message) || (is_numeric($message) && isset($msg_discountcode[$message]) && $page == "discount")) ? "active" : "");?>" id="promocodes">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a class="btn btn-primary" href="<?=$url_base?>/promote/promotions/discountcode.php"><i class="icon-cross8"></i> <?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_ADD);?></a>
                                <? if (is_numeric($message) && isset($msg_discountcode[$message])) { ?>
                                    <br><br>
                                    <p class="alert alert-success"><?=$msg_discountcode[$message]?></p>
                                <? } ?>
                            </div>
                            <div class="table-responsive">
                                <? include(INCLUDES_DIR."/tables/table_discountcode.php"); ?>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="tab-pane <?=(((is_numeric($message) && isset($msg_discountcode[$message]) && $page == "package")) ? "active" : "");?>" id="packages">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a class="btn btn-primary" href="<?=$url_base?>/promote/promotions/package.php"><i class="icon-cross8"></i> <?=system_showText(LANG_SITEMGR_PACKAGE_ADD);?></a>
                                <? if (is_numeric($message) && isset($msg_package[$message])) { ?>
                                    <br><br>
                                    <p class="alert alert-success"><?=$msg_package[$message]?></p>
                                <? } ?>
                            </div>
                            <div class="table-responsive">
                                <? include(INCLUDES_DIR."/tables/table_package.php"); ?>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </div>

    </main>

    <? include(INCLUDES_DIR."/modals/modal-delete.php"); ?>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>