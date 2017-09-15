<?
    /**
     * # Admin Panel for eDirectory
     * @copyright Copyright 2015 Arca Solutions, Inc.
     * @author Basecode - Arca Solutions, Inc.
     */
    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/modals/modal-categoryselect.php
    # ----------------------------------------------------------------------------------------------------

    /* This line will search the URL for "/content|sponsors/{SOMETHING}/".
     * This {SOMETHING} will be added to the $filteredMatches array as a string
     * if {SOMETHING} is not found or does not match any of our known modules, we'll block the modal
     */
    preg_match( "/(\/content\/|\/".MEMBERS_ALIAS."\/)(\w*)(?=\/)/", $_SERVER["PHP_SELF"], $filteredMatches );

    $modalCategoryMaxAllowed = MAX_CATEGORY_ALLOWED;
    $modalCategoryInfo       = "<p>".system_showText( LANG_CATEGORIES_CATEGORIESMAXTIP1 )." <strong>".system_showText( MAX_CATEGORY_ALLOWED )."</strong> ".system_showText( LANG_CATEGORIES_CATEGORIESMAXTIP2 )."</p>";

    $matched = true;
    if (isset($filteredMatches[2])) switch ( $filteredMatches[2] )
    {
        // Listing is a hipster, he's different.
        case "claim":
        case LISTING_FEATURE_FOLDER :
            $modalListId             = "listing";
            $modalCategoryMaxAllowed = LISTING_MAX_CATEGORY_ALLOWED;

            if ( ((!$listing->getNumber( "id" )) || $listing->getNumber( "package_id" ) > 0 || (($listing) && ($listing->needToCheckOut())) || (string_strpos( $url_base, "/".SITEMGR_ALIAS."" )) || (($listing) && ($listing->getPrice('monthly') <= 0 && $listing->getPrice('yearly') <= 0))) && ($process != "signup") )
            {
                $modalCategoryInfo = "<p>".system_showText( LANG_CATEGORIES_CATEGORIESMAXTIP1 )." <strong> ".system_showText( LISTING_MAX_CATEGORY_ALLOWED )."</strong> ".system_showText( LANG_CATEGORIES_CATEGORIESMAXTIP2 )."</p>".
                    "<p>".(($listingLevelObj->getFreeCategory( $level ) > 1) ? system_showText( LANG_LABEL_CATEGORY_PLURAL ) : system_showText( LANG_LABEL_CATEGORY ))." <strong>".system_showText( LANG_LABEL_FREE ).": ".$listingLevelObj->getFreeCategory( $level )."</strong> ".system_showText( LANG_MSG_EXTRA_CATEGORIES_COST )." <strong> ".system_showText( LANG_MSG_ADDITIONAL )." ".CURRENCY_SYMBOL.$listingLevelObj->getCategoryPrice( $level )."</strong>.</p>";
            }

            if ( string_strpos( $url_base, "/".SITEMGR_ALIAS."" ) !== false )
            {
                $modalCategoryInfo .= "<p>".str_replace( "[a]", "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/payment/\" target=\"_blank\">", str_replace( "[/a]", "</a>", system_showText( LANG_SITEMGR_CATEGORYSETTINGS ) ) )."</p>";
                $modalCategoryInfo .= "<p><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".LISTING_FEATURE_FOLDER."/categories/category.php\">".system_showText(LANG_ADD_CATEGORIES)."</a></p>";

            }
            break;
        case EVENT_FEATURE_FOLDER :
            $modalListId = "event";
            if ( string_strpos( $url_base, "/".SITEMGR_ALIAS."" ) !== false ) {
                $modalCategoryInfo .= "<p><a href=\"" . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/content/" . EVENT_FEATURE_FOLDER . "/categories/category.php\">" . system_showText(LANG_ADD_CATEGORIES) . "</a></p>";
            }
            break;
        case CLASSIFIED_FEATURE_FOLDER :
            $modalListId = "classified";
            if ( string_strpos( $url_base, "/".SITEMGR_ALIAS."" ) !== false ) {
                $modalCategoryInfo .= "<p><a href=\"" . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/content/" . CLASSIFIED_FEATURE_FOLDER . "/categories/category.php\">" . system_showText(LANG_ADD_CATEGORIES) . "</a></p>";
            }
            break;
        case ARTICLE_FEATURE_FOLDER :
            $modalListId = "article";
            if ( string_strpos( $url_base, "/".SITEMGR_ALIAS."" ) !== false ) {
                $modalCategoryInfo .= "<p><a href=\"" . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/content/" . ARTICLE_FEATURE_FOLDER . "/categories/category.php\">" . system_showText(LANG_ADD_CATEGORIES) . "</a></p>";
            }
            break;
        case BLOG_FEATURE_FOLDER :
            $modalListId = "blog";
            $modalCategoryInfo .= "<p><a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/".BLOG_FEATURE_FOLDER."/categories/category.php\">".system_showText(LANG_ADD_CATEGORIES)."</a></p>";
            break;
        default:
            /* It hasn't matched any of our modules. Must be a mistake. */
            $matched     = false;
            break;
    }

    if ( $matched ):
        ?>

        <!-- ######################## -->
        <!-- Modal Categories -->
        <!-- ######################## -->

        <div class="modal fade" id="modal-categories" tabindex="-1" role="dialog" aria-labelledby="modal-categories" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><?= system_showText( LANG_CATEGORIES_SUBCATEGS ) ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                <div class="multiple-categories">
                                    <ul id="<?= $modalListId ?>_categorytree_id_0">&nbsp;</ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-lg-offset-3">
                                <input type="text" id="category-select" class="form-control" placeholder="<?= str_replace( "[max]", $modalCategoryMaxAllowed, system_showText( LANG_SELECTMAX_CATEGORIES ) ); ?>" value="">
                                <br>
                                <?= $modalCategoryInfo ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button type="button" class="btn btn-primary btn-block" id="action-categories"><?= system_showText( LANG_BUTTON_OK ); ?></button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <? endif; ?>