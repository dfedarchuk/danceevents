<?
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form-domain.php
# ----------------------------------------------------------------------------------------------------

if ($message_domain) {
    echo "<p class='alert alert-warning'>";
    echo $message_domain;
    echo "</p>";
}
?>
<div class="col-md-7 col-xs-12">

    <!-- Panel Basic Information  -->
    <div class="panel panel-form">

        <div class="panel-heading">
            <?= system_showText(LANG_SITEMGR_DOMAIN_INFORMATION) ?>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <label for="name"><?= system_showText(LANG_SITEMGR_DOMAIN_NAME) ?></label>
                <input type="text" name="name" id="name" value="<?= $name ?>" maxlength="200" class="form-control"
                       placeholder="<?= system_showText(LANG_SITEMGR_DOMAIN_FRIENDLY_NAME) ?>">
            </div>

            <div class="form-group">
                <label for="url"><?= system_showText(LANG_SITEMGR_DOMAIN_URL) ?></label>
                <input type="text" name="url" id="url" value="<?= $url ?>" maxlength="200" class="form-control"
                       placeholder="yoursite.com">
            </div>

            <div class="form-group row">
                <div class="col-sm-6 <?= (count($servers) > 1) ? "" : "hidden"; ?>">
                    <label for="server"><?= system_showText(LANG_SITEMGR_DOMAIN_SERVER) ?></label>
                    <select class="form-control status-select" name="server" id="server">
                        <? foreach ($servers as $server) { ?>
                            <option
                                value="<?= $server == system_showText(LANG_SITEMGR_DOMAIN_CURRENT_SERVER) ? "default" : $server; ?>" <?= $selected_server == $server ? "selected" : ""; ?>><?= $server; ?></option>
                        <? } ?>
                    </select>
                </div>
            </div>

            <?php if ($_SESSION["is_arcalogin"]) { ?>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="mysql_database"><?= system_showText(LANG_SITEMGR_DOMAIN_MYSQL_DATABASES) ?></label>
                        <select class="form-control status-select" name="mysql_database" id="mysql_database">
                            <option value=""><?= system_showText(LANG_SITEMGR_DOMAIN_MYSQL_DATABASES_EMPTY) ?></option>
                            <?php
                            foreach ($databases as $database) { ?>
                                <option value="<?= $database ?>" <?= $mysql_database == $database ? "selected" : ""; ?>><?= $database ?></option>
                            <? } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="mysql_username"><?= system_showText(LANG_SITEMGR_DOMAIN_MYSQL_USERNAME) ?></label>
                        <input type="text" name="mysql_username" id="mysql_username" value="<?= $mysql_username ?>"
                               class="form-control"/>
                    </div>
                    <div class="col-sm-4">
                        <label for="mysql_password"><?= system_showText(LANG_SITEMGR_DOMAIN_MYSQL_PASSWORD) ?></label>
                        <input type="password" name="mysql_password" id="mysql_password" value="<?= $mysql_password ?>"
                               class="form-control"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <spam class="help-block"><?= system_showText(LANG_SITEMGR_DOMAIN_MYSQL_HELP) ?></spam>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>

</div> <!-- End Col-md-7 -->


<div class="col-md-5 col-xs-12">
    <br>
    <div class="panel panel-form-media">
        <div class="panel-heading"><?= system_showText(LANG_SITEMGR_DOMAIN_MODULES) ?></div>
        <div class="panel-body">
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="article_feature" <?= $article_feature ? "checked" : ""; ?>/>
                    &nbsp; <?= system_showText(LANG_ARTICLE_FEATURE_NAME); ?>
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="banner_feature" <?= $banner_feature ? "checked" : ""; ?>/>
                    &nbsp; <?= system_showText(LANG_BANNER_FEATURE_NAME); ?>
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="classified_feature" <?= $classified_feature ? "checked" : ""; ?>/>
                    &nbsp; <?= system_showText(LANG_CLASSIFIED_FEATURE_NAME); ?>
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="event_feature" <?= $event_feature ? "checked" : ""; ?>/>
                    &nbsp; <?= system_showText(LANG_EVENT_FEATURE_NAME); ?>
                </label>
            </div>
        </div>
    </div>
    <div class="panel panel-form-media">
        <div class="panel-heading"><?= system_showText(LANG_SITEMGR_DOMAIN_LANGUAGE) ?></div>
        <div class="panel-body">
            <div class="checkbox-inline">
                <label>
                    <input type="radio"
                           name="domain_language" <?= $domain_language == 'en' ? "checked" : !isset($domain_language) ? "checked" : ""; ?>
                           value="en"/>
                    &nbsp; English
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="radio" name="domain_language" <?= $domain_language == 'pt' ? "checked" : ""; ?>
                           value="pt"/>
                    &nbsp; Português
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="radio" name="domain_language" <?= $domain_language == 'es' ? "checked" : ""; ?>
                           value="es"/>
                    &nbsp; Español
                </label>
            </div>
        </div>
    </div>

</div>
