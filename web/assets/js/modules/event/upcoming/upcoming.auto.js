$(document).ready(function () {
    var success = $('#upcoming-events').data('success');
    eDirectory.Event.upcomingEventsOneBlock('#upcoming-events', success, 30);
});
