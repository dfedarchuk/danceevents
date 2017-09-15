<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form-location.php
# ----------------------------------------------------------------------------------------------------

$edirLocConf = explode(",", EDIR_LOCATIONS);
$edirLocConfNames = explode(",", EDIR_ALL_LOCATIONNAMES);

$container = SymfonyCore::getContainer();
$nearbyFeatureEnabled = $container->get("nearby.handler")->isNearbyEnabled();
?>

    <div class="col-md-7">

        <!-- Panel Hierarchy Information  -->
        <? if ($_location_level != $edirLocConf[0]) { ?>
            <div class="panel panel-form">
                <div
                    class="panel-heading"><?= system_showText(constant("LANG_SITEMGR_".$edirLocConfNames[$_location_level - 1]."_HIERARCHY")) ?></div>

                <div class="panel-body">
                    <? include(EDIRECTORY_ROOT."/includes/code/load_location_location.php"); ?>
                </div>
            </div>
        <? } ?>

        <? if ($operationTypeCheck) { ?>

            <!-- Panel Basic Information  -->
            <div class="panel panel-form">

                <div class="panel-heading"><?= system_showText(LANG_BASIC_INFO) ?></div>

                <div class="panel-body">

                    <input type="hidden" name="default" id="default" value="<?= $location_default ?>"/>
                    <input type="hidden" name="id" id="id" value="<?= $id ?>"/>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="location_name"><?= LOCATION_TITLE ?></label>
                            <input class="form-control" id="location_name" type="text" name="location_name"
                                   value="<?= htmlspecialchars($location_name) ?>"
                                   onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?= FRIENDLYURL_VALIDCHARS ?>', '<?= FRIENDLYURL_SEPARATOR ?>'); <?= ($nearbyFeatureEnabled ? "loadMap(document.location_data_in);" : "") ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label
                                for="location_abbreviation"><?= string_ucwords(system_showText(LANG_SITEMGR_ABBREVIATION)) ?></label>
                            <input class="form-control" id="location_abbreviation" type="text"
                                   name="location_abbreviation"
                                   value="<?= htmlspecialchars($location_abbreviation); ?>"/>
                        </div>
                    </div>

                </div>
            </div>
            <?
            $locations_info = db_getFromDB("settinglocation", "id", $_location_level, 1, "", "array",
                SELECTED_DOMAIN_ID);
            ?>

            <!-- Panel Nearby Information  -->
            <? if ($nearbyFeatureEnabled) { ?>
                <div class="panel panel-form">
                    <div class="panel-heading"><?= system_showText(LANG_LABEL_MAP_TUNING) ?></div>

                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-xs-12" id="tableMapTuning">
                                <div id="map" style="height: 200px"></div>
                                <input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="">
                                <input type="hidden" name="map_zoom" id="map_zoom" value="">
                                <input type="hidden" name="latitude" id="latitude" value="<?= $latitude ?>">
                                <input type="hidden" name="longitude" id="longitude" value="<?= $longitude ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label
                                    for="radius"><?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_RADIUS)) ?></label>
                                <input class="form-control" id="radius" type="number" min="1" max="999" maxlength="3"
                                       name="radius" value="<?= $radius ?>"
                                       data-error="<?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_RADIUS_VALIDATION_ERROR)) ?>"
                                       oninput="radiusValiding(this, true);"
                                       onkeyup="this.value=this.value.replace(/\D/, '')"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <p class="radiusError help-block alert alert-danger" style="display: none;"></p>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>

            <!-- Panel SEO Information  -->
            <div class="panel panel-form">

                <div class="panel-heading"><?= system_showText(LANG_LABEL_SEO_TUNING) ?></div>

                <div class="panel-body">

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label
                                for="friendly_url"><?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)) ?></label>
                            <input class="form-control" id="friendly_url" type="text" name="friendly_url"
                                   value="<?= $friendly_url ?>"
                                   onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?= FRIENDLYURL_VALIDCHARS ?>', '<?= FRIENDLYURL_SEPARATOR ?>');"/>
                        </div>

                        <div class="col-sm-6">
                            <label
                                for="page_title"><?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_PAGETITLE)) ?></label>
                            <input type="text" class="form-control" id="page_title" name="page_title"
                                   value="<?= $page_title ?>"/>
                        </div>

                    </div>

                    <div class="form-group">
                        <label
                            for="seo_keywords"><?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS)) ?></label>
                        <input type="text" class="form-control tag-input" id="seo_keywords" name="seo_keywords"
                               value="<?= $seo_keywords ?>"
                               placeholder="<?= system_showText(LANG_HOLDER_KEYWORDS); ?>"/>
                    </div>

                    <div class="form-group">
                        <label
                            for="seo_description"><?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION)) ?></label>
                        <textarea class="form-control textarea-counter" data-chars="250"
                                  data-msg="<?= system_showText(LANG_MSG_CHARS_LEFT) ?>" id="seo_description"
                                  name="seo_description" rows="5"><?= $seo_description ?></textarea>
                    </div>

                </div>
            </div>

        <? } ?>
    </div>

<?php
$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/location.php";
