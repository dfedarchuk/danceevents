/**
 * Changes label from clicked button using Bootstrap's functions
 *
 * @return void()
 */
$('.action-save').click(function () {
    var btn = $(this);
    btn.button('loading');
});

/**
 * Bring back clicked button above
 */
$(document).ajaxStop(function () {
    $('.action-save').button('reset');
});

/**
 * Creates message error for a form
 *
 * @param formID form ID
 * @param arrayErrors array of objects
 *
 * @return void()
 */
function errorMessageForm(formID, arrayErrors) {
    var formJQuery = $('#' + formID);

    formJQuery.find('.alert-warning').each(function () {
        $(this).remove();
    });

    for (var i = 0; i < arrayErrors.length; i++) {
        var error = arrayErrors[i];
        if (error.field) {
            var message = $.templates('#alert-message').render({
                type: 'warning',
                message: error.message
            });
            formJQuery.find('input[name='+error.field+']').parent('.form-group').after(message);
        }
    }

}
