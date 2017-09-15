/* Checks namespace existence */
eDirectory = eDirectory || {};
eDirectory.Utility = eDirectory.Utility || {};

/**
 * @param geoLocationCookieName
 * @constructor
 */
eDirectory.Utility.Geolocation = function (geoLocationCookieName) {
    this.lat = null;
    this.lon = null;
    this.cookieName = geoLocationCookieName;
    this.successCallback = null;
};

/**
 * Returns an object containing the values stored in the cookie or instance, if the former is not set.
 * @returns {{lat: number, lon: number}}
 * @private
 */
eDirectory.Utility.Geolocation.prototype._getInternalValue = function () {
    return this.convertToObject(Cookies.get(this.cookieName));
};

/**
 *
 * @param position Position
 * @private
 */
eDirectory.Utility.Geolocation.prototype._success = function (position, a, b, c, d) {
    var instance = eDirectory.Utility.Geolocation.getInstance();

    instance._setCoordinatesByPosition(position);
    instance.setCookie();

    if (instance.successCallback) {
        instance.successCallback(instance._getInternalValue());
    }
};

/**
 * Sets this object's internal values according to a Position instance
 * @param position Position
 * @private
 */
eDirectory.Utility.Geolocation.prototype._setCoordinatesByPosition = function (position) {
    this.lat = position.coords.latitude;
    this.lon = position.coords.longitude;
};

/**
 *
 * @param successCallback
 * @param errorCallback
 */
eDirectory.Utility.Geolocation.prototype.getCoordinates = function (successCallback, errorCallback) {
    this.successCallback = successCallback || null;

    var geoLocation = this._getInternalValue();

    if (geoLocation) {
        if (successCallback) {
            successCallback(geoLocation);
        }
    } else if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this._success, errorCallback);
    } else if (errorCallback) {
        var error = new PositionError();
        error.code = eDirectory.Utility.Geolocation.Errors.UNAVAILABLE_FEATURE;
        errorCallback(error);
    }
};

/**
 * Writes the latitude and longitude coordinates to a cookie whose name is passed to the constructor of the instance
 */
eDirectory.Utility.Geolocation.prototype.setCookie = function () {
    Cookies.set(this.cookieName, this.convertToString());
};

/**
 * Converts the lat and lon values passed as parameter to a coordinate string representation. If no parameters are available, the object's internal values will be used instead.
 *
 * @param lat
 * @param lon
 * @returns {string}
 */
eDirectory.Utility.Geolocation.prototype.convertToString = function (lat, lon) {
    var result = "";

    lat = lat || this.lat;
    lon = lon || this.lon;

    if (lat && lon) {
        result = lat + "," + lon;
    }

    return result;
};

/**
 * Converts the string passed as parameter to a valid coordinate object with lat and lon as keys. If no parameters are available, the object's internal values will be used instead.
 *
 * @param coordinates string
 * @returns {{lat: number, lon: number}}|null
 */
eDirectory.Utility.Geolocation.prototype.convertToObject = function (coordinates) {
    var result = null;

    var lat = null;
    var lon = null;

    if (coordinates) {
        var coordinateParts = coordinates.split(",");

        if (coordinateParts.length == 2) {
            lat = parseFloat(coordinateParts[0]);
            lon = parseFloat(coordinateParts[1]);
        }
    } else {
        lat = parseFloat(this.lat);
        lon = parseFloat(this.lon);
    }

    if (lat && lon) {
        result = {
            lat: lat,
            lon: lon
        };
    }

    return result;
};

/**
 * Constants containing all error values related to GeoLocation
 * @type {{UNAVAILABLE_FEATURE: number}}
 */
eDirectory.Utility.Geolocation.Errors = {
    UNAVAILABLE_FEATURE: 100
};

/**
 *
 * @type {eDirectory.Utility.Geolocation}|null
 * @private
 */
eDirectory.Utility.Geolocation._instance = null;

eDirectory.Utility.Geolocation.getInstance = function (cookieName) {
    if (eDirectory.Utility.Geolocation._instance === null) {
        eDirectory.Utility.Geolocation._instance = new eDirectory.Utility.Geolocation(cookieName);
    }

    return eDirectory.Utility.Geolocation._instance;
};
