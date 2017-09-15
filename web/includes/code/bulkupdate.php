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
	# * FILE: /includes/code/bulkupdate.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	/*
	 * Need to check if $bulkSubmit is equal to "Submit" or LANG_SITEMGR_SUBMIT to fix an IE7 bug
	 */
	if ($_SERVER['REQUEST_METHOD'] == "POST" && $bulkSubmit) {

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

		if (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER)) {
			$typeName = "Listing";
		} elseif (string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER)) {
			$typeName = "Classified";
		} elseif (string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER)) {
			$typeName = "Event";
		} elseif (string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER)) {
			$typeName = "Article";
		} elseif (string_strpos($_SERVER["PHP_SELF"], BANNER_FEATURE_FOLDER)) {
			$typeName = "Banner";
		} elseif (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER)) {
			$typeName = "Promotion";
		} elseif (string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER)) {
			$typeName = "Blog";
		} elseif (string_strpos($_SERVER["PHP_SELF"], "reviews-comments")) {
            $typeName = "Review";
        } elseif (string_strpos($_SERVER["PHP_SELF"], "terms")) {
            $typeName = "NearbySearch";
        }
		$ids = $_POST[lcfirst($typeName)."_id"];
        $error_msg = "";

		if ($ids) {
			if ($delete_all == "on") {
                foreach ($ids as $id) {

                    if ($typeName == "Blog") {
                        $auxtypeName = "Post";
                    } else {
                        $auxtypeName = $typeName;
                    }
                    $typeObj = new $auxtypeName($id);
                    $item_type = $typeObj->getString("item_type");
                    $item_id = $typeObj->getNumber("item_id");

                    $typeObj->delete();

                    if ($typeName == "Review"){
                        $avg = $typeObj->getRateAvgByItem($item_type, $item_id);
                        if (!is_numeric($avg)) {
                            $avg = 0;
                        }
                        if ($item_type == "listing") {
                            $listing = new Listing();
                            $listing->setAvgReview($avg, $item_id);
                        } else if ($item_type == "article") {
                            $article = new Article();
                            $article->setAvgReview($avg, $item_id);
                        }
                    }
                }
				$success_delete = true;

			} else {
                $updateItems = true;
				if (
				    ($typeName == "Banner" && !$change_account_id && !$status && !$change_renewaldate) ||
                    (!is_numeric($change_account_id) && !$status && !$level && !$change_renewaldate && !$add_category_id && !in_array($typeName, ["Banner", "Review", "NearbySearch"]))
                ) {
                    $error_msg = system_showText(LANG_SITEMGR_NO_FIELD_SELECTED);
                    $updateItems = false;
				} else {
					if (!in_array($typeName, ["Banner", "Promotion", "Review", "NearbySearch"]) && $add_category_id) {

                        $error_msg = LANG_SITEMGR_NO_UPDATE."<br>&#149;&nbsp;".constant("LANG_SITEMGR_".string_strtoupper($typeName)."_ERROR_MAXIMUM_CATEGORIES")."<br>";
						foreach ($ids as $id) {

                            if ($typeName == "Blog"){
                                $auxtypeName = "Post";
                            } else {
                                $auxtypeName = $typeName;
                            }

							$typeObj = new $auxtypeName($id);
							$new_categories = array();
							$categories_ids = $typeObj->getCategories(false, false, $id, true, false, true);
							if ($categories_ids) {
                                foreach ($categories_ids as $category_id) {
                                    if ($typeName == "Listing" || $typeName == "Blog") {
                                        array_push($new_categories, $category_id["id"]);
                                    } else {
                                        array_push($new_categories, $category_id->getNumber("id"));
                                    }
                                }
                            }

                            array_push($new_categories, $add_category_id);

							$array_categories = array();
							for ($i = 0; $i < count($new_categories); $i++) {
								array_push($array_categories,$new_categories[$i]);
							}
							$array_categories = array_unique($array_categories);
							$number_categories = count($array_categories);
							if ($typeName == "Listing") {
								if ($number_categories > LISTING_MAX_CATEGORY_ALLOWED) {
                                    $error_msg .= $typeObj->title."<br>";
                                    $updateItems = false;
								}
							} else {
								if (($number_categories > MAX_CATEGORY_ALLOWED) && $typeName != "Blog") {
                                    $error_msg .= $typeObj->title."<br>";
                                    $updateItems = false;
								}
							}
						}
					}

					if ($updateItems) {
						foreach ($ids as $id) {

                            if ($typeName == "Blog"){
                                $auxtypeName = "Post";
                            } else {
                                $auxtypeName = $typeName;
                            }

							$typeObj = new $auxtypeName($id);

							if ($change_account_id === "0" || $change_account_id === 0) {

								if ($typeObj->getNumber("account_id") != 0) {

									if ($typeName == "Listing"){
										$typeObj->removePromotionLinks();
                                    }
                                    if ($typeName == "Promotion"){
                                        $typeObj->setListingNull();
                                    }

									if ($typeName != "Banner" && $typeName != "Promotion"){

										$image_idT = $typeObj->getNumber("image_id");
										$thumb_idT = $typeObj->getNumber("thumb_id");
										$galleryArray = $typeObj->getGalleries();
										system_renameGalleryImages($image_idT, $thumb_idT, 0, $galleryArray[0]);

									} else {
										$image_idB = $typeObj->getNumber("image_id");

                                        if ($image_idB){

                                            $imageChange = new Image($image_idB);

                                            $oldPrefix = $imageChange->getString("prefix");
                                            $newPrefix = "sitemgr_";

                                            $img_type = string_strtolower($imageChange->getString("type"));
                                            $imageChange->setString("prefix",$newPrefix);
                                            $imageChange->Save();

                                            $dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
                                            $imageOld = $dir."/".$oldPrefix."photo_".$image_idB.".".$img_type;
                                            $imageNew = $dir."/".$newPrefix."photo_".$image_idB.".".$img_type;
                                            rename($imageOld, $imageNew);
                                        }
									}
								}

								$typeObj->setString("account_id", "NULL");

							} else if (is_numeric($change_account_id)) {

								if (isset($change_account_id) && $typeObj->getNumber("account_id") != $change_account_id) {

                                    if ($typeName == "Listing"){
										$typeObj->removePromotionLinks();
                                    }
                                    if ($typeName == "Promotion"){
                                        $typeObj->setListingNull();
                                    }

									if (!in_array($typeName, ["Banner", "Promotion"])){

										$image_idT = $typeObj->getNumber("image_id");
										$thumb_idT = $typeObj->getNumber("thumb_id");
										$galleryArray = $typeObj->getGalleries();
										system_renameGalleryImages($image_idT, $thumb_idT, $change_account_id, $galleryArray[0]);

									}else {
										$image_idB = $typeObj->getNumber("image_id");

                                        if ($image_idB){

                                            $imageChange = new Image($image_idB);

                                            $oldPrefix = $imageChange->getString("prefix");
                                            $newPrefix = $change_account_id."_";

                                            $img_type = string_strtolower($imageChange->getString("type"));
                                            $imageChange->setString("prefix",$newPrefix);
                                            $imageChange->Save();

                                            $dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
                                            $imageOld = $dir."/".$oldPrefix."photo_".$image_idB.".".$img_type;
                                            $imageNew = $dir."/".$newPrefix."photo_".$image_idB.".".$img_type;
                                            rename($imageOld, $imageNew);
                                        }
									}
								}

								$typeObj->setNumber("account_id", $change_account_id);
							}

							if (!in_array($typeName, ["Promotion", "Review", "NearbySearch"]) ) {
								if ($status) {
									$typeObj->setString("status", $status);
								}
								if (!in_array($typeName, ["Article", "Banner"]) && $level) {
                                    $typeObj->setNumber("level", $level);
								}
								if ($typeName != "Banner" && $add_category_id) {
									$typeObj->setCategories($array_categories);
								}
							}

                            if ($typeName == "Review" && $approved){
                                $message = $typeObj->ApproveReviewAndReply();
                            }

                            if ($typeName == "NearbySearch" && count($ids) == 1) {
                                /* Validated radius */
                                $radius = preg_replace("/[^0-9]/", "", $radius);

                                $typeObj->setString("radius", $radius?: "NULL");
                                $typeObj->setNumber("latitude", $latitude);
                                $typeObj->setNumber("longitude", $longitude);
                            }

							if ($change_renewaldate) {
								$typeObj->setDate("renewal_date", $change_renewaldate);
							}

                            $typeObj->Save();
						}
					}
				}
			}

            if (!$updateItems) {

                unset($msg);
                unset($message);

            } else {
                if ($typeName == "Promotion") {
                    $typeName = PROMOTION_FEATURE_FOLDER;
                }

                $messageHeader = "msg=success";
                $header_location = "/content/".string_strtolower($typeName);

                if ($typeName == "Review"){
                    $header_location = "/activity/reviews-comments";
                    $messageHeader = "message=".$message;
                }

                if ($typeName == "NearbySearch"){
                    $header_location = "/configuration/geography/terms";
                    $messageHeader = "msg=success";
                }

                if ($success_delete) {
                    $messageHeader = "msg=successdel";
                }

                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS.$header_location."/index.php?".$messageHeader."&letter=$letter&screen=$screen");
                exit;
            }

		}
	}
