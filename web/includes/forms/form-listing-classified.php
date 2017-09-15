<?php

/*
* # Admin Panel for eDirectory
* @copyright Copyright 2014 Arca Solutions, Inc.
* @author Basecode - Arca Solutions, Inc.
*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/forms/form-listing-classified.php
# ----------------------------------------------------------------------------------------------------

JavaScriptHandler::registerOnReady(
    "$('#classified-association').selectize({
        plugins: ['remove_button'],
        create: false, 
        sortField: 'text', 
        maxItems: {$listingClassifiedAssociation}, 
        persist: false, 
        allowEmptyOption: false
    });"
);
?>

<div class="col-md-8">

    <div class="panel panel-form">

        <div class="form-group">
            <div class="panel-heading">
                <?= system_showText(LANG_SITEMGR_CLASSIFIED_SING) ?>
            </div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <? if ($message_listingclassified) { ?>
                        <p class="alert alert-warning"><?= $message_listingclassified ?></p>
                    <? } ?>
                </div>
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <? if (count($classifieds) === 0) { ?>
                                <a href="<?=$url_base?>/<?=isset($sitemgr) ? 'content/' : ''?><?=CLASSIFIED_FEATURE_FOLDER?>/classified.php?listing_id=<?= $listing->getNumber(
                                    "id"
                                ) ?><?= (($url_search_params) ? "&$url_search_params" : ""); ?>"
                                   class="btn btn-primary">
                                    <?= system_showText(
                                        LANG_SITEMGR_ADDNEW
                                    ) ?>
                                    <?= system_showText(
                                        LANG_SITEMGR_CLASSIFIED
                                    ) ?>
                                </a>
                                <br>
                            <? } else {
                                /* I do not like elses */
                                $count = count($classifieds);
                                for ($i = 0; $i < $count; $i++) {
                                    if ($i === 0) {
                                        // first time
                                        printf(
                                            '<select id="%s" name="%s" multiple>',
                                            'classified-association',
                                            'classifieds_id[]'
                                        );
                                        printf(
                                            '<option %s value="%s">%s</option>',
                                            '',
                                            '',
                                            LANG_CHOOSE_CLASSIFIED_ATTACH
                                        );
                                    }
                                    $selected = $classifieds[$i]['listing_id'] == $listing->getNumber('id');
                                    // option tag
                                    printf(
                                        '<option %s value="%d">%s</option>',
                                        $selected ? 'selected' : '',
                                        $classifieds[$i]['id'],
                                        $classifieds[$i]['title']
                                    );
                                    // close select
                                    $i === ($count - 1) and printf(
                                        '</select>'
                                    );
                                }
                            } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label>
                                <?= system_showText(LANG_OR) ?>

                                <?= system_showText(
                                    LANG_SITEMGR_CLASSIFIED_ASSOCIATE
                                ) ?>
                            </label>
                            <div id="dealSelectBox"></div>
                            <p class="help-block small">
                                <?= system_showText(
                                    LANG_ATTACHCLASSIFIED_EMPTY
                                ); ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
