<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/newsletter.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>
        
        function showAccountTabs(num_div, accType) {
            $("#accType").attr("value", accType);
            $("#accType2").attr("value", accType);

            for (j = 0; j < 2; j++) {
                $('#account_'+j).css('display', 'none');
                $('#tab_account_'+j).removeClass("active");
            }    
            $('#account_'+num_div).css('display', '');
            $('#tab_account_'+num_div).addClass("active");

        }
        
        function disconnect() {
            $("#arcamailer_disconnect").submit();
        }
        
        function openLogin() {
            window.open("http://send.arcamailer.com<?=($edir_customer_id && $edir_email ? "?username=$edir_email" : "")?>", "_blank");
        }

    </script>