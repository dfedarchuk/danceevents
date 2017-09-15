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
	# * FILE: /classes/class_ConnectuinPool.php
	# ----------------------------------------------------------------------------------------------------

	/*	
	http://coolpenguin.net/persistclass 
	for updates, documentation, tutorials
	*/


	class ConnectionPool {
	
		private static $instance = null;
		private $pool;
	
		private function __construct() {
			$this->pool = array();	
		}
		
		public static function instance() {
			if(is_null(self::$instance)){
				self::$instance = new ConnectionPool();
			}	
			return self::$instance;
		}
		
		public function registerConnection($dbConnection, $name = null) {
			$this->pool[$name] = $dbConnection;	
		}
		
		public function getConnection($name = null) {
			if(!array_key_exists($name, $this->pool)){
				return false;
			}else{
				/*
				 * Check if connection is expired
				 */
				$expired = $this->pool[$name]->expire_connection - mktime (date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
				if($expired > 0){
					return $this->pool[$name]->link_id;
				}
			}	
		}
		
		public function unsetConnection($name) {
			unset($auxPool);

			foreach ($this->pool as $key => $value) {
				if ($key != $name) {
					$auxPool[$key] = $value;
				}
			}

			$this->pool = $auxPool;
		}
	}



?>
