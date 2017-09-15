/*Tabindex Ordering*/
$(function() {
    var tabindex = 1;
    $('input, select, textarea, .btn, .content-item, .content-item-noview, a:link, .navbar-slide').each(function() {
        if (this.type != "hidden") {
            var $input = $(this);
            $input.attr("tabindex", tabindex);
            tabindex++;
        }
    });

    $('input, select, textarea').bind('invalid', function(e){
        btn = $('.action-save');
        btn.button('reset');
    });
});

/* Nano Scroller*/
if ($('.nano').length) {
    $(".nano").nanoScroller();
}

/*Control Navbar*/
$(".navbar-control").click( function() {
    $(".navbar-nav").toggleClass("show");
    $(".navbar-slide").toggleClass("show");
});

$(window).resize(function() {
    $(".navbar-nav").removeClass("show");
    $(".navbar-slide").removeClass("show");
});

$(".sidebar-control").click( function(){
    ControlSidebar();
});

/*Initialize date picker and selectize plugins*/
function initPlugins() {
    $(".date-input").datepicker({
        format: DATEPICKER_FORMAT,
        language: DATEPICKER_LANGUAGE,
        autoclose: true,
        todayHighlight: true
    });
    $('.selectize > select').selectize({
        sortField: null
    });
}

/*Update dashboard steps*/
function updateDashboard(option) {
    $('#step_'+option).addClass('checked');
    $('#icon_'+option).removeClass('icon-ion-ios7-circle-outline').addClass('icon-ion-ios7-checkmark-outline');
    $('#span_'+option).attr('data-original-title', $('#span_'+option).attr('data-auxtip'));
    $.post(DEFAULT_URL + "/" + SITEMGR_ALIAS + "/index.php", {
		completion: option
	}, function (ret) {
        if (ret == 'ok') {
            $('.dashincomplete').addClass('hidden');
            $('.dashcomplete').removeClass('hidden');
            setTimeout(function() {
                if ($('#welcome').length) {
                    location.reload();
                } else {
                    $('#completion').fadeOut('slow');
                }
            }, 4000);
        }
    });
}

/*Back Button*/
function BackHistory() {
    window.history.back();
}

/*Display alert in DEMO LIVE MODE*/
function livemodeMessage(close, message_id) {
    if (message_id) {
        $(".live_messages").css("display", "none");
        $("#message_"+message_id).css("display", "");
    }
    var aux_keyboard;
    var aux_backdrop;
    if (close) {
        aux_keyboard = true;
        aux_backdrop = true;
        $('#modal-back').css("display", "none");
    } else {
        aux_keyboard = false;
        aux_backdrop = 'static';
    }
    $('#modal-live').modal({
        keyboard: aux_keyboard,
        backdrop: aux_backdrop
    }).on('hidden.bs.modal', function (e) {
        btn = $('.action-save');
        btn.button('reset');
    });
}

/*Open modal for confirmation*/
function confirmBox(message, form_id) {
    $("#modal-confirm-form").val(form_id);
    $("#modal-confirm-message").html(message);
    $("#modal-confirm").modal({});
}

/*Change Label for promotions values*/
function changeLabelOpt1() {
    $("#option1").show();
    $("#option2").hide();

}
function changeLabelOpt2() {
    $("#option2").show();
    $("#option1").hide();
}

/*Control Sidebar*/
function ControlSidebar() {
    $("[class*='wrapper']").toggleClass("togglesidebar");
    $("#sidebar").toggleClass("togglepush");
    $("body").toggleClass("no-sidebar");
    var wW = $(window).width();
    if (wW <= 1200) {
         $('.wrapper').addClass('respSide');
    }
};

/* Nav Tabs on Responsive*/
$('.nav.nav-tabs').click( function(){
    var wW = $(window).width();
    if (wW <= 768) {
        $(this).toggleClass('open');
    }
});

