<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/modules.php
	# ----------------------------------------------------------------------------------------------------

    //Section
    $maxCategoryAllowed = MAX_CATEGORY_ALLOWED;
    if (string_strpos($_SERVER["PHP_SELF"], "/".LISTING_FEATURE_FOLDER."/") !== false || string_strpos($_SERVER["PHP_SELF"], "/claim/") !== false || string_strpos($_SERVER["PHP_SELF"], "listing-types/type.php") !== false) {
        if (string_strpos($_SERVER["PHP_SELF"], "/listing.php") !== false) {
            $feedName = "listing";
        } elseif (string_strpos($_SERVER["PHP_SELF"], "/type.php") !== false) {
            $feedName = "listingtemplate";
        }
        $maxCategoryAllowed = LISTING_MAX_CATEGORY_ALLOWED;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/".EVENT_FEATURE_FOLDER."/event.php") !== false) {
        $feedName = "event";
        $eventScript = true;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/".CLASSIFIED_FEATURE_FOLDER."/classified.php") !== false) {
        $feedName = "classified";
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/".ARTICLE_FEATURE_FOLDER."/article.php") !== false) {
        $feedName = "article";
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/".BANNER_FEATURE_FOLDER."/") !== false) {
        $bannerScript = true;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/".PROMOTION_FEATURE_FOLDER."/deal.php") !== false) {
        $promotionScript = true;
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/".BLOG_FEATURE_FOLDER."/blog.php") !== false) {
        $feedName = "blog";
    }

    if ($loadMap) {
        include(EDIRECTORY_ROOT."/includes/code/maptuning_forms.php");
    }

    if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/") !== false) {
        $tutSteps = "";
        if (is_array($arrayTutorial)) {
            foreach ($arrayTutorial as $key => $fieldTut) {
                $tutSteps .= "{
                            placement: \"" . $fieldTut["placement"] . "\",
                            element: \"#" . $fieldTut["id"] . "\",
                            title: \"" . addslashes($fieldTut["field"]) . "\",
                            content: \"" . addslashes($fieldTut["content"]) . "\"
                          },";
            }
        }
        $tutSteps = string_substr($tutSteps, 0, -1);
    }

