<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/support.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script type="text/javascript">
        function JS_submit(value) {
            $("#rewriteFile").attr("value", value);
            document.configChecker.submit();
        }

        function resetOption(url) {
            location.href = url;
        }

        $(document).ready( function(){
            $("#reset_flags_button").click( function(){
                bootbox.confirm('Are you sure you want to reset all cron flags?', function( result ) {
                    if ( result ) {
                        $.post("crontab.php", { action : "resetflags" }).done( function(data){
                            $(".alert").remove();
                            var message, elementClass;

                            if( data ){
                                message = "Success! Resetted all flags.";
                                elementClass = "alert-success";
                            }
                            else{
                                message = "Oops! Coldn't reset some flags. Contact support... yeah...";
                                elementClass = "alert-danger";
                            }

                            $("#reset_message_box").prepend( '<div class="alert '+elementClass+'">'+message+'</div>' );
                        });
                    }
                });
            });

            <?/*     $("#launch_manager_button").click( function(){
                $.post("<?=DEFAULT_URL."/cron/cron_manager.php"?>", {}).done( function(data){
                    $(".alert").remove();
                    $("#reset_message_box").prepend( '<div class="alert alert-info">'+data+'</div>' );
                });
            });*/?>
        });
    </script>
