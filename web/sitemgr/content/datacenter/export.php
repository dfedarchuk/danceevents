<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/datacenter/export.php
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
	include(INCLUDES_DIR."/code/export.php");
	
	if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
		$listingExportFunct = "showListingOptions();";
	} else {
		$listingExportFunct = "exportFile('Listing');";
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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-content.php");

?> 

    <main class="wrapper togglesidebar container-fluid">
            
        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?> 

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_DATATOOL);?></h1>
            <p><?=system_showText(LANG_SITEMGR_DATACONTENT_TIP_1);?></p>
            <p><?=system_showText(LANG_SITEMGR_DATACONTENT_TIP_2);?></p>
        </section>

        <div class="tab-options">
            <ul role="tablist" class="row nav nav-tabs">
                <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/index.php"?>"><?=system_showText(LANG_SITEMGR_IMPORT_TOOL);?></a></li>
                <li class="active"><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/export.php"?>"><?=system_showText(LANG_SITEMGR_EXPORT_TOOL);?></a></li>
                <li><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/settings.php"?>"><?=system_showText(LANG_SITEMGR_LABEL_SETTINGS);?></a></li>
            </ul>

            <div class="row tab-content">
                <div class="col-xs-12">
                <section class="tab-pane active" id="import-tool">

                    <legend><?=system_showText(LANG_SITEMGR_EXPORT_TOOL);?></legend>

                    <div class="row">

                        <div class="col-sm-4">
                            <p>
                                <button class="btn btn-primary btn-icon btn-block" type="button" onclick="showForm('listing')">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTLISTINGSAMEFORMAT)?>
                                </button>
                            </p>

                            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>  
                                <p>
                                    <button class="btn btn-primary btn-icon btn-block" type="button" onclick="showForm('event')">
                                       <?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTEVENTSAMEFORMAT)?>
                                    </button>
                                </p>
                            <? } ?>
                        </div>
                        <div class="col-sm-4">      
                            <? if (MAIL_APP_FEATURE == "on") { ?>
                            <p>
                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/datacenter/arcamailerexport.php" class="btn btn-primary btn-icon btn-block">
                                   <?=system_showText(LANG_SITEMGR_MAILAPP_EXPORTER)?>
                                </a>
                            </p>
                            <? } ?>
                            
                            <p>
                                <a href="#" data-toggle="modal" data-target="#modal-payment" class="btn btn-primary btn-icon btn-block">
                                   <?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS)?>
                                </a>
                            </p>
                                
                        </div>
                        
                        <div class="col-sm-12 hidden exporting" id="exporting-form-listing">
                            <div class="panel panel-default">
                                <div class="panel-heading"><?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTLISTINGSAMEFORMAT)?></div>
                                <div class="panel-body">
                                    <p><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_AFTEREXPORTDONE)?> <b><?=IMPORT_FOLDER_RELATIVE_PATH?></b></p>
                                    <p><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_FILENAME)?> <?=$exportFileListing?></p>
                                    <?
                                    //Check if SCALABILITY is " on " and if cron is running to show progress of export
                                    if ($aux_export_running["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on") { ?>

                                        <br><br>

                                        <p>
                                            <span id="export_message"></span>
                                        </p>

                                        <p>
                                            <span id="export_progress">&nbsp;</span>
                                            <span id="export_progress_percentage">&nbsp;</span>
                                        </p>

                                    <? } else { ?>

                                        <br><br>

                                        <p>
                                            <span id="export_message">
                                                <a href="javascript:startExport();" class="btn btn-primary">
                                                    <?=system_showText(LANG_SITEMGR_EXPORT_CLICKHERETOSTART)?>
                                                </a>
                                                <br>
                                                    <? if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
                                                        if ($old_export_file) { ?>
                                                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/exportfile.php?export_type=listing&filename=".$old_export_file."&type=csv"?>"><?=system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)?></a>
                                                        <? }
                                                    }
                                                    ?>
                                            </span>
                                        </p>

                                        <p>
                                            <span id="export_progress">&nbsp;</span>
                                            <span id="export_progress_percentage">&nbsp;</span>
                                        </p>
                                    <? } ?>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-7 hidden exporting" id="exporting-form-event">
                            <div class="panel panel-default">
                                <div class="panel-heading"><?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTEVENTSAMEFORMAT)?></div>
                                <div class="panel-body">
                                    <p><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_AFTEREXPORTDONE)?> <b><?=IMPORT_FOLDER_RELATIVE_PATH?></b></p>
                                    <p><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_FILENAME)?> <?=$exportFileEvent?></p>
                                    <?
                                    //Check if SCALABILITY is " on " and if cron is running to show progress of export
                                    if ($aux_export_runningEvent["finished"] == "N" && EVENT_SCALABILITY_OPTIMIZATION == "on") { ?>

                                        <br /><br />

                                        <p>
                                            <span id="export_messageEvent"></span>
                                        </p>

                                        <p>
                                            <span id="export_progressEvent">&nbsp;</span>
                                            <span id="export_progress_percentageEvent">&nbsp;</span>
                                        </p>

                                    <? } else { ?>

                                        <br /><br />

                                        <p>
                                            <span id="export_messageEvent">
                                                <a href="javascript:startExportEvent();" class="btn btn-primary">
                                                    <strong><?=system_showText(LANG_SITEMGR_EXPORT_CLICKHERETOSTART)?></strong><br /></a>
                                                    <? if (EVENT_SCALABILITY_OPTIMIZATION == "on") {
                                                        if ($old_export_fileEvent) { ?>
                                                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/exportfile.php?export_type=event&filename=".$old_export_file."&type=csv"?>"><?=system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)?></a>
                                                        <? }
                                                    }
                                                    ?>
                                            </span>
                                        </p>

                                        <p>
                                            <span id="export_progressEvent">&nbsp;</span>
                                            <span id="export_progress_percentageEvent">&nbsp;</span>
                                        </p>
                                    <? } ?>

                                </div>
                            </div>
                        </div>

                    </div>

                    <legend><?=system_showText(LANG_SITEMGR_EXPORT_CLICKTODOWNLOADDATA);?></legend>


                  


                    <div class="row">

                        <div class="col-sm-12">
                            <p id="exportMessage" class="alert <?=$messageStyle? $messageStyle: ""; ?>" style="<?=$messageStyle? "": "display: none;"; ?>">
                                <?=$exportMessage? $exportMessage: ""; ?>
                            </p>

                            <div id="export_loading" class="alert alert-loading alert-block text-center hidden">
                                <p><?=system_showText(LANG_SITEMGR_EXPORT_WAITING_CRON);?></p>
                                <img src="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/assets/img/loading-64.gif">
                            </div>

                            <div id="exportlisting" class="panel panel-default" style="<?=(LISTING_SCALABILITY_OPTIMIZATION == "on" && $export["finished"] == "N"? "": "display:none");?>">
                                <div class="panel-body">
                                    <input type="hidden" id="nextFileName" value="<?=$exportFile?>" />
                                    <p>
                                        <strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_AFTEREXPORTDONE)?></strong> <?=$exportFilePath?>
                                    </p>
                                    <p>
                                        <strong><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTITEM_FILENAME)?></strong> <span id="showFileName"><?=$exportFile?></span>
                                    </p>
                                    <p  class="text-center" id="export_cron_loading" style="<?=$export["finished"] == "N"? "": "display: none;"?>">
                                        <?=system_showText(LANG_SITEMGR_EXPORT_EXPORTINGPLEASEWAIT);?>
                                        <img src="<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif">
                                    </p>
                                    <p class="text-center" id="export_progress" style="<?=$export["finished"] == "N"? "": "display: none;"?>">&nbsp;</p>
                                    <p class="text-center" id="export_link_start" style="<?=$export["finished"] == "N"? "display: none;": "";?>">
                                        <a href="javascript:void(0);" onclick="scheduleExport();" class="btn btn-link" style="margin: 0; padding: 0; font-size: 14px;">
                                            <?=system_showText(LANG_SITEMGR_EXPORT_CLICKHERETOSTART)?>
                                        </a>
                                    </p>
                                    <p class="text-center" id="file_link" style="<?=$exportedFileName? "": "display: none; "?>">
                                        <? if ($exportedFileName){ ?>
                                            <a class="btn btn-primary" href="<?=$_SERVER["PHP_SELF"]."?action=cron&download=".$exportedFileName;?>"><?=system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)?></a>
                                        <? } ?>
                                    </p>                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="<?=$listingExportFunct;?>">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_LISTING_DATA)?>
                                </button>
                            </p>
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('ListingCategory');">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_LISTING_CATEGORY_DATA)?>
                                </button>
                            </p>
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('Location');">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_LOCATION_DATA)?>
                                </button>
                            </p>
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('Account');">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_ACCOUNT_DATA)?>
                                </button>
                            </p>
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="showEmailOptions();">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_GENERATEEMAILLIST)?>
                                </button>
                            </p>

                        
                            <div id="emailDataFields" class="form-group" style="display: none;">
                                <div class="radio-inline">
                                    <label><input type="radio" name="item_filter" onclick="changeEmailOption(this.value);" value="all" checked>All</input></label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="item_filter" onclick="changeEmailOption(this.value);" value="category">Category</input></label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="item_filter" onclick="changeEmailOption(this.value);" value="location">Location</input></label>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <span id="categoryDropDown" style="display: none;" class="simple-select"><?=$categoryDropDown;?></span>
                                        <span id="locationDropDown" style="display: none; " class="simple-select"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" onclick="exportFile('Email');" class="btn btn-primary btn-block" >
                                            <?=system_showText(LANG_SITEMGR_EXPORT_EMAIL_LIST);?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                                               
                        <div class="col-sm-3">
                        <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('Banner');">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_BANNER_DATA)?>
                                </button>
                            </p>
                        <? } ?>
                            
                        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('Classified');">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_CLASSIFIED_DATA)?>
                                </button>
                            </p>
                            <p>
                                <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('ClassifiedCategory');">
                                    <?=system_showText(LANG_SITEMGR_EXPORT_CLASSIFIED_CATEGORY_DATA)?>
                                </button>
                            </p>
                        <? } ?>
                        </div>
                        
                        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                            <div class="col-sm-3">
                                <p>
                                    <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('Event');">
                                        <?=system_showText(LANG_SITEMGR_EXPORT_EVENT_DATA)?>
                                    </button>
                                </p>
                                <p>
                                    <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('EventCategory');">
                                        <?=system_showText(LANG_SITEMGR_EXPORT_EVENT_CATEGORY_DATA)?>
                                    </button>
                                </p>
                            </div>
                        <? } ?>

                        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                            <div class="col-sm-3">
                                <p>
                                    <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('Article');">
                                        <?=system_showText(LANG_SITEMGR_EXPORT_ARTICLE_DATA);?>
                                    </button>
                                </p>
                                <p>
                                    <button class="btn btn-info btn-icon btn-block" type="button" onclick="exportFile('ArticleCategory');">
                                         <?=system_showText(LANG_SITEMGR_EXPORT_ARTICLE_CATEGORY_DATA);?>
                                    </button>
                                </p>
                            </div>
                        <? } ?>
                       
                        
                    </div>

                    <hr>
                    
                    <? include(INCLUDES_DIR."/tables/table-export.php"); ?>
                    
                    <form name="export_delete" id="export_delete" action="<?=$url_redirect?>" method="get">
                        <input type="hidden" name="action" value="deleteFile" />
                        <input type="hidden" id="deleteFile" name="file" value="" />
                    </form>
                    
                    <!-- ######################## -->
                    <!-- Modal Export Payment record -->
                    <!-- ######################## -->
                    
                    <div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-payment" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS)?></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form name="export_payment" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="hidden" name="export_payment" value="true">
                                                <? include(INCLUDES_DIR."/forms/form-export-payment.php"); ?>
                                            </div>  
                                            <div class="col-sm-6 col-sm-offset-3 text-center">  
                                                <button type="submit" name="btn_export_payment" value="Submit" class="btn btn-primary"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                                            </div>
                                        </form>                        
                                    </div>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
                </section>
                </div>
            </div>

        </div>

    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/export.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>