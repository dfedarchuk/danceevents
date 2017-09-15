<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-search-module.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------

    switch ($manageModule) {
        case "listing":     $moduleCategory = "ListingCategory";
                            $level = new ListingLevel();
                            $moduleScalability = LISTINGCATEGORY_SCALABILITY_OPTIMIZATION;
                            break;
                        
        case "banner":      
                            break;
                        
        case "event":       $moduleCategory = "EventCategory";
                            $level = new EventLevel();
                            $moduleScalability = EVENTCATEGORY_SCALABILITY_OPTIMIZATION;
                            break;
                        
        case "classified":  $moduleCategory = "ClassifiedCategory";
                            $level = new ClassifiedLevel();
                            $moduleScalability = CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION;
                            break;
                        
        case "article":     $moduleCategory = "ArticleCategory";
                            $level = new ArticleLevel();
                            $moduleScalability = ARTICLECATEGORY_SCALABILITY_OPTIMIZATION;
                            break;
                                               
        case "blog":        $moduleCategory = "BlogCategory";
                            $moduleScalability = BLOGCATEGORY_SCALABILITY_OPTIMIZATION;
                            break;
    }

     if ($manageModule != "promotion") {
        //Status
        if ($manageModule == "blog") {
            $arrayNameDD = Array(system_showText(LANG_LABEL_ACTIVE), system_showText(LANG_LABEL_SUSPENDED), system_showText(LANG_LABEL_PENDING));
            $arrayValueDD = Array("A", "S", "P");
            $statusDropDown = html_selectBox("search_status", $arrayNameDD, $arrayValueDD, $search_status, "", "", system_showText(LANG_LABEL_SELECT_ALLSTATUS));
        } else {
            $statusObj = new ItemStatus();
            $statusDropDown = html_selectBox("search_status", $statusObj->getNames(), $statusObj->getValues(), $search_status, "", "", system_showText(LANG_LABEL_SELECT_ALLSTATUS));
        }
    }

    if ($manageModule != "promotion" && $manageModule != "banner") {
        //Category
        $orderby = "`title`";
        if ($manageModule == "listing" || $manageModule == "blog") {
            $fields = array("id", "title");
            $nameArray  = array();
            $valueArray = array();
            $resultArray = db_loadCategoriesDropdown($moduleCategory, $fields, null, 1, $moduleScalability, SELECTED_DOMAIN_ID, $str_values, $orderby);

            $valueArray = $resultArray["values"];
            $nameArray = $resultArray["names"];

        } else {
            $fields = "`id`, `title`";
            $categories = db_getFromDB(strtolower($moduleCategory), "category_id", null, "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
            $nameArray  = array();
            $valueArray = array();
            if ($categories) {
                foreach ($categories as $category) {
                    $valueArray[] = $category->getNumber("id");
                    $nameArray[] = $category->getString("title");
                    if ($moduleScalability != "on") {
                        $subcategories = db_getFromDB(strtolower($moduleCategory), "category_id", $category->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                        if ($subcategories) {
                            foreach ($subcategories as $subcategory) {
                                $valueArray[] = $subcategory->getNumber("id");
                                $nameArray[] = " &raquo; ".$subcategory->getString("title");
                                $subcategories2 = db_getFromDB(strtolower($moduleCategory), "category_id", $subcategory->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                if ($subcategories2) {
                                    foreach ($subcategories2 as $subcategory2) {
                                        $valueArray[] = $subcategory2->getNumber("id");
                                        $nameArray[] = " &raquo;&raquo; ".$subcategory2->getString("title");
                                        $subcategories3 = db_getFromDB(strtolower($moduleCategory), "category_id", $subcategory2->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                        if ($subcategories3) {
                                            foreach ($subcategories3 as $subcategory3) {
                                                $valueArray[] = $subcategory3->getNumber("id");
                                                $nameArray[] = " &raquo;&raquo;&raquo; ".$subcategory3->getString("title");
                                                $subcategories4 = db_getFromDB(strtolower($moduleCategory), "category_id", $subcategory3->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                                if ($subcategories4) {
                                                    foreach ($subcategories4 as $subcategory4) {
                                                        $valueArray[] = $subcategory4->getNumber("id");
                                                        $nameArray[] = " &raquo;&raquo;&raquo;&raquo; ".$subcategory4->getString("title");
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }

        $categoryDropDown = html_selectBox("search_category_id", $nameArray, $valueArray, $search_category_id, "", "", system_showText(LANG_LABEL_SELECT_ALLCATEGORIES));

    } elseif ($manageModule == "banner") {
        //Banner Type Drop Down
        $fields = "`id`, `title`";
        $orderby = "`title`";
        $whereField = "`caption`";
        
        $bannerObj  = new Banner();

        $nameArray  = array();
        $valueArray = array();

        $bannerLevelObj = new BannerLevel(true);
        unset($levelStatus);
        foreach ($bannerLevelObj->value as $k => $value) {
            $levelStatus[$value] = $bannerLevelObj->active[$k];
        }

        foreach($bannerObj->banner_types as $each_type => $each_value){
            $banner_size = "(".$bannerLevelObj->getWidth($each_value)."px x ".$bannerLevelObj->getHeight($each_value)."px)";
            if ($levelStatus[$each_value] == "n") $banner_size .= " (".LANG_BANNER_DISABLED.")";

            $nameArray[]  = string_ucwords(str_replace("_"," ",$each_type))." ".$banner_size;
            $valueArray[] = $each_value;

        }

        $typeDropDown = html_selectBox("search_type", $nameArray, $valueArray, $search_type, "", "", system_showText(LANG_LABEL_SELECT_TYPE));

        unset($bannerObj);
        
        $nameArray  = array();
        $valueArray = array();
        if ($search_section) {
            if ($search_section == "general") {
                $categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\" disabled", "", system_showText(LANG_LABEL_SELECT_ALLPAGESBUTITEMPAGES));
            } elseif ($search_section == "global") {
                $categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\" disabled", "", system_showText(LANG_LABEL_SELECT_ALLPAGES));
            } else {
                if ($search_section == "listing" || $search_section == "promotion") $tableCategory = "listingcategory";
                elseif ($search_section == "event") $tableCategory = "eventcategory";
                elseif ($search_section == "classified") $tableCategory = "classifiedcategory";
                elseif ($search_section == "article") $tableCategory = "articlecategory";
                elseif ($search_section == "blog") $tableCategory = "blogcategory";
                $categories = db_getFromDB($tableCategory, "category_id", null, "all", $orderby, "object", SELECTED_DOMAIN_ID);
                if ($categories) {
                    foreach ($categories as $category) {
                        if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
                            $valueArray[]  = "";
                            $nameArray[]   = "--------------------------------------------------";
                        }
                        $valueArray[]  = $category->getNumber("id");
                        $nameArray[]   = $category->getString("title");
                        if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
                            $subcategories = db_getFromDB($tableCategory, "category_id", $category->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                            if ($subcategories) {
                                foreach ($subcategories as $subcategory) {
                                    $valueArray[] = $subcategory->getNumber("id");
                                    $nameArray[]  = "- ".$subcategory->getString("title");
                                    $subcategories2 = db_getFromDB($tableCategory, "category_id", $subcategory->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                    if ($subcategories2) {
                                        foreach ($subcategories2 as $subcategory2) {
                                            $valueArray[] = $subcategory2->getNumber("id");
                                            $nameArray[]  = "&nbsp;- ".$subcategory2->getString("title");
                                            $subcategories3 = db_getFromDB($tableCategory, "category_id", $subcategory2->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                            if ($subcategories3) {
                                                foreach ($subcategories3 as $subcategory3) {
                                                    $valueArray[] = $subcategory3->getNumber("id");
                                                    $nameArray[]  = "&nbsp;&nbsp;- ".$subcategory3->getString("title");
                                                    $subcategories4 = db_getFromDB($tableCategory, "category_id", $subcategory3->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                                    if ($subcategories4) {
                                                        foreach ($subcategories4 as $subcategory4) {
                                                            $valueArray[] = $subcategory4->getNumber("id");
                                                            $nameArray[]  = "&nbsp;&nbsp;&nbsp;- ".$subcategory4->getString("title");
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\"", "", system_showText(LANG_SITEMGR_LABEL_NONCATEGORYSEARCH));
        
    }
    
    //Account
    $accountDropDown = "<input type=\"text\" class=\"form-control mail-select\" name=\"search_account_id\" id=\search_account_id\" placeholder=\"".LANG_LABEL_ACCOUNT."\" value=\"".$search_account_id."\">";
    system_generateAccountDropdown($auxAccountSelectize);
    
    if ($manageModule == "listing" || $manageModule == "classified" || $manageModule == "event") {
        //Location
        $_non_default_locations = "";
        $_default_locations_info = "";
        if (EDIR_DEFAULT_LOCATIONS) {

            system_retrieveLocationsInfo ($_non_default_locations, $_default_locations_info);

            $last_default_location	  =	$_default_locations_info[count($_default_locations_info)-1]['type'];
            $last_default_location_id = $_default_locations_info[count($_default_locations_info)-1]['id'];

            if ($_non_default_locations) {
                $objLocationLabel = "Location".$_non_default_locations[0];
                ${"Location".$_non_default_locations[0]} = new $objLocationLabel;
                ${"Location".$_non_default_locations[0]}->SetString("location_".$last_default_location, $last_default_location_id);
                ${"locations".$_non_default_locations[0]} = ${"Location".$_non_default_locations[0]}->retrieveLocationByLocation($last_default_location);
            }

        } else {
            $_non_default_locations = explode(",", EDIR_LOCATIONS);
            $objLocationLabel = "Location".$_non_default_locations[0];
            ${"Location".$_non_default_locations[0]} = new $objLocationLabel;
            ${"locations".$_non_default_locations[0]}  = ${"Location".$_non_default_locations[0]}->retrieveAllLocation();
        }

        $stop_search_locations = false;
        //if there is at least one non default location
        if ($_non_default_locations) {
            foreach($_non_default_locations as $_location_level) {
                if ($_GET["search_location_".$_location_level]) {
                    ${"location_".$_location_level} = $_GET["search_location_".$_location_level];
                } else {
                    $stop_search_locations = true;
                }
                system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
                if (${"location_".$_location_level} && $_location_child_level) {
                    if (!$stop_search_locations) {
                        $objLocationLabel = "Location".$_location_child_level;
                        ${"Location".$_location_child_level} = new $objLocationLabel;
                        ${"Location".$_location_child_level}->SetString("location_".$_location_level, ${"search_location_".$_location_level});
                        ${"locations".$_location_child_level} = ${"Location".$_location_child_level}->retrieveLocationByLocation($_location_level);
                    } else {
                        ${"locations".$_location_child_level} = "";
                    }
                } else {
                    $stop_search_locations = true;
                }
            }
            unset ($_location_father_level);
            unset ($_location_child_level);
            unset ($_location_level);
        }
    }
    
    if ($manageModule == "listing") {
        //Listing type
        $listingTemplates = db_getFromDB("listingtemplate", "", 0, "all", "editable, title", "object", SELECTED_DOMAIN_ID);
        $listingTemplateDropDown = "<select name=\"search_listingtemplate_id\">";
        $listingTemplateDropDown .= "<option value=\"\"> ".system_showText(LANG_SITEMGR_LABEL_SELECT_LISTINGTEMPLATE)." </option>";
        $listingTemplateDropDown .= "<option value=\"D\"".(($search_listingtemplate_id == "D") ? " selected" : "").">".system_showText(LANG_SITEMGR_DEFAULT)."</option>";
        if ($listingTemplates) {
            foreach ($listingTemplates as $each_template) {
                $listingtemplate = new ListingTemplate($rowLT["id"]);
                $listingTemplateDropDown .= "<option value=\"".$each_template->getNumber("id")."\"";
                if ($search_listingtemplate_id == $each_template->getNumber("id"))
                    $listingTemplateDropDown .= " selected";
                $listingTemplateDropDown .= ">".$each_template->getString("title")."</option>";
            }
        }
        $listingTemplateDropDown .= "</select>";
    }
?>

    <div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="modal-search" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=system_showText(LANG_CLOSE);?></span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_SEARCH_ADVANCEDSEARCH)?></h4>
                </div>
                
                <form name="search" id="search" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
                    <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="search_title"><?=string_ucwords(system_showText(LANG_LABEL_SEARCHKEYWORD))?></label>
                                    <input type="text" class="form-control" id="search_title" name="search_title" value="<?=$search_title?>">
                                </div>
                                
                                <? if ($manageModule == "listing" && LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") { ?>
                                 <div class="col-sm-6">
                                    <label><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING_LISTINGTEMPLATE))?></label>
                                    <div class="selectize">
                                        <?=$listingTemplateDropDown?>
                                    </div>
                                </div>
                                <? } ?>
                                
                                <? if ($manageModule == "promotion") { ?>
                                <div class="col-sm-6">
                                    <label><?=system_showText(LANG_LABEL_ACCOUNT)?></label>
                                    <div class="selectize">
                                        <?=$accountDropDown;?>
                                    </div>
                                </div>
                                <? } ?>
                                                                
                                <? if ($manageModule == "banner") { ?>
                                <div class="col-sm-6">
                                    <label><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_TYPE))?></label>
                                    <div class="selectize">
                                        <?=$typeDropDown?>
                                    </div>
                                </div>
                                <? } ?>
                                
                            </div>
                        
                            <? if ($manageModule == "banner") { ?>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_SECTION))?>
                                </div>
                                <div class="col-sm-12">
                                    
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="search_section" value="global" <? if ($search_section == "global") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=system_showText(LANG_SITEMGR_BANNER_GLOBAL)?>
                                        </label>
                                    </div>
                                    
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="search_section" value="general" <? if ($search_section == "general") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=system_showText(LANG_SITEMGR_LABEL_GENERALPAGES)?>
                                        </label>
                                    </div>
                                    
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="search_section" value="listing" <? if ($search_section == "listing") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?>
                                        </label>
                                    </div>
                                    
                                    <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") { ?>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_section" value="promotion" <? if ($search_section == "promotion") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION))?>
                                            </label>
                                        </div>
                                    <? } ?>

                                    <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_section" value="event" <? if ($search_section == "event") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=string_ucwords(system_showText(LANG_SITEMGR_EVENT))?>
                                            </label>
                                        </div>
                                    <? } ?>

                                    <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_section" value="classified" <? if ($search_section == "classified") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))?>
                                            </label>
                                        </div>
                                    <? } ?>

                                    <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_section" value="article" <? if ($search_section == "article") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE))?>
                                            </label>
                                        </div>
                                    <? } ?>

                                    <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_section" value="blog" <? if ($search_section == "blog") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form, <?=SELECTED_DOMAIN_ID?>, 'search');"><?=string_ucwords(system_showText(LANG_SITEMGR_BLOG))?>
                                            </label>
                                        </div>
                                    <? } ?>
                                    
                                </div>
                            </div>
                            <? } ?>

                            <? if ($manageModule != "promotion" && $manageModule != "article" && $manageModule != "blog" && $manageModule != "banner") { ?>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVEL))?>
                                </div>
                                <div class="col-sm-12">
                                    <?
                                    $levelvalues = $level->getLevelValues();
                                    foreach ($levelvalues as $levelvalue) {
                                        ?>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_level" value="<?=$levelvalue?>" <? if ($search_level == $levelvalue) echo "checked"; ?>>
                                                <?=$level->showLevel($levelvalue)?>
                                            </label>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>
                            <? } ?>

                            <div class="row form-group">
                                <? if ($manageModule != "blog" && $manageModule != "promotion") { ?>
                                <div class="col-sm-4">
                                    <label><?=system_showText(LANG_LABEL_ACCOUNT)?></label>
                                    <div class="selectize">
                                        <?=$accountDropDown;?>
                                    </div>
                                </div>
                                <? } ?>
                                <? if ($manageModule != "promotion") { ?>
                                <div class="col-sm-4">
                                    <label><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></label>
                                    <div class="<?=($manageModule != "banner" ? "selectize" : "select-special")?>">
                                        <?=$categoryDropDown?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label> <?=system_showText(LANG_SITEMGR_STATUS)?></label>
                                    <div class="selectize">
                                        <?=$statusDropDown?>
                                    </div>
                                </div>
                                <? } ?>
                            </div>
                        
                                                    
                            <? if ($manageModule == "event") { ?>
                            <div class="form-group">
                                <label for="search_date_period1">
                                    <?=system_showText(LANG_SITEMGR_LABEL_DATERANGE)?>
                                </label>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control date-input" name="search_date_period1" id="search_date_period1" value="<?=$search_date_period1?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_FROM)?>" maxlength="10">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control date-input" name="search_date_period2" id="search_date_period2" value="<?=$search_date_period2?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_TO2)?>" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <? } ?>

                            <? if (PAYMENTSYSTEM_FEATURE == "on" && $manageModule != "promotion"  && $manageModule != "blog") { ?>
                            <div class="form-group">
                                <label for="search_expiration_date">
                                    <?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION)?>
                                </label>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control date-input" name="search_expiration_date" id="search_expiration_date" value="<?=$search_expiration_date?>" maxlength="10">
                                    </div>
                                    <div class="col-sm-7 form-horizontal">
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_opt_expiration_date" value="1" <?php if (!isset($search_opt_expiration_date) || intval($search_opt_expiration_date) == 1) { echo "checked"; } ?>>
                                                <?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT1)?>
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="search_opt_expiration_date" value="2" <?php if (intval($search_opt_expiration_date) == 2) { echo "checked"; } ?>>
                                                <?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT2)?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label for="dicount-code"><?=string_ucwords(LANG_LABEL_DISCOUNTCODE)?></label>
                                <input type="text" id="dicount-code" class="form-control" name="search_discount" value="<?=$search_discount?>" maxlength="10">
                            </div>
                                
                            <? } else if ($manageModule != "promotion" && $manageModule != "blog") {
                                echo "<input type=\"hidden\" name=\"search_expiration_date\""; 
                            }
                        
                            if ($manageModule == "listing" || $manageModule == "classified" || $manageModule == "event") {
                            $contact = true;
                            $sitemgrSearch = true;
                            include(EDIRECTORY_ROOT."/includes/code/load_location.php");
                            
                            ?>
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="search_zipcode"><?=string_ucwords(ZIPCODE_LABEL)?></label>
                                    <input type="text" id="search_zipcode" class="form-control" name="search_zipcode" value="<?=$search_zipcode?>" maxlength="10">
                                </div>
                            </div>

                            <? } ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL);?></button>
                        <button type="submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
                    </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->