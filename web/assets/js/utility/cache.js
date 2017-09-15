/* Checks namespace existence */
if (typeof eDirectory == 'undefined') {
    eDirectory = {};
}

if (typeof eDirectory.Utility == 'undefined') {
    eDirectory.Utility = {};
}

/**
 * Handles caching for any sort of data
 * @param maxSize
 * @constructor
 */
eDirectory.Utility.Cache = function (maxSize) {
    this.maxSize = maxSize ? maxSize : 30;
    this.data = {};
    this.keyOrder = [];
};

/**
 * Inserts data into the cache
 * @param keyword
 * @param data
 */
eDirectory.Utility.Cache.prototype.addData = function (keyword, data) {
    this.keyOrder.push(keyword);
    this.data[keyword] = data;

    if (Object.keys(this.data).length > this.maxSize) {
        this.clean();
    }
};

/**
 * Retrieves data from the cache. Returns null if data does not exist
 * @param keyword
 * @returns {*}
 */
eDirectory.Utility.Cache.prototype.getData = function (keyword) {
    return this.data[keyword] ? this.data[keyword] : null;
};

/**
 * Removes the oldest data entry
 */
eDirectory.Utility.Cache.prototype.clean = function () {
    delete this.data[this.keyOrder.shift()];
};
