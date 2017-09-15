<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/category.php
	# ----------------------------------------------------------------------------------------------------

?>
    <script src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>

    <? if ($module) { ?>
    
    <script">
        loadCategoryTree('all', '<?=strtolower($module)?>_', '<?=$module;?>Category', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);
    </script>
    <? } ?>
    
	<script>
        
        var check_progress_time = 1*1000;
        
        function linkRedirect(url) {
            window.location = url;
        }
        
        function deleteList(id) {
            bootbox.confirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE)?>', function(result) {
                if (result) {
                    $('#hiddenValue').attr('value', id);
                    document.MailList_post.submit();
                }
            });
        }
        
        function checkRunningProgress() {
            
            $.post(DEFAULT_URL + "/includes/code/mailapplist.php", {
                domain_id: <?=SELECTED_DOMAIN_ID?>,
                type: 'ajax'
            }, function (ret) {
                if (ret != "quit") {
                    var aRet = ret.split("||");
                    var current_id = aRet[1];
                    var current_status = aRet[3];
                    var current_progress = aRet[5];
                    var last_id = aRet[7];
                    var last_status = aRet[9];
                    
                    //Enable/Disable buttons
                    var enableCurrent_down_bt = false;
                    var enableCurrent_delete_bt = false;
                    
                    var enableLast_down_bt = false;
                    var enableLast_delete_bt = false;
                    
                    var disableCurrent_down_bt = false;
                    var disableCurrent_delete_bt = false;
                    
                    var disableLast_down_bt = false;
                    var disableLast_delete_bt = false;
                    
                    if (current_id) {
                        switch (current_status) {
                            case "R" :  $("#tdprogress_"+current_id).html("<span class=\"status-running\"><?=system_showText(LANG_SITEMGR_IMPORT_RUNNING)?></span>");
                                        disableCurrent_down_bt = true;
                                        disableCurrent_delete_bt = true;
                                        break;
                                        
                            case "E" :  $("#tdprogress_"+current_id).html("<span class=\"status-error\"><?=system_showText(LANG_SITEMGR_IMPORT_ERROR)?></span>");
                                        enableCurrent_delete_bt = true;
                                        break;
                                        
                            case "F" :  $("#tdprogress_"+current_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
                                        enableCurrent_down_bt = true;
                                        enableCurrent_delete_bt = true;
                                        break;
                        }
                        $("#progress_"+current_id).html(current_progress+"%");
                    }
                    
                    if (last_id) {
                        switch (last_status) {
                            case "R" :  $("#tdprogress_"+last_id).html("<span class=\"status-running\"><?=system_showText(LANG_SITEMGR_IMPORT_RUNNING)?></span>");
                                        disableLast_down_bt = true;
                                        disableLast_delete_bt = true;
                                        break;
                                        
                            case "E" :  $("#tdprogress_"+last_id).html("<span class=\"status-error\"><?=system_showText(LANG_SITEMGR_IMPORT_ERROR)?></span>");
                                        enableLast_delete_bt = true;
                                        break;
                                        
                            case "F" :  $("#tdprogress_"+last_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
                                        enableLast_down_bt = true;
                                        enableLast_delete_bt = true;
                                        break;
                        }
                        if (last_status == "F") {
                            $("#progress_"+last_id).html("100%");
                        }
                    }
                    
                    if (enableCurrent_down_bt) {
                        $("#img_download_"+current_id).removeClass("btn-default");
                        $("#img_download_"+current_id).addClass("btn-primary");
						$("#img_download_"+current_id).css("cursor", "pointer");
                        document.getElementById("img_download_"+current_id).onclick = function() {
                            linkRedirect('arcamailerexport.php?action=downFile&id='+current_id);
                        }
                    }
                    
                    if (enableCurrent_delete_bt) {
                        $("#img_delete_"+current_id).removeClass("btn-default");
                        $("#img_delete_"+current_id).addClass("btn-warning");
						$("#img_delete_"+current_id).css("cursor", "pointer");
                        document.getElementById("img_delete_"+current_id).onclick = function() {
                            deleteList(current_id);
                        }
                    }
                    
                    if (enableLast_down_bt) {
                        $("#img_download_"+last_id).removeClass("btn-default");
                        $("#img_download_"+last_id).addClass("btn-primary");
						$("#img_download_"+last_id).css("cursor", "pointer");
                        document.getElementById("img_download_"+last_id).onclick = function() {
                            linkRedirect('arcamailerexport.php?action=downFile&id='+last_id);
                        }
                    }
                    
                    if (enableLast_delete_bt) {
                        $("#img_delete_"+last_id).removeClass("btn-default");
                        $("#img_delete_"+last_id).addClass("btn-warning");
						$("#img_delete_"+last_id).css("cursor", "pointer");
                        document.getElementById("img_delete_"+last_id).onclick = function() {
                            deleteList(last_id);
                        }
                    }
                    
                    if (disableCurrent_down_bt) {
                        $("#img_download_"+current_id).addClass("btn-default");
                        $("#img_download_"+current_id).removeClass("btn-primary");
						$("#img_download_"+current_id).attr("onclick", "");
						$("#img_download_"+current_id).css("cursor", "default");
                    }
                    
                    if (disableCurrent_delete_bt) {
                        $("#img_delete_"+current_id).addClass("btn-default");
                        $("#img_delete_"+current_id).removeClass("btn-warning");
						$("#img_delete_"+current_id).attr("onclick", "");
						$("#img_delete_"+current_id).css("cursor", "default");
                    }
                    
                    if (disableLast_down_bt) {
                        $("#img_download_"+last_id).addClass("btn-default");
                        $("#img_download_"+last_id).removeClass("btn-primary");
						$("#img_download_"+last_id).attr("onclick", "");
						$("#img_download_"+last_id).css("cursor", "default");
                    }
                    
                    if (disableLast_delete_bt) {
                        $("#img_delete_"+last_id).addClass("btn-default");
                        $("#img_delete_"+last_id).removeClass("btn-warning");
						$("#img_delete_"+last_id).attr("onclick", "");
						$("#img_delete_"+last_id).css("cursor", "default");
                    }
                    
                    if (current_id) {
                        setTimeout("checkRunningProgress();", check_progress_time);
                    }
                }

            });
            
        }
        
        <? if ($runAjax) { ?>
            
            $(document).ready(function(){
                checkRunningProgress();
            });
            
        <? } ?>
            
        function showCategoriesByModule(moduleName) {
            
            if (moduleName == "all") {
                
                $("#div_step_2").toggle('slow');
                $('#label_step_3').text("2");
                $('#label_step_4').text("3");
                
            } else {
                
                $("#div_step_2").fadeIn();
                $('#label_step_3').text("3");
                $('#label_step_4').text("4");
            
                <? foreach ($availableModules as $avModule) { ?>
                    $("#categories_<?=ucfirst($avModule);?>").css("display", "none");
                    $("#<?=$avModule;?>_categorytree_id_0").html("&nbsp;");
                <? } ?>

                if (moduleName) {

                    if (moduleName == 'Listing') {
                        loadCategoryTree('all', 'listing_', 'ListingCategory', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);
                    } else {
                        loadCategoryTree('all', moduleName.toLowerCase()+'_', moduleName+'Category', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);
                    }

                    if ($('#divCategories').css('display') == 'none') {
                        $("#divCategories").fadeIn();
                    }
                    if ($('#divAll').css('display') == 'none') {
                        $("#divAll").fadeIn();
                    }
                    $("#categories_"+moduleName).fadeIn();

                } else {
                    $("#divAll").fadeOut();
                    $("#divCategories").css("display", "none");
                }
                
            }
            
        }
        
        function JS_addCategory(id) {
            var selectedModule = document.mailapp.module.value;
            var id_aux = "";
            var text_aux = "";
            
            switch (selectedModule) {
                case "Listing" :    feed = document.mailapp.feed_listing;
                                    id_aux = "listing_"+id;
                                    break;
                case "Event" :      feed = document.mailapp.feed_event;
                                    id_aux = "event_"+id;
                                    break;
                case "Classified" : feed = document.mailapp.feed_classified;
                                    id_aux = "classified_"+id;
                                    break;
                case "Article" :    feed = document.mailapp.feed_article;
                                    id_aux = "article_"+id;
                                    break;
            }
            
            feedAll = document.mailapp.feed_all;
            
            var text = unescapeHTML($("#liContent"+id).html());
            var flag = true;
            for (i = 0; i < feed.length; i++) {
                if (feed.options[i].value == id) {
                    flag = false;
                }
            }
            
            switch (selectedModule) {
                case "Listing" :    text_aux = "<?=system_showText(LANG_LISTING_FEATURE_NAME)." » ";?>"+text;
                                    break;
                case "Event" :      text_aux = "<?=system_showText(LANG_EVENT_FEATURE_NAME)." » ";?>"+text;
                                    break;
                case "Classified" : text_aux = "<?=system_showText(LANG_CLASSIFIED_FEATURE_NAME)." » ";?>"+text;
                                    break;
                case "Article" :    text_aux = "<?=system_showText(LANG_ARTICLE_FEATURE_NAME)." » ";?>"+text;
                                    break;
            }

            if (text && id && flag) {
                feed.options[feed.length] = new Option(text, id);
                feedAll.options[feedAll.length] = new Option(text_aux, id_aux);
                $('#categoryAdd'+id).after("<span class=\"categorySuccessMessage\"><?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?></span>").css('display', 'none');
                $('.categorySuccessMessage').fadeOut(5000);
                
            } else {
                if (!flag) $('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?></span> </li>");
                else ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?></span> </li>");
            }            
            
            //Show button to remove categories
            $('#removeCategoriesButton').show(); 
            
        }
        
        function removeCategory(feed) {
            
            if (feed.selectedIndex >= 0) {
                
                categ = feed.options[feed.selectedIndex].value;
                categinfo = categ.split('_');
                
                switch (categinfo[0]) {
                    case "listing" :    path_aux = "../<?=LISTING_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_listing;
                                        break;
                    case "event" :      path_aux = "../<?=EVENT_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_event;
                                        break;
                    case "classified" : path_aux = "../<?=CLASSIFIED_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_classified;
                                        break;
                    case "article" :    path_aux = "../<?=ARTICLE_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_article;
                                        break;
                }
                
                for (i = 0; i < feed_aux.length; i++) {
                    if (feed_aux.options[i].value == categinfo[1]) {
                        $("#feed_"+categinfo[0]).val(categinfo[1]);
                    }
                }
                
                feed.remove(feed.selectedIndex);
                JS_removeCategory(feed_aux, false);
                
                if (feed.length == 0) {
                	$('#removeCategoriesButton').hide();
                }
            }

        }
        
        function JS_submit() {
           
            <? foreach ($availableModules as $avModule) { ?>
            feed_<?=$avModule;?> = document.mailapp.feed_<?=$avModule;?>;
            return_categories_<?=$avModule;?> = document.mailapp.return_categories_<?=$avModule;?>;
            if (return_categories_<?=$avModule;?>.value.length > 0) return_categories_<?=$avModule;?>.value = "";

            if (feed_<?=$avModule;?>) {
                for (i = 0; i < feed_<?=$avModule;?>.length; i++) {
                    if (feed_<?=$avModule;?>.options[i].value != "") {
                        if (return_categories_<?=$avModule;?>.value.length > 0) {
                            return_categories_<?=$avModule;?>.value = return_categories_<?=$avModule;?>.value + "," + feed_<?=$avModule;?>.options[i].value;
                        } else {
                            return_categories_<?=$avModule;?>.value = return_categories_<?=$avModule;?>.value + feed_<?=$avModule;?>.options[i].value;
                        }
                    }
                }
            }
            <? } ?>
            
            feedAll = document.mailapp.feed_all;
            return_categories_all = document.mailapp.return_categories_all;
            if (return_categories_all.value.length > 0) return_categories_all.value = "";

            if (feedAll) {
                for (i = 0; i < feedAll.length; i++) {
                    if (feedAll.options[i].value != "") {
                        if (return_categories_all.value.length > 0) {
                            return_categories_all.value = return_categories_all.value + "," + feedAll.options[i].value;
                        } else {
                            return_categories_all.value = return_categories_all.value + feedAll.options[i].value;
                        }
                    }
                }
            }
            
            document.mailapp.submit();
        }
            
    </script>