/*Affix Preview on AppBuilder */
/*Keep preview image always visible when scroll*/
$('.appbuilder-wrap').scroll(function() {
    var scroll = $(this).scrollTop();
    if ( scroll > 510 ) {
        $('#custompageform .cover-preview-image').addClass('affix');
    } else {
        $('#custompageform .cover-preview-image').removeClass('affix');
    }
});


/*Dashboard scroll control*/
$('.wrapper-dashboard').scroll(function() {
    var scroll = $(this).scrollTop();
    if ( scroll > 450 ) {
        $('.timeline-control').addClass('tmlaffix');
        $('.timeline').addClass('tml-tmlaffix');
    } else {
        $('.timeline-control').removeClass('tmlaffix');
        $('.timeline').removeClass('tml-tmlaffix');
    }
});

/* Wrapper Control */
// $('.wrapper').click( function(){
//     var wW = $(window).width();

//     if (wW <= 1200 && !$(this).hasClass('respSide')) {
//         ControlSidebar();
//         $(this).addClass('respSide');
//     };
// });

/*Bulk Update*/
$("#check-all").click(function(){
    $("#search-all").toggleClass("hidden");
    $("#bulkupdate").toggleClass("hidden");
    $("#uncheck-all").prop("checked", true);
    $(".check-bulk input").prop("checked", true);
    bulkSelect($("#bulkListType").val());
});

$("#uncheck-all").click(function(){
    $("#search-all").toggleClass("hidden");
    $("#bulkupdate").toggleClass("hidden");
    $("#check-all").prop("checked", false);
    $(".check-bulk input").prop("checked", false);
    bulkSelect($("#bulkListType").val());
});

$("#check-all-terms").click(function(){
    $(".check-bulk input").prop("checked", $(this).is( ":checked" ));
    $("#deleteAllButton").toggleClass("hidden");
    bulkSelect($("#bulkListType").val());
});

$( ".check-bulk input[type='checkbox']" ).click( function() {
      $(".check-bulk input").each( function() {
            if ( $(this).is( ":checked" ) ) {
                $("#search-all").addClass("hidden");
                $("#bulkupdate").removeClass("hidden");
                $("#uncheck-all").prop("checked", true);
                return false;
            } else {
                $("#search-all").removeClass("hidden");
                $("#bulkupdate").addClass("hidden");
            }
      });
});

/* Manage content*/
/*Change Values on VIEW a item from Manage Content*/
//////////////////////////////////////////////////////////////////
$(".content-item .item").click( function() {
    var item = $(this).parent();
    $(".content-item").removeClass('active');
    item.addClass('active');
    openView(item.attr("data-id"));
    $(".list-content").addClass('smart-content-view');
    var wW = $(window).width();
    var wH = $(window).height();
    var ptop = $(this).offset().top;
    var scroll = $('.list-content').scrollTop();
    if (wW <= 1200) {
        if (scroll !== 0) {
            // $('.view-content.show').css('bottom', -scroll).css('top', scroll);
            // $('.view-content-info').css('top', '1em');
            // $('.control-view').css('top', 20 + scroll);
            // $('.view-item').css('top', 60 + scroll).css('height', wH - 180);
        };
    };

});
$(".content-item .item").focus( function() {
    var item = $(this);
    $(".content-item").removeClass('active');
    item.addClass('active');
    openView(item.attr("data-id"));
});
$('.check-bulk input[type=checkbox]').click(function (e) {
    e.stopPropagation();
});
$('.check-bulk').on('click', function(){
   var checkbox = $(this).children('input[type="checkbox"]');
   checkbox.prop('checked', !checkbox.prop('checked'));
});

/*Manage Tree Content*/
$(".tree-control").click( function(){
    var content = $(this).parent();

    $(this).children(".btn").toggleClass("active");

    content.toggleClass("selected").parent().find(".tree-child").each( function(){
            $(this).toggleClass("open");
            return false;
    });
});

