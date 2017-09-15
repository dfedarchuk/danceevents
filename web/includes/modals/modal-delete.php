<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-delete.php
	# ----------------------------------------------------------------------------------------------------

    //Modal section
    if (string_strpos($_SERVER["PHP_SELF"], "/account/sponsor") !== false || string_strpos($_SERVER["PHP_SELF"], "/account/visitor") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DEL_ACC);
        $modalMessage = system_showText(LANG_SITEMGR_ACCOUNT_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/account/manager") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_SMACCOUNT_DELETESITEMGRACCOUNT);
        $modalMessage = system_showText(LANG_SITEMGR_SMACCOUNT_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/sites") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE_SITE);
        $modalMessage = system_showText(LANG_SITEMGR_DOMAIN_DELETEQUESTION)."<br>".system_showText(LANG_SITEMGR_DOMAIN_DELETEQUESTION2);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".LISTING_FEATURE_FOLDER."/index.php") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_LISTING_SING);
        $modalMessage = system_showText(LANG_SITEMGR_LISTING_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/categories/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_CATEGORY_DELETECATEGORY);
        $modalMessage = system_showText(LANG_SITEMGR_CATEGORY_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".EVENT_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_EVENT_SING);
        $modalMessage = system_showText(LANG_SITEMGR_EVENT_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".CLASSIFIED_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_CLASSIFIED_SING);
        $modalMessage = system_showText(LANG_SITEMGR_CLASSIFIED_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".ARTICLE_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_ARTICLE_SING);
        $modalMessage = system_showText(LANG_SITEMGR_ARTICLE_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".BANNER_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_BANNER_SING);
        $modalMessage = system_showText(LANG_SITEMGR_BANNER_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".PROMOTION_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_PROMOTION_SING);
        $modalMessage = system_showText(LANG_SITEMGR_PROMOTION_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/content/".BLOG_FEATURE_FOLDER) !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_BLOG_SING);
        $modalMessage = system_showText(LANG_SITEMGR_POST_DELETEQUESTION);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/mobile/notifications/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_MOBILE_NOTIF_SING);
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/transactions/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_TRANSACTION);
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/invoices/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_INVOICE);
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/custominvoices/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_CUSTOMINVOICE);
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/promotions/") !== false) {
        $modalTitle = "&nbsp;";
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/listing-types/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_LISTINGTEMPLATE);
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/locations/") !== false) {
        $modalTitle = $msgModalDelete;
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    }  elseif (string_strpos($_SERVER["PHP_SELF"], "/reviews-comments/") !== false) {
        if ($item_type == "blog") {
            $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ";
            $modalTitle .= ($reply_id ? string_ucwords(system_showText(LANG_SITEMGR_REPLY)): string_ucwords(system_showText(LANG_SITEMGR_COMMENT)));
            if ($reply_id) {
                $modalMessage = system_showText(LANG_SITEMGR_REPLY_DELETEQUESTION);
            } else {
                $modalMessage = system_showText(LANG_SITEMGR_COMMENT_DELETEQUESTION);
            }
        } else {
            $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_REVIEW);
            $modalMessage = system_showText(LANG_SITEMGR_REVIEW_DELETEQUESTION);
        }
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/leads/") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_LABEL_LEAD);
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/design/page-editor") !== false) {
        $modalTitle = system_showText(LANG_SITEMGR_DELETE)." ".system_showText(LANG_SITEMGR_LABEL_PAGE);
        $modalMessage = system_showText(LANG_SITEMGR_MSGAREYOUSURE);
    }
?>

    <form name="delete_item" id="delete_item" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
        <?=system_getFormInputHiddenParams((($_POST)?($_POST):($_GET)));?>
        <input type="hidden" name="id" id="delete-id" value="" />
        <input type="hidden" name="item_type" id="item-type" value="" />
        <input type="hidden" name="item_id" id="item-id" value="" />
        <input type="hidden" name="letter" value="<?=$letter?>" />
        <input type="hidden" name="screen" value="<?=$screen?>" />
        <input type="hidden" name="action" value="delete" />
    </form>

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-danger">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=$modalTitle?></h4>
                </div>
                <div class="modal-body text-center">
                    <p><?=$modalMessage?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"><?=system_showText(LANG_CANCEL)?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#delete_item').submit();"><?=system_showText(LANG_SITEMGR_YESCONTINUE);?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->