$(document).ready(function () {
    $('body').on('click', '.sendEmailButton', function (event) {
        event.preventDefault();
        $.post($(this).data('action')).done(function (data) {
            if (data) {
                var modal = new eDirectory.Utility.Modal("sendMail", data.title, data.content);
                modal.show();
            }
        });
    });

    $('body').on('submit', 'form.send-email', function (event) {
        event.preventDefault();

        $.post($(this).attr('action'), $(this).serialize()).done(function (data) {
            if (data) {
                var modal = new eDirectory.Utility.Modal("sendMail", data.title, data.content);
                modal.show();

                if (data.status) {
                    setTimeout(function () {
                        modal.hide();
                    }, 3000);
                }
            } else {
                $("#sendMail").remove();
            }
        });
    });
});
