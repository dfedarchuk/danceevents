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
	# * FILE: /includes/code/clicktocall.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	$enableSave = false;

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if($_POST["item_clicktocall_number"] && $_POST["item_title"]){
			
			if($_POST["action_clicktocall"] == "addCallerID"){
				/**
				 * Don't work to extension
				if($_POST["item_clicktocall_extension"]){
					$extension = $_POST["item_clicktocall_extension"];
				}else{
					$extension = false;
				}
				*/
				//$response = twilio_AddCalledID($_POST["item_title"], $_POST["item_clicktocall_number"], $extension);
				$response = twilio_AddCalledID($_POST["item_title"], $_POST["item_clicktocall_number"], false);
				
				if($response->IsError){
					$error = true;
					$message = system_showText(constant("LANG_TWILIO_ERROR_".$response->ResponseXml->RestException->Code));				
				}else{
					$enableSave = true;
					$message = LANG_CLICKTOCALL_YOUR_VALIDATION_CODE." ".$response->ResponseXml->ValidationRequest->ValidationCode;
				}
				
			} elseif($_POST["action_clicktocall"] == "verify_number"){
				
				$response = twilio_CheckCallerID($_POST["item_clicktocall_number"]);

				if($response->IsError){
					$error = true;
					$message = system_showText(constant("LANG_TWILIO_ERROR_".$response->ResponseXml->RestException->Code));				
				}elseif (!$response->ResponseXml->OutgoingCallerIds->OutgoingCallerId->DateCreated){
					$error = true;
					$message = system_showText(LANG_TWILIO_ERROR_10000);
				} else {
					/**
					 * Save number on Listing
					 */
					unset($listingObj);
					$listingObj = new Listing($_POST["id"]);
					
					$date = date_create($response->ResponseXml->OutgoingCallerIds->OutgoingCallerId->DateCreated);
					$listingObj->setDate("clicktocall_date", date_format($date, 'Y-m-d'));
					$listingObj->setString("clicktocall_number", $_POST["item_clicktocall_number"]);
					if($_POST["item_clicktocall_extension"]){
						$listingObj->setString("clicktocall_extension",$_POST["item_clicktocall_extension"]);
					}
					$listingObj->Save();
					$message = 12;
					header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
					exit;
				}
			} elseif($_POST["action_clicktocall"] == "clearNumber"){
				/**
				 * Clear number on Listing
				 */
				unset($listingObj);
				$listingObj = new Listing($_POST["id"]);
				$listingObj->setString("clicktocall_number", "");
				$listingObj->setNumber("clicktocall_extension", 0);
				$listingObj->setDate("clicktocall_date", "");
				$listingObj->Save();
				$message = 13;
				header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
				exit;
			} elseif($_POST["action_clicktocall"] == "copyNumber"){
                /**
                 * Save number on Listing
                 */
                unset($listingObj);
                $listingObj = new Listing($_POST["id"]);
                $listingObj->setDate("clicktocall_date", date('Y-m-d'));
                $listingObj->setString("clicktocall_number", $_POST["item_clicktocall_number"]);
                if($_POST["item_clicktocall_extension"]){
                    $listingObj->setString("clicktocall_extension",$_POST["item_clicktocall_extension"]);
                }
                $listingObj->Save();
                $message = 12;
                header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
                exit;
                
            }
		} else {
			$error = true;
			$message = system_showText(LANG_PHONE_REQUIRED);
		}
		
		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];

	if (is_object($listingObj)){
		$itemObj = $listingObj;
	} else {
		$itemObj = new Listing($id);
	}
	
	if ($id && is_object($itemObj)) {
		$item_title					= addslashes($itemObj->getString("title"));
		$item_clicktocall_number	= $itemObj->getString("clicktocall_number"); 
		$item_clicktocall_extension = $itemObj->getNumber("clicktocall_extension");
	}
	
	extract($_POST);
	extract($_GET);
?>