<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/headertag.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	unset($headertag_templateObj);
	unset($headertag_categoryObj);
	unset($extra_headertag_title);
	unset($extra_headertag_title_keyword);
	unset($extra_headertag_title_where);
	unset($extra_headertag_title_template);
	unset($extra_headertag_title_category);
	unset($extra_headertag_title_location);
	unset($extra_headertag_title_zip);
	unset($extra_headertag_title_screen);
	unset($extra_headertag_title_page);

	unset($aux_get_header_tag);
	$aux_get_header_tag = array();
	if (!$headertag_title) {
		$aux_get_header_tag[] = "name = 'header_title'";
	}

	if (!$headertag_author) {
		$aux_get_header_tag[] = "name = 'header_author'";
	}

	if (!$headertag_description) {
		$aux_get_header_tag[] = "name = 'header_description'";
	}

	if (!$headertag_keywords) {
		$aux_get_header_tag[] = "name = 'header_keywords'";
	}

	$return_headertag = customtext_getByArray($aux_get_header_tag);
	if (is_array($return_headertag)) {
		
		extract($return_headertag);
		
		if (array_key_exists ("header_title", $return_headertag)) {
			$headertag_title = (($header_title) ? ($header_title) : (EDIRECTORY_TITLE));
		}
		
		if (array_key_exists ("header_author", $return_headertag)) {
			$headertag_author = (($header_author) ? ($header_author) : ("Arca Solutions"));
		}
		
		if (array_key_exists ("header_description", $return_headertag)) {
			$headertag_description = (($header_description) ? ($header_description) : (EDIRECTORY_TITLE));
		}
		
		if (array_key_exists ("header_keywords", $return_headertag)) {
			$headertag_keywords	= (($header_keywords) ? ($header_keywords) : EDIRECTORY_TITLE);
		}
		
	}
	
	if ($extra_headertag_title) {
		$headertag_title = $extra_headertag_title.$headertag_title ;
	}


	unset($headertag_templateObj);
	unset($headertag_categoryObj);
	unset($locationsTag);
	unset($extra_headertag_title);
	unset($extra_headertag_title_keyword);
	unset($extra_headertag_title_where);
	unset($extra_headertag_title_template);
	unset($extra_headertag_title_category);
	unset($extra_headertag_title_location);
	unset($extra_headertag_title_zip);
	unset($extra_headertag_title_screen);
	unset($extra_headertag_title_page);