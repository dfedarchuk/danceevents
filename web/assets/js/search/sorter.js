/* Checks namespace existence */
eDirectory = eDirectory || {};
eDirectory.Search = eDirectory.Search || {};

/**
 * Class responsible for keeping track of user choices on the sorter selected element and functionalities
 * @param element
 * @param geoLocation eDirectory.Utility.Geolocation
 * @param errorHandlerCallback
 * @constructor
 */
eDirectory.Search.Sorter = function (element, geoLocation, errorHandlerCallback) {
    this.element = element;
    this.geoLocation = geoLocation;
    this.errorHandlerCallback = errorHandlerCallback;
};

/**
 * Disables all options containing geolocation features
 */
eDirectory.Search.Sorter.prototype.disableGeoLocation = function () {
    $('*[data-needsgeolocation="1"]').prop("disabled", true);
    //this.element.selectpicker('refresh');
};

/**
 * Initializes sorter component and functionality
 */
eDirectory.Search.Sorter.prototype.initialize = function () {
    var instance = this;

    this.element.on('change', function () {
        var selected;

        if (selected = $(this).find("option:selected")) {
            if (selected.data("needsgeolocation")) {
                instance.geoLocation.getCoordinates(
                    function (coordinates) {
                        window.location = selected.val();
                    },
                    function (errors) {
                        instance.disableGeoLocation();

                        if( instance.errorHandlerCallback ){
                            instance.errorHandlerCallback(errors);
                        }
                    }
                );
            } else {
                window.location = selected.val();
            }
        }
    });
};
