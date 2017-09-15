<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/design/css-editor/index.php
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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/editor.php");
    
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

    <main class="wrapper togglesidebar container-fluid wysiwyg">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <form id="htmleditor" role="form" name="htmleditor" class="html-editor" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

            <section class="heading">
                <div class="pull-right">
                    <button type="submit" name="revert" value="Submit" class="btn btn-default btn-lg action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_RESET)?></button>
                    <button type="submit" name="htmleditor" value="Submit" class="btn btn-primary btn-lg action-save"" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                </div>
                <h1><?=system_showText(LANG_SITEMGR_CSS_EDITOR)?></h1>
                <p><?=system_showText(LANG_SITEMGR_EDITOR_TIP1);?></p>
            </section>

            <section>
                <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>">
                <input type="hidden" name="file" value="<?=$file?>">
                <input type="hidden" name="fileType" value="<?=$fileType?>">
                <input type="hidden" name="submitAction" value="csseditor">

                <div class="row">
                    <div class="col-md-9 col-xs-12">
                        <textarea name="text" id="textarea" class="form-control" rows="30"><?=htmlspecialchars($text)?></textarea>
                    </div>
                    <div class="col-md-3 col-xs-12">
                    </div>
                </div>

                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <p class="alert alert-warning" role="alert">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?=system_showText(LANG_SITEMGR_COLOR_OPTIONS_TIP);?>
                        </p>
                    </div>
                </div>
            </section>
        </form>

    </main>

<?php
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/design.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");