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
	# * FILE: /includes/tables/table_lead.php
	# ---------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_lead[$message])) { ?>
        <p class="alert alert-success"><?=$msg_lead[$message]?></p>
	<? } elseif ($errorMessage) { ?>
        <p class="alert alert-warning"><?=$errorMessage;?></p>
    <? } ?>
        
	<table class="table table-hovered">
        <thead>
		<tr>
			<th>
                <?=system_showText(LANG_LABEL_FROM);?>
            </th>
            
            <? if (!$item_id) { ?>
			<th>
                <?=system_showText(LANG_LABEL_FOR);?>
            </th>
            <? } ?>
            
			<th>
                <?=string_ucwords(system_showText(LANG_LABEL_SUBJECT));?>
            </th>
            
            <th>
                <?=string_ucwords(system_showText(LANG_LABEL_CREATED));?>
            </th>
                            
            <th class="text-center">
                <?=system_showText(LANG_LABEL_OPTIONS)?>
            </th>
            
		</tr>
        </thead>
        <tbody>
		<?
        if ($leadsArr) foreach($leadsArr as $each_lead) {
            
            $auxMessage = @unserialize($each_lead["message"]);
            if (is_array($auxMessage)) {
                $each_lead["message"] = "";
                foreach ($auxMessage as $key => $value) {
                    $each_lead["message"] .= (defined($key) ? constant($key) : $key).($value ? ": ".$value : "")."\n";
                }
            }
            
            if (!$item_id) {
                
                $labelFor = "";
                if ($each_lead["type"] == "general") {
                    $labelFor = "<span>".system_showText(LANG_GENERAL_LEAD)."</span>";
                } else {
                    
                    if ($each_lead["type"] == "listing") {
                        $aux_itemObj = new Listing($each_lead["item_id"]);
                        $itemPath = LISTING_FEATURE_FOLDER;
                        $itemFile = "listing";
                    } elseif ($each_lead["type"] == "classified") {
                        $aux_itemObj = new Classified($each_lead["item_id"]);
                        $itemPath = CLASSIFIED_FEATURE_FOLDER;
                        $itemFile = "classified";
                    } elseif ($each_lead["type"] == "event") {
                        $aux_itemObj = new Event($each_lead["item_id"]);
                        $itemPath = EVENT_FEATURE_FOLDER;
                        $itemFile = "event";
                    }
                    
                    if (is_object($aux_itemObj) && $aux_itemObj->getNumber("id")) {
                        $titleStr = $aux_itemObj->getString("title");
                        $labelFor = "<a href=\"".$url_base."/content/".$itemPath."/$itemFile.php?id=".$each_lead["item_id"]."\">".$aux_itemObj->getString("title")."</a>";
                    } else {
                        $titleStr = "";
                        $labelFor = "<span>".system_showText(LANG_GENERAL_LEAD)."</span>";
                    }
                }
                
            }
            
            $iconReplyForward = "";
            if ($each_lead["reply_date"] && $each_lead["reply_date"] != "0000-00-00 00:00:00" && $each_lead["forward_date"] && $each_lead["forward_date"] != "0000-00-00 00:00:00") {
                $iconReplyForward = "ico-reply-forward";
                $titleIco = system_showText(LANG_LEAD_REPLIED_FORWARDED_ICO);
                $titleIco = str_replace("[dater]", " (".format_date($each_lead["reply_date"], DEFAULT_DATE_FORMAT, "datestring").")", $titleIco);
                $titleIco = str_replace("[datef]", " (".format_date($each_lead["forward_date"], DEFAULT_DATE_FORMAT, "datestring").")", $titleIco);
            } elseif ($each_lead["reply_date"] && $each_lead["reply_date"] != "0000-00-00 00:00:00") {
                $iconReplyForward = "ico-reply";
                $titleIco = system_showText(LANG_LEAD_REPLIED_ICO)." (".format_date($each_lead["reply_date"], DEFAULT_DATE_FORMAT, "datestring").")";
            } elseif ($each_lead["forward_date"] && $each_lead["forward_date"] != "0000-00-00 00:00:00") {
                $iconReplyForward = "ico-forward";
                $titleIco = system_showText(LANG_LEAD_FORWARDED_ICO)." (".format_date($each_lead["forward_date"], DEFAULT_DATE_FORMAT, "datestring").")";
            }
            ?>
			<tr id="leadTR<?=$each_lead["id"];?>">
                <td>
                    
                    <? if ($iconReplyForward) { ?>
                        <i class="icon-paper27" title="<?=$titleIco;?>"></i>
                    <? } ?>
                    
                    <? if ($each_lead["member_id"] && string_strpos($url_base, "/".SITEMGR_ALIAS)) {
                        $contact = db_getFromDB("contact", "account_id", db_formatNumber($each_lead["member_id"]));
                        
                        if ($contact->getNumber("account_id")) { ?>
                    
                            <a title="<?=$contact->getString("first_name")." ".$contact->getString("last_name");?>" href="<?=$url_base?>/account/sponsor/sponsor.php?id=<?=$each_lead["member_id"]?>">
                                <?=system_showTruncatedText($contact->getString("first_name")." ".$contact->getString("last_name"), 25);?>
                            </a>
                    
                        <? } else { ?>
                    
                            <span><?=$each_lead["first_name"].($each_lead["last_name"] ? " ".$each_lead["last_name"] : "");?></span>
                            
                        <? } ?>
                            
                    <? } else { ?>
                            
                        <span><?=$each_lead["first_name"].($each_lead["last_name"] ? " ".$each_lead["last_name"] : "");?></span>
                        
                    <? } ?>
                </td>
                    
                <? if (!$item_id) { ?>
                
                    <td><?=$labelFor;?></td>
                    
                <? } ?>
                
                <td><?=$each_lead["subject"];?></td>
                               
                <td><?=format_date($each_lead["entered"], DEFAULT_DATE_FORMAT, "datestring");?></td>
                                               
				<td nowrap class="text-center">
					<a class="btn btn-primary btn-xs" href="javascript: void(0);" onclick="showLead(<?=$each_lead["id"];?>, 'view');"><?=system_showText(LANG_LABEL_VIEW)?></a>
                    <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$each_lead["id"];?>);"><?=system_showText(LANG_LABEL_DELETE);?></a>
                </td>
                
			</tr>
            
            <tr id="viewTR<?=$each_lead["id"];?>" class="hideForm " style="display:none">
                <td colspan="6" id="viewTD<?=$each_lead["id"];?>" class="table-in-content">
                    <div class="view-lead">
                       
                        <div class="row">
                            <div class="col-sm-12">
                                <blockquote class="small">
                                    <h4><?=$each_lead["subject"];?></h4>
                                    <p><?=nl2br($each_lead["message"]);?></p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-10">
                                <a class="btn btn-xs btn-info" id="linkreply<?=$each_lead["id"];?>" href="javascript: void(0);" onclick="showLead(<?=$each_lead["id"];?>, 'reply');"><?=system_showText(LANG_LABEL_REPLY)?></a>
                                <a class="btn btn-xs btn-info" id="linkforward<?=$each_lead["id"];?>" href="javascript: void(0);" onclick="showLead(<?=$each_lead["id"];?>, 'forward');"><?=system_showText(LANG_LABEL_FORWARD)?></a>
                            </div>
                            <div class="col-xs-2 text-right">
                                <a class="btn btn-icon btn-xs btn-default" href="javascript:void(0);" onclick="hideLead(<?=$each_lead["id"];?>, 'view');"> <i class="icon-ion-ios7-close-empty"></i></a>
                            </div>
                        </div>


                        <div id="reply_lead_<?=$each_lead["id"];?>" style="display:none" class="view-lead-action">
                            <hr>
                            <form name="formReply" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                                
                                <input type="hidden" name="item_id" value="<?=$item_id;?>">
                                <input type="hidden" name="item_type" value="<?=$item_type;?>">
                                <input type="hidden" name="type" value="<?=$item_type;?>">
                                <input type="hidden" name="idLead" value="<?=$each_lead["id"];?>">
                                <input type="hidden" name="screen" value="<?=$screen;?>"> 
                                <input type="hidden" name="letter" value="<?=$letter;?>">
                                <input type="hidden" name="action" value="reply">
                                
                                <div class="form-group">
                                    <label for="in-email"><?=system_showText(LANG_LABEL_TO);?>: </label>
                                    <input class="form-control" id="in-email" type="email" name="to" value="<?=($to && $action == "reply" && $idLead == $each_lead["id"] ? $to : $each_lead["email"]);?>">
                                </div>

                                <div class="form-group">
                                    <label for="in-message"><?=system_showText(LANG_LABEL_MESSAGE);?>:</label>
                                    <textarea class="form-control" id="in-message" name="message" rows="5"><?=($message && $action == "reply" && $idLead == $each_lead["id"] ? $message : "");?></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-info btn-sm action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_BUTTON_SEND);?></button>
                                        <button type="reset"  name="cancel" value="Cancel" class="btn btn-default btn-sm" onclick="hideLead(<?=$each_lead["id"];?>, 'reply');"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                    </div>
                                </div>
                                
                            </form>
                            
                        </div>
                                           
                        <div id="forward_lead_<?=$each_lead["id"];?>" style="display:none" class="view-lead-action">    
                            <hr>
                            <form name="formForward" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                                
                                <input type="hidden" name="item_id" value="<?=$item_id;?>">
                                <input type="hidden" name="item_type" value="<?=$item_type;?>">
                                <input type="hidden" name="idLead" value="<?=$each_lead["id"];?>">
                                <input type="hidden" name="screen" value="<?=$screen;?>"> 
                                <input type="hidden" name="letter" value="<?=$letter;?>">
                                <input type="hidden" name="action" value="forward">
                                
                                <div class="form-group">
                                    <label for="for-mail"><?=system_showText(LANG_LABEL_TO);?>: </label>
                                    <input class="form-control" id="for-mail" type="email" name="to" value="<?=($to && $action == "forward" && $idLead == $each_lead["id"] ? $to : "");?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="for-message"><?=system_showText(LANG_LABEL_MESSAGE);?>: </label>
                                    <textarea class="form-control" id="for-message" name="message" rows="6"><?=($message && $action == "forward" && $idLead == $each_lead["id"] ? $message : $each_lead["message"]);?></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-sm btn-info action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_BUTTON_SEND);?></button>
                                        <button type="reset"  name="cancel" value="Cancel" class="btn btn-sm btn-default" onclick="hideLead(<?=$each_lead["id"];?>, 'forward');"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                    </div>  
                                </div>  
                                
                            </form>
                            
                        </div>
                        
                    </div>
                </td>
            </tr>

		<? } ?>
        </tbody>
	</table>