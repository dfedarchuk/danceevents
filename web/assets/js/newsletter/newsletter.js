$(document).ready(function () {
    $('#formNewsletter button').click(function () {
        var form = $(this).parents('form');
        form.find('.showmessage').addClass('hidden');

        $.post(Routing.generate('web_newsletter'), $(this).parents('form').serialize(), function (data) {
            if (data.success) {
                if ($.templates) {
                    var message = $.templates('#alert-message').render({
                        type: 'success',
                        message: data.message
                    });
                    form.find('.showmessage').removeClass('hidden').html(message);
                } else {
                    /*
                    Workaround for Doctor theme
                     */
                    form.find('.showmessage').removeClass('hidden');
                }

                $("#newsname").prop("value", "");
                $("#newsemail").prop("value", "")
                if ($().placeholder) {
                    $('input').placeholder();
                }
                form.find('.alert-warning').each(function () {
                    $(this).remove();
                });

            } else {
                if ($.templates) {
                    errorMessageForm('formNewsletter', data.errors);
                } else {
                    /*
                     Workaround for Doctor theme
                     */
                    form.find('.alert-warning').each(function () {
                        $(this).remove();
                    });
                    for (var i = 0; i < data.errors.length; i++) {
                        var error = data.errors[i];
                        if (error.field) {
                            var errorMessage = '<span class="alert alert-warning" role="alert"> <i class="fa fa-warning"></i> ' + error.message + '</span>';
                            form.find('input[name='+error.field+']').parent('.form-group').after(errorMessage);
                        }
                    }
                }
            }

            return false;
        });

        return false;
    });

    $(this).parents('form').submit(function () {
        return false;
    })
});
