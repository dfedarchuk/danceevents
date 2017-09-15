$(document).ready(function () {
    var messageBox = null;

    $('body').on('submit', 'form.clicktocall', function () {
        // this var it's used to interact inside the post function
        var form_father = $(this);

        $.post($(this).attr('action'), $(this).serialize())
            .done(function (data) {
                if (messageBox == null) {
                    messageBox = $('<div>');
                    form_father.prev('.info').prepend(messageBox);
                }

                if (data.status) {
                    form_father.find('input').attr('disabled', true);
                    messageBox.removeClass().addClass('alert alert-success').html(data.msg);

                    // Closes the modal
                    setTimeout(function(){
                        $('#modalClicktoCall').modal('hide');
                    }, 10000);
                } else {
                    if (data.msg != undefined) {
                        messageBox.removeClass().addClass('alert alert-warning').html(data.msg);
                    } else {
                        form_father.html($(data).find('.clicktocall').html());
                    }
                }
            });
        return false;
    });

    $('#modalClicktoCall').on('hidden.bs.modal', function(e) {
        $(this).removeData('bs.modal');
    });
});
