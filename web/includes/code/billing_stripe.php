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
	# * FILE: /includes/code/billing_stripe.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	require_once(CLASSES_DIR."/class_StripeInterface.php");
	require_once(CLASSES_DIR."/class_Payments.php");
	include(EDIRECTORY_ROOT."/conf/payment_stripe.inc.php");

	extract($_POST);
	extract($_GET);

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $pay) {

		$verification = "y";

		if (!is_array($listing_id) && !is_array($event_id) && !is_array($banner_id) && !is_array($classified_id) && !is_array($article_id) && !is_array($custominvoice_id)) {

			$verification = "n";

			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN) . "<br />\n<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . $process . "/payment.php?payment_method=stripe\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN) . "<br />\n<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . $process . "/payment.php?payment_method=stripe&claimlistingid=" . $claimlistingid . "\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";
			else $payment_message .= system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN) . "<br />\n<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/billing/index.php\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";

		} elseif (!$cardnumber || !$month || !$year || !$cvv) {

			$verification = "n";

			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS) . "<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . $process . "/payment.php?payment_method=stripe\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS) . "<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . $process . "/payment.php?payment_method=stripe&claimlistingid=" . $claimlistingid . "\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";
			else $payment_message .= system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS) . "<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/billing/index.php\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";

		} elseif ($cvv && (!is_numeric($cvv) || ((string_strlen($cvv) != 3) && (string_strlen($cvv) != 4)))) {

			$verification = "n";

			$payment_message = "<p class=\"errorMessage\">\n";

			if ($process == "signup") $payment_message .= system_showText(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER) . "<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . $process . "/payment.php?payment_method=stripe\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";
			elseif ($process == "claim") $payment_message .= system_showText(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER) . "<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/" . $process . "/payment.php?payment_method=stripe&claimlistingid=" . $claimlistingid . "\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";
			else $payment_message .= system_showText(LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER) . "<br />\n<br />\n<a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/billing/index.php\">" . system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN) . "</a>\n";

		}

		if ($verification == "y") {

			//Generate a new valid token on Stripe
			$token = StripeInterface::StripeRequest("createtoken", STRIPE_APIKEY,
				array(
					"number" => $cardnumber,
					"exp_month" => $month,
					"exp_year" => $year,
					"cvc" => $cvv,
					"address_city" => $city,
					"address_country" => $country,
					"address_line1" => $address1,
					"address_line2" => $address2,
					"name" => $name,
					"address_state" => $state,
					"address_zip" => $zip
				)
			);

			if (!$token->id) {
				$payment_message = "<p class=\"errorMessage\">\n";
				$payment_message .= system_showText(LANG_MSG_TRANSACTION_NOT_COMPLETED) . "<br />\n<br />\n";
				$payment_message .= StripeInterface::$errorMessage;
			} else {

				$accountObj = new Account(sess_getAccountIdFromSession());

				if ($accountObj->getString("stripe_id")) {
					//Check if customer really exists on Stripe
					$customer = StripeInterface::StripeRequest("retrievecustomer", STRIPE_APIKEY,
						array(
							"customer_id" => $accountObj->getString("stripe_id")
						)
					);
				}
				if (!isset($customer->id) || $customer->deleted) {
					//Create the customer on Stripe
					$customer = StripeInterface::StripeRequest("createcustomer", STRIPE_APIKEY,
						array(
							"email" => $customer_email,
							"token" => $token->id,
							"customer_first_name" => $customer_first_name,
							"customer_last_name" => $customer_last_name
						)
					);
				}

				if (!$customer->id) {
					$payment_message = "<p class=\"errorMessage\">\n";
					$payment_message .= system_showText(LANG_MSG_TRANSACTION_NOT_COMPLETED) . "<br />\n<br />\n";
					$payment_message .= StripeInterface::$errorMessage;
				} else {

					//Updates customer id
					$accountObj->setString("stripe_id", $customer->id);
					$accountObj->save();

					$oneTimePayment = false;

					//Create subscriptions
					if (RECURRING_FEATURE == "on") {

						$modules = ["listing", "event", "classified", "article", "banner"];
						$transaction_message = "";

						foreach ($modules as $module) {

							if (!empty(${$module."_id"}[0])) {
								$k = 0;
								$errorSubscription = false;
								foreach (${$module."_id"} as $item_id) {

									$moduleClass = ucfirst($module);
									$itemObj = new $moduleClass($item_id);

									$renewal_period = ($_SESSION["order_renewal_period_{$module}_{$item_id}"] ? $_SESSION["order_renewal_period_{$module}_{$item_id}"] : $_SESSION["order_renewal_period"]);
									if (!$renewal_period) {
										$renewal_period = "monthly";
									}

									//Check if item was bought using a package
									if ($itemObj->getNumber("package_id") && $itemObj->getNumber("package_price") > 0) {

										$packageObj = new Package($itemObj->getNumber("package_id"));

										//Create plan on stripe
										/*
                                         * Plan id format: pack_[PACKAGE ID]_[RENEWAL]_[DOMAIN_ID]
                                         */
										$planID = "pack_".$packageObj->getNumber("id")."_".$renewal_period."_".SELECTED_DOMAIN_ID;

										$pricePackage = $itemObj->getNumber("package_price");
										if (strpos($pricePackage, ".") !== false || strpos($pricePackage, ",") !== false) {
											$pricePackage = (int)(str_replace(".", "", $pricePackage));
											$pricePackage = (int)(str_replace(",", "", $pricePackage));
										} else {
											$pricePackage *= 100;
										}

										$data = [
											"price" => $pricePackage,
											"interval" => ($renewal_period == "monthly" ? "month" : "year"),
											"name" => system_showText(LANG_PACKAGE_SING)." ".$packageObj->getString("title")." - ".($renewal_period == "monthly" ? system_showText(LANG_MONTHLY) : system_showText(LANG_YEARLY)),
											"currency" => PAYMENT_CURRENCY,
											"id" => $planID
										];

										//Check if plan already exists
										try {
											$planObj = \Stripe\Plan::retrieve($planID);
											/*
                                             * Stripe does not allow the change of the amount, currency or trial of a plan.
                                             * So we need to delete the plan and create it again.
                                             */
											$planObj->delete();
											$response = StripeInterface::createPlan($data);
										} catch (\Stripe\Error\Base $e) {
											//Plan doesn't exist, create a new one
											$response = StripeInterface::createPlan($data);
										}

										//Subscripe to plan
										$subscription = StripeInterface::StripeRequest("createsubscription", STRIPE_APIKEY,
											array(
												"coupon" => $itemObj->getString("discount_id") ? $itemObj->getString("discount_id") : null,
												"plan" => $planID,
												"customer" => $customer->id,
												"metadata" => $metadata,
												"tax_percent" => ($stripe_tax ? (int)$stripe_tax : null)
											)
										);

									} else {

										$plan = $renewal_period;
										$plan .= "_" . $module . "_" . $itemObj->getNumber($module == "banner" ? "type" : "level") . "_" . SELECTED_DOMAIN_ID;

										$subscription = StripeInterface::StripeRequest("createsubscription", STRIPE_APIKEY,
											array(
												"coupon" => $itemObj->getString("discount_id") ? $itemObj->getString("discount_id") : null,
												"plan" => $plan,
												"customer" => $customer->id,
												"metadata" => $metadata,
												"tax_percent" => ($stripe_tax ? (int)$stripe_tax : null)
											)
										);
									}


									if (!$subscription->id || ($subscription->status != "trialing" && $subscription->status != "active")) {
										$payment_message = "<p class=\"errorMessage\">\n";
										$payment_message .= system_showText(LANG_MSG_TRANSACTION_NOT_COMPLETED) . "<br />\n<br />\n";
										$payment_message .= StripeInterface::$errorMessage;
										$errorSubscription = true;
									} else {

										$amount = str_replace( ",", ".", ${$module."_price"}[$k] );
										$subtotal = $amount;
										if ($stripe_tax > 0) {
											$amount = payment_calculateTax($subtotal, $stripe_tax);
										}

										Payments::newPayment(array(
											"account_id" => sess_getAccountIdFromSession(),
											"account_username" => $customer_email,
											"transaction_id" => $subscription->id,
											"transaction_status" => "Approved",
											"tax" => $stripe_tax,
											"subtotal" => $subtotal,
											"amount" => $amount,
											"currency" => PAYMENT_CURRENCY,
											"gateway" => "stripe",
											"recurring" => "y",
											"notes" => "",
											"{$module}_id" => ${$module."_id"},
											"{$module}_price" => ${$module."_price"},
											"renewal" => ($_SESSION["order_renewal_period"] == "monthly" ? "M" : "Y"),
											"recurring_status" => $subscription->status
										));

										$transaction_message .= system_showText(LANG_LABEL_TRANSACTION_ID) . ": " . $subscription->id . "<br />\n";
										$transaction_message .= system_showText(LANG_LABEL_AMOUNT) . ": " . PAYMENT_CURRENCY . " " . $amount . "<br /><br />\n";

										//Creates additional subscription for extra categories and listing type if needed
										if ($module == "listing") {

											//Create subscription for paid listing type
											if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && $itemObj->getNumber("listingtemplate_id")) {
												$typeObj = new ListingTemplate($itemObj->getNumber("listingtemplate_id"));
												if ($typeObj->getString("status") == "enabled") {
													$priceListingType = $typeObj->getString("price");

													if ($priceListingType > 0) {

														//Create plan on stripe
														/*
														 * Plan id format: type_[TYPE ID]_[RENEWAL]_[DOMAIN_ID]
														 */
														$planID = "type_".$typeObj->getNumber("id")."_".$renewal_period."_".SELECTED_DOMAIN_ID;

														$data = [
															"price" => StripeInterface::normalizePrice($typeObj->getString("price")),
															"interval" => ($renewal_period == "monthly" ? "month" : "year"),
															"name" => system_showText(LANG_LISTING_TEMPLATE)." ".$typeObj->getString("title")." - ".($renewal_period == "monthly" ? system_showText(LANG_MONTHLY) : system_showText(LANG_YEARLY)),
															"currency" => PAYMENT_CURRENCY,
															"id" => $planID
														];

														//Check if plan already exists
														try {
															$planObj = \Stripe\Plan::retrieve($planID);
															/*
                                                             * Stripe does not allow the change of the amount, currency or trial of a plan.
                                                             * So we need to delete the plan and create it again.
                                                             */
															$planObj->delete();
															$response = StripeInterface::createPlan($data);
														} catch (\Stripe\Error\Base $e) {
															//Plan doesn't exist, create a new one
															$response = StripeInterface::createPlan($data);
														}

														//Subscripe to plan
														$subscription = StripeInterface::StripeRequest("createsubscription", STRIPE_APIKEY,
															array(
																"coupon" => $itemObj->getString("discount_id") ? $itemObj->getString("discount_id") : null,
																"plan" => $planID,
																"customer" => $customer->id,
																"metadata" => $metadata,
																"tax_percent" => ($stripe_tax ? (int)$stripe_tax : null)
															)
														);

													}
												}
											}

											//Create subscription for extra categories
											if (${$module."_extracategory"}[$k] > 0) {
												$levelObj = new ListingLevel();
												$priceCategory = $levelObj->getCategoryPrice($itemObj->getNumber("level"));
												if (strpos($priceCategory, ".") !== false || strpos($priceCategory, ",") !== false) {
													$priceCategory = (int)(str_replace(".", "", $priceCategory));
													$priceCategory = (int)(str_replace(",", "", $priceCategory));
												} else {
													$priceCategory *= 100;
												}

												$priceCategory *= ${$module."_extracategory"}[$k];

												if ($priceCategory > 0) {
													//Create plan on stripe
													/*
													 * Plan id format: cat_[LEVEL]_[EXTRA CATEGORIES AMOUNT]_[RENEWAL]_[DOMAIN_ID]
													 */
													$planID = "cat_".$itemObj->getNumber("level")."_".${$module."_extracategory"}[$k]."_".$renewal_period."_".SELECTED_DOMAIN_ID;

													$data = [
														"price" => StripeInterface::normalizePrice($priceCategory),
														"interval" => ($renewal_period == "monthly" ? "month" : "year"),
														"name" => ${$module."_extracategory"}[$k]." ".system_showText(LANG_LABEL_EXTRA_CATEGORY)." ".$levelObj->getName($itemObj->getNumber("level"))." - ".($renewal_period == "monthly" ? system_showText(LANG_MONTHLY) : system_showText(LANG_YEARLY)),
														"currency" => PAYMENT_CURRENCY,
														"id" => $planID
													];

													//Check if plan already exists
													try {
														$planObj = \Stripe\Plan::retrieve($planID);
														/*
                                                         * Stripe does not allow the change of the amount, currency or trial of a plan.
                                                         * So we need to delete the plan and create it again.
                                                         */
														$planObj->delete();
														$response = StripeInterface::createPlan($data);
													} catch (\Stripe\Error\Base $e) {
														//Plan doesn't exist, create a new one
														$response = StripeInterface::createPlan($data);
													}

													//Subscripe to plan
													$subscription = StripeInterface::StripeRequest("createsubscription", STRIPE_APIKEY,
														array(
															"coupon" => $itemObj->getString("discount_id") ? $itemObj->getString("discount_id") : null,
															"plan" => $planID,
															"customer" => $customer->id,
															"metadata" => $metadata,
															"tax_percent" => ($stripe_tax ? (int)$stripe_tax : null)
														)
													);

												}
											}

											$k++;

										}

									}

								}
							}
						}

                        if (!empty($custominvoice_id[0])) {
                            $oneTimePayment = true;
                        }

						if (!$errorSubscription) {

							$payment_success = "y";

							$payment_message .= "<p class=\"successMessage\">\n";

							$payment_message .= system_showText(LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY) . "<br />\n<br />\n";

							$payment_message .= $transaction_message;

							if ($process == "claim") $payment_message .= "<br />\n" . system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND) . "<br />\n" . system_showText(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY) . "<br />\n";
							else $payment_message .= "<br />\n" . system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND) . "<br />\n" . system_showText(LANG_MSG_IN_YOUR) . " <a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/transactions/index.php\">" . system_showText(LANG_LABEL_TRANSACTION_HISTORY) . "</a><br />\n";

                            //Check if a package offering a custom option was bought
                            if ($stripe_package_id) {
                                $packageObj = new Package($stripe_package_id);
                                $array_package_offers = $packageObj->getPackagesByDomainID();
                                $auxitem_name = $array_package_offers[0]["items"][0]["module"];
                                if ($auxitem_name == "custom_package") {
                                    $oneTimePayment = true;

                                    //Redefines payment information to make sure only the custom option is being charged, not the main item again.
                                    $aux_package_total = 0;
                                    foreach ($array_package_offers as $package_offer) {
                                        foreach ($package_offer['items'] as $package_offer_item) {
                                            $aux_package_total += $package_offer_item['price'];
                                        }
                                    }

                                    $amount = $aux_package_total;

                                    setting_get("payment_tax_status", $payment_tax_status);

                                    if ($payment_tax_status == "on") {
                                        $amount = payment_calculateTax($amount, $payment_tax_value);
                                        setting_get("payment_tax_value", $payment_tax_value);
                                    } else {
                                        $amount = format_money($amount);
                                    }

                                    $statement_descriptor = $packageObj->getString("title");
                                    $metadata["items"] = $packageObj->getString("title");
                                    $metadata["tax"] = ($payment_tax_status == "on") ? $payment_tax_value : "";
                                    $metadata["subtotal"] = $aux_package_total;
                                    $stripe_tax = ($payment_tax_status == "on") ? $payment_tax_value : "";
                                    $stripe_subtotal = $aux_package_total;
                                    unset($listing_id, $listing_price, $event_id, $event_price, $classified_id, $classified_price, $article_id, $article_price, $banner_id, $banner_price, $unpaid_impressions, $custominvoice_id, $custominvoice_price);
                                }
                            }

						}

					} else {

                        $oneTimePayment = true;

					}

					if ($oneTimePayment) {
                        //Charges the customer (one time payments)
                        $charge = StripeInterface::StripeRequest("createcharge", STRIPE_APIKEY,
                            array(
                                "amount" => $amount,
                                "currency" => PAYMENT_CURRENCY,
                                "description" => system_showText(LANG_CHARGEFOR) . " " . $customer_email,
                                "statement_descriptor" => system_showTruncatedText($statement_descriptor, 22, ""),
                                "customer" => $customer->id,
                                "metadata" => $metadata
                            )
                        );

                        if (!$charge->id || ($charge->status != "succeeded" && $charge->status != "paid")) {
                            $payment_message = "<p class=\"errorMessage\">\n";
                            $payment_message .= system_showText(LANG_MSG_TRANSACTION_NOT_COMPLETED) . "<br />\n<br />\n";
                            $payment_message .= StripeInterface::$errorMessage;
                        } else {

                            $payment_success = "y";

                            $payment_message .= "<p class=\"successMessage\">\n";

                            $payment_message .= system_showText(LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY) . "<br />\n<br />\n";
                            $payment_message .= system_showText(LANG_LABEL_TRANSACTION_ID) . ": " . $charge->id . "<br />\n";
                            $payment_message .= system_showText(LANG_LABEL_AMOUNT) . ": " . PAYMENT_CURRENCY . " " . $amount . "<br />\n";
                            if ($process == "claim") $payment_message .= "<br />\n" . system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND) . "<br />\n" . system_showText(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY) . "<br />\n";
                            else $payment_message .= "<br />\n" . system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND) . "<br />\n" . system_showText(LANG_MSG_IN_YOUR) . " <a href=\"" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/transactions/index.php\">" . system_showText(LANG_LABEL_TRANSACTION_HISTORY) . "</a><br />\n";

                            Payments::newPayment(array(
                                "account_id" => sess_getAccountIdFromSession(),
                                "account_username" => $customer_email,
                                "transaction_id" => $charge->id,
                                "transaction_status" => "Approved",
                                "tax" => $stripe_tax,
                                "subtotal" => $stripe_subtotal,
                                "amount" => $amount,
                                "currency" => PAYMENT_CURRENCY,
                                "gateway" => "stripe",
                                "recurring" => "n",
                                "notes" => "",
                                "listing_id" => $listing_id,
                                "listing_price" => $listing_price,
                                "event_id" => $event_id,
                                "event_price" => $event_price,
                                "classified_id" => $classified_id,
                                "classified_price" => $classified_price,
                                "article_id" => $article_id,
                                "article_price" => $article_price,
                                "banner_id" => $banner_id,
                                "banner_price" => $banner_price,
                                "banner_unpaid_impressions" => $unpaid_impressions,
                                "custominvoice_id" => $custominvoice_id,
                                "custominvoice_price" => $custominvoice_price,
                                "package_id" => $stripe_package_id,
                                "renewal" => ($_SESSION["order_renewal_period"] == "monthly" ? "M" : "Y")

                            ));

                        }
                    }

				}

			}

		}

	}
