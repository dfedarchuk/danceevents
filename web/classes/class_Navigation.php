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
	# * FILE: /classes/class_Navigation.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$navigationObj = new Navigation($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 9.7.00
	 * @package Classes
	 * @name Navigation
	 * @access Public
	 */
	class Navigation extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $order;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $label;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $link;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $area;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $custom;


		/**
		 * <code>
		 *		$navigationObj = new Navigation($id);
		 *		//OR
		 *		$navigationObj = new Navigation($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.7.00
		 * @name Navigation
		 * @access Public
		 * @param mixed $var
		 */
		function Navigation($var='', $domain_id = false) {

			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id) {
					$this->domain_id = $domain_id;
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				} else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Navigation WHERE order = $var";

				$row = mysql_fetch_array($db->query($sql));

				unset($db);

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
		 * @version 9.7.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row='') {

			$this->order    = ($row["order"])       ? $row["order"]     : ($this->order     ? $this->order  : 0);
			$this->label    = ($row["label"])       ? $row["label"]     : ($this->label     ? $this->label  : "");
			$this->link     = ($row["link"])        ? $row["link"]      : ($this->link      ? $this->link   : "");
			$this->area     = ($row["area"])        ? $row["area"]      : ($this->area      ? $this->area   : "");
			$this->custom   = ($row["custom"])      ? $row["custom"]    : ($this->custom    ? $this->custom : "");

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$navigationObj->Save();
		 * <br /><br />
		 *		//Using this in Navigation() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.7.00
		 * @name Save
		 * @access Public
		 */
		function Save() {

            $dbMain = db_getDBObject(DEFAULT_DB, true);

            if ($this->domain_id) {
                $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
            } else	if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }

            unset($dbMain);

            $this->prepareToSave();

            $sql = "INSERT INTO Setting_Navigation (`order`, `label`, `link`, `area`, `custom`) VALUES (".$this->order.", ".$this->label.", ".$this->link.", ".$this->area.", ".$this->custom.")";
            $dbObj->query($sql);

		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$navigationObj->ClearNavigation();
		 * <br /><br />
		 *		//Using this in Navigation() class.
		 *		$this->ClearNavigation();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.7.00
		 * @name ClearNavigation
		 * @access Public
         * @param string $area
		 */
        function ClearNavigation($area) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);

            if ($this->domain_id) {
                $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
            } else	if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }

            unset($dbMain);
            $sql = "DELETE FROM Setting_Navigation WHERE `area` = '".$area."'";
            $dbObj->query($sql);

        }

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$navigationObj->getNavbar();
		 * <br /><br />
		 *		//Using this in Navigation() class.
		 *		$this->getNavbar();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.7.00
		 * @name getNavbar
		 * @access Public
         * @param array $navBarOptions
         * @param string $area
		 */
        public static function getNavbar(&$navBarOptions, $area) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

            unset($dbMain, $navbar);

            $sql = "SELECT ".($api ? "label, link" : "*")." FROM Setting_Navigation WHERE `area` = '".$area."' ".($api ? " AND link NOT in ('home', 'mydeals', 'myreviews', 'myfavorites')" : "")." ORDER BY `order`";
            $result = $dbObj->query($sql);

            /*
             * reviews
             * nearby
             * account
             */


            if (mysql_num_rows($result)) {
                $i = 0;
                while($row = mysql_fetch_assoc($result)) {
                    $row["icon"] = null;

                    //Validate available modules
                    $addNode = false;
                    if ($area == "tabbar") {
                        $row["fixed"] = false;
                        if ($row["link"] == "events") {
                            if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
                                $addNode = true;
                            }
                        } elseif ($row["link"] == "classifieds") {
                            if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
                                $addNode = true;
                            }
                        } elseif ($row["link"] == "articles") {
                            if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
                                $addNode = true;
                            }
                        } elseif ($row["link"] == "blog") {
                            if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") {
                                $addNode = true;
                            }
                        } elseif ($row["link"] == "deals") {
                            if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {
                                $addNode = true;
                            }
                        }  elseif ($row["link"] == "mydeals") {
                            if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") {
                                $addNode = true;
                                $row["fixed"] = true;
                            }
                        } elseif ($row["link"] == "myreviews") {
                            setting_get("review_listing_enabled", $review_listing_enabled);
                            setting_get("review_article_enabled", $review_article_enabled);

                            if ($review_listing_enabled == "on" || $review_article_enabled == "on") {
                                $addNode = true;
                                $row["fixed"] = true;
                            }

                        } else if( strpos ( $row["link"], "cp_" ) !== false ) {
                            $parts = explode( "_", $row["link"]);
                            $customPage = AppCustomPage::Load( $parts[1] );
                            $row["icon"] = $customPage->icon;
                            $row["id"]   = $customPage->id;
                            $row["link"] = "custompage";
                        } else {
                            $addNode = true;

                            if ($row["link"] == "favorites" || $row["link"] == "about" || $row["link"] == "home") {
                                $row["fixed"] = true;
                            }
                        }
                    } else {
                        $addNode = true;
                    }

                    if ($addNode) {
                        foreach ($row as $key => $value) {
                            $navBarOptions[$i][$key] = $value;
                        }
                        $i++;
                    }
                }
            }
        }

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$navigationObj->ResetNavbar();
		 * <br /><br />
		 *		//Using this in Navigation() class.
		 *		$this->ResetNavbar();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.7.00
		 * @name ResetNavbar
		 * @access Public
         * @param string $area
		 */
        function ResetNavbar($area, $appBuilder = false) {

            $this->ClearNavigation($area);

            /**
             * Array with Modules and URL
             */
            if ($appBuilder) {
                $auxArrayModules = unserialize(APPBUILDER_MENU);
            } else {
                $auxArrayModules = unserialize(THEME_NAVIGATION_MENU);
            }
            $array_modules = $auxArrayModules[$area];

            for ($i = 0; $i < count($array_modules); $i++) {

                $moduleOn = false;
                if ($array_modules[$i]["module"]) {
                    if ((constant($array_modules[$i]["module"]) == "on") && (constant("CUSTOM_".$array_modules[$i]["module"]) == "on")) {
                        $moduleOn = true;
                    }

                } else {
                    $moduleOn = true;
                }

                if ($moduleOn) {

                    $labelName = strpos($array_modules[$i]["name"], "LANG_") !== false ? constant($array_modules[$i]["name"]) : $array_modules[$i]["name"];

                    unset($aux_array);
                    $aux_array["order"]     = $i;
                    $aux_array["label"]     = $labelName;
                    $aux_array["link"]      = $array_modules[$i]["url"];
                    $aux_array["area"]      = $area;
                    $aux_array["custom"]    = "n";
                    $this->makeFromRow($aux_array);
                    $this->Save();
                }
            }

            if (!$appBuilder) {
                $filePath = HTMLEDITOR_FOLDER."/".EDIR_THEME."/".$area."_menu.php";
                @unlink($filePath);
            }
        }
    }
