<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form-locationsettings.php
# ----------------------------------------------------------------------------------------------------
$container = SymfonyCore::getContainer();
$distanceUnit = $container->get("translator")->trans("distance.unit", [], "units");

?>
<div class="col-sm-9">

    <div class="panel panel-default">

        <div class="panel-heading"><?= ucwords(system_showText(LANG_SITEMGR_GEOIP)) ?></div>

        <div class="panel-body form-horizontal">

            <div class="form-group">

                <div class="col-sm-4">
                    <div class="checkbox-inline">
                        <label>
                            <input type="checkbox" name="geoip_feature"
                                   value="on" <?= ($google_geocoding_status == "on" ? "checked=\"checked\"" : ""); ?>>
                            <?= ucwords(system_showText(LANG_SITEMGR_SETTINGS_GEOIP_ENABLE)) ?>&nbsp;<a
                                href="http://support.edirectory.com/customer/en/portal/articles/1850046-edirectory-geo-ip---location-tracking"
                                target="_blank"><i class="form-tip icon-help10"></i></a>
                        </label>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <div class="checkbox-inline">
                        <label>
                            <input type="checkbox" name="nearby_feature_enabled"
                                   value="on" <?= ($nearby_feature_enabled == "on" ? "checked=\"checked\"" : ""); ?>>
                            <?= system_showText(LANG_SITEMGR_ENABLE_NEARBY_RESULTS) ?>&nbsp;<a
                                href="http://support.edirectory.com/customer/portal/articles/2779831-how-the-nearby-results-work-?b_id=7909"
                                target="_blank"><i class="form-tip icon-help10"></i></a>
                            <p class="help-block small">
                                <a href="<?= DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/geography/terms/" ?>"><?= system_showText(LANG_SITEMGR_NEARBY_CUSTOMTOKENS) ?></a>
                            </p>
                        </label>
                    </div>
                </div>

                <div class="input col-sm-4">
                    <label
                        for="nearby_default_radius"><?= string_ucwords(system_showText(LANG_SITEMGR_NEARBY_DEFAULT_RADIUS)) ?> <?= "(".$distanceUnit.")" ?></label>
                    <input class="form-control" type="number" name="nearby_default_radius" id="nearby_default_radius"
                           value="<?= $nearby_default_radius ?>" maxlength="3" min="1"
                           max="999" <?= ((DEMO_LIVE_MODE) ? "readonly" : "") ?> placeholder="10"
                           data-error="<?= string_ucwords(system_showText(LANG_SITEMGR_LABEL_RADIUS_VALIDATION_ERROR)) ?>"
                           oninput="radiusValiding(this, true);" onkeyup="this.value=this.value.replace(/\D/, '')">
                    <p class="radiusError help-block alert alert-danger" style="display: none;"></p>
                </div>
            </div>

            <div class="form-group row">
                <div class="input col-xs-12">
                    <label
                        for="google_geocoding_key"><?= string_ucwords(system_showText(LANG_SITEMGR_GOOGLEGEOCODING_KEY)) ?></label>
                    <input class="form-control" type="text" name="google_geocoding_key" id="google_geocoding_key"
                           value="<?= $google_geocoding_key ?>"
                           maxlength="255" <?= ((DEMO_LIVE_MODE) ? "readonly" : "") ?>
                           placeholder="<?= system_showText(LANG_SITEMGR_EXAMPLE) ?> ABQIAAAApsu_yVy ... PoWjn3yp6vDxlSg">
                    <p class="help-block"><?= system_showText(LANG_SITEMGR_SETTINGS_GEOIP_TIP1); ?></p>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" name="location_setting" value="geolocation" class="btn btn-primary action-save"
                    data-loading-text="<?= system_showText(LANG_LABEL_FORM_WAIT); ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
        </div>
    </div>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><?= system_showText(LANG_SITEMGR_CHOOSELOCATIONSWANTUSE) ?></div>
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">
                    <?= string_ucwords(system_showText(LANG_SITEMGR_ENABLE)) ?>
                </th>
                <th class="text-center">
                    <?= string_ucwords(system_showText(LANG_SITEMGR_LOCATION)) ?>
                </th>
                <th class="text-center">
                    <?= string_ucwords(system_showText(LANG_SITEMGR_LOCATION_DEFAULT)) ?>
                </th>
                <th class="text-center">
                    <?= string_ucwords(system_showText(LANG_SITEMGR_LOCATION_SHOWDEFAULT)) ?>
                </th>
                <th class="text-center">
                    <?= string_ucwords(system_showText(LANG_ITEM_FEATURED)) ?> <i class="form-tip icon-help10"
                                                                                  title='<?= system_showText(LANG_SITEMGR_LOCATION_FEATURED2_TIP) ?>'></i>
                </th>
            </tr>
            </thead>
            <tbody>

            <?
            for ($i = 1; $i <= 5; $i++) {

                $index = ($i - 1);
                $tmp_location_enabled[$i] = $locations_info[$index]['enabled'];
                $tmp_location_show[$i] = $locations_info[$index]['show'];
                $tmp_default[$i] = false;
                if ($tmp_location_enabled[$i] == 'y') {
                    $tmp_default_location[$i] = db_getFromDB("location".$i, "Location_".$i.".id",
                        $locations_info[$index]['default_id'], 1, false, "object");
                    $tmp_default_location_id[$i] = $tmp_default_location[$i]->getNumber("id");
                    $tmp_default_location_name[$i] = $tmp_default_location[$i]->getString("name");
                    if ($tmp_default_location_id[$i]) {
                        $tmp_default[$i] = true;
                    }
                }

                $objLocationLabel = "Location".$i;
                ${"Location".$i} = new $objLocationLabel;

                $location_father = false;
                $location_father_id = false;
                $j = $i - 1;
                while ($j >= 1 && !$location_father) {
                    if (${"location_".$j."_checked"}) {
                        $location_father = $j;
                        if ($tmp_default_location_id[$j]) {
                            $location_father_id = $tmp_default_location_id[$j];
                        }
                    }
                    $j--;
                }
                if (!$location_father) {
                    ${"locations".$i} = ${"Location".$i}->retrieveAllLocation();
                } elseif ($location_father_id) {
                    ${"Location".$i}->SetString("location_".$location_father, $location_father_id);
                    ${"locations".$i} = ${"Location".$i}->retrieveLocationByLocation($location_father);
                }

                ?>
                <tr>
                    <td class="checkbox-table">
                        <input type="checkbox" name="location_<?= $i ?>_enabled"
                               id="location_<?= $i ?>_enabled" <?= ${"location_".$i."_checked"} ?>
                               class="inputCheck" <?= (($i != 5) ? 'onclick="controlLocationActivation('.$i.')"' : '') ?> />
                    </td>
                    <td class="form-group-table text-center">
                        <label
                            for="location_<?= $i ?>_enabled"><?= system_showText(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$i."_SYSTEM"))) ?></label>
                    </td>
                    <td class="form-group-table">
                        <?
                        $enable_location = (${"location_".$i."_checked"} && (!$location_father || ($tmp_default[$location_father])));
                        ?>
                        <select class="form-control" name="default_L<?= $i ?>_id"
                                id="default_L<?= $i ?>_id" <?= ($enable_location ? "" : "disabled") ?>
                                onchange="changeSettings(this.value, <?= $i ?>)">
                            <option id="l_location_<?= $i ?>"
                                    value=""><?= system_showText(LANG_SITEMGR_LOCATION_NODEFAULT) ?></option>

                            <?
                            if (is_array(${"locations".$i})) {
                                foreach (${"locations".$i} as $each_location) {
                                    $selected = ($tmp_default_location_id[$i] == $each_location["id"]) ? "selected" : "";
                                    ?>
                                    <option <?= $selected ?> id="option_L<?= $i ?>_ID<?= $each_location["id"] ?>"
                                                             value="<?= $each_location["id"] ?>"><?= $each_location["name"] ?></option><?
                                    unset($selected);
                                }
                            } ?>
                        </select>
                    </td>
                    <td class="checkbox-table">
                        <input name="check_L<?= $i ?>_show" id="check_L<?= $i ?>_show"
                               type="checkbox" <?= ($tmp_location_show[$i] == 'y' ? 'checked' : '') ?> <?= ($tmp_location_show[$i] != 'b' ? "" : "disabled") ?>
                               onclick="changeShowOption(<?= $i ?>)"/>
                    </td>
                    <td class="checkbox-table">
                        <input name="radio_browse" type="radio" <?= ($explorelocations_level == $i ? 'checked' : '') ?>
                               value="<?= $i ?>">
                    </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
        <div class="panel-footer">
            <button type="submit" name="location_setting" value="Submit" class="btn btn-primary action-save"
                    data-loading-text="<?= system_showText(LANG_LABEL_FORM_WAIT); ?>"><?= system_showText(LANG_SITEMGR_SAVE_CHANGES); ?></button>
        </div>
    </div>

</div>

<? for ($i = 1; $i <= 5; $i++) { ?>

    <input id="default_L<?= $i ?>_show" name="default_L<?= $i ?>_show" type="hidden"
           value="<?= ($tmp_location_show[$i]) ?>">
    <input id="default_L<?= $i ?>_name" name="default_L<?= $i ?>_name" type="hidden"
           value="<?= ($tmp_default_location_name[$i] ? $tmp_default_location_name[$i] : '') ?>">

    <? if ($i < 5) { ?>
        <p id="enable_location<?= $i ?>"
           style="display:none"><?= system_showText(LANG_SITEMGR_LOCATION_MSGSORRYYOUCANTENABLE) ?> <?= system_showText(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$i."_SYSTEM"))) ?>
            . <?= system_showText(LANG_SITEMGR_LOCATION_MSGACTIVATELOCATION) ?></p>
    <? }
}
unset($tmp_location_enabled);
unset($tmp_location_show);
unset($tmp_default_location);
unset($tmp_default_location_id);
unset($tmp_default_location_name);
?>
