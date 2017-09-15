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
	# * FILE: /classes/class_ListingLevel.php
	# ----------------------------------------------------------------------------------------------------

	class ListingLevel {

		##################################################
		# PRIVATE
		##################################################

		var $default;
		var $value;
        var $name;
		var $detail;
		var $images;
        var $has_review;
        var $has_sms;
        var $has_call;
		var $price;
		var $price_yearly;
		var $trial;
		var $free_category;
		var $deals;
		var $category_price;
        var $active;
        var $popular;
        var $featured;
        var $classified_quantity_association;

		function ListingLevel($listAll = false, $domain_id = false) {

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

            if (!defined("ALL_LISTINGLEVEL_INFORMATION") || !defined("ACTIVE_LISTINGLEVEL_INFORMATION")) {
               $sql = "SELECT * FROM ListingLevel ORDER BY value DESC";
            }

            if ($sql != "") {
                $result = $dbObj->query($sql);
                unset($listingLevelAux);
                unset($listingLevelAuxAll);
                $i = 0;
                $j = 0;
                while ($row = mysql_fetch_assoc($result)) {
                    foreach ($row as $key => $value) {
                        if ($row["active"] == "y"){
                            if ($key == "defaultlevel" && $value == "y") $listingLevelAuxAll[$j]["default"] = $row["value"];
                            $listingLevelAuxAll[$j][$key] = $value;

                        }
                        if ($key == "defaultlevel" && $value == "y") $listingLevelAux[$i]["default"] = $row["value"];
                        $listingLevelAux[$i][$key] = $value;
                    }
                    $i++;
                    $j++;
                }
            }

            if (is_array($listingLevelAux)) {
                if (!defined("ALL_LISTINGLEVEL_INFORMATION")) {
                    define("ALL_LISTINGLEVEL_INFORMATION", serialize($listingLevelAux));
                }
            }

            if (is_array($listingLevelAuxAll)) {
                if (!defined("ACTIVE_LISTINGLEVEL_INFORMATION")) {
                    define("ACTIVE_LISTINGLEVEL_INFORMATION", serialize($listingLevelAuxAll));
                }
            }

            if ($listAll) {
                $listingLevelAux = unserialize(ALL_LISTINGLEVEL_INFORMATION);
            } else {
                $listingLevelAux = unserialize(ACTIVE_LISTINGLEVEL_INFORMATION);
            }

            if (is_array($listingLevelAux)) {
                foreach ($listingLevelAux as $listingLevel) {
                    if ($listingLevel["defaultlevel"] == "y")
                        $this->default = $listingLevel["value"];

                    $this->value[]          = $listingLevel["value"];
                    $this->name[]           = $listingLevel["name"];
                    $this->detail[]         = $listingLevel["detail"];
                    $this->images[]         = $listingLevel["images"];
                    $this->has_review[]     = $listingLevel["has_review"];
                    $this->has_sms[]        = $listingLevel["has_sms"];
                    $this->has_call[]       = $listingLevel["has_call"];
					$this->price[]    = $listingLevel["price"];
					$this->price_yearly[]    = $listingLevel["price_yearly"];
					$this->trial[]    = $listingLevel["trial"];
                    $this->free_category[]  = $listingLevel["free_category"];
					$this->deals[]  		= $listingLevel["deals"];
					$this->category_price[] = $listingLevel["category_price"];
                    $this->active[]         = $listingLevel["active"];
                    $this->popular[]        = $listingLevel["popular"];
                    $this->featured[]       = $listingLevel["featured"];
                    $this->classified_quantity_association[] = $listingLevel["classified_quantity_association"];

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

		function getClassifiedQuantityAssociation($value) {
            $classified_quantity_association = $this->union($this->value, $this->classified_quantity_association);
            if (isset($classified_quantity_association[$value])) return $classified_quantity_association[$value];
            else return $classified_quantity_association[$this->default];
        }

        function getHasReview($value) {
			$hasreviewArray = $this->union($this->value, $this->has_review);
			if (isset($hasreviewArray[$value])) return $hasreviewArray[$value];
			else return $hasreviewArray[$this->default];
		}

		function getHasSms($value) {
			$hassmsArray = $this->union($this->value, $this->has_sms);
			if (isset($hassmsArray[$value])) return $hassmsArray[$value];
			else return $hassmsArray[$this->default];
		}

		function getHasCall($value) {
			$hascallArray = $this->union($this->value, $this->has_call);
			if (isset($hascallArray[$value])) return $hascallArray[$value];
			else return $hascallArray[$this->default];
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

		function getFreeCategory($value) {
			$freeCategoryArray = $this->union($this->value, $this->free_category);
			if (isset($freeCategoryArray[$value])) return $freeCategoryArray[$value];
			else return $freeCategoryArray[$this->default];
		}

		function getDeals($value) {
			$dealsArray = $this->union($this->value, $this->deals);
			if (isset($dealsArray[$value])) return $dealsArray[$value];
			else return $dealsArray[$this->default];
		}

		function getCategoryPrice($value) {
			$categoryPriceArray = $this->union($this->value, $this->category_price);
			if (isset($categoryPriceArray[$value])) return $categoryPriceArray[$value];
			else return $categoryPriceArray[$this->default];
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

        function getLevelOrdering($value) {
            switch ( $value ) {
                case 10:
                    return system_showText(LANG_SITEMGR_FIRST);
                case 30:
                    return system_showText(LANG_SITEMGR_SECOND);
                case 50:
                    return system_showText(LANG_SITEMGR_THIRD);
                case 70:
                    return system_showText(LANG_SITEMGR_FOURTH);
            }
        }

		function convertTableToArray(){
			$array_fields = get_object_vars($this);

			unset($level_values);
			for($i=0;$i<count($array_fields["value"]);$i++){
				$level_values[] = $array_fields["value"][$i];

			}

			if(count($level_values) && is_array($array_fields)){
				$aux_new_array_fields = array();
				foreach($array_fields as $key => $value){
					if(is_array($value)){
						for($i=0;$i<count($level_values);$i++){
							$aux_new_array_fields[$key][$level_values[$i]] = $value[$i];
						}
					}

				}

				return $aux_new_array_fields;

			}else{
				return false;
			}

		}

        function updateValues($name = "", $active = "", $has_review = "", $has_sms = "", $has_call = "", $detail = "", $images = "", $levelValue, $type = "names", $popular = "", $classified_association_quantity = ""){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            if ($type == "names") {
                $sql = "UPDATE ListingLevel SET name = '".$name."', active = '".$active."', popular = '".$popular."' WHERE value = ".$levelValue;
            } elseif ($type == "fields") {
                $sql = "UPDATE ListingLevel SET detail = '$detail', has_review = '".$has_review."', has_sms = '".$has_sms."', has_call = '".$has_call."', images = '".$images."', classified_quantity_association = {$classified_association_quantity} WHERE value = ".$levelValue;
            }

            $dbObj->query($sql);

        }

        function updatePricing($field, $fieldValue, $level){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $sql = "UPDATE ListingLevel SET $field = ".$fieldValue." WHERE value = ".$level;
            $dbObj->query($sql);
        }

        function updateFeatured($newValue, $level){

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            $sql = "UPDATE ListingLevel SET featured = '{$newValue}' WHERE value = ".$level;
            $dbObj->query($sql);
        }

		##################################################
		# PUBLIC
		##################################################

	}



?>
