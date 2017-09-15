/* Checks namespace existence */
if (typeof eDirectory == 'undefined') {
    eDirectory = {};
}

if (typeof eDirectory.Search == 'undefined') {
    eDirectory.Search = {};
}

/**
 * Creates a result google map handler.
 * @param fetchUrl The url in which we'll fetch summary contents
 * @param map The google map instance
 * @param container The container which has the google map elements such as markers
 * @param clusterer The marker clusterer instance
 * @param tabButton The selector of the button which will show the bootstrap tab
 * @param summaryDisplayElement The element where the summary will be appended to
 * @param maxCacheSize The maximum number of elements to be saved
 * @constructor
 */
eDirectory.Search.Map = function (fetchUrl, map, container, clusterer, tabButton, summaryDisplayElement, maxCacheSize) {
    this.fetchUrl = fetchUrl;
    this.map = map;
    this.container = container;
    this.clusterer = clusterer;
    this.tabButton = tabButton;
    this.summaryDisplayElement = summaryDisplayElement;
    this.cache = new eDirectory.Utility.Cache(maxCacheSize);
    this.infoWindow = null;
};

/**
 * Starts up necessary event handlers for the map results to work
 */
eDirectory.Search.Map.prototype.initialize = function () {
    var instance = this;
    var map = this.map;
    var clusterer = this.clusterer;
    var container = this.container;

    $(this.tabButton).on('shown.bs.tab', function (e) {
        instance.moveToCenter();
    });

    /* Sets click events for every marker in the map */
    for (var markerId in container.markers) {
        var marker = container.markers[markerId];
        google.maps.event.addListener(marker, 'click', function () {
            instance.viewElement(this.itemElement, this);
        });
    }

    google.maps.event.addListener(clusterer, "clusterclick", function (cluster) {
        var markers = cluster.getMarkers();

        if (markers) {
            var position = markers[0].position;
            var match = true;
            var elements = [markers[0].itemElement];

            for (var i = 1; i < markers.length && match; i++) {
                var marker = markers[i];

                if (match = position.equals(marker.position)) {
                    elements.push(marker.itemElement);
                }
            }

            if (match) {
                instance.viewElement(elements, markers[0]);
            }
        }
    });

    if (Cookies.get("edirectory_results_viewmode") == "map") {
        this.moveToCenter();
    }
};

/**
 * Moves map focus and centers on contained markers
 */
eDirectory.Search.Map.prototype.moveToCenter = function () {
    google.maps.event.trigger(this.map, "resize");
    this.clusterer.fitMapToMarkers();
};

/**
 *
 * @param {Array|string} data
 * @param element
 */
eDirectory.Search.Map.prototype.displayResults = function (data, element) {

    if (data.constructor === Array) {

    } else {

        /* Closes previous windows opened */
        if (this.infoWindow) {
            this.infoWindow.close();
        }

        this.infoWindow = new google.maps.InfoWindow({
            content: data
        });
        this.infoWindow.open(this.map, element);
    }
};

/**
 * Shows info about the clicked item on the map
 * @param data
 * @param element {Object}
 */
eDirectory.Search.Map.prototype.viewElement = function (data, element) {
    var instance = this;

    if (data.constructor !== Array) {
        data = [data];
    }

    $.post(instance.fetchUrl,{data: data}).done(function (response) {
        instance.displayResults(response, element);
    });
};
