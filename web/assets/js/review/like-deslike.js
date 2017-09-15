$(document).ready(function () {
    $('.review-bottom button').click(function () {
        var div = $(this).parent();
        var type = $(this).data('type');
        var id = $(this).data('id');

        div.find('button.active').removeClass('active');
        $(this).addClass('active');

        $.post(Routing.generate('web_rate_review', {id: id, type: type}), function (response) {
            if (response.status == 1) { // success
                div.find('span.like').text(response.like);
                div.find('span.dislike').text(response.dislike);
            }
        })
    })
});
