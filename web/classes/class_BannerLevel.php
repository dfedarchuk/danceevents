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
	# * FILE: /classes/class_BannerLevel.php
	# ----------------------------------------------------------------------------------------------------

	class BannerLevel {

		##################################################
		# PRIVATE
		##################################################

		var $default;
		var $value;
		var $name;
		var $price;
		var $price_yearly;
		var $trial;
		var $width;
		var $height;
		var $impression_block;
		var $impression_price;
        var $active;
        var $popular;
		var $displayName;

		function BannerLevel($listAll = false, $domain_id = false) {

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

            $sql = "";

            if (!defined("ALL_BANNERLEVEL_INFORMATION") || !defined("ACTIVE_BANNERLEVEL_INFORMATION")) {
                $sql = "SELECT * FROM BannerLevel ORDER BY value";
            }

            if ($sql != "") {
                $result = $dbObj->query($sql);
                unset($bannerLevelAux);
                unset($bannerLevelAuxAll);
                $i = 0;
                $j = 0;
                while ($row = mysql_fetch_assoc($result)) {
                    foreach ($row as $key => $value) {
                        if ($row["active"] == "y"){
                            if ($key == "defaultlevel" && $value == "y") $bannerLevelAuxAll[$j]["default"] = $row["value"];
                            $bannerLevelAuxAll[$j][$key] = $value;

                        }
                        if ($key == "defaultlevel" && $value == "y") $bannerLevelAux[$i]["default"] = $row["value"];
                        $bannerLevelAux[$i][$key] = $value;
                    }
                    $i++;
                    $j++;
                }
            }

            if (is_array($bannerLevelAux)) {
                if (!defined("ALL_BANNERLEVEL_INFORMATION")) {
                    define("ALL_BANNERLEVEL_INFORMATION", serialize($bannerLevelAux));
                }
            }

            if (is_array($bannerLevelAuxAll)) {
                if (!defined("ACTIVE_BANNERLEVEL_INFORMATION")) {
                    define("ACTIVE_BANNERLEVEL_INFORMATION", serialize($bannerLevelAuxAll));
                }
            }

            if ($listAll) {
                $bannerLevelAux = unserialize(ALL_BANNERLEVEL_INFORMATION);
            } else {
                $bannerLevelAux = unserialize(ACTIVE_BANNERLEVEL_INFORMATION);
            }

            if (is_array($bannerLevelAux)) {
                foreach ($bannerLevelAux as $bannerLevel) {
                    if ($bannerLevel["defaultlevel"] == "y") $this->default = $bannerLevel["value"];
                    $this->value[] = $bannerLevel["value"];
                    $this->name[] = $bannerLevel["name"];
					$this->price[]    = $bannerLevel["price"];
					$this->price_yearly[]    = $bannerLevel["price_yearly"];
					$this->trial[]    = $bannerLevel["trial"];
                    $this->width[] = $bannerLevel["width"];
                    $this->height[] = $bannerLevel["height"];
                    $this->impression_block[] = $bannerLevel["impression_block"];
                    $this->impression_price[] = $bannerLevel["impression_price"];
                    $this->active[] = $bannerLevel["active"];
                    $this->displayName[] = $bannerLevel["displayName"];
                    $this->popular[] = $bannerLevel["popular"];
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
                ksort($activeArray);
                $newActiveArray = array_keys($activeArray);
                return $newActiveArray[0];
            }
        }

		function getStatus ($value) {
			$auxStatus = $this->union($this->getValues(), $this->active);
			return $auxStatus[$value];
		}

        function getName($value, $name = false) {
            if ($name){
				if (is_numeric($value)){
					$value_name = $this->getValueName();
					return $value_name[$value];
				}
			} else {
				return $this->getDisplayName($value);
			}
        }

		function getDisplayName($value) {
			if (is_numeric($value)){
				$value_name = $this->union($this->value, $this->displayName);
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

		function getPrice($value, $expiration_setting = BANNER_EXPIRATION_RENEWAL_DATE, $period = '') {
			if($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE){
				$priceArray = $this->union($this->value, $this->{'price'.($period ? '_'.$period : $period)});
			} elseif ($expiration_setting == BANNER_EXPIRATION_IMPRESSION){
				$priceArray = $this->union($this->value, $this->impression_price);
			}
			if (isset($priceArray[$value])) return $priceArray[$value];
			else return $priceArray[$this->default];
		}

		function getTrial($value) {
			$trialArray = $this->union($this->value, $this->trial);
			if (isset($trialArray[$value])) return $trialArray[$value];
			else return $trialArray[$this->default];
		}

		function getImpressionBlock($value) {
			$impression_block_array = $this->union($this->value, $this->impression_block);
			if (isset($impression_block_array[$value])) return $impression_block_array[$value];
			else return $impression_block_array[$this->default];
		}

		function getImpressionPrice($value) {
			$impression_price_array = $this->union($this->value, $this->impression_price);
			if (isset($impression_price_array[$value])) return $impression_price_array[$value];
			else return $impression_price_array[$this->default];
		}

		function getWidth($value) {
			$widthArray = $this->union($this->value, $this->width);
			if (isset($widthArray[$value])) return $widthArray[$value];
			else return $widthArray[$this->default];
		}

		function getHeight($value) {
			$heightArray = $this->union($this->value, $this->height);
			if (isset($heightArray[$value])) return $heightArray[$value];
			else return $heightArray[$this->default];
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
			else return false;
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

        function getPopular($value) {
            $popularArray = $this->union($this->value, $this->popular);
            return $popularArray[$value];
        }

        function updateValues($name, $active, $levelValue, $popular = ""){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $sql = "UPDATE BannerLevel SET displayName = '".$name."', active = '".$active."', popular = '".$popular."' WHERE value = ".$levelValue;
            $dbObj->query($sql);

        }

        function updatePricing($field, $fieldValue, $level){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $sql = "UPDATE BannerLevel SET $field = ".$fieldValue." WHERE value = ".$level;
            $dbObj->query($sql);
        }

		##################################################
		# PUBLIC
		##################################################

	}

?>
