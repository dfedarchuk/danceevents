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
    # * FILE: /classes/class_lang.php
    # ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$langObj = new Lang($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Lang
	 * @method Lang
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method changeOrder
	 * @method changeStatus
	 * @method defineDefault
	 * @method getAll
	 * @method getCountEnabledLang
	 * @method getDefault
	 * @method getDefaultName
	 * @method getDefaultLang
	 * @method hasDuplicateOrder
	 * @method newOrder
	 * @method setDefault
	 * @method writeLanguageFile
	 * @access Public
	 */
    class Lang extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
        var $id_number;
		/**
		 * @var char
		 * @access Private
		 */
        var $id;
		/**
		 * @var varchar
		 * @access Private
		 */
        var $name;
		/**
		 * @var char
		 * @access Private
		 */
        var $lang_enabled;
		/**
		 * @var char
		 * @access Private
		 */
        var $lang_default;
		/**
		 * @var integer
		 * @access Private
		 */
        var $lang_order;

		/**
		 * <code>
		 *		$langObj = new Lang($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Lang
		 * @access Public
		 * @param mixed $var
		 */
        function Lang($var='') {
            if ($var && !is_array($var)) {

				/*
				 * Get information of constant of language
				 */
				unset($row);
				$row = language_getLanguageInformation($var);
				if(is_array($row)){
					$this->makeFromRow($row);
				}else{
					$dbMain = db_getDBObject(DEFAULT_DB, true);
					if (defined("SELECTED_DOMAIN_ID")) {
						$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
					} else {
						$db = db_getDBObject();
					}

					unset($dbMain);
					$sql = "SELECT * FROM Lang WHERE id = '$var'";
					$row = mysql_fetch_array($db->query($sql));
					$this->makeFromRow($row);
				}
                
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
        function makeFromRow($row='') {
            
            $this->id_number         = ($row["id_number"])             ? $row["id_number"]         : ($this->id_number             ? $this->id_number         :  '');
            $this->id                = ($row["id"])                    ? $row["id"]                : ($this->id                    ? $this->id                :  '');
            $this->name              = ($row["name"])                  ? $row["name"]              : ($this->name                  ? $this->name              :  '');
            $this->lang_enabled      = ($row["lang_enabled"])          ? $row["lang_enabled"]      : ($this->lang_enabled          ? $this->lang_enabled      :  'n');
            $this->lang_default      = ($row["lang_default"])          ? $row["lang_default"]      : ($this->lang_default          ? $this->lang_default      :  'n');
            $this->lang_order      	 = ($row["lang_order"])            ? $row["lang_order"]        : ($this->lang_order            ? $this->lang_order        :  '0');
            
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->Save();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 * @return boolean
		 */
        function Save($domain_id) {

            $this->prepareToSave();

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id) {
                $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
            } elseif (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

            if ($this->id_number && $this->id_number != "''") {
                $sql  = "UPDATE Lang SET"
                    . " name     = $this->name,"
                    . " lang_enabled  = $this->lang_enabled,"
                    . " lang_default  = $this->lang_default,"
                    . " lang_order  = $this->lang_order"
                    . " WHERE id_number = $this->id_number";

                if (!$dbObj->query($sql)) {
                    return false;
                }
            } else {
                $sql = "INSERT INTO Lang (id, name, lang_enabled, lang_default) VALUES ("
                    . " $this->id,"
                    . " $this->name,"
                    . " $this->lang_enabled,"
                    . " $this->lang_default)";
                $dbObj->query($sql);

				$this->id_number = mysql_insert_id($dbObj->link_id);
                
                $sql = "UPDATE Lang SET lang_order = ".$this->id_number." WHERE id_number = ".$this->id_number;
                $dbObj->query($sql);
            }

            $this->prepareToUse();
            
            return $this->writeLanguageFile();

        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->writeLanguageFile();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->writeLanguageFile();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name writeLanguageFile
		 * @access Public
		 * @return boolean $return_flag
		 */
        function writeLanguageFile() {
			
			$filePath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/lang/language.inc.php';
			
			if (!$file = fopen($filePath, 'w+')) {
				return false;
			}
			
			$buffer = "<?php".PHP_EOL;
			if ($this->hasDefaultLang()) {
				
				$langs = $this->getAll();
				$ids      = array();
				$names    = array();
				foreach ($langs as $row) {
					if ($row['lang_enabled'] == 'y') {
						$ids[]    = $row['id'];
						$names[]  = $row['name'];
						$number[] = $row['id_number'];
					}
				}
				
				$lang_default = $this->getDefault();
				$lang_default_number = $this->getDefaultId();
				
				$buffer .= "\$edir_default_language = \"".$lang_default."\";".PHP_EOL.PHP_EOL;
				$buffer .= "\$edir_default_languagenumber = \"".$lang_default_number."\";".PHP_EOL.PHP_EOL;

				$buffer .= "\$edir_languages = \"".implode(',', $ids)."\";".PHP_EOL;
				$buffer .= "\$edir_languagenames = \"".implode(',', $names)."\";".PHP_EOL;
				$buffer .= "\$edir_languagenumbers = \"".implode(',', $number)."\";".PHP_EOL;
				
			}
			
			$return_flag = fwrite($file, $buffer, string_strlen(utf8_encode($buffer)));
			fclose($file);
			
			return $return_flag;
			
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->getAll();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->getAll();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getAll
		 * @access Public
		 * @return array $rows
		 */
        function getAll($get_enabled=false) {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
            
            if($get_enabled){
                $where = " where lang_enabled = 'y' ";
            }else{
                $where = "";
            }
			
			$sql    = "SELECT * FROM Lang ".$where." ORDER BY lang_default DESC, lang_order";
			$result = $dbObj->query($sql);
			
			$rows = array();
			while ($row = mysql_fetch_array($result)) {
				$rows[] = $row;
			}
			
			return $rows;
			
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->getDefault();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->getDefault();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getDefault
		 * @access Public
		 * @return integer $row["id"]
		 */
        function getDefault() {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			
			$sql    = "SELECT `id` FROM Lang WHERE lang_default='y' LIMIT 1";
			$result = $dbObj->query($sql);
			
			if (!$row = mysql_fetch_array($result)) {
				return false;
			}
			
			return $row['id'];
			
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->getDefaultName();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->getDefaultName();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getDefaultName
		 * @access Public
		 * @return varchar $row["name"]
		 */
        function getDefaultName() {
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
            
            $sql    = "SELECT `name` FROM Lang WHERE lang_default='y' LIMIT 1";
            $result = $dbObj->query($sql);
            
            if (!$row = mysql_fetch_array($result)) {
                return false;
            }
            
            return $row['name'];
            
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->getDefaultName();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->getDefaultName();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getDefaultName
		 * @access Public
		 * @return varchar $row["name"]
		 */
        function getDefaultId() {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

            $sql    = "SELECT `id_number` FROM Lang WHERE lang_default='y' LIMIT 1";
            $result = $dbObj->query($sql);

            if (!$row = mysql_fetch_array($result)) {
                return false;
            }

            return $row['id_number'];

        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->getCountEnabledLang();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->getCountEnabledLang();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getCountEnabledLang
		 * @access Public
		 * @return integer $result
		 */
        function getCountEnabledLang() {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			
			$sql    = "SELECT * FROM Lang WHERE lang_enabled = 'y'";
			$result = $dbObj->query($sql);
			
			return intval(mysql_num_rows($result));
			
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->hasDefaultLang();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->hasDefaultLang();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name hasDefaultLang
		 * @access Public
		 * @return boolean
		 */
        function hasDefaultLang() {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			
			$sql    = "SELECT * FROM Lang WHERE lang_default = 'y'";
			$result = $dbObj->query($sql);
			
			return (mysql_num_rows($result) ? true : false);
			
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->hasDuplicatedOrder();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->hasDuplicatedOrder();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name hasDuplicatedOrder
		 * @access Public
		 * @return boolean
		 */
        function hasDuplicatedOrder() {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			
			$sql    = "SELECT COUNT(*) AS qtde FROM Lang GROUP BY lang_order HAVING qtde > 1;";
			$result = $dbObj->query($sql);
			
			return (mysql_num_rows($result) ? true : false);
			
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->Delete();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Delete
		 * @access Public
		 */
        function Delete() {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

            ### LANG
            $sql = "DELETE FROM Lang WHERE id_number = '$this->id_number'";
            $dbObj->query($sql);

        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->newOrder();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->newOrder();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name newOrder
		 * @access Public
		 * @param integer $order
		 */
        function newOrder($order) {
        
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

            $sql = "SELECT * FROM Lang WHERE lang_order = '$this->lang_order' AND id <> '$this->id'";
            $result = $dbObj->query($sql);

            if (!$row = mysql_fetch_array($result)) {
                return false;
            } else {
                unset($sql);
                $sql = "UPDATE Lang SET lang_order='$order' WHERE id='".$row['id']."'";
                $dbObj->query($sql);
            }
            
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->defineDefault();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->defineDefault();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name defineDefault
		 * @access Public
		 */
        function defineDefault() {
        
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
            
            $sql = "SELECT * FROM Lang WHERE lang_default ='y'";
            $result = $dbObj->query($sql);
            
            if (!$row = mysql_fetch_array($result)) {
                return false;
            } else {
                unset($sql);
                $sql = "UPDATE Lang SET lang_default='y' WHERE lang_order='0'";
                $dbObj->query($sql);   
            }  
            
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->setDefault();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->setDefault();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setDefault
		 * @access Public
		 */
        function setDefault() {
        
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
            $sql = "SELECT id FROM Lang WHERE lang_default='y'";
            $result = $dbObj->query($sql);
            ($row = mysql_fetch_array($result)) ? $last_default = $row['id'] : '';

            $sql = "UPDATE Lang SET lang_default='n' WHERE 1";
            $dbObj->query($sql);
            $sql = "UPDATE Lang SET lang_default='y' WHERE id='$this->id'";
            $dbObj->query($sql);
            $sql = "UPDATE Lang SET lang_order='$this->lang_order' WHERE id='$last_default'";
            $dbObj->query($sql);
            $sql = "UPDATE Lang SET lang_order='0' WHERE id='$this->id'";
            $dbObj->query($sql);
            
        }
        
        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->changeDefaultLang();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->changeDefaultLang();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name changeDefaultLang
		 * @access Public
		 */
        function changeDefaultLang() {
        
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

            $sql = "UPDATE Lang SET lang_default = 'n'";
            $dbObj->query($sql);
            $sql = "UPDATE Lang SET lang_enabled = 'n'";
            $dbObj->query($sql);
            
            $sql = "UPDATE Lang SET lang_default = 'y' WHERE id = '$this->id'";
            $dbObj->query($sql);
            $sql = "UPDATE Lang SET lang_enabled = 'y' WHERE id = '$this->id'";
            $dbObj->query($sql);

        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->changeStatus();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->changeStatus();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name changeStatus
		 * @access Public
		 */
        function changeStatus() {
        
            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
            $sql = "SELECT * FROM Lang WHERE id='$this->id' AND lang_default='n'";
            $result = $dbObj->query($sql);
            ($row = mysql_fetch_array($result)) ? $enabled = $row['lang_enabled'] : '';
            $current_order = $row['lang_order'] + 1;

            $sql = "SELECT COUNT(*) FROM Lang WHERE lang_enabled = 'y'";
            $result = $dbObj->query($sql);
            if ( $result ) $enabled_langs = mysql_fetch_array($result);
            $enabled_langs = intval($enabled_langs[0]);
            if ($enabled == 'y') {
                $sql = "UPDATE Lang SET lang_enabled='n' WHERE id='$this->id'";
            } elseif ( $enabled_langs < MAX_ENABLED_LANGUAGES ) {
                $sql = "UPDATE Lang SET lang_enabled='y' WHERE id='$this->id'";
            } else return true;
            $dbObj->query($sql);    
            
        }

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$langObj->changeOrder();
		 * <br /><br />
		 *		//Using this in Lang() class.
		 *		$this->changeOrder();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name changeOrder
		 * @access Public
		 * @param varchar $order
		 */
        function changeOrder($order) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

            $sql = "SELECT * FROM Lang WHERE id ='$this->id'";
            $result = $dbObj->query($sql);
            $row = mysql_fetch_array($result);
            $current_order = $row['lang_order'];

            if ($order == 'up') {
                $change = $row['lang_order'] - 1;
            } else if ($order == 'down') {
                $change = $row['lang_order'] + 1;
            }

            if ( $change > 0 && $change < count($this->getAll()) ) {

                $sql2 = "SELECT * FROM Lang WHERE lang_order = '$change' AND id <> '$this->id'";
                $result2 = $dbObj->query($sql2);

                $sql = "UPDATE Lang SET lang_order='$change' WHERE id='$this->id'";
                $dbObj->query($sql);
                if ($row = mysql_fetch_array($result2)) {
                    $sql = "UPDATE Lang SET lang_order='$current_order' WHERE id='".$row['id']."'";
                    $dbObj->query($sql);
                }

            }
            
        }

		function returnLangId($strlang){
			unset($array_languages);
			$array_languages = language_getLanguageInformation($strlang);
			return $array_languages["id_number"];
		}

		function convertTableToArray(){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

            $sql    = "SELECT * FROM Lang";
            $result = $dbObj->query($sql);
			if(mysql_num_rows($result)){
				unset($array_lang);
				$array_lang = array();
				while($row = mysql_fetch_assoc($result)){
					$array_lang[$row["id"]]["id"]			= $row["id"];
					$array_lang[$row["id"]]["id_number"]	= $row["id_number"];
					$array_lang[$row["id"]]["name"]			= $row["name"];
					$array_lang[$row["id"]]["lang_enabled"] = $row["lang_enabled"];
					$array_lang[$row["id"]]["lang_default"] = $row["lang_default"];
					$array_lang[$row["id"]]["lang_order"]	= $row["lang_order"];
				}
				return $array_lang;
			}else{
				return false;
			}

		}
    }