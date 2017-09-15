<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_adminemail.php
	# ----------------------------------------------------------------------------------------------------

?>

    <form name="adminemail" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

        <? if ($message_adminemail) { ?>
            <p class="alert alert-<?=$message_style?>"><?=$message_adminemail?></p>
        <? } ?>

        <div class="row">
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_GENERALEMAIL)?> <small><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_GENERALEMAIL_SPAN)?></small></div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="sitemgrEmail" class="control-label col-sm-5"><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="sitemgrEmail" name="sitemgr_email" value="<?=$sitemgr_email?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox row">
                                    <label class="col-sm-7 col-sm-offset-5">
                                        <input type="checkbox" name="send_email" <?=$send_email_checked?>>
                                        <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SENDNOTIFICATIONONTHISACCOUNT)?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="panel-footer">
                        <button type="submit" name="adminemail" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SPECIFICEMAIL)?> <small><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SPECIFICEMAIL_SPAN)?></small></div>
                    <div class="panel-body">                        
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_LISTINGADDUPDATE)?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitemgr_listing_email" value="<?=$sitemgr_listing_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                </div>                       
                            </div>

                            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>            
                                <div class="form-group row">
                                    <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_EVENTADDUPDATE)?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sitemgr_event_email" value="<?=$sitemgr_event_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                    </div>                       
                                </div>          
                            <? } ?>


                            <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                                <div class="form-group row">
                                    <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_BANNERADDUPDATE)?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sitemgr_banner_email" value="<?=$sitemgr_banner_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                    </div>                       
                                </div>             
                            <? } ?>

                            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                                <div class="form-group row">
                                    <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CLASSIFIEDADDUPDATE)?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sitemgr_classified_email" value="<?=$sitemgr_classified_email?>"  placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                    </div>                       
                                </div> 
                            <? } ?>

                            <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                                <div class="form-group row">
                                    <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ARTICLEADDUPDATE)?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sitemgr_article_email" value="<?=$sitemgr_article_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                    </div>                       
                                </div>            
                            <? } ?>

                            <div class="form-group row">
                                <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ACCOUNTADD)?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitemgr_account_email" value="<?=$sitemgr_account_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                </div>                       
                            </div> 

                            <div class="form-group row">
                                <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CONTACTUS)?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitemgr_contactus_email" value="<?=$sitemgr_contactus_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                </div>                       
                            </div> 

                            <div class="form-group row">
                                <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_HELPSUPPORT)?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitemgr_support_email" value="<?=$sitemgr_support_email?>"  placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                </div>                       
                            </div> 

                            <? if (PAYMENT_FEATURE == "on") { ?>
                                <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_PAYMENTRECEIVED)?></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="sitemgr_payment_email" value="<?=$sitemgr_payment_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                        </div>                       
                                    </div>                 
                                <? } ?>
                            <? } ?>

                            <div class="form-group row">
                                <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_REVIEWS)?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitemgr_rate_email" value="<?=$sitemgr_rate_email?>"  placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                </div>                       
                            </div> 


                            <? if (CLAIM_FEATURE == "on") { ?>
                                <div class="form-group row">
                                    <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CLAIMLISTING)?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sitemgr_claim_email" value="<?=$sitemgr_claim_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                    </div>                       
                                </div>             
                            <? } ?>

                            <? if (BLOG_FEATURE == "on") { ?>
                                <div class="form-group row">
                                    <label class="control-label col-sm-5"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_BLOG)?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sitemgr_blog_email" value="<?=$sitemgr_blog_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                    </div>                       
                                </div>            
                            <? } ?>

                            <div class="form-group row">
                                <label class="control-label col-sm-5"> <?=ucfirst(system_showText(LANG_SITEMGR_IMPORT))?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sitemgr_import_email" value="<?=$sitemgr_import_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>">
                                </div>                       
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" name="adminemail" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="help-block">
                            <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_THEASEEMAILSAREREQUIRED)?>
                            <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_PLEASESEPARATEWITHCOMMA)?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        
    </form>