<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/content/listing-types/index.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# VALIDATE FEATURE
# ----------------------------------------------------------------------------------------------------
if (LISTINGTEMPLATE_FEATURE != "on" || CUSTOM_LISTINGTEMPLATE_FEATURE != "on") { exit; }

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();

extract($_GET);
extract($_POST);

$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (validate_listingtemplate($_POST, $message_listingtemplate)) {

        $listingtemplate = new ListingTemplate($_POST);
        $listingtemplate->save();

        $template_id = $listingtemplate->getNumber("id");
        $listingtemplate->clearListingTemplateFields();

        $show_order = 0;
        foreach ($label as $fieldname=>$labelname) {
            if (trim($labelname)) {
                $ltf["field"] = $fieldname;
                $ltf["label"] = $labelname;
                unset($aux_fieldvalues);
                if ($fieldvalues[$fieldname]) {
                    $auxfieldvalues = explode("\n", $fieldvalues[$fieldname]);
                    foreach ($auxfieldvalues as $fieldvalue) {
                        $fieldvalue = str_replace("\n", "", $fieldvalue);
                        $fieldvalue = str_replace("\r", "", $fieldvalue);
                        if (trim($fieldvalue)) {
                            $aux_fieldvalues[] = $fieldvalue;
                        }
                    }
                }
                if ($aux_fieldvalues) $ltf["fieldvalues"] = implode(",", $aux_fieldvalues);
                else $ltf["fieldvalues"] = "";
                $ltf["instructions"] = $instructions[$fieldname];
                $ltf["required"] = $required[$fieldname];
                $ltf["search"] = $search[$fieldname];
                $ltf["searchbykeyword"] = $searchbykeyword[$fieldname];
                $ltf["searchbyrange"] = $searchbyrange[$fieldname];
                $ltf["show_order"] = $show_order;
                $listingtemplate->addListingTemplateField($ltf);
                $show_order++;
            }
        }

        // setting categories
        $return_categories_array = explode(",", $return_categories);
        $listingtemplate->setCategories($return_categories_array); // MUST BE ALWAYS AFTER $LISTINGTEMPLATEOBJECT->SAVE();

        if ($id) $message = 7;
        else $message = 8;

        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/listing-types/index.php?message=".urlencode($message)."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
        exit;

    }

    // removing slashes added if required
    $_POST = format_magicQuotes($_POST);
    $_GET  = format_magicQuotes($_GET);
    extract($_POST);
    extract($_GET);

}

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------

if ($id) {
    $listingtemplate = new ListingTemplate($id);
    $listingtemplate->extract();
    $template_fields = $listingtemplate->getListingTemplateFields();
    if ($template_fields) {
        foreach ($template_fields as $template_field) {
            $label[$template_field["field"]] = $template_field["label"];
            $fieldvalues[$template_field["field"]] = str_replace(",", "\n", $template_field["fieldvalues"]);
            $instructions[$template_field["field"]] = $template_field["instructions"];
            $required[$template_field["field"]] = $template_field["required"];
            $search[$template_field["field"]] = $template_field["search"];
            $searchbykeyword[$template_field["field"]] = $template_field["searchbykeyword"];
            $searchbyrange[$template_field["field"]] = $template_field["searchbyrange"];
        }
    }
}

$categories = "";
$selectizeCategs = array();
$selectizeCategsIndex = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($return_categories) {
        $return_categories_array = explode(",", $return_categories);
        foreach ($return_categories_array as $each_category) {
            $categories[] = new ListingCategory($each_category);
        }
    }
} else {
    if (!$categories) if ($listingtemplate) $categories = $listingtemplate->getCategories();
}
if ($categories) {
    for ($i=0; $i<count($categories); $i++) {
        $arr_category[$i]["name"] = $categories[$i]->getString("title");
        $arr_category[$i]["value"] = $categories[$i]->getNumber("id");
        $arr_return_categories[] = $categories[$i]->getNumber("id");
    }
    if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
    array_multisort($arr_category);
    $feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
    if ($arr_category) foreach ($arr_category as $each_category) {
        $feedDropDown .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
        $selectizeCategs[$selectizeCategsIndex]["value"] = $each_category["value"];
        $selectizeCategs[$selectizeCategsIndex]["name"] = $each_category["name"];
        $selectizeCategsIndex++;
    }
    $feedDropDown .= "</select>";
} else {
    if ($return_categories) {
        $return_categories_array = explode(",", $return_categories);
        if ($return_categories_array) {
            foreach ($return_categories_array as $each_category) {
                $categories[] = new ListingCategory($each_category);
            }
        }
    }
    $feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
    if ($categories) {
        foreach ($categories as $category) {
            $name = $category->getString("title");
            $feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
            $selectizeCategs[$selectizeCategsIndex]["value"] = $category->getNumber( "id" );
            $selectizeCategs[$selectizeCategsIndex]["name"] = $name;
            $selectizeCategsIndex++;
        }
    }
    $feedDropDown .= "</select>";
}

