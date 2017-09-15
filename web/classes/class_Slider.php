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
	# * FILE: /classes/class_Slider.php
	# ----------------------------------------------------------------------------------------------------

	class Slider extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $title;
		/**
		 * @var string
		 * @access Private
		 */
		var $summary;
		/**
		 * @var string
		 * @access Private
		 */
		var $link;
		/**
		 * @var string
		 * @access Private
		 */
		var $slide_order;
		/**
		 * @var string
		 * @access Private
		 */
		var $target;
		/**
		 * @var string
		 * @access Private
		 */
		var $area;


		/**
		 * <code>
		 *		$sliderObj = new Slider($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.0.00
		 * @name Slider
		 * @access Public
		 * @param integer $var
		 */
		function Slider($var='', $domain_id = false) {

			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$this->domain_id = $domain_id;
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				}else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Slider WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));

				$this->makeFromRow($row);
			} else {
                if (!is_array($var)) {
                    $var = array();
                }
				$this->makeFromRow($var);
			}

		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row='') {

				$this->id					= ($row["id"])					? $row["id"]				: ($this->id					? $this->id                 : 0);
				$this->title				= ($row["title"])				? $row["title"]				: ($this->title					? $this->title              : "");
				$this->image_id				= ($row["image_id"])			? $row["image_id"]			: ($this->image_id				? $this->image_id           : 0);
				$this->summary				= ($row["summary"])             ? $row["summary"]           : ($this->summary               ? $this->summary            : "");
				$this->link                 = ($row["link"])				? $row["link"]              : ($this->link                  ? $this->link               : "");
				$this->slide_order			= ($row["slide_order"])			? $row["slide_order"]   	: ($this->slide_order			? $this->slide_order		: 0);
                $this->target				= ($row["target"])				? $row["target"]			: ($this->target				? $this->target				: "");
				$this->area					= ($row["area"])				? $row["area"]				: ($this->area					? $this->area				: "");
		}


		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$sliderObj->Save();
		 * <br /><br />
		 *		//Using this in Slider() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			} else	if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			$this->prepareToSave();

			if ($this->id) {

				$sql  = "UPDATE Slider SET"
					. " title               = $this->title,"
					. " image_id            = $this->image_id,"
					. " summary             = $this->summary,"
					. " link                = $this->link,"
					. " slide_order         = $this->slide_order,"
					. " target              = $this->target,"
					. " area               	= $this->area"
					. " WHERE id            = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Slider"
					. " (title,"
					. " image_id,"
					. " summary,"
					. " link,"
					. " slide_order,"
					. " target,"
					. " area)"
					. " VALUES"
					. " ($this->title,"
					. " $this->image_id,"
					. " $this->summary,"
					. " $this->link,"
					. " $this->slide_order,"
					. " $this->target,"
					. " $this->area)";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);


			}

			$this->prepareToUse();

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$sliderObj->Delete();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.0.00
		 * @name Delete
		 * @access Public
		 * @param integer $domain_id
		 */
		function Delete($domain_id = false) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
			}

			### Slider
			$sql = "DELETE FROM Slider WHERE id = $this->id";
			$dbObj->query($sql);

            ### IMAGE
            if ($this->image_id) {
                $image = new Image($this->image_id);
                if ($image){
                    $image->Delete($domain_id);
                }
            }

        }

		function getAllSliderItems($domain_id = false, $area = "web") {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
			}

			$sql = "SELECT * FROM Slider WHERE area = '$area' ORDER BY slide_order";
			$result = $dbObj->query($sql);
			unset($array_slider);
			if (mysql_num_rows($result)) {
				$i = 1; // needs be 1 to work on form of sitemgr

				while ($row = mysql_fetch_assoc($result)) {
					foreach ($this as $key => $value) {
						$array_slider[$i][$key] = htmlspecialchars($row[$key]);
					}
					$i++;
				}
				return $array_slider;
			} else {
				return false;
			}

		}

		function ClearSlider() {
			$this->title				= "";
			$this->image_id				= 0;
			$this->summary				= "";
			$this->link                 = "";
			$this->Save();
		}

        public static function SaveOrder(array $array_order = [])
        {
            if (!count($array_order)) {
                return false;
            }

            $dbObj = db_getDBObject();
            try {
                for ($i = 0; $i < count($array_order); $i++) {
                    $sql = 'UPDATE Slider SET slide_order = '. ($i + 1) .' WHERE id = '.$array_order[$i];
                    $dbObj->query($sql);
                }
            } catch (Exception $e) {
                return false;
            }

            return true;
        }
	}