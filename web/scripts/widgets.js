function serialize() {
    var listElement = $("#sortWidgets").sortable("toArray"),
        strContent = '{',
        i = 1;

    listElement.forEach(function (element) {
        strContent = strContent + '"' + i + '": { ';
        $("div #" + element).find('input').each(function () {
            strContent = strContent + '"' + this.name + '" : "' + this.value + '",';
        });
        strContent = strContent.replace(/,\s*$/, "");
        strContent = strContent + '},';
        i++;
    });
    strContent = strContent.replace(/,\s*$/, "");
    strContent = strContent + '}';

    $("#serializedPost").val(strContent);
}

function JS_widget_submit() {
    serialize();
    $('#form_widgets').find('[type="submit"]').trigger('click');
}

function resetSaveButton() {
    var btn = $('.action-save');
    btn.button('reset');
}

function widgetActionsAjax(url, type, data, contentType) {
    // Send the data using post
    if (contentType) {
        return $.ajax({
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: type
        });
    } else {
        return $.ajax({
            url: url,
            data: data,
            cache: false,
            processData: false,
            type: type
        });
    }
}

// Serialize form to array and stringify it if necessary
function serializeForm(form, stringify) {
    var serialized;

    if (stringify) {
        serialized = JSON.stringify($("#" + form).serializeArray());
    } else {
        serialized = $("#" + form).serializeArray();
    }

    return serialized;
}


