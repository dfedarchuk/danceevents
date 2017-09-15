<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/general.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>
        
        function activationByPhone() {
            if (document.getElementById("activation_by_phone").checked) {
                document.getElementById("table_activation").className = "form-group show";
            } else {
                document.getElementById("table_activation").className = "form-group hidden";
            }
        }
        
        function toogleTrans(obj) {
            if (obj.checked == true) {
                document.getElementById("trans_form").style.display = 'block';
            } else {
                document.getElementById("trans_form").style.display = 'none';
            }
        }
        
        function emptyDate(obj) {
            if (obj.value == "00/00/0000") {
                return true;
            } else {
                return false;
            }
        }
        
        function submitFormSettings() {
            btn = $("#btn-save");
            $.post("<?=$modalSettingsPath?>", $("#setting_item").serialize(), function(result) {
                if ($.trim(result) != "error") {
                    if ($.trim(result) == "1") {
                        window.location.href = '<?=$url_redirect?>/index.php?message=1';
                    } else {
                        btn.button('reset');
                        $("#warningSettings").removeClass('hidden');
                        $("#warningSettings").html(result);
                    }
                }
            });
        }      
        
        $('#modal-settings').on('show.bs.modal', function (e) {
            if ($('#warningSettings').length <= 0) {
                $("#settings-content").html('');
                $.get('<?=$modalSettingsPath?>', {
                    domain_id: <?=SELECTED_DOMAIN_ID?>,
                    id: $("#setting-id").val()
                }, function (ret) {
                    $("#settings-content").html(ret);
                    initPlugins();
                });
            }
        })
        
        $('#modal-settings').on('hidden.bs.modal', function (e) {
            $("#settings-content").html('');
        })
        
        <? if ($controlSidebar) { ?>
        $(document).ready(function () {
            var wW = $(window).width();
            if (wW >= 1200) {
                ControlSidebar();
            }
        });
        <? } ?>

    </script>