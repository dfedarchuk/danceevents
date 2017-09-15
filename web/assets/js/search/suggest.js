/* Checks namespace existence */
if (typeof eDirectory == 'undefined') {
    eDirectory = {};
}

if (typeof eDirectory.Search == 'undefined') {
    eDirectory.Search = {};
}

/**
 * Default cookie name for what input
 * @type {string}
 */
eDirectory.Search.whatCookieName = "edirectory_searchQuery_what";

/**
 * Default cookie name for where input
 * @type {string}
 */
eDirectory.Search.whereCookieName = "edirectory_searchQuery_where";

/**
 * Default cookie name for where input
 * @type {string}
 */
eDirectory.Search.whenCookieName = "edirectory_searchQuery_when";

/**
 * Stores the page in which the cookies will take effect
 * @type {string}
 */
eDirectory.Search.targetCookieName = "edirectory_searchQuery_targetpage";

/**
 * Creates a suggest field
 * @param field The JQuery selector of an text input
 * @param typeaheadConfigs The input configurations for Typeahead
 * @param bloodhoundConfigs The bloodhound configurations for Typeahead
 * @param urlProvider
 * @param cookieName
 * @constructor
 */
eDirectory.Search.Suggest = function (field, bloodhoundConfigs, typeaheadConfigs, urlProvider, cookieName) {
    this.field = field;
    this.bloodhoundConfigs = bloodhoundConfigs;
    this.typeaheadConfigs = typeaheadConfigs;
    this.urlProvider = urlProvider;
    this.cookieName = cookieName;

    this.value = {
        setBy: "unset",
        friendlyUrl: "",
        itemType: ""
    };
};

/**
 * Sets the field's internal value
 * @param whoSet
 * @param whatFriendlyUrl
 * @param module
 */
eDirectory.Search.Suggest.prototype.setInternalValue = function(whoSet, whatFriendlyUrl, module){
    this.value.setBy = (whoSet ? whoSet : null);
    this.value.friendlyUrl = (whatFriendlyUrl ? whatFriendlyUrl : null);
    this.value.itemType = (module ? module : null);
};

eDirectory.Search.Suggest.prototype.initialize = function(){
    if( this.field ){
        var instance = this;

        if( this.typeaheadConfigs && this.bloodhoundConfigs ) {
            this.field.typeahead( this.typeaheadConfigs, this.bloodhoundConfigs);

            this.field.bind('typeahead:select', function(ev, suggestion) {
                var infos = suggestion.payload;

                if (infos) {
                    var friendlyUrl = infos.friendlyUrl;
                    var type = infos.type;
                    var id = infos.id;

                    if (!type && !id){
                        instance.setInternalValue("typeahead", friendlyUrl, null);
                    }
                    switch( eDirectory.Search.Utility.getSuggestionType(type) ){
                        case "item" :
                            $.post( instance.urlProvider, { item: friendlyUrl, itemtype: type }).done(function (response) {
                                if (response.status) {
                                    window.location = response.url;
                                } else {
                                    /* This means the controller was not able to create an url for this combination */
                                    instance.setInternalValue("user", null, null);
                                    instance.field.typeahead('val', suggestion.text);
                                }
                            });

                            break;
                        case "category" :
                            instance.setInternalValue("typeahead", friendlyUrl, type);
                            break;
                    }
                }
            });

            this.field.bind('keyup', function(event) {
                var code = (event.keyCode ? event.keyCode : event.which);

                switch (code){
                    case 9:  /* Tab */
                    case 13: /* Enter */
                    case 27: /* Esc */
                    case 37: /* Left arrow */
                    case 38: /* Up arrow */
                    case 39: /* Right arrow */
                    case 40: /* Left arrow */
                        break;
                    default : /* Everything else */
                        if( instance.value.setBy !== "user" ){
                            instance.setInternalValue("user", null, null);
                        }
                        break;
                }
            });

            if(instance.field.data("prefill") != 0){
                var targetcookieValue  = Cookies.get(eDirectory.Search.targetCookieName);

                var typedCookieName = this.cookieName + "_typed";
                var cookieValue  = Cookies.get(typedCookieName);

                var internalCookieName = this.cookieName + "_internal";
                var internalValue  = Cookies.get(internalCookieName);;

                if( internalValue ) {
                    instance.value = JSON.parse(internalValue);
                }

                if(cookieValue){
                    this.field.typeahead('val', cookieValue);
                }

                if( window.location.pathname.indexOf(targetcookieValue) < 0){
                    Cookies.remove(eDirectory.Search.targetCookieName);
                    Cookies.remove(typedCookieName);
                    Cookies.remove(internalCookieName);
                }
            }
        } else {
            console.log("Error: typeahead configurations were not properly set.");
        }
    }
};
