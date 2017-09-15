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
	# * FILE: /functions/twilio_funct.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * Add a new Caller ID using Twilio Account.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_AddCalledID
	 * @param string $item_title
	 * @param string $item_number
	 * @param string $extension
	 * @return string $response
	 */
	
	function twilio_AddCalledID($item_title, $item_number, $extension = false){
	
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");
			
		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient(TWILIO_API_SID, TWILIO_API_AUTH);

		$url = TWILIO_API_VERSION."/Accounts/".TWILIO_API_SID."/OutgoingCallerIds";
		
		$aux_array_parameters = array();
		$aux_array_parameters["FriendlyName"]	= $item_title;
		$aux_array_parameters["PhoneNumber"]	= $item_number;
		if($extension){
			$aux_array_parameters["Extension"]		= $extension;
			
		}
		
		
		/* make Twilio REST request to initiate outgoing call */
		$response = $client->request($url,"POST", $aux_array_parameters);
    
		return $response;
	}
	
	/**
	 * Check if the Caller ID is validated using Twilio Account.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_CheckCallerID
	 * @param string $number
	 * @return string $response
	 */
	
	function twilio_CheckCallerID($number){
		
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");

		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient(TWILIO_API_SID, TWILIO_API_AUTH);

		$url = TWILIO_API_VERSION."/Accounts/".TWILIO_API_SID."/OutgoingCallerIds";
		
		$aux_array_parameters = array();
		$aux_array_parameters["PhoneNumber"]	= $number;
		
		/* make Twilio REST request to initiate outgoing call */
		$response = $client->request($url,"GET", $aux_array_parameters);
    
		return $response;
	}
	
	/**
	 * Return the phone call reports of a Twilio number.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_CallerReport
	 * @param string $number
	 * @return string $response
	 */
	
	function twilio_CallerReport($number){
		
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");

		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient(TWILIO_API_SID, TWILIO_API_AUTH);

		$url = TWILIO_API_VERSION."/Accounts/".TWILIO_API_SID."/Calls";
		
		$aux_array_parameters = array();
		$aux_array_parameters["From"]		= $number;
		$aux_array_parameters["Status"]		= "completed";				
		$aux_array_parameters["pagesize"]	= 1000;
		
		$response = $client->request($url,"GET", $aux_array_parameters);
    
		return $response;
		
	}