function saveWidget(modal) {

    var serializedContent = "", serializedNavbar = "", serializedSocialLinks = "", customHtml = "",
        pageId = $('#pageId').val(), widgetId = $('#openWidgetId').val(), divId = $.widgetDivId,
        fileFav = document.getElementById('favIconInput') ? document.getElementById('favIconInput').files[0] : '',
        fileLogo = document.getElementById('logoImageInput') ? document.getElementById('logoImageInput').files[0] : '',
        fileImageSearch = document.getElementById('bgImageInput') ? document.getElementById('bgImageInput').files[0] : '',
        fileImageNewsletter = document.getElementById('bgImageNewsletterInput') ? document.getElementById('bgImageNewsletterInput').files[0] : '',
        fileImageLocation = document.getElementById('bgImageLocationInput') ? document.getElementById('bgImageLocationInput').files[0] : '',
        selectedDomainId = $('#selectedDomainId').val(),
        // REQUEST INFO
        url = "../../../includes/code/widgetActionAjax.php", data, request, type = "POST";

    if (modal == 'generic') {
        serializedContent = serializeForm('form_generic', true);
    } else if (modal == 'header' || modal == 'header-with-phone' || modal == 'header-with-social-media') {

        if (!isNavigationValid('form_navigation')) {
            return false;
        }

        serializedContent = serializeForm('form_header', false);
        serializedNavbar = serializeForm('form_navigation', true);
        serializedSocialLinks = serializeForm('form_social_header', true);
        $.each(serializeForm('datainfoDivHeader', false), function (index, obj) {
            serializedContent.push({name: obj.name, value: obj.value})
        });

        serializedContent = JSON.stringify(serializedContent);
    } else if (modal == 'footer' || modal == 'footer-with-social-media' || modal == 'footer-with-logo' || modal == 'footer-with-newsletter') {
        if (!isNavigationValid('form_navigation_footer')) {
            return false;
        }

        serializedContent = serializeForm('form_footer', false);
        serializedNavbar = serializeForm('form_navigation_footer', true);
        serializedSocialLinks = serializeForm('form_social', true);
        $.each(serializeForm('form_newsletter_footer', false), function (index, obj) {
            serializedContent.push({name: obj.name, value: obj.value})
        });
        $.each(serializeForm('datainfoDivFooter', false), function (index, obj) {
            serializedContent.push({name: obj.name, value: obj.value})
        });

        serializedContent = JSON.stringify(serializedContent);
    } else if (modal == 'downloadapp') {
        serializedContent = serializeForm('form_downloadapp', false);
        serializedContent.push({
            name: 'checkboxOpenWindow',
            value: $("#checkboxOpenWindow").is(':checked') ? '_blank' : ''
        });
        serializedContent = JSON.stringify(serializedContent);
    } else if (modal == 'search') {
        serializedContent = serializeForm('form_search', true);
    } else if (modal == 'newsletter') {
        serializedContent = serializeForm('form_newsletter', true);
    } else if (modal == 'location') {
        serializedContent = serializeForm('form_location', true);
    } else if (modal == 'contactform') {
        serializedContent = serializeForm('form_contactform', true);
    } else if (modal == 'customcontent') {
        serializedContent = serializeForm('form_customcontent', true);
        CKEDITOR.instances.customHtml.updateElement();
        customHtml = CKEDITOR.instances.customHtml.getData();
    } else if (modal == 'calendar') {
        serializedContent = serializeForm('form_calendar', true);
    }

    data = new FormData();
    data.append('favicon_file', fileFav);
    data.append('header_image', fileLogo);
    data.append('contentArr', serializedContent);
    data.append('navbarArr', serializedNavbar);
    data.append('modal', modal);
    data.append('socialLinks', serializedSocialLinks);
    data.append('background_image', fileImageSearch);
    data.append('background_image_newsletter', fileImageNewsletter);
    data.append('background_image_location', fileImageLocation);
    data.append('customHtml', customHtml);
    data.append('pageId', pageId);
    data.append('widgetId', widgetId);
    data.append('domain_id', selectedDomainId);

    request = widgetActionsAjax(url, type, data, true);

    request.done(function (data) {
        var objData = jQuery.parseJSON(data), rand = Math.floor((Math.random() * 10) + 1),
            msgSuccess = '', msgError = '', msgErrorAux = '', successAlert = $('#successAlert'),
            errorAlert = $('#errorAlert');

        if (objData.success) {
            msgSuccess = objData.message;
        }

        if (objData.favicon && objData.favicon.success) {
            $("#favIconImg").attr('src', objData.favicon.url);
        }

        if (objData.logoImage && objData.logoImage.success) {
            $("#logoImage").attr('src', objData.logoImage.url + '?' + rand).show();
        }

        if (objData.bgImage && objData.bgImage.success) {
            $("#bgImage").attr('src', objData.bgImage.url + '?' + rand).show();
        }

        if (objData.bgNewsletterImage && objData.bgNewsletterImage.success) {
            $("#bgImageNewsletter").attr('src', objData.bgNewsletterImage.url + '?' + rand).show();
        }
        if (objData.bgLocationImage && objData.bgLocationImage.success) {
            $("#bgImageLocation").attr('src', objData.bgLocationImage.url + '?' + rand).show();
        }

        if (objData.errorMessage) {
            msgError = '<ul><li>';
            msgErrorAux = objData.errorMessage.join('</li><li>');
            msgError = msgError + msgErrorAux + '</li></ul>';
            errorAlert.children('div').html(msgError).alert();
            errorAlert.fadeTo(3000, 500).slideUp(500, function () {
                errorAlert.slideUp(500);
            });
        }

        if (msgSuccess) {
            successAlert.children('div').html(msgSuccess).alert();
            successAlert.fadeTo(3000, 500).slideUp(500, function () {
                successAlert.slideUp(500);
            });
        }

        if (objData.isNewWidget && objData.newWidgetId) {
            $('#' + divId + ' #pageWidgetIdInput').val(objData.newWidgetId);
            $('#' + divId + ' .editWidgetButton').data('pagewidget', objData.newWidgetId);
        }

        $('#edit-widget-modal').modal('toggle');
    }).always(function () {
        resetSaveButton();
    });
}

/*
 * NAVIGATION JS
 */

function addListeners() {
    $('.removeNavItem').click(function () {
        var divId = $(this).data('id');
        $('#' + divId).remove();
    });
}

