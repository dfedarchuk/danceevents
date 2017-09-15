/**
 * jQuery Form Builder Plugin
 * Copyright (c) 2009 Mike Botsko, Botsko.net LLC (http://www.botsko.net)
 * http://www.botsko.net/blog/2009/04/jquery-form-builder-plugin/
 * Originally designed for AspenMSM, a CMS product from Trellis Development
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * Copyright notice and license must remain intact for legal use
 */
(function ($) {
        $.fn.formbuilder = function (options) {
                // Extend the configuration options with user-provided
                var defaults = {
                        save_url: false,
                        load_url: false,
                        control_box_target: false,
                        serialize_prefix: 'frmb',
                        css_ol_sortable_class : 'ol_opt_sortable',
                        messages: {
                                save                            : LANG_LEAD_SAVE,
                                preview                         : LANG_LEAD_PREVIEW,
                                add_new_field                   : LANG_LEAD_ADD_FIELD,
                                text                            : LANG_LEAD_TEXT,
                                title                           : LANG_LEAD_TITLE,
                                paragraph                       : LANG_LEAD_PARAGRAPH,
                                checkboxes                      : LANG_LEAD_CHECKBOXES,
                                radio                           : LANG_LEAD_RADIO,
                                select                          : LANG_LEAD_SELECTLIST,
                                text_field                      : LANG_LEAD_TEXT_FIELD,
                                label                           : LANG_LEAD_LABEL,
                                paragraph_field                 : LANG_LEAD_PARAGRAPH_FIELD,
                                select_options                  : LANG_LEAD_SELECT_OPTIONS,
                                add                             : LANG_LEAD_ADD,
                                checkbox_group                  : LANG_LEAD_CHECKBOX_GROUP,
                                remove_message                  : LANG_LEAD_CONFIRM_REMOVE,
                                remove                          : LANG_LEAD_REMOVE,
                                radio_group                     : LANG_LEAD_RADIO_GROUP,
                                selections_message              : LANG_LEAD_MULT_SELECT,
                                hide                            : LANG_LEAD_HIDE,
                                required                        : LANG_LEAD_REQUIRED,
                                show                            : LANG_LEAD_SHOW
                        }
                };
                var opts = $.extend(defaults, options);
                var frmb_id = 'frmb-' + $('ul[id^=frmb-]').length++;
                return this.each(function () {
                        var ul_obj = $(this).append('<br><ul id="' + frmb_id + '" class="frmb list-unstyled"></ul>').find('ul');
                        var field = '', field_type = '', last_id = 1, help, form_db_id;
                        // Add a unique class to the current element
                        $(ul_obj).addClass(frmb_id);
                        // load existing form data
                        if (opts.load_url) {
                                $.getJSON(opts.load_url, function(json) {
                                        form_db_id = json.form_id;
                                        fromJson(json.form_structure);
                                });
                        }
                        // Create form control select box and add into the editor
                        var controlBox = function (target) {
                                        var select = '';
                                        var box_content = '';
                                        var box_content_bottom = '';
                                        var save_button = '';
                                        var preview_button = '';
                                        var box_id = frmb_id + '-control-box';
                                        var box_id_bottom = frmb_id + '-control-box-bottom';
                                        var save_id = frmb_id + '-save-button';
                                        var preview_id = frmb_id + '-preview-button';
                                        var div_options = '';
                                        // Add the available options
                                        select += '<option value="0">' + opts.messages.add_new_field + '</option>';
                                        select += '<option value="input_text">' + opts.messages.text + '</option>';
                                        select += '<option value="textarea">' + opts.messages.paragraph + '</option>';
                                        select += '<option value="checkbox">' + opts.messages.checkboxes + '</option>';
                                        select += '<option value="radio">' + opts.messages.radio + '</option>';
                                        select += '<option value="select">' + opts.messages.select + '</option>';
                                        // Build the control box and search button content
                                        box_content = '<div class="row"><div class="col-sm-4"><select id="' + box_id + '" class="frmb-control form-control">' + select + '</select></div></div>';
                                        box_content_bottom = '<div class="col-sm-4"><select id="' + box_id_bottom + '" class="frmb-control  form-control">' + select + '</select></div>';
                                        preview_button = '<input type="button" id="' + preview_id + '" class="frmb-submit  btn btn-default" value="' + opts.messages.preview + '"/>';
                                        save_button = '<input type="submit" id="' + save_id + '" class="frmb-submit btn btn-primary" value="' + opts.messages.save + '"/> ';
                                        // Insert the control box into page
                                        if (!target) {
                                                $(ul_obj).before(box_content);
                                        } else {
                                                $(target).append(box_content);
                                        }
                                        div_options = '<div id="div_options" style="display:none"><div class="row">' + box_content_bottom + '</div><br><div class="row"><div class="col-sm-12">' + /*save_button + preview_button + */'</div></div></div>';
//                                        //Add select again
//                                        $(ul_obj).after(box_content);
//                                        // Insert the search button
//                                        $(ul_obj).after(save_button);
//                                        // Insert the preview button
//                                        $(ul_obj).after(preview_button);
                                        $(ul_obj).after(div_options);
                                        // Set the form save action
                                        $('#' + save_id).click(function () {
                                                save(true);
                                                return false;
                                        });
                                        // Set the form preview action
                                        $('#' + preview_id).click(function () {
                                                if ($("#livemode").val() == 1) {
                                                    livemodeMessage(true, false);
                                                } else {
                                                    save(false);
                                                    window.open($("#domain_url").val(), "_blank");
                                                    return false;
                                                }
                                        });
                                        // Add a callback to the select element
                                        $('#' + box_id + ', #' + box_id_bottom).change(function () {
                                                appendNewField($(this).val());
                                                $(this).val(0).blur();
                                                // This solves the scrollTo dependency
                                                $('html, body').animate({
                                                        scrollTop: $('#frm-' + (last_id - 1) + '-item').offset().top
                                                }, 500);
                                                return false;
                                        });
                                }(opts.control_box_target);
                        // Json parser to build the form builder
                        var fromJson = function (json) {
                                        var values = '';
                                        var options = false;
                                        // Parse json
                                        if (json) {
                                            $("#div_options").css("display", "");
                                            $(json).each(function () {
                                                // checkbox type
                                                if (this.cssClass === 'checkbox') {
                                                        options = [this.title];
                                                        values = [];
                                                        $.each(this.values, function () {
                                                                values.push([this.value, this.baseline]);
                                                        });
                                                }
                                                // radio type
                                                else if (this.cssClass === 'radio') {
                                                        options = [this.title];
                                                        values = [];
                                                        $.each(this.values, function () {
                                                                values.push([this.value, this.baseline]);
                                                        });
                                                }
                                                // select type
                                                else if (this.cssClass === 'select') {
                                                        options = [this.title, this.multiple];
                                                        values = [];
                                                        $.each(this.values, function () {
                                                                values.push([this.value, this.baseline]);
                                                        });
                                                }
                                                else {
                                                        values = [this.values];
                                                }
                                                appendNewField(this.cssClass, values, options, this.required);
                                            });
                                        } else {
                                            $("#div_options").css("display", "none");
                                        }
                                        
                                };
                        // Wrapper for adding a new field
                        var appendNewField = function (type, values, options, required) {
                                        $("#div_options").css("display", "");
                                        field = '';
                                        field_type = type;
                                        if (typeof (values) === 'undefined') {
                                                values = '';
                                        }
                                        switch (type) {
                                        case 'input_text':
                                                appendTextInput(values, required);
                                                break;
                                        case 'textarea':
                                                appendTextarea(values, required);
                                                break;
                                        case 'checkbox':
                                                appendCheckboxGroup(values, options, required);
                                                break;
                                        case 'radio':
                                                appendRadioGroup(values, options, required);
                                                break;
                                        case 'select':
                                                appendSelectList(values, options, required);
                                                break;
                                        }
                                };
                        // single line input type="text"
                        var appendTextInput = function (values, required) {
                                        field += '<label>' + opts.messages.label + '</label>';
                                        field += '<input class="fld-title form-control" id="title-' + last_id + '" type="text" value="' + values + '" />';
                                        help = '';
                                        appendFieldLi(opts.messages.text, field, required, help);
                                };
                        // multi-line textarea
                        var appendTextarea = function (values, required) {
                                        field += '<label>' + opts.messages.label + '</label>';
                                        field += '<input class="form-control" type="text" value="' + values + '" />';
                                        help = '';
                                        appendFieldLi(opts.messages.paragraph_field, field, required, help);
                                };
                        // adds a checkbox element
                        var appendCheckboxGroup = function (values, options, required) {
                                        var title = '';
                                        if (typeof (options) === 'object') {
                                                title = options[0];
                                        }
                                        field += '<div class="chk_group">';
                                        field += '<div class="frm-fld"><label>' + opts.messages.title + '</label>';
                                        field += '<input class="form-control" type="text" name="title" value="' + title + '" /></div>';
                                        field += '<br><div class="false-label form-group">' + opts.messages.select_options + '</div>';
                                        field += '<div class="fields">';

                                        field += '<div><ol class="' + opts.css_ol_sortable_class + '">';

                                        if (typeof (values) === 'object') {
                                                for (i = 0; i < values.length; i++) {
                                                        field += checkboxFieldHtml(values[i]);
                                                }
                                        }
                                        else {
                                                field += checkboxFieldHtml('');
                                        }

                                        field += '<div class="add-area"><a href="#" class="add add_ck">' + opts.messages.add + '</a></div>';
                                        field += '</ol></div>';
                                        field += '</div>';
                                        field += '</div>';
                                        help = '';
                                        appendFieldLi(opts.messages.checkbox_group, field, required, help);

                                        $('.'+ opts.css_ol_sortable_class).sortable(); // making the dynamically added option fields sortable.
                                };
                        // Checkbox field html, since there may be multiple
                        var checkboxFieldHtml = function (values) {
                                        var checked = false;
                                        var value = '';
                                        if (typeof (values) === 'object') {
                                                value = values[0];
                                                checked = ( values[1] === 'false' || values[1] === 'undefined' ) ? false : true;
                                        }
                                        field = '<li>';
                                        field += '<div class="row">';
                                        field += '<div class="col-sm-6"><input type="checkbox"' + (checked ? ' checked="checked"' : '') + ' />';
                                        field += '<input class="form-control" type="text" value="' + value + '" /></div>';
                                        field += '<div class="col-sm-6"><a href="#" class="remove" title="' + opts.messages.remove_message + '">' + opts.messages.remove + '</a></div>';
                                        field += '</div></li><br>';
                                        return field;
                                };
                        // adds a radio element
                        var appendRadioGroup = function (values, options, required) {
                                        var title = '';
                                        if (typeof (options) === 'object') {
                                                title = options[0];
                                        }
                                        field += '<div class="rd_group">';
                                        field += '<div class="frm-fld"><label>' + opts.messages.title + '</label>';
                                        field += '<input class="form-control" type="text" name="title" value="' + title + '" /></div>';
                                        field += '<br><div class="false-label form-group">' + opts.messages.select_options + '</div>';
                                        field += '<div class="fields">';

                                        field += '<div><ol class="' + opts.css_ol_sortable_class + '">';

                                        if (typeof (values) === 'object') {
                                                for (i = 0; i < values.length; i++) {
                                                        field += radioFieldHtml(values[i], 'frm-' + last_id + '-fld');
                                                }
                                        }
                                        else {
                                                field += radioFieldHtml('', 'frm-' + last_id + '-fld');
                                        }

                                        field += '<div class="add-area"><a href="#" class="add add_rd">' + opts.messages.add + '</a></div>';
                                        field += '</ol></div>';
                                        field += '</div>';
                                        field += '</div>';
                                        help = '';
                                        appendFieldLi(opts.messages.radio_group, field, required, help);

                                        $('.'+ opts.css_ol_sortable_class).sortable(); // making the dynamically added option fields sortable. 
                                };
                        // Radio field html, since there may be multiple
                        var radioFieldHtml = function (values, name) {
                                        var checked = false;
                                        var value = '';
                                        if (typeof (values) === 'object') {
                                                value = values[0];
                                                checked = ( values[1] === 'false' || values[1] === 'undefined' ) ? false : true;
                                        }
                                        field = '<li>'; 
                                        field += '<div class="row"><div class="col-sm-6">';
                                        if (name) {
                                            field += '<input type="radio"' + (checked ? ' checked="checked"' : '') + ' name="radio_' + name + '" />';
                                        }
                                        field += '<input class="form-control" type="text" value="' + value + '" /></div>';
                                        field += '<div class="col-sm-6"><a href="#" class="remove" title="' + opts.messages.remove_message + '">' + opts.messages.remove + '</a></div>';
                                        field += '</div></li><br>';

                                        return field;
                                };
                        // adds a select/option element
                        var appendSelectList = function (values, options, required) {
                                        var multiple = false;
                                        var title = '';
                                        if (typeof (options) === 'object') {
                                                title = options[0];
                                                multiple = options[1] === 'true' || options[1] === 'checked' ? true : false;
                                        }
                                        field += '<div class="opt_group">';
                                        field += '<div class="frm-fld"><label>' + opts.messages.title + '</label>';
                                        field += '<input class="form-control" type="text" name="title" value="' + title + '" /></div>';
                                        field += '';
                                        field += '<br><div class="false-label form-group">' + opts.messages.select_options + '</div>';
                                        field += '<div class="fields">';
                                        //field += '<input type="checkbox" name="multiple"' + (multiple ? 'checked="checked"' : '') + '>';
                                        //field += '<label class="auto">' + opts.messages.selections_message + '</label>';

                                        field += '<div><ol class="' + opts.css_ol_sortable_class + '">';

                                                if (typeof (values) === 'object') {
                                                        for (i = 0; i < values.length; i++) {
                                                                field += selectFieldHtml(values[i], multiple);
                                                        }
                                                }
                                                else {
                                                        field += selectFieldHtml('', multiple);
                                                }

                                        field += '<div class="add-area"><a href="#" class="add add_opt">' + opts.messages.add + '</a></div>';
                                        field += '</ol></div>';
                                        field += '</div>';
                                        field += '</div>';
                                        help = '';
                                        appendFieldLi(opts.messages.select, field, required, help);

                                        $('.'+ opts.css_ol_sortable_class).sortable(); // making the dynamically added option fields sortable.  
                                };
                        // Select field html, since there may be multiple
                        var selectFieldHtml = function (values, multiple) {
                                        if (multiple) {
                                                return checkboxFieldHtml(values);
                                        }
                                        else {
                                                return radioFieldHtml(values);
                                        }
                                };
                        // Appends the new field markup to the editor
                        var appendFieldLi = function (title, field_html, required, help) {
                                        if (required) {
                                                required = (required === 'checked' || required === 'true' ? true : false);
                                        }

                                        var li = '';
                                        li += '<br><li id="frm-' + last_id + '-item" class="' + field_type + '">';
                                        li += '<div class="panel panel-default"><div class="legend panel-heading">';
                                        li += '<a id="del_' + last_id + '" class="del-button delete-confirm pull-right text-warning" href="#" title="' + opts.messages.remove_message + '"><span>' + '<i class="icon-waste2"></i>' + '</span></a>';
                                        //li += ' <a id="frm-' + last_id + '" class="toggle-form pull-right" href="#">' + opts.messages.hide + '</a> ';
                                        li += '<i class="icon-uniE605 pull-left"></i> <span id="txt-title-' + last_id + '">' + title + '</span></div>';
                                        li += '<div id="frm-' + last_id + '-fld" class="frm-holder panel-body">';
                                        li += '<div class="frm-elements form-group">';
                                        li += '<div class="frm-fld checkbox"><label for="required-' + last_id + '">';
                                        li += '<input class="required" type="checkbox" value="1" name="required-' + last_id + '" id="required-' + last_id + '"' + (required ? ' checked="checked"' : '') + '>' +  opts.messages.required + '</label></div>';
                                        li += field;
                                        li += '</div></div>';
                                        li += '</div>';
                                        li += '</li>';
                                        $(ul_obj).append(li);
                                        $('#frm-' + last_id + '-item').hide();
                                        $('#frm-' + last_id + '-item').animate({
                                                opacity: 'show',
                                                height: 'show'
                                        }, 'slow');
                                        last_id++;
                                };
                        // handle field delete links
                        $('.frmb').delegate('.remove', 'click', function () {
                                $(this).parent('div').parent('div').animate({
                                        opacity: 'hide',
                                        height: 'hide',
                                        marginBottom: '0px'
                                }, 'fast', function () {
                                        $(this).remove();
                                });
                                return false;
                        });
                        // handle field display/hide
                        $('.frmb').delegate('.toggle-form', 'click', function () {
                                var target = $(this).attr("id");
                                if ($(this).html() === opts.messages.hide) {
                                        $(this).removeClass('open').addClass('closed').html(opts.messages.show);
                                        $('#' + target + '-fld').animate({
                                                opacity: 'hide',
                                                height: 'hide'
                                        }, 'slow');
                                        return false;
                                }
                                if ($(this).html() === opts.messages.show) {
                                        $(this).removeClass('closed').addClass('open').html(opts.messages.hide);
                                        $('#' + target + '-fld').animate({
                                                opacity: 'show',
                                                height: 'show'
                                        }, 'slow');
                                        return false;
                                }
                                return false;
                        });
                        // handle delete confirmation
                        $('.frmb').delegate('.delete-confirm', 'click', function () {
                                var delete_id = $(this).attr("id").replace(/del_/, '');
                                
                                bootbox.confirm($(this).attr('title'), function(result) {
                                    if (result) {
                                        $('#frm-' + delete_id + '-item').animate({
                                                opacity: 'hide',
                                                height: 'hide',
                                                marginBottom: '0px'
                                        }, 'slow', function () {
                                                $(this).remove();
                                        });
                                    }
                                });

                                return false;
                        });
                        // Attach a callback to add new checkboxes
                        $('.frmb').delegate('.add_ck', 'click', function () {
                                $(this).parent().before(checkboxFieldHtml());
                                return false;
                        });
                        // Attach a callback to add new options
                        $('.frmb').delegate('.add_opt', 'click', function () {
                                $(this).parent().before(selectFieldHtml('', false));
                                return false;
                        });
                        // Attach a callback to add new radio fields
                        $('.frmb').delegate('.add_rd', 'click', function () {
                                $(this).parent().before(radioFieldHtml(false, $(this).parents('.frm-holder').attr('id')));
                                return false;
                        });
                        // saves the serialized data to the server
                        var save = function (showMessage) {
                                        if (opts.save_url) {
                                            
                                                if ($("#livemode").val() == 1) {
                                                    livemodeMessage(true, false);
                                                } else {
                                                    $.ajax({
                                                            type: "POST",
                                                            url: opts.save_url,
                                                            data: $(ul_obj).serializeFormList({
                                                                    prepend: opts.serialize_prefix
                                                            }) + "&form_id=" + form_db_id,
                                                            success: function () {
                                                                var successAlert = $('#successAlert');
                                                                if(opts.modal_name) {
                                                                    successAlert.children('div').html(opts.msg_success).alert();
                                                                    successAlert.fadeTo(3000, 500).slideUp(500, function () {
                                                                        successAlert.slideUp(500);
                                                                    });
                                                                    saveWidget('contactform');
                                                                } else {
                                                                    if (showMessage) {
                                                                        $("#successMessage").css("display", "");
                                                                        $('html, body').animate({
                                                                            scrollTop: $('.heading').offset().top
                                                                        }, 500);
                                                                    }
                                                                }
                                                            }
                                                    });
                                                }
                                        }
                                };
                });
        };
})(jQuery);
/**
 * jQuery Form Builder List Serialization Plugin
 * Copyright (c) 2009 Mike Botsko, Botsko.net LLC (http://www.botsko.net)
 * Originally designed for AspenMSM, a CMS product from Trellis Development
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * Copyright notice and license must remain intact for legal use
 * Modified from the serialize list plugin
 * http://www.botsko.net/blog/2009/01/jquery_serialize_list_plugin/
 */
