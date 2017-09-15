<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /makemainimage.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $domain_id = db_formatString($_GET["domain_id"], null, null, false);
    $image_id = (int)db_formatString($_GET["image_id"], null, null, false);
    $thumb_id = (int)db_formatString($_GET["thumb_id"], null, null, false);
    $item_id = (int)db_formatString($_GET["item_id"], null, null, false);
    $temp = db_formatString($_GET["temp"], null, null, false);
    $item_type = db_formatString(ucfirst($_GET["item_type"]), null, null, false);
    $sess_id = db_formatString($_GET["gallery_hash"], null, null, false);

	if ($temp == 'y'){

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
		if ($item_id == 0){
			$sql = "Update Gallery_Temp SET image_default = 'n' WHERE sess_id = '".$sess_id."'";
			$dbObj->query($sql);
			$sql = "Update Gallery_Temp SET image_default = 'y' WHERE image_id = $image_id";
			$dbObj->query($sql);
		}

		if ($item_id != 0){

			$sql = "SELECT image_id, thumb_id FROM $item_type WHERE id = $item_id";
			$row = mysql_fetch_array($dbObj->query($sql));
			$old_image = $row["image_id"];
			$old_thumb = $row["thumb_id"];

            if ($old_image && $old_thumb) {
                $sql = "SELECT	id,
							gallery_id,
							image_caption,
							thumb_caption
					FROM Gallery_Image
					WHERE image_id = $old_image AND thumb_id = $old_thumb";

                $row = mysql_fetch_array($dbObj->query($sql));

                $old_id = $row["id"];
                $old_gallery_id = $row["gallery_id"];
                $old_image_caption = addslashes($row["image_caption"]);
                $old_thumb_caption = addslashes($row["thumb_caption"]);
            }

			$sql = "SELECT	image_caption,
							thumb_caption
					FROM Gallery_Temp
					WHERE image_id = $image_id AND thumb_id = $thumb_id";
			$row = mysql_fetch_array($dbObj->query($sql));

			$image_caption = addslashes($row["image_caption"]);
			$thumb_caption = addslashes($row["thumb_caption"]);

			$itemObj = new $item_type($item_id);
			$itemObj->setNumber("image_id", $image_id);
			$itemObj->setNumber("thumb_id", $thumb_id);
			$itemObj->save();

			if ($old_image && $old_thumb){
				$sql = "UPDATE Gallery_Temp SET
											image_id = $old_image,
											image_caption = \"$old_image_caption\",
											thumb_id = $old_thumb,
											thumb_caption = \"$old_thumb_caption\",
											image_default = \"n\"
						WHERE image_id = $image_id";
				$dbObj->query($sql);

				$sql = "UPDATE Gallery_Image SET
											image_id = $image_id,
											image_caption = \"$image_caption\",
											thumb_id = $thumb_id,
											thumb_caption = \"$thumb_caption\"
						WHERE id = $old_id";
				$dbObj->query($sql);

			}else {
				$sql = "DELETE FROM Gallery_Temp WHERE image_id = $image_id";
				$dbObj->query($sql);
				$sql = "SELECT gallery_id FROM Gallery_Item WHERE item_id = $item_id AND item_type = '".string_strtolower($item_type)."'";
				$row = mysql_fetch_array($dbObj->query($sql));
				$gallery_id = $row["gallery_id"];
                $sql = "Update Gallery_Temp SET image_default = 'n' WHERE sess_id = '".$sess_id."'";
                $dbObj->query($sql);
				$sql = "INSERT INTO Gallery_Image (gallery_id,
													image_id,
													image_caption,
													thumb_id,
													thumb_caption,
													image_default)
											VALUES ($gallery_id,
													$image_id,
													'$image_caption',
													$thumb_id,
													'$thumb_caption',
													'y')";
				$dbObj->query($sql);
			}
		}
	}else{

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
		$sql = "SELECT image_id, thumb_id FROM $item_type WHERE id = $item_id";
		$row = mysql_fetch_array($dbObj->query($sql));
		$old_image = $row["image_id"];
		$old_thumb = $row["thumb_id"];

		$itemObj = new $item_type($item_id);
		$itemObj->setNumber("image_id", $image_id);
		$itemObj->setNumber("thumb_id", $thumb_id);
		$itemObj->save();

		$sql = "SELECT	id,
						gallery_id,
						image_caption,
						thumb_caption
				FROM Gallery_Image
				WHERE image_id = $image_id AND thumb_id = $thumb_id";
		$row = mysql_fetch_array($dbObj->query($sql));

        $id = $row["id"];
		$gallery_id = $row["gallery_id"];
		$image_caption = addslashes($row["image_caption"]);
		$thumb_caption = addslashes($row["thumb_caption"]);

		if ($old_image && $old_thumb) {


			$sql = "SELECT	id,
							image_caption,
							thumb_caption,
							gallery_id
					FROM Gallery_Image
					WHERE image_id = $old_image AND thumb_id = $old_thumb";
			$row = mysql_fetch_array($dbObj->query($sql));

			$old_id = $row["id"];
			$old_id_gallery_id = $row["gallery_id"];
			$old_image_caption = addslashes($row["image_caption"]);
			$old_thumb_caption = addslashes($row["thumb_caption"]);

			//update the gallery images ids as the older images ids
            $sql = "UPDATE Gallery_Image SET image_default = 'n' WHERE gallery_id = {$old_id_gallery_id} AND image_default = 'y'";
			$dbObj->query($sql);

            //update the new main image captions with the gallery captions
            $sql = "UPDATE Gallery_Image SET image_default = 'y' WHERE id = {$id}";
			$dbObj->query($sql);
		} else {

            $sql = "DELETE FROM Gallery_Image WHERE id = $id";
            $dbObj->query($sql);

			$sql = "INSERT INTO Gallery_Image (gallery_id,
												image_id,
												image_caption,
												thumb_id,
												thumb_caption,
												image_default)
										VALUES ($gallery_id,
												$image_id,
												'$image_caption',
												$thumb_id,
												'$thumb_caption',
												'y')";
			$dbObj->query($sql);
		}
	}