function resetNavigation(modal) {
    var url = "../../../includes/code/widgetNavigationAjax.php",
        selectedDomainId = $('#selectedDomainId').val(),
        type = "GET",
        data = "area=" + modal + "&reset=1" + "&domain_id=" + selectedDomainId;

    var request = widgetActionsAjax(url, type, data, false);

    request.done(function (data) {
        if (modal == 'header') {
            $('#sortableNav').html(data);
        } else {
            $('#sortableNavFooter').html(data);
        }
        addListeners();
    });
}

function isNavigationValid(form) {
    var error = false,
        formNavigation = $('#edit-widget-modal').find('#' + form);

    /** Validates empty labels */
    $.each(formNavigation.find('.navTitle'), function (i, item) {
        if ($(item).val() == '') {
            error = LANG_JS_NAVIGATION_LABEL_EMPTY;
        }
    });

    /** validates duplicated links */
    $.each(formNavigation.find("[id^=link_]"), function (i, item) {
        var link = $(item).val(),
            count = 0;

        jQuery.grep(formNavigation.find("[id^=link_]"), function (itemLink) {
            if (link == $(itemLink).val()) {
                count++;
                if (count > 1) {
                    error = LANG_JS_NAVIGATION_DUPLICATED_LINK;
                }
            }
        });
    });

    if (error) {
        var objModalDiv = $('#edit-widget-modal');

        /* Scroll to the top of modal */
        objModalDiv.animate({scrollTop: '0px'}, 500);

        /* reset the save button */
        setTimeout(function () {
            objModalDiv.find('.action-save').button('reset');
        }, 500);

        /* Show the error message */
        var messages = objModalDiv.find('div#messageAlertHeader');
        messages.find('div').text(error)
            .parent('div').addClass('alert-danger').show();

    }

    return !error;
}

/*
 * SLIDER JS
 */
$('#livemodeMessage').click(function (e) {
    e.preventDefault();

    livemodeMessage(true, false);
});

function hideSliderInfo() {
    $(".sliderInfo").hide();
}

function showSlideInfo(divId) {
    $("#sliderInfo" + divId).fadeIn();
}

function changeActiveSlide(divId) {
    $("#sortableSlider li").removeClass("active");
    $("#li" + divId).addClass("active");
}

function addListenersSlider() {
    $(document).find('.sliderImageButton').off('click');

    $(document).on('click', '.sliderImageButton', function () {
        var imageInput = $(this).data('imageinput');
        $('#slideImage' + imageInput).trigger('click');
    });

    $(document).on('blur', '.sliderLink', function () {
        var input = $(this),
            val = input.val();
        if (val && !val.match(/^http([s]?):\/\/.*/)) {
            input.val('http://' + val);
        }
    });

    $(document).on('click', '.removeSlide', function () {
        var deletedInput = $('#deletedSlides'),
            slideId = $(this).data('slideid'),
            itemDelete = $('#li' + slideId);

        if (deletedInput.val()) {
            deletedInput.val(deletedInput.val() + ',' + slideId);
        } else {
            deletedInput.val(slideId);
        }

        if (itemDelete.hasClass('active')) {
            if (itemDelete.prev() && itemDelete.prev().hasClass('slideLi')) {
                // Trigger click on the next item if exists
                $("#" + itemDelete.prev().attr('id') + " .click-area").trigger('click');
            } else if (itemDelete.next() && itemDelete.next().hasClass('slideLi')) {
                // Trigger click on the previous item if exists
                $("#" + itemDelete.next().attr('id') + " .click-area").trigger('click');
            }
        }

        itemDelete.remove();
        $('#sliderInfo' + slideId).remove();
        $('#sliderInfoDiv').find('#sliderInfo' + slideId).remove();

        var newSliderButton = $('.createSliderItem');
        if ($('#sortableSlider').find('li.slideLi').size() < newSliderButton.data('maxslides')) {
            newSliderButton.fadeIn('slow');
        }
    });
}

/*
 * ADD WIDGET TO PAGE JS
 */

