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
	# * FILE: /includes/code/leadeditor.php
	# ----------------------------------------------------------------------------------------------------

    require(CLASSES_DIR."/class_Formbuilder.php");

    if ($_GET["action"] == "load") {
        
        $editorFolder = EDIRECTORY_ROOT."/custom/domain_".$_GET["domain_id"]."/editor/lead";
    
        if (!is_dir($editorFolder)) {
            //create folder custom/domain_x/editor/lead
            
            $editorFolderAux = EDIRECTORY_ROOT."/custom/domain_".$_GET["domain_id"]."/editor";
            
            if (!mkdir($editorFolderAux)) {
                $errorFolder = true;
            }
            
            if (!mkdir($editorFolder)) {
                $errorFolder = true;
            }
        }
        
        $jsonstr = "";
        if (file_exists($editorFolder."/save.json")) {
            $jsonstr = file_get_contents($editorFolder."/save.json");
        }
        $arrayJson = array('form_structure' => $jsonstr);
        $form = new Formbuilder($arrayJson);
        $form->render_json();
        exit;
        
    } elseif ($_GET["action"] == "save") {
        
        $editorFolder = EDIRECTORY_ROOT."/custom/domain_".$_GET["domain_id"]."/editor/lead";
    
        if (!is_dir($editorFolder)) {
            //create folder custom/domain_x/editor/lead
            if (!mkdir($editorFolder)) {
                $errorFolder = true;
            }
        }
        
        $form_data = isset($_POST['frmb']) ? $_POST : false;
        $form = new Formbuilder($form_data);
        $arrayJson = $form->get_encoded_form_array();
        file_put_contents($editorFolder."/save.json", $arrayJson["form_structure"]);
        exit;
    }
    
    $domainObj = new Domain(SELECTED_DOMAIN_ID);
    $domainURL = "http://".$domainObj->getString("url")."/".ALIAS_LEAD_URL_DIVISOR."/";

?>