<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-support-reset.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="col-md-9">

        <div class="panel panel-default ">
            <div class="panel-heading">Sitemgr Password</div>
            <div class="panel-body">
                <input type="email" name="sitemgrusername" value="<?=$sm_username?>" placeholder="Username">
                <input type="password" name="sitemgrpass" placeholder="New password">
                <input type="hidden" name="action" value="sitemgr">
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <div class="panel panel-default ">
            <div class="panel-heading">Language File</div>
            <div class="panel-body">
                Rebuild language file (<i>custom/domain_<?=SELECTED_DOMAIN_ID?>/lang/language.inc.php</i>)
                <p class="help-block"><small>This may solve some problems related to the language files. Sometimes an issue may occur when copying them over to the /custom folder, so it might be necessary to run this tool to copy them again.</small></p>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-primary <?=$classLang?>" <?=$onclickLang?>><?=($classLang ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Sign In Options - Current Values:</div>
            <div class="panel-body">
                <p><strong>Google Account: </strong><?=$foreignaccount_google ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?>  <small>Turns this sign in option ON/FF.</small></p>
                <p><strong>Facebook: </strong><?=$foreignaccount_facebook? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?>   <small>Turns this sign in option ON/FF.</small></p>
                <p><strong>Facebook App ID: </strong><?=$foreignaccount_facebook_apiid?></p>
                <p><strong>Facebook App Secret: </strong><?=$foreignaccount_facebook_apisecret?></p>
            </div>
            <div class="panel-footer">
                Clear Sign In Options Values: <button type="button" class="btn btn-primary <?=$classsignIn?>" <?=$onclicksignIn?>><?=($classsignIn ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Twitter Options - Current Values:</div>
            <div class="panel-body">
                <p>Twitter Account: <i><?=$twitter_account?></i></p>
            </div>
            <div class="panel-footer">
                Clear Twitter Options Values: <button type="button" class="btn btn-primary <?=$classtwitter?>" <?=$onclicktwitter?>><?=($classtwitter ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Facebook Comments Options - Current Values:</div>
            <div class="panel-body">
                <p>Facebook Comments: <?=$commenting_fb ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?></p>
                <p>App ID: <?=$foreignaccount_facebook_apiid?></p>
                <p>User ID: <?=$fb_user_id?></p>
            </div>
            <div class="panel-footer">
                Clear Facebook Comments Options Values:  <button type="button" class="btn btn-primary <?=$classfbComments?>" <?=$onclickfbComments?>><?=($classfbComments ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Click to Call and Send to Phone - Current Values:</div>
            <div class="panel-body">
                <p>Click to Call: <?=$twilio_enabled_call ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?></p>
                <p>Twilio Account SID <?=$twilio_account_sid?></p>
                <p>Twilio Auth Token: <?=$twilio_auth_token?></p>
            </div>
            <div class="panel-footer">
                Clear Twilio Options Values: <button type="button" class="btn btn-primary <?=$classtwilio?>" <?=$onclicktwilio?>><?=($classtwilio ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Google Maps - Current Values:</div>
            <div class="panel-body">
                <p>Maps:  <?=$google_maps ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?></p>
                <p>Google Maps Key: <?=$google_maps_key?></p>
            </div>
            <div class="panel-footer">
                Clear Google Maps Options Values: <button type="button" class="btn btn-primary <?=$classgmaps?>" <?=$onclickgmaps?>><?=($classgmaps ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Google Ads - Current Values:</div>
            <div class="panel-body">
                <p> Ads: <?=$google_ad_status ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?></p>
                <p>Google Ads Client: <?=$google_ad_client?></p>
            </div>
            <div class="panel-footer">
                Clear Google Ads Options Values: <button type="button" class="btn btn-primary <?=$classgads?>" <?=$onclickgads?>><?=($classgads ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Google Analytics - Current Values:
            </div>
            <div class="panel-body">
                <p>Google Analytics Account<?=$google_analytics_account?></p>
                <p>Front<?=$google_analytics_front ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?></p>
                <p>Members<?=$google_analytics_members ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?></p>
                <p>Sitemgr<?=$google_analytics_sitemgr ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?></p>
            </div>
            <div class="panel-footer">Clear Google Analytics Options Values
                <button type="button" class="btn btn-primary <?=$classganalytics?>" <?=$onclickganalytics?>><?=($classganalytics ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Footer Links - Current Values:
            </div>
            <div class="panel-body">
                <p>Facebook
                    <?=$setting_facebook_link?>
                </p>

                <p>Linkedin
                    <?=$setting_linkedin_link?>
                </p>

            </div>
            <div class="panel-footer">Clear Footer links
                <button type="button" class="btn btn-primary <?=$classfooter?>" <?=$onclickfooter?>><?=($classfooter ? "Updated!" : "Reset Settings")?></button>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Sitemgr General E-mail - Current Values:
            </div>
            <div class="panel-body">

                <p>E-mail
                    <?=$sitemgr_email?>
                </p>

                <p>Send notifications to the e-mail above
                    <?=$send_email ? "<strong style=\"color: green\">ON</strong>" : "<strong style=\"color: red\">OFF</strong>"?>
                </p>
            </div>
            <div class="panel-footer">
                Clear Sitemgr General E-mail Options
                <button type="button" class="btn btn-primary <?=$classsystemEmail?>" <?=$onclicksystemEmail?>><?=($classsystemEmail ? "Updated!" : "Reset Settings")?></button>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                E-Mail Sending Configuration - Current Values:
            </div>
            <div class="panel-body">

                <p>  E-mail Method
                    <?=$emailconf_method?>
                </p>

                <p>  E-mail Host
                    <?=$emailconf_host?>
                </p>

                <p>  E-mail Port
                    <?=$emailconf_port?>
                </p>

                <p>  E-mail Auth
                    <?=$emailconf_auth?>
                </p>

                <p>  E-mail
                    <?=$emailconf_email?>
                </p>

                <p>  E-mail Username
                    <?=$emailconf_username?>
                </p>

                <p>   E-mail Password
                    <?=$emailconf_password?>
                </p>
            </div>
            <div class="panel-footer">
                Clear E-Mail Sending Configuration Options
                <button type="button" class="btn btn-primary <?=$classsmtpEmail?>" <?=$onclicksmtpEmail?>><?=($classsmtpEmail ? "Updated!" : "Reset Settings")?></button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                "To Do" Items
            </div>
            <div class="panel-body"> Reset all "to do" items
                <button type="button" class="btn btn-primary" onclick="resetOption('<?=$url_redirect."?action=todoItems"?>');">Reset Settings</button>
            </div>
        </div>

    </div>
