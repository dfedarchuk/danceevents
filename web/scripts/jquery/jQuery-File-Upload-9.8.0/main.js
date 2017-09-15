/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */
if ($('#tour-images').length || $('#fileupload').length || $('#tour-image').length) {
$(function () {
    'use strict';

    //Auxiliary inputs for image upload
    var gallery_hash = $('#gallery_hash').val();
    var item_type = $('#item_type').val();
    var galleryid = $('#galleryid').val();
    var max_images = $('#max_images').val();
    var item_id = $('#id').val();
    var level = $('#level').val();
    var sitemgr = $('#sitemgr').val();
    var domain_id = $('#domain_id').val();
    var uploader_url = DEFAULT_URL + '/';

    if (sitemgr) {
        uploader_url = uploader_url + SITEMGR_ALIAS;
    }
    else {
        uploader_url = uploader_url + MEMBERS_ALIAS;
    }

    // Initialize the jQuery File Upload widget:
    $('#fileupload, #tour-images, #tour-image').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: uploader_url + '/uploader/index.php?gallery_hash=' + gallery_hash + '&item_type=' + item_type + '&galleryid=' + galleryid + '&photos=' + max_images +'&item_id=' + item_id + '&level=' + level + '&sitemgr=' + sitemgr + '&domain_id=' + domain_id,
        autoUpload: true,
        replaceFileInput: false
    });

    // Called when delete button is pressed and the item disappeared
    $('#fileupload, #tour-images, #tour-image').bind('fileuploaddestroyed', function (e, data) {
        // if it does not have an image default, it will simulate the click in the first item
        if (0 === $(this).find('.files .row .image-default').length) {
            $(this).find('.files .row').eq(0).find('.item-gallery').click();
        }
    });

    // Load existing files:
    $('#fileupload, #tour-images, #tour-image').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload, #tour-images, #tour-image').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload, #tour-images, #tour-image')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });

});

}
