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
	# * FILE: /classes/class_ClassifiedLevel.php
	# ----------------------------------------------------------------------------------------------------

	class ClassifiedLevel {

		##################################################
		# PRIVATE
		##################################################

		var $default;
		var $value;
		var $name;
		var $detail;
		var $images;
        var $price;
        var $price_yearly;
        var $trial;
		var $active;
        var $popular;
        var $featured;
        var $video;
        var $additional_files;

		function ClassifiedLevel($listAll = false, $domain_id = false) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id){
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

            $sql = "";

            if (!defined("ALL_CLASSIFIEDLEVEL_INFORMATION") || !defined("ACTIVE_CLASSIFIEDLEVEL_INFORMATION")) {
               $sql = "SELECT * FROM ClassifiedLevel ORDER BY value DESC";
            }

            if ($sql != "") {
                $result = $dbObj->query($sql);
                unset($classifiedLevelAux);
                unset($classifiedLevelAuxAll);
                $i = 0;
                $j = 0;
                while ($row = mysql_fetch_assoc($result)) {
                    foreach ($row as $key => $value) {
                        if ($row["active"] == "y"){
                            if ($key == "defaultlevel" && $value == "y") $classifiedLevelAuxAll[$j]["default"] = $row["value"];
                            $classifiedLevelAuxAll[$j][$key] = $value;

                        }
                        if ($key == "defaultlevel" && $value == "y") $classifiedLevelAux[$i]["default"] = $row["value"];
                        $classifiedLevelAux[$i][$key] = $value;
                    }
                    $i++;
                    $j++;
                }
            }

            if (is_array($classifiedLevelAux)) {
                if (!defined("ALL_CLASSIFIEDLEVEL_INFORMATION")) {
                    define("ALL_CLASSIFIEDLEVEL_INFORMATION", serialize($classifiedLevelAux));
                }
            }

            if (is_array($classifiedLevelAuxAll)) {
                if (!defined("ACTIVE_CLASSIFIEDLEVEL_INFORMATION")) {
                    define("ACTIVE_CLASSIFIEDLEVEL_INFORMATION", serialize($classifiedLevelAuxAll));
                }
            }

            if ($listAll) {
                $classifiedLevelAux = unserialize(ALL_CLASSIFIEDLEVEL_INFORMATION);
            } else {
                $classifiedLevelAux = unserialize(ACTIVE_CLASSIFIEDLEVEL_INFORMATION);
            }

            if (is_array($classifiedLevelAux)) {
                foreach ($classifiedLevelAux as $classifiedLevel) {
                    if ($classifiedLevel["defaultlevel"] == "y") $this->default = $classifiedLevel["value"];

                    $this->value[]              = $classifiedLevel["value"];
                    $this->name[]               = $classifiedLevel["name"];
                    $this->detail[]             = $classifiedLevel["detail"];
                    $this->images[]             = $classifiedLevel["images"];
                    $this->price[]              = $classifiedLevel["price"];
                    $this->price_yearly[]       = $classifiedLevel["price_yearly"];
                    $this->trial[]              = $classifiedLevel["trial"];
                    $this->active[]             = $classifiedLevel["active"];
                    $this->popular[]            = $classifiedLevel["popular"];
                    $this->featured[]           = $classifiedLevel["featured"];
                    $this->video[]              = $classifiedLevel["video"];
                    $this->additional_files[]   = $classifiedLevel["additional_files"];
                }
            }

		}

		function getValues() {
			return $this->value;
		}

		function getNames() {
			return $this->name;
		}

		function union($key, $value) {
			for ($i=0; $i<count($key); $i++) {
				$aux[$key[$i]] = $value[$i];
			}
			return $aux;
		}

		function getValueName() {
			return $this->union($this->getValues(), $this->getNames());
		}

		function getDefault() {
            $activeArray =  array_filter($this->union($this->value, $this->active), 'validateActive');
            if(array_key_exists($this->default, $activeArray)) {
                return $this->default;
            } else {
                krsort($activeArray);
                $newActiveArray = array_keys($activeArray);
                return $newActiveArray[0];
            }
        }

		function getName($value) {
			if (is_numeric($value)){
				$value_name = $this->getValueName();
				return $value_name[$value];
			}
		}

		##################################################
		# PRIVATE
		##################################################

		##################################################
		# PUBLIC
		##################################################

		function getLevel($value) {
			if ($this->getName($value)) return $this->getName($value);
			else return $this->getLevel($this->getDefaultLevel());
		}

		function getDetail($value) {
			$detailArray = $this->union($this->value, $this->detail);
			if (isset($detailArray[$value])) return $detailArray[$value];
			else return $detailArray[$this->default];
		}

		function getImages($value) {
			$imagesArray = $this->union($this->value, $this->images);
			if (isset($imagesArray[$value])) return $imagesArray[$value];
			else return $imagesArray[$this->default];
		}

		function getPrice($value, $period = '') {
			$priceArray = $this->union($this->value, $this->{'price'.($period ? '_'.$period : $period)});
			if (isset($priceArray[$value])) return $priceArray[$value];
			else return $priceArray[$this->default];
		}

        function getTrial($value) {
            $trialArray = $this->union($this->value, $this->trial);
            if (isset($trialArray[$value])) return $trialArray[$value];
            else return $trialArray[$this->default];
        }

		function getDefaultLevel() {
			return $this->getDefault();
		}

		function getLevelValues() {
			return $this->getValues();
		}

		function getLevelNames() {
			return $this->getNames();
		}

		function showLevel($value) {
			if ($this->getName($value)) return string_ucwords($this->getName($value));
			else return string_ucwords($this->getLevel($this->getDefaultLevel()));
		}

		function showLevelNames() {
			$names = $this->getNames();
			foreach ($names as $name) {
				$array[] = string_ucwords($name);
			}
			return $array;
		}

        function getActive($value) {
            $activeArray = $this->union($this->value, $this->active);
            return $activeArray[$value];
        }

        function getLevelActive($value) {
            if ($this->getActive($value) == 'y') return $value;
            else return $this->getDefaultLevel();
        }

        function getPopular($value) {
            $popularArray = $this->union($this->value, $this->popular);
            return $popularArray[$value];
        }

        function getFeatured($value) {
            $popularArray = $this->union($this->value, $this->featured);
            return $popularArray[$value];
        }

        function getVideo($value) {
            $videoArray = $this->union($this->value, $this->video);
            if (isset($videoArray[$value])) return $videoArray[$value];
            else return $videoArray[$this->default];
        }

        function getAdditionalFiles($value) {
            $additionalFilesArray = $this->union($this->value, $this->additional_files);
            if (isset($additionalFilesArray[$value])) return $additionalFilesArray[$value];
            else return $additionalFilesArray[$this->default];
        }

        function getLevelOrdering($value) {
            switch ( $value ) {
                case 10:
                    return system_showText(LANG_SITEMGR_FIRST);
                    break;
                case 30:
                    return system_showText(LANG_SITEMGR_SECOND);
                    break;
                case 50:
                    return system_showText(LANG_SITEMGR_THIRD);
                    break;
            }
        }

        function updateValues($name, $active, $detail = "", $images = "", $levelValue, $video = "", $additional_files = "", $type = "names", $popular = ""){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            if ($type == "names") {
                $sql = "UPDATE ClassifiedLevel SET name = '".$name."', active = '".$active."', popular = '".$popular."' WHERE value = ".$levelValue;
            } elseif ($type == "fields") {
                $sql = "UPDATE ClassifiedLevel SET detail = '".$detail."', images = '".$images."', video = '".$video."', additional_files = '".$additional_files."' WHERE value = ".$levelValue;
            }

            $dbObj->query($sql);

        }

        function updatePricing($field, $fieldValue, $level){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $sql = "UPDATE ClassifiedLevel SET $field = ".$fieldValue." WHERE value = ".$level;
            $dbObj->query($sql);
        }

        function updateFeatured($newValue, $level){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $sql = "UPDATE ClassifiedLevel SET featured = '{$newValue}' WHERE value = ".$level;
            $dbObj->query($sql);
        }

		##################################################
		# PUBLIC
		##################################################
	}