$count_customcheckbox = 0;
$count_customdropdown = 0;
$count_customtext = 0;
$count_customshortdesc = 0;
$count_customlongdesc = 0;
$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbObjCustom = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$sqlCustom = "DESC Listing";
$resultCustom = $dbObjCustom->query($sqlCustom);
while ($rowCustom = mysql_fetch_assoc($resultCustom)) {
    if (string_strpos($rowCustom["Field"], "custom_checkbox") !== false) {
        $count_customcheckbox++;
    } elseif (string_strpos($rowCustom["Field"], "custom_dropdown") !== false) {
        $count_customdropdown++;
    } elseif (string_strpos($rowCustom["Field"], "custom_text") !== false) {
        $count_customtext++;
    } elseif (string_strpos($rowCustom["Field"], "custom_short_desc") !== false) {
        $count_customshortdesc++;
    } elseif (string_strpos($rowCustom["Field"], "custom_long_desc") !== false) {
        $count_customlongdesc++;
    }
}

extract($_POST);
extract($_GET);

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT."/layout/header.php");

# ----------------------------------------------------------------------------------------------------
# NAVBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

# ----------------------------------------------------------------------------------------------------
# SIDEBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT."/layout/sidebar-content.php");

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

        unset($domainObj);
        $domainObj = new Domain(SELECTED_DOMAIN_ID);

        $registeredDomain = $domainObj->getString("url");
        $registeredDomainID = SELECTED_DOMAIN_ID;
        if ((IAMOK == "iamok") || (!isTORSBRDB())) {
            $isregisteredBin = exec(BIN_PATH."/".BIN_SERVERTYPE."/reg.bin validation null ".$registeredDomain." ".VERSION." null isregistered", $execreturn);
        } else {
            $isregisteredBin = isRegistered($registeredDomain,$registeredDomainID);
        }
        if ($isregisteredBin) {
            if ((IAMOK == "iamok") || (!isTORSBRDB())) {
                eval(exec(BIN_PATH."/".BIN_SERVERTYPE."/reg.bin validation null ".$registeredDomain." ".VERSION." null checktemplate", $execreturn));
            } else {
                if ((LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") && isRegistered($registeredDomain,$registeredDomainID) && ($edirectory_registration_file == "yes") && ($edirectory_registration_aux == md5("499bb0ce1391c3d8497d79097726bfa7".session_id())) && ($edirectory_checkregistration_file == "yes") && ($edirectory_checkregistration_aux == md5("217413e28563be686aa871241300624a".session_id()))) { $checkTemplateBin = true; }
            }
            if ($checkTemplateBin) {
                ?>

                <form role="form" id="listingtemplate" name="listingtemplate" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="POST">

                    <input type="hidden" name="id" value="<?=$id?>" />

                    <section class="row heading">
                        <div class="container">
                            <? if ($id) { ?>
                                <h1><?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))." ".system_showText(LANG_SITEMGR_LISTING_LISTINGTEMPLATE)?> <i><?=$listingtemplate->getString("title")?></i></h1>
                            <? } else { ?>
                                <h1><?=string_ucwords(system_showText(LANG_SITEMGR_ADD))." ".system_showText(LANG_SITEMGR_LISTING_LISTINGTEMPLATE)?></h1>
                            <? } ?>
                        </div>

                        <? if ($message_listingtemplate) { ?>
                            <div class="container alert alert-warning" role="alert">
                                <p><?=$message_listingtemplate;?></p>
                            </div>
                        <? } ?>
                    </section>

                    <section class="row">
                        <div class="container">
                            <? include(INCLUDES_DIR."/forms/form-listingtype.php"); ?>
                        </div>
                    </section>

                    <section class="row footer-action">
                        <div class="container">
                            <div class="col-xs-12 text-right">
                                <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/listing-types/"?>" class="btn btn-default btn-xs"><?=system_showText(LANG_CANCEL)?></a>
                                <span class="separator"> <?=system_showText(LANG_OR)?> </span>
                                <button type="button" name="submit_button" value="Submit" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                            </div>
                        </div>
                    </section>

                </form>

                <?
            } else {
                ?><p class="alert alert-danger"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ACTIVATIONISREQUIRED)?></p><?
            }
        } else {
            ?><p class="alert alert-danger"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ACTIVATIONISREQUIRED)?></p><?
        }
        ?>

    </main>

<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
include(SM_EDIRECTORY_ROOT."/layout/footer.php");
