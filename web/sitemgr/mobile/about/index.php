<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/mobile/about/index.php
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

    include(INCLUDES_DIR."/code/mobile_about.php");
    
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
    include(SM_EDIRECTORY_ROOT."/layout/sidebar-mobile.php");
 

?>
    
    <main class="wrapper togglesidebar container-fluid">

        <section class="row heading">
            <div class="container">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_TITLE);?></h1>
                <p><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_40_MESSAGE);?></p>

				<p id="returnMessage" style="display:none;"></p>

				<? if ($errorMessage) { ?>
					<p id="errorMessage" class="alert alert-warning"><?=$errorMessage;?></p>
				<? } elseif ($success) { ?>
					<p id="successMessage" class="alert alert-success"><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGSSUCCESSUPDATED));?></p>
				<? } ?>

       		</div>
        </section>

        <section class="row appbuilder">
            <div class="appbuilder-container">

                <?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                ?>
                
                <section class="container">

					<form id="step4" name="step4" method="post" enctype="multipart/form-data" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
	                    
	                    <input type="hidden" name="next" id="next" value="no" />

	                    <div class="form-left">

					        <h4><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_PREVIEW);?></h4>
					        <p><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_TIP);?></p>

						    <div id="device-apple" class="cover-preview-image device-apple">
                                
						        <div class="about-preview-image">
						        	<span class="lang-aboutus"><?=system_showText(LANG_MENU_ABOUT)?></span>
							        <div class="prev-logo">
				                        <? if (file_exists(EDIRECTORY_ROOT."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}")) { ?>
											<img src="<?=DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}"?>" />
										<? } else { ?>
											<div class="your-logo"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_LOGO)?></div>
										<? } ?>
			                        </div>
			                        <span class="customtext <?=($about ? "" : "wireframe")?>">
                                        <? if ($about) { ?>
                                        <?=nl2br($about);?>
                                        <? } else { ?>
                                        <div class="your-abouttext"><?=system_showText(LANG_MENU_ABOUT)?></div>
                                        <? } ?>
                                    </span>
									<span class="lang-email"><?=system_showText(LANG_LABEL_EMAIL_ADDRESS)?></span>
		                        	<span class="lang-phone"><?=system_showText(LANG_LABEL_PHONE_NUMBER)?></span>
		                        	<span class="lang-website"><?=system_showText(LANG_LABEL_WEBSITE)?></span>
		                        </div>
                                
						        <div class="change-device">
						            <a class="icon-device-apple active" href="javascript:void(0);"></a>
						            <a class="icon-device-android" href="javascript:void(0);"></a>
						        </div>
                                
						    </div>
                            
						    <div id="device-android" class="cover-preview-image device-android" style="display:none;">
                                
						        <div class="about-preview-image">
						        	<span class="lang-aboutus"><?=system_showText(LANG_MENU_ABOUT)?></span>
						        	<div class="prev-logo">
				                        <? if (file_exists(EDIRECTORY_ROOT."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}")) { ?>
											<img src="<?=DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}"?>" />
										<? } else { ?>
											<div class="your-logo"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_LOGO)?></div>
										<? } ?>  
		                        	</div>
		                        	<span class="customtext <?=($about ? "" : "wireframe")?>">
                                        <? if ($about) { ?>
                                        <?=nl2br($about);?>
                                        <? } else { ?>
                                        <div class="your-abouttext"><?=system_showText(LANG_MENU_ABOUT)?></div>
                                        <? } ?>
                                    </span>
		                        	<span class="lang-email"><?=system_showText(LANG_LABEL_EMAIL_ADDRESS)?></span>
		                        	<span class="lang-phone"><?=system_showText(LANG_LABEL_PHONE_NUMBER)?></span>
		                        	<span class="lang-website"><?=system_showText(LANG_LABEL_WEBSITE)?></span>
		                        </div>
                                
						        <div class="change-device">
						            <a class="icon-device-apple" href="javascript:void(0);"></a>
						            <a class="icon-device-android active" href="javascript:void(0);"></a>
						        </div>
                                
						    </div>
                            
					    </div>
                        
						<div class="form-right">
	                                
					        <h4><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_CONFIG);?></h4>
					        <p><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_CONFIG_TIP);?></p>

	                        <div>
								<label for="logo"><?=system_showText(LANG_SITEMGR_LOGO_IMAGE)?> (430 x 320 pixels)</label>
                                <div class="row">
                                   <div class="col-xs-6"><input id="image" name="image" type="file" onchange="sendFile();" class="filestyle upload-files file-noinput"><br></div>
                                   <div class="col-xs-6"> <div id="loading_image" class="loading-image hidden"><img src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/loading-32.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/></div></div>
                                </div>
							</div>

							<div>
								<p id="alert_img" class="alert alert-warning" style="display:none;"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_CONFIG_TIP2);?></p>
							</div>
	                        
							<div>
								<label for="textarea"><?=system_showText(LANG_SITEMGR_ABOUT_TEXT)?></label>
								<textarea class="form-control" cols="40" rows="8" name="about" id="textarea" onkeyup="updateAbout();"><?=$about;?></textarea>
							</div>

							<div>
								<label for="email"><?=system_showText(LANG_LABEL_EMAIL_ADDRESS)?></label>
								<input class="form-control" type="email" name="email" id="email" value="<?=$email;?>" />
							</div>

							<div>
								<label for="phone"><?=system_showText(LANG_LABEL_PHONE_NUMBER)?></label>
								<input class="form-control" type="phone" name="phone" id="phone" value="<?=$phone;?>" />
							</div>

							<div>
								<label for="website"><?=system_showText(LANG_LABEL_WEBSITE)?></label>
								<input class="form-control" type="url" name="website" id="website" value="<?=$website;?>" />
							</div>
						
						</div>
	                    
						<br class="clearfix"><br />
	                    
						<div class="action">
							<button type="button" class="btn btn-success" onclick="JS_submit(true);"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES)?></button>
						</div>

					</form>
                        
                </section>
                
			</div>
            
        </section>
        
    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/appbuilder.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>