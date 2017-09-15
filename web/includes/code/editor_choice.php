<?

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
	# * FILE: /includes/code/editor_choice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$message_editorchoice = "";
	$message_error_editorchoice = "";

	if ($_POST["editorchoice"] == "Submit") {

		foreach ($_POST['name'] as $k => $name) {
			$i = $k+1;
			if (($name && (!$_FILES["file$i"]["tmp_name"] && !$_POST['image'][$k])) || (!$name && ($_FILES["file$i"]["tmp_name"] || $_POST['image'][$k]))) {
				$message_error_editorchoice .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_MSGERROR_REQUIREDTOFINISHUPDATE1)." ".($k+1)." ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_MSGERROR_REQUIREDTOFINISHUPDATE2)."<br />";
			}
		}
		if (!$message_editorchoice && !$message_error_editorchoice) {

			foreach ($_POST['name'] as $k => $name) {
				$i = $k+1;
				unset($editorChoiceObj);
				$editorChoiceObj = new EditorChoice($_POST['choice'][$k]);
				if ($name) {
					if ($_FILES["file$i"]["tmp_name"] && $_FILES["file$i"]["error"] == 0) {
						
                        unset($imageArray);
                        $imageArray = image_uploadBadges($_FILES["file$i"]["tmp_name"], "sitemgr_", IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT);
                        if ($imageArray["success"]) {
                            unset($imageObj);
                            if ($editorChoiceObj->image_id) {
                                $imageObj = new Image($editorChoiceObj->image_id);
                                if ($imageObj) $imageObj->Delete();
                            }
                            unset($imageObj);
                            $editorChoiceObj->image_id = $imageArray["image_id"];
                        }
                        
					}
                    
					$editorChoiceObj->name = $name;
					$editorChoiceObj->available = ($_POST["available_$k"]) ? "1" : "0";
					$editorChoiceObj->save();
					unset($editorChoiceObj);
					$name = str_replace("\\", "",$name);
				}
			}

			$message_editorchoice = system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONWASUPDATED);
		}
	}