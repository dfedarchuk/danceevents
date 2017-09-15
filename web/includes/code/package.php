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
	# * FILE: /includes/code/package.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$_POST["title"] = trim($_POST["title"]);
		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);

		if (validate_form("package", $_POST, $message_package)) {

			if ($_POST["id"]) {
				unset($packageObj);
				$packageObj = new Package($_POST["id"]);
				$packageItemObj = new PackageItems("",$_POST["id"]);
				$image_id = $packageObj->getNumber("image_id");
				$thumb_id = $packageObj->getNumber("thumb_id");
				$message = 1;
			} else {
				unset($packageObj);
				$packageObj = new Package();
				$packageItemObj = new PackageItems();
				$image_id = 0;
				$thumb_id = 0;
				$message = 0;
			}

			//Clean Image
			if ($remove_image) {
				if ($idm = $packageObj->getNumber("image_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				if ($idm = $packageObj->getNumber("thumb_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
			}

			if ($_FILES['image']['name'] && $_FILES['image']['tmp_name'] && !$_FILES['image']['error']) {
                $imageArray = image_uploadForItem($_FILES['image']['tmp_name'], "sitemgr_", IMAGE_PACKAGE_FULL_WIDTH, IMAGE_PACKAGE_FULL_HEIGHT, IMAGE_PACKAGE_THUMB_WIDTH, IMAGE_PACKAGE_THUMB_HEIGHT);
                if ($imageArray["success"]) {
                    $upload_image = "success";
                    $remove_image = false;
                } else {
                    $upload_image = "failed";
                }
            }

            if ($upload_image != "failed") {

				/*
				 * Saving package
				 */
				$packageObj->setString("title",$_POST["title"]);
				$packageObj->setNumber("parent_domain",$_POST["offer_domain_id"]);

				/*
				 * Prepare vars to save
				 */
				unset($aux_ordered_item);

				if ($_POST["ordered_item"]) {
					$aux_ordered_item = explode("_",$_POST["ordered_item"]);

					if(is_array($aux_ordered_item)){
						$packageObj->setString("module",$aux_ordered_item[0]);
						$packageObj->setNumber("level",$aux_ordered_item[1]);
					}

				}

				$packageObj->setString("status", $status ? $status : "S");
				$packageObj->setString("show_info", $_POST["show_info"]);
				$packageObj->setString("content", $_POST["content"]);

				if ($upload_image == "success") {
					$packageObj->updateImage($imageArray);
				}

				if ($remove_image) {
					$packageObj->setNumber("image_id", 0);
					$packageObj->setNumber("thumb_id", 0);
				}

				$packageObj->Save();

				/*
				 * When sitemgr edit items of package the old items are deleted and generate a log on PackateItemsLOG
				 * table on Main DB
				 */
				if (sess_getSMIdFromSession()){
					$smAccountObj = new SMAccount(sess_getSMIdFromSession());
					$aux_SMAccount = $smAccountObj->getString("name")." (".$smAccountObj->getString("username").")";
				} else {
					setting_get("sitemgr_username",$sitemgr_email);
					$aux_SMAccount = "Sitemgr"." (".$sitemgr_email.")";
				}

				/*
				 * Save items of package
				 */
				if($_POST["offer_item"] && $_POST["offer_item"] != "custom_package"){
					$aux_offer_item = explode("_",$_POST["offer_item"]);	

					for($i=0;$i<count($_POST["packageItem_domain_id"]);$i++){
						$aux_posted_items[$i]["domain_id"] = $_POST["packageItem_domain_id"][$i];
						$aux_posted_items[$i]["module"]	   = $aux_offer_item[0];
						$aux_posted_items[$i]["level"]	   = $aux_offer_item[1];
						$aux_posted_items[$i]["price"]	   = $_POST["value_domain_".$_POST["packageItem_domain_id"][$i]];
					}

					if(!domain_saveLogForPackageItems($packageObj->getNumber("id"),$aux_posted_items,$aux_SMAccount)){
						$message = 3;
					}
					/****************************************************************************************************/

					for($i=0;$i<count($_POST["packageItem_domain_id"]);$i++){
						unset($packageItemObj);
						unset($array_PackItems);

						$array_PackItems["package_id"] = $packageObj->getNumber("id");
						$array_PackItems["domain_id"] = $_POST["packageItem_domain_id"][$i];
						$array_PackItems["module"] = $aux_offer_item[0];
						$array_PackItems["level"] = $aux_offer_item[1];
						$array_PackItems["price"] = $_POST["value_domain_".$_POST["packageItem_domain_id"][$i]];
						
						$packageItemObj = new PackageItems($array_PackItems);

						$packageItemObj->Save();
					}

				} else if ($_POST["offer_item"] == "custom_package"){

					unset($packageItemObj);
					unset($array_PackItems);
					
					$aux_posted_items[0]["domain_id"] = 0;
					$aux_posted_items[0]["module"] = "custom_package";
					$aux_posted_items[0]["level"] = 0;
					$aux_posted_items[0]["price"] = $_POST["price"];

					if(!domain_saveLogForPackageItems($packageObj->getNumber("id"),$aux_posted_items,$aux_SMAccount)){
						$message = 3;
					}

					$array_PackItems["package_id"] = $packageObj->getNumber("id");
					$array_PackItems["domain_id"] = 0;
					$array_PackItems["module"] = "custom_package";
					$array_PackItems["level"] = 0;
					$array_PackItems["price"] = $_POST["price"];

					$packageItemObj = new PackageItems($array_PackItems);

					$packageItemObj->Save();

				}

				

				/*
				 * Return to manage page
				 */
				header("Location: index.php?page=package&process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
				exit;
			} else if ($upload_image == "failed") $message_package .= system_showText(LANG_MSG_INVALID_IMAGE_TYPE);
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
    
	if ($id) {

		/*
		 * Create object to edit
		 */
		unset($packageObj,$title,$parent_domain,$ordered_item);
		$packageObj = new Package($id);

		$title = $packageObj->getString("title");
		$parent_domain = $packageObj->getNumber("parent_domain");
		$ordered_item = $packageObj->getString("module")."_".$packageObj->getNumber("level");
		$show_info = $packageObj->getString("show_info");

		$content = $packageObj->getNumber("content");
		$image_id = $packageObj->getNumber("image_id");
		$thumb_id = $packageObj->getNumber("thumb_id");

		/*
		 * Get items of package
		 */
		unset($packageItemObj);
		$packageItemObj = new PackageItems();

		$array_package_items = $packageItemObj->getItemsByPackageId($id);

		if(is_array($array_package_items)){
			if ($array_package_items[0]["level"])
				$offer_item = $array_package_items[0]["module"]."_".$array_package_items[0]["level"];
			else
				$offer_item = $array_package_items[0]["module"];
			$price = $array_package_items[0]["price"];
	
			unset($aux_package_items_domains,$aux_package_items_values);
			for($i=0;$i<count($array_package_items);$i++){
				$aux_package_items_domains[] = $array_package_items[$i]["domain_id"];
				$aux_package_items_values[$array_package_items[$i]["domain_id"]] = $array_package_items[$i]["price"];

			}
		}
		
	} else {
		$aux_package_items_domains = $_POST["packageItem_domain_id"];
	}

    // Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E" && $arrayValue[$i] != "P") {
			$arrayValueDD[] = string_ucwords($arrayValue[$i]);
			$arrayNameDD[] = string_ucwords($arrayName[$i]);
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, (is_object($packageObj) ? $packageObj->getString("status") : $status), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	/*
	 * Get items and levels of domain
	 */
	unset($array_option_id_actual);
	$array_dropdown_module_level_actual = domain_DropDownModuleDomain();

	/*
	 * Use this array to get common items in domains
	 */
	for($i=0;$i<count($array_dropdown_module_level_actual);$i++){
		$array_option_id_actual[] = $array_dropdown_module_level_actual[$i]["option_id"];
	}

	/*
	 * Get common items and levels of all domains
	 */
	$aux_domainObj = new Domain();
	$array_fields[] = "id";
	$array_fields[] = "name";
	$array_domains = $aux_domainObj->getAllDomains($array_fields, 'A');
	
	/*
	 * Get all items of domain
	 */
	$array_commom_domain = domain_CommonModuleLevel($array_domains,$array_option_id_actual,true);
	
?>