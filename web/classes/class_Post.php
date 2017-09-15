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
# * FILE: /classes/class_Post.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *        $postObj = new Post($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 9.5.00
 * @package Classes
 * @name Post
 * @access Public
 */
class Post extends Handle
{

    var $id;
    var $image_id;
    var $thumb_id;
    var $cover_id;
    var $updated;
    var $entered;
    var $title;
    var $seo_title;
    var $friendly_url;
    var $image_caption;
    var $thumb_caption;
    var $content;
    var $keywords;
    var $seo_keywords;
    var $seo_abstract;
    var $status;
    var $number_views;
    var $data_in_array;

    /**
     * <code>
     *        $postObj = new Post($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name Post
     * @access Public
     * @param mixed $var
     */
    function Post($var = "", $domain_id = false)
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id) {
                $db = db_getDBObjectByDomainID($domain_id, $dbMain);
            } else {
                if (defined("SELECTED_DOMAIN_ID")) {
                    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $db = db_getDBObject();
                }
            }

            unset($dbMain);
            $sql = "SELECT * FROM Post WHERE id = $var";
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
     *        $this->makeFromRow($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name makeFromRow
     * @access Public
     * @param array $row
     */
    function makeFromRow($row = "")
    {

        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->image_id = ($row["image_id"]) ? $row["image_id"] : ($this->image_id ? $this->image_id : "NULL");
        $this->thumb_id = ($row["thumb_id"]) ? $row["thumb_id"] : ($this->thumb_id ? $this->thumb_id : "NULL");
        $this->cover_id = ($row["cover_id"]) ? $row["cover_id"] : ($this->cover_id ? $this->cover_id : "NULL");
        $this->updated = ($row["updated"]) ? $row["updated"] : ($this->updated ? $this->updated : "");
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : "");
        $this->title = ($row["title"]) ? $row["title"] : ($this->title ? $this->title : "");
        $this->seo_title = ($row["seo_title"]) ? $row["seo_title"] : ($this->seo_title ? $this->seo_title : "");
        $this->friendly_url = ($row["friendly_url"]) ? $row["friendly_url"] : "";
        $this->image_caption = ($row["image_caption"]) ? $row["image_caption"] : ($this->image_caption ? $this->image_caption : "");
        $this->thumb_caption = ($row["thumb_caption"]) ? $row["thumb_caption"] : ($this->thumb_caption ? $this->thumb_caption : "");
        $this->content = ($row["content"]) ? $row["content"] : "";
        $this->keywords = ($row["keywords"]) ? $row["keywords"] : "";
        $this->seo_keywords = ($row["seo_keywords"]) ? $row["seo_keywords"] : ($this->seo_keywords ? $this->seo_keywords : "");
        $this->seo_abstract = ($row["seo_abstract"]) ? $row["seo_abstract"] : ($this->seo_abstract ? $this->seo_abstract : "");
        $this->status = ($row["status"]) ? $row["status"] : "A";
        $this->number_views = ($row["number_views"]) ? $row["number_views"] : ($this->number_views ? $this->number_views : 0);
        $this->data_in_array = $row;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->Save();
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name Save
     * @access Public
     */
    function Save()
    {
        $this->prepareToSave();

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        $this->friendly_url = string_strtolower($this->friendly_url);

        /*
         * TODO
         * Review calls of method save when adding/editing an item
         * Right now it's been called several times messing up some attributes values
         */
        if ($this->image_id == "''") {
            $this->image_id = "NULL";
        }
        if ($this->thumb_id == "''") {
            $this->thumb_id = "NULL";
        }
        if ($this->cover_id == "''") {
            $this->cover_id = "NULL";
        }

        if ($this->id) {

            $sql = "UPDATE Post SET"
                . " image_id      = $this->image_id,"
                . " thumb_id      = $this->thumb_id,"
                . " cover_id      = $this->cover_id,"
                . " updated       = NOW(),"
                . " title         = $this->title,"
                . " seo_title     = $this->seo_title,"
                . " friendly_url  = $this->friendly_url,"
                . " image_caption = $this->image_caption,"
                . " thumb_caption = $this->thumb_caption,"
                . " content       = $this->content,"
                . " keywords      = $this->keywords,"
                . " seo_keywords  = $this->seo_keywords,"
                . " seo_abstract  = $this->seo_abstract,"
                . " status        = $this->status,"
                . " number_views  = $this->number_views"
                . " WHERE id      = $this->id";

            $dbObj->query($sql);

            $this->updateCategoryStatusByID();

        } else {

            $sql = "INSERT INTO Post"
                . " (image_id,"
                . " thumb_id,"
                . " cover_id,"
                . " updated,"
                . " entered,"
                . " title,"
                . " seo_title,"
                . " friendly_url,"
                . " image_caption,"
                . " thumb_caption,"
                . " content,"
                . " keywords,"
                . " seo_keywords,"
                . " seo_abstract,"
                . " fulltextsearch_keyword,"
                . " status,"
                . " number_views)"
                . " VALUES"
                . " ($this->image_id,"
                . " $this->thumb_id,"
                . " $this->cover_id,"
                . " NOW(),"
                . " NOW(),"
                . " $this->title,"
                . " $this->seo_title,"
                . " $this->friendly_url,"
                . " $this->image_caption,"
                . " $this->thumb_caption,"
                . " $this->content,"
                . " $this->keywords,"
                . " $this->seo_keywords,"
                . " $this->seo_abstract,"
                . " '',"
                . " $this->status,"
                . " $this->number_views)";

            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);
        }

        $this->prepareToUse();
        $this->setFullTextSearch();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->Delete();
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->Delete();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name Delete
     * @access Public
     */
    function Delete($domain_id = SELECTED_DOMAIN_ID)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        ### POST CATEGORY STATUS
        if ($this->status != "P") {
            $sql = "UPDATE Post SET status = 'P' WHERE id = $this->id";
            $dbObj->query($sql);
        }

        ### COMMENTS
        $sql = "SELECT id FROM Comments WHERE post_id = $this->id";
        $result = $dbObj->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $commentObj = new Comments($row["id"]);
            $commentObj->Delete();
        }

        ### BLOG_CATEOGRY
        $sql = "DELETE FROM Blog_Category WHERE post_id = $this->id";
        $dbObj->query($sql);

        //before deleting the image, it needs to clear image ids
        $sql = "UPDATE Post SET image_id = NULL, thumb_id = NULL, cover_id = NULL WHERE id = $this->id";
        $dbObj->query($sql);

        ### IMAGE
        if ($this->image_id) {
            $image = new Image($this->image_id);
            if ($image) {
                $image->Delete();
            }
        }
        if ($this->thumb_id) {
            $image = new Image($this->thumb_id);
            if ($image) {
                $image->Delete();
            }
        }
        if (is_numeric($this->cover_id)) {
            $image = new Image($this->cover_id);
            if ($image) {
                $image->Delete();
            }
        }

        ### POST
        $sql = "DELETE FROM Post WHERE id = $this->id";
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("blog.synchronization")->addDelete($this->id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->setFullTextSearch();
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->setFullTextSearch();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name setFullTextSearch
     * @access Public
     */
    function setFullTextSearch()
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        if ($this->title) {
            $fulltextsearch_keyword[] = $this->title;
            $addkeyword = format_addApostWords($this->title);
            if ($addkeyword) {
                $fulltextsearch_keyword[] = $addkeyword;
            }
            unset($addkeyword);
        }

        if ($this->keywords) {
            $string = str_replace(" || ", " ", $this->keywords);
            $fulltextsearch_keyword[] = $string;
            $addkeyword = format_addApostWords($string);
            if ($addkeyword != '') {
                $fulltextsearch_keyword[] = $addkeyword;
            }
            unset($addkeyword);
        }

        $categories = $this->getCategories(false, false, $this->id, true, true);
        if ($categories) {
            foreach ($categories as $category) {
                unset($parents);
                $category_id = $category->getNumber("id");
                while (!is_null($category_id) && $category_id != 0) {
                    $sql = "SELECT * FROM BlogCategory WHERE id = $category_id";
                    $result = $dbObj->query($sql);
                    if (mysql_num_rows($result) > 0) {
                        $category_info = mysql_fetch_assoc($result);
                        if ($category_info["enabled"] == "y") {
                            if ($category_info["title"]) {
                                $fulltextsearch_keyword[] = $category_info["title"];
                            }

                            if ($category_info["keywords"]) {
                                $fulltextsearch_keyword[] = str_replace(array("\r\n", "\n"), " ",
                                    $category_info["keywords"]);
                            }
                        }
                        $category_id = $category_info["category_id"];
                    } else {
                        $category_id = 'NULL';
                    }
                }
            }
        }

        if (is_array($fulltextsearch_keyword)) {
            $fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
            $sql = "UPDATE Post SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
            $result = $dbObj->query($sql);
        }

        $this->synchronize();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->setNumberViews($id);
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->setNumberViews($id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name setNumberViews
     * @access Public
     * @param integer $id
     */
    function setNumberViews($id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "UPDATE Post SET number_views = " . $this->number_views . " + 1 WHERE Post.id = " . $id;
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("blog.synchronization")->addViewUpdate($id);
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->getCategories(...);
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->getCategories(...);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getCategories
     * @access Public
     * @param boolean $have_data
     * @param array $data
     * @param integer $id
     * @param boolean $getAll
     * @param boolean $object
     * @param boolean $bulk
     * @return array $categories
     */
    function getCategories(
        $have_data = false,
        $data = false,
        $id = false,
        $getAll = false,
        $object = false,
        $bulk = false
    ) {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        if ($have_data) {
            if ($data["cat_1_id"]) {
                $ids[] = $data["cat_1_id"];
            }
            if ($data["cat_2_id"]) {
                $ids[] = $data["cat_2_id"];
            }
            if ($data["cat_3_id"]) {
                $ids[] = $data["cat_3_id"];
            }
            if ($data["cat_4_id"]) {
                $ids[] = $data["cat_4_id"];
            }
            if ($data["cat_5_id"]) {
                $ids[] = $data["cat_5_id"];
            }

            if (is_array($ids)) {
                $ids = array_unique($ids);
                $sql = "SELECT * FROM BlogCategory WHERE id IN (" . implode(",", $ids) . ")";
                $r = $dbObj->query($sql);
                while ($row = mysql_fetch_array($r)) {
                    $categories[] = new BlogCategory($row);
                }
            }

        } else {
            if (!$id) {
                $id = $this->id;
            }
            if ($id) {

                $sql_main = "SELECT category.root_id,
										post_category.category_id
										FROM Blog_Category post_category
										INNER JOIN BlogCategory category ON category.id = post_category.category_id
										WHERE post_category.post_id = " . $id . " AND root_id > 0";

                $result_main = $dbObj->unbuffered_query($sql_main);
                //if(mysql_num_rows($result_main) > 0){
                if ($result_main) {

                    $aux_array_categories = array();
                    while ($row = mysql_fetch_assoc($result_main)) {
                        if (!$object && !$bulk) {
                            $aux_array_categories[] = $row["root_id"];
                        }
                        if ($getAll) {
                            $aux_array_categories[] = $row["category_id"];
                        }
                    }

                    if (count($aux_array_categories) > 0) {
                        $sql = "SELECT	id,
											title,
											page_title,
											friendly_url,
											enabled,
											category_id
										FROM BlogCategory
										WHERE id IN (" . implode(",", $aux_array_categories) . ")";

                        if (!$object) {
                            $result = $dbObj->unbuffered_query($sql);
                        } else {
                            $result = $dbObj->query($sql);
                        }

                        if ($result) {
                            $categories = array();
                            while ($row = mysql_fetch_assoc($result)) {
                                if ($object) {
                                    $categories[] = new BlogCategory($row);
                                } else {
                                    $categories[] = $row;
                                }
                            }
                        }
                    }
                }
            }
        }

        if (count($categories) > 0) {
            return $categories;
        } else {
            return false;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->setCategories($categories);
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->setCategories($categories);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setCategories
     * @access Public
     * @param array $array
     */
    function setCategories($array)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        if ($this->id) {

            $sql = "DELETE FROM Blog_Category WHERE post_id = " . $this->id;
            $dbObj->query($sql);

            if ($array) {
                foreach ($array as $category) {
                    if ($category) {

                        $lCatObj = new BlogCategory($category);
                        unset($root_id, $left, $right);
                        $root_id = $lCatObj->getNumber("root_id");
                        $left = $lCatObj->getNumber("left");
                        $right = $lCatObj->getNumber("right");

                        unset($b_catObj);
                        $b_catObj = new Blog_Category();
                        $b_catObj->setNumber("post_id", $this->id);
                        $b_catObj->setNumber("category_id", $category);
                        $b_catObj->setString("status", $this->status);
                        $b_catObj->setNumber("category_root_id", $root_id);
                        $b_catObj->setNumber("category_node_left", $left);
                        $b_catObj->setNumber("category_node_right", $right);
                        $b_catObj->Save();
                    }
                }
            }

            $this->setFullTextSearch();
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->updateCategoryStatusByID();
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->updateCategoryStatusByID();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name updateCategoryStatusByID
     * @access Public
     */
    function updateCategoryStatusByID()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql_update = "UPDATE Blog_Category SET status = $this->status WHERE post_id = $this->id";
        $dbObj->query($sql_update);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->getFullPath();
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->getFullPath();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name getFullPath
     * @access Public
     * @return array $path
     */
    function getFullPath()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $category_id = $this->id;
        $i = 0;
        while ($category_id != 0) {
            $sql = "SELECT * FROM BlogCategory WHERE id = $category_id";
            $result = $dbObj->query($sql);
            $row = mysql_fetch_assoc($result);
            $path[$i]["id"] = $row["id"];
            $path[$i]["dad"] = $row["category_id"];
            $path[$i]["title"] = $row["title"];
            $path[$i]["friendly_url"] = $row["friendly_url"];
            $i++;
            $category_id = $row["category_id"];
        }
        if ($path) {
            $path = array_reverse($path);
            for ($i = 0; $i < count($path); $i++) {
                $path[$i]["level"] = $i + 1;
            }

            return ($path);
        } else {
            return false;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $postObj->getPostByFriendlyURL($friendly_url);
     * <br /><br />
     *        //Using this in Post() class.
     *        $this->getPostByFriendlyURL($friendly_url);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getPostByFriendlyURL
     * @param string $friendly_url
     * @access Public
     */
    function getPostByFriendlyURL($friendly_url)
    {
        $dbObj = db_getDBObject();
        $sql = "SELECT * FROM Post WHERE friendly_url = '" . $friendly_url . "'";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result)) {
            $this->makeFromRow(mysql_fetch_assoc($result));

            return true;
        } else {
            return false;
        }
    }

    /**
     * Synchronizes this instance in elasticsearch
     */
    public function synchronize()
    {
        if ($symfonyContainer = SymfonyCore::getContainer()) {
            if($this->status == 'A'){
                $symfonyContainer->get("blog.synchronization")->addUpsert($this->id);
            } else {
                $symfonyContainer->get("blog.synchronization")->addDelete($this->id);
            }
        }
    }
}
