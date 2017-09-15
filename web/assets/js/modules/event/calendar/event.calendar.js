$(document).ready(function () {
    var calendar = $("#event-calendar").calendar({
        tmpl_path: "/tmpls/",
        tmpl_cache: false,
        view: 'month',
        views: {
            day: false,
            week: false,
            month: {
                slide_events: false,
                enable: true
            },
            year: {
                slide_events: false,
                enable: true
            }
        },
        display_week_numbers: false,
        weekbox: false,
        classes: {
            months: {
                general: 'label'
            }
        },
        events_source: Routing.generate('event_calendar'),
        onAfterViewLoad: function (view) {
            $('.event-view-year').text(this.getTitle());
            $('.event-next-year').text(this.getYear() + 1);
            $('.event-prev-year').text(this.getYear() - 1);
        }
    });

    $('.event-navigation button[data-calendar-nav]').each(function () {
        var $this = $(this);
        $this.click(function () {
            calendar.navigate($this.data('calendar-nav'));
        });
    });

    $('.event-header-navigation button[data-calendar-view]').each(function () {
        var $this = $(this);
        $this.click(function () {
            calendar.view($this.data('calendar-view'));
        });
    });

    $('.event-header-navigation button[data-calendar-nav-year]').each(function () {
        var $this = $(this);
        $this.click(function () {
            calendar.view('year');
            calendar.navigate($this.data('calendar-nav-year'));
        });
    });
});
