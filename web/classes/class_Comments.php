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
	# * FILE: /classes/class_Comments.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$commentObj = new Comments($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 9.5.00
	 * @package Classes
	 * @name Comments
	 * @access Public
	 */
	class Comments extends Handle {

		/**
		 * @var integer
		 * @access Private
		 */
		var $id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $post_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $reply_id;
		/**
		 * @var integer
		 * @access Private
		 */
		var $member_id;
		/**
		 * @var string
		 * @access Private
		 */
		var $member_name;
		/**
		 * @var date
		 * @access Private
		 */
		var $added;
		/**
		 * @var varchar
		 * @access Private
		 */
		var $description;
		/**
		 * @var integer
		 * @access Private
		 */
		var $approved;

		/**
		 * <code>
		 *		$commentsObj = new Comments($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.5.00
		 * @name Comments
		 * @access Public
		 * @param mixed $var
		 */
		function Comments($var="") {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
				$sql = "SELECT * FROM Comments WHERE id = $var";
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
		 * @version 9.5.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
		function makeFromRow($row="") {

			$this->id                    = ($row["id"])                     ? $row["id"]                    : ($this->id                    ? $this->id                     : 0);
			$this->post_id               = ($row["post_id"])                ? $row["post_id"]               : ($this->post_id               ? $this->post_id                : 0);
			$this->reply_id			     = ($row["reply_id"])               ? $row["reply_id"]              : ($this->reply_id              ? $this->reply_id               : 0);
			$this->member_id			 = ($row["member_id"])              ? $row["member_id"]             : ($this->member_id             ? $this->member_id              : 0);
			$this->member_name			 = ($row["member_name"])            ? $row["member_name"]           : ($this->member_name           ? $this->member_name            : "");
			$this->added                 = ($row["added"])                  ? $row["added"]                 : ($this->added                 ? $this->added                  : "");
			$this->description           = ($row["description"])            ? $row["description"]           : "";
			$this->approved              = ($row["approved"])               ? $row["approved"]              : 0;

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$commentsObj->Save();
		 * <br /><br />
		 *		//Using this in Comments() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.5.00
		 * @name Save
		 * @access Public
		 */
		function Save() {

			$this->prepareToSave();

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);

			if ($this->id) {

				$sql = "SELECT approved FROM Comments WHERE id = $this->id";
				$result = $dbObj->query($sql);
				if ($row = mysql_fetch_assoc($result)) $last_status = $row["approved"];
				$this_status = $this->approved;

				$sql = "UPDATE Comments SET"
					. " post_id     = $this->post_id,"
					. " reply_id    = $this->reply_id,"
					. " member_id   = $this->member_id,"
					. " member_name = $this->member_name,"
					. " added       = $this->added,"
					. " description = $this->description,"
					. " approved	= $this->approved"
					. " WHERE id    = $this->id";

					$dbObj->query($sql);

					$post = new Post(str_replace("'","",$this->post_id));
					$item_title = $post->getString("title");

			} else {

				$sql = "INSERT INTO Comments"
					. " (post_id,"
					. " reply_id,"
					. " member_id,"
					. " member_name,"
					. " added,"
					. " description,"
					. " approved)"
					. " VALUES"
					. " ("
					. " $this->post_id,"
					. " $this->reply_id,"
					. " $this->member_id,"
					. " $this->member_name,"
					. " NOW(),"
					. " $this->description,"
					. " $this->approved"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

                $rowTimeline = array();
                $rowTimeline["item_type"] = ($this->reply_id ? "reply" : "comment");
                $rowTimeline["action"] = "new";
                $rowTimeline["item_id"] = $this->id;
                $timelineObj = new Timeline($rowTimeline);
                $timelineObj->save();

				$post = new Post(str_replace("'","",$this->post_id));
				$item_title = $post->getString("title");

			}
			$this->prepareToUse();
		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$commentsObj->Delete($domain_id);
		 * <br /><br />
		 *		//Using this in Comments() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.5.00
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

			$sql = "DELETE FROM Comments WHERE reply_id = $this->id";
			$dbObj->query($sql);

			$sql = "DELETE FROM Comments WHERE id = $this->id";
			$dbObj->query($sql);

            ### Timeline
            if ($this->reply_id) {
                $sql = "DELETE FROM Timeline WHERE item_type = 'reply' AND item_id = $this->id";
            } else {
                $sql = "DELETE FROM Timeline WHERE item_type = 'comment' AND item_id = $this->id";
            }
            $dbObj->query($sql);

		}

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$commentsObj->deletePerAccount($account_id, $domain_id);
		 * <br /><br />
		 *		//Using this in Comments() class.
		 *		$this->deletePerAccount($account_id);
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 9.5.00
		 * @name deletePerAccount
		 * @access Public
		 * @param integer $account_id
		 * @param integer $domain_id
		 */
		function deletePerAccount($account_id = 0, $domain_id = false) {
			if (is_numeric($account_id) && $account_id > 0) {
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
				$sql = "SELECT * FROM Comments WHERE member_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete($domain_id);
				}
			}
		}

        /**
         * Function to get all comments from an item
         * @return array
         */
        function getCommentsByItemID($post_id = 0) {

            $db = db_getDBObject();
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $sql = "SELECT * FROM Comments WHERE post_id = ".db_formatNumber($this->item_id)." AND description IS NOT NULL AND approved = 1 AND reply_id = ".db_formatNumber($post_id)." ORDER BY added DESC";
            $result = $db->query($sql);

            if (mysql_num_rows($result)) {

                unset($aux_array_comments);
                $aux_array_comments = array();
                while ($row = mysql_fetch_assoc($result)) {
                    unset($aux_fields);
                    foreach ($row as $key => $value) {
                        if ($key != "approved" && $key != "member_name" && $key != "reply_id" && $key != "member_img") {
                            if ($key == "member_id") {
                                $auxContact = new Contact($value);
                                $auxMember = array();
                                $auxMember["id"] = (int)$value;
                                $auxMember["first_name"] = $auxContact->getString("first_name");
                                $auxMember["last_name"] = $auxContact->getString("last_name");
                                $auxMember["email"] = $auxContact->getString("email");
                                $auxMember["member_img"] = system_getUserImage($value);
                                $aux_fields["account"] = $auxMember;
                            } else {
                                $aux_fields[$key] = (is_numeric($value) ? (float)$value : $value);
                            }
                        }
                    }
                    //Get user image
                    if (SOCIALNETWORK_FEATURE == "on") {

                        if ($row["member_id"] > 0) {

                            $sql = "SELECT image_id, facebook_image, A.has_profile
                                    FROM Profile
                                    LEFT JOIN Account A ON (A.id = account_id)
                                    WHERE account_id = ".db_formatNumber($row["member_id"])."";
                            $resultImage = $dbMain->query($sql);
                            $rowImage = mysql_fetch_assoc($resultImage);

                            if ($rowImage["has_profile"] == "y") {
                                $imgObj = new Image($rowImage["image_id"], true);
                                if ($imgObj->imageExists()) {
                                    $aux_fields["member_img"] = $imgObj->getPath();
                                //No image
                                } else {
                                    if ($rowImage["facebook_image"]) {
                                        $aux_fields["member_img"] = $rowImage["facebook_image"];
                                    } else {
                                        $aux_fields["member_img"] = DEFAULT_URL."/assets/images/structure/icon-user-thumb.gif";
                                    }
                                }
                            //No image
                            } else {
                                $aux_fields["member_img"] = DEFAULT_URL."/assets/images/structure/icon-user-thumb.gif";
                            }

                        //No image
                        } else {
                            $aux_fields["member_img"] = DEFAULT_URL."/assets/images/structure/icon-user-thumb.gif";
                        }
                    } else {
                        $aux_fields["member_img"] = "";
                    }

                    $replies = $this->getCommentsByItemID($aux_fields["id"]);
                    if (is_array($replies)) {
                        $aux_fields["replies"] = $replies;
                    } else {
                        $aux_fields["replies"] = NULL;
                    }

                    $aux_array_comments[] = $aux_fields;
                }

                if (is_array($aux_array_comments)) {
                    return $aux_array_comments;
                } else {
                    return false;
                }

            } else {
                return false;
            }
        }

        function GetTotalCommentsByItemID() {
            $db = db_getDBObject();
            $sql = "SELECT post_id FROM Comments WHERE post_id = ".db_formatNumber($this->post_id)." AND approved = 1";

            $result = $db->query($sql);
            $total_result = mysql_num_rows($result);
            if ($total_result) {
                return $total_result;
            } else {
                return NULL;
            }
        }
	}
