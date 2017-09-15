<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/category.php
	# ----------------------------------------------------------------------------------------------------

?>
    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/navigation.js"></script>
    
	<script>
        
        
        $(function() {
            $("#sortable").sortable();
        });

        function JS_submit() {
            serialize();
            document.form_navigation.submit();
        }

        function ChangeArea(area) {
            document.location = "<?=$_SERVER["PHP_SELF"]?>?navigation_area="+area;
        }

    </script>