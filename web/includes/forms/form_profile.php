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
	# * FILE: /inclues/forms/form_profile.php
	# ----------------------------------------------------------------------------------------------------

    $validate_demodirectoryDotCom = true;

    if (DEMO_LIVE_MODE) {
        $validate_demodirectoryDotCom = validate_demodirectoryDotCom($username, $message_demoDotCom);
    }

    if (!$facebook_image) {
        if ($image_id) {

            $imageObj = new Image($image_id, true);
            if ($imageObj->imageExists()) {
                $imgTag = $imageObj->getTag(true, PROFILE_MEMBERS_IMAGE_WIDTH, PROFILE_MEMBERS_IMAGE_HEIGHT);
            } else {
                $imgTag = "<span class=\"placeholder-profile\"><i class=\"fa fa-user\"></i></span>";
            }
        } else {
            $imgTag = "<span class=\"placeholder-profile\"><i class=\"fa fa-user\"></i></span>";
        }
    } else {
        if ($facebook_image) {
            if (HTTPS_MODE == "on") {
                $facebook_image = str_replace("http://", "https://", $facebook_image);
            }
            $imgTag = "<img src=\"".$facebook_image."\" width=\"".PROFILE_MEMBERS_IMAGE_WIDTH."\" height=\"".PROFILE_MEMBERS_IMAGE_HEIGHT."\" alt=\"Facebook Image\">";
        } else {
            $imgTag = "<span class=\"placeholder-profile\"><i class=\"fa fa-user\"></i></span>";
        }
    }

    $domain = new Domain(SELECTED_DOMAIN_ID);
	$domain_url = (SSL_ENABLED == "on" && FORCE_PROFILE_SSL == "on" ? "https://" : "http://").$domain->getString("url").EDIRECTORY_FOLDER."/".SOCIALNETWORK_FEATURE_NAME;

    ?>

    <div id="hiddenFields" style="display: none;">
        <input type="hidden" id="facebook_image" name="facebook_image" value="<?=$facebook_image?>">
        <input type="hidden" name="image_id" value="<?=$image_id?>">
    </div>

    <div id="personal-info">


        <h2><?=system_showText(LANG_LABEL_PROFILE_INFORMATION);?></h2>
        <br>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 well">
                <div class="row">
                    <div class="col-sm-3">
                        <div id="image_fb" class="img-responsive">
                            <?=$imgTag;?>
                        </div>

                        <div class="hidden-file profile-image">

                            <span class="hidden-file-box">
                                <button class="btn btn-block btn-sm btn-primary" type="button" id="buttonfile"><?=system_showText(LANG_LABEL_PROFILE_CHANGEPHOTO);?></button>
                                <input type="file" name="image" id="image" size="1">
                            </span>

                        </div>

                        <? if ($accountObj->getString("facebook_username")) { ?>
                            <br>
                            <span onclick="getFacebookImage();" class="btn btn-default btn-xs btn-facebook btn-block">
                                <?=system_showText(LANG_LABEL_IMAGE_FROM_FACEBOOK);?>
                            </span>

                        <? } ?>
                        <? if ($image_id || $facebook_image) { ?>
                            <div id="linkRemovePhoto" class="text-center">
                                <br>
                                <span class="btn btn-default btn-xs" onclick="removePhoto();"><?=system_showText(LANG_LABEL_PROFILE_REMOVEPHOTO);?></span>
                            </div>
                        <? } ?>

                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="nickname"><?=system_showText(LANG_LABEL_PROFILE_DISPLAYNAME);?></label>
                            <input class="form-control" id="nickname" type="text" name="nickname" value="<?=$nickname?>">
                        </div>

                        <div class="form-group">
                            <label for="personal_message"><?=system_showText(LANG_LABEL_ABOUT_ME);?></label>
                            <textarea class="form-control" id="personal_message" name="personal_message" rows="7" cols="1"><?=$personal_message?></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div id="personal-page">


        <h2><?=system_showText(LANG_LABEL_PROFILE_PERSONALPAGE);?></h2>
        <p><?=system_showText(LANG_MSG_FRIENDLY_URL_PROFILE_TIP);?></p>
        <br>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 well">
            <? if ($validate_demodirectoryDotCom && $is_sponsor == "y") { ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="has_profile" name="has_profile" <?=($has_profile == "y") ? "checked=\"checked\"": "" ?> onclick="profileStatus(this.id);">
                        <?=system_showText(LANG_LABEL_CREATE_PERSONAL_PAGE);?>
                    </label>
                </div>
            <? } ?>

            <div class="form-group">
                <label for="friendly_url"><?=system_showText(LANG_LABEL_YOUR_URL);?> </label>

                <div class="input-group">
                    <input class="form-control" type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>'); validateFriendlyURL(this.value, <?=(sess_getAccountIdFromSession() ? sess_getAccountIdFromSession() : 0)?>);">
                    <span class="input-group-addon">
                         <span id="URL_ok" ><i class="fa fa-check text-success"></i> <small><?=system_showText(LANG_LABEL_URLOK);?></small></span>
                         <span id="URL_notok" style="display: none;"><i class="fa fa-times text-warning"></i><small><?=system_showText(LANG_LABEL_URLNOTOK);?></small></span>
                    </span>
                  </div>
            </div>

            <div class="form-group">
                <label class="domainUrlSample"><?=$domain_url;?>/<b id="urlSample"><?=($friendly_url ? $friendly_url : system_showText(LANG_LABEL_YOUR_URLTIP))?></b>/</label>
            </div>

            </div>

        </div>

    </div>
