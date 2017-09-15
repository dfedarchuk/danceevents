<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-listing-extra-fields.php
	# ----------------------------------------------------------------------------------------------------

	if ($templateObj && $templateObj->getString("status") == "enabled") {
        $template_fields = $templateObj->getListingTemplateFields("");
        $hideExtraFieldsTable = true;
		if ($template_fields !== false) {
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_EXTRA_FIELDS), "tour-additional");
        ?>
            <div id="tour-additional">
            <? foreach ($template_fields as $row) {
                $row["form_value"] = $$row["field"];
                template_CreateDynamicField($row, false, $hideExtraFieldsTable);
            } ?>
            </div>
            <? if ($hideExtraFieldsTable) { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#extraFieldsTable").css("display", "none");
                });
            </script>
            <? }
		}
	}
?>