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
	# * FILE: /functions/package_funct.php
	# ----------------------------------------------------------------------------------------------------


	 function package_buying_package($aux_post, $getPackageID = false, $members = false){
		 /*
		 * Get items by package ID
		 */
		unset($packageItemObj);
		$packageItemObj = new PackageItems();

		$contactObj = new Contact($_SESSION["SESS_ACCOUNT_ID"]);
		$account = new Account($_SESSION["SESS_ACCOUNT_ID"]);

		for($i=0;$i<count($aux_post["package_id"]);$i++){
			unset($array_package_items);
			$array_package_items = $packageItemObj->getItemsByPackageId($aux_post["package_id"][$i]);

			$packageObj = new Package($aux_post["package_id"][$i]);
			$packageName = $packageObj->getString("title");
			$itemMailLink = "";

			if($array_package_items){

				for($j=0;$j<count($array_package_items);$j++){

					unset($aux_item_object);

					/*
					 * Check if domain is active
					 */
					unset($aux_domainObj);
					$aux_domainObj = new Domain($array_package_items[$j]["domain_id"]);

                    $aux_domain_id = $array_package_items[$j]["domain_id"];

					if($aux_domainObj->getString("status") == "A" || $aux_domainObj->getString("status") == "P"){

						if ($array_package_items[$j]["module"] != "custom_package") {
							$aux_post["item_friendly_ur"] .= FRIENDLYURL_SEPARATOR.uniqid();
						}

						if ($array_package_items[$j]["module"] == "listing") {
							$aux_item_object = new Listing();
							$aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id", $_SESSION["SESS_ACCOUNT_ID"]);

							setting_get("listing_approve_free", $listing_approve_free);

							if (!$listing_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}

							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendly_ur"]);
							$aux_item_object->setNumber("listingtemplate_id",$aux_post["listingtemplate_id"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);

							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"), $domain_url);
							$itemMailLink .= ucfirst(LISTING_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/listing.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/listing.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "event"){
							$aux_item_object = new Event();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);

							setting_get("event_approve_free", $event_approve_free);

							if (!$event_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}

							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendly_ur"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(EVENT_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/event.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/".SITEMGR_ALIAS."/content/".EVENT_FEATURE_FOLDER."/event.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "article"){
							$aux_item_object = new Article();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);

							setting_get("article_approve_free", $article_approve_free);

							if (!$article_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}

							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendly_ur"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(ARTICLE_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/".SITEMGR_ALIAS."/content/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "classified"){
							$aux_item_object = new Classified();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);

							setting_get("classified_approve_free", $classified_approve_free);

							if (!$classified_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}

							$aux_item_object->setString("title",$aux_post["item_name"]);
							$aux_item_object->setString("friendly_url",$aux_post["item_friendly_ur"]);
							$aux_item_object->setNumber("level",$array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id",$array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price",$array_package_items[$j]["price"]);
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(CLASSIFIED_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/".SITEMGR_ALIAS."/content/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "banner"){

							$aux_item_object = new Banner();
                            $aux_item_object->setNumber("domain_id", $aux_domain_id);
							$aux_item_object->setNumber("account_id",$_SESSION["SESS_ACCOUNT_ID"]);
							$aux_item_object->setNumber("domain_id",$array_package_items[$j]["domain_id"]);

							setting_get("banner_approve_free", $banner_approve_free);

							if (!$banner_approve_free && $array_package_items[$j]["price"] <=0){
								$aux_item_object->setString("status","A");
							} else {
								$aux_item_object->setString("status","P");
							}

							$aux_item_object->setString("caption", $aux_post["item_name"]);
							$aux_item_object->setString("friendly_url", $aux_post["item_friendly_ur"]);
							$aux_item_object->setNumber("type", $array_package_items[$j]["level"]);
							$aux_item_object->setNumber("package_id", $array_package_items[$j]["package_id"]);
							$aux_item_object->setNumber("package_price", $array_package_items[$j]["price"]);
							$aux_item_object->setNumber("expiration_setting", BANNER_EXPIRATION_RENEWAL_DATE);
							$aux_item_object->setString("unlimited_impressions", "y");
							$aux_item_object->Save();

							$domain_url = DEFAULT_URL;
							$domain_url = str_replace($_SERVER["HTTP_HOST"], $aux_domainObj->getstring("url"),$domain_url);
							$itemMailLink .= ucfirst(BANNER_FEATURE_NAME)." \"".$aux_post["item_name"]."\"<br />";
							$itemMailLink .= "<a href=\"".$domain_url."/".SITEMGR_ALIAS."/content/".BANNER_FEATURE_FOLDER."/banner.php?id=".$aux_item_object->getNumber("id")."\" target=\"_blank\">".$domain_url."/".SITEMGR_ALIAS."/content/".BANNER_FEATURE_FOLDER."/banner.php?id=".$aux_item_object->getNumber("id")."</a><br /><br />";
						}

						if($array_package_items[$j]["module"] == "custom_package"){

							if ($members){

								if ($array_package_items[$j]["price"]>0){

									$itemMailLink .= "Custom Option<br />";

									$customInvoiceObj = new CustomInvoice();

									$item_prices[] = $array_package_items[$j]["price"];
									$item_desc[] = $packageName;
									$subtotal = 0;
									$subtotal += $array_package_items[$j]["price"];
									$array_custominvoice["account_id"] = $_SESSION["SESS_ACCOUNT_ID"];
									$array_custominvoice["title"] = system_showText(LANG_CHARGING_PACKAGE)."\"".$packageName."\"";
									$array_custominvoice["subtotal"] = $subtotal;
									$array_custominvoice["tax"] = 0;
									$array_custominvoice["amount"] = $subtotal;
									$array_custominvoice["completed"] = "y";
									$array_custominvoice["sent"] = "y";
									$array_custominvoice["sent_date"] = date("Y-m-d");
									$array_custominvoice["domain_id"] = $aux_domain_id;
									$customInvoiceObj->makeFromRow($array_custominvoice);

									$customInvoiceObj->Save();

									$customInvoiceObj->setItems($item_desc, $item_prices);
									$domain = new Domain(SELECTED_DOMAIN_ID);
									$itemMailLink .= "A custom invoice was sent to the user. You can see it in <br />";
									$itemMailLink .= (SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on" ? "https://".$domain->getstring("url") : "http://".$domain->getstring("url"));
									$itemMailLink .= "/".SITEMGR_ALIAS."/activity/custominvoices/index.php?search_id=".$customInvoiceObj->getNumber("id");
									$itemMailLink .= "<br />";

									///////////////////Email Notif to Member////////////////////////

									$emailNotification = new EmailNotification(SYSTEM_NEW_CUSTOMINVOICE);

									$body = stripslashes($emailNotification->getString("body"));
									$subject = stripslashes($emailNotification->getString("subject"));
									$subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $subject);
									$body = str_replace(ACCOUNT_NAME, $contactObj->getString("first_name")." ".$contactObj->getString("last_name"), $body);


									$body = str_replace("DEFAULT_URL", SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" ? "https://".$domain->getstring("url") : "http://".$domain->getstring("url"), $body);
									$body = str_replace("CUSTOM_INVOICE_AMOUNT", CURRENCY_SYMBOL.format_money($subtotal), $body);
									$body = str_replace("CUSTOM_INVOICE_AMOUNT", CURRENCY_SYMBOL.format_money($subtotal), $body);
                                    $body = str_replace("MEMBERS_URL", MEMBERS_ALIAS, $body);

									customtext_get("payment_tax_label", $payment_tax_label);

									$body = str_replace("CUSTOM_INVOICE_TAX", "+ ".$payment_tax_label, $body);
									$body = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body);

                                    Mailer::mail( $contactObj->getString( "email" ), $subject, $body, $emailNotification->getString( "content_type" ), null, $emailNotification->getString( "bcc" ) );
                                    ////////////////////////////////////////////////////////

								}
							}
						}
						$arrayPackModule["account_id"] = sess_getAccountIdFromSession();
						$arrayPackModule["package_id"] = $array_package_items[$j]["package_id"];
						$arrayPackModule["domain_id"] = $array_package_items[$j]["domain_id"];
						$arrayPackModule["parent_domain_id"] = SELECTED_DOMAIN_ID;
						$arrayPackModule["module"] = $array_package_items[$j]["module"];
						$package_id = $arrayPackModule["package_id"];

						if ($array_package_items[$j]["module"] != "custom_package"){
							$arrayPackModule["module_id"] = $aux_item_object->getNumber("id");
							if ($array_package_items[$j]["module"] != "banner"){
								$arrayPackModule["module_name"] = $aux_item_object->getString("title");
							} else {
								$arrayPackModule["module_name"] = $aux_item_object->getString("caption");
							}
						} else {
							$arrayPackModule["module_id"] = 0;
						}

						$packageModule = new PackageModules($arrayPackModule);
						$packageModule->Save();

					}
				}

				///////////////////Email Notif to Sitemgr////////////////////////

                $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_PACKAGE);
                $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />
                                ".system_showText(LANG_NOTIFY_PACKAGE_1)." \"".$packageName."\" ".system_showText(LANG_NOTIFY_PACKAGE_2)." \"".system_showAccountUserName($account->getString("username"))."\" ".system_showText(LANG_NOTIFY_PACKAGE_3)."<br /><br />
                                ".system_showText(LANG_NOTIFY_PACKAGE_4).":<br /><br />
                                ".$itemMailLink."";

                system_notifySitemgr("", $emailSubject, $sitemgr_msg);

				//////////////////////////////////

			}

		}

		if ($getPackageID) {
			return $package_id;
		}
	 }
?>