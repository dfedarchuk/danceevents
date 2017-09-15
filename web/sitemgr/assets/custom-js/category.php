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

        $(document).ready(function () {

            //Close sidebar automatically
            ControlSidebar();

            //Pre-fill page title
            $('#title').blur(function() {
                $('#page_title').attr('value', $('#title').val());
            });

            $(".categoryImageDeleteButton").click(function(){
                var clickedItem = $(this);

                var data = {
                    action : "ajax",
                    type : "removeImage",
                    module : clickedItem.data("module"),
                    id : clickedItem.data("id")
                };

                $.post(window.location.href, data).done(function (response) {
                    if (response) {
                        data = JSON.parse(response);

                        if (data && data.status) {
                            $("#categoryImageContainer").find("img").fadeOut(function(){$(this).remove()});
                            clickedItem.fadeOut(function(){$(this).remove()});
                            $('[name=image_id]').val(0);
                        }
                    }
                });
            });
        });

    </script>
