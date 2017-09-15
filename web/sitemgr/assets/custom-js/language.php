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
	<script>
        
        function JS_submit() {
            document.language.submit();
        }
        
		function download_file(action) {
            
			<? if (!DEMO_LIVE_MODE) { ?>
                    
                if (action == 'add') {
                    document.location = "<?=$url_redirect?>?download=1";
                } else if (action == 'edit') {
                    $("#language_id").attr("value", $("#lang").val());
                    $("#language_area").attr("value", $("#area").val());
                    document.language_file.submit();
                }
                
			<? } else { ?>
				livemodeMessage(true, false);
			<? } ?>
                
		}
        
        $(document).ready(function() {
            //Close sidebar automatically
            ControlSidebar();
        });

    </script>