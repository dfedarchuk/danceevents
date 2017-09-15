<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-language.php
	# ----------------------------------------------------------------------------------------------------
?>
    <div class="col-sm-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LANGUAGE_MAIN);?>
                <p><small><?=system_showText(LANG_SITEMGR_LANGUAGE_MAIN_TIP);?></small></p>
            </div>

            <div class="panel-body">
                <div class="row">
                    <? foreach ($allLanguages as $lang) {

                        if (file_exists($flagFolder."/".$lang["id"].".png")) {
                            $flagPath = DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/lang/flags/".$lang["id"].".png";
                        } else {
                            $flagPath = DEFAULT_URL."/".SITEMGR_ALIAS."/assets/img/languages/img-flag-".$lang["id"].".png";
                        }
                        if ($lang["lang_default"] == "y") {
                            $auxStyle = "style=\"cursor: default;\"";
                        } else {
                            $auxStyle = "";
                        }
                    ?>

                        <div class="col-sm-3 text-center">
                            <div class="lang-selector <?=($lang["lang_default"] == "y" ? "active" : "");?>">
                                <a href="<?=($lang["lang_default"] == "y" ? "javascript: void(0);" : $url_redirect."?active&id=".$lang["id"])?>" <?=$auxStyle?>>
                                    <img class="img-flags" alt="<?=$lang["name"]?>" src="<?=$flagPath?>">
                                </a>
                                <p><?=$lang["name"]?></p>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LANGUAGE_ADMIN);?>
                <p><small><?=system_showText(LANG_SITEMGR_LANGUAGE_ADMIN_TIP);?></small></p>
            </div>
            <div class="panel-body">
                <div class="row">

                    <? foreach ($allLanguages as $lang) {

                        if (file_exists($flagFolder."/".$lang["id"].".png")) {
                            $flagPath = DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/lang/flags/".$lang["id"].".png";
                        } else {
                            $flagPath = DEFAULT_URL."/".SITEMGR_ALIAS."/assets/img/languages/img-flag-".$lang["id"].".png";
                        }
                        if ($sitemgr_language == $lang["id"]) {
                            $auxStyle = "style=\"cursor: default;\"";
                        } else {
                            $auxStyle = "";
                        }
                    ?>

                        <div class="col-sm-3 text-center">
                            <div class="lang-selector <?=($sitemgr_language == $lang["id"] ? "active" : "");?>">
                                <a href="<?=($sitemgr_language == $lang["id"] ? "javascript: void(0);" : $url_redirect."?activeAdmin&id=".$lang["id"])?>" <?=$auxStyle?>>
                                    <img class="img-flags" alt="<?=$lang["name"]?>" src="<?=$flagPath?>">
                                </a>
                                <p><?=$lang["name"]?></p>
                            </div>
                        </div>

                    <? } ?>

                </div>

            </div>

        </div>

    </div>
