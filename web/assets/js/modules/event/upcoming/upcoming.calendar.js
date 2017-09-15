$(document).ready(function () {
    /* Binds */
    $('.calendar-carousel .calendar-dates button').click(function () {

        $(this).parents('.calendar-dates').find('button').each(function () {
            $(this).prop('disabled', true);
        });

        $(this).parents('.calendar-dates').find('button.active').removeClass('active');
        $(this).addClass('active');

        eDirectory.Event.upcomingEventsCalendar($(this), function () {
            $('.calendar-carousel .calendar-dates button').parents('.calendar-dates').find('button').each(function () {
                $(this).prop('disabled', false);
            });
        });
    });

    if ($('.calendar-carousel .calendar-dates button').length) {
        $('.calendar-carousel .calendar-dates button:first').click();
    }

    var owl = $('.calendar-dates');

    /* Carousel */
    owl.owlCarousel({
        items : 10, //10 items above 1000px browser width
        itemsDesktop : [1000,10], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,3], // betweem 900px and 601px
        itemsTablet: [600,2], //2 items between 600 and 0
        itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
        pagination: false,
        navigation:true,
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        //touchDrag: false,
        //mouseDrag: false
    });

    $('.calendar-control.right').click(function(){
        owl.data('owlCarousel').next();
    });

    $('.calendar-control.left').click(function(){
        owl.data('owlCarousel').prev();
    });
});

//function random(owlSelector){
//    owlSelector.children().sort(function(){
//        return Math.round(Math.random()) - 0.5;
//    }).each(function(){
//        $(this).appendTo(owlSelector);
//    });
//}
//
