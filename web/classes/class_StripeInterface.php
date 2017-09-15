<?php
/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2016 Arca Solutions, Inc. All Rights Reserved.           #
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
# * FILE: /classes/class_StripeInterface.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *		$stripeObj = new StripeRequest($resource, $apikey);
 * <code>
 * @copyright Copyright 2016 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 11.1.00
 * @package Classes
 * @name StripeInterface
 * @access Public
 */

use Stripe\Stripe;

class StripeInterface
{

    /**
     * Error message returned from Stripe
     * @var string
     */
    public static $errorMessage = '';

    public static function StripeRequest($resource = "", $apikey = "", $data = "")
    {

        \Stripe\Stripe::setApiKey($apikey);

        switch ($resource) {
            case "createplans":

                                $modules = [
                                    "listing" => "ListingLevel",
                                    "event" => "EventLevel",
                                    "classified" => "ClassifiedLevel",
                                    "banner" => "BannerLevel",
                                    "article" => "ArticleLevel"
                                ];

                                //Create/update plans for all modules
                                foreach ($modules as $module => $levelClass) {
                                    $levelObj = new $levelClass(true);
                                    $levelValues = $levelObj->getValues();

                                    //Create/update plan for all levels
                                    foreach ($levelValues as $value) {

                                        //Plan ID pattern: PERIOD_MODULE_LEVEL_DOMAINID
                                        $planID = $module."_".$value."_".SELECTED_DOMAIN_ID;

                                        //Create monthly plan

                                        if ($module == "banner") {
                                            $price = $levelObj->getPrice($value, BANNER_EXPIRATION_RENEWAL_DATE);
                                        } else {
                                            $price = $levelObj->getPrice($value);
                                        }

                                        if ($price > 0) {
                                            $planID = "monthly_".$planID;

                                            $data = [
                                                "price" => self::normalizePrice($price),
                                                "interval" => "month",
                                                "name" => @constant("LANG_".strtoupper($module)."_FEATURE_NAME")." ".$levelObj->getName($value)." - ".system_showText(LANG_MONTHLY),
                                                "currency" => PAYMENT_CURRENCY,
                                                "trial" => $levelObj->getTrial($value),
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
                                                $response = self::createPlan($data);
                                            } catch (\Stripe\Error\Base $e) {
                                                //Plan doesn't exist, create a new one
                                                $response = self::createPlan($data);
                                            }
                                        }

                                        //Create yearly plan

                                        if ($module == "banner") {
                                            $price = $levelObj->getPrice($value, BANNER_EXPIRATION_RENEWAL_DATE, "yearly");
                                        } else {
                                            $price = $levelObj->getPrice($value, "yearly");
                                        }

                                        if ($price > 0) {
                                            $planID = $module."_".$value."_".SELECTED_DOMAIN_ID;
                                            $planID = "yearly_".$planID;

                                            $data = [
                                                "price" => self::normalizePrice($price),
                                                "interval" => "year",
                                                "name" => @constant("LANG_".strtoupper($module)."_FEATURE_NAME")." ".$levelObj->getName($value)." - ".system_showText(LANG_YEARLY),
                                                "currency" => PAYMENT_CURRENCY,
                                                "trial" => $levelObj->getTrial($value),
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
                                                $response = self::createPlan($data);
                                            } catch (\Stripe\Error\Base $e) {
                                                //Plan doesn't exist, create a new one
                                                $response = self::createPlan($data);
                                            }

                                        }

                                    }
                                }

                                if (!setting_set("stripe_planscreated", "1")) {
                                    setting_new("stripe_planscreated", "1");
                                }

                                break;
            case "createcoupons":

                                $promocode = new pageBrowsing("Discount_Code", 1, false, "id", false, false, "expire_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')".(isset($data["id"]) ? " AND id IN ('".$data["id"]."')" : ""));
                                $discount_codes = $promocode->retrievePage("array");

                                if (is_array($discount_codes)) foreach ($discount_codes as $discount_code) {

                                    $expireDate = DateTime::createFromFormat('Y-m-d', $discount_code["expire_date"]);

                                    $data = [
                                        "id" => $discount_code["id"],
                                        "duration" => ($discount_code["recurring"] == "yes" ? "forever" : "once"),
                                        "amount_off" => ($discount_code["type"] == "percentage" ? 0 : self::normalizePrice($discount_code["amount"])),
                                        "currency" => PAYMENT_CURRENCY,
                                        "percent_off" => ($discount_code["type"] == "percentage" ? self::normalizePrice($discount_code["amount"], true) : 0),
                                        "redeem_by" => $expireDate->getTimestamp()
                                    ];

                                    //Check if coupon already exists
                                    try {
                                        $couponObj = \Stripe\Coupon::retrieve($discount_code["id"]);
                                        /*
                                         * Stripe does not allow the change of coupons detail.
                                         * So we need to delete the coupon and create it again.
                                         */
                                        $couponObj->delete();
                                        $response = self::createCoupon($data);
                                    } catch (\Stripe\Error\Base $e) {
                                        //Coupon doesn't exist, create a new one
                                        $response = self::createCoupon($data);
                                    }

                                }

                                if (!setting_set("stripe_couponscreated", "1")) {
                                    setting_new("stripe_couponscreated", "1");
                                }

                                break;

            case "deletecoupon":

                                //Check if coupon already exists
                                if ($data["id"]) {
                                    try {
                                        $couponObj = \Stripe\Coupon::retrieve($data["id"]);
                                        $couponObj->delete();
                                    } catch (\Stripe\Error\Base $e) {

                                    }
                                }

                                break;

            case "createtoken":

                                $response = self::createToken($data);
                                break;

            case "retrievecustomer":

                                $response = self::retrieveCustomer($data);
                                break;

            case "createcustomer":

                                $response = self::createCustomer($data);
                                break;

            case "createcharge":

                                $response = self::createCharge($data);
                                break;

            case "createsubscription":

                $response = self::createSubscription($data);
                break;

        }

        return $response;

    }

