<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/package.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>

        function ShowOptionPackage(optionValue) {
            /*
            * Hidden field to save type of package
            */
            if (optionValue == "custom_package") {
                document.getElementById('div_editor').style.display = 'block';
                document.getElementById('table_custom').style.display = '';
                document.getElementById('div_domains').style.display = 'none';
            } else {
                document.getElementById('table_custom').style.display = 'none';
                document.getElementById('div_domains').style.display = 'block';
            }

        }

        function enablePriceField(obj) {
            var field_id = "value_domain_"+obj.value;
            if (obj.checked == true) {
                document.getElementById(field_id).disabled = false;
            } else {
                document.getElementById(field_id).disabled = true;
            }
        }

        function checkAll(obj, num) {

            var value = obj.checked;

            if (value == true) {
                obj.checked = false;
                value = false;

                for (i = 0; i <num; i++) {
                    document.getElementById('package_'+i).checked = false;
                    enablePriceField(document.getElementById('package_'+i));
                }
            } else {
                obj.checked = true;
                value = true;

                for (i = 0; i < num; i++) {
                    document.getElementById('package_'+i).checked = true;
                    enablePriceField(document.getElementById('package_'+i));
                }
            }
        }

        ShowOptionPackage('<?=$offer_item?>');

	</script>
