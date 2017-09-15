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
	# * FILE: /classes/class_importLog.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$importLogObj = new ImportLog($var);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name ImportLog
	 * @access Public
	 */
	class ImportLog extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $domain_id;
		/**
		 * @var Date
		 * @access Private
		 */
		var $date;
		/**
		 * @var time
		 * @access Private
		 */
		var $time;
		/**
		 * @var string
		 * @access Private
		 */
		var $filename;
		/**
		 * @var string
		 * @access Private
		 */
		var $linesadded;
		/**
		 * @var string
		 * @access Private
		 */
		var $totallines;
        /**
		 * @var string
		 * @access Private
		 */
		var $errorlines;
		/**
		 * @var integer
		 * @access Private
		 */
		var $itens_added;
		/**
		 * @var integer
		 * @access Private
		 */
		var $accounts_added;
		/**
		 * @var string
		 * @access Private
		 */
		var $phisicalname;
		/**
		 * @var string
		 * @access Private
		 */
		var $status;
		/**
		 * @var string
		 * @access Private
		 */
		var $action;
		/**
		 * @var string
		 * @access Private
		 */
		var $progress;
		/**
		 * @var string
		 * @access Private
		 */
		var $history;
		/**
		 * @var string
		 * @access Private
		 */
		var $update_itens;
        /**
		 * @var string
		 * @access Private
		 */
		var $from_export;
        /**
		 * @var string
		 * @access Private
		 */
		var $active_item;
        /**
		 * @var string
		 * @access Private
		 */
		var $update_friendlyurl;
        /**
		 * @var string
		 * @access Private
		 */
		var $featured_categs;
        /**
		 * @var string
		 * @access Private
		 */
		var $default_level;
        /**
		 * @var string
		 * @access Private
		 */
		var $same_account;
        /**
		 * @var string
		 * @access Private
		 */
		var $account_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $delimiter;
		/**
		 * @var string
		 * @access Private
		 */
		var $mysqlerror;
		/**
		 * @var string
		 * @access Private
		 */
		var $type;

        /**
         * <code>
         *        $importLogObj = new ImportLog($var);
         * <code>
         * @copyright Copyright 2005 Arca Solutions, Inc.
         * @author Arca Solutions, Inc.
         * @version 8.0.00
         * @param array|string $var
         * @param bool $domain_id
         * @return ImportLog
         * @internal param $ImportLog
         * @access Public
         */
		function ImportLog($var='', $domain_id = false) {
			$this->domain_id = $domain_id;
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$db = db_getDBObjectByDomainID($this->domain_id, $dbMain);
				}else if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM ImportLog WHERE status<>'D' AND id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
			else {
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

			if ($row['id']) $this->id = $row['id'];
			else if (!$this->id) $this->id = 0;

			if ($row['date']) $this->date = $row['date'];
			else if (!$this->date) $this->date = 0;

			if ($row['time']) $this->time = $row['time'];
			else if (!$this->time) $this->time = "";

			if ($row['filename']) $this->filename = $row['filename'];
			else if (!$this->filename) $this->filename = "";

			if ($row['phisicalname']) $this->phisicalname = $row['phisicalname'];
			else if (!$this->phisicalname) $this->phisicalname = "";

			if ($row['linesadded']) $this->linesadded = $row['linesadded'];
			else if (!$this->linesadded) $this->linesadded = "0";

			if ($row['totallines']) $this->totallines = $row['totallines'];
			else if (!$this->totallines) $this->totallines = "0";

            if ($row['errorlines']) $this->errorlines = $row['errorlines'];
			else if (!$this->errorlines) $this->errorlines = "0";

			if ($row['itens_added']) $this->itens_added = $row['itens_added'];
			else if (!$this->itens_added) $this->itens_added = "0";

			if ($row['accounts_added']) $this->accounts_added = $row['accounts_added'];
			else if (!$this->accounts_added) $this->accounts_added = "0";

			if ($row['status']) $this->status = $row['status'];
			else if (!$this->status) $this->status = "P";

			if ($row['action']) $this->action = $row['action'];
			else if (!$this->action) $this->action = "RI";

			if ($row['progress']) $this->progress = $row['progress'];
			else if (!$this->progress) $this->progress = "0%";

			if ($row['history']) $this->history = $row['history'];
			else if (!$this->history) $this->history = "";

			if ($row['update_itens']) $this->update_itens = $row['update_itens'];
			else if (!$this->update_itens) $this->update_itens = "";

            if ($row['from_export']) $this->from_export = $row['from_export'];
			else if (!$this->from_export) $this->from_export = "";

            if ($row['active_item']) $this->active_item = $row['active_item'];
			else if (!$this->active_item) $this->active_item = "";

            if ($row['update_friendlyurl']) $this->update_friendlyurl = $row['update_friendlyurl'];
			else if (!$this->update_friendlyurl) $this->update_friendlyurl = "";

            if ($row['featured_categs']) $this->featured_categs = $row['featured_categs'];
			else if (!$this->featured_categs) $this->featured_categs = "";

            if ($row['default_level']) $this->default_level = $row['default_level'];
			else if (!$this->default_level) $this->default_level = "";

            if ($row['same_account']) $this->same_account = $row['same_account'];
			else if (!$this->same_account) $this->same_account = "";

            if ($row['account_id']) $this->account_id = $row['account_id'];
			else if (!$this->account_id) $this->account_id = "NULL";

			$row["delimiter"] ?	$this->delimiter = $row["delimiter"] : $this->delimiter ? $this->delimiter = $this->delimiter : $this->delimiter = "";

			if ($row['mysqlerror']) $this->mysqlerror = $row['mysqlerror'];
			else if (!$this->mysqlerror) $this->mysqlerror = "";

			if ($row['type']) $this->type = $row['type'];
			else if (!$this->type) $this->type = "listing";

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->Save();
		 * <br /><br />
		 *		//Using this in ImportLog() class.
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
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$this->prepareToSave();
			if ($this->id) {
				$sql  = "UPDATE ImportLog SET"
					. " date                = $this->date,"
					. " time                = $this->time,"
					. " filename            = $this->filename,"
					. " linesadded          = $this->linesadded,"
					. " totallines          = $this->totallines,"
					. " errorlines          = $this->errorlines,"
					. " itens_added         = $this->itens_added,"
					. " accounts_added      = $this->accounts_added,"
					. " phisicalname        = $this->phisicalname,"
					. " status              = $this->status,"
					. " action              = $this->action,"
					. " progress            = $this->progress,"
					. " update_itens        = $this->update_itens,"
					. " from_export         = $this->from_export,"
					. " active_item         = $this->active_item,"
					. " update_friendlyurl	= $this->update_friendlyurl,"
					. " featured_categs     = $this->featured_categs,"
					. " default_level       = $this->default_level,"
					. " same_account        = $this->same_account,"
					. " account_id          = $this->account_id,"
					. " delimiter           = $this->delimiter,"
					. " mysqlerror          = $this->mysqlerror,"
					. " type                = $this->type"
					. " WHERE id            = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO ImportLog"
					. " (date, 
                        time, 
                        filename, 
                        linesadded,
                        totallines, 
                        errorlines, 
                        itens_added, 
                        accounts_added, 
                        phisicalname, 
                        status, 
                        action, 
                        progress, 
                        history, 
                        update_itens, 
                        from_export, 
                        active_item, 
                        update_friendlyurl, 
                        featured_categs, 
                        default_level, 
                        same_account, 
                        account_id, 
                        delimiter, 
                        mysqlerror, 
                        type)"
					. " VALUES"
					. " ($this->date, 
                        $this->time, 
                        $this->filename, 
                        $this->linesadded, 
                        $this->totallines, 
                        $this->errorlines, 
                        $this->itens_added, 
                        $this->accounts_added, 
                        $this->phisicalname, 
                        $this->status, 
                        $this->action, 
                        $this->progress, 
                        '', 
                        $this->update_itens, 
                        $this->from_export, 
                        $this->active_item, 
                        $this->update_friendlyurl, 
                        $this->featured_categs, 
                        $this->default_level, 
                        $this->same_account, 
                        $this->account_id, 
                        $this->delimiter, 
                        '', 
                        $this->type)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->Delete();
		 * <br /><br />
		 *		//Using this in ImportLog() class.
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
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "UPDATE ImportLog SET status = 'D' WHERE id = $this->id";
			$dbObj->query($sql);
			@unlink(IMPORT_FOLDER."/".$this->phisicalname);
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->getImports();
		 * <br /><br />
		 *		//Using this in ImportLog() class.
		 *		$this->getImports();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name getImports
		 * @access Public
		 * @return array $logarray
		 */
		function getImports($type = "listing") {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT id FROM ImportLog WHERE status <> 'D' AND type = '$type' ORDER BY id DESC";
			$result = $dbObj->query($sql);
			if ($result) {
				while ($row = mysql_fetch_assoc($result)) {
					$id = $row['id'];
					$logarray[] = new ImportLog($id);
				}
				return $logarray;
			} else return NULL;
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$importLogObj->setHistory($history);
		 * <br /><br />
		 *		//Using this in ImportLog() class.
		 *		$this->setHistory($history);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name setHistory
		 * @access Public
		 * @param string $history
		 */
		function setHistory($history) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($this->domain_id){
				$dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
			}else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

			$history = $history."||";
			$aux_str = addslashes($history);
			$sql = "UPDATE ImportLog SET history = CONCAT(history, '".$aux_str."') WHERE id = '".$this->id."'";
			$dbObj->query($sql);
		}

	}

?>
