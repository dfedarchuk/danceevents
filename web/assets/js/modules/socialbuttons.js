var socialLikesButtons = {
    whatsapp: {
        popupUrl: 'whatsapp://send?text={title} - {url}'
    }
};

$(document).ready(function () {
    $('.social-sharing').socialLikes();
})
