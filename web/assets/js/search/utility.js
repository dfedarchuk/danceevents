/* Checks namespace existence */
if (typeof eDirectory == 'undefined') {
    eDirectory = {};
}

if (typeof eDirectory.Search == 'undefined') {
    eDirectory.Search = {};
}

if (typeof eDirectory.Search.Utility == 'undefined') {
    eDirectory.Search.Utility = {};
}

eDirectory.Search.Utility.getComplementByType = function ( type ){
    var complement = type;

    switch (type) {
        case "article":            complement = '<span class="pull-right"><i class="text-info fa fa-newspaper-o articleSuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "blog":               complement = '<span class="pull-right"><i class="text-info fa fa-comment blogSuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "classified":         complement = '<span class="pull-right"><i class="text-info fa fa-tag classifiedSuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "deal":               complement = '<span class="pull-right"><i class="text-info fa fa-ticket dealSuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "event":              complement = '<span class="pull-right"><i class="text-info fa fa-calendar eventSuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "listing":            complement = '<span class="pull-right"><i class="text-info fa fa-home listingSuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "articleCategory":    complement = '<span class="pull-right"><i class="text-danger fa fa-dot-circle-o articleCategorySuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "blogCategory":       complement = '<span class="pull-right"><i class="text-danger fa fa-dot-circle-o blogCategorySuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "classifiedCategory": complement = '<span class="pull-right"><i class="text-danger fa fa-dot-circle-o classifiedCategorySuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "eventCategory":      complement = '<span class="pull-right"><i class="text-danger fa fa-dot-circle-o eventCategorySuggestion"></i> <small> %TEXT% </small> </span>'; break;
        case "listingCategory":    complement = '<span class="pull-right"><i class="text-danger fa fa-dot-circle-o listingCategorySuggestion"></i> <small> %TEXT% </small> </span>'; break;
    }

    return complement;
};

eDirectory.Search.Utility.getSuggestionType = function ( type ){
    var response = null;

    switch (type) {
        case "article":
        case "blog":
        case "classified":
        case "deal":
        case "event":
        case "listing":
            response = "item";
            break;
        case "blogCategory":
        case "classifiedCategory":
        case "eventCategory":
        case "listingCategory":
            response = "category";
            break;
    }

    return response;
};

/**
 * Generates a new bloodhoud instance which will retrieve data from sourceUrl
 * @param sourceUrl
 * @returns {Bloodhound}
 */
eDirectory.Search.Utility.createBloodhound = function ( sourceUrl, module ){
    sourceUrl += '?';

    if (module) {
        sourceUrl += 'module=' + module + "&";
    }

    return new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: sourceUrl + 'key=%QUERY',
            wildcard:"%QUERY",
            filter: function (options) { return options.options; },
            rateLimitWait: 100
        }
    });
};

/**
 * Hides filters exceeding a certain threshold and appends a button to show them once again.
 * @param optionList The jquery elements to be collapsed
 * @param viewAllButtonText The text which will appear inside the button. Typically something meaning 'Show More'
 * @param viewAllButtonClass The button's Class. <b>Defaults to "btn-link"</b>
 * @param threshold The maximum number of elements necessary for the collapser to appear. <b>Defaults to 10</b>
 * @param itemElementClass The class which should be added to the itemElement. <b>Defaults to "list-group-item"</b>
 * @param itemElement A string representing the dom element which should be used to display the items. <b>Defaults to "<li>"</b>
 */
eDirectory.Search.Utility.filterCollapser = function ( optionList, viewAllButtonText, viewAllButtonClass, threshold, itemElementClass, itemElement ){
    itemElement = itemElement || "<li>";
    threshold = threshold || 11;
    itemElementClass = itemElementClass || "list-group-item";
    viewAllButtonClass = viewAllButtonClass || "btn-link";

    if (optionList.length > threshold + 1) {

        var viewAllLine = $(itemElement).addClass(itemElementClass);
        var button = $('<button>');

        button.addClass(viewAllButtonClass);
        button.addClass("pull-right btn-block");
        button.html(viewAllButtonText);

        (function(group, button, line){
            button.click(function () {
                group.fadeIn("fast");
                line.remove();
            });
        })(optionList, button, viewAllLine);

        viewAllLine.append(button);
        $(optionList[threshold - 1]).after(viewAllLine);

        for (var j = threshold; j < optionList.length; j++) {
            $(optionList[j]).hide();
        }
    }
};
