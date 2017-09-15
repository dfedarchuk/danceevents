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
	# * FILE: /functions/setting_funct.php
	# ----------------------------------------------------------------------------------------------------

	function setting_new($name, $value) {
		if ($name) {
			$settingObj = new Setting($name);
			if (!$settingObj->getString("name")) {
				$settingObj->setString("name", $name);
				$settingObj->setString("value", $value);
				$settingObj->Save($update = false);
				return true;
			}
		}
		return false;
	}

	function setting_get($name, &$value) {
		if ($name) {

			unset($array_settings);
			$array_settings = setting_getSettingInformation($name);
			if((is_array($array_settings)) && ($_SERVER['REQUEST_METHOD']!="POST")){
				$value = $array_settings["value"];
				return true;
			}else{
				$settingObj = new Setting($name);
				if ($settingObj->getString("name")) {
					$value = $settingObj->getString("value");
					return true;
				}
			}
			
		}
		$value = "";
		return false;
	}

	function setting_set($name, $value) {
		if ($name) {
			$settingObj = new Setting($name);
			if ($settingObj->getString("name")) {
				$settingObj->setString("value", $value);
				$settingObj->Save();
				setting_constants();
				return true;
			}
		}
		return false;
	}

	function setting_delete($name) {
		if ($name) {
			$settingObj = new Setting($name);
			return $settingObj->Delete();
		}
		return false;
	}

	/*
	 * Function to create a constant with table of setting Information
	 */
	function setting_constants(){
		if(defined('SETTING_INFORMATION')) return false;
		unset($settingObj,$array_setting);

		$settingObj = new Setting();
		$array_setting = $settingObj->convertTableToArray();

		if(is_array($array_setting)){
			define("SETTING_INFORMATION", serialize($array_setting));
		}

	}
	
	/*
	 * Function to create a constant with table of setting Information
	 */
	function setting_social_network_constants(){
		if(defined('SETTING_SOCIAL_NETWORK_INFORMATION')) return false;
		unset($settingObj,$array_setting);

		$settingObj = new SettingSocialNetwork();
		$array_setting = $settingObj->convertTableToArray();

		if(is_array($array_setting)){
			define("SETTING_SOCIAL_NETWORK_INFORMATION", serialize($array_setting));
		}

	}

	
	/*
	 * Function to get information about language
	 */
	function setting_getSettingSocialNetworkInformation($index){

		if(!defined('SETTING_SOCIAL_NETWORK_INFORMATION')){
			setting_social_network_constants();
		}

		$aux_setting_information = unserialize(SETTING_SOCIAL_NETWORK_INFORMATION);
		$array_setting_information = $aux_setting_information[$index];

		if(is_array($array_setting_information)){
			return $array_setting_information;
		}else{
			return false;
		}

	}
	
	
	
	/*
	 * Function to get information about language
	 */
	function setting_getSettingInformation($index){

		if(!defined('SETTING_INFORMATION')){
			setting_constants();
		}

		$aux_setting_information = unserialize(SETTING_INFORMATION);
		$array_setting_information = $aux_setting_information[$index];

		if(is_array($array_setting_information)){
			return $array_setting_information;
		}else{
			return false;
		}

	}
	
	function setting_social_network_get($name, &$value) {
		if ($name) {
			
			unset($array_settings);
			$array_settings = setting_getSettingSocialNetworkInformation($name);
			
			if((is_array($array_settings)) && ($_SERVER['REQUEST_METHOD']!="POST")){
				$value = $array_settings["value"];
				return true;
			}else{
			
				$settingObj = new SettingSocialNetwork($name);
				if ($settingObj->getString($name)) {
					$value = $settingObj->getString("value");
					return true;
				}
			}
			
		}
		$value = "";
		return false;
	}

?>
