function enableCustomLink(liID) {
    if ($("#dropdown_link_to_"+liID).val() == "custom") {
        $("#custom_link_"+liID).prop('disabled', '');
        $("#custom_link_"+liID).css('background-color', '#FFFFFF');
    } else {
        $("#custom_link_"+liID).prop('disabled', 'true');
        $("#custom_link_"+liID).css('background-color', '#f0f0f0');
    }
}

/*
 * Serialize and submit form through the submit button
 */
function serialize() {
    var ids = $("#sortable").sortable("toArray");

    $("#SaveByAjax").val("false");
    $("#order_options").attr("value", ids);
    $("#navigation").submit();
}

/*
 * Remove item from menu
 *
 * Param string id
 * Param boolean checkCounter
 */
function removeItem(id, checkCounter) {
    //Remove item
    $("#"+id).remove();
    if (checkCounter) {
        //Update preview
        updatePreview();
        //Validate available options
        disableDropdown();
        var limitItems = $("#limitItems").val();
        //Show "Add menu item" if available
        if ($("#sortable li").length <= limitItems) {
            $("#add_item").css("display", "");
        }
    }
}

/*
 * Auxiliary function to replace all occurrences of a string
 *
 * Param string string
 * Param string token
 * Param string newtoken
 *
 * Return string string
 */
function replaceAll(string, token, newtoken) {
    while (string.indexOf(token) != -1) {
        string = string.replace(token, newtoken);
    }
    return string;
}

/*
 * Add new item to the menu
 *
 * Param boolean checkCounter
 */
function CreateNewItem(checkCounter) {
    //HTML structure to create a new element on the list
    var LiText = $("#aux_litext").html();
    //Replace ids for the next id available (counter)
    LiText = replaceAll(LiText, "LI_ID", $("#aux_count_li").val());

    //Add item to the menu
    if ($("#sortable").find('.static:first').length) {
        $("#sortable").find('.static:first').after(LiText);
    } else {
        $("#sortable").append(LiText);
    }

    //Initialize selectize - Site Navigation only
    if ($('#dropdown_link_to_' + $("#aux_count_li").val()).length && $('#dropdown_link_to_' + $("#aux_count_li").val()).parent().attr('class') != 'list-edit') {
        var $select = $('#dropdown_link_to_' + $("#aux_count_li").val()).selectize({});
        var selectize1 = $select[0].selectize;
    }

    //Increase total items amount
    var countLi = parseInt($("#aux_count_li").val());
    $("#aux_count_li").val(countLi+1);

    //Check total items amount and hide "Add menu item" if reached the limit
    if (checkCounter) {
        disableDropdown();
        var limitItems = $("#limitItems").val();
        if ($("#sortable li").length >= limitItems) {
            $("#add_item").css("display", "none");
        }
    }
}

/*
 * Triggered when new items are created, deleted or changed.
 * Updates the iOS tab bar / Android menu preview.
 *
 * Param misc obj
 */
function updatePreview(obj) {
    var i = 0;
    //Amount of items on the menu
    var totalItems = $("#aux_count_li").val();

    //Remove class active for all menus (iOS preview)
    $(".cover-preview-image .tab-bar span").removeClass("active");

    //Run through all input texts getting the current label
    $('#sortable li input:text').each(function() {
        //Current text
        var text = $(this).prop("value");
        //Fix to keep the circles aligned if the input is empty (iOS preview)
        if (!text) {
            text = "&nbsp;";
        }

        //iOS preview - Add class active to the current item being updated
        if (obj && obj.value == text) {
            $("#preview_box_apple_"+i).addClass("active");
        }
        //Show the menu option and updates its content
        $("#preview_box_apple_"+i).css("display", "");
        $("#preview_label_apple_"+i).html(text);

        //Android preview - Add class active to the current item being updated
        if (obj && obj.value == text) {
            $("#preview_box_android_"+i).addClass("active");
        }
        //Show the menu option and updates its content
        $("#preview_box_android_"+i).css("display", "");
        $("#preview_label_android_"+i).html(text);
        i++;
    });
    //iOS Preview - Show/hide "More" according to the amount of items
    if (i >= 5) {
        $("#menusamplemore").css("display", "");
    } else {
        $("#menusamplemore").css("display", "none");
    }
    //Hide menus from the preview if they were deleted
    if (i < totalItems) {
        for (j = i; j< totalItems; j++) {
            $("#preview_box_apple_"+j).css("display", "none");
            $("#preview_box_android_"+j).css("display", "none");
        }
    }
}

/*
 * Triggered when new items are created, deleted or changed.
 * Run through all current selected options and disable options that are already in use.
 * Avoid two links pointing to the same section.
 */
function disableDropdown() {
    //Run through all dropdowns elements
    $("#sortable li select").each(function() {
        var selectId = $(this).attr("id");
        //Run through all options for each dropdown
        $("#" + selectId + " option").each(function() {

            var this_objOption = $(this);
            //Enable option by default
            this_objOption.prop("disabled", "");

            //Run again through all dropdowns elements checking the selected option
            $("#sortable li select option:selected").each(function() {


                //Check if the selected option is the same as this_objOption. If true, disable this_objOption
                if ($(this).val() == this_objOption.val() && selectId != $(this).parent().attr("id")) {
                    this_objOption.prop("disabled", "disabled");
                }
            });

        });

    });
}

/*
 * Remove the delete option when the selected option for the menu is Favorites, About Us or My Account.
 * These sections can't be removed.
 *
 * Param integer id
 */
function checkOption(id) {
    //Get selected value
    var selected = $("#dropdown_link_to_" + id + " option:selected").val();

    //Sets a default value to the field if the user hasn't inserted any. Updates the preview.
    var linkedinput = $("#navigation_text_" + id );
    if( linkedinput.val() == "" )
    {
        linkedinput.val( $("#dropdown_link_to_" + id + " option:selected").html() );
        updatePreview( linkedinput.get( 0 ) );
        updateItem( id, linkedinput.get( 0 ) );
    }

    //Check if needs to remove delete button or not
    if (selected == "favorites" || selected == "about" || selected == "account") {
        $("#remove_item"+id).css("display", "none");
    } else {
        $("#remove_item"+id).css("display", "");
    }
}
