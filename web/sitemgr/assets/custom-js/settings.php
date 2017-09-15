<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/settings.php
	# ----------------------------------------------------------------------------------------------------

    if ($loadMap) {
        include(EDIRECTORY_ROOT."/includes/code/maptuning_forms.php");
   }
?>
	<script>
        
        function setNewKey() {
            $("#edirectory_api_key_disabled").attr("value", $("#new_key").val());
            $("#edirectory_api_key").attr("value", $("#new_key").val());
        }

        function download_doc(){
            <? if (!DEMO_LIVE_MODE) { ?>
                document.location = "<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/configuration/general-settings/index.php?download=1";
            <? } else { ?>
                livemodeMessage(true);
            <? } ?>
        }
        
        <? if ($hasValidCoord) { ?>
        loadMap(false, true);
        <? } ?>

    </script>