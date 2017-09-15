/*Bootstrap Tour-------------*/
// Instance the tour
var $tutorial, tour;
$tutorial = $("#demo");

tour = new Tour(
{
    backdrop: true,
    storage: false,
    onStart: function() {
      return $tutorial.addClass("disabled", true);
    },
    onEnd: function() {
      $("aside.tutorial-tour, .wrapper").removeClass("toggletutorial");
    },
    onShown: function() {
        $(".tour-step").removeClass("active");
        //Get current step and activate menu status active
        var step = tour.getCurrentStep();

        $(".tour-step").each( function() {
            if ( $(this).data("step") == step ) {
                $(this).addClass("active");
            }
        });
    },
    steps: auxStepsTutorial
}
);


$(".tutorial-text").click( function() {
    $("aside.tutorial-tour, .wrapper").addClass("toggletutorial");
    // Initialize the tour
    tour.init();
    tour.start();
});

$(document).on("click", "[data-tour]", function(e) {
    e.preventDefault();
    if ($(this).hasClass("disabled")) {
      return;
    }
    tour.restart();
});

$(".tour-step ").click( function() {
    $(".tour-step").removeClass("active");
    $(this).addClass("active");
    tour.goTo( parseInt( $(this).attr("data-step") ) );
});

$(".tour-step-end").click( function() {
    tour.end();
});

//Close help for places there are no tutorial, only help
$(".close-help").click( function() {
    $(".toggletutorial").removeClass("toggletutorial");
});