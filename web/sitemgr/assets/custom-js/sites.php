<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /ed-admin/assets/custom-js/sites.php
# ----------------------------------------------------------------------------------------------------

?>
<script>

    function domainFinish(id) {
        var domain_name = $("#name").val();
        var domain_url = $("#url").val();
        var domain_server = $("#server").val();
        var domain_db = $("#mysql_database").val();
        var domain_dbuser = $("#mysql_username").val();
        var domain_dbpass = $("#mysql_password").val();
        var domain_lang = $("input[name='domain_language']:checked").val();
        var domain_id = id;
        $('#domainButtons').css('display', 'none');
        $('#domainProgress').css('display', '');
        $('#finishError').css('display', 'none');
        $.post("<?=DEFAULT_URL."/".SITEMGR_ALIAS."/sites/finish.php"?>", {
            domain_name: domain_name,
            domain_url: domain_url,
            domain_server: domain_server,
            domain_db: domain_db,
            domain_id: domain_id,
            domain_lang: domain_lang,
            action: "save"
        }, function (ret) {
            domain_id = $.trim(ret);
            $.post("<?=DEFAULT_URL."/".SITEMGR_ALIAS."/sites/finish.php"?>", {
                domain_id: domain_id,
                domain_dbuser: domain_dbuser,
                domain_dbpass: domain_dbpass,
                domain_db: domain_db,
                domain_lang: domain_lang,
                action: "create"
            });
            showPercentage(domain_id);
        });
    }

    function showPercentage(domain_id) {
        $.post("<?=DEFAULT_URL."/".SITEMGR_ALIAS."/sites/finish.php"?>", {
            domain_id: domain_id,
            action: "read"
        }, function (ret) {
            var aRet = ret.split("|");
            if (aRet[1] == 100) {
                $("#domain_message").html(aRet[0]);
            } else {
                $("#domain_message").html(aRet[0] + "<br /><img src=\"<?=DEFAULT_URL;?>/assets/images/structure/img_loading.gif\" />");
            }
            $("#domain_progress").text(aRet[1]);
            if (aRet[1] >= 0 && aRet[1] < 100) {
                showPercentage(domain_id);
            } else if (aRet[1] == 100) {
                window.location = "<?=DEFAULT_URL."/".SITEMGR_ALIAS."/sites/index.php"?>" + "?message=0&domain_id=" + domain_id;
            } else if (aRet[1] == "error") {
                $('#finishError').html(aRet[0] + "<br /><?=system_showText(LANG_SITEMGR_DOMAIN_ERROR_TRYAGAIN);?>");
                $('#finishError').css('display', '');
                $('#domainButtons').css('display', '');
                $('#domainProgress').css('display', 'none');
                $("#domain_message").html("<?=system_showText(LANG_SITEMGR_DOMAIN_PROCESS_STARTING);?><br /><img src=\"<?=DEFAULT_URL;?>/assets/images/structure/img_loading.gif\"> /");
                $("#domain_progress").text("0");
            }
        });
    }

    var is_valid = '<?=$is_valid;?>';
    var domain_id = '<?=$domain_id;?>';
    if (is_valid) {
        domainFinish(domain_id);
    }

    <? if (DEMO_LIVE_MODE) { ?>
    $(document).ready(function () {
        livemodeMessage(false);
        setTimeout("window.location=\"<?=DEFAULT_URL;?>/<?=SITEMGR_ALIAS?>/sites/\"", 5000);
    });
    <? } ?>

</script>
