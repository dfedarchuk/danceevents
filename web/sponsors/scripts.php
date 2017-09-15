<script>

    if ($("#myChart").length) {
        //This will get the first returned node in the jQuery collection.
        var ctx = $("#myChart").get(0).getContext("2d");
    }

    function initializeDashboard() {
        $(".dial").knob({
            readOnly:   true,
            fgColor:    "#<?=$colorKnob;?>",
            bgColor:    "#DEE1E3",
            fontWeight: 300,
            thickness:  .2,
            width:      70,
            height:     70
        });

        $(".status, .floating-tip, .alert-new, #item_renewal").tooltip({
            animation: true,
            placement: "top"
        });

        if ($("#myChart").length) {
            //Get context with jQuery - using jQuery's .get() method.
            ctx = $("#myChart").get(0).getContext("2d");
            loadChart();
        }
    }

    $(function() {
        $("#alert").fadeOut(5000);
        initializeDashboard();
    });

    function showReply(id) {
        $('#review_reply'+id).css('display', '');
        $('#link_reply'+id).css('display', 'none');
        $('#cancel_reply'+id).css('display', '');
    }

    function hideReply(id) {
        $('#review_reply'+id).css('display', 'none');
        $('#link_reply'+id).css('display', '');
        $('#cancel_reply'+id).css('display', 'none');
    }

    function showLead(id) {
        $('#lead_reply'+id).css('display', '');
        $('#link_lead'+id).css('display', 'none');
        $('#cancel_lead'+id).css('display', '');
    }

    function hideLead(id) {
        $('#lead_reply'+id).css('display', 'none');
        $('#link_lead'+id).css('display', '');
        $('#cancel_lead'+id).css('display', 'none');
    }

    function saveReply(id) {
        $("#submitReply"+id).css("cursor", "default");
        $("#submitReply"+id).prop("disabled", "disabled");
        $("#submitReply"+id).html('<?=system_showText(LANG_WAITLOADING);?>');

        $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", $("#formReply"+id).serialize(), function(data) {
            if ($.trim(data) == "ok") {
                $("#msgReviewE"+id).css("display", "none");
                $("#msgReviewS"+id).css("display", "");
                $("#msgReviewS"+id).fadeOut(5000);
            } else {
                $("#msgReviewE"+id).css("display", "");
                $("#msgReviewS"+id).css("display", "none");
            }
            $("#submitReply"+id).html('<?=system_showText(LANG_BUTTON_SUBMIT);?>');
            $("#submitReply"+id).prop("disabled", "");
            $("#submitReply"+id).css("cursor", "pointer");
        });
    }

    function saveLead(id) {
        $("#submitLead"+id).css("cursor", "default");
        $("#submitLead"+id).prop("disabled", "disabled");
        $("#submitLead"+id).html('<?=system_showText(LANG_WAITLOADING);?>');

        $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", $("#formLead"+id).serialize(), function(data) {
            if ($.trim(data) == "ok") {
                $("#msgLeadE"+id).css("display", "none");
                $("#msgLeadS"+id).css("display", "");
                $("#msgLeadS"+id).fadeOut(5000);
                setTimeout("leadBox('hide', "+id+");", 4000);
                $("#title_replied"+id).css("display", "none");
                $("#new_replied"+id).css("display", "");
            } else {
                $("#msgLeadE"+id).html(data);
                $("#msgLeadE"+id).css("display", "");
                $("#msgLeadS"+id).css("display", "none");
            }
            $("#submitLead"+id).html('<?=system_showText(LANG_BUTTON_SUBMIT);?>');
            $("#submitLead"+id).prop("disabled", "");
            $("#submitLead"+id).css("cursor", "pointer");
        });
    }

    function reviewBox(option, id) {
        $("#reviews-list").children(".item-review").children(".review-detail").stop(true,true).slideUp();
        $("#reviews-list").children(".item-review").children(".review-summary").stop(true,true).slideDown().removeClass("new");
        if (option == "show") {
            $("#review-summary-"+id).slideUp();
            $("#review-detail-"+id).slideDown();
            setItemAsViewed("review", id);
        } else {
            $("#review-summary-"+id).slideDown();
            $("#review-detail-"+id).slideUp();
        }
    }

    function leadBox(option, id) {
        $("#leads-list").children(".item-review").children(".review-detail").stop(true,true).slideUp();
        $("#leads-list").children(".item-review").children(".review-summary").stop(true,true).slideDown().removeClass("new");
        if (option == "show") {
            $("#lead-summary-"+id).slideUp();
            $("#lead-detail-"+id).slideDown();
            setItemAsViewed("lead", id);
        } else {
            $("#lead-summary-"+id).slideDown();
            $("#lead-detail-"+id).slideUp();
        }
    }

    function dealBox(option, id) {
        $("#deals-list").children(".item-review").children(".review-detail").stop(true,true).slideUp();
        $("#deals-list").children(".item-review").children(".review-summary").stop(true,true).slideDown();
        if (option == "show") {
            $("#deal-summary-"+id).slideUp();
            $("#deal-detail-"+id).slideDown();
        } else {
            $("#deal-summary-"+id).slideDown();
            $("#deal-detail-"+id).slideUp();
        }
    }

    function changeDealStatus(option, id, promocode) {
        $.post("<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=PROMOTION_FEATURE_FOLDER?>/deal.php",{action: option, promotion_id: promocode}, function() {
            if (option == "freeUpDeal") {
                $("#label_used"+id).css("display", "");
            } else {
                $("#label_used"+id).css("display", "none");
            }
        });
    }

    function setItemAsViewed(type, id) {
        $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", {
            ajax_type: 'setItemAsViewed',
            type: type,
            id: id
        }, function () {});
    }

    function loadDashboard(item_type, item_id) {
        $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", {
            ajax_type: 'load_dashboard',
            item_type: item_type,
            item_id: item_id
        }, function (ret) {
            $(".webitem").removeClass("active");
            $("#"+item_type+"_"+item_id).addClass("active");
            scrollPage('#dashboard');
            $("#dashboard").hide().html(ret).fadeIn(800);
            initializeDashboard();
        });
    }

    function selectLegend(option, id, chartdata) {
        var countVisible = 0;

        if (option == "viewALL") {

            if ( $(".legend-ALL").hasClass("isvisible")) {
//                    $(".legend-ALL").removeClass("isvisible");
//                    $("#optionLegend > li > i").removeClass("checked");
//                    $("#optionLegend > li").removeClass("isvisible");
//                    $("#controlLegend > li").remove();
            } else {
                countVisible = 2;
                $("#optionLegend > li > i").addClass("checked");
                $(".legend-ALL").addClass("isvisible");
                $("#optionLegend > li").not(".isvisible").clone().appendTo("#controlLegend");
                $("#optionLegend > li").addClass("isvisible");
            }
        } else {
            id: id
            chartdata: chartdata
            $newlegend = $(".legend-"+id).clone();

            if ($(".legend-"+id).hasClass("isvisible")) {

                //Check if there's at least one other legend selected to prevent empty chart
                $('#optionLegend li').each(function() {
                    if ($(this).hasClass("isvisible")) {
                        countVisible++;
                    }
                });

                if (countVisible > 1) {
                    $(".legend-"+id).children("i").removeClass("checked");
                    $(".legend-"+id).removeClass("isvisible");
                    $("#controlLegend").children(".legend-"+id).remove();
                    $(".legend-ALL").children("i").removeClass("checked");
                    $(".legend-ALL").removeClass("isvisible");
                }
            } else {
                countVisible = 2;
                $(".legend-"+id).children("i").addClass("checked");
                $(".legend-"+id).addClass("isvisible");
                $newlegend.appendTo("#controlLegend");
            }
        }
        if (countVisible > 1) {
            controlChart();
        }
    }

    function loadChart() {
        var data = {
            labels : chartLabels,
            datasets : initialReport
        };
        var steps = 5;
        var max = maxInitialReport;
        if (max < steps) {
            steps = max;
        }
        var options = {
            bezierCurve : false,
            scaleOverride: true,
            scaleSteps: steps,
            scaleStepWidth: Math.ceil(max / steps),
            scaleStartValue: 0
        };
        new Chart(ctx).Line(data, options);
    }

    function controlChart() {

        var datasets = new Array();
        var max = 0;
        var thisHighest = 0;
        $('#optionLegend li').each(function() {
            if ($(this).hasClass("isvisible")) {
                var reportType = $(this).attr('report');
                if (reportType) {
                    datasets.push(window[reportType]);
                    thisHighest = Math.max.apply(Math, window[reportType].data);
                    if (thisHighest > max) {
                        max = thisHighest;
                    }
                }
            }
        });

        var steps = 5;
        if (max < steps) {
            steps = max;
        }
        var options = {
            bezierCurve : false,
            scaleOverride: true,
            scaleSteps: steps,
            scaleStepWidth: Math.ceil(max / steps),
            scaleStartValue: 0
        };

        var data = {
            labels : chartLabels,
            datasets : datasets
        };
        new Chart(ctx).Line(data, options);

    }

    function deleteItem(pText, pId, pForm) {
        bootbox.confirm(pText, function(result) {
            if (result) {
                $("input[name='hiddenValue']").attr('value', pId);
                document.getElementById(pForm).submit();
            }
        });
    }

</script>
