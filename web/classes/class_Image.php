<?php

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
	# * FILE: /classes/class_image.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$imageObj = new Image($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Image
	 * @method Image
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method imageExists
	 * @method getTag
	 * @method _getTag
	 * @method getAntialiasedTag
	 * @access Public
	 */
	class Image extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $type;
		/**
		 * @var integer
		 * @access Private
		 */
		var $width;
		/**
		 * @var integer
		 * @access Private
		 */
		var $height;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $prefix;
		/**
		 * @var boolean
		 * @access Private
		 */
		var $force_main;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $IMAGE_RELATIVE_PATH;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $IMAGE_DIR;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $IMAGE_URL;

		/**
		 * <code>
		 *		$imageObj = new Image($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Lang
		 * @access Public
		 * @param mixed $var
		 */
		function Image($var = "", $force_main = false, $domain_id = false) {
			$this->force_main = $force_main;

			if ($this->force_main) {
				$this->IMAGE_RELATIVE_PATH = PROFILE_IMAGE_RELATIVE_PATH;
				$this->IMAGE_DIR = PROFILE_IMAGE_DIR;
				$this->IMAGE_URL = PROFILE_IMAGE_URL;
			} else {
				$this->IMAGE_RELATIVE_PATH = IMAGE_RELATIVE_PATH;
				$this->IMAGE_DIR = IMAGE_DIR;
				$this->IMAGE_URL = IMAGE_URL;
			}

			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($this->force_main) {
					$db = $dbMain;
				} else if ($domain_id) {
					$db = db_getDBObjectByDomainID($domain_id, $dbMain);
				} else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}

				unset($dbMain);
				$sql = "SELECT * FROM Image WHERE id = $var";
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
		 * @version 8.0.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row="") {
			if ($row["id"]) $this->id = $row["id"];
			else if (!$this->id) $this->id = 0;
			$row["type"] ? $this->type = $row["type"] : $this->type = 0;
			$row["width"] ? $this->width = $row["width"] : $this->width = 0;
			$row["height"] ? $this->height = $row["height"] : $this->height = 0;
			$row["prefix"] ? $this->prefix = $row["prefix"] : $this->prefix = "";
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->Save();
		 * <br /><br />
		 *		//Using this in Image() class.
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
			if ($this->force_main) {
				$dbObj = $dbMain;
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			$this->prepareToSave();

			if ($this->id) {
				$sql = "UPDATE Image SET"
					. " type = $this->type,"
					. " width = $this->width,"
					. " height = $this->height,"
					. " prefix = $this->prefix"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Image"
					. " (type, width, height,prefix)"
					. " VALUES"
					. " ($this->type, $this->width, $this->height, $this->prefix)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->Delete();
		 * <br /><br />
		 *		//Using this in Image() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 * @param integer $domain_id
		 */
		function Delete($domain_id = false) {
			$type = string_strtolower($this->type);
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->force_main) {
				$db = $dbMain;
			} else if ($domain_id) {
				$db = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
			}
			$sql = "DELETE FROM Image WHERE id = $this->id";
			$db->query($sql);
			@unlink($this->IMAGE_DIR."/".$this->prefix."photo_".$this->id.".".$type);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->imageExists();
		 * <br /><br />
		 *		//Using this in Image() class.
		 *		$this->imageExists();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name imageExists
		 * @access Public
		 * @return boolean
		 */
		function imageExists() {
			$type = string_strtolower($this->type);
			$tmpFilename = $this->IMAGE_DIR."/".$this->prefix."photo_".$this->id.".".$type;
			return (file_exists($tmpFilename) && is_readable($tmpFilename));
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->getTag(...);
		 * <br /><br />
		 *		//Using this in Image() class.
		 *		$this->getTag(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getTag
		 * @access Public
		 * @param boolean $resize
		 * @param integer $maxWidth
		 * @param integer $maxHeight
		 * @param varchar $title
		 * @param boolean $force_resize
		 * @return varchar htmlcode
		 */
		function getTag($resize = false, $maxWidth = 0, $maxHeight = 0, $title="", $force_resize = false, $alternative_text = false, $class = false) {
			
			if (RESIZE_IMAGES_UPGRADE == "off"){
				$force_resize = false;
			}

			return $this->_getTag($resize, $maxWidth, $maxHeight, $title, $force_resize, $alternative_text, $class);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->_getTag(...);
		 * <br /><br />
		 *		//Using this in Image() class.
		 *		$this->_getTag(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name _getTag
		 * @access Public
		 * @param boolean $resize
		 * @param integer $maxWidth
		 * @param integer $maxHeight
		 * @param varchar $title
		 * @param boolean $force_resize
		 * @return varchar htmlcode
		 */
		function _getTag($resize = false, $maxWidth = 0, $maxHeight = 0, $title="", $force_resize = false, $alternative_text = false, $class = false){
			$type = string_strtolower($this->type);
			
			/*
			 * Alternative text for SEO
			 */
			unset($aux_image_seo); 
			if($alternative_text){
				$aux_image_seo .= " alt=\"".string_htmlentities($alternative_text)."\" ";
			}else{
				if($title){
					$aux_image_seo .= " alt=\"".string_htmlentities($title)."\"";
				}else{
					$aux_image_seo .= " alt=\"Business Image\"";
				}
				
			}
			if($title){
				$aux_image_seo .= " title =\"".string_htmlentities($title)."\" ";
			}else{
				$aux_image_seo .= "";
			}
			
			$title = $aux_image_seo;
			if ($force_resize) {
				$return = "<img ".($class ? "class=\"".$class."\"": "")." width=\"".$maxWidth."\" height=\"".$maxHeight."\" src=\"".$this->IMAGE_URL."/".$this->prefix."photo_".$this->id.".".$type."\" ".$title." />";
			} elseif($resize) {
				image_getNewDimension($maxWidth, $maxHeight, $this->width, $this->height, $newWidth, $newHeight);
				$return = "<img ".($class ? "class=\"".$class."\"": "")." width=\"".(int)$newWidth."\" height=\"".(int)$newHeight."\" src=\"".$this->IMAGE_URL."/".$this->prefix."photo_".$this->id.".".$type."\" ".$title." ".(RESIZE_IMAGES_UPGRADE == "off"? "style=\"display:inline\"" : "")." />";
			} else {
				$return = "<img ".($class ? "class=\"".$class."\"": "")." src=\"".$this->IMAGE_URL."/".$this->prefix."photo_".$this->id.".".$type."\" ".$title." />";
			}
			return $return;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->getAntialiasedTag(...);
		 * <br /><br />
		 *		//Using this in Image() class.
		 *		$this->getAntialiasedTag(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getAntialiasedTag
		 * @access Public
		 * @param boolean $resize
		 * @param integer $maxWidth
		 * @param integer $maxHeight
		 * @param varchar $title
		 * @param boolean $distort
		 * @param varchar $img_path
		 * @return varchar htmlcode
		 */
		function getAntialiasedTag($resize = false, $maxWidth, $maxHeight, $title = "", $distort = false, $img_path = false, $alternative_text = false, $class = false) {
			$img_path = ($img_path) ? $img_path : $this->IMAGE_RELATIVE_PATH;

			$type = string_strtolower($this->type);
			if (!$maxWidth || !$maxHeight){
				$file = EDIRECTORY_ROOT.$img_path."/".$this->prefix."photo_".$this->id.".".$type;
				list($maxWidth, $maxHeight, $fileType, $fileAttr) = getimagesize($file);
			}
			$file = $img_path."/".$this->prefix."photo_".$this->id.".".$type;
			if ($resize) {
				if (!$distort) {
					image_getNewDimension($maxWidth, $maxHeight, $this->width, $this->height, $newWidth, $newHeight);
					$maxWidth = $newWidth;
					$maxHeight = $newHeight;
				}
			}
			return "<img ".($class ? "class=\"".$class."\"": "")." alt=\"".string_htmlentities($alternative_text)."\" title=\"".string_htmlentities($title)."\" src=\"".DEFAULT_URL."/image_resizer.php?img=".$file."&newWidth=".(int)$maxWidth."&newHeight=".(int)$maxHeight."\" width=\"".(int)$maxWidth."\" height=\"".(int)$maxHeight."\" />";
		}
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->getPath(...);
		 * <br /><br />
		 *		//Using this in Image() class.
		 *		$this->getPath(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getPath
		 * @access Public
		 * @return varchar $path
		 */
        function getPath($relativePath = true){
            $path = "";
            $type = string_strtolower($this->type);
            if ($relativePath) {
                $path = $this->IMAGE_URL."/".$this->prefix."photo_".$this->id.".".$type;
            } else {
                $path = $this->IMAGE_DIR."/".$this->prefix."photo_".$this->id.".".$type;
            }
            
            return $path;
        }
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$imageObj->getName(...);
		 * <br /><br />
		 *		//Using this in Image() class.
		 *		$this->getName(...);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getName
		 * @access Public
		 * @return varchar $name
		 */
        function getName() {
            $name = "";
            $type = string_strtolower($this->type);
            $name = $this->prefix."photo_".$this->id.".".$type;
            
            return $name;
        }

	}

?>
