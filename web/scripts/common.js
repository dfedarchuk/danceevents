function easyFriendlyUrl(strToReplace, target, validchars, separator) {
    var str = "";
    var i;
    var str_accent = LETTERS_CHARS_ACCENT;
    var str_no_accent = LETTERS_CHARS_NO_ACCENT;
    var str_new = "";

    for (i = 0; i < strToReplace.length; i++) {
        if (str_accent.indexOf(strToReplace.charAt(i)) != -1) {
            str_new += str_no_accent.substr(str_accent.search(strToReplace.substr(i,1)),1);
        } else {
            str_new += strToReplace.substr(i,1);
        }
    }

    var exp_reg = new RegExp("[" + validchars + separator + "]");
    var exp_reg_space = new RegExp("[ ]");
    name2friendlyurl = str_new;
    name2friendlyurl.toString();
    name2friendlyurl = name2friendlyurl.replace(/^ +/, "");

    for (i = 0 ; i < name2friendlyurl.length; i++) {
        if (exp_reg.test(name2friendlyurl.charAt(i))) {
            str = str+name2friendlyurl.charAt(i);
        } else {
            if (exp_reg_space.test(name2friendlyurl.charAt(i))) {
                if (str.charAt(str.length-1) != separator) {
                    str = str + separator;
                }
            }
        }
    }

    if (str.charAt(str.length-1) == separator) str = str.substr(0, str.length-1);
    if (document.getElementById(target))
    document.getElementById(target).value = str.toLowerCase();
}

function showText(text) {
	return unescape(text);
}

function JS_removeCategory(feed, order) {
    if (feed.selectedIndex >= 0) {
        $('#categoryAdd'+feed.options[feed.selectedIndex].value).after($('.categorySuccessMessage').empty());
        $('#categoryAdd'+feed.options[feed.selectedIndex].value ).fadeIn(500);
        feed.remove(feed.selectedIndex);
        if (order){
            orderCalculate();
        }
    }

	if(feed.length == 0){
    	$('#removeCategoriesButton').hide();
    }

}

function itemInQuicklist (elem, action, user, item, type) {
	if (user && item && type) {

		$.post(DEFAULT_URL + "/profile/index.php", {
			type_action: 'save',
			from: 'Quicklist',
			action: action,
			account_id: user,
			item_id: item,
			item_type: type
		}, function () {
			if (action == "add") {
				alert(LANG_JS_FAVORITEADD);
			} else {
                $(elem).parent('div').fadeOut();
			}
		});


	}
}

/*
 * Copy one field's value to another
 */
function populateField(value, target, testReplace) {
    if (testReplace) {
        if ($('#'+target).val()) {
            return;
        } else {
            $('#'+target).val(value);
        }
    } else {
        $('#'+target).val(value);
    }
}

function in_array (x, matriz) {
	var txt = "¬" + matriz.join("¬") + "¬";
	var er = new RegExp ("¬" + x + "¬", "gim");
	return ( (txt.match (er)) ? true : false );
}

function scrollPage(position_id){
	if(!position_id){
		$position_id = '#resultsMap';
	}else {
		$position_id = position_id;
	}
	$('html, body').animate({scrollTop: $($position_id).offset().top},'slow');
}

function urlencode( str ) {

    var histogram = {}, tmp_arr = [];
    var ret = (str+'').toString();

    var replacer = function(searchT, replace, str) {
        var tmp_arr = [];
        tmp_arr = str.split(searchT);
        return tmp_arr.join(replace);
    };

    // The histogram is identical to the one in urldecode.
    histogram["'"]   = '%27';
    histogram['(']   = '%28';
    histogram[')']   = '%29';
    histogram['*']   = '%2A';
    histogram['~']   = '%7E';
    histogram['!']   = '%21';
    histogram['%20'] = '+';
    histogram['\u20AC'] = '%80';
    histogram['\u0081'] = '%81';
    histogram['\u201A'] = '%82';
    histogram['\u0192'] = '%83';
    histogram['\u201E'] = '%84';
    histogram['\u2026'] = '%85';
    histogram['\u2020'] = '%86';
    histogram['\u2021'] = '%87';
    histogram['\u02C6'] = '%88';
    histogram['\u2030'] = '%89';
    histogram['\u0160'] = '%8A';
    histogram['\u2039'] = '%8B';
    histogram['\u0152'] = '%8C';
    histogram['\u008D'] = '%8D';
    histogram['\u017D'] = '%8E';
    histogram['\u008F'] = '%8F';
    histogram['\u0090'] = '%90';
    histogram['\u2018'] = '%91';
    histogram['\u2019'] = '%92';
    histogram['\u201C'] = '%93';
    histogram['\u201D'] = '%94';
    histogram['\u2022'] = '%95';
    histogram['\u2013'] = '%96';
    histogram['\u2014'] = '%97';
    histogram['\u02DC'] = '%98';
    histogram['\u2122'] = '%99';
    histogram['\u0161'] = '%9A';
    histogram['\u203A'] = '%9B';
    histogram['\u0153'] = '%9C';
    histogram['\u009D'] = '%9D';
    histogram['\u017E'] = '%9E';
    histogram['\u0178'] = '%9F';

    // Begin with encodeURIComponent, which most resembles PHP's encoding functions
    ret = encodeURIComponent(ret);

    for (searchT in histogram) {
        replace = histogram[searchT];
        ret = replacer(searchT, replace, ret) // Custom replace. No regexing
    }

    // Uppercase for full PHP compatibility
    return ret.replace(/(\%([a-z0-9]{2}))/g, function(full, m1, m2) {
        return "%"+m2.toUpperCase();
    });

    return ret;
}

function escapeHTML(html) {
    var escape = document.createElement('textarea');
    escape.innerHTML = html;
    return escape.innerHTML;
}

function unescapeHTML(html) {
    var escape = document.createElement('textarea');
    escape.innerHTML = html;
    return escape.value;
}

function showmore(div_id, link_id, total, block) {
    total = total - 1;
    var lastItemToShow = parseInt($("#"+div_id).val());
    for (i = 0; i < block; i++) {
        lastItemToShow = lastItemToShow + 1;
        $("#"+div_id+lastItemToShow).fadeIn(50);
    }
    if (lastItemToShow >= total) {
        $("#"+link_id).css("display", "none");
    }
    $("#"+div_id).attr("value", lastItemToShow);
}

function checkUsername(username, path, option, current_acc) {

	expression = /(&\B)|(^&)|(#\B)|(^#)/;
	if (expression.exec(username)) {
		username = 'erro';
	}

	$.get(DEFAULT_URL + "/search_username.php", {
		option: option,
		username: username,
		path: path,
		current_acc : current_acc
	}, function (response) {
		$('#checkUsername').html($.trim(response));
	});

}

function sendEmailActivation(acc_id) {
    $("#loadingEmail").css("display", "");
    $.get(DEFAULT_URL + "/activationEmail.php", {
        acc_id: acc_id
    }, function (response) {
        $("#loadingEmail").css("display", "none");
        if ($.trim(response) == "ok") {
            $("#messageEmail").css("display", "");
            $("#messageEmailError").css("display", "none");
        } else {
            $("#messageEmail").css("display", "none");
            $("#messageEmailError").html(response);
            $("#messageEmailError").css("display", "");
        }
    });
}
