<?php
/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form-support-system.php
# ----------------------------------------------------------------------------------------------------

?>

<div class="col-md-9">

    <div class="panel panel-default">
        <div class="panel-heading">Current folder permissions
            <p>
                <small>The system needs to be able to read and write files as the web user under the /bin and /custom
                    folders. If these permissions are not set properly, the activation of eDirectory will NOT work.
                </small>
            </p>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-3">Required Permission for both folders</label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <b><?= $rightPerm ?></b>
                        <span>Having "<?= $rightPerm ?>" as permission, means a file can be read and written by any user.</span>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">/custom</label>
                <div class="col-sm-9">
                    <p class="form-control-static" <?= $styleCustom ?>>
                        <b><?= $customPerm ?></b>
                        <span>Current permission for the /custom folder and its contents. This folder holds all the modifiable files such as uploaded files, themes, etc.</span>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">/bin</label>
                <div class="col-sm-9">
                    <p class="form-control-static" <?= $styleBin ?>>
                        <b><?= $binPerm ?></b>
                        <span>Current permission for the /bin folder and its contents. This folder holds the binary files required by our activation system validation.</span>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">.htaccess Files </label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <? if (count($arrayHtaccesMissing)) { ?>
                            <b style="color: red; font-weight:bold;">Missing</b>
                            <b><?= $arrayHtaccesMissing[0] ?></b>
                            <?
                            array_shift($arrayHtaccesMissing);
                            if (is_array($arrayHtaccesMissing) && $arrayHtaccesMissing[0]) {
                                foreach ($arrayHtaccesMissing as $htFile) { ?>
                                    <b><?= $htFile ?></b>
                                <? } ?>
                            <? } ?>
                        <? } else { ?>
                            <b style="color: green">OK</b>
                        <? } ?>
                        <span>These files are responsible for most of the rewrites we have, such as friendly URLs, language URLs, etc.</span>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">reg.bin</label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <?
                        if (is_executable(BIN_PATH."/".BIN_SERVERTYPE."/reg.bin")) {
                            echo "<b style=\"color: green\">OK</b>";
                        } else {
                            echo "<b style=\"color: red\">reg.bin is not executable.</b>";
                        }
                        ?>
                        <span>Part of the directory activation information relies on this binary file. The system needs to be able to read it.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Constants
            <small> (custom/domain_<?= SELECTED_DOMAIN_ID ?>/conf/constants.inc.php)</small>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Save jpg as png
                </div>
                <div class="checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="const_jpg_as_png" value="y" <? if (FORCE_SAVE_JPG_AS_PNG == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>Turn on this constant to save jpg image as png. <span class="text-warning">ATTENTION! This provides better quality images, but image files size will be larger.</span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Force Sitemap url's to use "https"
                </div>
                <div class="checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="sitemap_forcehttps" value="y" <? if (SITEMAP_FORCEHTTPS == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>Turn on this constant to force every sitemap url to use https.</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-primary" onclick="JS_submit('constants');">Save Settings</button>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            Scalability
            <small> (custom/domain_<?= SELECTED_DOMAIN_ID ?>/conf/scalability.inc.php)</small>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Listing Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_listing"
                               value="y" <? if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 100.000 listings and/or more than 50.000 listings on the highest level</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Promotion Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_promotion"
                               value="y" <? if (PROMOTION_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 50.000 promotions</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Event Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_event"
                               value="y" <? if (EVENT_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 100.000 events and/or more than 50.000 events on the highest level</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Banner Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_banner"
                               value="y" <? if (BANNER_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 50.000 banners</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Classified Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_classified"
                               value="y" <? if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 100.000 classifieds and/or more than 50.000 classifieds on the highest level</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Article Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_article"
                               value="y" <? if (ARTICLE_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 100.000 articles and/or more than 50.000 articles on the highest level</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Blog Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_blog"
                               value="y" <? if (BLOG_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 100.000 posts</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Listing Category Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_listingcateg"
                               value="y" <? if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 20 main listing categories</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Event Category Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_eventcateg"
                               value="y" <? if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 20 main event categories</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Classified Category Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_classifiedcateg"
                               value="y" <? if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 20 main classified categories</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Article Category Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_articlecateg"
                               value="y" <? if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 20 main article categories</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Blog Category Scalability
                </div>
                <div class=" checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="scalability_blogcateg"
                               value="y" <? if (BLOGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>suggestion: turn on if edirectory has more than 20 main blog categories</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-primary" onclick="JS_submit('scalability');">Save Settings</button>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            General Settings
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    ArcaMailer Export via cron
                </div>
                <div class="checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="mailapp_via_cron" value="y" <? if ($mailapp_via_cron == "y") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>Check this box to export ArcaMailer lists via cron. <span class="text-warning">ATTENTION! Make sure cron task export_mailapp.php is scheduled if this box is checked.</span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Disable WhatsApp Share Button
                </div>
                <div class="checkbox col-sm-9">
                    <label>
                        <input type="checkbox" name="disable_whatsapp_share_button"
                               value="y" <? if ($disable_whatsapp_share_button == "y") {
                            echo "checked";
                        } ?> class="inputCheck"/>
                        <span>Disable WhatsApp share button</span>
                    </label>
                </div>
            </div>

            <?php
            $searchConfig = (new Symfony('search.yml'))->getConfig('search');
            ?>

            <div class="form-group">
                <div class="col-sm-3 control-label">
                    Aggregation Size
                </div>
                <div class="checkbox col-sm-9">
                    <label>
                        <input type="number" name="aggregation_size"
                               value="<?= $searchConfig['settings']['aggregationSize'] ?>" class="inputCheck"/>
                    </label>
                </div>
            </div>

        </div>
    </div>

</div>
