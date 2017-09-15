<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-promotion.php
	# ----------------------------------------------------------------------------------------------------

    if (!is_numeric($realvalue)) {
        $realvalue = 0;
    }
    if (!is_numeric($dealvalue)) {
        $dealvalue = 0;
    }

    if ($deal_type == "percentage") {
        $aux_deal_type = "%";
    } else {
        $aux_deal_type = CURRENCY_SYMBOL;
    }

    $amount = (int)$amount;
    if ($amount < 0) {
        $amount = ($amount*(-1));
    }

    unset($price_value);
    if ($realvalue != 'NULL' ) {
        $price_value = explode(".", $realvalue);
    }

    unset($price_value2);
    if ( $dealvalue != 'NULL' && $deal_type != "percentage") {
        $price_value2 = explode(".", $dealvalue);
    } else {
        $price_value2[0] = $deal_price_int;
    }

    $dealInfo = $promotion->getDealInfo();

    JavaScriptHandler::registerLoose('
        function setListingSelectBox(){
            $("#helpBlockEmpty").hide();
            $.post( "'.DEFAULT_URL.'/includes/code/deal_ajax_interface.php", { listingId : '.($aux_listing_id ? $aux_listing_id : 0).', dealid : '.($id ? $id : 0).', action : "getAllListings", accountId : window.selectAcc.val() }).done(function( data ) {
                var listings = JSON.parse( data );

                if( listings )
                {
                    $("#helpBlockEmpty").show();
                
                    var i, length = listings.length;
                    var select   = "<select name=\"listing_id\">";
                    var selected = '.( $aux_listing_id ? '""' : '"selected=\"selected\""' ).';
                    select += "<option "+selected+" value=\"0\">'.system_showText( LANG_CHOOSE_DEAL_ATTACH ).'</option>";
                    for( i = 0; i < listings.length; i++ ){
                        selected = ( listings[i].id == "'.($aux_listing_id ? $aux_listing_id : 0).'" ? "selected=\"selected\"" : "" );
                        select += "<option "+selected+" value=\""+listings[i].id+"\">"+listings[i].label+"</option>";
                    }
                    select += "</select>";

                    $("#listingSelectBox").html( select );

                    var options = {
                        allowEmptyOption : true
                    };

                    $("#listingSelectBox select").selectize( options );
                }
                else
                {
                    $("#helpBlockEmpty").hide();
                
                    var listingInput = "<input type=\"hidden\" name=\"listing_id\" id=\"listing_id\" value=\"0\">";
                        listingInput += "'.system_showText( LANG_ATTACHLISTING_UNAVAILABLE ).'"; 
                    $("#listingSelectBox").html( listingInput );
                }
            });
        }
    ');
    if (!$members) {
        JavaScriptHandler::registerOnReady('
                window.selectAcc.on( "change", setListingSelectBox );
                setListingSelectBox();
        ');
    }
?>

    <div class="col-md-7">

        <!-- Item Name is separated from all informations -->
        <div class="form-group" id="tour-title">
            <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_PROMOTION_TITLE), "tour-title"); ?>
            <label for="name" class="label-lg"><?=system_showText(LANG_PROMOTION_TITLE);?></label>
            <input type="text" class="form-control input-lg" id="name" name="name" value="<?=$name?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."'); populateField(this.value, 'seo_title', true);\" " : ""?> placeholder="<?=system_showText(LANG_HOLDER_PROMOTIONTITLE)?>" required>
        </div>

        <!-- Panel Basic Information  -->
        <div class="panel panel-form">

            <div class="panel-heading"><?=system_showText(LANG_BASIC_INFO)?></div>

            <div class="panel-body">

                <div class="form-group row">
                    <?
                    if (!$members) {
                    system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_ACCOUNT), "tour-owner");
                    ?>
                    <div class="col-sm-4" id="tour-owner">
                        <label for="account_id"><?=system_showText(LANG_LABEL_ACCOUNT);?></label>
                        <input type="text" class="form-control mail-select" name="account_id" id="account_id" placeholder="<?=system_showText(LANG_LABEL_ACCOUNT);?>" value="<?=$account_id?>">
                        <? system_generateAccountDropdown($auxAccountSelectize); ?>
                    </div>

                    <div class="col-sm-8" id="tour-listing">
                        <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_DEAL_LISTING_SELECT), "tour-listing"); ?>
                        <label for="listing_title"><?=system_showText(LANG_DEAL_LISTING_SELECT);?></label>
                        <div id="listingSelectBox"></div>
                        <p id="helpBlockEmpty" class="help-block small"><?=system_showText(LANG_ATTACHDEAL_EMPTY);?></p>
                    </div>

                    <? } else { ?>
                        <input type="hidden" name="listing_id" id="listing_id" value="<?=($aux_listing_id ? $aux_listing_id : ($_GET["listing_id"] ? $_GET["listing_id"] : ""));?>">
                    <? } ?>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_SUMMARY_DESCRIPTION), "tour-summary"); ?>
                <div class="form-group" id="tour-summary">
                    <label for="summary"><?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?></label>
                    <textarea id="summary" name="description" class="textarea-counter form-control <?=($highlight == "description" && !$description ? "highlight" : "")?>" <?=(!$id) ? " onblur=\"populateField(this.value, 'seo_description', true);\" " : ""?> rows="3" data-chars="250" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>" placeholder="<?=system_showText(LANG_HOLDER_PROMOTIONSUMMARY);?>"><?=$description;?></textarea>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_DESCRIPTION), "tour-description"); ?>
                <div class="form-group" id="tour-description">
                    <label for="full-description"><?=system_showText(LANG_LABEL_DESCRIPTION)?></label>
                    <textarea name="long_description" id="full-description" class="form-control <?=($highlight == "description" && !$long_description ? "highlight" : "")?>" rows="5" placeholder="<?=system_showText(LANG_HOLDER_PROMOTIONDESCRIPTION);?>"><?=$long_description?></textarea>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_CONDITIONS), "tour-conditions"); ?>
                <div class="form-group" id="tour-conditions">
                    <label for="conditions"><?=system_showText(LANG_LABEL_CONDITIONS)?></label>
                    <textarea id="conditions" name="conditions" class="textarea-counter form-control <?=($highlight == "description" && !$conditions ? "highlight" : "")?>" rows="5" data-chars="1000" data-msg="<?=system_showText(LANG_MSG_CHARS_LEFT)?>" placeholder="<?=system_showText(LANG_HOLDER_PROMOTIONCONDITIONS);?>"><?=$conditions;?></textarea>
                </div>

                <? system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH), "tour-keywords"); ?>
                <div class="form-group" id="tour-keywords">
                    <label for="keywords"><?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?></label>
                    <input type="text" name="keywords" id="keywords" class="form-control tag-input <?=($highlight == "additional" && !$keywords ? "highlight" : "")?>" placeholder="<?=system_showText(LANG_HOLDER_KEYWORDS);?>" value="<?=$keywords?>">
                    <p class="help-block small"><?=ucfirst(system_showText(LANG_LABEL_MAX));?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?></p>
                </div>

            </div>

        </div>

        <!-- Panel Date Information  -->
        <?
        system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_PROMOTION_DATE), "tour-date");
        ?>
        <div class="panel panel-form" id="tour-date">

            <div class="panel-heading"><?=system_showText(LANG_LABEL_PROMOTION_DATE)?></div>

            <div class="panel-body">

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="start_date"><?=system_showText(LANG_LABEL_START_DATE);?></label>
                        <input type="text" class="form-control date-input" id="start_date" name="start_date" value="<?=$start_date?>" placeholder="<?=format_printDateStandard()?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="end_date"><?=system_showText(LANG_LABEL_END_DATE);?></label>
                        <input type="text" class="form-control date-input" id="end_date" name="end_date" value="<?=$end_date?>" placeholder="<?=format_printDateStandard()?>">
                    </div>
                </div>

            </div>

        </div>

        <!-- Panel Discount Information  -->
        <?
        system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_SITEMGR_DISCINFO), "tour-discount");
        ?>
        <div class="panel panel-form" id="tour-discount">

            <div class="panel-heading"><?=system_showText(LANG_SITEMGR_DISCINFO)?></div>

            <div class="panel-body">

                <div class="form-group">

                    <label><?=system_showText(LANG_LABEL_DISCOUNT_TYPE)?></label>

                    <br>

                    <label class="radio-inline">
                        <input type="radio" id="type_monetary" name="deal_type" value="monetary value" <?=((!$deal_type || $deal_type == "monetary value") ? "checked" : "")?> onclick="showAmountType('<?=CURRENCY_SYMBOL?>', 'not');">
                        <?=system_showText(ucfirst(LANG_LABEL_FIXEDVALUE_DISC))?>
                    </label>

                    <label class="radio-inline">
                        <input type="radio" id="type_percentage" name="deal_type" value="percentage" <?=(($deal_type == "percentage") ? "checked" : "")?> onclick="showAmountType('%', 'not');">
                        <?=system_showText(ucfirst(LANG_LABEL_PERCENTAGE_DISC))?>
                    </label>

                </div>

                <div class="form-group row">

                    <div class="col-sm-6">
                        <label for="real_price_int"><?=system_showText(LANG_SITEMGR_ITEMVALUE)?> </label>
                        <div class="input-group">
                            <span class="input-group-addon"><?=CURRENCY_SYMBOL?></span>
                            <input type="number" class="form-control" id="real_price_int" name="real_price_int" value="<?=$price_value[0]?>" onkeyup="calculateDiscount();" maxlength="5">
                            <span class="input-group-addon"> &nbsp;.&nbsp; </span>
                            <input type="number" class="form-control" id="real_price_cent" name="real_price_cent" value="<?=$price_value[1]?>" onkeyup="calculateDiscount();" maxlength="2">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="deal_price_int" id="dealPriceValueLabel"><?=system_showText(LANG_LABEL_DISC_AMOUNT)?> </label>
                        <div class="input-group">
                            <span id="amount_monetary" class="input-group-addon"><?=CURRENCY_SYMBOL?></span>
                            <input type="number" class="form-control" id="deal_price_int" name="deal_price_int" value="<?=$price_value2[0]?>" onkeyup="calculateDiscount();" <?=(($deal_type == "percentage") ? "maxlength=\"2\"" : "maxlength=\"5\"")?>>

                            <span  id="label_deal_cent" class="input-group-addon"> &nbsp;.&nbsp; </span>
                            <input type="number" class="form-control" id="deal_price_cent" name="deal_price_cent" value="<?=$price_value2[1]?>" onkeyup="calculateDiscount();" maxlength="2">

                            <span class="input-group-addon" id="amount_percentage">  % </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    <p class="help-block small">
                        <?=system_showText(LANG_LABEL_DISC_CALCULATED)?>
                        <span id="discountAmount"> <?=(($realvalue > 0 && $dealvalue) && ($realvalue > $dealvalue) ) ? round(100 -( ($dealvalue*100) / $realvalue ) ).'%' : ''?> </span>
                        <span id="amountDiscountMessage" class="alert-warning"><?=($realvalue < $dealvalue ? system_showText(LANG_MSG_VALID_MINOR) : "")?></span>
                    </p>
                </div>

                <div class="form-group">
                    <label for="amount"><?=system_showText(LANG_LABEL_DEALS_OFFER);?></label>
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="amount" id="amount" maxlength="10" value="<?=(int)$amount?>">
                        </div>
                    </div>
                    <? if ($dealInfo['sold']) { ?>
                        <p class="help-block small"><?=$dealInfo['sold']?> <?=$dealInfo['sold'] > 1 ? system_showText(LANG_SITEMGR_DONEUNTIL_PLURAL) : system_showText(LANG_SITEMGR_DONEUNTIL_SINGULAR)?>.</p>
                    <? } ?>
                </div>


            </div>

        </div>

        <? include(INCLUDES_DIR."/forms/form-module-seocenter.php"); ?>

    </div>

    <div class="col-md-5">

        <!-- Cover Image-->
        <div class="panel panel-form-media">
            <div class="panel-heading">
                <?= system_showText(LANG_LABEL_COVERIMAGE);?>
                <span class="btn btn-sm btn-danger delete pull-right <?=(!(int)$cover_id ? "hidden" : "")?>" id="buttonReset">
                    <i class="icon-ion-ios7-trash-outline" onclick="sendCoverImage('promotion', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'deleteCover');" ></i>
                </span>
                <div class="pull-right">
                    <input type="file" name="cover-image" class="file-noinput" onchange="sendCoverImage('promotion', '<?=$_SERVER["PHP_SELF"]?>', <?=(isset($account_id) && $account_id == null ? $account_id : 0 )?>, 'uploadCover');">
                </div>
            </div>
            <div class="panel-body">
                <div id="coverimage" class="files">
                    <? if ((int)$cover_id) {
                        $imgObj = new Image($cover_id);
                        if ($imgObj->imageExists()) {
                            echo $imgObj->getTag(false, 0, 0, "", false, false, "img-responsive");
                        }

                        ?>
                        <input type="hidden" name="cover_id"  value="<?=$cover_id;?>">
                        <?
                    } ?>
                </div>

                <input type="hidden" name="curr_cover_id"  value="<?=$cover_id;?>">

                <p id="returnMessage" class="alert alert-warning" style="display:none;"></p>

            </div>
            <div class="panel-footer text-center">
                <p class="small text-muted"><?=system_showText(LANG_LABEL_RECOMMENDED_DIMENSIONS);?>: <?=COVER_IMAGE_WIDTH?> x <?=COVER_IMAGE_HEIGHT?> px (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</p>
                <p class="small text-muted"><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></p>
            </div>
        </div>

        <!-- Images-->
        <?php
            system_fieldsGuide($arrayTutorial, $counterTutorial, system_showText(LANG_LABEL_IMAGE), "tour-image");
            $imageUploader->buildform( true,"tour-image", false );
        ?>
    </div>
