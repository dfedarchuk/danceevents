    function setLocationSelect () {
		var arrayIds = new Array();
		var n_checked = 0;

		var val = 0;
		var input = "";

		for (i=0; i < document.item_list.elements.length ; i++) {
			if (document.item_list.elements[i].name == "item_check[]") {
				if (document.item_list.elements[i].checked) {
					arrayIds[n_checked] = document.item_list.elements[i].value;

					val = document.item_list.elements[i].value;
					$('#location_' + val).remove();
					input = document.createElement('input');
					input.setAttribute('type', 'hidden');
					input.setAttribute('id', 'location_' + val);
					input.setAttribute('name', 'location_id[]');
					input.setAttribute('value', val);
					$('#form-bulk').append(input);

					n_checked++;
				} else {
					val = document.item_list.elements[i].value;
					$('#location_' + val).remove();
				}
			}
		}
	}

    function checkAll(type, obj, link, num) {

		var value = obj.checked;
		var val = 0;
		var input = "";

		if(link == true){
			if(value == true){
				obj.checked = false;
				value = false;
				for (i=1;i<=num;i++) {
					document.getElementById(type+'_id'+i).checked = false;
					val = document.getElementById(type+'_id'+i).value;
					$('#' + type + '_' + val).remove();
				}
			} else {
				obj.checked = true;
				value = true;

				for (i=1;i<=num;i++) {
					val = document.getElementById(type+'_id'+i).value;
					document.getElementById(type+'_id'+i).checked = true;

					input = document.createElement('input');
					input.setAttribute('type', 'hidden');
					input.setAttribute('id', type + '_' + val);
					input.setAttribute('name', type + '_id[]');
					input.setAttribute('value', val);
					$('#form-bulk').append(input);
				}
			}
		} else {
			if(value == true){
				obj.checked = true;
				value = true;

				for (i=1;i<=num;i++) {
					if (document.getElementById(type+'_id'+i)) {
						val = document.getElementById(type+'_id'+i).value;
						document.getElementById(type+'_id'+i).checked = true;

						input = document.createElement('input');
						input.setAttribute('type', 'hidden');
						input.setAttribute('id', type + '_' + val);
						input.setAttribute('name', type + '_id[]');
						input.setAttribute('value', val);
						$('#form-bulk').append(input);
					}
				}
			} else {
				obj.checked = false;
				value = false;
				for (i=1;i<=num;i++) {
					val = document.getElementById(type+'_id'+i).value;
					document.getElementById(type+'_id'+i).checked = false;
					$('#' + type + '_' + val).remove();
				}
			}
		}
	}

	function bulkSelect(type) {

		var arrayIds = new Array();
		var n_checked = 0;

		var val = 0;
		var input = "";

		for (i=0; i < document.item_list.elements.length ; i++) {
			if (document.item_list.elements[i].name == "item_check[]") {
				if (document.item_list.elements[i].checked) {
					arrayIds[n_checked] = document.item_list.elements[i].value;

					val = document.item_list.elements[i].value;
					$('#' + type + '_' + val).remove();
					input = document.createElement('input');
					input.setAttribute('type', 'hidden');
					input.setAttribute('id', type + '_' + val);
					input.setAttribute('name', type + '_id[]');
					input.setAttribute('value', val);
					$('#form-bulk').append(input);

					n_checked++;
				} else {
					val = document.item_list.elements[i].value;
					$('#' + type + '_' + val).remove();
				}
			}
		}
        if (n_checked > 0){
            $("#deleteAllButton").removeClass("hidden");
        } else {
            $("#deleteAllButton").addClass("hidden");
        }
        closeView();

	}

	function disableBulkOptions(obj) {

		var value = obj.checked;

		if (value == true) {
            if (document.getElementById('change_no_owner')) {
                document.getElementById('change_no_owner').disabled = true;
            }
			if (document.getElementById('level')) {
				document.getElementById('level').disabled = true;
			}
			if (document.getElementById('status')) {
				document.getElementById('status').disabled = true;
			}
			if (document.getElementById('change_renewaldate')) {
				document.getElementById('change_renewaldate').disabled = true;
			}
			if (document.getElementById('add_category_id')) {
				document.getElementById('add_category_id').disabled = true;
			}
			if (document.getElementById('tr_category')) {
				if (document.getElementById('tr_category').style.display == "") {
					if (document.getElementById('removecategory')) {
						document.getElementById('removecategory').disabled = true;
					}
				}
			}
            if (document.getElementById('change_account_search')) {
                document.getElementById('change_account_search').href = "javascript:void(0);";
            }
			if (document.getElementById('section_general')) {
				document.getElementById('section_general').disabled = true;
			}
			if (document.getElementById('section_listing')) {
				document.getElementById('section_listing').disabled = true;
			}
			if (document.getElementById('section_event')) {
				document.getElementById('section_event').disabled = true;
			}
			if (document.getElementById('section_classified')) {
				document.getElementById('section_classified').disabled = true;
			}
			if (document.getElementById('section_article')) {
				document.getElementById('section_article').disabled = true;
			}
			if (document.getElementById('section_global')) {
				document.getElementById('section_global').disabled = true;
			}

		} else {
            if (document.getElementById('change_no_owner')) {
                document.getElementById('change_no_owner').disabled = false;
            }
			if (document.getElementById('level')) {
				document.getElementById('level').disabled = false;
			}
			if (document.getElementById('status')) {
				document.getElementById('status').disabled = false;
			}
			if (document.getElementById('change_renewaldate')) {
				document.getElementById('change_renewaldate').disabled = false;
			}
			if (document.getElementById('add_category_id')) {
				document.getElementById('add_category_id').disabled = false;
			}
			if (document.getElementById('tr_category')) {
				if (document.getElementById('tr_category').style.display == "none") {
					if (document.getElementById('removecategory')) {
						document.getElementById('removecategory').disabled = false;
					}
				}else{
					document.getElementById('removecategory').disabled = false;
				}
			}
            if (document.getElementById('change_account_search')) {
                document.getElementById('change_account_search').href = "javascript:changeAccount()";
            }
			if (document.getElementById('section_general')) {
				document.getElementById('section_general').disabled = false;
			}
			if (document.getElementById('section_listing')) {
				document.getElementById('section_listing').disabled = false;
			}
			if (document.getElementById('section_event')) {
				document.getElementById('section_event').disabled = false;
			}
			if (document.getElementById('section_classified')) {
				document.getElementById('section_classified').disabled = false;
			}
			if (document.getElementById('section_article')) {
				document.getElementById('section_article').disabled = false;
			}
			if (document.getElementById('section_global')) {
				document.getElementById('section_global').disabled = false;
			}
		}
	}

    function confirmBulk(msg_id) {
        $("#alert_delete").css("display", "none");
        $("#alert_update").css("display", "none");
        $("#alert_"+msg_id).css("display", "");
        document.getElementById("bulkSubmit").value = "Submit";
    }

    /**
     * Submit changed term information for bulk update of all selected terms
     * Adds the changed term to the list
     *
     * @param termId
     * @param msg_id
     */
    function submitTermMap(termId, msg_id)
    {
        if (termId) {
            var checkboxElement = $("input[name^=item_check][value=" + termId + "]");

            if (!checkboxElement.is(":checked") && termId) {
                checkboxElement.prop("checked", true);

                var type = $("#bulkListType").val();
                var input = document.createElement('input');

                input.setAttribute('type', 'hidden');
                input.setAttribute('id', type + '_' + termId);
                input.setAttribute('name', type + '_id[]');
                input.setAttribute('value', termId);

                $('#form-bulk').append(input);
            }
        }
        /* save information on form */
        $("#latitude").val($("#latitude"+termId).val());
        $("#longitude").val($("#longitude"+termId).val());
        $("#radius").val($("#radius"+termId).val());

        $("#action").val(msg_id);
        confirmBulk(msg_id)

        $("#form-bulk").submit();
    }
