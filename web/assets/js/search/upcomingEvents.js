/* Checks namespace existence */
eDirectory = eDirectory || {};
eDirectory.Search = eDirectory.Search || {};

/**
 * Handles upcoming events custom event search based on dates selected on an bootstrap datepicker input.
 *
 * @param calendarButton The jQuery instance of the button which will call the calendar
 * @param datePickerOptions The bootstrap datepicker instance options
 * @param dateFormat The format in which the date shall be processed
 * @constructor
 */
eDirectory.Search.UpcomingEvents = function (calendarButton, datePickerOptions, dateFormat) {
    this.calendarButton = calendarButton;
    this.urlFormat = calendarButton.data("urlformat");
    this.datePickerOptions = datePickerOptions;
    this.dateFormat = dateFormat || "mm/dd/yyyy";
};

/**
 * Initializes bootstrap datepicker and sets button click action
 */
eDirectory.Search.UpcomingEvents.prototype.initialize = function () {
    var instance = this;

    instance.calendarButton.datepicker(instance.datePickerOptions);

    instance.calendarButton.datepicker().on("changeDate", function () {
        var startDate = instance.calendarButton.data('datepicker').getFormattedDate(instance.dateFormat);
        window.location = instance.urlFormat.replace('/STARTDATE', startDate).replace("/ENDDATE", "");
    });
};
