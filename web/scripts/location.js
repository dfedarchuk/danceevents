//================================================================================

//================================================================================

function loadLocationSitemgrMembers(url, edir_locations, level, childLevel, id) {

	var edir_locations = edir_locations.split(',');
	
	if (!isNaN(id)) {		

		for (i=0; i<edir_locations.length; i++) {
			if (edir_locations[i]>level) {
				text = $("#l_location_"+edir_locations[i]).text();
				$("#location_"+edir_locations[i]).html("<option id=\"l_location_"+edir_locations[i]+"\" value=\"\">"+text+"</option>");
				$('#div_location_'+edir_locations[i]).css('display', 'none');
				$('#new_location'+edir_locations[i]+'_field').attr('value', '');
				$('#div_new_location'+edir_locations[i]+'_field').css('display', 'none');				
			}
		}	

		$("#div_location_"+childLevel).css("display","");
		$('#location_'+childLevel).css('display', 'none');
		$('#div_img_loading_'+childLevel).css('display', '');
		$('#box_no_location_found_'+childLevel).css('display', 'none');
                try{
                    $('#div_select_'+childLevel).css('display', 'none');
                } catch(e){}

		$.get(url+"/location.php",{id: id, level: level, childLevel: childLevel, type:'byId'},function(location){
			
			if (location!="empty"){
				var text = $("#l_location_"+childLevel).text();			
				$("#location_"+childLevel).html(location);
				$("#l_location_"+childLevel).html(text);
				$('#location_'+childLevel).css('display', '');
                try{
                    $('#div_select_'+childLevel).css('display', '');
                } catch(e){}
				display_level_limit = childLevel;
			} else {
				if (!id) 
					$("#div_location_"+childLevel).css("display", 'none');
				else {
                    try{
                        $('#div_select_'+childLevel).css('display', '');
                    } catch(e){}
					$('#box_no_location_found_'+childLevel).css('display', '');
                }
			}
				
			if (childLevel && id)
				$('#div_new_location'+childLevel+'_link').css('display', '');
			else
				$('#div_new_location'+childLevel+'_link').css('display', 'none');			

			$('#div_img_loading_'+childLevel).css('display', 'none');	
			
		});
	}	
}

function loadLocationsChildtb (url, level, id, childLevel) {
	if (!isNaN(id)) {
		$.get(url+"/location.php",{id: id, level: level, childLevel: childLevel, type:'byId'},function(location){
			var text = $("#l_location_"+childLevel).text();	
			if (location!="empty"){
				$("#select_L"+childLevel).html(location);
				$("#l_location_"+childLevel).html(text);
			} else
				$("#select_L"+childLevel).html('<option id=\"l_location_'+childLevel+'\" value=\"\">'+text+'</option>');
		});
	}

}

function loadAllLocationstb (url, level) {
	$.get(url+"/location.php",{level: level, type:'All'},function(location){
		if (location!="empty"){
			var text = $("#l_location_"+level).text();
			alert('all text: '+text);
			$("#select_L"+level).html(location);
			$("#l_location_"+level).html(text);
		}
	});
}

function loadLocationsChild (url, level, id, childLevel) {

	if (!isNaN(id)) {
		$.get(url+"/location.php",{id: id, level: level, childLevel: childLevel, type:'byId'},function(location){
			var text = $("#l_location_"+childLevel).text();			
			if (location!="empty"){
				$("#default_L"+childLevel+"_id").html(location);
				$("#l_location_"+childLevel).html(text);
			} else
				$("#default_L"+childLevel+"_id").html('<option id=\"l_location_'+childLevel+'\" value=\"\">'+text+'</option>');
		});
	} 
}

function loadAllLocations (url, level) {
	$.get(url+"/location.php",{level: level, type:'All'},function(location){
		if (location!="empty"){
			var text = $("#l_location_"+level).text();			
			$("#default_L"+level+"_id").html(location);
			$("#l_location_"+level).html(text);
		}
	});
}

function formLocations_submit(level, form) {	
	if (level<=3) {		
		for (i=(level+1); i<=4; i++)
			if ($('#select_location'+i).val())
				$('#select_location'+i).remove();
	}
	form.submit();
}

function showNewLocationField(level, edir_locations, back, text) {

	var edir_locations = edir_locations.split(',');

	for (i=0; i<edir_locations.length; i++) {
		if (edir_locations[i]>=level) {
            $('#location_'+edir_locations[i]).val('0');
			$('#div_location_'+edir_locations[i]).css('display', 'none');
			$('#new_location'+edir_locations[i]+'_field').attr('value', '');
			$('#div_new_location'+edir_locations[i]+'_field').css('display', 'none');
		}
	}		
	$('#div_new_location'+level+'_field').css('display', '');	
	$('#div_new_location'+level+'_link').css('display', 'none');
	if (!back)
		$('#div_new_location'+level+'_back').css('display', 'none');
	else
		$('#div_new_location'+level+'_back').css('display', '');

	if (text) {
		$('#new_location'+level+'_field').val(text);
	}

}

function hideNewLocationField(level, edir_locations) {

	var edir_locations = edir_locations.split(',');

	for (i=0; i<edir_locations.length; i++) {
		if (edir_locations[i]>=level) {
            $('#location_'+edir_locations[i]).val('0');
			$('#new_location'+edir_locations[i]+'_field').attr('value', '');
			$('#div_new_location'+edir_locations[i]+'_field').css('display', 'none');
		}
	}	
	$('#div_location_'+level).css('display', '');
	$('#div_new_location'+level+'_link').css('display', '');
    if (!$("#location_"+level).is(":visible")) {
        $('#box_no_location_found_'+level).css('display', '');
    }
}

function fillFieldWhere(location_title){
	if (document.getElementById("where")) {
		if (document.getElementById("where").value != '') {
			document.getElementById("where").value += ', '+location_title;
		} else {
			document.getElementById("where").value += location_title;
		}
	}
    
    //Responsive layout
    if (document.getElementById("where_resp")) {
		if (document.getElementById("where_resp").value != '') {
			document.getElementById("where_resp").value += ', '+location_title;
		} else {
			document.getElementById("where_resp").value += location_title;
		}
	}
}

function fillLocations(levels) {
	/*
	 * Concat where field with selected option
	 */
	var edir_locations = levels.split(',');
    
	if (edir_locations) {
		if (document.getElementById("where")) {
            $("#where, #where_resp").attr("value", "");
		}
		
		if (document.getElementById("locations_default_where")) {
			if (document.getElementById("locations_default_where").value) {
				$("#where, #where_resp").attr("value", $("#locations_default_where").val());
			}
		}
		
		for (i = 0; i < edir_locations.length; i++) {
			if ($("#location_"+edir_locations[i]+" option:selected").val() > 0) {
				fillFieldWhere($("#location_"+edir_locations[i]+" option:selected").text());
			}
		}
	}
}

function clearLocations(levels, has_default, last_default){
	
	var edir_locations = levels.split(',');
	var first_to_show = 0;
	document.getElementById("where").value = "";
	
	for (i=0; i<edir_locations.length; i++) {
		if (i > first_to_show) {
			$('#div_location_'+edir_locations[i]).css('display', 'none');	
		}else{
			$('#div_location_'+edir_locations[i]).css('display', '');
			$("#location_"+edir_locations[i]).prop("selectedIndex", 0);
		}
		
		if (has_default){
			if (edir_locations[i] == last_default){
				first_to_show = i+1;
			}
		}
	}
	
	$('#locations_clear').css('display', 'none');
}