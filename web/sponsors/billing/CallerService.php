<?php

####################################################################################################
####################################################################################################
####################################################################################################
### THIS FILE WAS CHANGED TO WORK CORRECTLY IN DIRECTORY                                         ###
####################################################################################################
####################################################################################################
####################################################################################################

/***************************************************************************************************
CallerService.php

This file uses the constants.php to get parameters needed
to make an API call and calls the server.if you want use your
own credentials, you have to change the constants.php

Called by TransactionDetails.php, ReviewOrder.php,
DoDirectPaymentReceipt.php and DoExpressCheckoutPayment.php.

***************************************************************************************************/

//require_once "constants.php";
//$API_UserName=API_USERNAME;
//$API_Password=API_PASSWORD;
//$API_Signature=API_SIGNATURE;
//$API_Endpoint=API_ENDPOINT;
//$version=API_VERSION;
//session_start();

$API_UserName  = PAYPALAPI_USERNAME;
$API_Password  = PAYPALAPI_PASSWORD;
$API_Signature = PAYPALAPI_SIGNATURE;
$API_Endpoint  = PAYPALAPI_ENDPOINT;
$version       = PAYPALAPI_VERSION;

//card type = Visa
//card number = 4059042064101342
//card verification number = 962
//city = Omaha
//state = NE
//zip code = 95131

/*

   * hash_call: Function to perform the API call to PayPal using API signature
   * @methodName is name of API method.
   * @nvpStr is nvp string.
   * returns an associtive array containing the response from the server.

*/

function hash_call($methodName, $nvpStr) {

	//declaring of global variables.
	global $API_Endpoint, $version, $API_UserName, $API_Password, $API_Signature;

	//setting the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
	//if PAYPALAPI_USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
	//set proxy name to PAYPALAPI_PROXY_HOST and port number to PAYPALAPI_PROXY_PORT in constants.php.
	if (PAYPALAPI_USE_PROXY) curl_setopt($ch, CURLOPT_PROXY, PAYPALAPI_PROXY_HOST.":".PAYPALAPI_PROXY_PORT);

	//NVPRequest for submitting to server.
	$nvpreq = "METHOD=".urlencode($methodName)."&VERSION=".urlencode($version)."&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature).$nvpStr;

	//setting the nvpreq as POST FIELD to curl.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

	//getting response from server.
	$response = curl_exec($ch);

	//convrting NVPResponse to an Associative Array.
	$nvpResArray = deformatNVP($response);
	$nvpReqArray = deformatNVP($nvpreq);
	$nvpResArray["nvpReqArray"] = $nvpReqArray;

	if (curl_errno($ch)) {
		// moving to display page to display curl errors.
		$nvpResArray["CURL_ERROR"] = "Y";
		$nvpResArray["curl_error_no"] = curl_errno($ch);
		$nvpResArray["curl_error_msg"] = curl_error($ch);
	} else {
		//closing the curl.
		curl_close($ch);
	}

	return $nvpResArray;

}

/*

   * This function will take NVPString and convert it to an Associative Array and it will decode the response.
   * It is usefull to search for a particular key and displaying arrays.
   * @nvpstr is NVPString.
   * @nvpArray is Associative Array.

*/

function deformatNVP($nvpstr) {

	$intial = 0;
	$nvpArray = array();

	while (string_strlen($nvpstr)) {

		//postion of Key.
		$keypos = string_strpos($nvpstr, "=");
		//position of value.
		$valuepos = string_strpos($nvpstr, "&") ? string_strpos($nvpstr, "&") : string_strlen($nvpstr);

		//getting the Key and Value values and storing in a Associative Array.
		$keyval = string_substr($nvpstr, $intial, $keypos);
		$valval = string_substr($nvpstr, $keypos+1, $valuepos-$keypos-1);
		//decoding the respose.
		$nvpArray[urldecode($keyval)] = urldecode($valval);
		$nvpstr = string_substr($nvpstr, $valuepos+1, string_strlen($nvpstr));

	}

	return $nvpArray;

}