$(document).ready(function () {
    $(document).ajaxStart(function () {
        $('#loading_ajax').fadeIn('fast');
    });

    $(document).ajaxStop(function () {
        $('#loading_ajax').fadeOut('fast');
    });
    //Initialize sortable
    $(function () {
        $(document).find("#sortWidgets").sortable(
            {
                update: function (event, ui) {
                    $("#changed").val(1);
                }
            }
        );
    });


    $(document).on("click", ".createItem", function () {
        var modal = $(this).data('modalaux'),
            url = "../../../includes/code/widgetNavigationAjax.php",
            selectedDomainId = $('#selectedDomainId').val(),
            type = "GET",
            data = "area=" + modal + "&domain_id=" + selectedDomainId;

        var request = widgetActionsAjax(url, type, data, false);
        request.done(function (data) {
            if (modal == 'header') {
                $('#sortableNav').append(data);
            } else {
                $('#sortableNavFooter').append(data);
            }
            addListeners();
        });
    });

    $(document).on('click', '.editNavItem', function () {
        var divId = $(this).data('id'),
            modal = $(this).data('modalaux'),
            labelObj = $('#navigation_text_' + divId),
            linkObj = $('#link_' + divId),
            customObj = $('#custom_' + divId),
            url;

        if (modal == 'footer') {
            url = '/includes/modals/widget/modal-widget-navigation-footer.php';
        } else {
            url = '/includes/modals/widget/modal-widget-navigation.php';
        }

        $('#edit-navigation-link-modal').show('modal').find('.modal-content').load(url, function () {
            $('#navLabel').val(labelObj.val());
            $('#divIdNav').val(divId);
            if (customObj.val() == 'n') {
                $('#navCustomLinkDiv').hide();
                $('#navLink').val(linkObj.val());
            } else {
                $('#navLink').val('custom');
                $('#navCustomLinkDiv').show();
            }
            $('#navCustomLink').val(linkObj.val());
            $('#edit-navigation-link-modal').modal({show: true});
        });
    });

    $(document).on('click', '.saveNavButton', function () {
        var modal = $(this).data('modalaux'),
            divId = $('#divIdNav').val(),
            labelObj = $('#navigation_text_' + divId),
            linkObj = $('#link_' + divId),
            customObj = $('#custom_' + divId),
            selectedOption = $('#navLink').val();

        /* Update inputs that will be used while saving the header modal */
        labelObj.val($('#navLabel').val());

        /* Update with the selected value of dropdown */
        customObj.val('n');
        linkObj.val(selectedOption);

        if (selectedOption == 'custom') {
            customObj.val('y');
            linkObj.val($('#navCustomLink').val());
        }

        $('#edit-navigation-link-modal').modal('hide');
        resetSaveButton();
    });

    $(document).on('change', '.navLink', function () {
        var modal = $(this).data('modalaux');
        $('#navCustomLink').val("");
        if ($(this).val() == 'custom') {
            $('#navCustomLinkDiv').slideDown();
        } else {
            $('#navCustomLinkDiv').slideUp();
        }
    });

    $(document).on('blur', '.navCustomLink', function () {
        var input = $(this),
            val = input.val();
        if (val && !val.match(/^http([s]?):\/\/.*/)) {
            input.val('http://' + val);
        }
    });

    var successSaved = $('#alert-save');

    successSaved.alert();
    successSaved.fadeTo(3000, 500).slideUp(500, function () {
        successSaved.slideUp(500);
    });

    /* Open modal add new widget */
    $('#add-new-widget-modal').on('hidden.bs.modal', function () {
        $(this).find('.modal-content').html('');
    });

    $(document).on('click', '.btn-new-widget', function (e) {
        e.preventDefault();

        $('#add-new-widget-modal').modal('show').find('.modal-content').load($('#new-widget').attr('href'), function () {
            var pageWidget = [];
            $('.edit-info').each(function (i) {
                pageWidget.push($(this).data('title'));
            });

            var listOfForbiddenWidgets = [];
            var widgetFound = [];
            $.each($.widgetDuplicated, function (group, widgets) {
                widgetFound = pageWidget.filter(function (el) {
                    return widgets.indexOf(el) != -1
                });

                if (widgetFound.length) {
                    $.merge(listOfForbiddenWidgets, widgets);
                }
            });

            $('.addWidget').each(function () {
                /* The variable $.widgetDuplicate was created in widget.php file */
                if ($.inArray($(this).data('title'), listOfForbiddenWidgets) >= 0) {
                    $(this).parent('div').remove();
                }
            });

            $('.tab-content').find('.tab-pane').each(function (i) {
                if ($(this).find('.row').children('.col-md-6').length == 0) {
                    var field = $(this).find('.row').children('.col-md-12');
                    field.removeClass('hide');
                }
            });
        });
    });

    $(document).on('click', '.addWidget', function (e) {
        e.preventDefault();

        var widgetId = $(this).data('widgetid');

        var modal = $(this).data('modalaux'),
            url = '../../../includes/code/widgetGetAjax.php',
            selectedDomainId = $('#selectedDomainId').val(),
            type = 'GET',
            data = 'widgetId=' + widgetId + "&domain_id=" + selectedDomainId;

        var request = widgetActionsAjax(url, type, data, false);
        request.done(function (data) {
            //to insert in a specific position
            if ($.widgetPosition !== undefined) {
                $.widgetPosition.before(data);
                delete $.widgetPosition;
            } else {
                //insert at the end of the page
                $('#sortWidgets').append(data);

                //Scroll page to the item added
                var height = $('.sortableDiv').get(0).scrollHeight;
                $('main').animate({scrollTop: height + 'px'}, 500);
            }

            $('#changed').val(1);
            $('#add-new-widget-modal').modal('hide');
        });
    });

    /*
     * Please always use the form id (in the modal file) this way:
     * "form_" + modalArr[1]
     * modalArr[1] will be always a reference to which modal is opened
     */
    $(document).on('click', '.editWidgetButton', function (e) {
        e.preventDefault();

        $.widgetDivId = $(this).data('divid');

        var modalFullName = $(this).data('modal'),
            divId = $(this).data('divid'),
            editInfo = $('#' + divId + ' .edit-info');

        // REQUEST INFO
        var modalArr = modalFullName.split('-'),
            pageWidgetId = editInfo.data('pagewidget') ? editInfo.data('pagewidget') : $('#' + divId + ' #pageWidgetIdInput').val(),
            widgetId = editInfo.data('widgetid'),
            selectedDomainId = $('#selectedDomainId').val(),
            url = "/includes/code/widgetActionAjax.php",
            data = "?pageWidgetId=" + pageWidgetId
                + "&modal=" + modalArr[1]
                + "&widgetId=" + widgetId
                + "&domain_id=" + selectedDomainId
                + "&modalFullName=" + modalFullName
                + "&action=edit";

        $('#edit-widget-modal').show('modal').load(url + data, function (result) {

            //Set data divdid on save button
            $('#edit-widget-modal .btn-primary').data('divid', divId);
            $('#edit-widget-modal').find('[id^=messageAlert]').removeClass('alert-danger').hide();

            $("#openWidgetId").val(widgetId);

            if (modalArr[1] == 'header') {
                $('span.page-title').text($('#type').val());
                addListeners();
            } else if (modalArr[1] == 'footer') {
                addListeners();
            } else if (modalArr[1] == 'slider') {
                $('#deletedSlides').val('');
                if ($("#sortableSlider").html()) {
                    var newSliderButton = $('.createSliderItem');
                    if ($('#sortableSlider').find('li.slideLi').size() >= newSliderButton.data('maxslides')) {
                        newSliderButton.fadeOut('slow');
                    }
                    addListenersSlider();
                }
            }
            //Initialize sortables
            $(function () {
                $(document).find("#sortableNav").sortable();
                $(document).find("#sortableNavFooter").sortable();
                $(document).find("#sortableSlider").sortable().disableSelection().on("click", ".click-area", function () {
                    var divId = $(this).data('divid');
                    changeActiveSlide(divId);
                    hideSliderInfo();
                    showSlideInfo(divId);
                });
            });
            $('#edit-widget-modal').modal({show: true});
        });
    });

    $(document).on('click', '.removeWidgetButton', function (e) {
        e.preventDefault();

        var divId = $(this).data('divid');
        var editInfo = $('#' + divId + ' .edit-info');
        var pageWidgetId = editInfo.data("pagewidget") ? editInfo.data("pagewidget") : null;

        $('#remove-widget-modal').find('.confirmRemoval').attr('onClick', 'removeWidget(' + divId + ', ' + pageWidgetId + ')');
    });

    $(document).on('click', '.logoImageButton', function () {
        $(this).parents('form').find('input[type="file"]').trigger('click');
    });

    $(document).on('click', '.favIconButton', function (e) {
        e.preventDefault();
        $('#favIconInput').trigger('click');
    });

    $(document).on('click', '.bgImageButton', function () {
        $('#bgImageInput').trigger('click');
    });

    $(document).on('click', '.bgImageNewsletterButton', function () {
        $('#bgImageNewsletterInput').trigger('click');
    });

    $(document).on('click', '.bgImageLocationButton', function () {
        $('#bgImageLocationInput').trigger('click');
    });

    $(document).on('click', '.bgImageCalendarButton', function () {
        $('#bgImageCalendarInput').trigger('click');
    });

    $(document).on('blur', '.sliderLink', function () {
        var input = $(this),
            val = input.val();
        if (val && !val.match(/^http([s]?):\/\/.*/)) {
            input.val('http://' + val);
        }
    });

    $(document).on('click', '#saveSliderWidget', function (e) {
        e.preventDefault();

        var serializedContent = serializeForm('form_slider', true),
            serializedSlider = serializeForm('form_slider_info', false),
            deletedSlides = $('#deletedSlides').val(),
            selectedDomainId = $('#selectedDomainId').val(),
            divId = $.widgetDivId,
            pageId = $('#pageId').val(),
            widgetId = $('#openWidgetId').val(),
            // REQUEST INFO
            data = new FormData(),
            url = "../../../includes/code/widgetActionAjax.php", request, type = "POST";

        // Labels Info
        data.append('contentArr', serializedContent);
        // Slide ids to be deleted
        data.append('deletedSlides', deletedSlides);

        data.append('domain_id', selectedDomainId);
        data.append('pageId', pageId);
        data.append('widgetId', widgetId);

        // Get Each slide info
        var sliders = [];
        var sliderForm = '';
        var sliderError = [];
        $.each(serializedSlider, function (index, slider) {
            sliderForm = 'form_sliderInfo' + slider.value;
            if ($('#' + sliderForm).find("input[name='imageId']").val() == '') {
                sliderError.push(LANG_JS_SLIDER_WITHOUT_IMAGE);
            }
            sliders[index] = serializeForm(sliderForm, false);
        });

        if (sliderError.length > 0) {
            var messages = $('#messageAlertSlider').html('');
            var displayedMessages = []

            $.each(sliderError, function (x, message) {
                if ($.inArray(message, displayedMessages) === -1) { // Prevents duplicated messages
                    messages.append($('<div>').addClass('alert alert-danger').html(message));
                    displayedMessages.push(message)
                }
            });

            messages.fadeIn('slow', function () {
                $(this).fadeTo(3000, 500).slideUp(500, function () {
                    messages.slideUp(500);
                });
            });

            // Restore buttons
            resetSaveButton();
            var newSliderButton = $('.createSliderItem');
            if ($('#sortableSlider').find('li.slideLi').size() < newSliderButton.data('maxslides')) {
                newSliderButton.fadeIn('slow');
            }

            return true;
        }

        data.append('sliderJson', JSON.stringify(sliders));

        request = widgetActionsAjax(url, type, data, true);

        request.done(function (data) {
            var objData = jQuery.parseJSON(data),
                msgSuccess = '', msgError = '', msgErrorAux = '', successAlert = $('#successAlert'),
                errorAlert = $('#errorAlert');

            if (objData.success) {
                msgSuccess = objData.message;
            }

            if (objData.errorMessage) {
                msgError = '<ul><li>'
                msgErrorAux = objData.errorMessage.join('</li><li>');
                msgError = msgError + msgErrorAux + '</li></ul>';
                errorAlert.children('div').html(msgError).alert();
                errorAlert.fadeTo(3000, 500).slideUp(500, function () {
                    errorAlert.slideUp(500);
                });
            }

            if (msgSuccess) {
                successAlert.children('div').html(msgSuccess).alert();
                successAlert.fadeTo(3000, 500).slideUp(500, function () {
                    successAlert.slideUp(500);
                });
            }

            if (objData.isNewWidget && objData.newWidgetId) {
                $('#' + divId + ' #pageWidgetIdInput').val(objData.newWidgetId);
                $('#' + divId + ' .editWidgetButton').data('pagewidget', objData.newWidgetId);
            }

            $('#edit-widget-modal').modal('toggle');
        }).always(function () {
            resetSaveButton();
        });
    });

    $(document).on('click', '.createSliderItem', function (e) {
        e.preventDefault();

        var maxSlides = $(this).data('maxslides');
        var totSlides = $('#sortableSlider').find('li.slideLi').size();

        if (totSlides < maxSlides) {
            var url = '../../../includes/code/widgetSliderAjax.php',
                selectedDomainId = $('#selectedDomainId').val(),
                type = 'GET',
                data = 'domain_id=' + selectedDomainId;

            var request = widgetActionsAjax(url, type, data, false);
            request.done(function (data) {
                var objData = jQuery.parseJSON(data);

                if (totSlides < maxSlides) {
                    $('.noSlidesAlert').hide();
                    $('#sortableSlider').append(objData.slider);
                    $('#sliderInfoDiv').append(objData.sliderInfo);
                    $('#li' + objData.newId + ' .click-area').trigger('click');

                    // Remove the button
                    if (totSlides + 1 >= maxSlides) {
                        $('.createSliderItem').fadeOut('slow');
                    }
                }
            });
        }
    });
});

