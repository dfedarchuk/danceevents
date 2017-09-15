<?php

class BlogCategory extends Handle
{
    var $id;
    var $title;
    var $page_title;
    var $friendly_url;
    var $category_id;
    var $image_id;
    var $thumb_id;
    var $featured;
    var $summary_description;
    var $seo_description;
    var $keywords;
    var $seo_keywords;
    var $content;
    var $left;
    var $right;
    var $root_id;
    var $full_friendly_url;
    var $level;
    var $enabled;
    const SYNCHRONIZATION_SERVICE_NAME = "blog.category.synchronization";

    /**
     * <code>
     *        $categObj = new BlogCategory($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @param integer $var
     */
    function BlogCategory($var = '')
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
            $sql = "SELECT * FROM BlogCategory WHERE id = $var";
            $row = mysql_fetch_array($db->unbuffered_query($sql));
            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = [];
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
     * @param array $row
     */
    function makeFromRow($row = '')
    {

        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->title = ($row["title"]) ? $row["title"] : ($this->title ? $this->title : "");
        $this->page_title = ($row["page_title"]) ? $row["page_title"] : ($this->page_title ? $this->page_title : "");
        $this->friendly_url = ($row["friendly_url"]) ? $row["friendly_url"] : ($this->friendly_url ? $this->friendly_url : "");
        $this->category_id = ($row["category_id"]) ? $row["category_id"] : ($this->category_id ? $this->category_id : "NULL");
        $this->featured = ($row["featured"]) ? $row["featured"] : ($this->featured ? $this->featured : "n");
        $this->summary_description = ($row["summary_description"]) ? $row["summary_description"] : "";
        $this->seo_description = ($row["seo_description"]) ? $row["seo_description"] : "";
        $this->keywords = ($row["keywords"]) ? $row["keywords"] : ($this->keywords ? $this->keywords : "");
        $this->seo_keywords = ($row["seo_keywords"]) ? $row["seo_keywords"] : ($this->seo_keywords ? $this->seo_keywords : "");
        $this->content = ($row["content"]) ? $row["content"] : "";
        $this->left = ($row["left"]) ? $row["left"] : ($this->left ? $this->left : 1);
        $this->right = ($row["right"]) ? $row["right"] : ($this->right ? $this->right : 2);
        $this->root_id = ($row["root_id"]) ? $row["root_id"] : ($this->root_id ? $this->root_id : 0);
        $this->full_friendly_url = ($row["full_friendly_url"]) ? $row["full_friendly_url"] : "";
        $this->level = ($row["level"]) ? $row["level"] : 0;
        $this->enabled = ($row["enabled"]) ? $row["enabled"] : ($this->enabled ? $this->enabled : "n");
        if ($row["image_id"]) {
            $this->image_id = $row["image_id"];
        } else {
            if (!$this->image_id) {
                $this->image_id = 'NULL';
            }
        }
        if ($row["thumb_id"]) {
            $this->thumb_id = $row["thumb_id"];
        } else {
            if (!$this->thumb_id) {
                $this->thumb_id = 'NULL';
            }
        }

    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->Save();
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @param boolean $update_friendlyurl
     */
    function Save($update_friendlyurl = true)
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

        if ($this->id) {

            $sql = "UPDATE BlogCategory SET"
                . " title = $this->title,"
                . " page_title = $this->page_title,"
                . " friendly_url = $this->friendly_url,"
                . " category_id = $this->category_id,"
                . " image_id = $this->image_id,"
                . " thumb_id = $this->thumb_id,"
                . " featured = $this->featured,"
                . " summary_description = $this->summary_description,"
                . " seo_description = $this->seo_description,"
                . " keywords = $this->keywords,"
                . " seo_keywords = $this->seo_keywords,"
                . " content = $this->content,"
                . " enabled = $this->enabled,"
                . " root_id = $this->root_id,"
                . " level = $this->level"
                . " WHERE id = $this->id";

            $dbObj->query($sql);

        } else {

            $sql = "INSERT INTO BlogCategory"
                . " (title,"
                . " page_title,"
                . " friendly_url,"
                . " category_id,"
                . " image_id,"
                . " thumb_id,"
                . " featured,"
                . " summary_description,"
                . " seo_description,"
                . " keywords,"
                . " seo_keywords,"
                . " content,"
                . " enabled,"
                . " level)"
                . " VALUES"
                . " ($this->title,"
                . " $this->page_title,"
                . " $this->friendly_url,"
                . " $this->category_id,"
                . " $this->image_id,"
                . " $this->thumb_id,"
                . " $this->featured,"
                . " $this->summary_description,"
                . " $this->seo_description,"
                . " $this->keywords,"
                . " $this->seo_keywords,"
                . " $this->content,"
                . " $this->enabled,"
                . " $this->level)";

            $dbObj->query($sql);

            $this->id = mysql_insert_id($dbObj->link_id);

        }

        $this->root_id = $this->findRootCategoryId($this->id);
        $this->rebuildCategoryTree($this->root_id, 1);
        $this->prepareToUse();

        /*
         * Update full path to categories
         */
        if ($update_friendlyurl) {
            $this->updateFullFriendlyURL();
        }

        $this->synchronize();
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->rebuildCategoryTree($category_id, $node_left);
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->rebuildCategoryTree($category_id, $node_left);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name rebuildCategoryTree
     * @param integer $category_id
     * @param integer $node_left
     * @return integer
     * @access Public
     */
    function rebuildCategoryTree($category_id, $node_left)
    {

        if (($category_id > 0) or ($this->id > 0)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }

            // initializing variables
            $category_id = ($category_id > 0) ? $category_id : $this->id;
            $node_left = ($node_left > 0) ? $node_left : 1;
            $root_category_id = $this->findRootCategoryId($category_id);

            // saving / adjusting root id
            $sql = 'UPDATE BlogCategory SET root_id = ' . $root_category_id . ' WHERE id=' . $category_id;
            $dbObj->query($sql);

            // the right value of this node is the left value + 1
            $node_right = $node_left + 1;

            // get all children of this node
            $sql = 'SELECT id FROM BlogCategory WHERE category_id= ' . $category_id;
            $result = $dbObj->query($sql);
            //.' and root_category_id='.$root_category_id
            while ($row = mysql_fetch_assoc($result)) {
                // recursive execution of this function for each
                // child of this node
                // $node_right is the current right value, which is
                // incremented by the rebuild_tree function
                $node_right = $this->rebuildCategoryTree($row['id'], $node_right);
            }

            // we've got the left value, and now that we've processed
            // the children of this node we also know the right value
            $sql = 'UPDATE BlogCategory SET `left` = ' . $node_left . ', `right` = ' . $node_right . ', root_id = ' . $root_category_id . ' WHERE  id = ' . $category_id;
            $dbObj->query($sql);
            $sql = 'UPDATE Blog_Category SET `category_node_left` = ' . $node_left . ', `category_node_right` = ' . $node_right . ', `category_root_id` = ' . $root_category_id . ' WHERE `category_id` = ' . $category_id;
            $dbObj->query($sql);

            // return the right value of this node + 1
            return $node_right + 1;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->findRootCategoryId($category_id);
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->findRootCategoryId($category_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name findRootCategoryId
     * @param integer $category_id
     * @return integer
     * @access Public
     */
    function findRootCategoryId($category_id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        /*
         * Remove "'" if need
         */
        $category_id = str_replace("'", "", $category_id);

        while ($category_id != 0) {
            $sql = "SELECT category_id, id FROM BlogCategory WHERE id = $category_id";
            $result = $dbObj->query($sql);
            $row = mysql_fetch_assoc($result);
            $category_id = $row["category_id"];
            $root_category_id = $row["id"];
        }

        return $root_category_id;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->getHierarchy($id, $get_parents, $get_children);
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->getHierarchy($id, $get_parents, $get_children);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name getHierarchy
     * @param integer $id
     * @param boolean $get_parents
     * @param boolean $get_children
     * @return string
     * @access Public
     */
    function getHierarchy($id, $get_parents = false, $get_children = false)
    {
        unset($dbObj, $string_hierarchy);
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "SELECT postcategory.id,
						   postcategory.root_id,
						   postcategory.left,
						   postcategory.right,
						   postcategory.category_id
						FROM BlogCategory postcategory
						WHERE postcategory.id = " . $id;

        $result = $dbObj->query($sql);

        if (mysql_num_rows($result) > 0) {
            $aux_array = mysql_fetch_assoc($result);

            //To keep the old rules
            if (!$get_parents && !$get_children) {
                if ($aux_array["category_id"] == 0) {
                    $get_parents = false;
                    $get_children = true;
                } else {
                    $get_parents = true;
                    $get_children = false;
                }
            }

            if ($get_children) {
                // Get children
                $sql_aux = "SELECT postcategory.id
										  FROM BlogCategory postcategory
										  WHERE postcategory.root_id = " . $aux_array["root_id"] . " AND
												postcategory.left    > " . $aux_array["left"] . " AND
												postcategory.right   < " . $aux_array["right"];
            } else {
                if ($get_parents) {
                    // Get Parents
                    $sql_aux = "SELECT postcategory.id
										  FROM BlogCategory postcategory
										  WHERE postcategory.root_id = " . $aux_array["root_id"] . " AND
												postcategory.left    < " . $aux_array["left"] . " AND
												postcategory.right   > " . $aux_array["right"];
                }
            }

            //$result_hierarchy = $dbObj->query($sql_aux);
            $result_hierarchy = $dbObj->unbuffered_query($sql_aux);
            //if(mysql_num_rows($result_hierarchy) > 0){
            if ($result_hierarchy) {
                unset($array_hierarchy);
                while ($row = mysql_fetch_assoc($result_hierarchy)) {
                    $array_hierarchy[] = $row["id"];
                }
                if (is_array($array_hierarchy)) {
                    $string_hierarchy = implode(',', $array_hierarchy);
                }
            }
            if (string_strlen($string_hierarchy) > 0) {
                $string_hierarchy .= ',' . $id;
            } else {
                $string_hierarchy = $id;
            }

            return $string_hierarchy;
        } else {
            return false;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->getHighestLevel($id);
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->getHighestLevel($id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name getHighestLevel
     * @param integer $id
     * @return string
     * @access Public
     */
    function getHighestLevel($id)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $ids_children = $this->getHierarchy($id, false, true);
        $max_sublevel = 1;

        if ($ids_children) {
            $sql = "SELECT
						COUNT(DISTINCT category_id) as max_sublevel
						FROM
						BlogCategory
						WHERE
						id IN ($ids_children) AND
						id != " . $id . "
						";
            $result_sublevels = $dbObj->query($sql);

            $row = mysql_fetch_array($result_sublevels);
            $max_sublevel += $row["max_sublevel"];
        }

        return $max_sublevel;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name Delete
     * @access Public
     */
    function Delete()
    {
        if ($this->id != 0) {

            foreach ($this->getFullPath() as $cat_path) {
                $cat_id[] = $cat_path["id"];
            }

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }

            unset($dbMain);

            $category_ids = $this->getHierarchy($this->id, $get_parents = false, $get_children = true);

            if ($category_ids) {
                $sql = "SELECT post_id FROM Blog_Category WHERE category_id IN ($category_ids)";
                $posts_ids = [];
                $result = $dbObj->query($sql);
                while ($row = mysql_fetch_assoc($result)) {
                    $posts_ids[] = $row["post_id"];
                }

                $sql_delete = "DELETE FROM Blog_Category WHERE category_id IN ($category_ids)";
                $dbObj->query($sql_delete);

                $sql_delete = "DELETE FROM BlogCategory WHERE id IN ($category_ids)";
                $dbObj->query($sql_delete);
            }
            $sql = "UPDATE Banner SET category_id = NULL WHERE category_id = $this->id AND section = 'blog'";
            $dbObj->query($sql);

            $this->updateFullTextItems();

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

            if ($symfonyContainer = SymfonyCore::getContainer()) {
                $symfonyContainer->get(self::SYNCHRONIZATION_SERVICE_NAME)->addDelete($category_ids);
            }
        }
    }

    function updateImage($imageArray)
    {
        unset($imageObj);
        if ($this->image_id) {
            $imageobj = new Image($this->image_id);
            if ($imageobj) {
                $imageobj->delete();
            }
        }
        $this->image_id = $imageArray["image_id"];
        unset($imageObj);
        if ($this->thumb_id) {
            $imageObj = new Image($this->thumb_id);
            if ($imageObj) {
                $imageObj->delete();
            }
        }
        $this->thumb_id = $imageArray["thumb_id"];
        unset($imageObj);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->retrieveAllCategories(featured);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name retrieveAllCategories
     * @access Public
     * @param char $featured
     */
    function retrieveAllCategories($featured = '')
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "SELECT * FROM BlogCategory WHERE category_id IS NULL";
        if ($featured == "on") {
            $sql .= " AND featured = 'y'";
        }
        $sql .= "  AND enabled = 'y' ORDER BY title";
        $result = $dbObj->unbuffered_query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->retrieveAllCategoriesXML($featured, $category_id);
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->retrieveAllCategoriesXML($featured, $category_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name retrieveAllCategoriesXML
     * @param string $featured
     * @param integer $category_id
     * @return misc
     * @access Public
     */
    function retrieveAllCategoriesXML($featured = "", $category_id = null)
    {
        $sql_catid = "category_id = '" . $category_id . "'";
        if (is_null($category_id) || $category_id <= 0) {
            $sql_catid = "category_id IS NULL";
        }
        $sql = "SELECT * FROM BlogCategory WHERE ".$sql_catid;

        if ($featured == "on") {
            $sql .= " AND featured = 'y'";
        }

        $sql .= "  AND enabled = 'y' ORDER BY title LIMIT " . MAX_SHOW_ALL_CATEGORIES;

        return system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->getAllCategoriesHierarchyXML($featured, $category_id, $id, $domain_id);
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->getAllCategoriesHierarchyXML($featured, $category_id, $id, $domain_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name getAllCategoriesHierarchyXML
     * @param string $featured
     * @param integer $category_id
     * @param integer $id
     * @param integer $domain_id
     * @return misc
     * @access Public
     */
    function getAllCategoriesHierarchyXML($featured = "", $category_id = null, $id = 0, $domain_id = false)
    {

        $sql = "SELECT
						BlogCategory_1.id,
						BlogCategory_1.title,
						BlogCategory_1.page_title,
						BlogCategory_1.friendly_url,
						BlogCategory_1.category_id,
						BlogCategory_1.root_id,
						BlogCategory_1.left,
						BlogCategory_1.enabled,
						(	SELECT COUNT(BlogCategory_2.id)
							FROM
								BlogCategory BlogCategory_2
							WHERE BlogCategory_2.left < BlogCategory_1.left
							AND BlogCategory_2.right > BlogCategory_1.right
							AND BlogCategory_2.root_id = BlogCategory_1.root_id
						) level,
						(	SELECT
								COUNT(DISTINCT category_id) AS max_sublevel
							FROM
								BlogCategory
							WHERE category_id IN (BlogCategory_1.id)
							AND id != BlogCategory_1.id
							AND title <> ''
                            AND enabled = 'y'
						) children
						FROM
							BlogCategory BlogCategory_1
						WHERE BlogCategory_1.root_id > 0
					";

        $sql_catid = " AND BlogCategory_1.category_id = " . $category_id;
        if (is_null($category_id) || $category_id <= 0) {
            $sql_catid = " AND BlogCategory_1.category_id IS NULL";
        }
        $sql .= $sql_catid;

        if ($id) {
            $sql .= " AND BlogCategory_1.id IN (" . $id . ")";
        }
        if ($featured == "on") {
            $sql .= " AND BlogCategory_1.featured = 'y'";
        }

        $sql .= " AND BlogCategory_1.title <> '' AND BlogCategory_1.enabled = 'y'";

        $sql .= " ORDER BY BlogCategory_1.title LIMIT " . MAX_SHOW_ALL_CATEGORIES;

        return system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->retrieveAllSubCatById($id, $featured);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name retrieveAllSubCatById
     * @access Public
     * @param integer $id
     * @param char $featured
     */
    function retrieveAllSubCatById($id = '', $featured = '')
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "SELECT * FROM BlogCategory WHERE category_id = $id";
        if ($featured == "on") {
            $sql .= " AND featured = 'y'";
        }
        $sql .= "  AND enabled = 'y' ORDER BY title";

        $result = $dbObj->unbuffered_query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->getLevel();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name getLevel
     * @access Public
     */
    function getLevel()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $cat_level = 0;
        $category_id = $this->getString("id");
        while ($category_id != 0) {
            $sql = "SELECT category_id FROM BlogCategory WHERE id = $category_id";
            $result = $dbObj->unbuffered_query($sql);
            $row = mysql_fetch_assoc($result);
            $category_id = $row["category_id"];
            $cat_level++;
        }

        return $cat_level;
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->getFullPath();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name getFullPath
     * @access Public
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

        $fields = "`id`, `category_id`, `featured`, `enabled`, `friendly_url`, `title`";

        $category_id = $this->id;
        $i = 0;
        while ($category_id != 0) {
            $sql = "SELECT $fields FROM BlogCategory WHERE id = $category_id";
            //$result = $dbObj->query($sql);
            $result = $dbObj->unbuffered_query($sql);
            $row = mysql_fetch_assoc($result);
            $path[$i]["id"] = $row["id"];
            $path[$i]["dad"] = $row["category_id"];
            $path[$i]["title"] = $row["title"];
            $path[$i]["friendly_url"] = $row["friendly_url"];
            $path[$i]["featured"] = $row["featured"];
            $path[$i]["enabled"] = $row["enabled"];
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
     *        $categObj->updateFullTextItems();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name updateFullTextItems
     * @access Public
     */
    function updateFullTextItems($posts_ids = false)
    {
        if (!$posts_ids) {

            if ($this->id) {
                $category_ids = $this->getHierarchy($this->id, $get_parents = true, $get_children = false);
                $category_ids .= (string_strlen($category_ids) ? "," : "");
                $category_ids .= $this->getHierarchy($this->id, $get_parents = false, $get_children = true);

                if ($category_ids) {
                    $dbMain = db_getDBObject(DEFAULT_DB, true);
                    if (defined("SELECTED_DOMAIN_ID")) {
                        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                    } else {
                        $dbObj = db_getDBObject();
                    }
                    unset($dbMain);

                    $sql = "SELECT post_id FROM Blog_Category WHERE category_id IN ($category_ids)";
                    $result = $dbObj->query($sql);

                    while ($row = mysql_fetch_array($result)) {
                        if ($row['post_id']) {
                            $postObj = new Post($row['post_id']);
                            $postObj->setFullTextSearch();
                            unset($postObj);
                        }
                    }
                }

                return true;
            }

            return false;
        } else {
            foreach ($posts_ids as $post_id) {
                if ($post_id) {
                    $postObj = new Post($post_id);
                    $postObj->setFullTextSearch();
                    unset($postObj);
                }
            }

            return true;
        }
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->setFeatured();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name setFeatured
     * @access Public
     */
    function setFeatured()
    {
        if (!$this->id) {
            return false;
        }
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $sql = "UPDATE BlogCategory SET featured = 'y' WHERE id = $this->id";

        return $dbObj->query($sql);
    }

    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $categObj->updateFullFriendlyURL();
     * <br /><br />
     *        //Using this in BlogCategory() class.
     *        $this->updateFullFriendlyURL();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 9.5.00
     * @name updateFullFriendlyURL
     * @access Public
     */
    function updateFullFriendlyURL()
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $db = db_getDBObject();
        }
        unset($dbMain);

        /*
         * Get correct info of category
         */
        $sql = "SELECT
                    BlogCategory.root_id,
                    BlogCategory.left,
                    BlogCategory.right
                FROM BlogCategory
                WHERE id = {$this->root_id}";

        $result = $db->query($sql);

        if (mysql_num_rows($result) > 0) {
            /*
             * Get all children
             */
            $row_father = mysql_fetch_assoc($result);
            $sql_children = "SELECT *
                             FROM BlogCategory
                             WHERE
                                 BlogCategory.root_id= {$row_father["root_id"]} AND
                                 BlogCategory.left >= {$row_father["left"]} AND
                                 BlogCategory.right <= {$row_father["right"]}";

            $result_children = $db->query($sql_children);

            if (mysql_num_rows($result_children) > 0) {
                while ($row_children = mysql_fetch_assoc($result_children)) {
                    $cat_aux = new BlogCategory($row_children);
                    $sql = "SELECT friendly_url
                            FROM BlogCategory
                            WHERE root_id = {$cat_aux->root_id} AND
                                  BlogCategory.left <= {$cat_aux->left} AND
                                  BlogCategory.right >= {$cat_aux->right}
                            ORDER BY root_id,
                                     BlogCategory.left,
                                     BlogCategory.right";

                    $result = $db->query($sql);
                    $lines = mysql_num_rows($result);

                    if (mysql_num_rows($result) > 0) {
                        $aux_friendly_url = "";
                        while ($row = mysql_fetch_assoc($result)) {
                            $lines--;
                            if ($row["friendly_url"]) {
                                $aux_friendly_url .= $row["friendly_url"] . ($lines > 0 ? "/" : "");
                            }
                        }

                        /*
                         * Save full friendly_url
                         */
                        $sql_update = "UPDATE BlogCategory SET full_friendly_url = " . db_formatString($aux_friendly_url) . " WHERE id = " . $cat_aux->id;
                        $db->query($sql_update);
                    }
                }
            }
        }
    }

    public function synchronize()
    {
        if ($symfonyContainer = SymfonyCore::getContainer()) {
            $synchronizable = $symfonyContainer->get(self::SYNCHRONIZATION_SERVICE_NAME);

            $synchronizable->addUpsert($this->id);
            $this->category_id and $synchronizable->addUpsert($this->category_id);
        }
    }
}
