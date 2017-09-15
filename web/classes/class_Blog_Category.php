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
# * FILE: /classes/class_Blog_Category.php
# ----------------------------------------------------------------------------------------------------

class Blog_Category extends Handle
{
    var $id;
    var $post_id;
    var $category_id;
    var $status;
    var $category_root_id;
    var $category_node_left;
    var $category_node_right;

    /*
     * Dont save this field
     */
    var $total_posts;

    function Blog_Category($var = '')
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
            $sql = "SELECT * FROM Blog_Category WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));
            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }

    function makeFromRow($row = '')
    {
        if ($row['id']) {
            $this->id = $row['id'];
        } else {
            if (!$this->id) {
                $this->id = 0;
            }
        }
        if ($row['post_id']) {
            $this->post_id = $row['post_id'];
        } else {
            if (!$this->post_id) {
                $this->post_id = 0;
            }
        }
        if ($row['category_id']) {
            $this->category_id = $row['category_id'];
        } else {
            if (!$this->category_id) {
                $this->category_id = 0;
            }
        }
        if ($row['status']) {
            $this->status = $row['status'];
        } else {
            if (!$this->status) {
                $this->status = "";
            }
        }
        if ($row['category_root_id']) {
            $this->category_root_id = $row['category_root_id'];
        } else {
            if (!$this->category_root_id) {
                $this->category_root_id = 0;
            }
        }
        if ($row['category_node_left']) {
            $this->category_node_left = $row['category_node_left'];
        } else {
            if (!$this->category_node_left) {
                $this->category_node_left = 0;
            }
        }
        if ($row['category_node_right']) {
            $this->category_node_right = $row['category_node_right'];
        } else {
            if (!$this->category_node_right) {
                $this->category_node_right = 0;
            }
        }
    }

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

        if ($this->id) {
            $sql = "UPDATE Blog_Category SET"
                . " post_id = $this->post_id,"
                . " category_id = $this->category_id,"
                . " status = $this->status,"
                . " category_root_id = $this->category_root_id,"
                . " category_node_left = $this->category_node_left,"
                . " category_node_right = $this->category_node_right,"
                . " WHERE id = $this->id";
            $dbObj->query($sql);
        } else {
            $sql = "INSERT INTO Blog_Category"
                . " (post_id, category_id, status, category_root_id, category_node_left, category_node_right)"
                . " VALUES"
                . " ($this->post_id, $this->category_id, $this->status, $this->category_root_id, $this->category_node_left, $this->category_node_right)";
            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);
        }

        $this->prepareToUse();

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("blog.synchronization")->addUpsert($this->post_id);
        }
    }

    function Delete()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        $sql = "DELETE FROM Blog_Category WHERE id = $this->id";
        $dbObj->query($sql);

        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $symfonyContainer->get("blog.synchronization")->addUpsert($this->post_id);
        }
    }

    function getPosts($category_id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);
        $sql = "SELECT DISTINCT post_id FROM Blog_Category USE INDEX (category_status) WHERE category_id IN (" . $category_id . ") AND status = 'A'";

        $result = $dbObj->query($sql);
        $lines = mysql_num_rows($result);

        /*
         * Total of posts
         */
        $this->total_posts = $lines;
        unset($string_posts);
        if ($lines > 0) {
            $string_posts = "";
            while ($row = mysql_fetch_assoc($result)) {
                $lines--;
                $string_posts .= $row["post_id"] . ($lines > 0 ? "," : "");
            }
        }

        if ($string_posts) {
            return $string_posts;
        } else {
            return 0;
        }
    }

    function getPostsByCategoryHierarchy($root_id, $left, $right, $letter = false)
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "SELECT Blog_Category.post_id
						FROM Blog_Category Blog_Category
						WHERE Blog_Category.category_root_id = " . $root_id . " AND
							  Blog_Category.category_node_left >= " . $left . " AND
							  Blog_Category.category_node_right <= " . $right . " AND
		  					  Blog_Category.status = 'A'";

        $result = $dbObj->query($sql);
        $lines = mysql_num_rows($result);

        /*
         * Total of posts
         */
        $aux_count_posts = 0;
        $aux_post_id = 0;

        unset($string_posts);
        if ($lines > 0) {
            $string_posts = "";
            while ($row = mysql_fetch_assoc($result)) {
                $lines--;
                if ($row["post_id"] != $aux_post_id) {
                    $string_posts .= $row["post_id"] . ($lines > 0 ? "," : "");
                    $aux_count_posts++;
                    $aux_post_id = $row["post_id"];
                }
            }
            $this->total_posts = $aux_count_posts;
        }

        if (string_substr($string_posts, -1) == ",") {
            $string_posts = string_substr($string_posts, 0, -1);
        }

        if ($letter) {
            $sql = "SELECT id FROM Post WHERE id IN ($string_posts) AND title LIKE " . db_formatString($letter . "%");
            $result = $dbObj->query($sql);
            $count = mysql_num_rows($result);
            $this->total_posts = $count;
        }

        if ($string_posts) {
            return $string_posts;
        } else {
            return 0;
        }
    }

    function getCategoriesByPostID($post_id)
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "SELECT BlogCategory.title,
                           Blog_Category.category_id
                      FROM Blog_Category Blog_Category
                        INNER JOIN BlogCategory BlogCategory ON BlogCategory.id = Blog_Category.category_id
                     WHERE Blog_Category.post_id =" . $post_id . " ORDER BY BlogCategory.title";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result)) {
            $i = 0;
            while ($row = mysql_fetch_assoc($result)) {
                $categories_array[$i]["id"] = $row["category_id"];
                $categories_array[$i]["title"] = $row["title"];
                $i++;
            }

            return $categories_array;
        } else {
            return false;
        }


    }
}
