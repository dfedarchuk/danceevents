<?php
    /*
     * # Admin Panel for eDirectory
     * @copyright Copyright 2014 Arca Solutions, Inc.
     * @author Basecode - Arca Solutions, Inc.
     */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /ed-admin/assets/custom-js/location.php
    # ----------------------------------------------------------------------------------------------------

    if (isset($nearbyFeatureEnabled)) {
        include(EDIRECTORY_ROOT."/includes/code/maptuning_forms.php"); ?>
        <script>
            loadMap(document.location_data_in, true);
        </script>
    <?php }
?>

    <script>
        function changeSettings(value, level) {
            resetLevelsChild(level);
            if (value=='') {
                $('#check_L'+level+"_show").prop('checked', '');
                $('#check_L'+level+"_show").prop('disabled', 'disabled');
                $("#default_L"+level+"_show").attr('value', 'b');
                $('#default_L'+level+'_name').attr('value', '');
                //resetLevelsChild(level);
            } else {
                $('#check_L'+level+"_show").prop('disabled', '');
                $('#check_L'+level+"_show").prop('checked', 'checked');
                $("#default_L"+level+"_show").attr('value', 'y');
                $('#default_L'+level+'_name').attr('value', $('#option_L'+level+'_ID'+value).text());
                next_enabled_location = retrieveNextEnabledLocation (level);
                if (next_enabled_location) {
                    enableLevel (next_enabled_location);
                    loadLocationsChild('<?=DEFAULT_URL?>', level, value, next_enabled_location);
                }
            }
        }

        function controlLocationActivation(level) {
            if ($('#location_'+level+'_enabled').is(':checked')) {
                non_activatable_locations = '<?=$non_activatable_locations?>';
                if (non_activatable_locations) {
                    non_activatable_locations = [<?=$non_activatable_locations?>];
                    if (in_array (level, non_activatable_locations)) {
                        $('#location_'+level+'_enabled').prop('checked', '');
                        bootbox.alert($("#enable_location"+level).html(), function() {});
                    } else
                        activeLocation(level);
                } else
                    activeLocation(level);
            } else
                activeLocation(level);
        }

        function activeLocation(level) {
            resetLevelsChild(level);
            if ($('#location_'+level+'_enabled').is(':checked')) {
                prev_enabled_location = retrievePrevEnabledLocation(level);
                active_option_default=true;
                if (prev_enabled_location)
                    if ($('#default_L'+prev_enabled_location+'_id').val()=='')
                        active_option_default = false;

                if (active_option_default) {
                    enableLevel (level);
                    if(prev_enabled_location)
                        loadLocationsChild('<?=DEFAULT_URL?>', prev_enabled_location, $('#default_L'+prev_enabled_location+'_id').val(), level);
                    else
                        loadAllLocations('<?=DEFAULT_URL?>', level);
                }
            } else {
                disableLevel (level);
                active_option_default=true;
                next_enabled_location = retrieveNextEnabledLocation(level)
                if (next_enabled_location) {
                    prev_enabled_location = retrievePrevEnabledLocation (level);
                    if (prev_enabled_location)
                        if ($('#default_L'+prev_enabled_location+'_id').val()=='')
                            active_option_default=false;
                } else
                    active_option_default = false;
                if (active_option_default) {
                    enableLevel (next_enabled_location);
                    if(prev_enabled_location) {
                        loadLocationsChild('<?=DEFAULT_URL?>', prev_enabled_location, $('#default_L'+prev_enabled_location+'_id').val(), next_enabled_location);
                    } else {
                        loadAllLocations('<?=DEFAULT_URL?>', next_enabled_location);
                    }
                }
            }
        }

        function retrievePrevEnabledLocation(level) {
            prev_enabled_location = false;
            if (level>1) {
                i=level-1;
                while (i>=1 && !prev_enabled_location) {
                    if ($('#location_'+i+'_enabled').is(':checked'))
                        prev_enabled_location = i;
                    i--;
                }
            }
            return prev_enabled_location;
        }

        function retrieveNextEnabledLocation(level) {
            next_enabled_location = false;
            if (level<5) {
                i=level+1;
                while (i<=5 && !next_enabled_location) {
                    if ($('#location_'+i+'_enabled').is(':checked'))
                        next_enabled_location = i;
                    i++;
                }
            }
            return next_enabled_location;
        }

        function resetLevelsChild(level) {
            if (level<5) {
                for (i=(level+1); i<=5; i++) {
                    $("#default_L"+i+"_id").attr('value', '');
                    $('#default_L'+i+"_id").prop('disabled', 'disabled');
                    $('#check_L'+i+"_show").prop('checked', '');
                    $('#check_L'+i+"_show").prop('disabled', 'disabled');
                    $("#default_L"+i+"_show").attr('value', 'b');
                    $("#default_L"+i+"_name").attr('value', '');
                }
            }
        }

        function enableLevel(level) {
            $('#default_L'+level+"_id").prop('disabled', '');
        }

        function disableLevel(level) {
            $("#default_L"+level+"_id").attr('value', '');
            $('#default_L'+level+"_id").prop('disabled', 'disabled');
            $('#check_L'+level+"_show").prop('checked', '');
            $('#check_L'+level+"_show").prop('disabled', 'disabled');
            $("#default_L"+level+"_show").attr('value', 'b');
            $("#default_L"+level+"_name").attr('value', '');
        }

        function changeShowOption(level) {
            if ($('#check_L'+level+"_show").is(':checked')) {
                $("#default_L"+level+"_show").attr('value', 'y');
            } else {
                $("#default_L"+level+"_show").attr('value', 'n');
            }
        }

        function doSubmitLocation(formName, operationName) {
            if (!document.forms[formName].elements['operation']) {
                alert('doSubmitLocation: Error !');
                return false;
            }
            document.forms[formName].elements['operation'].value = operationName;
            document.forms[formName].submit();
            return true;
        }

    </script>

    <? if ($lastLoc) { ?>
        <script type="text/javascript">
            loadLocationSitemgrMembers('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$lastLoc["up_level"]?>, <?=$lastLoc["level"]?>, <?=($lastLoc["up_val"] ? $lastLoc["up_val"] : 0)?>);
        </script>
    <? }
    if ($newLoc) { ?>
        <script type="text/javascript">
            $(document).ready(function() {
                var i = 0;
                <? foreach ($newLoc as $loc) { ?>
                    showNewLocationField('<?=$loc["level"]?>', '<?=EDIR_LOCATIONS?>', i == 0? true: false, '<?=$loc["val"]?>');
                    easyFriendlyUrl('<?=$loc["val"]?>', 'new_location<?=$loc["level"]?>_friendly', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');
                    i++;
                <? } ?>
                <?if ($newLocLevelBlank) { ?>
                    showNewLocationField('<?=$newLocLevelBlank?>', '<?=EDIR_LOCATIONS?>', false);
                <? } ?>
            });
        </script>
    <? } ?>
