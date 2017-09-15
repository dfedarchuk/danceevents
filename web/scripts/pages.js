function pageActionsAjax(url, type, data, contentType) {
    // Send the data using post
    if(contentType) {
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

function addNewPage() {
    var // REQUEST INFO
        url = '../../../includes/code/pageActionAjax.php',
        data = 'action=newPage',
        type = "POST",
        request;

    request = pageActionsAjax(url, type, data, false);

    request.done(function (data) {
        var objData = jQuery.parseJSON(data);

        if(objData.success) {
            window.location.href = objData.redirect;
        }
    });
}

$('.addNewPageButton').on('click', function () {
    addNewPage();
});