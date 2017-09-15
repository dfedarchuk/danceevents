<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/promote/awards/index.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	
    
    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($delete_id) {
			$editorChoice = new EditorChoice($delete_id);
			$editorChoice->delete();
			$message = 0;
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/promote/awards/index.php?message=".$message."");
			exit;
		} else {
			include(INCLUDES_DIR."/code/editor_choice.php");
		}

	}
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

    $default_max_choice = 10;
    
	if ($default_max_choice == 1) $editorChoices[] = db_getFromDB("editor_choice", "", "", $default_max_choice, "id", "object", SELECTED_DOMAIN_ID);
	else $editorChoices = db_getFromDB("editor_choice", "", "", $default_max_choice, "id", "object", SELECTED_DOMAIN_ID);
	$indice = 0;
	if ($editorChoices) {
		foreach ($editorChoices as $editor) { 
			$default_editor_id[$indice] = $editor->getNumber("id");
			$default_name[$indice]      = $editor->getString("name", false);
			$default_available[$indice] = ($editor->available) ? "checked" : "";
			$default_images[$indice++]  = $editor->getNumber("image_id");
		}
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-promote.php");

?> 

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_AWARD_BADGE);?></h1>
            <p><?=system_showText(LANG_SITEMGR_AWARD_BADGE_TIP1);?></p>
            <? if ($message_editorchoice) { ?>
                <p class="alert alert-success"><?=$message_editorchoice?></p>
            <? } elseif (is_numeric($message) && isset($msg_designation[$message])) { ?>
                <p class="alert alert-success"><?=$msg_designation[$message]?></p>
            <? } elseif ($message_error_editorchoice) { ?>
                <p class="alert alert-warning"><?=$message_error_editorchoice?></p>
            <? } ?>
        </section>

        <section class="row">
            <section class="form-thumbnails">
                <div class="row">
                    <? include(INCLUDES_DIR."/lists/list-badges.php"); ?>
                </div>
            </section>
        </section>

        <form name="badges" id="badges" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
        
            <input type="hidden" name="last_badge_changed" id="last_badge_changed" value="">
            <input type="hidden" name="delete_id" id="delete_id" value="">
            
            <section class="tab-content">
                
                <? for ($i = 0; $i < $default_max_choice; $i++) { ?>
                
                    <input type="hidden" name="choice[]" value="<?=$default_editor_id[$i]?>">
                    <input type="hidden" name="image[]"  value="<?=$default_images[$i]?>">
                
                    <div class="row tab-pane section-form <?=($_POST && $last_badge_changed == $i && $message_error_editorchoice ? "active" : "")?>" id="form-badge<?=$i;?>">
                        
                        <? include(INCLUDES_DIR."/forms/form-badge.php"); ?>
                        
                        <div class="footer-action col-sm-12 text-center">
                            <button type="submit" name="editorchoice" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                        </div>
  
                    </div>
                <? } ?>
                
            </section>

        </form>
    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>