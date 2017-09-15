<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/assets/custom-js/email-editor.php
# ----------------------------------------------------------------------------------------------------

setting_get('sitemgr_language', $lang);
?>
<script>
    $(document).ready(function () {
        //Close sidebar automatically
        ControlSidebar();
    });

    function JS_Back() {
        document.emailnotifications.nav_page.value = 0;
        document.emailnotifications.submit();
    }

    function confirmRestore(pText, pId, pForm) {

        bootbox.confirm(pText, function (result) {
            if (result) {
                $("input[name='hiddenValue']").attr('value', pId);
                document.getElementById(pForm).submit();
            }
        });

    }

    function cKEditor(active) {
        if (typeof editor != 'undefined') {
            editor.destroy();
            delete editor;
        }

        if (active) {
            editor = CKEDITOR.replace('body', {
                language: '<?=$lang?>',
                customConfig: '/assets/js/lib/ckeditor/base.config.js'
            });
        }
    }
</script>
