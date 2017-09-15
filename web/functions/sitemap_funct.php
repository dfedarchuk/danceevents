<?php

    /* ==================================================================*\
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
      \*================================================================== */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /cron/sitemap_funct.php
    # ----------------------------------------------------------------------------------------------------

    function sitemap_printHeader($encoding = "UTF-8")
    {
        $buffer = "";
        $buffer .= "<?xml version=\"1.0\" encoding=\"".$encoding."\"?>".PHP_EOL;
        $buffer .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">".PHP_EOL;

        return $buffer;
    }

    function sitemap_printNodeUrl($loc, $lastmod = false)
    {
        if (!$lastmod) {
            $lastmod = date("Y-m-d");
        }

        $buffer = "";
        $buffer .= "\t<url>".PHP_EOL;
        $buffer .= "\t\t<loc>".$loc."</loc>".PHP_EOL;
        $buffer .= "\t\t<lastmod>".$lastmod."</lastmod>".PHP_EOL;
        $buffer .= "\t</url>".PHP_EOL;

        return $buffer;
    }

    function sitemap_printFooter()
    {
        $buffer = "";
        $buffer .= "</urlset>".PHP_EOL;

        return $buffer;
    }

    function sitemap_printHeaderNews($encoding = "UTF-8")
    {
        $buffer = "";
        $buffer .= "<?xml version=\"1.0\" encoding=\"".$encoding."\"?>".PHP_EOL;
        $buffer .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:news=\"http://www.google.com/schemas/sitemap-news/0.9\">".PHP_EOL;

        return $buffer;
    }

    function sitemap_printNodeUrlNews($loc, $publication_date = false, $keywords = false, $title = false, $language = false)
    {
        if (!$publication_date) {
            $publication_date = date("Y-m-d");
        }

        if (!$keywords) {
            $keywords = "";
        }

        $buffer = "";
        $buffer .= "\t<url>".PHP_EOL;
        $buffer .= "\t\t<loc>".$loc."</loc>".PHP_EOL;
        $buffer .= "\t\t<news:news>".PHP_EOL;

        if ($title && $language) {
            $buffer .= "\t\t\t<news:publication>".PHP_EOL;
            $buffer .= "\t\t\t\t<news:name>".$title."</news:name>".PHP_EOL;
            $buffer .= "\t\t\t\t<news:language>".$language."</news:language>".PHP_EOL;
            $buffer .= "\t\t\t</news:publication>".PHP_EOL;
        }

        $title and $buffer .= "\t\t\t<news:title>".$title."</news:title>".PHP_EOL;
        $buffer .= "\t\t\t<news:publication_date>".$publication_date."</news:publication_date>".PHP_EOL;
        $buffer .= "\t\t\t<news:keywords>".$keywords."</news:keywords>".PHP_EOL;
        $buffer .= "\t\t</news:news>".PHP_EOL;
        $buffer .= "\t</url>".PHP_EOL;

        return $buffer;
    }

    function sitemap_printFooterNews()
    {
        $buffer = "";
        $buffer .= "</urlset>".PHP_EOL;

        return $buffer;
    }

    function sitemap_indexPrintHeader($encoding = "UTF-8")
    {
        $buffer = "";
        $buffer .= "<?xml version=\"1.0\" encoding=\"".$encoding."\"?>".PHP_EOL;
        $buffer .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">".PHP_EOL;

        return $buffer;
    }

    function sitemap_indexPrintNodeSitemap($file, $lastmod = false)
    {
        setting_get("default_url", $url);
        $url_http = SITEMAP_FORCEHTTPS == "on" ? "https://" : "http://";

        $url_protocol = $url_http.(SITEMAP_ADD_WWW == "on" ? "www." : "");

        $default_url = "$url_protocol$url".EDIRECTORY_FOLDER;
        $sitemap_loc = $default_url."/custom/domain_".SELECTED_DOMAIN_ID."/sitemap/".$file;

        if (!$lastmod) {
            $lastmod = date("Y-m-d");
        }

        $buffer = "";
        $buffer .= "\t<sitemap>".PHP_EOL;
        $buffer .= "\t\t<loc>".$sitemap_loc."</loc>".PHP_EOL;
        $buffer .= "\t\t<lastmod>".$lastmod."</lastmod>".PHP_EOL;
        $buffer .= "\t</sitemap>".PHP_EOL;

        return $buffer;
    }

    function sitemap_indexPrintFooter()
    {
        $buffer = "";
        $buffer .= "</sitemapindex>".PHP_EOL;

        return $buffer;
    }

    function sitemap_writeFile($file_path, $file_content)
    {
        $file = @fopen($file_path, "w");

        if (!is_writeable($file_path)) {
            die("File: $file_path is not writable".PHP_EOL);
        }

        if ($file) {
            if (fwrite($file, $file_content)) {
                fclose($file);

                return true;
            }
        }

        @fclose($file);

        return false;
    }

    function sitemap_buildUrlPath(
        $_locations,
        $_location_level,
        $location_father_id,
        &$buffer_location,
        $location_str,
        &$url_number,
        &$file_number,
        &$files,
        $module
    ) {
        system_retrieveLocationRelationship($_locations, $_location_level, $_location_father_level, $_location_child_level);
        $dbObj = db_getDBObject(DEFAULT_DB, true);

        $container = SymfonyCore::getContainer();

        $result = $container->get('search.engine')
            ->getLocationByModule($module, $_location_level);

        $ids = [];
        array_walk($result['buckets'], function ($a) use (&$ids) {
            $id = $level = null;
            sscanf($a['key'], 'L%d:%d', $level, $id);
            $ids[] = $id;
        });

        $strIds = implode(',', $ids);

        if ($strIds) {

            $location_query = "SELECT id, name, friendly_url FROM Location_".$_location_level." WHERE location_".$_location_father_level."=".$location_father_id." ".($strIds ? " AND id IN ($strIds)" : "")." ORDER BY NAME";

            unset($locations_result);
            $path = EDIRECTORY_ROOT;
            $locations_result = $dbObj->query($location_query);

            while ($location = mysql_fetch_array($locations_result)) {
                if ($url_number <= 0) {
                    $buffer_location .= sitemap_printHeader();
                }

                $str_location_toWrite = $location_str."/".$location['friendly_url'];
                $location_id = $location['id'];
                $buffer_location .= sitemap_printNodeUrl($str_location_toWrite, $default_lastmod);
                $url_number++;

                if ($url_number == SITEMAP_MAXURL) {
                    $buffer_location .= sitemap_printFooter();

                    if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'location'.$file_number.'.xml',
                        $buffer_location)
                    ) {
                        die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/content'.$module.'location'.$file_number.'.xml!'.PHP_EOL);
                    }

                    $buffer_location = "";
                    $files[] = $module."location".$file_number.".xml";
                    $file_number++;
                    $url_number = 0;
                }

                if ($_location_child_level) {
                    sitemap_buildUrlPath($_locations, $_location_child_level, $location_id, $buffer_location, $location_str,
                        $url_number, $file_number, $files, $module);
                }
            }
        }
    }

    function sitemap_createModuleLocations($path, $module)
    {
        $container = SymfonyCore::getContainer();

        $dbObj = db_getDBObject(DEFAULT_DB, true);

        setting_get("default_url", $url);

        $url_http = SITEMAP_FORCEHTTPS == "on" ? "https://" : "http://";

        $url_protocol = $url_http.(SITEMAP_ADD_WWW == "on" ? "www." : "");
        $default_url = "$url_protocol$url";
        $item_default_url = constant(string_strtoupper($module)."_DEFAULT_URL");

        if (!$_SERVER["HTTP_HOST"]) {
            if (string_strpos($item_default_url, $default_url) === false) {
                $item_default_url = $default_url.str_replace($url_http, "", $item_default_url);
            }
        }

        if ($module == "promotion") {
            $module = "deal";
        }

        $_locations = explode(",", EDIR_LOCATIONS);
        $_location_level = $_locations[0];

        $result = $container->get('search.engine')
            ->getLocationByModule($module, $_location_level);

        $ids = [];
        array_walk($result['buckets'], function ($a) use (&$ids) {
            $id = $level = null;
            sscanf($a['key'], 'L%d:%d', $level, $id);
            $ids[] = $id;
        });

        system_retrieveLocationRelationship($_locations, $_location_level, $_location_father_level, $_location_child_level);

        $strIds = implode(',', $ids);

        $files = false;

        if ($strIds) {

            $location_query = "SELECT id, name, friendly_url FROM Location_".$_location_level." ".($strIds ? " WHERE id IN ($strIds)" : "")." ORDER BY name";

            unset($locations_result);

            $locations_result = $dbObj->query($location_query);
            $default_lastmod = date("Y-m-d");
            $buffer_location = "";
            $file_number = 0;
            $url_number = 0;

            while ($location = mysql_fetch_array($locations_result)) {
                if ($url_number <= 0) {
                    $buffer_location .= sitemap_printHeader();
                }

                $location_str = $item_default_url."/".$location['friendly_url'];
                $location_id = $location['id'];
                $buffer_location .= sitemap_printNodeUrl($location_str, $default_lastmod);
                $url_number++;

                if ($url_number == SITEMAP_MAXURL) {
                    $buffer_location .= sitemap_printFooter();

                    if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'location'.$file_number.'.xml',
                        $buffer_location)
                    ) {
                        die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/content'.$module.'location'.$file_number.'.xml!'.PHP_EOL);
                    }

                    $buffer_location = "";
                    $files[] = $module."location".$file_number.".xml";
                    $file_number++;
                    $url_number = 0;
                }

                if ($_location_child_level) {
                    sitemap_buildUrlPath($_locations, $_location_child_level, $location_id, $buffer_location,
                        $item_default_url, $url_number, $file_number, $files, $module);
                }
            }

            if ($url_number > 0) {
                $buffer_location .= sitemap_printFooter();

                if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'location'.$file_number.'.xml',
                    $buffer_location)
                ) {
                    die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/content'.$module.'location'.$file_number.'.xml!'.PHP_EOL);
                }

                $buffer_location = "";
                $files[] = $module."location".$file_number.".xml";
                $file_number++;
                $url_number = 0;
            }

        }

        return $files;
    }

    function sitemap_createModuleCategories($path, $module)
    {
        setting_get("default_url", $url);

        $schema = SITEMAP_FORCEHTTPS == "on" ? "https://" : "http://";

        $url_protocol = $schema.(SITEMAP_ADD_WWW == "on" ? "www." : "");

        $default_url = $url_protocol.$url;
        $item_default_url = constant(string_strtoupper($module)."_DEFAULT_URL");

        if (!$_SERVER["HTTP_HOST"]) {
            if (string_strpos($item_default_url, $default_url) === false) {
                $item_default_url = $default_url.str_replace($schema, "", $item_default_url);
            }
        }

        switch ($module){
            case 'promotion':
                $module = 'deal';
                break;
            case 'blog':
                $module = 'post';
                break;
        }

        $files = [];
        $fileNumber = 0;
        $fileNamePatter = $path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/%scategory%d.xml';

        $categories = SymfonyCore::getContainer()
            ->get('search.repository.category')
            ->findCategoriesWithItens($module);

        if(count($categories) == 0) {
            return [];
        }

        $buffer = sitemap_printHeader();
        $i = 1;

        foreach ($categories as $category) {
            if($i % SITEMAP_MAXURL == 0) {
                $buffer .= sitemap_printFooter();
                $files[] = sprintf('%scategory%d.xml', $module, $fileNumber);
                sitemap_writeFile(sprintf($fileNamePatter, $module, $fileNumber), $buffer);
                $buffer = sitemap_printHeader();
                $fileNumber++;
            }

            $buffer .= sitemap_printCategoryNode($category, $item_default_url);
            $i++;
        }

        $buffer .= sitemap_printFooter();
        sitemap_writeFile(sprintf($fileNamePatter, $module, $fileNumber), $buffer);
        $files[] = sprintf('%scategory%d.xml', $module, $fileNumber);

        return $files;
    }

    /**
     * @param \ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category $category
     * @param string $default_url
     * @return string
     */
    function sitemap_printCategoryNode($category, $default_url){
        $url = sprintf('%s/%s', $default_url, $category->getFriendlyUrl());

        $nodes = sitemap_printNodeUrl($url);

        foreach ($category->getChildren() as $child) {
            $child->setFriendlyUrl(sprintf('%s/%s', $category->getFriendlyUrl(), $child->getFriendlyUrl()));
            $nodes .= sitemap_printCategoryNode($child, $default_url);
        }

        return $nodes;
    }

    function sitemap_createModuleDetails($path, $module)
    {
        $dbObjMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

        setting_get("default_url", $url);

        $url_http = SITEMAP_FORCEHTTPS == "on" ? "https://" : "http://";

        $url_protocol = $url_http.(SITEMAP_ADD_WWW == "on" ? "www." : "");
        $default_url = "$url_protocol$url";
        $item_default_url = constant(string_strtoupper($module)."_DEFAULT_URL");

        if (!$_SERVER["HTTP_HOST"]) {
            if (string_strpos($item_default_url, $default_url) === false) {
                $item_default_url = $default_url.str_replace($url_http, "", $item_default_url);
            }
        }

        if ($module == "blog") {
            $items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url FROM Post WHERE status = 'A' ORDER BY title";
            $items_result = $dbObj->query($items_query);
            $module = "post";
        } elseif ($module == "promotion") {
            $levelspromotion_query = "SELECT value FROM ListingLevel WHERE deals > 0";
            $levelspromotion_result = $dbObj->query($levelspromotion_query);
            $levelspromotion = [];

            while ($arr = mysql_fetch_array($levelspromotion_result)) {
                $levelspromotion[] = $arr['value'];
            }

            $items_query = "SELECT id, DATE(updated) AS updated, name AS title, friendly_url FROM Promotion WHERE Promotion.listing_status = 'A' AND Promotion.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND Promotion.start_date <= DATE_FORMAT(NOW(), '%Y-%m-%d') AND Promotion.amount > 0 AND Promotion.listing_id > 0 AND Promotion.listing_level IN ('".implode(',',
                    $levelspromotion)."') ORDER BY title";
            $items_result = $dbObj->query($items_query);
            $module = "deal";
        } else {

            $levelsdetail_query = "SELECT value FROM ".ucfirst($module)."Level WHERE detail = 'y'";
            $levelsdetail_result = $dbObj->query($levelsdetail_query);
            $levelsdetail = [];

            while ($arr = mysql_fetch_array($levelsdetail_result)) {
                $levelsdetail[] = $arr['value'];
            }

            $items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url FROM ".ucfirst($module)." WHERE FIND_IN_SET(level, '".implode(',',
                    $levelsdetail)."') AND status = 'A' ORDER BY title";
            $items_result = $dbObj->query($items_query);
        }

        $buffer_moduleDetails = "";
        $files = false;
        $file_number = 0;
        $url_number = 0;

        while ($item = mysql_fetch_array($items_result)) {
            if ($url_number <= 0) {
                $buffer_moduleDetails .= sitemap_printHeader();
            }

            $loc = "".$item_default_url."/".$item['friendly_url'].".html";
            $lastmod = $item['updated'];
            $buffer_moduleDetails .= sitemap_printNodeUrl($loc, $lastmod);
            $url_number++;

            if ($url_number == SITEMAP_MAXURL) {
                $buffer_moduleDetails .= sitemap_printFooter();

                if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$file_number.'.xml',
                    $buffer_moduleDetails)
                ) {
                    die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$file_number.'.xml!'.PHP_EOL);
                }

                $buffer_moduleDetails = "";
                $files[] = $module."detail".$file_number.".xml";
                $file_number++;
                $url_number = 0;
            }
        }
        if ($url_number > 0) {
            $buffer_moduleDetails .= sitemap_printFooter();

            if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$file_number.'.xml',
                $buffer_moduleDetails)
            ) {
                die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'detail'.$file_number.'.xml!'.PHP_EOL);
            }

            $buffer_moduleDetails = "";
            $files[] = $module."detail".$file_number.".xml";
            $file_number++;
            $url_number = 0;
        }

        return $files;
    }

    function sitemap_createModuleNews($path, $module)
    {
        $dbObjMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

        setting_get("default_url", $url);

        $url_http = SITEMAP_FORCEHTTPS == "on" ? "https://" : "http://";

        $url_protocol = $url_http.(SITEMAP_ADD_WWW == "on" ? "www." : "");
        $default_url = "$url_protocol$url";
        $item_default_url = constant(string_strtoupper($module)."_DEFAULT_URL");

        if (!$_SERVER["HTTP_HOST"]) {
            if (string_strpos($item_default_url, $default_url) === false) {
                $item_default_url = $default_url.str_replace($url_http, "", $item_default_url);
            }
        }

        $items_query = "SELECT id, DATE(updated) AS updated, title, friendly_url, seo_keywords FROM ".ucfirst($module)." WHERE status='A' AND ( DATE( `updated` ) BETWEEN DATE_SUB( CURDATE(), INTERVAL 2 DAY ) AND CURDATE() ) ORDER BY title";
        $items_result = $dbObj->query($items_query);
        $buffer_moduleNews = "";
        $files = false;
        $file_number = 0;
        $url_number = 0;

        while ($item = mysql_fetch_array($items_result)) {
            if ($url_number <= 0) {
                $buffer_moduleNews .= sitemap_printHeaderNews();
            }

            /**
             * <Lucas Trentim (2015)>
             * @todo: This is supposed to be a ISO 639 Language Code, and reCaptcha happens to use them aswell.
             * This is temporary, just to avoid data replication. We should build a proper class full of
             * such dictionaries, so all data is centered in one place and all others draw from it.
             *
             * Just hope not to visit this comment in some years and tell myself: "temporary my ass"
             */

            $languageLibrary = [
                "en_us" => "en",
                "pt_br" => "pt-BR",
                "es_es" => "es",
                "tr_tr" => "tr",
                "ge_ge" => "de",
                "fr_fr" => "fr",
                "it_it" => "it",
            ];

            $loc = "".$item_default_url."/".$item['friendly_url'].".html";
            $publication_date = $item['updated'];
            $keywords = $item['seo_keywords'];
            $title = $item['title'];
            $language = $languageLibrary[EDIR_LANGUAGE];

            $buffer_moduleNews .= sitemap_printNodeUrlNews($loc, $publication_date, $keywords, $title, $language);
            $url_number++;

            if ($url_number == SITEMAP_MAXURL) {
                $buffer_moduleNews .= sitemap_printFooterNews();

                if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'news'.$file_number.'.xml',
                    $buffer_moduleNews)
                ) {
                    die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'news'.$file_number.'.xml!'.PHP_EOL);
                }

                $buffer_moduleNews = "";
                $files[] = $module."news".$file_number.".xml";
                $file_number++;
                $url_number = 0;
            }
        }

        if ($url_number > 0) {
            $buffer_moduleNews .= sitemap_printFooterNews();

            if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'news'.$file_number.'.xml',
                $buffer_moduleNews)
            ) {
                die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/'.$module.'news'.$file_number.'.xml!'.PHP_EOL);
            }

            $buffer_moduleNews = "";
            $files[] = $module."news".$file_number.".xml";
            $file_number++;
            $url_number = 0;
        }

        return $files;
    }

    function sitemap_createContentMap($path)
    {
        $dbObjMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjMain);

        setting_get("default_url", $url);

        $url_http = SITEMAP_FORCEHTTPS == "on" ? "https://" : "http://";

        $url_protocol = $url_http.(SITEMAP_ADD_WWW == "on" ? "www." : "");
        $default_url = "$url_protocol$url";
        $content_query = "SELECT P.`id`, P.`updated`, P.`title`, P.`url` FROM `Page` AS P INNER JOIN PageType AS PT ON (P.`pagetype_id` = `PT`.id AND PT.`title` = 'CustomPage' AND P.`url` != '' AND P.`sitemap` = '1')";
        $content_result = $dbObj->query($content_query);
        $buffer_content = "";
        $files = false;
        $file_number = 0;
        $url_number = 0;

        while ($content = mysql_fetch_array($content_result)) {
            if ($url_number <= 0) {
                $buffer_content .= sitemap_printHeader();
            }

            if (string_strpos($content['updated'], "0000-00-00") !== false) {
                $lastmod = date("Y-m-d");
            } else {
                $lastmod = date("Y-m-d", strtotime($content['updated']));
            }

            $loc = $default_url."/".$content['url'].".html";
            $buffer_content .= sitemap_printNodeUrl($loc, $lastmod);
            $url_number++;

            if ($url_number == SITEMAP_MAXURL) {
                $buffer_content .= sitemap_printFooter();
                if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/content'.$file_number.'.xml',
                    $buffer_content)
                ) {
                    die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/content'.$file_number.'.xml!'.PHP_EOL);
                }
                $buffer_content = "";
                $files[] = "content".$file_number.".xml";
                $file_number++;
                $url_number = 0;
            }
        }

        if ($url_number > 0) {
            $buffer_content .= sitemap_printFooter();
            if (!sitemap_writeFile($path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/content'.$file_number.'.xml',
                $buffer_content)
            ) {
                die('ERROR WHILE SAVING THE '.$path.'/custom/domain_'.SELECTED_DOMAIN_ID.'/sitemap/content'.$file_number.'.xml!'.PHP_EOL);
            }
            $buffer_content = "";
            $files[] = "content".$file_number.".xml";
            $file_number++;
            $url_number = 0;
        }

        return $files;
    }
