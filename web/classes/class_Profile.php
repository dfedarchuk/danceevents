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
	# * FILE: /classes/class_Profile.php
	# ----------------------------------------------------------------------------------------------------

    /**
	 * <code>
	 *		$profileObj = new Profile($id);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @package Classes
	 * @name Profile
	 * @access Public
	 */

	class Profile extends Handle {

        /**
		 * @var integer
		 * @access Private
		 */
		var $account_id;
        /**
		 * @var integer
		 * @access Private
		 */
		var $image_id;
        /**
		 * @var string
		 * @access Private
		 */
		var $facebook_image;
        /**
		 * @var string
		 * @access Private
		 */
		var $nickname;
        /**
		 * @var string
		 * @access Private
		 */
		var $friendly_url;
        /**
		 * @var date
		 * @access Private
		 */
		var $entered;
        /**
		 * @var date
		 * @access Private
		 */
		var $updated;
        /**
		 * @var string
		 * @access Private
		 */
		var $personal_message;
        /**
		 * @var string
		 * @access Private
		 */
		var $facebook_uid;
        /**
		 * @var string
		 * @access Private
		 */
		var $profile_exists;

        /**
		 * <code>
		 *		$profileObj = new Profile($id);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Profile
		 * @access Public
		 * @param integer $var
		 */
		function Profile($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject(DEFAULT_DB,true);
				$sql = "SELECT * FROM Profile WHERE account_id = $var";
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
		function makeFromRow($row='') {
			$row["account_id"]              ?           $this->account_id = $row["account_id"]:									$this->account_id = 0;
			$row["image_id"]                ?           $this->image_id = $row["image_id"]:										$this->image_id = 0;
			$row["facebook_image"]          ?			$this->facebook_image = $row["facebook_image"]:							$this->facebook_image = "";
			$row["nickname"]                ?           $this->nickname = $row["nickname"]:										$this->nickname = "";
			$row["friendly_url"]            ?			$this->friendly_url = $row["friendly_url"]:								$this->friendly_url = "";
			$row["entered"]                 ?           $this->entered = $row["entered"]:										$this->entered = 0;
			$row["updated"]                 ?           $this->updated = $row["updated"]:										$this->updated = 0;
			$row["personal_message"]        ?           $this->personal_message = $row["personal_message"]:						$this->personal_message = "";
			if ($row["facebook_uid"]) $this->facebook_uid = $row["facebook_uid"];
			else if (!$this->facebook_uid) $this->facebook_uid = "";
			$this->profileExists();
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->Save();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->Save();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Save() {
			$exists = $this->profile_exists;

			$this->prepareToSave();
			$dbObj = db_getDBObject(DEFAULT_DB,true);

			if ($exists) {
				$sql  = "UPDATE Profile SET"
					. " image_id = $this->image_id,"
					. " facebook_image = $this->facebook_image,"
					. " nickname = $this->nickname,"
					. " friendly_url = $this->friendly_url,"
					. " updated = NOW(),"
					. " personal_message = $this->personal_message,"
					. " facebook_uid = $this->facebook_uid "
					. " WHERE account_id = $this->account_id";

				$dbObj->query($sql);
			} else {
				$auxAccID = str_replace("'", "", $this->account_id);
				if ($auxAccID > 0) {

                    if ($this->friendly_url == "''") {
                        $this->friendly_url = system_generateFriendlyURL(str_replace("'", "", $this->nickname));
                    }

                    //Check for repeated friendly url
                    $sql = "SELECT account_id FROM Profile WHERE friendly_url = ".db_formatString($this->friendly_url);
                    $result = $dbObj->query($sql);
                    if (mysql_num_rows($result) > 0) {
                        $this->friendly_url = $this->friendly_url.FRIENDLYURL_SEPARATOR.uniqid();
                    }

                    $this->friendly_url = db_formatString($this->friendly_url);

					$sql = "INSERT INTO Profile"
						. " (account_id, image_id, facebook_image, nickname, friendly_url, entered, personal_message, facebook_uid)"
						. " VALUES"
						. " ($this->account_id, $this->image_id, $this->facebook_image, $this->nickname, $this->friendly_url, NOW(), $this->personal_message, $this->facebook_uid)";
					$dbObj->query($sql);

				}
			}


			$this->prepareToUse();
		}

        /**
        * <code>
        *		//Using this in forms or other pages.
        *		$profileObj->profileExists();
        * <br /><br />
        *		//Using this in Profile() class.
        *		$this->profileExists();
        * </code>
        * @copyright Copyright 2005 Arca Solutions, Inc.
        * @author Arca Solutions, Inc.
        * @version 8.0.00
        * @name Save
        * @access Public
        */
		function profileExists() {
			if ($this->account_id > 0) $this->profile_exists = true;
			else $this->profile_exists = false;
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->findUid();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->findUid();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function findUid($uid=false){
			if (!$uid) return false;
			$dbObj = db_getDBObject(DEFAULT_DB,true);
			$sql="SELECT * FROM Profile WHERE facebook_uid = '".addslashes($uid)."'";

			$dbObj->query($sql);
			$result = $dbObj->Query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row["account_id"]){
				$this->makeFromRow($row);
				return true;
			} else {
                return false;
            }

		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->Delete();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->Delete();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function Delete() {
			$dbObj = db_getDBObject(DEFAULT_DB,true);

            ### IMAGE
			if ($this->image_id) {
				$image = new Image($this->image_id, true);
				if ($image) $image->Delete();
            }

			$sql = "DELETE FROM Profile WHERE account_id = $this->account_id";
			$dbObj->query($sql);
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->fUrl_Exists();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->fUrl_Exists();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function fUrl_Exists($fUrl) {
			if ($fUrl) {
				$dbObj = db_getDBObject(DEFAULT_DB,true);
				$sql = " SELECT account_id FROM Profile WHERE friendly_url = '".$fUrl."'";
				$result = $dbObj->query($sql);
				if (mysql_num_rows($result) > 0) {
					$row = mysql_fetch_assoc($result);
					if ($row["account_id"] == sess_getAccountIdFromSession()) {
						return false;
					} else {
						return true;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

        /**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$profileObj->deal_done();
		 * <br /><br />
		 *		//Using this in Profile() class.
		 *		$this->deal_done();
		 * </code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 8.0.00
		 * @name Save
		 * @access Public
		 */
		function deal_done($dealtype = "twitter", $promotion_id = false, $network_response = false){

			if (!$promotion_id)  return false;

			if($dealtype == "profile"){
				$twittered = 0;
				$facebooked = 0;
			} else if($dealtype == "twitter"){
				$twittered = 1;
				$facebooked = 0;
			} else {
				$twittered = 0;
				$facebooked = 1;
			}

			$dbObj = db_getDBObject(DEFAULT_DB, true);
            $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);

			$sqlRedeem = "SELECT id FROM `Promotion_Redeem` WHERE `account_id` = ".sess_getAccountIdFromSession()." AND `promotion_id` = $promotion_id LIMIT 1";
			$resRedeem = $dbDomain->query($sqlRedeem);

			if (mysql_num_rows($resRedeem) > 0) {
				$rowRedeem = mysql_fetch_assoc($resRedeem);
				$redeem_id = $rowRedeem["id"];

				$arrayUpdate = array();

				if ($dealtype == "twitter") $arrayUpdate[]= "twittered = 1";
				if ($dealtype == "profile") $arrayUpdate[]= "facebooked = 1";

				$sqlSet = implode(",",$arrayUpdate);
				$sqlSet .= ", network_response = CONCAT(network_response, ".db_formatString("[|]".$network_response).")";

				$sql = "UPDATE Promotion_Redeem SET ".$sqlSet." WHERE id = ".$redeem_id;
				$result = $dbDomain->query($sql);
			} else {
				$redeem_code = system_generatePassword();

				$sql = "INSERT INTO Promotion_Redeem ( ";
				$sql .= "account_id, promotion_id, twittered, facebooked, network_response, datetime, redeem_code";
				$sql .= " ) VALUES (";
				$sql .= (int)sess_getAccountIdFromSession().", ";
				$sql .= (int)$promotion_id.", ";
				$sql .= "$twittered, $facebooked, ";
				$sql .= db_formatString($network_response).", ";
				$sql .= "NOW(), ".db_formatString($redeem_code)."";
				$sql .= ")";
				$result = $dbDomain->query($sql);

				$sql = "UPDATE Promotion SET amount = amount - 1 WHERE id = $promotion_id";
				$dbDomain->query($sql);

                //Notification to deal owner
                $promotionObj = new Promotion($promotion_id);
                $contactObj = new Contact($promotionObj->getNumber('account_id'));
                if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_DEAL)) {
                    $subject   = $emailNotificationObj->getString("subject");
                    $body      = $emailNotificationObj->getString("body");
                    $body      = system_replaceEmailVariables($body, $promotionObj->getNumber('id'), 'promotion');
                    $subject   = system_replaceEmailVariables($subject, $promotionObj->getNumber('id'), 'promotion');
                    $body      = html_entity_decode($body);
                    $subject   = html_entity_decode($subject);
                    $error = false;

                    Mailer::mail( $contactObj->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                }

                //Notification to user
                unset($contactObj);
                $contactObj = new Contact(sess_getAccountIdFromSession());
                if ($emailNotificationObj = system_checkEmail(SYSTEM_DEAL_DONE)) {
                    $subject   = $emailNotificationObj->getString("subject");
                    $body      = $emailNotificationObj->getString("body");
                    $body      = system_replaceEmailVariables($body, $promotionObj->getNumber('id'), 'promotion', $redeem_code, $contactObj->getString('first_name').' '.$contactObj->getString('last_name'));
                    $subject   = system_replaceEmailVariables($subject, $promotionObj->getNumber('id'), 'promotion');
                    $body      = html_entity_decode($body);
                    $subject   = html_entity_decode($subject);
                    $error = false;

                    Mailer::mail( $contactObj->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                }
            }

			return $redeem_code;
		}
	}
