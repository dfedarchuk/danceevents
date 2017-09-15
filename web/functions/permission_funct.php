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
	# * FILE: /functions/permission_funct.php
	# ----------------------------------------------------------------------------------------------------

	function permission_hasSMPerm() {
		if ($_SESSION[SESS_SM_ID]) {
			if (SITEMGR_PERMISSION_SECTION > 0) {
				$hasperm = false;
				for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
					unset($folders);
					$folders = permission_getSMPermFolders($i);
					if ($folders) {
						foreach ($folders as $folder) {
							if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/".$folder."/") !== false) {
								$sess_sm_perm = decbin($_SESSION[SESS_SM_PERM]);
								while(string_strlen($sess_sm_perm) < SITEMGR_PERMISSION_SECTION) {
									$sess_sm_perm = "0".$sess_sm_perm;
								}
								$id = permission_getSMPermID($i);
								$id = decbin($id);
								while(string_strlen($id) < SITEMGR_PERMISSION_SECTION) {
									$id = "0".$id;
								}
								if (($sess_sm_perm & $id) == $id) {
									$hasperm = true;
								}
							}
						}
					}
				}
				if (!$hasperm) {
					header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
					exit;
				}
			}
		}
	}

	function permission_hasSMPermSection($sectionid = false) {
		if ($sectionid) {
			if ($_SESSION[SESS_SM_ID]) {
				if (SITEMGR_PERMISSION_SECTION > 0) {
					for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
						$sess_sm_perm = decbin($_SESSION[SESS_SM_PERM]);
						while(string_strlen($sess_sm_perm) < SITEMGR_PERMISSION_SECTION) {
							$sess_sm_perm = "0".$sess_sm_perm;
						}
						$sectionid = decbin($sectionid);
						while(string_strlen($sectionid) < SITEMGR_PERMISSION_SECTION) {
							$sectionid = "0".$sectionid;
						}
						if (($sess_sm_perm & $sectionid) == $sectionid) {
							return true;
						}
					}
				}
			} else {
				return true;
			}
		}
		return false;
	}

	function permission_getSMPermID($i) {
		$permission = constant("SITEMGR_PERMISSION_".$i);
		$permission = explode(",", $permission);
		return $permission[0];
	}

	function permission_getSMPermLabel($i) {
		$permission = constant("SITEMGR_PERMISSION_".$i);
		$permission = explode(",", $permission);
		return $permission[1];
	}
        
	function permission_getSMPermFolders($i) {
		$permission = constant("SITEMGR_PERMISSION_".$i);
		$permission = explode(",", $permission);
		for ($i = 3; $i < count($permission); $i++) {
			$folders[] = $permission[$i];
		}
		return $folders;
	}

	function permission_getSMTable($account_permission, $myAdminAccount) {

		$return = "";
		$acc_id = ($_GET["id"] ? $_GET["id"] : $_POST["id"]);
		
		if (SITEMGR_PERMISSION_SECTION > 0) {

			if ($account_permission) {
				if (!is_array($account_permission)) {
					unset($accountpermission);
					$accountpermission = decbin($account_permission);
					unset($account_permission);
					while(string_strlen($accountpermission) < SITEMGR_PERMISSION_SECTION) {
						$accountpermission = "0".$accountpermission;
					}
					for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
						if ($accountpermission[SITEMGR_PERMISSION_SECTION-$i-1]) {
							$account_permission[] = permission_getSMPermID($i);
						}
					}
				}
			}
			
			if (!$myAdminAccount && !sess_getSMIdFromSession()) {

				$returnjsselect = "";
				$returnjsunselect = "";

                $return .= "\t\t<p><a href=\"javascript:void(0);\" onclick=\"selectAll();\">".system_showText(LANG_SITEMGR_LABEL_SELECTALL)."</a> / <a href=\"javascript:void(0);\" onclick=\"unselectAll();\">".system_showText(LANG_SITEMGR_LABEL_UNSELECTALL)."</a></p>\n";

                for ($i = 0; $i < SITEMGR_PERMISSION_SECTION; $i++) {
                    $return .= "\t\t<div class=\"col-sm-4\"><div class=\"checkbox-inline\">\n";
                        $return .= "\t\t\t<label><input type=\"checkbox\" name=\"permission[]\" value=\"".permission_getSMPermID($i)."\" id=\"permission".permission_getSMPermID($i)."\" class=\"inputCheck\" ";
                        $returnjsselect .= "\t\tdocument.getElementById(\"permission".permission_getSMPermID($i)."\").checked = true;\n";
                        $returnjsunselect .= "\t\tdocument.getElementById(\"permission".permission_getSMPermID($i)."\").checked = false;\n";
                        if ($account_permission) {
                            if (is_array($account_permission)) {
                                if (in_array(permission_getSMPermID($i), $account_permission)) {
                                    $return .= "checked ";
                                }
                            }
                        }
                        $return .= "/>\n";
                    $return .= "\t\t\t".permission_getSMPermLabel($i)."<p class=\"text-muted small\">"."\n";
                    $return .= "\t\t</div></div>\n";

                }

				$return .= "<script language=\"javascript\" type=\"text/javascript\">\n";
					$return .= "\tfunction selectAll() {\n";
						$return .= $returnjsselect;
					$return .= "\t}\n";
					$return .= "\tfunction unselectAll() {\n";
						$return .= $returnjsunselect;
					$return .= "\t}\n";
				$return .= "</script>\n";

			} else {

				if ($account_permission) {
					if (is_array($account_permission)) {
						for ($i=0; $i<SITEMGR_PERMISSION_SECTION; $i++) {
							if (in_array(permission_getSMPermID($i), $account_permission)) {
								$return .= "<input type=\"hidden\" name=\"permission[]\" value=\"".permission_getSMPermID($i)."\" />\n";
							}
						}
					}
				}

			}

		}

		return $return;

	}

?>
