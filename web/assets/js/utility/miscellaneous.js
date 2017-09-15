/* Checks namespace existence */
if (typeof eDirectory == 'undefined') {
    eDirectory = {};
}

if (typeof eDirectory.Utility == 'undefined') {
    eDirectory.Utility = {};
}

if (typeof eDirectory.Utility.Miscellaneous == 'undefined') {
    eDirectory.Utility.Miscellaneous = {};
}

/**
 * Checks whether or not an element is visible within the viewport
 * @param element
 * @param percentage
 * @returns {bool}
 */
eDirectory.Utility.Miscellaneous.isElementVisible = function (element, percentage) {

    if (typeof jQuery === "function" && element instanceof jQuery) {
        element = element[0];
    }

    var borders = element.getBoundingClientRect();

    if(percentage){
        percentage = eDirectory.Utility.Miscellaneous.clamp(percentage, 0, 100);

        if(percentage > 1 && percentage <= 100) {
            percentage /= 100;
        }

        var widthChunk = percentage * borders.width;
        var heightChunk = percentage * borders.height;

        borders = {
            top: borders.top + heightChunk,
            bottom: borders.bottom - heightChunk,
            left: borders.left + widthChunk,
            right: borders.right - widthChunk
        };
    }

    var vWidth  = window.innerWidth || doc.documentElement.clientWidth;
    var vHeight = window.innerHeight || doc.documentElement.clientHeight;
    var efp     = function (x, y) { return document.elementFromPoint(x, y) };

    if (borders.right < 0 || borders.bottom < 0 || borders.left > vWidth || borders.top > vHeight)
        return false;

    return (
        element.contains(efp(borders.left,  borders.top))
        ||  element.contains(efp(borders.right, borders.top))
        ||  element.contains(efp(borders.right, borders.bottom))
        ||  element.contains(efp(borders.left,  borders.bottom))
    );
};

/**
 * Forces a number to fit within a certain maximum and mininum
 * @param number
 * @param min
 * @param max
 * @returns {number}
 */
eDirectory.Utility.Miscellaneous.clamp = function (number, min, max) {
    /* Just to be sure... */
    if(min > max){
        var transport = max;
        max = min;
        min = transport;
    }

    return Math.min(Math.max(number, min), max);
};

/**
 * Checks if the browser being used is mobile
 * @returns {boolean}
 */
eDirectory.Utility.Miscellaneous.isMobile = function (){
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};
