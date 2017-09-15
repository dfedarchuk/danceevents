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
	# * FILE: /classes/class_locationManager.php
	# ----------------------------------------------------------------------------------------------------

	class LocationManager extends Handle {

		/* table object with location id fields */
		var $table;

		/* arrays to store location objects for results pages */
		var $locations;
		var $instances;

		function LocationManager() {
			$this->relationships = array();
			$this->relationships["location_1"] = "Location1";
			$this->relationships["location_2"] = "Location2";
			$this->relationships["location_3"] = "Location3";
			$this->relationships["location_4"] = "Location4";
			$this->relationships["location_5"] = "Location5";
			$this->locations = array();
			$this->instances = 0;
		}

		function getLocationObject($objectName, $objectId){
			if(!$this->locations[$objectName][$objectId]){
				$this->locations[$objectName][$objectId] = new $objectName($objectId);
				$this->instances++;
			}
			return $this->locations[$objectName][$objectId];
		}

		function getInstances(){
			return $this->instances; /* only for statistics */
		}

	}

?>