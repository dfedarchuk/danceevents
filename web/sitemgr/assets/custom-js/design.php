<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/design.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/editarea/edit_area/edit_area_full.js"></script>

    <script>

        //Theme changing
        function JS_submit(scheme, checkTheme, value) {
            if (scheme) {
                $("#scheme").attr("value", scheme);
            }
            $("#select_theme").attr("value", value);
            $('#loading_theme').removeClass('hidden');
            $("#theme").submit();
        }

        //Colors changing
        function JS_submitColors(type) {
			if (type == "reset") {
                $("#action").attr("value", "reset");
                bootbox.confirm('<?=system_showText(LANG_SITEMGR_COLORS_RESET_CONFIRM);?>', function(result) {
                    if (result) {
                        document.color_scheme.submit();
                    } else {
                        btn = $('.action-save');
                        btn.button('reset');
                    }
                });
			} else {
                document.color_scheme.submit();
			}
		}

        function InitEDitor() {
            editAreaLoader.init({
                id : "textarea",
                syntax: "<?=$editorSyntax?>",
                start_highlight: true,
                language: "<?=$editorLang?>",
                allow_toggle: false
            });
        }

        $(document).ready(function() {
            if ($('#textarea').length) {
                InitEDitor();
            }
        });

    </script>
