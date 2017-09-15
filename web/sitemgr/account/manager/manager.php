<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/account/manager/manager.php
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
    
    // required because of the cookie var
	$username = "";

	extract($_GET);
	extract($_POST);	

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if (($password == '0' && string_strlen($password) < 4)) {
			$sucess = false;
			$message_smaccount = system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";
		} else {
			if (validate_smaccount($_POST, $message_smaccount)) {

				if ($permission) {
					$permissions = $permission;
					$permission = 0;
					foreach ($permissions as $each_permission) {
						$permission += $each_permission;
					}
				} else {
					$permission = 0;
				}
                $_POST["active"] = ($_POST["status"] == "1" ? "y" : "n");
				$_POST["permission"] = $permission;
                
				$smaccount = new SMAccount($_POST);
				$smaccount->Save();

				if ($password) {
					$smaccount->setString("password", $password);
					$smaccount->updatePassword();
				}

				if ($id) {
					$message = 5;
				} else {
					$newest = "1";
					$message = 6;
				}

				header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/manager.php?message=".$message."&id=".$smaccount->getNumber("id")."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
				exit;

			}
		}
		
		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$smaccount = new SMAccount($id);
		$smaccount->extract();
	}

	extract($_POST);
	extract($_GET);
    
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-accounts.php");

?> 

        <main class="wrapper-dashboard togglesidebar container-fluid">

            <?php
            require(SM_EDIRECTORY_ROOT."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?> 

            <form role="form" name="smaccount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                
                <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
                <input type="hidden" name="id" value="<?=$id?>" />
                
                <section class="row heading">
                    <div class="container">
                    	<div class="col-xs-12">
                    	    <h1><?=system_showText($id ? LANG_SITEMGR_EDIT_SMACCOUNT : LANG_SITEMGR_ADD_SMACCOUNT);?></h1>
                	    </div>
                	</div>
                </section>

                <? if (is_numeric($message) && isset($msg_account[$message])) { ?>
                <div class="container alert alert-info fade in" role="alert">
                    <h4><?=$msg_account[$message]?></h4>
                </div>
                <? } ?>

               <section class="section-form">
                    <div class="container">
                        <? include(INCLUDES_DIR."/forms/form-manager.php"); ?>
                    </div>
               </section>

               <section class="row footer-action">
                    <div class="container">
                        <div class="col-xs-12 text-right">
                            <a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS."/account/manager/index.php?screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""))?>" class="btn btn-default"><?=system_showText(LANG_CANCEL);?></a>
                            <span class="separator"> <?=system_showText(LANG_OR);?>  </span>
                            <button type="submit" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_MSG_SAVE_CHANGES);?></button>
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
?>