?>

	<script>
        $(document).ready(function () {

            //Load Map
            <?php if ($hasValidCoord) { ?>
                loadMap(document.<?=$feedName?>, true);
            <?php } ?>

            //Load video automatically
            if ($("#video").val()) {
                autoEmbed();
            }

            //Pre-fill categories input (selectize)
            loadCategs();

            if ($('#item_clicktocall_number').length) {

                $("#item_clicktocall_number").autocomplete(
                {
                    source: function (request, response)
                    {
                        $.ajax(
                        {
                            url: '<?=DEFAULT_URL;?>/autocomplete_twilio.php?sitemgr=1&domain_id=<?=SELECTED_DOMAIN_ID?>&account_id=<?=$accId?>',
                            dataType: 'json',
                            data:
                            {
                                term: request.term
                            },
                            success: function (data)
                            {
                                response(data);
                            }
                        });
                    },
                    delay: 1000,
                    minLength: 3,
                    select: function (event, ui)
                    {
                        $(".action-save").removeClass("disabled");
                        $(".action-save").prop("disabled", false);
                        $(".action-save").attr("onclick", "changeSendForm('copyNumber'); ");
                    }
                });

            }

            <?php if ($promotionScript) { ?>

            <? if (!$members) { ?>
            // Initialize the selectize control for the account field
            window.selectAcc = $('#account_id').selectize({});

            // fetch the instance
            var selectize1 = window.selectAcc[0].selectize;
            <? } ?>

            showAmountType('<?=$aux_deal_type?>', 'show');
            calculateDiscount();

            <?php } ?>


        });

        function sendCoverImage(form_id, path, acc_id, action) {

            $("#"+form_id).vPB({
                url: DEFAULT_URL + "/" + path + "?action=ajax&type=" + action + "&domain_id=" + <?=SELECTED_DOMAIN_ID?> + "&account_id=" + acc_id + "&module=" + form_id,
                success: function(response)
                {
                    strReturn = response.split("||");

                    if (strReturn[0] == "ok") {
                        $("#returnMessage").hide();
                        $("#coverimage").hide().fadeIn('slow').html(strReturn[1]);
                        if (action == "deleteCover") {
                            $("#buttonReset").addClass("hidden");
                        } else {
                            $("#buttonReset").removeClass("hidden");
                        }
                    } else {
                        $("#returnMessage").removeClass("alert-success");
                        $("#returnMessage").removeClass("alert-warning");
                        $("#returnMessage").addClass("alert-warning");
                        $("#returnMessage").html(strReturn[1]);
                        $("#returnMessage").show();
                    }

                    btn = $('.action-save');
                    btn.button('reset');
                }
            }).submit();

        }

        <?php if ($promotionScript) { ?>

        function calculateDiscount() {

            var percentage = false;
            var realvalue = Number($('#real_price_int').val() + "." + $('#real_price_cent').val());
            var dealvalue = Number($('#deal_price_int').val() + "." + $('#deal_price_cent').val());

            if (document.getElementById("type_percentage").checked) {
                percentage = true;
            }

            if (realvalue != 'NaN' && dealvalue != 'NaN' ) {
                if (realvalue < 0) {
                    realvalue = realvalue * (-1);
                }

                if (dealvalue < 0) {
                    dealvalue = dealvalue * (-1);
                }

                if ((dealvalue > realvalue) && (percentage == false)) {
                    $('#amountDiscountMessage').html("<?=system_showText(LANG_MSG_VALID_MINOR)?>");
                    $('#discountAmount').html('');
                } else {
                    $('#amountDiscountMessage').html('');

                    if (percentage) {
                        discount = realvalue - ((dealvalue*realvalue)/100);
                    } else {
                        discount = 100 - (dealvalue/realvalue)*100;
                    }

                    if (!isNaN(discount) && discount >= 0) {
                        if (discount > 100 && !percentage) {
                            discount = 100;
                        }

                        if (percentage) {
                            $('#discountAmount').html('<?=CURRENCY_SYMBOL?>'+discount.toFixed(2));
                        } else {
                            $('#discountAmount').html(Math.round(discount)+'%');
                        }
                    }
                }
            }
        }

        function showAmountType(type, show) {
            if (type == '%') {
                $("#dealPriceValueLabel").html("<?=ucfirst(LANG_LABEL_PERCENTAGE)?>");
                document.getElementById('amount_monetary').innerHTML = ':';
                document.getElementById('amount_monetary').style.display = 'none';
                document.getElementById('amount_percentage').innerHTML = type;
                document.getElementById('amount_percentage').style.display = '';
                document.getElementById('label_deal_cent').style.display = 'none';
                document.getElementById('deal_price_cent').style.display = 'none';

                $('#discountAmount').html('');
                $('#amountDiscountMessage').html('');

                if (show == "not") {
                    document.getElementById('deal_price_int').value = '';
                    document.getElementById('deal_price_cent').value = '';
                }

                document.getElementById('deal_price_int').setAttribute('maxlength', 2);
            } else {
                $("#dealPriceValueLabel").html("<?=ucfirst(LANG_LABEL_DISC_AMOUNT)?>");

                document.getElementById('amount_monetary').innerHTML = type;
                document.getElementById('amount_monetary').style.display = '';
                document.getElementById('amount_percentage').style.display = 'none';
                document.getElementById('label_deal_cent').style.display = '';
                document.getElementById('deal_price_cent').style.display = '';

                $('#discountAmount').html('');
                $('#amountDiscountMessage').html('');

                if (show == "not") {
                    document.getElementById('deal_price_int').value = '';
                }

                document.getElementById('deal_price_int').setAttribute('maxlength', 5);
            }
        }

        <? } ?>

        <? if ($eventScript) { ?>

            function recurringcheck() {
                if (document.getElementById("recurring").checked==true){
                    document.getElementById("reccuring_events").style.display='';
                    document.getElementById("reccuring_ends").style.display='';
                    document.getElementById("end_date").disabled=true;
                    document.getElementById("labelEndDate").style.display='none';
                    chooseperiod(document.getElementById("period").value);
                    if (document.getElementById("eventEver").checked==true){
                        document.getElementById("until_date").disabled=true;
                    } else {
                        document.getElementById("until_date").disabled=false;
                    }

                } else {
                    document.getElementById("reccuring_events").style.display='none';
                    document.getElementById("reccuring_ends").style.display='none';
                    document.getElementById("end_date").disabled=false;
                    document.getElementById("labelEndDate").style.display='';
                }
            }

            // ---------------------------------- //

            function chooseperiod(value){
                if (value=="daily" || value=="" ){
                    document.getElementById("select_day").style.display='none';
                    document.getElementById("select_week").style.display='none';
                    document.getElementById("day").disabled=true;
                    document.getElementById("week").disabled=true;
                    document.getElementById("dayofweek").disabled=true;
                    for (i=0;i<7;i++){
                        document.getElementById("dayofweek_"+i).disabled=true;
                    }
                    for (i=0;i<5;i++){
                        document.getElementById("numberofweek_"+i).disabled=true;
                    }
                    document.getElementById("month").disabled=true;
                }else if(value=='weekly'){
                    document.getElementById("select_day").style.display='none';
                    document.getElementById("of").style.display='none';
                    document.getElementById("week_of").style.display='none';
                    document.getElementById("of2").style.display='';
                    document.getElementById("of3").style.display='none';
                    document.getElementById("of4").style.display='none';
                    document.getElementById("month_of").style.display='none';
                    document.getElementById("week").style.display='none';
                    document.getElementById("weeklabel").style.display='none';
                    document.getElementById("month").style.display='none';
                    document.getElementById("month2").style.display='none';
                    document.getElementById("select_week").style.display='';

                    document.getElementById("day").disabled=true;
                    document.getElementById("dayofweek").disabled=false;
                    for (i=0;i<7;i++){
                        document.getElementById("dayofweek_"+i).disabled=false;
                    }
                    for (i=0;i<5;i++){
                        document.getElementById("numberofweek_"+i).disabled=false;
                    }
                    document.getElementById("week").disabled=true;
                    document.getElementById("month").disabled=true;
                    document.getElementById("month2").disabled=true;
                    document.getElementById("precision1").style.display='none';
                    document.getElementById("precision2").style.display='none';

                }else if(value=='monthly'){
                    document.getElementById("precision1").style.display='';
                    document.getElementById("precision2").style.display='';
                    document.getElementById("precision2").checked=true;
                    document.getElementById("select_day").style.display='';
                    document.getElementById("of").style.display='';
                    document.getElementById("week_of").style.display='';
                    document.getElementById("of2").style.display='none';
                    document.getElementById("of3").style.display='none';
                    document.getElementById("of4").style.display='';
                    document.getElementById("month_of").style.display='none';
                    document.getElementById("week").style.display='';
                    document.getElementById("weeklabel").style.display='';
                    document.getElementById("month").style.display='none';
                    document.getElementById("month2").style.display='none';
                    document.getElementById("select_week").style.display='';

                    document.getElementById("day").disabled=true;
                    document.getElementById("dayofweek").disabled=false;
                    for (i=0;i<7;i++){
                        document.getElementById("dayofweek_"+i).disabled=false;
                    }
                    for (i=0;i<5;i++){
                        document.getElementById("numberofweek_"+i).disabled=false;
                    }
                    document.getElementById("week").disabled=false;
                    document.getElementById("month").disabled=false;
                    document.getElementById("month2").disabled=true;

                }else if(value=='yearly'){
                    document.getElementById("select_day").style.display='';
                    document.getElementById("of").style.display='';
                    document.getElementById("week_of").style.display='';
                    document.getElementById("of2").style.display='';
                    document.getElementById("of3").style.display='';
                    document.getElementById("of4").style.display='none';
                    document.getElementById("month_of").style.display='';
                    document.getElementById("week").style.display='';
                    document.getElementById("weeklabel").style.display='';
                    document.getElementById("month").style.display='';
                    document.getElementById("month2").style.display='';
                    document.getElementById("select_week").style.display='';
                    document.getElementById("precision1").style.display='';
                    document.getElementById("precision2").style.display='';
                    document.getElementById("precision2").checked=true;
                    document.getElementById("day").disabled=true;
                    document.getElementById("dayofweek").disabled=false;
                    for (i=0;i<7;i++){
                        document.getElementById("dayofweek_"+i).disabled=false;
                    }
                    for (i=0;i<5;i++){
                        document.getElementById("numberofweek_"+i).disabled=false;
                    }
                    document.getElementById("week").disabled=false;
                    document.getElementById("month").disabled=true;
                    document.getElementById("month2").disabled=false;
                }
            }

            // ---------------------------------- //

            function chooseprecision(value){

                if (value=='day'){

                    var start_date = $("#start_date").val();
                    var date_format = '<?=DEFAULT_DATE_FORMAT;?>';
                    var arrStDate = start_date.split("/");
                    if (date_format == 'd/m/Y') {
                        var defDay = arrStDate[0];
                        var defMonth = arrStDate[1];
                    } else if (date_format == 'm/d/Y') {
                        var defDay = arrStDate[1];
                        var defMonth = arrStDate[0];
                    }

                    if ($("#day").val() == "") {
                        $("#day").val(defDay);
                    }

                    if ($("#month option:selected").val() == "") {
                        if (defMonth) {
                            var nMonth = document.getElementById("month");
                            nMonth[(defMonth - 1) + 1].selected = true;
                        }
                    }

                    document.getElementById("day").disabled=false;
                    document.getElementById("dayofweek").disabled=true;
                    for (i=0;i<7;i++){
                        document.getElementById("dayofweek_"+i).disabled=true;
                    }
                    for (i=0;i<5;i++){
                        document.getElementById("numberofweek_"+i).disabled=true;
                    }
                    document.getElementById("week").disabled=true;
                    document.getElementById("month").disabled=false;
                    document.getElementById("month2").disabled=true;
                    document.getElementById("precision1").checked=true;
                    document.getElementById("precision2").checked=false;
                } else if (value=='weekday') {
                    document.getElementById("day").disabled=true;
                    document.getElementById("dayofweek").disabled=false;
                    for (i=0;i<7;i++){
                    document.getElementById("dayofweek_"+i).disabled=false;
                    }
                    for (i=0;i<5;i++){
                    document.getElementById("numberofweek_"+i).disabled=false;
                    }
                    document.getElementById("week").disabled=false;
                    document.getElementById("month").disabled=true;
                    document.getElementById("month2").disabled=false;
                } else {
                    document.getElementById("day").disabled=true;
                    document.getElementById("dayofweek").disabled=false;
                    for (i=0;i<7;i++){
                        document.getElementById("dayofweek_"+i).disabled=false;
                    }
                    for (i=0;i<5;i++){
                        document.getElementById("numberofweek_"+i).disabled=false;
                    }
                    document.getElementById("week").disabled=false;
                    document.getElementById("month").disabled=true;
                    document.getElementById("week2").disabled=false;
                }
            }

            // ---------------------------------- //

            function enableUntil(op){
                if (op==1){
                    document.getElementById("until_date").disabled=true;
                } else if (op==2){
                    document.getElementById("until_date").disabled=false;
                }
            }

            <? if ($recurring == "Y") { ?>
                recurringcheck();
                chooseperiod('<?=$period?>');
                <? if($period == "monthly" || $period == "yearly" ){ ?>
                    chooseprecision('<?=$precision?>');
                <? } ?>
            <? } ?>

        <? } ?>

        <? if ($feedName) { ?>

        function JS_submit() {

            feed = document.<?=$feedName?>.feed;
            return_categories = document.<?=$feedName?>.return_categories;
            if (return_categories.value.length > 0) return_categories.value = "";

            for (i = 0; i < feed.length; i++) {
                if (!isNaN(feed.options[i].value)) {
                    if (return_categories.value.length > 0) {
                        return_categories.value = return_categories.value + "," + feed.options[i].value;
                    } else {
                        return_categories.value = return_categories.value + feed.options[i].value;
                    }
                }
            }

            document.<?=$feedName?>.submit();
        }

        function JS_addCategory(id) {
            var totalSelected = selectize1.getValue().split(',');
            var totalAllowed = <?=$maxCategoryAllowed?>;
            if (totalSelected.length <= totalAllowed) {
                $('#span_'+id).addClass('selected');
                seed = document.<?=$feedName?>.seed;
                feed = document.<?=$feedName?>.feed;
                var text = unescapeHTML($("#liContent"+id).html());
                <? if (is_object($listing) && is_object($listingLevelObj)) { ?>
                cat_add = <?=$listingLevelObj->getFreeCategory($level)?>;
                <? if ($listing->needToCheckOut() || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || !$listing->getNumber("id") || $listing->getNumber("package_id") == 0) { ?>
                    check_cat = 0;
                <? } else { ?>
                    check_cat = 1;
                <? } ?>

                if (feed.length == cat_add && check_cat == 1) {
                    bootbox.alert('<?=system_showText(str_replace("[max]", $listingLevelObj->getFreeCategory($level), $listingLevelObj->getFreeCategory($level) == 1 ? LANG_ITEM_ALREADY_HAS_PAID2 : LANG_ITEM_ALREADY_HAS_PAID));?>', function() {});
                } else {
                <? } ?>
                    var flag = true;
                    for (i = 0; i <feed.length; i++) {
                        if (feed.options[i].value == id) {
                            flag = false;
                        }
                    }
                    if (text && id && flag) {
                        feed.options[feed.length] = new Option(text, id);
                    }
                <? if (is_object($listing)) { ?>
                }
                <? } ?>
            }
        }

        <? } ?>

        <? if (!$members) { ?>

        function changeModuleLevel() {

            var auxLevel = $('#level').val();
            <? if (is_object($listing)) { ?>

            var auxTemplate = $('#listingtemplate_id').val();
            var url = "<?=DEFAULT_URL.str_replace(EDIRECTORY_FOLDER, "", $_SERVER["PHP_SELF"]);?>?level="+auxLevel+"&listingtemplate_id="+auxTemplate+"<?=($id ? "&id=".$id : "")?>";
            var currTemplateId = '<?=$listingtemplate_id ? $listingtemplate_id : ''?>';

            <? } else { ?>

            var url = "<?=DEFAULT_URL.str_replace(EDIRECTORY_FOLDER, "", $_SERVER["PHP_SELF"]);?>?level="+auxLevel+"<?=($id ? "&id=".$id : "")?>";

            <? } ?>
            var currLevel = '<?=is_numeric($level) ? $level : ''?>';

            bootbox.confirm('<?=system_showText(LANG_CONFIRM_CHANGE_LEVEL)?>', function(result) {
                if (result) {
                    document.location.href = url;
                } else {
                    <? if (is_object($listing)) { ?>
                    $("#listingtemplate_id").val(currTemplateId);
                    <? } ?>
                    $("#level").val(currLevel);
                }
            });
        }

        <? } ?>

        //Load video iframe from URL
        function autoEmbed() {
            var videoURL = $("#video").val();

            if (videoURL) {
                $.post("<?=DEFAULT_URL."/includes/code/get_video.php"?>", {
                    video: videoURL
                }, function (ret) {
                    if (ret == "error") {
                        $("#videoMsg").removeClass("hidden");
                    } else {
                        $("#videoMsg").addClass("hidden");
                        $("#icon").css("display", "none");
                        $("#video_frame").html(ret);
                        $("#video_snippet").attr("value", ret);
                        $("#video_frame").fadeIn();
                    }
                });
            } else {
                $("#video_snippet").attr("value", "");
            }
        }

        //Remove attachment file
        function removeAttachment() {
            $("#div_attachment").addClass("hidden");
            $("#remove_attachment").attr("value", "1");
        }

        //Add event to category tree
        function initCategories() {
            $(".no-child > span").click( function() {
                var category = $(this).text();
                var categoryID = $(this).attr("data-catID");
                selectize1.addOption({value : categoryID, text : category});
                selectize1.addItem(categoryID);
            });
        }

        function loadCategs() {

            <? if ( $selectizeCategs ) foreach ( $selectizeCategs as $each_category ) { ?>
            selectize1.addOption({value : '<?=$each_category["value"]?>', text : '<?=htmlspecialchars_decode(addslashes($each_category["name"]))?>'});
            selectize1.addItem('<?=$each_category["value"]?>');
            <? } ?>

        }

        var auxStepsTutorial = [<?=$tutSteps?>];

        <? if ($feedName) { ?>

        // Initialize the selectize control for the Select Categories Modal
        var $select = $('#category-select').selectize({
            plugins: ['remove_button'],
            maxItems: <?=$maxCategoryAllowed?>,
            create: false,
            onItemRemove: function(value) {
                $('#feed').val(value);
                selectize2.removeOption(value);
                JS_removeCategory(document.<?=$feedName?>.feed, false);
                $('#span_'+value).removeClass('selected');
            },
            onItemAdd: function(value, $item) {
                JS_addCategory(value);
                selectize2.addOption({value : value, text : $item[0].firstChild.data});
                selectize2.addItem(value);
            }
        });

        // Initialize the selectize control for the categories field
        var $selectCat = $('#categories').selectize({
            plugins: ['remove_button'],
            maxItems: <?=$maxCategoryAllowed?>,
            create: false,
            onItemRemove: function(value) {
                $('#feed').val(value);
                selectize1.removeOption(value);
                JS_removeCategory(document.<?=$feedName?>.feed, false);
                $('#span_'+value).removeClass('selected');
            },
            onItemAdd: function(value, text) {
                JS_addCategory(value);
            }
        });

        // fetch the instance
        var selectize1 = $select[0].selectize; //modal
        var selectize2 = $selectCat[0].selectize; //field

        $("#action-categories").click(function () {
            $('#modal-categories').modal('hide');
        });

        <? } ?>

        function checkboxLabelChanging(pos) {
            $('#custom_checkbox' + (pos+1)).removeClass('hidden');
        }

        function dropdownLabelChanging(pos) {
            $('#custom_dropdown' + (pos+1)).removeClass('hidden');
        }

        function textLabelChanging(pos) {
            $('#custom_text' + (pos+1)).removeClass('hidden');
        }

        function shortdescLabelChanging(pos) {
            $('#custom_short_desc' + (pos+1)).removeClass('hidden');
        }

        function longdescLabelChanging(pos) {
            $('#custom_long_desc' + (pos+1)).removeClass('hidden');
        }

        function changeSendForm(method){
			if (method == "checkClickToCall") {
				document.getElementById("action_clicktocall").value = "verify_number";
			} else if (method == "clearNumber") {
				document.getElementById("action_clicktocall").value = "clearNumber";
			} else if (method == "copyNumber") {
				document.getElementById("action_clicktocall").value = "copyNumber";
			}
			document.getElementById('clicktocall_form').submit();
		}

    </script>

    <? if (string_strpos($_SERVER["PHP_SELF"], "/listing-types") === false && string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/") !== false) { ?>

    <script src="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/js/module-tutorial.js"></script>

    <? }

    if ($feedName) { ?>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>

        <script>
            <?
            if ($feedName == "listing") {
            if (((!$listing->getNumber("id")) || $listing->getNumber("package_id") > 0 || (($listing) && ($listing->needToCheckOut())) || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || (($listing) && ($listing->getPrice('monthly') <= 0 && $listing->getPrice('yearly') <= 0))) && ($process != "signup")) {
                    if ( is_numeric($listingtemplate_id) && $listingtemplate_id ) { ?>

                        loadCategoryTree('template', 'listing_', 'ListingCategory', 0, '<?=$listingtemplate_id?>', '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>, true);

                    <? } else { ?>

                        loadCategoryTree('all', 'listing_', 'ListingCategory', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>, true);

                    <? }
                }
            } elseif ($feedName == "listingtemplate") { ?>

                loadCategoryTree('main', 'listing_', 'ListingCategory', 0, 0, '<?=DEFAULT_URL?>', '<?=SELECTED_DOMAIN_ID;?>', true);

            <? } else { ?>

                loadCategoryTree('all', '<?=$feedName?>_', '<?=ucfirst($feedName)?>Category', 0, 0, '<?=DEFAULT_URL?>', <?=SELECTED_DOMAIN_ID?>, true);

            <? } ?>
        </script>

    <? }

    if ($facebookScript) { ?>
        <script>
            (function(d){
                var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
                js = d.createElement('script'); js.id = id; js.async = true;
                js.src = "//connect.facebook.net/<?=EDIR_LANGUAGEFACEBOOK?>/all.js#xfbml=1";
                d.getElementsByTagName('head')[0].appendChild(js);
            }(document));
        </script>
    <? }

    if (string_strpos($_SERVER["PHP_SELF"], "/".LISTING_FEATURE_FOLDER."/report.php") !== false) { ?>
        <script>

            $(document).ready(function(){
                $.get('<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=LISTING_FEATURE_FOLDER?>/twilio_report.php', {
                    item_type: 'listing',
                    domain_id: '<?=SELECTED_DOMAIN_ID;?>',
                    item_id: <?=$listing->getNumber("id")?>
                }, function(res) {
                    $("#twilio_reports").html(res);
                });
            });

        </script>
    <? } ?>

    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>

    <script src="<?=DEFAULT_URL?>/scripts/jquery/auto_upload/js/file_uploads.js"></script>

    <script>
        // Banner
        <? if ($bannerScript) { ?>
            var banner_tmp_form_images_content = document.getElementById("banner_with_images").innerHTML;
            var banner_tmp_form_text_content = document.getElementById("banner_with_text").innerHTML;

            function fillCaption (capt) {
                $("#mainCaption").attr("value", capt);
            }

            <?
            if ($type < 50)       echo "bannerDisableTextForm();";
            else if ($type >= 50) echo "bannerDisableImagesForm();";
            if ($forceTextForm) echo "bannerDisableImagesForm();";
            }
        ?>

    </script>
