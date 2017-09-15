<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/content/view-module.php
# ----------------------------------------------------------------------------------------------------

if (is_array($previewTerm)) {
    foreach ($previewTerm as $term) { ?>
        <section class="view-content-info" id="view-content-info-<?= $term["id"] ?>" style="display:none">

            <div class="control-view">
                <button type="button" class="close close-view" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="view-item">
                <div class="row">
                    <div class="col-xs-12">
                        <form role="form" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>"
                              name="term_location_data_<?= $term['id'] ?>" id="term_location_data_<?= $term['id'] ?>"
                              method="post">
                            <h1><?= $term['token'] ?></h1>
                            <span><?= system_showText(LANG_SITEMGR_SEARCH_TERMS_TIP) ?></span>

                            <div class="panel-body">
                                <div class="form-group row">
                                    <div class="col-xs-12" id="tableMapTuning<?= $term['id'] ?>">
                                        <div id="map<?= $term['id'] ?>" style="height: 200px"></div>
                                        <input type="hidden" name="latitude_longitude"
                                               id="myLatitudeLongitude<?= $term['id'] ?>" value="">
                                        <input type="hidden" name="map_zoom" id="map_zoom<?= $term['id'] ?>" value="">
                                        <input type="hidden" name="latitude" id="latitude<?= $term['id'] ?>"
                                               value="<?= $term['latitude'] ?>">
                                        <input type="hidden" name="longitude" id="longitude<?= $term['id'] ?>"
                                               value="<?= $term['longitude'] ?>">
                                        <input type="hidden" name="token" id="token<?= $term['id'] ?>"
                                               value="<?= $term['token'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label
                                            for="radius<?= $term['id'] ?>"><?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_RADIUS)) ?></label>
                                        <input class="form-control" id="radius<?= $term['id'] ?>" type="number" min="1"
                                               max="999" name="radius" maxlength="3"
                                               value="<?= $term['radius'] == "NULL" ? '' : $term['radius'] ?>"
                                               data-error="<?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_RADIUS_VALIDATION_ERROR)) ?>"
                                               oninput="radiusValiding(this, true);"
                                               onkeyup="this.value=this.value.replace(/\D/, '')"/>
                                        <p class="radiusError help-block alert alert-danger" style="display: none;"></p>
                                    </div>

                                    <div class="pull-right top-actions">
                                        <button type="button" name="submit_button" value="delete" class="btn btn-danger"
                                                data-loading-text="<?= system_showText(LANG_LABEL_FORM_WAIT); ?>"
                                                onclick="$('#delete_all').attr('value', 'on'); submitTermMap(<?= $term['id'] ?>, 'delete');"><?= system_showText(LANG_SITEMGR_DELETE_TERM); ?></button>
                                        <button type="button" name="submit_button" value="Submit"
                                                class="btn btn-primary action-save"
                                                data-loading-text="<?= system_showText(LANG_LABEL_FORM_WAIT); ?>"
                                                onclick="submitTermMap(<?= $term['id'] ?>, 'update')"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    <? }
}