/* Pagination Sorting*/
$("#mainOrdering .option-dropup").click(function () {
    var labeling = $(this).text();
    var target = $(this).data("target");

    if (target == "#paginationSorting") {
        $("#paginationSorting").removeClass("hidden");
        $("#paginationDisplaying").addClass("hidden");
    } else {
        $("#paginationDisplaying").removeClass("hidden");
        $("#paginationSorting").addClass("hidden");
    }
    $("#mainOrdering .label-dropup").text(labeling);
});

$(".group-ordering .option-dropup").click( function(){
    var labeling = $(this).text();
    var group = $(this).parent().data("group");

    if (group == "#paginationSorting") {
        $("#paginationSorting .label-dropup").text(labeling);
    } else {
       $("#paginationDisplaying .label-dropup").text(labeling);
    }

});

/*Manage content - Open view*/
function openView(id) {
    $(".view-content-info").css("display", "none");
    $("#view-content-info-"+id).css("display", "");
    $(".view-content").addClass("show");
    $(".list-content").addClass("divided");
    if ($('#item-info-ajax-'+id).length) {
        var ajaxURL = $('#item-info-ajax-'+id).attr("data-ajax-url") + '?id=' + id;
        $.post(ajaxURL, {}, function (ret) {
            $('#item-info-ajax-'+id).html(ret);
        });
    }
}

/*Manage content - Close view*/
function closeView() {
    $(".view-content").removeClass("show");
    $(".view-content-info").css("display", "none");
	$(".list-content").removeClass("divided");
    $(".content-item").removeClass('active');
    $(".list-content").removeClass('smart-content-view');
}

/*Add Module - Select level*/
function selectLevel(obj, level) {
	$(".footer-action").addClass("hidden");
	$(".levelSelect").removeClass("active");
	$(".levelSelect button").removeClass("active");
	$(".levelSelect button").html( window.defaultButtonLabel );
    obj.toggleClass("active");
    obj.html( window.selectedButtonLabel );
    obj.parent().toggleClass("active");

    if ($('#listingtemplate_feature').val() == "yes") {
        $(".type-choice").removeClass("hidden");
        $position_id = '.type-choice';
    } else {
        $(".footer-action").removeClass("hidden");
        $position_id = '.btn-success';
    }
    $('#level').attr('value', level);
    $('.wrapper').animate({scrollTop: $($position_id).offset().top}, 'slow');
}

/*Add Listing - Select listing type*/
function selectType(obj, type) {
    $(".typeSelect").removeClass("active");
	$(".typeSelect button").removeClass("active");
	$(".typeSelect button").html( window.defaultButtonLabel );
    obj.toggleClass("active");
    obj.html( window.selectedButtonLabel );
    obj.parent().toggleClass("active");
    $(".footer-action").removeClass("hidden");
    $('#listingtemplate_id').attr('value', type);
    $('.wrapper').animate({scrollTop: $(".btn-success").offset().top}, 'slow');
}

/*Delete Badge*/
function deleteBadge(id, msg) {
    bootbox.confirm(msg, function(result) {
        if (result) {
            $('#delete_id').attr('value', id);
            document.badges.submit();
        }
    });
}

/*Save/Edit page*/
// [name] is the name of the event "click", "mouseover", ..
// same as you'd pass it to bind()
// [fn] is the handler function
$.fn.bindFirst = function(name, fn) {
    // bind as you normally would
    // don't want to miss out on any jQuery magic
    this.on(name, fn);

    // Thanks to a comment by @Martin, adding support for
    // namespaced events too.
    this.each(function() {
        var handlers = $._data(this, 'events')[name.split('.')[0]];
        // take out the handler we just inserted from the end
        var handler = handlers.pop();
        // move it at the beginning
        handlers.splice(0, 0, handler);
    });
};

$(".action-save").bindFirst('click', function () {
    $(this).button('loading');
});

/*Manage content - Close view*/
$(".close-view").click( function() {
	closeView();
});

/******************************************************/

/*External Plugins*/

/******************************************************/

