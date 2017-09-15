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
	# * FILE: /classes/class_importStatus.php
	# ----------------------------------------------------------------------------------------------------

	class ImportStatus {

		##################################################
		# PRIVATE
		##################################################

		var $default;
		var $value;
		var $name;
		var $style;

		function ImportStatus() {
			$this->default = "P";
			$this->value = Array("P", "R", "W", "S", "D", "F", "C", "E", "Q", "Q2", "U", "WR", "PA");
			$this->name = Array(system_showText(LANG_LABEL_PENDING), system_showText(LANG_SITEMGR_IMPORT_RUNNING), system_showText(LANG_SITEMGR_IMPORT_WAIT)."...", system_showText(LANG_SITEMGR_IMPORT_STOPPED), system_showText(LANG_SITEMGR_IMPORT_DELETED), system_showText(LANG_SITEMGR_IMPORT_FINISHED), system_showText(LANG_SITEMGR_IMPORT_CANCELLED), system_showText(LANG_SITEMGR_ERROR), system_showText(LANG_SITEMGR_IMPORT_QUEUE), system_showText(LANG_SITEMGR_IMPORT_QUEUE2), system_showText(LANG_SITEMGR_IMPORT_CONVERTING)."...", system_showText(LANG_SITEMGR_IMPORT_WAITROLLBACK), system_showText(LANG_SITEMGR_PENDING_APPROVAL));
			$this->style = Array("status-pending", "status-running", "status-wait", "status-stopped", "status-deleted", "status-finished", "status-cancelled", "status-error", "status-pending", "status-wait", "status-running", "status-wait", "status-pending");
		}

		function getValues() {
			return $this->value;
		}

		function getNames() {
			return $this->name;
		}

		function getStyles() {
			return $this->style;
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

		function getValueStyle() {
			return $this->union($this->getValues(), $this->getStyles());
		}

		function getDefault() {
			return $this->default;
		}

		function getName($value) {
			$value_name = $this->getValueName();
			return $value_name[$value];
		}

		function getStyle($value) {
			$value_style = $this->getValueStyle();
			return $value_style[$value];
		}

		##################################################
		# PRIVATE
		##################################################

		##################################################
		# PUBLIC
		##################################################

		function getStatus($value) {
			if ($this->getName($value)) return string_ucwords($this->getName($value));
			else return string_ucwords($this->getStatus($this->getDefaultStatus()));
		}

		function getStatusWithStyle($value, $log_id = 0) {
			if ($this->getName($value)) {
				return "<span id=\"label_id".$log_id."\" class=".$this->getStyle($value).">".string_ucwords($this->getName($value))."</span>";
			}
			return string_ucwords($this->getStatusWithStyle($this->getDefaultStatus()));
		}

		function getDefaultStatus() {
			return $this->getDefault();
		}

		function getStatusValues() {
			return $this->getValues();
		}

		function getStatusNames() {
			return $this->getNames();
		}

		##################################################
		# PUBLIC
		##################################################

	}

?>
