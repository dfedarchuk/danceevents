<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/assets/custom-js/widget.php
# ----------------------------------------------------------------------------------------------------

?>

<script type="text/javascript">
$.widgetDuplicated = {};
<?php
foreach ($wysiwygService->getWidgetNonDuplicate() as $group => $widgets) { ?>
    $.widgetDuplicated['<?= $group ?>'] = [];
<?php
    foreach ($widgets as $key => $widget) { ?>
        $.widgetDuplicated['<?=$group?>']['<?=$key?>'] = '<?=$widget?>';
<?php }
}
?>
</script>

<script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/widgets.js"></script>
<script src="<?= DEFAULT_URL ?>/scripts/jquery/formbuilder/jquery.formbuilder.js"></script>
<script src="<?= DEFAULT_URL ?>/scripts/jquery/auto_upload/js/file_uploads.js"></script>
<script src="//cdn.ckeditor.com/4.6.0/standard-all/ckeditor.js"></script>
<script
    src="<?= DEFAULT_URL ?>/scripts/jquery/formbuilder/lang/<?= (file_exists(EDIRECTORY_ROOT."/scripts/jquery/formbuilder/lang/".$sitemgr_language.".js") ? $sitemgr_language : "en_us") ?>.js"></script>

<script type="text/javascript">
    // Using the auto_upload jquery plugin
    function saveImage(formField, type, imgField, parentId, imgHidden, idMessage, logoOnHeaderAndFooter) {
        logoOnHeaderAndFooter = logoOnHeaderAndFooter || false;
        var form = $('#' + formField);
        var $file = form.find('input:file');
        var maxSize = '<?= UPLOAD_MAX_SIZE ?>' * Math.pow(10, 6);
        var maxSizeMsg = '<?= system_showText(LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE_BIG) ?>'

        if($file.length < 0 || $file.val() == '') {
            return;
        }

        // if possible validate file size on client side
        if(window.FileReader) {
            var files = $file[0].files;

            if(files.length < 1){
                return
            }

            var file = files[0]

            if(file.size > maxSize) {
                $('#'+ formField).parents().find('#' + idMessage)
                    .addClass('alert-danger').removeClass('alert-success')
                    .find('div').html(maxSizeMsg)
                    .parent().show();

                return;
            }
        }

        if (form.find('input:file').val() == '') {
            return;
        }

        var baseUrl = '<?=DEFAULT_URL."/".SITEMGR_ALIAS?>/design/page-editor/custom.php?domain_id=<?=SELECTED_DOMAIN_ID?>';
        $('#messageAlert').hide();

        form.vPB({
            dataType: 'json',
            url: baseUrl + '&action=upload&type=' + type,
            success: function (response) {
                if(response.length === 0) {
                    $('#'+ formField).parents().find('#' + idMessage)
                        .addClass('alert-danger').removeClass('alert-success')
                        .find('div').html(maxSizeMsg)
                        .parent().show();
                } else if (response.success == false) {
                    $('#'+ formField).parents().find('#' + idMessage)
                        .addClass('alert-danger').removeClass('alert-success')
                        .find('div').html(response.message)
                        .parent().show();
                } else {
                    var imgElement = $('#' + imgField);
                    /* in the theme Restaurant sitemgr can edit the logo at the header or at the footer widget */
                    if (logoOnHeaderAndFooter) {
                        imgElement = $('.' + imgField + formField);
                    }
                    // Remove new image structure and create a image tag
                    if (imgElement.length === 0) {
                        var parentField = $('#' + parentId);

                        parentField.fadeOut('slow', function () {
                            $(this)
                                .find('div.new').removeClass('new').addClass('edit-houver')
                                .find('a.add-new').removeClass('thumbnail add-new')
                                .find('div.caption').remove();
                            $(this).fadeIn('slow');
                        });

                        imgElement = $('<img id="' + imgField + '" alt="eDirectory">');
                        imgElement.appendTo(parentField.find('a'));
                    }

                    // Change image
                    imgElement.fadeOut('slow', function () {
                        $(this).attr('src', response.url + '?t=' + new Date().getTime());
                        onImgLoad(imgElement, function () {
                            $(this).fadeIn('slow');
                        });
                    });

                    // Update field when return the id from database
                    if (imgHidden && response.code) {
                        $('#' + imgHidden).val(response.code);
                    }

                    $("#" + idMessage).hide();
                }
            }
        }).submit();
    }

    /**
     * Trigger a callback when the selected images are loaded:
     * @param {String} selector
     * @param {Function} callback
     */
    var onImgLoad = function (selector, callback) {
        $(selector).each(function () {
            if (this.complete || /*for IE 10-*/ $(this).height() > 0) {
                callback.apply(this);
            } else {
                $(this).on('load', function () {
                    callback.apply(this);
                });
            }
        });
    };


    $(document).on('click', '#button-save', function (e) {
        <? if (in_array($page->getPageType()->getTitle(), $confirmPages)) { ?>
        if ($('#oldPageUrl').val() !== $('#url').val()) {
            $('#modal-confirmation').modal('show');
        } else {
            JS_widget_submit();
        }
        <? } else { ?>
        JS_widget_submit();
        <? } ?>
    });

    function saveSlider(field) {
        var sliderId = $(field).data('slider');
        saveImage('form_slider_' + sliderId, 'slide', 'imgSlider' + sliderId, 'image-background' + sliderId, 'imageId' + sliderId, 'messageAlertSlider');
    }

    // hack to fix ckeditor/bootstrap compatibility bug when ckeditor appears in a bootstrap modal dialog
    // References:
    // http://stackoverflow.com/questions/14420300/bootstrap-with-ckeditor-equals-problems/18554395#18554395
    // http://jsfiddle.net/pvkovalev/4PACy/

    $(document).ready(function(){

        $.fn.modal.Constructor.prototype.enforceFocus = function () {
            modal_this = this
            $(document).on('focusin.modal', function (e) {
                if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
                    // add whatever conditions you need here:
                    &&
                    !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                    modal_this.$element.focus()
                }
            })
        };

        $(document).on('show.bs.modal', '#edit-widget-modal',function () {
            $('#form-builder').formbuilder({
                'save_url': '<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/page-editor/custom.php?action=save&domain_id=".SELECTED_DOMAIN_ID?>',
                'load_url': '<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/page-editor/custom.php?action=load&domain_id=".SELECTED_DOMAIN_ID?>',
                'modal_name': 'edit-widget-modal',
                'msg_success': '<?=LANG_SITEMGR_WIDGET_SUCCESSFULLY_SAVED?>'
            });

            $(function () {
                $(document).find("#form-builder ul").sortable({opacity: 0.6, cursor: 'move'});
            });
        });
    });


</script>
