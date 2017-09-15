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
if (LISTINGTEMPLATE_FEATURE != "on" || CUSTOM_LISTINGTEMPLATE_FEATURE != "on") {
    header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");
    exit;
}

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();

$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/content/listing-types";
$url_base     = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
extract($_POST);
extract($_GET);

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == "delete") {
    $listingtemplate = new ListingTemplate($_POST['id']);
    if ($listingtemplate->getString("editable") == "y") {
        $listingtemplate->delete();
    }
    $message = 9;
    header("Location: ".$url_redirect."/index.php?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
    exit;
}
// Page Browsing /////////////////////////////////////////
$pageObj = new pageBrowsing("ListingTemplate", $screen, false, "editable, title", "title", $letter);
$listingtemplates = $pageObj->retrievePage();

$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/listingtemplate/index.php";

// Letters Menu
$letters = $pageObj->getString("letters");
foreach($letters as $each_letter)
    if ($each_letter == "#") {
        $letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
    } else {
        $letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
    }

# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
# --------------------------------------------------------------------------------------------------------------


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
        ?>

        <section class="heading">
            <h1><?=string_ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_PLURAL))?></h1>
            <p><?=str_replace("[a]", "", str_replace("[/a]", "", system_showText(LANG_SELECT_LISTINGTEMPLATE_TIP)))?></p>
            <? if (is_numeric($message) && isset($msg_listing[$message])) { ?>
                <p class="alert alert-success"><?=$msg_listing[$message]?></p>
            <? } ?>
        </section>

        <?
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
                <div class="row">
                    <section class="form-thumbnails">
                        <div class="row">

                            <? if ($listingtemplates) {
                                include(INCLUDES_DIR."/lists/list-listingtypes.php");
                            } ?>

                            <div class="col-md-2 col-xs-6">
                                <a class="thumbnail add-new" href="<?=$url_redirect?>/type.php">
                                    <i class="icon-cross8"></i>
                                    <div class="caption">
                                        <h6><?=system_showText(LANG_SITEMGR_LISTING_LISTINGTEMPLATE_ADD);?></h6>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </section>
                </div>
                <?
            } else {
                ?><p class="alert alert-danger"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ACTIVATIONISREQUIRED)?></p><?
            }
        } else {
            ?><p class="alert alert-danger"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ACTIVATIONISREQUIRED)?></p><?
        }
        ?>
    </main>

<? include(INCLUDES_DIR."/modals/modal-delete.php"); ?>

<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT."/layout/footer.php");
