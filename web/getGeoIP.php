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
# * FILE: /getGeoIP.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("./conf/loadconfig.inc.php");

header("Content-Type: text/html; charset=".EDIR_CHARSET, true);

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$googleSettingObj = new GoogleSettings($_SERVER["HTTP_HOST"]);

/* key for demodirectory.com */
if (DEMO_LIVE_MODE) {
    $googleMapsKey = GOOGLE_GEOLOCATION_APP_DEMO;
} else {
    $googleMapsKey = $googleSettingObj->geoLocationKey;
}

$location_GeoIP = '';

if ($googleSettingObj->geoLocationStatus == "off") {
    exit;
}

if ($_COOKIE["location_geoip"]) {
    die($_COOKIE["location_geoip"]);
}

if ($_GET["lat"] && $_GET["long"]) {
    $position = $_GET["lat"].",".$_GET["long"];
} else {

    if ($googleMapsKey) {

        $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        /*
         * Get user's lat/long by IP
         */
        $ch = curl_init("https://www.googleapis.com/geolocation/v1/geolocate?key=$googleMapsKey");

        $post_data = [];
        $post_data["considerIp"] = true;

        curl_setopt($ch, CURLOPT_HTTPHEADER,
            ['Content-Type: application/json', 'Content-Length: '.strlen(json_encode($post_data))]);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $output = curl_exec($ch);
        $return = json_decode($output);

        if (!isset($return->error) && isset($return->location->lat) && isset($return->location->lng)) {
            $position = $return->location->lat.",".$return->location->lng;
        }
    }
}

if ($position) {

    /*
     * Get user's location info by lat/long
     */
    switch (EDIR_LANGUAGE) {
        case "en_us" :
            $language = "en";
            break;
        case "pt_br" :
            $language = "pt-BR";
            break;
        case "it_it" :
            $language = "it";
            break;
        case "es_es" :
            $language = "es";
            break;
        case "tr_tr" :
            $language = "tr";
            break;
        case "fr_fr" :
            $language = "fr";
            break;
        case "ge_ge" :
            $language = "de";
            break;
    }

    $ch = curl_init("https://maps.googleapis.com/maps/api/geocode/json?latlng=$position&key=$googleMapsKey&language=$language&result_type=street_address");

    curl_setopt($ch, CURLOPT_HTTPHEADER,
        ['Content-Type: application/json', 'Content-Length: '.strlen(json_encode($post_data))]);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $output = curl_exec($ch);
    $return = json_decode($output);

    $location = [];

    if ($return->status == "OK") {
        $results = $return->results;
        if (is_array($results)) {

            system_retrieveLocationsInfo($_non_default_locations, $_default_locations_info);

            foreach ($results as $result) {
                $addresses = $result->address_components;
                if (is_array($addresses)) {
                    foreach ($addresses as $address) {

                        if (is_array($address->types)) {
                            foreach ($address->types as $type) {
                                switch ($type) {
                                    case "neighborhood":
                                        if (!in_array($address->long_name, $location) && in_array("5",
                                                $_non_default_locations)
                                        ) {
                                            $location[] = $address->long_name;
                                        } //Neighborhood
                                        break;
                                    case "sublocality":
                                        if (!in_array($address->long_name, $location) && in_array("5",
                                                $_non_default_locations)
                                        ) {
                                            $location[] = $address->long_name;
                                        } //Neighborhood
                                        break;
                                    case "sublocality_level_1":
                                        if (!in_array($address->long_name, $location) && in_array("5",
                                                $_non_default_locations)
                                        ) {
                                            $location[] = $address->long_name;
                                        } //Neighborhood
                                        break;
                                    case "locality":
                                        if (in_array("4", $_non_default_locations)) {
                                            $location[] = $address->long_name;
                                        } //City
                                        break;
                                    case "administrative_area_level_1":
                                        if (in_array("3", $_non_default_locations)) {
                                            $location[] = $address->short_name;
                                        } //State
                                        break;
                                    case "country":
                                        if (in_array("1", $_non_default_locations)) {
                                            $location[] = $address->long_name;
                                        } //Country
                                        break;
                                }
                            }
                        }
                    }
                }

            }
            $location_GeoIP = implode(", ", $location);
        }
    }
}

setcookie("location_geoip", $location_GeoIP, 0, "".EDIRECTORY_FOLDER."/");

echo $location_GeoIP;
