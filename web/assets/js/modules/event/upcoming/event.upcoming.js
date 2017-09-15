/* Checks namespace existence */
if (typeof eDirectory == 'undefined') {
    eDirectory = {};
}

if (typeof eDirectory.Event == 'undefined') {
    eDirectory.Event = {};
}

/**
 * Used to prepare the parameters to use in the ajax
 *
 * @param target_div Element's Identification
 * @param max_success Total of days shown
 * @param max_executed Max attempts
 */
eDirectory.Event.upcomingEventsOneBlock = function (target_div, max_success, max_executed) {
    var today = $(target_div).data('today');

    if (!today) {
        return;
    }

    today = today.split('-');
    today = new Date(today[1] + '/' + today[2] + '/' + today[0]);

    eDirectory.Event.upcomingEventsAjaxOneBlock(target_div, today, max_success, max_executed, 0, 0);
}

/**
 * Get events from a day
 *
 * @param target_div Element's Identification
 * @param date
 * @param max_success Total of days shown
 * @param max_executed Max attempts
 * @param success Number of days with events
 * @param executed Attempts's number
 */
eDirectory.Event.upcomingEventsAjaxOneBlock = function (target_div, date, max_success, max_executed, success, executed) {
    // stop execution
    if (success >= max_success || executed >= max_executed) {
        return false;
    }

    $.get(Routing.generate('event_upcoming', {
            day: date.getDate(),
            month: date.getMonth() + 1,
            year: date.getFullYear()
        }))
        .done(function (data) {
            if (data.events.length > 0) {
                var events_items = [];
                for (var event in data.events) {
                    if (success < max_success) {
                        success++;
                        events_items.push(data.events[event]);
                    }
                }

                var events = $.templates('#upcoming-event-box').render(events_items);
                $(target_div).find('.row').append(events);
            }

            // next day
            date.setDate(date.getDate() + 1);
            eDirectory.Event.upcomingEventsAjaxOneBlock(target_div, date, max_success, max_executed, success, executed + 1);
        });
}

/**
 *  Upcoming Event for event home.
 *  Works like a calendar. Used in Upcoming Extension.
 *
 * @param target_div
 */
eDirectory.Event.upcomingEventsCalendar = function (target_div, callback) {
    var day = $(target_div).data('day');

    if (!day) {
        return;
    }

    day = day.split('-');
    day = new Date(day[1] + '/' + day[2] + '/' + day[0]);

    /* div#id */
    var id = day.getDate() + '' + (day.getMonth() + 1) + '' + day.getFullYear();
    /* div to add events */
    var block_container = $(target_div).parents('.calendar-carousel').next('.block-container');

    /* class used in view */
    block_container.find('.upcoming-event-block').hide();

    /* day already searched */
    if (block_container.find('#' + id).length > 0) {
        block_container.find('#' + id).show();
        callback();
        return;
    }

    block_container.append('<div id="loading" class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
    $.get(Routing.generate('event_upcoming', {
            day: day.getDate(),
            month: day.getMonth() + 1,
            year: day.getFullYear()
        }))
        .always(function () {
            callback();
        })
        .done(function (data) {
            block_container.find('#loading').remove();

            /* check if a event was found */
            if (!(data.events.length > 0)) {
                return;
            }

            /* it'll reorganize the data that comes in JSON and group elements following their category */
            /* where, for instance, a Sports's event will be together with others Sports's event */
            var group_events = _.groupBy(data.events, function (arg) {
                if (arg.categories.length > 0)
                    return arg.categories[0].title;

                // Event does not have category
                return '';
            });

            group_events = _.map(group_events, function (value, key) {
                if (key.length > 0) {
                    return {
                        category: {
                            name: key,
                            link: value[0].categories[0].link
                        },
                        events: value
                    }
                } else {
                    // Event does not have category
                    return {
                        category: {
                            name: '',
                            link: ''
                        },
                        events: value
                    }
                }
            });

            /* #id used here */
            var events = $.templates('#upcoming-event-caroulse').render({group: group_events, id: id});
            /* block_container used here */
            block_container.append(events);
        }).fail(function () {
        block_container.find('#loading').remove();
    });
};
