<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-bulkupdate.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$bulkType = $manageModule;

	// Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i = 0; $i < count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}

	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, "", "", "class='input-dd-form-search$bulkType'", system_showText(LANG_SITEMGR_CHANGESTATUS));

    // Level Drop Down
	if ( in_array($bulkType, ["listing", "event", "classified"]) ) {
        $objLevelType = ucfirst($bulkType)."Level";
        $LevelObj = new $objLevelType(true);
        unset($levelStatus);
        foreach ($LevelObj->value as $k => $value) {
            if ($LevelObj->getActive($value) == "y") {
                $arrayNameLL[] = ucfirst($LevelObj->name[$k]);
                $arrayValueLL[] = $value;
            }
        }
        $levelDropDown = html_selectBox("level", $arrayNameLL, $arrayValueLL, "", "", "class='input-dd-form-search$bulkType'", system_showText(LANG_SITEMGR_CHANGELEVEL));

	}

    //Account Drop Down
    if ( !in_array($bulkType, ["blog", "review", "nearbySearch"]) ) {
        $accountDropDown = "<input type=\"text\" class=\"form-control mail-select\" name=\"change_account_id\" id=\change_account_id\" placeholder=\"".LANG_SITEMGR_CHANGE_ACC."\">";
        system_generateAccountDropdown($auxAccountSelectize);
    }

    //Category Drop Down
	if ( !in_array($bulkType, ["review", "banner", "promotion", "nearbySearch"]) ) {
        $fields = "`id`, `title`";
        $orderby = "`title`";

        $item_scalability = @constant(strtoupper($bulkType)."CATEGORY_SCALABILITY_OPTIMIZATION");
        $hideCategTree = false;
        if ($item_scalability == "on"){
            $hideCategTree = true;
        }

        if (!$hideCategTree){
            if ($bulkType == "listing") {

                $fields = array("id", "title");

                $nameArray  = array();
                $valueArray = array();
                $valueCatArray = array();
                $str_cats = "";
                $resultArray = db_loadCategoriesDropdown("ListingCategory", $fields, null, 1, "off", SELECTED_DOMAIN_ID, $str_cats, $orderby);
                $str_cats = string_substr($str_cats, 0, -1);

                $valueArray = $resultArray["values"];
                $nameArray = $resultArray["names"];

                $valueCatArray = explode(",",$str_cats);

            } else {

                $categories = db_getFromDB($bulkType."category", "category_id", null, "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                $nameArray  = array();
                $valueArray = array();
                $nameCatArray = array();
                $valueCatArray = array();
                if ($categories) {
                    foreach ($categories as $category) {
                        $valueArray[] = $category->getNumber("id");
                        $nameArray[] = $category->getString("title");
                        if ($item_scalability != "on") {
                            $subcategories = db_getFromDB($bulkType."category", "category_id", $category->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                            if ($subcategories) {
                                foreach ($subcategories as $subcategory) {
                                    $valueArray[] = $subcategory->getNumber("id");
                                    $nameArray[] = $subcategory->getString("title");
                                    $subcategories2 = db_getFromDB($bulkType."category", "category_id", $subcategory->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                    if ($subcategories2) {
                                        foreach ($subcategories2 as $subcategory2) {
                                            $valueArray[] = $subcategory2->getNumber("id");
                                            $nameArray[] = $subcategory2->getString("title");
                                            $subcategories3 = db_getFromDB($bulkType."category", "category_id", $subcategory2->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                            if ($subcategories3) {
                                                foreach ($subcategories3 as $subcategory3) {
                                                    $valueArray[] = $subcategory3->getNumber("id");
                                                    $nameArray[] = $subcategory3->getString("title");
                                                    $subcategories4 = db_getFromDB($bulkType."category", "category_id", $subcategory3->getNumber("id"), "all", $orderby, "object", SELECTED_DOMAIN_ID, false, $fields);
                                                    if ($subcategories4) {
                                                        foreach ($subcategories4 as $subcategory4) {
                                                            $valueArray[] = $subcategory4->getNumber("id");
                                                            $nameArray[] = $subcategory4->getString("title");
                                                            $nameCatArray[] = $subcategory4->getString("title");
                                                            $valueCatArray[] = $subcategory4->getNumber("id");
                                                        }
                                                    } else {
                                                        $nameCatArray[] = $subcategory3->getString("title");
                                                        $valueCatArray[] = $subcategory3->getNumber("id");
                                                    }
                                                }
                                            } else {
                                                $nameCatArray[] = $subcategory2->getString("title");
                                                $valueCatArray[] = $subcategory2->getNumber("id");
                                            }
                                        }
                                    } else {
                                        $nameCatArray[] = $subcategory->getString("title");
                                        $valueCatArray[] = $subcategory->getNumber("id");
                                    }
                                }
                            } else {
                                $nameCatArray[] = $category->getString("title");
                                $valueCatArray[] = $category->getNumber("id");
                            }
                        }
                    }
                }

            }
            $categoryDropDown = html_selectBox_BulkUpdate("add_category_id", $nameArray, $valueArray, "", "", "", system_showText(LANG_SITEMGR_LANG_SITEMGR_ADDCATEGORY), $valueCatArray);
		}
	}
?>

    <form class="bulkupdate" name="form-bulk" id="form-bulk" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

        <input type="hidden" name="account_search_bulk" id="account_search_bulk" value="">
        <input type="hidden" name="level_bulk" id="level_bulk" value="">
        <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="">
        <input type="hidden" name="bulkListType" id="bulkListType" value="<?=$bulkType?>">
        <input type="hidden" name="delete_all" id="delete_all" value="">

        <? if ($bulkType == "nearbySearch") { ?>
        <input type="hidden" name="action" id="action" value="">
        <input type="hidden" name="latitude" id="latitude" value="">
        <input type="hidden" name="longitude" id="longitude" value="">
        <input type="hidden" name="radius" id="radius" value="">
        <? } ?>

		<div class="bulk-check-all">
			<label class="sr-only"><?=system_showText(LANG_SITEMGR_CHECKALL);?></label>
			<input type="checkbox" id="uncheck-all">
		</div>

		<? if (!in_array($bulkType, ["review", "article", "promotion", "blog", "banner", "nearbySearch"]) ) { ?>
			<div class="col-md-2 col-xs-3 visible-lg">
				<label class="sr-only" for="level"><?=system_showText(LANG_SITEMGR_CHANGELEVEL)?></label>
				<div class="selectize"><?=$levelDropDown?></div>
			</div>
		<? } ?>

		<? if (!in_array($bulkType, ["review", "promotion", "nearbySearch"])) { ?>
			<div class="col-md-2 col-xs-3 visible-lg">
				<label class="sr-only" for="status"><?=system_showText(LANG_SITEMGR_CHANGESTATUS)?>:</label>
				<div class="selectize">
					<?=$statusDropDown?>
				</div>
			</div>
		<? } ?>

        <? if ($bulkType == "review") { ?>
            <input type="hidden" name="approved" id="approved" value="1" class="form-control date-input"/>
        <? } ?>

		<? if ( !in_array($bulkType, ["review", "blog", "promotion", "nearbySearch"]) ) { ?>
			<div class="col-md-2 col-xs-3 visible-lg">
				<label class="sr-only" for="change_renewaldate"><?=system_showText(LANG_SITEMGR_CHANGEEXPIRATIONDATE)?>:</label>
				<input type="text" name="change_renewaldate" id="change_renewaldate" value="" class="form-control date-input" placeholder="<?=system_showText(LANG_SITEMGR_CHANGEEXPIRATIONDATE)?>"/>
			</div>
		<? } ?>

        <? if ( !in_array($bulkType, ["review", "banner", "promotion", "nearbySearch"]) && !$hideCategTree) { ?>
            <div class="col-md-2 col-xs-3 visible-lg">
                <label class="sr-only"><?=string_ucwords(system_showText($bulkType == "banner" ? LANG_SITEMGR_CATEGORY : LANG_SITEMGR_LANG_SITEMGR_ADDCATEGORY))?>:</label>
                <div class="selectize">
                    <?=$categoryDropDown?>
                </div>
            </div>
        <? } ?>

		<? if ( !in_array($bulkType, ["blog", "review", "nearbySearch"]) ) { ?>
	    <div class="col-md-2 col-xs-3 visible-lg">
	    	<label class="sr-only"><?=system_showText(LANG_SITEMGR_CHANGE_ACC);?></label>
	    	<div class="selectize">
	    		<?=$accountDropDown;?>
	    	</div>
	    </div>
	    <? } ?>

		<div class="bulk-buttons">
            <? if ( !in_array($bulkType, ["nearbySearch"]) ) { ?>
            <a data-toggle="modal" data-target="#modal-bulk" href="#" class="btn btn-primary btn-sm btn-icon btn-tip btn-visible-lg" data-placement="bottom" title="<?=system_showText($bulkType == "review"? LANG_SITEMGR_APPROVE_ALL : LANG_SITEMGR_UPDATE_ALL)?>" onclick="confirmBulk('update');"><i class="icon-ion-ios7-checkmark-outline"></i></a>
	    	<? } ?>
            <a data-toggle="modal" data-target="#modal-bulk" href="#" class="btn btn-warning btn-sm btn-icon btn-tip" data-placement="bottom" title="<?=system_showText(LANG_SITEMGR_DELETE_ALL)?>" onclick="confirmBulk('delete'); $('#delete_all').attr('value', 'on');"><i class="icon-waste2"></i></a>
   		</div>

	</form>