/*Tooltip*/
$('.progress-bar, .form-tip, .btn-tip, #iconHelp, .panel-stats, .tml-nav ul li a, #navAppbuilder span a, .tipcomplete, .table-help i, .text-center i').tooltip();
/*End Tooltip*/

/*File Input*/
$(".file-noinput").filestyle({
	input: false,
	buttonText: LANG_JS_ADDFILE,
	buttonName: "btn-primary",
	size: "sm",
	iconName: "glyphicon-plus"
});
$(".file-withinput").filestyle({
    input: true,
    buttonText: LANG_JS_ADDFILE,
    buttonName: "btn-primary",
    size: "sm",
    iconName: "glyphicon-plus"
});
/*End File Input*/

/*Date picker*/
$(".date-input").datepicker({
    format: DATEPICKER_FORMAT,
    language: DATEPICKER_LANGUAGE,
    autoclose: true,
    todayHighlight: true
});
/*End Date picker*/

/*Time Picker*/
$(".time-input").timepicker();
/*End Time Picker*/

/*Selectize*/
$('.input-dd-form-settings, #opt_timezone, #default_search_option, .selectize > select, .status-select').selectize({
//    sortField: null
});
/*End Selectize*/

/*Keyword inputs*/
$(".tag-input").selectize({
    plugins: ['remove_button'],
    delimiter: ',',
    persist: false,
    maxItems: 10,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    },
    render: {
        option_create: function(data, escape) {
            return '<div class="create">' + LANG_JS_ADDKEYWORD + ' <strong>' + escape(data.input) + '</strong>&hellip;</div>';
        }
    }
});
/*End Keyword inputs*/

/* ColColorpick----------------*/
if ($('.color-box').length) {
    $('.color-box').colpick({
        colorScheme: 'light',
        layout: 'hex',
        submit: 0,
        onChange: function (hsb, hex, rgb, el) {
            $(el).css('background-color', '#' + hex);
            $('#' + $(el).attr("data-id")).attr('value', hex);
        }
    }).click(function () {
        var rgb = this.style.backgroundColor;

        rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        function hex(x) {
            return ("0" + parseInt(x).toString(16)).slice(-2);
        }

        var hex = "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);

        $(this).colpickSetColor(hex);
    });
}
/* End ColColorpick----------------*/

/* List.js------------------------------*/
if ($('.title-list').length) {
    var options = {
        valueNames: [ 'title-list', 'item-feature' ]
    };
    var contentList = new List('view-content-list', options);
}
/* End List.js------------------------------*/

if ($('.textarea-counter').length) {
    $('.textarea-counter').each(function() {
        var options = {
            'maxCharacterSize': $(this).attr('data-chars'),
            'displayFormat' : '<p class="help-block text-right">#left ' + $(this).attr('data-msg') +'</p>'
        };
        $(this).textareaCount(options);
    });

}

/*Dashboard - Timeline Scroll*/
$(document).ready(function() {

    if ($('#timeline_total_pages').val() > 0) {
        $('.timelinescroll').jscroll({
            nextSelector: '#t-next',
            autoTrigger: true,
            autoTriggerUntil: $('#timeline_total_pages').val(),
            loadingHtml: '<div class="text-center"><img src=" ' + DEFAULT_URL + '/' + SITEMGR_ALIAS + '/assets/img/preloader-32.gif" alt="Loading" /> ' + LANG_JS_LOADING + '</div>',
            padding:10
        });
    }

    if (typeof aux_force_showModal != "undefined") {
        if (aux_force_showModal) {
            $('#aux-ed-modal').modal('show');
        }
    }
});

/* Blocking negative values in radius fields */
function radiusValiding(field, clean) {
    var txt = '';
    if (! field.validity.valid) {
        $('.radiusError').fadeIn('fast');
        txt = field.getAttribute('data-error');
        if (clean === true) field.value = '';
    } else {
        $('.radiusError').fadeOut('fast');
    }

    $('.radiusError').text(txt);
}

