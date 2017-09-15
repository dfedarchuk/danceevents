<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/mobile.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>
        
        function JS_submit(type) {
            if (type == "ios") {
                $("#submit_android").prop("value", "");
            } else if (type == "android") {
                $("#submit_ios").prop("value", "");
            }
            $("#submit_"+type).prop("value", "submit");
            document.splashScreen.submit();
        }

    </script>