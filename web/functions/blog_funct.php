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
	# * FILE: /functions/blog_funct.php
	# ----------------------------------------------------------------------------------------------------

	function blog_getContentbyCharacters($content, $nCharacters, $detail, &$more = false) {

		$total = string_strlen(strip_tags($content));

		if ($total > $nCharacters) {
			$newContent = string_substr(strip_tags($content), 0,$nCharacters)." ...";
			$more = true;
		} else {
			$newContent = strip_tags($content);
		}

		return $newContent;
	}
    
    function blog_getMonth($month) {

		$arrayMonth = explode(",", LANG_DATE_MONTHS);
		return $arrayMonth[$month-1];

	}

	function blog_retrivePostArchiveFeatured() {

		$dbObj = db_getDBObJect();
		$sql = "SELECT YEAR( entered ) AS Blog_Year, MONTH( entered ) AS Blog_Month, COUNT( entered ) AS total";
		$sql .= " FROM Post";
		$sql .= " WHERE status = 'A' AND entered <= NOW()";
		$sql .= " GROUP BY MONTH( entered ), YEAR( entered )";
		$sql .= " ORDER BY Blog_Year ".(THEME_BLOGARCHIVE_ACCORDION ? "DESC" : "ASC").", Blog_Month";
		$result = $dbObj->query($sql);
		unset($info);
        
		while ($row = mysql_fetch_assoc($result)) {
			$info[] = $row;
		}
		
        if (count($info) > 0) {

			$arrayYears = array();
			$arrayMonths = array();

			for ($i = 0; $i < count($info); $i++) {
				if (!in_array($info[$i]["Blog_Year"], $arrayYears)) {
					$arrayYears[] = (int)$info[$i]["Blog_Year"];
				}
				$arrayMonths[$info[$i]["Blog_Year"]][$info[$i]["Blog_Month"]] = (int)$info[$i]["total"];
			}

			$arrayReturn = array();
			$arrayReturn["years"] = $arrayYears;
			$arrayReturn["months"] = $arrayMonths;
			return $arrayReturn;

        }
		
	}

	function blog_getReply($id) {

		$dbObjMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);
		$sql = "SELECT * FROM Comments WHERE reply_id = $id";

		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$info[] = $row;
		}

		if (count($info)>0){
			return 1;
        } else {
			return 0;
        }
	}

	function blog_retrieveIdRelatedPosts($array, $post_id) {

		if ($array) {
			$strIN = "";
			for ($i = 0; $i < count($array); $i++) {
				$strIN .= $array[$i].",";
			}
			$strIN = string_substr($strIN, 0, -1);

			$db = db_getDBObject();

			$sql = "SELECT post_id, COUNT( Blog_Category.category_id ) AS total"
				  ." FROM  Blog_Category, Post"
				  ." WHERE Blog_Category.post_id = Post.id AND Post.status = 'A' AND category_id IN ( $strIN ) AND post_id <> $post_id"
				  ." GROUP BY post_id"
				  ." ORDER BY total DESC"
				  ." LIMIT 5";

			$result = $db->query($sql);

			while ($row = mysql_fetch_array($result)) {
				$ids[] = $row["post_id"];
			}

			return $ids;
		}
	}

	function blog_retrieveInfoRelatedPost($ids) {

		if ($ids) {
			$strIN = "";
			for ($i = 0; $i < count($ids); $i++) {
				$strIN .= $ids[$i].",";
			}
			$strIN = string_substr($strIN, 0, -1);

			$db = db_getDBObject();

			$sql = "SELECT id, title, entered, friendly_url, thumb_id"
				 ." FROM Post"
				 ." WHERE id IN ( $strIN )";

			$result = $db->query($sql);

			while ($row = mysql_fetch_assoc($result)) {
				$info[] = $row;

			}

			return $info;
		}
	}

	function blog_retrieveNewMembers() {

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$sql = "SELECT Contact.account_id, Profile.image_id, Contact.first_name, Contact.last_name, Profile.friendly_url, Account.entered"
			  ." FROM  Contact, Profile, Account"
			  ." WHERE Profile.account_id = Contact.account_id AND Profile.account_id = Account.id AND Account.has_profile = 'y'"
			  ." ORDER BY Contact.entered DESC "
			  ." LIMIT 5";

		$result = $dbObj->query($sql);
		while ($row = mysql_fetch_array($result)) {
			$newMembers["account_id"][] = $row["account_id"];
			$newMembers["image_id"][] = $row["image_id"];
			$newMembers["first_name"][] = $row["first_name"];
			$newMembers["last_name"][] = $row["last_name"];
			$newMembers["friendly_url"][] = $row["friendly_url"];
			$newMembers["entered"][] = $row["entered"];
		}
		return $newMembers;

	}
?>