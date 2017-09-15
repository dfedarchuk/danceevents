<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_review_sitemgr.php
	# ----------------------------------------------------------------------------------------------------

?>

    <p class="alert alert-warning"  style="display:none" id="errorMessageReview"></p>

    <form name="formReview" action="review/review.php" method="post">

        <? if ($message_review) { ?>
            <p class="alert alert-warning"><?=$message_review?></p>
        <? } ?>

        <input type="hidden" name="rating_<?=$prevModule['id'];?>" id="rating_<?=$prevModule['id'];?>" value="">
        <input type="hidden" name="item_id" value="<?=$prevModule['item_id'];?>">
        <input type="hidden" name="item_type" value="<?=$prevModule['item_type'];?>">
        <input type="hidden" name="idReview" value="<?=$prevModule['id'];?>">
        <? if ($filter_id) { ?>
        <input type="hidden" name="filter_id" value="1">
        <? } ?>

        <div class="row">
            <div class="well">
                <div class="row">
                    <div id="star_<?=$prevModule['id'];?>" class="col-xs-12 text-center">
                        <?
                        $img_id = "star_".$prevModule['id']."";
                        $rating_id = "rating_".$prevModule['id']."";
                        ?>
                        <?=ucfirst(system_showText(LANG_SITEMGR_RATE))?>:
                        <img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/assets/images/structure/review-star-o.png" onclick="setRatingLevel(1, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(1, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/assets/images/structure/review-star-o.png" onclick="setRatingLevel(2, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(2, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/assets/images/structure/review-star-o.png" onclick="setRatingLevel(3, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(3, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/assets/images/structure/review-star-o.png" onclick="setRatingLevel(4, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(4, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/assets/images/structure/review-star-o.png" onclick="setRatingLevel(5, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(5, '<?=$img_id?>')" alt="star" />
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="reviewer_name<?=$prevModule['id'];?>"><?=system_showText(LANG_SITEMGR_LABEL_NAME)?></label>
                        <input class="form-control" type="text" name="reviewer_name" id="reviewer_name<?=$prevModule['id'];?>" value="<?=$prevModule["reviewer_name"];?>" maxlength="50">
                    </div>
                    <div class="col-sm-4">
                        <label for="reviewer_email<?=$prevModule['id'];?>"><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?></label>
                        <input class="form-control" type="text" name="reviewer_email" id="reviewer_email<?=$prevModule['id'];?>" value="<?=$prevModule["reviewer_email"];?>" maxlength="100">
                    </div>
                    <div class="col-sm-4">
                        <label for="reviewer_location<?=$prevModule['id'];?>"><?=system_showText(LANG_SITEMGR_LABEL_CITY_STATE)?></label>
                        <input class="form-control" type="text" name="reviewer_location" id="reviewer_location<?=$prevModule['id'];?>" value="<?=$prevModule["reviewer_location"];?>" maxlength="50">
                    </div>
                </div>

                <div class="form-group">
                    <label for="review_title<?=$prevModule['id'];?>"><?=system_showText(LANG_SITEMGR_TITLE)?></label>
                    <input class="form-control" type="text" name="review_title" id="review_title<?=$prevModule['id'];?>" value="<?=$prevModule["review_title"];?>" maxlength="50">
                </div>
                <div class="form-group">
                    <label for="review<?=$prevModule['id'];?>"><?=system_showText(LANG_SITEMGR_LABEL_COMMENT)?></label>
                    <textarea class="form-control" name="review" id="review<?=$prevModule['id'];?>" class="input-textarea-form-rate" rows="4"><?=$prevModule["review"];?></textarea>
                </div>
                <? if (string_strlen(trim($prevModule["response"])) > 0) { ?>
                    <div class="form-group">
                        <label for="response<?=$prevModule['id'];?>"><?=system_showText(LANG_REPLY)?></label>
                        <textarea class="form-control" name="response" id="response<?=$prevModule['id'];?>" rows="2"><?=$prevModule['response'];?></textarea>
                    </div>
                <? } ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="submit" value="Submit" class="btn btn-primary action-save"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
                    </div>
                </div>
            </div>
        </div>

    </form>


    <?// Approve Form ?>
    <div id="statusTR<?=$prevModule['id'];?>" class="hideForm" style="display:none">
        <form name="formStatus" id="formStatus_<?=$prevModule['id'];?>" action="review/status.php">
            <input type="hidden" name="item_id" value="<?=$prevModule['item_id'];?>">
            <input type="hidden" name="item_type" value="<?=$prevModule['item_type'];?>">
            <input type="hidden" name="idReview" value="<?=$prevModule['id'];?>">
            <input type="hidden" name="screen" value="<?=$_GET['screen']?>">
            <input type="hidden" name="letter" value="<?=$_GET['letter']?>">
            <input type="hidden" name="status" value="both">
        </form>
    </div>
