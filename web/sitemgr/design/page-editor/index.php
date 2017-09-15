<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/design/page-editor/index.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------

include("../../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$container = SymfonyCore::getContainer();
$wysiwygService = $container->get('wysiwyg.service');

$translator = $container->get("translator");
setting_get("sitemgr_language", $sitemgr_language);
$sitemgrLanguage = substr($sitemgr_language, 0, 2);

# ----------------------------------------------------------------------------------------------------
# DELETE
# ----------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Delete item
    if ($_POST['action'] == "delete") {
        $wysiwygService->deletePage($_POST['id']);
        $deletedMessage = LANG_SITEMGR_PAGE_DELETED;
    }
}

// Get All pages
$pages = $wysiwygService->getAllPages();

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
include(SM_EDIRECTORY_ROOT."/layout/sidebar-design.php");

?>

<main class="wrapper togglesidebar container-fluid wysiwyg">

    <?php
    require(SM_EDIRECTORY_ROOT."/registration.php");
    require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
    require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
    ?>

    <section class="heading">

        <?php if ($deletedMessage) { ?>
            <p class="alert alert-success">
                <?php echo $deletedMessage ?>
            </p>
        <?php } ?>

        <?php if ($_GET['error']) { ?>
            <p class="alert alert-danger">
                <?php
                switch ($_GET['error']) {
                    case 1:
                        echo LANG_SITEMGR_PAGE_BUILDER_NOTFOUND;
                        break;
                }
                ?>
            </p>
        <?php } ?>

        <div class="pull-right">
            <a class="btn btn-primary btn-lg addNewPageButton"
               href="#"><?= system_showText(LANG_SITEMGR_PAGE_ADD) ?></a>
        </div>
        <h1>
            <?= system_showText(LANG_SITEMGR_PAGE_EDITOR) ?>
        </h1>
        <p><?= system_showText(LANG_SITEMGR_PAGE_EDITOR_TIP); ?></p>
    </section>

    <section class="form-thumbnails">
        <div class="row p-editor">
            <?php
            /* @var $page \ArcaSolutions\WysiwygBundle\Entity\Page */
            if ($pages) {
                foreach ($pages as $page) { ?>
                    <div class="col-xg-5 col-md-3 col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <div class="caption">
                                <?php if ($page->getPageType()->getTitle() == \ArcaSolutions\WysiwygBundle\Services\Wysiwyg::CUSTOM_PAGE) { ?>
                                    <div class="dropdown">
                                        <button class="btn btn-default" type="button" data-toggle="modal"
                                                data-target="#modal-delete"
                                                onclick="$('#delete-id').val(<?= $page->getId(); ?>); $('#item-type').val('page')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php } ?>
                                <h4><?= /** @Ignore */
                                    $translator->trans($page->getTitle(), [], 'widgets', /** @Ignore */
                                        $sitemgrLanguage) ?></h4>
                                <a class="btn btn-primary"
                                   href="custom.php?id=<?= $page->getId() ?>"><?= system_showText(LANG_SITEMGR_EDIT) ?></a>
                                <? if (!in_array($page->getPageType()->getTitle(),
                                        $wysiwygService->pageViewNotAllowed) or $page->getPageType()->getTitle() == \ArcaSolutions\WysiwygBundle\Services\Wysiwyg::HOME_PAGE
                                ) {
                                    ?>
                                    <a class="btn btn-default" target="_blank"
                                       href="<?= $wysiwygService->getFinalPageUrl($page) ?>"><?= system_showText(LANG_SITEMGR_VIEW) ?></a>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
            <div class="col-xg-5 col-md-3 col-sm-6 col-xs-12">
                <a class="thumbnail add-new addNewPageButton" href="#">
                    <div class="caption">
                        <h6><i class="fa fa-plus-circle"
                               aria-hidden="true"></i> <?= system_showText(LANG_SITEMGR_PAGE_ADD) ?></h6>
                    </div>
                </a>
            </div>

        </div>
    </section>

</main>

<?php

include(INCLUDES_DIR."/modals/modal-delete.php");

# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/pages.php";

include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
