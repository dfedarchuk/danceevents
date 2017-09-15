<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/modals/modal-add-mult-categories.php
# ----------------------------------------------------------------------------------------------------

?>
<div class="modal fade" id="modal-add-mult-categories" tabindex="-1" role="dialog" aria-labelledby="modal-add-mult-categories" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?= system_showText( LANG_SITEMGR_ADD_MULT_CATEGORY) ?></h4>
            </div>
            <div class="modal-body">
                <p><?= system_showText(str_replace("5", ($moduleFolder == LISTING_FEATURE_FOLDER ? LISTING_CATEGORY_LEVEL_AMOUNT : CATEGORY_LEVEL_AMOUNT), LANG_SITEMGR_ADD_MULTIPLE_CATEGORIES_DESC))?></p>
                <form name="mult_categories" id="mult_categories" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                    <input type="hidden" name="moduleFolder" value="<?=$moduleFolder?>">
                    <input type="hidden" name="action" value="add_mult_categories">
                    <div class="row">
                        <div class="col-lg-12 col-lg-offset" id="tour-description">
                            <textarea name="multiple_categories" id="multiple-categories" class="form-control"
                                      rows="10" placeholder="<?=system_showText(LANG_SITEMGR_MULT_CATEGORIES_EX);?>"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-lg-offset">
                            <div class="checkbox">
                                <label for="multiple-featured">
                                    <input type="checkbox" name="featured" value="y" id="multiple-featured">
                                    <?=system_showText(LANG_SITEMGR_MULT_CATEGORIES_FEATURED);?>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4 col-sm-offset-8">
                        <button type="submit" class="btn btn-primary btn-block action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="$('#mult_categories').submit();" id="action-add-mult-categories"><?= ucwords(system_showText( LANG_ADD_CATEGORIES)); ?></button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
