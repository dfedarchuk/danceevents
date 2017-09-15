/* Checks namespace existence */
eDirectory = eDirectory || {};
eDirectory.Search = eDirectory.Search || {};
eDirectory.Search.Filters = eDirectory.Search.Filters || {};

/**
 * Handles date filter mechanics and configurations
 *
 * @param inputContainer jQuery instance of the element containing the inputs
 * @param refreshButton  jQuery instance of the refresh button
 * @param datePickerOptions The options for the bootstrap datepicker instance
 * @param dateFormat The format in which the date shall be processed
 * @param initialValues The initial values of the date inputs
 * @constructor
 */
eDirectory.Search.Filters.DateFilter = function (inputContainer, refreshButton, datePickerOptions, dateFormat, initialValues) {
    this.input = inputContainer;
    this.refreshButton = refreshButton;
    this.urlFormat = refreshButton.data("urlformat");
    this.datePickerOptions = datePickerOptions;
    this.dateFormat = dateFormat || "mm/dd/yyyy";
    this.initialValues = initialValues || [];
};

/**
 * Initializes inputs as bootstrap datepickers and sets button click action
 */
eDirectory.Search.Filters.DateFilter.prototype.initialize = function () {
    var instance = this;

    /* Creates the datepicker itself */
    instance.input.datepicker(instance.datePickerOptions);

    var pickers = instance.input.data('datepicker').pickers;

    /* Sets initial values, if any */
    for(var i = 0; i < this.initialValues.length && i < pickers.length; i++){
        pickers[i].setDate(this.initialValues[i]);
    }

    this.refreshButton.click(function () {
        var pickers = instance.input.data('datepicker').pickers;

        var startDate = pickers.shift().getFormattedDate(instance.dateFormat);
        var endDate = (pickers.length > 0) ? pickers.shift().getFormattedDate(instance.dateFormat) : null;

        window.location = instance.urlFormat.replace('/STARTDATE', startDate).replace("/ENDDATE", endDate);
    });
};