    public static function normalizePrice($price, $percentage = false) {

        if ($percentage) {
            //Percentage should be an integer between 1 and 100
            $price = (int)($price);
        } else {
            //Stripe price should be sent as cents
            $price = (int)(str_replace(".", "", $price));
            $price = (int)(str_replace(",", "", $price));
        }

        return $price;
    }

    public static function createPlan($data)
    {
        try {
            \Stripe\Plan::create(array(
                    "amount" => $data["price"],
                    "interval" => $data["interval"],
                    "name" => $data["name"],
                    "currency" => $data["currency"],
                    "trial_period_days" => $data["trial"],
                    "id" => $data["id"])
            );
        } catch (\Stripe\Error\Base $e) {
            return $e->getMessage();
        }
    }

    public static function createCoupon($data) {

        if (!$data["amount_off"]) {
            unset($data["amount_off"]);
        } elseif (!$data["percent_off"]) {
            unset($data["percent_off"]);
        }

        try {
            \Stripe\Coupon::create($data);
        } catch (\Stripe\Error\Base $e) {
            return $e->getMessage();
        }
    }

    public static function createToken($data) {

        try {
            $token = \Stripe\Token::create(array(
                "card" => array(
                    "number" => $data["number"],
                    "exp_month" => $data["exp_month"],
                    "exp_year" => $data["exp_year"],
                    "cvc" => $data["cvc"],
                    "address_city" => $data["address_city"],
                    "address_country" => $data["address_country"],
                    "address_line1" => $data["address_line1"],
                    "address_line2" => $data["address_line2"],
                    "name" => $data["name"],
                    "address_state" => $data["address_state"],
                    "address_zip" => $data["address_zip"]
                )
            ));
            return $token;
        } catch (\Stripe\Error\Base $e) {
            self::$errorMessage = $e->getMessage();
            return $e->getCode();
        }
    }

    public static function retrieveCustomer($data) {

        try {
            $customer = \Stripe\Customer::retrieve($data["customer_id"]);
            return $customer;
        } catch (\Stripe\Error\Base $e) {
            self::$errorMessage = $e->getMessage();
            return $e->getCode();
        }
    }

    public static function createCustomer($data) {

        try {
            $customer = \Stripe\Customer::create(array(
                "email" => $data["email"],
                "source" => $data["token"],
                "description" => system_showText(LANG_LABEL_NAME) . ": " . $data["customer_first_name"] . " " . $data["customer_last_name"]
            ));
            
            return $customer;
        } catch (\Stripe\Error\Base $e) {
            self::$errorMessage = $e->getMessage();
            return $e->getCode();
        }
    }

    public static function createCharge($data) {

        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => self::normalizePrice($data["amount"]),
                "currency" => $data["currency"],
                "description" => $data["description"],
                "statement_descriptor" => ($data["statement_descriptor"] ? $data["statement_descriptor"] : system_showTruncatedText(LANG_ORDER_MULTIPLEITEMS, 20, "")),
                "customer" => $data["customer"],
                "metadata" => $data["metadata"]
            ));

            return $charge;
        } catch (\Stripe\Error\Base $e) {
            self::$errorMessage = $e->getMessage();
            return $e->getCode();
        }
    }

    public static function createSubscription($data) {

        try {
            $subscription = \Stripe\Subscription::create(array(
                "coupon" => $data["coupon"],
                "plan" => $data["plan"],
                "customer" => $data["customer"],
                "tax_percent" => $data["tax_percent"],
                "metadata" => $data["metadata"]
            ));

            return $subscription;
        } catch (\Stripe\Error\Base $e) {
            self::$errorMessage = $e->getMessage();
            return $e->getCode();
        }
    }

}