(function ($) {
        $.fn.serializeFormList = function (options) {
                // Extend the configuration options with user-provided
                var defaults = {
                        prepend: 'ul',
                        is_child: false,
                        attributes: ['class']
                };
                var opts = $.extend(defaults, options);
                if (!opts.is_child) {
                        opts.prepend = '&' + opts.prepend;
                }
                var serialStr = '';
                // Begin the core plugin
                this.each(function () {
                        var ul_obj = this;
                        var li_count = 0;
                        var c = 1;
                        $(this).children().each(function () {
                                for (att = 0; att < opts.attributes.length; att++) {
                                        var key = (opts.attributes[att] === 'class' ? 'cssClass' : opts.attributes[att]);
                                        serialStr += opts.prepend + '[' + li_count + '][' + key + ']=' + encodeURIComponent($(this).attr(opts.attributes[att]));
                                        // append the form field values
                                        if (opts.attributes[att] === 'class') {
                                                serialStr += opts.prepend + '[' + li_count + '][required]=' + encodeURIComponent($('#' + $(this).attr('id') + ' input.required').is(':checked'));
                                                switch ($(this).attr(opts.attributes[att])) {
                                                case 'input_text':
                                                        serialStr += opts.prepend + '[' + li_count + '][values]=' + encodeURIComponent($('#' + $(this).attr('id') + ' input[type=text]').val());
                                                        break;
                                                case 'textarea':
                                                        serialStr += opts.prepend + '[' + li_count + '][values]=' + encodeURIComponent($('#' + $(this).attr('id') + ' input[type=text]').val());
                                                        break;
                                                case 'checkbox':
                                                        c = 1;
                                                        $('#' + $(this).attr('id') + ' input[type=text]').each(function () {
                                                                if ($(this).attr('name') === 'title') {
                                                                        serialStr += opts.prepend + '[' + li_count + '][title]=' + encodeURIComponent($(this).val());
                                                                }
                                                                else {
                                                                        serialStr += opts.prepend + '[' + li_count + '][values][' + c + '][value]=' + encodeURIComponent($(this).val());
                                                                        serialStr += opts.prepend + '[' + li_count + '][values][' + c + '][baseline]=' + $(this).prev().is(':checked');
                                                                }
                                                                c++;
                                                        });
                                                        break;
                                                case 'radio':
                                                        c = 1;
                                                        $('#' + $(this).attr('id') + ' input[type=text]').each(function () {
                                                                if ($(this).attr('name') === 'title') {
                                                                        serialStr += opts.prepend + '[' + li_count + '][title]=' + encodeURIComponent($(this).val());
                                                                }
                                                                else {
                                                                        serialStr += opts.prepend + '[' + li_count + '][values][' + c + '][value]=' + encodeURIComponent($(this).val());
                                                                        serialStr += opts.prepend + '[' + li_count + '][values][' + c + '][baseline]=' + $(this).prev().is(':checked');
                                                                }
                                                                c++;
                                                        });
                                                        break;
                                                case 'select':
                                                        c = 1;
                                                        serialStr += opts.prepend + '[' + li_count + '][multiple]=' + $('#' + $(this).attr('id') + ' input[name=multiple]').is(':checked');
                                                        $('#' + $(this).attr('id') + ' input[type=text]').each(function () {
                                                                if ($(this).attr('name') === 'title') {
                                                                        serialStr += opts.prepend + '[' + li_count + '][title]=' + encodeURIComponent($(this).val());
                                                                }
                                                                else {
                                                                        serialStr += opts.prepend + '[' + li_count + '][values][' + c + '][value]=' + encodeURIComponent($(this).val());
                                                                        serialStr += opts.prepend + '[' + li_count + '][values][' + c + '][baseline]=' + $(this).prev().is(':checked');
                                                                }
                                                                c++;
                                                        });
                                                        break;
                                                }
                                        }
                                }
                                li_count++;
                        });
                });
                return (serialStr);
        };
})(jQuery);