$(document).ready(function () {
    var date = $('#countdown').data('date');
    $('#countdown').countdown(date).on('update.countdown', function (event) {
        var $this = $(this).html(event.strftime($.templates('#countdown-style').render()));
    })

    /*
     * Workaround for redeem without login
     */
    if (Cookies.get('open_redeem')) {
        $('button[data-target=#redeem]:visible').click();
        Cookies.remove('open_redeem');
    }

    $('#modalLogin').on('hidden.bs.modal', function () {
        $(this).removeData('bs.modal');
    });
});
