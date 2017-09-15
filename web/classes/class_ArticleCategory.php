<?php

class ArticleCategory extends Handle
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
    var $enabled;

    const SYNCHRONIZATION_SERVICE_NAME = "article.category.synchronization";

    function ArticleCategory($var = '')
    {
        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }

            unset($dbMain);
            $sql = "SELECT * FROM ArticleCategory WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));
            $this->makeFromRow($row);
        } else {
            if (!is_array($var)) {
                $var = [];
            }
            $this->makeFromRow($var);
        }
    }

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
        $this->seo_keywords = ($row["seo_keywords"]) ? $row["seo_keywords"] : "";
        $this->content = ($row["content"]) ? $row["content"] : "";
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

        if ($this->id) {

            $sql = "UPDATE ArticleCategory SET"
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
                . " enabled = $this->enabled"
                . " WHERE id = $this->id";
            $dbObj->query($sql);

        } else {

            $sql = "INSERT INTO ArticleCategory"
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
                . " enabled)"
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
                . " $this->enabled)";

            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);

        }

        $this->prepareToUse();

        $this->synchronize();
    }

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

            $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$this->id}";
            $r = $dbObj->query($sql);

            while ($row = mysql_fetch_array($r)) {
                $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$row["id"]}";
                $r2 = $dbObj->query($sql);

                while ($row2 = mysql_fetch_array($r2)) {
                    $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$row2["id"]}";
                    $r3 = $dbObj->query($sql);

                    while ($row3 = mysql_fetch_array($r3)) {
                        $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$row3["id"]}";
                        $r4 = $dbObj->query($sql);

                        while ($row4 = mysql_fetch_array($r4)) {
                            $sql = "UPDATE Article SET cat_1_id = NULL, parcat_1_level1_id = 0, parcat_1_level2_id = 0, parcat_1_level3_id = 0, parcat_1_level4_id = 0 WHERE cat_1_id = {$row4["id"]}";
                            $dbObj->query($sql);
                            $sql = "UPDATE Article SET cat_2_id = NULL, parcat_2_level1_id = 0, parcat_2_level2_id = 0, parcat_2_level3_id = 0, parcat_2_level4_id = 0 WHERE cat_2_id = {$row4["id"]}";
                            $dbObj->query($sql);
                            $sql = "UPDATE Article SET cat_3_id = NULL, parcat_3_level1_id = 0, parcat_3_level2_id = 0, parcat_3_level3_id = 0, parcat_3_level4_id = 0 WHERE cat_3_id = {$row4["id"]}";
                            $dbObj->query($sql);
                            $sql = "UPDATE Article SET cat_4_id = NULL, parcat_4_level1_id = 0, parcat_4_level2_id = 0, parcat_4_level3_id = 0, parcat_4_level4_id = 0 WHERE cat_4_id = {$row4["id"]}";
                            $dbObj->query($sql);
                            $sql = "UPDATE Article SET cat_5_id = NULL, parcat_5_level1_id = 0, parcat_5_level2_id = 0, parcat_5_level3_id = 0, parcat_5_level4_id = 0 WHERE cat_5_id = {$row4["id"]}";
                            $dbObj->query($sql);
                        }

                        $sql = "UPDATE Article SET cat_1_id = NULL, parcat_1_level1_id = 0, parcat_1_level2_id = 0, parcat_1_level3_id = 0, parcat_1_level4_id = 0 WHERE cat_1_id = {$row3["id"]}";
                        $dbObj->query($sql);
                        $sql = "UPDATE Article SET cat_2_id = NULL, parcat_2_level1_id = 0, parcat_2_level2_id = 0, parcat_2_level3_id = 0, parcat_2_level4_id = 0 WHERE cat_2_id = {$row3["id"]}";
                        $dbObj->query($sql);
                        $sql = "UPDATE Article SET cat_3_id = NULL, parcat_3_level1_id = 0, parcat_3_level2_id = 0, parcat_3_level3_id = 0, parcat_3_level4_id = 0 WHERE cat_3_id = {$row3["id"]}";
                        $dbObj->query($sql);
                        $sql = "UPDATE Article SET cat_4_id = NULL, parcat_4_level1_id = 0, parcat_4_level2_id = 0, parcat_4_level3_id = 0, parcat_4_level4_id = 0 WHERE cat_4_id = {$row3["id"]}";
                        $dbObj->query($sql);
                        $sql = "UPDATE Article SET cat_5_id = NULL, parcat_5_level1_id = 0, parcat_5_level2_id = 0, parcat_5_level3_id = 0, parcat_5_level4_id = 0 WHERE cat_5_id = {$row3["id"]}";
                        $dbObj->query($sql);
                    }

                    $sql = "UPDATE Article SET cat_1_id = NULL, parcat_1_level1_id = 0, parcat_1_level2_id = 0, parcat_1_level3_id = 0, parcat_1_level4_id = 0 WHERE cat_1_id = {$row2["id"]}";
                    $dbObj->query($sql);
                    $sql = "UPDATE Article SET cat_2_id = NULL, parcat_2_level1_id = 0, parcat_2_level2_id = 0, parcat_2_level3_id = 0, parcat_2_level4_id = 0 WHERE cat_2_id = {$row2["id"]}";
                    $dbObj->query($sql);
                    $sql = "UPDATE Article SET cat_3_id = NULL, parcat_3_level1_id = 0, parcat_3_level2_id = 0, parcat_3_level3_id = 0, parcat_3_level4_id = 0 WHERE cat_3_id = {$row2["id"]}";
                    $dbObj->query($sql);
                    $sql = "UPDATE Article SET cat_4_id = NULL, parcat_4_level1_id = 0, parcat_4_level2_id = 0, parcat_4_level3_id = 0, parcat_4_level4_id = 0 WHERE cat_4_id = {$row2["id"]}";
                    $dbObj->query($sql);
                    $sql = "UPDATE Article SET cat_5_id = NULL, parcat_5_level1_id = 0, parcat_5_level2_id = 0, parcat_5_level3_id = 0, parcat_5_level4_id = 0 WHERE cat_5_id = {$row2["id"]}";
                    $dbObj->query($sql);
                }
                $sql = "UPDATE Article SET cat_1_id = NULL, parcat_1_level1_id = 0, parcat_1_level2_id = 0, parcat_1_level3_id = 0, parcat_1_level4_id = 0 WHERE cat_1_id = {$row["id"]}";
                $dbObj->query($sql);
                $sql = "UPDATE Article SET cat_2_id = NULL, parcat_2_level1_id = 0, parcat_2_level2_id = 0, parcat_2_level3_id = 0, parcat_2_level4_id = 0 WHERE cat_2_id = {$row["id"]}";
                $dbObj->query($sql);
                $sql = "UPDATE Article SET cat_3_id = NULL, parcat_3_level1_id = 0, parcat_3_level2_id = 0, parcat_3_level3_id = 0, parcat_3_level4_id = 0 WHERE cat_3_id = {$row["id"]}";
                $dbObj->query($sql);
                $sql = "UPDATE Article SET cat_4_id = NULL, parcat_4_level1_id = 0, parcat_4_level2_id = 0, parcat_4_level3_id = 0, parcat_4_level4_id = 0 WHERE cat_4_id = {$row["id"]}";
                $dbObj->query($sql);
                $sql = "UPDATE Article SET cat_5_id = NULL, parcat_5_level1_id = 0, parcat_5_level2_id = 0, parcat_5_level3_id = 0, parcat_5_level4_id = 0 WHERE cat_5_id = {$row["id"]}";
                $dbObj->query($sql);
            }

            $sql = "UPDATE Article SET cat_1_id = NULL, parcat_1_level1_id = 0, parcat_1_level2_id = 0, parcat_1_level3_id = 0, parcat_1_level4_id = 0 WHERE cat_1_id = {$this->id}";
            $dbObj->query($sql);
            $sql = "UPDATE Article SET cat_2_id = NULL, parcat_2_level1_id = 0, parcat_2_level2_id = 0, parcat_2_level3_id = 0, parcat_2_level4_id = 0 WHERE cat_2_id = {$this->id}";
            $dbObj->query($sql);
            $sql = "UPDATE Article SET cat_3_id = NULL, parcat_3_level1_id = 0, parcat_3_level2_id = 0, parcat_3_level3_id = 0, parcat_3_level4_id = 0 WHERE cat_3_id = {$this->id}";
            $dbObj->query($sql);
            $sql = "UPDATE Article SET cat_4_id = NULL, parcat_4_level1_id = 0, parcat_4_level2_id = 0, parcat_4_level3_id = 0, parcat_4_level4_id = 0 WHERE cat_4_id = {$this->id}";
            $dbObj->query($sql);
            $sql = "UPDATE Article SET cat_5_id = NULL, parcat_5_level1_id = 0, parcat_5_level2_id = 0, parcat_5_level3_id = 0, parcat_5_level4_id = 0 WHERE cat_5_id = {$this->id}";
            $dbObj->query($sql);

            /* In here we'll collect all categories which will meet their doom */
            $categoryDump[] = $this->id;

            $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$this->id}";
            $r = $dbObj->query($sql);
            while ($row = mysql_fetch_array($r)) {
                $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$row["id"]}";
                $r2 = $dbObj->query($sql);
                while ($row2 = mysql_fetch_array($r2)) {
                    $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$row2["id"]}";
                    $r3 = $dbObj->query($sql);
                    while ($row3 = mysql_fetch_array($r3)) {
                        $sql = "SELECT * FROM ArticleCategory WHERE category_id = {$row3["id"]}";
                        $r4 = $dbObj->query($sql);
                        while ($row4 = mysql_fetch_array($r4)) {
                            $categoryDump[] = $row4["id"];

                            $sql = "DELETE FROM ArticleCategory WHERE id = {$row4["id"]}";
                            $dbObj->query($sql);
                        }

                        $categoryDump[] = $row3["id"];
                        $sql = "DELETE FROM ArticleCategory WHERE id = {$row3["id"]}";
                        $dbObj->query($sql);
                    }

                    $categoryDump[] = $row2["id"];
                    $sql = "DELETE FROM ArticleCategory WHERE id = {$row2["id"]}";
                    $dbObj->query($sql);
                }

                $categoryDump[] = $row["id"];
                $sql = "DELETE FROM ArticleCategory WHERE id = {$row["id"]}";
                $dbObj->query($sql);
            }

            $categoryDump[] = $this->id;
            $sql = "DELETE FROM ArticleCategory WHERE id = {$this->id} LIMIT 1";
            $dbObj->query($sql);

            $sql = "UPDATE Banner SET category_id = 0 WHERE category_id = {$this->id} AND section = 'article'";
            $dbObj->query($sql);

            if ($symfonyContainer = SymfonyCore::getContainer()) {
                $symfonyContainer->get(self::SYNCHRONIZATION_SERVICE_NAME)->addDelete($categoryDump);
            }

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

    function retrieveAllCategories($featured = '')
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "SELECT * FROM ArticleCategory WHERE category_id IS NULL";
        if ($featured == "on") {
            $sql .= " AND featured = 'y'";
        }
        $sql .= " AND enabled = 'y' ORDER BY title";
        $result = $dbObj->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    function retrieveAllSubCatById($id = '', $featured = '')
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "SELECT * FROM ArticleCategory WHERE category_id = $id";
        if ($featured == "on") {
            $sql .= " AND featured = 'y'";
        }
        $sql .= "  AND enabled = 'y' ORDER BY title";
        $result = $dbObj->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

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
            $sql = "SELECT category_id FROM ArticleCategory WHERE id = $category_id";
            $result = $dbObj->query($sql);
            $row = mysql_fetch_assoc($result);
            $category_id = $row["category_id"];
            $cat_level++;
        }

        return $cat_level;
    }

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
            $sql = "SELECT $fields FROM ArticleCategory WHERE id = $category_id";
            $result = $dbObj->query($sql);
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

    function updateFullTextItems()
    {

        if ($this->id) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }

            unset($dbMain);

            $category_id = $this->id;

            $sql = "SELECT id
                    FROM Article
                    WHERE (
                        cat_1_id = {$category_id}
                        OR parcat_1_level1_id = {$category_id}
                        OR parcat_1_level2_id = {$category_id}
                        OR parcat_1_level3_id = {$category_id}
                        OR parcat_1_level4_id = {$category_id}
                        OR cat_2_id = {$category_id}
                        OR parcat_2_level1_id = {$category_id}
                        OR parcat_2_level2_id = {$category_id}
                        OR parcat_2_level3_id = {$category_id}
                        OR parcat_2_level4_id = {$category_id}
                        OR cat_3_id = {$category_id}
                        OR parcat_3_level1_id = {$category_id}
                        OR parcat_3_level2_id = {$category_id}
                        OR parcat_3_level3_id = {$category_id}
                        OR parcat_3_level4_id = {$category_id}
                        OR cat_4_id = {$category_id}
                        OR parcat_4_level1_id = {$category_id}
                        OR parcat_4_level2_id = {$category_id}
                        OR parcat_4_level3_id = {$category_id}
                        OR parcat_4_level4_id = {$category_id}
                        OR cat_5_id = {$category_id}
                        OR parcat_5_level1_id = {$category_id}
                        OR parcat_5_level2_id = {$category_id}
                        OR parcat_5_level3_id = {$category_id}
                        OR parcat_5_level4_id = {$category_id}
                    )";

            $result = $dbObj->query($sql);

            while ($row = mysql_fetch_array($result)) {
                if ($row['id']) {
                    $articleObj = new Article($row['id']);
                    $articleObj->setFullTextSearch();
                    unset($articleObj);
                }
            }

            return true;
        }

        return false;
    }

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
        $sql = "UPDATE ArticleCategory SET featured='y'  WHERE id=$this->id";

        return $dbObj->query($sql);
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