//On click of the "plus" button to add a new widget
$(document).on('click', '.add-plus-circle-widget', function (e) {
    $.widgetPosition = $(this).parent('div');
});

function removeWidget(divId, pageWidgetId) {
    $('#' + divId).remove();

    var // REQUEST INFO
        url = '../../../includes/code/widgetActionAjax.php',
        selectedDomainId = $('#selectedDomainId').val(),
        data = 'pageWidgetId=' + pageWidgetId + '&removeWidget=1' + "&domain_id=" + selectedDomainId,
        type = "POST",
        request;

    request = widgetActionsAjax(url, type, data, false);

    request.done(function (data) {
        var objData = jQuery.parseJSON(data);

        if (objData.success) {
            var msgSuccess = objData.message, successAlert = $('#successAlert');

            $('#remove-widget-modal').modal('toggle');
            $('#remove-widget-modal .confirmRemoval').prop('onClick', null);

            if (msgSuccess) {
                successAlert.children('div').html(msgSuccess).alert();
                successAlert.fadeTo(3000, 500).slideUp(500, function () {
                    successAlert.slideUp(500);
                });
            }
        }
    });
}

$(document).on('click', '.linkWidget', function (e) {
    window.location.href = DEFAULT_URL + "/" + SITEMGR_ALIAS + "/promote/newsletter/";
});

$('.resetPageButton').on('click', function (e) {
    e.preventDefault();

    $('#modal-reset-page').modal('show');
});

$(document).on('click', '.confirmation-save', function (e) {
    e.preventDefault();

    $('<input>').attr({
        type: 'hidden',
        name: 'replica',
        id: 'replica',
        value: $(this).data('replica')
    }).appendTo('#form_widgets');

    JS_widget_submit();
});
